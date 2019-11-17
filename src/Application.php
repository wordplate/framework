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

namespace WordPlate;

use Dotenv\Dotenv;
use Symfony\Component\HttpFoundation\Request;

/**
 * This is the application class.
 *
 * @author Vincent Klaiber <hello@doubledip.se>
 */
class Application
{
    /**
     * The base path for the WordPlate installation.
     *
     * @var string
     */
    protected $basePath;

    /**
     * The public web directory path.
     *
     * @var string
     */
    protected $publicPath;

    /**
     * Create a new application instance.
     *
     * @param string $basePath
     *
     * @return void
     */
    public function __construct(string $basePath)
    {
        $this->basePath = $basePath;

        Dotenv::create($this->basePath)->safeLoad();
    }

    /**
     * Star the application engine.
     *
     * @return void
     */
    public function run(): void
    {
        // For developers: WordPress debugging mode.
        $debug = env('WP_DEBUG', false);
        define('WP_DEBUG', $debug);
        define('WP_DEBUG_LOG', env('WP_DEBUG_LOG', false));
        define('WP_DEBUG_DISPLAY', env('WP_DEBUG_DISPLAY', $debug));
        define('SCRIPT_DEBUG', env('SCRIPT_DEBUG', $debug));

        // The database configuration with database name, username, password,
        // hostname charset and database collae type.
        define('DB_NAME', env('DB_NAME'));
        define('DB_USER', env('DB_USER'));
        define('DB_PASSWORD', env('DB_PASSWORD'));
        define('DB_HOST', env('DB_HOST'));
        define('DB_CHARSET', env('DB_CHARSET', 'utf8mb4'));
        define('DB_COLLATE', env('DB_COLLATE', 'utf8mb4_unicode_ci'));

        // Detect HTTPS behind a reverse proxy or a load balancer.
        if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
            $_SERVER['HTTPS'] = 'on';
        }

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

        // Constant to configure core updates.
        define('WP_AUTO_UPDATE_CORE', env('WP_AUTO_UPDATE_CORE', 'minor'));

        // Specify the number of post revisions.
        define('WP_POST_REVISIONS', env('WP_POST_REVISIONS', 2));

        // Cleanup WordPress image edits.
        define('IMAGE_EDIT_OVERWRITE', env('IMAGE_EDIT_OVERWRITE', true));

        // Prevent file edititing from the dashboard.
        define('DISALLOW_FILE_EDIT', env('DISALLOW_FILE_EDIT', true));

        // Disable technical issues emails.
        // https://make.wordpress.org/core/2019/04/16/fatal-error-recovery-mode-in-5-2/
        define('WP_DISABLE_FATAL_ERROR_HANDLER', env('WP_DISABLE_FATAL_ERROR_HANDLER', false));

        // Set the cache constant for plugins such as WP Super Cache and W3 Total Cache.
        define('WP_CACHE', env('WP_CACHE', true));

        // Set the absolute path to the WordPress directory.
        if (!defined('ABSPATH')) {
            define('ABSPATH', sprintf('%s/%s/', $this->getPublicPath(), env('WP_DIR', 'wordpress')));
        }

        // Load the must-use plugins.
        $pluginLoader = new PluginLoader();
        $pluginLoader->load();
    }

    /**
     * Get the base path for the application.
     *
     * @return string
     */
    public function getBasePath(): string
    {
        return $this->basePath;
    }

    /**
     * Get the public web directory path.
     *
     * @return string
     */
    public function getPublicPath(): string
    {
        if (is_null($this->publicPath)) {
            return $this->basePath.DIRECTORY_SEPARATOR.'public';
        }

        return $this->publicPath;
    }

    /**
     * Set the public web directory path.
     *
     * @param string $publicPath
     *
     * @return void
     */
    public function setPublicPath(string $publicPath)
    {
        $this->publicPath = $publicPath;
    }
}
