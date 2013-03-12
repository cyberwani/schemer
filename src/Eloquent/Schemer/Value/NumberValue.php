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

use InvalidArgumentException;

class NumberValue extends AbstractValue
{
    /**
     * @param float $value
     */
    public function __construct($value)
    {
        if (!is_float($value)) {
            throw new InvalidArgumentException(
                'Value must be a floating-point number.'
            );
        }

        parent::__construct($value);
    }

    /**
     * @param ValueVisitorInterface $visitor
     *
     * @return mixed
     */
    public function accept(ValueVisitorInterface $visitor)
    {
        return $visitor->visitNumberValue($this);
    }
}
