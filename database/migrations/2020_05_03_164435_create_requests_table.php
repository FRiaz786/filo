<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->string('reason', 300);
            $table->bigInteger('user')->unsigned();
            $table->bigInteger('post')->unsigned();
            $table->enum('status', ['Pending', 'Approved', 'Revoked'])->default('Pending');
            $table->foreign('user')->references('id')->on('users');
            $table->foreign('post')->references('id')->on('posts');
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
        Schema::dropIfExists('requests');
    }
}
