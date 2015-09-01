<?php

/*
 * This file is part of WordPlate.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WordPlate\Console\Commands;

/**
 * This is the salts generate command.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
final class SaltsGenerate extends AbstractCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'salts:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate WordPress security salt keys';

    /**
     * Environment file name.
     *
     * @var string
     */
    protected $file = '.env';

    /**
     * The base salt string.
     *
     * @var string
     */
    protected $baseSalt = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-_ []{}<>~`+=,.;:/?|';

    /**
     * Salt keys to generate.
     *
     * @var array
     */
    protected $keys = [
        'AUTH_KEY',
        'SECURE_AUTH_KEY',
        'LOGGED_IN_KEY',
        'NONCE_KEY',
        'AUTH_SALT',
        'SECURE_AUTH_SALT',
        'LOGGED_IN_SALT',
        'NONCE_SALT',
    ];

    /**
     * Run the command.
     *
     * @return void
     */
    public function handle()
    {
        if (!file_exists($this->getFilePath())) {
            $this->createFile();
        }

        $salts = $this->generate();

        $this->save($salts);
    }

    /**
     * Save the new salt keys to the env file.
     *
     * @param $salts
     *
     * @return void
     */
    protected function save($salts)
    {
        $file = $this->getFilePath();

        $content = file_get_contents($this->getFilePath());

        if (preg_match('/AUTH_KEY/', $content)) {
            $content = $this->replace($content, $salts);
        } else {
            $content = $this->append($content, $salts);
        }

        file_put_contents($file, $content);

        $this->info('WordPress security salts set successfully.');
    }

    /**
     * Replace salt keys.
     *
     * @param string $content
     * @param array $salts
     *
     * @return mixed
     */
    protected function replace($content, array $salts)
    {
        foreach ($salts as $key => $value) {
            $content = preg_replace('/'.$key.'.+/', $value, $content);
        }

        return $content;
    }

    /**
     * Append new salt keys.
     *
     * @param string $content
     * @param array $salts
     *
     * @return mixed
     */
    protected function append($content, array $salts)
    {
        $content .= "\n";

        foreach ($salts as $key => $value) {
            $content .= $value."\n";
        }

        return $content;
    }

    /**
     * Create environment file.
     *
     * @return void
     */
    protected function createFile()
    {
        if (!copy('.env.example', $this->getFilePath())) {
            $this->error('Unable to locate .env.example file.');
            exit;
        }
    }

    /**
     * Generate the salt strings.
     *
     * @return string
     */
    protected function generate()
    {
        $salts = [];

        foreach ($this->keys as $key) {
            $salts[$key] = sprintf('%s="%s"', $key, $this->getRandomSalt());
        }

        return $salts;
    }

    /**
     * Generate random salt string.
     *
     * @param int $length
     *
     * @return string
     */
    protected function getRandomSalt($length = 64)
    {
        $salt = '';

        for ($i = 0; $i < $length; $i++) {
            $salt .= substr($this->baseSalt, rand(0, strlen($this->baseSalt) - 1), 1);
        }

        return $salt;
    }

    /**
     * Get the environment file path.
     *
     * @return string
     */
    protected function getFilePath()
    {
        return $this->app->basePath.'/'.$this->file;
    }
}
