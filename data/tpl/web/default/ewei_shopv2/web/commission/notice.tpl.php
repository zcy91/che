<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<style>
    .select2{
        margin:0;
        width:100%;
        height:34px;
        border-radius: 3px;
        border-color: rgb(229, 230, 231);
    }
    .select2 .select2-choice{
        height: 34px;
        line-height: 32px;
        border-radius: 3px;
        border-color: rgb(229, 230, 231);
    }
    .select2 .select2-choice .select2-arrow{
        background: #fff;
    }
    .form-group .radio-inline{
        padding-top: 0px;;
    }
</style>
<div class="page-heading">
    <div class="pull-right" style="text-align: right;margin-top: 10px;" >
        <strong>高级模式</strong>
        <?php if(cv('commission.notice.edit')) { ?>
        	<input class="js-switch small" type="checkbox" <?php  if(!empty($data['tm']['is_advanced'])) { ?>checked<?php  } ?>/>
        <?php  } else { ?>
        	<?php  if(!empty($data['tm']['is_advanced'])) { ?>开启<?php  } else { ?>关闭<?php  } ?>
        <?php  } ?>
    </div>
    <h2>通知设置</h2>

</div>
<form id="setform"  <?php if(cv('commission.notice.edit')) { ?>action="" method="post"<?php  } ?> class="form-horizontal form-validate">
    <input type="hidden" value="<?php  echo intval($data['tm']['is_advanced'])?>" name='data[is_advanced]' />
    <?php if(cv('commission.notice.edit')) { ?>
    <div class='alert alert-success' id="advanced_alert">
        使用高级模式 , 将全部启用自定义的模板内容进行推送 ! <span class="text-danger"><a href="<?php  echo webUrl('sysset/tmessage')?>">模板库(点击进入)</a></span>
    </div>
    <div class='alert alert-info' id="normal_alert">
        默认为全部开启，用户在会员中心可自行设置是否开启, 模板消息自动替换变量
    </div>
    <?php  } ?>
    <div id="normal">
        <div class="form-group">
            <label class="col-sm-2 control-label">任务处理通知</label>
            <div class="col-sm-9 col-xs-12">
                <?php if(cv('commission.notice.edit')) { ?>
                <input type="text" name="data[templateid]" class="form-control" value="<?php  echo $data['tm']['templateid'];?>" />
                <div class="help-block">公众平台模板消息编号: OPENTM200605630 </div>
                <?php  } else { ?>
                <div class='form-control-static'><?php  echo $data['tm']['templateid'];?></div>
                <?php  } ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">成为分销商通知</label>
            <div class="col-sm-9 col-xs-12">

                <?php if(cv('commission.notice.edit')) { ?>
                <input type="text" name="data[commission_becometitle]" class="form-control" value="<?php  echo $data['tm']['commission_becometitle'];?>" />
                <div class="help-block">标题，默认"成为分销商通知"</div>
                <?php  } else { ?>
                <div class='form-control-static'><?php  echo $data['tm']['commission_becometitle'];?></div>
                <?php  } ?>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label"></label>
            <div class="col-sm-9 col-xs-12">
                <?php if(cv('commission.notice.edit')) { ?>
                <textarea  name="data[commission_become]" class="form-control" ><?php  echo $data['tm']['commission_become'];?></textarea>
                模板变量: [昵称] [时间]
                <?php  } else { ?>
                <div class='form-control-static'><?php  echo $data['tm']['commission_become'];?></div>
                <?php  } ?>

            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">新增下级通知</label>
            <div class="col-sm-9 col-xs-12">
                <?php if(cv('commission.notice.edit')) { ?>
                <input type="text" name="data[commission_agent_newtitle]" class="form-control" value="<?php  echo $data['tm']['commission_agent_newtitle'];?>" />
                <div class="help-block">
                    标题，默认"新增下线通知"&nbsp;&nbsp;&nbsp; 默认通知等级 :
                    <label class="radio-inline">
                        <input type="radio" value="0" name="data[commission_agent_new_notice]" <?php  if(empty($data['tm']['commission_agent_new_notice'])) { ?>checked=""<?php  } ?>> <?php echo empty($data['texts']['c1'])?'一级':$data['texts']['c1']?>[默认]
                    </label>
                    <label class="radio-inline">
                        <input type="radio" value="1" name="data[commission_agent_new_notice]" <?php  if(strexists($data['tm']['commission_agent_new_notice'],'1')) { ?>checked=""<?php  } ?>> <?php echo empty($data['texts']['c1'])?'一级':$data['texts']['c1']?>+<?php echo empty($data['texts']['c2'])?'二级':$data['texts']['c2']?>
                    </label>
                    <label class="radio-inline">
                        <input type="radio" value="2" name="data[commission_agent_new_notice]" <?php  if(strexists($data['tm']['commission_agent_new_notice'],'2')) { ?>checked=""<?php  } ?>> <?php echo empty($data['texts']['c1'])?'一级':$data['texts']['c1']?>+<?php echo empty($data['texts']['c2'])?'二级':$data['texts']['c2']?>+<?php echo empty($data['texts']['c3'])?'三级':$data['texts']['c3']?>
                    </label>
                </div>
                <?php  } else { ?>
                <div class='form-control-static'><?php  echo $data['tm']['commission_agent_newtitle'];?></div>
                <?php  } ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label"></label>
            <div class="col-sm-9 col-xs-12">
                <?php if(cv('commission.notice.edit')) { ?>
                <textarea  name="data[commission_agent_new]" class="form-control" ><?php  echo $data['tm']['commission_agent_new'];?></textarea>
                <div class='help-block'>模板变量: [下级昵称] [时间] [下线层级]</div>
                <?php  } else { ?>
                <div class='form-control-static'><?php  echo $data['tm']['commission_agent_new'];?></div>
                <?php  } ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">下级付款通知</label>
            <div class="col-sm-9 col-xs-12">
                <?php if(cv('commission.notice.edit')) { ?>
                <input type="text" name="data[commission_order_paytitle]" class="form-control" value="<?php  echo $data['tm']['commission_order_paytitle'];?>" />
                <div class="help-block">
                    标题，默认"下级付款通知"&nbsp;&nbsp;&nbsp;默认通知等级 :
                    <label class="radio-inline">
                        <input type="radio" value="0" name="data[commission_order_pay_notice]" <?php  if(empty($data['tm']['commission_order_pay_notice'])) { ?>checked=""<?php  } ?>> <?php echo empty($data['texts']['c1'])?'一级':$data['texts']['c1']?>[默认]
                    </label>
                    <label class="radio-inline">
                        <input type="radio" value="1" name="data[commission_order_pay_notice]" <?php  if(strexists($data['tm']['commission_order_pay_notice'],'1')) { ?>checked=""<?php  } ?>> <?php echo empty($data['texts']['c1'])?'一级':$data['texts']['c1']?>+<?php echo empty($data['texts']['c2'])?'二级':$data['texts']['c2']?>
                    </label>
                    <label class="radio-inline">
                        <input type="radio" value="2" name="data[commission_order_pay_notice]" <?php  if(strexists($data['tm']['commission_order_pay_notice'],'2')) { ?>checked=""<?php  } ?>> <?php echo empty($data['texts']['c1'])?'一级':$data['texts']['c1']?>+<?php echo empty($data['texts']['c2'])?'二级':$data['texts']['c2']?>+<?php echo empty($data['texts']['c3'])?'三级':$data['texts']['c3']?>
                    </label>
                </div>
                <?php  } else { ?>
                <div class='form-control-static'><?php  echo $data['tm']['commission_order_paytitle'];?></div>
                <?php  } ?>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label"></label>
            <div class="col-sm-9 col-xs-12">
                <?php if(cv('commission.notice.edit')) { ?>
                <textarea  name="data[commission_order_pay]" class="form-control" ><?php  echo $data['tm']['commission_order_pay'];?></textarea>
                <div class="help-block">模板变量 [下级昵称] [订单编号] [订单金额] [商品详情] [佣金金额] [时间] [下线层级]</div>
                <div class="help-block">注意: 此 [佣金金额] ，不代表上级用户会立即获得，为可能获得的佣金金额</div>
                <?php  } else { ?>
                <div class='form-control-static'><?php  echo $data['tm']['commission_order_pay'];?></div>
                <?php  } ?>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">下级确认收货通知</label>
            <div class="col-sm-9 col-xs-12">
                <?php if(cv('commission.notice.edit')) { ?>
                <input type="text" name="data[commission_order_finishtitle]" class="form-control" value="<?php  echo $data['tm']['commission_order_finishtitle'];?>" />
                <div class="help-block">
                    标题，默认"下级确认收货通知"&nbsp;&nbsp;&nbsp;默认通知等级 :
                    <label class="radio-inline">
                        <input type="radio" value="0" name="data[commission_order_finish_notice]" <?php  if(empty($data['tm']['commission_order_finish_notice'])) { ?>checked=""<?php  } ?>> <?php echo empty($data['texts']['c1'])?'一级':$data['texts']['c1']?>[默认]
                    </label>
                    <label class="radio-inline">
                        <input type="radio" value="1" name="data[commission_order_finish_notice]" <?php  if(strexists($data['tm']['commission_order_finish_notice'],'1')) { ?>checked=""<?php  } ?>><?php echo empty($data['texts']['c1'])?'一级':$data['texts']['c1']?>+<?php echo empty($data['texts']['c2'])?'二级':$data['texts']['c2']?>
                    </label>
                    <label class="radio-inline">
                        <input type="radio" value="2" name="data[commission_order_finish_notice]" <?php  if(strexists($data['tm']['commission_order_finish_notice'],'2')) { ?>checked=""<?php  } ?>><?php echo empty($data['texts']['c1'])?'一级':$data['texts']['c1']?>+<?php echo empty($data['texts']['c2'])?'二级':$data['texts']['c2']?>+<?php echo empty($data['texts']['c3'])?'三级':$data['texts']['c3']?>
                    </label>
                </div>
                <?php  } else { ?>
                <div class='form-control-static'><?php  echo $data['tm']['commission_order_finishtitle'];?></div>
                <?php  } ?>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label"></label>
            <div class="col-sm-9 col-xs-12">
                <?php if(cv('commission.notice.edit')) { ?>
                <textarea  name="data[commission_order_finish]" class="form-control" ><?php  echo $data['tm']['commission_order_finish'];?></textarea>
                <div class="help-block">模板变量 [下级昵称] [订单编号] [订单金额] [商品详情] [佣金金额] [时间] [下线层级]</div>
                <div class="help-block">注意: 此 [佣金金额] ，不代表上级用户会立即获得，为可能获得的佣金金额</div>
                <?php  } else { ?>
                <div class='form-control-static'><?php  echo $data['tm']['commission_order_finish'];?></div>
                <?php  } ?>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">提现申请提交通知</label>
            <div class="col-sm-9 col-xs-12">
                <?php if(cv('commission.notice.edit')) { ?>
                <input type="text" name="data[commission_applytitle]" class="form-control" value="<?php  echo $data['tm']['commission_applytitle'];?>" />
                <div class="help-block">标题，默认"提现申请提交通知"</div>
                <?php  } else { ?>
                <div class='form-control-static'><?php  echo $data['tm']['commission_applytitle'];?></div>
                <?php  } ?>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label"></label>
            <div class="col-sm-9 col-xs-12">
                <?php if(cv('commission.notice.edit')) { ?>
                <textarea  name="data[commission_apply]" class="form-control" ><?php  echo $data['tm']['commission_apply'];?></textarea>
                模板变量 [昵称] [时间] [金额] [提现方式]
                <?php  } else { ?>
                <div class='form-control-static'><?php  echo $data['tm']['commission_apply'];?></div>
                <?php  } ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">提现申请审核完成通知</label>
            <div class="col-sm-9 col-xs-12">
                <?php if(cv('commission.notice.edit')) { ?>
                <input type="text" name="data[commission_checktitle]" class="form-control" value="<?php  echo $data['tm']['commission_checktitle'];?>" />
                <div class="help-block">标题，默认"提现申请审核完成通知"</div>
                <?php  } else { ?>
                <div class='form-control-static'><?php  echo $data['tm']['commission_checktitle'];?></div>
                <?php  } ?>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label"></label>
            <div class="col-sm-9 col-xs-12">
                <?php if(cv('commission.notice.edit')) { ?>
                <textarea  name="data[commission_check]" class="form-control" ><?php  echo $data['tm']['commission_check'];?></textarea>
                模板变量 [昵称] [提现方式]  [金额] [时间]
                <?php  } else { ?>
                <div class='form-control-static'><?php  echo $data['tm']['commission_check'];?></div>
                <?php  } ?>
            </div>
        </div>


        <div class="form-group">
            <label class="col-sm-2 control-label">佣金打款通知</label>
            <div class="col-sm-9 col-xs-12">
                <?php if(cv('commission.notice.edit')) { ?>
                <input type="text" name="data[commission_paytitle]" class="form-control" value="<?php  echo $data['tm']['commission_paytitle'];?>" />
                <div class="help-block">标题，默认"佣金打款通知"</div>
                <?php  } else { ?>
                <div class='form-control-static'><?php  echo $data['tm']['commission_paytitle'];?></div>
                <?php  } ?>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label"></label>
            <div class="col-sm-9 col-xs-12">
                <?php if(cv('commission.notice.edit')) { ?>
                <textarea  name="data[commission_pay]" class="form-control" ><?php  echo $data['tm']['commission_pay'];?></textarea>
                模板变量 [昵称] [提现方式] [金额] [时间]
                <?php  } else { ?>
                <div class='form-control-static'><?php  echo $data['tm']['commission_pay'];?></div>
                <?php  } ?>
            </div>
        </div>


        <div class="form-group">
            <label class="col-sm-2 control-label">分销商等级升级通知</label>
            <div class="col-sm-9 col-xs-12">
                <?php if(cv('commission.notice.edit')) { ?>
                <input type="text" name="data[commission_upgradetitle]" class="form-control" value="<?php  echo $data['tm']['commission_upgradetitle'];?>" />
                <div class="help-block">标题，默认"分销商等级升级通知"</div>
                <?php  } else { ?>
                <div class='form-control-static'><?php  echo $data['tm']['commission_upgradetitle'];?></div>
                <?php  } ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label"></label>
            <div class="col-sm-9 col-xs-12">
                <?php if(cv('commission.notice.edit')) { ?>
                <textarea  name="data[commission_upgrade]" class="form-control" ><?php  echo $data['tm']['commission_upgrade'];?></textarea>
                模板变量: [昵称] [旧等级]  [旧一级分销比例] [旧二级分销比例] [旧三级分销比例] [新等级] [新一级分销比例] [新二级分销比例] [新三级分销比例]  [时间]
                <?php  } else { ?>
                <div class='form-control-static'><?php  echo $data['tm']['commission_upgrade'];?></div>
                <?php  } ?>
            </div>
        </div>
    </div>
    <div id="advanced">
        <div class="form-group">
            <label class="col-sm-2 control-label">成为分销商通知</label>
            <div class="col-sm-9 col-xs-12">
                <select class="select2" <?php if(cv('commission.notice.edit')) { ?>name="data[commission_become_advanced]"<?php  } else { ?>disabled<?php  } ?>>
                    <option value=''>从模板消息库中选择</option>
                    <?php  if(is_array($template_list)) { foreach($template_list as $template_val) { ?>
                    <option value="<?php  echo $template_val['id'];?>" <?php  if($data['tm']['commission_become_advanced'] == $template_val['id'] ) { ?>selected<?php  } ?>><?php  echo $template_val['title'];?></option>
                    <?php  } } ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">新增下级通知</label>
            <div class="col-sm-9 col-xs-12">
                <select class="select2" <?php if(cv('commission.notice.edit')) { ?>name="data[commission_agent_new_advanced]"<?php  } else { ?>disabled<?php  } ?>>
                    <option value=''>从模板消息库中选择</option>
                    <?php  if(is_array($template_list)) { foreach($template_list as $template_val) { ?>
                    <option value="<?php  echo $template_val['id'];?>" <?php  if($data['tm']['commission_agent_new_advanced'] == $template_val['id'] ) { ?>selected<?php  } ?>><?php  echo $template_val['title'];?></option>
                    <?php  } } ?>
                </select>
                <div class="help-block">
                    默认通知等级 :
                    <label class="radio-inline">
                        <input type="radio" value="0" name="data[commission_agent_new_advanced_notice]" <?php  if(empty($data['tm']['commission_agent_new_advanced_notice'])) { ?>checked=""<?php  } ?>> <?php echo empty($data['texts']['c1'])?'一级':$data['texts']['c1']?>[默认]
                    </label>
                    <label class="radio-inline">
                        <input type="radio" value="1" name="data[commission_agent_new_advanced_notice]" <?php  if(strexists($data['tm']['commission_agent_new_advanced_notice'],'1')) { ?>checked=""<?php  } ?>> <?php echo empty($data['texts']['c1'])?'一级':$data['texts']['c1']?>+<?php echo empty($data['texts']['c2'])?'二级':$data['texts']['c2']?>
                    </label>
                    <label class="radio-inline">
                        <input type="radio" value="2" name="data[commission_agent_new_advanced_notice]" <?php  if(strexists($data['tm']['commission_agent_new_advanced_notice'],'2')) { ?>checked=""<?php  } ?>> <?php echo empty($data['texts']['c1'])?'一级':$data['texts']['c1']?>+<?php echo empty($data['texts']['c2'])?'二级':$data['texts']['c2']?>+<?php echo empty($data['texts']['c3'])?'三级':$data['texts']['c3']?>
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group-title">下级通知</div>
        <div class="form-group">
            <label class="col-sm-2 control-label">下级付款通知</label>
            <div class="col-sm-9 col-xs-12">

                <select class="select2" <?php if(cv('commission.notice.edit')) { ?>name="data[commission_order_pay_advanced]"<?php  } else { ?>disabled<?php  } ?>>
                    <option value=''>从模板消息库中选择</option>
                    <?php  if(is_array($template_list)) { foreach($template_list as $template_val) { ?>
                    <option value="<?php  echo $template_val['id'];?>" <?php  if($data['tm']['commission_order_pay_advanced'] == $template_val['id'] ) { ?>selected<?php  } ?>><?php  echo $template_val['title'];?></option>
                    <?php  } } ?>
                </select>
                <div class="help-block">
                    默认通知等级 :
                    <label class="radio-inline">
                        <input type="radio" value="0" name="data[commission_order_pay_advanced_notice]" <?php  if(empty($data['tm']['commission_order_pay_advanced_notice'])) { ?>checked=""<?php  } ?>> <?php echo empty($data['texts']['c1'])?'一级':$data['texts']['c1']?>[默认]
                    </label>
                    <label class="radio-inline">
                        <input type="radio" value="1" name="data[commission_order_pay_advanced_notice]" <?php  if(strexists($data['tm']['commission_order_pay_advanced_notice'],'1')) { ?>checked=""<?php  } ?>> <?php echo empty($data['texts']['c1'])?'一级':$data['texts']['c1']?>+<?php echo empty($data['texts']['c2'])?'二级':$data['texts']['c2']?>
                    </label>
                    <label class="radio-inline">
                        <input type="radio" value="2" name="data[commission_order_pay_advanced_notice]" <?php  if(strexists($data['tm']['commission_order_pay_advanced_notice'],'2')) { ?>checked=""<?php  } ?>> <?php echo empty($data['texts']['c1'])?'一级':$data['texts']['c1']?>+<?php echo empty($data['texts']['c2'])?'二级':$data['texts']['c2']?>+<?php echo empty($data['texts']['c3'])?'三级':$data['texts']['c3']?>
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">下级确认收货通知</label>
            <div class="col-sm-9 col-xs-12">
                <select class="select2" <?php if(cv('commission.notice.edit')) { ?>name="data[commission_order_finish_advanced]"<?php  } else { ?>disabled<?php  } ?>>
                    <option value=''>从模板消息库中选择</option>
                    <?php  if(is_array($template_list)) { foreach($template_list as $template_val) { ?>
                    <option value="<?php  echo $template_val['id'];?>" <?php  if($data['tm']['commission_order_finish_advanced'] == $template_val['id'] ) { ?>selected<?php  } ?>><?php  echo $template_val['title'];?></option>
                    <?php  } } ?>
                </select>
                <div class="help-block">
                    默认通知等级 :
                    <label class="radio-inline">
                        <input type="radio" value="0" name="data[commission_order_finish_advanced_notice]" <?php  if(empty($data['tm']['commission_order_finish_advanced_notice'])) { ?>checked=""<?php  } ?>> <?php echo empty($data['texts']['c1'])?'一级':$data['texts']['c1']?>[默认]
                    </label>
                    <label class="radio-inline">
                        <input type="radio" value="1" name="data[commission_order_finish_advanced_notice]" <?php  if(strexists($data['tm']['commission_order_finish_advanced_notice'],'1')) { ?>checked=""<?php  } ?>><?php echo empty($data['texts']['c1'])?'一级':$data['texts']['c1']?>+<?php echo empty($data['texts']['c2'])?'二级':$data['texts']['c2']?>
                    </label>
                    <label class="radio-inline">
                        <input type="radio" value="2" name="data[commission_order_finish_advanced_notice]" <?php  if(strexists($data['tm']['commission_order_finish_advanced_notice'],'2')) { ?>checked=""<?php  } ?>><?php echo empty($data['texts']['c1'])?'一级':$data['texts']['c1']?>+<?php echo empty($data['texts']['c2'])?'二级':$data['texts']['c2']?>+<?php echo empty($data['texts']['c3'])?'三级':$data['texts']['c3']?>
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group-title">提现通知</div>
        <div class="form-group">
            <label class="col-sm-2 control-label">提现申请提交通知</label>
            <div class="col-sm-9 col-xs-12">
                <select class="select2" <?php if(cv('commission.notice.edit')) { ?>name="data[commission_apply_advanced]"<?php  } else { ?>disabled<?php  } ?>>
                    <option value=''>从模板消息库中选择</option>
                    <?php  if(is_array($template_list)) { foreach($template_list as $template_val) { ?>
                    <option value="<?php  echo $template_val['id'];?>" <?php  if($data['tm']['commission_apply_advanced'] == $template_val['id'] ) { ?>selected<?php  } ?>><?php  echo $template_val['title'];?></option>
                    <?php  } } ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">提现申请审核完成通知</label>
            <div class="col-sm-9 col-xs-12">
                <select class="select2" <?php if(cv('commission.notice.edit')) { ?>name="data[commission_check_advanced]"<?php  } else { ?>disabled<?php  } ?>>
                    <option value=''>从模板消息库中选择</option>
                    <?php  if(is_array($template_list)) { foreach($template_list as $template_val) { ?>
                    <option value="<?php  echo $template_val['id'];?>" <?php  if($data['tm']['commission_check_advanced'] == $template_val['id'] ) { ?>selected<?php  } ?>><?php  echo $template_val['title'];?></option>
                    <?php  } } ?>
                </select>
            </div>
        </div>

        <div class="form-group-title">佣金通知</div>
        <div class="form-group">
            <label class="col-sm-2 control-label">佣金打款通知</label>
            <div class="col-sm-9 col-xs-12">
                <select class="select2" <?php if(cv('commission.notice.edit')) { ?>name="data[commission_pay_advanced]"<?php  } else { ?>disabled<?php  } ?>>
                    <option value=''>从模板消息库中选择</option>
                    <?php  if(is_array($template_list)) { foreach($template_list as $template_val) { ?>
                    <option value="<?php  echo $template_val['id'];?>" <?php  if($data['tm']['commission_pay_advanced'] == $template_val['id'] ) { ?>selected<?php  } ?>><?php  echo $template_val['title'];?></option>
                    <?php  } } ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">分销商等级升级通知</label>
            <div class="col-sm-9 col-xs-12">
                <select class="select2" <?php if(cv('commission.notice.edit')) { ?>name="data[commission_upgrade_advanced]"<?php  } else { ?>disabled<?php  } ?>>
                    <option value=''>从模板消息库中选择</option>
                    <?php  if(is_array($template_list)) { foreach($template_list as $template_val) { ?>
                    <option value="<?php  echo $template_val['id'];?>" <?php  if($data['tm']['commission_upgrade_advanced'] == $template_val['id'] ) { ?>selected<?php  } ?>><?php  echo $template_val['title'];?></option>
                    <?php  } } ?>
                </select>
            </div>
        </div>

    </div>
    <?php if(cv('commission.notice.edit')) { ?>
    <div class="form-group">
        <label class="col-sm-2 control-label"></label>
        <div class="col-sm-9">
            <input type="submit" value="提交" class="btn btn-primary" />
        </div>
    </div>
    <?php  } ?>
</form>
<script>
    $(function () {
        $(".js-switch").click(function () {
            $(":input[name='data[is_advanced]']").val( this.checked ?1:0);
            if (this.checked)
            {
                $("#advanced,#advanced_alert").show();
                $("#normal,#normal_alert").hide();
            }
            else
            {
                $("#advanced,#advanced_alert").hide();
                $("#normal,#normal_alert").show();
            }
        })

        if($(":input[name='data[is_advanced]']").val() == 1)
        {
            $("#advanced,#advanced_alert").show();
            $("#normal,#normal_alert").hide();
        }
        else
        {
            $("#advanced,#advanced_alert").hide();
            $("#normal,#normal_alert").show();
        }
    })
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>