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
        Schema::create('surgeries', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('patient_id')->unsigned();
            $table->bigInteger('pre_diagnosis_id')->unsigned();
            $table->bigInteger('post_diagnosis_id')->unsigned();
            $table->date('date');	
            $table->time('start_time');	
            $table->time('end_time');	
            $table->char('bed_num', 3);
            $table->string('anesthesia_type');
            $table->text('procedure_findings');
            $table->float('oxygen_use', 8, 2)->comment('###,## (L)');
            $table->text('equipment');
            $table->text('supplies');
            $table->text('observations');
            $table->decimal('amount', 8, 2);
            $table->timestamps();
            $table->foreign('patient_id')->references('id')->on('patients')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->foreign('pre_diagnosis_id')->references('id')->on('diagnoses')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');  
            $table->foreign('post_diagnosis_id')->references('id')->on('diagnoses')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surgeries');
    }
};
