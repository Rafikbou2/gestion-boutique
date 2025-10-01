<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_ventes_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentesTable extends Migration
{
    public function up()
    {
        Schema::create('ventes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('produit_id');
            $table->integer('quantite');
            $table->decimal('montant', 10, 2);
            $table->date('date_vente');
            $table->enum('statut', ['nouvelle', 'en attente', 'en cours', 'livrée'])->default('nouvelle');
            $table->timestamps();
            
            // Si vous avez une relation avec la table des produits
            $table->foreign('produit_id')->references('id')->on('produits')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('ventes');
    }
}
