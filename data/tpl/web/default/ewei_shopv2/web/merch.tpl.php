<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>

<div class="page-heading">
    <span class='pull-right'>
        <?php if(cv('merch.user.add')) { ?>
        	<a class='btn btn-primary btn-sm' href="<?php  echo webUrl('merch/user/add')?>"><i class='fa fa-plus'></i> 添加商户</a>
        <?php  } ?>
    </span>
    <h2>多商户概述</h2>
</div>

<div class="row">
    <div class="col-sm-4">
        <div class="ibox float-e-margins" style="border: 1px solid #e7eaec">
            <div class="ibox-title">
                <h5>入驻申请中</h5>
            </div>
            <div class="ibox-content">
                <h1 class="no-margins text-danger reg0">--</h1>
                <div class="stat-percent font-bold text-success"><span class="today-rate"></span><i class="fa"></i>
                </div>
                <small></small>
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="ibox float-e-margins" style="border: 1px solid #e7eaec">
            <div class="ibox-title">
                <h5>入驻申请驳回</h5>
            </div>
            <div class="ibox-content">
                <h1 class="no-margins text-default reg_1">--</h1>
                <div class="stat-percent font-bold text-success"><span class="today-rate"></span><i class="fa"></i>
                </div>
                <small></small>
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="ibox float-e-margins" style="border: 1px solid #e7eaec">
            <div class="ibox-title">
                <h5>待入驻商户</h5>
            </div>
            <div class="ibox-content">
                <h1 class="no-margins text-success user0">--</h1>
                <div class="stat-percent font-bold text-warning"><span class="seven-rate"></span><i class="fa"></i>
                </div>
                <small></small>
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="ibox float-e-margins" style="border: 1px solid #e7eaec">
            <div class="ibox-title">
                <h5>入驻中商户</h5>
            </div>
            <div class="ibox-content">
                <h1 class="no-margins text-primary user1">--</h1>
                <div class="stat-percent font-bold text-warning"><span class="seven-rate"></span><i class="fa"></i>
                </div>
                <small></small>
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="ibox float-e-margins" style="border: 1px solid #e7eaec">
            <div class="ibox-title">
                <h5>暂停中商户</h5>
            </div>
            <div class="ibox-content">
                <h1 class="no-margins text-warning user2">--</h1>
                <div class="stat-percent font-bold text-warning"><span class="seven-rate"></span><i class="fa"></i>
                </div>
                <small></small>
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="ibox float-e-margins" style="border: 1px solid #e7eaec">
            <div class="ibox-title">
                <h5>即将到期商户</h5>
            </div>
            <div class="ibox-content">
                <h1 class="no-margins text-danger user3">--</h1>
                <div class="stat-percent font-bold text-warning"><span class="seven-rate"></span><i class="fa"></i>
                </div>
                <small></small>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-sm-6">
        <div class="ibox float-e-margins" style="border: 1px solid #e7eaec">
            <div class="ibox-title">
                <span class="label label-primary pull-left">总订单统计</span>
                <span class="pull-right">总订单<span class="today-avg"></span></span>
                <h5></h5>
            </div>
            <div class="ibox-content">

                <div class="row">
                    <div class="col-md-6 text-center">
                        订单数
                        <h2 class="no-margins totalcount">--</h2>
                    </div>
                    <div class="col-md-6 text-center">
                        订单金额
                        <h2 class="no-margins">¥ <span class="totalmoney">--</span></h2>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="col-md-6 col-sm-6">
        <div class="ibox float-e-margins" style="border: 1px solid #e7eaec">
            <div class="ibox-title">
                <span class="label label-success pull-left">已完成订单统计</span>
                <span class="pull-right">已完成订单<span class="today-avg"></span></span>
                <h5></h5>
            </div>
            <div class="ibox-content">

                <div class="row">
                    <div class="col-md-6 text-center">
                        订单数
                        <h2 class="no-margins tcount">--</h2>
                    </div>
                    <div class="col-md-6 text-center">
                        订单金额
                        <h2 class="no-margins">¥ <span class="tmoney">--</span></h2>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>

<script>

    $(function(){
        $.ajax({
            type: "GET",
            url: "<?php  echo webUrl('merch/index/ajaxuser')?>",
            dataType: "json",
            success: function (data) {
                var json = data.result;
                $(".reg0").text(json.reg0);
                $(".reg_1").text(json.reg_1);
                $(".user0").text(json.user0);
                $(".user1").text(json.user1);
                $(".user2").text(json.user2);
                $(".user3").text(json.user3);
                $(".totalmoney").text(json.totalmoney);
                $(".totalcount").text(json.totalcount);
                $(".tmoney").text(json.tmoney);
                $(".tcount").text(json.tcount);
            }
        });
    });


</script>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>