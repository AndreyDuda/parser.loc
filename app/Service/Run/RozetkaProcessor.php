<?php
/**
 * Created by PhpStorm.
 * User: duda
 * Date: 30.01.19
 * Time: 23:43
 */

namespace App\Service\Run;

use App\Service\Crawler;
use App\Service\RecordManager\Rozetka\RecordManagerRozetka;

class RozetkaProcessor implements ProcessorInterface
{
    private $crawler;
    private $record_manager;
    private $links;

    public function __construct()
    {
        $this->crawler = new Crawler();
        $this->record_manager = new RecordManagerRozetka();
        $this->links   = config('parser.resource.rozetka.categories');
    }

    public function run()
    {
        $content = [];

        foreach ($this->links as $k => $link) {

            $content[$k] = $this->crawler->execute($link);
        }

        $this->record_manager->save($content);

        return true;
    }
}
