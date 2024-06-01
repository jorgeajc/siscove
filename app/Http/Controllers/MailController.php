<?php
namespace App\Http\Controllers;
 
use App\Http\Controllers\Controller;
use App\Mail\DemoEmail;
use Illuminate\Support\Facades\Mail;
 
class MailController extends Controller
{
    public function send()
    {
        $objDemo = new \stdClass();
        $objDemo->nombre1 = 'jorge';
        $objDemo->nombre2 = 'alberto';
        $objDemo->apellido1 = 'jimenez';
        $objDemo->apellido2 = 'carrillo';
        $objDemo->recibe = 'Jimena';
        $objDemo->saludo = 'Kitcha';

        Mail::to("siscovesg@gmail.com")->send(new DemoEmail($objDemo));
    }
}