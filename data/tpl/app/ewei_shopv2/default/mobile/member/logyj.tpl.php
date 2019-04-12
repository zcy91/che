<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<div class='fui-page  fui-page-current member-log-page'>
    <div class="fui-header">
        <div class="fui-header-left">
            <a class="back"></a>
        </div>
        <div class="title">佣金明细</div>
    </div>

    <div class='fui-content navbar' >

        
        <div id="tab" class="fui-tab fui-tab-danger">
            <a data-tab="tab1"  class="external active" data-type='0'>佣金列表</a>
           
        </div>
      


        <div class='content-empty' style='display:none;'>
            <i class='icon icon-searchlist'></i><br/>暂时没有任何记录!
        </div>

        <div class='fui-list-group container' style="display:none;"></div>
        <div class='infinite-loading'><span class='fui-preloader'></span><span class='text'> 正在加载...</span></div>
    </div>

    <script id="tpl_member_log_list" type="text/html">

        <%each list as log%>
        <div class="fui-list goods-item">

            <div class="fui-list-inner">
                <div class='title'>   <%if log.type==0%><%log.title%>: <%/if%>
                    <%if log.type==1%>提现金额: <%/if%>
                    <%if log.type==2%>佣金打款: <%/if%>
                    <%log.money%> 元

                </div>
               
                <div class='text'><%log.remark%></div>
            </div>
            <div class='fui-list-angle'>
              <%log.createtime%>

            </div>

        </div>
        <%/each%>
    </script>

    <script language='javascript'>require(['biz/member/logyj'], function (modal) {
        modal.init({type:"<?php  echo $_GPC['type'];?>"});
    });
	</script>
    <?php  $this->footerMenus()?>
</div>

<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>