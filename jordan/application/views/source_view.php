<script type="text/javascript">
  $(document).ready(function(){
      $('#upload').click(function(){
          $('#myModal').modal('show');
      });
      $("#chosefile").click(function(){
          $("#myfile").click();
          //mfile.disabled=false;mfile.click();mfile.disabled=true
      });
      $("#myfile").change(function(){
          $("#file_name").text($("#myfile").val());
      });
      $("#save_file").click(function(){
          // alert($("#positon").val());
          // alert($('input:radio[name="isfixed"]:checked').val());
          if($('#myfile').val() == ""){
            alert("选择上传的素材！");
            $("#file_name").css("color","red");
          }else if($("#new_name").val() == ""){
            alert("plase input new_name!");
          }else{
            var filename = $("#myfile").val() ;
            var suffix = getExt(filename);
            $("#suffix").val(suffix);
            $("#upload-form").submit();
          }
      });
      $('.mod').tooltip();
      $('.del').tooltip();
      $('.mod').click(function(){
          var id = $(this).parent().prev().find('a').attr("id");
          var update_id = $(this).attr("mod");
          var path_arr = new Array();
          var adconfigid_arr = new Array();
          var filename_arr = new Array();
          var domain_arr = new Array();
          var description_arr = new Array();
          <?php foreach ($result as $key => $value) : ?>
            adconfigid_arr[<?php echo $key; ?>] = '<?php echo $value->adconfigid; ?>';
            domain_arr[<?php echo $key; ?>] = '<?php echo $value->domain; ?>';
            path_arr[<?php echo $key; ?>] = '<?php echo $value->path; ?>';
            filename_arr[<?php echo $key; ?>] = '<?php echo $value->filename; ?>';
            description_arr[<?php echo $key; ?>] = '<?php echo $value->description; ?>';
          <?php endforeach ?>
          $.ajax({
                type:"GET",
                url:"<?php echo base_url();?>source/get_adconfigbyid",
                data:{"adconfigid":adconfigid_arr[id]},
                success: function(data){
                  $.each($("#positon>option"),function(index,entry){
                      if($(entry).attr("value")==data.result['position']){
                        $(entry).attr("selected","selected")
                      };
                  });
                  if(data.result['isfixed']=="false"){
                    $("#isfixed1").attr("checked","checked");
                  }else if(data.result['isfixed']=="true"){
                    $("#isfixed2").attr("checked","checked");
                  }else if(data.result['isfixed']=="glass"){
                    $("#isfixed3").attr("checked","checked");
                  }
                  $("#update_id").val(update_id);
                  $("#adconfigid").val(adconfigid_arr[id]);
                  $("#domain").val(domain_arr[id]);
                  $("#file_name").text(path_arr[id]);
                  var filename = (filename_arr[id].split("_")[1]).split(".")[0];
                  $("#new_name").val(filename);
                  $("#description").val(description_arr[id]);
                  $('#myModal').modal('show');
                }
              });
      });

      var show_arr = new Array();
      var sourcetype_arr = new Array();
      <?php foreach ($result as $key => $value) : ?>
        show_arr[<?php echo $key; ?>] = '<?php echo $value->path; ?>';
        sourcetype_arr[<?php echo $key; ?>] = '<?php echo $value->sourcetype; ?>';
      <?php endforeach ?>
      $('.show').click(function(){
        var id = $(this).attr("id");
        var html = "";
        if(sourcetype_arr[id] == "swf"){
            html += '<embed src="'+show_arr[id]+'" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="300" height="300"></embed><img align="right"  src="http://49.4.129.122/jordan/static/images/close.gif" class="close_ad_cooler">';
        }else{
            html += '<img src='+show_arr[id]+'/>';
        }
        $("#show_source").html(html);
        $('#myModal_source').modal('show');
      });

     $("#submit").click(function(){
        var sourch_name = $("#sourch_name").val();
        location.href = "<?php echo base_url() ;?>source/index?sourch_name="+sourch_name+"&count=0";
      });
  });

  function getExt(s)
    {
       var r, re;
       re = /\.([^\.]+)$/i;
       r = s.match(re);
       return r[1];
    }
</script>

<div class="row-fluid">
<div class="span12">
    <!-- main index-->
    <div class="span9 offset3 ">
        <div class="span8 ">       
            <form class="navbar-search pull-left"  method="post" enctype="multipart/form-data">
            
            <p>
              <span>domain：</span> 
              <input class=" search-query" style="height:30px" id="sourch_name" type='text'   name='sourch_name' value="<?php echo $sourch_name ?>"  />
            
              <input id="count" type='hidden'  value="0" />
              <input id="curPage" type='hidden'  value="1" />
              <input type='button' class="btn  btn-primary" id="submit"  value="search"/> 
              <input type='button' class="btn  btn-success" id="upload"  value="UPLOAD"/> 
            </p>
          </form>
        </div>
        
    </div> 

    <div class="span12" >

      <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">新增素材</h3>
          </div>
          <div class="modal-body" id="show_ad">
            <form id="upload-form" action="/jordan/source/up/" method="post" enctype="multipart/form-data">
                <p>
                    <span>域&nbsp;&nbsp;&nbsp;名：</span>
                    <input id="domain" name="domain" class="input-large" style="height:30px;margin-top:10px;" type="text" value="49.4.129.122">
                </p>
                <p> 
                    <span>位&nbsp;&nbsp;&nbsp;置：</span>                    
                    <select id="positon" name="position" >
                      <option value="left">左</option>
                      <option value="right">右</option>
                      <option value="top">上</option>
                      <option value="bottom">下</option>
                      <option value="left_bottom">左下</option>
                      <option value="right_bottom">右下</option>
                      <!-- 
                      <option value="left_top">左上</option>
                      <option value="right_top">右上</option>
                      -->
                    </select>
                </p>
                <p>
                    <span>形&nbsp;&nbsp;&nbsp;态：</span>
                    <input type="radio" name="isfixed" id="isfixed1" value="false" checked>
                    漂浮
                    <input type="radio" name="isfixed" id="isfixed2" value="true">
                    固定
                    <input type="radio" name="isfixed" id="isfixed3" value="glass">
                    背投
                </p>
                <p>
                    <span>素&nbsp;&nbsp;&nbsp;材：</span>
                    <input id="update_id" type="hidden" value="-1" name="id"/>
                    <input id="adconfigid" type="hidden" value="-1" name="adconfigid"/>
                    <input id="suffix" type="hidden" name="suffix"/>
                    <span  id="file_name" name="file_name" class="input-large uneditable-input " style="margin-top:10px;">file name ,click right btn</span>
                    <input id="myfile" type="file" name="myfile" style="display: none">
                    <input id="chosefile" type="button" class="btn  btn-success"  value="上传自己的素材">
                </p>
                <p>
                    <span>重命名：</span>
                    <input id="new_name" name="new_name" class="input-large" style="height:30px;margin-top:10px;" type="text">
                    <span style="color:red;">*不能包含_和.</span>
                </p>
                <p>
                    <span>描&nbsp;&nbsp;&nbsp;述：</span>
                    <input id="description" name="description" class="input-large" style="height:30px;margin-top:10px;" type="text">
                </p>
            </form>
          </div>
          <div class="modal-footer">
            <button id="save_file" class="btn btn-primary" >提交</button>
            <button class="btn  btn-danger" data-dismiss="modal" aria-hidden="true">关闭</button>
          </div>
      </div>
        
    </div>

    <div class="span12" >
        <table class="table">
            <tr >
                <th>domain</th>
                <th>description</th>
                <th>filename</th> 
                <th>&nbsp;content&nbsp;&nbsp;</th>             
                <th>operation</th>
                <th>path</th>
            </tr>
            <?php foreach ($result as $key => $value) :?>
            <tr class="success">
                <td><?php echo $value->domain; ?></td>
                <td><?php echo $value->description; ?></td>
                <td><?php echo $value->filename; ?></td>
                <td><a class="show" ata-toggle="tooltip" data-placement="top" title="" data-original-title="show advise in page!"  href="#" id="<?php echo $key; ?>">展示内容</a></td>
                <td> 
                  <a class="mod" data-toggle="tooltip" data-placement="top" title="" data-original-title="modify this source!" mod="<?php echo $value->id; ?>"  href="#">mod</a>
                  &nbsp;&nbsp;&nbsp;
                  <a class="del" data-toggle="tooltip" data-placement="top" title="" data-original-title="delete this source!" href="<?php echo base_url() ;?>source/del_source?id=<?php echo $value->id; ?>&filename=<?php echo $value->filename; ?>">del</a> 
                </td>
                <td><?php echo $value->path; ?></td>
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


           <!-- Modal -->
    <div id="myModal_source" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">资源展示</h3>
      </div>
      <div id="show_source" class="modal-body" >
        <img src="" id="show_source">
      </div>
      <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button>
      </div>
    </div>  
<!-- main end-->
</div>
</div>