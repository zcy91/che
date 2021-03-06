<?php
if (!(defined('IN_IA'))) 
{
	exit('Access Denied');
}
class Pay_EweiShopV2Page extends MobileLoginPage 
{
	public function main() 
	{
		global $_W;
		global $_GPC;
		$openid = $_W['openid'];
		$uniacid = $_W['uniacid'];
		$member = m('member')->getMember($openid, true);
		$orderid = intval($_GPC['id']);
		$og_array = m('order')->checkOrderGoods($orderid);
		if (!(empty($og_array['flag']))) 
		{
			$this->message($og_array['msg'], '', 'error');
		}
		if (empty($orderid)) 
		{
			header('location: ' . mobileUrl('order'));
			exit();
		}
		$order = pdo_fetch('select * from ' . tablename('ewei_shop_order') . ' where id=:id and uniacid=:uniacid and openid=:openid limit 1', array(':id' => $orderid, ':uniacid' => $uniacid, ':openid' => $openid));
		if (empty($order)) 
		{
			header('location: ' . mobileUrl('order'));
			exit();
		}
		if ($order['status'] == -1) 
		{
			header('location: ' . mobileUrl('order/detail', array('id' => $order['id'])));
			exit();
		}
		else if (1 <= $order['status']) 
		{
			header('location: ' . mobileUrl('order/detail', array('id' => $order['id'])));
			exit();
		}
		$log = pdo_fetch('SELECT * FROM ' . tablename('core_paylog') . ' WHERE `uniacid`=:uniacid AND `module`=:module AND `tid`=:tid limit 1', array(':uniacid' => $uniacid, ':module' => 'ewei_shopv2', ':tid' => $order['ordersn']));
		if (!(empty($log)) && ($log['status'] != '0')) 
		{
			header('location: ' . mobileUrl('order/detail', array('id' => $order['id'])));
			exit();
		}
		$seckill_goods = pdo_fetchall('select goodsid,optionid,seckill from  ' . tablename('ewei_shop_order_goods') . ' where orderid=:orderid and uniacid=:uniacid and seckill=1 ', array(':uniacid' => $_W['uniacid'], ':orderid' => $orderid));
		if (!(empty($log)) && ($log['status'] == '0')) 
		{
			pdo_delete('core_paylog', array('plid' => $log['plid']));
			$log = NULL;
		}
		if (empty($log)) 
		{
			$log = array('uniacid' => $uniacid, 'openid' => $member['uid'], 'module' => 'ewei_shopv2', 'tid' => $order['ordersn'], 'fee' => $order['price'], 'status' => 0);
			pdo_insert('core_paylog', $log);
			$plid = pdo_insertid();
		}
		$set = m('common')->getSysset(array('shop', 'pay'));
		$set['pay']['weixin'] = ((!(empty($set['pay']['weixin_sub'])) ? 1 : $set['pay']['weixin']));
		$set['pay']['weixin_jie'] = ((!(empty($set['pay']['weixin_jie_sub'])) ? 1 : $set['pay']['weixin_jie']));
		$param_title = $set['shop']['name'] . '订单';
		$credit = array('success' => false);
		if (isset($set['pay']) && ($set['pay']['credit'] == 1)) 
		{
			$credit = array('success' => true, 'current' => $member['credit2']);
		}
		load()->model('payment');
		$setting = uni_setting($_W['uniacid'], array('payment'));
		$sec = m('common')->getSec();
		$sec = iunserializer($sec['sec']);
		$wechat = array('success' => false);
		$jie = intval($_GPC['jie']);
		if (is_weixin()) 
		{
			$params = array();
			$params['tid'] = $log['tid'];
			if (!(empty($order['ordersn2']))) 
			{
				$var = sprintf('%02d', $order['ordersn2']);
				$params['tid'] .= 'GJ' . $var;
			}
			$params['user'] = $openid;
			$params['fee'] = $order['price'];
			$params['title'] = $param_title;
			if (isset($set['pay']) && ($set['pay']['weixin'] == 1) && ($jie !== 1)) 
			{
				$options = array();
				if (is_array($setting['payment']['wechat']) && $setting['payment']['wechat']['switch']) 
				{
					load()->model('payment');
					$setting = uni_setting($_W['uniacid'], array('payment'));
					if (is_array($setting['payment'])) 
					{
						$options = $setting['payment']['wechat'];
						$options['appid'] = $_W['account']['key'];
						$options['secret'] = $_W['account']['secret'];
					}
				}
				$wechat = m('common')->wechat_build($params, $options, 0);
				if (!(is_error($wechat))) 
				{
					$wechat['success'] = true;
					$wechat['weixin'] = true;
				}
			}
			if ((isset($set['pay']) && ($set['pay']['weixin_jie'] == 1) && !($wechat['success'])) || ($jie === 1)) 
			{
				if (!(empty($order['ordersn2']))) 
				{
					$params['tid'] = $params['tid'] . '_B';
				}
				else 
				{
					$params['tid'] = $params['tid'] . '_borrow';
				}
				$options = array();
				$options['appid'] = $sec['appid'];
				$options['mchid'] = $sec['mchid'];
				$options['apikey'] = $sec['apikey'];
				if (!(empty($set['pay']['weixin_jie_sub'])) && !(empty($sec['sub_secret_jie_sub']))) 
				{
					$wxuser = m('member')->wxuser($sec['sub_appid_jie_sub'], $sec['sub_secret_jie_sub']);
					$params['openid'] = $wxuser['openid'];
				}
				else if (!(empty($sec['secret']))) 
				{
					$wxuser = m('member')->wxuser($sec['appid'], $sec['secret']);
					$params['openid'] = $wxuser['openid'];
				}
				$wechat = m('common')->wechat_native_build($params, $options, 0);
				if (!(is_error($wechat))) 
				{
					$wechat['success'] = true;
					if (!(empty($params['openid']))) 
					{
						$wechat['weixin'] = true;
					}
					else 
					{
						$wechat['weixin_jie'] = true;
					}
				}
			}
			$wechat['jie'] = $jie;
		}
		$alipay = array('success' => false);
		if (empty($seckill_goods)) 
		{
			if (isset($set['pay']) && ($set['pay']['alipay'] == 1)) 
			{
				if (is_array($setting['payment']['alipay']) && $setting['payment']['alipay']['switch']) 
				{
					$params = array();
					$params['tid'] = $log['tid'];
					$params['user'] = $_W['openid'];
					$params['fee'] = $order['price'];
					$params['title'] = $param_title;
					load()->func('communication');
					load()->model('payment');
					$setting = uni_setting($_W['uniacid'], array('payment'));
					if (is_array($setting['payment'])) 
					{
						$options = $setting['payment']['alipay'];
						$alipay = m('common')->alipay_build($params, $options, 0, $_W['openid']);
						if (!(empty($alipay['url']))) 
						{
							$alipay['url'] = urlencode($alipay['url']);
							$alipay['success'] = true;
						}
					}
				}
			}
			$cash = array('success' => ($order['cash'] == 1) && isset($set['pay']) && ($set['pay']['cash'] == 1) && ($order['isverify'] == 0) && ($order['isvirtual'] == 0));
		}
		else 
		{
			$cash = array('success' => false);
		}
		$payinfo = array('orderid' => $orderid, 'credit' => $credit, 'alipay' => $alipay, 'wechat' => $wechat, 'cash' => $cash, 'money' => $order['price']);
		if (is_h5app()) 
		{
			$payinfo = array('wechat' => (!(empty($sec['app_wechat']['merchname'])) && !(empty($set['pay']['app_wechat'])) && !(empty($sec['app_wechat']['appid'])) && !(empty($sec['app_wechat']['appsecret'])) && !(empty($sec['app_wechat']['merchid'])) && !(empty($sec['app_wechat']['apikey'])) && (0 < $order['price']) ? true : false), 'alipay' => (!(empty($set['pay']['app_alipay'])) && !(empty($sec['app_alipay']['public_key'])) ? true : false), 'mcname' => $sec['app_wechat']['merchname'], 'aliname' => (empty($_W['shopset']['shop']['name']) ? $sec['app_wechat']['merchname'] : $_W['shopset']['shop']['name']), 'ordersn' => $log['tid'], 'money' => $order['price'], 'attach' => $_W['uniacid'] . ':0', 'type' => 0, 'orderid' => $orderid, 'credit' => $credit, 'cash' => $cash);
		}
		if (p('seckill')) 
		{
			foreach ($seckill_goods as $data ) 
			{
				plugin_run('seckill::getSeckill', $data['goodsid'], $data['optionid'], true, $_W['openid']);
			}
		}
		include $this->template();
	}
	public function orderstatus() 
	{
		global $_W;
		global $_GPC;
		$uniacid = $_W['uniacid'];
		$orderid = intval($_GPC['id']);
		$order = pdo_fetch('select status from ' . tablename('ewei_shop_order') . ' where id=:id and uniacid=:uniacid limit 1', array(':id' => $orderid, ':uniacid' => $uniacid));
		if (1 <= $order['status']) 
		{
			@session_start();
			$_SESSION[EWEI_SHOPV2_PREFIX . '_order_pay_complete'] = 1;
			show_json(1);
		}
		show_json(0);
	}
	public function complete() 
	{
		global $_W;
		global $_GPC;
		$orderid = intval($_GPC['id']);
		$uniacid = $_W['uniacid'];
		$openid = $_W['openid'];
		if (is_h5app() && empty($orderid)) 
		{
			$ordersn = $_GPC['ordersn'];
			$orderid = pdo_fetchcolumn('select id from ' . tablename('ewei_shop_order') . ' where ordersn=:ordersn and uniacid=:uniacid and openid=:openid limit 1', array(':ordersn' => $ordersn, ':uniacid' => $uniacid, ':openid' => $openid));
		}
		if (empty($orderid)) 
		{
			if ($_W['ispost']) 
			{
				show_json(0, '参数错误');
			}
			else 
			{
				$this->message('参数错误', mobileUrl('order'));
			}
		}
		$set = m('common')->getSysset(array('shop', 'pay'));
		$set['pay']['weixin'] = ((!(empty($set['pay']['weixin_sub'])) ? 1 : $set['pay']['weixin']));
		$set['pay']['weixin_jie'] = ((!(empty($set['pay']['weixin_jie_sub'])) ? 1 : $set['pay']['weixin_jie']));
		$member = m('member')->getMember($openid, true);
        //@lk2017.9.12
        $gg=$member['isfx'];

		$order = pdo_fetch('select * from ' . tablename('ewei_shop_order') . ' where id=:id and uniacid=:uniacid and openid=:openid limit 1', array(':id' => $orderid, ':uniacid' => $uniacid, ':openid' => $openid));
		if (0 < $order['ispackage']) 
		{
			$package = pdo_fetch('SELECT * FROM ' . tablename('ewei_shop_package') . ' WHERE uniacid = ' . $uniacid . ' and id = ' . $order['packageid'] . ' ');
			if (empty($package)) 
			{
				show_json(0, '未找到套餐！');
			}
			if (time() < $package['starttime']) 
			{
				show_json(0, '套餐活动未开始，请耐心等待！');
			}
			if ($package['endtime'] < time()) 
			{
				show_json(0, '套餐活动已结束，谢谢您的关注，请您浏览其他套餐或商品！');
			}
		}
		if (empty($order)) 
		{
			if ($_W['ispost']) 
			{
				show_json(0, '订单未找到');
			}
			else 
			{
				$this->message('订单未找到', mobileUrl('order'));
			}
		}
		$type = $_GPC['type'];
		if (!(in_array($type, array('wechat', 'alipay', 'credit', 'cash')))) 
		{
			if ($_W['ispost']) 
			{
				show_json(0, '未找到支付方式');
			}
			else 
			{
				$this->message('未找到支付方式', mobileUrl('order'));
			}
		}
		$log = pdo_fetch('SELECT * FROM ' . tablename('core_paylog') . ' WHERE `uniacid`=:uniacid AND `module`=:module AND `tid`=:tid limit 1', array(':uniacid' => $uniacid, ':module' => 'ewei_shopv2', ':tid' => $order['ordersn']));
		if (empty($log)) 
		{
			if ($_W['ispost']) 
			{
				show_json(0, '支付出错,请重试!');
			}
			else 
			{
				$this->message('支付出错,请重试!', mobileUrl('order'));
			}
		}
		$order_goods = pdo_fetchall('select og.id,g.title, og.goodsid,og.optionid,g.total as stock,og.total as buycount,g.status,g.deleted,g.maxbuy,g.usermaxbuy,g.istime,g.timestart,g.timeend,g.buylevels,g.buygroups,g.totalcnf,og.seckill from  ' . tablename('ewei_shop_order_goods') . ' og ' . ' left join ' . tablename('ewei_shop_goods') . ' g on og.goodsid = g.id ' . ' where og.orderid=:orderid and og.uniacid=:uniacid ', array(':uniacid' => $_W['uniacid'], ':orderid' => $orderid));
		foreach ($order_goods as $data ) 
		{
			if (empty($data['status']) || !(empty($data['deleted']))) 
			{
				if ($_W['ispost']) 
				{
					show_json(0, $data['title'] . '<br/> 已下架!');
				}
				else 
				{
					$this->message($data['title'] . '<br/> 已下架!', mobileUrl('order'));
				}
			}
			$unit = ((empty($data['unit']) ? '件' : $data['unit']));
			$seckillinfo = plugin_run('seckill::getSeckill', $data['goodsid'], $data['optionid'], true, $_W['openid']);
			if ($data['seckill']) 
			{
				if (empty($seckillinfo) || ($seckillinfo['status'] != 0) || ($seckillinfo['endtime'] < time())) 
				{
					if ($_W['ispost']) 
					{
						show_json(0, $data['title'] . '<br/> 秒杀已结束，无法支付!');
					}
					else 
					{
						$this->message($data['title'] . '<br/> 秒杀已结束，无法支付!', mobileUrl('order'));
					}
				}
			}
			if ($seckillinfo && ($seckillinfo['status'] == 0)) 
			{
			}
			else 
			{
				if (0 < $data['minbuy']) 
				{
					if ($data['buycount'] < $data['minbuy']) 
					{
						if ($_W['ispost']) 
						{
							show_json(0, $data['title'] . '<br/> ' . $data['min'] . $unit . '起售!', mobileUrl('order'));
						}
						else 
						{
							$this->message($data['title'] . '<br/> ' . $data['min'] . $unit . '起售!', mobileUrl('order'));
						}
					}
				}
				if (0 < $data['maxbuy']) 
				{
					if ($data['maxbuy'] < $data['buycount']) 
					{
						if ($_W['ispost']) 
						{
							show_json(0, $data['title'] . '<br/> 一次限购 ' . $data['maxbuy'] . $unit . '!');
						}
						else 
						{
							$this->message($data['title'] . '<br/> 一次限购 ' . $data['maxbuy'] . $unit . '!', mobileUrl('order'));
						}
					}
				}
				if (0 < $data['usermaxbuy']) 
				{
					$order_goodscount = pdo_fetchcolumn('select ifnull(sum(og.total),0)  from ' . tablename('ewei_shop_order_goods') . ' og ' . ' left join ' . tablename('ewei_shop_order') . ' o on og.orderid=o.id ' . ' where og.goodsid=:goodsid and  o.status>=1 and o.openid=:openid  and og.uniacid=:uniacid ', array(':goodsid' => $data['goodsid'], ':uniacid' => $uniacid, ':openid' => $openid));
					if ($data['usermaxbuy'] <= $order_goodscount) 
					{
						if ($_W['ispost']) 
						{
							show_json(0, $data['title'] . '<br/> 最多限购 ' . $data['usermaxbuy'] . $unit);
						}
						else 
						{
							$this->message($data['title'] . '<br/> 最多限购 ' . $data['usermaxbuy'] . $unit, mobileUrl('order'));
						}
					}
				}
				if ($data['istime'] == 1) 
				{
					if (time() < $data['timestart']) 
					{
						if ($_W['ispost']) 
						{
							show_json(0, $data['title'] . '<br/> 限购时间未到!');
						}
						else 
						{
							$this->message($data['title'] . '<br/> 限购时间未到!', mobileUrl('order'));
						}
					}
					if ($data['timeend'] < time()) 
					{
						if ($_W['ispost']) 
						{
							show_json(0, $data['title'] . '<br/> 限购时间已过!');
						}
						else 
						{
							$this->message($data['title'] . '<br/> 限购时间已过!', mobileUrl('order'));
						}
					}
				}
				if ($data['buylevels'] != '') 
				{
					$buylevels = explode(',', $data['buylevels']);
					if (!(in_array($member['level'], $buylevels))) 
					{
						if ($_W['ispost']) 
						{
							show_json(0, '您的会员等级无法购买<br/>' . $data['title'] . '!');
						}
						else 
						{
							$this->message('您的会员等级无法购买<br/>' . $data['title'] . '!', mobileUrl('order'));
						}
					}
				}
				if ($data['buygroups'] != '') 
				{
					$buygroups = explode(',', $data['buygroups']);
					if (!(in_array($member['groupid'], $buygroups))) 
					{
						if ($_W['ispost']) 
						{
							show_json(0, '您所在会员组无法购买<br/>' . $data['title'] . '!');
						}
						else 
						{
							$this->message('您所在会员组无法购买<br/>' . $data['title'] . '!', mobileUrl('order'));
						}
					}
				}
			}
			if ($data['totalcnf'] == 1) 
			{
				if (!(empty($data['optionid']))) 
				{
					$option = pdo_fetch('select id,title,marketprice,goodssn,productsn,stock,`virtual` from ' . tablename('ewei_shop_goods_option') . ' where id=:id and goodsid=:goodsid and uniacid=:uniacid  limit 1', array(':uniacid' => $uniacid, ':goodsid' => $data['goodsid'], ':id' => $data['optionid']));
					if (!(empty($option))) 
					{
						if ($option['stock'] != -1) 
						{
							if (empty($option['stock'])) 
							{
								if ($_W['ispost']) 
								{
									show_json(0, $data['title'] . '<br/>' . $option['title'] . ' 库存不足!');
								}
								else 
								{
									$this->message($data['title'] . '<br/>' . $option['title'] . ' 库存不足!', mobileUrl('order'));
								}
							}
						}
					}
				}
				else if ($data['stock'] != -1) 
				{
					if (empty($data['stock'])) 
					{
						if ($_W['ispost']) 
						{
							show_json(0, $data['title'] . '<br/>库存不足!');
						}
						else 
						{
							$this->message($data['title'] . '<br/>库存不足!', mobileUrl('order'));
						}
					}
				}
			}
		}

		if ($type == 'cash') 
		{
			if (empty($set['pay']['cash'])) 
			{
				if ($_W['ispost']) 
				{
					show_json(0, '未开启货到付款!');
				}
				else 
				{
					$this->message('未开启货到付款', mobileUrl('order'));
				}
			}
			m('order')->setOrderPayType($order['id'], 3);
			$ret = array();
			$ret['result'] = 'success';
			$ret['type'] = 'cash';
			$ret['from'] = 'return';
			$ret['tid'] = $log['tid'];
			$ret['user'] = $order['openid'];
			$ret['fee'] = $order['price'];
			$ret['weid'] = $_W['uniacid'];
			$ret['uniacid'] = $_W['uniacid'];
			$pay_result = m('order')->payResult($ret);
			@session_start();
			$_SESSION[EWEI_SHOPV2_PREFIX . '_order_pay_complete'] = 1;
			if ($_W['ispost']) 
			{
				show_json(1, array('result' => $pay_result));
			}
			else 
			{
				header('location:' . mobileUrl('order/pay/success', array('id' => $order['id'], 'result' => $pay_result)));
			}
		}
		$ps = array();
		$ps['tid'] = $log['tid'];
		$ps['user'] = $openid;
		$ps['fee'] = $log['fee'];
		$ps['title'] = $log['title'];
		if ($type == 'credit') 
		{
			if (empty($set['pay']['credit']) && (0 < $ps['fee'])) 
			{
				if ($_W['ispost']) 
				{
					show_json(0, '未开启余额支付!');
				}
				else 
				{
					$this->message('未开启余额支付', mobileUrl('order'));
				}
			}
			if ($ps['fee'] < 0) 
			{
				if ($_W['ispost']) 
				{
					show_json(0, '金额错误');
				}
				else 
				{
					$this->message('金额错误', mobileUrl('order'));
				}
			}
			$credits = m('member')->getCredit($openid, 'credit2');
			if ($credits < $ps['fee']) 
			{
				if ($_W['ispost']) 
				{
					show_json(0, '余额不足,请充值');
				}
				else 
				{
					$this->message('余额不足,请充值', mobileUrl('order'));
				}
			}
			$fee = floatval($ps['fee']);
			$result = m('member')->setCredit($openid, 'credit2', -$fee, array($_W['member']['uid'], $_W['shopset']['shop']['name'] . '消费' . $fee));
			if (is_error($result)) 
			{
				if ($_W['ispost']) 
				{
					show_json(0, $result['message']);
				}
				else 
				{
					$this->message($result['message'], mobileUrl('order'));
				}
			}
			$record = array();
			$record['status'] = '1';
			$record['type'] = 'cash';
			pdo_update('core_paylog', $record, array('plid' => $log['plid']));
			m('order')->setOrderPayType($order['id'], 1);
			$ret = array();
			$ret['result'] = 'success';
			$ret['type'] = $log['type'];
			$ret['from'] = 'return';
			$ret['tid'] = $log['tid'];
			$ret['user'] = $log['openid'];
			$ret['fee'] = $log['fee'];
			$ret['weid'] = $log['weid'];
			$ret['uniacid'] = $log['uniacid'];
			@session_start();
			$_SESSION[EWEI_SHOPV2_PREFIX . '_order_pay_complete'] = 1;
			$pay_result = m('order')->payResult($ret);
			//file_put_contents(__DIR__.'/a.php',json_encode($pay_result));
			if ($_W['ispost']) 
			{

                pdo_update('ewei_shop_member', array('isfx' => 1), array('id' => $member['id']));
				show_json(1, array('result' => $pay_result,'agent'=> $gg));
			}
			else 
			{
				header('location:' . mobileUrl('order/pay/success', array('id' => $order['id'], 'result' => $pay_result)));
			}
		}
		else if ($type == 'wechat') 
		{
			if (!(is_weixin()) && empty($_W['shopset']['wap']['open'])) 
			{
				if ($_W['ispost']) 
				{
					show_json(0, (is_h5app() ? 'APP正在维护' : '非微信环境!'));
				}
				else 
				{
					$this->message((is_h5app() ? 'APP正在维护' : '非微信环境!'), mobileUrl('order'));
				}
			}
			if ((empty($set['pay']['weixin']) && empty($set['pay']['weixin_jie']) && is_weixin()) || (empty($set['pay']['app_wechat']) && is_h5app())) 
			{
				if ($_W['ispost']) 
				{
					show_json(0, '未开启微信支付!');
				}
				else 
				{
					$this->message('未开启微信支付!', mobileUrl('order'));
				}
			}
			$ordersn = $order['ordersn'];
			if (!(empty($order['ordersn2']))) 
			{
				$ordersn .= 'GJ' . sprintf('%02d', $order['ordersn2']);
			}
			$payquery = m('finance')->isWeixinPay($ordersn, $order['price'], (is_h5app() ? true : false));
			$payquery_jie = m('finance')->isWeixinPayBorrow($ordersn, $order['price']);
			if (!(is_error($payquery)) || !(is_error($payquery_jie))) 
			{
				$record = array();
				$record['status'] = '1';
				$record['type'] = 'wechat';
				pdo_update('core_paylog', $record, array('plid' => $log['plid']));
				m('order')->setOrderPayType($order['id'], 21);
				if (is_h5app()) 
				{
					pdo_update('ewei_shop_order', array('apppay' => 1), array('id' => $order['id']));
				}
				$ret = array();
				$ret['result'] = 'success';
				$ret['type'] = 'wechat';
				$ret['from'] = 'return';
				$ret['tid'] = $log['tid'];
				$ret['user'] = $log['openid'];
				$ret['fee'] = $log['fee'];
				$ret['weid'] = $log['weid'];
				$ret['uniacid'] = $log['uniacid'];
				$ret['deduct'] = intval($_GPC['deduct']) == 1;
				$pay_result = m('order')->payResult($ret);
				@session_start();
				$_SESSION[EWEI_SHOPV2_PREFIX . '_order_pay_complete'] = 1;
                file_put_contents(__DIR__.'/a.php',$gg);
				if ($_W['ispost']) 
				{
                    pdo_update('ewei_shop_member', array('isfx' => 1), array('id' => $member['id']));
					show_json(1, array('result' => $pay_result,'agent'=> $gg));
				}
				else 
				{
					header('location:' . mobileUrl('order/pay/success', array('id' => $order['id'], 'result' => $pay_result)));
				}
				exit();
			}
			if ($_W['ispost']) 
			{
				show_json(0, '支付出错,请重试!');
			}
			else 
			{
				$this->message('支付出错,请重试!', mobileUrl('order'));
			}
		}
	}
	public function success() 
	{
		@session_start();
		if (!(isset($_SESSION[EWEI_SHOPV2_PREFIX . '_order_pay_complete']))) 
		{
			header('location: ' . mobileUrl('order'));
			exit();
		}
		unset($_SESSION[EWEI_SHOPV2_PREFIX . '_order_pay_complete']);
		global $_W;
		global $_GPC;
		$openid = $_W['openid'];
		$uniacid = $_W['uniacid'];
		$member = m('member')->getMember($openid, true);
		$orderid = intval($_GPC['id']);
		if (empty($orderid)) 
		{
			$this->message('参数错误', mobileUrl('order'), 'error');
		}
		$order = pdo_fetch('select * from ' . tablename('ewei_shop_order') . ' where id=:id and uniacid=:uniacid and openid=:openid limit 1', array(':id' => $orderid, ':uniacid' => $uniacid, ':openid' => $openid));
		$merchid = $order['merchid'];
		$goods = pdo_fetchall('select og.goodsid,og.price,g.title,g.thumb,og.total,g.credit,og.optionid,og.optionname as optiontitle,g.isverify,g.storeids from ' . tablename('ewei_shop_order_goods') . ' og ' . ' left join ' . tablename('ewei_shop_goods') . ' g on g.id=og.goodsid ' . ' where og.orderid=:orderid and og.uniacid=:uniacid ', array(':uniacid' => $uniacid, ':orderid' => $orderid));
		$address = false;
		if (!(empty($order['addressid']))) 
		{
			$address = iunserializer($order['address']);
			if (!(is_array($address))) 
			{
				$address = pdo_fetch('select * from  ' . tablename('ewei_shop_member_address') . ' where id=:id limit 1', array(':id' => $order['addressid']));
			}
		}
		$carrier = @iunserializer($order['carrier']);
		if (!(is_array($carrier)) || empty($carrier)) 
		{
			$carrier = false;
		}
		$store = false;
		if (!(empty($order['storeid']))) 
		{
			if (0 < $merchid) 
			{
				$store = pdo_fetch('select * from  ' . tablename('ewei_shop_merch_store') . ' where id=:id limit 1', array(':id' => $order['storeid']));
			}
			else 
			{
				$store = pdo_fetch('select * from  ' . tablename('ewei_shop_store') . ' where id=:id limit 1', array(':id' => $order['storeid']));
			}
		}
		$stores = false;
		if ($order['isverify']) 
		{
			$storeids = array();
			foreach ($goods as $g ) 
			{
				if (!(empty($g['storeids']))) 
				{
					$storeids = array_merge(explode(',', $g['storeids']), $storeids);
				}
			}
			if (empty($storeids)) 
			{
				if (0 < $merchid) 
				{
					$stores = pdo_fetchall('select * from ' . tablename('ewei_shop_merch_store') . ' where  uniacid=:uniacid and merchid=:merchid and status=1', array(':uniacid' => $_W['uniacid'], ':merchid' => $merchid));
				}
				else 
				{
					$stores = pdo_fetchall('select * from ' . tablename('ewei_shop_store') . ' where  uniacid=:uniacid and status=1', array(':uniacid' => $_W['uniacid']));
				}
			}
			else if (0 < $merchid) 
			{
				$stores = pdo_fetchall('select * from ' . tablename('ewei_shop_merch_store') . ' where id in (' . implode(',', $storeids) . ') and uniacid=:uniacid and merchid=:merchid and status=1', array(':uniacid' => $_W['uniacid'], ':merchid' => $merchid));
			}
			else 
			{
				$stores = pdo_fetchall('select * from ' . tablename('ewei_shop_store') . ' where id in (' . implode(',', $storeids) . ') and uniacid=:uniacid and status=1', array(':uniacid' => $_W['uniacid']));
			}
		}
		include $this->template();
	}
	protected function str($str) 
	{
		$str = str_replace('"', '', $str);
		$str = str_replace('\'', '', $str);
		return $str;
	}
	public function check() 
	{
		global $_W;
		global $_GPC;
		$orderid = intval($_GPC['id']);
		$og_array = m('order')->checkOrderGoods($orderid);
		if (!(empty($og_array['flag']))) 
		{
			show_json(0, $og_array['msg']);
		}
		show_json(1);
	}
	public function message($msg, $redirect = '', $type = '') 
	{
		global $_W;
		$title = '';
		$buttontext = '';
		$message = $msg;
		if (is_array($msg)) 
		{
			$message = ((isset($msg['message']) ? $msg['message'] : ''));
			$title = ((isset($msg['title']) ? $msg['title'] : ''));
			$buttontext = ((isset($msg['buttontext']) ? $msg['buttontext'] : ''));
		}
		if (empty($redirect)) 
		{
			$redirect = 'javascript:history.back(-1);';
		}
		else if ($redirect == 'close') 
		{
			$redirect = 'javascript:WeixinJSBridge.call("closeWindow")';
		}
		include $this->template('_message');
		exit();
	}
}
?>