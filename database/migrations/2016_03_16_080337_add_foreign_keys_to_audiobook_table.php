<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAudiobookTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('audiobook', function(Blueprint $table)
		{
			$table->foreign('category_id', 'audiobook.id_category')->references('id')->on('category')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('publisher_id', 'audiobook.id_publisher')->references('id')->on('admin')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('audiobook', function(Blueprint $table)
		{
			$table->dropForeign('audiobook.id_category');
			$table->dropForeign('audiobook.id_publisher');
		});
	}

}
