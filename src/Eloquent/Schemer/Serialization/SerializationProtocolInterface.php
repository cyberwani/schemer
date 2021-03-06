<?php

/*
 * This file is part of the Schemer package.
 *
 * Copyright © 2013 Erin Millard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eloquent\Schemer\Serialization;

interface SerializationProtocolInterface
{
    /**
     * @param string $data
     *
     * @return mixed
     * @throws Exception\ThawExceptionInterface
     */
    public function thaw($data);
}
