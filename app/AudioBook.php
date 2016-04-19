<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\AudioBook
 *
 * @property integer $id
 * @property string $title
 * @property string $subtitle
 * @property string $author
 * @property string $narrator
 * @property string $isbn
 * @property float $price
 * @property string $about
 * @property string $audio_file_url
 * @property string $audio_preview_file_url
 * @property integer $duration_seconds
 * @property string $cover_picture_url
 * @property string $banner_picture_url
 * @property string $copyright_year
 * @property integer $visibility
 * @property string $released_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property integer $category_id
 * @property integer $publisher_id
 * @property-read \App\Category $category
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\AudioBookChapter[] $audiobookChapter
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Purchase[] $purchase
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Review[] $review
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $wishlist
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Collection[] $collection
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Bundle[] $bundle
 * @property-read mixed $reviews_count
 * @property-read mixed $ratings_average
 * @method static \Illuminate\Database\Query\Builder|\App\AudioBook whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AudioBook whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AudioBook whereSubtitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AudioBook whereAuthor($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AudioBook whereNarrator($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AudioBook whereIsbn($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AudioBook wherePrice($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AudioBook whereAbout($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AudioBook whereAudioFileUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AudioBook whereAudioPreviewFileUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AudioBook whereDurationSeconds($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AudioBook whereCoverPictureUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AudioBook whereBannerPictureUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AudioBook whereCopyrightYear($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AudioBook whereVisibility($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AudioBook whereReleasedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AudioBook whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AudioBook whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AudioBook whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AudioBook whereCategoryId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AudioBook wherePublisherId($value)
 * @mixin \Eloquent
 */
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

    public function audiobookChapter()
    {
        return $this->hasMany('App\AudioBookChapter', 'audiobook_id');
    }

    public function purchase()
    {
        return $this->hasMany('App\Purchase', 'audiobook_id');
    }

    public function review()
    {
        return $this->hasMany('App\Review', 'audiobook_id');
    }

    public function wishlist()
    {
        return $this->belongsToMany('App\User', 'wishlist', 'audiobook_id');
    }

    public function user()
    {
        return $this->belongsToMany('App\User', 'purchase', 'audiobook_id');
    }

    public function collection()
    {
        return $this->belongsToMany('App\Collection');
    }

    public function bundle()
    {
        return $this->belongsToMany('App\Bundle');
    }

    public function getReviewsCountAttribute()
    {
        if ($this->reviews == null) return 0;
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