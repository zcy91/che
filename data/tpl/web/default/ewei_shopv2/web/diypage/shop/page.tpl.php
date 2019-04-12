<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<div class="page-heading">
    <h2>商城页面设置</h2>
</div>

<form action="" <?php if(cv('diypage.shop.page.save')) { ?>method="post"<?php  } ?> class="form-horizontal form-validate">

    <div class="alert alert-danger">注意：商城页面如果是diy页面，自定义菜单请至diy页面编辑中设置。</div>


    <div class="form-group-title">系统页面</div>

    <div class="form-group">
        <label class="col-sm-2 control-label">商城首页</label>
        <div class="col-sm-9 col-xs-12">
            <select class="form-control valid" <?php if(cv('diypage.shop.page.save')) { ?>name="page[home]"<?php  } else { ?> disabled<?php  } ?>>
                <option value="">系统默认</option>
                <?php  if(is_array($home_list)) { foreach($home_list as $item) { ?>
                <option value="<?php  echo $item['id'];?>" <?php  if($data['page']['home']==$item['id']) { ?>selected="selected"<?php  } ?>><?php  echo $item['name'];?></option>
                <?php  } } ?>
            </select>
        </div>
    </div>

    <?php  if($_W['plugin']!='merch' && !isset($_W['merch'])) { ?>
        <div class="form-group">
            <label class="col-sm-2 control-label">会员中心</label>
            <div class="col-sm-9 col-xs-12">
                <select class="form-control valid" <?php if(cv('diypage.shop.page.save')) { ?>name="page[member]"<?php  } else { ?> disabled<?php  } ?>>
                <option value="">系统默认</option>
                <?php  if(is_array($member_list)) { foreach($member_list as $item) { ?>
                <option value="<?php  echo $item['id'];?>" <?php  if($data['page']['member']==$item['id']) { ?>selected="selected"<?php  } ?>><?php  echo $item['name'];?></option>
                <?php  } } ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">商品详情</label>
            <div class="col-sm-9 col-xs-12">
                <select class="form-control valid" <?php if(cv('diypage.shop.page.save')) { ?>name="page[detail]"<?php  } else { ?> disabled<?php  } ?>>
                <option value="">系统默认</option>
                <?php  if(is_array($detail_list)) { foreach($detail_list as $item) { ?>
                <option value="<?php  echo $item['id'];?>" <?php  if($data['page']['detail']==$item['id']) { ?>selected="selected"<?php  } ?>><?php  echo $item['name'];?></option>
                <?php  } } ?>
                </select>
                <span class="help-block">提示：单商品模板设置请到商品设置中设置，商品详情页不支持自定义商城菜单</span>
            </div>
        </div>
    <?php  } ?>

    <div class="form-group-title">应用页面</div>

    <?php  if($_W['plugin']!='merch' && !isset($_W['merch'])) { ?>
        <?php  if(p('commission')) { ?>
            <div class="form-group">
                <label class="col-sm-2 control-label">分销中心</label>
                <div class="col-sm-9 col-xs-12">
                    <select class="form-control valid" <?php if(cv('diypage.shop.page.save')) { ?>name="page[commission]"<?php  } else { ?> disabled<?php  } ?>>
                    <option value="">系统默认</option>
                    <?php  if(is_array($commission_list)) { foreach($commission_list as $item) { ?>
                    <option value="<?php  echo $item['id'];?>" <?php  if($data['page']['commission']==$item['id']) { ?>selected="selected"<?php  } ?>><?php  echo $item['name'];?></option>
                    <?php  } } ?>
                    </select>
                </div>
            </div>
        <?php  } ?>

        <?php  if(p('creditshop')) { ?>
            <div class="form-group">
                <label class="col-sm-2 control-label">积分商城</label>
                <div class="col-sm-9 col-xs-12">
                    <select class="form-control valid" <?php if(cv('diypage.shop.page.save')) { ?>name="page[creditshop]"<?php  } else { ?> disabled<?php  } ?>>
                    <option value="">系统默认</option>
                    <?php  if(is_array($creditshop_list)) { foreach($creditshop_list as $item) { ?>
                    <option value="<?php  echo $item['id'];?>" <?php  if($data['page']['creditshop']==$item['id']) { ?>selected="selected"<?php  } ?>><?php  echo $item['name'];?></option>
                    <?php  } } ?>
                    </select>
                </div>
            </div>
        <?php  } ?>

        <?php  if(p('seckill')) { ?>
            <div class="form-group">
                <label class="col-sm-2 control-label">整点秒杀</label>
                <div class="col-sm-9 col-xs-12">
                    <select class="form-control valid" <?php if(cv('diypage.shop.page.save')) { ?>name="page[seckill]"<?php  } else { ?> disabled<?php  } ?>>
                    <option value="">系统默认</option>
                    <?php  if(is_array($seckill_list)) { foreach($seckill_list as $item) { ?>
                    <option value="<?php  echo $item['id'];?>" <?php  if($data['page']['seckill']==$item['id']) { ?>selected="selected"<?php  } ?>><?php  echo $item['name'];?></option>
                    <?php  } } ?>
                    </select>
                    <span class="help-block">提示：这里是统一设置秒杀会场的页面样式，可以在会场管理中单独设置</span>
                </div>
            </div>
        <?php  } ?>

        <?php  if(p('exchange')) { ?>
            <div class="form-group">
                <label class="col-sm-2 control-label">兑换中心</label>
                <div class="col-sm-9 col-xs-12">
                    <select class="form-control valid" <?php if(cv('diypage.shop.page.save')) { ?>name="page[exchange]"<?php  } else { ?> disabled<?php  } ?>>
                    <option value="">系统默认</option>
                    <?php  if(is_array($exchange_list)) { foreach($exchange_list as $item) { ?>
                        <option value="<?php  echo $item['id'];?>" <?php  if($data['page']['exchange']==$item['id']) { ?>selected="selected"<?php  } ?>><?php  echo $item['name'];?></option>
                    <?php  } } ?>
                    </select>
                    <span class="help-block">提示：这里是统一设置兑换任务的页面样式，可以在兑换任务中单独设置</span>
                </div>
            </div>
        <?php  } ?>

    <?php  } ?>

    <?php if(cv('diypage.shop.page.save')) { ?>
        <div class="form-group">
            <label class="col-sm-2 control-label"></label>
            <div class="col-sm-9 col-xs-12">
                <input type="submit" value="提交" class="btn btn-primary"/>
            </div>
        </div>
    <?php  } ?>

</form>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>