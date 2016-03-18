<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model {

	protected $table = 'wishlist';

	protected $fillable = [];

	protected $dates = ['created_at', 'updated_at', 'deleted_at'];

}
