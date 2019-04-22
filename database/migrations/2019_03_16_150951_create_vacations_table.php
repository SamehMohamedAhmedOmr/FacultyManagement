<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVacationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacations', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('description');
            $table->date('startDate');
            $table->date('endDate');
            $table->integer('decisionNumber')->nullable();
            $table->date('decisionDate')->nullable();
            $table->string('VacationType');
            $table->string('countryName');
            $table->integer('yearNumber');
            $table->unsignedInteger('facultymemberId');
            $table->foreign('facultymemberId')->references('id')->on('faculty_members')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vacations');
    }
}
