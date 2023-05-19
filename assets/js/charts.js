
($(()=>{

    data_chart();

    $( "#from").datepicker({
        showOn: "button",
        buttonText: "Calendario",
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yy-mm-dd',
        buttonImage: host_url + 'assets/images/calendario2.png',
    });
    $( "#to").datepicker({
        showOn: "button",
        buttonText: "Calendario",
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yy-mm-dd',
        buttonImage: host_url + 'assets/images/calendario2.png',
    });
}));

let date_from;
let date_to;
let chart;
let data=[];

data_chart = () =>{
	$.ajax({
		type: "GET",
		url: host_url + 'api/get',
        crossOrigin: false,
		async:false,
		success: (result) => {
           data=result;
		},
	});
}


generate_chart =()=>{
    let range =[];
    date_from = $("#from").val();
    date_to=$("#to").val();
    labels= [];
    values =[];
    
    if(date_from !="" && date_to !=""){


            data.forEach(x=>{
                if(x.fechaIndicador >= date_from &&  x.fechaIndicador <= date_to){
                    labels.push(x.id);
                    values.push(x.valorIndicador)
                }
            });

            console.log(labels,values)

            draw_chart(labels,values);

        }else{
            swal({
                title: "Corregir",
                icon: "warning",
                text: "Debe ingresar ambas campos de fecha. Reintente nuevamente",
            });
        }
    
    //aqui se dibuja el charts

}

draw_chart=(labels,values)=>{
  $("#chat1").empty();
  if( values.length !=0){
        const ctx = document.getElementById('chart1');
        if (chart) {chart.destroy();}
        chart= new Chart(ctx, {
            type: 'line',
            data: {
            labels: labels,
            datasets: [{
                label: 'Variación UF en período seleccionado (pesos/registro)',
                data: values,
                borderWidth: 1
            }]
            },
            options: {
            scales: {
                y: {
                    max: 32000,
                    min: 28000
                   
                  },
            }
            }
        });
    }

}


$("#generate_chart").on("click", generate_chart);

    