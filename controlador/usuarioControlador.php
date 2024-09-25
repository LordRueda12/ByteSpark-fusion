<?php
session_start();

include_once "../modelo/usuarioModelo.php";


class usuarioControlador {
    public $id_docente;
    public $documento;
    public $nombre;
    public $apellido;
    public $email;
    public $password;
    public $url;
    


    public function ctrIniciarSesion() {
        $objRespuesta = usuarioModelo::mdlIniciarSesion($this->email, $this->password);
        echo json_encode($objRespuesta);
    }

    public function ctrListaTipoUsuarios(){
        $objRespuesta = usuarioModelo::mdlListaTipoUsuarios();
        echo json_encode($objRespuesta);
    }
}



if (isset($_POST["iniciarSesion"]) == "ok") {
    $objUsuario = new usuarioControlador();
    $objUsuario->email = $_POST["emailUsuario"];
    $objUsuario->password = $_POST["passwordUsuario"];
    $objUsuario->ctrIniciarSesion();
}
if(isset($_POST["listaTipoUsuarios"]) == "ok"){
    $objTipoUsuario = new TipoUsuarioControlador();
    $objTipoUsuario ->ctrListaTipoUsuarios();
}