<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Bundle extends Model {

	protected $table = 'audiobook_bundle';

	protected $fillable = [];

	protected $dates = ['created_at', 'updated_at', 'deleted_at'];

}
