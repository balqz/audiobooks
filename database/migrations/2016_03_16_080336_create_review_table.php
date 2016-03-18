<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateReviewTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('review', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('content', 500);
			$table->float('rating', 10, 0)->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->integer('audiobook_id')->nullable()->index('review.id_audiobook_idx');
			$table->integer('user_id')->nullable()->index('review.id_user_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('review');
	}

}
