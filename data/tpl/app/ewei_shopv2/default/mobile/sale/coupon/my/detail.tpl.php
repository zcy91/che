<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<link rel="stylesheet" type="text/css" href="../addons/ewei_shopv2/template/mobile/default/static/css/coupon.css?v=2.0.0">
<div class='fui-page fui-page-current coupon-detail-page'>
	<div class="fui-header">
		<div class="fui-header-left">
			<a class="back"></a>
		</div>
		<div class="title">优惠券详情</div>
		<div class="fui-header-right">
			<a href="<?php  echo mobileUrl('sale/coupon/my')?>" class="external">
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
						<?php  echo $coupon['timestr'];?>
						<?php  } ?>
						<?php  } ?>
						<?php  if(!empty($coupon['merchname'])) { ?>
						限购[<?php  echo $coupon['merchname'];?>]店铺商品
						<?php  } ?></p>
				</div>
				<div class="coupon-detail-head-info">
					<span><?php  echo $coupon['title2'];?><?php  echo $coupon['title3'];?></span>
					<?php  if(!empty($coupon['used'])) { ?>
						<a  href="javascript:void(0);">	<p>已使用</p></a>
					<?php  } else if($coupon['past']) { ?>
						<a  href="javascript:void(0);">	<p>已过期</p></a>
					<?php  } else { ?>
						<a  href="<?php  echo $useurl;?>">
							<p>
								<?php  if(empty($coupon['coupontype'])) { ?>
									立即去选商品使用
								<?php  } else if($coupon['coupontype']=='1') { ?>
									立即去充值
								<?php  } else { ?>
									返回我的优惠卷
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
	</div>

	<script language='javascript'>require(['biz/sale/coupon/mydetail'], function (modal) {modal.init();});</script>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>