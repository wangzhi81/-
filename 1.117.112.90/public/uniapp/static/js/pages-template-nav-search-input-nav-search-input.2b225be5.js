(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["pages-template-nav-search-input-nav-search-input"],{"0b04":function(i,t,n){"use strict";n.r(t);var e=n("8575"),a=n("e38e");for(var u in a)"default"!==u&&function(i){n.d(t,i,(function(){return a[i]}))}(u);n("22b7");var r,v=n("f0c5"),c=Object(v["a"])(a["default"],e["b"],e["c"],!1,null,"5ab19a4f",null,!1,e["a"],r);t["default"]=c.exports},"22b7":function(i,t,n){"use strict";var e=n("43bb"),a=n.n(e);a.a},"43bb":function(i,t,n){var e=n("d908");"string"===typeof e&&(e=[[i.i,e,""]]),e.locals&&(i.exports=e.locals);var a=n("4f06").default;a("5e64951c",e,!0,{sourceMap:!1,shadowMode:!1})},8575:function(i,t,n){"use strict";var e;n.d(t,"b",(function(){return a})),n.d(t,"c",(function(){return u})),n.d(t,"a",(function(){return e}));var a=function(){var i=this,t=i.$createElement,n=i._self._c||t;return n("v-uni-view",{staticClass:"page"},[n("v-uni-swiper",{attrs:{"indicator-dots":"true"}},i._l(i.imgUrls,(function(i,t){return n("v-uni-swiper-item",{key:t},[n("v-uni-image",{attrs:{src:i}})],1)})),1),n("v-uni-view",{staticClass:"uni-padding-wrap uni-common-mt"},[n("v-uni-view",{staticClass:"uni-title"},[n("v-uni-view",[i._v("本示例为导航栏带搜索框完整功能演示，主要演示有：")]),n("v-uni-view",[i._v("1. 导航栏为 transparent 模式，向上滑动页面，导航栏会从透明变为实色。")]),n("v-uni-view",[i._v("2. 点击搜索框跳转到搜索页面。")]),n("v-uni-view",[i._v("3. 点击导航栏右侧按钮实现关联操作。")]),n("v-uni-view",[i._v("4. 搜索页面为提示词搜索，输入内容实时显示关联词。")]),n("v-uni-view",[i._v("5. 搜索结果根据搜索内容高亮显示文字。")]),n("v-uni-view",[i._v("6. 点击搜索列表或者软键盘搜索按钮，会将结果保存到搜索历史列表。")]),n("v-uni-view",[i._v("7. 点击删除图标，清空历史搜索列表。")]),n("v-uni-view",[i._v("Tips")]),n("v-uni-view",[i._v("1. 本示例目前仅支持 App 端")]),n("v-uni-view",[i._v("2. 所有示例均为演示使用，具体逻辑需要自己实现。")])],1)],1),n("v-uni-view",{staticStyle:{height:"1000rpx"}})],1)},u=[]},d908:function(i,t,n){var e=n("24fb");t=e(!1),t.push([i.i,"uni-image[data-v-5ab19a4f],\r\nuni-swiper[data-v-5ab19a4f],\r\n.img-view[data-v-5ab19a4f]{width:%?750?%;width:100%;height:%?500?%}.page-section-title[data-v-5ab19a4f]{margin-top:%?50?%}",""]),i.exports=t},e38e:function(i,t,n){"use strict";n.r(t);var e=n("ff90"),a=n.n(e);for(var u in e)"default"!==u&&function(i){n.d(t,i,(function(){return e[i]}))}(u);t["default"]=a.a},ff90:function(i,t,n){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0;var e={data:function(){return{showSwiper:!1,imgUrls:["https://vkceyugu.cdn.bspapp.com/VKCEYUGU-dc-site/b4b60b10-5168-11eb-bd01-97bc1429a9ff.jpg","https://vkceyugu.cdn.bspapp.com/VKCEYUGU-dc-site/b1dcfa70-5168-11eb-bd01-97bc1429a9ff.jpg"]}},onNavigationBarSearchInputClicked:function(i){console.log("事件执行了"),uni.navigateTo({url:"/pages/template/nav-search-input/detail/detail"})},onNavigationBarButtonTap:function(){uni.showModal({title:"提示",content:"用户点击了功能按钮，这里仅做展示。",success:function(i){i.confirm&&console.log("用户点击了确定")}})}};t.default=e}}]);