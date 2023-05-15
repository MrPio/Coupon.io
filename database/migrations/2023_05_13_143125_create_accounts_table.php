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
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('name', 32);
            $table->string('surname', 32);
            $table->string('username', 64)->unique();
            $table->string('password');
            $table->enum('gender', ['male', 'female', 'unknown'])->default('unknown');
            $table->date('birth')->nullable();
            $table->string('phone', 32)->nullable();
            $table->string('email', 256)->nullable();
            $table->timestamp('last_access')->nullable();
            $table->timestamp('removed_at')->nullable()->default(null);  // TODO: mi sa che ci conviene toglierla
            $table->rememberToken();
            $table->timestamps();
        });

        // constraints
        // TODO: sistemare il vincolo della data di nascita
        // DB::statement('ALTER TABLE accounts ADD CONSTRAINT check_birth CHECK birth <= now()');  // NOT WORKING
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounts');
    }
};
