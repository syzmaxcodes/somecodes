/**
 * Created by Administrator on 2018/2/6 0006.
 */
$(function(){
    // 首页banner视觉差
    var oUl=$('#banner'), l = oUl.width()/2, t = oUl.height()/2, aLi=$('.banner_li');
    oUl.mousemove(function( ev ){
        var oEv = ev || event, iL = oEv.clientX, iT = oEv.clientY;
        for(var i=0; i<aLi.length; i++){
            aLi[i].style.marginLeft=(iL - l )/100*aLi[i].style.zIndex+'px';
            aLi[i].style.marginTop=(iT - t )/70*aLi[i].style.zIndex+'px';
        }
    });

   //回到顶部
   backTop();
   //右侧菜单栏电话及微信
   sidebar();

});

// 回到顶部
function backTop(){
    var backToTopEle = $("#backTop").click( function() {
        $("html, body").animate({
            scrollTop: "0px"
        }, 1000, null, function(){
            var h = location.href;
            if(h.indexOf('apply') > -1)
                window.location.hash = "top";
        });
        backToTopEle.data("isClick",true);
        $("#backTop").removeClass("fade_in");
        $("#backTop").addClass("fade_out");
    });
    var showEle = function(){
        if(backToTopEle.data("isClick")){
        }else{
            $(backToTopEle).removeClass("fade_out");
            $(backToTopEle).addClass("fade_in");
        }
    };
    var timeDelay = null;
    var backToTopFun = function() {
        var docScrollTop = $(document).scrollTop();
        var winowHeight = $(window).height();
        if(docScrollTop > 0){
            showEle() ;
        }else{
            backToTopEle.data("isClick",false);
            $("#backTop").removeClass("fade_in");
            $("#backTop").addClass("fade_out");
        }

        //IE6涓嬬殑瀹氫綅
        if ($.browser.msie && $.browser.version == "6.0") {
            backToTopEle.hide();
            clearTimeout(timeDelay);
            timeDelay = setTimeout(function(){
                backToTopEle.show();
                clearTimeout(timeDelay);
            },1000);
            backToTopEle.css("top", docScrollTop + winowHeight - 125);
        }
    };
    $(window).bind("scroll", backToTopFun);
}

// 右侧栏电话、微信
function sidebar(){
    var mtmp_sidebar_tel =$('.mtmp_sidebar_tel'),
        mtmp_sidebar_wx =$('.mtmp_sidebar_wx'),
        sidebar_tel_li = $('#sidebar_tel_li'),
        sidebar_wx_li = $('#sidebar_wx_li');
        sidebar_tel_li.hover(function(){
            mtmp_sidebar_tel.css({"right":"50px","opacity":"1","z-index": "999" });
            mtmp_sidebar_wx.css({"right":"90px","opacity":"0","z-index": "-1"});
        },function(){
            mtmp_sidebar_tel.css({"right":"90px","opacity":"0","z-index": "-1"});
            mtmp_sidebar_wx.css({"right":"90px","opacity":"0","z-index": "-1"});
    });
        sidebar_wx_li.hover(function(){
            mtmp_sidebar_wx.css({"right":"50px","opacity":"1","z-index": "999"});
            mtmp_sidebar_tel.css({"right":"90px","opacity":"0","z-index": "-1"});
        },function(){
            mtmp_sidebar_wx.css({"right":"90px","opacity":"0","z-index": "-1"});
            mtmp_sidebar_tel.css({"right":"90px","opacity":"0","z-index": "-1"});
        })
}

// 服务-营销支持
(function($){
    var Caroursel = function (caroursel){
        var self = this;
        this.caroursel = caroursel;
        this.posterList = caroursel.find(".poster-list");
        this.posterItems = caroursel.find(".poster-item");
        this.firstPosterItem = this.posterItems.first();
        this.lastPosterItem = this.posterItems.last();
        this.prevBtn = this.caroursel.find(".poster-prev-btn");
        this.nextBtn = this.caroursel.find(".poster-next-btn");
        //默认参数
        this.setting = {
            "width":"1200",
            "height":"270",
            "posterWidth":"640",
            "posterHeight":"270",
            "scale":"0.9",
            "speed":5000,
            "isAutoplay":false,
            "dealy":3000
        };
        //自定义参数与默认参数合并
        $.extend(this.setting,this.getSetting())
        //设置第一帧位置
        this.setFirstPosition();
        //设置剩余帧的位置
        this.setSlicePosition();
        //旋转
        this.rotateFlag = true;
        this.prevBtn.bind("click",function(){
            if(self.rotateFlag){
                self.rotateFlag = false;
                self.rotateAnimate("left")
            }
        });
        this.nextBtn.bind("click",function(){
            if(self.rotateFlag){
                self.rotateFlag = false;
                self.rotateAnimate("right")
            }
        });
        if(this.setting.isAutoplay){
            this.autoPlay();
            this.caroursel.hover(function(){clearInterval(self.timer)},function(){self.autoPlay()})
        }
    };
    Caroursel.prototype = {
        autoPlay:function(){
            var that = this;
            this.timer =  window.setInterval(function(){
                that.prevBtn.click();
            },that.setting.dealy)
        },
        rotateAnimate:function(type){
            var that = this;
            var zIndexArr = [];
            if(type == "left"){//向左移动
                this.posterItems.each(function(){
                    var self = $(this),
                        prev = $(this).next().get(0)?$(this).next():that.firstPosterItem,
                        width = prev.css("width"),
                        height = prev.css("height"),
                        zIndex = prev.css("zIndex"),
                        opacity = prev.css("opacity"),
                        left = prev.css("left"),
                        top = prev.css("top");

                    self.animate({
                        "width":width,
                        "height":height,
                        "left":left,
                        "opacity":opacity,
                        "top":top
                    },that.setting.speed,function(){
                        that.rotateFlag = true;
                    });
                    zIndexArr.push(zIndex);
                });
                this.posterItems.each(function(i){
                    $(this).css("zIndex",zIndexArr[i]);
                });
            }
            if(type == "right"){//向右移动
                this.posterItems.each(function(){
                    var self = $(this),
                        next = $(this).prev().get(0)?$(this).prev():that.lastPosterItem,
                        width = next.css("width"),
                        height = next.css("height"),
                        zIndex = next.css("zIndex"),
                        opacity = next.css("opacity"),
                        left = next.css("left"),
                        top = next.css("top");
                    self.animate({
                        "width":width,
                        "height":height,
                        "left":left,
                        "opacity":opacity,
                        "top":top
                    },that.setting.speed,function(){
                        that.rotateFlag = true;
                    });
                    zIndexArr.push(zIndex);
                });
                this.posterItems.each(function(i){
                    $(this).css("zIndex",zIndexArr[i]);
                });
            }
        },
        setFirstPosition:function(){
            this.caroursel.css({"width":this.setting.width,"height":this.setting.height});
            this.posterList.css({"width":this.setting.width,"height":this.setting.height});
            var width = (this.setting.width - this.setting.posterWidth) / 2;
            //设置两个按钮的样式
            this.prevBtn.css({"width":width , "height":this.setting.height,"zIndex":Math.ceil(this.posterItems.size()/2)});
            this.nextBtn.css({"width":width , "height":this.setting.height,"zIndex":Math.ceil(this.posterItems.size()/2)});
            this.firstPosterItem.css({
                "width":this.setting.posterWidth,
                "height":this.setting.posterHeight,
                "left":width,
                "zIndex":Math.ceil(this.posterItems.size()/2),
                "top":this.setVertialType(this.setting.posterHeight)
            });
        },
        setSlicePosition:function(){
            var _self = this;
            var sliceItems = this.posterItems.slice(1),
                level = Math.floor(this.posterItems.length/2),
                leftItems = sliceItems.slice(0,level),
                rightItems = sliceItems.slice(level),
                posterWidth = this.setting.posterWidth,
                posterHeight = this.setting.posterHeight,
                Btnwidth = (this.setting.width - this.setting.posterWidth) / 2,
                gap = Btnwidth/level,
                containerWidth = this.setting.width;
            //设置左边帧的位置
            var i = 1;
            var leftWidth = posterWidth;
            var leftHeight = posterHeight;
            var zLoop1 = level;
            leftItems.each(function(index,item){
                leftWidth = posterWidth * _self.setting.scale;
                leftHeight = posterHeight*_self.setting.scale;
                $(this).css({
                    "width":leftWidth,
                    "height":leftHeight,
                    "left": Btnwidth - i*gap,
                    //"zIndex":zLoop1--,
                    "zIndex":0,
                    // "opacity":1/(i+1),
                    "opacity":1,
                    "top":_self.setVertialType(leftHeight)
                });
                i++;
            });
            //设置右面帧的位置
            var j = level;
            var zLoop2 = 1;
            var rightWidth = posterWidth;
            var rightHeight = posterHeight;
            rightItems.each(function(index,item){
                var rightWidth = posterWidth * _self.setting.scale;
                var rightHeight = posterHeight*_self.setting.scale;
                $(this).css({
                    "width":rightWidth,
                    "height":rightHeight,
                    "left": containerWidth -( Btnwidth - j*gap + rightWidth),
                    //"zIndex":zLoop2++,
                    "zIndex":1,
                    //"opacity":1/(j+1),
                    "opacity":1,
                    "top":_self.setVertialType(rightHeight)
                });
                j--;
            });
        },
        getSetting:function(){
            var settting = this.caroursel.attr("data-setting");
            if(settting.length > 0){
                return $.parseJSON(settting);
            }else{
                return {};
            }
        },
        setVertialType:function(height){
            var algin = this.setting.algin;
            if(algin == "top") {
                return 0
            }else if(algin == "middle"){
                return (this.setting.posterHeight - height) / 2
            }else if(algin == "bottom"){
                return this.setting.posterHeight - height
            }else {
                return (this.setting.posterHeight - height) / 2
            }
        }
    };
    Caroursel.init = function (caroursels){
        caroursels.each(function(index,item){
            new Caroursel($(this));
        })  ;
    };
    window["Caroursel"] = Caroursel;
})(jQuery);

// 提示弹窗
function winPop(obj){
    function tanchuang(obj){
            //$('body').append('<div id="mry-opo"><div id="mry-opo-title"></div><div  id="mry-opo-content"></div></div>');
        $('body').append('<div id="mry-opo"><div id="mry-opo-content"></div><a href="javascript:void(0)" deletes="mry-opo" id="mry-opo-btn"  class="winpopBtn"></a></div>');
        var div = $('#mry-opo');
            //$('#mry-opo-title').text(obj.title);
            $('#mry-opo-content').text(obj.content);
            $('#mry-opo-btn').text(obj.btn);
            div.css('width',obj.width+'px');
            div.css('height',obj.height+'px');
            div.css('margin-left',-(parseInt(obj.width)/2)+'px');
            div.css('margin-top',-(parseInt(obj.height)/2)+'px');
            div.css('background',obj.backgorund);
            $('#mry-mask').css('display','block');
        }
    function del(){
        $('[deletes=mry-opo]').click(function(){
            $('#mry-opo,#mry-mask').remove();});
        }
    $('body').append('<div id="mry-mask" deletes="mry-opo"></div>');
    var ject=obj;
    ject.width = parseInt(obj.width)||300;
    ject.height = parseInt(obj.height)||300;
    //ject.title=obj.title||'啥西';
    ject.content = obj.content||'啥西呀';
    ject.btn = obj.btn||'关闭';
    ject.backgorund=obj.backgorund||'#fff';
    tanchuang(ject);
    del();
}