<?php namespace App;

use Illuminate\Database\Eloquent\Model;

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
