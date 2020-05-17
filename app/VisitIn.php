<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VisitIn extends Model
{
    public $timestamps = false;
    public $table = "VisitIns";
    public $primaryKey="ID";
    protected $fillable = [
        'myCash',
        'date',
        'patient_ID',
        'user_ID',
        'notes',
        'hospital_ID',
        'isExist',
        'Finished',
        'datefinish'
    ];

    protected $hidden=[
        'patient_ID',
        'hospital_ID',
        'user_ID',
    ];
    public function user()
    {
        return $this->belongsTo(User::class,'user_ID','ID');
    }

    public function hospital()
    {
        return $this->belongsTo(Hospital::class,'hospital_ID','ID');
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class,'patient_ID','ID');
    }

    public function visitOut()
    {
        return $this->hasMany(VisitOut::class,'visitIn_ID');
    }

    public function VisitOutDetails()
    {
        return $this->hasMany(VisitOutDetail::class,'visitIn_ID');
    }

    public function Morafeks(){
        return $this->hasMany(Morafek::class,'visitIn_ID','ID');
    }
}
