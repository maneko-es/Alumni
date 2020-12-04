<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerkTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perk_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('perk_id')->unsigned();
            $table->string('title');
            $table->text('body');
            $table->string('locale', 2)->index();
            $table->string('slug')->index();

            $table->unique(['perk_id','locale']);
            $table->unique(['slug', 'locale']);
            $table->foreign('perk_id')->references('id')->on('perks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('perk_translations');
    }
}
