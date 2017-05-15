<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDownloadLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roem_media_download_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('download_id')->unsigned()->index();
            $table->timestamps();
        });

        DB::statement('ALTER TABLE `roem_media_download_logs` ADD `ip_address` VARBINARY(16) AFTER `download_id`');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('ALTER TABLE `roem_media_download_logs` DROP COLUMN `ip_address`');

        Schema::drop('roem_media_download_logs');
    }
}
