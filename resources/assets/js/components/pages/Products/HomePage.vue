<template>
	<MainLayout>
	<div class="container">
		<Slider></Slider>
		<nav class="navbar navbar menu-content" >
		  <div class="container-fluid">
		    <div class="navbar-header">
		      <p class="navbar-brand" href="#">Sản Phẩm Nổi Bật Nhất</p>
		    </div>
		  </div>
		</nav>
		<div class="container content-home">
			<div class="col-xs-7 col-sm-3 col-md-3 col-lg-3 products" v-for='item in Products'>
				<router-link :to="{name:'detail',params:{id: item.id }}">
					<div class="thumbnail">
						<img :src="item.image">
						<span class="inforbuy" v-if='item.discount == 0'>Trả góp 0%</span>
						<span class="discount" v-if='item.discount != 0'>Giảm {{formatPrice(item.discount)}}₫</span>
						<div class="caption">
							<h5>{{item.name}}</h5>
							<strong>
								{{formatPrice(item.price)}}₫
							</strong>
							<p style="margin-top:4px; "> <span class="fa fa-star" v-for=' star in avg(item)'></span><span class="fa fa-star-o" v-for=' start in 5-(avg(item))'></span><span class="totaldanhgia">{{item.danhgias.length}} đánh giá</span></p>
						</div>
					</div>
				</router-link>
			</div>
		</div>
		<nav class="navbar navbar menu-content" >
		  <div class="container-fluid">
		    <div class="navbar-header">
		      <p class="navbar-brand" href="#">Điện Thoại </p>
		    </div>
		    <ul class="nav navbar-nav navbar-right nav-content">
		      <li class="active" v-for='item in List_SubCates' @click='productSubcates(item)'><a>{{item.sub_catetitle}}</a></li>
		      
		      <li>
		      	<router-link to="/products" exact>
			      	<a >Xem tất cả 
			      		<span style="font-weight: bold;">{{this.Products_List.length}}</span> điện thoại
			      	</a>
		      	</router-link>
		      </li>
		    </ul>
		  </div>
		</nav>
		<div class="container content-home">
			<div class="col-xs-7 col-sm-3 col-md-3 col-lg-3 products" v-for='item in Random_Products'>
				<router-link :to="{name:'detail',params:{id: item.id }}">
					<div class="thumbnail">
						<img v-lazy="item.image">
						<span class="inforbuy" v-if='item.discount == 0'>Trả góp 0%</span>
						<span class="discount" v-if='item.discount != 0'>Giảm {{formatPrice(item.discount)}}₫</span>
						<div class="caption">
							<h5>{{item.name}}</h5>
							<strong>
								{{formatPrice(item.price)}}₫
							</strong>
							<p style="margin-top:4px; "> <span class="fa fa-star" v-for=' star in avg(item)'></span><span class="fa fa-star-o" v-for=' start in 5-(avg(item))'></span><span class="totaldanhgia">{{item.danhgias.length}} đánh giá</span></p>
						</div>
					</div>
				</router-link>
			</div>
			
		</div>
		<nav class="navbar navbar menu-content" >
		  <div class="container-fluid">
		    <div class="navbar-header">
		      <p class="navbar-brand" href="#">Tin tức nổi bật</p>
		    </div>
		    
		  </div>
		</nav>
		<div class="container content-news">
			<div class=" col-xs-7 col-sm-3 col-md-3 col-lg-3 products" v-for='item in Phukien'>
				<router-link :to="{name:'detail',params:{id: item.id }}">
					<div class="thumbnail">
						<img v-lazy="item.image">
						<div class="caption">
							<h5>{{item.name}}</h5>
							<strong>
								{{formatPrice(item.price)}}₫
							</strong>
						</div>
					</div>
				</router-link>
			</div>
		</div>
		
	</div>
	</MainLayout>
</template>
<script>
	import Loading from './../layout/Loading.vue'
	import Slider from './../layout/Slider.vue'
	export default{
		components:{
			Loading,
			Slider
		},
		data(){
			return{
				Products:[],
				isloading : false,
				Random_Products:[],
				Products_List:[],
				List_SubCates:[],
				Phukien:[],
			}
		},
		created(){
			this.getProductsHomePages();
		},
		methods:{
			getProductsHomePages(){
				this.isloading = true
				axios.get('/productshomepages')
				.then(response =>{
					this.isloading = false  
					this.Products = response.data.result.slice(0,10)
					this.Products_List = response.data.result
					this.Phukien = response.data.result.slice(0,5)
					this.List_SubCates = response.data.List_SubCates.slice(0,4)
					this.Random_Products = response.data.randomProducts
				})
			},
			formatPrice(value) {
		        let val = (value/1).toFixed(0).replace('.', ',')
		        return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
	    	},
	    	productSubcates(item){
	    		axios.get('/productSubcates/'+item.id)
	    		.then(response=>{
	    			this.Random_Products = response.data.products
	    		})
	    		.catch(error=>{
	    			console.log('Error')
	    		})
	    	},
	    	avg(value){
	    		var sum = 0;
	    		var avg = 0; 
	    		for(var i = 0 ; i < value.danhgias.length; i++ )
	    		{
	    			  sum += value.danhgias[i]['star']
	    		}
	    		// return avg = parseInt(sum/value.danhgias.length);
	    		if(sum == 0){
	    			return sum;
	    		}if(sum > 0 ){
	    			return Math.ceil(sum/value.danhgias.length)
	    		}
	    	}
		}
	}
</script>
<style scoped="css">
	.thumbnail img{
		height: 190px;
		transition: all 0.3s ease;
	}
	.thumbnail img:hover{
		transform: translateY(-10px);
	}
	a{
		cursor: pointer;
	}
	.fa-star,.fa-star-o{
		font-size: 12px;
		margin: 1px;
		color:#f4bc44;
	}
	.totaldanhgia {
		margin-left: 5px; 
		font-size: 12px;
		color: #777;
	}
	.products{
		position: relative;
	}
	.inforbuy{
		position: absolute;
		top:192px;
		left: 10px;
		background: #f28902;
		width: 88px;
		height: 18px;
		color: white;
		text-align: center;
		font-size: 12px;
		line-height: 18px;
	}
	.discount{
		position: absolute;
		top:192px;
		left: 10px;
		background-image: linear-gradient(-90deg,#ec1f1f 0%,#ff9c00 100%);
		width: auto;
		height: 18px;
		color: white;
		padding: 2px 4px 3px 4px;
		border-radius: 4px;
		text-align: center;
		font-size: 12px;
		line-height: 18px;
		text-align: center;
		
	}
</style>