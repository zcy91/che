<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<link rel="stylesheet" type="text/css" href="../addons/ewei_shopv2/template/mobile/default/static/css/coupon.css?v=2.0.0">
<div class='fui-page fui-page-current coupon-detail-page'>
	<div class="fui-header">
		<div class="fui-header-left">
			<a class="back"></a>
		</div>
		<div class="title">洗车券详情</div>
		<div class="fui-header-right">
			<a href="<?php  echo mobileUrl('sale/car/my')?>" class="external">
				<i class="icon icon-home"></i>
			</a>
		</div>
	</div>

	<div class='fui-content'>
		<div class="coupon-detail">
			<div class="coupon-detail-head <?php  echo $coupon['color'];?>">
				<div class="coupon-detail-head-title">
					<h2><?php  echo $car['couponname'];?></h2>
					<p>有效期:<?php  if($car['timestr']=='0') { ?>
						永久有效
						<?php  } else { ?>
						<?php  if($car['timestr']=='1') { ?>
						即<?php  echo $car['gettypestr'];?>日内 <?php  echo $car['timedays'];?> 天有效
						<?php  } else { ?>
						<?php  echo $car['timestr'];?>
						<?php  } ?>
						<?php  } ?>
						<?php  if(!empty($car['merchname'])) { ?>
						限购[<?php  echo $car['merchname'];?>]店铺商品
						<?php  } ?></p>
				</div>
				<div class="coupon-detail-head-info">
					<span><?php  echo $car['title2'];?><?php  echo $car['title3'];?></span>
					<?php  if(!empty($car['used'])) { ?>
						<a  href="javascript:void(0);">	<p>已使用</p></a>
					<?php  } else if($car['past']) { ?>
						<a  href="javascript:void(0);">	<p>已过期</p></a>
					<?php  } else { ?>
						<a  href="<?php  echo $useurl;?>">
							<p>
								<?php  if(empty($car['coupontype'])) { ?>
									立即去选商品使用
								<?php  } else if($car['coupontype']=='1') { ?>
									立即去充值
								<?php  } else { ?>
									返回我的洗车卷
								<?php  } ?>
							</p>
						</a>
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
						<strong>拥有数量</strong>
						<p>
							<?php  if($num>0) { ?>
								共 <?php  echo $num;?> 张
							<?php  } ?>
						</p>
					</div>

					<div class="coupon-detail-content-info-top">

						<strong>使用说明</strong>
							<p><?php  echo $car['desc'];?></p>

					</div>
					<div class="coupon-detail-content-info-bot">
						<strong>使用限制</strong>

						<?php  if($car['coupontype']=='2') { ?>
						<p>本洗车卷只能在商户店中使用</p>
						<?php  } ?>

						<?php  if($car['limitdiscounttype']=='1') { ?>
							<p>不允许与促销优惠同时使用</p>
						<?php  } else if($car['limitdiscounttype']=='2') { ?>
							<p>不允许与会员折扣同时使用</p>
						<?php  } else if($car['limitdiscounttype']=='3') { ?>
							<p>不允许与促销优惠和会员折扣同时使用</p>
						<?php  } ?>
						<?php  if($car['limitgoodtype']=='1') { ?>
						<p>允许以下商品使用:</p>
						<p>
							<?php  if(is_array($goods)) { foreach($goods as $g) { ?>
								<p><?php  echo $g['title'];?></p>
							<?php  } } ?>
						</p>
						<?php  } ?>
						<?php  if($car['limitgoodtype']=='1') { ?>
							<p>允许以下商品分类使用:</p>
							<p>
								<?php  if(is_array($category)) { foreach($category as $c) { ?>
								<?php  echo $c['name'];?>&nbsp;
								<?php  } } ?>
							</p>
						<?php  } ?>
						<?php  if($car['limitgoodtype']=='0'&& $car['limitgoodtype']=='0'&&$car['limitdiscounttype']=='0'&&$car['coupontype']!='2') { ?>
						<p>无</p>
						<?php  } ?>
					</div>
					<?php  if(!empty($car['chepai'])) { ?>
					<div class="coupon-detail-content-info-bot">
						<strong>车牌号</strong>
						<p><?php  echo $car['chepai'];?></p>
					</div>
					<?php  } ?>
					<?php  if(!empty($car['hexiaoma'])) { ?>
					<div class="coupon-detail-content-info-bot">
						<strong>洗车卷核销码</strong>
						<p><?php  echo $car['hexiaoma'];?></p>
					</div>
					<?php  } ?>
					
					<div class="coupon-detail-content-info-bot">
						<strong>本月剩余次数</strong>
						<p><?php  echo $car['discount2'];?>次</p>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script language='javascript'>require(['biz/sale/car/mydetail'], function (modal) {modal.init();});</script>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>