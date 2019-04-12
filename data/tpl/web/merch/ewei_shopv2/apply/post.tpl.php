<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<div class="page-heading">    <span class='pull-right'>        
<input type="button" name="back" onclick='history.back()' value="返回" class="btn btn-default" />    </span>   
 <h2>申请提现    </h2>
 </div>
 <form <?php if( mce('merch.apply.list.post' ,$item) ) { ?>action="" method="post"<?php  } ?> class="form-horizontal form-validate" enctype="multipart/form-data">
 <div class="row">   
 <div class="col-sm-6">        <div style="border: 1px solid #e7eaec" class="ibox float-e-margins">            <div class="ibox-title">              
 <label class="label label-primary  pull-right">抽成比例 <?php  echo $item['payrate'];?>%</label>               
 <h5>可提现金额(抽成后)</h5>            </div>            <div class="ibox-content">               
 <h1 class="no-margins yesterday-count"><span id="bonusmoney_pay"><?php  echo $item['realpricerate'];?></span> 积分</h1>              
 <div class="stat-percent font-bold text-info"></div>              
 <small>抽成前的金额: <?php  echo $item['realprice'];?> 积分</small>            </div>        </div>    </div>   
 <div class="col-sm-6">        <div style="border: 1px solid #e7eaec" class="ibox float-e-margins">          
 <div class="ibox-title">                <h5>订单金额</h5>            </div>        
 <div class="ibox-content">                <h1 class="no-margins today-count"><?php  echo $item['orderprice'];?> 积分</h1>              
 <div class="stat-percent font-bold text-success"></div>                <small>订单个数: <?php  echo $order_num;?> 个</small>            </div>        </div>    </div>   
 <!--<div class="col-sm-4">-->   
 <!--<div style="border: 1px solid #e7eaec" class="ibox float-e-margins">-->  
 <!--<div class="ibox-title">-->  
 <!--<h5>股东已结算</h5>-->  
 <!--</div>-->  
 <!--<div class="ibox-content">-->  
 <!--<h1 class="no-margins seven-count"><span id="partnercount1"><?php  echo $data['partnercount1'];?></span> 个 </h1>-->  
 <!--<div class="stat-percent font-bold text-warning"></div>-->  
 <!--<small>股东数量: <?php  echo $data['partnercount'];?></small>-->  
 <!--</div>-->    <!--</div>-->    <!--</div>-->
 </div><?php  if($item['realprice'] > 0) { ?>
 <div class="form-group">    
 <label class="col-sm-2 control-label">提现方式</label>    
 <div class="col-sm-9 col-xs-12">       
 <select name='applytype' class='form-control' id="applytype" style="width: 220px;">            
 <?php  if(is_array($type_array)) { foreach($type_array as $key => $value) { ?>           
 <option value="<?php  echo $key;?>" <?php  if(!empty($value['checked'])) { ?>selected<?php  } ?>><?php  echo $value['title'];?></option>   
 <?php  } } ?>       
 </select>   
 </div>
 </div>
 <?php  if(!empty($type_array['2']) || !empty($type_array['3'])) { ?>
 <div class="form-group ab-group" <?php  if(empty($type_array[2]['checked']) || empty($type_array[3]['checked']) ) { ?>style="display: none;"<?php  } ?>><label class="col-sm-2 control-label">姓名</label><div class="col-sm-9 col-xs-12">   
 <input type="text"id="realname" name="realname" class="form-control" value="<?php  echo $last_data['applyrealname'];?>" style="width: 220px;"/></div></div>
 <?php  } ?>
 <?php  if(!empty($type_array['2'])) { ?>
 <div class="form-group alipay-group" <?php  if(empty($type_array[2]['checked'])) { ?>style="display: none;"<?php  } ?>>
 <label class="col-sm-2 control-label">支付宝帐号</label><div class="col-sm-9 col-xs-12">   
 <input type="text"id="alipay" name="alipay" class="form-control" value="<?php  echo $last_data['alipay'];?>" style="width: 220px;"/>
 </div>
 </div>
 <div class="form-group alipay-group" <?php  if(empty($type_array[2]['checked'])) { ?>style="display: none;"<?php  } ?>>
 <label class="col-sm-2 control-label">确认帐号</label>
 <div class="col-sm-9 col-xs-12">   
 <input type="text"id="alipay1" name="alipay1" class="form-control" value="<?php  echo $last_data['alipay'];?>" style="width: 220px;"/>
 </div>
 </div>
 <?php  } ?>
 <?php  if(!empty($type_array['3'])) { ?>
 <div class="form-group bank-group" <?php  if(empty($type_array[3]['checked'])) { ?>style="display: none;"<?php  } ?>>
 <label class="col-sm-2 control-label">选择银行</label><div class="col-sm-9 col-xs-12">   
 <select name='bankname' class='form-control' id="bankname" style="width: 220px;">      
 <?php  if(is_array($banklist)) { foreach($banklist as $key => $value) { ?>     
 <option value="<?php  echo $value['bankname'];?>" <?php  if(!empty($last_data) && $last_data['bankname'] == $value['bankname']) { ?>selected<?php  } ?>><?php  echo $value['bankname'];?></option>   
 <?php  } } ?>   
 </select>
 </div>
 </div>
 <div class="form-group bank-group" <?php  if(empty($type_array[3]['checked'])) { ?>style="display: none;"<?php  } ?>>
 <label class="col-sm-2 control-label">银行卡号</label>
 <div class="col-sm-9 col-xs-12">   
 <input type="text"id="bankcard" name="bankcard" class="form-control" value="<?php  echo $last_data['bankcard'];?>" style="width: 220px;"/>
 </div>
 </div>
 <div class="form-group bank-group" <?php  if(empty($type_array[3]['checked'])) { ?>style="display: none;"<?php  } ?>>
 <label class="col-sm-2 control-label">确认卡号</label>
 <div class="col-sm-9 col-xs-12">   
 <input type="text"id="bankcard1" name="bankcard1" class="form-control" value="<?php  echo $last_data['bankcard'];?>" style="width: 220px;"/>
 </div>
 </div>
 <?php  } ?>
 <?php  } ?>
 <?php  if($item['realprice'] > 0) { ?>
 <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('apply/table', TEMPLATE_INCLUDEPATH)) : (include template('apply/table', TEMPLATE_INCLUDEPATH));?><?php  } ?>
 <div class="form-group" style="margin-top:20px;">   
 <div class="col-sm-12" style="text-align: right;">       
 <div class="col-sm-9 col-xs-12">          
 <?php  if($item['realprice'] > 0) { ?>           
 <?php if( mce('merch.apply.list.add' ,$item) ) { ?>           
 <input type="submit" value="提交申请" class="btn btn-primary"  />   
 <?php  } ?>           
 <?php  } ?>          
 <input type="button" name="back" onclick='history.back()' value="返回" class="btn btn-default" />     
 </div>   
 </div>
 </div>
 </form>
 <script >   
 $(function(){        
	 var checked_applytype = $('#applytype').find("option:selected").val();        
		 if (checked_applytype == 2) {            
		 $('.ab-group').show();            
		 $('.alipay-group').show();            
		 $('.bank-group').hide();        
		 } else if (checked_applytype == 3) {            
		 $('.ab-group').show();            
		 $('.alipay-group').hide();            
		 $('.bank-group').show();        
		 } else {            
		 $('.ab-group').hide();            
		 $('.alipay-group').hide();            
		 $('.bank-group').hide();        
		 }        
	 $('#applytype').change(function () {            
		 var applytype = $(this).find("option:selected").val();            
		 if (applytype == 2) {                
		 $('.ab-group').show();                
		 $('.alipay-group').show();                
		 $('.bank-group').hide();            
	 } else if (applytype == 3) {                
		 $('.ab-group').show();                
		 $('.alipay-group').hide();                
		 $('.bank-group').show();            
	 } else {                
		 $('.ab-group').hide();                
		 $('.alipay-group').hide();                
		 $('.bank-group').hide();            
	 }        
	 });        
	 $('form').submit(function(){            
		 var html = '';            
		 var applytype = $('#applytype').find("option:selected").val();            
		 var typename = $('#applytype').find("option:selected").html();            
	 if (applytype == undefined) {                
		$('form').attr('stop',1),tip.msgbox.err('未选择提现方式，请您选择提现方式后重试!!');                
		return false;            
	 }            
	 if (applytype == 0) {                
		html = typename;            
	 } else if (applytype == 2) {                
		 if ($('#realname').isEmpty()) {                   
		 $('form').attr('stop',1),tip.msgbox.err('请填写姓名!');                    
		 return false;                
	 }                
	 if ($('#alipay').isEmpty()) {                   
		 $('form').attr('stop',1),tip.msgbox.err('请填写支付宝帐号!');                    
		 return false;                
	 }                
	 if ($('#alipay1').isEmpty()) {                    
		 $('form').attr('stop',1),tip.msgbox.err('请填写确认帐号!');                    
		 return false;                
	 }                
	 if ($('#alipay').val() != $('#alipay1').val()) {                    
		 $('form').attr('stop',1),tip.msgbox.err('支付宝帐号与确认帐号不一致!');                    
		 return false;                
	 }                
		 realname = $('#realname').val();                
		 alipay = $('#alipay').val();                
		 alipay1 = $('#alipay1').val();                
		 html = typename + "?<br>姓名:" + realname + "<br>支付宝帐号:" + alipay;            
	 } else if (applytype == 3) {                
	 if ($('#realname').isEmpty()) {                    
		 $('form').attr('stop',1),tip.msgbox.err('请填写姓名!');                    
		 return false;                
	 }                
	 if ($('#bankcard').isEmpty()) {                    
		 $('form').attr('stop',1),tip.msgbox.err('请填写银行卡号!');                    
		 return false;                
	 }               
	 if (!$('#bankcard').isNumber()) {                    
		 $('form').attr('stop',1),tip.msgbox.err('银行卡号格式不正确!');                    
		 return false;                
	 }                
	 if ($('#bankcard1').isEmpty()) {                   
		 $('form').attr('stop',1),tip.msgbox.err('请填写确认卡号!');                    
		 return false;                
	 }                
	 if ($('#bankcard').val() != $('#bankcard1').val()) {                    
		 $('form').attr('stop',1),tip.msgbox.err('银行卡号与确认卡号不一致!');                    
		 return false;                
	 }                
		 realname = $('#realname').val();               
		 bankcard = $('#bankcard').val();                
		 bankname = $('#bankname').find("option:selected").html();                
		 html = typename + "?<br>姓名:" + realname + "<br>" + bankname + " 卡号:" + $('#bankcard').val();            
	 }            
	 if (applytype < 2) {                
		var confirm_msg = '确认要' + html + "?";            
	 } else {                
		var confirm_msg = '确认要' + html;            
	 }            
	 $('form').attr('stop',1);            
		 tip.confirm(confirm_msg, function () {               
		 $('form').removeAttr('stop');                
		 $('form').submit();            
	 });        
	 });    
	 })
 </script>
 <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 