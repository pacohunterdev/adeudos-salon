<div class="contenedor">
    <div class="row">
        <?php foreach($totalesGenerales as $item): ?>
            <div class="col s12 m6 l4 center-align white-text ">
                <div class="card-panel hoverable <?php echo $item['color'];?>">
                    <div class="row valign-wrapper">
                        <div class="col s12 l5 ">
                            <img class="responsive-img" src="<?php echo $item['imagen'];?>" alt="" width="100">
                        </div>
                        <div class="col s12 l7">
                            <h4 >
                                <strong><?php echo $item['titulo'];?></strong>
                            </h4>
                            <h1 ><?php echo $item['total'];?></h1>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach;?>
    </div>

    <div class="row">
        <?php foreach($totalesGrupos as $grupo): ?>
            <div class="col s12 m5 l3 center-align">
                <div class="card-panel">
                    <h5><strong><?php echo $grupo->seleccion;?></strong></h5>
                    <p style="margin: 20px;">
                        <strong>
                            <span class="deep-purple darken-4 white-text total">
                               Activos: <?php echo $grupo->activos ?? 0;?>
                            </span>
                        </strong>
                    </p>
                    <p style="margin: 20px;">
                        <strong>
                            <span class=" pink darken-4 white-text total">
                                Bajas: <?php echo $grupo->bajas ?? 0;?>
                            </span>
                        </strong>
                    </p>
                    <p style="margin: 20px;">
                        <strong>
                            <span class="teal darken-4 white-text total">
                                Pagos: $<?php echo $grupo->pagos ?? 0;?>
                            </span>
                        </strong>
                    </p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="card-panel center-align">
        <h3>Pagos X Alumnos</h3>
        <div id="contenedor-alumnos">
            <canvas id="grafica-alumnos"></canvas>
        </div>
    </div>

    <div class="row">
        <div class="col s12 m6 l6">
            <div class="card-panel center-align">
                <h3>Pagos X Cuotas</h3>
                <div id="contenedor-cuotas">
                    <canvas id="grafica-cuotas"></canvas>
                </div>
            </div>
        </div>
        <div class="col s12 m6 l6">
            <div class="card-panel center-align">
                <h3>Pagos X Grupos</h3>
                <div id="contenedor-grupos">
                    <canvas id="grafica-grupos"></canvas>
                </div>
            </div>
        </div>
    </div>

    <?php $this->load->view('cargando'); ?>


    <!-Presentación en tabla nomóas por si las moscas-->
    <!--table>
        <tr>
            <th>Grupo: </th>
            <?php foreach($totalesGrupos as $grupo): ?>
                <td><?php echo $grupo->seleccion;?></td>
            <?php endforeach; ?>
        </tr>
        <tr>
            <th>Activos: </th>
            <?php foreach($totalesGrupos as $grupo): ?>
                <td><?php echo $grupo->activos ?? 0;?></td>
            <?php endforeach; ?>
        </tr>
        <tr>
            <th>Bajas: </th>
            <?php foreach($totalesGrupos as $grupo): ?>
                <td><?php echo $grupo->bajas ?? 0;?></td>
            <?php endforeach; ?>
        </tr>
        <tr>
            <th>Pagos: </th>
            <?php foreach($totalesGrupos as $grupo): ?>
                <td><?php echo $grupo->pagos ?? 0;?></td>
            <?php endforeach; ?>
        </tr>
    </table-->


</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.0.0/chart.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/utiles.js"></script>
<script>
    
    const crearGraficaAlumnos = async() => {
        let totales = await get('inicio/pagosAlumnos');
        generarGrafica('bar', totales, "#contenedor-alumnos", "#grafica-alumnos", "grafica-alumnos")
    }
    
    const crearGraficaCuotas = async() => {
        let totales = await get('inicio/pagosCuotas');
        generarGrafica('pie', totales, "#contenedor-cuotas", "#grafica-cuotas", "grafica-cuotas")
    }
    
    const crearGraficaGrupos = async() => {
        let totales = await get('inicio/pagosPorGrupo');
        generarGrafica('line', totales, "#contenedor-grupos", "#grafica-grupos", "grafica-grupos")
    }

    mostrarCargando();
    setTimeout(() => {
        crearGraficaAlumnos();
        crearGraficaCuotas();
        crearGraficaGrupos();
        
        ocultarCargando(); 
    }, 2000);
    
</script>
<style>
    .card-panel {
        border: 1px solid #311b92;
        border-radius: 20px;
    }

</style>