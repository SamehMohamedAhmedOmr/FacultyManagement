<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResearchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('researches', function (Blueprint $table) {
            $table->increments('id');
            $table->text('researchName');
            $table->string('magazine');
            $table->date('publishDate');
            $table->string('publishPlace')->nullable();
            $table->double('effectCoefficient',5,3);
            $table->double('bonusValue',6,2);
            $table->integer('participantsBonusValue');
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
        Schema::dropIfExists('researches');
    }
}
