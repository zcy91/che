<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<link rel="stylesheet" type="text/css" href="../addons/ewei_shopv2/template/mobile/default/static/css/coupon.css?v=2.0.0">
<div class='fui-page fui-page-current coupon-detail-page'>
	<div class="fui-header">
		<div class="fui-header-left">
			<a class="back"></a>
		</div>
		<div class="title">优惠券详情</div>
		<div class="fui-header-right">
			<a href="<?php  echo mobileUrl('sale/coupon')?>" class="external">
				<i class="icon icon-home"></i>
			</a>
		</div>
	</div>
	<div class='fui-content'>
		<div class="coupon-detail">
			<div class="coupon-detail-head <?php  echo $coupon['color'];?>">
				<div class="coupon-detail-head-title">
					<h2><?php  echo $coupon['couponname'];?></h2>
					<p>有效期:<?php  if($coupon['timestr']=='0') { ?>
						永久有效
						<?php  } else { ?>
						<?php  if($coupon['timestr']=='1') { ?>
						即<?php  echo $coupon['gettypestr'];?>日内 <?php  echo $coupon['timedays'];?> 天有效
						<?php  } else { ?>
						有效期 <?php  echo $coupon['timestr'];?>
						<?php  } ?>
						<?php  } ?>
						<?php  if(!empty($coupon['merchname'])) { ?>
						限购[<?php  echo $coupon['merchname'];?>]店铺商品
						<?php  } ?></p>
				</div>
				<div class="coupon-detail-head-info">
					<span><?php  echo $coupon['title2'];?><?php  echo $coupon['title3'];?></span>
					<?php  if($coupon['canget']===false) { ?>
						<a href="javascript:void(0);"><p  style="color:#ccc;">已达到<?php  echo $coupon['gettypestr'];?>上限</p></a>
					<?php  } else if($pass) { ?>
						<a href="javascript:void(0);"  id="btncoupon"><p>立即<?php  echo $coupon['gettypestr'];?></p></a>
					<?php  } else { ?>
						<a href="javascript:void(0);"><p>未达到<?php  echo $coupon['gettypestr'];?>权限</p></a>
					<?php  } ?>
				</div>
				<div class="coupon-detal-bot">
					<i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i>
					<i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i>
				</div>
			</div>
			<div class="coupon-detail-content">
				<div class="coupon-detail-content-info">
					<div class="coupon-detail-content-info-top">
						<strong>领取限制</strong>
						<?php  if($coupon['islimitlevel']=='1') { ?>
							<p>用户必须达到以下条件之一:</p>
							<?php  if(!empty($coupon['limitmemberlevels'])|| $coupon['limitmemberlevels']==='0') { ?>
								<p>		会员:  <?php  echo $meblvname;?>
									<?php  if(is_array($level1)) { foreach($level1 as $l1) { ?>
										<?php  echo $l1['levelname'];?>
									<?php  } } ?>
								</p>
							<?php  } ?>
							<?php  if((!empty($coupon['limitagentlevels']) || $coupon['limitagentlevels']==='0')&&$hascommission) { ?>
								<p>		<?php  echo $leveltitle2;?>:
									<?php  if(in_array("0",$limitagentlevels)) { ?>
										<?php  echo $commissionname;?>
									<?php  } ?>
									<?php  if(is_array($level2)) { foreach($level2 as $l2) { ?>
									<?php  echo $l2['levelname'];?>
									<?php  } } ?>
								</p>
							<?php  } ?>
							<?php  if((!empty($coupon['limitpartnerlevels']) || $coupon['limitpartnerlevels']==='0')&&$hasglobonus) { ?>
								<p>	<?php  echo $leveltitle3;?>:  <?php  echo $globonuname;?>
									<?php  if(is_array($level3)) { foreach($level3 as $l3) { ?>
									<?php  echo $l3['levelname'];?>
									<?php  } } ?>
								</p>
							<?php  } ?>
							<?php  if((!empty($coupon['limitaagentlevels']) || $coupon['limitaagentlevels']==='0')&&$hasabonus) { ?>
								<p>	<?php  echo $leveltitle4;?>:  <?php  echo $abonuname;?>
									<?php  if(is_array($level4)) { foreach($level4 as $l4) { ?>
									<?php  echo $l4['levelname'];?>
									<?php  } } ?>
								</p>
							<?php  } ?>
						<?php  } ?>
						<?php  if($coupon['islimitlevel']=='0') { ?>
							<p>无</p>
						<?php  } ?>

						<strong>有效期限</strong>
						<p style="font-weight: bold; color:#000;;"><?php  if($coupon['timestr']=='0') { ?>
							永久有效
							<?php  } else { ?>
							<?php  if($coupon['timestr']=='1') { ?>
							即<?php  echo $coupon['gettypestr'];?>日内 <?php  echo $coupon['timedays'];?> 天有效
							<?php  } else { ?>
							有效期 <?php  echo $coupon['timestr'];?>
							<?php  } ?>
							<?php  } ?>
							<?php  if(!empty($coupon['merchname'])) { ?>
							限购[<?php  echo $coupon['merchname'];?>]店铺商品
							<?php  } ?></p>
					</div>
					<div class="coupon-detail-content-info-top">
						<strong>使用说明</strong>

						<?php  if(empty($coupon['descnoset'])) { ?>
							<?php  if(empty($coupon['coupontype'])) { ?>
								<?php  echo htmlspecialchars_decode($set['consumedesc'])?>
							<?php  } else { ?>
								<?php  echo htmlspecialchars_decode($set['rechargedesc'])?>
							<?php  } ?>
						<?php  } else { ?>
							<p><?php  echo $coupon['desc'];?></p>
						<?php  } ?>
					</div>
					<div class="coupon-detail-content-info-bot">
						<strong>使用限制</strong>

						<?php  if($coupon['coupontype']=='2') { ?>
						<p>本优惠卷只能在收银台中使用</p>
						<?php  } ?>

						<?php  if($coupon['limitdiscounttype']=='1') { ?>
							<p>不允许与促销优惠同时使用</p>
						<?php  } else if($coupon['limitdiscounttype']=='2') { ?>
							<p>不允许与会员折扣同时使用</p>
						<?php  } else if($coupon['limitdiscounttype']=='3') { ?>
							<p>不允许与促销优惠和会员折扣同时使用</p>
						<?php  } ?>
						<?php  if($coupon['limitgoodtype']=='1') { ?>
						<p>允许以下商品使用:</p>
						<p>
							<?php  if(is_array($goods)) { foreach($goods as $g) { ?>
						<p><?php  echo $g['title'];?></p>
							<?php  } } ?>

						</p>
						<?php  } ?>
						<?php  if($coupon['limitgoodtype']=='1') { ?>
						<p>允许以下商品分类使用:</p>
						<p>
							<?php  if(is_array($category)) { foreach($category as $c) { ?>
							<?php  echo $c['name'];?>&nbsp;
							<?php  } } ?>
						</p>
						<?php  } ?>
						<?php  if($coupon['limitgoodtype']=='0'&& $coupon['limitgoodtype']=='0'&&$coupon['limitdiscounttype']=='0'&&$coupon['coupontype']!='2') { ?>
						<p>无</p>
						<?php  } ?>
					</div>
				</div>
			</div>
		</div>

		<script language='javascript'>
			require(['biz/sale/coupon/detail'], function (modal) {
				modal.init({coupon: <?php  echo json_encode($coupon)?>});
			});
		</script>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>