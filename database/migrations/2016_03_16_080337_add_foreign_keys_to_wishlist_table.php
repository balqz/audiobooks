<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToWishlistTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('wishlist', function(Blueprint $table)
		{
			$table->foreign('user_id', 'wishilist.id_user')->references('id')->on('user')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('audiobook_id', 'wishlist.id_audiobook')->references('id')->on('audiobook')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('wishlist', function(Blueprint $table)
		{
			$table->dropForeign('wishilist.id_user');
			$table->dropForeign('wishlist.id_audiobook');
		});
	}

}
