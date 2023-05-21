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
        Schema::create('records', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('attention_id')->unsigned();
            $table->text('symptom')->nullable();
            $table->text('history')->nullable();
            $table->text('physiological_background')->nullable();
            $table->text('pathological_background')->nullable();
            $table->text('physical_exam')->nullable();
            $table->text('auxiliary_exams')->nullable();
            $table->text('treatment')->nullable();
            $table->text('instruction')->nullable();
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
        Schema::dropIfExists('records');
    }
};
