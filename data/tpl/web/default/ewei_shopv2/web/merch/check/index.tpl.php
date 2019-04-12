<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>


<div class="page-heading">
    <h2><?php  echo $applytitle;?>提现申请</h2>
</div>

<form action="./index.php" method="get" class="form-horizontal table-search" role="form">
    <input type="hidden" name="c" value="site" />
    <input type="hidden" name="a" value="entry" />
    <input type="hidden" name="m" value="ewei_shopv2" />
    <input type="hidden" name="do" value="web" />
    <input type="hidden" name="r" value="merch.check.status<?php  echo $action_status;?>" />
    <div class="page-toolbar row m-b-sm m-t-sm">
        <div class="col-sm-6">

            <div class="btn-group btn-group-sm" style='float:left'>
                <button class="btn btn-default btn-sm"  type="button" data-toggle='refresh'><i class='fa fa-refresh'></i></button>

            </div>


            <div class='input-group input-group-sm'   >

                <select name='timetype'   class='form-control  input-sm select-md'   style="width:95px;"  >
                    <option value=''>不按时间</option>
                    <?php  if($status>=1) { ?><option value='applytime' <?php  if($_GPC['timetype']=='applytime') { ?>selected<?php  } ?>>申请时间</option><?php  } ?>
                    <?php  if($status>=2) { ?><option value='checktime' <?php  if($_GPC['timetype']=='checktime') { ?>selected<?php  } ?>>审核时间</option><?php  } ?>
                    <?php  if($status>=3) { ?><option value='paytime' <?php  if($_GPC['timetype']=='paytime') { ?>selected<?php  } ?>>打款时间</option><?php  } ?>
                </select>

                <?php  echo tpl_form_field_daterange('time', array('starttime'=>date('Y-m-d H:i', $starttime),'endtime'=>date('Y-m-d H:i', $endtime)),true);?>

            </div>
        </div>

        <div class="col-sm-6 pull-right">
            <select name='searchfield'  class='form-control  input-sm select-md'   style="width:110px;"  >
                <option value='member' <?php  if($_GPC['searchfield']=='member') { ?>selected<?php  } ?>>商户信息</option>
                <option value='applyno' <?php  if($_GPC['searchfield']=='applyno') { ?>selected<?php  } ?>>提现单号</option>
            </select>
            <div class="input-group">
                <input type="text" class="form-control input-sm"  name="keyword" value="<?php  echo $_GPC['keyword'];?>" placeholder="请输入关键词"/>
				<span class="input-group-btn">
					<button class="btn btn-sm btn-primary" type="submit"> 搜索</button>
					   <?php if(cv('merch.check.export')) { ?>
							<button type="submit" name="export" value="1" class="btn btn-success btn-sm">导出</button>
							<?php  } ?>
				</span>
            </div>

        </div>
    </div>
</form>

<?php  if(count($list)>0) { ?>
<table class="table table-hover table-responsive">
    <thead class="navbar-inner">
    <tr>
        <!--<th style="width:25px;"><input type='checkbox' /></th>-->
        <th style="width:200px;">提现单号</th>
        <th style="width:120px;">商户信息</th>
        <th style="width:110px;">申请金额<br>抽成后金额</th>
        <?php  if($status > 1) { ?>
        <th style="width:110px;">通过申请金额<br>抽成后金额</th>
        <?php  } ?>
        <?php  if($status == 3) { ?>
        <th style="width:100px;">实际打款金额</th>
        <?php  } ?>
        <th style="width:100px;">抽成比例</th>
        <th style="width:120px;">申请订单个数<?php  if($status > 1) { ?><br>通过申请订单个数<?php  } ?></th>
        <th style="width:100px;">提现方式</th>
        <?php  if($_W['routes']=='merch.check.status2') { ?>
        <th style="width:80px;">最终打款</th>
        <?php  } ?>
        <th style="width:100px;">申请时间</th>
        <th style="width:100px;">操作</th>
    </tr>
    </thead>
    <tbody>
    <?php  if(is_array($list)) { foreach($list as $row) { ?>
    <tr>
        <!--<td style="position: relative; "><input type='checkbox'   value="<?php  echo $row['id'];?>"/></td>-->
        <td><?php  echo $row['applyno'];?></td>
        <td><?php  echo $row['realname'];?><br/><?php  echo $row['mobile'];?></td>
        <td><?php  echo $row['realprice'];?><br><?php  echo $row['realpricerate'];?></td>
        <?php  if($status > 1) { ?>
        <td><?php  echo $row['passrealprice'];?><br><?php  echo $row['passrealpricerate'];?></td>
        <?php  } ?>
        <?php  if($status == 3) { ?>
        <td><?php  echo $row['finalprice'];?></td>
        <?php  } ?>
        <td><?php  echo $row['payrate'];?>%</td>
        <td><?php  echo $row['ordernum'];?><?php  if($status > 1) { ?><br><?php  echo $row['passordernum'];?><?php  } ?></td>
        <td>
            <span class='label <?php  if(empty($row['applytype'])) { ?>label-success<?php  } else if($row['applytype']=='2') { ?>label-warning<?php  } else if($row['applytype']=='3') { ?>label-primary<?php  } ?>'>
            <?php  echo $apply_type[$row['applytype']];?>
            </span>
        </td>
        <?php  if($_W['routes']=='merch.check.status2') { ?>
        <td><?php  echo $row['finalprice'];?></td>
        <?php  } ?>
        <td>
            <?php  echo date('Y-m-d',$row['applytime'])?><br/><?php  echo date('H:i',$row['applytime'])?>
        </td>
        <td style="overflow:visible;">
            <?php if(cv('merch.check.detail')) { ?>
                <a class='btn btn-default btn-sm' href="<?php  echo webUrl('merch/check/detail',array('id' => $row['id'], 'status' => $status))?>">详情</a>
            <?php  } ?>
            <?php  if($row['status'] != '2') { ?>
                <!--<a data-toggle='ajaxRemove' href="<?php  echo webUrl('merch/check/delete',array('id' => $row['id']));?>" class="btn btn-danger btn-sm" data-confirm='确认要删除此结账单?'>删除</a>-->
            <?php  } ?>
        </td>
    </tr>
    <?php  } } ?>
    </tbody>
</table>
<?php  } else { ?>
<div class='panel panel-default'>
    <div class='panel-body' style='text-align: center;padding:30px;'>
        暂时没有任何申请!
    </div>
</div>
<?php  } ?>
<?php  echo $pager;?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>