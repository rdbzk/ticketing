<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('flight_reservations', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('flight_id');
            $table->string('passenger_passport_id', 9);
            $table->string('seat', 3);
            $table->timestamps();

            // The UNIQUE constraints are also used as indexes when performing queries
            $table->unique(['flight_id', 'passenger_passport_id']);
            $table->unique(['flight_id', 'seat']);
            $table->foreign('flight_id')->references('id')->on('flights');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('flight_reservations');
    }
};
