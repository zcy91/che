<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<div class="container" style="margin-top:20px;">

    <div class="row">
        <div class="col-sm-10">
            <div class="contact-box" style="border: 1px solid #e7eaec">
                <div class="forum-item">
                    <div class="row">
                        <a href="<?php  echo merchUrl('apply/list/add')?>">
                            <div class="col-sm-3 forum-info">
                                                <span class="views-number status0">
                                                    --
                                                </span>
                                <div>
                                    <small>可提现金额</small>
                                </div>
                            </div>
                        </a>

                        <a href="<?php  echo merchUrl('apply/list/status1')?>">
                            <div class="col-sm-3 forum-info">
                                                <span class="views-number status1">
                                                   --
                                                </span>
                                <div>
                                    <small>待审核金额</small>
                                </div>
                            </div>
                        </a>

                        <a href="<?php  echo merchUrl('apply/list/status2')?>">
                            <div class="col-sm-3 forum-info">
                                                <span class="views-number status2">
                                                   --
                                                </span>
                                <div>
                                    <small>待结算金额</small>
                                </div>
                            </div>
                        </a>


                        <a href="<?php  echo merchUrl('apply/list/status3')?>">
                            <div class="col-sm-3 forum-info">
                                                <span class="views-number status3">
                                                   --
                                                </span>
                                <div>
                                    <small>已结算金额</small>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="row">
                        <div class="col-sm-3" style="padding-left: 80px;">
                            <a class="btn btn-primary btn-sm" href="<?php  echo merchUrl('apply/list/add')?>" style="color: #fff">申请提现</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="col-md-10 col-sm-10" style="display: none;">
            <?php  if(!empty($order_ok)) { ?>
            <div class="ibox float-e-margins" style="border: 1px solid #e7eaec">
                <div class="ibox-title">
                    <h5>用户购买待发货订单</h5>
                </div>
                <div class="ibox-content">
                    <table class="table table-hover no-margins">
                        <thead>
                        <tr>
                            <th class="col-sm-1">状态</th>
                            <th class="col-sm-2">日期</th>
                            <th class="col-sm-1">金额</th>
                            <th class="col-sm-2">用户</th>
                            <th class="col-sm-3">订单号</th>
                            <th class="col-sm-2">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php  if(is_array($order_ok)) { foreach($order_ok as $key => $value) { ?>
                        <tr>
                            <td><span class="label label-warning">待发货</span>
                            </td>
                            <td><?php  echo date('Y-m-d H:i',$value['createtime'])?></td>
                            <td class="text-navy"><?php  echo $value['price'];?></td>
                            <td><?php echo !empty($value['address']['realname']) ? $value['address']['realname'] : $value['invoicename']?></td>
                            <td class="text-navy"><?php  echo $value['ordersn'];?></td>
                            <td>
                                <?php if(mcv('order.detail')) { ?>
                                <a href="<?php  echo merchUrl('order/detail',array('id'=>$value['id']))?>" class="btn btn-xs btn-primary">查看详情</a></td>
                            <?php  } ?>
                        </tr>
                        <?php  } } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php  } else { ?>
            <div class="panel panel-default">
                <div class="panel-body" style="text-align: center;padding:30px;">
                    暂时没有任何待处理订单!
                </div>
            </div>
            <?php  } ?>
        </div>

    </div>

    <script type="text/javascript">
        $(document).ready(function(){
            $.ajax({
                type: "GET",
                url: "<?php  echo merchUrl('apply/index/ajaxgettotalprice')?>",
                dataType: "json",
                success: function (data) {
                    var res = data.result;
                    $("span.status0").text(res.status0);
                    $("span.status1").text(res.status1);
                    $("span.status2").text(res.status2);
                    $("span.status3").text(res.status3);
                }
            });
        });
    </script>


    <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>