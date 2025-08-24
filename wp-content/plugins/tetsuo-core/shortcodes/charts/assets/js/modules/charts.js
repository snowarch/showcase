(function($) {
	'use strict';
	
	var charts = {};
	edgtf.modules.charts = charts;

    charts.edgtfCharts = edgtfCharts;

    charts.edgtfOnWindowLoad = edgtfOnWindowLoad;

    $(window).on('load', edgtfOnWindowLoad);

	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgtfOnWindowLoad() {
        edgtfCharts();
	}

    // init charts shortcode
    function edgtfCharts() {
        var chartHolder = $('.edgtf-charts');

        if (chartHolder.length) {
            chartHolder.each(function () {
                var thisChartHolder = $(this);
                var thisChartCanvasId = thisChartHolder.find('canvas').attr('id');

                thisChartHolder.height(thisChartHolder.width() / 2);

                //////////////////////////////////////////////////////////////////////////////
                // prep vars from data atts

                var chartType = thisChartHolder.data('type');
                var chartSkin = thisChartHolder.data('skin');
                var noOfDatasets = thisChartHolder.data('no_of_used_datasets');
                var pointGroupLabels = thisChartHolder.data('point_group_labels');
                var colorScheme = '';
                var legendPosition = thisChartHolder.data('legend_position');
                var startAtZero = '';
                var radarScale = '';
                var polarScale = '';
                var pointLabels = {
                    fontColor: 'white', // labels around the edge like 'Running'
                    fontSize: 18,
                    fontFamily: 'Rajdhani,sans-serif'
                };

                if (chartType == 'line' || chartType == 'horizontalBar' || chartType == 'bar') {
                    startAtZero = {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                fontColor: 'white' // labels such as 10, 20, etc
                            },
                            gridLines: {
                                color: '#562512'
                            },
                            angleLines: {
                                color: '#562512' // lines radiating from the center
                            },
                            pointLabels: pointLabels
                        }],
                        xAxes: [{
                            ticks: {
                                beginAtZero: true,
                                fontColor: 'white' // labels such as 10, 20, etc
                            },
                            gridLines: {
                                color: '#562512'
                            },
                            angleLines: {
                                color: '#562512' // lines radiating from the center
                            },
                            pointLabels: pointLabels
                        }]
                    };
                }

                if (chartType == 'radar') {
                    radarScale = {
                        ticks: {
                            display: false,
                            //beginAtZero: true,
                            fontColor: 'white', // labels such as 10, 20, etc
                            showLabelBackdrop: false, // hide square behind text
                            stepSize: 2
                        },
                        pointLabels: pointLabels,
                        gridLines: {
                            color: '#562512'
                        },
                        angleLines: {
                            color: '#562512' // lines radiating from the center
                        }
                    };
                }

                if (chartType == 'polarArea') {
                    polarScale = {
                        ticks: {
                            display: false,
                            //beginAtZero: true,
                            fontColor: 'white', // labels such as 10, 20, etc
                            showLabelBackdrop: false // hide square behind text
                        },
                        pointLabels: pointLabels,
                        gridLines: {
                            color: '#562512'
                        },
                        angleLines: {
                            color: '#562512' // lines radiating from the center
                        }
                    };
                }

                //////////////////////////////////////////////////////////////////////////////

                var pointGroupColors = '',
                    dataset_1,
                    dataset_1_color,
                    dataset_2,
                    dataset_2_color,
                    dataset_3,
                    dataset_3_color,
                    datasets;

                if (thisChartHolder.data('color_scheme') == 'dataset') {
                    dataset_1_color = thisChartHolder.data('dataset_1_color');
                }
                else {
                    dataset_1_color = thisChartHolder.data('point_group_colors').split(',');
                }

                dataset_1 = {
                    label: thisChartHolder.data('dataset_1_label'),
                    backgroundColor: dataset_1_color,
                    pointRadius: 0,
                    data: thisChartHolder.data('dataset_1').split(','),
                    cubicInterpolationMode: 'monotone'
                };

                datasets = [dataset_1];

                if (noOfDatasets >= 2) {
                    if (thisChartHolder.data('color_scheme') == 'dataset') {
                        dataset_2_color = thisChartHolder.data('dataset_2_color');
                    }
                    else {
                        dataset_2_color = thisChartHolder.data('point_group_colors').split(',');
                    }

                    dataset_2 = {
                        label: thisChartHolder.data('dataset_2_label'),
                        backgroundColor: dataset_2_color,
                        pointRadius: 0,
                        data: thisChartHolder.data('dataset_2').split(','),
                        cubicInterpolationMode: 'monotone'
                    };

                    datasets = [dataset_1, dataset_2];
                }

                if (noOfDatasets >= 3) {
                    if (thisChartHolder.data('color_scheme') == 'dataset') {
                        dataset_3_color = thisChartHolder.data('dataset_3_color');
                    }
                    else {
                        dataset_3_color = thisChartHolder.data('point_group_colors').split(',');
                    }

                    dataset_3 = {
                        label: thisChartHolder.data('dataset_3_label'),
                        backgroundColor: dataset_3_color,
                        pointRadius: 0,
                        data: thisChartHolder.data('dataset_3').split(','),
                        cubicInterpolationMode: 'monotone'
                    };

                    datasets = [dataset_1, dataset_2, dataset_3];
                }

                // there is probably better way of doing init than the following one
                var thisChartParams = {
                    labels: pointGroupLabels.split(','),
                    datasets: datasets
                };

                //////////////////////////////////////////////////////////////////////////////

                var ctx = document.getElementById(thisChartCanvasId).getContext('2d');

                var options = {
                    responsive: true,
                    legend: {
                        position: legendPosition,
                        labels: {
                            fontColor: 'white',
                            width: 28,
                            fontSize: 20,
                            fontFamily: 'Roboto Condensed,sans-serif'
                        }
                    }
                };

                options.scales = startAtZero;
                if (chartType == 'radar') {
                    options.scale = radarScale;
                }
                if (chartType == 'polarArea') {
                    options.scale = polarScale;
                }

                if (chartSkin == 'dark' ) {
                    pointLabels.fontColor = '#111111';
                    options.legend.labels.fontColor = '#111111';
                    if(options.scales.yAxes !== undefined && options.scales.xAxes !== undefined) {
                        options.scales.yAxes[0].gridLines.color = '#f4b79f';
                        options.scales.xAxes[0].gridLines.color = '#f4b79f';
                        options.scales.yAxes[0].angleLines.color = '#f4b79f';
                        options.scales.xAxes[0].angleLines.color = '#f4b79f';
                        options.scales.yAxes[0].ticks.fontColor = '#111';
                        options.scales.xAxes[0].ticks.fontColor = '#111';
                    }

                    if(options.scale !== undefined) {
                        options.scale.gridLines.color = '#f4b79f';
                        options.scale.angleLines.color = '#f4b79f';
                        options.scale.ticks.fontColor = '#111';
                    }
                }

                thisChartHolder.appear(function () {
                    thisChartHolder.addClass('edgtf-appeared');

                    setTimeout(function () {

                        window.myBar = new Chart(ctx, {
                            type: chartType,
                            data: thisChartParams,
                            options: options
                        });

                    }, 500);
                }, {accX: 0, accY: edgtfGlobalVars.vars.edgtfElementAppearAmount});


            });
        }
    }
	
})(jQuery);