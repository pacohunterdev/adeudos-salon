<div class="" id="index-banner">
  <div class="contenedor">
    <h1 class="header center deep-purple-text darken-4">
      <span id="no-alumnos"></span>
       Alumnos
      <span class="deep-purple darken-4 white-text total" style="display: none;" id="grado-grupo"></span>
    </h1>
    
    <div class="center-align ">
      <a class="waves-effect waves-purple  modal-trigger btn-flat" href="#modal1" >VER GRADOS Y GRUPOS</a>
    </div>

    <div class="card-panel center" style="margin: 10px; padding:20px;">
      <div class="row">
        <div class="input-field col s12 m8 l8">
          <input id="alumno-buscar" type="text"  >
          <label for="alumno-buscar">Buscar alumno por nombre o apellidos</label>
        </div>
        <div class="col s12 m4 l4">
          <br>
          <button class="waves-effect waves-light btn deep-purple darken-1" onclick="buscarPorNombre()" >
            <i class="material-icons left">search</i>
              Buscar
          </button>
        </div>
      </div>  

      <?php $this->load->view('alumnos/select');?>
    </div>

    <div style="display: none;" class="card-panel  yellow accent-1" id="mensaje-no-encontrados">
      <h2>No se encontraron alumnos :(</h2>
      <h3>Agrega algunos</h3>
    </div>

    <div class="contenedorTabla">
      <div class="col s12">
        <table id="tabla-alumnos" class=" responsive-table"  style="display: none;">
          <thead>
            <tr>
                <th>No.</th>
                <th>Apellido paterno</th>
                <th>Apellido materno</th>
                <th>Nombre</th>
                <th>Segundo nombre</th>
                <th>Tutor</th>
                <th>Teléfono</th>
                <th>Acciones</th>
            </tr>
          </thead>
          <tbody id="cuerpo-tabla-alumnos"></tbody>
        </table>
      </div>
    </div>
    <?php $this->load->view('cargando');?>

    <!-- Modal Grados y Grupos -->
	  <div id="modal1" class="modal modal-fixed-footer">
	    <div class="modal-content">
	      <h4>Administrar grados y grupos</h4>
	      <div class="row">
	      	<div class="col s6">
	      		<h5>Grados</h5>
            <div class="row">
              <div class="input-field col s6">
                <input id="nombre_grado" type="text" class="validate">
                <label for="nombre_grado">Grado:</label>
              </div>
              <div class="col s6">
                <br>
                <a class="waves-effect waves-light btn deep-purple darken-4" onclick="agregarGrado()">Agregar</a>
              </div>
            </div>
	      		<table>
	      			<thead>
	      				<th>Grados registrados</th>
	      			</thead>
	      			<tbody id="tabla-grados">
	      			</tbody>
	      		</table>
	      	</div>
	      	<div class="col s6">
	      		<h5>Grupos</h5>
            <div class="row">
              <div class="input-field col s6">
                <input id="nombre_grupo" type="text" class="validate">
                <label for="nombre_grupo">Grupo:</label>
              </div>
              <div class="col s6">
                <br>
                <a class="waves-effect waves-light btn deep-purple darken-4" onclick="agregarGrupo()" >Agregar</a>
              </div>
            </div>
	      		<table>
		      		<thead>
		      			<th>Grupos registrados</th>
		      		</thead>
		      		<tbody id="tabla-grupos">
		      		</tbody>
	      		</table>
	      	</div>
	      </div>
	    </div>
	    <div class="modal-footer">
	      <a onclick="cerrarModal('modal1')" class="modal-close waves-effect waves-green btn deep-purple darken-4">Cerrar</a>
	    </div>
	  </div>

    <div id="modalCuotas" class="modal modal-fixed-footer" >
      <div class="modal-content">
        <h4>Cuotas de <span id="lbl-nombre-alumno"></span></h4>
        <div class="row">
          <div class="col s12 m6 l6">
            <div class="card-panel">
              <span class="teal-text text-darken-4">
                <h5>Pagadas: <span id="pagadas"></span></h5>
                <h5>Total pagado: $<span id="pagado"></span></h5>
              </span>
            </div>
          </div>
          <div class="col s12 m6 l6">
            <div class="card-panel">
              <span class="pink-text text-darken-4">
              <h5>Pendientes: <span id="pendientes"></span></h5>
              <h5>Por pagar: $ <span id="por-pagar"></span></h5>
              </span>
            </div>
          </div>
        </div>
        <table id="tabla-cuotas">
          <thead>
            <th>Pagada</th>
            <th>Cuota</th>
            <th>Descripción</th>
            <th>Pago</th>
            <th>Vencimiento</th>
          </thead>
          <tbody id="cuotas-pagos"></tbody>
        </table>
      </div>
      <div class="modal-footer">
        <a onclick="cerrarModal('modalCuotas')" class="modal-close waves-effect waves-green btn deep-purple darken-4">Cerrar</a>
      </div>
    </div>
    
    <div id="modalAgregarAlumno" class="modal">
      <div class="modal-content">
        <h4><span id="titulo-modal-alumno"></span> alumno</h4>
        <form onsubmit="event.preventDefault();">
          <input type="text" id="id-alumno" style="display:none;">
        <div class="row">
          <div class="input-field col s6">
            <input id="primer_nombre" type="text"  required>
            <label for="primer_nombre" class="label">Primer nombre*</label>
          </div>
          <div class="input-field col s6">
            <input id="segundo_nombre" type="text" >
            <label for="segundo_nombre" class="label">Segundo nombre</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s6">
            <input id="apellido_paterno" type="text" required>
            <label for="apellido_paterno" class="label">Apellido paterno*</label>
          </div>
          <div class="input-field col s6">
            <input id="apellido_materno" type="text" >
            <label for="apellido_materno" class="label">Apellido materno</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s6">
            <input id="nombre_tutor" type="text" required>
            <label for="nombre_tutor" class="label">Nombre tutor*</label>
          </div>
          <div class="input-field col s6">
            <input id="telefono_tutor" type="text" required>
            <label for="telefono_tutor" class="label">Teléfono</label>
          </div>
        </div>
      <div class="modal-footer">
        <a onclick="cancelarRegistrar()" class="modal-close waves-effect waves-green btn-flat">Cerrar</a>
        <button type="submit" onclick="registrarAlumno()" class=" waves-effect waves-green btn deep-purple darken-4">Registrar</a>
      </div>
      </form>
    </div>
    </div>
  </div>

  <div id="modalBajas" class="modal">
    <div class="modal-content">
      <h4>Alumnos dados de baja</h4>
      <table id="tabla-bajas">
        <thead>
          <th>Grupo</th>
          <th>Apellido paterno</th>
          <th>Apellido materno</th>
          <th>Primer nombre</th>
          <th>Segundo nombre</th>
          <th>Tutor</th>
          <th>Teléfono</th>
        </thead>
        <tbody id="alumnos-baja"></tbody>
      </table>
    </div>
    <div class="modal-footer">
      <a onclick="cerrarModal('modalBajas')" class="modal-close waves-effect waves-green btn deep-purple darken-4">Cerrar</a>
    </div>
  </div>


  <div class="fixed-action-btn">
	  <a class="btn-floating btn-large  deep-purple darken-4">
	    <i class="large material-icons">mode_edit</i>
	  </a>
	  <ul>
	    <li><a class="btn-floating pink darken-4 tooltipped" data-position="left" data-tooltip="Alumnos dados de baja" onclick="abrirDadosBaja()"><i class="material-icons">mood_bad</i></a></li>
	    <li><a class="btn-floating indigo darken-4 tooltipped " data-position="left" data-tooltip="Agregar alumno" onclick="abrirModalAgregar('Agregar')"><i class="material-icons">add</i></a></li>
	  </ul>
	</div>
  
<script>
  const btnBuscarAlumnos = document.querySelector("#boton-buscar");
  const selectGrado = document.querySelector("#select-grado");
  const selectGrupo = document.querySelector("#select-grupo");
  const tablaAlumnos = document.querySelector("#tabla-alumnos")
  const noEncontrados = document.querySelector("#mensaje-no-encontrados")
  const noAlumnos = document.querySelector("#no-alumnos");
  const gradoGrupo = document.querySelector("#grado-grupo");
  const labelModalAlumno = document.querySelector("#titulo-modal-alumno");
  
  const nombre = document.querySelector("#primer_nombre");
  const segundoNombre = document.querySelector("#segundo_nombre");
  const apellidoPaterno = document.querySelector("#apellido_paterno");
  const apellidoMaterno = document.querySelector("#apellido_materno");
  const nombreTutor = document.querySelector("#nombre_tutor");
  const telefonoTutor = document.querySelector("#telefono_tutor");

  const buscarPorNombre = () => {
    let busqueda = document.querySelector("#alumno-buscar").value;
    if(busqueda === "") {
      M.toast({html: 'Escribe parte del nombre o apellidos del alumno'});
      return;
    }

    selectGrado.value = selectGrupo.value = "";
    gradoGrupo.innerHTML = "";
    gradoGrupo.style.display = "none";
    dibujarTablaAlumnos({ buscarPor: busqueda });
  }
       
  const registrarAlumno = async (event)=>{
    let accion = labelModalAlumno.innerText;
    let ruta = (accion === 'Agregar') ? 'alumnos/registrar':
      'alumnos/editar'; 
    let mensaje = (accion === 'Agregar') ? 'Alumno registrado':
      'Información de alumno actualizada'; 
    let payload = {
      nombre: nombre.value,
      segundoNombre: segundoNombre.value,
      apellidoPaterno: apellidoPaterno.value,
      apellidoMaterno: apellidoMaterno.value,
      nombreTutor: nombreTutor.value,
      telefonoTutor: telefonoTutor.value,
      idGrado : selectGrado.value,
      idGrupo : selectGrupo.value
    }

    if(accion === "Editar") payload.idAlumno = document.querySelector("#id-alumno").value;

    if(payload.nombre === ""||
    payload.apellidoPaterno === "" ||
    payload.nombreTutor === "" ||
    payload.telefonoTutor === ""){
      M.toast({html: 'Completa todos los campos con *'});
      return;
    }

    let respuesta = await post(payload, ruta);

    if(respuesta){
      nombre.value = "";
      segundoNombre.value = "";
      apellidoPaterno.value = "";
      apellidoMaterno.value = "";
      nombreTutor.value = "";
      telefonoTutor.value = "";
      M.toast({html: mensaje});
      dibujarTablaAlumnos({idGrado: selectGrado.value,idGrupo: selectGrupo.value});
      if(accion == "Editar"){
        labelModalAlumno.innerHTML = "";
        cerrarModal('modalAgregarAlumno')        
      }
    }
  }

  btnBuscarAlumnos.onclick =  ()=>{
    if(selectGrado.value === "" || selectGrupo.value === "" ){
      M.toast({html: 'Selecciona el grado y grupo'});
      return;
    }

    dibujarTablaAlumnos({idGrado: selectGrado.value,idGrupo: selectGrupo.value});
    gradoGrupo.style.cssText = "display: inline;";
    gradoGrupo.innerHTML = selectGrado.options[selectGrado.selectedIndex].text +"° "+
    selectGrupo.options[selectGrupo.selectedIndex].text;
    document.querySelector("#alumno-buscar").value = "";
  }

  const dibujarTablaAlumnos = async (payload) =>{
    mostrarCargando();
    let alumnos = await post(payload,'alumnos/obtener');
    
    if(alumnos.length > 0){  
      let noLista = 0;      
      let cuerpoTablaAlumnos = document.querySelector("#cuerpo-tabla-alumnos")
      let body = document.createElement('tbody');
      tablaAlumnos.style.cssText = "display: block; "
      noEncontrados.style.cssText = "display: none;"
      cuerpoTablaAlumnos.remove();
      body.id= 'cuerpo-tabla-alumnos';
      tablaAlumnos.appendChild(body);
      cuerpoTabla = document.querySelector('#cuerpo-tabla-alumnos');
      
      alumnos.forEach(alumno => {
        let fila = cuerpoTabla.insertRow();
        let estilo = "";
        let acciones = "";
        
        if(alumno.estado === 'BAJA') {
          fila.style.cssText = 'background-color: #bdbdbd;';
          estilo = 'background-color:  #424242 !important; pointer-events: none;';
        }
        
        acciones = "<a class='btn-floating btn-small waves-effect waves-light indigo darken-3' style='"+estilo+"' onclick='editarAlumno("+JSON.stringify(alumno)+")'><i class='material-icons'>edit</i></a>"+
        " <a class='btn-floating btn-small waves-effect waves-light  pink darken-2' style='"+estilo+"' onclick='eliminarAlumno("+alumno.id_alumno+")'><i class='material-icons'>delete_sweep</i></a>"+
        " <a class='btn-floating btn-small waves-effect waves-light  teal darken-3' onclick='manejarCuotas("+JSON.stringify(alumno)+")'><i class='material-icons'>monetization_on</i></a>";
        noLista++;
        fila.insertCell().textContent = noLista;
        fila.insertCell().textContent = alumno.apellido_paterno;
        fila.insertCell().textContent = alumno.apellido_materno;
        fila.insertCell().textContent = alumno.primer_nombre;
        fila.insertCell().textContent = alumno.segundo_nombre;
        fila.insertCell().textContent = alumno.nombre_tutor;
        fila.insertCell().textContent = alumno.telefono;
        fila.insertCell().innerHTML = acciones;
      })
      noAlumnos.innerHTML = alumnos.length;
      ocultarCargando();
    }else{
      noEncontrados.style.cssText = "display: block";
      tablaAlumnos.style.cssText = "display: none";
      noAlumnos.innerHTML = "";
      gradoGrupo.innerHTML = "";
      gradoGrupo.style.cssText = "display: none;";
      ocultarCargando();
    }
  }

  const editarAlumno = (alumno) => {
    document.querySelector("#id-alumno").value = alumno.id_alumno;
    abrirModalAgregar('Editar');
    let labeles = document.querySelectorAll('.label');
    labeles.forEach(label => {
      label.classList.add('active');
    });
    nombre.value = alumno.primer_nombre;
    segundoNombre.value = alumno.segundo_nombre;
    apellidoPaterno.value = alumno.apellido_paterno;
    apellidoMaterno.value = alumno.apellido_materno;
    nombreTutor.value = alumno.nombre_tutor;
    telefonoTutor.value = alumno.telefono;
  }

  const manejarCuotas =  (alumno) => {
    const elem = document.getElementById('modalCuotas');
    const instance = M.Modal.init(elem, {dismissible: false});
    instance.open();
    dibujarTablaCuotas(alumno);
  }

  const dibujarTablaCuotas = async (alumno)=>{
    let cuotas = await obtenerCuotas(alumno.id_alumno);
    let tabla = document.querySelector("#tabla-cuotas");
    let cuerpoCuotas = document.querySelector("#cuotas-pagos")
    let body = document.createElement('tbody');
    cuerpoCuotas.remove();
    body.id= 'cuotas-pagos';
    tabla.appendChild(body);
    cuerpoTabla = document.querySelector('#cuotas-pagos');
    document.querySelector("#lbl-nombre-alumno").innerText = alumno.primer_nombre + " " + alumno.segundo_nombre + " " + alumno.apellido_paterno + " " + alumno.apellido_materno;
          
    cuotas.forEach(cuota => {
      let checkboxPago = "<p>"+
        "<label>"+
        "  <input type='checkbox' id='check-"+cuota.id_cuota+"' class='filled-in' onclick='marcarPago("+JSON.stringify(alumno)+","+cuota.id_cuota+","+cuota.precio+")' />"+
        "  <span></span>"+
        "</label>"+
      "</p>";
      let fila = cuerpoTabla.insertRow();
      fila.insertCell().innerHTML = checkboxPago;
      fila.insertCell().textContent = cuota.nombre_cuota;
      fila.insertCell().textContent = cuota.descripcion;
      fila.insertCell().textContent = cuota.precio;
      fila.insertCell().textContent = cuota.fecha_vecimiento;
      let check = document.querySelector("#check-"+cuota.id_cuota);
      check.checked = cuota.pagada;
      if(cuota.pagada) {
        bloquearCheck(cuota.id_cuota);
        fila.style.background = "#c5e1a5";
      }

      if(cuota.vencida && !cuota.pagada) fila.style.background = "#e57373";
      if(alumno.estado === 'BAJA') {
        let elementos = document.querySelectorAll('input[type="checkbox"]');
        for(let i = 0; i < elementos.length; i++){
          elementos[i].disabled = true;
        }
      }
    })

    calcularTotalesPagos();
  };

  const obtenerCuotas = async (idAlumno) => {
    return await post( 
      {
        idGrado: selectGrado.value, 
        idGrupo: selectGrupo.value,
        idAlumno: idAlumno
      }, 
      'cuotas/obtenerPorGrupo'
    );
  }

  const marcarPago = async (alumno, idCuota, total) => {
    let payload = {
      idAlumno: alumno.id_alumno,
      idCuota: idCuota, 
      total: total
    }

    let respuesta = await post(payload, 'cuotas/pagar');
    if(respuesta) {
      M.toast({html: 'Cuota pagada'});
      bloquearCheck(idCuota);
      dibujarTablaCuotas(alumno)
    }
  }

  const bloquearCheck = (id) => {
    let check = document.querySelector("#check-" + id);
    check.disabled = true;
  }

  const calcularTotalesPagos = () => {
    let pagados = 0;
    let total = 0;
    let pendientes = 0;
    let porPagar = 0;
    let rows = document.getElementById("cuotas-pagos").getElementsByTagName("tr");

    for(let i = 0; i < rows.length; i++) {
      let tdCheck = rows[i].getElementsByTagName("td")[0];
      let check = tdCheck.querySelectorAll('.filled-in')[0].checked;
      
      if(check){
        let tdPago = rows[i].getElementsByTagName("td")[3].innerHTML;
        pagados++;
        total = parseFloat(total) + parseFloat(tdPago);
      }
      if(!check){
        let tdPago = rows[i].getElementsByTagName("td")[3].innerHTML;
        pendientes++;
        porPagar = parseFloat(porPagar) + parseFloat(tdPago);
      } 
    }
    document.querySelector("#pagadas").innerText = pagados;
    document.querySelector("#pagado").innerText = total;
    document.querySelector("#pendientes").innerText = pendientes;
    document.querySelector("#por-pagar").innerText = porPagar;
  }

  const abrirModalAgregar = (tipo) => {
    if(tipo === "Agregar"){
      if(selectGrado.value === "" || selectGrupo.value === ""){
        M.toast({html: 'Selecciona el grado y grupo para poder agregar'});
        return;
      }
    }
    labelModalAlumno.innerHTML = tipo;
    const elem = document.getElementById('modalAgregarAlumno');
    const instance = M.Modal.init(elem, {dismissible: false});
    instance.open();
  }

  const cancelarRegistrar = () => {
    nombre.value = "";
    segundoNombre.value = "";
    apellidoPaterno.value = "";
    apellidoMaterno.value = "";
    nombreTutor.value = "";
    telefonoTutor.value = "";
    cerrarModal('modalAgregarAlumno');
  }

  const eliminarAlumno = (id) => {
    Swal.fire({
      title: '¿Seguro de dar de baja?',
      text: "El alumno será dado de baja, podrá eliminarlo en el apartado alumnos baja",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Sí, dar de baja'
    }).then(async (result) => {
      if (result.isConfirmed) {
        let eliminado = await post({ idAlumno: id }, 'alumnos/darBaja');
        if(eliminado){
          Swal.fire(
            'Correcto',
            'El alumno ha sido dado de baja.',
            'success'
          )
          dibujarTablaAlumnos({idGrado: selectGrado.value,idGrupo: selectGrupo.value});  
        }
      }
    })
  }

  const obtenerGrados = async ()=>{
    let tabla =  document.querySelector("#tabla-grados");
    let fila = "";
    let grados = await getGrados();
    grados.forEach(grado=>{
        fila += "<tr>"+
        "<td>"+grado.nombre_grado+"</td>"+
        "</tr>";
    })

    tabla.innerHTML = fila
  }

  const obtenerGrupos = async () => {
    let tabla =  document.querySelector("#tabla-grupos");
    let filas = "";
    
    let grupos = await getGrupos();
    grupos.forEach(grupo => {
      filas += "<tr>"+
          "<td>"+grupo.nombre_grupo+"</td>"+
          "</tr>";
    })
    tabla.innerHTML = filas
  }

  const agregarGrado = async () => {
    let nombre = document.querySelector("#nombre_grado");
    if(nombre.value === ""){
      M.toast({html: 'Coloca el grado a registrar'});
      return;
    }
    let respuesta = await post( { nombreGrado: nombre.value }, 'alumnos/registrarGrado' );
    if(respuesta === 'EXISTE'){
      M.toast({html: 'El grado ya existe, selecciona otro'});
      return;
    }
    if(respuesta){
      
      nombre.value = "";  
      obtenerGrados();
      llenarSelectGrados();
      M.toast({html: 'Grado registrado!'});
    }
  }
        
  const agregarGrupo = async () => {
    let nombre = document.querySelector("#nombre_grupo");
    if(nombre.value === ""){
      M.toast({html: 'Coloca el grupo a registrar'});
      return;
    }
    let respuesta = await post({ nombreGrupo: nombre.value }, 'alumnos/registrarGrupo');
    if(respuesta === 'EXISTE'){
      M.toast({html: 'El grupo ya existe, selecciona otro'});
      return;
    }
    if(respuesta) {
       
        nombre.value = "";
        obtenerGrupos();
        llenarSelectGrupos();
        M.toast({html: 'Grupo registrado!'});
    }
  }

  abrirDadosBaja = () => {
    const elem = document.getElementById('modalBajas');
    const instance = M.Modal.init(elem, {dismissible: false});
    instance.open();
    dadosBaja();
  }

  const dadosBaja =  async () => {
    let alumnos = await get('alumnos/dadosBaja');
    let cuerpoTabla = document.querySelector("#alumnos-baja")
    cuerpoTabla.remove();
    let body = document.createElement('tbody');
    body.id= 'alumnos-baja';
    document.querySelector("#tabla-bajas").appendChild(body);
    cuerpoTabla = document.querySelector('#alumnos-baja');
    alumnos.forEach(alumno => {
      let fila = cuerpoTabla.insertRow();
      fila.insertCell().textContent = alumno.grupo;
      fila.insertCell().textContent = alumno.apellido_paterno;
      fila.insertCell().textContent = alumno.apellido_materno;
      fila.insertCell().textContent = alumno.primer_nombre;
      fila.insertCell().textContent = alumno.segundo_nombre;
      fila.insertCell().textContent = alumno.nombre_tutor;
      fila.insertCell().textContent = alumno.telefono;
    })
  }
  mostrarCargando();
  setTimeout(() => {          
    llenarSelectGrados();
    llenarSelectGrupos();
    obtenerGrupos();
    obtenerGrados();
    ocultarCargando();
  }, 1000);

        
  $('input').on('keyup', function(){
    this.value = this.value.toUpperCase();
  })
</script>
<style>
  .contenedorTabla {
    display: flex;
    justify-content: center;
  }
  
  input { 
    text-transform: uppercase;
  }
</style>