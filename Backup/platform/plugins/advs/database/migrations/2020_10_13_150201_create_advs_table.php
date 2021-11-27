<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advs', function (Blueprint $table) {
            $table->id();
            $table->string('name', 120);
            $table->tinyInteger('position')->unsigned()->default(0);
            $table->tinyInteger('istop')->unsigned()->default(0);
            $table->date('fromdate')->nullable();
            $table->date('todate')->nullable();
            $table->string('image', 255)->nullable();
            $table->string('link', 255)->nullable();
            $table->integer('user_id')->unsigned()->index()->references('id')->on('users');
            $table->string('status', 60)->default('published');
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
        Schema::dropIfExists('advs');
    }
}