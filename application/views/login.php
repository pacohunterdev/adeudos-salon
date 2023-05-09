<?php $this->load->library('session');?>

<div class="container">
    <?php $this->load->view('cargando'); ?>
    <h1 class="center-align white-text">Inicio de Sesión</h1>
    <h3 class="center-align white-text">Adeudos escolares</h3>
    <div class="card-panel deep-purple lighten-5">
        <div class="row">
            <div class="col s12 m6 l4">
                <img class="responsive-img imgInicio"  src="https://handsonbanking.org/wp-content/uploads/2020/05/gradcapwithmoneysymbol_green.png" alt="">
            </div>
            <div class="col s12 m6 l8">
                <form class="col s12" action="<?php echo base_url()?>index.php/usuario/inciarSesion" method="post">
                    <div class="row">
                        <div class="input-field col s12">
                            <input name="usuario" id="usuario" type="text" required>
                            <label for="usuario">Usuario</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input name="password" id="password" type="password" required>
                            <label for="password">Contraseña</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m6 l6">
                            <button class="btn deep-purple darken-4 waves-effect waves-light" type="submit" name="action">Iniciar Sesión
                            <i class="material-icons left">send</i>
                            </button>
                        </div>
                        <div class="col s12 m6 l6">
                            <button class="btn deep-purple darken-1 waves-effect waves-light modal-trigger" href="#modalOlvide" name="action">Olvidé contraseña</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
        <?php if($this->session->flashdata('mensaje')): ?>
            <div class="card-panel red center-align white-text">
                <h5><?php echo $this->session->flashdata('mensaje');?></h5>
            </div>
        <?php endif; ?>
    </div>
    <div id="modalOlvide" class="modal modal-fixed-footer">
        <div class="modal-content">
        <h4>Recuperar contraseña</h4>
        <div class="row">
            <div class="input-field col s12">
                <input name="usuarioRecuperar" id="usuarioRecuperar" type="text">
                <label for="usuarioRecuperar">Usuario</label>
            </div>
            <div class="input-field col s12">
                <input name="email" id="email" type="email">
                <label for="email">Correo electrónico</label>
            </div>
            <div class="input-field col s12">
                <input name="nuevaPass" id="nuevaPass" type="password">
                <label for="nuevaPass">Nueva contraseña</label>
            </div>
            <div class="input-field col s12">
                <input name="repiteNueva" id="repiteNueva" type="password">
                <label for="repiteNueva">Repite la nueva contraseña</label>
            </div>
        </div>
        </div>
        <div class="modal-footer">
        <a onclick="cerrarModal('modalOlvide')" class="modal-close waves-effect waves-green btn-flat">Cerrar</a>
        <a class="waves-effect waves-green btn deep-purple darken-4" onclick="recuperar()">Recuperar</a>
        </div>
    </div>
</div>
<script>
    const recuperar = async () => {
        const usuario = document.querySelector("#usuarioRecuperar");
        const email = document.querySelector("#email");
        const nueva = document.querySelector("#nuevaPass");
        const repite = document.querySelector("#repiteNueva");
        let payload = {
            usuario: usuario.value ,
            email: email.value  ,
            nueva: nueva.value  
        }

        if(payload.usuario === "" || payload.email === "" || payload.nueva === ""){
            M.toast({html: 'Completa todos los campos'});
            return;
        }

        if(repite.value !== payload.nueva){
            M.toast({html: 'Las contraseñas no coinciden'});
            retuern;
        }

        let respuesta =  await post(payload, 'usuario/recuperar');
        if(respuesta){
            usuario.value = "";
            email.value = "";
            nueva.value = "";
            repite.value = "";
            cerrarModal('modalOlvide');
            M.toast({html: 'Contraseña guardada'});
            return;
        }
        M.toast({html: 'Algo salió mal'});
    }

    mostrarCargando();
    setTimeout(() => {
        ocultarCargando();
    }, 1000);
</script>
<style>
    body{
        background: #7c4dff;
        padding:10%;
    }

    .card-panel{
        border-radius: 40px;
    }

    .imgInicio{
        filter: opacity(0.5) drop-shadow(0 0 0 blue);
    }
</style>