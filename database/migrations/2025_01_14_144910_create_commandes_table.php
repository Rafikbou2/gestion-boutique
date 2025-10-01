<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommandesTable extends Migration
{
    public function up()
    {
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->string('client_name');
            $table->text('produits');
            $table->decimal('prix_total', 8, 2);
            $table->string('statut');
            $table->timestamps();
        });
        Schema::table('ventes', function (Blueprint $table) {
            $table->unsignedBigInteger('commande_id'); // Ajouter la colonne commande_id
            $table->foreign('commande_id')->references('id')->on('commandes')->onDelete('cascade'); // Définir la clé étrangère
        });
    }

    public function down()
    {
        
        }
    }

