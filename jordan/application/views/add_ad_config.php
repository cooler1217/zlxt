<div class="row-fluid">
        <div class="span12 " style="min-height:500px">
            <div class="span12" style="min-height:40px;margin-bottom:10px;">
                 <h2 align="center">新增频道配置</h2>
            </div>
            <form  class="form-horizontal"action="<?php echo base_url();?>/god/add_ad_config"  method="post" enctype="multipart/form-data">
            <div class="row-fluid">
              <div class="span8 offset2">
                <div class="row-fluid">

                  <div class="span6">
                    <div class="row-fluid">
                      <div class="span3">
                        <label >domain:</label>
                      </div>
                      <div class="span9">
                        <input type='text' class="input-medium"  name='domain' value="<?php if($action=="modify"){echo $domain->domain;}else{echo $domain['domain'];} ?>"  />
                      </div>
                    </div>
                  </div>

                  <div class="span6">
                    <div class="row-fluid">
                      <div class="span3">
                        <label >position:</label>
                      </div>
                      <div class="span9">
                        <input type='text' class="input-medium"  name='position' value="<?php if($action=="modify"){echo $domain->position;}else{echo $domain['position'];} ?>"  />
                      </div>
                    </div>
                  </div>

                </div>


                <div class="row-fluid">

                  <div class="span6">
                    <div class="row-fluid">
                      <div class="span3">
                        <label >isfixed:</label>
                      </div>
                      <div class="span9">
                        <input type='text' class="input-medium"  name='isfixed' value="<?php if($action=="modify"){echo $domain->isfixed;}else{echo $domain['isfixed'];} ?>"  />
                      </div>
                    </div>
                  </div>

                  <div class="span6">
                    <div class="row-fluid">
                      <div class="span3">
                          <label >description:</label>
                      </div>
                      <div class="span9">
                          <input type='text' class="input-medium" name='description' value="<?php if($action=="modify"){echo $domain->description;}else{echo $domain['description'];} ?>"  />
                      </div>
                    </div>
                  </div>

                </div>

                <div class="row-fluid">

                  <div class="span6">
                    <div class="row-fluid">
                      <div class="span3">
                          <label >left:</label>
                      </div>
                      <div class="span9">
                          <input type='text' class="input-medium" name='left' value="<?php if($action=="modify"){echo $domain->left;}else{echo $domain['left'];} ?>"  />(px)
                      </div>
                    </div>
                  </div>

                  <div class="span6">
                    <div class="row-fluid">
                      <div class="span3">
                          <label>top:</label>
                      </div>
                      <div class="span9">
                        <input type='text' class="input-medium"  name='top' value="<?php if($action=="modify"){echo $domain->top;}else{echo $domain['top'];} ?>"  />(px)
                      </div>
                    </div>
                  </div>

                </div>


                <div class="row-fluid">

                  <div class="span6">
                    <div class="row-fluid">
                      <div class="span3">
                         <label >width:</label>
                      </div>
                      <div class="span9">
                        <input type='text' class="input-medium" name='width' value="<?php if($action=="modify"){echo $domain->width;}else{echo $domain['width'];} ?>"  />(px)
                      </div>
                    </div>
                  </div>

                  <div class="span6">
                    <div class="row-fluid">
                      <div class="span3">
                         <label >height:</label>
                      </div>
                      <div class="span9">
                        <input type='text' class="input-medium" name='height' value="<?php if($action=="modify"){echo $domain->height;}else{echo $domain['height'];} ?>"  />(px)
                      </div>
                    </div>
                  </div>

                </div>

                <div class="row-fluid">
                        <label >content :</label>
                    
                    <div class="span12">
                        <textarea  name='content' style=" width:90%;" rows="15"><?php if($action=="modify"){echo $domain->content;}else{echo $domain['content'];} ?>
                        </textarea>
                    </div>
                </div>
                <div class="row-fluid">
                    <div class="span2 offset4">
                      <input type='hidden'   name='id' value="<?php if($action=="modify"){echo $domain->id;}else{echo $domain['id'];} ?>"  />
                      <input type='submit' class="btn  btn-primary"  value="提交"/> 
                    </div>
                </div>
              </div>
            </form>
            </div>

        </div>           
</div>
    <!-- main end-->




    <!-- 
<script  src="http://127.0.0.1/jordan/static/js/ad.js"></script>
<script  src="http://127.0.0.1/jordan/static/js/ad_glass.js"></script>
<script  src="http://127.0.0.1/jordan/static/js/importjquery.js"></script>
<script  src="http://49.4.129.122/jordan/static/js/importjquery.js"></script>
<script  src="http://127.0.0.1/jordan/static/js/super_getad.js"></script>
    <script  src="http://49.4.129.122/jordan/static/js/super_getad.js"></script>
<script src="./static/js/left_right_bak.js"></script>
    <script src="./static/js/left_right.js"></script>
    -->