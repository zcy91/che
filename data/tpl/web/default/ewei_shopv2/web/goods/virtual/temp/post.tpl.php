<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>

<div class="page-heading"> 

    <span class='pull-right'>

        <?php if(cv('goods.virtual.temp.add')) { ?>
        <a class="btn btn-primary btn-sm" href="<?php  echo webUrl('goods/virtual/temp/add')?>">添加新模板</a>
        <?php  } ?>

        <a class="btn btn-default  btn-sm" href="<?php  echo webUrl('goods/virtual/temp')?>">返回列表</a>


    </span>
    <h2><?php  if(!empty($item['id'])) { ?>编辑<?php  } else { ?>添加<?php  } ?>模板 <small><?php  if(!empty($item['id'])) { ?>修改【<?php  echo $item['title'];?>】<?php  } ?></small></h2> 
</div>

<?php if( ce('goods.virtual.temp' ,$item) ) { ?>
<?php  if(!empty($_GPC['id'])) { ?>
<div class="alert alert-danger">警告：当模板中已经添加数据后改变模板结构有可能导致无法使用！</div>
<?php  } ?>
<?php  } ?>


<form action="" method="post" class="form-horizontal form-validate" enctype="multipart/form-data">
    <input type="hidden" name="tp_id" value="<?php  echo $item['id'];?>" />



    <div class="form-group">
        <label class="col-sm-2 control-label" > 分类</label>
        <div class="col-sm-9 col-xs-12">
            <?php if( ce('goods.virtual.temp' ,$item) ) { ?>
            <select name="cate" class="form-control">
                <option value=""></option>
                <?php  if(is_array($category)) { foreach($category as $c) { ?>
                <option value="<?php  echo $c['id'];?>" <?php  if($item['cate']==$c['id']) { ?>selected<?php  } ?>><?php  echo $c['name'];?></option>
                <?php  } } ?>
            </select>
            <?php  } else { ?>
            <?php  if(is_array($category)) { foreach($category as $c) { ?>
            <?php  if($item['cate']==$c['id']) { ?><?php  echo $c['name'];?><?php  } ?>
            <?php  } } ?>
            <?php  } ?>
        </div> 
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label must" >模版名称</label>
        <div class="col-sm-9 col-xs-12">
            <?php if( ce('goods.virtual.temp' ,$item) ) { ?>
            <input type="text" name="tp_title" class="form-control" value="<?php  echo $item['title'];?>" placeholder="模版名称，例：话费充值卡" data-rule-required='true' />
            <?php  } else { ?>
            <div class='form-control-static'><?php  echo $item['title'];?></div>
            <?php  } ?>
        </div> 
    </div>
    <?php  $key="key";?>
    <?php  $name= $item['fields']['key'];?>
    <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('goods/virtual/temp/tpl', TEMPLATE_INCLUDEPATH)) : (include template('goods/virtual/temp/tpl', TEMPLATE_INCLUDEPATH));?>

    <?php  if(is_array($item['fields'])) { foreach($item['fields'] as $key => $name) { ?>
    <?php  if($key!='key') { ?>
       <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('goods/virtual/temp/tpl', TEMPLATE_INCLUDEPATH)) : (include template('goods/virtual/temp/tpl', TEMPLATE_INCLUDEPATH));?>
    <?php  } ?>
    <?php  } } ?>

    <div id="type-items"></div>
    <?php  if($datacount<=0) { ?>
    <?php if( ce('goods.virtual.temp' ,$item) ) { ?>
    <div class="form-group">
        <label class="col-sm-2 control-label" ></label>
        <div class="col-sm-9 col-xs-12">
            <a class="btn btn-default btn-add-type" href="javascript:;" onclick="addType();"><i class="fa fa-plus" title=""></i> 增加一条键</a>
        </div>
    </div>
    <?php  } ?>
    <?php  } ?>




    <div class="form-group">
        <label class="col-sm-2 control-label" ></label>
        <div class="col-sm-9 col-xs-12">
            <?php if( ce('goods.virtual.temp' ,$item) ) { ?>
            <input type="submit" value="提交" class="btn btn-primary"  />
            
            <?php  } ?>
            <a href="<?php  echo webUrl('goods/virtual/temp')?>"  <?php if( ce('goods.virtual.temp' ,$item) ) { ?>style='margin-left:10px;'<?php  } ?>><span class="btn btn-default" style='margin-left:10px;'>返回列表</span></a>
        </div>
    </div>

</form>
<script language='javascript'>
    var kw = 1;
    function addType() {
        $(".btn-add-type").button("loading");
        $.ajax({
            url: "<?php  echo webUrl('goods/virtual/temp/tpl')?>&kw=" + kw,
            cache: false
        }).done(function (html) {
            $(".btn-add-type").button("reset");
            $("#type-items").append(html);
        });
        kw++;
    }

    function removeType(obj) {
        $(obj).parent().remove();
    }

    $('form').submit(function () {


        var check = true;
        $("input[type=text]").each(function () {
            var val = $(this).val();
            if (!val) {
                $('form').validate('false');
                $(this).focus();
                tip.msgbox.err('不能为空');
                check = false;

                return false;
            }
        });
        if (!check) {
            $('form').attr('stop', 1);
            return false;
        }
        $('form').removeAttr('stop');
        var o = {}; // 判断重复
        $("input[mk=1]").each(function () {
            if (!(o[$(this).val()])) {
                o[$(this).val()] = true;
            } else {
                var val = $(this).val();
                $("input[mk=1]").each(function () {
                    if ($(this).val() == val) {
                        $(this).css("border-color", "#f01");
                    } else {
                        $(this).css("border-color", "#ccc");
                    }
                });
                tip.msgbox.err("红圈里的数据不能重复");

                check = false;
                return false;
            }
        });
        if (!check) {
            $('form').attr('stop', 1);
            return false;
        }
        $('form').removeAttr('stop');
        return check;
    });

</script>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>
