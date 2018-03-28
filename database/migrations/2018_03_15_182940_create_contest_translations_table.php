<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContestTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contest_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('contest_id');

            $table->string('topic');
            $table->text('seo_message')->nullable();
            $table->text('description')->nullable();
            

            $table->string('locale')->index();
            $table->unique(['contest_id', 'locale']);
            $table->foreign('contest_id')->references('id')->on('contests')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contest_translations');
    }
}
