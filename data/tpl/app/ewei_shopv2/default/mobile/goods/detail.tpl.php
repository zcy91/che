<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<style>
    .fui-cell-group{width:100%;}
</style>
<div class='fui-page fui-page-current  page-goods-detail' id='page-goods-detail-index'>
    <?php  $this->followBar()?>

    <?php  if(empty($err)) { ?>
    <div class="fui-header">
        <div class="fui-header-left">
            <a class="back" id="btn-back"></a>
        </div>
        <div class="title">
            <div id="tab" class="fui-tab fui-tab-danger">
                <a data-tab="tab1" class="tab active">商品</a>
                <a data-tab="tab2" class="tab">详情</a>

                <?php  if(count($params)>0) { ?>
                <a data-tab="tab3" class="tab">参数</a>
                <?php  } ?>

                <?php  if($getComments) { ?>
                <a  data-tab="tab4" class="tab" style="display:none" id="tabcomment">评价</a>
                <?php  } ?>
            </div>
        </div>
        <div class="fui-header-right"></div>
    </div>
    <?php  } else { ?>
    <div class="fui-header ">
        <div class="fui-header-left">
            <a class="back" id="btn-back"></a>
        </div>
        <div class="title">
            找不到宝贝
        </div>
    </div>
    <?php  } ?>

    <?php  if(empty($err)) { ?>


    <?php  if(count($params)>0) { ?>
    <div class="fui-content param-block  <?php  if(!$goods['canbuy']) { ?>notbuy<?php  } ?>">
        <div class="fui-cell-group">
            <?php  if(!empty($params)) { ?>
            <?php  if(is_array($params)) { foreach($params as $p) { ?>
            <div class="fui-cell">
                <div class="fui-cell-label" ><?php  echo $p['title'];?></div>
                <div class="fui-cell-info overflow"><?php  echo $p['value'];?></div>
            </div>
            <?php  } } ?>

            <?php  } else { ?>
            <div class="fui-cell">
                <div class="fui-cell-info text-align">商品没有参数</div>
            </div>
            <?php  } ?>
        </div>
    </div>
    <?php  } ?>

    <div class='fui-content comment-block  <?php  if(!$goods['canbuy']) { ?>notbuy<?php  } ?>' data-getcount='1' id='comments-list-container'>
    <div class='fui-icon-group col-5 '>
        <div class='fui-icon-col' data-level='all'><span class='text-danger'>全部<br/><span class="count"></span></span></div>
        <div class='fui-icon-col' data-level='good'><span>好评<br/><span class="count"></span></span></div>
        <div class='fui-icon-col' data-level='normal'><span>中评<br/><span class="count"></span></span></div>
        <div class='fui-icon-col' data-level='bad'><span>差评<br/><span class="count"></span></span></div>
        <div class='fui-icon-col' data-level='pic'><span>晒图<br/><span class="count"></span></span></div>
    </div>
    <div class='content-empty' style='display:none;'>
        <i class='icon icon-community'></i><br/>暂时没有任何评价
    </div>
    <div class='container' id="comments-all"></div>
    <div class='infinite-loading'><span class='fui-preloader'></span><span class='text'> 正在加载...</span></div>
</div>

<div class="fui-content detail-block  <?php  if(!$goods['canbuy']) { ?>notbuy<?php  } ?>">
    <div class="text-danger look-basic"><i class='icon icon-unfold'></i> <span>上拉返回商品详情</span></div>
    <div class='content-block content-images'></div>
</div>


<div class='fui-content basic-block pulldown <?php  if(!$goods['canbuy']) { ?>notbuy<?php  } ?>'>


<?php  if(!empty($err)) { ?>
<div class='content-empty'>
    <i class='icon icon-search'></i><br/> 宝贝找不到了~ 您看看别的吧 ~<br/><a href="<?php  echo mobileUrl()?>" class='btn btn-default-o external'>到处逛逛</a>
</div>
<?php  } else { ?>
<?php  if($commission_data['qrcodeshare'] > 0) { ?>
<i class="icon icon-qrcode" id="alert-click"></i>
<?php  } ?>
<div class='fui-swipe'>
    <div class='fui-swipe-wrapper'>
        <?php  if(is_array($thumbs)) { foreach($thumbs as $thumb) { ?>
        <div class='fui-swipe-item'><img src="<?php echo EWEI_SHOPV2_PLACEHOLDER;?>"  data-lazy="<?php  echo tomedia($thumb)?>" /></div>
        <?php  } } ?>
    </div>
    <div class='fui-swipe-page'></div>
    <?php  if($goods['total']<=0 && !empty($_W['shopset']['shop']['saleout'])) { ?>
    <div class="salez">
        <img src="<?php  echo tomedia($_W['shopset']['shop']['saleout'])?>">
    </div>
    <?php  } ?>
</div>

<?php  if(!empty($seckillinfo) ) { ?>
<div class="seckill-container <?php  if($seckillinfo['status']==1) { ?>notstart<?php  } ?>"
     data-starttime="<?php  echo $seckillinfo['starttime']-time();?>"
     data-endtime="<?php  echo $seckillinfo['endtime']-time();?>"
     data-status="<?php  echo $seckillinfo['status'];?>">
    <div class="fui-list seckill-list" style="" >
        <div class="fui-list-media seckill-price">
            &yen;<span><?php  echo $seckillinfo['price'];?></span>
        </div>
        <div class="fui-list-inner">
            <div class="text"><span class="stitle"><?php  echo $seckillinfo['tag'];?></span></div>
            <div class="text"><span class="oldprice">&yen;<?php  echo $goods['minprice'];?></span></div>
        </div>
    </div>

    <div class="fui-list seckill-list1" style="" >
        <div class="fui-list-inner">
            <div class="text "><?php  if($seckillinfo['status']==0) { ?>已出售 <?php  echo $seckillinfo['percent'];?>%<?php  } ?></div>
            <div class="text "><?php  if($seckillinfo['status']==0) { ?><span class="process"><div class="inner" style="width:<?php  echo $seckillinfo['percent'];?>%"></div></span><?php  } ?></div>
        </div>
    </div>

    <div class="fui-list seckill-list2" style="" >
        <div class="fui-list-inner">
            <div class="text ">距<?php  if($seckillinfo['status']==1) { ?>开始<?php  } else { ?>结束<?php  } ?>还有</div>
            <div class="text timer">
                <span class="time-hour">-</span>&nbsp;:&nbsp;<span class="time-min">-</span>&nbsp;:&nbsp;<span class="time-sec">-</span>
            </div>
        </div>

    </div>


</div>
<?php  } ?>


<div class="fui-cell-group fui-detail-group" >
    <div class="fui-cell">
        <div class="fui-cell-text name"><?php  echo $goods['title'];?></div>
        <?php  if(empty($share['goods_detail_close'])) { ?>
        <a class="fui-cell-remark share"  <?php  if(!empty($goods['sharebtn']) && $member['isagent']==1 && $member['status']==1) { ?> href="<?php  echo mobileUrl('commission/qrcode', array('goodsid'=>$goods['id']))?>" <?php  } else { ?> id='btn-share' <?php  } ?>>
        <i class="icon icon-share"></i>
        <p>分享</p>
        </a>
        <?php  } ?>
    </div>
    <?php  if(!empty($goods['shorttitle'])) { ?>
    <div class="fui-cell goods-subtitle">
        <span class='text-danger' style="color: black"><?php  echo $goods['shorttitle'];?></span>
    </div>
    <?php  } ?>
    <?php  if(!empty($goods['subtitle'])) { ?>
    <div class="fui-cell goods-subtitle">
        <span class='text-danger'><?php  echo $goods['subtitle'];?></span>
    </div>
    <?php  } ?>

    <?php  if(empty($seckillinfo)) { ?>
    <?php  if($goods['pcate']!=1174) { ?>
    <div class="fui-cell">
        <div class="fui-cell-text price">
			<span class="text-danger">
			<?php  if($goods['merchid']) { ?>积分：<?php  } else { ?>￥<?php  } ?><?php  if($goods['minprice']==$goods['maxprice']) { ?><?php  echo $goods['minprice'];?><?php  } else { ?><?php  echo $goods['minprice'];?>~<?php  echo $goods['maxprice'];?><?php  } ?>
			<?php  if($goods['isdiscount'] && $goods['isdiscount_time']>=time()) { ?>
			     <span class="original">￥<?php  echo $goods['productprice'];?></span>
			<?php  } else { ?>
			<?php  if($goods['productprice']>0) { ?><span  class="original">￥<?php  echo $goods['productprice'];?></span><?php  } ?>
			<?php  } ?>
			</span>
        </div>
    </div>
    <?php  } ?>



    <?php  if($goods['isdiscount'] && $goods['isdiscount_time']>=time()) { ?>
    <div class="row row-time">
        <div id='discount-container' class='fui-labeltext fui-labeltext-danger'
             data-now="<?php  echo date('Y-m-d H:i:s')?>"
             data-end="<?php  echo date('Y-m-d H:i:s', $goods['isdiscount_time'])?>"
             data-end-label='<?php echo empty($goods['isdiscount_title'])?'促销':$goods['isdiscount_title']?>' >
        <div class='label'><?php echo empty($goods['isdiscount_title'])?'促销':$goods['isdiscount_title']?></div>
        <div class='text'>
            <span class="day number text-danger" >-</span><span class="time">天</span>
            <span class="hour number text-danger">-</span><span class="time">小时</span>
            <span class="minute number text-danger">-</span><span class="time">分</span>
            <span class="second number text-danger">-</span><span class="time">秒</span>
        </div>
    </div>

</div>
<?php  } ?>

<?php  if($goods['istime']) { ?>
<div class="row row-time">
        <div id='time-container' class='fui-labeltext fui-labeltext-danger'
             data-now="<?php  echo date('Y-m-d H:i:s')?>"
             data-start-label='距离限时购开始'
             data-end-label='距离限时购结束'
             data-end-text='活动已经结束，下次早点来~'
             data-start="<?php  echo date('Y-m-d H:i:s', $goods['timestart'])?>"
             data-end="<?php  echo date('Y-m-d H:i:s', $goods['timeend'])?>"
        >
            <div class='label'>限时购</div>
            <div class='text'>
                <span class="day number"></span><span class="time">天</span><span class="hour number"></span><span class="time">小时</span><span class="minute number"></span><span class="time">分</span><span class="second number"></span><span class="time">秒</span>
            </div>
        </div>
</div>
<?php  } ?>
<?php  } ?>




<div class="fui-cell">
    <div class="fui-cell-text flex">
        <?php  if($goods['pcate']==1174) { ?>
        <span class="t2 fs-18 text-primary">厂商指导价:  <?php echo $goods['zhidaojia'] == 0 ? '详情进店咨询' : number_format($goods['zhidaojia'],2)?>万</span>
        <?php  } else { ?>
            <?php  if(is_array($goods['dispatchprice'])) { ?>
            <?php  if($goods['type']==1) { ?>
            <span>快递:  <?php  echo number_format($goods['dispatchprice']['min'],2)?> ~ <?php  echo number_format($goods['dispatchprice']['max'],2)?></span>
            <?php  } ?>
            <?php  } else { ?>
            <?php  if($goods['type']==1) { ?>
            <span>快递:  <?php echo $goods['dispatchprice'] == 0 ? '包邮' : number_format($goods['dispatchprice'],2)?></span>
            <?php  } ?>
            <?php  } ?>
        <?php  } ?>
        <?php  if($seckillinfo==false || ( $seckillinfo && $seckillinfo.status==1)) { ?>
        <?php  if($goods['showtotal'] == 1) { ?>
        <span>库存:  <?php  echo $goods['total'];?></span>
        <?php  } ?>
        <span>销量:  <?php  echo number_format($goods['sales'],0)?> <?php  echo $goods['unit'];?></span>
        <?php  } else { ?>
        <span></span>
        <span></span>
        <?php  } ?>


        <?php  if($goods['province'] != '请选择省份' && $goods['city'] != '请选择城市') { ?>
        <span><?php  echo $goods['province'];?> <?php  echo $goods['city'];?></span>
        <?php  } ?>
    </div>
</div>
</div>

<?php  if(empty($seckillinfo)) { ?>
<?php  if(floatval($goods['buyagain'])>0) { ?>
<div class="fui-cell-group  fui-sale-group" style="margin-top:0">
    <div class="fui-cell">
        <div class="fui-cell-text" style="white-space: normal;">此商品二次购买 可享受 <span class="text-danger"><?php  echo $goods['buyagain'];?></span> 折优惠
            <?php  if(empty($goods['buyagain_sale'])) { ?>
            <br>二次购买的时候 不与其他优惠共享
            <?php  } ?>
        </div>
    </div>
</div>
<?php  } ?>

<?php  if(empty($goods['isdiscount']) || (!empty($goods['isdiscount']) &&$goods['isdiscount_time']<time())) { ?>
<?php  if(!empty($memberprice) && $memberprice!=$goods['minprice'] && !empty($level)) { ?>
<div class="fui-cell-group  fui-sale-group" style="margin-top:0">
    <div class="fui-cell">
        <div class="fui-cell-text" style="white-space: normal;">您的会员等级是 <span class="text-danger"><?php  echo $level['levelname'];?></span> 可享受 <span class="text-danger">￥<?php  echo $memberprice;?></span> 的价格</div>
    </div>
</div>
<?php  } ?>
<?php  } ?>

<?php  } ?>

<?php  if((!empty($goods['deduct']) && $goods['deduct'] != '0.00')  || !empty($goods['credit'])) { ?>
<div class='fui-cell-group  fui-sale-group' style='margin-top:0'>
    <div class='fui-cell'>
        <div class='fui-cell-text'><?php  echo $_W['shopset']['trade']['credittext'];?> <?php  if(!empty($goods['deduct']) && $goods['deduct'] != '0.00') { ?>最高抵扣 <span class="text-danger"><?php  echo $goods['deduct'];?></span> 元<?php  } ?> <?php  if(!empty($goods['credit'])) { ?>购买赠送 <span class="text-danger"><?php  echo $goods['credit'];?></span> <?php  echo $_W['shopset']['trade']['credittext'];?><?php  } ?></div>
    </div>
</div>
<?php  } ?>

<?php  if($has_city) { ?>
<div class='fui-cell-group fui-cell-click  fui-sale-group' style='margin-top:0' id="city-picker">
    <div class='fui-cell'>
        <div class='fui-cell-text'>不配送区域:
            <?php  if(is_array($citys)) { foreach($citys as $item) { ?>
            <?php  echo $item;?>
            <?php  } } ?>
        </div>

        <div class='fui-cell-remark'></div>
    </div>
</div>
<?php  } ?>

<?php  if($gifts && $goods['total'] > 0) { ?>
<div class='fui-cell-group fui-sale-group' style='margin-top:0'>
    <div class='fui-cell'>
        <?php  if(count($gifts)>1) { ?>
        <div class='fui-cell-text fui-cell-giftclick'>
            赠品: <label id="gifttitle">请选择赠品</label>
            <input type="hidden" name="giftid" id="giftid" value="">
        </div>
        <?php  } else { ?>
        <?php  if(is_array($gifts)) { foreach($gifts as $item) { ?>
        <div class='fui-cell-text' onclick="javascript:window.location.href='<?php  echo mobileUrl('goods/gift',array('id'=>$item['id']))?>'">
            赠品:<?php  echo $gifttitle;?><input type="hidden" name="giftid" id="giftid" value="<?php  echo $item['id'];?>">
        </div>
        <?php  } } ?>
        <?php  } ?>
        <div class='fui-cell-remark'></div>
    </div>
</div>
<?php  } ?>

<?php  if($hasSales && empty($seckillinfo)) { ?>

<div class='fui-cell-group fui-cell-click  fui-sale-group' style='margin-top:0' id="sale-picker">
    <div class='fui-cell'>
        <div class='fui-cell-text'>优惠
            <?php  if($enoughfree && $enoughfree==-1) { ?>
            全场包邮
            <?php  } else { ?>
            <?php  if($goods['ednum']>0) { ?>单品满 <span class="text-danger"><?php  echo $goods['ednum'];?></span> <?php echo empty($goods['unit'])?'件':$goods['unit']?>包邮<?php  } ?>
            <?php  if($goods['edmoney']>0) { ?>单品满 <span class="text-danger">￥<?php  echo $goods['edmoney'];?></span> 包邮<?php  } ?>
            <?php  if($enoughfree) { ?>全场满 <span class="text-danger">￥<?php  echo $enoughfree;?></span> 包邮<?php  } ?>
            <?php  } ?>
            <?php  if($enoughs && count($enoughs)>0) { ?>
            全场满 <span class="text-danger">￥<?php  echo $enoughs[0]['enough'];?></span> 立减 <span class="text-danger">￥<?php  echo $enoughs[0]['money'];?></span>
            <?php  } ?>
        </div>

        <div class='fui-cell-remark'></div>
    </div>
</div>

<?php  } ?>




<?php  if(!empty($stores)) { ?>
<script language='javascript' src='http://api.map.baidu.com/api?v=2.0&ak=ZQiFErjQB7inrGpx27M1GR5w3TxZ64k7'></script>
<div class='fui-according-group'>
    <div class='fui-according'>
        <div class='fui-according-header'>
            <i class='icon icon-shop'></i>
            <span class="text">适用门店</span>
            <span class="remark"><div class="badge"><?php  echo count($stores)?></div></span>
        </div>
        <div class="fui-according-content store-container">
            <?php  if(is_array($stores)) { foreach($stores as $item) { ?>
            <div  class="fui-list store-item"

                  data-lng="<?php  echo floatval($item['lng'])?>"
                  data-lat="<?php  echo floatval($item['lat'])?>">
                <div class="fui-list-media">
                    <i class='icon icon-shop'></i>
                </div>
                <div class="fui-list-inner store-inner">
                    <div class="title"><span class='storename'><?php  echo $item['storename'];?></span></div>
                    <div class="text">
                        地址: <span class='realname'><?php  echo $item['address'];?></span>
                    </div>
                    <div class="text">
                        电话: <span class='address'><?php  echo $item['tel'];?></span>
                    </div>
                </div>
                <div class="fui-list-angle ">
                    <?php  if(!empty($item['tel'])) { ?><a href="tel:<?php  echo $item['tel'];?>" class='external '><i class=' icon icon-phone' style='color:green'></i></a><?php  } ?>
                    <a href="<?php  echo mobileUrl('store/map',array('id'=>$item['id'],'merchid'=>$item['merchid']))?>" class='external' ><i class='icon icon-location' style='color:#f90'></i></a>
                </div>
            </div>
            <?php  } } ?>
        </div>

        <div id="nearStore" style="display:none">

            <div class='fui-list store-item'  id='nearStoreHtml'></div>
        </div>
    </div></div>
<?php  } ?>
<?php  if($goods['pcate']==1174) { ?>
<div class="scheme section" style="    margin-top: 13px;
    padding: 22px 16px 18px;">
    <div class="title" style="color: #191919;
    font-size: 16px;
    padding-left: 13px;
    height: 14px;
    line-height: 14px;
    background: url('http://picm.photophoto.cn/005/014/009/0140090047.jpg') no-repeat 0;
    background-size: contain;
    margin-bottom: 20px; display: none" >
        先用一年
    </div>
    <div class="payment" style="background-color: #dfdfdf;
    margin-bottom: 17px;
    border-radius: 4px;
    min-height: 70px;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    text-align: center;
    -ms-flex-pack: distribute;
    justify-content: space-around;">
        <div class="item">
            <div class="t1 fs-12 text-gray">
                首付
            </div>
            <div class="t2 fs-18 text-primary">
                <b><?php  echo $goods['shoufu'];?>万</b>
            </div>
        </div>
        <div class="item">
            <div class="t1 fs-12 text-gray">
                月供&nbsp;<!---->
            </div>
            <div class="t2 fs-18 text-primary">
                <b><?php  echo $goods['yuegong'];?>元</b>
            </div>
        </div>
        <div class="item">
            <div class="t1 fs-12 text-gray">
                期数
            </div>
            <div class="t2 fs-18 text-primary">
                <b><?php  echo $goods['qishu'];?>期</b>
            </div>
        </div>
    </div>

    <div class="tips tips1 fs-12" style="    margin-bottom: 32px;color: #999;font-size: 12px;">
        <p class="scheme-tags" style="    margin-bottom: 12px;">
            ·<?php  if($labelname) { ?>
            <?php  if(is_array($labelname)) { foreach($labelname as $item) { ?>
             <span style="    display: inline-block;
    color: #ff5719;
    margin-right: 8px;
    padding: 1px 5px;
    border: none;
    font-size: 12px;
    background-color: rgba(255,87,26,.1);
    position: relative;"><?php  echo $item;?></span>
            <?php  } } ?>
            <?php  } ?>
        </p>
        <div class="fee" style="    line-height: 18px;
    height: 18px;">
            <div>
                · <?php  echo $fuwuchar;?><?php  echo $goods['fuwufei'];?>元<a href="http://jyqc.hejiewl.com/app/index.php?i=1&c=entry&m=ewei_shopv2&do=mobile&r=diypage&id=21" style="display: none"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAC4AAAAuCAYAAABXuSs3AAAAAXNSR0IArs4c6QAABPRJREFUaAXVmTtPVEEUx2eR92uB8IjEQMFj6ShA+QjGmKAFCZ3GxoLCUgsjhcZCSj+ACXQmFmpijB8BAwUFhYsSAsvyhizh/fT/H+9cZx9379y7FxYmWWZ25pwzv3v2zJm5gxDXtISC4J6YmLhZUFBw7/z8vA32mlE3s7Zsx0OhUBxt1n/Ozs6+9/b2Llljvivf4JOTk+0AHADMA8zeh7aRLcifQ34c8l/Q/tTT0/PbD73RZLrhqampWycnJ6/R9xiTF+hjXtsAP4POaGFh4XB3d3fMi74x+MzMTPX29vZLwD7DBKVeJjGQPcBDvK+urn7b0dGxbSAvjMDh5cjx8fFXGOw0MZqDTLSoqKgf3v/lZsMVHLF8F17+CENhN2MBjSfg/UHE/o9s9rLGKKCfAvrbJUKTNcw5OXc2cEePW54m9I1sBi5w7BSev+/k+YzgVkyPA+qywsPp+ROI+b5MMZ8WKswe1kLMCRreEvzkWMJkIVOqncLUDqY89PnKHpWVlaKhoUGUlZWJ0tJ/GfPo6Ejs7e2J5eVlWafOZ/C902J6ocsmuYSbC55wBgKe83RLS4uE1o3rbSw4sba2JhYWFvRu0/YBQqZD36SSPI4d8Q0seYZubW0V9fX1EgI2xPr6utjf35ffKyoq5BjOMqKxsVHwF1hZWTEFVnKlFtsT1WF7HFmkHZ2/4Jm0uFfCmWqGRyQSkUOHh4ciGo1KOF2WodPV1SUIT89PT08LynopWC88HkTU2caGhMEBr9CcuK6uzp4/Ho+nQXOQ3l9dXZVyXLBVVVW2jmmDbGRU8jY4Oh6qTi91eXm5FIdRsbW15ai6s7Njjykdu8O8YTNKcJ6n4Yk75vr/JXGyk18Y24R3KnpqZMj4KWQkK3XlrHwJwAHfjncvRmdnZ2W+hn5WNT081MLNqpBhEI4JkRVDHyQ4Ovjm4qswR7sVld8pd3p6KjY3N91UHMcVq/rN1GuWo4LfAWaUtrY2exedn58X2Cv8mqOeZJXgeIoLAS8pKRF4MRBqHXDzycXbpFasF+ZxwhIaOx7nE7FYzE6JssP/n/8ehw3ndOBzAh4B6HGWxcVFP7ul08ySVXk85+sCfRYesGpqamTX7u6uPGDp4zm2JasER37kvUdgpba21l6MS0uB+oR2JavyeKDg6khLT5ikS48ek6wyj+Mp/mC1etR3FqctlfKYt4MsZKU9Cc5rMXRgPrPbKDeQubk5NxFf42QkK5VlqPAuD9A/fVm7XKVxde8oPW7N/Rl1XxAcfGEoLi6WpvjW4/Xs7cQA535RY2pxcrV+wif7SUlpudQ8ozc1NcmP2oBcVFyHyUZGJWiDW28WY2rgCtaj6u2HbDY4v2CbfoXqgO1cSiKREBsbG/LDc3oA5QBsw7qdtDM43j3fIZae60L5biNERuDtpOuJJI8TkFe9qKL5htXmj1pMWldKqHCE99NYUP1oJpIk8/OFV3D9me7M0zxOPt7V4ecZRDPYbc/bw/PSczDTvSHNZATnAGLqBxSH0MwHPKGHyECWTCVtcaYKWdfNV+5i3xWcD3IV/5XiGCq65xln4XD4Nn6+EfTnnOd121ab/7wa4RxOMZ2qY+RxXYk3utYF5CPke6MH1/X1NmB5xBjjxgfgmD7m1vYMrgzykhTgvMt7CIA7aBvZgixE5Un0M9qX9w9aBa7X+fiXuD7/tWr/BRfC+fouFKJ3AAAAAElFTkSuQmCC" width="12px"></a>

            </div>
            </div>
    </div>
    <div class="title title1" style="color: #191919;
    font-size: 16px;
    padding-left: 13px;
    height: 14px;
    line-height: 14px;
    background: url('http://picm.photophoto.cn/005/014/009/0140090047.jpg') no-repeat 0;
    background-size: contain;
    margin-bottom: 20px; display: none">
        一年后
    </div>
    <div class="tips fs-12" style="font-size: 12px;    color: #999;">
        <p class="final-payment" style="margin-bottom: 10px;">
            · <span style="    color: #ff5517;
    font-size: 16px;
    line-height: 1;"><?php  echo $wkchar;?>&nbsp;<?php  echo $goods['weikuan'];?>万</span>
        </p>
        <p>
            · <?php  echo $fqchar;?>&nbsp;<?php  echo $goods['yuegong2'];?>元 x <?php  echo $goods['qishu2'];?>个月
        </p>
    </div>
</div>
<?php  } ?>

<?php  if($goods['canbuy'] && $goods['pcate']!=1174) { ?>
<div class="fui-cell-group fui-cell-click">
    <div class="fui-cell">
        <div class="fui-cell-text option-selector">请选择<?php  if(empty($spec_titles)) { ?>数量<?php  } else { ?><?php  echo $spec_titles;?>等<?php  } ?></div>
        <div class="fui-cell-remark"></div>
    </div>
</div>
<?php  } else { ?>
<div class="fui-cell-group fui-cell-click">
    <div class="fui-cell">
        <div class="fui-cell-text">
            <?php  if($goods['userbuy']==0) { ?>
            您已经超出最大<?php  echo $goods['usermaxbuy'];?>件购买量
            <?php  } else if($goods['levelbuy']==0) { ?>
            您当前会员等级没有购买权限
            <?php  } else if($goods['groupbuy']==0) { ?>
            您所在的用户组没有购买权限
            <?php  } else if($goods['timebuy'] ==-1) { ?>
            未到开始抢购时间!
            <?php  } else if($goods['timebuy'] ==1) { ?>
            抢购时间已经结束!
            <?php  } else if($goods['total'] <=0) { ?>
            商品已经售罄!
            <?php  } ?></div>
    </div>
</div>

<?php  } ?>

<?php  if($packages && $goods['total'] > 0) { ?>
<?php  if(count($packages)<=3) { ?>
<style>
    .package-goods{padding:0.2rem 1rem;}
</style>
<div class="fui-cell-group fui-comment-group">
    <div class="fui-cell fui-cell-click">
        <div class="fui-cell-text desc">相关套餐</div>
        <div class="fui-cell-text desc label" onclick="javascript:window.location.href='<?php  echo mobileUrl('goods/package',array('goodsid'=>$goods['id']))?>'">更多套餐</div>
        <div class="fui-cell-remark"></div>
    </div>
    <div class="fui-cell">
        <div class="fui-cell-text comment ">
            <div class="fui-list package-list">
                <?php  if(is_array($packages)) { foreach($packages as $item) { ?>
                <div class="fui-list-inner package-goods" onclick="javascript:window.location.href='<?php  echo mobileUrl('goods/package/detail',array('pid'=>$package_goods['pid']))?>'">
                    <img src="<?php  echo tomedia($item['thumb'])?>" class="package-goods-img" alt="<?php  echo $item['title'];?>">
                    <span><?php  echo $item['title'];?></span>
                </div>
                <?php  } } ?>
            </div>
        </div>
    </div>
</div>
<?php  } else { ?>
<div class="fui-cell-group fui-comment-group">
    <div class="fui-cell fui-cell-click">
        <div class="fui-cell-text desc">相关套餐</div>
        <div class="fui-cell-text desc label" onclick="javascript:window.location.href='<?php  echo mobileUrl('goods/package',array('goodsid'=>$goods['id']))?>'">更多套餐</div>
        <div class="fui-cell-remark"></div>
    </div>
    <div id="product" class="fui-list">
        <span class="prev fui-list-media"><i class="icon icon-left"></i></span>
        <div id="content" class="fui-list-inner">
            <div id="content_list" onclick="javascript:window.location.href='<?php  echo mobileUrl('goods/package/detail',array('pid'=>$package_goods['pid']))?>'">
                <?php  if(is_array($packages)) { foreach($packages as $item) { ?>
                <dl class="package-goods package-goods3">
                    <dt><img class="package-goods-img" src="<?php  echo tomedia($item['thumb'])?>"/></dt>
                    <dd><?php  echo $item['title'];?></dd>
                </dl>
                <?php  } } ?>
            </div>
        </div>
        <span class="next fui-list-media"><i class="icon icon-right1"></i></span>
    </div>
</div>
<script type="text/javascript">
    $(function(){
        var page = 1;
        var i = 3; //每版放4个图片
        //向后 按钮
        $("span.next").click(function(){    //绑定click事件
            var content = $("div#content");
            var content_list = $("div#content_list");
            var v_width = content.width();
            var len = content.find("dl").length;
            var page_count = Math.ceil(len / i) ;   //只要不是整数，就往大的方向取最小的整数
            if( !content_list.is(":animated") ){    //判断“内容展示区域”是否正在处于动画
                if( page == page_count ){  //已经到最后一个版面了,如果再向后，必须跳转到第一个版面。
                    content_list.animate({ left : '0px'}, "slow"); //通过改变left值，跳转到第一个版面
                    page = 1;
                }else{
                    content_list.animate({ left : '-='+v_width }, "slow");  //通过改变left值，达到每次换一个版面
                    page++;
                }
            }
        });
        //往前 按钮
        $("span.prev").click(function(){
            var content = $("div#content");
            var content_list = $("div#content_list");
            var v_width = content.width();
            var len = content.find("dl").length;
            var page_count = Math.ceil(len / i) ;   //只要不是整数，就往大的方向取最小的整数
            if(!content_list.is(":animated") ){    //判断“内容展示区域”是否正在处于动画
                if(page == 1 ){  //已经到第一个版面了,如果再向前，必须跳转到最后一个版面。
                    content_list.animate({ left : '-='+v_width*(page_count-1) }, "slow");
                    page = page_count;
                }else{
                    content_list.animate({ left : '+='+v_width }, "slow");
                    page--;
                }
            }
        });
    });
</script>
<?php  } ?>

<script type="text/javascript">
    $(function(){
        $(".package-goods-img").height($(".package-goods-img").width());
    })
</script>
<?php  } ?>

<div id='comments-container'></div>

<div class="fui-cell-group fui-shop-group">
    <div class='fui-list'>
        <div class='fui-list-media'>
            <img data-lazy="<?php  echo tomedia($shopdetail['logo'])?>" />
        </div>
        <div class='fui-list-inner'>
            <div class='title'><?php  echo $shopdetail['shopname'];?></div>
            <div class='subtitle'><?php  echo $shopdetail['description'];?></div>
        </div>
    </div>

    <div class="fui-cell">
        <div class="fui-cell-text center"><?php  echo $statics['all'];?><p>全部</p></div>
        <div class="fui-cell-text center"><?php  echo $statics['new'];?><p>新品</p></div>
        <div class="fui-cell-text center"><?php  echo $statics['discount'];?><p>促销</p></div>
    </div>
    <div class="fui-cell btns">
        <div class="fui-cell-text center">
            <a class="btn btn-default-o external" href="<?php  echo $shopdetail['btnurl1'];?>"><?php  if(!empty($shopdetail['btntext1'])) { ?><?php  echo $shopdetail['btntext1'];?><?php  } else { ?>全部商品<?php  } ?></a>
            <a class="btn btn-default-o external" href="<?php  echo $shopdetail['btnurl2'];?>"><?php  if(!empty($shopdetail['btntext2'])) { ?><?php  echo $shopdetail['btntext2'];?><?php  } else { ?>进店逛逛<?php  } ?></a>
        </div>
    </div>
</div>

<?php  if($buyshow==1 && !empty($goods['buycontent'])) { ?>
<div class="fui-cell-group">
    <div class="fui-cell">
        <div class="content-block"><?php  echo $goods['buycontent'];?></div>
    </div>
</div>
<?php  } ?>

<div class="fui-cell-group">
    <div class="fui-cell">
        <div class="fui-cell-text text-center look-detail"><i class='icon icon-fold'></i> <span>上拉查看图文详情</span></div>
    </div>
</div>
<?php  } ?>
</div>
<?php  if($isgift && $goods['total'] > 0) { ?>
<div id='gift-picker-modal' style="margin:-100%;">
    <div class='gift-picker'>
        <div class="fui-cell-group fui-sale-group" style='margin-top:0;'>
            <div class="fui-cell">
                <div class="fui-cell-text dispatching">
                    请选择赠品:
                    <div class="dispatching-info" style="max-height:12rem;overflow-y: auto ">
                        <?php  if(is_array($gifts)) { foreach($gifts as $item) { ?>
                        <div class="fui-list goods-item align-start" data-giftid="<?php  echo $item['id'];?>">
                            <div class="fui-list-media">
                                <input type="radio" name="checkbox" class="fui-radio fui-radio-danger gift-item" value="<?php  echo $item['id'];?>" style="display: list-item;">
                            </div>
                            <div class="fui-list-inner">
                                <?php  if(is_array($item['gift'])) { foreach($item['gift'] as $gift) { ?>
                                <div class="fui-list">
                                    <div class="fui-list-media image-media" style="position: initial;">
                                        <a href="javascript:void(0);">
                                            <img class="round" src="<?php  echo tomedia($gift['thumb'])?>" data-lazyloaded="true">
                                        </a>
                                    </div>
                                    <div class="fui-list-inner">
                                        <a href="javascript:void(0);">
                                            <div class="text">
                                                <?php  echo $gift['title'];?>
                                            </div>
                                        </a>
                                    </div>
                                    <div class='fui-list-angle'>
                                        <span class="price">&yen;<del class='marketprice'><?php  echo $gift['marketprice'];?></del></span>
                                    </div>
                                </div>
                                <?php  } } ?>
                            </div>
                        </div>
                        <?php  } } ?>
                    </div>
                </div>
            </div>
            <div class='btn btn-danger block'>确定</div>
        </div>
    </div>
</div>
<?php  } ?>

<?php  if($goods['canbuy']) { ?>
<div class="fui-navbar bottom-buttons">

    <a  class="nav-item favorite-item <?php  if($isFavorite) { ?>active<?php  } ?>" data-isfavorite="<?php  echo intval($isFavorite)?>">
        <span class="icon <?php  if($isFavorite) { ?>icon-likefill<?php  } else { ?>icon-like<?php  } ?>"></span>
        <span class="label" >关注</span>
    </a>
    <?php  if($goods['pcate']!=1174) { ?>
    <a  class="nav-item external" href="<?php echo !empty($goods['merchid']) ? mobileUrl('merch',array('merchid'=>$goods['merchid'])) : mobileUrl('');?>">
        <span class="icon icon-shop"></span>
        <span class="label" >店铺</span>
    </a>
    <a class="nav-item cart-item" href="<?php  echo mobileUrl('member/cart')?>" data-nocache="true" he="" id="menucart">
        <span class='badge <?php  if($cartCount<=0) { ?>out<?php  } else { ?>in<?php  } ?>'><?php  echo $cartCount;?></span>
        <span class="icon icon-cart"></span>
        <span class="label">购物车</span>
    </a>
    <?php  if($canAddCart) { ?>
    <a  class="nav-item btn cartbtn">加入购物车</a>
    <?php  } ?>
    <?php  } ?>
    <?php  if(!empty($seckillinfo) && $seckillinfo['status']==1) { ?>
    <a  class="nav-item btn buybtn seckill-notstart">原价购买</a>
    <?php  } else { ?>
    <?php  if($goods['pcate']!=1174) { ?>
    <a  class="nav-item btn buybtn">立刻购买</a>
    <?php  } else { ?> <a  class="nav-item btn buybtn">立即预约</a>
    <?php  } ?>
    <?php  } ?>
</div>
<?php  } ?>

<?php  if($has_city) { ?>
<div id='city-picker-modal' style="margin: -100%;">
    <div class='city-picker'>
        <div class='fui-cell-title'>促销活动</div>

        <div class="fui-cell-group fui-sale-group" style='margin-top:0;'>

            <div class="fui-cell">
                <div class="fui-cell-text dispatching">
                    不配送区域:
                    <div class="dispatching-info">
                        <?php  if(is_array($citys)) { foreach($citys as $item) { ?>
                        <i><?php  echo $item;?></i>
                        <?php  } } ?>
                    </div>
                </div>
            </div>


            <div class='btn btn-danger block'>确定</div>
        </div>
    </div>
</div>
<?php  } ?>


<div id='sale-picker-modal' style="margin: -100%;">
    <div class='sale-picker'>
        <div class='fui-cell-title'>促销活动</div>

        <div class="fui-cell-group fui-sale-group" style='margin-top:0'>
            <?php  if($enoughfree && $enoughfree==-1) { ?>
            <div class="fui-cell"><div class="fui-cell-text">全场包邮</div></div>
            <?php  } else { ?>

            <?php  if($enoughfree>0) { ?>
            <div class="fui-cell">
                <div class="fui-cell-text">全场满 <span class="text-danger">￥<?php  echo $enoughfree;?></span> 包邮</div>
            </div>
            <?php  } ?>

            <?php  if($goods['ednum']>0) { ?>
            <div class="fui-cell">
                <div class="fui-cell-text">单品满 <span class="text-danger"><?php  echo $goods['ednum'];?></span> <?php echo empty($goods['unit'])?'件':$goods['unit']?>包邮
                </div>
            </div>
            <?php  } ?>
            <?php  if($goods['edmoney']>0) { ?>

            <div class="fui-cell">
                <div class="fui-cell-text">单品满 <span class="text-danger">￥<?php  echo $goods['edmoney'];?></span> 包邮
                </div>
            </div>

            <?php  } ?>
            <?php  } ?>



            <?php  if($enoughfree || ($enoughs && count($enoughs)>0)) { ?>

            <?php  if($enoughs && count($enoughs)>0) { ?>
            <div class='fui-according'>
                <div class='fui-according-header'>
                    <div class="text">
                        <div class="fui-cell-text">全场满 <span class="text-danger">￥<?php  echo $enoughs[0]['enough'];?></span> 立减 <span class="text-danger">￥<?php  echo $enoughs[0]['money'];?></span></div>
                    </div>
                    <?php  if(count($enoughs)>1) { ?><span class="remark">更多</span><?php  } ?>
                </div>
                <?php  if(count($enoughs)>1) { ?>
                <div class='fui-according-content'>
                    <?php  if(is_array($enoughs)) { foreach($enoughs as $key => $enough) { ?>
                    <?php  if($key>0) { ?>
                    <div class="fui-cell">
                        <div class="fui-cell-text">满 <span class="text-danger">￥<?php  echo $enough['enough'];?></span> 立减 <span class="text-danger">￥<?php  echo $enough['money'];?></span></div>
                    </div>
                    <?php  } ?>
                    <?php  } } ?>
                </div>
                <?php  } ?>
            </div>
            <?php  } ?>



            <?php  } ?>
            <div class='btn btn-danger block'>确定</div>
        </div>
    </div>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('goods/picker', TEMPLATE_INCLUDEPATH)) : (include template('goods/picker', TEMPLATE_INCLUDEPATH));?>

<?php  if($getComments) { ?>
<script type='text/html' id='tpl_goods_detail_comments_list'>
    <div class="fui-cell-group fui-comment-group">
        <%each list as comment%>
        <div class="fui-cell">
            <div class="fui-cell-text comment ">
                <div class="info head">
                    <div class='img'><img src='<%comment.headimgurl%>'/></div>
                    <div class='nickname'><%comment.nickname%></div>

                    <div class="date"><%comment.createtime%></div>
                    <div class="star star1">
                        <span <%if comment.level>=1%>class="shine"<%/if%>>★</span>
                        <span <%if comment.level>=2%>class="shine"<%/if%>>★</span>
                        <span <%if comment.level>=3%>class="shine"<%/if%>>★</span>
                        <span <%if comment.level>=4%>class="shine"<%/if%>>★</span>
                        <span <%if comment.level>=5%>class="shine"<%/if%>>★</span>
                    </div>
                </div>
                <div class="remark"><%comment.content%></div>
                <%if comment.images.length>0%>
                <div class="remark img">
                    <%each comment.images as img%>
                    <div class="img"><img data-lazy="<%img%>" /></div>
                    <%/each%>
                </div>
                <%/if%>

                <%if comment.reply_content%>
                <div class="reply-content" style="background:#EDEDED;">
                    掌柜回复：<%comment.reply_content%>
                    <%if comment.reply_images.length>0%>
                    <div class="remark img">
                        <%each comment.reply_images as img%>
                        <div class="img"><img data-lazy="<%img%>" /></div>
                        <%/each%>
                    </div>
                    <%/if%>
                </div>
                <%/if%>
                <%if comment.append_content && comment.replychecked==0%>
                <div class="remark reply-title">用户追加评价</div>
                <div class="remark"><%comment.append_content%></div>
                <%if comment.append_images.length>0%>
                <div class="remark img">
                    <%each comment.append_images as img%>
                    <div class="img"><img data-lazy="<%img%>" /></div>
                    <%/each%>
                </div>
                <%/if%>
                <%if comment.append_reply_content%>
                <div class="reply-content" style="background:#EDEDED;">
                    掌柜回复：<%comment.append_reply_content%>
                    <%if comment.append_reply_images.length>0%>
                    <div class="remark img">
                        <%each comment.append_reply_images as img%>
                        <div class="img"><img data-lazy="<%img%>" /></div>
                        <%/each%>
                    </div>
                    <%/if%>
                </div>
                <%/if%>
                <%/if%>
            </div>
        </div>
        <%/each%>
    </div>
</script>

<script type='text/html' id='tpl_goods_detail_comments'>
    <div class="fui-cell-group fui-comment-group">

        <div class="fui-cell fui-cell-click">
            <div class="fui-cell-text desc">评价(<%count.all%>)</div>
            <div class="fui-cell-text desc label"><span><%percent%>%</span> 好评</div>
            <div class="fui-cell-remark"></div>

        </div>
        <%each list as comment%>
        <div class="fui-cell">

            <div class="fui-cell-text comment ">
                <div class="info">
                    <div class="star">
                        <span <%if comment.level>=1%>class="shine"<%/if%>>★</span>
                        <span <%if comment.level>=2%>class="shine"<%/if%>>★</span>
                        <span <%if comment.level>=3%>class="shine"<%/if%>>★</span>
                        <span <%if comment.level>=4%>class="shine"<%/if%>>★</span>
                        <span <%if comment.level>=5%>class="shine"<%/if%>>★</span>
                    </div>
                    <div class="date"><%comment.nickname%> <%comment.createtime%></div>
                </div>
                <div class="remark"><%comment.content%></div>
                <%if comment.images.length>0%>
                <div class="remark img">
                    <%each comment.images as img%>
                    <div class="img"><img data-lazy="<%img%>" height="50" /></div>
                    <%/each%>
                </div>
                <%/if%>
            </div>
        </div>
        <%/each%>
    </div>
</script>
<?php  } ?>

<?php  } else { ?>

<div class='fui-content'>
    <div class='content-empty'>
        <i class='icon icon-searchlist'></i><br/> 商品已经下架，或者已经删除!<br/><a href="<?php  echo mobileUrl()?>" class='btn btn-default-o external'>到处逛逛</a>
    </div>
</div>
<?php  } ?>


<div id='cover'>
    <div class='fui-mask-m visible'></div>
    <div class='arrow'></div>
    <div class='content'><?php  if(empty($share['goods_detail_text'])) { ?>请点击右上角<br/>通过【发送给朋友】<br/>邀请好友购买<?php  } else { ?><?php  echo $share['goods_detail_text'];?><?php  } ?></div>
</div>

<script language="javascript">

    require(['biz/goods/detail'], function (modal) {
        modal.init({
            goodsid:"<?php  echo $goods['id'];?>",
            goodspcate:"<?php  echo $goods['pcate'];?>",
            getComments : "<?php  echo $getComments;?>",
            seckillinfo: <?php  echo json_encode($seckillinfo)?>,
            attachurl_local:"<?php  echo $GLOBALS['_W']['attachurl_local'];?>",
            attachurl_remote:"<?php  echo $GLOBALS['_W']['attachurl_remote'];?>"
        });
    });</script>
</div>

<div id="alert-picker">
    <script type="text/javascript" src="../addons/ewei_shopv2/static/js/dist/jquery/jquery.qrcode.min.js"></script>
    <script type="text/javascript">
        $(function(){
            $(".alert-qrcode-i").html('')
            $(".alert-qrcode-i").qrcode({
                typeNumber: 0,      //计算模式
                correctLevel: 0,//纠错等级
                text:"<?php  echo $_W['siteroot'].'app/'.mobileUrl('goods/detail', array('id'=>$goods['id'],'mid'=>$mid))?>"/*<?php  echo $_W['siteroot'].'app/'.mobileUrl('goods/detail', array('id'=>$goods['id']))?>*/
            });
        });
    </script>
    <div id="alert-mask"></div>
    <?php  if($commission_data['codeShare'] == 1) { ?>
    <div class="alert-content">
        <div class="alert">
            <i class="alert-close alert-close1 icon icon-close"></i>
            <div class="fui-list alert-header">
                <div class="fui-list-media">
                    <img class="round" src="<?php  echo tomedia($_W['shopset']['shop']['logo'])?>">
                </div>
                <div class="fui-list-inner">
                    <?php  echo $_W['shopset']['shop']['name'];?>
                </div>
            </div>
            <img src="<?php  echo tomedia($goods['thumb'])?>" class="alert-goods-img" alt="">
            <div class="fui-list alert-qrcode">
                <div class="fui-list-media">
                    <i class="alert-qrcode-i"></i>
                </div>
                <div class="fui-list-inner alert-content">
                    <h2 class="alert-title"><?php  echo $goods['title'];?></h2>
                    <span>&yen;<?php  if($goods['minprice']==$goods['maxprice']) { ?><?php  echo $goods['minprice'];?><?php  } else { ?><?php  echo $goods['minprice'];?>~<?php  echo $goods['maxprice'];?><?php  } ?></span>
                    <?php  if($goods['isdiscount'] && $goods['isdiscount_time']>=time()) { ?>
                    <del>&yen;<?php  echo $goods['productprice'];?></del>
                    <?php  } else { ?>
                    <?php  if($goods['productprice']>0) { ?><del>&yen;<?php  echo $goods['productprice'];?></del><?php  } ?>
                    <?php  } ?>
                </div>
            </div>
            <div class="share-text1">截屏保存分享给您的朋友</div>
        </div>
    </div>
    <?php  } else { ?>
    <div class="alert-content">
        <div class="alert2">
            <div class="fui-list alert2-goods">
                <div class="fui-list-media">
                    <img src="<?php  echo tomedia($goods['thumb'])?>" class="alert2-goods-img" alt="">
                </div>
                <div class="fui-list-inner">
                    <h2 class="alert2-title"><?php  echo $goods['title'];?></h2>
                    <span>&yen;<?php  if($goods['minprice']==$goods['maxprice']) { ?><?php  echo $goods['minprice'];?><?php  } else { ?><?php  echo $goods['minprice'];?>~<?php  echo $goods['maxprice'];?><?php  } ?></span>
                    <?php  if($goods['isdiscount'] && $goods['isdiscount_time']>=time()) { ?>
                    <del>&yen;<?php  echo $goods['productprice'];?></del>
                    <?php  } else { ?>
                    <?php  if($goods['productprice']>0) { ?><del>&yen;<?php  echo $goods['productprice'];?></del><?php  } ?>
                    <?php  } ?>
                </div>
            </div>
            <div class="alert2-qrcode">
                <i class="alert-qrcode-i"></i>
            </div>
            <div class="share-text2">截屏保存分享给您的朋友</div>
            <a href="javascript:void(0);" class="alert-close2"><?php  echo $_W['shopset']['shop']['name'];?></a>
        </div>
    </div>
    <?php  } ?>
</div>

<style type="text/css">
    .share-text1{text-align: center;padding:0.5rem 0.5rem 0;font-size:0.6rem;color:#666;line-height: 1rem;}
    .share-text2{text-align: center;padding:0 0.5rem 0.5rem;font-size:0.6rem;color:#666;line-height: 1rem;}
</style>

<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>