<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subbuckets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('tipe');
            $table->string('size');
            $table->string('class');
            $table->boolean('isFolder');
            $table->integer('user_id');
            $table->integer('bucket_id');
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
        Schema::dropIfExists('subbuckets');
    }
};
