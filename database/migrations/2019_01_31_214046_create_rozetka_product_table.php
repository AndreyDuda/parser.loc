<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\Rozetka\RozetkaProduct;
use App\Models\Rozetka\RozetkaImage;

class CreateRozetkaProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(RozetkaProduct::TABLE, function (Blueprint $table) {
            $table->increments(RozetkaProduct::PROP_ID)
                ->references(RozetkaImage::PROP_PRODUCT_ID)
                ->on(RozetkaImage::TABLE)
                ->delete('CASCADE');
            $table->string(RozetkaProduct::PROP_CODE,255)->index();
            $table->string(RozetkaProduct::PROP_TITLE, 255);
            $table->text(RozetkaProduct::PROP_TEXT);
            $table->string(RozetkaProduct::PROP_PRICE, 10);
            $table->timestamps();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(RozetkaProduct::TABLE);
    }
}
