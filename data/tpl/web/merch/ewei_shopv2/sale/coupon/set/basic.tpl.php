<?php defined('IN_IA') or exit('Access Denied');?> 
     
	 <div class="form-group">
		<label class="col-sm-2 control-label">购物券优惠券统一使用说明</label>
		<div class="col-sm-9 col-xs-12">
			  <?php if(mcv('sale.coupon.set')) { ?>
                                 <?php  echo tpl_ueditor('data[consumedesc]',$data['consumedesc'],array('dest_dir'=>'merch/'.$_W['merchid']))?>
			   <span class='help-block'>统一说明会放到购物券单独说明的前面</span>
                            <?php  } else { ?>
                            <textarea id='consumedesc' style='display:none'><?php  echo $data['consumedesc'];?></textarea>
							
                            <a href='javascript:preview_html("#consumedesc")' class="btn btn-default">查看内容</a>
                            <?php  } ?>
		</div>
	</div>
		 
	 <div class="form-group">
		<label class="col-sm-2 control-label">充值优惠券统一使用说明</label>
		<div class="col-sm-9 col-xs-12">
			  <?php if(mcv('sale.coupon.set')) { ?>
                            <?php  echo tpl_ueditor('data[rechargedesc]',$data['rechargedesc'],array('dest_dir'=>'merch/'.$_W['merchid']))?>
							<span class='help-block'>统一说明会放到充值券单独说明的前面</span>
                            <?php  } else { ?>
                            <textarea id='rechargedesc' style='display:none'><?php  echo $data['rechargedesc'];?></textarea>
                            <a href='javascript:preview_html("#rechargedesc")' class="btn btn-default">查看内容</a>
                            <?php  } ?>
		</div>
	</div>

		 	
	 