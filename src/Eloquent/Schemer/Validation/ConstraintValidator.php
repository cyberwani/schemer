<?php

/*
 * This file is part of the Schemer package.
 *
 * Copyright © 2013 Erin Millard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eloquent\Schemer\Validation;

use Eloquent\Schemer\Constraint\ConstraintInterface;
use Eloquent\Schemer\Constraint\ConstraintVisitorInterface;
use Eloquent\Schemer\Constraint\Generic\AnyOfConstraint;
use Eloquent\Schemer\Constraint\Generic\TypeConstraint;
use Eloquent\Schemer\Constraint\ObjectValue\PropertyConstraint;
use Eloquent\Schemer\Constraint\Schema;
use Eloquent\Schemer\Pointer\Pointer;
use Eloquent\Schemer\Pointer\PointerInterface;
use Eloquent\Schemer\Value\ArrayValue;
use Eloquent\Schemer\Value\BooleanValue;
use Eloquent\Schemer\Value\DateTimeValue;
use Eloquent\Schemer\Value\IntegerValue;
use Eloquent\Schemer\Value\NullValue;
use Eloquent\Schemer\Value\NumberValue;
use Eloquent\Schemer\Value\ObjectValue;
use Eloquent\Schemer\Value\StringValue;
use Eloquent\Schemer\Value\ValueInterface;
use Eloquent\Schemer\Value\ValueType;
use LogicException;

class ConstraintValidator implements
    ConstraintValidatorInterface,
    ConstraintVisitorInterface
{
    /**
     * @param ConstraintInterface   $constraint
     * @param ValueInterface        $value
     * @param PointerInterface|null $entryPoint
     *
     * @return ValidationResult
     */
    public function validate(
        ConstraintInterface $constraint,
        ValueInterface $value,
        PointerInterface $entryPoint = null
    ) {
        if (null === $entryPoint) {
            $entryPoint = new Pointer;
        }

        $this->clear();

        $this->pushContext(array($value, $entryPoint));
        $result = new Result\ValidationResult($constraint->accept($this));

        $this->clear();

        return $result;
    }

    /**
     * @param Schema $constraint
     *
     * @return array<Result\ValidationIssue>
     */
    public function visitSchema(Schema $constraint)
    {
        $issues = array();
        foreach ($constraint->constraints() as $subConstraint) {
            $issues = array_merge(
                $issues,
                $subConstraint->accept($this)
            );
        }

        return $issues;
    }

    // generic constraints

    /**
     * @param TypeConstraint $constraint
     *
     * @return array<Result\ValidationIssue>
     */
    public function visitTypeConstraint(TypeConstraint $constraint)
    {
        $value = $this->currentValue();
        $isValid = false;
        foreach ($constraint->types() as $type) {
            if ($type === ValueType::ARRAY_TYPE()) {
                $isValid = $value instanceof ArrayValue;
            } elseif ($type === ValueType::BOOLEAN_TYPE()) {
                $isValid = $value instanceof BooleanValue;
            } elseif ($type === ValueType::DATETIME_TYPE()) {
                $isValid = $value instanceof DateTimeValue;
            } elseif ($type === ValueType::INTEGER_TYPE()) {
                $isValid = $value instanceof IntegerValue;
            } elseif ($type === ValueType::NULL_TYPE()) {
                $isValid = $value instanceof NullValue;
            } elseif ($type === ValueType::NUMBER_TYPE()) {
                $isValid =
                    $value instanceof NumberValue ||
                    $value instanceof IntegerValue;
            } elseif ($type === ValueType::OBJECT_TYPE()) {
                $isValid = $value instanceof ObjectValue;
            } elseif ($type === ValueType::STRING_TYPE()) {
                $isValid = $value instanceof StringValue;
            }

            if ($isValid) {
                return array();
            }
        }

        return array($this->createIssue($constraint));
    }

    // object constraints

    /**
     * @param PropertyConstraint $constraint
     *
     * @return array<Result\ValidationIssue>
     */
    public function visitPropertyConstraint(PropertyConstraint $constraint)
    {
        $value = $this->currentValue();
        if (
            !$value instanceof ObjectValue ||
            !$value->has($constraint->property())
        ) {
            return array();
        }

        $this->pushContext(array(
            $value->get($constraint->property()),
            $this->currentPointer()->joinAtom($constraint->property())
        ));
        $issues = $constraint->schema()->accept($this);
        $this->popContext();

        return $issues;
    }

    /**
     * @param AnyOfConstraint $constraint
     *
     * @return array<Result\ValidationIssue>
     */
    public function visitAnyOfConstraint(AnyOfConstraint $constraint)
    {
        foreach ($constraint->schemas() as $schema) {
            if (count($schema->accept($this)) < 1) {
                return array();
            }
        }

        return array($this->createIssue($constraint));
    }

    // implementation details

    /**
     * @param tuple<ValueInterface,PointerInterface> $context
     */
    protected function pushContext(array $context)
    {
        array_push($this->contextStack, $context);
    }

    /**
     * @throws LogicException
     */
    protected function popContext()
    {
        if (null === array_pop($this->contextStack)) {
            throw new LogicException('Validation context stack is empty.');
        }
    }

    protected function clear()
    {
        $this->contextStack = array();
        $this->issues = array();
    }

    /**
     * @return tuple<ValueInterface,PointerInterface>
     * @throws LogicException
     */
    protected function currentContext()
    {
        $count = count($this->contextStack);
        if ($count < 1) {
            throw new LogicException('Current validation context is undefined.');
        }

        return $this->contextStack[$count - 1];
    }

    /**
     * @return ValueInterface
     * @throws LogicException
     */
    protected function currentValue()
    {
        list($value) = $this->currentContext();

        return $value;
    }

    /**
     * @return PointerInterface
     * @throws LogicException
     */
    protected function currentPointer()
    {
        list(, $pointer) = $this->currentContext();

        return $pointer;
    }

    /**
     * @param ConstraintInterface $constraint
     */
    protected function createIssue(ConstraintInterface $constraint)
    {
        list($value, $pointer) = $this->currentContext();

        return new Result\ValidationIssue(
            $constraint,
            $value,
            $pointer
        );
    }

    private $contextStack;
}