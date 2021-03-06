<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Books extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    // blog table
    Schema::create('books', function(Blueprint $table)
        {
          $table->increments('id');
          $table -> integer('author_id') -> unsigned() -> default(0);
          $table->foreign('author_id')
              ->references('id')->on('users')
              ->onDelete('cascade');
          $table->string('title')->unique();
          $table->text('body');
          $table->string('slug')->unique();
          $table->boolean('active');
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
            // drop book summaries table
    Schema::drop('books');
    }
}
