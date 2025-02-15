import { createRouter, createWebHistory } from 'vue-router'
import index from '../pages/views/index.vue'
import Home from '../pages/views/Home.vue'
import ShowProduct from '../pages/views/ShowProduct.vue'
import Cart from '../pages/views/Cart.vue'
import Contact from '../pages/views/Contact.vue'
import ConfidentialityShop from '../pages/views/ConfidentialityShop.vue'
import ConditionShop from '../pages/views/ConditionShop.vue'
import AboutShop from '../pages/views/AboutShop.vue'
import Checkout from '../pages/views/Checkout.vue'
import Wishlist from '../pages/views/Wishlist.vue'
import Products from '../pages/views/Products.vue'
import MyAccount from '../pages/views/MyAccount.vue'
import ViewOrder from '../pages/views/ViewOrder.vue'
import Auth from '../pages/Auth/Auth.vue'
import ForgotPassword from '../pages/Auth/ForgotPassword.vue'
import LoginAdmin from '../pages/Auth/Admin.vue'
import notFound from '../pages/notFound.vue'

//dashboad
import DashboadIndex from '../pages/dashboad/Index.vue'

//categories
import DashboadCategories from '../pages/dashboad/categories/IndexCategories.vue'

//banner
import DashboadBanners from '../pages/dashboad/banner/IndexBanners.vue'

//delivery_country
import IndexCountries from '../pages/dashboad/delivery_countries/IndexCountries.vue'

//delivery_city
import IndexCities from '../pages/dashboad/delivery_cities/IndexCities.vue'

//Code
import DashboadCodes from '../pages/dashboad/codes/IndexCodes.vue'
//Reviews
import DashboadReviews from '../pages/dashboad/reviews/Index.vue'
//products
import DashboadAddProduct from '../pages/dashboad/products/AddProduct.vue'
import DashboadEditProduct from '../pages/dashboad/products/EditProduct.vue'
import DashboadIndexProduct from '../pages/dashboad/products/IndexProduct.vue'

//shop
import DashboadConfigShop from '../pages/dashboad/shop/ConfigShop.vue'
//confidentiality
import DashboadConfidentialityShop from '../pages/dashboad/confidentiality/ConfidentialityShop.vue'

//condition
import DashboadConditionShop from '../pages/dashboad/condition/ConditionShop.vue'

//orders
import DashboadOrders from '../pages/dashboad/orders/IndexOrders.vue'
import DashboadShowOrder from '../pages/dashboad/orders/ShowOrder.vue'

//reset info admin
import DashboadSetting from '../pages/dashboad/setting/EditAdminInfo.vue'

//auth marketplace
import LoginMarketPlace from '../pages/views/Auth/Login.vue'
import RegisterMarketPlace from '../pages/views/Auth/Register.vue'

//products marketplace
import ProductsMarketPlace from '../pages/views/MarketPlace.vue'


const routes = [
    {
        name: 'Home',
        path: '/home/index',
        component: Home,
        meta: {
            requiresAuth: false
        }

    },
    {
        name: 'LoginMarketPlace',
        path: '/home/login',
        component: LoginMarketPlace,
        meta: {
            requiresAuth: false
        }

    },
    {
        name: 'RegisterMarketPlace',
        path: '/home/register',
        component: RegisterMarketPlace,
        meta: {
            requiresAuth: false
        }

    },
    {
        name: 'ProductsMarketPlace',
        path: '/home/marketplace',
        component: ProductsMarketPlace,
        meta: {
            requiresAuth: false
        }

    },
    {
        name: 'index',
        path: '/',
        component: index,
        meta: {
            requiresAuth: false
        }

    },
    {
        name: 'Cart',
        path: '/cart',
        component: Cart,
        meta: {
            requiresAuth: true
        }

    },
    {
        name: 'Wishlist',
        path: '/wishlist',
        component: Wishlist,
        meta: {
            requiresAuth: true
        }

    },
    {
        name: 'ConfidentialityShop',
        path: '/confidentialitychop',
        component: ConfidentialityShop,
        meta: {
            requiresAuth: false
        }

    },
    {
        name: 'Conditionshop',
        path: '/conditionshop',
        component: ConditionShop,
        meta: {
            requiresAuth: false
        }

    },
    {
        name: 'AboutShop',
        path: '/about-shop',
        component: AboutShop,
        meta: {
            requiresAuth: false
        }

    },
    {
        name: 'Contact',
        path: '/contact',
        component: Contact,
        meta: {
            requiresAuth: false
        }

    },
    {
        name: 'Checkout',
        path: '/checkout',
        component: Checkout,
        meta: {
            requiresAuth: true
        }

    },
    {
        name: 'Products',
        path: '/products',
        component: Products,
        meta: {
            requiresAuth: false
        }

    },
    {
        name: 'MyAccount',
        path: '/my-account',
        component: MyAccount,
        meta: {
            requiresAuth: true
        }

    },
    {
        name: 'ViewOrder',
        path: '/view-order/:orderId',
        component: ViewOrder,
        props:true,
        meta: {
            requiresAuth: true
        }
    },
    {
        name: 'Auth',
        path: '/auth',
        component: Auth,
        meta: {
            requiresAuth: false
        }

    },
    {
        name: 'ForgotPassword',
        path: '/forgot-password',
        component: ForgotPassword,
        meta: {
            requiresAuth: false
        }

    },
    {
        name: 'LoginAdmin',
        path: '/admin',
        component: LoginAdmin,
        meta: {
            requiresAuth: false
        }

    },
    {
        name: 'ShowProduct',
        path: '/showproduct/:productId',
        component: ShowProduct,
        props:true,
        meta: {
            requiresAuth: false
        }

    },
    {
        name: 'DashboadIndex',
        path: '/dashboad/statistic',
        component: DashboadIndex,
        props:true,
        meta: {
            requiresAuth: true
        }

    },
    {
        name: 'DashboadCategories',
        path: '/dashboad/categories',
        component: DashboadCategories,
        meta: {
            requiresAuth: true
        }
    },
    {
        name: 'DashboadBanners',
        path: '/dashboad/banners',
        component: DashboadBanners,
        meta: {
            requiresAuth: true
        }

    },
    {
        name: 'DashboadCodes',
        path: '/dashboad/codes',
        component: DashboadCodes,
        meta: {
            requiresAuth: true
        }


    },
    {
        name: 'DashboadReviews',
        path: '/dashboad/reviews',
        component: DashboadReviews,
        meta: {
            requiresAuth: true
        }


    },
    {
        name: 'IndexCities',
        path: '/dashboad/cities',
        component: IndexCities,
        meta: {
            requiresAuth: true
        }


    },
    {
        name: 'IndexCountries',
        path: '/dashboad/countries',
        component: IndexCountries,
        meta: {
            requiresAuth: true
        }


    },
    {
        name: 'DashboadAddProduct',
        path: '/dashboad/addproduct',
        component: DashboadAddProduct,

    },
    {
        name: 'DashboadEditProduct',
        path: '/dashboad/editproduct/:productId',
        component: DashboadEditProduct,
        props:true,
        meta: {
            requiresAuth: true
        }

    },
    {
        name: 'DashboadIndexProduct',
        path: '/dashboad/products',
        component: DashboadIndexProduct,
        meta: {
                    requiresAuth: true
                }

    },

    {
        name: 'DashboadConfigShop',
        path: '/dashboad/configshop',
        component: DashboadConfigShop,
        meta: {
                    requiresAuth: true
                }

    },
    {
        name: 'DashboadConfidentialityShop',
        path: '/dashboad/confidentialityshop',
        component: DashboadConfidentialityShop,
        meta: {
                    requiresAuth: true
                }

    },
    {
        name: 'DashboadConditionShop',
        path: '/dashboad/conditionshop',
        component: DashboadConditionShop,
        meta: {
                    requiresAuth: true
                }

    },

    {
        name: 'DashboadSetting',
        path: '/dashboad/setting',
        component: DashboadSetting,
        meta: {
                    requiresAuth: true
                }

    },

    {
        name: 'DashboadOrders',
        path: '/dashboad/orders',
        component: DashboadOrders,
        meta: {
                    requiresAuth: true
                }

    },

    {
        name: 'DashboadShowOrder',
        path: '/dashboad/show-order/:orderId',
        component: DashboadShowOrder,
        props:true,
        meta: {
                    requiresAuth: true
                }

    },

    {
        path: '/:pathMatch(.*)*',
        component: notFound,

    }

]

const router = createRouter({
    history: createWebHistory(),
    routes,

})

router.beforeEach((to,from) =>{
    if(to.meta.requiresAuth && !sessionStorage.getItem('token')){
        return { name: 'Auth' }
    }

    // if(to.meta.requiresAuth == false && localStorage.getItem('token')){
    //     return { name: 'index' }
    // }
})

export default router
