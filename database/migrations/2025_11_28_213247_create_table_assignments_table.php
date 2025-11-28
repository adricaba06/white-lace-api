<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('table_assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wedding_member_id')->constrained('wedding_members')->cascadeOnDelete();
            $table->foreignId('wedding_table_id')->constrained('wedding_tables')->cascadeOnDelete();
            $table->timestamps();

            $table->unique('wedding_member_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('table_assignments');
    }
};
