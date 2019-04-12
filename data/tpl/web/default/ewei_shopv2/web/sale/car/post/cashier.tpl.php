<?php defined('IN_IA') or exit('Access Denied');?><div class="form-group">
    <label class="col-sm-2 control-label">优惠方式</label>
    <div class="col-sm-9 col-xs-12">
        <input type="hidden" name="coupontype" value="2"/>

         <label class="radio-inline " ><input type="radio" name="backtype" onclick='showbacktype(0)' value="0" <?php  if($item['backtype']==0) { ?>checked<?php  } ?>>洗车券</label>
         <label class="radio-inline"><input type="radio" name="backtype" onclick='showbacktype(1)' value="1" <?php  if($item['backtype']==1) { ?>checked<?php  } ?>>洗车卡</label>

    </div>
 </div>
 <div class="form-group">
    <label class="col-sm-2 control-label">新用户</label>
    <div class="col-sm-9 col-xs-12">
        <input type="hidden" name="coupontype" value="2"/>

         <label class="radio-inline " ><input type="radio" name="backtype2" value="1" <?php  if($item['backtype2']==1) { ?>checked<?php  } ?>>免费送</label>
         <label class="radio-inline"><input type="radio" name="backtype2" value="0" <?php  if($item['backtype2']==0) { ?>checked<?php  } ?>>取消</label>

    </div>
 </div>
<div class="form-group">
    <label class="col-sm-2 control-label"></label>
    <?php if( ce('sale.coupon' ,$item) ) { ?>


        <div class="col-sm-9 col-xs-12 backtype backtype1"  <?php  if($item['backtype']!=1) { ?>style='display:none'<?php  } ?>>
            <div class='input-group'>
                <span class='input-group-addon'>每月</span>
                <input type='number' class='form-control' name='discount' value="<?php  echo $item['discount'];?>"/>
                <span class='input-group-addon'>次</span>
             </div>
        </div>
    
    <?php  } ?>
</div>