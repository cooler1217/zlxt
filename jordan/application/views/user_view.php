<script type="text/javascript">
  $(document).ready(function(){
     $('#show_add_user').click(function(){
          $('#myModal').modal('show');
      });

      $('.mod').tooltip();
      $('.del').tooltip();

      $('.mod').click(function(){
          var id = $(this).parent().prev().prev().prev().prev().text();
          var username_arr = new Array();
          var domain_arr = new Array();
          var right_arr = new Array();
          <?php foreach ($result as $key => $value) : ?>
            username_arr[<?php echo $key; ?>] = '<?php echo $value->username; ?>';
            domain_arr[<?php echo $key; ?>] = '<?php echo $value->domain; ?>';
            right_arr[<?php echo $key; ?>] = '<?php echo $value->right; ?>';
          <?php endforeach ?>
          $("#username").val(username_arr[id]);
          $("#domain").val(domain_arr[id]);
          $("#right").val(right_arr[id]);
          $("#update_id").val($(this).attr("mod"));
          $('#myModal').modal('show');
      });

      $("#save_user").click(function(){
          if($('#username').val() == ""){
            alert("用户名不能为空！");
          }else if($("#password").val() == ""){
            alert("密码不能为空！");
          }else if($("#domain").val() == ""){
            alert("域名不能为空！");
          }else if($("#right").val() == ""){
            alert("权限不能为空！")
          }else{
            $("#saveuser-form").submit();
          }
      });

     $("#submit").click(function(){
        var username_search = $("#username_search").val();
        location.href = "<?php echo base_url() ;?>user/show_user?username="+username_search+"&count=0";
      });
  });

</script>

<div class="row-fluid">
<div class="span12">
    <!-- main index-->
    <div class="spane12" >
      <div class="span8 offset2">
        <h2 align="center" >用户管理</h2>
      </div>
    </div>
    <div class="span9 offset3 ">
        <div class="span8 ">       
            <form class="navbar-search pull-left"  method="post" enctype="multipart/form-data">
            
            <p>
              <span>username：</span> 
              <input class=" search-query" style="height:30px" id="username_search" type='text'   name='username_search' value="<?php echo $username ?>"  />
            
              <input id="count" type='hidden'  value="0" />
              <input id="curPage" type='hidden'  value="1" />
              <input type='button' class="btn  btn-primary" id="submit"  value="search"/> 
              <input type='button' class="btn  btn-success" id="show_add_user"  value="新增用户"/> 
            </p>
          </form>
        </div>
        
    </div> 

    <div class="span12" >

      <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">新增用户</h3>
          </div>
          <div class="modal-body" id="show_ad">
            <form id="saveuser-form" action="<?php echo base_url() ;?>user/save_user" method="post" >
                <p>

                    <span>用&nbsp;户&nbsp;名：</span>
                    <input id="update_id" type="hidden" value="-1" name="id"/>
                    <input id="username" name="username" class="input-large" style="height:30px;margin-top:10px;"  type="text" value="">
                    <span style="color:red;">*</span>
                </p>

                <p>
                    <span>密&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;码：</span>
                    <input id="password" type="password" value="" name="password" style="height:30px;margin-top:10px;"/>
                    <span style="color:red;">*</span>
                </p>
                <p>
                    <span>域&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;名：</span>
                    <input id="domain" type="text" value="" name="domain" style="height:30px;margin-top:10px;"/>
                    <span style="color:red;">*</span>
                </p>
                <p>
                    <span>权&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;限：</span>
                    <input id="right" name="right" class="input-large" style="height:30px;margin-top:10px;" type="text">
                    <span style="color:red;">* 0:管理员 1:操作员 2：游客 </span>
                </p>
            </form>
          </div>
          <div class="modal-footer">
            <button id="save_user" class="btn btn-primary" >提交</button>
            <button class="btn  btn-danger" data-dismiss="modal" aria-hidden="true">关闭</button>
          </div>
      </div>
        
    </div>

    <div class="span12" >
        <table class="table">
            <tr >
                <th>id</th>
                <th>username</th>
                <th>right</th>  
                <th>domain</th>             
                <th>operation</th>
            </tr>
            <?php foreach ($result as $key => $value) :?>
            <tr class="success">
                <td><?php echo $key; ?></td>
                <td><?php echo $value->username; ?></td>
                <td>
                  <?php 
                    if($value->right == "0"){
                        echo "管理员";
                      }else if($value->right == "1"){
                        echo "操作员";
                      }else if($value->right == "2"){
                        echo "游客";
                      } 
                      ?>
                </td>
                <td><?php echo $value->domain; ?></td>
                <td> 
                  <a class="mod" data-toggle="tooltip" data-placement="top" title="" data-original-title="modify this user!" mod="<?php echo $value->id; ?>"  href="#">mod</a>
                  &nbsp;&nbsp;&nbsp;
                  <a class="del" data-toggle="tooltip" data-placement="top" title="" data-original-title="delete this user!" href="<?php echo base_url() ;?>user/del_user?id=<?php echo $value->id; ?>">del</a> 
                </td>
            </tr>
            <?php endforeach ?>
          </table>
          <!--page-->
          <div class="span6 offset8" >
                    <?php echo $page_links; ?>
           </div>
           <!--page end-->
        </div>      
        <div id="show_urls" style="display:none;">
    </div>  
<!-- main end-->
</div>
</div>