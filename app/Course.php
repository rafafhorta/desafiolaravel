<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Category;
use App\User;

class Course extends Model
{
    use Notifiable;

    protected $guarded = ['id','created_at', 'updated_at'];

    public function categories(){
        return $this->belongsTo('App\Category');
    }

    public function users(){
        return $this->belongsToMany('App\User', 'course_user', 'course_id', 'user_id');
    }
}
