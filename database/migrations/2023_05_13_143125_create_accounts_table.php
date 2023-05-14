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
            $table->boolean('admin')->default(false);
            $table->string('name', 32);
            $table->string('surname', 32);
            $table->string('username', 64)->unique();
            $table->string('password');
            $table->enum('gender', ['male', 'female', 'unknown'])->default('unknown');
            $table->date('birth');
            $table->string('phone', 32);
            $table->string('email', 256);
            $table->timestamp('last_access')->nullable();
            $table->timestamp('removed_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        // constraints
        // TODO: sistemare il constraint della data di nascita
        // DB::statement('ALTER TABLE accounts ADD CONSTRAINT check_birth CHECK birth <= now()');  // NOT WORKING
        // TODO: aggiungere il seguente constraint: ci può essere solo un account con la colonna `admin` settata a true
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
