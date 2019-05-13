<?php

/*
 * This file is part of WordPlate.
 *
 * (c) Vincent Klaiber <hello@doubledip.se>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

function current_user_can()
{
    return true;
}

function do_action()
{
    //
}

function get_current_screen()
{
    return json_decode(json_encode(['base' => 'plugins']));
}

function get_option()
{
    return [];
}

function get_theme_file_path(string $path)
{
    return __DIR__.'/stubs/child-theme'.$path;
}

function get_stylesheet_directory()
{
    return __DIR__.'/stubs/child-theme';
}

function get_stylesheet_directory_uri()
{
    return 'https://wordplate.dev/wp-content/themes/child-theme';
}

function get_template_directory()
{
    return __DIR__.'/stubs/parent-theme';
}

function get_template_directory_uri()
{
    return 'https://wordplate.dev/wp-content/themes/parent-theme';
}

function is_blog_installed()
{
    return true;
}

function is_plugin_active()
{
    return false;
}

function update_option()
{
    return [];
}
