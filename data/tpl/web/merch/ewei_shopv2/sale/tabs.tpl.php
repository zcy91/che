<?php defined('IN_IA') or exit('Access Denied');?><?php  if(mcom("sale")) { ?>
<?php if(mcv('sale.deduct|sale.enough|sale.enoughfree|sale.recharge')) { ?>
<div class='menu-header'>基本</div>
<ul>
   <?php if(mcv('sale.enough')) { ?><li <?php  if($_W['routes']=='sale.enough') { ?>class="active"<?php  } ?>><a href="<?php  echo merchUrl('sale/enough')?>">满额立减</a></li><?php  } ?>
   <?php if(mcv('sale.enoughfree')) { ?><li <?php  if($_W['routes']=='sale.enoughfree') { ?>class="active"<?php  } ?>><a href="<?php  echo merchUrl('sale/enoughfree')?>">满额包邮</a></li><?php  } ?>
</ul>
<?php  } ?>
<?php  } ?>
<?php  if(mcom("coupon")) { ?>
<?php if(mcv('sale.coupon.view|sale.coupon.category|sale.coupon.log|sale.coupon.set|sale.coupon.logs')) { ?>
  <div class='menu-header'>优惠券</div>
  <ul>
   <?php if(mcv('sale.coupon.view')) { ?><li <?php  if($_W['routes']=='sale.coupon') { ?>class="active"<?php  } ?>><a href="<?php  echo merchUrl('sale/coupon')?>">优惠券管理</a></li><?php  } ?>
   <?php if(mcv('sale.coupon.category')) { ?><li <?php  if($_W['routes']=='sale.coupon.category') { ?>class="active"<?php  } ?>><a href="<?php  echo merchUrl('sale/coupon/category')?>">分类</a></li><?php  } ?>
   <?php if(mcv('sale.coupon.log')) { ?><li <?php  if($_W['routes']=='sale.coupon.log') { ?>class="active"<?php  } ?>><a href="<?php  echo merchUrl('sale/coupon/log')?>">发放记录</a></li><?php  } ?>
   <?php if(mcv('sale.coupon.set')) { ?><li <?php  if($_W['routes']=='sale.coupon.set') { ?>class="active"<?php  } ?>><a href="<?php  echo merchUrl('sale/coupon/set')?>">设置</a></li><?php  } ?>
   <?php if(mcv('sale.coupon.logs')) { ?><li <?php  if($_W['routes']=='sale.coupon.logs') { ?>class="active"<?php  } ?>><a href="<?php  echo merchUrl('sale/coupon/logs')?>">洗车卷使用记录</a></li><?php  } ?>
   <?php if(mcv('sale.coupon.logk')) { ?><li <?php  if($_W['routes']=='sale.coupon.logk') { ?>class="active"<?php  } ?>><a href="<?php  echo merchUrl('sale/coupon/logk')?>">洗车卡记录</a></li><?php  } ?>
   <?php if(mcv('sale.coupon.logkjl')) { ?><li <?php  if($_W['routes']=='sale.coupon.logkjl') { ?>class="active"<?php  } ?>><a href="<?php  echo merchUrl('sale/coupon/logkjl')?>">洗车卡使用记录</a></li><?php  } ?>
   </ul>
<?php  } ?>
<?php  } ?>