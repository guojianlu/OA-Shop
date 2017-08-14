<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>收支管理</title>
    <link rel="stylesheet" type="text/css" href="/Public/Admin/css/css.css" />
    <script type="text/javascript" src="/Public/Admin/js/jquery.min.js"></script>
    </head>
<body>
<script src="/Public/Admin/plugin/highcharts.js"></script>
<script src="/Public/Admin/plugin/modules/data.js"></script>
<script src="/Public/Admin/plugin/modules/drilldown.js"></script>
<script src="/Public/Admin/plugin/modules/exporting.js"></script>
<div id="pageAll">
        <div class="pageTop">
            <div class="page">
                <img src="/Public/Admin/img/coin02.png" /><span><a>首页</a>&nbsp;-&nbsp;<a
                    href="#">收支管理</a>&nbsp;-</span>&nbsp;收支管理
            </div>
        </div>

        <div class="page">
            <!-- banner页面样式 -->
            <div class="connoisseur">
                <div class="conform">
                   
                        <div class="cfD">
                            选择年份:<select id="yselect" onchange="myyear(this.options[this.options.selectedIndex].value)">
                                        <?php if(is_array($year)): $i = 0; $__LIST__ = $year;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vol["Y"]); ?>"><?php echo ($vol["Y"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                     </select>
                            选择月份:<select id="mselect" onchange="mymonth(this.options[this.options.selectedIndex].value)">
                                            <option value="1">一月</option><option value="2">二月</option>
                                            <option value="3">三月</option><option value="4">四月</option>
                                            <option value="5">五月</option><option value="6">六月</option>
                                            <option value="7">七月</option><option value="8">八月</option>
                                            <option value="9">九月</option><option value="10">十月</option>
                                            <option value="11">十一月</option><option value="12">十二月</option>
                                      </select>
                            <a href="javascript:;" class="ss"><button class="button">搜索</button></a>
                        </div>
                   
                </div>
            </div>
        </div>
</div>


<br><br>
<div id="container" style="min-width: 310px; max-width: 800px; height: 400px; margin: 0 auto"></div>
<br>
<div id="container_2" style="min-width: 300px; max-width: 800px; height: 600px; margin: 0 auto"></div>

<script type="text/javascript">

// Create the chart
Highcharts.chart('container', {
    chart: {
        type: 'pie'
    },
    title: {
        text: '公司收支情况: <?php echo ($t2); ?>年<?php echo ($t); ?>月数据'
    },
    subtitle: {
        text: 'Source: 芙瑞施'
    },
    plotOptions: {
        series: {
            dataLabels: {
                enabled: true,
                format: '{point.name}: {point.y:.2f}%'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
    },
    series: [{
        name: '收支表',
        colorByPoint: true,
        data: <?php echo ($str); ?>
    }],
    drilldown: {
        series: [{
            name: '收入',
            id: '收入',
            data: <?php echo ($str_sr); ?>
        }, {
            name: '支出',
            id: '支出',
            data: <?php echo ($str_zc); ?>
        }]
    }
});


//树状图
Highcharts.chart('container_2', {
    chart: {
        type: 'column'
    },
    title: {
        text: '公司收支情况: <?php echo ($t2); ?>年<?php echo ($t); ?>月数据'
    },
    subtitle: {
        text: 'Source: 芙瑞施'
    },
    xAxis: {
        type: 'category',
        labels: {
            rotation: -45,
            style: {
                fontSize: '13px',
                fontFamily: 'Verdana, sans-serif'
            }
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: '公司收支 (元)'
        }
    },
    legend: {
        enabled: false
    },
    tooltip: {
        pointFormat: '<?php echo ($t2); ?>年<?php echo ($t); ?>月: <b>{point.y} 元</b>'
    },
    series: [{
        name: 'Population',
        data: [
            ['公司收入', <?php echo ($data_12); ?>],
            ['公司支出', <?php echo ($data_zc); ?>],
            ['公司利润', <?php echo ($data_lr); ?>],
            ['注册收入', <?php echo ($data_1); ?>],
            ['返单收入', <?php echo ($data_2); ?>],
            ['注册提成', <?php echo ($data_3); ?>],
            ['返单提成', <?php echo ($data_4); ?>],
            ['股东分红', <?php echo ($data_5); ?>],
            ['董事分红', <?php echo ($data_6); ?>]
        ],
        dataLabels: {
            enabled: true,
            rotation: -90,
            color: '#FFFFFF',
            align: 'right',
            format: '{point.y}', // one decimal
            y: 10, // 10 pixels down from the top
            style: {
                fontSize: '13px',
                fontFamily: 'Verdana, sans-serif'
            }
        }
    }]
});

$(function(){
        //通过审核按钮的点击事件
        $('.ss').on('click',function(){
            var y = $('#yselect option:selected').val();
            var m = $('#mselect option:selected').val();
            m = '0' + m;
            window.location.href = '/index.php/Admin/Inout/inout/y/' + y + '/m/' + m;
        })
});
		</script>
	</body>
</html>