<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produits', function (Blueprint $table) {
            $table->id(); // Colonne ID auto-incrémentée
            $table->string('nom'); // Nom du produit
            $table->decimal('prix', 8, 2); // Prix avec 2 décimales
            $table->integer('quantite'); // Quantité en stock
            $table->text('description')->nullable(); // Description optionnelle
            $table->timestamps(); // Colonnes created_at et updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produits');
    }
}

