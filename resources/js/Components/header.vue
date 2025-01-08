<template>

    <header class="header-one">
        <div class="top-header">
            <div class="container clearfix">
                <div class="logo float-left"><a href="index.html"><img src="/images/logo/logo.png" alt=""></a></div>
                <div class="address-wrapper float-right">
                    <ul>
                        <li class="address">
                            <i class="icon flaticon-placeholder"></i>
                            <h6>Address:</h6>
                            <p>2A0, Queenstown St, USA.</p>
                        </li>
                        <li class="address">
                            <i class="icon flaticon-multimedia"></i>
                            <h6>Mail us:</h6>
                            <p>supporthere@mail.com</p>
                        </li>
                        <li class="quotes"><a href="#">GET A QUOTES</a></li>
                    </ul>
                </div> <!-- /.address-wrapper -->
            </div> <!-- /.container -->
        </div> <!-- /.top-header -->

        <div class="theme-menu-wrapper">
            <div class="container">
                <div class="bg-wrapper clearfix">
                    <!-- ============== Menu Warpper ================ -->
                    <div class="menu-wrapper float-left">
                        <nav id="mega-menu-holder" class="clearfix">
                            <ul class="clearfix">
                                <li>
                                    <a href="/">Басты бет</a>
                                </li>
                                <li v-for="cat in categories" :key="'cat' + cat.id" >
                                    <a  href="#">{{ cat.name }}</a>
                                    <ul v-if="cat.all_children && cat.all_children.length > 0" class="dropdown">
                                        <li v-for="mini_cat in cat.all_children" :key="'mini_cat' + mini_cat.id">
                                            <a href="about.html">{{mini_cat.name}} </a>
                                            <ul  v-for="micro_cat in mini_cat.all_children" :key="'micro_cat' + micro_cat.id">
                                                <li><a href="#">{{micro_cat.name}}</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="contact.html">contact</a></li>
                            </ul>
                        </nav> <!-- /#mega-menu-holder -->
                    </div> <!-- /.menu-wrapper -->

                    <div class="right-widget float-right">
                        <ul>
                            <li class="social-icon">
                                <ul>
                                    <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                                </ul>
                            </li>
                            <li class="cart-icon">
                            </li>
                        </ul>
                    </div> <!-- /.right-widget -->
                </div> <!-- /.bg-wrapper -->
            </div> <!-- /.container -->
        </div> <!-- /.theme-menu-wrapper -->
    </header> <!-- /.header-one -->
</template>


<script>
import { isEmpty } from 'lodash';

export default {
    created() {
        this.fetchHeaderData();
    },
    data() {
        return {
            currentDate: new Date,
            categories: {}
        }
    },
    methods: {
        async fetchHeaderData() {
            try {
                const response = await axios.get('/api/categories');
                this.categories = response.data;
            } catch (error) {
                console.error('Error fetching header data:', error);
            }
        }
    }

}
</script>
<style>
ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
}

ul.clearfix>li {
    position: relative;
    display: inline-block;
}

ul.clearfix>li>a {
    display: block;
    padding: 10px;
    text-decoration: none;
}

ul.clearfix>li>ul.dropdown {
    display: none;
    position: absolute;
    top: 100%;
    left: 0;
    background-color: #fff;
    border: 1px solid #ccc;
}

ul.clearfix>li:hover>ul.dropdown {
    display: block;
}

ul.clearfix>li>ul.dropdown>li {
    display: block;
}

ul.clearfix>li>ul.dropdown>li>a {
    padding: 10px;
    text-decoration: none;
    display: block;
}

ul.clearfix>li>ul.dropdown>li>a:hover {
    background-color: #f0f0f0;
}
</style>