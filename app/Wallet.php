<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    //dailyWallet
    public $timestamps = false;
    public $table = "Wallets";
    public $primaryKey = "ID";

    protected $fillable = [
        'totalMoney','user_ID', 'date'
    ];

    protected $hidden=[
        'user_ID'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_ID');
    }

    public function walletDetails()
    {
        return $this->hasMany(WalletDetail::class,'Wallet_ID');
    }
}
