<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<script src="../addons/ewei_shopv2/static/js/app/biz/sale/coupon/circle-progress.js"></script>
<link rel="stylesheet" type="text/css" href="../addons/ewei_shopv2/template/mobile/default/static/css/coupon.css?v=2.0.0">
<div class='fui-page fui-page-current'>
	<div class="fui-header">
		<div class="fui-header-left">
			<a class="back"></a>
		</div>
		<div class="title">洗车券领取中心</div>
		<div class="fui-header-right">
			<a href="<?php  echo mobileUrl('sale/car/my')?>" class="external">
				<i class="icon icon-person2"></i>
			</a>
		</div>
	</div>
	<div class='fui-content coupon-index-bg'>

		<?php  if(!empty($advs)) { ?>
			<div class='fui-swipe' data-transition="500" data-gap="1"> 
			    <div class='fui-swipe-wrapper'>
					<?php  if(is_array($advs)) { foreach($advs as $adv) { ?>
						<a class='fui-swipe-item' href="<?php  if(!empty($adv['url'])) { ?><?php  echo $adv['url'];?><?php  } else { ?>javascript:;<?php  } ?>"><img src="<?php  echo tomedia($adv['img'])?>" /></a>
					<?php  } } ?>
			    </div>
			    <div class='fui-swipe-page'></div>
			</div>
		<?php  } ?>

		<div class="fui-tab-scroll">
			<div class='container'>
				<span class='item on' data-cateid="">全部洗车券</span>
					<?php  if(is_array($category)) { foreach($category as $item) { ?>
						<span class='item' data-cateid="<?php  echo $item['id'];?>"><?php  echo $item['name'];?></span>
					<?php  } } ?>
			</div>
		</div>
		
		<div class="fui-message fui-message-popup in content-empty" style="display: none; margin-top: 0; padding-top: 0; position: relative; height: auto; background: none;">
				<div class="icon ">
					<i class="icon icon-information"></i>
				</div>
				<div class="content">还没有发布洗车券~</div>
		</div>
		<!--内容加载-->
		<div id='container' class="coupon-container coupon-index-list">
		</div>

		<div class='infinite-loading' style="text-align: center; color: #666;">
	    	<span class='fui-preloader'></span>
	    	<span class='text'> 正在加载...</span>
	    </div>
		<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_copyright', TEMPLATE_INCLUDEPATH)) : (include template('_copyright', TEMPLATE_INCLUDEPATH));?>
	</div>
	<script id='tpl_list_coupon' type='text/html'>
		<%each list as car index%>
		<% if car.isdisa =='1'%>
		<a href="javascript:void(0);" class="coupon-index-list-a disa">
			<div class="fui-list coupon-list " >
				<i class="coupon-top-i"></i><i class="coupon-bot-i"></i>
				<span class="coupon-ling"><img src="../addons/ewei_shopv2/template/mobile/default/static/images/coupon/end.png" alt=""></span>
				<div class="fui-list-inner coupon-index-list-left">
					<b style="width: 92px ; text-align:center ; "><%car.tagtitle%></b>
					<div class="coupon-index-list-info fui-list">
						<div class="fui-list-media">
							<img src="<%if coupon.thumb==''%>/addons/ewei_shopv2/template/mobile/default/static/images/coupon/coupon-list-img.png<%else%><%coupon.thumb%><%/if%>" alt="">
						</div>
						<div class="fui-list-inner">
							<h3><%car.couponname%></h3>
							<p class="coupon-full"><%=car.title3%>  <%=car.title2%></p>
							<p class="coupon-time"><%=car.title4%></p>
						</div>
					</div>
				</div>
				<div class="fui-list-media coupon-index-list-right">
					<div class="forth0 circle coupon-list-canvas"></div>
					<i class="coupon-list-ling">已发完</i>
				</div>
			</div>
		</a>
		<% else %>
		<a href="<?php  echo mobileUrl('sale/car/detail')?>&id=<%car.id%>" class="coupon-index-list-a  <%car.color%>">
			<div class="fui-list coupon-list coupon-list-allow" data-id="<%car.id%>" data-t="<%car.t%>" data-last="<%car.last%>">
				<i class="coupon-top-i"></i><i class="coupon-bot-i"></i>
				<div class="fui-list-inner coupon-index-list-left">
					<b   style="width: 92px ; text-align:center ; <% if car.settitlecolor ==1 %>background:<%car.titlecolor%><%/if%>"><%car.tagtitle%></b>
					<div class="coupon-index-list-info fui-list">
						<div class="fui-list-media">
							<img src="<%if coupon.thumb==''%>/addons/ewei_shopv2/template/mobile/default/static/images/coupon/coupon-list-img.png<%else%><%coupon.thumb%><%/if%>" alt="">
						</div>
						<div class="fui-list-inner">
							<h3><%car.couponname%></h3>
							<p class="coupon-full"><%=car.title3%>  <%=car.title2%></p>
							<p class="coupon-time"><%=car.title4%></p>
						</div>
					</div>
				</div>
				<div class="fui-list-media coupon-index-list-right">
					<div class="forth<%car.id%> circle coupon-list-canvas">
						<p>剩余</p><strong><%car.lastratio%><i>%</i></strong>
					</div>
					<i class="coupon-list-ling">立即领取</i>
				</div>
			</div>
		</a>

		<% /if %>
		<%/each%>
	</script>
	<script  language='javascript'>
		require(['biz/sale/car/common'], function (modal) {modal.init();});
	</script>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>