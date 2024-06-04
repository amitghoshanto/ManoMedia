<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notification_key', function (Blueprint $table) {
            $table->id();
            $table->string('secret_key', 400);
            $table->tinyInteger('missed')->default(0);
            $table->tinyInteger('type')->default(1)->comment('1 = active, 0 = deactivate');
            $table->string('country', 100)->nullable();
            $table->string('timezone', 100)->nullable();
            $table->string('device', 100)->nullable();
            $table->string('platform', 100)->nullable();
            $table->string('browser', 100)->nullable();
            $table->string('language', 100)->nullable();
            $table->timestamps(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notification_key');
    }
};
