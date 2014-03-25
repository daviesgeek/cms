<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('menu', function($table) {
			$table->increments('id');
			$table->integer('parentID');
			$table->string('name');
			$table->string('url');
			$table->string('controller');
			$table->string('h1');
			$table->tinyInteger('status')->default('0');
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
		Schema::drop('menu');
	}

}
