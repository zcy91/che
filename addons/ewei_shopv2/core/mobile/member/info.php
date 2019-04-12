<?php
if (!defined('IN_IA')) 
{
	exit('Access Denied');
}
class Info_EweiShopV2Page extends MobileLoginPage 
{
	protected $member;
	public function __construct() 
	{
		global $_W;
		global $_GPC;
		parent::__construct();
		$this->member = m('member')->getInfo($_W['openid']);
	}
	protected function diyformData() 
	{
		$template_flag = 0;
		$diyform_plugin = p('diyform');
		if ($diyform_plugin) 
		{
			$set_config = $diyform_plugin->getSet();
			$user_diyform_open = $set_config['user_diyform_open'];
			if ($user_diyform_open == 1) 
			{
				$template_flag = 1;
				$diyform_id = $set_config['user_diyform'];
				if (!empty($diyform_id)) 
				{
					$formInfo = $diyform_plugin->getDiyformInfo($diyform_id);
					$fields = $formInfo['fields'];
					$diyform_data = iunserializer($this->member['diymemberdata']);
					$f_data = $diyform_plugin->getDiyformData($diyform_data, $fields, $this->member);
				}
			}
		}
		return array('template_flag' => $template_flag, 'set_config' => $set_config, 'diyform_plugin' => $diyform_plugin, 'formInfo' => $formInfo, 'diyform_id' => $diyform_id, 'diyform_data' => $diyform_data, 'fields' => $fields, 'f_data' => $f_data);
	}
	public function main() 
	{
		global $_W;
		global $_GPC;
		$diyform_data = $this->diyformData();
		extract($diyform_data);
		$returnurl = urldecode(trim($_GPC['returnurl']));
		$member = $this->member;
		$wapset = m('common')->getSysset('wap');
		include $this->template();
	}
	public function submit() 
	{
		global $_W;
		global $_GPC;
		$diyform_data = $this->diyformData();
		extract($diyform_data);
		$memberdata = $_GPC['memberdata'];
		$cardtime=$memberdata['birthyear'].'-'.$memberdata['birthmonth'].'-'.$memberdata['birthday'];
		if(!empty($cardtime)){
			$memberdata['cardtime']=strtotime($cardtime);
		}
		if ($template_flag == 1) 
		{
			$data = array();
			$m_data = array();
			$mc_data = array();
			$insert_data = $diyform_plugin->getInsertData($fields, $memberdata);
			$data = $insert_data['data'];
			$m_data = $insert_data['m_data'];
			$mc_data = $insert_data['mc_data'];
			$m_data['diymemberid'] = $diyform_id;
			$m_data['diymemberfields'] = iserializer($fields);
			$m_data['diymemberdata'] = $data;

			$songa = pdo_update('ewei_shop_member', $m_data, array('openid' => $_W['openid'], 'uniacid' => $_W['uniacid']));
			if (!empty($this->member['uid'])) 
			{
				if (!empty($mc_data)) 
				{
					m('member')->mc_update($this->member['uid'], $mc_data);
				}
			}
		}
		else 
		{
			$songb = pdo_update('ewei_shop_member', $memberdata, array('openid' => $_W['openid'], 'uniacid' => $_W['uniacid']));
			if (!empty($this->member['uid'])) 
			{
				$mcdata = $_GPC['mcdata'];
				m('member')->mc_update($this->member['uid'], $mcdata);
			}
		}
		
		/*添加洗车卷*/
		$song = pdo_fetch('SELECT * FROM ' . tablename('ewei_shop_member') . ' where openid=:openid and uniacid=:uniacid', array('openid' => $_W['openid'], 'uniacid' => $_W['uniacid']));
		
		if(!empty($song)){
			//$couponid = intval($_GPC['couponid']); //劵ID
			$backtype = 0;
			$backtype2 = 1;
			$car = pdo_fetch('SELECT * FROM ' . tablename('ewei_shop_car') . ' WHERE backtype=:backtype and backtype2=:backtype2 and uniacid=:uniacid and merchid=0', array('backtype' => $backtype,'backtype2' => $backtype2, ':uniacid' => $_W['uniacid']));
			if (empty($car)) 
			{
				show_json(0, '未找到优惠券!');
			}
			
			$time = time();
			$i = 1;
			
			$log = array('uniacid' => $_W['uniacid'], 'merchid' => $car['merchid'], 'openid' => $song['openid'], 'logno' => m('common')->createNO('coupon_log', 'logno', 'CC'), 'couponid' => $car['id'], 'status' => 1, 'paystatus' => -1, 'creditstatus' => -1, 'createtime' => $time, 'getfrom' => 0);
			
			pdo_insert('ewei_shop_car_log', $log);
			$logid = pdo_insertid();
			$he = $song['card'];
			//$hexiaoma = substr($he,3);
			
			$str='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890';
			$randStr = str_shuffle($str);//打乱字符串
			$hexiaoma = substr($randStr,0,6);//substr(string,start,length);返回字符串的一部分
			
			$data = array('uniacid' => $_W['uniacid'], 'merchid' => $car['merchid'], 'openid' => $song['openid'], 'couponid' => $car['id'], 'gettype' => 0, 'gettime' => $time,'cardtime'=> $song['cardtime'],'hexiaoma'=> $hexiaoma,'chepai'=>$he, 'senduid' => $_W['uid']);
			
			pdo_insert('ewei_shop_car_data', $data);
			++$i;
		}
		
		
		show_json(1);
	}
	
		
	
	
}
?>