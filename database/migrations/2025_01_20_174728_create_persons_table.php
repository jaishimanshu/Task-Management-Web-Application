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
        Schema::create('persons', function (Blueprint $table) {
                $table->id();  // Auto-incrementing primary key
                $table->string('name');
                $table->string('title');
                $table->text('description');  
                $table->dateTime('due_date');  
                $table->smallInteger('status')->default(0)->comment('1-done, 0-pending'); 
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
        Schema::dropIfExists('persons');
    }
};
