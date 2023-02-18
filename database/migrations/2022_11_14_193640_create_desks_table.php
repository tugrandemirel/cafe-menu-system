<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // desk tablosunu oluşturuyoruz
        Schema::create('desks', function (Blueprint $table) {
            // desk tablosunun kolonlarını oluşturuyoruz
            $table->id();
            $table->integer('number');
            $table->integer('capacity');
            $table->integer('status')->default(0)->comment('0: available, 1: occupied');
            $table->integer('user_id')->nullable();
            $table->integer('adicional_id')->nullable();
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
        Schema::dropIfExists('desks');
    }
}
