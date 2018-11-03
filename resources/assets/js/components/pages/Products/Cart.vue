<template>
	<MainLayout>
	<div>
	<div>
		
		<Loading v-if='!this.isloading'></Loading>
		<LoadingCart v-if='this.is_show_addCart'></LoadingCart>
		<div v-if='this.List_Cart == 0'>
			<div class="cart-blank" >
				<img src="https://www.redbubble.com/assets/fe/sadOllied198187229d8d8a6785b1587f86182f5.gif">
				<h4>Không có sản phẩm nào trong giỏ hàng</h4>
				<router-link :to="{name:'HomePage'}"><button class='btn-page'>Quay về trang chủ</button></router-link>
			</div>
		</div>
		<div class="container" v-else>
		
		<div class="col-sm-8 col-md-8 col-lg-8 content-cart " style='margin-left: 300px; '>
			<div class=" col-sm-15 col-md-15 col-lg-15 center-block ">
				<nav class="navbar navbar">
				  <div class="container-fluid">
				    <div class="navbar-header">
				      <router-link to="/">
				     	 <a class="navbar-brand" >Mua thêm sản phẩm khác</a>
				      </router-link>
				    </div>
				    <ul class="nav navbar-nav navbar-right">
				      <li><a href="#">Giỏ hàng của bạn</a></li>
				    </ul>
				  </div>
				  <h3 v-if='this.errors_qty_updatecart != 0' style="margin:auto;color: red;font-size: 16px;">{{this.errors_qty_updatecart}}</h3>
				</nav>

			</div>
			<div class=" col-sm-15 col-md-15 col-lg-15 content-cart ">
				<div class=" col-sm-15 col-md-15 col-lg-15 add-cart" v-for='(item,index) in List_Cart'>
					<div class=" col-sm-2 col-md-2 col-lg-2">
						<div class="thumbnail">
							<router-link :to="{name:'detail',params:{id: item.id }}">
								<img :src="item.options.image" alt="">
							</router-link>
							<div class="caption" @click='deleteCart(item,index)'>
								<p>Xóa</p>
							</div>
						</div>
					</div>
					<div class=" col-sm-4 col-md-4 col-lg-4">
						<div class="caption">
							<h5>{{item.name}}</h5>
						</div>
					</div>

					<div class=" col-sm-2 col-md-2 col-lg-4 money">
						<div class="caption">
							<h5>{{formatPrice(item.price)}}đ</h5>
							<button class="btn btn-danger" @click='Giamsp(item,index)'  v-if='item.qty > 1'>-</button>
							<button class="btn btn-danger" @click='Giamsp(item,index)' disabled v-if='item.qty == 1'>-</button>
							<input type="button"  v-model='item.qty' class="btn-qty">
							<button class="btn btn-danger" @click='UpdateCart(item,index)' v-if='item.qty <10'>+</button>
							<button class="btn btn-danger" @click='UpdateCart(item,index)' disabled v-if='item.qty == 10'>+</button>
						</div>
						<p>Thanh tiền : <span style="color: #c10017">{{formatPrice(item.price*item.qty)}}đ</span></p>
					</div>
				</div>
				
			</div>
			<div class=" col-sm-15 col-md-15 col-lg-15 content-cart ">
				<div class="panel total">
					<span>{{this.total}}đ</span>
					<p>Tổng tiền</p>
				</div>
				<div style="clear: both;"></div>
				<div class="panel total">
					<span style="font-size: 16px;color: #c10017;font-weight: bold;">{{this.total}}đ</span>
					<p style="font-weight: bold;">Cần Thanh toán</p>
				</div>

			</div>
			<div class="ccol-sm-15 col-md-15 col-lg-15 content-cart ">
				<div  v-if="loi.length">
					<span v-for="err in loi">
						<p style="color: red;">{{ err[0] }}</p>
					</span>
					<hr>
				</div>
				<div class="col-xs-15 col-sm-15 col-md-15 col-lg-15">
					<label class="radio-inline"><input type="radio" name="optradio" checked :value='1' v-model='cart.gender'>Nam</label>
					<label class="radio-inline"><input type="radio" name="optradio" :value='0' v-model='cart.gender'>Nữ</label>
					<!-- <p style="color: red;">{{this.loi[2]}}</p> -->
					
				</div>
				<div class=" col-sm-7 col-md-7 col-lg-7">
					<div class="form-group">
					  <input type="text" class="form-control"  placeholder="Tên" v-model='cart.name' name='name'>
					 <!--  <span style="color: red;">{{this.loi[0]}}</span> -->
					</div>
				</div>
				<div class=" col-sm-7 col-md-7 col-lg-7 infor-cart" >
					<div class="form-group">
					  <input  name="phone" type="text" placeholder="Số điện thoại"v-model='cart.phone'class="form-control">
						<!-- <span style="color: red;float: right;">{{this.loi[1]}}</span> -->
					</div>
				</div>
				<div class=" col-sm-15 col-md-15 col-lg-15" >
					<div class="form-group">
					  <input type="text" class="form-control" placeholder="Yêu cầu khác (Không bắt buộc)">
					</div>
				</div>
			</div>

			<div class=" col-sm-15 col-md-15 col-lg-15 content-cart ">
				<h5>Để được phục vụ nhanh hơn, hãy chọn thêm:</h5>

				<div class=" col-sm-7 col-md-7 col-lg-7">
					<div class="form-group">
					  <label for="sel1">Chọn Tỉnh(Thành Phố)</label>
					  <select class="form-control" id="sel1">
					    <option>Hà Nội</option>
					  </select>
					</div>
				</div>
				<div class=" col-sm-7 col-md-7 col-lg-7 infor-cart">
					<div class="form-group">
					  <label for="sel1">Chọn Quận(Huyện)</label>
					  <select class="form-control" id="sel1">
					    <option>Gia Lâm</option>
					  </select>
					</div>
				</div>
				<div class=" col-sm-15 col-md-15 col-lg-15" >
					<div class="form-group">
					  <input type="text" class="form-control" placeholder="Số nhà ,tên đường,phường/xã">
					</div>
				</div>
			</div>
			<div class=" col-sm-15 col-md-15 col-lg-15 content-cart ">
				 <button class="btn btn-danger" @click='addCart()' data-toggle="modal" href='#modal-id-cart'>Thanh toán khi nhận hàng</button>
				  <button class="btn btn-danger" style="float: right;">Thanh toán online</button>
			</div>
			<div v-if="this.is_show_modal_nofj"class="modal fade" id="modal-id-cart" >
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title">Thông báo</h4>
						</div>
						<div class="modal-body">
							<h4>Thanh toán thành công</h4>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							<button type="button" class="btn btn-primary">Save changes</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		
	</div>
	 </div>
	
	</div>

	</MainLayout>
</template>
<script >
	import Loading from './../layout/Loading.vue'
	import LoadingCart from './../layout/LoadingCart.vue'
	import { EventBus } from './event-bus.js'
	export default{
		components: {
		  Loading,
		  LoadingCart
		},

		data(){
			return{
				List_Cart:[],
				total:0,
				toa:'',
				isloading : false,
				qty:0,
				is_Cart:0,
				is_show_modal_nofj:false,
				is_show_addCart:false,
				cart:{
					name:'',
					phone:'',
					gender:null
				},
				userProfile:{
					age:0
				},
				loi:[],
				errors_qty_updatecart:[],
				thanhtien:null,
				countCart:null,
			}
		},
		created:function(){
			this.getListCartNew()
		},
		methods:{
			getListCartNew()
            {
                axios.get('/getlistcartnew')
	    		.then(response=>{
	    			console.log(response.data.cartcontent)
	    			this.List_Cart = response.data.cartcontent 
	    			this.total = response.data.total 
	    			this.isloading = true
	    		})

            },
            formatPrice(value) {
		        let val = (value/1).toFixed(0).replace('.', ',')
		        return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
	    	},
	    	deleteCart(product,index){
	    		axios.get('/deletecart/' + product.rowId)
				.then(response => {
					this.List_Cart = response.data.content
					this.total = response.data.total
					this.countCart = response.data.countCart
					EventBus.$emit('delateCart', this.countCart)
					console.log('quy')
				})
				.catch(error => {
					console.log('ERROER');
				})
	    	},
	    	addCart(){
	    		this.is_show_addCart = true
	    		axios.post('/postCart',{
	    			name:this.cart.name,
	    			phone:this.cart.phone,
	    			gender:this.cart.gender,
	    		}).then(response=>{
	    			this.countCart = response.data.countCart
	    			EventBus.$emit('addcart', this.countCart)
	    			 Vue.swal('Success','Thanh toán thành công','success');
	    			this.is_show_addCart = false
	    			this.List_Cart =''
	    			this.is_show_modal_nofj = true
	    		}).catch(error=>{
	    			this.loi = []
	    			if(error.response.data.errors.name) {
						this.loi.push(error.response.data.errors.name)
					}
					if(error.response.data.errors.phone) {
						this.loi.push(error.response.data.errors.phone)
					}
					if(error.response.data.errors.gender) {
						this.loi.push(error.response.data.errors.gender)
					}
					console.log(this.loi)
	    		})
	    	},
	    	Giamsp(product,index){
	    		product.qty--
	    		this.is_show_addCart = true
	    		axios.get('/UpdateCart/' + product.rowId +'/'+ product.qty +'/'+ product.id)
	    		.then(response=>{
	    			this.is_show_addCart = false
	    			this.List_Cart =response.data.content
	    			this.total = response.data.total
	    			this.errors_qty_updatecart = response.data.error
	    			this.countCart = response.data.countCart
	    			EventBus.$emit('clicked', this.countCart)
	    		}).catch(error=>{
	    			console.log('Error')
	    		})
	    	},
	    	UpdateCart(product,index){
	    		product.qty++
	    		this.is_show_addCart = true
	    		axios.get('/UpdateCart/' + product.rowId +'/'+ product.qty +'/'+ product.id)
	    		.then(response=>{
	    			this.is_show_addCart = false
	    			this.List_Cart =response.data.content
	    			this.total = response.data.total
	    			this.errors_qty_updatecart = response.data.error
	    			this.countCart = response.data.countCart
	    			EventBus.$emit('clicked', this.countCart)
	    		}).catch(error=>{
	    			console.log('Error')
	    		})
	    	}
		},
	}

</script>
<style lang="scss" scoped>
	.productscart{
		width: 100%;height: auto;border-bottom: 1px solid #f5f5f5;padding: 10px;
	}
	.total-money{
		width: 100%;height: 40px;margin-top:7px;
	}
	.pay-money{
		width: 100%;height: 40px;
	}
	.pay-money p{
		font-weight: bold;
	}
	.pay-money strong{
		color: #b71616;font-size: 16px
	}
	.content-cart{
		-webkit-box-shadow: 0px 0px 13px 3px rgba(214,217,217,1);
		-moz-box-shadow: 0px 0px 13px 3px rgba(214,217,217,1);
		box-shadow: 0px 0px 13px 3px rgba(214,217,217,1);
	}
	.title-cart{
		padding:  20px;
	}
	.btn-pay input[type="submit"]{
		width: 200px;
		background: -webkit-linear-gradient(top,#f59000,#fd6e1d);
		color: white;
		padding: 10px 15px;
		border: none;
		border-radius: 6px;
		color: white;
	}
	.pay-on{
		margin-left: 150px;
	}
	.caption p{
		cursor: pointer;
	}
	.cart-blank{
		margin: 120px auto; 
		height: 300px; 
		width: 40%;
	}
	.cart-blank img{
		width: 30%;
		margin: 20px 0px 0px 140px;
	}
	.cart-blank h4{
		text-align: center;
	}
	.btn-page{
	    display: block;
	    overflow: hidden;
	    background: #fff;
	    line-height: 40px;
	    text-align: center;
	    margin: 15px auto;
	    width: 300px;
	    font-size: 14px;
	    color: #288ad6;
	    font-weight: 600;
	    text-transform: uppercase;
	    border: 1px solid #288ad6;
	    border-radius: 4px;
	}
	.btn-qty{
		width: 34px;
		height: 34px;
		background: white;
		border: 1px solid #dfdfdf;
		border-radius: 4px;
		padding-bottom: 3px;  
	}
	.cart-fixed{
		display: none;
	}
</style>
