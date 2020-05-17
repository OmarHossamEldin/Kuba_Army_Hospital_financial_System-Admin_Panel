<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Morafek extends Model
{
    public $timestamps = false;
    public $table = "Morafeks";
    public $primaryKey="ID";

    protected $fillable = [
        "name",
        "myCash",
        "visitIn_ID",
        "date",
        "prinitingTime"
    ];

    public function VisitIn(){
        return $this->belongsTo(VisitIn::class,'visitIn_ID','ID');
    }
}