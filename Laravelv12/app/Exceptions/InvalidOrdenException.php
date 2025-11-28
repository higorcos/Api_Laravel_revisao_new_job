<?php

namespace App\Exceptions;

use Exception;

class InvalidOrdenException extends Exception
{
   
   public function render(){
        return response()->view('errors.invalid-order', [400]);
   }
}
