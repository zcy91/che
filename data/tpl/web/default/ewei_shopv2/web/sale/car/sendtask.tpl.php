<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<style type="text/css">
    .table_kf {display: none;}
    .table_kf.active {display: table-footer-group;}
</style>
<div class="page-heading">
    <span class='pull-right'>
        <?php if(cv('sale.car')) { ?>
            <?php  if($data['isopensendtask']==1) { ?>
                <a class='btn btn-danger btn-sm' href="<?php  echo webUrl('sale/car/sendtask/closetask')?>"><i class='fa fa-close'></i> 关闭功能</a>
            <?php  } else { ?>
                <a class='btn btn-warning btn-sm' href="<?php  echo webUrl('sale/car/sendtask/opentask')?>"><i class='fa fa-plus'></i> 开启功能</a>
            <?php  } ?>
            <a class='btn btn-primary btn-sm' href="<?php  echo webUrl('sale/car/sendtask/add')?>"><i class='fa fa-plus'></i> 添加任务</a>
        <?php  } ?>
    </span>
    <h2>发送任务</h2> </div>
    <ul class="nav nav-arrow-next nav-tabs" id="myTab">
        <li class="active" >
            <a href="<?php  echo webUrl('sale/car/sendtask')?>">满额送优惠券</a>
        </li>
        <li >
            <a href="<?php  echo webUrl('sale/car/goodssend')?>">购买指定商品送优惠券</a>
        </li>
    </ul>
    <form action="" method="post">
        <table class="table table-hover table-responsive">
            <thead class="navbar-inner">
            <tr>
                <th>满足价格</th>
                <th style="width: 70px">优惠券图片</th>
                <th style="width: 120px">优惠券名称</th>
                <th>赠送数量</th>
                <th  style="width: 200px">活动时间</th>
                <th>剩余数量</th>
                <th>状态</th>
                <th style="width:120px">操作</th>
            </tr>
            </thead>
            <tbody>
                <?php  if(count($sendtasks)>0) { ?>
                    <?php  if(is_array($sendtasks)) { foreach($sendtasks as $item) { ?>
                    <tr>
                        <td>
                            <?php  echo $item['enough'];?>
                        </td>
                        <td>
                            <img src="<?php  echo tomedia($item['thumb'])?>" style="width:40px;height:40px;padding:1px;border:1px solid #ccc;"  />
                        </td>
                        <td>
                            <?php  echo $item['couponname'];?>
                        </td>
                        <td>
                            <?php  echo $item['sendnum'];?>
                        </td>
                        <td>
                            <?php  echo date("Y-m-d ", $item['starttime'])?> - <?php  echo date("Y-m-d", $item['endtime'])?>
                        </td>
                        <td>
                            <?php  echo $item['num'];?>
                        </td>
                        <td>
                            <?php  if($item['status']==1) { ?>开启<?php  } else { ?>关闭<?php  } ?>
                        </td>
                        <td  style="overflow:visible;position:relative;text-align: right;">
                            <?php if(cv('sale.car')) { ?>
                                <a  class='btn btn-default btn-sm' href="<?php  echo webUrl('sale.car.sendtask/edit', array('id' => $item['id'],'page'=>$page))?>" title="<?php if(cv('sale.car')) { ?>编辑<?php  } else { ?>查看<?php  } ?>"><i class='fa fa-edit'></i> <?php if(cv('sale.car')) { ?>编辑<?php  } else { ?>查看<?php  } ?></a>
                            <?php  } ?>
                            <?php if(cv('sale.car')) { ?>
                                <a  class='btn btn-default btn-sm' data-toggle='ajaxRemove' href="<?php  echo webUrl('sale.car.sendtask/delete', array('id' => $item['id']))?>" data-confirm='确认要删除吗?？'><i class='fa fa-remove'></i> 删除</a>
                            <?php  } ?>
                        </td>
                    </tr>
                    <?php  } } ?>
                    <?php  } else { ?>
                    <td colspan="6" style="text-align: center;">暂时没有任何任务!</td>
                    <?php  } ?>
            </tbody>
        </table>
    </form>
<div style="text-align:right;width:100%;">
    <?php  echo $pager;?>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>
