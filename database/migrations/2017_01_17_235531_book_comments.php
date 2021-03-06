<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BookComments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            //id, on_blog, from_user, body, at_time
    Schema::create('book_comments', function(Blueprint $table)
    {
      $table->increments('id');
      $table -> integer('on_book') -> unsigned() -> default(0);
      $table->foreign('on_book')
          ->references('id')->on('books')
          ->onDelete('cascade');
      $table -> integer('from_user') -> unsigned() -> default(0);
      $table->foreign('from_user')
          ->references('id')->on('users')
          ->onDelete('cascade');
      $table->text('body');
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
            // drop book comment table
    Schema::drop('book_comments');
    }
}
