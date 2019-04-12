<?php defined('IN_IA') or exit('Access Denied');?><?php  if(empty($diyitem['params']['style']) || $diyitem['params']['style']=='default1') { ?>
    <div class="headinfo commission" style="background-color: <?php  echo $diyitem['style']['background'];?>;">
        <div class="userinfo" style="border-bottom: 0.5px solid <?php  echo $diyitem['style']['textcolor'];?>;">
            <div class="fui-list">
                <div class="fui-list-media"><img src="<?php  echo $diyitem['params']['avatar'];?>"></div>
                <div class="fui-list-info">
                    <div class="title" style="color: <?php  echo $diyitem['style']['textcolor'];?>;"><?php  echo $diyitem['params']['nickname'];?></div>
                    <div class="subtitle" style="color: <?php  echo $diyitem['style']['textlight'];?>;">&lt;<?php  echo $diyitem['params']['levelname'];?>&gt;</div>
                    <?php  if(empty($diyitem['params']['hideup'])) { ?>
                    <div class="text" style="color: <?php  echo $diyitem['style']['textcolor'];?>;"><?php  echo $diyitem['params']['upname'];?>: <?php  echo $diyitem['params']['upmember'];?></div>
                    <?php  } ?>
                </div>
            </div>
            <?php  if(!empty($diyitem['params']['seticon']) && !empty($diyitem['params']['setlink'])) { ?>
                <a class="setbtn" href="<?php  echo $diyitem['params']['setlink'];?>" data-nocache="true"><i class="icon <?php  echo $diyitem['params']['seticon'];?>"></i></a>
            <?php  } ?>
        </div>
        <div class="userblock">
            <div class="line total">
                <div class="title" style="color: <?php  echo $diyitem['style']['textcolor'];?>;"><?php  echo $diyitem['params']['textsuccesswithdraw'];?>(<?php  echo $diyitem['params']['textyaun'];?>)</div>
                <div class="num" style="color: <?php  echo $diyitem['style']['textcolor'];?>;"><?php  echo $diyitem['params']['successwithdraw'];?></div>
            </div>
            <div class="line usable">
                <?php  if(!empty($diyitem['params']['centernav'])) { ?>
                    <a class="btn" href="<?php  echo $diyitem['params']['centernavlink'];?>" data-nocache="true"><?php  echo $diyitem['params']['centernav'];?></a>
                <?php  } ?>
                <div class="text">
                    <div class="title" style="color: <?php  echo $diyitem['style']['textcolor'];?>;"><?php  echo $diyitem['params']['textcanwithdraw'];?>(<?php  echo $diyitem['params']['textyaun'];?>)</div>
                    <div class="num" style="color: <?php  echo $diyitem['style']['textcolor'];?>;"><?php  echo $diyitem['params']['canwithdraw'];?></div>
                </div>
            </div>
        </div>
    </div>
<?php  } else if($diyitem['params']['style']=='default2') { ?>
    <div class="headinfo-m" style="background: <?php  echo $diyitem['style']['background'];?>; <?php  if(!empty($diyitem['style']['background'])) { ?>border: none;<?php  } ?>">
        <?php  if(!empty($diyitem['params']['seticon']) && !empty($diyitem['params']['setlink'])) { ?>
        <a class="setbtn" style="color: <?php  echo $diyitem['style']['textcolor'];?>;" href="<?php  echo $diyitem['params']['setlink'];?>" data-nocache="true"><i class="icon <?php  echo $diyitem['params']['seticon'];?>"></i></a>
        <?php  } ?>
        <div class="child">
            <div class="title" style="color: <?php  echo $diyitem['style']['textcolor'];?>;"><?php  echo $diyitem['params']['textsuccesswithdraw'];?></div>
            <div class="num" style="color: <?php  echo $diyitem['style']['textlight'];?>;"><?php  echo $diyitem['params']['successwithdraw'];?></div>
            <?php  if(!empty($diyitem['params']['leftnav'])) { ?>
            <a class="btn" style="color: <?php  echo $diyitem['style']['textcolor'];?>; border-color: <?php  echo $diyitem['style']['textcolor'];?>;" href="<?php  echo $diyitem['params']['leftnavlink'];?>" data-nocache="true"><?php  echo $diyitem['params']['leftnav'];?></a>
            <?php  } ?>
        </div>
        <div class="child userinfo" style="color: <?php  echo $diyitem['style']['textcolor'];?>;">
            <div class="face <?php  echo $diyitem['style']['headstyle'];?>"><img src="<?php  echo $diyitem['params']['avatar'];?>"></div>
            <div class="name"><?php  echo $diyitem['params']['nickname'];?></div>
            <div class="level">[<?php  echo $diyitem['params']['levelname'];?>]</div>
            <?php  if(empty($diyitem['params']['hideup'])) { ?>
            <div class="level"><?php  echo $diyitem['params']['upname'];?>: <?php  echo $diyitem['params']['upmember'];?></div>
            <?php  } ?>
        </div>
        <div class="child">
            <div class="title" style="color: <?php  echo $diyitem['style']['textcolor'];?>;"><?php  echo $diyitem['params']['textcanwithdraw'];?></div>
            <div class="num" style="color: <?php  echo $diyitem['style']['textlight'];?>;"><?php  echo $diyitem['params']['canwithdraw'];?></div>
            <?php  if(!empty($diyitem['params']['rightnav'])) { ?>
            <a class="btn" style="color: <?php  echo $diyitem['style']['textcolor'];?>; border-color: <?php  echo $diyitem['style']['textcolor'];?>;" href="<?php  echo $diyitem['params']['rightnavlink'];?>" data-nocache="true"><?php  echo $diyitem['params']['rightnav'];?></a>
            <?php  } ?>
        </div>
    </div>
<?php  } ?>