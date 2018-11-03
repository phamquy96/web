addcart<template>
	<div>
		 <nav class="navbar navbar-inverse" role="navigation">
			<div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class=" logo-menu" href="#">
						<router-link to="/" exact>
							<img src="/img/logo.png"/>
						</router-link>	
					</a>
				</div>

		 			
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse navbar-ex1-collapse">
					<ul class="nav navbar-nav">
						
					</ul>
					<form class="navbar-form navbar-left" action="/action_page.php">
				      <div  class="input-group" style="position: relative;" >
				        <input type="text" class="form-control" placeholder="Search" name="search" v-model='search' v-on:keyup="keymonitor">
				        <div v-if='this.is_Search' class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="background: white;position: absolute;z-index: 99;width:400px;top:100%;" >
				        	<div v-for='item in List_Products' style="width: 100%;height: 60px;border-bottom: dashed 1px black; margin-top:10px;">
				        		<router-link :to="{name:'detail',params:{id:item.id}}" >
					        		<img :src="item.image" style="width: 50px;float: left; margin-left: 5px;  ">
					        		<div style="float: left;margin-left: 14px; ">
					        			<strong style='color: #333;font-size: 14px;font-weight: 700;'>{{item.name}}</strong>
					        			<h5 style="font-size: 12px;color: #c70100;">{{formatPrice(item.price)}}đ</h5>
					        		</div>
				        		</router-link>
				        	</div>
				        </div>
				        <div class="input-group-btn">
				       	 <router-link :to="{name:'search',params:{id:this.search}}">
					          <button class="btn btn-default" >
					            <i class="glyphicon glyphicon-search"></i>
					          </button>
				         </router-link>
				        </div>
				      </div>
				    </form>

					<ul class="nav navbar-nav navbar-left">
						<li><router-link to="/Products" exact>Điện Thoại</router-link></li>
						<!-- <li><router-link to="/phukien" exact>Phụ Kiện</router-link></li> -->
						<li><router-link to="/cart" exact @click='hideCart()'>Gio Hàng</router-link></li>
						<li>
							<a  v-if='this.account' >Chào.{{this.account.name}}</a>
						</li>
						<li>
							<a  @click='logout()' v-if='this.account'>Đăng xuất</a>
						</li>
						<li  v-if='!this.account'>
							<a data-toggle="modal" href='#modal-id' >Đăng Kí
							</a>
						</li>
						<li  v-if='!this.account' >
							<a data-toggle="modal" href='#modal-id-login' @click='showLoginmodal()' >Đăng Nhập
							</a>
						</li>
						<div class="modal fade" id="modal-id" v-if='this.is_User == 0'>
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										<h4 class="modal-title">Tài khoản</h4>
									</div>
									<div class="modal-body">
										<div  v-if="loi.length">
											<span v-for="err in loi">
												<p>{{ err[0]}}</p>
											</span>
											<hr>
										</div>
										<div class="form-group">
											<label>Tài khoản</label>
											<input type="text"  class="form-control" v-model='user.name'>
										</div>
										<div class="form-group">
											<label>Email</label>
											<input type="text"  class="form-control" v-model='user.email' name="email">
										</div>
										<div class="form-group">
											<label>Mật khẩu</label>
											<input type="password"  class="form-control" v-model='user.password'>
										</div>
										
										
										<label class="radio-inline">
											<input type="radio" :value='1' v-model='user.gender'>Nam</label>
										<label class="radio-inline">
											<input type="radio" :value='0' v-model='user.gender'>Nữ</label>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default" @click='cong()'>dsa</button>
										<button type="button" class="btn btn-default" @click='changeModal()'>Đăng Nhập</button>
										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										<button type="button" class="btn btn-primary" @click='addAccount()'>Đăng kí</button>
									</div>
								</div>
							</div>
						</div>
						<div class="modal fade" id="modal-idn" >
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										<h4 class="modal-title">Thông báo</h4>
									</div>
									<div class="modal-body">
										 <h4>Đăng kí thành công</h4>
									</div>
									<div class="modal-footer">
										<a  type="button" class="btn btn-default" data-dismiss="modal">Đồng ý</a>
									</div>
								</div>
							</div>
						</div>
						<div class="modal fade" id="modal-id-login"  >
							<div class="modal-dialog" >
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="this.is_User ">&times;</button>
										<h4 class="modal-title">Đăng Nhập</h4>
									</div>
									<div class="modal-body">
										<div class="form-group">
											<label>Email</label>
											<input type="name"  class="form-control" v-model='user.name'>
										</div>
										<div class="form-group">
											<label>Mật khẩu</label>
											<input type="password"  class="form-control" v-model='user.password'>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										<button type="button" class="btn btn-primary" @click='login()'>Đăng Nhập</button>
									</div>
								</div>
							</div>
						</div>
							<div class="cart-fixed" v-if='this.count_cart > 0' @click='clickCartFxied()'>
								<router-link :to="{name:'cart'}" >
									<img src="/img/cart.jpg">
									<h5>Giỏ hàng có {{this.count_cart}} sản phẩm</h5>
								</router-link>
							</div>

							<div v-else>
								
							</div>
							<!-- <div class="chat-box">
								
							</div> -->
					</ul>
				</div><!-- /.navbar-collapse -->
			</div>

		</nav>
	</div>

</template>
<script>
	import { EventBus } from './../Products/event-bus.js';

// Listen for the i-got-clicked event and its payload.
	
	export default{
		data(){
			return{
				user:{
					name:'',
					email:'',
					password:'',
					gender:null,
					passwordcomfirm:''
				},
				search:'',
				is_Model:false,
				is_User:0,
				List_Products:[],
				is_Search:false,
				count_cart:0,
				loi:[],
				account:[],
				count:0,
			}
		},
		created(){
			this.getProducts()
			EventBus.$on('clicked', this.handler)
			EventBus.$on('delateCart', this.delateCart)
			EventBus.$on('addcart', this.addcart)
		},
		methods:{
			addcart(e){
				console.log(e)
				this.count_cart = e
			},
			delateCart(e){
				this.count_cart = e
			},
			handler(e) {
				this.count_cart = e
		    },
			cong(){
				this.count++
			},
			addAccount(){
				Vue.swal({
				  title: 'Are you sure?',
				  text: "You won't be able to revert this!",
				  type: 'warning',
				  showCancelButton: true,
				  confirmButtonColor: '#3085d6',
				  cancelButtonColor: '#d33',
				  confirmButtonText: 'Yes, delete it!'
				}).then((result) => {
				  if (result.value) {
				    Vue.swal(
				      'Deleted!',
				      'Your file has been deleted.',
				      'success'
				    )
				  }
				})
				axios.post('/addUser',{
					name:this.user.name,
					email:this.user.email,
					password:this.user.password,
					gender:this.user.gender,	
				}).then(response =>{
					this.is_User=2
					this.List_Products = response.data.products
				}).catch(error => {
					 this.loi = []
					if(error.response.data.errors.name) {
						this.loi.push(error.response.data.errors.name)
					}
					if(error.response.data.errors.email) {
						this.loi.push(error.response.data.errors.email)
					}
					if(error.response.data.errors.password) {
						this.loi.push(error.response.data.errors.password)
					}
					if(error.response.data.errors.gender) {
						this.loi.push(error.response.data.errors.gender)
					}
				})
			},
			showLoginmodal(){
				console.log('anhquy')
				this.is_User = false
			},
			login(){

				axios.post('/login',{
					name:this.user.name,
					password:this.user.password,
				}).then(response =>{
					this.is_User=true
					this.account = response.data.account
					console.log(response.data.account)
					EventBus.$emit('loginDetail', this.account)
					if(this.account == null )
					{
						Vue.swal('errors', 'Đăng nhập thất bại!', 'errors')
					}if(this.account != null){
						Vue.swal('success', 'Đăng nhập thành công !', 'errors')
					}
					
				}).catch(error => {
					console.log('Error')
					
				})
			},
			getProducts(){
				axios.get('/getproducts').then(response=>{
					this.List_Products = response.data.products
					this.count_cart = response.data.count_cart
					this.account = response.data.account
					console.log(this.count_cart)
				})
				 EventBus.$on('clicked', countCart => {
				  console.log(this.count_cart) 
				});
			},
			clickCartFxied(){
				console.log(111)
			},
			keymonitor(){
				// var products = this.List_Products.filter(item => item.name.match(this.search))
				axios.get('/searchproducts/'+this.search).then(response=>{
					this.List_Products = response.data.products;
					if(this.search == '')
					{
						this.is_Search =false
					}else{
						this.is_Search =true
					}
					
				})
				
			},
			formatPrice(value) {
		        let val = (value/1).toFixed(0).replace('.', ',')
		        return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
	    	},
	    	logout(){
	    		axios.get('/logout').then(response=>{
	    			this.account = response.data.account
	    			EventBus.$emit('logout', this.account)
	    		})
	    	},
	    	hideCart(){

	    	}
	    	
			// searchAny(){
			// 	axios.get('/searchany/'+this.search).then(response=>{
			// 		console.log('ahhah')
			// 		
			// 	}).catch(error=>{
			// 		console.log('loi nhe')
			// 	})
			// }

		},
		computed: {
			filterProducts() {
				// hàm này sẽ tạo 1 biến với giá trị là mảng Products_List_Main (a ko biết list product của em là cái nào đoán là cái này)
				// nó sẽ filter từng row của list product, nếu như trường id_subcates của nó chứa giá trị của query thì trả về
				// kết quả cuối cùng ta có được 1 mảng mà ko làm thay đổi trạng thái của mảng list_products gốc
				// bây giờ ở danh sách chọn category mỗi category khi click vào thì em set cho query = giá trị id_subcates của query đó, chỉ cần query thay đổi thì computed này sẽ tự động đc chạy,
				// Note: tên biến quá nghiệp dư: Products_List_Main, List_SubCates ????? WTFFFFF, tên biến/hàm trừ hằng số, ko bao h ai viết hoa ở đầu em nhé, nên viết là productsListMain hoặc listSubCates
				console.log(32423)
				var a = this.search
				var data = this.List_Products
				return	data.filter(function (item) {
				    return item.name.toLowerCase().includes(a.toLowerCase())
				})
			}
		}
	}
</script>
<style >
	.logo img{
		width: 135px;
		height: 35px;
	}
	.fade{
		padding: 30px;
	}
	.modal.fade:not(.in).right .modal-dialog {
		-webkit-transform: translate3d(0, -125%, 0);
	    transform: translate3d(0, -25%, 0);
	}
	.cart-fixed{
		width: 10%;
		height: 50px;
		background: white;
		top:86%;
		right: 2%;
		position: fixed;
		z-index: 99;
		border-radius: 20px;
		box-shadow: 1px 2px 7px 0 rgba(0, 0, 0, 0.21); 
	}
	.cart-fixed img{
		margin: 4px;
		width:43px;
		float: left; 
	}
	a:hover{
		text-decoration: none;
	}
	.chat-box{
		width: 16%;
		height: 200px;
		background: white;
		top:50%;
		right: 2%;
		position: fixed;
		z-index: 99;
		border-radius: 20px;
		box-shadow: 1px 2px 7px 0 rgba(0, 0, 0, 0.21); 
	}
</style>