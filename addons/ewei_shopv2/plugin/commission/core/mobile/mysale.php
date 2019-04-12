<?php

/*
 * 人人商城V2
 * 
 * @author ewei 狸小狐 QQ:22185157 
 */
if (!defined('IN_IA')) {
	exit('Access Denied');
}

require EWEI_SHOPV2_PLUGIN . 'commission/core/page_login_mobile.php';

class Mysale_EweiShopV2Page extends CommissionMobileLoginPage {

    protected function merchData()
    {
        $merch_plugin = p('merch');
        $merch_data = m('common')->getPluginset('merch');
        if ($merch_plugin && $merch_data['is_openmerch'])
        {
            $is_openmerch = 1;
        }
        else
        {
            $is_openmerch = 0;
        }
        return array('is_openmerch' => $is_openmerch, 'merch_plugin' => $merch_plugin, 'merch_data' => $merch_data);
    }
    public function main()
    {
        global $_W;
        global $_GPC;
        $uniacid = $_W['uniacid'];
        $openid = $_W['openid'];
        $price = 0;
        $trade = m('common')->getSysset('trade');
        $merchdata = $this->merchData();
        extract($merchdata);
        $member = m('member')->getMember($openid);
        $openid_str = '';
        $child = pdo_fetchall('Select openid from ' . tablename('ewei_shop_member') . ' where agentpath like "%,'.$member['id'].',%"');
        foreach($child as $row){
            $openid_str .= ',"'.$row['openid'].'"';
        }
        $openid_str = substr($openid_str, 1);
        $condition = ' and openid in('.$openid_str.') and ismr=0 and deleted=0 and uniacid=:uniacid and is_carsale = 1';
        $params = array(':uniacid' => $uniacid);
        $condition .= ' and merchshow=0 ';
        //统计金额
        $condition .= ' and status =3';
        $allsale = pdo_fetchall('select id,isparent from ' . tablename('ewei_shop_order') . ' where 1 ' . $condition . ' order by createtime desc', $params);
        foreach($allsale as $row){
            if ($row['isparent'] == 1)
            {
                $scondition = ' og.parentorderid=:parentorderid';
                $param[':parentorderid'] = $row['id'];
            }
            else
            {
                $scondition = ' og.orderid=:orderid';
                $param[':orderid'] = $row['id'];
            }
            $sql = 'SELECT og.goodsid,og.total,g.title,g.thumb,g.pcate,g.status,og.price,og.optionname as optiontitle,og.optionid,op.specs,g.merchid,og.seckill,og.seckill_taskid FROM ' . tablename('ewei_shop_order_goods') . ' og ' . ' left join ' . tablename('ewei_shop_goods') . ' g on og.goodsid = g.id ' . ' left join ' . tablename('ewei_shop_goods_option') . ' op on og.optionid = op.id ' . ' where ' . $scondition . ' and g.pcate = 1174 order by og.id asc';
            $goods = pdo_fetchall($sql, $param);
            foreach($goods as $item){
                if($item['pcate'] == 1174){
                    $price += $item['price'];
                }
            }
        }
        include $this->template();
    }
    public function get_list()
    {
        global $_W;
        global $_GPC;
        $uniacid = $_W['uniacid'];
        $openid = $_W['openid'];
        $pindex = max(1, intval($_GPC['page']));
        $psize = 50;
        $show_status = $_GPC['status'];
        $r_type = array('退款', '退货退款', '换货');
        $member = m('member')->getMember($openid);
        $openid_str = '';
        $child = pdo_fetchall('Select openid from ' . tablename('ewei_shop_member') . ' where agentpath like "%,'.$member['id'].',%"');
        foreach($child as $row){
            $openid_str .= ',"'.$row['openid'].'"';
        }
        $openid_str = substr($openid_str, 1);
        $condition = ' and openid in('.$openid_str.') and ismr=0 and deleted=0 and uniacid=:uniacid and is_carsale = 1';
        $params = array(':uniacid' => $uniacid);
        $merchdata = $this->merchData();
        extract($merchdata);
        $condition .= ' and merchshow=0 ';
        if($show_status == ""){
            $show_status = 6;
        }else{
            $show_status = intval($show_status);
        }
        switch ($show_status)
        {
            case 0: $condition .= ' and status=0 and paytype!=3';
                break;
            case 2: $condition .= ' and (status=2 or status=0 and paytype=3)';
                break;
            case 4: $condition .= ' and refundstate>0';
                break;
            case 5: $condition .= ' and userdeleted=1 ';
                break;
            case 6: $condition .= ' and userdeleted=0 ';
                break;
            default: $condition .= ' and status=' . intval($show_status);

        }
        if ($show_status != 5)
        {
            $condition .= ' and userdeleted=0 ';

        }
        $com_verify = com('verify');
        $s_string = '';
        if (p('ccard'))
        {
            $s_string = ',ccard';
        }
        $sql = 'select id,addressid,createtime,address,ordersn,price,dispatchprice,status,iscomment,isverify,verifyendtime,' . "\n" . 'verified,verifycode,verifytype,iscomment,refundid,expresscom,express,expresssn,finishtime,`virtual`,' . "\n" . 'paytype,expresssn,refundstate,dispatchtype,verifyinfo,merchid,isparent,userdeleted' . $s_string . "\n" . ' from ' . tablename('ewei_shop_order') . ' where 1 ' . $condition . ' order by createtime desc LIMIT ' . (($pindex - 1) * $psize) . ',' . $psize;
        $list = pdo_fetchall($sql, $params);
        $total = pdo_fetchcolumn('select count(*) from ' . tablename('ewei_shop_order') . ' where 1 ' . $condition, $params);
        $refunddays = intval($_W['shopset']['trade']['refunddays']);
        if ($is_openmerch == 1)
        {
            $merch_user = $merch_plugin->getListUser($list, 'merch_user');
        }

        foreach ($list as &$row )
        {
            $param = array();
            if ($row['isparent'] == 1)
            {
                $scondition = ' og.parentorderid=:parentorderid';
                $param[':parentorderid'] = $row['id'];
            }
            else
            {
                $scondition = ' og.orderid=:orderid';
                $param[':orderid'] = $row['id'];
            }
            $row['address'] = iunserializer($row['address']);
            $row['createtime'] = date('Y-m-d H:i:s', $row['createtime']);
            $sql = 'SELECT og.goodsid,og.total,g.title,g.thumb,g.pcate,g.status,og.price,og.optionname as optiontitle,og.optionid,op.specs,g.merchid,og.seckill,og.seckill_taskid FROM ' . tablename('ewei_shop_order_goods') . ' og ' . ' left join ' . tablename('ewei_shop_goods') . ' g on og.goodsid = g.id ' . ' left join ' . tablename('ewei_shop_goods_option') . ' op on og.optionid = op.id ' . ' where ' . $scondition . ' and g.pcate = 1174 order by og.id asc';
            $goods = pdo_fetchall($sql, $param);
            $ismerch = 0;
            $merch_array = array();
            foreach ($goods as &$r )
            {
                if ($r['pcate'] != '1174') continue;
                $r['seckilltask'] = false;
                if ($r['seckill'])
                {
                    $r['seckill_task'] = plugin_run('seckill::getTaskInfo', $r['seckill_taskid']);
                }
                $merchid = $r['merchid'];
                $merch_array[$merchid] = $merchid;
                if (!(empty($r['specs'])))
                {
                    $thumb = m('goods')->getSpecThumb($r['specs']);
                    if (!(empty($thumb)))
                    {
                        $r['thumb'] = $thumb;
                    }
                }
            }
            unset($r);
            if (!(empty($merch_array)))
            {
                if (1 < count($merch_array))
                {
                    $ismerch = 1;
                }
            }
            $goods = set_medias($goods, 'thumb');
            if (empty($goods))
            {
                $goods = array();
            }
            foreach ($goods as &$r )
            {
                if ($r['pcate'] != '1174') continue;
                $r['thumb'] .= '?t=' . random(50);
            }
            unset($r);
            $goods_list = array();
            if ($ismerch)
            {
                $getListUser = $merch_plugin->getListUser($goods);
                $merch_user = $getListUser['merch_user'];
                foreach ($getListUser['merch'] as $k => $v )
                {
                    if (empty($merch_user[$k]['merchname']))
                    {
                        $goods_list[$k]['shopname'] = $_W['shopset']['shop']['name'];
                    }
                    else
                    {
                        $goods_list[$k]['shopname'] = $merch_user[$k]['merchname'];
                    }
                    $goods_list[$k]['goods'] = $v;
                }
            }
            else
            {
                if ($merchid == 0)
                {
                    $goods_list[0]['shopname'] = $_W['shopset']['shop']['name'];
                }
                else
                {
                    $merch_data = $merch_plugin->getListUserOne($merchid);
                    $goods_list[0]['shopname'] = $merch_data['merchname'];
                }
                $goods_list[0]['goods'] = $goods;
            }
            $row['goods'] = $goods_list;
            $row['goods_num'] = count($goods);
            $statuscss = 'text-cancel';
            switch ($row['status'])
            {
                case '-1': $status = '已取消';
                    break;
                case '0': if ($row['paytype'] == 3)
                {
                    $status = '待发货';
                }
                else
                {
                    $status = '待付款';
                }
                    $statuscss = 'text-cancel';
                    break;
                case '1': if ($row['isverify'] == 1)
                {
                    $status = '使用中';
                    if ((0 < $row['verifyendtime']) && ($row['verifyendtime'] < time()))
                    {
                        $row['status'] = -1;
                        $status = '已过期';
                    }
                }
                else if (empty($row['addressid']))
                {
                    if (!(empty($row['ccard'])))
                    {
                        $status = '充值中';
                    }
                    else
                    {
                        $status = '待取货';
                    }
                }
                else
                {
                    $status = '待发货';
                }
                    $statuscss = 'text-warning';
                    break;
                case '2': $status = '待收货';
                    $statuscss = 'text-danger';
                    break;
                case '3': if (empty($row['iscomment']))
                {
                    if ($show_status == 5)
                    {
                        $status = '已完成';
                    }
                    else
                    {
                        $status = ((empty($_W['shopset']['trade']['closecomment']) ? '待评价' : '已完成'));
                    }
                }
                else
                {
                    $status = '交易完成';
                }
                    $statuscss = 'text-success';
                    break;
            }
            $row['statusstr'] = $status;
            $row['statuscss'] = $statuscss;
            if ((0 < $row['refundstate']) && !(empty($row['refundid'])))
            {
                $refund = pdo_fetch('select * from ' . tablename('ewei_shop_order_refund') . ' where id=:id and uniacid=:uniacid and orderid=:orderid limit 1', array(':id' => $row['refundid'], ':uniacid' => $uniacid, ':orderid' => $row['id']));
                if (!(empty($refund)))
                {
                    $row['statusstr'] = '待' . $r_type[$refund['rtype']];
                }
            }
            $canrefund = false;
            $row['canrefund'] = $canrefund;
            $row['canverify'] = false;
            $canverify = false;
            if ($com_verify)
            {
                $showverify = $row['dispatchtype'] || $row['isverify'];
                if ($row['isverify'])
                {
                    if (($row['verifytype'] == 0) || ($row['verifytype'] == 1))
                    {
                        $vs = iunserializer($row['verifyinfo']);
                        $verifyinfo = array( array('verifycode' => $row['verifycode'], 'verified' => ($row['verifytype'] == 0 ? $row['verified'] : $row['goods'][0]['goods']['total'] <= count($vs))) );
                        if ($row['verifytype'] == 0)
                        {
                            $canverify = empty($row['verified']) && $showverify;
                        }
                        else if ($row['verifytype'] == 1)
                        {
                            $canverify = (count($vs) < $row['goods'][0]['goods']['total']) && $showverify;
                        }
                    }
                    else
                    {
                        $verifyinfo = iunserializer($row['verifyinfo']);
                        $last = 0;
                        foreach ($verifyinfo as $v )
                        {
                            if (!($v['verified']))
                            {
                                ++$last;
                            }
                        }
                        $canverify = (0 < $last) && $showverify;
                    }
                }
                else if (!(empty($row['dispatchtype'])))
                {
                    $canverify = ($row['status'] == 1) && $showverify;
                }
            }
            $row['canverify'] = $canverify;
            if ($is_openmerch == 1)
            {
                $row['merchname'] = (($merch_user[$row['merchid']]['merchname'] ? $merch_user[$row['merchid']]['merchname'] : $_W['shopset']['shop']['name']));
            }
        }

        unset($row);
        show_json(1, array('list' => $list, 'pagesize' => $psize, 'total' => $total));
    }
}
