<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<div class="page-heading"> 
          <h2>操作日志 <small>总数: <span class='text-danger'><?php  echo $total;?></span></small></h2> 
</div>


 <form action="./index.php" method="get" class="form-horizontal" plugins="form">
                <input type="hidden" name="c" value="site" />
                <input type="hidden" name="a" value="entry" />
                <input type="hidden" name="m" value="ewei_shopv2" />
                <input type="hidden" name="do" value="web" />
                <input type="hidden" name="r"  value="perm.log" />
<div class="page-toolbar row m-b-sm m-t-sm">
                            <div class="col-sm-1">
				 
			  <div class="input-group-btn">
			        <button class="btn btn-default btn-sm"  type="button" data-toggle='refresh'><i class='fa fa-refresh'></i></button>
			 
				
			   </div>  
			
                               </div>	
	  
				 
                            <div class="col-sm-11 pull-right">
			 <div class='input-group input-group-sm' style='float:left;'   >
				   <?php  echo tpl_daterange('time', array('placeholder'=>'操作时间'),true);?>
			</div>  
                                
                                 <select name='logtype'  class='form-control  input-sm select-md select2'   style="width:250px;"  >
                          <option value=''>操作类型</option>
                               <?php  if(is_array($types)) { foreach($types as $t) { ?>
                               <option value='<?php  echo $t['value'];?>' <?php  if($_GPC['logtype']==$t['value']) { ?>selected<?php  } ?>><?php  echo $t['text'];?></option>
                               <?php  } } ?>
                    </select>
                                
	 
                                
                            
				<div class="input-group">				 
                                        <input type="text" class="input-sm form-control" name='keyword' value="<?php  echo $_GPC['keyword'];?>" placeholder="可搜索操作员用户名/操作内容"> <span class="input-group-btn">
						
                                     <button class="btn btn-sm btn-primary" type="submit"> 搜索</button> </span>
                                </div>
								
                            </div>
</div>
  </form>
 
 

            <table class="table table-hover table-responsive">
                <thead>
                    <tr>
                        <th style='width:50px;'>ID</th>
                        <th style='width:80px;'>操作员</th>
                        <th style='width:200px;' >类型</th>
                        <th>操作内容</th>
                        <th style='width:110px;'>操作IP</th>
                        <th style='width:100px;'>操作时间</th>
 
                    </tr>
                </thead>
                <tbody>
                    <?php  if(is_array($list)) { foreach($list as $row) { ?>
                    <tr  data-toggle='popover' data-html='true' data-placement='top' data-trigger='hover' data-content='<?php  echo $row['op'];?>'>
                        <td><?php  echo $row['id'];?></td>
                        <td><?php  echo $row['username'];?></td>
                        <td><?php  echo $row['name'];?></td>
                        <td><span><?php  echo $row['op'];?></span></td>
                        <td><?php  echo $row['ip'];?></td>
                        <td><?php  echo date('Y-m-d', $row['createtime'])?><br/><?php  echo date('H:i:s', $row['createtime'])?></td>
                    </tr>
                    <?php  } } ?>
                  
                </tbody>
            </table>
            <?php  echo $pager;?>
 
           
 
    </div>
</form>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>
 