(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["pages-API-request-payment-request-payment"],{"1fdf":function(e,n,t){var i=t("28d2");"string"===typeof i&&(i=[[e.i,i,""]]),i.locals&&(e.exports=i.locals);var a=t("4f06").default;a("397270c1",i,!0,{sourceMap:!1,shadowMode:!1})},"28d2":function(e,n,t){var i=t("24fb");n=i(!1),n.push([e.i,".rmbLogo[data-v-345ab026]{font-size:%?40?%}uni-button[data-v-345ab026]{background-color:#007aff;color:#fff}.uni-h1.uni-center[data-v-345ab026]{display:flex;flex-direction:row;justify-content:center;align-items:flex-end}.price[data-v-345ab026]{border-bottom:1px solid #eee;width:%?200?%;height:%?80?%;padding-bottom:%?4?%}.ipaPayBtn[data-v-345ab026]{margin-top:%?30?%}",""]),e.exports=n},"8efc":function(e,n,t){"use strict";var i=t("1fdf"),a=t.n(i);a.a},bff4:function(e,n,t){"use strict";t.r(n);var i=t("d03a"),a=t("d36d");for(var o in a)"default"!==o&&function(e){t.d(n,e,(function(){return a[e]}))}(o);t("8efc");var r,u=t("f0c5"),c=Object(u["a"])(a["default"],i["b"],i["c"],!1,null,"345ab026",null,!1,i["a"],r);n["default"]=c.exports},ce42:function(e,n,t){"use strict";var i=t("4ea4");t("a9e3"),t("d3b7"),Object.defineProperty(n,"__esModule",{value:!0}),n.default=void 0;var a=i(t("5530"));t("96cf");var o=i(t("1da1")),r={data:function(){return{title:"request-payment",loading:!1,price:1,providerList:[]}},onLoad:function(){},methods:{loginMpWeixin:function(){return new Promise((function(e,n){uni.login({provider:"weixin",success:function(t){console.warn("此处使用uni-id处理微信小程序登录，详情参考: https://uniapp.dcloud.net.cn/uniCloud/uni-id"),uni.request({url:"https://97fca9f2-41f6-449f-a35e-3f135d4c3875.bspapp.com/http/user-center",method:"POST",data:{action:"loginByWeixin",params:{code:t.code,platform:"mp-weixin"}},success:function(t){0===t.data.code?(uni.setStorageSync("openid",t.data.openid),e(t.data.openid)):n(new Error("获取openid失败：",t.result.msg))},fail:function(e){n(new Error("获取openid失败："+e))}})},fail:function(e){n(e)}})}))},weixinPay:function(){var e=this;return(0,o.default)(regeneratorRuntime.mark((function n(){var t,i;return regeneratorRuntime.wrap((function(n){while(1)switch(n.prev=n.next){case 0:if(t=uni.getStorageSync("openid"),console.log("发起支付"),e.loading=!0,t){n.next=17;break}return n.prev=4,n.next=7,e.loginMpWeixin();case 7:t=n.sent,n.next=13;break;case 10:n.prev=10,n.t0=n["catch"](4),console.error(n.t0);case 13:if(t){n.next=17;break}return uni.showModal({content:"获取openid失败",showCancel:!1}),e.loading=!1,n.abrupt("return");case 17:return e.openid=t,n.next=20,e.getOrderInfo("wxpay");case 20:if(i=n.sent,i){n.next=24;break}return uni.showModal({content:"获取支付信息失败",showCancel:!1}),n.abrupt("return");case 24:uni.requestPayment((0,a.default)((0,a.default)({},i),{},{success:function(e){uni.showToast({title:"感谢您的赞助!"})},fail:function(e){uni.showModal({content:"支付失败,原因为: "+e.errMsg,showCancel:!1})},complete:function(){e.loading=!1}}));case 25:case"end":return n.stop()}}),n,null,[[4,10]])})))()},requestPayment:function(e,n){var t=this;return(0,o.default)(regeneratorRuntime.mark((function i(){var a,o;return regeneratorRuntime.wrap((function(i){while(1)switch(i.prev=i.next){case 0:return t.providerList[n].loading=!0,a=e.id,i.next=4,t.getOrderInfo(a);case 4:if(o=i.sent,o){i.next=8;break}return uni.showModal({content:"获取支付信息失败",showCancel:!1}),i.abrupt("return");case 8:console.log("--------orderInfo--------"),console.log(o),uni.requestPayment({provider:a,orderInfo:o,success:function(e){console.log("success",e),uni.showToast({title:"感谢您的赞助!"})},fail:function(e){console.log("fail",e),uni.showModal({content:"支付失败,原因为: "+e.errMsg,showCancel:!1})},complete:function(){t.providerList[n].loading=!1}});case 11:case"end":return i.stop()}}),i)})))()},getOrderInfo:function(e){var n=this;return new Promise((function(t,i){n.price||i(new Error("请输入金额")),console.warn("此处使用uni-pay处理支付，详情参考: https://uniapp.dcloud.io/uniCloud/unipay"),uni.request({method:"POST",url:"https://97fca9f2-41f6-449f-a35e-3f135d4c3875.bspapp.com/http/pay",data:{provider:e,openid:n.openid,totalFee:100*Number(n.price)},success:function(e){0===e.data.code?t(e.data.orderInfo):i(new Error("获取支付信息失败"+e.data.msg))},fail:function(e){i(new Error("请求支付接口失败"+e))}})}))},priceChange:function(e){console.log(e.detail.value),this.price=e.detail.value}}};n.default=r},d03a:function(e,n,t){"use strict";t.d(n,"b",(function(){return a})),t.d(n,"c",(function(){return o})),t.d(n,"a",(function(){return i}));var i={pageHead:t("2c31").default},a=function(){var e=this,n=e.$createElement,t=e._self._c||n;return t("v-uni-view",[t("page-head",{attrs:{title:e.title}}),t("v-uni-view",{staticClass:"uni-padding-wrap"},[t("v-uni-view",{staticStyle:{background:"#FFF",padding:"50rpx 0"}},[t("v-uni-view",{staticClass:"uni-hello-text uni-center"},[t("v-uni-text",[e._v("支付金额")])],1),t("v-uni-view",{staticClass:"uni-h1 uni-center uni-common-mt"},[t("v-uni-text",{staticClass:"rmbLogo"},[e._v("￥")]),t("v-uni-input",{staticClass:"price",attrs:{type:"digit",value:e.price,maxlength:"4"},on:{input:function(n){arguments[0]=n=e.$handleEvent(n),e.priceChange.apply(void 0,arguments)}}})],1)],1),t("v-uni-view",{staticClass:"uni-btn-v uni-common-mt"})],1)],1)},o=[]},d36d:function(e,n,t){"use strict";t.r(n);var i=t("ce42"),a=t.n(i);for(var o in i)"default"!==o&&function(e){t.d(n,e,(function(){return i[e]}))}(o);n["default"]=a.a}}]);