<script setup>
import { ref, onMounted, computed } from 'vue';
import Header from '../components/Header.vue';
import Breadcrumb from './../myaccountComponent/Breadcrumb.vue'
import HeaderInfo from '../myaccountComponent/HeaderInfo.vue'
import Nav from './../myaccountComponent/Nav.vue'
import Dashboard from './../myaccountComponent/Dashboard.vue'
import Orders from './../myaccountComponent/Orders.vue'
import Downloads from './../myaccountComponent/Downloads.vue'
import Address from './../myaccountComponent/Address.vue'
import Account from './../myaccountComponent/Account.vue'
</script>

<template>
    <Header />

    <main>
        
    <Breadcrumb />

        <section class="page-secton-wrapper section-space-ptb">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="account-dashboard">
                           <HeaderInfo />
                            <div class="row">
                               <Nav />
                                <div class="col-md-12 col-lg-10">
                                    <!-- Tab panes -->
                                    <div class="tab-content dashboard-content">
                                        <Dashboard />
                                        <Orders />
                                        <Downloads />
                                        <Address />
                                        <Account />
                                      
                                      
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

</template>