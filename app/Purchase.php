<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{

    protected $table = 'purchase';

    protected $fillable = [
        'price', 'audiobook_id', 'user_id'
    ];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function audiobook()
    {
        return $this->belongsTo('App\AudioBook');
    }

}
