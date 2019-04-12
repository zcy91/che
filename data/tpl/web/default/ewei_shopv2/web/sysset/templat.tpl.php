<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<div class="page-heading"> <h2>模板设置</h2> </div>
 
    <form action="" method="post" class="form-horizontal form-validate" enctype="multipart/form-data" >
 
 
                <div class="form-group">
                    <label class="col-sm-2 control-label">模板选择</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if(cv('sysset.template.edit')) { ?>
                        <select class='form-control' name='data[style]'>
                            <?php  if(is_array($styles)) { foreach($styles as $style) { ?>
                            <option value='<?php  echo $style;?>' <?php  if($style==$data['style']) { ?>selected<?php  } ?>><?php  echo $style;?></option>
                            <?php  } } ?>
                        </select>
                        <?php  } else { ?>
                        <input type="hidden" name="shop[style]" value="<?php  echo $set['shop']['style'];?>"/>
                        <div class='form-control-static'>
                            <?php  if(empty($data['style'])) { ?>default<?php  } else { ?><?php  echo $data['style'];?><?php  } ?>
                        </div>
                        <?php  } ?>
                    </div>
                </div> 

            <div class="form-group">
                    <label class="col-sm-2 control-label"></label>
                    <div class="col-sm-9 col-xs-12">
                           <?php if(cv('sysset.template.edit')) { ?>
                            <input type="submit" value="提交" class="btn btn-primary"  /> 
             
                          <?php  } ?>
                     </div>
            </div>
    
    </form>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>     