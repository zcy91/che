<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>


<div class="page-heading"> 
	<span class='pull-right'>
		<?php if(cv('goods.virtual.data.add')) { ?>
							<a class='btn btn-primary  btn-sm' href="<?php  echo webUrl('goods/virtual/data/add', array('typeid'=>$_GPC['typeid']))?>"><i class="fa fa-plus"></i> 添加数据</a>
							<?php  } ?>
							<?php if(cv('goods.virtual.data.export')) { ?>
							<a class='btn btn-success  btn-sm' href="<?php  echo webUrl('goods/virtual/data/export', array('typeid'=>$_GPC['typeid']))?>"><i class="fa fa-download"></i> 导出已使用数据</a>
							<?php  } ?>
		<a class='btn btn-default btn-sm' href="<?php  echo webUrl('goods/virtual/temp')?>">返回列表</a> 
	</span>
	
	<h2>模板数据 <small>总数:<?php  echo $total;?>; 模板名称:<?php  echo $type['title'];?>)</small></h2>
	</div>
	
<form action="./index.php" method="get" class="form-horizontal" role="form">
                    <input type="hidden" name="c" value="site" />
                    <input type="hidden" name="a" value="entry" />
                    <input type="hidden" name="m" value="ewei_shopv2" />
                    <input type="hidden" name="do" value="web" />
                    <input type="hidden" name="r" value="goods.virtual.data" />
                    <input type="hidden" name="typeid" value="<?php  echo $type['id'];?>" />
<div class="page-toolbar row m-b-sm m-t-sm">
                            <div class="col-sm-4">
				 
			   <div class="input-group-btn">
			         <button class="btn btn-default btn-sm"  type="button" data-toggle='refresh'><i class='fa fa-refresh'></i></button>
				<?php if(cv('goods.virtual.data.delete')) { ?>	
			        <button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle='batch-remove' data-confirm="确认要删除?" data-href="<?php  echo webUrl('goods/virtual/data/delete', array('typeid'=>$_GPC['typeid']))?>"><i class='fa fa-trash'></i> 删除</button>
					<?php  } ?>
							
			   </div> 
                               </div>	
	  
			 
                            <div class="col-sm-6 pull-right">
			 		 
				<select name="status" class='form-control input-sm select-sm'>
					<option value="" <?php  if($_GPC['status'] == '') { ?> selected<?php  } ?>>状态</option>
					   <option value='0' <?php  if($_GPC['status']=='0') { ?>selected<?php  } ?>>未使用</option>
                                <option value='1' <?php  if($_GPC['status']=='1') { ?>selected<?php  } ?>>已使用</option>
				</select>	
				<div class="input-group">				 
                                        <input type="text" class="input-sm form-control" name='keyword' value="<?php  echo $_GPC['keyword'];?>" placeholder="请输入主键(key)进行搜索"> <span class="input-group-btn">
						
                                     <button class="btn btn-sm btn-primary" type="submit"> 搜索</button> </span>
                                </div>
								
                            </div>
</div>
  </form>
 
                <table class="table table-hover table-responsive">
                    <thead>
                        <tr>
                            <th style="width:25px;"><input type='checkbox' /></th>
                  
                            
                            <?php  if(is_array($type['fields'])) { foreach($type['fields'] as $key => $name) { ?>
							<th> <?php  echo $name;?> (<?php  echo $key;?>)</th>
                            <?php  } } ?>
                            <th style='text-align: center;width:80px;'>状态</th>
                           
                            <th>操作</th>
                        </tr>
                    </thead> 
                    <tbody>
                        <?php  if(is_array($items)) { foreach($items as $item) { ?>
                            <tr>
                              	<td>
									<?php  if(empty($item['openid'])) { ?><input type='checkbox'   value="<?php  echo $item['id'];?>"/><?php  } ?>
							</td>
                                
                                    
                                            <?php  $datas = iunserializer($item['fields'])?>
                                <?php  if(is_array($type['fields'])) { foreach($type['fields'] as $key => $name) { ?>
                                       <td> <?php  echo $datas[$key];?></td>
                                        <?php  } } ?>
                                  
                                
                                <td style='width:60px; text-align: center'>
                                    <?php  if(empty($item['openid'])) { ?><span style="color:green">未使用</span><?php  } else { ?><span style="color:red;">已使用</span><?php  } ?>
                                </td> 
                              
                           
                                <td>
									<div class='btn-group btn-group-sm'>
                                    <?php  if(empty($item['openid'])) { ?>
				    <?php if(cv('goods.virtual.data.edit')) { ?><a class='btn btn-default btn-sm' href="<?php  echo webUrl('goods/virtual/data/edit', array('id' => $item['id'],'typeid'=>$item['typeid']))?>"><i class='fa fa-edit'></i> <?php if(cv('goods.virtual.data.edit')) { ?>编辑<?php  } else { ?>查看<?php  } ?></a><?php  } ?>
                                        <?php if(cv('goods.virtual.data.delete')) { ?><a class='btn btn-default  btn-sm' data-toggle='ajaxRemove'  href="<?php  echo webUrl('goods/virtual/data/delete', array('typeid'=>$item['typeid'],'id' => $item['id']))?>" data-confirm="确认删除此条数据吗？"><i class='fa fa-trash'></i> 删除</a><?php  } ?>
 				    <?php  } else { ?>
				    <a class='btn btn-default  btn-sm' data-toggle='popover' data-content="
					   粉丝: <img src='<?php  echo tomedia($item['avatar'])?>' style='width:20px;height:20px;padding:1px;border:1px solid #ccc' /> <?php  echo $item['nickname'];?> <br/>
				  会员: <?php  echo $item['realname'];?>/<?php  echo $item['mobile'];?><br/>
				  订单: <a href='<?php  echo webUrl('order/detail',array('id'=>$item['orderid']))?>' target='_blank'> [<?php  echo $item['orderid'];?>]<?php  echo $item['ordersn'];?></a> <br/>
				  时间: <?php  echo date('Y-m-d H:i',$item['usetime'])?><br/>
				  价格: <?php  echo $item['price'];?>" data-placement='top' data-html='true'><i class='fa fa-user'></i> 购买情况  </a>						
                                    <?php  } ?>
									</div>
                                </td>
                            </tr>
 
                              
                        <?php  } } ?>
                 
                    </tbody>
                </table>
        <?php  echo $pager;?>
 

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>
