<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePurchaseTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('purchase', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->float('price', 10, 0);
			$table->dateTime('createdAt');
			$table->dateTime('updatedAt');
			$table->integer('id_audiobook')->nullable()->index('id_audiobook_idx');
			$table->integer('id_user')->nullable()->index('purchase.id_user_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('purchase');
	}

}
