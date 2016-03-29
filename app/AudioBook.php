<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AudioBook extends Model
{
    use SoftDeletes;

    protected $appends = ['reviews_count', 'ratings_average'];

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
        return $this->hasMany('App\Review', 'audiobook_id');
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

    public function getReviewsCountAttribute()
    {
        return $this->reviews->count();
    }

    public function getRatingsAverageAttribute()
    {
        if ($this->reviews_count > 0) {
            $totalRating = 0;
            foreach ($this->reviews as $r) {
                $totalRating += $r->rating;
            }

            return $totalRating / $this->reviews_count;
        } else {
            return 0;
        }
    }

}