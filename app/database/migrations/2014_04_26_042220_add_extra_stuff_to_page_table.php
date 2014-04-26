<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddExtraStuffToPageTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('page', function($table)
		{
			$table->string('title');
			$table->integer('sort_order');
			$table->text('keywords');
			$table->tinyInteger('hidden');
			$table->text('description');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('page', function($table)
		{
			$table->dropColumn('title');
			$table->dropColumn('sort_order');
			$table->dropColumn('keywords');
			$table->dropColumn('hidden');
			$table->dropColumn('description');
		});
	}

}
