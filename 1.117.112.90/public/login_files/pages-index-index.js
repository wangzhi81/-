(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["pages-index-index"],{"0bc6":function(t,e,i){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var n="http://ck13.8396048.com",a={info:{msg:n+"/routine/debt/msg"},login:{login:n+"/routine/login/login",logo:n+"/routine/login/get_enter_logo"},reg:{reg:n+"/routine/login/register",verifycode:n+"/routine/login/verifycode",forget:n+"/routine/login/forget"},index:{info:n+"/routine/home/info",notice:n+"/routine/login/getHomePop",get_list:n+"/routine/user/get_check_level_list",up_list:n+"/routine/user/up_check_level_list",examine:n+"/routine/debt/examine",crowdfunding:n+"/routine/debt/crowdfunding",visit:n+"/routine/auth_api/visit",nearRepayment:n+"/routine/debt/nearRepayment",lists:n+"/routine/article/lists",getArticle:n+"/routine/article/getArticle"},user:{realname:n+"/routine/user/realname",updateIdImage:n+"/routine/user/updateIdImage",upIdentityCard:n+"/routine/user/upIdentityCard",addressList:n+"/routine/user/addressList",saveAddress:n+"/routine/user/saveAddress",saveReceivables:n+"/routine/debt/saveReceivables",getReceivables:n+"/routine/debt/getReceivables",mygroup:n+"/routine/user/mygroup",qrcode:n+"/routine/user/qrcode",detail:n+"/routine/complaint/detail",revoke:n+"/routine/complaint/revoke",getOwnList:n+"/routine/complaint/getOwnList",getList:n+"/routine/complaint/getList",myteams:n+"/routine/user/myteams",message:n+"/routine/home/message"},planpage:{addDebt:n+"/routine/debt/addDebt",get_check_up:n+"/routine/user/get_check_up_list",update_voucher:n+"/routine/user/update_voucher",history:n+"/routine/user/get_check_level_list",adjustment:n+"/routine/user/adjustment",ask:n+"/routine/complaint/ask"}},o=function(t,e,i,n,a){uni.request({url:i,data:n,method:e,success:function(e){var i=e.data;401==i.code?(uni.removeStorageSync("token"),uni.reLaunch({url:"/pages/login/login"})):a(t,i)}})},r=function(t,e,i,n,a){uni.showLoading({title:"加载中",mask:!0});var o=setTimeout(function(){uni.hideLoading(),uni.showToast({icon:"none",title:"网络请求错误，请稍后再试"})},1e4);uni.request({url:i,data:n,method:e,success:function(e){uni.hideLoading(),clearTimeout(o);var i=e.data;401==i.code?(uni.removeStorageSync("token"),uni.reLaunch({url:"/pages/login/login"})):a(t,i)}})},s={api:n,api_root:a,entire:o,load_entire:r};e.default=s},"21f8":function(t,e,i){e=t.exports=i("2350")(!1),e.push([t.i,".load[data-v-5fc1f3b4]{height:100%;width:100%;position:fixed;top:0;left:0;z-index:1000;background:rgba(0,0,0,.7)}",""])},"280a":function(t,e,i){"use strict";var n=i("288e");Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var a=n(i("0bc6")),o=n(i("f725")),r={components:{load:o.default},data:function(){return{img_list:"",indicatorDots:!0,autoplay:!0,interval:3e3,duration:500,circular:!0,Lbtlist:"",api_root:"",notice:"",notice_show:!1,notice_record:!0,article:"",msg:[],lists:""}},onLoad:function(){""==uni.getStorageSync("token")&&uni.reLaunch({url:"/pages/login/login"}),1==this.notice_record&&a.default.entire(this,"get",a.default.api_root.index.notice,{token:uni.getStorageSync("token")},function(t,e){""!=e.data&&(t.notice_show=!0,t.notice=e.data[0])}),a.default.entire(this,"get",a.default.api_root.index.info,{token:uni.getStorageSync("token")},function(t,e){t.img_list=e.data.banner,t.article=e.data.articlelist,uni.setStorageSync("user",e.data.member)}),a.default.entire(this,"get",a.default.api_root.index.nearRepayment,{token:uni.getStorageSync("token")},function(t,e){t.msg=e.data}),a.default.entire(this,"get",a.default.api_root.index.lists,{token:uni.getStorageSync("token")},function(t,e){t.lists=e.data})},methods:{jump:function(t){uni.navigateTo({url:t})},close:function(){this.notice_show=!1,this.notice_record=!1,uni.setStorageSync("notice_record",this.notice_record)}}};e.default=r},"4f92":function(t,e,i){"use strict";var n=i("b962"),a=i.n(n);a.a},"56a5":function(t,e,i){"use strict";i.r(e);var n=i("c4d9"),a=i.n(n);for(var o in n)"default"!==o&&function(t){i.d(e,t,function(){return n[t]})}(o);e["default"]=a.a},"7e3a":function(t,e,i){"use strict";i.r(e);var n=i("280a"),a=i.n(n);for(var o in n)"default"!==o&&function(t){i.d(e,t,function(){return n[t]})}(o);e["default"]=a.a},"8c46":function(t,e,i){"use strict";var n=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("v-uni-view",{staticClass:"load"})},a=[];i.d(e,"a",function(){return n}),i.d(e,"b",function(){return a})},a6dc:function(t,e,i){var n=i("21f8");"string"===typeof n&&(n=[[t.i,n,""]]),n.locals&&(t.exports=n.locals);var a=i("4f06").default;a("d1c21f2a",n,!0,{sourceMap:!1,shadowMode:!1})},a7e0:function(t,e,i){"use strict";var n=i("a6dc"),a=i.n(n);a.a},b32c:function(t,e,i){e=t.exports=i("2350")(!1),e.push([t.i,".content[data-v-6b96c4ec]{padding:0 2%;padding-bottom:%?120?%;overflow:hidden;overflow-x:hidden}.top_img[data-v-6b96c4ec]{color:#fff;text-align:right;background:#3a3d46;border-radius:%?10?%;\n\t/* min-height: 300upx; */height:%?300?%;\n\t/* margin: 156upx 26upx 20upx; */\n\t/* margin: 20upx 26upx; */margin-top:%?110?%}.swiper-item[data-v-6b96c4ec]{height:100%}.bang_img[data-v-6b96c4ec]{width:100%;\n\t/* height: 100%; */height:%?300?%}.top[data-v-6b96c4ec]{position:fixed;top:0;left:0;width:100%;-webkit-box-sizing:border-box;box-sizing:border-box;text-align:center;color:#fff;background:#343c6d;overflow:hidden;height:%?100?%;padding:%?40?% %?20?% %?20?% %?20?%;font-size:%?32?%;font-weight:700;z-index:888}.top uni-image[data-v-6b96c4ec]{width:%?50?%;height:%?50?%}.top uni-image[data-v-6b96c4ec]:first-of-type{float:left}.top uni-image[data-v-6b96c4ec]:nth-of-type(2){float:right}.more[data-v-6b96c4ec]{height:%?180?%;-webkit-box-sizing:border-box;box-sizing:border-box;overflow:hidden}.more uni-image[data-v-6b96c4ec]{margin-top:%?20?%;width:96%;position:absolute}.newsList[data-v-6b96c4ec]{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;margin-bottom:%?22?%;overflow:hidden;background:#fff;border-radius:%?10?%}.newsList .right[data-v-6b96c4ec]{\n\t/* width: 59%; */-webkit-box-flex:2;-webkit-flex-grow:2;-ms-flex-positive:2;flex-grow:2;height:%?160?%;display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-box-pack:center;-webkit-justify-content:center;-ms-flex-pack:center;justify-content:center;-webkit-box-orient:vertical;-webkit-box-direction:normal;-webkit-flex-direction:column;-ms-flex-direction:column;flex-direction:column}.newsList .left[data-v-6b96c4ec]{width:%?320?%;height:%?160?%;margin-right:4%}.newsList .left uni-image[data-v-6b96c4ec]{width:%?320?%;height:%?160?%}.newsList_title[data-v-6b96c4ec]{font-size:%?32?%;overflow:hidden;-o-text-overflow:ellipsis;text-overflow:ellipsis;white-space:nowrap;color:#444653}.newsList_concet[data-v-6b96c4ec]{margin-top:%?20?%;font-size:%?24?%;display:-webkit-box;-webkit-box-orient:vertical;-webkit-line-clamp:2;overflow:hidden;color:#9fa7ba}.box[data-v-6b96c4ec]{height:%?50?%;overflow:hidden;position:relative;bottom:%?-122?%}.uni-swiper-msg[data-v-6b96c4ec]{color:#4a93c4;text-align:center;font-size:%?28?%}.swiper-item[data-v-6b96c4ec]{height:100%;border-radius:%?20?%}.sw_left[data-v-6b96c4ec]{margin-right:%?20?%}.help[data-v-6b96c4ec]{margin-top:%?30?%;color:#afbbe5}.help .test[data-v-6b96c4ec]{font-size:%?28?%;margin-bottom:%?10?%}.help uni-image[data-v-6b96c4ec]{width:100%}.help_plan[data-v-6b96c4ec]{height:%?200?%;color:#fff;margin-bottom:%?30?%}.help_plan .help_left[data-v-6b96c4ec]{float:left;text-align:center;line-height:%?200?%;width:50%}.help_plan .help_rigth[data-v-6b96c4ec]{height:%?200?%;border-bottom-right-radius:%?20?%;border-top-right-radius:%?20?%;float:right;width:50%;background:#fff;padding:%?20?%;-webkit-box-sizing:border-box;box-sizing:border-box;font-size:%?28?%}.help_plan .help_rigth .help_top[data-v-6b96c4ec]{color:#36395a}.help_plan .help_rigth .help_bottom[data-v-6b96c4ec]{color:#7f8c9e;margin-top:%?10?%}.purple[data-v-6b96c4ec]{background:-webkit-gradient(linear,left top,right top,from(#b7cbfd),to(#7f96e6));background:-o-linear-gradient(left,#b7cbfd,#7f96e6);background:linear-gradient(90deg,#b7cbfd,#7f96e6)}.red[data-v-6b96c4ec]{background:-webkit-gradient(linear,left top,right top,from(#ffbf96),to(#f18857));background:-o-linear-gradient(left,#ffbf96,#f18857);background:linear-gradient(90deg,#ffbf96,#f18857)}.test .test_top[data-v-6b96c4ec]{color:#b4c0ea;font-size:%?32?%}.test .test_top uni-text[data-v-6b96c4ec]{margin-left:%?20?%;font-size:%?30?%;color:#6a78a1}.test_list[data-v-6b96c4ec]{overflow:hidden}.test_img[data-v-6b96c4ec]{width:48%;float:left;height:%?400?%;background:#fff;margin:1%;border-bottom-left-radius:%?10?%;border-bottom-right-radius:%?10?%}.test_img uni-image[data-v-6b96c4ec]{width:100%;height:%?300?%;border-bottom:%?1?% solid rgba(0,0,0,.2)}.test_img uni-view[data-v-6b96c4ec]{width:100%;text-align:center;font-size:%?32?%;height:%?80?%;color:#353a60;line-height:%?80?%}.notice[data-v-6b96c4ec]{width:80%;position:fixed;background:#fff;border-radius:%?10?%;padding:%?40?% %?10?%;z-index:999;top:50%;left:50%;-webkit-transform:translate(-50%,-50%);-ms-transform:translate(-50%,-50%);transform:translate(-50%,-50%);height:%?600?%}.notice uni-image[data-v-6b96c4ec]{width:%?50?%;height:%?50?%;position:absolute;right:%?10?%;top:%?10?%}.notice .notice_title[data-v-6b96c4ec]{text-align:center}.notice .notice_content[data-v-6b96c4ec]{font-size:%?30?%;text-indent:%?60?%}",""])},b962:function(t,e,i){var n=i("b32c");"string"===typeof n&&(n=[[t.i,n,""]]),n.locals&&(t.exports=n.locals);var a=i("4f06").default;a("638ea6d8",n,!0,{sourceMap:!1,shadowMode:!1})},b9d2:function(t,e,i){"use strict";var n=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("v-uni-view",{staticClass:"content"},[i("v-uni-view",{staticClass:"top"},[i("v-uni-image",{attrs:{src:"../../static/image/notice.png",mode:""},on:{click:function(e){e=t.$handleEvent(e),t.jump("../indexpage/news")}}}),i("v-uni-text",[t._v("有钱还")]),i("v-uni-image",{attrs:{src:"../../static/image/headset.png",mode:""}})],1),i("v-uni-view",{staticClass:"top_img"},[i("v-uni-view",{staticClass:"uni-padding-wrap"},[i("v-uni-view",{staticClass:"page-section swiper"},[i("v-uni-view",{staticClass:"page-section-spacing"},[i("v-uni-swiper",{staticClass:"swiper",attrs:{autoplay:t.autoplay,interval:t.interval,duration:t.duration,circular:t.circular}},t._l(t.img_list,function(t,e){return i("v-uni-swiper-item",{key:t.id},[i("v-uni-image",{staticClass:"bang_img",attrs:{src:t.pic,mode:"scaleToFill"}})],1)}),1)],1)],1)],1)],1),i("v-uni-view",{staticClass:"more"},[i("v-uni-image",{attrs:{src:"../../static/image/more.png",mode:"widthFix"}}),i("v-uni-view",{staticClass:"box"},[i("v-uni-view",{staticClass:"uni-swiper-msg"},[i("v-uni-swiper",{attrs:{vertical:"true",autoplay:"true",circular:"true",interval:"3000"}},t._l(t.msg,function(e,n){return i("v-uni-swiper-item",{key:n},[i("v-uni-text",{staticClass:"sw_left"},[t._v(t._s(e.account))]),i("v-uni-text",{staticClass:"sw_right"},[t._v("还款金额:"+t._s(e.money)+"元")])],1)}),1)],1)],1)],1),i("v-uni-view",{staticClass:"help"},[i("v-uni-view",{staticClass:"test"},[t._v("特色产品")]),t._l(t.lists,function(e){return i("v-uni-view",{key:e.id,staticClass:"newsList",on:{click:function(i){i=t.$handleEvent(i),t.jump("../indexpage/getArticle?id="+e.id)}}},[i("v-uni-view",{staticClass:"left"},[i("v-uni-image",{attrs:{src:e.image_input,mode:"scaleToFill"}})],1),i("v-uni-view",{staticClass:"right"},[i("v-uni-view",{staticClass:"newsList_title"},[t._v(t._s(e.title))]),i("v-uni-view",{staticClass:"newsList_concet"},[t._v(t._s(e.synopsis))])],1)],1)})],2),i("v-uni-view",{staticClass:"test"},[i("v-uni-view",{staticClass:"test_top"},[t._v("有钱还学院"),i("v-uni-text",[t._v("学习更多还卡知识摆脱卡奴")])],1),i("v-uni-view",{staticClass:"test_list"},t._l(t.article,function(e){return i("v-uni-view",{key:e.id,staticClass:"test_img",on:{click:function(i){i=t.$handleEvent(i),t.jump("../indexpage/visit?id="+e.id)}}},[i("v-uni-image",{attrs:{src:e.image_input,mode:"scaleToFill"}}),i("v-uni-view",{},[t._v(t._s(e.title))])],1)}),1)],1),t.notice_show?i("v-uni-view",{staticClass:"notice"},[i("v-uni-image",{attrs:{src:"../../static/image/close.png",mode:"aspectFit"},on:{click:function(e){e=t.$handleEvent(e),t.close()}}}),i("v-uni-view",{staticClass:"notice_title"},[t._v(t._s(t.notice.title))]),i("v-uni-view",{staticClass:"notice_content"},[t._v(t._s(t.notice.content))])],1):t._e()],1)},a=[];i.d(e,"a",function(){return n}),i.d(e,"b",function(){return a})},be23:function(t,e,i){"use strict";i.r(e);var n=i("b9d2"),a=i("7e3a");for(var o in a)"default"!==o&&function(t){i.d(e,t,function(){return a[t]})}(o);i("4f92");var r=i("2877"),s=Object(r["a"])(a["default"],n["a"],n["b"],!1,null,"6b96c4ec",null);e["default"]=s.exports},c4d9:function(t,e,i){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var n={data:function(){return{}},onReady:function(){uni.showLoading({title:"加载中"})}};e.default=n},f725:function(t,e,i){"use strict";i.r(e);var n=i("8c46"),a=i("56a5");for(var o in a)"default"!==o&&function(t){i.d(e,t,function(){return a[t]})}(o);i("a7e0");var r=i("2877"),s=Object(r["a"])(a["default"],n["a"],n["b"],!1,null,"5fc1f3b4",null);e["default"]=s.exports}}]);