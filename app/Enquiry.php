<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Calling;

class Enquiry extends Model
{
	protected $table="enquiries";
    public function courses()
    {
        return $this->belongsToMany('App\Course','course_enquiry','enquiry_id','course_id');
    }
    public function callings()
    {
        return $this->hasMany(Calling::class);
    }
}
