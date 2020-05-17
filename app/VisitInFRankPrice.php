<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VisitInFRankPrice extends Model
{
    public $timestamps = false;
    public $table = "VisitInFRankPrices";
    public $primaryKey="ID";
    protected $fillable = [
        'price',
        'FRank_ID'
    ];

    protected $hidden=[
        'FRank_ID'
    ];
}
