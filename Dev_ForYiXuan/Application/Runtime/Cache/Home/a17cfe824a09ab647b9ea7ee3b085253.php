<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>方猪 & 任狗</title>
<meta http-equiv="imagetoolbar" content="no">
<meta http-equiv="content-type" content="text/html;charset=UTF-8">
<!-- 引入在线的BS库 -->
<link rel="stylesheet" href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css">  
<script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- 图标 -->
<link href="http://www.jq22.com/jquery/font-awesome.4.6.0.css" rel="stylesheet">

    <!-- 标签云 js -->
  <script type="text/javascript" src="/ForYiXuan/Dev_Foryixuan/Public/JS/TagCloud/tagcloud.js"></script>
  <link rel="stylesheet" type="text/css" href="/ForYiXuan/Dev_Foryixuan/Public/CSS/TagCloud/demo.css" />

</head>
<body>
        <!-- 导航css -->
    <link rel="stylesheet" type="text/css" href="/ForYiXuan/Dev_Foryixuan/Public/CSS/photo_wall/nav.css" /> 
    <!-- 导航js -->
    <script type="text/javascript" src="/ForYiXuan/Dev_Foryixuan/Public/JS/photo_wall/nav2.js"></script>
    <!-- 导航 -->
	<div id="menu">
        <div class="hamburger">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </div>
        <div class="menu-inner">

            <ul>

                <div class="div_frame li_one">
                    <li class="the_li">
                        Otc
                    </li>	
                    <li class="the_sub_li sub_li_one">
                        1
                    </li>
                    <li class="the_sub_li sub_li_one">
                        2
                    </li>
                </div>

                <div class="div_frame li_two">

                    <li class="the_li">
                        Nov
                    </li>

                    <li class="the_sub_li sub_li_two">
                        k11
                    </li>

                    <li class="the_sub_li sub_li_two">
                        汉街
                    </li>
                </div>		
                <li>
                    Dec
                </li>
            </ul>
        </div>
        <svg version="1.1" id="blob"xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
            <path id="blob-path" d="M60,500H0V0h60c0,0,20,172,20,250S60,900,60,500z"/>
        </svg>
</div>
<div class="wrapper">
    <p class="rl">和艺璇去过的地方<br/>希望以后越来越多</p>
    <div class="tagcloud">
      <a href="#">江汉路</a>
      <a href="#">汉街</a>
      <a href="#">兰陵路</a>
      <a href="#">江滩</a>
      <a href="#">武汉科技大学</a>
      <a href="#">金地广场</a>
      <a href="#">群星城</a>
      <a href="#">群光广场</a>
      <a href="#">创意城</a>
      <a href="#">乐天城</a>
      <a href="#">未来城</a>
      <a href="#">广八路</a>
      <a href="#">k11</a>
      <a href="#">保利广场</a>
      <a href="#">永旺梦乐城（经开店</a>
    </div>
</div><!--wrapper-->
<div class="wrapper"> 
    <p class="rl">和艺璇打卡的店铺<br/>死任狗看就看饱</p>
  <div class="tagcloud">
    <a href="#">双喜铁板烧(五星好评)</a>
    <a href="#">广八路 原汤牛肉面</a>
    <a href="#">50岚</a>
    <a href="#">表哥</a>
    <a href="#">蓉城老院</a>
    <a href="#">小龙坎</a>
    <a href="#">奈雪的茶（蟹蟹包 菠萝芝士 奥利奥魔法棒 火龙果芝士）</a>
    <a href="#">偏爱</a>
    <a href="#">仟吉</a>
    <a href="#">裕禾</a>
    <a href="#">皇冠幸福里</a>
    <a href="#">研酵小山</a>
    <a href="#">汉街星巴克</a>
    <a href="#">群光星巴克</a>
    <a href="#">永旺星巴克</a>
    <a href="#">东北人烤肉</a>
    <a href="#">蹦猪🐷(为了买面包买一送一, 逛了超市多花了48??)</a>
  </div>
</div>

<div class="wrapper"> 
    <p class="rl">未来想和艺璇去的地方<br/>逐渐消灭！!!</p>
  <div class="tagcloud">
    <a href="#">上海迪士尼</a>
    <a href="#">欢乐谷夜场</a>
    <a href="#">宜家</a>
    <a href="#">古德寺</a>
    <a href="#">兰陵路</a>
    <a href="#">徐东大街</a>
    <a href="#">蓝色教堂</a>
    <a href="#">湖北美术馆</a>
    <a href="#">霸王餐（面包）</a>
    <a href="#">霸王餐（密室逃脱）</a>
  </div>
</div>

<div class="wrapper"> 
    <p class="rl">未来想和艺璇吃的馆子<br/>就知道吃??</p>
  <div class="tagcloud">
    <a href="#">精粉世家</a>
    <a href="#">江汉路地铁站b口内台湾小吃</a>
    <a href="#">年年</a>
    <a href="#">高老九火锅</a>
    <a href="#">吼吼也算一个吧</a>
    <a href="#">九毛九</a>
    <a href="#">书亦 烧仙草</a>
  </div>
</div>

<script type="text/javascript">
    /*3D标签云*/
    tagcloud({
        selector: ".tagcloud",  //元素选择器
        fontsize: 20,       //基本字体大小, 单位px
        radius: 150,         //滚动半径, 单位px
        mspeed: "fast",   //滚动最大速度, 取值: slow, normal(默认), fast
        ispeed: "normal",   //滚动初速度, 取值: slow, normal(默认), fast
        direction: 135,     //初始滚动方向, 取值角度(顺时针360): 0对应top, 90对应left, 135对应right-bottom(默认)...
        keep: false          //鼠标移出组件后是否继续随鼠标滚动, 取值: false, true(默认) 对应 减速至初速度滚动, 随鼠标滚动
    });
</script>
</body>
</html>