<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roem_media_assets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('assetable_type')->index();
            $table->integer('assetable_id')->unsigned()->index();
            $table->string('title');
            $table->string('slug')->unique()->index();
            $table->text('description');
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['assetable_type', 'assetable_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('roem_media_assets');
    }
}
