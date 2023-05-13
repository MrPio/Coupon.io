<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->boolean('admin')->default(false);
            $table->string('name', 32);
            $table->string('surname', 32);
            $table->string('username', 64)->unique();
            $table->string('password');
            $table->enum('gender', ['male', 'female', 'unknown'])->default('unknown');
            $table->date('birth');
            $table->string('phone', 15);
            $table->string('email', 256);
            $table->timestamp('last_access')->nullable();
            $table->timestamp('removed_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        // constraints
        // DB::statement('ALTER TABLE accounts ADD CONSTRAINT check_birth');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
