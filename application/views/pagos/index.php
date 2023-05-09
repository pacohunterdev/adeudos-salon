<div class="" id="index-banner">
    <?php $this->load->view('cargando'); ?>
    <div class="contenedor">
      <h1 class="header center deep-purple-text darken-4">
        <span id="no-pagos"></span>
         Pagos
         <span class="deep-purple darken-4 white-text total" id="total-pagos"></span>
      </h1>
      <h3 class="center" id="lbl-filtros"></h3>

    <div class="row">
        <div class="col s12 m6 l3">
            <h4>
                Pagos X Cuota
            </h4>
            <div class="card  deep-purple lighten-5">
                <table id="tabla-x-cuotas">
                    <thead>
                        <th>Cuota</th>
                        <th>Total</th>
                    </thead>
                    <tbody id="x-cuotas"></tbody>
                </table>
            </div>

            <h4>Pagos X Grupos</h4>
            <div class="card  deep-purple lighten-5">
                <table id="tabla-x-grupos">
                    <thead>
                        <th>Grupo</th>
                        <th>Total</th>
                    </thead>
                    <tbody id="x-grupos"></tbody>
                </table>
            </div>
        </div>
        <div class="col s12 m6 l9">
            <button class="waves-effect waves-light btn  indigo darken-4" id="btn-filtrar" >
                <i class="material-icons left">filter_list</i>
                Filtrar
            </button>
            
            <div class="card-panel" style="display: none;" id="panel-filtrar">
                <h6>BUSCAR POR GRADO Y GRUPO</h6>
                <?php $this->load->view('alumnos/select'); ?>
                <h6>BUSCAR EN FECHA</h6>
                <div class="row">
                    <div class="col s12 m6 l4">
                    <label>Del</label>
                        <input type="date" id="fecha-inicio">
                    </div>
                    <div class="col s12 m6 l4">
                    <label>Al</label>
                        <input type="date" id="fecha-fin">
                    </div>
                    <div class="col s12 m6 l4">
                    <br>
                    <button class="waves-effect waves-light btn deep-purple darken-4" id="btn-x-fecha" >
                    <i class="material-icons left">search</i>
                    Buscar
                    </button>
                    
                    </div>
                </div>
            </div>
            <br>
            <table class="responsive-table" id="tabla-pagos">
                <thead>
                    <th>Alumno</th>
                    <th>Grupo</th>
                    <th>Cuota</th>
                    <th>Pago</th>
                    <th>Fecha pago</th>
                    <th>Acciones</th>
                </thead>
                <tbody id="cuerpo-tabla">
                </tbody>
            </table>
            <div class="col-md-12 center text-center">
                <span class="left" id="total_reg"></span>
                <ul class="pagination pager" id="myPager"></ul>
            </div>
        </div>
    </div>

    <div id="modalPagosAlumno" class="modal modal-fixed-footer">
        <div class="modal-content">
            <h4>Pagos de <span id="lbl-nombre-alumno"></span></h4>
            <h5>
                <strong> 
                    Total: $ <span id="lbl-total-alumno"></span>
                </strong>
            </h5>
            <table id="tabla-pagos-alumno">
                <thead>
                    <th>Cuota</th>
                    <th>Fecha pagado</th>
                    <th>Fecha vencimiento</th>
                    <th>Pago</th>
                </thead>
                <tbody id="cuerpo-pagos-alumnos"></tbody>
            </table>
            </div>
            <div class="modal-footer">
            <a onclick="cerrarModal('modalPagosAlumno')"class="modal-close waves-effect waves-green btn deep-purple darken-4">Cerrar</a>
        </div>
    </div>|
</div>
<script src="<?php echo base_url()?>assets/js/pagination.js"></script>

<script>
    var mostrarFiltrar = false;
    const tablaCuotas = document.querySelector("#tabla-pagos");
    const tablaXCuotas = document.querySelector("#tabla-x-cuotas");
    const tablaXGrupos = document.querySelector("#tabla-x-grupos");
    const tablaPagosAlumnos = document.querySelector("#tabla-pagos-alumno");
    const selectGrado = document.querySelector("#select-grado");
    const selectGrupo = document.querySelector("#select-grupo");
    const btnFiltrar = document.querySelector("#btn-filtrar");
    const btnXFecha = document.querySelector("#btn-x-fecha");
    const btnXGrupo = document.querySelector("#boton-buscar");
    const fechaInicio = document.querySelector("#fecha-inicio");
    const fechaFin = document.querySelector("#fecha-fin");
    const grado = document.querySelector("#select-grado");
    const grupo = document.querySelector("#select-grupo");
    const lblFiltros = document.querySelector("#lbl-filtros");

    btnFiltrar.onclick = () => {
        mostrarFiltrar = !mostrarFiltrar;
        let estilo = (mostrarFiltrar) ? 'display: block;' : 'display: none';
        document.querySelector("#panel-filtrar").style.cssText = estilo;
        if(!mostrarFiltrar) {
            mostrarCargando();
            obtener();
            obtenerPorCuota();
            obtenerPorGrupos();
            lblFiltros.innerText = "Filtros: HOY";
            ocultarCargando();
        }
    }

    btnXFecha.onclick= () => {
        if(fechaInicio.value === "" || fechaFin.value === ""){
            M.toast({html: 'Selecciona la fecha de inicio y de fin'});
            return;
        }
        mostrarCargando();
        let filtro = {
            fecha: {
                inicio: fechaInicio.value,
                fin: fechaFin.value
            }
        };

        obtener(filtro);
        obtenerPorCuota(filtro);
        obtenerPorGrupos(filtro);
        grado.value = "";
        grupo.value = "";
        lblFiltros.innerText = "Filtros: Del " + fechaInicio.value +
        " al " + fechaFin.value;
        ocultarCargando();
    }

    btnXGrupo.onclick= () => {
        if(grado.value === "" || grupo.value === ""){
            M.toast({html: 'Selecciona el grado y grupo'});
            return;
        }
        mostrarCargando();
        let filtro = {
            grupo: {
                grado: grado.value,
                grupo: grupo.value
            }
        };

        obtener(filtro);
        obtenerPorCuota(filtro);
        obtenerPorGrupos(filtro);
        fechaInicio.value = "";
        fechaFin.value = "";
        lblFiltros.innerText = "Filtro: " + grado.options[selectGrado.selectedIndex].text +"° "+
            grupo.options[selectGrupo.selectedIndex].text;
        ocultarCargando();
    }

    const obtener = async(filtros = null) => {
        let pagos = await post({filtros: filtros }, 'pagos/obtener');
        let cuerpoTablaCuotas = document.querySelector("#cuerpo-tabla")
        let body = document.createElement('tbody');
        cuerpoTablaCuotas.remove();
        body.id= 'cuerpo-tabla';
        tablaCuotas.appendChild(body);
        cuerpoTabla = document.querySelector('#cuerpo-tabla');
        pagos.forEach(pago => {
          let fila = cuerpoTabla.insertRow();
          let acciones = "<a class='btn-flat waves-effect waves-purple  purple-text' onclick='verPagos("+JSON.stringify(pago)+")'><i class='material-icons left'>info</i>Ver pagos</a>";
          fila.insertCell().textContent = pago.alumno;
          fila.insertCell().textContent = pago.grupo;
          fila.insertCell().textContent = pago.cuota;
          fila.insertCell().textContent = pago.precio;
          fila.insertCell().textContent = pago.fecha_pago;
          fila.insertCell().innerHTML = acciones;
        })
        let total = calcularTotalesPagos(pagos)
        document.querySelector("#total-pagos").innerText = "$" + total;
        document.querySelector("#no-pagos").innerText = pagos.length;
        ponerPaginacion('tabla-pagos');
    }

    const verPagos = async (pago) => {
        let pagos = await post({ idAlumno: pago.id_alumno }, 'pagos/porAlumno');
        const elem = document.getElementById('modalPagosAlumno');
        const instance = M.Modal.init(elem, {dismissible: false});
        instance.open();
        document.querySelector("#lbl-nombre-alumno").innerText = pago.alumno

        let cuerpoTablaAlumno = document.querySelector("#cuerpo-pagos-alumnos");
        cuerpoTablaAlumno.remove();
        let body = document.createElement('tbody');
        body.id= 'cuerpo-pagos-alumnos';
        tablaPagosAlumnos.appendChild(body);
        cuerpoTabla = document.querySelector('#cuerpo-pagos-alumnos');
        pagos.forEach(pago => {
          let fila = cuerpoTabla.insertRow();
          fila.insertCell().textContent = pago.cuota;
          fila.insertCell().textContent = pago.fecha_pago;
          fila.insertCell().textContent = pago.fecha_vecimiento;
          fila.insertCell().textContent = pago.precio;
        })
        let total = calcularTotalesPagos(pagos);
        document.querySelector("#lbl-total-alumno").innerText = total;
    }

    const obtenerPorCuota = async (filtros = null) => {
        let pagos = await post({filtros: filtros }, 'pagos/porCuotas');
        let cuerpoTablaPagos = document.querySelector("#x-cuotas")
        cuerpoTablaPagos.remove();
        let body = document.createElement('tbody');
        body.id= 'x-cuotas';
        tablaXCuotas.appendChild(body);
        cuerpoTabla = document.querySelector('#x-cuotas');
        pagos.forEach(pago => {
          let fila = cuerpoTabla.insertRow();
          fila.insertCell().textContent = pago.nombre_cuota;
          fila.insertCell().innerHTML = '<span class="new badge deep-purple darken-4" data-badge-caption="$'+pago.total+'"></span>';
        })
    }
    
    const obtenerPorGrupos = async (filtros = null) => {
        let pagos = await post({filtros: filtros }, 'pagos/porGrupos');
        let cuerpoTablaPagos = document.querySelector("#x-grupos")
        cuerpoTablaPagos.remove();
        let body = document.createElement('tbody');
        body.id= 'x-grupos';
        tablaXGrupos.appendChild(body);
        cuerpoTabla = document.querySelector('#x-grupos');
        pagos.forEach(pago => {
          let fila = cuerpoTabla.insertRow();
          fila.insertCell().textContent = pago.grupo;
          fila.insertCell().innerHTML ='<span class="new badge deep-purple darken-4" data-badge-caption="$'+pago.total+'"></span>';
        })
    }

    const calcularTotalesPagos = (arreglo) => {
        return arreglo.reduce((acumulador, objeto) => {
            return acumulador + parseFloat(objeto['precio']);
        }, 0);
    }


    lblFiltros.innerText = "Filtros: HOY";
    mostrarCargando();
    setTimeout(() => {
        obtener();
        obtenerPorCuota();
        obtenerPorGrupos();
        llenarSelectGrados();
        llenarSelectGrupos();
        ocultarCargando();
    }, 1000);

</script>
