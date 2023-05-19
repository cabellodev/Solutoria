<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Tarea</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
	<link href="<?php echo base_url(); ?>assets/css/authenticate.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/base/jquery-ui.min.css" integrity="sha512-ELV+xyi8IhEApPS/pSj66+Jiw+sOT1Mqkzlh8ExXihe4zfqbWkxPRi8wptXIO9g73FSlhmquFlUOuMSoXz5IRw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script>
    const host_url = "<?php echo base_url(); ?>";
    
  </script>
</head>
<body>
<div class="card mb-3">
      <div class="card-header">
        <i class="fas fa-table"></i>
        Lista de registros 
        <button class="btn btn-success float-right" type='button' id="create"><i class="fas fa-plus"></i> Crear registro</button>
        <button class="btn btn-info float-right" type='button' id="charts"><i class="fas fa-plus"></i> Gráficos de datos</button>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="table-indicadores" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Nombre</th>
                <th>Código</th>
                <th>UnidadMedida</th>
                <th>Valor</th>
                <th>Fecha</th>
                <th>Tiempo</th>
                <th>Origen</th>
                <th>Editar</th>
                <th>Eliminar</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>


    <div class="modal fade" id="modal-data" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="title-modal">Crear registro</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
        <input class="form-control mb-2"  id="name" type="text" placeholder="Nombre" aria-label="default input example">
        <input class="form-control mb-2"  id="code" type="text" placeholder="Código" aria-label="default input example">
        <input class="form-control mb-2"  id="measure" type="text" placeholder="Unidad de medida" aria-label="default input example">
        <input class="form-control mb-2"  id="value" type="text" placeholder="Valor" aria-label="default input example">
        <input class="form-control mb-2"  id="date" type="text" placeholder="Fecha" aria-label="default input example">
        <input class="form-control mb-2"  id="time" type="text" placeholder="Tiempo" aria-label="default input example">
        <input class="form-control mb-2"  id="origin" type="text" placeholder="Origen" aria-label="default input example">
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" id="btn-create-modal" class="btn btn-primary">Crear</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-charts" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="title-modal">Módulo de gráficos</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
      <div class="row g-3 align-items-center">

            <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                Intrucciones
            </button>
            <div class="collapse" id="collapseExample">
              <div class="card card-body">
                Elige una fecha de inicio y una fecha limite para poder generar el correspondiente gráfico
              </div>
            </div>
            <div class="col-lg-6 col-md-3 col-sm-6">
              <input type="text" id="from" class="form-control" placeholder="Desde">
            </div>
            <div class="col-lg-6 col-md-3 col-sm-6">
              <input type="text" id="to" class="form-control" placeholder="Hasta">
            </div>
            <button class="btn btn-danger" id="generate_chart" type="button" >
                Generar
            </button>

            <div class="col-lg-12 col-md-12 col-sm-12">
              <canvas id="chart1"></canvas>
           </div>
      </div>
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" id="btn-create-modal" class="btn btn-primary">Crear</button>
      </div>
    </div>
  </div>
</div>


</body>
</html>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js" integrity="sha512-57oZ/vW8ANMjR/KQ6Be9v/+/h6bq9/l3f0Oc7vn6qMqyhvPd1cvKBRWWpzu0QoneImqr2SkmO4MSqU+RpHom3Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="<?php echo base_url(); ?>assets/js/crud.js"></script>
<script src="<?php echo base_url(); ?>assets/js/charts.js"></script>
