<?php

namespace App;

use App\facultyMembers;


use Illuminate\Database\Eloquent\Model;

class discussion extends Model
{
    protected $table = 'discussions';

    protected $fillable = [
        'discussionName','id','department','discussionDate','facultymemberId'];

    // relationShips

    public function facultyMember()
    {
        return $this->belongsTo('App\facultyMembers', 'facultymemberId', 'id');
    }

    public function supervised()
    {
        return $this->belongsToMany('App\facultyMembers', 'member_supervisor', 'discussionId', 'superVisorID');
    }
}
