<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model {

	protected $fillable = [];

	protected $dates = ['created_at', 'updated_at', 'deleted_at'];

}
