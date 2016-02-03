<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWishlistTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('wishlist', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->dateTime('createdAt');
			$table->dateTime('updatedAt');
			$table->integer('id_audiobook')->nullable()->index('id_audiobook_idx');
			$table->integer('id_user')->nullable()->index('id_user_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('wishlist');
	}

}
