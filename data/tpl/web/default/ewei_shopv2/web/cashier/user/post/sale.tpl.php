<?php defined('IN_IA') or exit('Access Denied');?><div class="form-group">
	<label class="col-sm-2 control-label">可用优惠卷</label>
	<div class="col-sm-8 col-xs-12">
		<?php if( ce('cashier.user' ,$item) ) { ?>
			<?php  echo tpl_selector('couponid',array(
			'preview'=>true,
			'readonly'=>true,
			'multi'=>1,
			'value'=>null,
			'url'=>webUrl('sale/coupon/querycoupons'),
			'items'=>$coupon,
			'buttontext'=>'选择优惠券',
			'placeholder'=>'请选择优惠券')
			)
			?>
		<?php  } else { ?>
		<div class="input-group multi-img-details container ui-sortable">
			<?php  if(is_array($coupon)) { foreach($coupon as $print) { ?>
			<div data-name="printerid" data-id="<?php  echo $print['id'];?>" class="multi-item">
				<img src="<?php  echo tomedia($print['thumb'])?>" class="img-responsive img-thumbnail">
				<div class="img-nickname"><?php  echo $print['title'];?></div>
			</div>
			<?php  } } ?>
		</div>
		<?php  } ?>
	</div>
</div>