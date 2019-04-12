<?php defined('IN_IA') or exit('Access Denied');?><?php  $no_left =true;?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<script type="text/javascript" src="../addons/ewei_shopv2/static/js/dist/area/cascade.js"></script>
<style type='text/css'>

           .tabs-container .form-group {overflow: hidden;}
          .tabs-container .tabs-left > .nav-tabs {
		width: 120px;;
          }
          .tabs-container .tabs-left .panel-body {
		margin-left: 120px;
		width:880px;
		text-align:left;
           }
	.tab-goods .nav li { width:120px; text-align:right; }

	.spec_item_thumb {position:relative;width:30px;height:20px;padding:0;border-left:none;}
          .spec_item_thumb i { position:absolute;top:-5px;right:-5px; }
</style>



<div class="page-heading"> 
	
	<span class='pull-right'>
		
		<?php if(mcv('goods.add')) { ?>
                            <a class="btn btn-primary btn-sm" href="<?php  echo merchUrl('goods/add')?>" >添加商品</a>
		<?php  } ?>
                
		<a class="btn btn-default btn-sm" href="<?php  echo merchUrl('goods',array('goodsfrom'=>$_GPC['goodsfrom'], 'page'=>$_GPC['page']))?>">返回列表</a>
                
                
	</span>
    <h2><?php  if(!empty($item['id'])) { ?>编辑<?php  } else { ?>添加<?php  } ?>商品 <small><?php  if(!empty($item['id'])) { ?>修改【<?php  echo $item['title'];?>】<?php  } ?></small></h2>
</div>

<form <?php if( mce('goods' ,$item) ) { ?>action="" method="post"<?php  } ?> class="form-horizontal form-validate" enctype="multipart/form-data">
    <!--<form action="" method="post" class="form-horizontal" enctype="multipart/form-data">-->
    <input type="hidden" id="tab" name="tab" value="#tab_basic" />
    <div class="tabs-container tab-goods">
                    <div class="tabs-left">
                    <ul class="nav nav-tabs" id="myTab">
                    <li  <?php  if(empty($_GPC['tab']) || $_GPC['tab']=='basic') { ?>class="active"<?php  } ?>><a href="#tab_basic">基本</a></li>
                    <li  <?php  if($_GPC['tab']=='option') { ?>class="active"<?php  } ?> ><a href="#tab_option">库存/规格</a></li>
                    <li <?php  if($_GPC['tab']=='param') { ?>class="active"<?php  } ?> ><a href="#tab_param">参数</a></li>
                    <li <?php  if($_GPC['tab']=='des') { ?>class="active"<?php  } ?> ><a href="#tab_des">详情</a></li>
                    <li <?php  if($_GPC['tab']=='buy') { ?>class="active"<?php  } ?> ><a href="#tab_buy">购买权限</a></li><li <?php  if($_GPC['tab']=='sale') { ?>class="active"<?php  } ?> ><a href="#tab_sale">营销</a></li>

                    <li <?php  if($_GPC['tab']=='share') { ?>class="active"<?php  } ?> ><a href="#tab_share">分享关注</a></li>
                    <li <?php  if($_GPC['tab']=='notice') { ?>class="active"<?php  } ?> ><a href="#tab_notice">下单通知</a></li>


                    <?php  if(!empty($com_set['level']) && $merch_user['commissionchecked'] == 1) { ?>
                    <li <?php  if($_GPC['tab']=='sell') { ?>class="active"<?php  } ?>><a href="#tab_sell">分销</a></li>
                    <?php  } ?>

                    <li <?php  if($_GPC['tab']=='verify') { ?>class="active"<?php  } ?>><a href="#tab_verify">线下核销</a></li>

                    <?php  if(p('diyform')) { ?>
                    <li <?php  if($_GPC['tab']=='diyform') { ?>class="active"<?php  } ?>><a href="#tab_diyform">自定义表单</a></li>
                    <?php  } ?>

                        </ul>
                    <div class="tab-content ">
                    <div class="tab-pane   <?php  if(empty($_GPC['tab']) || $_GPC['tab']=='basic') { ?>active<?php  } ?>" id="tab_basic"><div class="panel-body"><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('goods/tab/basic', TEMPLATE_INCLUDEPATH)) : (include template('goods/tab/basic', TEMPLATE_INCLUDEPATH));?></div></div>
                    <div class="tab-pane  <?php  if($_GPC['tab']=='option') { ?>active<?php  } ?>" id="tab_option"> <div class="panel-body"><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('goods/tab/option', TEMPLATE_INCLUDEPATH)) : (include template('goods/tab/option', TEMPLATE_INCLUDEPATH));?></div></div>
                    <div class="tab-pane <?php  if($_GPC['tab']=='param') { ?>active<?php  } ?>" id="tab_param"> <div class="panel-body"><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('goods/tab/param', TEMPLATE_INCLUDEPATH)) : (include template('goods/tab/param', TEMPLATE_INCLUDEPATH));?></div></div>
                    <div class="tab-pane <?php  if($_GPC['tab']=='des') { ?>active<?php  } ?>" id="tab_des"> <div class="panel-body" style='padding:0;'><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('goods/tab/des', TEMPLATE_INCLUDEPATH)) : (include template('goods/tab/des', TEMPLATE_INCLUDEPATH));?></div></div>
                    <div class="tab-pane <?php  if($_GPC['tab']=='buy') { ?>active<?php  } ?>" id="tab_buy"> <div class="panel-body"><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('goods/tab/buy', TEMPLATE_INCLUDEPATH)) : (include template('goods/tab/buy', TEMPLATE_INCLUDEPATH));?></div></div>
                    <div class="tab-pane <?php  if($_GPC['tab']=='sale') { ?>active<?php  } ?>" id="tab_sale"> <div class="panel-body"><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('goods/tab/sale', TEMPLATE_INCLUDEPATH)) : (include template('goods/tab/sale', TEMPLATE_INCLUDEPATH));?></div></div>

                    <div class="tab-pane <?php  if($_GPC['tab']=='share') { ?>active<?php  } ?>" id="tab_share"> <div class="panel-body"><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('goods/tab/share', TEMPLATE_INCLUDEPATH)) : (include template('goods/tab/share', TEMPLATE_INCLUDEPATH));?></div></div>
                    <div class="tab-pane  <?php  if($_GPC['tab']=='notice') { ?>active<?php  } ?>" id="tab_notice"> <div class="panel-body"><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('goods/tab/notice', TEMPLATE_INCLUDEPATH)) : (include template('goods/tab/notice', TEMPLATE_INCLUDEPATH));?></div></div>

                   <?php  if(p('commission') && !empty($com_set['level']) && $merch_user['commissionchecked'] == 1) { ?>
                   <div class="tab-pane <?php  if($_GPC['tab']=='sell') { ?>active<?php  } ?>" id="tab_sell"> <div class="panel-body"><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('commission/goods_merch', TEMPLATE_INCLUDEPATH)) : (include template('commission/goods_merch', TEMPLATE_INCLUDEPATH));?></div></div>
                   <?php  } ?>

                    <div class="tab-pane <?php  if($_GPC['tab']=='verify') { ?>active<?php  } ?>" id="tab_verify"> <div class="panel-body"><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('goods/tab/verify', TEMPLATE_INCLUDEPATH)) : (include template('goods/tab/verify', TEMPLATE_INCLUDEPATH));?></div></div>
                    <?php  if(p('diyform')) { ?>
                    <div class="tab-pane <?php  if($_GPC['tab']=='diyform') { ?>active<?php  } ?>" id="tab_diyform"> <div class="panel-body"><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('diyform/goods_merch', TEMPLATE_INCLUDEPATH)) : (include template('diyform/goods_merch', TEMPLATE_INCLUDEPATH));?></div></div>
                    <?php  } ?>

                   </div>

                    </div>

                </div>

	<div class='panel-body' style='position:fixed;bottom:0;width:1000px; text-align: right; '>


		<?php if( mce('goods' ,$item) ) { ?>
                          <input type="submit" value="保存商品" class="btn btn-primary"/>
                  <?php  } ?>
        </div>
</form>



<script type="text/javascript">
	window.type = "<?php  echo $item['type'];?>";
	window.virtual = "<?php  echo $item['virtual'];?>";
        require(['bootstrap'], function () {
		$('#myTab a').click(function (e) {
			$('#tab').val( $(this).attr('href'));
			e.preventDefault();
			$(this).tab('show');
		})
	});
	$(function () {

        $(':radio[name=isverify]').click(function () {
            window.type = $("input[name='isverify']:checked").val();

            if (window.type == '2') {
                $(':checkbox[name=cash]').attr("checked",false);
                $(':checkbox[name=cash]').parent().hide();
            } else {
                $(':checkbox[name=cash]').parent().show();
            }
        })

        $(':radio[name=type]').click(function () {
            window.type = $("input[name='type']:checked").val();
            window.virtual = $("#virtual").val();
            if(window.type=='1'){
                $('.dispatch_info').show();
            } else {
                $('.dispatch_info').hide();
            }
            if (window.type == '2') {
                $('.send-group').show();
            } else {
                $('.send-group').hide();
            }
            if (window.type == '3') {
                if ($('#virtual').val() == '0') {
                    $('.choosetemp').show();
                }
            }
            if (window.type == '2' || window.type == '3') {
                $(':checkbox[name=cash]').attr("checked",false);
                $(':checkbox[name=cash]').parent().hide();
            } else {
                $(':checkbox[name=cash]').parent().show();

            }
        })

        $(":checkbox[name='buyshow']").click(function () {
            if ($(this).prop('checked')) {
                $(".bcontent").show();
            }
            else {
                $(".bcontent").hide();
            }
	})

        $(':radio[name=buyshow]').click(function () {
            window.buyshow = $("input[name='buyshow']:checked").val();

            if(window.buyshow=='1'){
                $('.bcontent').show();
            } else {
                $('.bcontent').hide();
            }
        })
    })

	window.optionchanged = false;

	$('form').submit(function(){

        var check = true;

        $(".tp_title,.tp_name").each(function(){
            var val = $(this).val();
            if(!val){
                $('#myTab a[href="#tab_diyform"]').tab('show');
                $(this).focus(),$('form').attr('stop',1),tip.msgbox.err('自定义表单字段名称不能为空!');
                check =false;
                return false;
            }
        });

        var diyformtype = $(':radio[name=diyformtype]:checked').val();

        if (diyformtype == 2) {
            if(kw == 0) {
                $('#myTab a[href="#tab_diyform"]').tab('show');
                $(this).focus(),$('form').attr('stop',1),tip.msgbox.err('请先添加自定义表单字段再提交!');
                check =false;
                return false;
            }
        }

        if(!check){return false;}

		window.type = $("input[name='type']:checked").val();
		window.virtual = $("#virtual").val();
		if ($("#goodsname").isEmpty()) {
			$('#myTab a[href="#tab_basic"]').tab('show');
			$('form').attr('stop',1);
            $(this).focus(),$('form').attr('stop',1),tip.msgbox.err('请填写商品名称!');
			return false;
		}

        var inum = 0;
        $('.gimgs').find('.img-thumbnail').each(function(){
            inum++;
        });
        if(inum == 0){
            $('#myTab a[href="#tab_basic"]').tab('show');
            $('form').attr('stop',1),tip.msgbox.err('请上传商品图片!');
            return false;
        }


		var full = true;
		if (window.type == '3') {
			if (window.virtual != '0') {  //如果单规格，不能有规格
				if ($('#hasoption').get(0).checked) {
					$('form').attr('stop',1),tip.msgbox.err('您的商品类型为：虚拟物品(卡密)的单规格形式，需要关闭商品规格！');
					util.message('您的商品类型为：虚拟物品(卡密)的单规格形式，需要关闭商品规格！');
					return false;
				}
			}
			else {

				var has = false;
				$('.spec_item_virtual').each(function () {
					has = true;
					if ($(this).val() == '' || $(this).val() == '0') {
						$('#myTab a[href="#tab_option"]').tab('show');
						$(this).next().focus();
						$('form').attr('stop',1),tip.msgbox.err('请选择虚拟物品模板!');
						full = false;
						return false;
					}
				});
				if (!has) {
					$('#myTab a[href="#tab_option"]').tab('show');
					$('form').attr('stop',1),tip.msgbox.err('您的商品类型为：虚拟物品(卡密)的多规格形式，请添加规格！');
					util.message('您的商品类型为：虚拟物品(卡密)的多规格形式，请添加规格！');
					return false;
				}
			}
		}
		if (!full) {
			return false;
		}

		full = checkoption();
        if (!full) {
            $('form').attr('stop',1),tip.msgbox.err('请输入规格名称!');
            return false;
        }
		if (optionchanged) {
			$('#myTab a[href="#tab_option"]').tab('show');
			$('form').attr('stop',1),tip.msgbox.err('规格数据有变动，请重新点击 [刷新规格项目表] 按钮!');
			return false;
		}
		var spec_item_title = 1;
		$(".spec_item").each(function (i) {
			var _this = this;
			if($(_this).find(".spec_item_title").length == 0){
				spec_item_title = 0;
			}
		});
		if(spec_item_title == 0){
			$('form').attr('stop',1),tip.msgbox.err('详细规格没有填写,请填写详细规格!');
			return false;
		}
		$('form').attr('stop',1);
		//处理规格
		optionArray();
		isdiscountDiscountsArray();
		$('form').removeAttr('stop');
		return true;
	});

	function optionArray()
	{
		var option_stock = new Array();
		$('.option_stock').each(function (index,item) {
			option_stock.push($(item).val());
		});

		var option_id = new Array();
		$('.option_id').each(function (index,item) {
			option_id.push($(item).val());
		});

		var option_ids = new Array();
		$('.option_ids').each(function (index,item) {
			option_ids.push($(item).val());
		});

		var option_title = new Array();
		$('.option_title').each(function (index,item) {
			option_title.push($(item).val());
		});

		var option_virtual = new Array();
		$('.option_virtual').each(function (index,item) {
			option_virtual.push($(item).val());
		});

		var option_marketprice = new Array();
		$('.option_marketprice').each(function (index,item) {
			option_marketprice.push($(item).val());
		});

		var option_productprice = new Array();
		$('.option_productprice').each(function (index,item) {
			option_productprice.push($(item).val());
		});

		var option_costprice = new Array();
		$('.option_costprice').each(function (index,item) {
			option_costprice.push($(item).val());
		});

		var option_goodssn = new Array();
		$('.option_goodssn').each(function (index,item) {
			option_goodssn.push($(item).val());
		});

		var option_productsn = new Array();
		$('.option_productsn').each(function (index,item) {
			option_productsn.push($(item).val());
		});

		var option_weight = new Array();
		$('.option_weight').each(function (index,item) {
			option_weight.push($(item).val());
		});

		var options = {
				option_stock : option_stock,
				option_id : option_id,
				option_ids : option_ids,
				option_title : option_title,
				option_marketprice : option_marketprice,
				option_productprice : option_productprice,
				option_costprice : option_costprice,
				option_goodssn : option_goodssn,
				option_productsn : option_productsn,
				option_weight : option_weight,
				option_virtual : option_virtual
		};
		$("input[name='optionArray']").val(JSON.stringify(options));
	}

	function isdiscountDiscountsArray()
	{

		<?php  if(is_array($levels)) { foreach($levels as $level) { ?>
		var isdiscount_discounts_<?php  echo $level['key'];?> = new Array();
		$(".isdiscount_discounts_<?php  echo $level['key'];?>").each(function (index,item) {
			isdiscount_discounts_<?php  echo $level['key'];?>.push($(item).val());
		});
		<?php  } } ?>

		var isdiscount_discounts_id = new Array();
		$('.isdiscount_discounts_id').each(function (index,item) {
			isdiscount_discounts_id.push($(item).val());
		});

		var isdiscount_discounts_ids = new Array();
		$('.isdiscount_discounts_ids').each(function (index,item) {
			isdiscount_discounts_ids.push($(item).val());
		});

		var isdiscount_discounts_title = new Array();
		$('.isdiscount_discounts_title').each(function (index,item) {
			isdiscount_discounts_title.push($(item).val());
		});

		var isdiscount_discounts_virtual = new Array();
		$('.isdiscount_discounts_virtual').each(function (index,item) {
			isdiscount_discounts_virtual.push($(item).val());
		});

		var options = {
			<?php  if(is_array($levels)) { foreach($levels as $level) { ?>
			isdiscount_discounts_<?php  echo $level['key'];?> : isdiscount_discounts_<?php  echo $level['key'];?>,
			<?php  } } ?>
			isdiscount_discounts_id : isdiscount_discounts_id,
			isdiscount_discounts_ids : isdiscount_discounts_ids,
			isdiscount_discounts_title : isdiscount_discounts_title,
			isdiscount_discounts_virtual : isdiscount_discounts_virtual
		};
		$("input[name='isdiscountDiscountsArray']").val(JSON.stringify(options));
	}



	function checkoption() {

        var full = true;
        var $spec_title = $(".spec_title");
        var $spec_item_title = $(".spec_item_title");
        if ($("#hasoption").get(0).checked) {
            if($spec_title.length==0){
                $('#myTab a[href="#tab_option"]').tab('show');
                full = false;
            }
            if($spec_item_title.length==0){
                $('#myTab a[href="#tab_option"]').tab('show');
                full = false;
            }
        }
        if (!full) {
            return false;
        }
        return full;
	}
</script>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>
