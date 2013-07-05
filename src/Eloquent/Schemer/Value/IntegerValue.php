<?php

/*
 * This file is part of the Schemer package.
 *
 * Copyright © 2013 Erin Millard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eloquent\Schemer\Value;

class IntegerValue extends AbstractConcreteValue implements NumberValueInterface
{
    /**
     * @param integer $value
     */
    public function __construct($value)
    {
        if (!is_int($value)) {
            throw new Exception\UnexpectedValueTypeException($value, 'integer');
        }

        parent::__construct($value);
    }

    /**
     * @return ValueType
     */
    public function valueType()
    {
        return ValueType::INTEGER_TYPE();
    }

    /**
     * @param Visitor\ValueVisitorInterface $visitor
     *
     * @return mixed
     */
    public function accept(Visitor\ValueVisitorInterface $visitor)
    {
        return $visitor->visitIntegerValue($this);
    }
}
