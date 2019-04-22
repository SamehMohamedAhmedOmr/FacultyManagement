<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\facultyMembers;


class research extends Model
{
    protected $table = 'researches';

    protected $fillable = [
        'researchName','id','magazine','publishDate',
        'publishPlace','effectCoefficient','bonusValue',
        'participantsBonusValue','facultymemberId'];

    // relationShips
    public function facultyMember()
    {
        return $this->belongsTo('App\facultyMembers', 'facultymemberId', 'id');
    }
}
