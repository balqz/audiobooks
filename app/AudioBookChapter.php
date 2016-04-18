<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class AudioBookChapter extends Model
{

    protected $table = 'audiobookChapter';

    protected $fillable = [];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

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
        return $this->belongsToMany('App\User', 'purchase', 'audiobookChapter_id');
    }

}
