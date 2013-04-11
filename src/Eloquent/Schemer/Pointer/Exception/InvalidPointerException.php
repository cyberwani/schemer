<?php

/*
 * This file is part of the Schemer package.
 *
 * Copyright © 2013 Erin Millard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eloquent\Schemer\Pointer\Exception;

use Exception;
use Icecave\Repr\Repr;

final class InvalidPointerException extends Exception
{
    /**
     * @param string         $pointer
     * @param Exception|null $previous
     */
    public function __construct($pointer, Exception $previous = null)
    {
        $this->pointer = $pointer;

        parent::__construct(
            sprintf("Invalid pointer %s.", Repr::repr($pointer)),
            0,
            $previous
        );
    }

    /**
     * @return string
     */
    public function pointer()
    {
        return $this->pointer;
    }

    private $pointer;
}
