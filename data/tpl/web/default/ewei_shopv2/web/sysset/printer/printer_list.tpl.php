<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<div class="page-heading"> 
    <span class='pull-right'>
            <?php if(cv('sysset.printer.printer_add')) { ?>
               <a class='btn btn-primary btn-sm' href="<?php  echo webUrl('sysset/printer/printer_add')?>"><i class="fa fa-plus"></i> 添加打印机</a>
              <?php  } ?>

    </span>
    <h2>小票打印机管理</h2> </div>

<form action="" method="post">


  <form action="./index.php" method="get" class="form-horizontal form-search" role="form">
                <input type="hidden" name="c" value="site" />
                <input type="hidden" name="a" value="entry" />
                <input type="hidden" name="m" value="ewei_shopv2" />
                <input type="hidden" name="do" value="web" />
                <input type="hidden" name="r"  value="sysset.printer.printer_list" />
<div class="page-toolbar row m-b-sm m-t-sm">
                            <div class="col-sm-4">

			   <div class="input-group-btn">
			        <button class="btn btn-default btn-sm"  type="button" data-toggle='refresh'><i class='fa fa-refresh'></i></button>


				<?php if(cv('sysset.printer.printer_delete')) { ?>
			        <button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle='batch-remove' data-confirm="确认要删除?" data-href="<?php  echo webUrl('sysset/printer/printer_delete')?>"><i class='fa fa-trash'></i> 删除</button>
					<?php  } ?>

			   </div>
                               </div>


                            <div class="col-sm-6 pull-right">


				<div class="input-group">
                                        <input type="text" class="input-sm form-control" name='keyword' value="<?php  echo $_GPC['keyword'];?>" placeholder="请输入关键词"> <span class="input-group-btn">

                                     <button class="btn btn-sm btn-primary" type="submit"> 搜索</button> </span>
                                </div>

                            </div>
</div>
  </form>


<?php  if(count($list)>0) { ?>
            <table class="table table-responsive table-hover">
                <thead>
                    <tr>
                          <th style="width:25px;"><input type='checkbox' /></th>
                        <th >打印机名称</th>
                        <th style="text-align: center;">打印机品牌</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php  if(is_array($list)) { foreach($list as $row) { ?>
                    <tr><td>
									<input type='checkbox'   value="<?php  echo $row['id'];?>"/>
							</td>
                        <td><?php  echo $row['title'];?></td>
                        <td style="text-align: center;">
                            <span class="label label-success"><?php echo isset($printer[$row['type']]) ? $printer[$row['type']] : '未知';?></span>
                        </td>
                        <td>
                            <?php if(cv('sysset.printer.printer_edit')) { ?>
                            <a class='btn btn-default  btn-sm' href="<?php  echo webUrl('sysset/printer/printer_edit', array('id' => $row['id']))?>" ><i class='fa fa-edit'></i> <?php if(cv('sysset.printer.printer_edit')) { ?>编辑<?php  } else { ?>查看<?php  } ?></a><?php  } ?>
                            <?php if(cv('sysset.printer.printer_delete')) { ?><a class='btn btn-default  btn-sm'  data-toggle='ajaxRemove' href="<?php  echo webUrl('sysset/printer/printer_delete', array('id' => $row['id']))?>" data-confirm="确认删除此模板吗？" ><i class='fa fa-trash'></i> 删除</a><?php  } ?>
                    </tr>
                    <?php  } } ?>
                 
                </tbody>
            </table>
    <?php  echo $pager;?>
               <?php  } else { ?>
<div class='panel panel-default'>
	<div class='panel-body' style='text-align: center;padding:30px;'>
		 暂时没有任何小票打印机!
	</div>
</div>
<?php  } ?>
  
         </div>
 
</form>
 
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>
