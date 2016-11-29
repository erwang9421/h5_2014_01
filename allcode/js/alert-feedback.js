function feedBack(){
	//获取页面的高度和宽度
	var sWidth=document.body.scrollWidth;
	var sHeight=document.body.scrollHeight;
	
	//获取页面的可视区域高度和宽度
	var wHeight=document.documentElement.clientHeight;
	var wWidth=document.documentElement.clientWidth;
	
	var oMask=document.createElement("div");
		oMask.id="mask";
		oMask.style.height=sHeight+"px";
		oMask.style.width=sWidth+"px";
		document.body.appendChild(oMask);
	var sPost=document.createElement("div");
		sPost.id="suggestion";
		sPost.innerHTML="<div class='suggestionCon'><div id='sug'><h5>意见反馈</h5></div><div class='alert-content'><textarea id='texta' placeholder='请留下您对我们的宝贵意见'></textarea></div><div class='alert-footer'><a href='#' id='yes'>确定</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href='#' id='no'>取消</a></div></div>";
		document.body.appendChild(sPost);
	
	//获取意见反馈框的宽和高
	var dHeight=sPost.offsetHeight;
	var dWidth=sPost.offsetWidth;
		//设置意见反馈框的left和top
		sPost.style.left=wWidth/2-dWidth/2+"px";
		sPost.style.top=wHeight/2-dHeight/2+"px";
	//点击关闭按钮
	var oClose=document.getElementById("yes");
	var oClose2=document.getElementById("no");
		//点击意见反馈框以外的区域也可以关闭登陆框
		oClose.onclick=oMask.onclick=function(){
                        document.body.removeChild(sPost);
                        document.body.removeChild(oMask);
                        };
        oClose2.onclick=oMask.onclick=function(){
                        document.body.removeChild(sPost);
                        document.body.removeChild(oMask);
                        };
	};
					
	window.onload=function(){
			var oBtn=document.getElementById("sugPost");
				//点击意见反馈按钮
				oBtn.onclick=function(){
					feedBack();
					return false;
					}
	function scroll() {
            //alert(typeof document.getElementById('xx').style.height);
            document.getElementById('mask').style.height = document.documentElement.clientHeight+"px";
            document.getElementById('mask').style.width = document.documentElement.clientWidth+"px";
        }
        window.onload = scroll;
        window.onresize = scroll;
				
}