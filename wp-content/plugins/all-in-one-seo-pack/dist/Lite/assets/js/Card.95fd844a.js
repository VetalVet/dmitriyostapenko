import{e as y}from"./links.4c32e7b9.js";import{C as h}from"./Tooltip.d28f6bf4.js";import{a as k,S as b}from"./Caret.da0d1a59.js";import{a as B}from"./index.df267eaa.js";import{T as p}from"./Slide.3af65e43.js";import{r,o,c as i,J as g,a as d,e as n,I as T,t as w,b as c,w as u,d as q,f as a}from"./vue.runtime.esm-bundler.ba5c08e0.js";import{_ as A}from"./_plugin-vue_export-helper.80405f63.js";const N={setup(){return{settingsStore:y()}},emits:["close-card"],components:{CoreTooltip:h,SvgCaret:k,SvgCircleQuestionMark:B,SvgClose:b,TransitionSlide:p},props:{slug:{type:String,required:!0},headerText:String,toggles:{type:Boolean,default(){return!0}},hideHeader:Boolean,noSlide:Boolean,closes:Boolean,saveToggleStatus:{type:Boolean,default(){return!0}},disabled:Boolean,cardClass:{type:Object,default(){return{}}}},watch:{toggles(t){const s=this.slug;t&&!this.settingsStore.settings.toggledCards[s]&&this.settingsStore.toggleCard({slug:s,shouldSave:!0})}}},V={class:"text"},H={class:"header-icon"},L={class:"header-extra"},M={key:1,class:"content"},j={key:0,class:"content"},z={key:1,class:"content"};function D(t,s,e,l,E,I){const _=r("svg-circle-question-mark"),m=r("core-tooltip"),f=r("svg-caret"),v=r("svg-close"),S=r("transition-slide");return o(),i("div",{class:g(["aioseo-card",{disabled:e.disabled,...e.cardClass}])},[e.hideHeader?a("",!0):(o(),i("div",{key:0,class:g(["header",[{toggles:e.toggles}]]),onClick:s[2]||(s[2]=C=>l.settingsStore.toggleCard({slug:e.slug,shouldSave:e.saveToggleStatus}))},[d("div",V,[d("div",H,[n(t.$slots,"header-icon")]),d("div",{class:"header-title",onClick:s[0]||(s[0]=T(()=>{},["stop"]))},[n(t.$slots,"header",{},()=>[d("span",null,w(e.headerText),1)])]),t.$slots.tooltip?(o(),c(m,{key:0},{tooltip:u(()=>[n(t.$slots,"tooltip")]),default:u(()=>[q(_)]),_:3})):a("",!0),d("div",L,[n(t.$slots,"header-extra")])]),!e.closes&&e.toggles&&l.settingsStore.settings.toggledCards&&!e.noSlide&&!e.disabled?(o(),c(f,{key:0,class:g({rotated:!l.settingsStore.settings.toggledCards[e.slug]})},null,8,["class"])):a("",!0),e.closes?(o(),c(v,{key:1,onClick:s[1]||(s[1]=C=>t.$emit("close-card",!0))})):a("",!0)],2)),t.$slots.disabled&&e.disabled?(o(),i("div",M,[n(t.$slots,"disabled")])):a("",!0),(l.settingsStore.settings.toggledCards||e.noSlide)&&!e.disabled?(o(),c(S,{key:2,active:l.settingsStore.settings.toggledCards[e.slug]&&e.toggles||e.noSlide},{default:u(()=>[t.$slots["before-tabs"]?(o(),i("div",j,[n(t.$slots,"before-tabs")])):a("",!0),n(t.$slots,"tabs"),t.$slots.default?(o(),i("div",z,[n(t.$slots,"default")])):a("",!0)]),_:3},8,["active"])):a("",!0)],2)}const F=A(N,[["render",D]]);export{F as C};
