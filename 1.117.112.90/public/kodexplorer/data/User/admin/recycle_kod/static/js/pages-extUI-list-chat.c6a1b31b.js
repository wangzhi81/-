(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["pages-extUI-list-chat"],{1781:function(t,e,i){"use strict";var a=i("1a43"),n=i.n(a);n.a},"1a43":function(t,e,i){var a=i("56a8");"string"===typeof a&&(a=[[t.i,a,""]]),a.locals&&(t.exports=a.locals);var n=i("4f06").default;n("bb029288",a,!0,{sourceMap:!1,shadowMode:!1})},3510:function(t,e,i){"use strict";i.d(e,"b",(function(){return n})),i.d(e,"c",(function(){return s})),i.d(e,"a",(function(){return a}));var a={uniCard:i("9948").default,uniSection:i("041f").default,uniList:i("f175").default,uniListChat:i("3d46").default,uniIcons:i("58e4").default},n=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("v-uni-view",[i("uni-card",{attrs:{"is-shadow":!1,"is-full":!0}},[i("v-uni-text",{staticClass:"uni-h6"},[t._v("此示例展示了聊天列表的使用场景。")])],1),i("uni-section",{attrs:{title:"圆头像且不显示分割线",type:"line"}},[i("uni-list",{attrs:{border:!1}},t._l(t.listData,(function(t){return i("uni-list-chat",{key:t.id,attrs:{"avatar-circle":!0,title:t.author_name,avatar:t.cover,note:t.title,time:t.published_at,clickable:!1}})})),1)],1),i("uni-section",{attrs:{title:"带圆点",type:"line"}},[i("uni-list",t._l(t.listData,(function(t){return i("uni-list-chat",{key:t.id,attrs:{title:t.author_name,avatar:t.cover,note:t.title,time:t.published_at,"badge-text":t.text,clickable:!1,"badge-positon":"left","badge-text":"dot"}})})),1)],1),i("uni-section",{attrs:{title:"自定义右侧内容",type:"line"}},[i("uni-list",t._l(t.listData,(function(e){return i("uni-list-chat",{key:e.id,attrs:{title:e.author_name,avatar:e.cover,note:e.title,"badge-positon":"left","badge-text":e.text}},[i("v-uni-view",{staticClass:"chat-custom-right"},[i("v-uni-text",{staticClass:"chat-custom-text"},[t._v("刚刚")]),i("uni-icons",{attrs:{type:"star-filled",color:"#999",size:"18"}})],1)],1)})),1)],1),i("uni-section",{attrs:{title:"带通知角标的单头像聊天列表",type:"line"}},[i("uni-list",t._l(t.listData,(function(e){return i("uni-list-chat",{key:e.id,attrs:{title:e.author_name,avatar:e.cover,note:e.title,time:e.published_at,clickable:!0,"badge-text":e.text},on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.onClick.apply(void 0,arguments)}}})})),1)],1),i("uni-section",{attrs:{title:"带通知角标的多头像聊天列表",type:"line"}},[i("uni-list",t._l(t.listData,(function(e,a){return i("uni-list-chat",{key:e.id,attrs:{title:e.author_name,avatar:e.cover,note:e.title,time:e.published_at,clickable:!0,avatarList:t.avatar(a+1),"badge-text":e.text},on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.onClick.apply(void 0,arguments)}}})})),1)],1)],1)},s=[]},"3d46":function(t,e,i){"use strict";i.r(e);var a=i("7e81"),n=i("53b8");for(var s in n)"default"!==s&&function(t){i.d(e,t,(function(){return n[t]}))}(s);i("1781");var r,o=i("f0c5"),l=Object(o["a"])(n["default"],a["b"],a["c"],!1,null,"5a788973",null,!1,a["a"],r);e["default"]=l.exports},"42e4":function(t,e,i){var a=i("24fb");e=a(!1),e.push([t.i,'@charset "UTF-8";\n/**\n * 这里是uni-app内置的常用样式变量\n *\n * uni-app 官方扩展插件及插件市场（https://ext.dcloud.net.cn）上很多三方插件均使用了这些样式变量\n * 如果你是插件开发者，建议你使用scss预处理，并在插件代码中直接使用这些变量（无需 import 这个文件），方便用户通过搭积木的方式开发整体风格一致的App\n *\n */\n/**\n * 如果你是App开发者（插件使用者），你可以通过修改这些变量来定制自己的插件主题，实现自定义主题功能\n *\n * 如果你的项目同样使用了scss预处理，你也可以直接在你的 scss 代码中使用如下变量，同时无需 import 这个文件\n */\n/* 颜色变量 */\n/* 行为相关颜色 */\n/* 文字基本颜色 */\n/* 背景颜色 */\n/* 边框颜色 */\n/* 尺寸变量 */\n/* 文字尺寸 */\n/* 图片尺寸 */\n/* Border Radius */\n/* 水平间距 */\n/* 垂直间距 */\n/* 透明度 */\n/* 文章场景相关 */.uni-list[data-v-3858212e]{display:flex;background-color:#fff;position:relative;flex-direction:column}.uni-list--border[data-v-3858212e]{position:relative;z-index:-1}.uni-list--border-top[data-v-3858212e]{position:absolute;top:0;right:0;left:0;height:1px;-webkit-transform:scaleY(.5);transform:scaleY(.5);background-color:#e5e5e5;z-index:1}.uni-list--border-bottom[data-v-3858212e]{position:absolute;bottom:0;right:0;left:0;height:1px;-webkit-transform:scaleY(.5);transform:scaleY(.5);background-color:#e5e5e5}',""]),t.exports=e},"53b8":function(t,e,i){"use strict";i.r(e);var a=i("f0b8"),n=i.n(a);for(var s in a)"default"!==s&&function(t){i.d(e,t,(function(){return a[t]}))}(s);e["default"]=n.a},"56a8":function(t,e,i){var a=i("24fb");e=a(!1),e.push([t.i,'@charset "UTF-8";\n/**\n * 这里是uni-app内置的常用样式变量\n *\n * uni-app 官方扩展插件及插件市场（https://ext.dcloud.net.cn）上很多三方插件均使用了这些样式变量\n * 如果你是插件开发者，建议你使用scss预处理，并在插件代码中直接使用这些变量（无需 import 这个文件），方便用户通过搭积木的方式开发整体风格一致的App\n *\n */\n/**\n * 如果你是App开发者（插件使用者），你可以通过修改这些变量来定制自己的插件主题，实现自定义主题功能\n *\n * 如果你的项目同样使用了scss预处理，你也可以直接在你的 scss 代码中使用如下变量，同时无需 import 这个文件\n */\n/* 颜色变量 */\n/* 行为相关颜色 */\n/* 文字基本颜色 */\n/* 背景颜色 */\n/* 边框颜色 */\n/* 尺寸变量 */\n/* 文字尺寸 */\n/* 图片尺寸 */\n/* Border Radius */\n/* 水平间距 */\n/* 垂直间距 */\n/* 透明度 */\n/* 文章场景相关 */.uni-list-chat[data-v-5a788973]{font-size:16px;position:relative;flex-direction:column;justify-content:space-between;background-color:#fff}.uni-list-chat--hover[data-v-5a788973]{background-color:#f5f5f5}.uni-list--border[data-v-5a788973]{position:relative;margin-left:15px}.uni-list--border[data-v-5a788973]:after{position:absolute;top:0;right:0;left:0;height:1px;content:"";-webkit-transform:scaleY(.5);transform:scaleY(.5);background-color:#e5e5e5}.uni-list-item--first[data-v-5a788973]:after{height:0}.uni-list-chat--first[data-v-5a788973]{border-top-width:0}.uni-ellipsis[data-v-5a788973]{overflow:hidden;white-space:nowrap;text-overflow:ellipsis}.uni-ellipsis-2[data-v-5a788973]{overflow:hidden;text-overflow:ellipsis;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical}.uni-list-chat__container[data-v-5a788973]{position:relative;display:flex;flex-direction:row;flex:1;padding:10px 15px;position:relative;overflow:hidden}.uni-list-chat__header-warp[data-v-5a788973]{position:relative}.uni-list-chat__header[data-v-5a788973]{display:flex;align-content:center;flex-direction:row;justify-content:center;align-items:center;flex-wrap:wrap-reverse;width:45px;height:45px;border-radius:5px;border-color:#eee;border-width:1px;border-style:solid;overflow:hidden}.uni-list-chat__header-box[data-v-5a788973]{box-sizing:border-box;display:flex;width:45px;height:45px;overflow:hidden;border-radius:2px}.uni-list-chat__header-image[data-v-5a788973]{margin:1px;width:45px;height:45px}.uni-list-chat__header-image[data-v-5a788973]{display:block;width:100%;height:100%}.avatarItem--1[data-v-5a788973]{width:100%;height:100%}.avatarItem--2[data-v-5a788973]{width:47%;height:47%}.avatarItem--3[data-v-5a788973]{width:32%;height:32%}.header--circle[data-v-5a788973]{border-radius:50%}.uni-list-chat__content[data-v-5a788973]{display:flex;flex-direction:row;flex:1;overflow:hidden;padding:2px 0}.uni-list-chat__content-main[data-v-5a788973]{display:flex;flex-direction:column;justify-content:space-between;padding-left:10px;flex:1;overflow:hidden}.uni-list-chat__content-title[data-v-5a788973]{font-size:16px;color:#3b4144;font-weight:400;overflow:hidden}.uni-list-chat__content-note[data-v-5a788973]{margin-top:3px;color:#999;font-size:12px;font-weight:400;overflow:hidden}.uni-list-chat__content-extra[data-v-5a788973]{flex-shrink:0;display:flex;flex-direction:column;justify-content:space-between;align-items:flex-end;margin-left:5px}.uni-list-chat__content-extra-text[data-v-5a788973]{color:#999;font-size:12px;font-weight:400;overflow:hidden}.uni-list-chat__badge-pos[data-v-5a788973]{position:absolute;left:calc(45px + 10px - 6px + 0px);top:calc(10px/ 2 + 1px + 0px)}.uni-list-chat__badge[data-v-5a788973]{display:flex;justify-content:center;align-items:center;border-radius:100px;background-color:#ff5a5f}.uni-list-chat__badge-text[data-v-5a788973]{color:#fff;font-size:12px}.uni-badge--single[data-v-5a788973]{width:18px;height:18px}.uni-badge--complex[data-v-5a788973]{width:auto;height:18px;padding:0 6px}.uni-badge--dot[data-v-5a788973]{left:calc(45px + 15px - 10px/ 2 + 1px + 0px);width:10px;height:10px;padding:0}',""]),t.exports=e},"5bd7":function(t,e,i){var a=i("d7fa");"string"===typeof a&&(a=[[t.i,a,""]]),a.locals&&(t.exports=a.locals);var n=i("4f06").default;n("a4e2dda4",a,!0,{sourceMap:!1,shadowMode:!1})},"6bc0":function(t,e,i){"use strict";i.r(e);var a=i("85fc"),n=i.n(a);for(var s in a)"default"!==s&&function(t){i.d(e,t,(function(){return a[t]}))}(s);e["default"]=n.a},"6fcd":function(t,e,i){"use strict";var a=i("baf3"),n=i.n(a);n.a},7262:function(t,e,i){"use strict";var a;i.d(e,"b",(function(){return n})),i.d(e,"c",(function(){return s})),i.d(e,"a",(function(){return a}));var n=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("v-uni-view",{staticClass:"uni-list uni-border-top-bottom"},[t.border?i("v-uni-view",{staticClass:"uni-list--border-top"}):t._e(),t._t("default"),t.border?i("v-uni-view",{staticClass:"uni-list--border-bottom"}):t._e()],2)},s=[]},"7c03":function(t,e,i){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var a={name:"uniList","mp-weixin":{options:{multipleSlots:!1}},props:{enableBackToTop:{type:[Boolean,String],default:!1},scrollY:{type:[Boolean,String],default:!1},border:{type:Boolean,default:!0}},created:function(){this.firstChildAppend=!1},methods:{loadMore:function(t){this.$emit("scrolltolower")}}};e.default=a},"7e81":function(t,e,i){"use strict";var a;i.d(e,"b",(function(){return n})),i.d(e,"c",(function(){return s})),i.d(e,"a",(function(){return a}));var n=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("v-uni-view",{staticClass:"uni-list-chat",attrs:{"hover-class":t.clickable||t.link?"uni-list-chat--hover":""},on:{click:function(e){e.stopPropagation(),arguments[0]=e=t.$handleEvent(e),t.onClick.apply(void 0,arguments)}}},[i("v-uni-view",{class:{"uni-list--border":t.border,"uni-list-chat--first":t.isFirstChild}}),i("v-uni-view",{staticClass:"uni-list-chat__container"},[i("v-uni-view",{staticClass:"uni-list-chat__header-warp"},[t.avatarCircle||0===t.avatarList.length?i("v-uni-view",{staticClass:"uni-list-chat__header",class:{"header--circle":t.avatarCircle}},[i("v-uni-image",{staticClass:"uni-list-chat__header-image",class:{"header--circle":t.avatarCircle},attrs:{src:t.avatar,mode:"aspectFill"}})],1):i("v-uni-view",{staticClass:"uni-list-chat__header"},t._l(t.avatarList,(function(e,a){return i("v-uni-view",{key:a,staticClass:"uni-list-chat__header-box",class:t.computedAvatar,style:{width:t.imageWidth+"px",height:t.imageWidth+"px"}},[i("v-uni-image",{staticClass:"uni-list-chat__header-image",style:{width:t.imageWidth+"px",height:t.imageWidth+"px"},attrs:{src:e.url,mode:"aspectFill"}})],1)})),1)],1),t.badgeText&&"left"===t.badgePositon?i("v-uni-view",{staticClass:"uni-list-chat__badge uni-list-chat__badge-pos",class:[t.isSingle]},[i("v-uni-text",{staticClass:"uni-list-chat__badge-text"},[t._v(t._s("dot"===t.badgeText?"":t.badgeText))])],1):t._e(),i("v-uni-view",{staticClass:"uni-list-chat__content"},[i("v-uni-view",{staticClass:"uni-list-chat__content-main"},[i("v-uni-text",{staticClass:"uni-list-chat__content-title uni-ellipsis"},[t._v(t._s(t.title))]),i("v-uni-text",{staticClass:"uni-list-chat__content-note uni-ellipsis"},[t._v(t._s(t.note))])],1),i("v-uni-view",{staticClass:"uni-list-chat__content-extra"},[t._t("default",[i("v-uni-text",{staticClass:"uni-list-chat__content-extra-text"},[t._v(t._s(t.time))]),t.badgeText&&"right"===t.badgePositon?i("v-uni-view",{staticClass:"uni-list-chat__badge",class:[t.isSingle,"right"===t.badgePositon?"uni-list-chat--right":""]},[i("v-uni-text",{staticClass:"uni-list-chat__badge-text"},[t._v(t._s("dot"===t.badgeText?"":t.badgeText))])],1):t._e()])],2)],1)],1)],1)},s=[]},"85fc":function(t,e,i){"use strict";i("99af"),i("4160"),i("d81d"),i("fb6a"),i("ac1f"),i("1276"),i("159b"),Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var a={components:{},data:function(){return{UNITS:{"年":315576e5,"月":26298e5,"天":864e5,"小时":36e5,"分钟":6e4,"秒":1e3},listData:[],avatarList:[{url:"/static/logo.png"},{url:"/static/logo.png"},{url:"/static/logo.png"}]}},onLoad:function(){this.getList()},methods:{onClick:function(){uni.showToast({title:"列表被点击"})},avatar:function(t){var e=[];return this.avatarList.forEach((function(i,a){a<t&&e.push(i)})),e},getList:function(){var t=this,e={column:"id,post_id,title,author_name,cover,published_at"};uni.request({url:"https://unidemo.dcloud.net.cn/api/news",data:e,success:function(e){if(200==e.statusCode){var i=t.setTime(e.data);i=t.reload?i:t.listData.concat(i),i.map((function(t){return t.text=Math.floor(-19*Math.random()+20),t})),t.listData=t.getRandomArrayElements(i,3)}},fail:function(t,e){console.log("fail"+JSON.stringify(t))}})},getRandomArrayElements:function(t,e){var i,a,n=t.slice(0),s=t.length,r=s-e;while(s-- >r)a=Math.floor((s+1)*Math.random()),i=n[a],n[a]=n[s],n[s]=i;return n.slice(r)},setTime:function(t){var e=this,i=[];return t.forEach((function(t){i.push({author_name:t.author_name,cover:t.cover,id:t.id,post_id:t.post_id,published_at:e.format(t.published_at),title:t.title})})),i},format:function(t){var e=this.parse(t),i=Date.now()-e.getTime();if(i<this.UNITS["天"])return this.humanize(i);var a=function(t){return t<10?"0"+t:t};return e.getFullYear()+"-"+a(e.getMonth()+1)+"-"+a(e.getDate())+" "+a(e.getHours())+":"+a(e.getMinutes())},parse:function(t){var e=t.split(/[^0-9]/);return new Date(e[0],e[1]-1,e[2],e[3],e[4],e[5])}}};e.default=a},baf3:function(t,e,i){var a=i("42e4");"string"===typeof a&&(a=[[t.i,a,""]]),a.locals&&(t.exports=a.locals);var n=i("4f06").default;n("1f5993eb",a,!0,{sourceMap:!1,shadowMode:!1})},cb5f:function(t,e,i){"use strict";i.r(e);var a=i("3510"),n=i("6bc0");for(var s in n)"default"!==s&&function(t){i.d(e,t,(function(){return n[t]}))}(s);i("d083");var r,o=i("f0c5"),l=Object(o["a"])(n["default"],a["b"],a["c"],!1,null,"03ced5e4",null,!1,a["a"],r);e["default"]=l.exports},d083:function(t,e,i){"use strict";var a=i("5bd7"),n=i.n(a);n.a},d4d3:function(t,e,i){"use strict";i.r(e);var a=i("7c03"),n=i.n(a);for(var s in a)"default"!==s&&function(t){i.d(e,t,(function(){return a[t]}))}(s);e["default"]=n.a},d7fa:function(t,e,i){var a=i("24fb");e=a(!1),e.push([t.i,'@charset "UTF-8";\n/**\n * 这里是uni-app内置的常用样式变量\n *\n * uni-app 官方扩展插件及插件市场（https://ext.dcloud.net.cn）上很多三方插件均使用了这些样式变量\n * 如果你是插件开发者，建议你使用scss预处理，并在插件代码中直接使用这些变量（无需 import 这个文件），方便用户通过搭积木的方式开发整体风格一致的App\n *\n */\n/**\n * 如果你是App开发者（插件使用者），你可以通过修改这些变量来定制自己的插件主题，实现自定义主题功能\n *\n * 如果你的项目同样使用了scss预处理，你也可以直接在你的 scss 代码中使用如下变量，同时无需 import 这个文件\n */\n/* 颜色变量 */\n/* 行为相关颜色 */\n/* 文字基本颜色 */\n/* 背景颜色 */\n/* 边框颜色 */\n/* 尺寸变量 */\n/* 文字尺寸 */\n/* 图片尺寸 */\n/* Border Radius */\n/* 水平间距 */\n/* 垂直间距 */\n/* 透明度 */\n/* 文章场景相关 */.chat-custom-right[data-v-03ced5e4]{flex:1;display:flex;flex-direction:column;justify-content:space-between;align-items:flex-end}.chat-custom-text[data-v-03ced5e4]{font-size:12px;color:#999}',""]),t.exports=e},f0b8:function(t,e,i){"use strict";i("c975"),i("a9e3"),i("d3b7"),i("25f0"),Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var a=45,n={name:"UniListChat",emits:["click"],props:{title:{type:String,default:""},note:{type:String,default:""},clickable:{type:Boolean,default:!1},link:{type:[Boolean,String],default:!1},to:{type:String,default:""},badgeText:{type:[String,Number],default:""},badgePositon:{type:String,default:"right"},time:{type:String,default:""},avatarCircle:{type:Boolean,default:!1},avatar:{type:String,default:""},avatarList:{type:Array,default:function(){return[]}}},computed:{isSingle:function(){if("dot"===this.badgeText)return"uni-badge--dot";var t=this.badgeText.toString();return t.length>1?"uni-badge--complex":"uni-badge--single"},computedAvatar:function(){return this.avatarList.length>4?(this.imageWidth=.31*a,"avatarItem--3"):this.avatarList.length>1?(this.imageWidth=.47*a,"avatarItem--2"):(this.imageWidth=a,"avatarItem--1")}},data:function(){return{isFirstChild:!1,border:!0,imageWidth:50}},mounted:function(){this.list=this.getForm(),this.list&&(this.list.firstChildAppend||(this.list.firstChildAppend=!0,this.isFirstChild=!0),this.border=this.list.border)},methods:{getForm:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"uniList",e=this.$parent,i=e.$options.name;while(i!==t){if(e=e.$parent,!e)return!1;i=e.$options.name}return e},onClick:function(){""===this.to?(this.clickable||this.link)&&this.$emit("click",{data:{}}):this.openPage()},openPage:function(){-1!==["navigateTo","redirectTo","reLaunch","switchTab"].indexOf(this.link)?this.pageApi(this.link):this.pageApi("navigateTo")},pageApi:function(t){var e=this;uni[t]({url:this.to,success:function(t){e.$emit("click",{data:t})},fail:function(t){e.$emit("click",{data:t}),console.error(t.errMsg)}})}}};e.default=n},f175:function(t,e,i){"use strict";i.r(e);var a=i("7262"),n=i("d4d3");for(var s in n)"default"!==s&&function(t){i.d(e,t,(function(){return n[t]}))}(s);i("6fcd");var r,o=i("f0c5"),l=Object(o["a"])(n["default"],a["b"],a["c"],!1,null,"3858212e",null,!1,a["a"],r);e["default"]=l.exports}}]);