<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('password', 60)->nullable();

            $table->string('device_id')->nullable();
            $table->string('device_os')->nullable();
            $table->string('token', 60)->unique();

            $table->tinyInteger('status')->default(0)->unsigned();
            $table->string('confirmation_code');
            $table->boolean('confirmed')->default(config('access.users.confirm_email') ? false : true);
            $table->rememberToken();

            $table->string('family_name');
            $table->string('given_name');
            $table->string('family_name_yomi')->nullable();
            $table->string('given_name_yomi')->nullable();
            $table->string('phone')->nullable();
            $table->tinyInteger('sex')->nullable();
            $table->date('birthday')->nullable();
            $table->string('personal_id')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('street')->nullable();
            $table->string('building')->nullable();

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
        Schema::drop('users');
    }
}
