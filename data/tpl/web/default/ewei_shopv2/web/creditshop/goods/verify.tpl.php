<?php defined('IN_IA') or exit('Access Denied');?><style type='text/css'>
    body { width:100%;}
    .img-thumbnail { width:100px; height:100px;}
    .img-nickname { height:25px;line-height:25px;width:90px;margin-left:5px;margin-right:5px;position: absolute;bottom:55px;color:#fff;text-align: center;background:rgba(0,0,0,0.7)}
</style>
<div class="form-group">
    <label class="col-xs-12 col-sm-3 col-md-2 control-label">支持线下核销</label>
    <div class="col-sm-6 col-xs-6">
        <?php if( ce('creditshop.goods' ,$item) ) { ?>
        <label class="radio-inline"><input type="radio" name="isverify" value="0" <?php  if(empty($item['isverify']) || $item['isverify'] == 0) { ?>checked="true"<?php  } ?> <?php  if(!empty($item)) { ?> disabled<?php  } ?> /> 不支持</label>
        <label class="radio-inline"><input type="radio" name="isverify" value="1" <?php  if($item['isverify'] == 1) { ?>checked="true"<?php  } ?> <?php  if(!empty($item)) { ?> disabled<?php  } ?>  /> 支持</label>
        <?php  } else { ?>
        <div class='form-control-static'>
            <?php  if(empty($item['isverify']) || $item['isverify'] == 1) { ?>不支持<?php  } else { ?>支持<?php  } ?>
        </div>
        <?php  } ?>

    </div>
</div>

<div class="form-group verify_groups" <?php  if(empty($item['isverify'])) { ?>style="display:none;"<?php  } ?>>
    <label class="col-xs-12 col-sm-3 col-md-2 control-label">核销类型</label>
    <div class="col-sm-6 col-xs-6">
        <?php if( ce('creditshop.goods' ,$item) ) { ?>
        <label class="radio-inline"><input type="radio" name="verifytype" value="0" <?php  if(empty($item['verifytype'])) { ?>checked="true"<?php  } ?>  /> 按订单核销</label>
        <label class="radio-inline"><input type="radio" name="verifytype" value="1" <?php  if($item['verifytype'] == 1) { ?>checked="true"<?php  } ?>   /> 按次核销</label>
        <div class='input-group' id="verifynum" style="margin:10px 0;<?php  if($item['verifytype'] == 0) { ?>display:none;<?php  } ?>">
            <span class="input-group-addon">核销次数</span>
            <input type="text" name="verifynum" value="<?php  echo $item['verifynum'];?>" class="form-control"/>
            <span class="input-group-addon">次</span>
        </div>
        <?php  } else { ?>
        <div class='form-control-static'>
            <?php  if(empty($item['isverify'])) { ?>按订单核销<?php  } else if($item['verifytype'] == 1) { ?>按消费码核销<?php  } else if($item['verifytype'] == 2) { ?>按次核销<?php  } ?>
        </div>
        <?php  } ?>
        <p class="help-block">
            按订单核销： 不管够买多少 一次核销完成<br>
            按次核销：  一个消费码使用多次
        </p>
    </div>
</div>
<div class="form-group verify_groups" <?php  if(empty($item['isverify'])) { ?>style="display:none;"<?php  } ?>>
    <label class="col-sm-2 control-label">兑换限时</label>
    <div class="col-sm-9 col-xs-12">
        <?php if( ce('creditshop.goods' ,$item) ) { ?>
        <label class="radio-inline">
            <input type="radio" name='isendtime' value="0" <?php  if(empty($item['isendtime'])) { ?>checked<?php  } ?> /> 指定时间兑换
        </label>
        <label class="radio-inline">
            <input type="radio" name='isendtime' value="1" <?php  if($item['isendtime']==1) { ?>checked<?php  } ?> /> 限时兑换
        </label>
        <?php  } else { ?>
        <div class='form-control-static'><?php  if(empty($item['isendtime'])) { ?>指定时间兑换<?php  } else { ?>限时兑换<?php  } ?></div>
        <?php  } ?>
    </div>
</div>
<div class="form-group verify_groups" id="usetime" <?php  if(empty($item['isverify']) || !empty($item['isendtime'])) { ?>style="display:none;"<?php  } ?>>
    <label class="col-sm-2 control-label">自动使用期限</label>
    <div class="col-sm-9 col-xs-12">
        <?php if( ce('creditshop.goods' ,$item) ) { ?>
        <div class="input-group">
            <input type='text' class='form-control' name='usetime' value="<?php  echo $item['usetime'];?>" />
            <span class="input-group-addon">天</span>
        </div>
        <span class='help-block'>商品购买X天后自动使用，自动使用后无法退款，设置为0则没有限制。</span>
        <?php  } else { ?>
        <div class='form-control-static'><?php  echo $item['usetime'];?>元</div>
        <?php  } ?>
    </div>
</div>
<div class="form-group" id="endtime" <?php  if(empty($item['isverify']) || empty($item['isendtime'])) { ?>style="display:none;"<?php  } ?>>
    <label class="col-sm-2 control-label">使用有效期至</label>
    <div class="col-sm-9 col-xs-12">
        <?php if( ce('creditshop.goods' ,$item) ) { ?>
        <?php  echo tpl_form_field_date('endtime', $endtime,true)?>
        <?php  } else { ?>
        <div class='form-control-static'>
            兑换之日起至 <?php  echo $endtime;?> 有效
        </div>
        <?php  } ?>
    </div>
</div>

<div class="form-group verify_groups" <?php  if(empty($item['isverify'])) { ?>style="display:none;"<?php  } ?>>
    <label class="col-sm-2 control-label">线下兑换门店选择</label>
    <div class="col-sm-9 col-xs-12 chks">
       <?php if( ce('creditshop.goods' ,$item) ) { ?>
           <?php  echo tpl_selector('storeids',array('text'=>'storename','type'=>'text', 'preview'=>true, 'multi'=>1, 'url'=>webUrl('shop/verify/store/query'), 'items'=>$stores,'buttontext'=>'选择门店','placeholder'=>'请输入门店名称'))?>
          <span class='help-block'>如果不选择门店，则此商品支持在所有门店兑换</span>
       <?php  } else { ?>
          <div class='form-control-static'>
             <?php  if(is_array($stores)) { foreach($stores as $store) { ?>
                  <?php  echo $store['storename'];?>; 
             <?php  } } ?>
           </div>
       <?php  } ?>
    </div>
  
</div>
<script type="text/javascript">
    $(function(){
        $("input[name='verifytype']").click(function(){
            if(this.value== true){
                $("#verifynum").show()
            }else{
                $("#verifynum").hide();
            }
        });
        $("input[name='isverify']").click(function(){
            if($(this).val()==1){
                $(".verify_groups").show();
            }else{
                $(".verify_groups").hide();
            }
        })

    })
</script>

