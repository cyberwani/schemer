<?php

/*
 * This file is part of the Schemer package.
 *
 * Copyright © 2013 Erin Millard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eloquent\Schemer\Reference\Exception;

use Eloquent\Schemer\Value\ReferenceValue;
use Exception;

final class UndefinedReferenceException extends Exception
{
    /**
     * @param ReferenceValue $reference
     * @param string|null    $context
     * @param Exception|null $previous
     */
    public function __construct(
        ReferenceValue $reference,
        $context = null,
        Exception $previous = null
    ) {
        $this->reference = $reference;
        $this->context = $context;

        if (null === $context) {
            $message = sprintf(
                "Unable to resolve reference %s.",
                var_export($reference->uri()->toString(), true)
            );
        } else {
            $message = sprintf(
                "Unable to resolve reference %s from within context %s.",
                var_export($reference->uri()->toString(), true),
                var_export($context, true)
            );
        }

        parent::__construct($message, 0, $previous);
    }

    /**
     * @return ReferenceValue
     */
    public function reference()
    {
        return $this->reference;
    }

    /**
     * @return string|null
     */
    public function context()
    {
        return $this->context;
    }

    private $reference;
    private $context;
}
