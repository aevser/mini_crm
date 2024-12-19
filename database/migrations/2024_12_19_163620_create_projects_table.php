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
            $table->foreignIdFor(\App\Models\User::class, 'user_id')
                ->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('api_token');
            $table->boolean('timezone')->default(0);
            $table->string('color')->nullable();
            $table->boolean('enabled')->default(1);
            $table->unsignedInteger('lead_validation_days')->default(0);
            $table->boolean('detect_region')->default(0);
            $table->boolean('calltracking')->default(0);
            $table->unsignedInteger('leads_today')->default(0);
            $table->unsignedInteger('leads_total')->default(0);
            $table->timestamps();

            // Indexing
            $table->index(['leads_today', 'leads_total']);
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
