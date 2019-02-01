<?php

namespace App\Models\Rozetka;

use Illuminate\Database\Eloquent\Model;
use App\Models\Rozetka\RozetkaImage;

class RozetkaProduct extends Model
{
    const TABLE = 'rozetka_product';

    const PROP_ID       = 'id';
    const PROP_CODE     = 'code';
    const PROP_TITLE    = 'title';
    const PROP_TEXT     = 'text';
    const PROP_PRICE    = 'price';


    protected $fillable = [
        self::PROP_TITLE,
        self::PROP_CODE,
        self::PROP_TEXT,
        self::PROP_PRICE,
    ];

    protected $table = self::TABLE;

    public function image()
    {
        return $this->hasMany(RozetkaImage::class);
    }

    public static function getOne($code)
    {
        return static::where(self::PROP_CODE, $code)->first();
    }
}
