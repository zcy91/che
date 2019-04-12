<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<div class='page-heading'>
    <span class='pull-right'>

				 	<a class='btn btn-primary btn-sm' href="<?php  echo webUrl('sale/car/add')?>"><i class='fa fa-plus'></i> 添加洗车券</a>
	 </span>
	<h2>洗车券管理 <small>总数: <span class='text-danger'><?php  echo $total;?></span> 排序数字越大越靠前显示</small></h2></div>


<form action="./index.php" method="get" class="form-horizontal table-search" role="form" id="form1">
	<input type="hidden" name="c" value="site" />
	<input type="hidden" name="a" value="entry" />
	<input type="hidden" name="m" value="ewei_shopv2" />
	<input type="hidden" name="do" value="web" />
	<input type="hidden" name="r" value="sale.car" />
	<div class="page-toolbar row m-b-sm m-t-sm">
		<div class="col-sm-1">

			<div class="input-group-btn">
				<button class="btn btn-default btn-sm"  type="button" data-toggle='refresh'><i class='fa fa-refresh'></i></button>

				<?php if(cv('sale.coupon.delete')) { ?>
				<button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle='batch-remove' data-confirm="确认要删除?" data-href="<?php  echo webUrl('sale/coupon/delete')?>"><i class='fa fa-trash'></i> 删除</button>
				<?php  } ?>


			</div>

		</div>


		<div class="col-sm-11 pull-right">
			<div class='input-group input-group-sm' style='float:left;'   >
				<?php  echo tpl_daterange('time', array('placeholder'=>'创建时间'),true);?>
			</div>
			
			<div class="input-group">
				<input type="text" class="input-sm form-control" name='keyword' value="<?php  echo $_GPC['keyword'];?>" placeholder="洗车券名称"> <span class="input-group-btn">
						
                                     <button class="btn btn-sm btn-primary" type="submit"> 搜索</button> </span>
			</div>

		</div>
	</div>
</form>

<?php  if(count($list)>0) { ?>
<table class="table table-hover table-responsive">
	<thead class="navbar-inner" >
	<tr>
		<th style="width:25px;"><input type='checkbox' /></th>
		<th style="width:50px;">排序</th>
		<th style="width:180px;">洗车券名称</th>
		<th style="width:120px;" >类型<br/>剩余数量</th>
		
		<th style="width:100px;">创建时间</th>
		<th>操作</th>
	</tr>
	</thead>
	<tbody>
	<?php  if(is_array($list)) { foreach($list as $row) { ?>
	<tr>
		<td>
			<input type='checkbox'   value="<?php  echo $row['id'];?>"/>
		</td>
		<td>
			<?php if(cv('sale.coupon.edit')) { ?>
			<a href='javascript:;' data-toggle='ajaxEdit' data-href="<?php  echo webUrl('sale/coupon/displayorder',array('id'=>$row['id']))?>" ><?php  echo $row['displayorder'];?></a>
			<?php  } else { ?>
			<?php  echo $row['displayorder'];?>
			<?php  } ?>
		</td>

		<td>
			<?php  if(!empty($row['catid'])) { ?>
			<label class='label label-primary'><?php  echo $category[$row['catid']]['name'];?></label>
			<?php  } ?>
			<?php  echo $row['couponname'];?>
		</td>
		
		<td>

			<?php  if($row['backtype']==0) { ?>
			免费洗车一次
			<?php  } else if($row['backtype']==1) { ?>
			<br/><?php  echo $row['discount'];?>次/月
			
			<?php  } ?>
			<br/>
			<?php if(cv('coupon.log.view')) { ?>
			<a href="<?php  echo webUrl('sale/coupon/log',array('couponid'=>$row['id']))?>"
			   data-toggle='popover'
			   data-html='true'
			   data-trigger='hover'
			   data-content="已使用: <?php  echo $row['usetotal'];?> <br/> 已发出: <?php  echo $row['gettotal'];?>">
				<?php  if($row['total']==-1) { ?>无限<?php  } else { ?><?php  echo $row['total'] -  $row['gettotal']?><?php  } ?> <i class='fa fa-question-circle'></i>
			</a>
			<?php  } else { ?>
			<span><?php  if($row['total']==-1) { ?>无限<?php  } else { ?><?php  echo $row['total'] -  $row['gettotal']?><?php  } ?></span>
			<?php  } ?>
		</td>



		
		<td><?php  echo date('Y-m-d',$row['createtime'])?><br/><?php  echo date('H:i',$row['createtime'])?></td>
		<td>

			<div class="btn-group btn-group-sm">
						
				<?php if(cv('sale.coupon.edit')) { ?>
				<a class='btn btn-default btn-sm' href="<?php  echo webUrl('sale/car/edit',array('id' => $row['id']));?>"><i class='fa fa-edit'></i> <?php if(cv('sale.coupon.edit')) { ?>编辑<?php  } else { ?>查看<?php  } ?></a>

				<?php  } ?>
				<?php if(cv('sale.coupon.delete')) { ?>
				<a class='btn btn-default  btn-sm' data-toggle='ajaxRemove' href="<?php  echo webUrl('sale/car/delete',array('id' => $row['id']));?>" data-confirm="确定要删除该优惠券吗？"><i class='fa fa-trash'></i> 删除</a>

				<?php  } ?>

				<?php if(cv('sale.coupon.send')) { ?>
				<a  class='btn btn-primary  btn-sm' href="<?php  echo webUrl('sale/car/send',array('couponid' => $row['id']));?>"><i class='fa fa-send'></i> 发放洗车券</a>

				<?php  } ?>

			</div>


		</td>
	</tr>
	<?php  } } ?>
	</tbody>

</table>
<?php  echo $pager;?>
<?php  } else { ?>
<div class='panel panel-default'>
	<div class='panel-body' style='text-align: center;padding:30px;'>
		暂时没有任何洗车券!
	</div>
</div>
<?php  } ?>
</form>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>