@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">{{ucfirst(request()->user()->role)}} Dashboard</div>
        <div class="panel-body">
            <div class="row no-padding">
                <div class="col-md-8">
                    <div id="orders-container" style="min-width: 310px; height: 400px; width:100%; margin: 0 auto"></div>
                </div>
                <div class="col-md-4">
                    <div class="list-group">
                        <a class="list-group-item orders">
                            <h3 class="pull-right">
                                <i class="fa fa-first-order fa-dashboard-home"></i>
                            </h3>
                            <h4 class="list-group-item-heading count">
                                {{$result['orders']->count()}}</h4>
                            <p class="list-group-item-text">
                                Total Orders</p>
                        </a>
                        <a class="list-group-item sold-again">
                            <h3 class="pull-right">
                                <i class="fa fa-usd fa-dashboard-home"></i>
                            </h3>
                            <h4 class="list-group-item-heading count">
                                {{$result['orders']->where('status','=','sold')->count()}}</h4>
                            <p class="list-group-item-text">
                                Sold Again</p>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row no-padding">
                <div class="col-md-4">
                    <div class="list-group">
                        <a class="list-group-item managing-shops">
                            <h3 class="pull-right">
                                <i class="fa fa-shopping-cart fa-dashboard-home"></i>
                            </h3>
                            <h4 class="list-group-item-heading count">
                                {{$result['shops']->count()}}</h4>
                            <p class="list-group-item-text">
                                Managing Shops</p>
                        </a>
                        <a class="list-group-item devices">
                            <h3 class="pull-right">
                                <i class="fa fa-tablet fa-dashboard-home"></i>
                            </h3>
                            <h4 class="list-group-item-heading count">
                                {{$result['devices']->count()}}</h4>
                            <p class="list-group-item-text">
                                Total Devices</p>
                        </a>
                    </div>
                </div>
                <div class="col-md-8">
                    <div id="devices-container" style="min-width: 310px; height: 400px; width:100%; margin: 0 auto"></div>
                </div>
            </div>
            <div class="row no-padding">
                <div class="col-md-12">
                    <div id="conditions-container" style="min-width: 310px; height: 400px; width:100%; margin: 0 auto"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script>
        console.log();
        $(document).ready(function () {
            Highcharts.chart('orders-container', {
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                title: {
                    text: 'Orders by Status'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                            style: {
                                color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                            }
                        }
                    }
                },
                series: [{
                    name: 'Percentage',
                    colorByPoint: true,
                    data: {!! $result['counted_orders'] !!}
                }]
            });
            Highcharts.chart('devices-container', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Devices by condition'
                },
                xAxis: {
                    categories: {!! $result['available_conditions'] !!}
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Total number of devices'
                    }
                },
                tooltip: {
                    pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> ({point.percentage:.0f}%)<br/>',
                    shared: true
                },
                plotOptions: {
                    column: {
                        stacking: 'percent'
                    }
                },
                series: {!! $result['devices_by_condition'] !!}
            });

            Highcharts.chart('conditions-container', {

                chart: {
                    type: 'column'
                },

                title: {
                    text: 'Each total of conditions for each  device based on EAN'
                },

                legend: {
                    align: 'right',
                    verticalAlign: 'middle',
                    layout: 'vertical'
                },

                xAxis: {
                    categories: {!! $result['available_ean'] !!},
                    labels: {
                        x: -10
                    }
                },

                yAxis: {
                    allowDecimals: false,
                    title: {
                        text: 'Number'
                    }
                },

                series: {!! $result['devices_by_condition_total'] !!}
            });

        });




    </script>
@endsection