class usuario {
    constructor(objData) {
        this._objData = objData;
    }

    iniciarSesion() {
        let objDataUsuario = new FormData();
        objDataUsuario.append("emailUsuario", this._objData.email);
        objDataUsuario.append("passwordUsuario", this._objData.password);
        objDataUsuario.append("iniciarSesion", this._objData.iniciarSesion);

        fetch("controlador/usuarioControlador.php", {
            method: 'POST',
            body: objDataUsuario
        })
            .then(response => response.json())
            .catch(error => {
                console.log(error);
            })
            .then(response => {
                console.log(response);
                if (response["codigo"] == "200") {
                    window.location = "inicio";
                } else {
                    alert(response["mensaje"]);
                }
            });
    }
}