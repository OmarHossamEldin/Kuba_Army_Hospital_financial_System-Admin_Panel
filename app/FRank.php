<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FRank extends Model
{
	public $table="FRanks";
    public $timestamps = false;

    protected $fillable = [
        'FRName'
    ];

    public function patients()
    {
        return $this->hasMany(Patient::class,'FRank_ID');
    }
}
