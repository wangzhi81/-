(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["pages-API-download-file-download-file"],{"053c":function(n,t,i){"use strict";i.r(t);var a=i("eb9c"),e=i("a24a");for(var o in e)"default"!==o&&function(n){i.d(t,n,(function(){return e[n]}))}(o);i("0621");var c,u=i("f0c5"),r=Object(u["a"])(e["default"],a["b"],a["c"],!1,null,"39c220a3",null,!1,a["a"],c);t["default"]=r.exports},"0621":function(n,t,i){"use strict";var a=i("487a"),e=i.n(a);e.a},"0938":function(n,t,i){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0;var a={data:function(){return{title:"downloadFile",imageSrc:""}},onUnload:function(){this.imageSrc=""},methods:{downloadImage:function(){uni.showLoading({title:"下载中"});var n=this;uni.downloadFile({url:"https://img-cdn-qiniu.dcloud.net.cn/uniapp/images/uni@2x.png",success:function(t){console.log("downloadFile success, res is",t),n.imageSrc=t.tempFilePath,uni.hideLoading()},fail:function(n){console.log("downloadFile fail, err is:",n)}})}}};t.default=a},"3ad4":function(n,t,i){var a=i("24fb");t=a(!1),t.push([n.i,".img[data-v-39c220a3]{width:%?500?%;height:%?500?%;margin:0 auto}.image-container[data-v-39c220a3]{display:flex;justify-content:center;align-items:center}",""]),n.exports=t},"487a":function(n,t,i){var a=i("3ad4");"string"===typeof a&&(a=[[n.i,a,""]]),a.locals&&(n.exports=a.locals);var e=i("4f06").default;e("2fd373c0",a,!0,{sourceMap:!1,shadowMode:!1})},a24a:function(n,t,i){"use strict";i.r(t);var a=i("0938"),e=i.n(a);for(var o in a)"default"!==o&&function(n){i.d(t,n,(function(){return a[n]}))}(o);t["default"]=e.a},eb9c:function(n,t,i){"use strict";i.d(t,"b",(function(){return e})),i.d(t,"c",(function(){return o})),i.d(t,"a",(function(){return a}));var a={pageHead:i("2c31").default},e=function(){var n=this,t=n.$createElement,i=n._self._c||t;return i("v-uni-view",[i("page-head",{attrs:{title:n.title}}),i("v-uni-view",{staticClass:"uni-padding-wrap uni-common-mt"},[n.imageSrc?i("v-uni-view",{staticClass:"image-container"},[i("v-uni-image",{staticClass:"img",attrs:{src:n.imageSrc,mode:"center"}})],1):[i("v-uni-view",{staticClass:"uni-hello-text"},[n._v("点击按钮下载服务端示例图片（下载网络文件到本地临时目录）")]),i("v-uni-view",{staticClass:"uni-btn-v"},[i("v-uni-button",{attrs:{type:"primary"},on:{click:function(t){arguments[0]=t=n.$handleEvent(t),n.downloadImage.apply(void 0,arguments)}}},[n._v("下载")])],1)]],2)],1)},o=[]}}]);