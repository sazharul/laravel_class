<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
 
use Mail;
 
use App\Mail\NotifyMail;
 
 
class SendEmailController extends Controller
{
     
    public function index()
    {
      Mail::to('akashajmain01@gmail.com')->send(new NotifyMail());
 
      if (Mail::flushMacros()) {
           echo "Sorry! Please try again latter";
      }else{
           echo "Great! Successfully send in your mail";
         }
    } 
}