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
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->decimal('flat_discount', 6, 2)->nullable();
            $table->decimal('percentage_discount', 6, 2)->nullable();
            $table->integer('amount')->default(1);  // quantità di coupon disponibili
            $table->integer('acquired')->default(0);  // quantità di coupon acquisiti
            $table->date('starting_from');  // la data d'inizio della promozione
            $table->date('ends_on');  // la data di fine della promozione
            $table->timestamp('removed_at')->nullable()->default(null);
            $table->boolean('featured')->default(false);
            $table->timestamps();

            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();  // la categoria a cui appartiene la promozione
            $table->foreignId('staff_id')->nullable()->constrained()->nullOnDelete();  // il membro dello staff che ha creato la promozione
            $table->foreignId('product_id')->nullable()->constrained()->nullOnDelete();  // il prodotto associato alla promozione
            $table->foreignId('company_id')->nullable()->constrained()->nullOnDelete();  // l'azienda a cui è associata la promozione
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promotions');
    }
};
