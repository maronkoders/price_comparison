<li>
    {{-- <router-link  :to="{ path: '/home-page', query: { user_token: token}}"> --}}
        <a href="{{url('home-page?user_token='.session('user_token'))}}">
            <i class="fas fa-tachometer-alt"></i>
            Dashboard
        </a>
      
   {{-- </router-link> --}}
    <a class="js-arrow" href="#">
        <i class="fas fa-copy"></i> Products</a>
    <ul class="list-unstyled navbar__sub-list js-sub-list">
        <li>
            <a href="{{url('inactive-products?user_token='.session('user_token'))}}">

                In-active Products
            </a>
        </li>
        <li>
            <a href="{{url('active-products?user_token='.session('user_token'))}}">Active Products</a>
        </li>
      
    </ul> 
</li>
 {{-- <li>
    <router-link :to="{ path: '/inactive-products', query: { user_token: token }}">
              <i class="fas fa-copy"></i>    
            </router-link>
        </li>
        <li>
           <router-link  :to="{ path: '/active-products', query: { user_token: token }}">
             <i class="fas fa-copy"></i>   Active Products
            </router-link>
        </li> --}}