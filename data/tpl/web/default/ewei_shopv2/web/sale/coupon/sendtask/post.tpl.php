<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<div class="page-heading">
    <span class='pull-right'>
        <?php if(cv('sale.coupon')) { ?>
        	<a class='btn btn-primary btn-sm' href="<?php  echo webUrl('sale/coupon/sendtask/add')?>"><i class='fa fa-plus'></i> 添加任务</a>
        <?php  } ?>
        <a class="btn btn-default  btn-sm" href="<?php  echo webUrl('sale/coupon/sendtask')?>">返回列表</a>
    </span>
    <h2><?php  if(!empty($item['id'])) { ?>编辑<?php  } else { ?>添加<?php  } ?>发放任务</h2>
</div>

<form <?php if( ce('sale.coupon' ,$item) ) { ?>action="" method="post"<?php  } ?> class="form-horizontal form-validate" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php  echo $item['id'];?>" />
        <div class="tab-content ">
            <div class="tab-pane active">
                <div class="panel-body">

                    <div class="form-group ">
                        <label class="col-sm-2 control-label must">满足价格</label>
                        <div class="col-sm-9 col-xs-12">
                            <?php if( ce('sale.coupon' ,$item) ) { ?>
                            <div class="input-group">
                                <input type='text' class='form-control' name='enough' value="<?php  echo $item['enough'];?>"/>
                                <span class="input-group-addon">元</span>
                            </div>
                            <span class="help-block image-block" style="display: block;">当订单金额达到此金额要求时,触发发送优惠券任务</span>
                            <?php  } else { ?>
                            <div class='form-control-static'><?php  echo $item['price'];?></div>
                            <?php  } ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <?php if( ce('sale.coupon' ,$item) ) { ?>
                            <div class="form-group" >
                                <label class="col-sm-2 control-label">选择优惠券</label>
                                <div class="col-sm-9 col-xs-12">
                                    <div class="form-group ">
                                        <?php  echo tpl_selector('couponid',array(
                                        'preview'=>true,
                                        'readonly'=>true,
                                        'multi'=>0,
                                        'value'=>$item['title'],
                                        'url'=>webUrl('sale/coupon/querycoupons'),
                                        'items'=>$coupon,
                                        'buttontext'=>'选择优惠券',
                                        'placeholder'=>'请选择优惠券')
                                        )
                                        ?>
                                    </div>
                                </div>
                            </div>
                        <?php  } else { ?>
                            <?php  if(!empty($coupon)) { ?>
                                <a href="<?php  echo tomedia($coupon['thumb'])?>" target='_blank'>
                                    <img src="<?php  echo tomedia($coupon['thumb'])?>" style='width:100px;border:1px solid #ccc;padding:1px' />
                                </a>
                            <?php  } else { ?>
                            暂无商品
                            <?php  } ?>
                        <?php  } ?>
                    </div>

                    <div class="form-group ">
                        <label class="col-sm-2 control-label must">发送数量</label>
                        <div class="col-sm-9 col-xs-12">
                            <?php if( ce('sale.coupon' ,$item) ) { ?>
                            <div class="input-group">
                                <input type='text' class='form-control' name='sendnum' value="<?php  echo $item['sendnum'];?>"/>
                                <span class="input-group-addon">张</span>
                            </div>
                            <span class="help-block image-block" style="display: block;">当用户购买此商品时,赠送几张指定的优惠券</span>
                            <?php  } else { ?>
                            <div class='form-control-static'><?php  echo $item['sendnum'];?></div>
                            <?php  } ?>
                        </div>
                    </div>

                    <div class="form-group ">
                        <label class="col-sm-2 control-label must">剩余数量</label>
                        <div class="col-sm-9 col-xs-12">
                            <?php if( ce('sale.coupon' ,$item) ) { ?>
                            <div class="input-group">
                                <input type='text' class='form-control' name='num' value="<?php  echo $item['num'];?>" />
                                <span class="input-group-addon">张</span>
                            </div>
                            <span class="help-block image-block" style="display: block;">当剩余数量小于发送数量时,发送任务停止</span>
                            <?php  } else { ?>
                            <div class='form-control-static'><?php  echo $item['num'];?></div>
                            <?php  } ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">限时设置</label>
                        <div class="col-sm-9 col-xs-12">
                            <?php if( ce('sale.package' ,$item) ) { ?>
                            <div class="input-group">
                                <?php  echo tpl_form_field_daterange('sendtime', array('starttime'=>date('Y-m-d', intval($item['starttime'])),'endtime'=>date('Y-m-d', intval($item['endtime']))));?>

                            </div>
                            <?php  } else { ?>
                            <div class='form-control-static'><?php  echo date('Y-m-d H',$item['starttime'])?> - <?php  echo date('Y-m-d H',$item['endtime'])?></div>
                            <?php  } ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label must">发送节点</label>
                        <div class="col-xs-12 col-sm-8">
                            <div class="input-group">
                                <?php if( ce('sale.coupon' ,$item) ) { ?>
                                <label class="radio radio-inline">
                                    <input type="radio" name="sendpoint" value="1" <?php  if(intval($item['sendpoint']) ==1 ) { ?>checked="checked"<?php  } ?>> (推荐)订单完成后（包括子订单内所有订单收货后）发送优惠券
                                </label>
                                <label class="radio radio-inline">
                                    <input type="radio" name="sendpoint" value="2" <?php  if(intval($item['sendpoint']) ==2 ) { ?>checked="checked"<?php  } ?>> 订单付款后发送优惠券
                                </label>
                                <?php  } else { ?>
                                <div class='form-control-static'><?php  if(intval($item['sendpoint']) ==1 ) { ?>(推荐)订单完成后（包括子订单内所有订单收货后）发送优惠券<?php  } else if(intval($item['sendpoint']) ==2) { ?>订单付款后发送优惠券<?php  } ?></div>
                                <?php  } ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label must">状态</label>
                        <div class="col-xs-12 col-sm-8">
                            <div class="input-group">
                                <?php if( ce('sale.coupon' ,$item) ) { ?>
                                <label class="radio radio-inline">
                                    <input type="radio" name="status" value="0" <?php  if(intval($item['status']) ==0) { ?>checked="checked"<?php  } ?>> 关闭
                                </label>
                                <label class="radio radio-inline">
                                    <input type="radio" name="status" value="1" <?php  if(intval($item['status']) ==1 ) { ?>checked="checked"<?php  } ?>> 开启
                                </label>
                                <?php  } else { ?>
                                <div class='form-control-static'><?php  if(intval($item['status']) ==1 ) { ?>开启<?php  } else { ?>关闭<?php  } ?></div>
                                <?php  } ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <?php if( ce('sale.coupon' ,$item) ) { ?>
        <div class="form-group">
            <label class="col-sm-2 control-label"></label>
            <div class="col-sm-9 col-xs-12">
                <input type="submit"  value="提交" class="btn btn-primary" />
            </div>
        </div>
        <?php  } ?>
</form>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>