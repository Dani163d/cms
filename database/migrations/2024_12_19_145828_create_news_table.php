<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('welcome_sections', function (Blueprint $table) {
            $table->id();
            $table->string('section_name');
            $table->string('title')->nullable();
            $table->text('content')->nullable();
            $table->text('additional_data')->nullable(); // For storing JSON data if needed
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('welcome_sections');
    }
};