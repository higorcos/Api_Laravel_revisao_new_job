<?php

namespace App\Exceptions;

use Exception;

class ProductNotFoundException extends Exception
{
      
   public function render(){
           //modelo para API
        return response()->json([
            'error'=> 'ProductNotFoundException',
        ],400);
   }
}
