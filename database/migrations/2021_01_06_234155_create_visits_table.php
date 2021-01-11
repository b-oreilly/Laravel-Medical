<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Visit;
use App\Models\Role;

class CreateVisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('notes', 255);
            $table->integer('duration');
            $table->integer('cost');
            $table->date('date', 0)->nullable();
            $table->time('time', 0)->nullable();
            $table->boolean('cancelled')->default(false);
            $table->timestamps();

            $table->bigInteger('doctor_id')->unsigned();
            $table->bigInteger('patient_id')->unsigned();

            $table->foreign('doctor_id')->references('id')->on('doctors');
            $table->foreign('patient_id')->references('id')->on('patients');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visits');
    }
}
