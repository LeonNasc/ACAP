<?php

class Authenticator{

  const PERMISSION_TOKEN = 'ACAP2018';
  private $login_status = False;

  public function __construct($token){

    if($token === $this->login){
      $this->activateLogStatus();
    }
    else{
      throw Exception("Senha inválida");
    }    
  }

  private function activateLogStatus(){
    $this->login_status = True;
    return getStatus();
  }
  public function deactivateLogStatus(){
    $this->login_status = False;
    return getStatus();
  }

  public function getStatus(){
    return $this->login_status;
  }
}
?>