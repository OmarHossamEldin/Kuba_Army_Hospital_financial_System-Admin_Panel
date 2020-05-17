<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    public $timestamps = false;
    public $primaryKey = 'ID';

    protected $fillable = [
        'name','code', 'FRank_ID','Rank_ID'
    ];
    protected $hidden=[
        'FRank_ID',
        'Rank_ID',
    ];
    public function rank()
    {
        return $this->belongsTo(Rank::class,'Rank_ID');
    }

    public function frank()
    {
        return $this->belongsTo(FRank::class,'FRank_ID');
    }

    public function parents()
    {
        return $this->hasMany(Relation::class,'Child_ID',"ID");
    }

    public function childs()
    {
        return $this->hasMany(Relation::class,'Parent_ID',"ID");
    }

    public function visitIns()
    {
        return $this->hasMany(VisitIn::class,'patient_ID',"ID");
    }
}
