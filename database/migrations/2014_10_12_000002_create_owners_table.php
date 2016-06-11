<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOwnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('owners', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('password', 60)->nullable();

            $table->tinyInteger('status')->default(0)->unsigned();
            $table->string('confirmation_code');
            $table->boolean('confirmed')->default(config('access.owners.confirm_email') ? false : true);
            $table->rememberToken();

            $table->string('family_name');
            $table->string('given_name');
            $table->string('family_name_yomi')->nullable();
            $table->string('given_name_yomi')->nullable();
            $table->string('phone')->nullable();

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('owners');
    }
}
