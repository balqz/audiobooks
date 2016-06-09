<?php namespace App;

use App\Utils\AuthUtils;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * App\AudioBookChapter
 *
 * @property integer $id
 * @property string $title
 * @property string $subtitle
 * @property float $price
 * @property string $about
 * @property string $cover_picture_url
 * @property string $audio_file_url
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property integer $audiobook_id
 * @property-read \App\AudioBook $audiobook
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Purchase[] $purchase
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $user
 * @method static \Illuminate\Database\Query\Builder|\App\AudioBookChapter whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AudioBookChapter whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AudioBookChapter whereSubtitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AudioBookChapter wherePrice($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AudioBookChapter whereAbout($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AudioBookChapter whereCoverPictureUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AudioBookChapter whereAudioFileUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AudioBookChapter whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AudioBookChapter whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AudioBookChapter whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AudioBookChapter whereAudiobookId($value)
 * @mixin \Eloquent
 * @property integer $duration_seconds
 * @method static \Illuminate\Database\Query\Builder|\App\AudioBookChapter whereDurationSeconds($value)
 */
class AudioBookChapter extends Model
{
	use SoftDeletes;
    protected $table = 'audiobook_chapter';

    protected $fillable = [];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function setAttributeVisibility()
    {
        $user = AuthUtils::authenticate();
        if ($user == NULL || $this->user()->find($user->id) == NULL) {
            $this->setHidden(['audio_file_url']);
        } else {
            $this->setHidden([]);
        }
    }

    public function audiobook()
    {
        return $this->belongsTo('App\AudioBook');
    }

    public function purchase()
    {
        return $this->hasMany('App\Purchase', 'audiobookChapter_id');
    }

    public function user()
    {
        return $this->belongsToMany('App\User', 'purchase', 'audiobookChapter_id', 'user_id');
    }

    public function toJson($options = 0){
        $this->setAttributeVisibility();
        return parent::toJson();
    }

    public function toArray(){
        $this->setAttributeVisibility();
        return parent::toArray();
    }

}
