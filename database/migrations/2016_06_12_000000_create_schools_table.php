<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSchoolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        Schema::create('schools', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('yomi')->unique();
            $table->smallInteger('sort')->default(0)->unsigned();
            $table->string('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table(config('access.users_table_name'), function (Blueprint $table) {
            $table->integer('school_id')->unsigned()->nullable();
            /**
             * Add Foreign/Unique/Index
             */
            $table->foreign('school_id')
                ->references('id')
                ->on('schools')
                ->onUpdate('cascade')
                ->onDelete('set null');
        });

        Schema::create('campuses', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name')->unique();
            $table->smallInteger('sort')->default(0)->unsigned();
            // 経度配列
            $table->string('geo_lat')->unique();
            // 緯度配列
            $table->string('geo_lon')->unique();
            $table->integer('school_id')->unsigned();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at');
            $table->softDeletes();

            // Add Foreign
            $table->foreign('school_id')
                ->references('id')
                ->on('schools')
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
        Schema::table('campuses', function (Blueprint $table) {
            $table->dropForeign('campuses_school_id_foreign');
            $table->dropColumn('school_id');
        });

        Schema::drop('campuses');

        Schema::table(config('access.users_table_name'), function (Blueprint $table) {
            $table->dropForeign(config('access.users_table_name').'_school_id_foreign');
            $table->dropColumn('school_id');
        });

        Schema::drop('schools');
    }
}
