<?php

namespace App\Models\Rozetka;

use Illuminate\Database\Eloquent\Model;

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

    public function product()
    {
        return $this->hasOne(self::class, self::PROP_PRODUCT_ID, RozetkaProduct::PROP_ID);
    }

    public function add(int $product_id, string $url)
    {
        return static::create([
            self::PROP_PRODUCT_ID => $product_id,
            self::PROP_URL        => $url
        ]);
    }

    public function edit(int $product_id, string $url)
    {
        $image = $this->where(self::PROP_PRODUCT_ID, $product_id)->all();
    }
}
