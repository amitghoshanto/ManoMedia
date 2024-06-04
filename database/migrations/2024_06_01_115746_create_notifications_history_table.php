<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('fcm_history', function (Blueprint $table) {
            $table->id();
            $table->text('notification_key');
            $table->text('title')->nullable();
            $table->text('icon')->nullable();
            $table->text('image')->nullable();
            $table->text('body')->nullable();
            $table->text('short_url')->nullable();
            $table->text('full_url')->nullable();
            $table->integer('click_count')->default(0);
            $table->integer('status')->default(0);
            $table->timestamps(); // This will create `created_at` and `updated_at` columns
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications_history');
    }
};
