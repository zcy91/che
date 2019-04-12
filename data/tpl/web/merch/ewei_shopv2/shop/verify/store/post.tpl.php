<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>

<div class="page-heading"> 
	
	<span class='pull-right'>
		
		<?php if(mcv('shop.verify.store.add')) { ?>
                            <a class="btn btn-primary btn-sm" href="<?php  echo merchUrl('shop/verify/store/add')?>">添加新门店</a>
		<?php  } ?>
                
		<a class="btn btn-default  btn-sm" href="<?php  echo merchUrl('shop/verify/store')?>">返回列表</a>
                
                
	</span>
	<h2><?php  if(!empty($item['id'])) { ?>编辑<?php  } else { ?>添加<?php  } ?>门店 <small><?php  if(!empty($item['id'])) { ?>修改【<?php  echo $item['storename'];?>】<?php  } ?></small></h2> 
</div>
 
    <form <?php if( mce('shop.verify.store' ,$item) ) { ?>action="" method="post"<?php  } ?> class="form-horizontal form-validate" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php  echo $item['id'];?>" />
    
                <div class="form-group">
                    <label class="col-sm-2 control-label must">门店名称</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if( mce('shop.verify.store' ,$item) ) { ?>
                        <input type="text" name="storename" class="form-control" value="<?php  echo $item['storename'];?>" data-rule-required="true" />
                        <?php  } else { ?>
                        <div class='form-control-static'><?php  echo $item['storename'];?></div>
                        <?php  } ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">门店LOGO</label>
                    <div class="col-sm-9 col-xs-12">
                          <?php if( mce('shop.verify.store' ,$item) ) { ?>
                               <?php  echo tpl_form_field_image('logo',$item['logo'],'',array('dest_dir'=>'merch/'.$_W['merchid']))?>
                               <?php  } else { ?>
                        <?php  if(!empty($item['logo'])) { ?>
	                        <a href='<?php  echo tomedia($item['logo'])?>' target='_blank'>
	                           <img src="<?php  echo tomedia($item['logo'])?>" style='width:100px;border:1px solid #ccc;padding:1px' />
	                        </a>
                        <?php  } ?>
			<?php  } ?>
                    </div>
                </div>
	
               <div class="form-group">
                    <label class="col-sm-2 control-label">门店地址</label>
                    <div class="col-sm-9 col-xs-12">
                            <?php if( mce('shop.verify.store' ,$item) ) { ?>
                        <input type="text" name="address" class="form-control" value="<?php  echo $item['address'];?>" />
                               <?php  } else { ?>
                        <div class='form-control-static'><?php  echo $item['address'];?></div>
                        <?php  } ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">门店电话</label>
                    <div class="col-sm-9 col-xs-12">
                               <?php if( mce('shop.verify.store' ,$item) ) { ?>
                        <input type="text" name="tel" class="form-control" value="<?php  echo $item['tel'];?>" />
                               <?php  } else { ?>
                        <div class='form-control-static'><?php  echo $item['tel'];?></div>
                        <?php  } ?>
                    </div>
                </div>
	 <div class="form-group">
                    <label class="col-sm-2 control-label">营业时间</label>
                    <div class="col-sm-9 col-xs-12">
                            <?php if( mce('shop.verify.store' ,$item) ) { ?>
                        <input type="text" name="saletime" class="form-control" value="<?php  echo $item['saletime'];?>" />
                               <?php  } else { ?>
                        <div class='form-control-static'><?php  echo $item['saletime'];?></div>
                        <?php  } ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">门店位置</label>
                    <div class="col-sm-9 col-xs-12">
                               <?php if( mce('shop.verify.store' ,$item) ) { ?>
                        <?php  echo tpl_form_field_coordinate('map',array('lng'=>$item['lng'],'lat'=>$item['lat']))?>
                               <?php  } else { ?>
                        <div class='form-control-static'>lng=<?php  echo $item['lng'];?>,lat=<?php  echo $item['lat'];?></div>
                        <?php  } ?>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">门店支持</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if( mce('shop.verify.store' ,$item) ) { ?>
                        <label class='radio-inline'>
                            <input type='radio' name='type' value='1' <?php  if($item['type']==1) { ?>checked<?php  } ?> /> 支持自提
                        </label>

                        <label class='radio-inline'>
                            <input type='radio' name='type' value='2' <?php  if($item['type']==2) { ?>checked<?php  } ?> /> 支持核销
                        </label>

                        <label class='radio-inline'>
                            <input type='radio' name='type' value='3' <?php  if($item['type']==3) { ?>checked<?php  } ?> /> 支持自提+核销
                        </label>
                        <?php  } else { ?>
                        <div class='form-control-static'><?php  if($item['type']==1) { ?>支持自提<?php  } else if($item['type']==2) { ?>支持核销<?php  } else if($item['type']==3) { ?>支持自提+核销<?php  } ?></div>
                        <?php  } ?>
                    </div>
                </div>

                <div class="form-group" id="pick_info" <?php  if(empty($item['type']) || $item['type']==2) { ?>style="display:none;"<?php  } ?>>
                    <label class="col-sm-2 control-label">自提信息</label>
                    <div class="col-sm-10 col-xs-12">
                        <?php if( mce('shop.verify.store' ,$item) ) { ?>


                        <label class="radio-inline" style="float: left;padding-left:0px;">联系人</label>

                        <div class="col-sm-9 col-xs-12" style="width: 120px; float: left; margin: 0px 20px 0px -5px;">
                            <input type="text" value="<?php  echo $item['realname'];?>" class="form-control" name="realname" style="width:120px;padding:5px;">
                        </div>

                        <label class="radio-inline" style="float: left;">联系电话</label>
                        <div class="col-sm-9 col-xs-12" style="width: 120px; float: left; margin: 0px 20px 0px -5px;">
                            <input type="text" value="<?php  echo $item['mobile'];?>" class="form-control" name="mobile" style="width:120px;padding:5px;">
                        </div>
						
		    <label class="radio-inline" style="float: left;">自提时间</label>
                        <div class="col-sm-9 col-xs-12" style="width: 200px; float: left; margin: 0px 0px 0px -5px;">
                            <input type="text" value="<?php  echo $item['fetchtime'];?>" class="form-control" name="fetchtime" style="width:200px;padding:5px;">
                        </div>

                        <?php  } else { ?>
                        <div class='form-control-static'>联系人:<?php  echo $item['realname'];?> 联系电话:<?php  echo $item['mobile'];?></div>
                        <?php  } ?>
                    </div>
                </div>


               <div class="form-group">
                    <label class="col-sm-2 control-label">门店简介</label>
                    <div class="col-sm-9 col-xs-12">
                            <?php if( mce('shop.verify.store' ,$item) ) { ?>
                         <textarea name="desc" class="form-control richtext" cols="70"><?php  echo $item['desc'];?></textarea>
                               <?php  } else { ?>
                        <div class='form-control-static'><?php  echo $item['desc'];?></div>
                        <?php  } ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">状态</label>
                    <div class="col-sm-9 col-xs-12">
                               <?php if( mce('shop.verify.store' ,$item) ) { ?>
                        <label class='radio-inline'>
                            <input type='radio' name='status' value=1' <?php  if($item['status']==1) { ?>checked<?php  } ?> /> 启用
                        </label>
                        <label class='radio-inline'>
                            <input type='radio' name='status' value=0' <?php  if($item['status']==0) { ?>checked<?php  } ?> /> 禁用
                        </label>
                               <?php  } else { ?>
                        <div class='form-control-static'><?php  if($item['status']==1) { ?>启用<?php  } else { ?>禁用<?php  } ?></div>
                        <?php  } ?>
                    </div>
                </div>
                
                      <div class="form-group"></div>
            <div class="form-group">
                    <label class="col-sm-2 control-label"></label>
                    <div class="col-sm-9 col-xs-12">
                           <?php if( mce('shop.verify.store' ,$item) ) { ?>
                            <input type="submit" value="提交" class="btn btn-primary"  />
                            
                        <?php  } ?>
                       <input type="button" name="back" onclick='history.back()' <?php if(mcv('shop.verify.store.add|shop.verify.store.edit')) { ?>style='margin-left:10px;'<?php  } ?> value="返回列表" class="btn btn-default" />
                    </div>
            </div>
 </form>
<script language='javascript'>
    $(function () {
        $(':radio[name=type]').click(function () {
            type = $("input[name='type']:checked").val();

            if(type=='1' || type=='3'){
                $('#pick_info').show();
            } else {
                $('#pick_info').hide();
            }
        })
    })
    </script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>