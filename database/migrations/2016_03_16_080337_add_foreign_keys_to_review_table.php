<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToReviewTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('review', function(Blueprint $table)
		{
			$table->foreign('audiobook_id', 'review.id_audiobook')->references('id')->on('audiobook')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('user_id', 'review.id_user')->references('id')->on('user')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('review', function(Blueprint $table)
		{
			$table->dropForeign('review.id_audiobook');
			$table->dropForeign('review.id_user');
		});
	}

}
