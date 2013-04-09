<?php

/*
 * This file is part of the Schemer package.
 *
 * Copyright © 2013 Erin Millard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eloquent\Schemer\Constraint\Renderer;

use Eloquent\Schemer\Constraint\ConstraintVisitorInterface;
use Eloquent\Schemer\Constraint\Generic\TypeConstraint;
use Eloquent\Schemer\Constraint\ObjectValue\PropertyConstraint;
use Eloquent\Schemer\Constraint\Schema;

class ConstraintFailureRenderer implements ConstraintVisitorInterface
{
    const UNMATCHED_SCHEMA = 'The value did not match the defined schema.';

    /**
     * @param Schema $constraint
     *
     * @return string
     */
    public function visitSchema(Schema $constraint)
    {
        return static::UNMATCHED_SCHEMA;
    }

    // generic constraints

    /**
     * @param TypeConstraint $constraint
     *
     * @return string
     */
    public function visitTypeConstraint(TypeConstraint $constraint)
    {
        return sprintf(
            "The value must be of type '%s'.", $constraint->type()->value()
        );
    }

    // object constraints

    /**
     * @param PropertyConstraint $constraint
     *
     * @return string
     */
    public function visitPropertyConstraint(PropertyConstraint $constraint)
    {
        return static::UNMATCHED_SCHEMA;
    }
}
