@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row tags-area">
            <div class="col-md-12">
                <div class="card mb-4" style="max-height: 500px;">
                    <div class="card-header">
                        <span class="h5 font-weight-bold text-primary" style="margin: 0px">Views</span>
                        <div class="div_cardheader_btn">
                            <span class="mb-0 btn float-right"><i class="fas fa-eye"></i> {{ count($views)}} </span>
                            <span class="mb-0 btn float-right tootbar-chart-btn"><i class="fas fa-chart-line"></i></span>
                            <span class="mb-0 btn float-right tootbar-table-btn"><i class="fas fa-list-ul"></i> </span>
                        </div>
                    </div>
                    <div class="card-body tag-wrapper tag-table-wrapper">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="views-table" width="100%" cellspacing="0">
                                <thead>
                                    <tr style="background: #eef2f7;">
                                        <th style="text-align: center;width: 5%;">#</th>
                                        <th >Name</th>
                                        <th style="width: 25%;">Email</th>
                                        <th style="width: 20%;">Contact</th>
                                        <th style="width: 180px;">Visit at</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $number = 1;
                                    @endphp
                                    @foreach ($views as $view)
                                    <tr class="zone-1">
                                        <td style="text-align: center">{{$number++}}</td>
                                        @if ($view->visitor != null)
                                        <td>{{$view->visitor->name}}</td>
                                        <td>{{$view->visitor->email}}</td>
                                        <td>{{$view->visitor->contact}}</td>
                                        @else
                                        <td>Anonymous</td>
                                        <td>N/A</td>
                                        <td>N/A</td>
                                        @endif
                                        <td>{{$view->visitAt}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-body tag-wrapper tag-chart-wrapper" style="display: none; height: 100%; width:100%;">
                        <div id="view-chart-container" style="height: 100%; width:100%;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    var viewer;
    var container = document.getElementById('viewer-container');
    var views = [
        @for($i = 0; $i < count($views); $i++)
            @if ($views[$i]->visitor != null)
            {   
                id: '{{$views[$i]->id}}' ,
                name: '{{$views[$i]->visitor->name}}',
                email: '{{$views[$i]->visitor->email}}',
                contact: '{{$views[$i]->visitor->contact}}',
                visitAt: '{{$views[$i]->visitAt}}'
            }
            @else
            {   
                id: '{{$views[$i]->id}}',
                name: 'Anonymous',
                email: 'N/A',
                contact: 'N/A',
                visitAt: '{{$views[$i]->visitAt}}'
            }
            @endif
            @if ($i < count($views) - 1 ) , @endif
        @endfor
    ]

</script>
<script>

    function initViewChart() {      
        let data = [];
        let count = 0;
        views.forEach(view => {
            count ++;
            data.push({
                x: new Date(view.visitAt).getTime(),
                y: count
            })
        });

        var options = {
            series:[{
                name: 'view',
                data: data
            }],
            chart: {
                height: 400,
                type: 'line',
                zoom: {
                    type: 'x',
                    enabled: true,
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth'
            },
            grid: {
                row: {
                    colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                    opacity: 0.5
                },
            },
            yaxis: {
                labels: {
                    formatter: function (val) {
                    return (val / 1).toFixed(0);
                    },
                },
                title: {
                    text: 'View count'
                },
            },
            xaxis: {
                type: 'datetime',
                title: {
                    text: 'Datetime'
                },
            }
        };

        var chart = new ApexCharts(document.querySelector("#view-chart-container"), options);
        chart.render();
    }
</script>
<script>
    $(document).ready(function() {
        initViewChart();

        $('.tootbar-chart-btn').click(function (e) { 
            $(this).parents('.tags-area').find('.tag-wrapper').hide();
            $(this).parents('.tags-area').find('.tag-chart-wrapper').show();
        });

        $('.tootbar-table-btn').click(function (e) { 
            $(this).parents('.tags-area').find('.tag-wrapper').hide();
            $(this).parents('.tags-area').find('.tag-table-wrapper').show();
        });
    });
</script>
@endsection
