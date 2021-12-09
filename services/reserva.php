<?php
    class Reserva{
        private $id_res;
        private $horaIni_res;
        private $horaFin_res;
        private $datos_res;
        private $id_use_fk;
        private $id_mes_fk;


        public function __construct($id_res,$horaIni_res,$horaFin_res,$datos_res,$id_use_fk,$id_mes_fk){
            $this->id_res=$id_res;
            $this->horaIni_res=$horaIni_res;
            $this->horaFin_res=$horaFin_res;
            $this->datos_res=$datos_res;
            $this->id_use_fk=$id_use_fk;
            $this->id_mes_fk=$id_mes_fk;
        }

    }