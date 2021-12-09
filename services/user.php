<?php 
class User{
  private $id_use;
  private $nombre_use;
  private $email_use;
  private $pwd_use;
  private $tipo_use;


 public function __construct($id_use,$nombre_use,$email_use,$pwd_use,$tipo_use){
    $this->id_use=$id_use;
    $this->nombre_use=$nombre_use;
    $this->email_use=$email_use;
    $this->pwd_use=$pwd_use;
    $this->tipo_use=$tipo_use;
 }

}