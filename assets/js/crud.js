($(()=>{
    getData(); 	
}));


let edit = false;
let ID=0;
let register ={};


charge_data=()=>{
    $.ajax({
		type: "GET",
		url: host_url +'api/chargeData',
        crossOrigin: false,
		success: (data) => {
			alert("carga con éxito");
		},
		error: (result) => {
			alert("No se han podido importar la data")
		},
	});
}

getData = () =>{

	$.ajax({
		type: "GET",
		url: host_url + 'api/get',
        crossOrigin: false,
		async:false,
		success: (data) => {
           
			tabla.clear();
			tabla.rows.add(data);
			tabla.draw();
		},
		error: (result) => {
			swal({
				title: "Error",
				icon: "error",
				text: result.msg,
			});
		
		},
	});
}

registerData = () =>{
    
    let url ;
	if(edit){
		url=host_url+`api/update/${ID}`;
	}else{
        url=host_url+`api/create`;	
	}

	register={
			name:$('#name').val(),
			code:$('#code').val(),
			measure:$('#measure').val(),
			value:$('#value').val(),
			date:$('#date').val(),
			time:$('#time').val(),
			origin:$('#origin').val(),
	}

	$.ajax({

		type: "POST",
		data:{register},
		url: url,
        crossOrigin: false,
		success: (result) => {
			swal({
				title: "Éxito",
				icon: "success",
				text: result.msg,
			}).then(() =>{
				 swal.close();
                 getData();
			});
		},
		error: (result) => {
			swal({
				title: "Error",
				icon: "error",
				text: result.responseJSON.msg,
			});
		},
	});

}


deleteData = (id) =>{
	$.ajax({
		type: "DELETE",
		url: host_url+`api/delete/${id}`,
        crossOrigin: false,
		success: (result) => {
			swal({
				title: "Éxito",
				icon: "success",
				text: result.msg,
			}).then(() =>{
				 swal.close();
                 getData();
			});
		},
		error: (result) => {
			swal({
				title: "Error",
				icon: "error",
				text: result.responseJSON.msg,
			});
		},
	});
};




// Tabla de indicadores provenientes de la base de datos 

const tabla = $("#table-indicadores").DataTable({
	// searching: true,
	language: {
		url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
	},
	columnDefs: [
        {className: "text-center", "targets": [2]},
		{className: "text-center", "targets": [3]}
    ],
	columns: [
        
		{data: "nombreIndicador"},
		{data: "codigoIndicador"},
        {data: "unidadMedidaIndicador"},
		{data: "valorIndicador"},
        {data: "fechaIndicador"}, 
        {
		 data: 'tiempoIndicador',
		 defaultContent:'Indefinido',
		 render: function (data, type, row, meta) { if(data){ return data; }
		}
		},
        {data: "origenIndicador"},
		{
			defaultContent: `<button type='button' name='edit' class='btn btn-primary'>
                                    Editar
                                  <i class="fas fa-times"></i>
                              </button>`,
		},
		{
			defaultContent: `<button type='button' name='delete' class='btn btn-danger'>
                                    Eliminar
                                  <i class="fas fa-times"></i>
                              </button>`,
		},
		
	],
});



$("#table-indicadores").on("click", "button", function () {
	let data = tabla.row($(this).parents("tr")).data();
	
	if ($(this)[0].name == "delete") {
		swal({
			title: `Elimnar registro`,
			icon: "warning",
			text: `¿Está seguro/a deseas eliminar el registro: "${data.nombreIndicador}"?`,
			buttons: {
				confirm: {
					text: "Eliminar",
					value: "exec",
				},
				cancel: {
					text: "Cancelar",
					value: "cancelar",
					visible: true,
				},
			},
		}).then((action) => {
			if (action == "exec") {
				deleteData(data.id);
			} else {
				swal.close();
			}
		});
	} else {

		edit=true;
		ID=data.id;
		clean_inputs();
		fill_inputs(data);
		console.log(register);
		$("#modal-data").modal('show');
	}
});

fill_inputs=(data)=>{
	
	$('#name').val(data.nombreIndicador);
	$('#code').val(data.codigoIndicador);
	$('#measure').val(data.unidadMedidaIndicador);
	$('#value').val(data.valorIndicador);
	$('#date').val(data.fechaIndicador);
	$('#time').val(data.tiempoIndicador);
	$('#origin').val(data.origenIndicador);
	
}

clean_inputs=() => {
	$('.form-control').val('');
}

$("#create").on("click",()=>{
	edit =false;
	clean_inputs();
	$("#modal-data").modal('show');}
);

$("#charts").on("click",()=>{
	$("#modal-charts").modal('show');}
);

$("#btn-create-modal").on("click",registerData);









