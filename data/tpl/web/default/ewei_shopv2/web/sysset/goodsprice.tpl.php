<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<div class="page-heading"> <h2>商品价格修复</h2> </div>

<form class="form-horizontal form-search">
    <div class="form-group" >
        <label class="col-xs-12 col-sm-3 col-md-2 control-label must">修复价格为0问题</label>
        <div class="col-sm-9">
            <a data-toggle="ajaxPost" data-href="<?php  echo webUrl('goods/goodsprice')?>" class="btn btn-primary btn-sm"> 点击修复</a>
            <div class="help-block"> 价格有问题或者显示为空的可以点击此修复!</div>
        </div>
    </div>
</form>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>