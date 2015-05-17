<?php

namespace WordPlate\Console\Commands;

/**
 * This is the theme name command.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class ThemeNameCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'theme:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set the application theme name';

    /**
     * Run the command.
     *
     * @return void
     */
    public function handle()
    {

        $this->info('Application theme name set!');
    }
}
