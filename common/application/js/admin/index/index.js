$(function() {
	$( "#sortable" ).sortable();
    $( "#sortable" ).disableSelection();

    // // Busca o mes atual
    // var mes_atual_tmp = $('#contatos-placeholder').attr('data-mes');
    // var mes_atual = getMonth(mes_atual_tmp);
    // var mes_anterior = getMonth(parseInt(mes_atual_tmp) - 1);
	//
    // // Grafico de contatos
    // var contatos_mes = $.parseJSON($('#contatos-placeholder').attr('data-contatos'));
    // var contatos_anterior = $.parseJSON($('#contatos-placeholder').attr('data-anterior'));
	//
    // // Any of the following formats may be used
    // var ctx = document.getElementById('myChart');
    // var ctx = document.getElementById('myChart').getContext('2d');
    // var ctx = $('#myChart');
    // var ctx = 'myChart';
	//
	//
    // var myChart = new Chart(ctx, {
    //     type: 'line',
    //     data: {
    //         labels: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31],
    //         datasets: [{
    //             label: 'Contatos/Dia',
    //             data: contatos_mes,
    //             backgroundColor: [ 'rgba(60,74,158, 0.2)' ],
    //             borderColor: [ 'rgba(60,74,158, 1)' ],
    //             borderWidth: 2
    //         }]
    //     },
    //     options: {
    //         layout: {
    //             padding: {
    //                 left: 20,
    //                 right: 40,
    //                 top: 0,
    //                 bottom: 20
    //             },
    //         },
    //         responsive: true,
    //         maintainAspectRatio: false,
    //         lineTension: 0,
    //         scales: {
    //             yAxes: [{
    //                 ticks: {
    //                     beginAtZero: true
    //                 },
    //                 gridLines: {
    //                     drawOnChartArea: false, // only want the grid lines for one axis to show up
    //                 },
    //             }]
    //         }
    //     }
    // });
});

function getMonth(mes) {

	var mes_atual = parseInt(mes);

	if(mes_atual == 0) {
		mes_atual = 12;
	}

	if(mes_atual == 13) {
		mes_atual = 1;
	}

	switch(mes_atual) {
		case 1:
			mes_atual = "Janeiro";
			break;
		case 2:
			mes_atual = "Fevereiro";
			break;
		case 3:
			mes_atual = "Março";
			break;
		case 4:
			mes_atual = "Abril";
			break;
		case 5:
			mes_atual = "Maio";
			break;
		case 6:
			mes_atual = "Junho";
			break;
		case 7:
			mes_atual = "Julho";
			break;
		case 8:
			mes_atual = "Agosto";
			break;
		case 9:
			mes_atual = "Setembro";
			break;
		case 10:
			mes_atual = "Outubro";
			break;
		case 11:
			mes_atual = "Novembro";
			break;
		case 12:
			mes_atual = "Dezembro";
			break;
	}

	return mes_atual;
}