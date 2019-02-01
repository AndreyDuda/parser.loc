<?php

namespace App\Models\Rozetka;

use Illuminate\Database\Eloquent\Model;
use App\Models\Rozetka\RozetkaProduct;

class RozetkaImage extends Model
{
    const TABLE = 'rozetka_image';

    const PROP_ID         = 'id';
    const PROP_PRODUCT_ID = 'rozetka_product_id';
    const PROP_URL        = 'url';

    protected $fillable = [
        self::PROP_URL,
        self::PROP_PRODUCT_ID
        ];

    protected $table = self::TABLE;

    public static function getAll($product_id)
    {
        return static::where(self::PROP_PRODUCT_ID, $product_id);
    }
}
