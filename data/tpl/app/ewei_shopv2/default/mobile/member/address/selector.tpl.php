<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<div class='fui-page  fui-page-current address-selector-page' id="page-address-selector">
 
	<div class="fui-header">
	    <div class="fui-header-left">
		<a class="back"></a>
	    </div>
	    <div class="title">选择地址</div> 
	    <div class="fui-header-right">&nbsp;</div>
	</div>
	<div class='fui-content'>
	    <div class="fui-list-group" >
		<?php  if(is_array($list)) { foreach($list as $address) { ?>
		<div  class="fui-list address-item" 
		      data-isdefault="<?php  echo $address['isdefault'];?>" 
		      data-addressid="<?php  echo $address['id'];?>">
		    <div class="fui-list-media">
			<input type="radio" name="selected" class="fui-radio  fui-radio-danger"  />
		    </div>
		    <div class="fui-list-inner">
			<div class="title"><span class='realname'><?php  echo $address['realname'];?></span> <span class='mobile'><?php  echo $address['mobile'];?></span></div>
			<div class="text">
			    <span class='address'><?php  echo $address['province'];?><?php  echo $address['city'];?><?php  echo $address['area'];?> <?php  echo $address['address'];?></span>
			</div>
			
		    </div>
		    <a  href="<?php  echo mobileUrl('member/address/post',array('id'=>$address['id']))?>" class="external" data-nocache="true">
			<div class="fui-list-angle">
			    <i class='icon icon-edit'></i>
			</div>
		    </a>
		</div>
		<?php  } } ?>
	    </div> 
	    <div class='fui-navbar'>
		<a href="<?php  echo mobileUrl('member/address/post')?>" class='nav-item btn btn-danger external' data-nocache="true"><i class="icon icon-add"></i> 新增地址</a>
	    </div>
	</div>
    <script  id='tpl_address_item' type='text/html'>
	<div  class="fui-list address-item" data-isdefault="<%address.isdefault%>" data-addressid="<%address.id%>">
		    <div class="fui-list-media">
			<input type="radio" name="selected" class="fui-radio  fui-radio-danger" />
		    </div>
		    <div class="fui-list-inner">
			<div class="title"><span class='realname'><%address.realname%></span> <span class='mobile'><%address.mobile%></span></div>
			<div class="text">
			    <span class='address'><%address.province%><%address.city%><%address.area%> <%address.address%></span>
			</div>
		    </div>
		    <a href="<?php  echo mobileUrl('member/address/post')?>&id=<%address.id%>" data-nocache="true">
			<div class="fui-list-angle">
			    <i class='icon icon-edit'></i>
			</div>
		    </a>
		</div>
	</script>
    <script language='javascript'>
	    require(['biz/member/address'], function (modal) {
		modal.initSelector()
                });</script>
</div>

<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>