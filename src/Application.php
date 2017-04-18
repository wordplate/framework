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

namespace WordPlate;

use Dotenv\Dotenv;
use Dotenv\Exception\InvalidPathException;
use Symfony\Component\HttpFoundation\Request;

/**
 * This is the application class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
final class Application
{
    /**
     * The base path for the WordPlate installation.
     *
     * @var string
     */
    protected $basePath;

    /**
     * The WordPress database table prefix.
     *
     * @param string $basePath
     *
     * @return void
     */
    public function __construct(string $basePath)
    {
        $this->basePath = $basePath;
        $this->tablePrefix = null;

        $this->loadEnvironment();
    }

    /**
     * Load the environment variables.
     *
     * @return void
     */
    protected function loadEnvironment()
    {
        try {
            (new Dotenv($this->basePath))->load();
        } catch (InvalidPathException $e) {
            //
        }
    }

    /**
     * Get the path to the public / web directory.
     *
     * @return string
     */
    protected function getPublicPath(): string
    {
        return $this->basePath.DIRECTORY_SEPARATOR.'public';
    }

    /**
     * Star the application engine.
     *
     * @return void
     */
    public function run()
    {
        // The WordPress environment.
        define('WP_ENV', env('WP_ENV', 'production'));

        // For developers: WordPress debugging mode.
        $debug = env('WP_DEBUG', false);
        define('WP_DEBUG', $debug);
        define('WP_DEBUG_DISPLAY', env('WP_DEBUG_DISPLAY', $debug));
        define('SCRIPT_DEBUG', env('SCRIPT_DEBUG', $debug));

        // The MySQL database configuration with database name, username,
        // password, hostname charset and database collae type.
        define('DB_NAME', env('DB_NAME'));
        define('DB_USER', env('DB_USER'));
        define('DB_PASSWORD', env('DB_PASSWORD'));
        define('DB_HOST', env('DB_HOST'));
        define('DB_CHARSET', env('DB_CHARSET', 'utf8mb4'));
        define('DB_COLLATE', env('DB_COLLATE', 'utf8mb4_unicode_ci'));

        // Set the WordPress database table prefix.
        $table_prefix = env('WP_PREFIX', 'wp_');

        // Set the unique authentication keys and salts.
        define('AUTH_KEY', env('AUTH_KEY'));
        define('SECURE_AUTH_KEY', env('SECURE_AUTH_KEY'));
        define('LOGGED_IN_KEY', env('LOGGED_IN_KEY'));
        define('NONCE_KEY', env('NONCE_KEY'));
        define('AUTH_SALT', env('AUTH_SALT'));
        define('SECURE_AUTH_SALT', env('SECURE_AUTH_SALT'));
        define('LOGGED_IN_SALT', env('LOGGED_IN_SALT'));
        define('NONCE_SALT', env('NONCE_SALT'));

        // Set the home url to the current domain.
        $request = Request::createFromGlobals();
        define('WP_HOME', env('WP_URL', $request->getSchemeAndHttpHost()));

        // Set the WordPress directory path.
        define('WP_SITEURL', env('WP_SITEURL', sprintf('%s/%s', WP_HOME, env('WP_DIR', 'wordpress'))));

        // Set the WordPress content directory path.
        define('WP_CONTENT_DIR', env('WP_CONTENT_DIR', $this->getPublicPath()));
        define('WP_CONTENT_URL', env('WP_CONTENT_URL', WP_HOME));

        // Set the trash to less days to optimize WordPress.
        define('EMPTY_TRASH_DAYS', env('EMPTY_TRASH_DAYS', 7));

        // Set the default WordPress theme.
        define('WP_DEFAULT_THEME', env('WP_THEME', 'wordplate'));

        // Specify the number of post revisions.
        define('WP_POST_REVISIONS', env('WP_POST_REVISIONS', 2));

        // Cleanup WordPress image edits.
        define('IMAGE_EDIT_OVERWRITE', env('IMAGE_EDIT_OVERWRITE', true));

        // Prevent file edititing from the dashboard.
        define('DISALLOW_FILE_EDIT', env('DISALLOW_FILE_EDIT', true));

        // Set the absolute path to the WordPress directory.
        if (!defined('ABSPATH')) {
            define('ABSPATH', sprintf('%s/%s/', $this->getPublicPath(), env('WP_DIR', 'wordpress')));
        }

        // WP-CLI require 'wp-settings.php' to be required in 'wp-config.php'.
        if (!class_exists('WP_CLI')) {
            // Set WordPress variables and included files.
            require sprintf('%swp-settings.php', ABSPATH);
        }
    }
}
