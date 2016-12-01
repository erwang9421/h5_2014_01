<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>畅想书评后台管理系统-用户列表</title>
<meta name="Copyright" content="Douco Design." />
<link href="/changxiang/Public/end/css/public.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/changxiang/Public/end/js/jquery.min.js"></script>
<script type="text/javascript" src="/changxiang/Public/end/js/global.js"></script>
<script type="text/javascript" src="/changxiang/Public/end/js/jquery.tab.js"></script>
<script type="text/javascript" src="/changxiang/Public/end/js/jquery.autotextarea.js"></script>

</head>
<body>
<div id="dcWrap"> <div id="dcHead">
 <div id="head">
  <div class="logo"><a href="index.html"><img src="/changxiang/Public/end/images/1.png" alt="logo" height="30"></a></div>
  <div class="nav">
   <ul>畅享书评后台管理系统
   </ul>
   <ul class="navRight">
    <li class="noRight"><a href="#">您好，admin</a>
     
    </li>
   <li class="noRight"><a href="login.html">退出</a></li>
   </ul>
  </div>
 </div>
</div>
<!-- dcHead 结束 --> 
<div id="dcLeft"><div id="menu">
 <ul class="top">
  <li><a href="index.html"><i class="home"></i><em>首页</em></a></li>
 </ul>

<ul>
  <li><a href="manager.html"><i class="manager"></i><em>管理员管理</em></a></li>
 </ul>


 <ul>
  <li><a href="/changxiang/index.php/Admin/User/lists"><i class="user"></i><em>用户列表</em></a></li>
  <li><a href="/changxiang/index.php/Admin/User/adduser"><i class="page"></i><em>添加用户</em></a></li>
 </ul>

<ul>
  <li><a href="comment.html"><i class="order"></i><em>评论管理</em></a></li>
 </ul>
<ul>
  <li><a href="collect.html"><i class="plugin"></i><em>收藏管理</em></a></li>
 </ul>
 <ul>
  <li><a href="letter.html"><i class="caseCat"></i><em>私信管理</em></a></li>
 </ul>
 <ul>
  <li><a href="pushpraise.html"><i class="show"></i><em>点赞管理</em></a></li>
 </ul>


 <ul>
  <li><a href="bookview.html"><i class="productCat"></i><em>书评列表</em></a></li>
  <li><a href="addbookview.html"><i class="guestbook"></i><em>添加书评</em></a></li>
 </ul>
 <ul>
  <li><a href="book.html"><i class="product"></i><em>图书列表</em></a></li>
  <li><a href="addbook.html"><i class="articleCat"></i><em>添加图书</em></a></li>
 </ul>
  <ul>
  <li><a href="payattention.html"><i class="pse"></i><em>我的关注</em></a></li>
  <li><a href="payattentioned.html"><i class="pae"></i><em>关注我的</em></a></li>
 </ul>
  <ul>
  <li><a href="tag.html"><i class="menuPage"></i><em>标签</em></a></li>
  <li><a href="keyword.html"><i class="theme"></i><em>关键字</em></a></li>
 </ul>
</div></div>


 <div id="dcMain">
   <!-- 当前位置 -->
<div id="urHere"><a href="index.html">畅评首页</a><b>></b><strong>添加书评</strong> </div>   <div class="mainBox" style="height:auto!important;height:550px;min-height:550px;">
            <h3><a href="bookview.html" class="actionBtn">书评列表</a>添加书评</h3>
    <form action="bookview.html" method="post" enctype="multipart/form-data">
     <table width="100%" border="0" cellpadding="8" cellspacing="0" class="tableBasic">
      <tr>
       <td width="90" align="center">图书名称</td>
       <td>
        <input type="text" name="name" value="" size="80" class="inpMain" />
       </td>
      </tr>
      <tr>
       <td width="90" align="center">书评标题</td>
       <td>
        <input type="text" name="name" value="" size="80" class="inpMain" />
       </td>
      </tr>
      <tr>
       <td align="center">书评类型</td>
       <td>
        <select name="cat_id">
         <option value="0">未分类</option>
                  <option value="1">文学</option>
                    <option value="10">- 文集</option>
                    <option value="11">- 纪实文学</option>
                    <option value="12">- 文学理论</option>
                    <option value="13">- 中国古诗词</option>
                    <option value="14">- 戏剧</option>
                    <option value="15">- 文集中国现当代诗歌</option>
                    <option value="16">- 外国诗歌</option>
                    <option value="17">- 民间文学</option>
                    <option value="18">- 外国随笔</option>
                    <option value="19">- 中国古代随笔</option>
                    <option value="2">小说</option>
                    <option value="20">- a</option>
                    <option value="21">- b</option>
                    <option value="3">哲学</option>
                    <option value="4">社会科学</option>
                    <option value="5">文化</option>
                    <option value="6">教育</option>
                    <option value="7">艺术</option>
                    <option value="8">自然科学</option>
                    <option value="9">工业技术</option>
          </select>
       </td>
      </tr>
      <tr>
       <td align="center">用户ID</td>
       <td>
        <input type="text" name="price" value="" size="40" class="inpMain" />
       </td>
      </tr>
            <tr>
       <td align="center" valign="top">书评内容</td>
       <td>
        <!-- KindEditor -->
			<link rel="stylesheet" href="js/kindeditor/themes/default/default.css" />
			<link rel="stylesheet" href="js/kindeditor/plugins/code/prettify.css" />
			<script charset="utf-8" src="js/kindeditor/kindeditor.js"></script>
			<script charset="utf-8" src="js/kindeditor/lang/zh_CN.js"></script>
			<script charset="utf-8" src="js/kindeditor/plugins/code/prettify.js"></script>
        <script>
					KindEditor.ready(function(K) {
						var editor1 = K.create('textarea[name="content"]', {
							cssPath : '../plugins/code/prettify.css',
							uploadJson : '../php/upload_json.php',
							fileManagerJson : '../php/file_manager_json.php',
							allowFileManager : true,
							afterCreate : function() {
								var self = this;
								K.ctrl(document, 13, function() {
									self.sync();
									K('form[name=example]')[0].submit();
								});
								K.ctrl(self.edit.doc, 13, function() {
									self.sync();
									K('form[name=example]')[0].submit();
								});
							}
						});
						prettyPrint();
					});
			</script>

        <!-- /KindEditor -->
        <textarea id="content" name="content" style="width:780px;height:400px;" class="textArea"></textarea>
       </td>
      </tr>
      <tr>
       <td align="center">发表时间</td>
       <td>
        <input type="text" name="sort" value="2016-11-26" size="5" class="inpMain" />
       </td>
      </tr>
       <td></td>
       <td>
        <input type="hidden" name="token" value="21307217" />
        <input type="hidden" name="id" value="">
        <input name="submit" class="btn" type="submit" value="提交" />
       </td>
      </tr>
     </table>
    </form>
           </div>
 </div>



 <div class="clear"></div>
<div id="dcFooter">
 <div id="footer">
  <div class="line"></div>
  <ul>
    畅所欲言，享你所想  |  畅想书评网站后台管理系统
  </ul>
 </div>
</div><!-- dcFooter 结束 -->
<div class="clear"></div> </div>
</body>
</html>