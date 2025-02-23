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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->integer('number_of_people');
            $table->decimal('total_price', 10, 2);
            $table->enum('status', ['confirmé', 'annulé'])->default('confirmé');
            $table->foreignId('client_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
