<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WalletDetail extends Model
{
    // details for visitins

    public $timestamps = false;
    public $table = "WalletDetails";
    public $primaryKey="ID";    

    protected $fillable = [
        'Patient_ID',
        'Service_ID',
        'Wallet_ID',
        'date',
        'price',
        'PrintingTimes',
        'done',
        'notes'
    ];

    protected $hidden=[
        'Patient_ID',
        'Wallet_ID',
        'Service_ID'
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class,'Patient_ID','ID');
    }

    public function service()
    {
        return $this->belongsTo(service::class,'Service_ID','ID');
    }

    public function dailyWallet()
    {
        return $this->belongsTo(WalletOfWallet::class,'Wallet_ID','ID');
    }

}
