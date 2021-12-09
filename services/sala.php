<?php 
class Sala{
  private $id_sal;
  private $nombre_sal;
  private $capacidad_sal;
  private $imagen_sal;


 public function __construct($id_sal,$nombre_sal,$capacidad_sal,$imagen_sal){
    $this->id_sal=$id_sal;
    $this->nombre_sal=$nombre_sal;
    $this->capacidad_sal=$capacidad_sal;
    $this->imagen_sal=$imagen_sal;
 }

}