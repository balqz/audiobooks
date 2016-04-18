<?php namespace App;

use App\Utils\AuthUtils;
use Illuminate\Database\Eloquent\Model;

class AudioBookChapter extends Model
{

    protected $table = 'audiobookChapter';

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
