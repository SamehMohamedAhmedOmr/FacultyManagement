<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemberSupervisorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_supervisor', function (Blueprint $table) {
            $table->unsignedInteger('discussionId');
            $table->foreign('discussionId')->references('id')->on('discussions')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedInteger('superVisorID');
            $table->foreign('superVisorID')->references('id')->on('faculty_members')->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['discussionId','superVisorID']);
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
        Schema::dropIfExists('member_supervisor');
    }
}
