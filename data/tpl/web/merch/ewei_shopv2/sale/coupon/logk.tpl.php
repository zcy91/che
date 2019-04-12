<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<div class="page-heading"> 
	
	<span class='pull-right'>
 
                
		<a class="btn btn-default  btn-sm" href="<?php  echo webUrl('sale/car')?>">返回列表</a>
                
                
	</span>
    <h2>洗车卡记录 <small><?php  if(!empty($car)) { ?>洗车卡: <?php  echo $car['couponname'];?><?php  } ?> 总数: <span class="text-danger"><?php  echo $total;?></span></small></h2>
</div>


<form action="" method="get" class="form-horizontal" role="form" id="form1">
    <input type="hidden" name="c" value="site" />
    <input type="hidden" name="a" value="entry" />
    <input type="hidden" name="m" value="ewei_shopv2" />
    <input type="hidden" name="do" value="web" />
    <input type="hidden" name="r" value="sale.coupon.logk" />
    <input type="hidden" name="couponid" value="<?php  echo $couponid;?>" />
	
    <?php  if(empty($car)) { ?>

    <div class="page-toolbar row m-b-sm m-t-sm">
        <div class="col-sm-12 pull-right">
		
        </div>
    </div>
    <div class="page-toolbar row m-b-sm m-t-sm">
        <div class="col-sm-12 pull-right">

            <div class="input-group">
                <input type="text" class="input-sm form-control" name='keyword' value="<?php  echo $_GPC['keyword'];?>" placeholder="请输入核销码"> 
				<span class="input-group-btn">
				<button class="btn btn-sm btn-primary" type="submit"> 搜索</button> 
				<?php if(mcv('sale.car.log.export')) { ?>
				<button type="submit" name="export" value="1" class="btn btn-success btn-sm">导出</button>
				<?php  } ?>
                </span>
            </div>
		
        </div>
    </div>
    <?php  } else { ?>
    <div class="page-toolbar row m-b-sm m-t-sm">
        <div class="col-sm-12 pull-right">
            <div class='input-group input-group-sm'  style='float:left;'  >
                <?php  echo tpl_daterange('time', array('sm'=>true,'placeholder'=>'获得时间'),true);?>
            </div>
            <div class='input-group input-group-sm'  style='float:left;'  >
                <?php  echo tpl_daterange('time1', array('sm'=>true,'placeholder'=>'使用时间'),true);?>
            </div>
            <div class="input-group">



                <button class="btn btn-sm btn-primary" type="submit"> 搜索</button>
                <?php if(mcv('sale.car.log.export')) { ?>
                <button type="submit" name="export" value="1" class="btn btn-success btn-sm">导出</button>
                <?php  } ?>

            </div>

        </div></div>
    <?php  } ?>

</form>

<?php  if(count($list)>0) { ?>
<table class="table table-hover table-responsive">
    <thead class="navbar-inner" >
    <tr>

        <th style='width:150px;'>洗车卡名称</th>
        <th style='width:90px;'>会员信息</th>
        <th style='width:100px;'></th>
        <th style='width:80px;'>获得方式</th>
        <th style='width:100px;'>获得时间</th>
		
		<th style='width:100px;'>车牌号</th>
        <th style='width:100px;'>核销码</th>
		<th style='width:100px;'>次/月剩余</th>
		<th style='width:100px;'>状态</th>
    </tr>
    </thead>
    <tbody>
    <?php  if(is_array($list)) { foreach($list as $row) { ?>
    <tr>

        <td>
		<?php  echo $row['couponname'];?>
        </td>
        <td>
            <span data-toggle='tooltip'  title='<?php  echo $row['nickname'];?>'>
            <img src='<?php  echo $row['avatar'];?>' style='width:30px;height:30px;padding1px;border:1px solid #ccc' />
            <?php  if(empty($row['nickname'])) { ?>未更新<?php  } else { ?><?php  echo $row['nickname'];?><?php  } ?></span>
        </td>
        <td>
            <?php  echo $row['realname'];?><br/><?php  echo $row['mobile'];?>
        </td>
        <td><?php  echo $row['gettypestr'];?></td>
        <td><?php  echo date('Y-m-d',$row['gettime'])?><br/><?php  echo date('H:i',$row['gettime'])?></td>
       
        <td><?php echo empty($row['chepai'])?'---':$row['chepai']?></td>
		<td><?php echo empty($row['hexiaoma'])?'---':$row['hexiaoma']?></td>
		<td>
				<?php  echo $row['discount2'];?>次
			</td>
		<?php  if($row['backtype'] ==1) { ?>
			
			 
			<td>	
			<?php  if($row['discount2'] ==0) { ?>
			本月已使用完
			<?php  } else { ?>
			<a class='btn btn-default  btn-sm'  href="<?php  echo webUrl('sale/coupon/logk/update',array('id' => $row['id']));?>" data-confirm="确定要关闭该洗车卡吗？">关闭一次</a>
			<?php  } ?>
			</td>
		<?php  } ?>
		
		
		
    </tr>
    <?php  } } ?>
    </tbody>
</table>
<?php  echo $pager;?>
<?php  } else { ?>
<div class='panel panel-default'>
    <div class='panel-body' style='text-align: center;padding:30px;'>
        请搜索关闭本次使用!
    </div>
</div>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>