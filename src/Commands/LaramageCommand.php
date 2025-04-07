<?php

namespace MrBohem\Laramage\Commands;

use Illuminate\Console\Command;

class LaramageCommand extends Command
{
    public $signature = 'laramage';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
