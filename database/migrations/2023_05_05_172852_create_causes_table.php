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
        Schema::create('causes', function (Blueprint $table) {
            $table->id();

            $table->string("bailiff_number");//رقم المحضر
            $table->string("case_book_number");//رقم دفتر الضبط
            $table->string("case_book_place");//مكان الضبط
            $table->integer("case_type_id");//نوع القضية
            $table->integer("violation_type_id");//نوع المخالفة
            $table->integer("goods_type_id");//نوع البضاعة
            $table->integer("merchant_id");
            $table->string("action_token");//رقم المحضر

            $table->text("notes")->nullable();

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
        Schema::dropIfExists('causes');
    }
};
