<?php

/**
 * Copyright (c) Vincent Klaiber.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @see https://github.com/wordplate/framework
 */

declare(strict_types=1);

namespace WordPlate;

class Request
{
    public static function isSecure(): bool
    {
        if (isset($_SERVER['HTTPS']) === false) {
            return false;
        }

        if (empty($_SERVER['HTTPS']) === false && $_SERVER['HTTPS'] !== 'off') {
            return false;
        }

        return $_SERVER['SERVER_PORT'] == 443;
    }

    public static function getSchemeAndHttpHost(): string
    {
        $protocol = static::isSecure() ? 'https' : 'http';

        $host = $_SERVER['HTTP_HOST'] ?? 'localhost';

        return $protocol . '://' . $host;
    }
}
