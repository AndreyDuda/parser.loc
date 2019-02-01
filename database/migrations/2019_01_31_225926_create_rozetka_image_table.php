<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\Rozetka\RozetkaImage;
use App\Models\Rozetka\RozetkaProduct;

class CreateRozetkaImageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(RozetkaImage::TABLE, function (Blueprint $table) {
            $table->increments(RozetkaImage::PROP_ID);
            $table->integer(RozetkaImage::PROP_PRODUCT_ID)->unsigned();
            $table->text(RozetkaImage::PROP_URL);
            $table->timestamps();

            $table->foreign(RozetkaImage::PROP_PRODUCT_ID)
                ->references(RozetkaProduct::PROP_ID)
                ->on(RozetkaProduct::TABLE);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(RozetkaImage::TABLE);
    }
}
