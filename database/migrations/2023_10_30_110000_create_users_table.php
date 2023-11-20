<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('country_id')->index()->nullable();
            $table->unsignedBigInteger('range_id')->index()->nullable();
            $table->string('twich_id')->unique();
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->boolean('status')->default(0);
            $table->string('channel')->nullable();
            $table->string('area')->nullable();
            $table->string('phone')->nullable();
            $table->string('time_zone')->nullable();
            $table->integer('hours_buyed')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            $table->foreign('range_id')->references('id')->on('ranges')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
