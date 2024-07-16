<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manege extends Model
{
    //
    protected $fillable = [
        'user_id',
        'post_id',
        'post',
        'image',
    ];
    public function reports() {
        return $this->hasMany(Report::class);
    }
}
