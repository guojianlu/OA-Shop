<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Organization Chart Plugin</title>

    <link rel="icon" href="/Public/Home/plugin/img/logo.png" type="image/png">
    <link rel="stylesheet" href="/Public/Home/plugin/css/font-awesome.min.css">
    <link rel="stylesheet" href="/Public/Home/plugin/css/jquery.orgchart.css">
    <link rel="stylesheet" href="/Public/Home/plugin/css/style.css">
</head>
<body>
<div id="chart-container"></div>
<script type="text/javascript" src="/Public/Home/plugin/js/jquery-3.1.0.min.js"></script>
<script type="text/javascript" src="/Public/Home/plugin/js/jquery.orgchart.js"></script>
</body>

<script type="text/javascript">
    $(function($){

        $(function() {

            var datascource = {
                    'id' :'<?php echo ($gen['uid']); ?>',
                    'name': '<?php echo ($gen['uname']); ?>',
                    'title': '<?php echo ($gen['uid']); ?>',
                    'relationship': '001',
                    'children': [
                    <?php if(is_array($children)): foreach($children as $key=>$vo): ?>{ 'id': "<?php echo ($vo['uid']); ?>",
                        'name': "<?php echo ($vo['uname']); ?>",
                        'title': "<?php echo ($vo['uid']); ?>" ,
                        'relationship': "<?php echo ($vo['relationship']); ?>"
                    },
                <if>
            </if><?php endforeach; endif; ?>
            ]
        };

            $('#chart-container').orgchart({
                'data' : datascource,
                'depth': 2,
                'nodeTitle': 'name',
                'nodeContent': 'title',
                'nodeId': 'id',
                'pan': true,
                'zoom': true,
                'ajaxURL': {
                    'children': '/index.php/Home/Map/abc/'
                },

                'createNode': function($node, data) {

                    var secondMenuIcon = $('<i>', {
                        'class': 'fa fa-info-circle second-menu-icon',
                        click: function() {
                            $(this).siblings('.second-menu').toggle();
                        }
                    });
                }
            });
        });
    });
</script>
</html>