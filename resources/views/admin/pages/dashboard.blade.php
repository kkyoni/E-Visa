@extends('admin.layouts.app')
@section('mainContent')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12 color_title">
        <h2><i class="fa fa-home"></i> Dashboard</h2>
    </div>
</div>

<div class="wrapper wrapper-content">
    <div class="row">

        <div class="col-xl-4 col-lg-6 col-12">
            <div class="card">
                <div class="card-content">
                    <div class="media align-items-stretch">
                        <div class="p-2 text-center bg-adminProfit_count">
                            <i class="fa fa-users fa-3x icon_admin"></i>
                        </div>
                        <div class="p-2 bg-gradient-x-adminProfit_count white media-body">
                            <h3>Total Users</h3>
                            <h5 class="text-bold-400 mb-0">{{$total_user}}</h5>
                            <div class="media-left media-middle mt-1">
                                <a class="white" href="{{ route('admin.index') }}">View more</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-6 col-12">
            <div class="card">
                <div class="card-content">
                    <div class="media align-items-stretch">
                        <div class="p-2 text-center bg-todayProfit_count bg-darken-2">
                            <i class="fa fa-hourglass fa-3x icon_admin"></i>
                        </div>
                        <div class="p-2 bg-gradient-x-todayProfit_count white media-body">
                            <h3>Pending Application</h3>
                            <h5 class="text-bold-400 mb-0">{{$pending_app}}</h5>
                            <div class="media-left media-middle mt-1">
                                <a class="white" href="{{ route('admin.order.index')  }}">View more</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-6 col-12">
            <div class="card">
                <div class="card-content">
                    <div class="media align-items-stretch">
                        <div class="p-2 text-center bg-todayBooking_count bg-darken-2">
                            <i class="fa fa-clock-o fa-3x icon_admin"></i>
                        </div>
                        <div class="p-2 bg-gradient-x-todayBooking_count white media-body">
                            <h3>Cancelled Application</h3>
                            <h5 class="text-bold-400 mb-0">{{$cancelled_app}}</h5>
                            <div class="media-left media-middle mt-1">
                                <a class="white" href="{{ route('admin.order.index')  }}">View more</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br><br><br><br><br><br><br>

        <div class="col-xl-4 col-lg-6 col-12">
            <div class="card">
                <div class="card-content">
                    <div class="media align-items-stretch">
                        <div class="p-2 text-center bg-vehicles_count bg-darken-2">
                            <i class="fa fa-check fa-3x icon_admin"></i>
                        </div>
                        <div class="p-2 bg-gradient-x-vehicles_count white media-body">
                            <h3>Completed Application</h3>
                            <h5 class="text-bold-400 mb-0"> {{$completed_app}}</h5>
                            <div class="media-left media-middle mt-1">
                                <a class="white" href="{{ route('admin.order.index')  }}">View more</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-6 col-12">
            <div class="card">
                <div class="card-content">
                    <div class="media align-items-stretch">
                        <div class="p-2 text-center bg-review_count bg-darken-2">
                            <i class="fa fa-ban fa-3x icon_admin"></i>
                        </div>
                        <div class="p-2 bg-gradient-x-review_count white media-body">
                            <h3>Rejected Application</h3>
                            <h5 class="text-bold-400 mb-0">{{$rejected_app}}</h5>
                            <div class="media-left media-middle mt-1">
                                <a class="white" href="{{ route('admin.order.index')  }}">View more</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-6 col-12">
            <div class="card">
                <div class="card-content">
                    <div class="media align-items-stretch">
                        <div class="p-2 text-center bg-promocode_count bg-darken-2">
                            <i class="fa fa-money fa-3x icon_admin"></i>
                        </div>
                        <div class="p-2 bg-gradient-x-promocode_count white media-body">
                            <h3>Total Profit</h3>
                            <h5 class="text-bold-400 mb-0">0</h5>
                            <div class="media-left media-middle mt-1">
                                <a class="white" href="#">View more</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-6 col-lg-6 col-12">
            <div  id="dynamic_data"></div>
            <div id="dashboard_div" style="margin: 2em; " style="width:250px;height:250px;">
                <table>
                    <tr>
                        <td><div id="control3" align="center"></div></td>
                    </tr>
                </table>
                <div id="chart2" align="center"></div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('styles')
<style type="text/css">
.wrapper-content{padding: 20px 10px 40px;}
.white{color:#FFF;}
.white:hover{color:#FFF;}
.bg-user_count {background-color: #00A5A8 !important;}
.bg-gradient-x-user_count {background-image: linear-gradient(to right, #00A5A8 0%, #4DCBCD 100%); background-repeat: repeat-x;}
.bg-driver_count {background-color: #FF6275 !important;}
.bg-gradient-x-driver_count {background-image: linear-gradient(to right, #FF6275 0%, #FF9EAC 100%); background-repeat: repeat-x;}
.bg-company_count {background-color: #fc7703 !important;}
.bg-gradient-x-company_count {background-image: linear-gradient(to right, #fc7703 0%, #FF976A 100%); background-repeat:repeat-x;}
.bg-todayBooking_count {background-color: #10C888 !important;}
.bg-gradient-x-todayBooking_count {background-image: linear-gradient(to right, #10C888 0%, #5CE0B8 100%); background-repeat: repeat-x;}
.bg-todayProfit_count {background-color: #d8db21!important;}
.bg-gradient-x-todayProfit_count {background-image: linear-gradient(to right, #d8db21 0%, #edeb6b 100%); background-repeat: repeat-x;}
.bg-vehicles_count {background-color: #4b5ff1!important;}
.bg-gradient-x-vehicles_count {background-image: linear-gradient(to right, #4b5ff1 0%, #6CDDEB 100%); background-repeat: repeat-x;}
.bg-adminProfit_count {background-color: #FF5733!important;}
.bg-gradient-x-adminProfit_count {background-image: linear-gradient(to right, #FF5733 0%, #ed836b 100%);
    background-repeat: repeat-x;}
.bg-review_count {background-color: #fcbe03!important;}
.bg-gradient-x-review_count {background-image: linear-gradient(to right, #fcbe03 0%, #fdd868 100%);
    background-repeat: repeat-x;}
.bg-promocode_count{background-color: #8803fc !important;}
.bg-gradient-x-promocode_count{background-image: linear-gradient(to right, #8803fc 0%, #cf9afe 100%);
    background-repeat: repeat-x;}
.bg-emergency_count {background-color: #33FFBD!important;}
.bg-gradient-x-emergency_count {background-image: linear-gradient(to right, #33FFBD 0%, #b3ffe7 100%);
    background-repeat: repeat-x;}
.card{color:#FFF!important; font-weight: 600!important; font-size: 1.14rem!important;}
.p-2 {padding: 1rem!important;}
#dynamic_data {margin: 2em auto;}
/*#container_chart{margin: 0 auto;}*/
/*.nprofit-bg {background-color: #7a8e8a !important; color: #ffffff;}
.emergency-bg {background-color: red;}
.rating-bg {background-color: #627d7d !important; color: #ffffff;}
.to_profit-bg{background-color: #ab6e2b !important; color: #ffffff;}
.gm-style-iw-d{overflow: hidden !important;}
.fa-3x {font-size: 3em;}
.highcharts-figure, .highcharts-data-table table {min-width: 360px; max-width: 800px; margin: 1em auto;}
.highcharts-data-table table {font-family: Verdana, sans-serif; border-collapse: collapse; border: 1px solid #EBEBEB; margin: 10px auto; text-align: center; width: 100%; max-width: 500px;}
.highcharts-data-table caption {padding: 1em 0; font-size: 1.2em; color: #555;}
.highcharts-data-table th {font-weight: 600; padding: 0.5em;}
.highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {padding: 0.5em;}
.highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {background: #f8f8f8;}
.highcharts-data-table tr:hover {background: #f1f7ff;}*/
</style>
@endsection
@section('scripts')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/variable-pie.js"></script>
<script type="text/javascript">
  Highcharts.chart('dynamic_data', {
    chart: {
      type: 'variablepie',
      backgroundColor: null
    },title: {
      text: ''
    },exporting: {
      enabled: false 
    },tooltip: {
      headerFormat: '',
      pointFormat: '<span style="color:{point.color}">\u25CF</span> <b> {point.name} : {point.y}</b><br/>'
    },series: [{
      minPointSize: 80,
      innerSize: '30%',
      zMin: 0,
      name: '{{Settings::get('project_title')}}',
      data: [{
        name: 'Users : {{$total_user}}',
        y: {{$total_user}},
        color : '#FF5733',
      }, {
        name: 'Pending Application : {{$pending_app}}',
        y: {{$pending_app}},
        color : '#d8db21',
      }, {
        name: 'Cancelled Application : {{$cancelled_app}}',
        y: {{$cancelled_app}},
        color : '#10C888',
      }, {
        name: 'Completed Application : {{$completed_app}}',
        y: {{$completed_app}},
        color : '#4b5ff1',
      },{
        name: 'Rejected Application : {{$rejected_app}}',
        y: {{$rejected_app}},
        color : '#fcbe03',
      },]
    }]
  });
</script>
@endsection
