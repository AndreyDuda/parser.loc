<?php

namespace App\Console\Commands\Parser\Rozetka;

use App\Service\Run\RozetkaProcessor;
use Illuminate\Console\Command;

class RozetkaParserCommand extends Command
{
    protected $signature = 'parse:rozetka';

    protected $description = 'Start parse resource rozetka.com';

    private $rozetka_processor;

    public function __construct(RozetkaProcessor $rozetka_processor)
    {
        parent::__construct();

        $this->rozetka_processor = $rozetka_processor;
    }

    public function handle()
    {

        $this->rozetka_processor->run();

        $this->info('Success!');

        return true;
    }
}
