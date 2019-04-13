<?php
if (!(defined('IN_IA'))) 
{
	exit('Access Denied');
}
class Index_EweiShopV2Page extends MobilePage 
{
    public function getAllGoods(){
        global $_W;
        global $_GPC;

        $allcategory = m('shop')->getFullCategory(true,true);
       // var_dump($allcategory);die;
        $category = pdo_fetchall('SELECT * FROM ' . tablename('ewei_shop_category') . ' WHERE uniacid =:uniacid AND enabled=1 AND level=1 ORDER BY parentid ASC, displayorder DESC', array(':uniacid' => $_W['uniacid']));
       foreach ($category as $k=>$v){
           $category[$k]['two'] =$this->GetTeamMember2($allcategory,$v['id']);

           foreach ($category[$k]['two'] as $key=>$value){


               $category[$k]['two'][$key]['three'] = ( $this->GetTeamMember3($allcategory,$value['id']));

               foreach ($category[$k]['two'][$key]['three'] as $ke=>$val){

                  $category[$k]['two'][$key]['three'][$ke]['goods'] = $this->get_goods_list($val['id']);
               }

           }
       }

       $arr = $this->get_goods_list(1186);
       var_dump($arr);die;
//       $arr= json_decode($arr,true);
//       var_dump($arr);die;
//        $arr = $this->GetTeamMember($allcategory,1174);
       var_dump($category);
        die;
        foreach ($allcategory['parent'] as $k=>$v){

//           foreach ($allcategory['children'] as $key=>$val){
               if($v['id'] == key($allcategory['children'])){
                   $allcategory['parent'][$k]['children'] = $allcategory['children'][key($allcategory['children'])];
//                   var_dump($allcategory['children'][key($allcategory['children'])]);die;
               }
//           }
        }
        var_dump($allcategory);die;
        $catlevel = intval($_W['shopset']['category']['level']);
        foreach ($allcategory['children'] as $k=>$v){
            var_dump($v);
        }
    }
    public function GetTeamMember2($members, $mid) {
        $teams=array();//最终结果
        $teams[$mid] = '';
        foreach ($members as $k=>$v) {
            if ( isset($teams[$v['parentid']] ) ) {
                if($v['level'] == 2){
                    $teams[$v['id'] ] = '';
                }else{
                    unset($members[$k]);
                }

            } else {
                unset($members[$k]);
            }
        }
//因为获取的是第一个会员下级,所以删除第一个会员
        unset($teams[$mid]);
        return ($members);
    }
    public function GetTeamMember3($members, $mid) {
        $teams=array();//最终结果
        $teams[$mid] = '';
        foreach ($members as $k=>$v) {
            if ( isset($teams[$v['parentid']] ) ) {
                if($v['level'] == 3){
                    $teams[$v['id'] ] = '';

                }else{
                    unset($members[$k]);
                }

            } else {
                unset($members[$k]);
            }
        }
//因为获取的是第一个会员下级,所以删除第一个会员
        unset($teams[$mid]);
        return $members;
//        return array_keys($teams);
    }
	public function main() 
	{
		global $_W;
		global $_GPC;
		$allcategory = m('shop')->getCategory();
		$catlevel = intval($_W['shopset']['category']['level']);
		$opencategory = true;
		$plugin_commission = p('commission');
		if ($plugin_commission && (0 < intval($_W['shopset']['commission']['level']))) 
		{
			$mid = intval($_GPC['mid']);
			if (!(empty($mid))) 
			{
				$shop = p('commission')->getShop($mid);
				if (empty($shop['selectcategory'])) 
				{
					$opencategory = false;
				}
			}
		}
		include $this->template();
	}
	public function gift() 
	{
		global $_W;
		global $_GPC;
		$uniacid = $_W['uniacid'];
		$giftid = intval($_GPC['id']);
		$gift = pdo_fetch('select * from ' . tablename('ewei_shop_gift') . ' where uniacid = ' . $uniacid . ' and id = ' . $giftid . ' and starttime <= ' . time() . ' and endtime >= ' . time() . ' and status = 1 ');
		$giftgoodsid = explode(',', $gift['giftgoodsid']);
		$giftgoods = array();
		if (!(empty($giftgoodsid))) 
		{
			foreach ($giftgoodsid as $key => $value ) 
			{
				$giftgoods[$key] = pdo_fetch('select id,status,title,thumb,marketprice from ' . tablename('ewei_shop_goods') . ' where uniacid = ' . $uniacid . ' and deleted = 0 and total > 0 and id = ' . $value . ' and status = 2 ');
			}
			$giftgoods = array_filter($giftgoods);
		}
		include $this->template();
	}
	public function get_list() 
	{
		global $_GPC;
		global $_W;
		$args = array('pagesize' => 10, 'page' => intval($_GPC['page']), 'isnew' => trim($_GPC['isnew']), 'ishot' => trim($_GPC['ishot']), 'isrecommand' => trim($_GPC['isrecommand']), 'isdiscount' => trim($_GPC['isdiscount']), 'istime' => trim($_GPC['istime']), 'issendfree' => trim($_GPC['issendfree']), 'keywords' => trim($_GPC['keywords']), 'cate' => trim($_GPC['cate']), 'order' => trim($_GPC['order']), 'by' => trim($_GPC['by']));
		$plugin_commission = p('commission');
		if ($plugin_commission && (0 < intval($_W['shopset']['commission']['level'])) && empty($_W['shopset']['commission']['closemyshop']) && !(empty($_W['shopset']['commission']['select_goods']))) 
		{
			$frommyshop = intval($_GPC['frommyshop']);
			$mid = intval($_GPC['mid']);
			if (!(empty($mid)) && !(empty($frommyshop))) 
			{
				$shop = p('commission')->getShop($mid);
				if (!(empty($shop['selectgoods']))) 
				{
					$args['ids'] = $shop['goodsids'];
				}
			}
		}
		$this->_condition($args);
	}
    public function get_goods_list($cate =1186)
    {
        global $_GPC;
        global $_W;
        $args = array('pagesize' => 10, 'page' => intval($_GPC['page']), 'isnew' => trim($_GPC['isnew']), 'ishot' => trim($_GPC['ishot']), 'isrecommand' => trim($_GPC['isrecommand']), 'isdiscount' => trim($_GPC['isdiscount']), 'istime' => trim($_GPC['istime']), 'issendfree' => trim($_GPC['issendfree']), 'keywords' => trim($_GPC['keywords']), 'cate' => 1186, 'order' => trim($_GPC['order']), 'by' => trim($_GPC['by']));
        $plugin_commission = p('commission');
        if ($plugin_commission && (0 < intval($_W['shopset']['commission']['level'])) && empty($_W['shopset']['commission']['closemyshop']) && !(empty($_W['shopset']['commission']['select_goods'])))
        {
            $frommyshop = intval($_GPC['frommyshop']);
            $mid = intval($_GPC['mid']);
            if (!(empty($mid)) && !(empty($frommyshop)))
            {
                $shop = p('commission')->getShop($mid);
                if (!(empty($shop['selectgoods'])))
                {
                    $args['ids'] = $shop['goodsids'];
                }
            }
        }

        $this->goods_condition($args);
    }
	public function query() 
	{
		global $_GPC;
		global $_W;
		$args = array('pagesize' => 10, 'page' => intval($_GPC['page']), 'isnew' => trim($_GPC['isnew']), 'ishot' => trim($_GPC['ishot']), 'isrecommand' => trim($_GPC['isrecommand']), 'isdiscount' => trim($_GPC['isdiscount']), 'istime' => trim($_GPC['istime']), 'keywords' => trim($_GPC['keywords']), 'cate' => trim($_GPC['cate']), 'order' => trim($_GPC['order']), 'by' => trim($_GPC['by']));
		$this->_condition($args);
	}
    private function goods_condition($args)
    {
        global $_GPC;
        $merch_plugin = p('merch');
        $merch_data = m('common')->getPluginset('merch');
        if ($merch_plugin && $merch_data['is_openmerch'])
        {
            $args['merchid'] = intval($_GPC['merchid']);
        }
        if (isset($_GPC['nocommission']))
        {
            $args['nocommission'] = intval($_GPC['nocommission']);
        }

        $goods = m('goods')->getList($args);
//     show_json(1, array('list' => $goods['list'], 'total' => $goods['total'], 'pagesize' => $args['pagesize']));
       //var_dump($goods['list']);die;

        $goods= ( json_encode(array('list' => $goods['list']),JSON_UNESCAPED_UNICODE));
        $goods =json_last_error();
        return $goods;
    }

	private function _condition($args) 
	{
		global $_GPC;
		$merch_plugin = p('merch');
		$merch_data = m('common')->getPluginset('merch');
		if ($merch_plugin && $merch_data['is_openmerch']) 
		{
			$args['merchid'] = intval($_GPC['merchid']);
		}
		if (isset($_GPC['nocommission'])) 
		{
			$args['nocommission'] = intval($_GPC['nocommission']);
		}
		$goods = m('goods')->getList($args);
		show_json(1, array('list' => $goods['list'], 'total' => $goods['total'], 'pagesize' => $args['pagesize']));
	}
}
?>