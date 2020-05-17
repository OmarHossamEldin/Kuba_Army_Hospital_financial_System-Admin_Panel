<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Relation extends Model
{
    public $timestamps = false;	
    protected $fillable = [
        'Child_ID', 'Parent_ID'
    ];
    public $primaryKey = 'ID';
    
    public function childs(){
        return $this->belongsTo(Patient::class,'Parent_ID','ID');
    }
}
