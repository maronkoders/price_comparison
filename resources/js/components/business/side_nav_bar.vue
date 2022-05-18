<template>
       <aside class="menu-sidebar d-none d-lg-block">
             <div class="logo">
                <a href="#">
                    <img src="images/icon/logo.png" alt="Priceline"/>
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                      <app-links/>
                    </ul>
                </nav>
            </div>
        </aside>
</template>

<script>
import appLinks from './appLinks.vue'
export default{
   name:'side_nav_bar',
   components:{
      appLinks
   },
   methods:{
      getLinkName:function(e)
      {  
         let route_name = e.target.innerText.toLowerCase();
         if(route_name != "dashboard")
         {
            this.$router.push('/'+route_name);
         }
        
      }
   }

}
</script>
