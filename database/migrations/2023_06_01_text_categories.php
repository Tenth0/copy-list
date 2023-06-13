<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTextCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('text_categories', function (Blueprint $table) {
            $table->integer('text_id')->index();
            $table->string('category_id_first', 255)->nullable();
            $table->string('category_id_second', 255)->nullable();
            $table->string('category_id_third', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('text_category');
    }
}
