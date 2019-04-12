<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>

<style>
    .select22{
        padding:0 0 0 10px;
        border:0;
    }
    .select22 .select2{
        margin:0;
        width:97%;
        height:34px;
        border-radius: 3px;
        border-color: rgb(229, 230, 231);
    }
    .select22 .select2 .select2-choice{
        height: 34px;
        line-height: 32px;
        border-radius: 3px;
        border-color: rgb(229, 230, 231);
    }
    .select22 .select2 .select2-choice .select2-arrow{
        background: #fff;
    }

    .select2-drop li {position: relative}
    .select2-drop li:before {
        content: "";
        height: 0;
        width: 100%;
        border-top:1px solid #eee; position: absolute;
        top:0;
        left:0;
    }
    .select2-drop li:first-child:before {border-top: 0}
    .tabs-container .panel-body{
        border: 0;
        padding: 0;
    }
    .panel {
        border: 0;
        padding: 5px;
    }
    .panel-inline{
        width: 49%;
        display: inline-block;
    }
    .form-group {
        margin-bottom: 0px;
    }
    .input-group .col-sm-6.col-xs-12{
        margin: 0;
        padding: 0;
    }
</style>
<div class="page-heading"> <h2>消息通知人</h2> </div>
<form action="" method="post" class="form-horizontal  form-validate" enctype="multipart/form-data" >

    <div class="form-group">
        <label class="col-sm-2 control-label">消息通知人</label>
        <div class="col-sm-9 col-xs-12">
            <?php if(mcv('sysset.save.notice')) { ?>
            <?php  echo tpl_selector('openids',array('key'=>'openid','text'=>'nickname', 'thumb'=>'avatar','multi'=>1,'placeholder'=>'昵称/姓名/手机号','buttontext'=>'选择通知人', 'items'=>$salers,'url'=>merchUrl('member/query') ))?>
            <span class='help-block'>订单生成后商家通知，可以制定多个人，如果不填写则不通知</span>

            <?php  } else { ?>
            <div class="input-group multi-img-details" id='saler_container'>
                <?php  if(is_array($salers)) { foreach($salers as $saler) { ?>
                <div class="multi-item saler-item" openid='<?php  echo $saler['openid'];?>'>
                <input type="hidden" value="<?php  echo $saler['openid'];?>" name="openids[]">
                <img class="img-responsive img-thumbnail" src='<?php  echo $saler['avatar'];?>' onerror="this.src='./resource/images/nopic.jpg'; this.title='图片未找到.'">
                <div class='img-nickname'><?php  echo $saler['nickname'];?></div>
                <input type="hidden" value="<?php  echo $saler['openid'];?>" name="openids[]">
            </div>
            <?php  } } ?>
        </div>
        <?php  } ?>
    </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">通知方式</label>
        <div class="col-sm-9 col-xs-12">
            <?php if(mcv('sysset.save.notice')) { ?>
            <label class="checkbox-inline">
                <input type="checkbox" value="0" name='data[newtype][]' <?php  if(in_array('0',$newtype)) { ?>checked<?php  } ?> /> 下单通知
            </label>
            <label class="checkbox-inline">
                <input type="checkbox" value="1" name='data[newtype][]' <?php  if(in_array('1',$newtype)) { ?>checked<?php  } ?> /> 付款通知
            </label>
            <label class="checkbox-inline">
                <input type="checkbox" value="2" name='data[newtype][]' <?php  if(in_array('2',$newtype)) { ?>checked<?php  } ?> /> 买家确认收货通知
            </label>
            <div class="help-block">通知商家方式</div>
            <?php  } else { ?>
            <input type="hidden" name="data[newtype]" value="<?php  echo $data['newtype'];?>" />
            <div class='form-control-static'><?php  if(in_array(0,$newtype)) { ?>下单通知;<?php  } ?><?php  if(in_array(1,$newtype)) { ?>付款通知;<?php  } ?><?php  if(in_array(2,$newtype)) { ?>买家收货通知;<?php  } ?></div>
            <?php  } ?>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label"></label>
        <div class="col-sm-9 col-xs-12">
            <?php if(mcv('sysset.notice.edit')) { ?>
            <input type="submit" value="提交" class="btn btn-primary"/>

            <?php  } ?>
        </div>
    </div>
</form>

<script>
    $(".js-switch").click(function () {
        $(this).prev().val( this.checked ?0:1);
        if (this.checked)
        {
            $(this).parents(".panel-body").next(".panel-body").show();
        }
        else
        {
            $(this).parents(".panel-body").next(".panel-body").hide();
        }
    })

    $(function () {
        $(".js-switch").each(function (key,val) {
            if (val.checked)
            {
                $(val).parents(".panel-body").next(".panel-body").show();
            }
            else
            {
                $(val).parents(".panel-body").next(".panel-body").hide();
            }
        })
        $.each($(".selectAll").parents(".tab-pane"),function (key,val) {
            $(val).find(".selectAll").attr("checked","true");
            $(val).find(".selectAll").next().attr("checked","true");
            $(val).find(":checkbox").not(".selectAll").each(function (k,v) {
                if (!v.checked)
                {
                    $(val).find(".selectAll").removeAttr("checked");
                    $(val).find(".selectAll").prev().removeAttr("checked");
                }
            });
        })

    })

    $(".selectAll").click(function () {
        var s = $(this).parents(".tab-pane");
        if (this.checked)
        {
            s.find(":checkbox").not(this).each(function (key,val) {
                if (!val.checked)
                    $(val).next().click();
            });
        }
        else
        {
            s.find(":checkbox").not(this).each(function (key,val) {
                if (val.checked)
                    $(val).next().click();
            });
        }

    })
</script>
 
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>     