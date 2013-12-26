<div class="row-fluid" style="height:500px">
  <div class="container">
    <form class="form-horizontal" method="POST" action="<?php echo base_url();?>user/auth">
        <section class="loginBox row-fluid">
          <section class="span7 left">
            <h2>用户登录</h2>
            <p><input type="text" name="username" /></p>
            <p><input type="password" name="password" /></p>
            <section class="row-fluid">
              <section class="span8 lh30"><label>猛戳蓝色按钮-></label></section>
          <section class="span1"><input type="submit" value=" 登录 " class="btn btn-primary"></section>
            </section>
          </section>
          <section class="span5 right">
            <h2>没有帐户？</h2>
            <section>
              <p>那还等啥，赶紧联系管理员！！ ^O^  ....  qq:418435432</p>
              
            </section>
          </section>
        </section><!-- /loginBox -->
      </form>
    </div> <!-- /container -->
</div>

<style type="text/css">
*{margin:0;padding: 0;}
      
      body{background: #444 }
      .loginBox{width:420px;height:230px;padding:0 20px;border:1px solid #fff; color:#000; margin-top:40px; border-radius:8px;background: white;box-shadow:0 0 15px #222; background: -moz-linear-gradient(top, #fff, #efefef 8%);background: -webkit-gradient(linear, 0 0, 0 100%, from(#f6f6f6), to(#f4f4f4));font:11px/1.5em 'Microsoft YaHei' ;position: absolute;left:50%;top:50%;margin-left:-210px;margin-top:-115px;}
      .loginBox h2{height:45px;font-size:20px;font-weight:normal;}
      .loginBox .left{border-right:1px solid #ccc;height:100%;padding-right: 20px; }
      .footer_white{
        color: white;
      }

</style>
