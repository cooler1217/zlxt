<div class="row-fluid">
        <div class="span12">
            <!-- main index-->
            <div class="span9 offset3 ">
                <div class="span8 ">       
                    <form class="navbar-search pull-left"  method="post" enctype="multipart/form-data">
                    
                    <p>
                      <span>domain：</span> 
                      <input class="input-medium search-query" id="domain" type='text'   name='domain' value="<?php echo $domain ?>"  />
                    
                      <input id="count" type='hidden'  value="0" />
                      <input id="curPage" type='hidden'  value="1" />
                      <input type='button' class="btn  btn-primary" id="submit"  value="search"/> 
                    </p>
                  </form>
                  
                </div>
                
            </div> 

            <div class="span12" >
                <table class="table">
                    <tr >
                        <th>domain</th>
                        <th>position</th>
                        <th>isfixed</th> 
                        <th>left</th> 
                        <th>top</th> 
                        <th>width</th> 
                        <th>height</th>
                        <th>content</th>             
                        <th>operation</th>
                        <th>status</th>
                        <th>description</th>  
                    </tr>
                    <?php foreach ($result as $key => $value) :?>
                    <tr class="success">
                        <td><?php echo $value->domain; ?></td>
                        <td><?php echo $value->position; ?></td>
                        <td><?php echo $value->isfixed; ?></td>
                        <td><?php echo $value->left; ?>(px)</td>
                        <td><?php echo $value->top; ?>(px)</td>
                        <td><?php echo $value->width; ?>(px)</td>
                        <td><?php echo $value->height; ?>(px)</td>
                        <td><a class="show" ata-toggle="tooltip" data-placement="top" title="" data-original-title="show advise in page!"  href="#" id="<?php echo $key; ?>">展示内容</a></td>
                        <td> 
                          <a class="mod" data-toggle="tooltip" data-placement="top" title="" data-original-title="modify this domain config!" href="<?php echo base_url() ;?>god/mod_ad_config?id=<?php echo $value->id; ?>">mod</a>
                          &nbsp;&nbsp;&nbsp;
                          <a class="del" data-toggle="tooltip" data-placement="top" title="" data-original-title="delete this domain config!" href="<?php echo base_url() ;?>god/del_ad_config?id=<?php echo $value->id; ?>">del</a> 
                        </td>
                        <td>
                          <?php if($value->status == 1):?>
                          <a class="change" style="color:red" data-toggle="tooltip" data-placement="top" title="" data-original-title="change this domain config status!" href="<?php echo base_url() ;?>god/change_ad_config?id=<?php echo $value->id; ?>&status=0">
                            stop
                          </a> 
                        <?php else:?>
                          <a class="change" style="color:green" data-toggle="tooltip" data-placement="top" title="" data-original-title="change this domain config status!" href="<?php echo base_url() ;?>god/change_ad_config?id=<?php echo $value->id; ?>&status=1">
                            start
                          </a> 
                        <?php endif?>
                        </td>
                        <td><?php echo $value->description; ?></td>
                    </tr>
                    <?php endforeach ?>
                  </table>
                  <!--page-->
                  <div class="span6 offset6" >
                            <?php echo $page_links; ?>
                   </div>
                   <!--page end-->
                </div>      
                <div id="show_urls" style="display:none;">
            </div>    
        <!-- main end-->

        <!-- Modal -->
        <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">广告条展示</h3>
          </div>
          <div class="modal-body" id="show_ad">
            
          </div>
          <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button>
          </div>
        </div>
</div>
        <script type="text/javascript">
            $(document).ready(function(){
                $("#submit").click(function(){
                  var domain = $("#domain").val();
                  location.href = "<?php echo base_url() ;?>god/show_ad_config_result?domain="+domain+"&count=0";
                });
                $('.mod').tooltip();
                $('.del').tooltip();
                var show_arr = new Array();
                <?php foreach ($result as $key => $value) : ?>
                  show_arr[<?php echo $key; ?>] = '<?php echo $value->content; ?>';
                <?php endforeach ?>
                $('.show').click(function(){
                  $("#show_ad").html(show_arr[$(this).attr("id")]);
                  $('#myModal').modal('show');
                });
            });
       </script>


