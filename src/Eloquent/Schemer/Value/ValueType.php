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

use Eloquent\Enumeration\AbstractEnumeration;

final class ValueType extends AbstractEnumeration
{
    const ARRAY_TYPE = 'array';
    const BOOLEAN_TYPE = 'boolean';
    const DATE_TIME_TYPE = 'date-time';
    const FLOATING_POINT_TYPE = 'float';
    const INTEGER_TYPE = 'integer';
    const NULL_TYPE = 'null';
    const NUMBER_TYPE = 'number';
    const OBJECT_TYPE = 'object';
    const STRING_TYPE = 'string';
}
