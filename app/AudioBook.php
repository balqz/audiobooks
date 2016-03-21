<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AudioBook extends Model
{
    use SoftDeletes;

    protected $table = 'audiobook';

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    protected $fillable = [
        'title', 'subtitle', 'author', 'narrator', 'isbn', 'price', 'about', 'audio_file_url',
        'audio_preview_file_url', 'duration_seconds', 'cover_picture_url', 'banner_picture_url',
        'copyright_year', 'visibility', 'released_at', 'category_id', 'publisher_id'
    ];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function chapters()
    {
        return $this->hasMany('App\AudioBookChapter');
    }

    public function purchases()
    {
        return $this->hasMany('App\Purchase');
    }

    public function reviews()
    {
        return $this->hasMany('App\Review');
    }

    public function wishlistUsers()
    {
        return $this->belongsToMany('App\User', 'wishlist');
    }

    public function users()
    {
        return $this->belongsToMany('App\User', 'purchase');
    }

    public function collections()
    {
        return $this->belongsToMany('App\Collection');
    }

    public function bundles()
    {
        return $this->belongsToMany('App\Bundle');
    }

}