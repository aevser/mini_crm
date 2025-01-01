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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Project\Project::class, 'project_id')
                ->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('class_id');
            $table->string('owner')->nullable();
            $table->string('company')->nullable();
            $table->string('status')->nullable();
            $table->string('name')->nullable();
            $table->string('surname')->nullable();
            $table->string('patronymic')->nullable();
            $table->string('full_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('entries')->nullable();
            $table->string('email')->nullable();
            $table->string('cost')->nullable();
            $table->text('comment')->nullable();
            $table->string('city')->nullable();
            $table->string('region')->nullable();
            $table->string('manual_region')->nullable();
            $table->string('manual_city')->nullable();
            $table->string('host')->nullable();
            $table->string('ip')->nullable();
            $table->string('source')->nullable();
            $table->string('url_query_string')->nullable();
            $table->json('utm')->nullable();
            $table->dateTime('nextcall_date')->nullable();
            $table->timestamps();

            // Indexing
            $table->index('class_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
