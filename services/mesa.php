<?php 
class Mesa{
  private $id_mes;
  private $nombre_mes;
  private $status_mes;
  private $capacidad_mes;
  private $id_sal_fk;


 public function __construct($id_mes,$nombre_mes,$status_mes,$capacidad_mes,$id_sal_fk){
    $this->id_mes=$id_mes;
    $this->nombre_mes=$nombre_mes;
    $this->status_mes=$status_mes;
    $this->capacidad_mes=$capacidad_mes;
    $this->id_sal_fk=$id_sal_fk;
 }

}