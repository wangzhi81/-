(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["pages-API-inner-audio-inner-audio"],{"100a":function(n,t,i){"use strict";i.d(t,"b",(function(){return e})),i.d(t,"c",(function(){return o})),i.d(t,"a",(function(){return a}));var a={pageHead:i("2c31").default},e=function(){var n=this,t=n.$createElement,i=n._self._c||t;return i("v-uni-view",{staticClass:"uni-padding-wrap"},[i("page-head",{attrs:{title:"audio"}}),i("v-uni-view",{staticClass:"uni-common-mt"},[i("v-uni-slider",{attrs:{value:n.position,min:0,max:n.duration},on:{changing:function(t){arguments[0]=t=n.$handleEvent(t),n.onchanging.apply(void 0,arguments)},change:function(t){arguments[0]=t=n.$handleEvent(t),n.onchange.apply(void 0,arguments)}}})],1),i("v-uni-view",{staticClass:"play-button-area"},[i("v-uni-image",{staticClass:"icon-play",attrs:{src:n.playImage},on:{click:function(t){arguments[0]=t=n.$handleEvent(t),n.play.apply(void 0,arguments)}}})],1)],1)},o=[]},"292c":function(n,t,i){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0;var a="https://vkceyugu.cdn.bspapp.com/VKCEYUGU-hello-uniapp/2cc220e0-c27a-11ea-9dfb-6da8e309e0d8.mp3",e={data:function(){return{title:"innerAudioContext",isPlaying:!1,isPlayEnd:!1,currentTime:0,duration:100}},computed:{position:function(){return this.isPlayEnd?0:this.currentTime},playImage:function(){return this.isPlaying?"/static/pause.png":"/static/play.png"}},onLoad:function(){this._isChanging=!1,this._audioContext=null,this.createAudio()},onUnload:function(){null!=this._audioContext&&this.isPlaying&&this.stop()},methods:{createAudio:function(){var n=this,t=this._audioContext=uni.createInnerAudioContext();return t.autoplay=!1,t.src=a,t.onPlay((function(){console.log("开始播放")})),t.onTimeUpdate((function(i){!0!==n._isChanging&&(n.currentTime=t.currentTime||0,n.duration=t.duration||0)})),t.onEnded((function(){n.currentTime=0,n.isPlaying=!1,n.isPlayEnd=!0})),t.onError((function(t){n.isPlaying=!1,console.log(t.errMsg),console.log(t.errCode)})),t},onchanging:function(){this._isChanging=!0},onchange:function(n){console.log(n.detail.value),console.log(typeof n.detail.value),this._audioContext.seek(n.detail.value),this._isChanging=!1},play:function(){this.isPlaying?this.pause():(this.isPlaying=!0,this._audioContext.play(),this.isPlayEnd=!1)},pause:function(){this._audioContext.pause(),this.isPlaying=!1},stop:function(){this._audioContext.stop(),this.isPlaying=!1}}};t.default=e},"355f":function(n,t,i){var a=i("a8fb");"string"===typeof a&&(a=[[n.i,a,""]]),a.locals&&(n.exports=a.locals);var e=i("4f06").default;e("b1eb8ab2",a,!0,{sourceMap:!1,shadowMode:!1})},"4c44":function(n,t,i){"use strict";var a=i("355f"),e=i.n(a);e.a},7206:function(n,t,i){"use strict";i.r(t);var a=i("292c"),e=i.n(a);for(var o in a)"default"!==o&&function(n){i.d(t,n,(function(){return a[n]}))}(o);t["default"]=e.a},8660:function(n,t,i){"use strict";i.r(t);var a=i("100a"),e=i("7206");for(var o in e)"default"!==o&&function(n){i.d(t,n,(function(){return e[n]}))}(o);i("4c44");var u,s=i("f0c5"),c=Object(s["a"])(e["default"],a["b"],a["c"],!1,null,"02d1e44d",null,!1,a["a"],u);t["default"]=c.exports},a8fb:function(n,t,i){var a=i("24fb");t=a(!1),t.push([n.i,".play-time-area[data-v-02d1e44d]{display:flex;flex-direction:row;margin-top:20px}.duration[data-v-02d1e44d]{margin-left:auto}.play-button-area[data-v-02d1e44d]{display:flex;flex-direction:row;justify-content:center;margin-top:50px}.icon-play[data-v-02d1e44d]{width:60px;height:60px}",""]),n.exports=t}}]);