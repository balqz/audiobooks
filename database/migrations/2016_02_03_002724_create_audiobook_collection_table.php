<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAudiobookCollectionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('audiobook_collection', function(Blueprint $table)
		{
			$table->integer('id')->primary();
			$table->integer('id_audiobook')->nullable()->index('id_audiobook_idx');
			$table->integer('id_collection')->nullable()->index('id_collection_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('audiobook_collection');
	}

}
