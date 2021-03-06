<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Category extends Model
{
    use Notifiable;

    protected $guarded = ['id','created_at', 'updated_at'];

    public function courses(){
        return $this->hasMany('App\Course');
    }

}
