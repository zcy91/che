<?php defined('IN_IA') or exit('Access Denied');?><div class='menu-header'>权限系统</div>

<ul>
    <?php  if(!empty($_W['accounttotal'])) { ?>
    <?php if(mcv('perm.role')) { ?><li <?php  if($_W['action']=='perm.role') { ?>class="active"<?php  } ?>><a href="<?php  echo merchUrl('perm/role')?>">角色</a></li><?php  } ?>
    <?php if(mcv('perm.user')) { ?><li <?php  if($_W['action']=='perm.user') { ?>class="active"<?php  } ?>><a href="<?php  echo merchUrl('perm/user')?>">操作员</a></li><?php  } ?>
    <?php  } ?>
    <?php if(mcv('perm.log')) { ?><li <?php  if($_W['action']=='perm.log') { ?>class="active"<?php  } ?>><a href="<?php  echo merchUrl('perm/log')?>">操作日志</a></li><?php  } ?>

</ul>
 