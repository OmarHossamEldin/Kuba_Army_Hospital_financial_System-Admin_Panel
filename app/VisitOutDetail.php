<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VisitOutDetail extends Model
{
    public $timestamps = false;
    public $table = "VisitOutDetails";
    public $primaryKey="ID";

    protected $fillable = [
        "withMoreafek",
        "subService_ID",
        "visitIn_ID",
        "totalPrice"
    ];

    protected $hidden=[
        'visitIn_ID',
        "subService_ID"
    ];

    public function otherprices()
    {
        return $this->belongsTo(OthersPrice::class,'subService_ID','ID');
    }
}
