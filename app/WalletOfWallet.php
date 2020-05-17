<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WalletOfWallet extends Model
{
    // mainWallet
    public $timestamps = false;
    public $primaryKey="ID";
    public $table = "WalletOfWallets";

    protected $fillable = [
        'totalMoney','User_ID'
    ];

    protected $hidden=[
        'User_ID'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'id','user_ID');
    }

}
