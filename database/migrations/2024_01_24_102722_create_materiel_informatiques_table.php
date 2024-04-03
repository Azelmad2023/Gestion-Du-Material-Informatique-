<?php

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
        Schema::create('materiel_informatiques', function (Blueprint $table) {
            $table->string('Num_Inv')->primary();
            $table->string('type');
            $table->string('marque');
            $table->date('dateDacquisition');
            $table->date('EF');
            $table->string('etat');
            $table->string('codeGresa');
            $table->foreign('codeGresa')->references('id')->on('etablissements');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materiel_informatiques');
    }
};
