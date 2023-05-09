<div class="contenedor">
    <div class="card-panel white-text deep-purple darken-4">
        <div class="row">
            <div class="col s12 m6 l3">
                <img class="responsive-img" src="https://www.pngplay.com/wp-content/uploads/12/User-Avatar-Profile-Free-PNG.png" alt="">
            </div>
            <div class="col s12 m6 l9">
                <div class="col s12">
                    <h5 class="yellow-text">Usuario</h5>
                    <div class="input-field inline">
                        <input required readonly id="usuario" class="input-lg" type="text" >
                    </div>
                </div>
                <div class="col s12">
                    <h5 class="yellow-text">Correo</h5>
                    <div class="input-field inline">
                        <input required readonly id="email" class="input-lg" type="text" >
                    </div>
                </div>
                <div class="col s9 offset-s9">
                    <a class='btn-floating btn-large waves-effect waves-light deep-purple ' id='btn-editar'><i class='material-icons'>edit</i></a>
                    <a class='btn-floating btn-large waves-effect waves-light deep-green ' id='btn-guardar' style="display: none;"><i class='material-icons'>check</i></a>
                    <a class='btn-floating btn-large waves-effect waves-light indigo modal-trigger' href="#modalPassword" id='btn-cambia-pass'><i class='material-icons'>lock</i></a>
                </div>
            </div>
        </div>
    </div>
    
    <div id="modalPassword" class="modal modal-fixed-foote">
        <div class="modal-content">
            <h4>Cambiar contraseña</h4>
            <div class="input-field col s12">
                <input id="actual" type="password">
                <label for="actual">Contraseña actual</label>
            </div>
            <div class="input-field col s12">
                <input id="nueva" type="password">
                <label for="nueva">Contraseña nueva</label>
            </div>
            <div class="input-field col s12">
                <input id="repetida" type="password">
                <label for="repetida">Repite la contraseña</label>
            </div>
        </div>
        <div class="modal-footer">
        <a onclick="cerrarModal('modalPassword')" class="modal-close waves-effect waves-green btn-flat">Cerrar</a>
        <a onclick="cambiarPassword()" class="waves-effect waves-green btn deep-purple darken-4">Cambiar contraseña</a>
        </div>
    </div>
</div>
<script>
    const btnEditar = document.querySelector("#btn-editar");
    const btnCambiaPass = document.querySelector("#btn-cambia-pass");
    const btnGuardar = document.querySelector("#btn-guardar");
    const nombre = document.querySelector("#usuario");
    const email = document.querySelector("#email");

    btnEditar.onclick = () => {
        nombre.removeAttribute('readonly');
        email.removeAttribute('readonly');
        nombre.focus();
        btnGuardar.style.display = 'inline-block';
        btnEditar.style.display = 'none';
    };

    btnGuardar.onclick=async()=>{
        if(nombre.value === "" || email.value === ""){
            M.toast({html: 'Completa los campos'});
            return;
        }
        let payload = {
            nombre: nombre.value,
            email: email.value
        };

        let resultado = await post(payload, 'usuario/editar');
        if(resultado){
            M.toast({html: 'Información actualizada'});
            nombre.setAttribute('readonly', true);
            email.setAttribute('readonly', true);
            btnGuardar.style.display = 'none';
            btnEditar.style.display = 'inline-block';   
        }
    }

    const obtener = async ()=>{
        let datos = await get('usuario/obtener');
        nombre.value=datos.nombre_usuario;
        email.value=datos.email;
    }

    const cambiarPassword = async() => {
        let payload = {
            actual: document.querySelector("#actual").value,
            nueva: document.querySelector("#nueva").value,
            repetida: document.querySelector("#repetida").value
        };

        if(payload.actual === "" || payload.nueva === "" || payload.repetida === ""){
            M.toast({html: 'Completa todos los datos'});
            return;
        }

        if(payload.nueva !== payload.repetida){
            M.toast({html: 'La contraseña nueva y la repetida no coinciden'});
            return;
        }

        let respuesta = await post(payload, 'usuario/cambiarPassword');
        if(respuesta === 'INCORRECTO') {
            M.toast({html: 'La contraseña actual es incorrecta'});
            return;
        }

        if(respuesta){
            M.toast({html: 'Contraseña actualizada'});
            cerrarModal('modalPassword');
        }
    }

    obtener();
</script>
<style>
    .input-lg {
    color: white;
    font-size: 40px !important;
    padding: 20px !important;
    width: 100% !important;
    }

    .card-panel{
        border-radius: 30px;
    }
</style>