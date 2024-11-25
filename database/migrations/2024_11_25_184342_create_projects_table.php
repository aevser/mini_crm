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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('api_token');
            $table->boolean('enabled');
            $table->unsignedInteger('leads_today');
            $table->unsignedInteger('leads_total');
            $table->timestamps();

            // Indexing
            $table->index([
                'leads_today',
                'leads_total',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
