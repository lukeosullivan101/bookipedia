<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submissions', function(Blueprint $table)
            {
          $table->increments('id');
          $table -> integer('author_id') -> unsigned() -> default(0);
          $table->foreign('author_id')
              ->references('id')->on('users')
              ->onDelete('cascade');
          $table->text('title');
          $table->text('summary');
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
        // drop submissions table
            Schema::drop('submissions');
    }
}
