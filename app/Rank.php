<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rank extends Model
{
	public $table="Ranks";
    public $timestamps = false;

    protected $fillable = [
        'RName'
    ];

    public function patients()
    {
        return $this->hasMany(Patient::class,'Rank_ID');
    }
}
