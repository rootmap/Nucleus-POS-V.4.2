<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
class MailController extends Controller {
  

   private $moduleName="Mail Sender";
   private $sdc;
   public function __construct(){ $this->sdc = new StaticDataController(); }

  public function basic_email()
  {

      echo $this->sdc->initMail(
         'f.bhuyian@gmail.com',
         'Testing Mail From Static Data Controller',
         'Hi <b>Monira</b>, <br> <b> Good Morning, </b> Hope You are doing well.');
  }


}


