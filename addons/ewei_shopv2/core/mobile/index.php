<?php
if (!(defined('IN_IA'))) 
{
	exit('Access Denied');
}
class Index_EweiShopV2Page extends MobilePage 
{
	public function __construct()
	{
		global $_W;
		global $_GPC;
		m('shop')->checkClose();
		$preview = intval($_GPC['preview']);
		$wap = m('common')->getSysset('wap');
		if ($wap['open'] && !(is_weixin()) && empty($preview))
		{
			if ($this instanceof MobileLoginPage || $this instanceof PluginMobileLoginPage)
			{
				if (empty($_W['openid']))
				{
					$_W['openid'] = m('account')->checkLogin();
				}
			}
			else
			{
				$_W['openid'] = m('account')->checkOpenid();
			}
		}
		else
		{
			if ($preview && !(is_weixin()))
			{
				$_W['openid'] = 'o6tC-wmZovDTswVba3Kg1oAV_dd0';
			}
			if (EWEI_SHOPV2_DEBUG)
			{
				$_W['openid'] = 'o6tC-wmZovDTswVba3Kg1oAV_dd0';
			}
		}
		$member = m('member')->checkMember();
		$r = $_GPC['r'];
		$me = m('member')->getMember($member['openid'], true);
		$_W['mid'] = ((!(empty($member)) ? $member['id'] : ''));
		$_W['mopenid'] = ((!(empty($member)) ? $member['openid'] : ''));
		$merch_plugin = p('merch');
		$merch_data = m('common')->getPluginset('merch');
		if (!(empty($_GPC['merchid'])) && $merch_plugin && $merch_data['is_openmerch'])
		{
			$this->merch_user = pdo_fetch('select * from ' . tablename('ewei_shop_merch_user') . ' where id=:id limit 1', array(':id' => intval($_GPC['merchid'])));
		}

	}
	public function main()
	{
		global $_W;
		global $_GPC;
		$member = m('member')->getMember($_W['openid'], true);
		/*if(empty($member['mobile'])){
			include $this->template('member/bind');
			exit();
		}*/
		$this->diypage('home');
		$uniacid = $_W['uniacid'];
		$mid = intval($_GPC['mid']);
		$index_cache = $this->getpage();
		if (!(empty($mid)))
		{
			$index_cache = preg_replace_callback('/href=[\\\'"]?([^\\\'" ]+).*?[\\\'"]/', function($matches) use($mid)
			{
				$preg = $matches[1];
				if (strexists($preg, 'mid='))
				{
					return 'href=\'' . $preg . '\'';
				}
				if (!(strexists($preg, 'javascript')))
				{
					$preg = preg_replace('/(&|\\?)mid=[\\d+]/', '', $preg);
					if (strexists($preg, '?'))
					{
						$newpreg = $preg . '&mid=' . $mid;
					}
					else
					{
						$newpreg = $preg . '?mid=' . $mid;
					}
					return 'href=\'' . $newpreg . '\'';
				}
			}
			, $index_cache);
		}
		$shop_data = m('common')->getSysset('shop');
		include $this->template();
	}
	public function get_recommand() 
	{
		global $_W;
		global $_GPC;
		$args = array('page' => $_GPC['page'], 'pagesize' => 6, 'isrecommand' => 1, 'order' => 'displayorder desc,createtime desc', 'by' => '');
		$recommand = m('goods')->getList($args);
		show_json(1, array('list' => $recommand['list'], 'pagesize' => $args['pagesize'], 'total' => $recommand['total'], 'page' => intval($_GPC['page'])));
	}
	private function getcache() 
	{
		global $_W;
		global $_GPC;
		return m('common')->createStaticFile(mobileUrl('getpage', NULL, true));
	}
	public function getpage() 
	{
		global $_W;
		global $_GPC;
		$uniacid = $_W['uniacid'];
		$defaults = array( 'adv' => array('text' => '幻灯片', 'visible' => 1), 'search' => array('text' => '搜索栏', 'visible' => 1), 'nav' => array('text' => '导航栏', 'visible' => 1), 'notice' => array('text' => '公告栏', 'visible' => 1), 'cube' => array('text' => '魔方栏', 'visible' => 1), 'banner' => array('text' => '广告栏', 'visible' => 1), 'goods' => array('text' => '推荐栏', 'visible' => 1) );
		$sorts = ((isset($_W['shopset']['shop']['indexsort']) ? $_W['shopset']['shop']['indexsort'] : $defaults));
		$sorts['recommand'] = array('text' => '系统推荐', 'visible' => 1);
		$advs = pdo_fetchall('select id,advname,link,thumb from ' . tablename('ewei_shop_adv') . ' where uniacid=:uniacid and enabled=1 order by displayorder desc', array(':uniacid' => $uniacid));
		$navs = pdo_fetchall('select id,navname,url,icon from ' . tablename('ewei_shop_nav') . ' where uniacid=:uniacid and status=1 order by displayorder desc', array(':uniacid' => $uniacid));
		$cubes = ((is_array($_W['shopset']['shop']['cubes']) ? $_W['shopset']['shop']['cubes'] : array()));
		$banners = pdo_fetchall('select id,bannername,link,thumb from ' . tablename('ewei_shop_banner') . ' where uniacid=:uniacid and enabled=1 order by displayorder desc', array(':uniacid' => $uniacid));
		$bannerswipe = $_W['shopset']['shop']['bannerswipe'];
		if (!(empty($_W['shopset']['shop']['indexrecommands']))) 
		{
			$goodids = implode(',', $_W['shopset']['shop']['indexrecommands']);
			if (!(empty($goodids))) 
			{
				$indexrecommands = pdo_fetchall('select id, title, thumb, marketprice, productprice, minprice, total from ' . tablename('ewei_shop_goods') . ' where id in( ' . $goodids . ' ) and uniacid=:uniacid and status=1 order by instr(\'' . $goodids . '\',id),displayorder desc', array(':uniacid' => $uniacid));
			}
		}
		$goodsstyle = $_W['shopset']['shop']['goodsstyle'];
		$notices = pdo_fetchall('select id, title, link, thumb from ' . tablename('ewei_shop_notice') . ' where uniacid=:uniacid and status=1 order by displayorder desc limit 5', array(':uniacid' => $uniacid));
		$seckillinfo = plugin_run('seckill::getTaskSeckillInfo');
		ob_start();
		ob_implicit_flush(false);
		require $this->template('index_tpl');
		return ob_get_clean();
	}
	public function seckillinfo() 
	{
		$seckillinfo = plugin_run('seckill::getTaskSeckillInfo');
		include $this->template('shop/index/seckill_tpl');
		exit();
	}
	public function qr() 
	{
		global $_W;
		global $_GPC;
		$url = trim($_GPC['url']);
		require IA_ROOT . '/framework/library/qrcode/phpqrcode.php';
		QRcode::png($url, false, QR_ECLEVEL_L, 16, 1);
	}
}
?>