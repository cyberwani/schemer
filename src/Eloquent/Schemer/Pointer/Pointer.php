<?php

/*
 * This file is part of the Schemer package.
 *
 * Copyright © 2013 Erin Millard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eloquent\Schemer\Pointer;

class Pointer implements PointerInterface
{
    /**
     * @param array<string>|null $atoms
     */
    public function __construct(array $atoms = null)
    {
        if (null === $atoms) {
            $atoms = array();
        }

        $this->atoms = $atoms;
    }

    /**
     * @return array<string>
     */
    public function atoms()
    {
        return $this->atoms;
    }

    /**
     * @return boolean
     */
    public function hasAtoms()
    {
        return count($this->atoms) > 0;
    }

    /**
     * @return string
     */
    public function string()
    {
        if (!$this->hasAtoms()) {
            return '';
        }

        return sprintf(
            '/%s',
            implode(
                '/',
                array_map(
                    function($value) {
                        return strtr($value, array('~' => '~0', '/' => '~1'));
                    },
                    $this->atoms()
                )
            )
        );
    }

    private $atoms;
}