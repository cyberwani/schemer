<?php

/*
 * This file is part of the Schemer package.
 *
 * Copyright © 2013 Erin Millard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eloquent\Schemer\Uri\Resolver;

use Eloquent\Schemer\Uri\UriInterface;

interface UriResolverInterface
{
    /**
     * @param UriInterface $uri
     * @param UriInterface $baseUri
     *
     * @return UriInterface
     */
    public function resolve(UriInterface $uri, UriInterface $baseUri);
}
