<?php

namespace App\Models\Rozetka;

use Illuminate\Database\Eloquent\Model;

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
        return $this->belongsToMany(static::class, RozetkaImage::TABLE, RozetkaImage::PROP_PRODUCT_ID);
    }

    public static function getOne($code)
    {
        return static::where(self::PROP_CODE, $code)->first();
    }

    public static function add(string $code, string $title, string $text, float $price)
    {
        return static::create([
            self::PROP_CODE  => $code,
            self::PROP_TITLE => $title,
            self::PROP_TEXT  => $text,
            self::PROP_PRICE => $price
        ]);
    }

    public function edit(string $code, string $title, string $text, float $price)
    {
        $product = $this->where(self::PROP_CODE, $code)->first();
        return $product->update([
                self::PROP_CODE  => $code,
                self::PROP_TITLE => $title,
                self::PROP_TEXT  => $text,
                self::PROP_PRICE => $price
        ]);
    }
}
