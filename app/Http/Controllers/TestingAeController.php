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

    public function email_display()
    {
        return view('email.auth.new_register_confirmation')
                ->with([
                    'nama' => 'Neng Ketty',
                    'link' => 'cerdas.com',
                    
                ]);
    }

    public function the_new_email_display()
    {
        return view('email.auth.the_new_register_confirmation')
                ->with([
                    'nama' => 'Neng Ketty',
                    'link' => 'cerdas.com',
                    
                ]);
    }
}
