<!DOCTYPE html>
<html>
    <head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />  
        <meta http-equiv="Access-Control-Allow-Origin" content="*">
        <!-- Bootstrap -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../static/bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
        <link href="../static/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <script type="text/javascript" src="../static/js/jquery.js"></script>
        <script src="../static/bootstrap/js/bootstrap.min.js"></script>
        <script src="../static/highcharts/js/highcharts.js"></script>

	<title>结果展示</title>
    </head>
<body >
<div class="container">
        <div class="row-fluid">
                <h1>引入结果查询</h1>
        </div>
    <div class="row-fluid">
        <div class="tabbable"> <!-- Only required for left/right tabs -->
          <ul class="nav nav-tabs">
            <li class="active">
                <a href="#tab1" id="import_count" data-toggle="tab">引入汇总</a>
            </li>
            <li>
                <a href="#tab2" id="user" data-toggle="tab">唯一用户</a>
            </li>
            <li>
                <a href="#tab3" id="domain_count" data-toggle="tab">域名统计</a>
            </li>
            <li>
                <a href="#tab4" id="url_top" data-toggle="tab">URL统计</a>
            </li>
            <li>
                <a href="#tab5" id="domain_top" data-toggle="tab">域名排名</a>
            </li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="tab1">
                <div class="span12" style="width:96%; height:400px;">
                  <div id="container1" style="width:100%; height:400px;"></div>
                </div>
            </div>
            <div class="tab-pane" id="tab2">
                <div class="span12" style="width:96%; height:400px;">
                  <div id="container2" style="width:100%; height:400px;"></div>
                </div>
            </div>
            <div class="tab-pane" id="tab3">
                <div class="span12" style="width:96%; height:400px;">
                    <div class="span4 offset4"> 
                      <input class="span2" id="hour_domain" style="height:30px;margin-top:10px;" id="appendedInputButton" value="5" type="text">
                      <button class="btn" id="search_domain" type="button">GO!</button>
                    </div>
                    <div id="container3" style="width:90%; height:400px;"></div>
                </div>
            </div>
            <div class="tab-pane" id="tab4">
                <div class="span12" style="width:96%; ">
                  <div id="container4" style="width:90%; ">
                  </div>
                </div>
            </div>
            <div class="tab-pane" id="tab5">
                <div class="span12" style="width:96%; ">
                  <div id="container5" style="width:90%; ">
                  </div>
                </div>
            </div>
          </div>
        </div>
    </div>

</div>
        <script type="text/javascript">
            $(document).ready(function(){
            
                function initDomain(){
                    var hour = $("#hour_domain").val();
                    $.ajax({
                        type:"GET",
                        url:"<?php echo base_url();?>show/get_domain_count",
                        data:{'hour':hour},
                        success: function(data){
                            var domainData = [];
                            $.each(data['results'],function(index,entry){
                                domainData.push([entry['domain'],parseInt(entry['total'])])
                            });
                            $('#container3').highcharts({
                                chart: {
                                    plotBackgroundColor: null,
                                    plotBorderWidth: null,
                                    plotShadow: false
                                },
                                title: {
                                    text: 'domain total percentage 1 hour ago'
                                },
                                tooltip: {
                                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b><br/>数量：{point.y}'
                                },
                                plotOptions: {
                                    pie: {
                                        allowPointSelect: true,
                                        cursor: 'pointer',
                                        dataLabels: {
                                            enabled: true,
                                            color: '#000000',
                                            connectorColor: '#000000',
                                            format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                                        }
                                    }
                                },
                                series: [{
                                    type: 'pie',
                                    name: 'domain share',
                                    data: domainData
                                }]
                            });
                        }
                    });
                }

                function initUrlTop(){
                    $.ajax({
                        type:"GET",
                        url:"<?php echo base_url();?>show/get_url_top",
                        data:{},
                        success: function(data){
                            var html = ' <table class="table">'+
                                        '  <thead>'+
                                        '     <tr>'+    
                                        '      <th>total_count</th>'+
                                        '      <th>location</th>'+
                                        '    </tr>'+
                                        '  </thead>'+
                                        '  <tbody>';
                            $.each(data['results'],function(index,entry){
                                html += '<tr class="success">'+
                                        '  <td>'+entry['total']+'</td>'+
                                        '  <td>'+entry['location']+'</td>'+
                                        '</tr>';
                            });
                            html += ' </tbody>'+
                                    ' </table>';
                            $("#container4").html(html);
                        }
                    });
                }

                function initUser(){
                    $.ajax({
                        type:"GET",
                        url:"<?php echo base_url();?>show/user_total",
                        data:{},
                        success: function(data){
                            var categoriesData = [];
                            var userData = [];
                            $.each(data['hour'],function(index,entry){
                                categoriesData.push(entry);
                            });
                            $.each(data['total'],function(index,entry){
                                userData.push(parseInt(entry));
                            });
                            $('#container2').highcharts({
                                chart: {
                                    type: 'line'
                                },
                                title: {
                                    text: ' 每小时唯一用户数'
                                },
                                subtitle: {
                                    text: 'Source: cooler'
                                },
                                xAxis: {
                                    categories: categoriesData.reverse()
                                },
                                yAxis: {
                                    title: {
                                        text: '唯一用户数 (人)'
                                    }
                                },
                                tooltip: {
                                    enabled: false,
                                    formatter: function() {
                                        return '<b>'+ this.series.name +'</b><br/>'+
                                            this.x +': '+ this.y +'°C';
                                    }
                                },
                                plotOptions: {
                                    line: {
                                        dataLabels: {
                                            enabled: true
                                        },
                                        enableMouseTracking: false
                                    }
                                },
                                series: [{
                                    name: '每小时唯一用户人数',
                                    data: userData.reverse()
                                }]
                            });
                        }
                    });
                }

                function initImportCount(){
                    $('#container1').highcharts({
                        chart: {
                            type: 'line'
                        },
                        title: {
                            text: '<?php echo $title ?>'
                        },
                        subtitle: {
                            text: 'Source: cooler'
                        },
                        xAxis: {
                            categories: [
                                <?php foreach ($totalArr as $key => $value) : ?>
                                '<?php  echo $key; ?>点',
                                <?php endforeach ?>  
                            ]
                        },
                        yAxis: {
                            title: {
                                text: '投放量 (次)'
                            }
                        },
                        tooltip: {
                            enabled: false,
                            formatter: function() {
                                return '<b>'+ this.series.name +'</b><br/>'+
                                    this.x +': '+ this.y +'°C';
                            }
                        },
                        plotOptions: {
                            line: {
                                dataLabels: {
                                    enabled: true
                                },
                                enableMouseTracking: false
                            }
                        },
                        series: [{
                            name: '每小时被投放量',
                            data: [
                                <?php foreach ($totalArr as $key => $value) : ?>
                                <?php  echo $value; ?>,
                                <?php endforeach ?>   
                            ]
                        }]
                    });
                }

                function initDomainTop(){
                    $.ajax({
                        type:"GET",
                        url:"<?php echo base_url();?>show/get_domain_top",
                        data:{"top":40},
                        success: function(data){
                            var html = ' <table class="table">'+
                                        '  <thead>'+
                                        '     <tr>'+    
                                        '      <th>total_count</th>'+
                                        '      <th>domain</th>'+
                                        '    </tr>'+
                                        '  </thead>'+
                                        '  <tbody>';
                            $.each(data['results'],function(index,entry){
                                html += '<tr class="success">'+
                                        '  <td>'+entry['total']+'</td>'+
                                        '  <td>'+entry['location']+'</td>'+
                                        '</tr>';
                            });
                            html += ' </tbody>'+
                                    ' </table>';
                            $("#container5").html(html);
                        }
                    });
                }

                $("#domain_count").click(function(){
                    initDomain();
                });
                $("#search_domain").click(function(){
                    initDomain();
                });
                $("#url_top").click(function(){
                    initUrlTop();
                });

                $("#user").click(function(){
                   initUser(); 
                });

                $("#import_count").click(function(){
                    initImportCount();
                })

                $("#domain_top").click(function(){
                    initDomainTop();
                })
                initImportCount();

            });

        </script>

</body>
</html>