<?php

namespace App\Http\Controllers;

use App\Mail\LigaBancaria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EnviaEmailController extends Controller
{
    public function send()
    {
        Mail::to('hego_06@hotmail.com')->send(new LigaBancaria());
    }
}
