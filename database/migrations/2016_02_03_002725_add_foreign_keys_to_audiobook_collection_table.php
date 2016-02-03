<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAudiobookCollectionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('audiobook_collection', function(Blueprint $table)
		{
			$table->foreign('id_audiobook', 'collection.id_audiobook')->references('id')->on('audiobook')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('id_collection', 'collection.id_collection')->references('id')->on('collection')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('audiobook_collection', function(Blueprint $table)
		{
			$table->dropForeign('collection.id_audiobook');
			$table->dropForeign('collection.id_collection');
		});
	}

}
