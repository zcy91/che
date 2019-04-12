<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('commission/common', TEMPLATE_INCLUDEPATH)) : (include template('commission/common', TEMPLATE_INCLUDEPATH));?><div class="fui-page fui-page-current page-commission-index ">	<div class="fui-header">		<div class="fui-header-left">			<a class="back" onclick='location.back()'></a>		</div>		<div class="title"><?php  echo $this->set['texts']['commission1']?></div>		<div class="fui-header-right"></div>	</div>    <div class="fui-content navbar">	<div class="headinfo">	    <div class='fui-list detail'>		<div class='fui-list-inner'>		    <div class='title'><?php  echo $this->set['texts']['commission_total']?>(<?php  echo $this->set['texts']['yuan']?>)</div>		    <div class='subtitle'><?php  echo number_format($member['commission_total'],2)?></div>		</div>		<div class='fui-list-angle'>		    <a class="btn" href="<?php  echo mobileUrl('commission/log')?>"><?php  echo $this->set['texts']['commission_detail']?></a>		</div>	    </div>	</div>	<div class='fui-cell-group'>	    <div class='fui-cell'>		<div class='fui-cell-icon'><i class='icon icon-money'></i></div>		<div class='fui-cell-label' style='width:auto'><?php  echo $this->set['texts']['commission_ok']?></div>		<div class='fui-cell-info' ></div>		<div class='fui-cell-remark noremark' ><span class="text-danger"><?php  echo number_format($member['commission_ok'],2)?> <?php  echo $this->set['texts']['yuan']?></span></div>	    </div>	</div>		<div class='fui-cell-group'>	    <div class='fui-cell'>		<div class='fui-cell-icon'><i class='icon icon-clock'></i></div>		<div class='fui-cell-label' style='width:auto'><?php  echo $this->set['texts']['commission_apply']?></div>		<div class='fui-cell-info' ></div>		<div class='fui-cell-remark noremark' ><?php  echo number_format($member['commission_apply'],2)?> <?php  echo $this->set['texts']['yuan']?></div>	    </div>	    <div class='fui-cell'>		<div class='fui-cell-icon'><i class='icon icon-rest'></i></div>		<div class='fui-cell-label' style='width:auto'><?php  echo $this->set['texts']['commission_check']?></div>		<div class='fui-cell-info' ></div>		<div class='fui-cell-remark noremark' ><?php  echo number_format($member['commission_check'],2)?> <?php  echo $this->set['texts']['yuan']?></div>	    </div>		<div class='fui-cell'>			<div class='fui-cell-icon'><i class='icon icon-rest'></i></div>			<div class='fui-cell-label' style='width:auto'><?php  echo $this->set['texts']['commission_fail']?></div>			<div class='fui-cell-info' ></div>			<div class='fui-cell-remark noremark' ><?php  echo number_format($member['commission_fail'],2)?> <?php  echo $this->set['texts']['yuan']?></div>		</div>	    <div class='fui-cell'>		<div class='fui-cell-icon'><i class='icon icon-pay'></i></div>		<div class='fui-cell-label' style='width:auto'><?php  echo $this->set['texts']['commission_pay']?></div>		<div class='fui-cell-info' ></div>		<div class='fui-cell-remark noremark' ><?php  echo number_format($member['commission_pay'],2)?> <?php  echo $this->set['texts']['yuan']?></div>	    </div>        <?php  if($member['commission_charge'] > 0) { ?>        <div class='fui-cell'>            <div class='fui-cell-icon'><i class='icon icon-pay'></i></div>            <div class='fui-cell-label' style='width:auto'><?php  echo $this->set['texts']['commission_charge']?></div>            <div class='fui-cell-info' ></div>            <div class='fui-cell-remark noremark' >-<?php  echo number_format($member['commission_charge'],2)?> <?php  echo $this->set['texts']['yuan']?></div>        </div>        <?php  } ?>	</div>	<div class='fui-cell-group'>	    <div class='fui-cell'>		<div class='fui-cell-icon'><i class='icon icon-process'></i></div>		<div class='fui-cell-label' style='width:auto'><?php  echo $this->set['texts']['commission_wait']?></div>		<div class='fui-cell-info' ></div>		<div class='fui-cell-remark noremark' ><?php  echo number_format($member['commission_wait'],2)?> <?php  echo $this->set['texts']['yuan']?></div>	    </div>	    <div class='fui-cell'>		<div class='fui-cell-icon'><i class='icon icon-lock'></i></div>		<div class='fui-cell-label' style='width:auto'><?php  echo $this->set['texts']['commission_lock']?></div>		<div class='fui-cell-info' ></div>		<div class='fui-cell-remark noremark' ><?php  echo number_format($member['commission_lock'],2)?> <?php  echo $this->set['texts']['yuan']?></div>	    </div>	</div>		<div class='fui-according-group'>	    <div class='fui-according expanded'>		<div class='fui-according-header'>		    <div class='text'>用户须知</div>		    <div class='remark'></div>		</div>		<div class='fui-according-content'>		    <div class='content-block'>		    <?php  if($this->set['settledays']>0) { ?>		    买家确认收货（<span class='text-danger'><?php  echo $this->set['settledays']?>天</span> )后，		    <?php  echo $this->set['texts']['commission']?>可<?php  echo $this->set['texts']['withdraw']?>。结算期内，买家退货，		    <?php  echo $this->set['texts']['commission']?>将自动扣除。		    <?php  } else { ?>		    买家确认收货后，立即获得<?php  echo $this->set['texts']['commission1']?>		    <?php  } ?>		    <?php  if($this->set['withdraw']>0) { ?><br/>注意：可用<?php  echo $this->set['texts']['commission']?>满 <span class='text-danger'><?php  echo $this->set['withdraw']?><?php  echo $this->set['texts']['yuan']?></span> 后才能申请<?php  echo $this->set['texts']['withdraw']?><?php  } ?>		    </div>		</div>	    </div>	</div>	  <a <?php  if($cansettle ) { ?>href="<?php  echo mobileUrl('commission/apply')?>"<?php  } ?> class="btn btn-danger block<?php  if(!$cansettle ) { ?> disabled<?php  } ?>">我要提现</a>	</div>    </div>    <?php  echo $this->footerMenus()?>    <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>