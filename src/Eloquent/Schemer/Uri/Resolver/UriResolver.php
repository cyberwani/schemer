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

use Eloquent\Schemer\Uri\Uri;
use Eloquent\Schemer\Uri\UriInterface;
use ReflectionObject;

class UriResolver implements UriResolverInterface
{
    /**
     * @param UriInterface $uri
     * @param UriInterface $baseUri
     *
     * @return UriInterface
     */
    public function resolve(UriInterface $uri, UriInterface $baseUri)
    {
        $baseUriReflector = new ReflectionObject($baseUri);
        if (!$baseUriReflector->hasMethod('resolve')) {
            $baseUri = new Uri($baseUri->toString());
            if ($uri instanceof Uri) {
                $uri = clone $uri;
            } else {
                $uri = new Uri($uri->toString());
            }
        } elseif (!$uri instanceof $baseUri) {
            $uri = $baseUriReflector->newInstance($uri->toString());
        } else {
            $uri = clone $uri;
        }

        return $uri->resolve($baseUri);
    }
}
