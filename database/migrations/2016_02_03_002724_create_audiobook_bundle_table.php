<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAudiobookBundleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('audiobook_bundle', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('id_audiobook')->nullable()->index('id_audiobook_idx');
			$table->integer('id_bundle')->nullable()->index('id_bundle_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('audiobook_bundle');
	}

}
