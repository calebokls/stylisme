<?php

use App\Models\Marques;
use App\Models\Property;
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
        Schema::create('property_marques',function(Blueprint $table){
            $table->foreignIdFor(Property::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Marques::class)->constrained()->cascadeOnDelete();
            $table->primary(['property_id','marques_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_marques');
    }
};
