<?php 
include 'modules/user.php';
session_start();
?>
<html lang="zh-cn">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="http://cdn.bootcss.com/bootstrap/3.1.1/css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="http://cdn.bootcss.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
    <script src="http://cdn.bootcss.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body style='padding-top: 70px;'>
	
    <nav class="navbar navbar-default navbar-fixed-top navbar-inverse" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<p class="navbar-text">源程序2092</p>
			</div>
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav navbar-left">
					<li><a class="navbar-link" href='index.php'>主页</a></li>
					<li class='active'><p class="navbar-text">废墟争夺战-参战列表</p></li>
				</ul>
			

				<?php
				if (usermanager::checkuser())
				{?>
				
				<form class="navbar-form navbar-right" role="login" method='post'>
					<p class="navbar-text ">欢迎登入，<?php echo usermanager::$usernow['displayname'];?></p>
					<button type="submit" class="btn btn-default btn-sm" name='act' value='logout'>登出</button>
				</form>
				<?php } else { ?>
				
				<form class="navbar-form navbar-right" role="login" method='post'>
				  <div class="form-group">
					<input type="text" name='uname' class="form-control" placeholder="用户名">
					<input type="password" name='upass' class="form-control" placeholder="密码">
					<input type="text" name='displayname' class="form-control" placeholder="显示名(登陆时不填)">
				  </div>
				  <button type="submit" class="btn btn-default btn-sm" name='act' value='login'>登陆</button>
				  <button type="submit" class="btn btn-default btn-sm" name='act' value='reg'>注册</button>
				</form>
				<?php } ?>

			</div>
		</div>
    </nav>

    <div class='container'>
        <div class='row'>
            <div class="col-md-3">
                <h2 style='text-align:center'>战斗背景</h2>
                <p>类型：废墟争夺战</p>
				<p>地点：联邦军的废墟啦,距离地球300万公里的深空宇宙 一个直径4.8公里的陨石基地废墟之中</p>
				<p>战斗双方：
				<ul>
					<li>拉扎罗斯</li>
					<li>复活</li>
				</ul>	  
				</p>
				<p>目标:回收重要的实验数据</p>
				<p>没有任何支援/两队人马的死斗/徒步</p>
				<p>拉扎罗斯得到数据，故乡主导的试验计划提速</p>
				<p>复活得到数据，地球将永远失去超时空光子信息传输的研发可能性</p>
				<p>周四晚上我就开放装备配置时间</p>
				<p>周四晚上天朝时间6点开始 可以找我配置装备</p>
				<p>从冷兵器到单兵核武 什么都有</p>
				<p>但是这么说了 请注意 有核武的话 我一定会在单子里准备种子离散器</p>
				<p>职业配置:精锐士兵</p>
				<p>alt f4真的是一种兵器(炸逼虽厉害，我大AF神技可不是盖的)</p>
				<p>没有任何帝国科技/没有帝国兵器/帝国是绝对不参与的</p>
				<p>资料在基地内部的某一处</p>
				<p>两边会各有一个英雄NPC参与</p>
				<p>拉扎罗斯队的参与者是亚赞。盖布尔</p>
				<p>复活队的参与者是志保。哈夫尼斯</p>
				<p>这两个人在这任务中不受死亡保护</p>
				<p>想想我在《反叛者面具》做的预告,然后想想志保的重要性</p>

					<div></div>
            </div>
            <div class="col-md-7">
                <h2 style='text-align:center'>战斗记录</h2>
                <div id='logs'>
                    <?php echo file_get_contents( 'record/online.txt');?>

                </div>


                <a id='adder' class='btn btn-primary'>参战人员点此添加纪录</a>
                <!-- 加载编辑器的容器 -->
                <script id="container" name="content" type="text/plain"></script>

                <!-- 实例化编辑器 -->
                <script type="text/javascript">
                    $('#adder').bind('click', loadeditor);
                    flag = false;
                    flag2 = false;

                    function loadlog() {
                        $.post("addlog.php", function (data) {
                            $('#logs').html(data);
                        });
                    }
                    setInterval('loadlog()', 30000);

                    function send() {

                        if (!(flag2)) {
                            $('#adder').text('发送中......');
                            $('#adder').unbind('click', send);
                            $.post("addlog.php", {
                                log: UE.getEditor('container').getContent()
                            }, function (data) {
                                $('#logs').html(data);
                                $('#adder').text('发送完成');
                                UE.getEditor('container').setHide();
                                flag2 = true;
                            });


                        };
                    };

                    function loadeditor() {
                        if (!(flag)) {
                            var ue = UE.getEditor('container');
                            $('#adder').unbind('click', loadeditor);
                            $('#adder').click(send);
                            $('#adder').text('点此发送');
                            flag = true;
                        }

                    }
                </script>
            </div>
            <div class="col-md-2">

			<?php
			
			
			$fz=json_decode(file_get_contents('fz.json'),1);
			$dic=array();
			foreach ($fz as $sl){array_push($dic,$sl);}
			
			
			?>
				<?php foreach ($fz as $sl){ ?>
				
                <h2 style='text-align:center'><?php echo $sl['name'];?></h2>
				<?php if (($sl['type']=='default')&&(usermanager::checkuser())){ ?>
				<div style='text-align:center'>
				<a style='text-align:center' href='gfz.php?people=<?php echo usermanager::$usernow['uname'];?>&fz=<?php echo $sl['id'];?>'>加入</a>
				</div><br>
				<?php } ?>
				<?php foreach ($sl['people'] as $people) {?>
                <div style='text-align:center'><?php echo usermanager::getdisplayname($people);?><br>
				<?php 
				if ($people==usermanager::$usernow['uname']){
				foreach ($dic as $lk) { if ($sl['name']!=$lk['name']){?>
				<a href='gfz.php?people=<?php echo $people;?>&fz=<?php echo $lk['id'];?>'>换到<?php echo $lk['name'];?></a><br>
				<?php }} 
				}
				?>
				</div>
				<?php }} ?>
				

            </div>
        </div>
    </div>


                <!-- 配置文件 -->
                <script type="text/javascript" src="ueditor/ueditor.config.js"></script>
                <!-- 编辑器源码文件 -->
                <script type="text/javascript" src="ueditor/ueditor.all.js"></script>

</body>

</html>

<!--

蜜娜
	莱德
	空航
	行剑无疆
	风行者

新殖民
	本
	扎古脑袋
	白兰
	guxiang



-->


