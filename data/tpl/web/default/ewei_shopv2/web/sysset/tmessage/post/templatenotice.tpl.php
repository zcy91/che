<?php defined('IN_IA') or exit('Access Denied');?><style>
    .form-horizontal .form-group{margin-right: -50px;}
    .col-sm-9{padding-right: 0;}
    .tm .btn { margin-bottom:5px;}
</style>


<div class="row">
    <div class="col-sm-8">

        <input type="hidden" name="tp_id" value="<?php  echo $list['id'];?>" />
        <div class="form-group">
            <label class="col-sm-2 control-label must" >模板消息ID</label>
            <div class="col-sm-9 col-xs-12">
                <?php if( ce('tmessage' ,$list) ) { ?>
                <input type="text"  id="tp_template_id" name="tp_template_id" class="form-control" value="<?php  echo $list['template_id'];?>" placeholder="模版消息ID，例：P8MxRKmW7wdejmZl14-swiGmsJVrFJiWYM7zKSPXq4I" data-rule-required='true' />
                <?php  } else { ?>
                <div class='form-control-static'><?php  echo $list['template_id'];?></div>
                <?php  } ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label must" >头部标题</label>

            <?php if( ce('tmessage' ,$list) ) { ?>
            <div class="col-sm-9 title" style='padding-right:0' >

                <textarea name="tp_first" class="form-control" value="" data-rule-required='true' placeholder="{{first.DATA}}"><?php  echo $list['first'];?></textarea>
                <span class='help-block'>对填充模板 {{first.DATA}} 的值 </span>
            </div>
            <div class="col-sm-1" style='padding-left:0;' >

                <input type="color" name="firstcolor" value="<?php  echo $list['firstcolor'];?>" style="width:32px;height:32px;" />

            </div>
            <?php  } else { ?>
            <div class="col-sm-3">
                <div class='form-control-static'><?php  echo $list['first'];?> 颜色: <?php  echo $list['firstcolor'];?></div>
            </div>
            <?php  } ?>

        </div>

        <?php  if(is_array($data)) { foreach($data as $list2) { ?>
        <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('sysset/tmessage/tpl', TEMPLATE_INCLUDEPATH)) : (include template('sysset/tmessage/tpl', TEMPLATE_INCLUDEPATH));?>
        <?php  } } ?>
        <?php if( ce('tmessage' ,$list) ) { ?>
        <div id="type-items"></div>
        <div class="form-group">
            <label class="col-sm-2 control-label" ></label>
            <div class="col-sm-9 col-xs-12">
                <a class="btn btn-default btn-add-type" href="javascript:;" onclick="addType();"><i class="fa fa-plus" title=""></i> 增加一条键</a>
                        <span class='help-block'>

                        </span>
            </div>
        </div>
        <?php  } ?>

        <div class="form-group">
            <label class="col-sm-2 control-label" >尾部描述</label>
            <?php if( ce('tmessage' ,$list) ) { ?>
            <div class="col-sm-9 title" style='padding-right:0' >
                <textarea name="tp_remark" class="form-control" placeholder="{{remark.DATA}}" ><?php  echo $list['remark'];?></textarea>
                <span class='help-block'>填充模板 {{remark.DATA}} 的值</span>
            </div>
            <div class="col-sm-1" style='padding-left:0' >

                <input type="color" name="remarkcolor" value="<?php  echo $list['remarkcolor'];?>" style="width:32px;height:32px;" />

            </div>

            <?php  } else { ?>
            <div class="col-sm-3">
                <div class='form-control-static'><?php  echo $list['remark'];?> 颜色: <?php  echo $list['remarkcolor'];?></div>
            </div>
            <?php  } ?>

        </div>
    </div>
    <div class="col-sm-4">
        <div class="col-sm-4"  style="width:310px;margin-left:20px;">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <span style="font-size: 15px">第一步：</span>添加我的模板
                </div>
                <div class="panel-body">
                    <input type="text" id="tempcode" class="form-control" placeholder="模板编号,例:TM00015" style="margin-bottom: 5px;"  value="" />
                    <a class="btn btn-default" href="javascript:;" onclick="addtempoption();"> 添加快速模板</a>
                </div>
            </div>
        </div>

        <div class="col-sm-4"  style="width:310px;margin-left:20px;">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <span style="font-size: 15px">第二步：</span>选择模板
                </div>
                <div class="panel-body">
                    <select id="selecttemplate"  class=" form-control" style="margin-bottom: 5px;">
                    </select>
                    <a class="btn btn-default" href="javascript:;"  onclick="selecttemp();"> 选择模板</a>
                    <a class="btn btn-default" href="javascript:;"  onclick="deltempoption();"> 删除模板</a>
                </div>
            </div>
        </div>

        <div class="col-sm-4  shilidiv"  style="width:310px;margin-left:20px; display: none;">
            <div class="panel panel-default">
                <div class="panel-heading">
                    模板展示:
                </div>
                <div class="panel-body">
                    <div id="shili" class="text">
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-4"  style="width:310px;margin-left:20px;">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <select class="form-control" onclick="$('.tm').hide();$('.tm-' + $(this).val()).show()">
                        <option value="">选择模板变量类型</option>
                        <option value="order">订单类</option>
                        <option value="upgrade">升级类</option>
                        <option value="rw">充值提现类</option>
                        <?php  if(cv('commission')) { ?>
                            <option value="commission">分销类</option>
                        <?php  } ?>
                    </select>
                </div>
                <div class="panel-body tm tm-upgrade" style="display:none">
                    <a href='JavaScript:' class="btn btn-default  btn-sm ">商城名称</a>
                    <a href='JavaScript:' class="btn btn-default btn-sm">粉丝昵称</a>
                    <a href='JavaScript:' class="btn btn-default btn-sm">旧等级</a>
                    <a href='JavaScript:' class="btn btn-default btn-sm">新等级</a>
                </div>
                <div class="panel-heading tm tm-rw" style="display:none">充值</div>

                <div class="panel-body tm tm-rw" style="display:none">
                    <a href='JavaScript:' class="btn btn-default  btn-sm">支付方式</a>
                    <a href='JavaScript:' class="btn btn-default btn-sm">充值金额</a>
                    <a href='JavaScript:' class="btn btn-default btn-sm">充值时间</a>
                    <a href='JavaScript:' class="btn btn-default btn-sm">赠送金额</a>
                    <a href='JavaScript:' class="btn btn-default btn-sm">实际到账</a>
                </div>

                <div class="panel-heading tm tm-rw" style="display:none">充值退款</div>
                <div class="panel-body tm tm-rw" style="display:none">
                    <a href='JavaScript:' class="btn btn-default  btn-sm">支付方式</a>
                    <a href='JavaScript:' class="btn btn-default btn-sm">充值金额</a>
                    <a href='JavaScript:' class="btn btn-default btn-sm">充值时间</a>
                    <a href='JavaScript:' class="btn btn-default btn-sm">赠送金额</a>
                    <a href='JavaScript:' class="btn btn-default btn-sm">实际到账</a>
                    <a href='JavaScript:' class="btn btn-default btn-sm">退款金额</a>
                </div>

                <div class="panel-heading tm tm-rw" style="display:none">提现</div>
                <div class="panel-body tm tm-rw" style="display:none">
                    <a href='JavaScript:' class="btn btn-default  btn-sm">提现金额</a>
                    <a href='JavaScript:' class="btn btn-default btn-sm">提现时间</a>
                </div>
                <div class="panel-heading tm tm-order" style="display:none">
                    订单信息
                </div>
                <div class="panel-body tm tm-order" style="display:none">
                    <a href='JavaScript:' class="btn btn-default  btn-sm">商城名称</a>
                    <a href='JavaScript:' class="btn btn-default btn-sm">粉丝昵称</a>
                    <a href='JavaScript:' class="btn btn-default btn-sm">订单号</a>
                    <a href='JavaScript:' class="btn btn-default btn-sm">订单金额</a>
                    <a href='JavaScript:' class="btn btn-default btn-sm">运费</a>
                    <a href='JavaScript:' class="btn btn-default btn-sm">商品详情</a>
                    <a href='JavaScript:' class="btn btn-default btn-sm">单品详情</a>(单品商家下单通知变量)
                    <a href='JavaScript:' class="btn btn-default btn-sm">快递公司</a>
                    <a href='JavaScript:' class="btn btn-default btn-sm">快递单号</a>
                    <a href='JavaScript:' class="btn btn-default btn-sm">购买者姓名</a>
                    <a href='JavaScript:' class="btn btn-default btn-sm">购买者电话</a>
                    <a href='JavaScript:' class="btn btn-default btn-sm">收货地址</a>
                    <a href='JavaScript:' class="btn btn-default btn-sm">下单时间</a>
                    <a href='JavaScript:' class="btn btn-default btn-sm">支付时间</a>
                    <a href='JavaScript:' class="btn btn-default btn-sm">发货时间</a>
                    <a href='JavaScript:' class="btn btn-default btn-sm">收货时间</a>
                    <a href='JavaScript:' class="btn btn-default btn-sm">门店</a>
                    <a href='JavaScript:' class="btn btn-default btn-sm">门店地址</a>
                    <a href='JavaScript:' class="btn btn-default btn-sm">门店联系人</a>
                    <a href='JavaScript:' class="btn btn-default btn-sm">门店营业时间</a>
                    <a href='JavaScript:' class="btn btn-default btn-sm">虚拟物品自动发货内容</a>
                    <a href='JavaScript:' class="btn btn-default btn-sm">虚拟卡密自动发货内容</a>
                    <a href='JavaScript:' class="btn btn-default btn-sm">自提码</a>

                </div>
                <div class="panel-heading tm tm-order" style="display:none">
                    售后相关
                </div>
                <div class="panel-body tm tm-order" style="display:none">
                    <a href='JavaScript:' class="btn btn-default btn-sm">售后类型</a>
                    <a href='JavaScript:' class="btn btn-default btn-sm">申请金额</a>
                    <a href='JavaScript:' class="btn btn-default btn-sm">退款金额</a>

                    <a href='JavaScript:' class="btn btn-default btn-sm">退货地址</a>
                    <a href='JavaScript:' class="btn btn-default btn-sm">换货快递公司</a>
                    <a href='JavaScript:' class="btn btn-default btn-sm">换货快递单号</a>

                </div>
                <div class="panel-heading tm tm-order" style="display:none">
                    订单状态更新
                </div>
                <div class="panel-body tm tm-order" style="display:none">
                    <a href='JavaScript:' class="btn btn-default btn-sm">粉丝昵称</a>
                    <a href='JavaScript:' class="btn btn-default btn-sm">订单编号</a>
                    <a href='JavaScript:' class="btn btn-default btn-sm">原收货地址</a>
                    <a href='JavaScript:' class="btn btn-default btn-sm">新收货地址</a>
                    <a href='JavaScript:' class="btn btn-default btn-sm">订单原价格</a>
                    <a href='JavaScript:' class="btn btn-default btn-sm">订单新价格</a>
                    <a href='JavaScript:' class="btn btn-default btn-sm">修改时间</a>
                </div>

                <div class="panel-heading tm tm-commission" style="display:none">成为下级或分销商</div>
                <div class="panel-body tm tm-commission" style="display:none">
                    <a href='JavaScript:' class="btn btn-default btn-sm">昵称</a>
                    <a href='JavaScript:' class="btn btn-default btn-sm">时间</a>
                </div>
                <div class="panel-heading tm tm-commission" style="display:none">新增下线通知</div>
                <div class="panel-body tm tm-commission" style="display:none">
                    <a href='JavaScript:' class="btn btn-default btn-sm">下线层级</a>
                    <a href='JavaScript:' class="btn btn-default btn-sm">下级昵称</a>
                    <a href='JavaScript:' class="btn btn-default btn-sm">时间</a>
                </div>
                <div class="panel-heading tm tm-commission" style="display:none">下级付款类</div>
                <div class="panel-body tm tm-commission" style="display:none">
                    <a href='JavaScript:' class="btn btn-default btn-sm">下级昵称</a>
                    <a href='JavaScript:' class="btn btn-default btn-sm">订单编号</a>
                    <a href='JavaScript:' class="btn btn-default btn-sm">订单金额</a>
                    <a href='JavaScript:' class="btn btn-default btn-sm">商品详情</a>
                    <a href='JavaScript:' class="btn btn-default btn-sm">佣金金额</a>
                    <a href='JavaScript:' class="btn btn-default btn-sm">时间</a>
                    <a href='JavaScript:' class="btn btn-default btn-sm">下线层级</a>
                </div>
                <div class="panel-heading tm tm-commission" style="display:none">提现申请和佣金打款类</div>
                <div class="panel-body tm tm-commission" style="display:none">
                    <a href='JavaScript:' class="btn btn-default btn-sm">昵称</a>
                    <a href='JavaScript:' class="btn btn-default btn-sm">时间</a>
                    <a href='JavaScript:' class="btn btn-default btn-sm">金额</a>
                    <a href='JavaScript:' class="btn btn-default btn-sm">提现方式</a>
                </div>
                <div class="panel-heading tm tm-commission" style="display:none">分销商等级升级通知</div>
                <div class="panel-body tm tm-commission" style="display:none">
                    <a href='JavaScript:' class="btn btn-default btn-sm">昵称</a>
                    <a href='JavaScript:' class="btn btn-default btn-sm">时间</a>
                    <a href='JavaScript:' class="btn btn-default btn-sm">旧等级</a>
                    <a href='JavaScript:' class="btn btn-default btn-sm">旧一级分销比例</a>
                    <a href='JavaScript:' class="btn btn-default btn-sm">旧二级分销比例</a>
                    <a href='JavaScript:' class="btn btn-default btn-sm">旧三级分销比例</a>
                    <a href='JavaScript:' class="btn btn-default btn-sm">新等级</a>
                    <a href='JavaScript:' class="btn btn-default btn-sm">新一级分销比例</a>
                    <a href='JavaScript:' class="btn btn-default btn-sm">新二级分销比例</a>
                    <a href='JavaScript:' class="btn btn-default btn-sm">新三级分销比例</a>
                </div>

                <div class="panel-body">
                    点击变量后会自动插入选择的文本框的焦点位置，在发送给粉丝时系统会自动替换对应变量值
                    <div class="text text-danger">
                        注意：以上模板消息变量只适用于系统类通知，会员群发工具不适用
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script language='javascript'>

    var kw = 1;
    var temps;
    var contents;
    restempoption();

    function selecttemp()
    {
        var tid = $("#selecttemplate").val();
        var temp;

        for(var i=0;i<temps.length;i++){
            if(temps[i].template_id==tid)
            {
                temp =temps[i];
                break;
            }
        }

        if(temp==null)
        {
            return;
        }else
        {
            contents = temp.contents;

            if(contents[0]!='first'||contents[contents.length-1]!='remark')
            {
                alert("此模板不可用!");
                return;
            }
            $("#shili").html(temp.content);

            $(".shilidiv").show();

            $("#tp_title").val(temp.title);
            $("#tp_template_id").val(temp.template_id);

            $('.key_item').remove();

            setcontents(0);
        }
    }


    function setcontents(i){

        if(contents.length==i)
        {
            return;
        }
        if(contents[i]!='first'&&contents[i]!='remark')
        {
            var data = {
                tpkw: contents[i]
            };
            $.ajax({
                url: "<?php  echo webUrl('sysset/tmessage/tpl')?>",
                cache: false,
                data:data
            }).done(function (html) {
                $(".btn-add-type").button("reset");
                $("#type-items").append(html);
                i++
                setcontents(i);
            });
        }else
        {
            i++
            setcontents(i);
        }
    }



    function addtempoption() {
        var tempcode = $("#tempcode").val();
        var data = {
            templateidshort: tempcode
        };
        $.ajax({
            url: "<?php  echo webUrl('sysset/tmessage/gettemplateid')?>",
            data: data,
            cache: false
        }).done(function (result) {

            var  data= jQuery.parseJSON(result);

            if(data.status==1) {
                alert("加入成功");
                restempoption();
            }else
            {
                alert("失败");
                alert(data.result.message);
            }

        });
    }


    function deltempoption() {
        var tid = $("#selecttemplate").val();
        var data = {
            template_id: tid
        };
        $.ajax({
            url: "<?php  echo webUrl('sysset/tmessage/deltemplatebyid')?>",
            data: data,
            cache: false
        }).done(function (result) {

            var  data= jQuery.parseJSON(result);

            if(data.status==1) {
                alert("删除成功");
                restempoption();
            }else
            {
                alert("失败");
                alert(data.result.message);
            }

        });
    }

    function restempoption() {
        $.ajax({
            url: "<?php  echo webUrl('sysset/tmessage/gettemplatelist')?>",
            cache: false
        }).done(function (result) {

            var  data= jQuery.parseJSON(result);

            if(data.status==1)
            {
                $("#selecttemplate option").remove();

                temps =data.result.template_list;
                for(var i=0;i<temps.length;i++){

                    $("#selecttemplate").append("<option value='"+temps[i].template_id+"'>"+temps[i].title+"</option>");
                }
            }
        });
    }

    function addType() {
        $(".btn-add-type").button("loading");
        $.ajax({
            url: "<?php  echo webUrl('sysset/tmessage/tpl')?>&kw="+kw,
            cache: false
        }).done(function (html) {
            $(".btn-add-type").button("reset");
            $("#type-items").append(html);
        });
        kw++;
    }



</script>