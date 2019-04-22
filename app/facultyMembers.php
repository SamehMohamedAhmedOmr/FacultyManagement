<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\research;
//use App\vacation;
use App\discussion;

class facultyMembers extends Model
{
    protected $table = 'faculty_members';

    protected $fillable = ['name','id','job'];

    // relationShips

    public function research()
    {
        return $this->hasMany('App\research', 'facultymemberId', 'id');
    }

    public function vacation()
    {
        return $this->hasMany('App\vacation', 'facultymemberId', 'id');
    }

    public function discussion()
    {
        return $this->hasMany('App\discussion', 'facultymemberId', 'id');
    }

    public function supervisor()
    {
        return $this->belongsToMany('App\discussion', 'member_supervisor', 'superVisorID', 'discussionId');
    }

}
