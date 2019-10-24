<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    protected $guarded=[];

    protected $dates = [
        'birth_date',
    ];
    protected $appends = [
        'left_days'
    ];



    public function historiques(){
        return $this->hasMany(App\historiques::class);
    }

    public function scopeBirthday($query, Carbon $date = null)
    {
        if (is_null($date)) {
            $date = Carbon::today();
        }
        return $query
                    ->whereRaw('DATE_FORMAT(birth_date, "%m-%d") >= ?', [Carbon::today()->format('m-d')])
                    ->orderBy('birth_date','asc')
                    ->take(8);
    }

    public function getLeftDaysAttribute()
    {
           return $this->birth_date->diffInDays(Carbon::today());
    }
}
