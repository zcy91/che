<?php defined('IN_IA') or exit('Access Denied');?><style type='text/css'>
    .mc-list a {
        position: relative;
    }
    .mc-list span  {

        float:right;margin-right:20px;
    }
</style>


<ul class="menu-head-top">
    <li <?php  if($_W['controller']=='apply') { ?> class="active" <?php  } ?>><a href="<?php  echo merchUrl('apply')?>">结算概述 <i class="fa fa-caret-right"></i></a></li>
</ul>

<div class='menu-header'>提现申请</div>
<ul class="mc-list">

    <?php if(mcv('merch.apply.list.status1')) { ?><li <?php  if($_W['routes']=='apply.list.status1') { ?>class="active"<?php  } ?>><a href="<?php  echo merchUrl('apply/list/status1')?>">待审核申请 <span class="text-primary"  id="status1">-</span></a></li><?php  } ?>
    <?php if(mcv('merch.apply.list.status2')) { ?><li <?php  if($_W['routes']=='apply.list.status2') { ?>class="active"<?php  } ?>><a href="<?php  echo merchUrl('apply/list/status2')?>">待结算申请 <span class="text-primary"  id="status2">-</span></a></li><?php  } ?>
    <?php if(mcv('merch.apply.list.status3')) { ?><li <?php  if($_W['routes']=='apply.list.status3') { ?>class="active"<?php  } ?>><a href="<?php  echo merchUrl('apply/list/status3')?>">已结算申请 <span class="text-success"  id="status3">-</span></a></li><?php  } ?>
    <?php if(mcv('merch.apply.list.status_1')) { ?><li <?php  if($_W['routes']=='apply.list.status_1') { ?>class="active"<?php  } ?>><a href="<?php  echo merchUrl('apply/list/status_1')?>">已无效申请 <span class="text-success"  id="status_1">-</span></a></li><?php  } ?>
    <?php if(mcv('merch.apply.list.add')) { ?><li <?php  if($_W['routes']=='apply.list.add') { ?>class="active"<?php  } ?>><a href="<?php  echo merchUrl('apply/list/add')?>">申请提现</a></li><?php  } ?>
	
</ul>

<script language="javascript">
    $(function(){
        $.ajax({
            url: "<?php  echo merchUrl('apply/list/ajaxgettotals')?>",
            dataType:'json',
            cache:false,
            success:function(ret){
                $('#status1').html( ret.result.status1);
                $('#status2').html( ret.result.status2);
                $('#status3').html( ret.result.status3);
                $('#status_1').html( ret.result.status_1);
            }
        });

    });
</script>