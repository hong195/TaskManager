<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('source');
            $table->string('extension');
            $table->unsignedBigInteger('size');
            $table->unsignedBigInteger('bu_id')->nullable();
            $table->unsignedBigInteger('block_id')->nullable();
            $table->unsignedBigInteger('cell_id')->nullable();
            $table->unsignedBigInteger('section_id')->nullable();
            $table->unsignedBigInteger('term_id')->nullable();
            $table->timestamps();

            $table->foreign('bu_id')->references('id')->on('units');
            $table->foreign('block_id')->references('id')->on('blocks');
            $table->foreign('cell_id')->references('id')->on('cells');
            $table->foreign('section_id')->references('id')->on('sections');
            $table->foreign('term_id')->references('id')->on('terms');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('files');
    }
}
