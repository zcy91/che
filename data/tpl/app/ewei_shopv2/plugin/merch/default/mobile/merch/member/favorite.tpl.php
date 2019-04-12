<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<div class='fui-page  fui-page-current member-cart-page'>
    <div class="fui-header">
	<div class="fui-header-left">
	    <a class="back"></a>
	</div>
	<div class="title">我的关注</div> 
	<div class="fui-header-right">
		<a class="btn-edit"  style="display:none">编辑</a>
	</div>
    </div>

    <div class='fui-content ' >
		<div class="fui-tab fui-tab-warning" id="tab">
			<a class="active" href="javascript:void(0)" data-tab="type0">商品</a>
			<a href="javascript:void(0)" data-tab="type1" class="">商家</a>
		</div>
	<div class='content-empty' style='display:none;'>
	     <i class='icon icon-like'></i><br/>您还没有任何关注，何不现在就去逛逛~<br/><a href="<?php  echo mobileUrl()?>" class='btn btn-default-o external'>去逛逛吧~</a>
	</div>
	  <div class='fui-list-group container' style="display:none;"></div>
	  <div class='infinite-loading'><span class='fui-preloader'></span><span class='text'> 正在加载...</span></div>
    </div>
    <div class="fui-footer editmode">
	<div class="fui-list noclick">
	    <div class="fui-list-media">
		<label class="checkbox-inline editcheckall"><input type="checkbox" name="checkbox" class="fui-radio fui-radio-danger " />&nbsp;全选</label>
	    </div>

	    <div class='fui-list-angle'>
		<div class="btn  btn-danger-o btn-delete  disabled">删除</div>
	    </div>
	</div>
    </div>
 
    <script id="tpl_member_favorite_list" type="text/html">
	 
	    <%each list as g index%>
		<div class="fui-list-group-title text-cancel"><%g.merchname%></div>
	    <div class="fui-list goods-item align-start" data-id="<%g.id%>" data-goodsid="<%g.goodsid%>">
		<div class="fui-list-media editmode">
		   <input type="checkbox" name="checkbox" class="fui-radio fui-radio-danger edit-item"/>
		</div> 

		<div class="fui-list-media image-media">
		    <a href="<?php  echo mobileUrl('goods/detail')?>&id=<%g.goodsid%>">
			<img data-lazy="<%g.thumb%>" class="round">
		    </a>
		</div>
		<div class="fui-list-inner">
		    <a href="<?php  echo mobileUrl('goods/detail')?>&id=<%g.goodsid%>">
			<div class="text">
			  <%g.title%>
			</div>
		    </a>
			<div class="text"><span class="text-danger">积分:<%g.marketprice%><%if g.productprice>0%></span> <span class='oldprice'>积分:<%g.productprice%></span><%/if%></div>

		</div>
	    </div>
	  <%/each%>
    </script>
	<script id="tpl_merch_member_favorite_list" type="text/html">

		<%each list as g index%>
		<div class="fui-list goods-item align-start" data-id="<%g.id%>" data-goodsid="<%g.merchid%>">
			<div class="fui-list-media editmode">
				<input type="checkbox" name="checkbox" class="fui-radio fui-radio-danger edit-item"/>
			</div>

			<div class="fui-list-media image-media">
				<a href="<?php  echo mobileUrl('merch')?>&merchid=<%g.merchid%>">
					<img data-lazy="<%g.logo%>" class="round">
				</a>
			</div>
			<div class="fui-list-inner">
				<a href="<?php  echo mobileUrl('merch')?>&merchid=<%g.merchid%>">
					<h5 class="text">
						<span class="text-danger"><%g.merchname%></span>
					</h5>
					<div class="text">
						<%g.desc%>
					</div>
				</a>
			</div>
		</div>
		<%/each%>
	</script>
    <script language='javascript'>require(['biz/member/favorite'], function (modal) {
                modal.init();
     });</script>
</div>

<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>