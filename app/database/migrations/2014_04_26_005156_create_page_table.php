<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePageTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('page', function($table) {
      $table->increments('id');
      $table->integer('parent_id');
      $table->string('name');
      $table->string('url');
      $table->string('h1');
      $table->integer('template')->default('1');
      $table->tinyInteger('active')->default('0');
      $table->tinyInteger('locked')->default('0');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::drop('page');
  }

}
