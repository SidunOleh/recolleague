import{n as h}from"./laravel-vue-pagination.es-71ea7c69.js";import{_ as p,e as _,o as l,c,a as e,F as m,d as g,h as f,t as a,p as x,b as v}from"./app-0de93b8b.js";const k={components:{Bootstrap5Pagination:h},data(){return{users:[]}},methods:{getUsers(t=1){this.$emit("loading"),axios.get(`/api/admin/users/${t}`).then(o=>{console.log(o),this.users=o.data}).catch(o=>{alert("Something goes wrong. Try again.")}).finally(()=>{this.$emit("loaded")})},updateStatus(t){axios.patch(`/api/admin/users/${t}/status/update`)},deleteUser(t){confirm("Are you sure?")&&axios.delete(`/api/admin/users/${t}`).then(o=>{this.users.data=this.users.data.filter(d=>d.id!=t)})}},mounted(){this.getUsers()},unmounted(){this.$emit("loaded")}},y=t=>(x("data-v-70005141"),t=t(),v(),t),P={class:"users"},S={class:"table table-striped"},b=y(()=>e("thead",null,[e("tr",null,[e("th",{scope:"col"},"Name"),e("th",{scope:"col"},"E-mail"),e("th",{scope:"col"},"Status"),e("th",{scope:"col"},"Last request"),e("th",{scope:"col"},"Requests count"),e("th",{scope:"col"},"Payment method"),e("th",{scope:"col"},"Last four number"),e("th",{scope:"col"},"Registred"),e("th",{scope:"col"})])],-1)),C={class:"form-check form-switch"},$=["checked","onChange"],B=["onClick"];function I(t,o,d,U,i,n){const r=_("Bootstrap5Pagination");return l(),c("div",P,[e("table",S,[b,e("tbody",null,[(l(!0),c(m,null,g(i.users.data,s=>(l(),c("tr",null,[e("td",null,a(s.name),1),e("td",null,a(s.email),1),e("td",null,[e("div",C,[e("input",{class:"form-check-input",type:"checkbox",role:"switch",id:"user-status",checked:s.is_active,onChange:u=>n.updateStatus(s.id)},null,40,$)])]),e("td",null,a(s.last_request),1),e("td",null,a(s.requests_count),1),e("td",null,a(s.pm_method),1),e("td",null,a(s.pm_last_four),1),e("td",null,a(s.registred),1),e("td",{class:"delete-user text-danger",title:"Delete",onClick:u=>n.deleteUser(s.id)}," x ",8,B)]))),256))])]),f(r,{data:i.users,onPaginationChangePage:n.getUsers},null,8,["data","onPaginationChangePage"])])}const L=p(k,[["render",I],["__scopeId","data-v-70005141"]]);export{L as default};