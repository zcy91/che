<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>


<div class="page-heading"><h2>评论管理</h2> </div>

<form action="./merchant.php" method="get" class="form-horizontal form-search" role="form">
    <input type="hidden" name="c" value="site" />
    <input type="hidden" name="a" value="entry" />
    <input type="hidden" name="m" value="ewei_shopv2" />
    <input type="hidden" name="do" value="web" />
    <input type="hidden" name="r"  value="shop.comment" />

    <div class="page-toolbar row m-b-sm m-t-sm">
        <div class="col-sm-3">

            <div class="input-group-btn">
                <button class="btn btn-default btn-sm"  type="button" data-toggle='refresh'><i class='fa fa-refresh'></i></button>
                <?php if(mcv('shop.comment.delete')) { ?>
                <button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle='batch-remove' data-confirm="确认要删除?" data-href="<?php  echo merchUrl('shop/comment/delete')?>"><i class='fa fa-trash'></i> 删除</button>
                <?php  } ?>


            </div>
        </div>


        <div class="col-sm-9 pull-right">

            <div class='input-group input-group-sm'  style='float:left;'  >
                <?php  echo tpl_daterange('time', array('sm'=>true,'placeholder'=>'请选择评论时间'),true);?>
            </div>

            <select name='replystatus' class='form-control input-sm select-sm'>
                <option value='' <?php  if($_GPC['replystatus']=='') { ?>selected<?php  } ?>>状态</option>
                <option value='0' <?php  if($_GPC['replystatus']=='0') { ?>selected<?php  } ?>>需要首次回复</option>
                <option value='1' <?php  if($_GPC['replystatus']=='1') { ?>selected<?php  } ?> >需要追加回复</option>
            </select>

            <!--select name='fade' class='form-control input-sm select-sm'>
                <option value='' <?php  if($_GPC['fade']=='') { ?>selected<?php  } ?>>类型</option>
                <option value='0' <?php  if($_GPC['fade']=='0') { ?>selected<?php  } ?>>模拟评价</option>
                <option value='1' <?php  if($_GPC['fade']=='1') { ?>selected<?php  } ?> >真实评价</option>
            </select-->
            <div class="input-group">
                <input type="text" class="input-sm form-control" name='keyword' value="<?php  echo $_GPC['keyword'];?>" placeholder="订单号/商品"> <span class="input-group-btn">
                    		
                    <button class="btn btn-sm btn-primary" type="submit"> 搜索</button> </span>
            </div>

        </div>
    </div>
</form>


<?php  if(count($list)>0) { ?>
<table class="table table-hover table-responsive">
    <thead>
    <tr>
        <th style="width:25px;"><input type='checkbox' /></th>
        <th style='width:50px;'>商品</th>
        <th style='width:100px;'></th>
        <th style='width:100px;'>评价者</th>
        <th style='width:95px;'>评分等级</th>
        <th style='width:90px;'>评价状态</th>
        <th style='width:90px;'>回复状态</th>
        <th style='width:100px;'>审核状态</th>
        <th style='width:90px;'>评价时间</th>
        <th style='width:300px;'>操作</th>
    </tr>
    </thead>
    <tbody>
    <?php  if(is_array($list)) { foreach($list as $row) { ?>
    <tr>

        <td>
            <input type='checkbox'   value="<?php  echo $row['id'];?>"/>
        </td>
        <td>
            <img src="<?php  echo tomedia($row['thumb'])?>" style="width: 30px; height: 30px;border:1px solid #ccc;padding:1px;">
        </td>
        <td>

            <?php  echo $row['title'];?><br/><small><?php  if(empty($row['openid'])) { ?>模拟评价<?php  } else { ?><?php  echo $row['ordersn'];?><?php  } ?></small>
        </td>
        <td >
            <span data-toggle='tooltip' title='<?php  echo $row['nickname'];?>'><img src="<?php  echo tomedia($row['headimgurl'])?>" style="width: 30px; height: 30px;border:1px solid #ccc;padding:1px;">
            <?php  echo $row['nickname'];?></span></td>
        <td style="color:#ff6600">
            <?php  if($row['level']>=1) { ?><i class='fa fa-star'></i><?php  } else { ?><i class='fa fa-star-o'></i><?php  } ?>
            <?php  if($row['level']>=2) { ?><i class='fa fa-star'></i><?php  } else { ?><i class='fa fa-star-o'></i><?php  } ?>
            <?php  if($row['level']>=3) { ?><i class='fa fa-star'></i><?php  } else { ?><i class='fa fa-star-o'></i><?php  } ?>
            <?php  if($row['level']>=4) { ?><i class='fa fa-star'></i><?php  } else { ?><i class='fa fa-star-o'></i><?php  } ?>
            <?php  if($row['level']>=5) { ?><i class='fa fa-star'></i><?php  } else { ?><i class='fa fa-star-o'></i><?php  } ?>
        </td>

        <td>
            <?php  if(!empty($row['append_content'])) { ?>
            <label class='label label-warning'>追加了评价</label>
            <?php  } else { ?>
            <label class='label label-primary'>首次回复</label>
            <?php  } ?>
        </td>
        <td>
            <?php  if(empty($row['reply_content'])) { ?>
            <label class='label label-danger'>未首次回复</label>
            <?php  } else { ?>
            <label class='label label-danger'>已首次回复</label>
            <?php  } ?>
            <br/>
            <?php  if(!empty($row['append_content'])) { ?>
                <?php  if(empty($row['append_reply_content'])) { ?>
                <label class='label label-warning'>未追加回复</label>
                <?php  } ?>
            <?php  } ?>
        </td>
        <td   style="overflow:visible;">
            <span class='label <?php  if($row['checked']==0) { ?>label-success<?php  } else if($row['checked']==1) { ?>label-warning<?php  } else if($row['checked']==2) { ?>label-danger<?php  } ?>'>
            <?php  if($row['checked']==0) { ?>首次评价通过<?php  } else if($row['checked']==1) { ?>首次评价审核中<?php  } else if($row['checked']==2) { ?>首次评价不通过<?php  } ?></span>
            <?php  if(!empty($row['append_content'])) { ?>
                <br>
                <span class='label <?php  if($row['replychecked']==0) { ?>label-success<?php  } else if($row['replychecked']==1) { ?>label-warning<?php  } else if($row['replychecked']==2) { ?>label-danger<?php  } ?>'>
                <?php  if($row['replychecked']==0) { ?>追加评价通过<?php  } else if($row['replychecked']==1) { ?>追加评价审核中<?php  } else if($row['replychecked']==2) { ?>追加评价不通过<?php  } ?></span>
            <?php  } ?>
        </td>
        <td >
            <?php  echo date('Y-m-d', $row['createtime'])?><br/><?php  echo date('H:i:s', $row['createtime'])?>
        </td>
        <td>
            <a class='btn btn-default btn-sm'  href="<?php  echo merchUrl('shop/comment/post', array('id' => $row['id'], 'type' => 1))?>" title='进行回复'>审核</a>

            <?php  if(!empty($row['openid'])) { ?>
                <?php if(mcv('shop.comment.post')) { ?>
                <a class='btn btn-default btn-sm'  href="<?php  echo merchUrl('shop/comment/post', array('id' => $row['id']))?>" title='进行回复'><i class="fa fa-reply"></i> 回复</a>
                <?php  } ?>
            <?php  } else { ?>
                <?php if(mcv('shop.comment.edit')) { ?>
                <a class='btn btn-default btn-sm'  href="<?php  echo merchUrl('shop/comment/edit', array( 'id' => $row['id']))?>" title='修改评价'><i class="fa fa-edit"></i> 编辑</a>
                <?php  } ?>
            <?php  } ?>

            <?php if(mcv('shop.comment.add')) { ?>
            <!--a class='btn btn-default  btn-sm'  href="<?php  echo merchUrl('shop/comment/add', array( 'goodsid' => $row['goodsid']))?>" title='添加此商品评价'><i class="fa fa-plus"></i> 添加</a-->
            <?php  } ?>
            <?php if(mcv('shop.comment.delete')) { ?>
            <a class='btn btn-default  btn-sm'  data-toggle='ajaxRemove'   href="<?php  echo merchUrl('shop/comment/delete', array('id' => $row['id']))?>" data-confirm="确认删除此评价吗？"><i class="fa fa-trash"></i> 删除</a>
            <?php  } ?>
        </td>
    </tr>
    <?php  } } ?>
    </tbody>
</table>
<?php  echo $pager;?>
<?php  } else { ?>
<div class='panel panel-default'>
    <div class='panel-body' style='text-align: center;padding:30px;'>
        暂时没有任何评价!
    </div>
</div>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>