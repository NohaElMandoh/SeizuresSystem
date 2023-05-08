<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {

            $table->integer("governorate_id")->nullable();
            $table->integer("city_id")->nullable();
            $table->integer("role_id")->nullable();
            $table->string("phone")->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('governorate_id');
            $table->dropColumn('city_id');
            $table->dropColumn('role_id');
            $table->dropColumn('phone');


        });
    }
};
