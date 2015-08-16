Highcharts.theme = {
	colors: ['#007dc3', '#74a4d8', '#99c124'],
	
	// blues
		// 009999
		// 1d4e7c
		// 0b72b5
		// 00a0c6

	// dark blues
		// 

	// medium blues 
 		// 007dc3

	// light blues 
		// 74a4d8
		// 24CBE5

	// orange
		// e65501 // Sodexo
		// FF9655

	// pink
		// f0037f

	// red
		// ff0000

	// purple
		// 983998

	// yellow 
		// FFF263

	// green
		// DDDF00
		// 99c124

	chart: {
		backgroundColor: '#FFFFFF',
		plotShadow: false,
		spacingBottom: 30,
		animation: {
			duration: 500,
		}
		// animation: false,
	},

	title: {
		style: {
			color: '#2294b6',
			font: 'bold 23px "Calibri", Verdana, sans-serif'
		}
	},
	subtitle: {
		style: {
			color: '#666666',
			font: 'bold 12px "Trebuchet MS", Verdana, sans-serif'
		}
	},
	plotOptions: {
		series: {
			borderWidth: 0,
			borderRadius: 0,
			borderColor: 'black',
			plotShadow: false,
			shadow: false,
			fillOpacity: 0.2,
			//stacking: 'normal',

			// Chart and Bars
			groupPadding: 0.2,		// distance between groups of columns
			pointPadding: 0,		// individual distance between columns

			// Line 
			lineWidth: 5,
			marker: {
				fillColor: '#FFFFFF',
				lineWidth: 3,
				radius: 6,
          		lineColor: null,	// inherit from series
          		symbol: 'circle'
			}
		}
	},
	xAxis: {
		gridLineWidth: 0,			// no top to bottom grid lines, default is 0.5
		lineWidth: 0,
		lineColor: '#666',			// the outside border of xAxis
		tickColor: '#e2e2e2',
		offset: 0,				// moves the xAxis down or up (with the bottom line: use y: instead)
		labels: {
			style: {
				color: '#666666',
				font: '13px Arial, Verdana, sans-serif'
			},
			rotation: 0,
			y: 20,					// moves the xAxis down or up
		},
		title: {
			style: {
				color: '#333',
				fontWeight: 'bold',
				fontSize: '12px',
				fontFamily: 'Trebuchet MS, Verdana, sans-serif'
			}
		}
	},
	yAxis: {
		//minorTickInterval: 'auto',
		min: 0,						// does not allow negative values
		gridLineColor: '#e2e2e2',
		lineColor: '#e2e2e2',		// the outside border of yAxis
		lineWidth: 0,
		tickWidth: 0,
		tickColor: '#e2e2e2',	
		offset: 5,		
		labels: {
			formatter: function() {		// yAxis values not capped
				return this.value;
			},			
			style: {
				color: '#666666',		// color of yAxis numbers
				font: '13px Arial, Verdana, sans-serif'
			},
		},
		title: {
			style: {
				color: '#333',
				fontWeight: 'normal',
				fontSize: '15px',
				fontFamily: 'Arial, Verdana, sans-serif'
			}
		},

	},
	legend: {
		backgroundColor: '#FFFFFF',
		symbolWidth: 30,
		borderRadius: 0,
		borderWidth: 0,
		margin: 30,
		itemStyle: {
			font: '14px Arial, Verdana, sans-serif',
			color: '#666666',
			fontWeight: 'normal'
		},
		itemHoverStyle: {
			color: '#039'
		},
		itemHiddenStyle: {
			color: 'gray'
		}
	},
	labels: {
		style: {
			color: '#99b'
		}
	}
};

// Apply the theme
var highchartsOptions = Highcharts.setOptions(Highcharts.theme);