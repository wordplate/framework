<?php

namespace WordPlate\Console\Commands;

class ClearCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove application files for development';

    /**
     * Files to remove.
     *
     * @var array
     */
    protected $files = [
        '.styleci.yml',
        'CHANGELOG.md',
        'CONTRIBUTING.md',
        'LICENSE'
    ];

    /**
     * Run the command.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->files as $file) {
            @unlink($this->app->basePath.'/'.$file);
        }

        $this->info('Files removed successfully.');
    }
}
