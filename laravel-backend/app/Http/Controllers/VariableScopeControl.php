<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VariableScopeControl extends Controller
{
    public $message = "Hello po, Team Ryzza";

    public function index($name)
{
    $age = 67;
    
}
}