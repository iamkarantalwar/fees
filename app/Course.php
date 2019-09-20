<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $tbale = "courses";

    public function contexts()
    {
        return $this->belongsToMany('App\Context','context_course','course_id','context_id');
    }

    public function duration()
    {
        return $this->belongsTo(Duration::class);
    }

    public function registrations()
    {
        return $this->belongsToMany(Registration::class);
    }
    public function enquiries()
    {
        return $this->belongsToMany(Enquiry::class);
    }
}
