<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header-base', TEMPLATE_INCLUDEPATH)) : (include template('common/header-base', TEMPLATE_INCLUDEPATH));?>
	<?php  if(!empty($_W['uid'])) { ?>
		<?php  if(!empty($_W['uniacid'])) { ?>
			<div class="navbar navbar-inverse navbar-static-top" role="navigation" style="position:static;">
				<div class="container-fluid">
					<ul class="nav navbar-nav">
						<li><a href="./?refresh"><i class="fa fa-reply-all"></i>返回系统</a></li>
						<?php  global $top_nav;?>
						<?php  if(is_array($top_nav)) { foreach($top_nav as $nav) { ?>
							<?php  if(!empty($_W['isfounder']) || empty($_W['setting']['permurls']['sections']) || in_array($nav['name'], $_W['setting']['permurls']['sections'])) { ?><li<?php  if(FRAME == $nav['name']) { ?> class="active"<?php  } ?>><a href="<?php  echo url('home/welcome/' . $nav['name']);?>"><i class="<?php  echo $nav['append_title'];?>"></i><?php  echo $nav['title'];?></a></li><?php  } ?>
						<?php  } } ?>
						<li <?php  if($action == 'emulator') { ?>class="active"<?php  } ?>>
							<a href="<?php  echo url('utility/emulator');?>" target="_blank"><i class="fa fa-mobile"></i> 模拟测试</a>
						</li>
						<?php  if(IMS_FAMILY != 'x') { ?>
						<?php  } ?>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown topbar-notice">
							<a type="button" data-toggle="dropdown">
								<i class="fa fa-bell"></i>
								<span class="badge" id="notice-total">0</span>
							</a>
							<div class="dropdown-menu" aria-labelledby="dLabel">
								<div class="topbar-notice-panel">
									<div class="topbar-notice-arrow"></div>
									<div class="topbar-notice-head">
										<span>系统公告</span>
										<a href="<?php  echo url('article/notice-show/list');?>" class="pull-right">更多公告>></a>
									</div>
									<div class="topbar-notice-body">
										<ul id="notice-container"></ul>
									</div>
								</div>
							</div>
						</li>
						<li class="dropdown">
							<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" style="display:block; max-width:200px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; "><i class="fa fa-group"></i><?php  echo $_W['account']['name'];?> <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<?php  if($_W['role'] != 'operator') { ?>
								<li><a href="<?php  echo url('account/post', array('uniacid' => $_W['uniacid']));?>" target="_blank"><i class="fa fa-weixin fa-fw"></i> 编辑当前账号资料</a></li>
								<?php  } ?>
								<li><a href="<?php  echo url('account/display');?>" target="_blank"><i class="fa fa-cogs fa-fw"></i> 管理其它公众号</a></li>
								<li><a href="<?php  echo url('utility/emulator');?>" target="_blank"><i class="fa fa-mobile fa-fw"></i> 模拟测试</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" style="display:block; max-width:185px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; "><i class="fa fa-user"></i><?php  echo $_W['user']['username'];?> (<?php  if($_W['role'] == 'founder') { ?>系统管理员<?php  } else if($_W['role'] == 'manager') { ?>公众号管理员<?php  } else { ?>公众号操作员<?php  } ?>) <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="<?php  echo url('user/profile/profile');?>" target="_blank"><i class="fa fa-weixin fa-fw"></i> 我的账号</a></li>
								<?php  if($_W['role'] == 'founder') { ?>
								<li class="divider"></li>
								<li><a href="<?php  echo url('system/welcome');?>" target="_blank"><i class="fa fa-sitemap fa-fw"></i> 系统选项</a></li>
								<li><a href="<?php  echo url('system/welcome');?>" target="_blank"><i class="fa fa-cloud-download fa-fw"></i> 自动更新</a></li>
								<li><a href="<?php  echo url('system/updatecache');?>" target="_blank"><i class="fa fa-refresh fa-fw"></i> 更新缓存</a></li>
								<li class="divider"></li>
								<?php  } ?>
								<li><a href="<?php  echo url('user/logout');?>"><i class="fa fa-sign-out fa-fw"></i> 退出系统</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		<?php  } else { ?>
			<div class="navbar navbar-inverse navbar-static-top" role="navigation" style="z-index:1001;">
				<div class="container-fluid">
					<ul class="nav navbar-nav">
						<li class="active"><a href="./?refresh"><i class="fa fa-cogs"></i>系统管理</a></li>
						<li><a href="<?php  echo url('account/display');?>" target="_blank"><i class="fa fa-share"></i>管理公众号</a></li>
						<?php  if(IMS_FAMILY != 'x') { ?>
						<?php  } ?>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" style="display:block; max-width:185px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; "><i class="fa fa-user"></i><?php  echo $_W['user']['username'];?> (<?php  if($_W['role'] == 'founder') { ?>系统管理员<?php  } else if($_W['role'] == 'manager') { ?>公众号管理员<?php  } else { ?>公众号操作员<?php  } ?>) <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="<?php  echo url('user/profile/profile');?>" target="_blank"><i class="fa fa-weixin fa-fw"></i> 我的账号</a></li>
								<?php  if($_W['role'] != 'operator') { ?>
								<li class="divider"></li>
								<li><a href="<?php  echo url('system/welcome');?>" target="_blank"><i class="fa fa-sitemap fa-fw"></i> 系统选项</a></li>
								<li><a href="<?php  echo url('system/welcome');?>" target="_blank"><i class="fa fa-cloud-download fa-fw"></i> 自动更新</a></li>
								<li><a href="<?php  echo url('system/updatecache');?>" target="_blank"><i class="fa fa-refresh fa-fw"></i> 更新缓存</a></li>
								<li class="divider"></li>
								<?php  } ?>
								<li><a href="<?php  echo url('user/logout');?>"><i class="fa fa-sign-out fa-fw"></i> 退出系统</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		<?php  } ?>
	<?php  } else { ?>
		<div class="navbar navbar-inverse navbar-static-top" role="navigation" style="z-index:1001;">
			<div class="container-fluid container">
				<ul class="nav navbar-nav navbar-right">
					<li class="active"><a href="<?php  echo url('user/register');?>"><i class="fa fa-user"></i>注册</a></li>
					<li><a href="<?php  echo url('user/login');?>"><i class="fa fa-user-plus"></i>登陆</a></li>
				</ul>
			</div>
		</div>
	<?php  } ?>

	<div class="container-fluid">
		<?php  if(defined('IN_MESSAGE')) { ?>
			<div class="jumbotron clearfix alert alert-<?php  echo $label;?>">
				<div class="row">
					<div class="col-xs-12 col-sm-4 col-md-3 col-lg-2">
						<i class="fa fa-5x fa-<?php  if($label=='success') { ?>check-circle<?php  } ?><?php  if($label=='danger') { ?>times-circle<?php  } ?><?php  if($label=='info') { ?>info-circle<?php  } ?><?php  if($label=='warning') { ?>exclamation-triangle<?php  } ?>"></i>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-9 col-lg-10">
						<?php  if(is_array($msg)) { ?>
							<h2>MYSQL 错误：</h2>
							<p><?php  echo cutstr($msg['sql'], 300, 1);?></p>
							<p><b><?php  echo $msg['error']['0'];?> <?php  echo $msg['error']['1'];?>：</b><?php  echo $msg['error']['2'];?></p>
						<?php  } else { ?>
						<h2><?php  echo $caption;?></h2>
						<p><?php  echo $msg;?></p>
						<?php  } ?>
						<?php  if($redirect) { ?>
						<p><a href="<?php  echo $redirect;?>" class="alert-link">如果你的浏览器没有自动跳转，请点击此链接</a></p>
						<script type="text/javascript">
							setTimeout(function () {
								location.href = "<?php  echo $redirect;?>";
							}, 3000);
						</script>
						<?php  } else { ?>
							<p>[<a href="javascript:history.go(-1);" class="alert-link">点击这里返回上一页</a>] &nbsp; [<a href="./?refresh" class="alert-link">首页</a>]</p>
						<?php  } ?>
					</div>
				</div>
			</div>
		<?php  } ?>
