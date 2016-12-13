window.onload=function(){
        //获取页面的高度和宽度
        var sWidth=document.body.scrollWidth;
        var sHeight=document.body.scrollHeight;
        
        //获取页面的可视区域高度和宽度
        var wHeight=document.documentElement.clientHeight;
        var wWidth=document.documentElement.clientWidth;
        var oBtn=document.getElementById("collectBook");
        //点击收藏书评按钮
        var oBtn2=document.getElementById("sugPost");
        //点击意见反馈按钮
        var oBtn3=document.getElementById("bookSummary");
        oBtn.onclick=function(){
            bookCollect();
            return false;
        }
        oBtn2.onclick=function(){
            feedBack();
            return false;
        }
        oBtn3.onclick=function(){
            bookSum();
            return false;
        }
function bookCollect(){
    var oMask=document.createElement("div");
    oMask.id="mask";
    oMask.style.height=sHeight+"px";
    oMask.style.width=sWidth+"px";
    document.body.appendChild(oMask);
    var cPass=document.createElement("div");
    cPass.id="collectB";
    cPass.innerHTML="<div class='collectCon'><div id='collect'><h5>收藏</h5></div><div class='alert-collect'><p><img src='images/success.png'</p><br/><p id='colsuccess'>收藏成功^_^</p></div><div class='bookname'><p id='warning'><img src='images/warn.png' height='25' width='25'/>添加书单来管理你的收藏</p><p>我的书单：<select id='book'><option>了解近代史必看的几本书</option><option>了解近代史必看的几本书</option><option>了解近代史必看的几本书</option><option>了解近代史必看的几本书</option></select></p><input type='text' placeholder='&nbsp;&nbsp;&nbsp;创建新书单' id='newbook'></div><div class='alert-collect-footer'><a href='#' id='yes'>确定</a>&nbsp;&nbsp;&nbsp;<a href='#' id='no'>取消</a></div></div>";
    document.body.appendChild(cPass);

//获取收藏框的宽和高
var dHeight=cPass.offsetHeight;
var dWidth=cPass.offsetWidth;
    //设置收藏框的left和top
    cPass.style.top=wHeight/2-dHeight/2+"px";
    cPass.style.left=wWidth/2-dWidth/2+"px";
//点击关闭按钮
var oClose=document.getElementById("yes");
var oClose2=document.getElementById("no");

    //点击收藏框以外的区域也可以关闭登陆框
    oClose.onclick=oMask.onclick=function(){
                document.body.removeChild(cPass);
                document.body.removeChild(oMask);
                };
    oClose2.onclick=oMask.onclick=function(){
                document.body.removeChild(cPass);
                document.body.removeChild(oMask);
                };
    };                  
function feedBack(){
            var oMask1=document.createElement("div");
                oMask1.id="mask";
                oMask1.style.height=sHeight+"px";
                oMask1.style.width=sWidth+"px";
                document.body.appendChild(oMask1);
            var sPost=document.createElement("div");
                sPost.id="suggestion";
                sPost.innerHTML="<div class='suggestionCon'><div id='sug'><h5>意见反馈</h5></div><div class='alert-content'><textarea id='texta' placeholder='请留下您对我们的宝贵意见'></textarea></div><div class='alert-footer'><a href='#' id='yes'>确定</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href='#' id='no'>取消</a></div></div>";
                document.body.appendChild(sPost);          
            //获取意见反馈框的宽和高
            var dHeight1=sPost.offsetHeight;
            var dWidth1=sPost.offsetWidth;
            //设置意见反馈框的left和top
             sPost.style.left=wWidth/2-dWidth1/2+"px";
             sPost.style.top=wHeight/2-dHeight1/2+"px";
            //点击关闭按钮
            var oClose=document.getElementById("yes");
            var oClose2=document.getElementById("no");
            //点击意见反馈框以外的区域也可以关闭意见反馈框
            oClose.onclick=oMask1.onclick=function(){
                        document.body.removeChild(sPost);
                        document.body.removeChild(oMask1);
                        };
            oClose2.onclick=oMask1.onclick=function(){
                        document.body.removeChild(sPost);
                        document.body.removeChild(oMask1);
                        };
        };
        function bookSum(){
            var oMask2=document.createElement("div");
                oMask2.id="mask";
                oMask2.style.height=sHeight+"px";
                oMask2.style.width=sWidth+"px";
                document.body.appendChild(oMask2);
            var boSum=document.createElement("div");
                boSum.id="bSummary";
                boSum.innerHTML="<div class='bookSummaryCon'><a href='#'><img src='images/close.png' height='32' width='32' id='close'/></a><div class='summaryContent'><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;故事主要视角以19岁的比利•林恩为主，在伊拉克战场的硝烟炮火摸爬滚打一年多后，他所在的B班阴差阳错地迎来一次小小胜利，并因此机缘巧合地成为“美国英雄”，在感恩节回国探亲时期，他们进行了为期两周的“凯旋之旅”，然后继续前往伊拉克服完剩余11个月的兵役。主体情节发生在德克萨斯体育场内，达拉斯牛仔队主场迎战芝加哥熊队。按照美式橄榄球比赛规则，比赛分为四节，每节15分钟，第一、二节称为上半场，第三、四节称为下半场，上下半场之间有12分钟（大学赛20分钟）的中场休息。在这有限的十几分钟之内，何谓“漫长”？ 书名蕴含的相悖逻辑，基本指明了作品暗藏的时间脉络，也是最具亮点之处。</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;整本书正面叙述的物理时间，只囊括一个白天，而这一天作为时间轴上的原点与核心，却吸附了无数往事，每扯开一缕思绪的线索，记忆之海便荡漾出无垠涟漪，通过章节之间的自然空白，巧妙回归时间原点，结尾实现完美闭合。于是，在这单一的场景中，时间绵延，空间扩增，通过“中场休息”这一横截面剖析出小至比利参军的前因后果、性格形成、家庭背景，大到整个美国社会的众生纷纭，着力一个微观层面，描摹社会全景与人物群像，是谓见微知著。作者在时间线上下功夫，打破线性叙事的基本结构，一方面顺应现代文艺作品的风潮，不再拘泥于古典叙事的窠臼，一方面也是沿袭了自《追忆似水年华》以来的意识流路线，以恒河一沙粒窥无限往生，更为著名的例子有詹姆斯•乔伊斯的《尤利西斯》、弗吉尼亚・伍尔夫 的《达洛维夫人》和伊恩•麦克尤恩的《星期六》，都是一天之内的脑海风暴与思想旅行。</p></div></div>";
                document.body.appendChild(boSum);          
            //获取本书简介框的宽和高
            var dHeight1=boSum.offsetHeight;
            var dWidth1=boSum.offsetWidth;
            //设置本书简介框的left和top
             boSum.style.left=wWidth/2-dWidth1/2+"px";
             boSum.style.top=wHeight/2-dHeight1/2+"px";
            //点击关闭按钮
            var oClose=document.getElementById("close");
            //点击本书简介框以外的区域也可以关闭意见反馈框
            oClose.onclick=oMask2.onclick=function(){
                        document.body.removeChild(boSum);
                        document.body.removeChild(oMask2);
                        };
        };
        function scroll() {
            //alert(typeof document.getElementById('xx').style.height);
            document.getElementById('mask').style.height = document.documentElement.clientHeight+"px";
            document.getElementById('mask').style.width = document.documentElement.clientWidth+"px";
        }
        window.onload = scroll;
        window.onresize = scroll;
}