<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        Schema::create('genres', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->smallInteger('sort')->default(0)->unsigned();
            $table->string('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('shops', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->smallInteger('sort')->default(0)->unsigned();
            $table->string('description')->nullable();
            $table->string('address')->nullable();
            $table->string('business_hours')->nullable();
            $table->tinyInteger('business_days')->default(pow(2, 7) - 1)->unsigned();

            $table->string('hp')->nullable();
            // 経度
            $table->string('geo_lat')->unique();
            // 緯度
            $table->string('geo_long')->unique();
            $table->timestamps();
            $table->softDeletes();

            // Add Foreign
            $table->integer('owner_id')->unsigned()->nullable();
            $table->foreign('owner_id')
                ->references('id')
                ->on('owners')
                ->onUpdate('cascade')
                ->onDelete('set null');

            // Add Foreign
            $table->integer('genre_id')->unsigned()->nullable();
            $table->foreign('genre_id')
                ->references('id')
                ->on('genres')
                ->onUpdate('cascade')
                ->onDelete('set null');
        });

        Schema::create('images', function (Blueprint $table) {
            $table->increments('id');
            $table->string('path')->nullable();
            $table->string('type')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Add Foreign
            $table->integer('shop_id')->unsigned()->nullable();
            $table->foreign('shop_id')
                ->references('id')
                ->on('shops')
                ->onUpdate('cascade')
                ->onDelete('set null');
        });

        Schema::create('items', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name')->unique();
            $table->smallInteger('point')->default(0)->unsigned();
            $table->string('image_path')->nullable();
            $table->smallInteger('sort')->default(0)->unsigned();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at');
            $table->softDeletes();
        });

        Schema::create('item_shop', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('item_id')->unsigned();
            $table->integer('shop_id')->unsigned();

            // Add Foreign
            $table->foreign('item_id')
                ->references('id')
                ->on('items')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('shop_id')
                ->references('id')
                ->on('shops')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            // $table->primary(['item_id', 'shop_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return  void
     */
    public function down()
    {
        Schema::drop('item_shop');
        Schema::drop('items');
        Schema::drop('images');
        Schema::drop('shops');
    }
}
