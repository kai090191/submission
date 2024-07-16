<?php

namespace App;

use Illuminate\Database\Eloquent\Model;



class Posts extends Model
{


    protected $fillable = [
        'user_id',
        'post',
        'image',
        'del_flg',
        
        
    ];
    public function scopeActive($query)
    {
        return $query->where('del_flg', 0);
    }

    public function scopeInactive($query)
    {
        return $query->where('del_flg', 1);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function likes()
    {
        return $this->hasMany(Like::class,'post_id');
    }
    public function reports() {
        return $this->hasMany(Report::class ,'post_id');
    }

}
    
