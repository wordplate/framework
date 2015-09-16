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

use Symfony\Component\Console\Command\Command as SymfonyCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use WordPlate\Console\Application;

/**
 * This is the abstract command class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class Command extends SymfonyCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description;

    /**
     * The input interface implementation.
     *
     * @var \Symfony\Component\Console\Input\InputInterface
     */
    protected $input;
    /**
     * The output interface implementation.
     *
     * @var \Symfony\Component\Console\Output\OutputInterface
     */
    protected $output;

    /**
     * The console application instance.
     *
     * @var \WordPlate\Console\Application
     */
    protected $app;

    /**
     * Create a new console command instance.
     *
     * @param \WordPlate\Console\Application $app
     */
    public function __construct(Application $app)
    {
        parent::__construct($this->name);

        $this->app = $app;

        $this->setDescription($this->description);
    }

    /**
     * Run the console command.
     *
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     *
     * @throws \Exception
     *
     * @return int
     */
    public function run(InputInterface $input, OutputInterface $output)
    {
        $this->input = $input;

        $this->output = $output;

        return parent::run($input, $output);
    }

    /**
     * Execute the console command.
     *
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     *
     * @return mixed
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $method = method_exists($this, 'handle') ? 'handle' : 'fire';

        return call_user_func([$this, $method]);
    }

    /**
     * Write a string as information output.
     *
     * @param string $string
     *
     * @return void
     */
    public function info($string)
    {
        $this->output->writeln("<info>$string</info>");
    }
}
