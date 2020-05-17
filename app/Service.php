<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public $timestamps = false;
    public $primaryKey="ID";    
    public $table = "Services";
    protected $fillable = [
        'name','flag', 'weight'
    ];
    public function supservice()
    {
        return $this->hasMany(OthersPrice::class,'Service_ID','ID');
    }
}
