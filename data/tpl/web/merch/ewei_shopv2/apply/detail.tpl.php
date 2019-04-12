<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>

<div class="page-heading">

    <h2>提现申请信息
        <small>申请单号: <?php  echo $item['applyno'];?></small>
    </h2>
</div>
<div class="step-region" >
    <ul class="ui-step ui-step-4" >
        <li <?php  if($item['status']>=1) { ?>class="ui-step-done"<?php  } ?>>
        <div class="ui-step-title" >申请中</div>
        <div class="ui-step-number" >1</div>
        <div class="ui-step-meta" ><?php  if(1<=$item['status']) { ?><?php  echo date('Y-m-d',$item['applytime'])?><br/><?php  echo date('H:i:s',$item['applytime'])?><?php  } ?></div>
        </li>
        <li  <?php  if($item['status']>=2) { ?>class="ui-step-done"<?php  } ?>>
        <div class="ui-step-title">商家审核</div>
        <div class="ui-step-number">2</div>
        <div class="ui-step-meta"><?php  if(2<=$item['status']) { ?><?php  echo date('Y-m-d',$item['checktime'])?><br/><?php  echo date('H:i:s',$item['checktime'])?><?php  } ?></div>
        </li>
        <li <?php  if($item['status']>=3) { ?>class="ui-step-done"<?php  } ?>>
        <div class="ui-step-title">商家打款</div>
        <div class="ui-step-number" >3</div>
        <div class="ui-step-meta" ><?php  if(3<=$item['status']) { ?><?php  echo date('Y-m-d',$item['paytime'])?><br/><?php  echo date('H:i:s',$item['paytime'])?><?php  } ?></div>
        </li>
        <li <?php  if($item['status']==-1) { ?>class="ui-step-done"<?php  } ?>>
        <div class="ui-step-title">无效</div>
        <div class="ui-step-number" >!</div>
        <div class="ui-step-meta" ><?php  if(-1==$item['status']) { ?><?php  echo date('Y-m-d',$item['invalidtime'])?><br/><?php  echo date('H:i:s',$item['invalidtime'])?><?php  } ?></div>
        </li>
    </ul>
</div>


<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('apply/box', TEMPLATE_INCLUDEPATH)) : (include template('apply/box', TEMPLATE_INCLUDEPATH));?>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('apply/applytype', TEMPLATE_INCLUDEPATH)) : (include template('apply/applytype', TEMPLATE_INCLUDEPATH));?>

<form action="./merchant.php" method="get" class="form-horizontal" role="form" id="form1">
    <input type="hidden" name="c" value="site"/>
    <input type="hidden" name="a" value="entry"/>
    <input type="hidden" name="m" value="ewei_shopv2"/>
    <input type="hidden" name="do" value="web"/>
    <input type="hidden" name="id" value="<?php  echo $id;?>"/>
    <input type="hidden" name="r" value="apply.detail"/>

    <div class="page-toolbar row m-b-sm m-t-sm">

        <div class="col-sm-7 pull-right">
            <div class="input-group">
                <input type="text" class="form-control input-sm" name="keyword" value="<?php  echo $_GPC['keyword'];?>"
                       placeholder="订单编号"/>
             <span class="input-group-btn">

            <button class="btn btn-sm btn-primary" type="submit"> 搜索</button>
            <?php if(mcv('merch.apply.detail.export')) { ?>
            <button type="submit" name="export" value="1" class="btn btn-success btn-sm">导出</button>
            <?php  } ?>
            </span>
            </div>

        </div>
    </div>


</form>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('apply/table', TEMPLATE_INCLUDEPATH)) : (include template('apply/table', TEMPLATE_INCLUDEPATH));?>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>