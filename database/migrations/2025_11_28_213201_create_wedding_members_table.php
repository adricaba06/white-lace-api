<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wedding_members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wedding_id')->constrained('weddings')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->enum('role', ['couple', 'collaborator', 'guest']);
            $table->enum('invitation_status', ['pending', 'sent', 'viewed'])->default('pending');
            $table->enum('rsvp_status', ['pending', 'confirmed', 'declined'])->default('pending');
            $table->integer('number_of_companions')->default(0);
            $table->text('dietary_restrictions')->nullable();
            $table->string('phone', 20)->nullable();
            $table->timestamps();

            $table->unique(['wedding_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wedding_members');
    }
};
