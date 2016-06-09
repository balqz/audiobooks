<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Collection extends Model {
	use SoftDeletes;
	protected $table = 'collection';

	protected $fillable = [];

	protected $dates = ['created_at', 'updated_at', 'deleted_at'];

	public function audiobook()
	{
		return $this->belongsToMany('App\AudioBook', 'audiobook_collection', 'collection_id', 'audiobook_id');
	}

}
