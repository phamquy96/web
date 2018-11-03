import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)
const router = new VueRouter({
	scrollBehavior() {
	    return { x: 0, y: 0 };
	  },
	mode: 'history',
    // base: '/app',
    linkActiveClass: 'active',
	routes: [
	    // { path: '/', redirect: '/pages' },
	    {
	      path: '/',
	      name: 'HomePage',
	      component: require('../pages/Products/HomePage.vue')
	    },
	    {
	      path: '/sosanh/:id/:in',
	      name: 'sosanh',
	      component: require('../pages/Products/CompareProducts.vue')
	    },
	    {
	      path: '/phukien',
	      name: 'phukien',
	      component: require('../pages/Products/Phukien.vue')
	    },
	    {
	      path: '/Products',
	      name: 'products',
	      component: require('../pages/Products/Products.vue')
	    },
	    {
	      path: '/search/:id',
	      name: 'search',
	      component: require('../pages/Products/Search.vue')
	    },
	    {
	      path: '/products/:id',
	      name: 'productsid',
	      component: require('../pages/Products/Products.vue')
	    },
	    {
	      path: '/detail/:id',
	      name: 'detail',
	      component: require('../pages/Products/DetailProducts.vue')
	    },
	    {
	      path: '/admin',
	      name: 'admin',
	      component: require('../admin/pages/products/Home.vue')
	    },
	    {
	      path: '/listproducts',
	      name: 'listproducts',
	      component: require('../admin/pages/products/ListProducts.vue')
	    },
	    {
	      path: '/cart',
	      name: 'cart',
	      component: require('../pages/Products/Cart.vue')
	    },
	    {
	      path: '/pages',
	      name: 'pages',
	      component: require('../admin/pages/pages/pages.vue')
	    },
	    {
	      path: '/addproducts',
	      name: 'addproducts',
	      component: require('../admin/pages/products/AddProducts.vue')
	    },
	    {
	      path: '/addsubcates',
	      name: 'addsubcates',
	      component: require('../admin/pages/subcates/AddSubcates.vue')
	    },
	    {
	      path: '/addcates',
	      name: 'addcates',
	      component: require('../admin/pages/cates/AddCates.vue')
	    },
	    {
	      path: '/listcates',
	      name: 'listcates',
	      component: require('../admin/pages/cates/ListCatess.vue')
	    },
	    {
	      path: '/listsubcates',
	      name: 'listsubcates',
	      component: require('../admin/pages/subcates/ListProducts.vue')
	    },
	    {
	      path: '/loading',
	      name: 'loading',
	      component: require('../pages/layout/Loading.vue')
	    },
	     {
	      path: '/orders',
	      name: 'orders',
	      component: require('../admin/pages/orders/ListOrder.vue')
	    },
	    {
	      path: '/phieuthu',
	      name: 'phieuthu',
	      component: require('../admin/pages/phieuthu/phieuthu.vue')
	    },
	    {
	      path: '/phieuchi',
	      name: 'phieuchi',
	      component: require('../admin/pages/phieuchi/phieuchi.vue')
	    },
	    {
	      path: '/profit',
	      name: 'profit',
	      component: require('../admin/pages/profit/ListProfit.vue')
	    },
	    {
	      path: '/tonkho',
	      name: 'tonkho',
	      component: require('../admin/pages/tonkho/tonkho.vue')
	    },
	    {
	      path: '/custommer',
	      name: 'custommer',
	      component: require('../admin/pages/custommer/custommer.vue')
	    },
	    {
	      path: '/doanhso',
	      name: 'doanhso',
	      component:require('../admin/pages/doanhso/doanhso.vue')
	    },
	    {
	      path: '/nhapkho',
	      name: 'nhapkho',
	      component:require('../admin/pages/nhapkho/nhapkho.vue')
	    },
	    {
	      path: '/xuatkho',
	      name: 'xuatkho',
	      component:require('../admin/pages/xuatkho/xuatkho.vue')
	    },
	    {
	      path: '/CreateWarhouse',
	      name: 'CreateWarhouse',
	      component:require('../admin/pages/nhapkho/CreateWarhouse.vue')
	    },
	    {
	      path: '/ListwareHouseProducts/:id',
	      name: 'ListwareHouseProducts',
	      component:require('../admin/pages/nhapkho/ListwareHouseProducts.vue')
	    },
	    {
	      path: '/EditProducts/:id',
	      name: 'EditProducts',
	      component:require('../admin/pages/products/EditProducts.vue')
	    },
	    {
	      path: '/ListUser',
	      name: 'ListUser',
	      component:require('../admin/pages/users/ListUser.vue')
	    }
    ]
})

export default router