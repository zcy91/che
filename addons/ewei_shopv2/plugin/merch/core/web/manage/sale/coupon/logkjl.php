<?php

if (!defined('IN_IA')) {

	exit('Access Denied');
}
/*卡 记录*/
require EWEI_SHOPV2_PLUGIN . 'merch/core/inc/page_merch.php';
class Logkjl_EweiShopV2Page extends MerchWebPage
{
	public function __construct($_com = 'coupon')
	{
		parent::__construct($_com);
	}

	public function main()
	{
		global $_W;
		global $_GPC;
		$pindex = max(1, intval($_GPC['page']));
		$psize = 20;
		$condition = ' k.uniacid = :uniacid ';
		$params = array(':uniacid' => $_W['uniacid']);
		$couponid = intval($_GPC['couponid']);
		if (!(empty($couponid))) 
		{
			$car = pdo_fetch('select * from ' . tablename('ewei_shop_car') . ' where id=:id and uniacid=:uniacid and merchid=0 limit 1', array(':id' => $couponid, ':uniacid' => $_W['uniacid']));
			$condition .= ' AND c.id=' . intval($couponid);
		}
		
		$keyword = trim($_GPC['keyword']);
		
		if (!(empty($keyword))) 
		{
			$condition .= ' and ( k.chepai like :keyword or k.hexiaoma like :keyword)';
			$params[':keyword'] = '%' . $keyword . '%';
		}
		
		$condition = ' k.merchid='.$_W['merchid'];
		$sql = 'SELECT k.*, c.coupontype,c.couponname,m.nickname,m.avatar,m.realname,m.mobile FROM ' . 
		tablename('ewei_shop_car_kadata') . ' k ' . ' left join ' . tablename('ewei_shop_car') . ' c on k.couponid = c.id ' . ' left join ' . 
		tablename('ewei_shop_member') . ' m on m.openid = k.openid and m.uniacid = k.uniacid ' . ' where  1 and ' . $condition . ' ORDER BY usetime DESC';
		//file_put_contents(__dir__."/sql816.txt",json_encode($sql));
		if (empty($_GPC['export'])) 
		{
			$sql .= ' LIMIT ' . (($pindex - 1) * $psize) . ',' . $psize;
		}
		$list = pdo_fetchall($sql, $params);
		
		foreach ($list as &$row ) 
		{
			$couponstr = '消费';
			if ($row['coupontype'] == 1) 
			{
				$couponstr = '充值';
			}
			$row['couponstr'] = $couponstr;
			if ($row['gettype'] == 0) 
			{
				$row['gettypestr'] = '后台发放';
			}
			else if ($row['gettype'] == 1) 
			{
				$row['gettypestr'] = '领券中心';
			}
			else if ($row['gettype'] == 2) 
			{
				$row['gettypestr'] = '积分商城';
			}
			else if ($row['gettype'] == 3) 
			{
				$row['gettypestr'] = '超级海报';
			}
			else if ($row['gettype'] == 4) 
			{
				$row['gettypestr'] = '活动海报';
			}
			else if ($row['gettype'] == 5) 
			{
				$row['gettypestr'] = '口令优惠券';
			}
			else if ($row['gettype'] == 6) 
			{
				$row['gettypestr'] = '任务发送';
			}
		}
		unset($row);
		if ($_GPC['export'] == 1) 
		{
			ca('car.log.export');
			foreach ($list as &$row ) 
			{
				$row['gettime'] = date('Y-m-d H:i', $row['gettime']);
				if (!(empty($row['usetime']))) 
				{
					$row['usetime'] = date('Y-m-d H:i', $row['usetime']);
				}
				else 
				{
					$row['usetime'] = '---';
				}
			}
			$columns = array( array('title' => 'ID', 'field' => 'id', 'width' => 12), array('title' => '洗车卡', 'field' => 'couponname', 'width' => 24), array('title' => '类型', 'field' => 'couponstr', 'width' => 12), array('title' => '会员信息', 'field' => 'nickname', 'width' => 12), array('title' => '姓名', 'field' => 'realname', 'width' => 12), array('title' => '手机号', 'field' => 'mobile', 'width' => 12), array('title' => 'openid', 'field' => 'openid', 'width' => 24), array('title' => '获取方式', 'field' => 'gettypestr', 'width' => 12), array('title' => '获取时间', 'field' => 'gettime', 'width' => 12), array('title' => '使用时间', 'field' => 'usetime', 'width' => 12), array('title' => '使用单号', 'field' => 'ordersn', 'width' => 12) );
			m('excel')->export($list, array('title' => '洗车券数据-' . date('Y-m-d-H-i', time()), 'columns' => $columns));
			plog('sale.car.log.export', '导出洗车卡发放记录');
		}
		$total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('ewei_shop_car_kadata') . ' k ' . ' left join ' . tablename('ewei_shop_car') . ' c on k.couponid = c.id ' . ' left join ' . tablename('ewei_shop_member') . ' m on m.openid = k.openid and m.uniacid = k.uniacid ' . 'where 1 and ' . $condition, $params);
		$pager = pagination($total, $pindex, $psize);
		include $this->template();
	}
	
	
	public function update(){
		global $_W;
		global $_GPC;
		$id = intval($_GPC['id']);
		$usetime = time();
		//$used = 1;
		$item = pdo_fetch('SELECT * FROM ' . tablename('ewei_shop_car_data') . ' WHERE id  = :id  and uniacid=:uniacid ', array(':id' => $id, ':uniacid' => $_W['uniacid']));
		if (!(empty($item))) 
		{
			pdo_update('ewei_shop_car_data',array('used'=>1,'merchid'=>$_W['merchid'],'usetime'=>time()),array('id'=>$id));
		}
		header("Location:https://jyqc.hejiewl.com/web/merchant.php?c=site&a=entry&m=ewei_shopv2&do=web&r=sale.coupon.logk");
	}                    
}


?>