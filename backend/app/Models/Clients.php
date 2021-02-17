<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clients extends Model{
     
    protected $table = 'clients';

    protected $fillable = [
        'name',
        'email',
        'telephone',
        'cpf'
    ]; 

    public static $rules = [
        'name' => 'required|max:45',
        'email' => 'required|email|max:45|email:rfc,dns',
        'telephone' => 'required|max:45',
        'cpf' => 'required|max:14'          
    ];
    
    // public function transactions(){

    //     return $this->hasMany(Transactions::class, 'id_client','id');
        
    // }
}