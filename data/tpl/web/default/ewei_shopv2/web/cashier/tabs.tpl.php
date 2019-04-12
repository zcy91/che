<?php defined('IN_IA') or exit('Access Denied');?><style type='text/css'>
	.clearing-list a {
		position: relative;
	}
	.clearing-list span  {
		float:right;margin-right:20px;
	}
</style>
<?php if(cv('cashier.user|cashier.category')) { ?>
<div class='menu-header'>收银台管理</div>
<ul>
	<li <?php  if($_GPC['r']=='cashier.user' || $_GPC['r']=='cashier.user.add' || $_GPC['r']=='cashier.user.edit') { ?> class="active"<?php  } ?>><a href="<?php  echo webUrl('cashier/user')?>">收银台管理</a></li>
	<li <?php  if($_GPC['r']=='cashier.category' || $_GPC['r']=='cashier.category.add' || $_GPC['r']=='cashier.category.edit') { ?> class="active"<?php  } ?>><a href="<?php  echo webUrl('cashier/category')?>">收银台分类</a></li>
</ul>
<?php  } ?>

<?php if(cv('cashier.clearing')) { ?>
<div class='menu-header'>收银台结算</div>
<ul class="clearing-list">
	<li <?php  if($_GPC['r']=='cashier.clearing'&&$_GPC['status']=='0') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('cashier/clearing',array('status'=>0))?>">待审核<span class="text-default status0">-</span></a></li>
	<li <?php  if($_GPC['r']=='cashier.clearing'&&$_GPC['status']=='1') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('cashier/clearing',array('status'=>1))?>">待结算<span class="text-warning status1">-</span></a></li>
	<li <?php  if($_GPC['r']=='cashier.clearing'&&$_GPC['status']=='2') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('cashier/clearing',array('status'=>2))?>">已结算<span class="text-success status2">-</span></a></li>
</ul>
<?php  } ?>

<?php if(cv('cashier.set')) { ?>
<div class='menu-header'>设置</div>
<ul>
	<li <?php  if($_GPC['r']=='cashier.set') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('cashier/set')?>">基础设置</a></li>
	<li <?php  if($_GPC['r']=='cashier.notice') { ?>class="active"<?php  } ?>><a href="<?php  echo webUrl('cashier/notice')?>">消息通知</a></li>
</ul>
<?php  } ?>

<?php if(cv('cashier.clearing')) { ?>
<script>
	$(function () {
		$.ajax({type: "GET",url: "<?php  echo webUrl('cashier/ajaxcleartotle')?>",dataType:"json",success: function(data){
			var res = data.result;
			$("span.status0").text(res.status0);
			$("span.status1").text(res.status1);
			$("span.status2").text(res.status2);
		}
		});
	});
</script>
<?php  } ?>