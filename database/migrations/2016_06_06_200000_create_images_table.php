<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roem_media_images', function (Blueprint $table) {
            $table->increments('id');
            $table->string('imageable_type')->index();
            $table->integer('imageable_id')->unsigned()->index();
            $table->string('title');
            $table->string('slug')->index();
            $table->text('description')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['imageable_type', 'imageable_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('roem_media_images');
    }
}
