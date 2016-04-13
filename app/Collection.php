<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model {

	protected $table = 'collection';

	protected $fillable = [];

	protected $dates = ['created_at', 'updated_at', 'deleted_at'];

	public function audiobook()
	{
		return $this->belongsToMany('App\AudioBook', 'audiobook_collection', 'collection_id', 'audiobook_id');
	}

}
