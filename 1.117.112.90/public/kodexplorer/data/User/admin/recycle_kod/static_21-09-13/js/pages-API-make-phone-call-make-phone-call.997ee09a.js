(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["pages-API-make-phone-call-make-phone-call"],{2129:function(t,n,e){"use strict";e.d(n,"b",(function(){return a})),e.d(n,"c",(function(){return u})),e.d(n,"a",(function(){return i}));var i={pageHead:e("2c31").default},a=function(){var t=this,n=t.$createElement,e=t._self._c||n;return e("v-uni-view",[e("page-head",{attrs:{title:t.title}}),e("v-uni-view",{staticClass:"uni-padding-wrap uni-common-mt"},[e("v-uni-view",{staticClass:"uni-hello-text uni-center"},[t._v("请在下方输入电话号码")]),e("v-uni-input",{staticClass:"input uni-common-mt",attrs:{type:"number",name:"input"},on:{input:function(n){arguments[0]=n=t.$handleEvent(n),t.bindInput.apply(void 0,arguments)}}}),e("v-uni-view",{staticClass:"uni-btn-v uni-common-mt"},[e("v-uni-button",{attrs:{type:"primary",disabled:t.disabled},on:{click:function(n){arguments[0]=n=t.$handleEvent(n),t.makePhoneCall.apply(void 0,arguments)}}},[t._v("拨打")])],1)],1)],1)},u=[]},3919:function(t,n,e){"use strict";e.r(n);var i=e("d868"),a=e.n(i);for(var u in i)"default"!==u&&function(t){e.d(n,t,(function(){return i[t]}))}(u);n["default"]=a.a},7671:function(t,n,e){"use strict";var i=e("9191"),a=e.n(i);a.a},9191:function(t,n,e){var i=e("dcdf");"string"===typeof i&&(i=[[t.i,i,""]]),i.locals&&(t.exports=i.locals);var a=e("4f06").default;a("4a99ef70",i,!0,{sourceMap:!1,shadowMode:!1})},d868:function(t,n,e){"use strict";Object.defineProperty(n,"__esModule",{value:!0}),n.default=void 0;var i={data:function(){return{title:"makePhoneCall",disabled:!0}},methods:{bindInput:function(t){this.inputValue=t.detail.value,this.inputValue.length>0?this.disabled=!1:this.disabled=!0},makePhoneCall:function(){uni.makePhoneCall({phoneNumber:this.inputValue,success:function(){console.log("成功拨打电话")}})}}};n.default=i},dcdf:function(t,n,e){var i=e("24fb");n=i(!1),n.push([t.i,".input[data-v-63b2bd9d]{height:%?119?%;line-height:%?119?%;font-size:%?78?%;border-bottom:%?1?% solid #e2e2e2;text-align:center}",""]),t.exports=n},defe:function(t,n,e){"use strict";e.r(n);var i=e("2129"),a=e("3919");for(var u in a)"default"!==u&&function(t){e.d(n,t,(function(){return a[t]}))}(u);e("7671");var o,l=e("f0c5"),d=Object(l["a"])(a["default"],i["b"],i["c"],!1,null,"63b2bd9d",null,!1,i["a"],o);n["default"]=d.exports}}]);