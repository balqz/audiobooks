<?php namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Review
 *
 * @property integer $id
 * @property string $content
 * @property float $rating
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property integer $audiobook_id
 * @property integer $user_id
 * @property-read \App\AudioBook $audiobook
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Query\Builder|\App\Review whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Review whereContent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Review whereRating($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Review whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Review whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Review whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Review whereAudiobookId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Review whereUserId($value)
 * @mixin \Eloquent
 */
class Review extends Model
{

    protected $table = 'review';

    protected $fillable = [
        'content', 'rating', 'audiobook_id', 'user_id'
    ];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function audiobook()
    {
        return $this->belongsTo('App\AudioBook');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
