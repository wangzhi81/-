(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["pages-extUI-drawer-drawer"],{3839:function(t,e,n){"use strict";var i=n("a602"),a=n.n(i);a.a},"5e11":function(t,e,n){"use strict";var i;n.d(e,"b",(function(){return a})),n.d(e,"c",(function(){return s})),n.d(e,"a",(function(){return i}));var a=function(){var t=this,e=t.$createElement,n=t._self._c||e;return t.visibleSync?n("v-uni-view",{staticClass:"uni-drawer",class:{"uni-drawer--visible":t.showDrawer},on:{touchmove:function(e){e.stopPropagation(),e.preventDefault(),arguments[0]=e=t.$handleEvent(e),t.clear.apply(void 0,arguments)}}},[n("v-uni-view",{staticClass:"uni-drawer__mask",class:{"uni-drawer__mask--visible":t.showDrawer&&t.mask},on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.close("mask")}}}),n("v-uni-view",{staticClass:"uni-drawer__content",class:{"uni-drawer--right":t.rightMode,"uni-drawer--left":!t.rightMode,"uni-drawer__content--visible":t.showDrawer},style:{width:t.drawerWidth+"px"}},[t._t("default")],2),n("keypress",{on:{esc:function(e){arguments[0]=e=t.$handleEvent(e),t.close("mask")}}})],1):t._e()},s=[]},"87cb":function(t,e,n){"use strict";n("7db0"),n("caad"),n("b64b"),n("2532"),Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var i={name:"Keypress",props:{disable:{type:Boolean,default:!1}},mounted:function(){var t=this,e={esc:["Esc","Escape"],tab:"Tab",enter:"Enter",space:[" ","Spacebar"],up:["Up","ArrowUp"],left:["Left","ArrowLeft"],right:["Right","ArrowRight"],down:["Down","ArrowDown"],delete:["Backspace","Delete","Del"]},n=function(n){if(!t.disable){var i=Object.keys(e).find((function(t){var i=n.key,a=e[t];return a===i||Array.isArray(a)&&a.includes(i)}));i&&setTimeout((function(){t.$emit(i,{})}),0)}};document.addEventListener("keyup",n)},render:function(){}};e.default=i},9133:function(t,e,n){"use strict";n.r(e);var i=n("5e11"),a=n("b901");for(var s in a)"default"!==s&&function(t){n.d(e,t,(function(){return a[t]}))}(s);n("9355");var r,o=n("f0c5"),c=Object(o["a"])(a["default"],i["b"],i["c"],!1,null,"f4afff28",null,!1,i["a"],r);e["default"]=c.exports},9355:function(t,e,n){"use strict";var i=n("b30c"),a=n.n(i);a.a},"981e":function(t,e,n){"use strict";n.d(e,"b",(function(){return a})),n.d(e,"c",(function(){return s})),n.d(e,"a",(function(){return i}));var i={uniCard:n("9948").default,uniSection:n("041f").default,uniDrawer:n("9133").default},a=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("v-uni-view",[n("uni-card",{attrs:{"is-full":!0,"is-shadow":!1}},[n("v-uni-text",{staticClass:"uni-h6"},[t._v("这是抽屉式导航组件使用示例，可以指定菜单左侧或者右侧弹出（仅初始化生效），组件内部可以放置任何内容。点击页面按钮即可显示导航菜单。")])],1),n("uni-section",{attrs:{title:"左侧滑出",type:"line"}},[n("v-uni-view",{staticClass:"example-body"},[n("v-uni-button",{attrs:{type:"primary"},on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.showDrawer("showLeft")}}},[n("v-uni-text",{staticClass:"word-btn-white"},[t._v("显示Drawer")])],1),n("uni-drawer",{ref:"showLeft",attrs:{mode:"left",width:320},on:{change:function(e){arguments[0]=e=t.$handleEvent(e),t.change(e,"showLeft")}}},[n("v-uni-view",{staticClass:"close"},[n("v-uni-button",{on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.closeDrawer("showLeft")}}},[n("v-uni-text",{staticClass:"word-btn-white"},[t._v("关闭Drawer")])],1)],1)],1)],1)],1),n("uni-section",{attrs:{title:"右侧滑出",type:"line"}},[n("v-uni-view",{staticClass:"example-body"},[n("v-uni-button",{attrs:{type:"primary"},on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.showDrawer("showRight")}}},[n("v-uni-text",{staticClass:"word-btn-white"},[t._v("显示Drawer")])],1),n("uni-drawer",{ref:"showRight",attrs:{mode:"right","mask-click":!1},on:{change:function(e){arguments[0]=e=t.$handleEvent(e),t.change(e,"showRight")}}},[n("v-uni-view",{staticClass:"scroll-view"},[n("v-uni-scroll-view",{staticClass:"scroll-view-box",attrs:{"scroll-y":"true"}},[n("v-uni-view",{staticClass:"info"},[n("v-uni-text",{staticClass:"info-text"},[t._v("右侧遮罩只能通过按钮关闭，不能通过点击遮罩关闭")])],1),n("v-uni-view",{staticClass:"close"},[n("v-uni-button",{on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.closeDrawer("showRight")}}},[n("v-uni-text",{staticClass:"word-btn-white"},[t._v("关闭Drawer")])],1)],1),t._l(100,(function(e){return n("v-uni-view",{key:e,staticClass:"info-content"},[n("v-uni-text",[t._v("可滚动内容 "+t._s(e))])],1)})),n("v-uni-view",{staticClass:"close"},[n("v-uni-button",{on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.closeDrawer("showRight")}}},[n("v-uni-text",{staticClass:"word-btn-white"},[t._v("关闭Drawer")])],1)],1)],2)],1)],1)],1)],1)],1)},s=[]},"9a41":function(t,e,n){"use strict";n.r(e);var i=n("981e"),a=n("9d54");for(var s in a)"default"!==s&&function(t){n.d(e,t,(function(){return a[t]}))}(s);n("3839");var r,o=n("f0c5"),c=Object(o["a"])(a["default"],i["b"],i["c"],!1,null,"6e9e9c04",null,!1,i["a"],r);e["default"]=c.exports},"9a70":function(t,e,n){var i=n("24fb");e=i(!1),e.push([t.i,'@charset "UTF-8";\n/**\n * 这里是uni-app内置的常用样式变量\n *\n * uni-app 官方扩展插件及插件市场（https://ext.dcloud.net.cn）上很多三方插件均使用了这些样式变量\n * 如果你是插件开发者，建议你使用scss预处理，并在插件代码中直接使用这些变量（无需 import 这个文件），方便用户通过搭积木的方式开发整体风格一致的App\n *\n */\n/**\n * 如果你是App开发者（插件使用者），你可以通过修改这些变量来定制自己的插件主题，实现自定义主题功能\n *\n * 如果你的项目同样使用了scss预处理，你也可以直接在你的 scss 代码中使用如下变量，同时无需 import 这个文件\n */\n/* 颜色变量 */\n/* 行为相关颜色 */\n/* 文字基本颜色 */\n/* 背景颜色 */\n/* 边框颜色 */\n/* 尺寸变量 */\n/* 文字尺寸 */\n/* 图片尺寸 */\n/* Border Radius */\n/* 水平间距 */\n/* 垂直间距 */\n/* 透明度 */\n/* 文章场景相关 */.example-body[data-v-6e9e9c04]{padding:10px}.scroll-view[data-v-6e9e9c04]{width:100%;height:100%;flex:1}.scroll-view-box[data-v-6e9e9c04]{flex:1;position:absolute;top:0;right:0;bottom:0;left:0}.info[data-v-6e9e9c04]{padding:15px;color:#666}.info-text[data-v-6e9e9c04]{font-size:14px;color:#666}.info-content[data-v-6e9e9c04]{padding:5px 15px}.close[data-v-6e9e9c04]{padding:10px}',""]),t.exports=e},"9d54":function(t,e,n){"use strict";n.r(e);var i=n("ee97"),a=n.n(i);for(var s in i)"default"!==s&&function(t){n.d(e,t,(function(){return i[t]}))}(s);e["default"]=a.a},a602:function(t,e,n){var i=n("9a70");"string"===typeof i&&(i=[[t.i,i,""]]),i.locals&&(t.exports=i.locals);var a=n("4f06").default;a("e64eb96e",i,!0,{sourceMap:!1,shadowMode:!1})},b30c:function(t,e,n){var i=n("e90f");"string"===typeof i&&(i=[[t.i,i,""]]),i.locals&&(t.exports=i.locals);var a=n("4f06").default;a("0622060c",i,!0,{sourceMap:!1,shadowMode:!1})},b901:function(t,e,n){"use strict";n.r(e);var i=n("cc6a"),a=n.n(i);for(var s in i)"default"!==s&&function(t){n.d(e,t,(function(){return i[t]}))}(s);e["default"]=a.a},cc6a:function(t,e,n){"use strict";var i=n("4ea4");n("a9e3"),Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var a=i(n("87cb")),s={name:"UniDrawer",components:{keypress:a.default},emits:["change"],props:{mode:{type:String,default:""},mask:{type:Boolean,default:!0},maskClick:{type:Boolean,default:!0},width:{type:Number,default:220}},data:function(){return{visibleSync:!1,showDrawer:!1,rightMode:!1,watchTimer:null,drawerWidth:220}},created:function(){this.drawerWidth=this.width,this.rightMode="right"===this.mode},methods:{clear:function(){},close:function(t){("mask"!==t||this.maskClick)&&this.visibleSync&&this._change("showDrawer","visibleSync",!1)},open:function(){this.visibleSync||this._change("visibleSync","showDrawer",!0)},_change:function(t,e,n){var i=this;this[t]=n,this.watchTimer&&clearTimeout(this.watchTimer),this.watchTimer=setTimeout((function(){i[e]=n,i.$emit("change",n)}),n?50:300)}}};e.default=s},e90f:function(t,e,n){var i=n("24fb");e=i(!1),e.push([t.i,'@charset "UTF-8";\n/**\n * 这里是uni-app内置的常用样式变量\n *\n * uni-app 官方扩展插件及插件市场（https://ext.dcloud.net.cn）上很多三方插件均使用了这些样式变量\n * 如果你是插件开发者，建议你使用scss预处理，并在插件代码中直接使用这些变量（无需 import 这个文件），方便用户通过搭积木的方式开发整体风格一致的App\n *\n */\n/**\n * 如果你是App开发者（插件使用者），你可以通过修改这些变量来定制自己的插件主题，实现自定义主题功能\n *\n * 如果你的项目同样使用了scss预处理，你也可以直接在你的 scss 代码中使用如下变量，同时无需 import 这个文件\n */\n/* 颜色变量 */\n/* 行为相关颜色 */\n/* 文字基本颜色 */\n/* 背景颜色 */\n/* 边框颜色 */\n/* 尺寸变量 */\n/* 文字尺寸 */\n/* 图片尺寸 */\n/* Border Radius */\n/* 水平间距 */\n/* 垂直间距 */\n/* 透明度 */\n/* 文章场景相关 */.uni-drawer[data-v-f4afff28]{display:block;position:fixed;top:0;left:0;right:0;bottom:0;overflow:hidden;z-index:999}.uni-drawer__content[data-v-f4afff28]{display:block;position:absolute;top:0;width:220px;bottom:0;background-color:#fff;transition:-webkit-transform .3s ease;transition:transform .3s ease;transition:transform .3s ease,-webkit-transform .3s ease}.uni-drawer--left[data-v-f4afff28]{left:0;-webkit-transform:translateX(-100%);transform:translateX(-100%)}.uni-drawer--right[data-v-f4afff28]{right:0;-webkit-transform:translateX(100%);transform:translateX(100%)}.uni-drawer__content--visible[data-v-f4afff28]{-webkit-transform:translateX(0);transform:translateX(0)}.uni-drawer__mask[data-v-f4afff28]{display:block;opacity:0;position:absolute;top:0;left:0;bottom:0;right:0;background-color:rgba(0,0,0,.4);transition:opacity .3s}.uni-drawer__mask--visible[data-v-f4afff28]{display:block;opacity:1}',""]),t.exports=e},ee97:function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var i={data:function(){return{showRight:!1,showLeft:!1}},methods:{confirm:function(){},showDrawer:function(t){this.$refs[t].open()},closeDrawer:function(t){this.$refs[t].close()},change:function(t,e){console.log(("showLeft"===e?"左窗口":"右窗口")+(t?"打开":"关闭")),this[e]=t}},onNavigationBarButtonTap:function(t){this.showLeft?this.$refs.showLeft.close():this.$refs.showLeft.open()},onBackPress:function(){if(this.showRight||this.showLeft)return this.$refs.showLeft.close(),this.$refs.showRight.close(),!0}};e.default=i}}]);