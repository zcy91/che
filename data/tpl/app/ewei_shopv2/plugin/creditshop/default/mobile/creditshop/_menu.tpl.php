<?php defined('IN_IA') or exit('Access Denied');?><div class="fui-navbar">
	<a href="<?php  echo mobileUrl('creditshop/index')?>" class="external nav-item <?php  if($_W['routes'] == 'creditshop.index') { ?>active<?php  } ?>">
		<span class="icon icon-home"></span>
		<span class="label">首页</span>
	</a>
	<a href="<?php  echo mobileUrl('creditshop/lists')?>" class="external nav-item <?php  if($_W['routes'] == 'creditshop.lists') { ?>active<?php  } ?>">
		<span class="icon icon-list"></span>
		<span class="label">全部商品</span>
	</a>
	<a href="<?php  echo mobileUrl('sign')?>" class="external nav-item">
		<span class="icon icon-gifts"></span>
		<span class="label"><?php  echo $_W['shopset']['trade']['credittext'];?>签到</span>
	</a>
	<a href="<?php  echo mobileUrl('creditshop/log')?>" class="external nav-item <?php  if($_W['routes'] == 'creditshop.log') { ?>active<?php  } ?>">
		<span class="icon icon-people"></span>
		<span class="label">我的</span>
	</a>
</div>

<?php  $this->followBar()?>