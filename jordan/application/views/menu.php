  
<div class="navbar navbar-inverse" style="position: static;">
  <div class="navbar-inner">
    <div class="container">
      <div class="span12">
        <ul class="nav">
            <?php 
              if ($active == "domain_result"){
                echo '<li class="active">';
              }else{
                echo '<li>';
              }
            ?>
                <a class="brand" href="<?php echo base_url() ;?>god/show_ad_config_result">频道列表</a>
            </li>
            <li class="divider-vertical"></li>
             <?php 
              if ($active == "add_domain"){
                echo '<li class="active">';
              }else{
                echo '<li>';
              }
            ?>
                <a class="brand" href="<?php echo base_url() ;?>god/show_add_ad_config">新增频道配置</a>
            </li>
            <li class="divider-vertical"></li>
              <?php 
              if ($active == "request_result"){
                echo '<li class="active">';
              }else{
                echo '<li>';
              }
            ?>
                <a class="brand" href="<?php echo base_url() ;?>god/show_request_result">引入结果查询</a>
            </li>
            <li class="divider-vertical"></li>
            <?php 
              if ($active == "total"){
                echo '<li class="active">';
              }else{
                echo '<li>';
              }
            ?>
                <a class="brand" href="<?php echo base_url() ;?>show/">汇总</a>
            </li>
            <li class="divider-vertical"></li>
            <?php 
              if ($active == "source"){
                echo '<li class="active">';
              }else{
                echo '<li>';
              }
            ?>
                <a class="brand" href="<?php echo base_url() ;?>source/">资源管理</a>
            </li>
        </ul>
        <ul class="nav pull-right">
            <!--
            <li><a href="#">Link</a></li>
            -->
            <li class="divider-vertical"></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">用户信息 <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo base_url() ;?>user/show_user">用户列表</a></li>
                <!--
                <li><a href="#">Another action</a></li>
                <li><a href="#">Separated link</a></li>
                -->
                <li class="divider"></li>
                <li><a href="<?php echo base_url() ;?>user/logout">安全退出</a></li>
              </ul>
            </li>
          </ul>
      </div>
    </div>
  </div><!-- /navbar-inner -->
</div><!-- /navbar -->