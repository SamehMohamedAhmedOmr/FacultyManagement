<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\facultyMembers;


class vacation extends Model
{
    protected $table = 'vacations';

    protected $fillable = [
        'description','id','startDate','endDate',
        'decisionNumber','decisionDate','VacationType',
        'countryName','yearNumber','facultymemberId'];

    // relationShips
    public function facultyMember()
    {
        return $this->belongsTo('App\facultyMembers', 'facultymemberId', 'id');
    }
}
