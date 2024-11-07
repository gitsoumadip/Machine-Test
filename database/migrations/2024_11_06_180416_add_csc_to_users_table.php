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
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('country_id')->nullable()->constrained()->references('id')->on('countries')->comment('for master country');
            $table->foreignId('state_id')->nullable()->constrained()->references('id')->on('states')->comment('for master state');
            $table->foreignId('city_id')->nullable()->constrained()->references('id')->on('cities')->comment('for master city');
            $table->foreignId('parent_id')->nullable()->constrained()->references('id')->on('users')->comment('for master users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        
    }
};
