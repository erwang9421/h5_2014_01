window.onload=function(){
        //获取页面的高度和宽度
        var sWidth=document.body.scrollWidth;
        var sHeight=document.body.scrollHeight;
        
        //获取页面的可视区域高度和宽度
        var wHeight=document.documentElement.clientHeight;
        var wWidth=document.documentElement.clientWidth;
        var oBtn=document.getElementById("collectBook");
        //点击修改密码按钮
        var oBtn2=document.getElementById("sugPost");
            //点击意见反馈按钮
        oBtn.onclick=function(){
            bookCollect();
            return false;
        }
        oBtn2.onclick=function(){
            feedBack();
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
    cPass.innerHTML="<div class='collectCon'><div id='collect'><h5>收藏</h5></div><div class='alert-collect'><p><img src='images/success.png'</p><br/><p id='colsuccess'>收藏成功^_^</p></div><div class='bookname'><p id='warning'><img src='images/warn.png' height='25' width='25'/>添加书单来管理你的收藏</p><p>我的书单：<input type='text' value='了解近代史必看的十本书' id='book'></p><input type='text' placeholder='&nbsp;&nbsp;&nbsp;创建新书单' id='newbook'></div><div class='alert-collect-footer'><a href='#' id='yes'>确定</a>&nbsp;&nbsp;&nbsp;<a href='#' id='no'>取消</a></div></div>";
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
        function scroll() {
            //alert(typeof document.getElementById('xx').style.height);
            document.getElementById('mask').style.height = document.documentElement.clientHeight+"px";
            document.getElementById('mask').style.width = document.documentElement.clientWidth+"px";
        }
        window.onload = scroll;
        window.onresize = scroll;
}