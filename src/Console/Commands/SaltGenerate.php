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
