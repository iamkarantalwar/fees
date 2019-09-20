<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    public function contexts()
    {
    	return $this->belongsToMany('App\Context','context_registration','registration_id','context_id');
    }
    public function courses()
    {
    	return $this->belongsToMany('App\Course','course_registration','registration_id','course_id');
    }

    public function fees()
    {
        return $this->hasMany(Fee::class);
    }
    public function degree()
    {
        return $this->belongsTo(Degree::class);
    }
    public function college()
    {
        return $this->belongsTo(College::class);
    }
   
    
}
