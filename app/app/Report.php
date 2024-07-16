<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    //
    protected $fillable = [
    'user_id',	
    'post_id',	
    'report',
    ];
    public function post()
    {
        return $this->belongsTo(Posts::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
