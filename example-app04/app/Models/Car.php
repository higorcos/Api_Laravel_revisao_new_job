<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    /** @use HasFactory<\Database\Factories\CarFactory> */
    use HasFactory;
    protected $fillable = ['seller_name', 'seller_email','make','model', 'year','user_id'];
    
    //public $timestamps = false;
       public function scopeCarList($query){  
        return $query->where('year', '>', '0');
    } 
    
    public function user(){
        return $this->belongsTo(User::class);
    }   
}
