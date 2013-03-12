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

use DateTime;

class DateTimeValue extends AbstractValue
{
    /**
     * @param DateTime $value
     */
    public function __construct(DateTime $value)
    {
        parent::__construct($value);
    }

    /**
     * @param ValueVisitorInterface $visitor
     *
     * @return mixed
     */
    public function accept(ValueVisitorInterface $visitor)
    {
        return $visitor->visitDateTimeValue($this);
    }
}
