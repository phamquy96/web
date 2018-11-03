<template>
	<div class="container"> 
	 	<Navbar></Navbar>
		<slot></slot>
		<Footer></Footer>
	</div>
</template>
<script>
    import Navbar from './layout/Navbar.vue'
    import Footer from './layout/Footer.vue'
    import Slider from './layout/Slider.vue'
    export default {
        components: {
            Navbar,
            Footer,
            Slider  
        }
    }
</script>
<style lang="scss">
        ul li {list-style-type: none;float: left;}
    .logo-menu img {
        width: 135px;
        height: 35px;
        margin:8px 20px ; 
    }
    .logo-menu{
        margin-top: 20px; 
        width: 200px;
        height: 45px;
    }
    #carousel-id{
        margin-bottom: 30px; 
    }
    .nav-content ul li a:focus{
        background: white;
    }
    .nav>li>a:hover, .nav>li>a:focus {
    text-decoration: none;
    background-color: white;
}
.thumbnail{
    border: none;
    margin-top:15px; 
}
.menu-content{
    margin-bottom: 0px; 
}
.products{
    border-right: 1px solid #eee;
    border-bottom: 1px solid #eee;
}
.content-home{
     border-top: 1px solid #eee;
     border-left:  1px solid #eee;
}
.content-news{
    border-top: 1px solid #eee;
     border-left:  1px solid #eee; 
}
.caption{
    margin: 10px;
}
.caption strong{
    display: inline-block;
    vertical-align: middle;
    overflow: hidden;
    font-size: 14px;
    color: #e10c00;
    line-height: 15px;
}
.caption h5{
    color: #333;
}
.footer{
    height: 300px;
     border-top: 1px solid #eee;
     border-right:  1px solid #eee;
     border-bottom:  1px solid #eee;
     margin-top:50px; 
     background-color: #263238;
}
.content-footer{
    height: 300px;
    
}
.content-footer ul li{
    float: left;
    width: 90%;
    border: none;
    background-color: #263238;
    color: #CCC;
}
.content-footer ul li a{
     color: #CCC;
}
.content-footer ul {
    margin-top:30px; 
    background-color: #263238;
}
.content-footer h5{
    font-weight: bold;
    margin: 30px 0px -15px 15px ;
    color: #FFF;
}
.title-detail{
    border-bottom:  1px solid #eee;
}
.image-detail{
    border-bottom:  1px solid #eee;
}
.thongsokithuat ul li{
    width: 100%;
}
.news-detail{
    border-bottom:  1px solid #eee;
}
.compore-products-detail img{
    height: 150px
}
.content-compare{
    border-bottom:  1px solid #eee;
}
.rating-detail{
    border:  1px solid #eee;
}
.bar-rating{
    margin-top:5px; 
}
.form-danhgia{
    border-bottom:  1px solid #eee;
}
.form-cmt{
    border-bottom:  1px solid #eee;
    border-top:  1px solid #eee;
    padding-top:20px;
}
.content-cmt-danhgia
{
    margin-left: 15px;
    color: #333;
    line-height: 3px; 
}
.panel-cmt {
    border: none;
    display: inline-block;
    height: 34px;
}
.panel-cmt strong {
    float: left;
    overflow: hidden;
    line-height: 22px;
    margin: 4px 5px;
    text-transform: capitalize;
}
.cmt-danhia{
    margin-bottom: 10px; 
}
.shape{
    width: 25px;
    height: 25px;
    background: #ddd;
    float: left;
}
.brand{
    line-height: 50px;
}
.nav-products{
    border-bottom:  1px solid #eee;
}
.img-title img{
    width: 60%;
    margin: 10% 0% 8% 18%;
}
.img-title{
    border:  1px solid #eee;
}
.navbar-toggle{
    background: black;
}
.nav-phukien{
    border-bottom:  1px solid #eee;
}
.navbar-phukien li{
    border: none;
    cursor: pointer;
    width: 90%;
    height: 30px;
}
.navbar-phukien a{
    margin-bottom: 10px; 
}
.navbar-phukien li:hover  a{
    color: #fff;
    text-decoration: none;
}
.navbar-phukien li:hover {
    background: #555;
    text-decoration: none;
    width: 90%;

}
.content-cart{
    margin: auto;
    border:  1px solid #eee;
    padding: 10px;
}
.money{
    float: right;
}
.add-cart{
    border-bottom:   1px solid #eee;
}
.total span{
    float: right;
}
.total p{
    float: left;
}
.infor-cart{
    margin-left: 37px; 
}
.input-danhgia{
    margin-left:12px; 
}
/*.bar-rating{
    margin-top: 
}*/
.level-star span
{
    line-height: 10px;
}
.total-star{
    margin-left: 3px; 
}
.tool-bar-star{
    font-size: 13px;
    line-height: 18px;
}
.rating-center{
    margin-top:10px; 
}
.btn-sendanhgia{
    margin:40px 40px 0px 60px; 
}
.payment{
margin-top:15px;  
}
</style>
