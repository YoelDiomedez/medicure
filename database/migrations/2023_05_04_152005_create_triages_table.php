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
        Schema::create('triages', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('attention_id')->unsigned();
            $table->char('height', 3)->nullable()->comment('### (cm)');
            $table->float('weight', 8, 2)->nullable()->comment('###,## (kg)');
            $table->float('bmi', 8, 2)->nullable()->comment('###,##');
            $table->float('temperature', 8, 2)->nullable()->comment('###,## (°C)');
            $table->char('heart_rate', 3)->nullable()->comment('### (x′)');
            $table->char('respiratory_rate', 2)->nullable()->comment('## (x′)');
            $table->char('blood_pressure', 7)->nullable()->comment('###/### (mmHg)');
            $table->char('oxygen_saturation', 3)->nullable()->comment('### (%)');	
            $table->timestamps();
            $table->foreign('attention_id')->references('id')->on('attentions')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('triages');
    }
};
