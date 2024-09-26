<?php
include_once "conexion.php";
class usuarioModelo{

    public static function mdlIniciarSesion($email, $password)
    {
        $mensaje = array();

        try {
            $objRespuesta = Conexion::conectar()->prepare("SELECT * FROM docente  WHERE docente.email=:email AND 
            docente.password=:password");
            $objRespuesta->bindParam(":email", $email);
            $objRespuesta->bindParam(":password", $password);
            $objRespuesta->execute();
            $objUsuario = $objRespuesta->fetch();

            if ($objUsuario != null) {
                $mensaje = array("codigo" => "200", "mensaje" => "ok");
                $_SESSION["usuario"] = $objUsuario["nombre"] . " " . $objUsuario["apellido"];
                $_SESSION["urlImagen"] = $objUsuario["url"];
                $_SESSION["id_docente"] = $objUsuario["id_docente"];
            } else {
                $mensaje = array("codigo" => "401", "mensaje" => "El usuario no existe, por favor verifique sus datos.");

            }
            $objRespuesta = null;

        } catch (Exception $e) {
            $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
        }

        return $mensaje;
    }
    


    public static function mdlListaTipoUsuarios(){
        $mensaje = array();
        try {
            $objRespuesta = Conexion::conectar()->prepare("SELECT * FROM tipo_usuario");
            $objRespuesta->execute();
            $listaTipoUsuarios = $objRespuesta->fetchAll();
            $mensaje = array("codigo"=>"200","listaTipoUsuarios"=>$listaTipoUsuarios);
            $objRespuesta = null;
        } catch (Exception $e) {
            $mensaje = array("codigo"=>"401","mensaje"=>$e->getMessage());
        }
        return $mensaje;
    }
}