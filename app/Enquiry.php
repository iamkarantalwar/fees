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
    public function degree()
    {
        return $this->belongsTo(Degree::class);
    }
    public function college()
    {
        return $this->belongsTo(College::class);
    }
    public function duration()
    {
        return $this->belongsTo(Duration::class);
    }
    public function registration()
    {
        return $this->hasOne(Registration::class);
    }
}
