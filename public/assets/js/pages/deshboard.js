var meta_diaria = 10;
var meta_semanal = 50;
$(document).ready(function() {
	console.log(' -> init deshboard.js');
});

$("#gfm_d").ready(function() {
	diario = $("#vm_d").val();
	value = (diario / meta_diaria) * 100;
	grafico_ponteiro('gfm_d', diario);
});


function grafico_ponteiro(id, value){
	var echartGauge = echarts.init(document.getElementById(id), 'minimal');
	echartGauge.setOption({
		tooltip: {
			formatter: "{a} <br/>{b} : {c}%"
		},
		toolbox: {
			show: true,
			feature: {
				restore: {
					show: true,
					title: "Restore"
				},
				saveAsImage: {
					show: true,
					title: "Save Image"
				}
			}
		},
		series: [{
			name: 'Performance',
			type: 'gauge',
			center: ['50%', '50%'],
			startAngle: 140,
			endAngle: -140,
			min: 0,
			max: 100,
			precision: 0,
			splitNumber: 10,
			axisLine: {
				show: true,
				lineStyle: {
					color: [
					[0.2, '#ff4500'],
					[0.4, 'orange'],
					[0.8, 'skyblue'],
					[1, 'lightgreen']
					],
					width: 30
				}
			},
			axisTick: {
				show: true,
				splitNumber: 5,
				length: 8,
				lineStyle: {
					color: '#eee',
					width: 1,
					type: 'solid'
				}
			},
			axisLabel: {
				show: true,
				formatter: function (v) {
					switch (v + '') {
						case '10':
						return 'd';
						case '30':
						return 'c';
						case '60':
						return 'b';
						case '90':
						return 'a';
						default:
						return '';
					}
				},
				textStyle: {
					color: '#333'
				}
			},
			splitLine: {
				show: true,
				length: 30,
				lineStyle: {
					color: '#eee',
					width: 2,
					type: 'solid'
				}
			},
			pointer: {
				length: '80%',
				width: 8,
				color: 'auto'
			},
			title: {
				show: true,
				offsetCenter: ['-65%', -10],
				textStyle: {
					color: '#333',
					fontSize: 15
				}
			},
			detail: {
				show: true,
				backgroundColor: 'rgba(0,0,0,0)',
				borderWidth: 0,
				borderColor: '#ccc',
				width: 100,
				height: 40,
				offsetCenter: ['-60%', 10],
				formatter: value,
				textStyle: {
					color: 'auto',
					fontSize: 30
				}
			},
			data: [{
				value: value*10,
        // name: 'Performance'
      }]
    }]
  });
}
