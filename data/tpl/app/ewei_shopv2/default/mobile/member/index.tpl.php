<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<div class='fui-page  fui-page-current'>
	<div class="fui-header">
		<div class="fui-header-left">
			<a class="back" onclick='location.back()'></a>
		</div>
		<div class="title">会员中心</div>
		<div class="fui-header-right"></div>
	</div>

	<div class='fui-content member-page navbar'>


		<div class="headinfo" >
			<a class="setbtn" href="<?php  echo mobileUrl('member/info')?>" data-nocache='true'><i class="icon icon-settings"></i></a>
			<div class="child">
				<div class="title"><?php  echo $_W['shopset']['trade']['moneytext'];?></div>
				<div class="num"><?php  echo number_format($member['credit2'],2)?></div>
				<?php  if(empty($_W['shopset']['trade']['closerecharge'])) { ?><a href="<?php  echo mobileUrl('member/recharge')?>"><div class="btn">充值</div></a><?php  } ?>
			</div>
			<div class="child userinfo">
				<div class="face"><img src="<?php  echo $member['avatar'];?>" /></div>
				<div class="name"><?php  echo $member['nickname'];?></div>
				<div class="level" <?php  if(!empty($_W['shopset']['shop']['levelurl'])) { ?>onclick='location.href="<?php  echo $_W['shopset']['shop']['levelurl'];?>"'<?php  } ?>>
				<?php  if(empty($level['id'])) { ?>
				[<?php  if(empty($_W['shopset']['shop']['levelname'])) { ?>普通会员<?php  } else { ?><?php  echo $_W['shopset']['shop']['levelname'];?><?php  } ?>]
				<?php  } else { ?>
				[<?php  echo $level['levelname'];?>]
				<?php  } ?>
				<?php  if(!empty($_W['shopset']['shop']['levelurl'])) { ?><i class='icon icon-question1' style='font-size:0.65rem'></i><?php  } ?>
			</div>
		</div>
		<div class="child">
			<div class="title"><?php  echo $_W['shopset']['trade']['credittext'];?></div>
			<div class="num"><?php  echo number_format($member['credit1'],0)?></div>
			<?php  if($open_creditshop) { ?><a href="<?php  echo mobileUrl('creditshop')?>" class="external"><div class="btn">兑换</div></a><?php  } ?>
		</div>
	</div>

	<?php  if(!$member['mobileverify'] && !empty($wapset['open'])) { ?>
	<div class="fui-cell-group fui-cell-click external">
		<a class="fui-cell"  href="<?php  echo mobileUrl('member/bind')?>">
			<div class="fui-cell-icon"><i class="icon icon-mobile"></i></div>
			<div class="fui-cell-text"><p class="text text-danger">绑定手机号</p></div>
			<div class="fui-cell-remark"></div>
		</a>
		<div class="fui-cell-tip">如果您用手机号注册过会员或您想通过微信外购物请绑定您的手机号码</div>
	</div>

	<?php  } ?>


	<div class="fui-cell-group fui-cell-click">
		<a class="fui-cell external" href="<?php  echo mobileUrl('order')?>">
			<div class="fui-cell-icon"><i class="icon icon-list"></i></div>
			<div class="fui-cell-text">我的订单</div>
			<div class="fui-cell-remark" style="font-size: 0.5rem;">查看全部订单</div>
		</a>
		<div class="fui-icon-group selecter">
			<a class="fui-icon-col external" href="<?php  echo mobileUrl('order',array('status'=>0))?>">
				<?php  if($statics['order_0']>0) { ?><div class="badge"><?php  echo $statics['order_0'];?></div><?php  } ?>
				<div class="icon icon-green radius"><i class="icon icon-card"></i></div>
				<div class="text">待付款</div>
			</a>
			<a class="fui-icon-col external" href="<?php  echo mobileUrl('order',array('status'=>1))?>">
				<?php  if($statics['order_1']>0) { ?><div class="badge"><?php  echo $statics['order_1'];?></div><?php  } ?>
				<div class="icon icon-orange radius"><i class="icon icon-box"></i></div>
				<div class="text">待发货</div>
			</a>
			<a class="fui-icon-col external" href="<?php  echo mobileUrl('order',array('status'=>2))?>">
				<?php  if($statics['order_2']>0) { ?><div class="badge"><?php  echo $statics['order_2'];?></div><?php  } ?>
				<div class="icon icon-blue radius"><i class="icon icon-deliver"></i></div>
				<div class="text">待收货</div>
			</a>
			<a class="fui-icon-col external" href="<?php  echo mobileUrl('order',array('status'=>4))?>">
				<?php  if($statics['order_4']>0) { ?><div class="badge"><?php  echo $statics['order_4'];?></div><?php  } ?>
				<div class="icon icon-pink radius"><i class="icon icon-electrical"></i></div>
				<div class="text">退换货</div>
			</a>
		</div>
	</div>

	<?php  if($hassign) { ?>
	<div class="fui-cell-group fui-cell-click">
		<a class="fui-cell" href="<?php  echo mobileUrl('sign')?>">
			<div class="fui-cell-icon"><i class="icon icon-goods1"></i></div>
			<div class="fui-cell-text"><p><?php  echo $hassign;?></p></div>
			<div class="fui-cell-remark"></div>
		</a>
	</div>
	<?php  } ?>

	<?php  if($hasglobonus) { ?>
	<div class="fui-cell-group fui-cell-click">
		<a class="fui-cell"  href="<?php  echo mobileUrl('globonus')?>">
			<div class="fui-cell-icon"><i class="icon icon-profile"></i></div>
			<div class="fui-cell-text"><p><?php  echo $plugin_globonus_set['texts']['center'];?></p></div>
			<div class="fui-cell-remark"></div>
		</a>
	</div>
	<?php  } ?>

	<?php  if($hasabonus) { ?>
	<div class="fui-cell-group fui-cell-click">
		<a class="fui-cell"  href="<?php  echo mobileUrl('abonus')?>">
			<div class="fui-cell-icon"><i class="icon icon-profile"></i></div>
			<div class="fui-cell-text"><p><?php  echo $plugin_abonus_set['texts']['center'];?></p></div>
			<div class="fui-cell-remark"></div>
		</a>
	</div>
	<?php  } ?>


	<?php  if($hasauthor) { ?>
	<div class="fui-cell-group fui-cell-click">
		<a class="fui-cell"  href="<?php  echo mobileUrl('author')?>">
			<div class="fui-cell-icon"><i class="icon icon-profile"></i></div>
			<div class="fui-cell-text"><p><?php  echo $plugin_author_set['texts']['center'];?></p></div>
			<div class="fui-cell-remark"></div>
		</a>
	</div>
	<?php  } ?>


	<?php  if($hascoupon) { ?>
	<div class="fui-cell-group fui-cell-click">
		<?php  if($hascouponcenter) { ?>
		<a class="fui-cell" href="<?php  echo mobileUrl('sale/coupon')?>">
			<div class="fui-cell-icon"><i class="icon icon-same"></i></div>
			<div class="fui-cell-text"><p>领取优惠券</p></div>
			<div class="fui-cell-remark"></div>
		</a>
		<?php  } ?>
		<a class="fui-cell"  href="<?php  echo mobileUrl('sale/coupon/my')?>">
			<div class="fui-cell-icon"><i class="icon icon-card"></i></div>
			<div class="fui-cell-text"><p>我的优惠券</p></div>
			<div class="fui-cell-remark"><?php  if($statics['coupon']>0) { ?><span  <?php  if($statics['newcoupon']>0) { ?>style="background: #fe5455;color:#fff"<?php  } ?> class='badge'>  <?php  if($statics['newcoupon']>0) { ?>new<?php  } else { ?><?php  echo $statics['coupon'];?><?php  } ?></span><?php  } ?></div>
		</a>
	</div>

	<div class="fui-cell-group fui-cell-click">
		<!-- <?php  if($hascouponcenter) { ?>
		<a class="fui-cell" href="<?php  echo mobileUrl('sale/car')?>">
			<div class="fui-cell-icon"><i class="icon icon-same"></i></div>
			<div class="fui-cell-text"><p>领取洗车劵</p></div>
			<div class="fui-cell-remark"></div>
		</a>
		<?php  } ?> -->
		<a class="fui-cell"  href="<?php  echo mobileUrl('sale/car/my')?>">
			<div class="fui-cell-icon"><i class="icon icon-card"></i></div>
			<div class="fui-cell-text"><p>我的洗车劵</p></div>
			<div class="fui-cell-remark"><?php  if($statics['car']>0) { ?><span  <?php  if($statics['newcoupon']>0) { ?>style="background: #fe5455;color:#fff"<?php  } ?> class='badge'>  <?php  if($statics['newcoupon']>0) { ?>new<?php  } else { ?><?php  echo $statics['car'];?><?php  } ?></span><?php  } ?></div>
		</a>
	</div>
	<?php  } ?>
	<?php  if(!empty( $_W['shopset']['rank']['status'] ) || !empty( $_W['shopset']['rank']['order_status'] ) ) { ?>
	<div class="fui-cell-group fui-cell-click">
		<?php  if(!empty( $_W['shopset']['rank']['status'] ) ) { ?>
		<a class="fui-cell" href="<?php  echo mobileUrl('member/rank');?>">
			<div class="fui-cell-icon"><i class="icon icon-rank"></i></div>
			<div class="fui-cell-text"><p><?php  echo $_W['shopset']['trade']['credittext'];?>排行</p></div>
			<div class="fui-cell-remark"></div>
		</a>
		<?php  } ?>
		<?php  if(!empty( $_W['shopset']['rank']['order_status'] ) ) { ?>
		<a class="fui-cell" href="<?php  echo mobileUrl('member/rank/order_rank');?>">
			<div class="fui-cell-icon"><i class="icon icon-money"></i></div>
			<div class="fui-cell-text"><p>消费排行</p></div>
			<div class="fui-cell-remark"></div>
		</a>
		<?php  } ?>
	</div>
	<?php  } ?>

	<div class="fui-cell-group fui-cell-click">
		<a class="fui-cell" href="<?php  echo mobileUrl('member/cart');?>">
			<div class="fui-cell-icon"><i class="icon icon-cart"></i></div>
			<div class="fui-cell-text"><p>我的购物车</p></div>
			<div class="fui-cell-remark"><?php  if($statics['cart']>0) { ?><span class='badge'><?php  echo $statics['cart'];?></span><?php  } ?></div>
		</a>
		<a class="fui-cell" href="<?php  echo mobileUrl('member/favorite');?>">
			<div class="fui-cell-icon"><i class="icon icon-like"></i></div>
			<div class="fui-cell-text"><p>我的关注</p></div>
			<div class="fui-cell-remark"><?php  if($statics['favorite']>0) { ?><span class='badge'><?php  echo $statics['favorite'];?></span><?php  } ?></div>
		</a>
		<a class="fui-cell" href="<?php  echo mobileUrl('member/history');?>">
			<div class="fui-cell-icon"><i class="icon icon-footprint"></i></div>
			<div class="fui-cell-text"><p>我的足迹</p></div>
			<div class="fui-cell-remark"></div>
		</a>
		<a class="fui-cell" href="<?php  echo mobileUrl('member/notice');?>" data-nocache="true">
			<div class="fui-cell-icon"><i class="icon icon-notice"></i></div>
			<div class="fui-cell-text"><p>消息提醒设置</p></div>
			<div class="fui-cell-remark"></div>
		</a>
	</div>

	<div class="fui-cell-group fui-cell-click">
		<?php  if($_W['shopset']['trade']['withdraw']==1) { ?>
		<a class="fui-cell" href="<?php  echo mobileUrl('member/withdraw')?>">
			<div class="fui-cell-icon"><i class="icon icon-money"></i></div>
			<div class="fui-cell-text"><p>佣金提现</p></div>
			<div class="fui-cell-remark"></div>
		</a>
		<?php  } ?>
		<a class="fui-cell" href="<?php  echo mobileUrl('member/log')?>">
			<div class="fui-cell-icon"><i class="icon icon-list"></i></div>
			<div class="fui-cell-text"><p>
				<?php  if($_W['shopset']['trade']['withdraw']==1) { ?><?php  echo $_W['shopset']['trade']['moneytext'];?>明细<?php  } else { ?>充值记录<?php  } ?>
			</p></div>
			<div class="fui-cell-remark"></div>
		</a>		<a class="fui-cell" href="<?php  echo mobileUrl('member/logyj')?>">			<div class="fui-cell-icon"><i class="icon icon-list"></i></div>			<div class="fui-cell-text"><p>				佣金明细			</p></div>			<div class="fui-cell-remark"></div>		</a>
	</div>
	<div class="fui-cell-group fui-cell-click">
		<a class="fui-cell" href="<?php  echo mobileUrl('member/address')?>">
			<div class="fui-cell-icon"><i class="icon icon-address"></i></div>
			<div class="fui-cell-text"><p>收货地址管理</p></div>
			<div class="fui-cell-remark"></div>
		</a>
	</div>
	<?php  if($hasqa) { ?>
	<div class="fui-cell-group fui-cell-click">
		<a class="fui-cell" href="<?php  echo mobileUrl('qa')?>">
			<div class="fui-cell-icon"><i class="icon icon-help"></i></div>
			<div class="fui-cell-text"><p>帮助中心</p></div>
			<div class="fui-cell-remark"></div>
		</a>
	</div>
	<?php  } ?>
	<?php  if(!is_weixin() && !empty($wapset['open'])) { ?>
	<div class="fui-cell-group fui-cell-click">
		<a class="fui-cell external" href="<?php  if(!empty($member['mobileverify'])) { ?><?php  echo mobileUrl('member/changepwd')?><?php  } else { ?><?php  echo mobileUrl('member/bind')?><?php  } ?>">
			<div class="fui-cell-text" style="text-align: center;color:red;"><p>修改密码</p></div>
		</a>
		<a class="fui-cell external btn-logout">
			<div class="fui-cell-text" style="text-align: center;color:red;"><p>退出登录</p></div>
		</a>
	</div>

	<div class="pop-apply-hidden" style="display: none">
		<div class="verify-pop pop">
			<div class="close"><i class="icon icon-roundclose"></i></div>
			<div class="qrcode">
				<div class="inner">
					<div class="title"><?php  echo $set['applytitle'];?></div>
					<div class="text"><?php  echo $set['applycontent'];?></div>
				</div>
				<div class="inner-btn" style="padding: 0.5rem">
					<div class="btn btn-warning" style="width: 100%; margin: 0">我已阅读</div>
				</div>
			</div>
		</div>
	</div>

	<?php  } ?>
	<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_copyright', TEMPLATE_INCLUDEPATH)) : (include template('_copyright', TEMPLATE_INCLUDEPATH));?>
</div>
<script language='javascript'>
	require(['biz/member/index'], function (modal) {
		modal.init();
	});
</script>
</div>

<?php  $this->footerMenus()?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>
