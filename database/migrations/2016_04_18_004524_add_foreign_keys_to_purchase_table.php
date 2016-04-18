<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPurchaseTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('purchase', function(Blueprint $table)
		{
			$table->foreign('audiobook_id', 'purchase.id_audiobook')->references('id')->on('audiobook')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('audiobookChapter_id', 'purchase.id_audiobookChapter')->references('id')->on('audiobookChapter')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('user_id', 'purchase.id_user')->references('id')->on('user')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('purchase', function(Blueprint $table)
		{
			$table->dropForeign('purchase.id_audiobook');
			$table->dropForeign('purchase.id_audiobookChapter');
			$table->dropForeign('purchase.id_user');
		});
	}

}
