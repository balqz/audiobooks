<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {

	protected $table = 'category';

	protected $fillable = [];

	protected $dates = ['created_at', 'updated_at', 'deleted_at'];

	public function audiobooks()
	{
		return $this->hasMany('App\AudioBook');
	}

}
