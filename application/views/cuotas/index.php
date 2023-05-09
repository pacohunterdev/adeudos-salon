<div class="" id="index-banner">   
    <div class="contenedor">
      <h1 class="header center deep-purple-text darken-4">
        <span id="no-cuotas"></span>
         Cuotas
      </h1>

        <table class="responsive-table">
            <tr>
                <th>Grupo:</th>
                <?php foreach($totalesGrupo as $grupo):?>
                    <th><?php echo $grupo->grado_grupo;?></th>
                <?php endforeach;?>
            </tr>
            <tr>
                <th>Cuotas asignadas:</th>
                <?php foreach($totalesGrupo as $grupo):?>
                    <td><?php echo $grupo->total;?></td>
                <?php endforeach;?>
            </tr>
        </table>
        <div class="card-panel center" style="margin: 10px; padding:20px;">
            <h5>Buscar por grado y grupo</h5>
            <?php 
            
            $this->load->view('alumnos/select'); 
            ?>
        </div>

        <table id="tabla-cuotas" class="responsive-table">
            <thead>
                <th>Cuota</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Grupos asignados</th>
                <th>Vencimiento</th>
                <th>Acciones</th>
            </thead>
            <tbody id="cuerpo-tabla"></tbody>
        </table>

        <div class="fixed-action-btn">
            <a class="btn-floating btn-large deep-purple darken-4" onclick="abrirModal('Registrar')">
                <i class="large material-icons" >add</i>
            </a>
        </div>
    </div>

    <div id="modalCuotas" class="modal">
        <form onsubmit="event.preventDefault();">
            <div class="modal-content">
                <input type="text" id="id-cuota" style="display: none;">
                <h4><span id="lbl-modal"></span> cuota</h4>
                <div class="row">
                    <div class="input-field col s6">
                        <input id="nombre_cuota" type="text"  required>
                        <label for="nombre_cuota" class="label">Nombre cuota*</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="precio_cuota" type="text" required>
                        <label for="precio_cuota" class="label">Precio*</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <textarea id="descripcion_cuota" class="materialize-textarea"></textarea>
                        <label for="descripcion_cuota" class="label">Descripción</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="fecha_vencimiento" type="date" required>
                        <label for="fecha_vencimiento" class="label">Fecha límite pago*</label>
                    </div>
                </div>
                <div class="row">
                    <div id="contenedor-asignados" style="display: none;">
                        <p>Grupos asignados</p>
                        <div id="grupos-asignados"></div>
                    </div>
                    <label for="">Asignar grupos*</label>
                    <div id="contenedor-chips">
                        <div id="chips-grupos" class="chips chips-autocomplete"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a class="modal-close waves-effect waves-green btn-flat" onclick="cerrarModalLocal()">Cerrar</a>
                <button type="submit" id="registrar-cuota" class=" waves-effect waves-green btn deep-purple darken-4">Registrar</a>
            </div>
        </form>
    </div>
    <?php $this->load->view('cargando'); ?>
</div>
<script>
    var asignados = [];
    var opcionesChips = {};
    var resultadosGrupos = {};
    const btnRegistrar = document.querySelector("#registrar-cuota");
    const tablaCuotas = document.querySelector("#tabla-cuotas");
    const btnBuscar = document.querySelector("#boton-buscar");
    const selectGrado = document.querySelector("#select-grado");
    const selectGrupo = document.querySelector("#select-grupo");
    const nombreCuota = document.querySelector("#nombre_cuota");
    const precioCuota = document.querySelector("#precio_cuota");
    const descripcionCuota = document.querySelector("#descripcion_cuota");
    const fechaVencimiento = document.querySelector("#fecha_vencimiento");

    btnBuscar.onclick = () => {
        if(selectGrado.value === "" || selectGrupo.value === ""){
            M.toast({html: 'Selecciona el grado y grupo'});
            return;
        }
        mostrarCargando();
        let filtro = {
            busqueda: selectGrado.options[selectGrado.selectedIndex].text +"° "+
            selectGrupo.options[selectGrupo.selectedIndex].text
        };

        obtener(filtro);
        ocultarCargando();
    }

    document.addEventListener('DOMContentLoaded', async function() {
        var elems = document.querySelectorAll('.chips-autocomplete');
        var instances = M.Chips.init(elems, {
            autocompleteOptions: {
            data: opcionesChips,
            limit: Infinity,
            minLength: 1
            },
            onChipAdd: (e, data) => { chipAgregado(e, data) },
            onChipDelete: (e, data) => { chipEliminado(e, data) },
        });
    });

    const abrirModal = (tipo) => {      
      document.querySelector("#lbl-modal").innerHTML = tipo;
      const elem = document.getElementById('modalCuotas');
      const instance = M.Modal.init(elem, {dismissible: false});
      instance.open();
    }

    const cerrarModalLocal = () => {
        document.querySelector("#contenedor-asignados").style.cssText = "display: none;";
        cerrarModal('modalCuotas');
        var chips = document.querySelector('#chips-grupos');
        var instanceChips = M.Chips.getInstance(chips);
        instanceChips.destroy();
        nombreCuota.value = "";
        precioCuota.value = "";
        descripcionCuota.value = "";
        fechaVencimiento.value = "";
    }

    btnRegistrar.onclick = async (event) => {
        if(nombreCuota.value === "" 
            || precioCuota.value === "" 
            || fechaVencimiento.value === ""){
            M.toast({html: 'Completa los campos marcados con *'});
            return;
        }
        let accion = document.querySelector("#lbl-modal").innerText;
        let ruta = (accion === 'Registrar') ? 'cuotas/registrar':
        'cuotas/editar'; 
        let mensaje = (accion === 'Registrar') ? 'Cuota registrada':
        'Información de cuota actualizada'; 
        let payload = {
            nombreCuota: nombreCuota.value,
            precioCuota: precioCuota.value,
            descripcionCuota: descripcionCuota.value,
            fechaVencimiento: fechaVencimiento.value,
            grupos: asignados
        };

        if(accion === "Editar") payload.idCuota = document.querySelector("#id-cuota").value;

        mostrarCargando();
        let respuesta = await post(payload, ruta);
        if(respuesta) {
            nombreCuota.value = "";
            precioCuota.value = "";
            descripcionCuota.value = "";
            fechaVencimiento.value = "";
          
            M.toast({ html: mensaje });  
            setTimeout(() => {
                ocultarCargando();
                location.reload();
            }, 2000);
        }
        ocultarCargando();
    }

    const obtener = async(filtros = null) => {
        let cuotas = await post({ filtros: filtros },'cuotas/obtener');
        let cuerpoTabla = document.querySelector("#cuerpo-tabla")
        let body = document.createElement('tbody');
        cuerpoTabla.remove();
        body.id= 'cuerpo-tabla';
        tablaCuotas.appendChild(body);
        cuerpoTabla = document.querySelector('#cuerpo-tabla');
        cuotas.forEach(cuota => {
          let fila = cuerpoTabla.insertRow();
          let acciones = "<a class='btn-floating btn-small waves-effect waves-light indigo darken-3' onclick='editarCuota("+JSON.stringify(cuota)+")'><i class='material-icons'>edit</i></a>"+
          " <a class='btn-floating btn-small waves-effect waves-light pink darken-2' onclick='eliminarCuota("+cuota.id_cuota+")'><i class='material-icons'>delete</i></a>";
          fila.insertCell().textContent = cuota.nombre_cuota;
          fila.insertCell().textContent = cuota.descripcion;
          fila.insertCell().textContent = cuota.precio;
          fila.insertCell().textContent = cuota.grupos;
          fila.insertCell().textContent = cuota.fecha_vecimiento;
          fila.insertCell().innerHTML = acciones;
        })
        document.querySelector("#no-cuotas").innerText = cuotas.length;
    }

    const editarCuota = async(cuota) => {
        abrirModal('Editar');
        let tagsIniciales = await post({ idCuota: cuota.id_cuota }, 'cuotas/gruposAsignados');
        let chips = "";
        let labeles =  document.querySelectorAll(".label");
        document.querySelector("#id-cuota").value = cuota.id_cuota;
        document.querySelector("#contenedor-asignados").style.cssText = "display: block";
        labeles.forEach(label=>{
            label.classList.add('active');
        })
        nombreCuota.value = cuota.nombre_cuota;
        precioCuota.value = cuota.precio;
        descripcionCuota.value = cuota.descripcion;
        fechaVencimiento.value = cuota.fecha_vecimiento;

        tagsIniciales.forEach(tag => {
            chips += "<div class='chip'>"+
                tag.tag +
                "<i class='close material-icons' onclick='eliminaChipAsignado("+JSON.stringify(tag.tag)+")'>close</i>"+
            "</div> "
        })
        document.querySelector("#grupos-asignados").innerHTML = chips;
    }

    const eliminaChipAsignado = async(grupo) =>{ 
        let idCuota = document.querySelector("#id-cuota").value;
        let payload = {
            idCuota: idCuota,
            grupo: grupo 
        };

        let respuesta =  await post(payload, 'cuotas/eliminaGrupoCuota');
        if(respuesta) {
            M.toast({html: 'Grupo quitado de la cuota'});  
        }
    }

    const eliminarCuota = (id) => {
        Swal.fire({
            title: '¿Seguro que deseas eliminar?',
            text: "Esta acción no se puede revertir",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Sí, eliminar'
        }).then(async (result) => {
            if (result.isConfirmed) {
              let eliminado = await post({ idCuota: id }, 'cuotas/eliminar');
              if(eliminado){
                Swal.fire(
                  'Correcto',
                  'La cuota se ha eliminado.',
                  'success'
                )
                obtener();  
              }
            }
          })
    }

    const chipAgregado = async (e, data) => {
        let chip = data.childNodes[0].textContent;
        let seleccionado =  resultadosGrupos[chip];
        seleccionado.texto = chip; 
        asignados.push(seleccionado)
    }

    const chipEliminado = (e, data) => {
        let chip = data.childNodes[0].textContent;
        for(let i = 0; i < asignados.length; i++){
            if(chip === asignados[i].texto){
                asignados.splice(i, 1);
            }
        }
    }

    const buscarGradosYGrupos = async()=> {
        let respuesta = await get('alumnos/gradosYGrupos');
        let opciones = respuesta.opciones;
        let arr =  respuesta.respuesta;
        
        for(let i = 0; i < opciones.length; i++ ) {
            Object.assign(opcionesChips, opciones[i]);
        }

        for(let i = 0; i < arr.length; i++ ) {
            Object.assign(resultadosGrupos, arr[i]);
        }
    }
    mostrarCargando();
    setTimeout(() => {
        llenarSelectGrados();
        llenarSelectGrupos();
    
        buscarGradosYGrupos();
        obtener();
        ocultarCargando();
    }, 1000);

    
    $('input textarea').on('keyup', function(){
        this.value = this.value.toUpperCase();
    })

</script>
<style>
    input, textarea  { 
        text-transform: uppercase;
    }
</style>
