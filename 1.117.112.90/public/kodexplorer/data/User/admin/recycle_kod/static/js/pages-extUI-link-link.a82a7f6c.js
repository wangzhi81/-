(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["pages-extUI-link-link"],{"0785":function(t,n,e){"use strict";var i;e.d(n,"b",(function(){return u})),e.d(n,"c",(function(){return a})),e.d(n,"a",(function(){return i}));var u=function(){var t=this,n=t.$createElement,e=t._self._c||n;return t.isShowA?e("a",{staticClass:"uni-link",class:{"uni-link--withline":!0===t.showUnderLine||"true"===t.showUnderLine},style:{color:t.color,fontSize:t.fontSize+"px"},attrs:{href:t.href,download:t.download}},[t._t("default",[t._v(t._s(t.text))])],2):e("v-uni-text",{staticClass:"uni-link",class:{"uni-link--withline":!0===t.showUnderLine||"true"===t.showUnderLine},style:{color:t.color,fontSize:t.fontSize+"px"},on:{click:function(n){arguments[0]=n=t.$handleEvent(n),t.openURL.apply(void 0,arguments)}}},[t._t("default",[t._v(t._s(t.text))])],2)},a=[]},1316:function(t,n,e){"use strict";e("a9e3"),e("2ca0"),Object.defineProperty(n,"__esModule",{value:!0}),n.default=void 0;var i={name:"uniLink",props:{href:{type:String,default:""},text:{type:String,default:""},download:{type:String,default:""},showUnderLine:{type:[Boolean,String],default:!0},copyTips:{type:String,default:"已自动复制网址，请在手机浏览器里粘贴该网址"},color:{type:String,default:"#999999"},fontSize:{type:[Number,String],default:14}},computed:{isShowA:function(){return this._isH5=!0,!(!this.isMail()&&!this.isTel()||!0!==this._isH5)}},created:function(){this._isH5=null},methods:{isMail:function(){return this.href.startsWith("mailto:")},isTel:function(){return this.href.startsWith("tel:")},openURL:function(){window.open(this.href)},makePhoneCall:function(t){uni.makePhoneCall({phoneNumber:t})}}};n.default=i},"8e23":function(t,n,e){"use strict";e.r(n);var i=e("0785"),u=e("b48e");for(var a in u)"default"!==a&&function(t){e.d(n,t,(function(){return u[t]}))}(a);e("fdf4");var o,r=e("f0c5"),s=Object(r["a"])(u["default"],i["b"],i["c"],!1,null,"604a1870",null,!1,i["a"],o);n["default"]=s.exports},9271:function(t,n,e){var i=e("24fb");n=i(!1),n.push([t.i,"\n.uni-link[data-v-604a1870]{cursor:pointer}\n.uni-link--withline[data-v-604a1870]{text-decoration:underline}",""]),t.exports=n},"9b33":function(t,n,e){var i=e("9271");"string"===typeof i&&(i=[[t.i,i,""]]),i.locals&&(t.exports=i.locals);var u=e("4f06").default;u("13c4685a",i,!0,{sourceMap:!1,shadowMode:!1})},a16b:function(t,n,e){"use strict";e.d(n,"b",(function(){return u})),e.d(n,"c",(function(){return a})),e.d(n,"a",(function(){return i}));var i={uniCard:e("9948").default,uniSection:e("041f").default,uniLink:e("8e23").default},u=function(){var t=this,n=t.$createElement,e=t._self._c||n;return e("v-uni-view",{staticClass:"container"},[e("uni-card",{attrs:{"is-full":!0,"is-shadow":!1}},[e("v-uni-text",{staticClass:"uni-h6"},[t._v("超链接组件，在小程序内复制url，在app内打开外部浏览器，在h5端打开新网页。")])],1),e("uni-section",{attrs:{title:"基本示例",subTitle:"打开外部连接",type:"line",padding:!0}},[e("uni-link",{attrs:{href:"https://uniapp.dcloud.io/",text:"https://uniapp.dcloud.io/"}})],1),e("uni-section",{attrs:{title:"自定义颜色",type:"line",padding:!0}},[e("uni-link",{attrs:{href:"https://uniapp.dcloud.io/",text:"https://uniapp.dcloud.io/",color:"#007BFF"}})],1),e("uni-section",{attrs:{title:"自定义下划线",type:"line",padding:!0}},[e("uni-link",{attrs:{href:"https://uniapp.dcloud.io/",text:"https://uniapp.dcloud.io/",showUnderLine:"false"}})],1),e("uni-section",{attrs:{title:"自定义字体大小",type:"line",padding:!0}},[e("uni-link",{attrs:{href:"https://uniapp.dcloud.io/",text:"https://uniapp.dcloud.io/",showUnderLine:"false","font-size":"20"}})],1),e("uni-section",{attrs:{title:"自定义插槽",type:"line",padding:!0}},[e("uni-link",{attrs:{href:"https://uniapp.dcloud.io/",text:"https://uniapp.dcloud.io/",showUnderLine:"false",color:"red"}},[t._v("点击跳转")])],1)],1)},a=[]},b48e:function(t,n,e){"use strict";e.r(n);var i=e("1316"),u=e.n(i);for(var a in i)"default"!==a&&function(t){e.d(n,t,(function(){return i[t]}))}(a);n["default"]=u.a},c1eb:function(t,n,e){"use strict";Object.defineProperty(n,"__esModule",{value:!0}),n.default=void 0;var i={components:{},data:function(){return{}}};n.default=i},f79d:function(t,n,e){"use strict";e.r(n);var i=e("c1eb"),u=e.n(i);for(var a in i)"default"!==a&&function(t){e.d(n,t,(function(){return i[t]}))}(a);n["default"]=u.a},fd3f:function(t,n,e){"use strict";e.r(n);var i=e("a16b"),u=e("f79d");for(var a in u)"default"!==a&&function(t){e.d(n,t,(function(){return u[t]}))}(a);var o,r=e("f0c5"),s=Object(r["a"])(u["default"],i["b"],i["c"],!1,null,"792f28a8",null,!1,i["a"],o);n["default"]=s.exports},fdf4:function(t,n,e){"use strict";var i=e("9b33"),u=e.n(i);u.a}}]);