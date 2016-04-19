<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAudiobookChapterTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('audiobookChapter', function(Blueprint $table)
		{
			$table->foreign('audiobook_id', 'chapter.id_audiobook')->references('id')->on('audiobook')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('audiobookChapter', function(Blueprint $table)
		{
			$table->dropForeign('chapter.id_audiobook');
		});
	}

}
