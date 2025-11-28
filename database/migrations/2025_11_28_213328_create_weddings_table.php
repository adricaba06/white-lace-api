<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('weddings', function (Blueprint $table) {
            $table->id();
            $table->date('wedding_date')->nullable();
            $table->string('venue_name', 255)->nullable();
            $table->text('venue_address')->nullable();
            $table->decimal('budget', 10, 2)->nullable();
            $table->string('dress_code', 100)->nullable();
            $table->text('dress_code_details')->nullable();
            $table->boolean('are_kids_allowed')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('weddings');
    }
};
