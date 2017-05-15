<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDownloadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roem_media_downloads', function (Blueprint $table) {
            $table->increments('id');
            $table->string('downloadable_type')->index();
            $table->integer('downloadable_id')->unsigned()->index();
            $table->string('title');
            $table->string('slug')->index();
            $table->string('icon');
            $table->text('description');
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['downloadable_type', 'downloadable_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('roem_media_downloads');
    }
}
