@php
    $response = App\Http\Controllers\AdminController::getStatistics();
    $devices = App\Http\Controllers\AdminController::getDevices();
    $platforms = App\Http\Controllers\AdminController::getPlatforms();
    $browsers = App\Http\Controllers\AdminController::getBrowsers();
    $visits = App\Http\Controllers\AdminController::getVisits();
    $mostPopular = json_decode($devices);
    $range = App\Http\Controllers\AdminController::getTimeInterval();
@endphp

<a href ='https://adminlte.io/themes/AdminLTE/pages/widgets.html'>Виджеты</a>

<div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-book"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Всего уроков</span>
                <span class="info-box-number">{{ $response['lessons'] }}</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-user"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Всего новых пользователей</span>
                <span class="info-box-number">{{ $response['new_users'] }}</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->

    <!-- fix for small devices only -->
    <div class="clearfix visible-sm-block"></div>

    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-graduation-cap"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Всего уровней</span>
                <span class="info-box-number">{{ $response['levels'] }}</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-clock-o"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Всего ДЗ</span>
                <span class="info-box-number">{{ $response['HW'] }}</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
</div>

<!-- MAP & BOX PANE -->
<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title">Пользователи</h3>

        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                <i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
            </button>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body no-padding">
        <div class="row">
            <div class="col-md-3 col-sm-6">
                <div class="pad">
                    <div id="chart_div1"></div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="pad">
                    <div id="chart_div2"></div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="pad">
                    <div id="chart_div3"></div>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6">
                <div class="pad box-pane-right bg-green" style="min-height: 280px">
                    <div class="description-block margin-bottom">
                        <div class="sparkbar pad" data-color="#fff">
                            <canvas width="34" height="30" style="display: inline-block; width: 34px; height: 30px; vertical-align: top;"></canvas>
                        </div>
                        <h5 class="description-header">{{ $visits }}</h5>
                        <span class="description-text">Посещении</span>
                    </div>
                    <!-- /.description-block -->
                    <div class="description-block margin-bottom">
                        <div class="sparkbar pad" data-color="#fff">
                            <canvas width="34" height="30" style="display: inline-block; width: 34px; height: 30px; vertical-align: top;"></canvas>
                        </div>
                        <h5 class="description-header">Популярное устройство:</h5>
                        <span class="description-text">{!! $mostPopular[0]->device !!}</span>
                    </div>
                    <!-- /.description-block -->
                    <div class="description-block">
                        <div class="sparkbar pad" data-color="#fff">
                            <canvas width="34" height="30" style="display: inline-block; width: 34px; height: 30px; vertical-align: top;"></canvas>
                        </div>
                        <h5 class="description-header">Самое посещаемое время</h5>
                        <span class="description-text">{!! json_decode($range)[0]->hours !!}</span>
                    </div>
                    <!-- /.description-block -->
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.box-body -->
</div>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart1);

    function drawChart1() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
            @foreach(json_decode($devices) as $device)
                ['{!! $device->device !!}', {!! $device->occurrence !!}],
            @endforeach
        ]);

        var options = {'title':'Устройства:',
                       'width':400,
                       'height':300};

        var chart = new google.visualization.PieChart(document.getElementById('chart_div1'));
        chart.draw(data, options);
    }
</script>
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart2);

    function drawChart2() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
            @foreach(json_decode($platforms) as $platform)
                ['{!! $platform->platform !!}', {!! $platform->occurrence !!}],
            @endforeach
        ]);

        var options = {'title':'Платформы:',
                       'width':400,
                       'height':300};

        var chart = new google.visualization.PieChart(document.getElementById('chart_div2'));
        chart.draw(data, options);
    }
</script>
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart3);

    function drawChart3() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
            @foreach(json_decode($browsers) as $browser)
                ['{!! $browser->browser !!}', {!! $browser->occurrence !!}],
            @endforeach
        ]);

        var options = {'title':'Браузеры:',
                       'width':400,
                       'height':300};

        var chart = new google.visualization.PieChart(document.getElementById('chart_div3'));
        chart.draw(data, options);
    }
</script>
