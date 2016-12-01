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
        <div id="urHere"><a href="index.html">畅评首页</a><b>></b><strong>书评列表</strong> </div>   <div class="mainBox" style="height:auto!important;height:550px;min-height:550px;">
        <h3><a href="addbookreview.html?rec=add" class="actionBtn add">添加书评</a>书评列表</h3>

        <div id="list">
            <form name="action" method="post" action="#">
                <table width="100%" border="0" cellpadding="8" cellspacing="0" class="tableBasic">
                    <tr>
                        <th width="22" align="center"><input name='chkall' type='checkbox' id='chkall' onclick='selectcheckbox(this.form)' value='check'></th>
                        <th align="center">评论图书</th>
                        <th align="center">图书作者</th>
                        <th align="center">书评标题</th>
                        <th align="center">书评内容</th>
                        <th align="center">发表时间</th>
                        <th align="center">收藏量</th>
                        <th align="center">浏览量</th>
                        <th align="center">评论量</th>
                        <th align="center">喜欢量</th>
                        <th align="center">操作</th>
                    </tr>
                    <tr>
                        <td align="center"><input type="checkbox" name="checkbox[]" value="15" /></td>
                        <td align="center">5</td>
                        <td align="center">5</td>
                        <td align="center">读钢铁是怎样炼成的</td>
                        <td align="center">文学类</td>
                        <td align="center">已发表</td>
                        <td align="center">5</td>
                        <td align="center">2013-06-26</td>
                        <td align="center">
                            <a href="editbookreview.html">编辑</a> | <a href="#">删除</a>
                        </td>
                    </tr>
                    <tr>
                        <td align="center"><input type="checkbox" name="checkbox[]" value="15" /></td>
                        <td align="center">4</td>
                        <td align="center">4</td>
                        <td align="center">读钢铁是怎样炼成的</td>
                        <td align="center">文学类</td>
                        <td align="center">已发表</td>
                        <td align="center">4</td>
                        <td align="center">2013-06-26</td>
                        <td align="center">
                            <a href="editbookreview.html">编辑</a> | <a href="#">删除</a>
                        </td>
                    </tr>
                    <tr>
                        <td align="center"><input type="checkbox" name="checkbox[]" value="15" /></td>
                        <td align="center">3</td>
                        <td align="center">3</td>
                        <td align="center">读钢铁是怎样炼成的</td>
                        <td align="center">文学类</td>
                        <td align="center">草稿箱</td>
                        <td align="center">3</td>
                        <td align="center">2013-06-26</td>
                        <td align="center">
                            <a href="editbookreview.html">编辑</a> | <a href="#">删除</a>
                        </td>
                    <tr>
                        <td align="center"><input type="checkbox" name="checkbox[]" value="15" /></td>
                        <td align="center">2</td>
                        <td align="center">2</td>
                        <td align="center">读钢铁是怎样炼成的</td>
                        <td align="center">文学类</td>
                        <td align="center">已删除</td>

                        <td align="center">2</td>
                        <td align="center">2013-06-26</td>
                        <td align="center">
                            <a href="editbookreview.html">编辑</a> | <a href="#">删除</a>
                        </td>
                    </tr>

                    <tr>
                        <td align="center"><input type="checkbox" name="checkbox[]" value="15" /></td>
                        <td align="center">1</td>
                        <td align="center">1</td>
                        <td align="center">读钢铁是怎样炼成的</td>
                        <td align="center">文学类</td>
                        <td align="center">已发表</td>

                        <td align="center">1</td>
                        <td align="center">2013-06-26</td>
                        <td align="center">
                            <a href="editbookreview.html">编辑</a> | <a href="#">删除</a>
                        </td>
                    </tr>


                </table>
            </form>
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