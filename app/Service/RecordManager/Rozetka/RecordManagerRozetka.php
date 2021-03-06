<?php
/**
 * Created by PhpStorm.
 * User: duda
 * Date: 01.02.19
 * Time: 3:23
 */

namespace App\Service\RecordManager\Rozetka;

use App\Models\Rozetka\RozetkaImage;
use App\Models\Rozetka\RozetkaProduct;
use App\Service\IRecordManager;
use App\Service\Parser\Rozetka\ProductParserService;

class RecordManagerRozetka implements IRecordManager
{

    private $count_update;

    public function __construct()
    {
        $this->count_update = (integer)config('parser.resource.rozetka.settings.update_content');
    }

    public function save($data)
    {

        foreach ($data as $items) {

            foreach ($items[ProductParserService::NAME] as $item) {
                foreach ($item as $k => $content) {

                    if ($product = RozetkaProduct::getOne($content['code'])) {

                        if ($this->count_update < $k && $this->count_update != 0) {
                            continue;
                        }
                        /** @var RozetkaProduct $product */
                        $product->update([
                            RozetkaProduct::PROP_CODE  => $content['code'],
                            RozetkaProduct::PROP_TITLE => $content['title'],
                            RozetkaProduct::PROP_PRICE => $content['price'],
                            RozetkaProduct::PROP_TEXT  => $content['text']
                        ]);

                        if ($product->image()) {
                            $product->image()->delete();
                        }

                        foreach ($content['image'] as $image) {
                            RozetkaImage::create([
                                RozetkaImage::PROP_PRODUCT_ID => $product->id,
                                RozetkaImage::PROP_URL        => $image
                            ]);
                        }

                    } else {

                        $product = RozetkaProduct::create([
                            RozetkaProduct::PROP_CODE => $content['code'],
                            RozetkaProduct::PROP_TITLE => $content['title'],
                            RozetkaProduct::PROP_TEXT => $content['text'],
                            RozetkaProduct::PROP_PRICE => $content['price']
                        ]);

                        foreach ($content['image'] as $image) {
                            RozetkaImage::create([
                                RozetkaImage::PROP_PRODUCT_ID => $product->id,
                                RozetkaImage::PROP_URL        => $image
                            ]);
                        }
                    }
                }
            }
        }
    }
}
