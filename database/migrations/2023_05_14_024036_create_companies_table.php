<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name', 64)->unique();
            $table->string('place', 64)->nullable();
            $table->string('logo', 64)->nullable();
            $table->string('url', 1024)->nullable();
            $table->string('type', 9)->nullable();
            $table->string('color', 7)->nullable();
            $table->string('description', 1024)->nullable();
            $table->boolean('featured')->default(true);
            $table->timestamp('removed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
};
