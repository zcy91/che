<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>

<div class='fui-page  fui-page-current'>
    <div class="fui-header">
        <div class="fui-header-left">
            <a class="back"></a>
        </div>
        <div class="title">扫码付款</div>
        <div class="fui-header-right">&nbsp;</div>
    </div>
    <div class='fui-content navbar' >
	 <form method='post' action="" >
    <div class='fui-cell-group fui-cell-group-o'>

            <div class='fui-cell-title'>
                <div class='fui-cell-info' style='color:#999'>当前余额: ￥<span id='current'><?php  echo number_format($credit,2)?></span></div>
            </div>

			
            <div class='fui-cell'>
                <div class='fui-cell-label big' style='width:auto;'>￥</div>
                <div class='fui-cell-info'><input type='number' name="money" class='fui-input' id='money' style='font-size:1.2rem;' ></div>
            </div>
			
		<input type="submit" value="提交" class="btn btn-success block"/>
    </div>
   </form>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>