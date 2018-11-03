<template>
	<MainLayout>
	<div class="container" v-if='this.List_Products.length == 0'>
		<h4>Rất tiếc, PhamQuyShop.com không tìm thấy kết quả nào phù hợp với từ khóa "{{this.$route.params.id}}"</h4>
		<h4 style="font-weight: bold;">Để tìm được kết quả chính xác hơn, bạn vui lòng:</h4>
		<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
			<ul>
				<li>- Kiểm tra lỗi chính tả của từ khóa đã nhập</li>
				<li>- Thử lại bằng từ khóa khác</li>
				<li>- Thử lại bằng những từ khóa tổng quát hơn</li>
				<li>- Thử lại bằng những từ khóa ngắn gọn hơn</li>
			</ul>
		</div>
		
	</div>
	<div class="container" v-else>
		<div class="row">
			<nav class="navbar navbar">
			  <div class="container-fluid">
			    <ul class="nav navbar-nav">
			      <li class="active"><a @click='allsearchProducts()'>Tất cả</a></li>
			      <li><a @click='productsMain()'>Sản phẩm chính</a></li>
			      <li><a @click='searchPhuKien()'>Phụ Kiện</a></li>
			      <li><a @click='searchTinTuc()'>Tin tức</a></li>
			    </ul>
			  </div>
			</nav>
			<h5>Tìm thấy {{this.List_Products.length}} kết quả với từ khóa "{{this.$route.params.id}}"</h5>
		</div>
		<div class="col-xs-11 col-sm-11 col-md-11 col-lg-11">
			<nav class="navbar navbar" style="border-bottom: 1px solid #eee;width: 98%;">
			  <div class="container-fluid">
			    <div class="navbar-header">
			      <a class="navbar-brand" v-if='this.is_show == 1'>Tin tức ({{this.List_News.length}})</a>
			      <a class="navbar-brand" v-if='this.is_show == 2'>Phụ kiên ({{this.List_PhuKien .length}})</a>
			      <a class="navbar-brand" v-if='this.is_show == 3'>Sản Phẩm ({{this.List_Products.length}})</a>
			      <a class="navbar-brand" v-if='this.is_show == 4'>Sản Phẩm ({{this.List_Products.length}})</a>
			    </div>
			    <ul class="nav navbar-nav navbar-right" style="margin-right: 20px; ">
			      <li class="active"><a href="#">Sắp xếp theo</a></li>
			      <li><a href="#">Độ liên quan</a></li>
			      <li><a @click = 'PriceDimished()'>Gía cao đến thấp</a></li>
			      <li><a @click = 'PriceIncrement()'>Thấp đến cao</a></li>
			    </ul>
			  </div>
			</nav>
			<div v-if='this.is_show == 1'>
				<div v-if='List_News == 0'>
					<h3>Không có tin tức nào</h3>
				</div>
			</div>
			<div v-if='this.is_show == 2'>
				<div v-if='List_PhuKien == 0'>
					<h3>Không có phu kien nào</h3>
				</div>
			</div>
			<div v-if='this.is_show == 3'>
				<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 productsmain"  v-for='item in List_Products' >
					<router-link :to="{name:'detail',params:{id: item.id }}">
						<div class="thumbnail">
							<img :src="item.image">
							<div class="caption">
								<h5>{{item.name}}</h5>
								<strong>
									{{item.price}}đ
								</strong>
							</div>
						</div>
					</router-link>
				</div>
			</div>
			<div v-if='this.is_show == 4'>
				<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 productsmain"  v-for='item in List_Products' >
					<router-link :to="{name:'detail',params:{id: item.id }}">
						<div class="thumbnail">
							<img :src="item.image">
							<div class="caption">
								<h5>{{item.name}}</h5>
								<strong>
									{{item.price}}đ
								</strong>
							</div>
						</div>
					</router-link>
				</div>
			</div>
		</div>
	<div class="col-xs-5 col-sm-4 col-md-4 col-lg-4 search-right">
			<div class="row">
				<h4 >Phụ Kiện (83)</h4>
				<div class="col-xs-15 col-sm-15 col-md-15 col-lg-15 products">
					<div class="thumbnail search-news">
						<img src="https://intense-eyrie-40931.herokuapp.com/img/iphone-xs-256gb-white-190x190.jpg">
						<div class="caption  caption-search-news" style="float: left;">
							<p>No kia a dasdasd</p>
							<strong>
								3.6000.000dd
							</strong>
						</div>
					</div>
				</div>
				<div class="col-xs-15 col-sm-15 col-md-15 col-lg-15 products">
					<div class="thumbnail search-news">
						<img src="https://intense-eyrie-40931.herokuapp.com/img/iphone-xs-256gb-white-190x190.jpg">
						<div class="caption  caption-search-news" style="float: left;">
							<p>No kia a dasdasd</p>
							<strong>
								3.6000.000dd
							</strong>
						</div>
					</div>
				</div>
				<div class="col-xs-15 col-sm-15 col-md-15 col-lg-15 products">
					<div class="thumbnail search-news">
						<img src="https://intense-eyrie-40931.herokuapp.com/img/iphone-xs-256gb-white-190x190.jpg">
						<div class="caption  caption-search-news" style="float: left;">
							<p>No kia a dasdasd</p>
							<strong>
								3.6000.000dd
							</strong>
						</div>
					</div>
				</div>
				<div class="col-xs-15 col-sm-15 col-md-15 col-lg-15 products">
					<div class="thumbnail search-news">
						<img src="https://intense-eyrie-40931.herokuapp.com/img/iphone-xs-256gb-white-190x190.jpg">
						<div class="caption  caption-search-news" style="float: left;">
							<p>No kia a dasdasd</p>
							<strong>
								3.6000.000dd
							</strong>
						</div>
					</div>
				</div>
				
			</div>
			<h4>Phụ Kiện (83)</h4>
			<div class="row">
				<div class="col-xs-15 col-sm-15 col-md-15 col-lg-15 products">
					<div class="thumbnail search-news">
						<img src="https://intense-eyrie-40931.herokuapp.com/img/iphone-xs-256gb-white-190x190.jpg">
						<div class="caption  caption-search-news" style="float: left;">
							<p>No kia a dasdasd</p>
							<strong>
								3.6000.000dd
							</strong>
						</div>
					</div>
				</div>
				<div class="col-xs-15 col-sm-15 col-md-15 col-lg-15 products">
					<div class="thumbnail search-news">
						<img src="https://intense-eyrie-40931.herokuapp.com/img/iphone-xs-256gb-white-190x190.jpg">
						<div class="caption  caption-search-news" style="float: left;">
							<p>No kia a dasdasd</p>
							<strong>
								3.6000.000dd
							</strong>
						</div>
					</div>
				</div>
				<div class="col-xs-15 col-sm-15 col-md-15 col-lg-15 products">
					<div class="thumbnail search-news">
						<img src="https://intense-eyrie-40931.herokuapp.com/img/iphone-xs-256gb-white-190x190.jpg">
						<div class="caption  caption-search-news" style="float: left;">
							<p>No kia a dasdasd</p>
							<strong>
								3.6000.000dd
							</strong>
						</div>
					</div>
				</div>
				<div class="col-xs-15 col-sm-15 col-md-15 col-lg-15 products">
					<div class="thumbnail search-news">
						<img src="https://intense-eyrie-40931.herokuapp.com/img/iphone-xs-256gb-white-190x190.jpg">
						<div class="caption  caption-search-news" style="float: left;">
							<p>No kia a dasdasd</p>
							<strong>
								3.6000.000dd
							</strong>
						</div>
					</div>
				</div>
				<div class="col-xs-15 col-sm-15 col-md-15 col-lg-15 products">
					<div class="thumbnail search-news">
						<img src="https://intense-eyrie-40931.herokuapp.com/img/iphone-xs-256gb-white-190x190.jpg">
						<div class="caption  caption-search-news" style="float: left;">
							<p>No kia a dasdasd</p>
							<strong>
								3.6000.000dd
							</strong>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</MainLayout>
</template>
<script >
	export default{
		data(){
			return{
				List_Products:[],
				List_PhuKien:[],
				List_News:[],
				is_show:4
			}
		},
		created(){
			this.getProductsAny()
		},
		methods:{
			getProductsAny(){
				axios.get('/searchany/'+ this.$route.params.id).then(response=>{
					this.is_show ==4
					this.List_Products = response.data.products
					console.log(this.List_Products.length)
				}).catch(error=>{
					console.log('loi nhe')
				})
			},
			searchPhuKien(){
				this.is_show=2
				this.List_PhuKien = ''
			},
			allsearchProducts(){
				this.is_show = 4
				console.log(this.is_show)
			},
			searchTinTuc(){
				this.is_show=1
			},
			productsMain(){
				this.is_show=3
			},
			PriceIncrement(){
				axios.get('/priceincrement/'+ this.$route.params.id).then(response=>{
					this.List_Products = response.data.products
					console.log(this.List_Products.length)
				}).catch(error=>{
					console.log('loi nhe')
				})
			},
			PriceDimished(){
				axios.get('/pricedimished/'+ this.$route.params.id).then(response=>{
					this.List_Products = response.data.products
					console.log(this.List_Products.length)
				}).catch(error=>{
					console.log('loi nhe')
				})
			}
		},
		computed:{
			 
		}
	}
</script>
<style scoped="text/css">
	.search-news img{
		width: 80px;
		float: left;
	}

	.caption-search-news{
		line-height: normal; 
	}
	a {
		 color: #4a4a4a;
		 cursor: pointer;
	}
	.productsmain:hover{
		box-shadow: 1px 2px 7px 0 rgba(0, 0, 0, 0.21);
	}
	.productsmain{
		border: none;
		margin-left: 4px; 
		width: 24.431%;
	}
	.productsmain img{
		width: 90%;
	}
</style>