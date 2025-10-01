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
   // Dans la méthode up()
public function up()
{
    Schema::table('ventes', function (Blueprint $table) {
        $table->dropColumn('commande_id');
    });
}

// Dans la méthode down()
public function down()
{
    Schema::table('ventes', function (Blueprint $table) {
        $table->unsignedBigInteger('commande_id')->nullable(); // ou mettez-le comme non nullable selon vos besoins
    });
}

};
