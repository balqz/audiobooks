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

}
