<template>
  <div>
    <div class="sidebar" style="background-color:black;">
      <div class="sidebar-wrapper">
        <div class="logo">
          <a href="javascript:void(0);" class="simple-text">Priceline</a>
        </div>
        <ul class="nav">
          <li class="nav-item">
            <router-link to="/home">
              <a class="nav-link">
                <p>Dashboard</p>
              </a>
            </router-link>
          </li>

           <!-- <li class="nav-item">
            <router-link to="/products-performance">
              <a class="nav-link">
                <p>Product performance</p>
              </a>
            </router-link>
          </li> -->

          <li>
            <router-link to="/industries">
              <a class="nav-link">
                <p>Industries</p>
              </a>
            </router-link>
          </li>

          <li>
            <router-link to="/companies">
              <a class="nav-link">
                <p>Companies</p>
              </a>
            </router-link>
          </li>


         <li>
            <router-link to="/companies_redirect">
              <a class="nav-link">
                <p>Companies Redirects</p>
              </a>
            </router-link>
          </li>


           <li>
            <router-link to="/catalog_promotion">
              <a class="nav-link">
                <p>Catalog Promotions</p>
              </a>
            </router-link>
          </li>

            <li>
            <router-link to="/manufacturers">
              <a class="nav-link">
                <p>Manufacturers</p>
              </a>
            </router-link>
          </li>

            <li>
            <router-link to="/skus">
              <a class="nav-link">
                <p>SKUs</p>
              </a>
            </router-link>
          </li>

          <li>
            <router-link to="/product-categories">
              <a class="nav-link">
                <p>Products Categories</p>
              </a>
            </router-link>
          </li>

           <li>
            <router-link to="/subscribers">
              <a class="nav-link">
                <p>Newsletter Subscribers</p>
              </a>
            </router-link>
          </li>
<!-- 
           <li>
            <router-link to="/products-brands">
              <a class="nav-link">
                <p>Products Brands</p>
              </a>
            </router-link>
          </li> -->

           <li>
            <router-link to="/products">
              <a class="nav-link">
                <p>products</p>
              </a>
            </router-link>
          </li>
          <li>
            <router-link to="/users">
              <a class="nav-link">
                <p>Users</p>
              </a>
            </router-link>
          </li>   
        </ul>
      </div>
    </div>
  </div>
</template>
<script>

export default {
  name: "sideBar",
  components:{

  },
  created()
  {
    
  }
};
</script>
