<?php

/*
 * This file is part of the Schemer package.
 *
 * Copyright © 2013 Erin Millard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eloquent\Schemer\Constraint\NumberValue;

use Eloquent\Schemer\Constraint\ConstraintInterface;
use Eloquent\Schemer\Constraint\Visitor\ConstraintVisitorInterface;

class MaximumConstraint implements ConstraintInterface
{
    /**
     * @param integer|float $maximum
     * @param boolean|null  $exclusive
     */
    public function __construct($maximum, $exclusive = null)
    {
        if (null === $exclusive) {
            $exclusive = false;
        }

        $this->maximum = $maximum;
        $this->exclusive = $exclusive;
    }

    /**
     * @return integer|float
     */
    public function maximum()
    {
        return $this->maximum;
    }

    /**
     * @return boolean
     */
    public function exclusive()
    {
        return $this->exclusive;
    }

    /**
     * @param ConstraintVisitorInterface $visitor
     *
     * @return mixed
     */
    public function accept(ConstraintVisitorInterface $visitor)
    {
        return $visitor->visitMaximumConstraint($this);
    }

    private $maximum;
    private $exclusive;
}
