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
        if (!Schema::hasTable('doctors')) {
            Schema::create('doctors', function (Blueprint $table) {
                $table->id();
                $table->foreignId('center_id')->nullable()->constrained('centers')->nullOnDelete();
                $table->string('name');
                $table->string('title')->nullable(); // BS.CK1, BS.CK2, ThS.BS, CN, YS, ĐD...
                $table->string('role')->nullable(); // Bác sĩ chuyên môn, Điều dưỡng...
                $table->string('avatar')->nullable();
                $table->string('phone')->nullable();
                $table->string('email')->nullable();
                $table->text('bio')->nullable();
                $table->integer('sort_order')->default(0);
                $table->boolean('is_active')->default(true);
                $table->timestamps();

                $table->index(['center_id', 'is_active', 'sort_order']);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
