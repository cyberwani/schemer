<?php

/*
 * This file is part of the Schemer package.
 *
 * Copyright © 2013 Erin Millard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eloquent\Schemer\Validation\Exception;

use Eloquent\Schemer\Constraint\ConstraintInterface;
use Eloquent\Schemer\Validation\Result\IssueRenderer;
use Eloquent\Schemer\Validation\Result\IssueRendererInterface;
use Eloquent\Schemer\Validation\Result\ValidationResult;
use Eloquent\Schemer\Value\ValueInterface;
use Exception;

final class InvalidValueException extends Exception
{
    /**
     * @param ValueInterface              $value
     * @param ConstraintInterface         $constraint
     * @param ValidationResult            $result
     * @param Exception|null              $previous
     * @param IssueRendererInterface|null $issueRenderer
     */
    public function __construct(
        ValueInterface $value,
        ConstraintInterface $constraint,
        ValidationResult $result,
        Exception $previous = null,
        IssueRendererInterface $issueRenderer = null
    ) {
        if (null === $issueRenderer) {
            $issueRenderer = new IssueRenderer;
        }

        $this->value = $value;
        $this->constraint = $constraint;
        $this->result = $result;
        $this->issueRenderer = $issueRenderer;

        parent::__construct(
            sprintf(
                "The provided value is not valid against the given constraint:\n%s",
                $issueRenderer->renderManyString($result->issues())
            ),
            0,
            $previous
        );
    }

    /**
     * @return ValueInterface
     */
    public function value()
    {
        return $this->value;
    }

    /**
     * @return ConstraintInterface
     */
    public function constraint()
    {
        return $this->constraint;
    }

    /**
     * @return ValidationResult
     */
    public function result()
    {
        return $this->result;
    }

    private $value;
    private $constraint;
    private $result;
}
