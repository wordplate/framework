<?php

/*
 * This file is part of WordPlate.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WordPlate\Debug;

use Symfony\Component\VarDumper\Dumper\HtmlDumper as SymfonyDumper;

/**
 * This is the html dumper class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class HtmlDumper extends SymfonyDumper
{
    /**
     * Colour definitions for output.
     *
     * @var array
     */
    protected $styles = [
        'default' => 'background-color: #fff; color: #222; line-height: 1.2em; font-weight: normal; font: 12px Monaco, Consolas, monospace; word-wrap: break-word; white-space: pre-wrap; position: relative; z-index: 100000:',
        'num' => 'color: #a71d5d',
        'const' => 'color: #795da3',
        'str' => 'color: #df5000',
        'cchr' => 'color: #222',
        'note' => 'color: #a71d5d',
        'ref' => 'color: #a0a0a0',
        'public' => 'color: #795da3',
        'protected' => 'color: #795da3',
        'private' => 'color: #795da3',
        'meta' => 'color: #b729d9',
        'key' => 'color: #df5000',
        'index' => 'color: #a71d5d',
    ];
}
