<?php

/*
 * This file is part of the Schemer package.
 *
 * Copyright © 2013 Erin Millard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eloquent\Schemer\Constraint;

interface ConstraintVisitorInterface
{
    /**
     * @param Schema $constraint
     *
     * @return mixed
     */
    public function visitSchema(Schema $constraint);

    // generic constraints =====================================================

    /**
     * @param Generic\EnumConstraint $constraint
     *
     * @return mixed
     */
    public function visitEnumConstraint(Generic\EnumConstraint $constraint);

    /**
     * @param Generic\TypeConstraint $constraint
     *
     * @return mixed
     */
    public function visitTypeConstraint(Generic\TypeConstraint $constraint);

    /**
     * @param Generic\AllOfConstraint $constraint
     *
     * @return mixed
     */
    public function visitAllOfConstraint(Generic\AllOfConstraint $constraint);

    /**
     * @param Generic\AnyOfConstraint $constraint
     *
     * @return mixed
     */
    public function visitAnyOfConstraint(Generic\AnyOfConstraint $constraint);

    /**
     * @param Generic\OneOfConstraint $constraint
     *
     * @return mixed
     */
    public function visitOneOfConstraint(Generic\OneOfConstraint $constraint);

    /**
     * @param Generic\NotConstraint $constraint
     *
     * @return mixed
     */
    public function visitNotConstraint(Generic\NotConstraint $constraint);

    // object constraints ======================================================

    /**
     * @param ObjectValue\MaximumPropertiesConstraint $constraint
     *
     * @return mixed
     */
    public function visitMaximumPropertiesConstraint(ObjectValue\MaximumPropertiesConstraint $constraint);

    /**
     * @param ObjectValue\MinimumPropertiesConstraint $constraint
     *
     * @return mixed
     */
    public function visitMinimumPropertiesConstraint(ObjectValue\MinimumPropertiesConstraint $constraint);

    /**
     * @param ObjectValue\RequiredConstraint $constraint
     *
     * @return mixed
     */
    public function visitRequiredConstraint(ObjectValue\RequiredConstraint $constraint);

    /**
     * @param ObjectValue\PropertiesConstraint $constraint
     *
     * @return mixed
     */
    public function visitPropertiesConstraint(ObjectValue\PropertiesConstraint $constraint);

    /**
     * @param ObjectValue\AdditionalPropertyConstraint $constraint
     *
     * @return mixed
     */
    public function visitAdditionalPropertyConstraint(ObjectValue\AdditionalPropertyConstraint $constraint);

    /**
     * @param ObjectValue\DependencyConstraint $constraint
     *
     * @return mixed
     */
    public function visitDependencyConstraint(ObjectValue\DependencyConstraint $constraint);

    // array constraints =======================================================

    /**
     * @param ArrayValue\ItemsConstraint $constraint
     *
     * @return mixed
     */
    public function visitItemsConstraint(ArrayValue\ItemsConstraint $constraint);

    /**
     * @param ArrayValue\AdditionalItemConstraint $constraint
     *
     * @return mixed
     */
    public function visitAdditionalItemConstraint(ArrayValue\AdditionalItemConstraint $constraint);

    /**
     * @param ArrayValue\MaximumItemsConstraint $constraint
     *
     * @return mixed
     */
    public function visitMaximumItemsConstraint(ArrayValue\MaximumItemsConstraint $constraint);

    /**
     * @param ArrayValue\MinimumItemsConstraint $constraint
     *
     * @return mixed
     */
    public function visitMinimumItemsConstraint(ArrayValue\MinimumItemsConstraint $constraint);

    /**
     * @param ArrayValue\UniqueItemsConstraint $constraint
     *
     * @return mixed
     */
    public function visitUniqueItemsConstraint(ArrayValue\UniqueItemsConstraint $constraint);

    // string constraints ======================================================

    /**
     * @param StringValue\PatternConstraint $constraint
     *
     * @return mixed
     */
    public function visitPatternConstraint(StringValue\PatternConstraint $constraint);
}
