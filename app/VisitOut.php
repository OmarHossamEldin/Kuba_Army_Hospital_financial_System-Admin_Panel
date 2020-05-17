<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VisitOut extends Model
{
    public $timestamps = false;
    public $table = "VisitOuts";
    public $primaryKey="ID";

    protected $fillable = [
        "requestedMoney",
        "daysNumber",
        "isRemain",
        "remainderMoney",
        "date",
        "user_ID",
        "visitIn_ID",
        "Ezn_Sarf"
    ];

    protected $hidden=[
        'visitIn_ID',
        'user_ID',
    ];
}
