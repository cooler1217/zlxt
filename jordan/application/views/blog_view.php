<!DOCTYPE html>
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

  <div class="row-fluid">
    <div class="span12" style="min-height:600px;">
      <table class="table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>服务区域</th>
                  <th>服务量（G）</th>
                  <th>往前状态</th>
                  <th>操作</th>
                </tr>
              </thead>
              <tbody>
                <tr class="warning">
                  <td>1</td>
                  <td>北洼东里</td>
                  <td>1000G</td>
                  <td>未服务</td>
                  <td>
                    <button type="button" class="btn btn-success">开始服务</button>
                  </td>
                </tr>
                  <tr class="warning">
                  <td>1</td>
                  <td>北洼西里</td>
                  <td>1000G</td>
                  <td>未服务</td>
                  <td>
                    <button type="button" class="btn btn-success">开始服务</button>
                  </td>
                </tr>
                <tr class="success">
                  <td>1</td>
                  <td>三里河一号院</td>
                  <td>2000G</td>
                  <td>正在服务</td>
                  <td>
                    <button type="button" class="btn btn-danger">关闭服务</button>
                  </td>
                </tr>
              </tbody>
            </table>
    </div>
  </div>

    <div class="span12">
        <input type="text" class="span3" style="margin: 0 auto;" data-provide="typeahead" data-items="4" data-source="[&quot;Alabama&quot;,&quot;Alaska&quot;,&quot;Arizona&quot;,&quot;Arkansas&quot;,&quot;California&quot;,&quot;Colorado&quot;,&quot;Connecticut&quot;,&quot;Delaware&quot;,&quot;Florida&quot;,&quot;Georgia&quot;,&quot;Hawaii&quot;,&quot;Idaho&quot;,&quot;Illinois&quot;,&quot;Indiana&quot;,&quot;Iowa&quot;,&quot;Kansas&quot;,&quot;Kentucky&quot;,&quot;Louisiana&quot;,&quot;Maine&quot;,&quot;Maryland&quot;,&quot;Massachusetts&quot;,&quot;Michigan&quot;,&quot;Minnesota&quot;,&quot;Mississippi&quot;,&quot;Missouri&quot;,&quot;Montana&quot;,&quot;Nebraska&quot;,&quot;Nevada&quot;,&quot;New Hampshire&quot;,&quot;New Jersey&quot;,&quot;New Mexico&quot;,&quot;New York&quot;,&quot;North Dakota&quot;,&quot;North Carolina&quot;,&quot;Ohio&quot;,&quot;Oklahoma&quot;,&quot;Oregon&quot;,&quot;Pennsylvania&quot;,&quot;Rhode Island&quot;,&quot;South Carolina&quot;,&quot;South Dakota&quot;,&quot;Tennessee&quot;,&quot;Texas&quot;,&quot;Utah&quot;,&quot;Vermont&quot;,&quot;Virginia&quot;,&quot;Washington&quot;,&quot;West Virginia&quot;,&quot;Wisconsin&quot;,&quot;Wyoming&quot;]">
    </div>
    <script type="text/javascript">
      function checkBrowser(){
          alert($.browser['version']);
          if($.browser.safari || $.browser.mozilla || $.browser.opera){
              return true;
          }
          if($.browser.msie && parseInt($.browser['version'])>=9){
              return true;
          }
      }
      //checkBrowser();
    </script>

    <div class="span12">
        <h1>show your face to my heart ~!</h1>
    </div>
    <div class="span8">
        <h2> <?php echo $title;  ?></h2>
    </div>
    <div class="span4">
        <p>
          <button class="btn btn-large btn-primary" type="button">Large button</button>
          <button class="btn btn-large" type="button">Large button</button>
        </p>
    </div>
    <div class="span12">
        <ul>
        <?php foreach ($todo as $key => $value) :?>
            <li>
                <?=$key ?> <?=$value ?>
            </li>
        <?php endforeach ?>
        <ol>
            <?php foreach ($todo as $item) :?>
                <li>
                    <?=$item ?> 
                </li>
            <?php endforeach ?>
        </ol>
        </ul>
    </div>
    <div class="span12">
        <!-- Button to trigger modal -->
        <a href="#myModal" role="button" class="btn" data-toggle="modal">查看演示案例</a>
         
        <!-- Modal -->
        <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Modal header</h3>
          </div>
          <div class="modal-body">
            <p>One fine body…</p>
          </div>
          <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button>
            <button class="btn btn-primary">Save changes</button>
          </div>
        </div>
    </div>


  <div class="span12">
          <div class="span2"><a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Tooltip on top">Tooltip on top</a></div>
          <div class="span2"><a href="#" data-toggle="tooltip" data-placement="right" title="Tooltip on right">Tooltip on right</a></div>
          <div class="span2"><a href="#" data-toggle="tooltip" data-placement="bottom" title="Tooltip on bottom">Tooltip on bottom</a></div>
          <div class="span2"><a href="#" data-toggle="tooltip" data-placement="left" title="Tooltip on left">Tooltip on left</a></div>
    </div>

    <div class="span12">
       <div id="myCarousel" class="carousel slide">
          <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
            <li data-target="#myCarousel" data-slide-to="3"></li>
          </ol>
          <!-- Carousel items -->
          <div class="carousel-inner">
            <div class="active item">

                <img src="<?php echo base_url();?>static/images/1.JPG" alt="">
            </div>
            <div class="item">
                <img src="<?php echo base_url();?>static/images/2.JPG" alt="">
            </div>
            <div class="item">
                <img src="<?php echo base_url();?>static/images/3.JPG" alt="">
            </div>
             <div class="item">
                <img src="<?php echo base_url();?>static/images/3.JPG" alt="">
            </div>
          </div>
          <!-- Carousel nav -->
          <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
          <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
        </div>
    </div>

    <div id="cooler" class="span12">
    cooler
    </div>

    <script>
      $(function () {
            $('.carousel').carousel({
                interval: 2000
            });
            $('.span2').find("a").tooltip();
      });
      document.write("dddddddddddddddddddd");
      document.getElementById("cooler").innerHTML="bbbbbbbbbbbbbbbbbbb";
    </script>
</body>
</html>