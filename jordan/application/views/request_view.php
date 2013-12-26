
        <div class="span12">
            <!-- main index-->
            <div class="span9 offset3 ">
                <div class="span8 ">       
                    <form class="navbar-search pull-left"  method="post" enctype="multipart/form-data">
                    
                    <p>
                        <span>date_hour：</span> 
                      <input class="input-medium search-query" id="date_hour" type='text'   name='date_hour' value="<?php echo $date_hour ?>"  />
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
                    <tr>
                        <th>序号</th>
                        <th>jordanGUID</th>
                        <th>domain</th>
                        <th>sfrom</th>
                        <th>request_datetime</th>            
                        <th>location</th>
                    </tr>
                    <?php foreach ($result as $key => $value) :?>
                    <tr class="success">
                        <td><?php echo $key; ?></td>
                        <td><?php echo $value->jordanGUID; ?></td>
                        <td><?php echo $value->domain; ?></td>
                        <td><?php echo $value->sfrom; ?></td>
                        <td><?php echo $value->request_datetime; ?></td>
                        <td><?php echo $value->location; ?></td>
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
       <script type="text/javascript">
            $(document).ready(function(){
                $("#submit").click(function(){
                  var domain = $("#domain").val();
                  var date_hour = $("#date_hour").val();
                  var checkValue = new RegExp ("^\[0-9]{4}_\[0-9]{2}_\[0-9]{2}_\[0-9]{2}") ;
                  if(checkValue.test(date_hour)){
                    location.href = "<?php echo base_url() ;?>god/show_request_result?domain="+domain+"&count=0&date_hour="+date_hour;
                  }else{
                    alert("查询时间格式错误,精确到小时！请输入：2013_09_05_16");
                  }
                });
                
            });
       </script>
        