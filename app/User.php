<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public $timestamps = false;
    public $primaryKey = "ID";

    protected $fillable = [
        'name','username', 'password','block'
    ];

    protected $hidden = [
        'password', 
    ];

    public function mainWallet()
    {
        return $this->hasMany(WalletOfWallet::class,'ID');
    }

    public function dailyWallet()
    {
        return $this->hasMany(Wallet::class,'user_ID','ID');
    }

    public function visitIN()
    {
        return $this->hasMany(visitIn::class,'user_ID');
    }
}
