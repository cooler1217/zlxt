<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
    <title>this is first ci and bootstrap !!</title>
    <base href="<?php echo base_url();?>" />
    <!-- Bootstrap -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?php echo base_url();?>static/bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
    <link href="<?php echo base_url();?>static/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <script type="text/javascript" src="<?php echo base_url();?>static/js/jquery.js"></script>
    <script src="<?php echo base_url();?>static/bootstrap/js/bootstrap.min.js"></script>
</head>
<body>

<script type="text/javascript">

</script>
    <script type="text/javascript">
          // alert(1);
          // alert($.browser['version']);
          // alert(2);
      // function checkBrowser(){
      //     if($.browser.safari || $.browser.mozilla || $.browser.opera){
      //         return true;
      //     }
      //     if($.browser.msie && parseInt($.browser['version'])>=9){
      //         return true;
      //     }
      // }
      // // checkBrowser();
      function autoinput(query,process){
        //alert(query);
        $.ajax({
                type:"GET",
                url:"<?php echo base_url();?>blog/get_json_data",
                data:{"query":query},
                success: function(data){
                  //lert(data)
                  process(data.result);
                }
              });
      }

      $(document).ready(function(){
        var subjects=['a','ab', 'b'];
        $('#search').typeahead({source: subjects});

        $('#search2').typeahead({source: autoinput});

      });

    </script>

    <div id="cooler" class="span12">
        <h1>show your face to my heart ~!</h1>
    </div>

    <div class="span12">
    </div> 
    <div class="span12">
        <input id="search" type="text" style="margin: 0 auto;height:30px;" data-provide="typeahead" data-items="40" >
    </div> 
      <div class="span12">
        <input id="search2" type="text" style="margin: 0 auto;height:30px;" data-provide="typeahead" data-items="40" >
    </div> 
    <div class="span12" style="min-height:2000px;">
      <iframe id='a9aa2389' name='a9aa2389' src='http://49.4.129.122/jordan/god/show_request_result' frameborder='0' scrolling='no' width='468' height='60'><a href='http://127.0.0.1/openx/www/delivery/ck.php?n=a49eadc7&amp;cb=INSERT_RANDOM_NUMBER_HERE' target='_blank'><img src='http://127.0.0.1/openx/www/delivery/avw.php?zoneid=1&amp;cb=INSERT_RANDOM_NUMBER_HERE&amp;n=a49eadc7' border='0' alt='' /></a></iframe>
      <!--
      <iframe src="http://127.0.0.1/jordan/blog/test_view"></iframe>
    -->
    </div>
</body>
</html>
<!--
<script  src="http://49.4.129.122/a.js"></script>
<script  src="http://127.0.0.1/jordan/static/js/ad.js"></script>
-->

