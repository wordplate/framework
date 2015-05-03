<?php

namespace WordPlate\Console\Commands;

class SaltGenerate extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'salt:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate WordPress salt keys.';

    public function handle()
    {
    }
}
