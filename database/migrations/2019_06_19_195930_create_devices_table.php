<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->increments('id');

            // Device Information
            $table->string('device_uuid',250)->unique()->index('device_uuid'); // Unique device token
            $table->string('access_token', 32)->nullable();
            $table->string('language_code', 10)->nullable(); // Ex: tr_TR, en_US
            $table->string('region_code', 10)->nullable(); // Ex: TR, US
            $table->string('platform', 50)->nullable(); // Ex: ios, android other ex. apple watch, android gear
            $table->string('notification_token', 250)->default(false); // Ex: Onesignal platform player token.
            $table->string('notification_tags', 250)->default(false); // Ex: daily, weekly, monthly, premium

            // App Information
            $table->string('app_version', 50)->nullable(); // Device current app version. Ex: 1.0.1, 1.0.2
            $table->boolean('is_premium')->default(false); // Device premium status.

            // Timestamp
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('devices');
    }
}
