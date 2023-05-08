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
        Schema::create('seizures_unites', function (Blueprint $table) {
            $table->id();

            $table->integer("seizures_id");
            $table->string("unit_name");
            $table->float("quantity"); 
            $table->float("weight");
            $table->string("unit_type");

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
        Schema::dropIfExists('seizures_unites');
    }
};
