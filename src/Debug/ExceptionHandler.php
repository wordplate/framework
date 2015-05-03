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

use ErrorException;
use Exception;
use Symfony\Component\Debug\Exception\FatalErrorException;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run as Whoops;
use WordPlate\Foundation\Application;

/**
 * This is the exception handler.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class ExceptionHandler
{
    /**
     * The application instance.
     *
     * @var \WordPlate\Foundation\Application
     */
    private $app;

    /**
     * Create new exception handler instance.
     *
     * @param \WordPlate\Foundation\Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;

        error_reporting(-1);

        set_error_handler([$this, 'handleError']);

        set_exception_handler([$this, 'handleException']);

        register_shutdown_function([$this, 'handleShutdown']);
    }

    /**
     * Handle an uncaught exception from the application.
     *
     * @param \Exception $e
     *
     * @return void
     */
    public function handleException(Exception $e)
    {
        if (config('theme.debug')) {
            return $this->whoops()->handleException($e);
        }
    }

    /**
     * Convert a PHP error to an ErrorException.
     *
     * @param int $level
     * @param string $message
     * @param string $file
     * @param int $line
     *
     * @throws \ErrorException
     */
    public function handleError($level, $message, $file = '', $line = 0)
    {
        if (error_reporting() & $level) {
            throw new ErrorException($message, 0, $level, $file, $line);
        }
    }

    /**
     * Handle the PHP shutdown event.
     *
     * @return void
     */
    public function handleShutdown()
    {
        if (!is_null($error = error_get_last()) && $this->isFatal($error['type'])) {
            $this->handleException($this->fatalExceptionFromError($error, 0));
        }
    }

    /**
     * Create a new fatal exception instance from an error array.
     *
     * @param array $error
     * @param int|null $traceOffset
     *
     * @return \Symfony\Component\Debug\Exception\FatalErrorException
     */
    protected function fatalExceptionFromError(array $error, $traceOffset = null)
    {
        return new FatalErrorException(
            $error['message'], $error['type'], 0, $error['file'], $error['line'], $traceOffset
        );
    }

    /**
     * Determine if the error type is fatal.
     *
     * @param int $type
     *
     * @return bool
     */
    protected function isFatal($type)
    {
        return in_array($type, [E_ERROR, E_CORE_ERROR, E_COMPILE_ERROR, E_PARSE]);
    }

    /**
     * Get the Whoops instance.
     *
     * @return \Whoops\Run
     */
    protected function whoops()
    {
        $whoops = new Whoops();

        $whoops->pushHandler(new PrettyPageHandler());

        return $whoops;
    }
}
