<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestingAeController extends Controller
{
    public function index()
    {
        echo hash('sha256', str_random(40)."ilham");
    }
}
