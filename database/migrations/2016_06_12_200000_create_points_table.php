<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('item_id')->unsigned()->nullable();
            $table->tinyInteger('amount')->default(1);
            $table->timestamps();
            $table->softDeletes();

            // Add Foreign
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('set null');

            // Add Foreign
            $table->foreign('item_id')
                ->references('id')
                ->on('items')
                ->onUpdate('cascade')
                ->onDelete('set null');
        });

        Schema::create('bonus_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('bonuses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('bonus_type_id')->unsigned();
            $table->string('code')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Add Foreign
            $table->foreign('bonus_type_id')
                ->references('id')
                ->on('bonus_types')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            // Add Foreign
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::create('rabbit_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('rabbits', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('rabbit_type_id')->unsigned();
            $table->smallInteger('device_interval')->unsigned()->nullable();
            $table->timestamp('device_time');
            $table->timestamps();
            $table->softDeletes();

            // Add Foreign
            $table->foreign('rabbit_type_id')
                ->references('id')
                ->on('rabbit_types')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            // Add Foreign
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::create('points', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->smallInteger('point');
            $table->integer('user_id')->unsigned()->nullable();
            $table->string('history_type');
            $table->integer('rabbit_id')->unsigned()->nullable();
            $table->integer('bonus_id')->unsigned()->nullable();
            $table->integer('order_id')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Add Foreign
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('set null');

            // Add Foreign
            $table->foreign('rabbit_id')
                ->references('id')
                ->on('rabbits')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            // Add Foreign
            $table->foreign('bonus_id')
                ->references('id')
                ->on('bonuses')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            // Add Foreign
            $table->foreign('order_id')
                ->references('id')
                ->on('orders')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return  void
     */
    public function down()
    {
        Schema::drop('points');
        Schema::drop('rabbits');
        Schema::drop('rabbit_types');
        Schema::drop('bonuses');
        Schema::drop('bonus_types');
        Schema::drop('orders');
    }
}
