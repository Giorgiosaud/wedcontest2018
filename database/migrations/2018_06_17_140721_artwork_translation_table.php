<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ArtworkTranslationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artwork_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('artwork_id');
            $table->string('title');
            $table->text('description');
            $table->string('locale')->index();
            $table->unique(['artwork_id', 'locale']);
            $table->foreign('artwork_id')->references('id')->on('artworks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('artwork_translations');
    }
}
