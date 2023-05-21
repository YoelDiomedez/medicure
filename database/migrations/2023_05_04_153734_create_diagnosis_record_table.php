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
        Schema::create('diagnosis_record', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('diagnosis_id')->unsigned();
            $table->bigInteger('record_id')->unsigned();
            $table->enum('type', ['P', 'D', 'R'])->comment('P (presuntivo) D (definitivo) R (repetido)');
            $table->timestamps();
            $table->foreign('diagnosis_id')->references('id')->on('diagnoses')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->foreign('record_id')->references('id')->on('records')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diagnosis_record');
    }
};
