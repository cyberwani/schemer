<?php

/*
 * This file is part of the Schemer package.
 *
 * Copyright © 2013 Erin Millard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eloquent\Schemer\Constraint\Generic;

use Eloquent\Schemer\Constraint\ConstraintInterface;
use Eloquent\Schemer\Constraint\ConstraintVisitorInterface;
use Eloquent\Schemer\Constraint\Schema;

class AnyOfConstraint implements ConstraintInterface
{
    /**
     * @param array<Schema> $schemas
     */
    public function __construct(array $schemas)
    {
        $this->property = $property;
        $this->schemas = $schemas;
    }

    /**
     * @return string
     */
    public function property()
    {
        return $this->property;
    }

    /**
     * @return array<Schema>
     */
    public function schemas()
    {
        return $this->schemas;
    }

    /**
     * @param ConstraintVisitorInterface $visitor
     *
     * @return mixed
     */
    public function accept(ConstraintVisitorInterface $visitor)
    {
        return $visitor->visitAnyOfConstraint($this);
    }

    private $property;
    private $schemas;
}
