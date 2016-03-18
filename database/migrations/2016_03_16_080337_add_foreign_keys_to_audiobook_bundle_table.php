<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAudiobookBundleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('audiobook_bundle', function(Blueprint $table)
		{
			$table->foreign('audiobook_id', 'bundle.id_audiobook')->references('id')->on('audiobook')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('bundle_id', 'bundle.id_bundle')->references('id')->on('bundle')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('audiobook_bundle', function(Blueprint $table)
		{
			$table->dropForeign('bundle.id_audiobook');
			$table->dropForeign('bundle.id_bundle');
		});
	}

}
