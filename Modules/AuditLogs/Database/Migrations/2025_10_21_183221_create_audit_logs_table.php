<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('action'); // create, update, delete
            $table->string('entity'); // e.g., 'task'
            $table->unsignedBigInteger('entity_id'); // task_id
            $table->json('changes')->nullable();
            $table->timestamps();

            // Add indexes
            $table->index('user_id');   // Index for foreign key
            $table->index('action');     // Index for action
            $table->index('entity');     // Index for entity
            $table->index('entity_id');     // Index for entity_id

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('audit_logs');
    }
};
