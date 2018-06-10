<?php

class Authenticator{

  const PERMISSION_TOKEN = 'ACAP2018';
  private $login_status = False;

  public function __construct($token){

    if($token == Authenticator::PERMISSION_TOKEN){
      $this->activateLogStatus();
    }
    else{
      throw new Exception("Senha inválida");
    }    
  }

  private function activateLogStatus(){
    $this->login_status = True;
    return Authenticator::setSessionStatus($this);
  }
  public function deactivateLogStatus(){
    $this->login_status = False;
    return Authenticator::setSessionStatus($this);
  }
  
  private static function setSessionStatus($authToken){
    session_start();
    $_SESSION['authentication_status'] = $authToken->getStatus();
  }

  public function getStatus(){
    return $this->login_status;
  }
}
?>