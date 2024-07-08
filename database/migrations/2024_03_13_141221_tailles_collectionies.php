<?php

use App\Models\Collectiony;
use App\Models\Taille;
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
        Schema::create('tailles_collectionies',function(Blueprint $table){
           $table->foreignIdFor(Taille::class)->constrained()->cascadeOnDelete();
           $table->foreignIdFor(Collectiony::class)->constrained()->cascadeOnDelete();
           $table->primary(['taille_id','collectiony_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tailles_collectionies');
    }
};
