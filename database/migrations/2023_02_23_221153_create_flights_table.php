<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->time('time_duration');
            $table->time('hour_output');
            $table->time('arrival_time');
            $table->double('old_price', 10,2);
            $table->double('price', 10,2);
            $table->integer('total_plots');
            $table->boolean('is_promotion')->default(false);
            $table->string('image',200)->nullable();
            $table->integer('qtd_stops')->default(0);
            $table->text('description')->nullable();

            $table->bigInteger('plane_id')->unsigned();
            $table->bigInteger('airport_origin_id')->unsigned();
            $table->bigInteger('airport_destination_id')->unsigned();

            $table->foreign('plane_id')->references('id')->on('planes')->onDelete('cascade');
            $table->foreign('airport_origin_id')->references('id')->on('airports')->onDelete('cascade');
            $table->foreign('airport_destination_id')->references('id')->on('airports')->onDelete('cascade');
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
        Schema::dropIfExists('flights');
    }
}
