(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["pages-extUI-goods-nav-goods-nav"],{"0684":function(t,n,o){var i=o("24fb");n=i(!1),n.push([t.i,'@charset "UTF-8";\n/**\n * 这里是uni-app内置的常用样式变量\n *\n * uni-app 官方扩展插件及插件市场（https://ext.dcloud.net.cn）上很多三方插件均使用了这些样式变量\n * 如果你是插件开发者，建议你使用scss预处理，并在插件代码中直接使用这些变量（无需 import 这个文件），方便用户通过搭积木的方式开发整体风格一致的App\n *\n */\n/**\n * 如果你是App开发者（插件使用者），你可以通过修改这些变量来定制自己的插件主题，实现自定义主题功能\n *\n * 如果你的项目同样使用了scss预处理，你也可以直接在你的 scss 代码中使用如下变量，同时无需 import 这个文件\n */\n/* 颜色变量 */\n/* 行为相关颜色 */\n/* 文字基本颜色 */\n/* 背景颜色 */\n/* 边框颜色 */\n/* 尺寸变量 */\n/* 文字尺寸 */\n/* 图片尺寸 */\n/* Border Radius */\n/* 水平间距 */\n/* 垂直间距 */\n/* 透明度 */\n/* 文章场景相关 */.flex[data-v-4f827f92]{display:flex;flex-direction:row}.uni-goods-nav[data-v-4f827f92]{display:flex;flex:1;flex-direction:row}.uni-tab__cart-box[data-v-4f827f92]{flex:1;height:50px;background-color:#fff;z-index:900}.uni-tab__cart-sub-left[data-v-4f827f92]{padding:0 5px}.uni-tab__cart-sub-right[data-v-4f827f92]{flex:1}.uni-tab__right[data-v-4f827f92]{margin:5px 0;margin-right:10px;border-radius:100px;overflow:hidden}.uni-tab__cart-button-left[data-v-4f827f92]{display:flex;position:relative;justify-content:center;align-items:center;flex-direction:column;margin:0 10px;cursor:pointer}.uni-tab__icon[data-v-4f827f92]{width:18px;height:18px}.image[data-v-4f827f92]{width:18px;height:18px}.uni-tab__text[data-v-4f827f92]{margin-top:3px;font-size:12px;color:#646566}.uni-tab__cart-button-right[data-v-4f827f92]{display:flex;flex-direction:column;flex:1;justify-content:center;align-items:center;cursor:pointer}.uni-tab__cart-button-right-text[data-v-4f827f92]{font-size:14px;color:#fff}.uni-tab__cart-button-right[data-v-4f827f92]:active{opacity:.7}.uni-tab__dot-box[data-v-4f827f92]{display:flex;flex-direction:column;position:absolute;right:-2px;top:2px;justify-content:center;align-items:center}.uni-tab__dot[data-v-4f827f92]{padding:0 4px;line-height:15px;color:#fff;text-align:center;font-size:12px;background-color:red;border-radius:15px}.uni-tab__dots[data-v-4f827f92]{padding:0 4px;border-radius:15px}',""]),t.exports=n},2169:function(t,n,o){var i=o("24fb");n=i(!1),n.push([t.i,'@charset "UTF-8";\n/**\n * 这里是uni-app内置的常用样式变量\n *\n * uni-app 官方扩展插件及插件市场（https://ext.dcloud.net.cn）上很多三方插件均使用了这些样式变量\n * 如果你是插件开发者，建议你使用scss预处理，并在插件代码中直接使用这些变量（无需 import 这个文件），方便用户通过搭积木的方式开发整体风格一致的App\n *\n */\n/**\n * 如果你是App开发者（插件使用者），你可以通过修改这些变量来定制自己的插件主题，实现自定义主题功能\n *\n * 如果你的项目同样使用了scss预处理，你也可以直接在你的 scss 代码中使用如下变量，同时无需 import 这个文件\n */\n/* 颜色变量 */\n/* 行为相关颜色 */\n/* 文字基本颜色 */\n/* 背景颜色 */\n/* 边框颜色 */\n/* 尺寸变量 */\n/* 文字尺寸 */\n/* 图片尺寸 */\n/* Border Radius */\n/* 水平间距 */\n/* 垂直间距 */\n/* 透明度 */\n/* 文章场景相关 */.example-body[data-v-133eb1f1]{padding:0;display:block}.goods-carts[data-v-133eb1f1]{display:flex;flex-direction:column;position:fixed;left:0;right:0;left:var(--window-left);right:var(--window-right);bottom:0}',""]),t.exports=n},2739:function(t,n,o){"use strict";Object.defineProperty(n,"__esModule",{value:!0}),n.default=void 0;var i={components:{},data:function(){return{options:[{icon:"chat",text:"客服"},{icon:"shop",text:"店铺",info:2,infoBackgroundColor:"#007aff",infoColor:"#f5f5f5"},{icon:"cart",text:"购物车",info:2}],buttonGroup:[{text:"加入购物车",backgroundColor:"linear-gradient(90deg, #FFCD1E, #FF8A18)",color:"#fff"},{text:"立即购买",backgroundColor:"linear-gradient(90deg, #FE6035, #EF1224)",color:"#fff"}],customButtonGroup:[{text:"加入购物车",backgroundColor:"linear-gradient(90deg, #1E83FF, #0053B8)",color:"#fff"},{text:"立即购买",backgroundColor:"linear-gradient(90deg, #60F3FF, #088FEB)",color:"#fff"}],customButtonGroup1:[{text:"立即购买",backgroundColor:"linear-gradient(90deg, #FE6035, #EF1224)",color:"#fff"}]}},onLoad:function(){},methods:{onClick:function(t){uni.showToast({title:"点击".concat(t.content.text),icon:"none"})},buttonClick:function(t){console.log(t),this.options[2].info++}}};n.default=i},"5c37":function(t,n,o){var i=o("2169");"string"===typeof i&&(i=[[t.i,i,""]]),i.locals&&(t.exports=i.locals);var a=o("4f06").default;a("077b934f",i,!0,{sourceMap:!1,shadowMode:!1})},"5e0e":function(t,n,o){"use strict";o.r(n);var i=o("6170"),a=o.n(i);for(var e in i)"default"!==e&&function(t){o.d(n,t,(function(){return i[t]}))}(e);n["default"]=a.a},6028:function(t,n,o){"use strict";o.r(n);var i=o("971c"),a=o("b397");for(var e in a)"default"!==e&&function(t){o.d(n,t,(function(){return a[t]}))}(e);o("fa47");var u,r=o("f0c5"),c=Object(r["a"])(a["default"],i["b"],i["c"],!1,null,"133eb1f1",null,!1,i["a"],u);n["default"]=c.exports},6170:function(t,n,o){"use strict";var i=o("4ea4");Object.defineProperty(n,"__esModule",{value:!0}),n.default=void 0;var a=o("37dc"),e=i(o("ca0d")),u=(0,a.initVueI18n)(e.default),r=u.t,c={name:"UniGoodsNav",emits:["click","buttonClick"],props:{options:{type:Array,default:function(){return[{icon:"shop",text:r("uni-goods-nav.options.shop")},{icon:"cart",text:r("uni-goods-nav.options.cart")}]}},buttonGroup:{type:Array,default:function(){return[{text:r("uni-goods-nav.buttonGroup.addToCart"),backgroundColor:"linear-gradient(90deg, #FFCD1E, #FF8A18)",color:"#fff"},{text:r("uni-goods-nav.buttonGroup.buyNow"),backgroundColor:"linear-gradient(90deg, #FE6035, #EF1224)",color:"#fff"}]}},fill:{type:Boolean,default:!1}},methods:{onClick:function(t,n){this.$emit("click",{index:t,content:n})},buttonClick:function(t,n){uni.report&&uni.report(n.text,n.text),this.$emit("buttonClick",{index:t,content:n})}}};n.default=c},6261:function(t,n,o){"use strict";o.d(n,"b",(function(){return a})),o.d(n,"c",(function(){return e})),o.d(n,"a",(function(){return i}));var i={uniIcons:o("58e4").default},a=function(){var t=this,n=t.$createElement,o=t._self._c||n;return o("v-uni-view",{staticClass:"uni-goods-nav"},[o("v-uni-view",{staticClass:"uni-tab__seat"}),o("v-uni-view",{staticClass:"uni-tab__cart-box flex"},[o("v-uni-view",{staticClass:"flex uni-tab__cart-sub-left"},t._l(t.options,(function(n,i){return o("v-uni-view",{key:i,staticClass:"flex uni-tab__cart-button-left uni-tab__shop-cart",on:{click:function(o){arguments[0]=o=t.$handleEvent(o),t.onClick(i,n)}}},[o("v-uni-view",{staticClass:"uni-tab__icon"},[o("uni-icons",{attrs:{type:n.icon,size:"20",color:"#646566"}})],1),o("v-uni-text",{staticClass:"uni-tab__text"},[t._v(t._s(n.text))]),o("v-uni-view",{staticClass:"flex uni-tab__dot-box"},[n.info?o("v-uni-text",{staticClass:"uni-tab__dot ",class:{"uni-tab__dots":n.info>9},style:{backgroundColor:n.infoBackgroundColor?n.infoBackgroundColor:"#ff0000",color:n.infoColor?n.infoColor:"#fff"}},[t._v(t._s(n.info))]):t._e()],1)],1)})),1),o("v-uni-view",{staticClass:"flex uni-tab__cart-sub-right ",class:{"uni-tab__right":t.fill}},t._l(t.buttonGroup,(function(n,i){return o("v-uni-view",{key:i,staticClass:"flex uni-tab__cart-button-right",style:{background:n.backgroundColor,color:n.color},on:{click:function(o){arguments[0]=o=t.$handleEvent(o),t.buttonClick(i,n)}}},[o("v-uni-text",{staticClass:"uni-tab__cart-button-right-text",style:{color:n.color}},[t._v(t._s(n.text))])],1)})),1)],1)],1)},e=[]},"6f61":function(t){t.exports=JSON.parse('{"uni-goods-nav.options.shop":"shop","uni-goods-nav.options.cart":"cart","uni-goods-nav.buttonGroup.addToCart":"add to cart","uni-goods-nav.buttonGroup.buyNow":"buy now"}')},7353:function(t){t.exports=JSON.parse('{"uni-goods-nav.options.shop":"店铺","uni-goods-nav.options.cart":"购物车","uni-goods-nav.buttonGroup.addToCart":"加入购物车","uni-goods-nav.buttonGroup.buyNow":"立即购买"}')},"8e6d":function(t,n,o){"use strict";o.r(n);var i=o("6261"),a=o("5e0e");for(var e in a)"default"!==e&&function(t){o.d(n,t,(function(){return a[t]}))}(e);o("d710");var u,r=o("f0c5"),c=Object(r["a"])(a["default"],i["b"],i["c"],!1,null,"4f827f92",null,!1,i["a"],u);n["default"]=c.exports},"971c":function(t,n,o){"use strict";o.d(n,"b",(function(){return a})),o.d(n,"c",(function(){return e})),o.d(n,"a",(function(){return i}));var i={uniCard:o("9948").default,uniSection:o("041f").default,uniGoodsNav:o("8e6d").default},a=function(){var t=this,n=t.$createElement,o=t._self._c||n;return o("v-uni-view",{staticClass:"uni-container"},[o("uni-card",{attrs:{"is-full":!0}},[o("v-uni-text",{staticClass:"uni-h6"},[t._v("uni-goods-nav 组件主要用于电商类应用底部导航，可自定义加入购物车，购买等操作")])],1),o("uni-section",{attrs:{title:"基础用法",type:"line"}},[o("uni-goods-nav",{on:{click:function(n){arguments[0]=n=t.$handleEvent(n),t.onClick.apply(void 0,arguments)}}})],1),o("uni-section",{attrs:{title:"自定义用法",type:"line"}},[o("uni-goods-nav",{attrs:{fill:!0,options:t.options,"button-group":t.customButtonGroup},on:{click:function(n){arguments[0]=n=t.$handleEvent(n),t.onClick.apply(void 0,arguments)},buttonClick:function(n){arguments[0]=n=t.$handleEvent(n),t.buttonClick.apply(void 0,arguments)}}}),o("uni-goods-nav",{staticStyle:{"margin-top":"20px"},attrs:{fill:!0,options:t.options,"button-group":t.customButtonGroup1},on:{click:function(n){arguments[0]=n=t.$handleEvent(n),t.onClick.apply(void 0,arguments)},buttonClick:function(n){arguments[0]=n=t.$handleEvent(n),t.buttonClick.apply(void 0,arguments)}}})],1),o("v-uni-view",{staticClass:"goods-carts"},[o("uni-goods-nav",{attrs:{options:t.options,fill:!0,"button-group":t.buttonGroup},on:{click:function(n){arguments[0]=n=t.$handleEvent(n),t.onClick.apply(void 0,arguments)},buttonClick:function(n){arguments[0]=n=t.$handleEvent(n),t.buttonClick.apply(void 0,arguments)}}})],1)],1)},e=[]},afbb:function(t){t.exports=JSON.parse('{"uni-goods-nav.options.shop":"店鋪","uni-goods-nav.options.cart":"購物車","uni-goods-nav.buttonGroup.addToCart":"加入購物車","uni-goods-nav.buttonGroup.buyNow":"立即購買"}')},b397:function(t,n,o){"use strict";o.r(n);var i=o("2739"),a=o.n(i);for(var e in i)"default"!==e&&function(t){o.d(n,t,(function(){return i[t]}))}(e);n["default"]=a.a},ca0d:function(t,n,o){"use strict";var i=o("4ea4");Object.defineProperty(n,"__esModule",{value:!0}),n.default=void 0;var a=i(o("6f61")),e=i(o("7353")),u=i(o("afbb")),r={en:a.default,"zh-Hans":e.default,"zh-Hant":u.default};n.default=r},d710:function(t,n,o){"use strict";var i=o("ff42"),a=o.n(i);a.a},fa47:function(t,n,o){"use strict";var i=o("5c37"),a=o.n(i);a.a},ff42:function(t,n,o){var i=o("0684");"string"===typeof i&&(i=[[t.i,i,""]]),i.locals&&(t.exports=i.locals);var a=o("4f06").default;a("5248532f",i,!0,{sourceMap:!1,shadowMode:!1})}}]);