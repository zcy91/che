<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<style>
    .input-group-sm .btn {padding: 4px 6px;}
    .trhead {border-left: 1px solid #e7eaec; border-right: 1px solid #e7eaec; background:#f8f8f8;}
    .trhead.bottom {border-bottom: 1px solid #e7eaec;}
    .trbody {border-bottom: 1px solid #e7eaec; border-right: 1px solid #e7eaec;}
    .trbody td {border-left: 1px solid #e7eaec;}
    .popover {font-family: '微软雅黑'; font-size: 12px;}
    .label {padding: 3px 5px;}
</style>

<div class="page-heading">
    <!--<span class="pull-right">
        <a class="btn btn-primary btn-sm" href="<?php  echo webUrl('creditshop/comment/add')?>"><i class="fa fa-plus"></i> 添加评价</a>
    </span>-->
    <h2>评价管理 <small>总数: <?php  echo $total;?></small></h2>
</div>

<form action="./index.php" method="get" class="form-horizontal form-search" role="form">
    <input type="hidden" name="c" value="site" />
    <input type="hidden" name="a" value="entry" />
    <input type="hidden" name="m" value="ewei_shopv2" />
    <input type="hidden" name="do" value="web" />
    <input type="hidden" name="r"  value="creditshop.comment" />
    <div class="page-toolbar row m-b-sm m-t-sm">
        <div class="col-sm-2">
            <div class="input-group-btn">
                <button class="btn btn-default btn-sm"  type="button" data-toggle='refresh'><i class='fa fa-refresh'></i></button>
                <?php if(cv('shop.comment.delete')) { ?>
                <button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle='batch-remove' data-confirm="确认要删除?" data-href="<?php  echo webUrl('shop/comment/delete')?>"><i class='fa fa-trash'></i> 删除</button>
                <?php  } ?>
            </div>
        </div>
        <div class="col-sm-10 pull-right">
            <div class='input-group input-group-sm'  style='float:left;'  >
                <?php  echo tpl_daterange('time', array('sm'=>true,'placeholder'=>'请选择评论时间'),true);?>
            </div>
            <select name='replystatus' class='form-control input-sm select-sm' style="width: 120px; padding: 0 6px;">
                <option value='0' <?php  if($_GPC['replystatus']=='') { ?>selected<?php  } ?>>评论状态</option>
                <option value='1' <?php  if($_GPC['replystatus']=='1') { ?>selected<?php  } ?>>首评待审核</option>
                <option value='2' <?php  if($_GPC['replystatus']=='2') { ?>selected<?php  } ?> >追评待审核</option>
                <option value='2' <?php  if($_GPC['replystatus']=='3') { ?>selected<?php  } ?>>首评待回复</option>
                <option value='4' <?php  if($_GPC['replystatus']=='4') { ?>selected<?php  } ?> >追评待回复</option>
            </select>
            <select name='virtual' class='form-control input-sm select-sm' style="padding: 0 6px;">
                <option value='' <?php  if($_GPC['virtual']=='') { ?>selected<?php  } ?>>评论类型</option>
                <option value='1' <?php  if($_GPC['virtual']=='1') { ?>selected<?php  } ?> >真实评价</option>
                <option value='0' <?php  if($_GPC['virtual']=='0') { ?>selected<?php  } ?>>模拟评价</option>
            </select>
            <div class="input-group">
                <input type="text" class="input-sm form-control" name='keyword' value="<?php  echo $_GPC['keyword'];?>" placeholder="参与记录/商品"> <span class="input-group-btn">
                    <button class="btn btn-sm btn-primary" type="submit"> 搜索</button> </span>
            </div>
        </div>
    </div>
</form>

<?php  if(empty($list)) { ?>
    <div class="panel panel-default">
        <div class="panel-body" style="text-align: center;padding:30px;">
            未查询到相关评价!
        </div>
    </div>
<?php  } else { ?>
    <table class="table table-hover table-responsive">
        <thead>
        <tr>
            <th><input type="checkbox"> 商品信息</th>
            <th style="width: 130px;">评价人</th>
            <th style="width: 80px; text-align: center;">评分等级</th>
            <th style="width:90px; text-align: center;">评价状态</th>
            <th style="width:90px; text-align: center;">回复状态</th>
            <th style="width:110px; text-align: center;">审核状态</th>
            <th style="width: 60px;">时间</th>
            <th style="width: 115px; text-align: center;">操作</th>
        </tr>
        </thead>
        <tbody>
        <tr style=" background: none;">
            <td colspan="8" style="height:20px;padding:0;border-top:none;"></td>
        </tr>

        <?php  if(is_array($list)) { foreach($list as $item) { ?>
        <tr class="trhead">
            <td colspan="7"><input type="checkbox" value="109"> <?php  if(empty($item['virtual'])) { ?>参与记录编号: <?php  echo $item['logno'];?><?php  } else { ?>虚拟评价<?php  } ?></td>
            <td colspan="1" style="text-align: right;">
                <?php  if(empty($item['virtual']) && ($item['checked']<1 || ($item['append_checked']<1) && (!empty($item['append_content'])||!empty($item['append_images'])))) { ?>
                    <label class="label label-default">待审核</label>
                <?php  } ?>
            </td>
        </tr>
        <tr class="trbody">
            <td data-toggle="tooltip" title="" data-original-title="<?php  echo $item['title'];?>">
                <a href="<?php  echo webUrl('creditshop/goods/edit', array('id'=>$item['goodsid']))?>" target="_blank"><img src="<?php  echo tomedia($item['thumb'])?>" style="width:30px; height:30px; border:1px solid #ccc;"> <?php  echo $item['title'];?></a>
            </td>
            <td data-toggle="tooltip" title="" data-original-title="<?php  echo $item['niackname'];?>">
                <?php  if(!empty($item['mid'])) { ?><a href="<?php  echo webUrl('member/list/detail', array('id'=>$item['mid']))?>" target="_blank"><?php  } ?>
                <img src="<?php  echo tomedia($item['headimg'])?>" style="width:30px; height:30px; border:1px solid #ccc;"> <?php  echo $item['nickname'];?>
                <?php  if(!empty($item['mid'])) { ?></a><?php  } ?>
            </td>
            <td style="text-align: center;">
                <label class="label label-danger"><?php  echo $item['level'];?> 颗星</label>
            </td>
            <td style="text-align: center; padding: 5px;">
                <?php  if(!empty($item['append_content'])) { ?>
                    <label class='label label-warning'>追加评价</label>
                <?php  } else { ?>
                    <label class='label label-default'>首次评价</label>
                <?php  } ?>
            </td>
            <td style="text-align: center;">
                <?php  if(!empty($item['reply_content']) || !empty($item['reply_images'])) { ?>
                     <label class="label label-danger">首评已回复</label>
                <?php  } else { ?>
                     <label class='label label-default'>首评待回复</label>
                <?php  } ?>
                <?php  if(!empty($item['append_content']) || !empty($item['append_images'])) { ?>
                    <br>
                    <?php  if(!empty($item['append_reply_content']) || !empty($item['append_reply_content'])) { ?>
                        <label class="label label-danger">追评已回复</label>
                    <?php  } else { ?>
                        <label class='label label-default'>追评待回复</label>
                    <?php  } ?>
                <?php  } ?>
            </td>
            <td style="text-align: center;">
                <?php  if(empty($item['virtual'])) { ?>
                    <?php  if(empty($item['checked'])) { ?>
                        <label class="label label-default">首次评价待审核</label>
                    <?php  } else if($item['checked']==1) { ?>
                        &nbsp;<label class="label label-danger">首次评价通过</label>
                    <?php  } else { ?>
                        &nbsp;<label class="label label-danger">首次评价不通过</label>
                    <?php  } ?>
                    <?php  if(!empty($item['append_content'])) { ?>
                        <br>
                        <?php  if(empty($item['append_checked'])) { ?>
                            <label class="label label-default">追加评价待审核</label>
                        <?php  } else if($item['append_checked']==1) { ?>
                            <label class="label label-danger">追加评价通过</label>
                        <?php  } else { ?>
                            <label class="label label-danger">追加评价不通过</label>
                        <?php  } ?>
                    <?php  } ?>
                <?php  } else { ?>
                    虚拟评价
                <?php  } ?>
            </td>
            <td>
                <a data-toggle="popover" data-html="true" data-placement="top" data-content="
                    <?php  if(!empty($item['time'])) { ?>首评时间: <?php  echo date('Y-m-d H:i:s', $item['time'])?><br><?php  } ?>
                    <?php  if(!empty($item['reply_time'])) { ?>首评回复: <?php  echo date('Y-m-d H:i:s', $item['reply_time'])?><br><?php  } ?>
                    <?php  if(!empty($item['append_time'])) { ?>追评时间: <?php  echo date('Y-m-d H:i:s', $item['append_time'])?><br><?php  } ?>
                    <?php  if(!empty($item['append_reply_time'])) { ?>追评回复: <?php  echo date('Y-m-d H:i:s', $item['append_reply_time'])?><?php  } ?>
                " data-trigger="focus" tabindex="0" role="button" data-original-title="" title="">查看 <i class="fa fa-question-circle"></i></a>
            </td>
            <td>
                <a class="btn btn-default btn-sm" href="<?php  echo webUrl('creditshop/comment/edit', array('id'=>$item['id']))?>" title="编辑"><i class="fa fa-edit"></i>
                    <?php  if(!empty($item['virtual'])) { ?>编辑
                    <?php  } else { ?>
                        <?php  if($item['checked']<1||$item['append_checked']<1) { ?>审核
                        <?php  } else if(empty($item['reply_content'])||((!empty($item['append_content'])||!empty($item['append_images']))&&empty($item['append_reply_content']))) { ?>回复
                        <?php  } else { ?>查看
                        <?php  } ?>
                    <?php  } ?>
                </a>
                <a class="btn btn-default  btn-sm" data-toggle="ajaxRemove" href="<?php  echo webUrl('creditshop/comment/delete', array('id'=>$item['id']))?>" data-confirm="确认删除此评价吗？"><i class="fa fa-trash"></i></a>
            </td>
        </tr>
        <tr style=" background: none;">
            <td colspan="8" style="height:20px;padding:0;border-top:none;"></td>
        </tr>

        <?php  } } ?>
        </tbody>
    </table>
<?php  } ?>



<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>