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
			$table->integer('audiobook_id')->nullable()->index('id_audiobook_idx');
			$table->integer('bundle_id')->nullable()->index('id_bundle_idx');
			$table->timestamps();
			$table->softDeletes();
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
