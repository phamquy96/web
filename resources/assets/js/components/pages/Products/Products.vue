<template>
	<MainLayout>
		<Loading v-if='this.isloading'></Loading>
	<div class="container" v-else>
		<div class="row">
			<div  class="col-xs-2 col-sm-2 col-md-2 col-lg-2 img-title" v-for='item in List_SubCates' @click='subcatesProduct(item.id)'>
					<img :src="item.image" @click='listCompleteTodo(item.id)'>
			</div>
		</div>

		<div class="row">
			<nav class="navbar navbar nav-products" role="navigation">
				<div class="container-fluid">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="brand" href="#">Chọn mức giá</a>
					<!-- 	<input type="text" name="" v-model='search'> -->
					</div>
			
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse navbar-ex1-collapse">
						<ul class="nav navbar-nav">
							<li class="active"><a @click='clicksearchprice(1)'>Dưới 2 triệu</a></li>
							<li class="active"><a @click='clicksearchprice(2)'>Từ 2 - 4 triệu</a></li>
							<li class="active"><a @click='clicksearchprice(3)'>Từ 4 - 7 triệu</a></li>
							<li class="active"><a @click='clicksearchprice(4)'>Từ 7 - 13 triệu</a></li>
							<li><a href="#" @click='clicksearchprice(5)'>Trên 13 triệu</a></li>
							<li class="active"><a >Sản phẩm mới</a></li>
						</ul>
						<ul class="nav navbar-nav navbar-right">
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Sắp xếp <b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li><a href="#">Sản phẩm nổi bật</a></li>
									<li><a @click='clicksearchprice(6)'>Gía cao đến thấp</a></li>
									<li><a @click='clicksearchprice(7)'>Gía thấp đến cao</a></li>
								</ul>
							</li>
						</ul>
					</div><!-- /.navbar-collapse -->
					<div class="row">
						<button v-if='this.is_ChooseFiler == 1' class="btn btn-danger">Dưới 2 triệu
							<i class="fa fa-close" @click = 'clicksearchprice(0)'></i>
						</button>
						<button v-if='this.is_ChooseFiler == 2' class="btn btn-danger">Dưới 2-4 triệu
							<i class="fa fa-close"@click = 'clicksearchprice(0)'></i>
						</button>
						<button v-if='this.is_ChooseFiler == 3' class="btn btn-danger">Dưới 4-7 triệu
							<i class="fa fa-close" @click = 'clicksearchprice(0)'></i>
						</button>
						<button v-if='this.is_ChooseFiler == 4' class="btn btn-danger">Dưới 7-13 triệu
							<i class="fa fa-close" @click = 'clicksearchprice(0)'></i>
						</button>
						<button v-if='this.is_ChooseFiler == 5' class="btn btn-danger">Dưới 13 triệu
							<i class="fa fa-close" @click = 'clicksearchprice(0)'></i>
						</button>
						<button v-if='this.is_ChooseFiler == 6' class="btn btn-danger">Gía cao đến thấp
							<i class="fa fa-close" @click = 'clicksearchprice(0)'></i>
						</button>
						<button v-if='this.is_ChooseFiler == 7' class="btn btn-danger">Gía thấp đến cao
							<i class="fa fa-close" @click = 'clicksearchprice(0)'></i>
						</button>
						<div v-for='item in List_SubCates'  class="btn btn-danger" v-if='this.is_show_Filter_Subcate == item.id'>
							<button ></button>
						</div>
					</div>
					<div class="row">
						
					</div>
				</div>
			</nav>
		</div>

		<nav class="navbar navbar menu-content" >
		  <div class="container-fluid">
		    <div class="navbar-header">
		      <p class="navbar-brand" href="#">Điện Thoại Nổi Bật</p>
		    </div>
		  </div>
		</nav>
		<div class="container content-home" v-if='Products_List_Main.length > 0 ' >

			<div class=" col-xs-7 col-sm-3 col-md-3 col-lg-3 products "@click = 'addProducts()' v-if=' account != null' >
				 <h3 style="line-height: 268px;text-align: center;">Thêm sản phẩm</h3>
			</div>
				<div class="card" style="margin-top:300px; " v-if='this.toggle_FormAdd'>
                      <div class="card-header">
                        <strong>Basic Form</strong> Elements
                      </div>
                        <div class="card-body card-block">
                        <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                          <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="select" class=" form-control-label">Chọn Danh Mục</label>
                            </div>
                            <div class="col-12 col-md-9">
                              <select name="select" class="form-control">
                                <option  v-for='item in cates' :value="item.id">{{item.name}}</option>
                              </select>
                            </div>
                          </div>
                          <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="select" class=" form-control-label">Chọn Hãng</label>
                            </div>
                            <div class="col-12 col-md-9">
                              <select name="select"  class="form-control" v-model='product.subcates_id'>
                                <option value="0">Please select</option>
                                <option  v-for='item in List_SubCates' :value="item.id">{{item.sub_catetitle}}</option>
                              </select>
                            </div>
                          </div>
                          <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Tên Sản Phẩm</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" name="text-input" placeholder="Text" class="form-control" v-model='product.name'>
                                <small class="form-text text-muted">This is a help text</small>
                            </div>
                          </div>
                          <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Gía Sản Phẩm</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="number"  name="text-input" placeholder="Text" class="form-control" v-model='product.price'>
                                <small class="form-text text-muted">This is a help text</small>
                            </div>
                          </div>
                          <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label" >Gía Khuyến Mại</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="number"  name="text-input" placeholder="Text" class="form-control" v-model='product.discount'>
                                <small class="form-text text-muted">This is a help text</small>
                            </div>
                          </div>
                          <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label" >Số lượng</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="number"  name="text-input" placeholder="Text" class="form-control" v-model='product.qty'>
                                <small class="form-text text-muted">This is a help text</small>
                            </div>
                          </div>
                          <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Thông tin khuyên mại</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text"  name="text-input" placeholder="Text" class="form-control" v-model='product.thongtinkhuyenmai'>
                                <small class="form-text text-muted">This is a help text</small>
                            </div>
                          </div>
                          
                          <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="textarea-input" class=" form-control-label">Chi Tiết Sản Phẩm</label>
                            </div>
                            <div class="col-12 col-md-9"><textarea name="textarea-input" id="textarea-input" rows="9" placeholder="Content..." class="form-control" v-model='product.thongsokithuat'></textarea></div>
                          </div>
                          <div class="row form-group">
                            <div class="col col-md-3">
                                <label class=" form-control-label">Sản Phẩm Nổi Bật</label>
                            </div>
                            <div class="col col-md-9">
                              <div class="form-check-inline form-check">
                                <label for="inline-radio1" class="form-check-label ">
                                  <input type="radio"   value="1" class="form-check-input" v-model='product.noibat'>Có
                                </label>
                                <label for="inline-radio2" class="form-check-label ">
                                  <input type="radio"   value="0" class="form-check-input" v-model='product.noibat'>Không
                                </label>
                              </div>
                            
                            </div>
                          </div>
                          <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="file-input" class=" form-control-label">Chọn Anh</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="file" id='file' class="form-control-file" v-on:change='uploadImg()' 
                                ref='file'>
                                 <img :src="this.product.image">
                            </div>
                          </div>
                           <button class="btn btn-primary btn-sm" v-on:click.prevent='CreatedProducts()'>
                          		<i class="fa fa-dot-circle-o"></i> Submit
                        	</button>
                            <!-- <div class="col-12 col-md-9">
                                <input type="file" id="files" ref="files" multiple v-on:change="handleFileUploads()"/>
                                <img :src="this.product.mulimage">
                            </div> -->
                      </form>
                  </div>
              </div>
			<div class=" col-xs-7 col-sm-3 col-md-3 col-lg-3 products" v-for='item in  Products_List_Main '>
				<router-link :to="{name:'detail',params:{id:item.id}}">
					<div class="thumbnail">
						<img v-lazy="item.image">
						<span class="inforbuy">Trả góp 0%</span>
						<div class="caption">
							<h5>{{item.name}}</h5>
							<strong>
								{{formatPrice(item.price)}}đ
							</strong>
							<p style="margin-top:4px; "> <span class="fa fa-star" v-for=' star in avg(item)'></span><span class="fa fa-star-o" v-for=' start in 5-(avg(item))'></span><span class="totaldanhgia">{{item.danhgias.length}} đánh giá</span></p>
						</div>
					</div>
				</router-link>
			</div>
		</div>
		<!-- <div class="container content-home" v-if='Products_List_Main.length == 0'>
			<h3 style="text-align: center;">Không tìm thấy sản phẩm nào </h3>
		</div> -->
		<div class="row">
			<div style="float: right;">
                     <paginate
                        v-model="paginateProducts.current_page"
                        :page-count="paginateProducts.pageCount"
                        :margin-pages="paginateProducts.pageCount"
                        :click-handler="getListPapersdProducts"
                        :container-class="'pagination'"
                        :page-class="'page-item'">
                     </paginate>
                </div>
		</div>
	</div>
	</MainLayout>
</template>
<script>
	import Loading from './../layout/Loading.vue'
	import { EventBus } from './event-bus.js';

// Listen for the i-got-clicked event and its payload.	});
	export default{
		components:{
			Loading,
		},
		data(){
			return{
				Products_List_Main:[],
				isloading : false,
				List_SubCates:[],
				cates:[],
				query: '',
				search:0,
				is_ChooseFiler:0,
				is_show_Filter_Subcate:0,
				change:'false',
				toggle_FormAdd:false,
				product:{
                    subcates_id:'0',
                    name:'',
                    price:'',
                    discount:'',
                    thongtinkhuyenmai:'',
                    thongsokithuat:'',
                    noibat:'',
                    image:'',
                    qty:''
                },
                id_subcates:'',
                paginateProducts:{
                	current_page:0,
                	per_page:0,
                	pageCount:0,
                },
                account:''
			}
		},
		created(){
			this.getProducts()
			this.getListPapersdProducts()
            EventBus.$on('loginDetail', this.login)
            EventBus.$on('logout', this.logout)
		},
		methods:{
            login(e){
                this.account = e
            },
            logout(e){
                this.account = e
            },
			getListPapersdProducts(page = 1){
                axios.get('/papersProducts/'+ page)
                .then(response=>{
                    console.log(response.data.list_papers)
                    this.Products_List_Main  = response.data.list_papers
                    this.paginateProducts.current_page  = response.data.page
                    this.paginateProducts.per_page  = response.data.per_page
                    this.paginateProducts.pageCount  = response.data.pageCount            
                })
                .catch(errors=>{
                    console.log('Error')
                })
            },
			 uploadImg(){
                let file
                    console.log(this.$refs.file.files[0])
                    file = this.$refs.file.files[0]              
                let formData = new FormData();
                formData.append('file', file); 
                    axios.post( '/single-file',
                    formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }
                ).then(response=>{
                      this.product.image = '/img/' + response.data.result
                       this.$swal('Oops...', 'Something went wrong!', 'error')
                    })
                    .catch(function(){
                      console.log('FAILURE!!')
                    });
              
            },
			CreatedProducts(){
                axios.post('/addproducts',{
                  subcates_id:this.product.subcates_id,
                  name:this.product.name,
                  price:this.product.price,
                  discount:this.product.discount,
                  thongtinkhuyenmai:this.product.thongtinkhuyenmai,
                  thongsokithuat:this.product.thongsokithuat,
                  noibat:this.product.noibat,
                  image:this.product.image,
                  qty:this.product.qty,
                })
                .then(response=>{
                  this.Products_List_Main = response.data.productsall
                })
            },
			getProducts(){
				this.isloading = true
				axios.get('/pageproducts')
				.then(response =>{
					this.isloading = false  
					this.Products_List_Main = response.data.Products_List_Main
					console.log(response.data.Products_List_Main)
					this.List_SubCates = response.data.List_SubCates
					this.cates = response.data.cates
                    this.account = response.data.account
				})
			},
			getProductsMain(id){
				axios.get('/productsmain/'+id)
				.then(response =>{
					this.Products_List_Main = response.data.product
					this.List_SubCates = response.data.List_SubCates
					this.isloading = false
				})
			},
	    	listCompleteTodo(id) {
                return this.Products_List_Main.filter(item => id)
            },
            subcatesProduct(id){
            	this.is_show_Filter_Subcate = id
            	this.query = id
            	this.is_ChooseFiler = 0
            	this.isloading = true,
            	this.getProductsMain(id)
            	// this.id_subcates = id
            },
            formatPrice(value) {
		        let val = (value/1).toFixed(0).replace('.', ',')
		        return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
	    	},
	    	clicksearchprice(value){
	    		this.is_ChooseFiler = value
	    		axios.get('/searchPriceProducts/'+ value)
	    		.then(response=>{
	    			this.Products_List_Main = response.data.products
	    		})
	    		.catch(error=>{

	    		})
	    	},
	    	addProducts(){
	    		this.toggle_FormAdd = !this.toggle_FormAdd
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
	    
		},
		computed: {
			filterProducts() {
				
                console.log(this.id_subcates)
                var id = this.id_subcates
                var data = this.Products_List_Main
                if(this.id_subcates == '')
                {
                	return data
                }
                if(this.id_subcates > 1){
                	var a = this.search
					return data.filter(item => item.id_subcates == id)
                }
                
			}
		}
	}
</script>
<style scoped="css">
	a{
		cursor: pointer;
	}
	img{
		cursor: pointer;
	}
	.thumbnail img{
		height: 190px;
		transition: all 0.3s ease;
	}
	.thumbnail img:hover{
		transform: translateY(-10px);
	}
	.products{
		cursor: pointer;
	}
	.totaldanhgia {
		margin-left: 5px; 
		font-size: 12px;
		color: #777;
	}
	.fa-star,.fa-star-o{
		font-size: 12px;
		margin: 1px;
		color:#f4bc44;
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
</style>