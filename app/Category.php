<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Category
 *
 * @property integer $id
 * @property string $title
 * @property string $subtitle
 * @property string $picture_url
 * @property string $about
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property integer $parent_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\AudioBook[] $audiobook
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereSubtitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Category wherePictureUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereAbout($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereParentId($value)
 * @mixin \Eloquent
 */
class Category extends Model {
	use SoftDeletes;
	protected $table = 'category';

	protected $fillable = [];

	protected $dates = ['created_at', 'updated_at', 'deleted_at'];

	public function audiobook()
	{
		return $this->hasMany('App\AudioBook');
	}
	
	public function category()
	{
		return $this->hasMany('App\Category');
	}
	
	public function child()
    {
        return $this->hasMany('App\Category','parent_id','id');
    }
	
	public function categories()
    {
        return $this->belongsToMany('App\Category', 'category', 'parent_id');
    }

}
