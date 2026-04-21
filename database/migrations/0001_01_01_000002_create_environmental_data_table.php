// database/migrations/2024_01_01_000002_create_environmental_data_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('environmental_data', function (Blueprint $table) {
            $table->id();
            $table->string('department');
            $table->string('municipality');
            $table->decimal('temperature', 5, 2);
            $table->integer('humidity');
            $table->string('air_quality');
            $table->decimal('co2_levels', 8, 2);
            $table->text('recommendations');
            $table->date('record_date');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('environmental_data');
    }
};