<?php namespace App;

use Illuminate\Database\Eloquent\Model;

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

	protected $table = 'category';

	protected $fillable = [];

	protected $dates = ['created_at', 'updated_at', 'deleted_at'];

	public function audiobook()
	{
		return $this->hasMany('App\AudioBook');
	}

}
