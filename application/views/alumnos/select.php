<div class="row">
	<div class="col s12 m6 l4">
    <label>Selecciona el grado</label>
	    <select id="select-grado" class="browser-default">
	    </select>
	</div>
	<div class="col s12 m6 l4">
    <label>Selecciona el grupo</label>
	    <select id="select-grupo" class="browser-default">
	    </select>
	</div>
	<div class="col s12 m6 l4">
    <br>
    <button class="waves-effect waves-light btn deep-purple darken-4" id="boton-buscar" >
    <i class="material-icons left">search</i>
      Buscar
    </button>
    
	</div>
</div>
<script>
  const llenarSelectGrupos = async () => {
    selectGrupo.options.length = 0;
    let grupos = await getGrupos();
    let opcionInicial = document.createElement("option");
    opcionInicial.text = "Seleccione"
    opcionInicial.value = ""
    opcionInicial.selected = true
    selectGrupo.appendChild(opcionInicial)
    grupos.forEach(grupo => {
      let option = document.createElement("option");
      option.text = grupo.nombre_grupo;
      option.value = grupo.id_grupo;
      selectGrupo.appendChild(option);
    });
  }

  const llenarSelectGrados = async ()=>{ 
    selectGrado.options.length = 0;
    let grados = await getGrados();
    let opcionInicial = document.createElement("option");
    opcionInicial.text = "Seleccione"
    opcionInicial.value = ""
    opcionInicial.selected = true
    selectGrado.appendChild(opcionInicial)
    grados.forEach(grado => {
      let option = document.createElement("option");
      option.text = grado.nombre_grado;
      option.value = grado.id_grado;
      selectGrado.appendChild(option);
    });
  }

  const getGrados = async () => {
    return get('alumnos/obtenerGrados');
  }

  const getGrupos = async () => {
    return get('alumnos/obtenerGrupos');
  }
</script>