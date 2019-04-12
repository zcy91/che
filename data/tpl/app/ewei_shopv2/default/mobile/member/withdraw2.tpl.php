<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>

<div class='fui-page  fui-page-current'>
    <div class="fui-header">
        <div class="fui-header-left">
            <a class="back"></a>
        </div>
        <div class="title">扫码付款</div>
        <div class="fui-header-right">&nbsp;</div>
    </div>
    <div class='fui-content navbar' >
        <div class='fui-cell-group fui-cell-group-o'>

            <div class='fui-cell-title'>
                <div class='fui-cell-info' style='color:#999'>当前余额: ￥<span id='current'><?php  echo number_format($credit,2)?></span> <a id='btn-all' class='text-primary external' href='#'>全部提现</a></div>
            </div>

			<!--
            <div class='fui-cell-title'>提现金额
                <?php  if(floatval($set['withdrawmoney'])>0) { ?>
                <small>提现额度最小为: <span class='text-danger'>￥<?php  echo number_format($set['withdrawmoney'],2)?></span></small>
                <?php  } ?>
            </div>
			-->
            <div class='fui-cell'>
                <div class='fui-cell-label big' style='width:auto;'>￥</div>
                <div class='fui-cell-info'><input type='number' class='fui-input' id='money' style='font-size:1.2rem;' ></div>
            </div>
			<!--
            <div class="fui-cell">
                <div class="fui-cell-label" style="width: 120px;"><span class="re-g">提现方式</span></div>
                <div class="fui-cell-info">

                    <select id="applytype">
                        <?php  if(is_array($type_array)) { foreach($type_array as $key => $value) { ?>
                        <option value="<?php  echo $key;?>" <?php  if(!empty($value['checked'])) { ?>selected<?php  } ?>><?php  echo $value['title'];?></option>
                        <?php  } } ?>
                    </select>
                </div>
                <div class="fui-cell-remark"></div>
            </div>
			
            <?php  if(!empty($type_array['2']) || !empty($type_array['3'])) { ?>
            <div class="fui-cell ab-group" <?php  if(empty($type_array[2]['checked']) || empty($type_array[3]['checked']) ) { ?>style="display: none;"<?php  } ?>>
                <div class="fui-cell-label" style="width: 120px;">姓名</div>
                <div class="fui-cell-info"><input type="text" id="realname" name="realname" class='fui-input' value="<?php  echo $last_data['realname'];?>" max="25"/></div>
            </div>
            <?php  } ?>

            <?php  if(!empty($type_array['2'])) { ?>
            <div class="fui-cell alipay-group" <?php  if(empty($type_array[2]['checked'])) { ?>style="display: none;"<?php  } ?>>
                <div class="fui-cell-label" style="width: 120px;">支付宝帐号</div>
                <div class="fui-cell-info"><input type="text" id="alipay" name="alipay" class='fui-input' value="<?php  echo $last_data['alipay'];?>" max="25"/></div>
                </div>

                    <div class="fui-cell alipay-group" <?php  if(empty($type_array[2]['checked'])) { ?>style="display: none;"<?php  } ?>>
                    <div class="fui-cell-label" style="width: 120px;">确认帐号</div>
                    <div class="fui-cell-info"><input type="text" id="alipay1" name="alipay1" class='fui-input' value="<?php  echo $last_data['alipay'];?>" max="25"/></div>
                </div>
            <?php  } ?>

            <?php  if(!empty($type_array['3'])) { ?>
                <div class="fui-cell bank-group" <?php  if(empty($type_array[3]['checked'])) { ?>style="display: none;"<?php  } ?>>
                    <div class="fui-cell-label" style="width: 120px;"><span class="re-g">选择银行</span></div>
                    <div class="fui-cell-info">

                        <select id="bankname">
                            <?php  if(is_array($banklist)) { foreach($banklist as $key => $value) { ?>
                            <option value="<?php  echo $bankname;?>" <?php  if(!empty($last_data) && $last_data['bankname'] == $value['bankname']) { ?>selected<?php  } ?>><?php  echo $value['bankname'];?></option>
                            <?php  } } ?>
                        </select>
                    </div>
                    <div class="fui-cell-remark"></div>
                </div>

                <div class="fui-cell bank-group" <?php  if(empty($type_array[3]['checked'])) { ?>style="display: none;"<?php  } ?>>
                <div class="fui-cell-label" style="width: 120px;">银行卡号</div>
                <div class="fui-cell-info"><input type="text" id="bankcard" name="bankcard" class='fui-input' value="<?php  echo $last_data['bankcard'];?>" max="25"/></div>
                </div>

                <div class="fui-cell bank-group" <?php  if(empty($type_array[3]['checked'])) { ?>style="display: none;"<?php  } ?>>
                    <div class="fui-cell-label" style="width: 120px;">确认卡号</div>
                    <div class="fui-cell-info"><input type="text" id="bankcard1" name="bankcard1`" class='fui-input' value="<?php  echo $last_data['bankcard'];?>" max="25"/></div>
                </div>
            <?php  } ?>

            <?php  if(!empty($withdrawcharge)) { ?>
            <div class='fui-cell-title'>提现手续费为 <?php  echo $withdrawcharge;?>%</div>
            <?php  } ?>

            <?php  if(!empty($withdrawend)) { ?>
            <div class='fui-cell-title'>手续费金额在￥<?php  echo $withdrawbegin;?>到￥<?php  echo $withdrawend;?>间免收</div>
            <?php  } ?>

            <div class='fui-cell-title charge-group' style="display: none;">本次提现将扣除手续费 ￥<span class='text-danger' id='deductionmoney'></span>
            </div>

            <div class='fui-cell-title charge-group' style="display: none;">本次提现实际到账金额 ￥<span class='text-danger' id='realmoney'></span>
            </div>
        </div>
		-->
        <a id='btn-next' class='btn btn-success block disabled '>提现</a>

    </div>
    <script language='javascript'>
        require(['biz/member/withdraw'], function (modal) {
            modal.init({
                withdrawcharge:<?php  echo floatval($withdrawcharge)?>,
                withdrawbegin:<?php  echo floatval($withdrawbegin)?>,
                withdrawend:<?php  echo floatval($withdrawend)?>,
                min:<?php  echo floatval($set['withdrawmoney'])?>,
                max:<?php  echo floatval($credit)?>,
            });
        });
    </script>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>