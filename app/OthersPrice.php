<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OthersPrice extends Model
{
    public $timestamps = false;
    public $table = "OthersPrices";
    public $primaryKey="ID";

    protected $fillable = [
        "name",
        "price",
        "Service_ID",
        "weight"
    ];

    public function MainService(){
        return $this->belongsTo(Service::class,'Service_ID','ID');
    }
}
