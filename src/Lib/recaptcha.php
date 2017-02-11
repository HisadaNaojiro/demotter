<?php
namespace App\Lib;
use Cake\Core\Configure;
use ReCaptcha\ReCaptcha;

class ReCaptcha{
  
  public function getConf()
  {
    return [
      'siteKey' => Configure::read('Recaptcha.siteKey'),
      'lang' => Configure::read('Recaptcha.lang')
    ];
  }

  public function verify($data)
  {
    $secretKey = Configure::read('Recaptcha.secretkey');
    $ReCaptcha =  new ReCaptcha($secretKey);
    $resp = $ReCaptcha->verify($data,$_SERVER['REMOTE_ADDR']);

    return ($resp->isSuccess())? true : false;
  }
}
