<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{

   protected $fillable = [
      'pid','department','username','name','email' 
   ];

}