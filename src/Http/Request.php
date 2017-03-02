<?php

/*
 * This file is part of WordPlate.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace WordPlate\Http;

/**
 * This is the request class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class Request
{
    /**
     * Get the request host.
     *
     * @return string
     */
    public function getHost(): string
    {
        if (isset($_SERVER['HTTP_HOST'])) {
            return $_SERVER['HTTP_HOST'];
        }

        if (isset($_SERVER['SERVER_NAME'])) {
            return $_SERVER['SERVER_NAME'];
        }

        return $_SERVER['SERVER_ADDR'] ?? '';
    }

    /**
     * Get the request's scheme.
     *
     * @return string
     */
    public function getScheme(): string
    {
        if (isset($_SERVER['HTTPS']) && 'off' !== strtolower($_SERVER['HTTPS'])) {
            return 'https';
        }

        return 'http';
    }
}
