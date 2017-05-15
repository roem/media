<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMediasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roem_media_medias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mediaable_type')->index();
            $table->integer('mediaable_id')->unsigned()->index();
            $table->string('path');
            $table->string('filename');
            $table->string('extension');
            $table->string('mimeType');
            $table->integer('size')->unsigned()->nullable();
            $table->timestamps();

            $table->index(['mediaable_type', 'mediaable_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('roem_media_medias');
    }
}
