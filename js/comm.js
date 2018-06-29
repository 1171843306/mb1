js_args = (function(script,i,me)
{
	var jsName='/comm.js?';
	var l = script.length;
	for(var i=0;i<l;i++)
	{
		me = !!document.querySelector ?
		    script[i].src : script[i].getAttribute('src',4);
			if (me.indexOf(jsName)!==-1)
			{
				return me.split(jsName)[1];
				break;
				}
		}
	})(document.getElementsByTagName('script'),0) 
 
getJsArgs = function( name )
{
    if(js_args)
	{
	    var p = js_args.split('&'), i = 0, l = p.length, a;
		for( ; i < l; i++ )
		{
		    a = p[i].split('=');
			if( name === a[0] ) return a[1];
		}
	}
	return null;
}

var w=getJsArgs('w');
var h=getJsArgs('h');
((w==null) || (w=="")) ? w=700 : parseInt(w);
((h==null) || (h=="")) ? h=525 : parseInt(h);

function addFavorite(url,webname){ //加入收藏
	try{
		window.external.AddFavorite(url,webname); 
	}catch(e){
		(window.sidebar)?window.sidebar.addPanel(webname,url,''):alert('请使用按键 Ctrl+d，'+webname); 
	}
}
function setHomepage(url){　 // 设置首页
	if (document.all){
		document.body.style.behavior = 'url(#default#homepage)';
		document.body.setHomePage(url);
	}else if (window.sidebar){
		if (window.netscape){
			try {
				netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
			}catch (e) {
				alert("该操作被浏览器拒绝，如果想启用该功能，请在地址栏内输入 about:config,然后将项 signed.applets.codebase_principal_support 值该为true");
			}
		}
		var prefs = Components.classes['@mozilla.org/preferences-service;1'].getService(Components.interfaces.nsIPrefBranch);
		prefs.setCharPref('browser.startup.homepage', url);
	}
} 

function clockon() {
    var now = new Date();
    var year = now.getFullYear(); //getFullYear getYear
    var month = now.getMonth();
    var date = now.getDate();
    var day = now.getDay();
    var hour = now.getHours();
    var minu = now.getMinutes();
    var sec = now.getSeconds();
    var week;
    month = month + 1;
    if (month < 10) month = "0" + month;
    if (date < 10) date = "0" + date;
    if (hour < 10) hour = "0" + hour;
    if (minu < 10) minu = "0" + minu;
    if (sec < 10) sec = "0" + sec;
    var arr_week = new Array("星期日", "星期一", "星期二", "星期三", "星期四", "星期五", "星期六");
    week = arr_week[day];
    var time = "";
    time ="今天是："+ year+"年"+month+"月"+date+"日"+"  "+week;
    $("#time").html(time);

}

function DrawImage(ImgD,iwidth,iheight){
//参数(图片,允许的宽度,允许的高度)
var image=new Image();
image.src=ImgD.src;
if(image.width>0 && image.height>0){
flag=true;
if(image.width/image.height>= iwidth/iheight){
if(image.width>iwidth){ 
ImgD.width=iwidth;
ImgD.height=(image.height*iwidth)/image.width;
}else{
ImgD.width=image.width; 
ImgD.height=image.height;
}
}
else{
if(image.height>iheight){ 
ImgD.height=iheight;
ImgD.width=(image.width*iheight)/image.height; 
}else{
ImgD.width=image.width; 
ImgD.height=image.height;
}
}}} 

function menuFix() {
	var nav=$("#nav");
	$(nav).children("li").hover(function(){
		$(this).addClass("sfhover").addClass("menu-hover");
	},function(){
		$(this).removeClass("sfhover").removeClass("menu-hover");
	});
	$(nav).children("li").children("ul").hover(function(){
		$(this).parent("li").addClass("menu-hover");
	},function(){
		$(this).parent("li").removeClass("menu-hover");
	});
} 


jQuery.fn.LoadImage=function(scaling,width,height,loadpic){
    if(loadpic==null)loadpic="load3.gif";
	return this.each(function(){
		var t=$(this);
		var src=$(this).attr("src")
		var img=new Image();
		//alert("Loading...")
		img.src=src;
		//自动缩放图片
		var autoScaling=function(){
			if(scaling){
			
				if(img.width>0 && img.height>0){ 
			        if(img.width/img.height>=width/height){ 
			            if(img.width>width){ 
			                t.width(width); 
			                t.height((img.height*width)/img.width); 
			            }else{ 
			                t.width(img.width); 
			                t.height(img.height); 
			            } 
			        } 
			        else{ 
			            if(img.height>height){ 
			                t.height(height); 
			                t.width((img.width*height)/img.height); 
			            }else{ 
			                t.width(img.width); 
			                t.height(img.height); 
			            } 
			        } 
			    } 
			}	
		}
		//处理ff下会自动读取缓存图片
		if(img.complete){
		    //alert("getToCache!");
			autoScaling();
		    return;
		}
		$(this).attr("src","");
		var loading=$("<img alt=\"加载中...\" title=\"图片加载中...\" src=\""+loadpic+"\" />");
		
		t.hide();
		t.after(loading);
		$(img).load(function(){
			autoScaling();
			loading.remove();
			t.attr("src",this.src);
			t.show();
			//alert("finally!")
		});
		
	});
}

$(document).ready(function(e) {
	var imgw=$(".right-main-show div img").width();
	var conw=$(".right-main-show").width();
	if(imgw>conw){
		$('.right-main-show div img').css('width',"100%");
	}
	if ($('.media').size()>0){
		$('.media').media({
		 width:w,
		 height:h,
		 bgColor:null
		});
	} 
	$("#KinSlideshow").KinSlideshow(
		{
                moveStyle:"right",
                titleBar:{titleBar_height:30,titleBar_bgColor:"#000",titleBar_alpha:0.5},
                titleFont:{TitleFont_size:12,TitleFont_color:"#FFFFFF",TitleFont_weight:"normal"},
                btn:{btn_bgColor:"#FFFFFF",btn_bgHoverColor:"#434343",btn_fontColor:"#000000",
                     btn_fontHoverColor:"#FFFFFF",btn_borderColor:"#fff",
                     btn_borderHoverColor:"#fff",btn_borderWidth:1}
        }
	);
}); 



 

