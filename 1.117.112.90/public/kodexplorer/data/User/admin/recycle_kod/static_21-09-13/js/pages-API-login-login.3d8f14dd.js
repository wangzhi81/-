(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["pages-API-login-login"],{"00f0":function(n,e,t){var i=t("24fb");e=i(!1),e.push([n.i,"uni-button[data-v-47a7d76f]{background-color:#007aff;color:#fff}",""]),n.exports=e},"07fd":function(n,e,t){"use strict";t.d(e,"b",(function(){return o})),t.d(e,"c",(function(){return a})),t.d(e,"a",(function(){return i}));var i={pageHead:t("2c31").default},o=function(){var n=this,e=n.$createElement,t=n._self._c||e;return t("v-uni-view",[t("page-head",{attrs:{title:n.title}}),t("v-uni-view",{staticClass:"uni-padding-wrap"},[t("v-uni-view",{staticStyle:{background:"#FFF",padding:"40rpx"}},[!0===n.hasLogin?[t("v-uni-view",{staticClass:"uni-h3 uni-center uni-common-mt"},[n._v("已登录"),n.isUniverifyLogin?t("v-uni-text",{staticStyle:{"font-size":"0.8em"}},[n.phoneNumber.length?t("i",[n._v("（"+n._s(n.phoneNumber)+"）")]):t("i",{staticClass:"uni-icon_toast uni-loading"})]):n._e()],1),t("v-uni-view",{staticClass:"uni-hello-text uni-center"},[t("v-uni-text",[n._v("每个账号仅需登录 1 次，\\n后续每次进入页面即可自动拉取用户信息。")])],1)]:n._e(),!1===n.hasLogin?[t("v-uni-view",{staticClass:"uni-h3 uni-center uni-common-mt"},[n._v("未登录")]),t("v-uni-view",{staticClass:"uni-hello-text uni-center"},[n._v("请点击按钮登录")])]:n._e()],2),t("v-uni-view",{staticClass:"uni-btn-v uni- uni-common-mt"},n._l(n.providerList,(function(e,i){return t("v-uni-button",{key:i,staticClass:"page-body-button",attrs:{type:"primary",loading:"univerify"===e.id&&n.univerifyBtnLoading},on:{click:function(t){arguments[0]=t=n.$handleEvent(t),n.tologin(e)}}},[n._v(n._s(e.name))])})),1)],1)],1)},a=[]},"0ff6":function(n,e,t){"use strict";t.r(e);var i=t("e259"),o=t.n(i);for(var a in i)"default"!==a&&function(n){t.d(e,n,(function(){return i[n]}))}(a);e["default"]=o.a},"587d":function(n,e,t){"use strict";var i=t("a5bc"),o=t.n(i);o.a},a5bc:function(n,e,t){var i=t("00f0");"string"===typeof i&&(i=[[n.i,i,""]]),i.locals&&(n.exports=i.locals);var o=t("4f06").default;o("652a8c02",i,!0,{sourceMap:!1,shadowMode:!1})},d54a:function(n,e,t){"use strict";t.r(e);var i=t("07fd"),o=t("0ff6");for(var a in o)"default"!==a&&function(n){t.d(e,n,(function(){return o[n]}))}(a);t("587d");var r,u=t("f0c5"),c=Object(u["a"])(o["default"],i["b"],i["c"],!1,null,"47a7d76f",null,!1,i["a"],r);e["default"]=c.exports},e259:function(n,e,t){"use strict";var i=t("4ea4");t("99af"),t("c975"),t("d81d"),Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var o=i(t("3835"));t("96cf");var a=i(t("1da1")),r=i(t("5530")),u=t("26cb"),c="univerifyInfo",s={data:function(){return{title:"login",providerList:[],phoneNumber:"",univerifyBtnLoading:!1}},computed:(0,r.default)({},(0,u.mapState)(["hasLogin","isUniverifyLogin","univerifyErrorMsg"])),onLoad:function(){var n=this;uni.getProvider({service:"oauth",success:function(e){n.providerList=e.provider.map((function(n){var e="";switch(n){case"weixin":e="微信登录";break;case"qq":e="QQ登录";break;case"sinaweibo":e="新浪微博登录";break;case"xiaomi":e="小米登录";break;case"alipay":e="支付宝登录";break;case"baidu":e="百度登录";break;case"jd":e="京东登录";break;case"toutiao":e="头条登录";break;case"apple":e="苹果登录";break;case"univerify":e="一键登录";break}return{name:e,id:n}}))},fail:function(n){console.log("获取登录通道失败",n)}}),this.hasLogin&&this.isUniverifyLogin&&this.getPhoneNumber(uni.getStorageSync(c)).then((function(e){n.phoneNumber=e}))},methods:(0,r.default)((0,r.default)((0,r.default)({},(0,u.mapMutations)(["login","setUniverifyLogin"])),(0,u.mapActions)(["getPhoneNumber"])),{},{Toast:function(n){var e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:1e3;uni.showToast(Object.assign({},n,{duration:e}))},tologin:function(n){var e=this;"univerify"===n.id&&(this.univerifyBtnLoading=!0),uni.login({provider:n.id,success:function(){var t=(0,a.default)(regeneratorRuntime.mark((function t(i){return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:console.log("login success:",i),e.Toast({title:"登录成功"}),e.login(n.id);case 3:case"end":return t.stop()}}),t)})));function i(n){return t.apply(this,arguments)}return i}(),fail:function(n){if(console.log("login fail:",n),"30002"==n.code)return uni.closeAuthView(),void e.Toast({title:"其他登录方式"});1e3!=n.code?"30005"!=n.code?"30003"!=n.code&&uni.showModal({showCancel:!1,title:"登录失败",content:JSON.stringify(n)}):uni.showModal({showCancel:!1,title:"预登录失败",content:e.univerifyErrorMsg||n.errMsg}):uni.showModal({title:"登录失败",content:"".concat(n.errMsg,"\n，错误码：").concat(n.code),confirmText:"开通指南",cancelText:"确定",success:function(n){n.confirm&&setTimeout((function(){plus.runtime.openWeb("https://ask.dcloud.net.cn/article/37965")}),500)}})},complete:function(){e.univerifyBtnLoading=!1}})},loginByUniverify:function(n,e){var t=this;this.setUniverifyLogin(!0),uni.closeAuthView();var i=(0,r.default)({provider:n},e.authResult);this.getPhoneNumber(i).then((function(n){t.phoneNumber=n,uni.setStorageSync(c,i)})).catch((function(n){uni.showModal({showCancel:!1,title:"手机号获取失败",content:"".concat(n.errMsg,"\n，错误码：").concat(n.code)}),console.error(e)}))},loginByApple:function(n,e){return(0,a.default)(regeneratorRuntime.mark((function e(){var t,i,a,r,u;return regeneratorRuntime.wrap((function(e){while(1)switch(e.prev=e.next){case 0:return e.next=2,uni.getUserInfo({provider:n});case 2:a=e.sent,r=(0,o.default)(a,2),t=r[0],i=r[1],t&&(u=t.errMsg,~u.indexOf("uni.login")&&(u="请在登录页面完成登录操作"),uni.showModal({title:"获取用户信息失败",content:"错误原因"+u,showCancel:!1})),console.warn("此处使用uni-id处理苹果登录，详情参考: https://uniapp.dcloud.net.cn/uniCloud/uni-id"),uni.request({url:"https://97fca9f2-41f6-449f-a35e-3f135d4c3875.bspapp.com/http/user-center",method:"POST",data:{action:"loginByApple",params:i.userInfo},success:function(n){console.log("uniId login success",n),0!==n.data.code?uni.showModal({showCancel:!1,content:"苹果登录失败: ".concat(JSON.stringify(n.data.msg))}):(uni.setStorageSync("openid",n.data.openid),uni.setStorageSync("apple_nickname",n.data.userInfo.nickname))},fail:function(n){uni.showModal({content:"苹果登录失败: ".concat(JSON.stringify(n)),showCancel:!1})}});case 9:case"end":return e.stop()}}),e)})))()}})};e.default=s}}]);