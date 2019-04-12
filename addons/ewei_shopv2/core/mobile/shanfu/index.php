<?php
if (!(defined('IN_IA'))) 
{
	exit('Access Denied');
}
class Index_EweiShopV2Page extends MobileLoginPage 
{
	public function main() 
	{
		global $_W;
		global $_GPC;
		$memberurl = "https://jyqc.hejiewl.com/app/index.php?i=1&c=entry&m=ewei_shopv2&do=mobile&r=member&wxref=mp.weixin.qq.com#wechat_redirect";
		$credits = pdo_fetch('select uid,credit2 from ' . tablename('mc_members') . ' where uid=:uid and uniacid=:uniacid', array(':uid' => $_W['fans']['uid'],':uniacid' => $_W['uniacid']));
		
		if($_W['ispost']){
			$money=$_GPC['money'];
			if(empty($_GPC['money'])){
				$this->message('金额不能为空');
			}
			if($credits['credit2'] < $_GPC['money'] ){
				$this->message('余额不足');
			}
			pdo_query('update '.tablename('mc_members').' set credit2=credit2-:money where uid=:uid',array(':uid'=>$_W['fans']['uid'],':money'=>$money));
			pdo_query('update '.tablename('ewei_shop_merch_user').' set xianxiamoney=xianxiamoney+:money where id=:id',array(':id'=>$_GPC['merchid'],':money'=>$money));
			
				$insert_data = array();
				$insert_data['uniacid'] = $_W['uniacid'];
				$insert_data['openid'] = $_GPC['openid'];
				$insert_data['goodsprice'] = $money;
				$insert_data['merchapply'] = 1; //商户申请
				$insert_data['finishtime'] = time();
				$insert_data['merchid'] = $_GPC['merchid'];
				pdo_insert('ewei_shop_order_shanfu', $insert_data);
			
			message('提交成功',$memberurl,'success');
		}
		$credit=pdo_getcolumn('mc_members',array('uid'=>$_W['fans']['uid']),'credit2');
		include $this->template();
	}
	
}
?>