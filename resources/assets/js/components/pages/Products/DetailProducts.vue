<template>
	<MainLayout>
	<Loading v-if='this.isloading'></Loading>
	<div class="container" v-else>
		
		<div class="row">
			<a href="">Trang chủ</a> > 
			<a href="">Điện thoại</a> > 
			<a href="">Sam sung</a>
		</div>
		<div class="row title-detail">
			<h3>Điện thoại {{products.name}}
			<input type="text" v-model ='products.name' class="form-control" v-if='this.editProducts == 1' style="width: 30%;margin: 10px;">
				<div v-if='trungbinhstar > 0'>
					<span class="fa fa-star" v-for="i in trungbinhstar"></span><span class="fa fa-star-o" v-for=' star in 5-(trungbinhstar)'></span>
					<span style="font-size: 13px;">{{totaldanhgia.length}} đánh giá</span>
				</div>
				<div v-if='trungbinhstar == 0'>
					
				</div>
				<button @click='updateProduct(products)' v-if='this.editProducts == 1' class="btn btn-danger">Lưu lại </button>
				<button @click='editPrice()' v-if='this.editProducts == 0 && account != null' class="btn btn-danger">Sửa sản phẩm</button>
			</h3>
		</div>
		<div class="row image-detail">
			<div class=" col-sm-7 col-md-7 col-lg-7">
				<div class="thumbnail img-large">
					<img :src="products.image" v-if='this.editProducts == 0' >
                    <input type="file" id='file' class="form-control-file" v-on:change='editImg(products)' 
                        ref='file' v-if='this.editProducts == 1'>
                    <img :src="products.image" v-if='this.editProducts == 1'>
					<div class="caption">
						
					</div>
				</div>
			</div>
			<div class=" col-sm-5 col-md-5 col-lg-5" v-if='products.soluong >= 1'>
				<div class=" col-sm-12 col-md-12 col-lg-13">
					<h3 v-if='this.account'>{{formatPrice(products.price)}}đ </h3>	
					<h3 v-if='!this.account' >{{formatPrice(products.price)}}đ</h3>
					<input type="text" v-model ='products.price' class="form-control" v-if='this.editProducts == 1' style="width: 50%;">
					<button class="btn btn-danger  btn-block" @click='addCart()' >MUA NGAY</button>
				</div>
				<div class="col-sm-6 col-md-6 col-lg-6 payment">
					<button class="btn btn-danger  btn-block">MUA TRẢ GÓP</button>
				</div>
				<div class=" col-sm-6 col-md-6 col-lg-6 payment-1">
					<button class="btn btn-danger  btn-block">MUA BẰNG THẺ</button>
				</div>
			</div>
			<div class=" col-sm-5 col-md-5 col-lg-5" v-if='products.soluong <= 0'>
				<div class=" col-sm-12 col-md-12 col-lg-13 ">
					<h3 v-if='this.account'>{{formatPrice(products.price)}}đ</h3>
					<h3 v-if='!this.account' >{{formatPrice(products.price)}}đ</h3>
					<input type="text" v-model ='products.price' class="form-control" v-if='this.editProducts == 1' style="width: 50%;">
					<button class="btn btn-danger  btn-block hethang">Sản phẩm tạm hết hàng</button>
				</div>
				<div class="col-sm-6 col-md-6 col-lg-13 ">
					<button class="btn btn-primary  btn-block nofi" @click='reciveNofj()'>Nhận thông báo khi có hàng</button>
				</div>
			</div>
			<div class=" col-sm-5 col-md-5 col-lg-6 form-infor-dathang" v-if='this.show_receive_infor'>
				<div class="form-group">
					<legend style="font-size: 16px;text-align: center;">Đăng ký nhận thông báo mới nhất về <strong>{{products.name}}</strong></legend>
				</div>
				<div class="form-group">
				  <label for="usr">Họ và tên *:</label>
				  <input type="text" class="form-control" >
				</div>
				<div class="form-group">
				  <label for="pwd">Số điện thoại *:</label>
				  <input type="password" class="form-control">
				</div>
				<div class="form-group">
				  <label for="pwd">Email:</label>
				  <input type="email" class="form-control">
				</div>
				<div class="form-group">
					<div class="col-sm-10 col-sm-offset-2">
						<button type="submit" class="btn btn-primary">Submit</button>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
				<nav class="navbar navbar menu-content" >
				  <div class="container-fluid">
				    <div class="navbar-header">
				      <p class="navbar-brand" href="#">Điện Thoại Liên Quan</p>
				    </div>
				   
				  </div>
				</nav>
			<div class="container content-home">
				<div class=" col-sm-3 col-md-3 col-lg-3 products" v-for='item in productslienquan'>
					<div class="thumbnail" @click='detailProducts(item.id)'>
						<img :src="item.image">
						<div class="caption">
							<h5>{{item.name}}</h5>
							<strong>
								{{formatPrice(item.price)}}đ
							</strong>
							<p style="margin-top:4px; "> <span class="fa fa-star" v-for=' star in avg(item)'></span><span class="fa fa-star-o" v-for=' start in 5-(avg(item))'></span><span class="totaldanhgia">{{item.danhgias.length}} đánh giá</span></p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class=" col-sm-10 col-md-10 col-lg-10" style="float: left;">
				<div class="row">
					<div class=" col-sm-15 col-md-15 col-lg-15 news-detail" >
						<div class="thumbnail">
							<img src="https://cdn.tgdd.vn/Products/Images/42/153830/Slider/vi-vn-samsung-galaxy-j8-thietke.gif">
							<div class="caption">
								
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class=" col-sm-15 col-md-15 col-lg-15">
						<nav class="navbar navbar">
						  <div class="container-fluid">
						    <div class="navbar-header">
						       <p class="navbar-brand" href="#">So sánh với các sản phẩm tương tự</p>
						    </div>
						   
						    <form class="navbar-form navbar-right" action="/action_page.php">
						      <div class="input-group">
						        <input type="text" class="form-control" placeholder="Search" v-on:keyup="searchcompareproducts" v-model='searchcompare' >
						        <div class="input-group-btn">
						          <button class="btn btn-default" type="submit">
						            <i class="glyphicon glyphicon-search"></i>
						          </button>
						        </div>
						      </div>
						      <div class="popSearchCompare">
					      	 	<div v-for='item in productsCompareSearch' class="itemCompareProducts">
						      	 	<router-link :to="{name:'sosanh',params:{id:item.id,in:products.id}}">{{item.name}}
						      	 	</router-link>
					      	    </div>
						      </div>
						    </form>
						  </div>
						</nav>
					</div>
				</div>
				<div class="row content-compare">
					<div class="   col-sm-15 col-md-3 col-lg-3">
						<div class="thumbnail compore-products-detail">
							<img v-lazy="products.image" alt="">
							<div class="caption">
								<h5>{{products.name}}</h5>
								<strong>
									{{formatPrice(products.price)}}
								</strong>
								<i style="display: inline-block;">Sản phẩm đang xem</i>
							</div>
						</div>
					</div>
					<div class=" col-sm-15 col-md-3 col-lg-3" v-for='item in randomProducts'>
						<router-link :to="{name:'sosanh',params:{id:item.id,in:products.id}}">
							<div class="thumbnail compore-products-detail">
								<img v-lazy="item.image" alt="">
								<div class="caption">
									<h5>{{item.name}}</h5>
									<strong>
										{{formatPrice(item.price)}}
									</strong>
									<p style="margin-top:4px; "> <span class="fa fa-star" v-for=' star in avg(item)'></span><span class="fa fa-star-o" v-for=' start in 5-(avg(item))'></span></p>
									<h5 style="cursor: pointer;color:#288ad6;" @click='compareProducts()'>So sánh sản phẩm</h5>
								</div>
							</div>
						</router-link>
					</div>
				</div>	
		<div class="row">
			<div class="col-sm-15 col-md-15 col-lg-15">
				<nav class="navbar navbar">
				  <div class="container-fluid">
				    <div class="navbar-header">
				       <p class="navbar-brand" href="#" v-if='this.cmtrating == 0'>Hãy là người đầu tiên đánh giá {{products.name}}</p>
				       <p class="navbar-brand" href="#" v-else>{{cmtrating.length}} đánh giá {{products.name}}</p>
				    </div>
				  </div>
				</nav>
			</div>
		</div>
		<div class="row rating-detail">
			<div class="col-xs-14 col-sm-14 col-md-14 col-lg-14">
				<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3"  v-if='trungbinhstar > 0'>
					<h1 style="text-align: center;line-height:60px; color: #f4bc44;" >
						{{trungbinhstar}}
						<i class="fa fa-star" style="font-size: 30px;"></i></h1>
				</div>
				<div class=" col-xs-8 col-sm-8 col-md-8 col-lg-8 rating-center"  v-if='trungbinhstar > 0'>
					<div class=" col-xs-15 col-sm-13 col-md-13 col-lg-13">
						<div class="row tool-bar-star">
							<div class=" col-xs-6 col-sm-2 col-md-2 col-lg-2 level-star" >
								<span>5</span><i class="fa fa-star"></i>
							</div>
							<div class=" col-xs-10 col-sm-10 col-md-10 col-lg-9 bar-rating" style="background: red;height: 7px;" v-bind:style="{ width: fontSize5 + '%' }">
							</div>
								<span>{{this.compute.namsao}} đánh giá</span>
						</div>
						<div class="row tool-bar-star">
							<div class=" col-xs-6 col-sm-2 col-md-2 col-lg-2 level-star" >
								<span>4</span><i class="fa fa-star"></i>
							</div>
							<div class=" col-xs-10 col-sm-10 col-md-10 col-lg-9 bar-rating" style="background: red;height: 7px;" v-bind:style="{ width: fontSize4 + '%' }">
							</div>
								<span>{{this.compute.bonsao}} đánh giá</span>
						</div>
						<div class="row tool-bar-star">
							<div class=" col-xs-6 col-sm-2 col-md-2 col-lg-2 level-star" >
								<span>3</span><i class="fa fa-star"></i>
							</div>
							<div class=" col-xs-10 col-sm-10 col-md-10 col-lg-9 bar-rating" style="background: red;height: 7px;" v-bind:style="{ width: fontSize3 + '%' }">
							</div>
								<span>{{this.compute.basao}} đánh giá</span>
						</div>
						<div class="row tool-bar-star">
							<div class=" col-xs-6 col-sm-2 col-md-2 col-lg-2 level-star" >
								<span>2</span><i class="fa fa-star"></i>
							</div>
							<div class=" col-xs-10 col-sm-10 col-md-10 col-lg-9 bar-rating" style="background: red;height: 7px;" v-bind:style="{ width: fontSize2 + '%' }">
							</div>
								<span>{{this.compute.haisao}} đánh giá</span>
						</div>
						<div class="row tool-bar-star">
							<div class=" col-xs-6 col-sm-2 col-md-2 col-lg-2 level-star" >
								<span>1</span><i class="fa fa-star"></i>
							</div>
							<div class=" col-xs-10 col-sm-10 col-md-10 col-lg-9 bar-rating" style="background: red;height: 7px;" v-bind:style="{ width: fontSize1 + '%' }">
							</div>
								<span>{{this.compute.motsao}} đánh giá</span>
						</div>
						
					</div>
				</div>
				<div class=" col-xs-3 col-sm-4 col-md-4 col-lg-4 ">
					<button class="btn btn-danger btn-sendanhgia" @click='closeFormDanhgia()' v-if='!this.is_Closeform'>Đóng lại</button>
					<button class="btn btn-danger btn-sendanhgia" @click='closeFormDanhgia()'v-if='this.is_Closeform'>Gửi đánh giá của bạn</button>
				</div>
			</div>

			<div class=" col-sm-15 col-md-15 col-lg-15" v-if='!this.is_Closeform'>
				<h4>Chọn đánh giá của bạn</h4>
				<StarRating v-bind:star-size="25" 
				 v-model='star'></StarRating>
			</div>
			<div class="row form-danhgia" v-if='!this.is_Closeform'>
				<div class=" col-sm-7 col-md-7 col-lg-7">
					<div class="form-group">
					  <textarea class="form-control" rows="5" id="comment" v-model='evaluate.content' placeholder="Nhập đánh giá về sản phẩm"></textarea >
					</div>
					<div class="col-12 col-md-9 img-danhgia">
                        <input type="file" id='file' class="form-control-file" v-on:change='uploadImg()' 
                        ref='file'>
                         <img :src="this.evaluate.image" >
                         <i class="fa fa-close" @click='closeImgPostDanhgia()' v-if='!this.show_CloseImg'></i>
                    </div>
				</div>
				<div class=" col-sm-7 col-md-7 col-lg-7" v-if='!this.is_Closeform'>
					<div class=" col-sm-7 col-md-7 col-lg-7 input-danhgia">
						<div class="form-group">
						  <input type="text" class="form-control" placeholder="Tên" v-model='evaluate.name'>
						</div>
					</div>
					<div class=" col-sm-7 col-md-7 col-lg-7 input-danhgia" >
						<div class="form-group">
						  <input type="text" class="form-control" v-model='evaluate.phone' placeholder="Số điện thoại">
						</div>
					</div>
					<div class="col-sm-7 col-md-7 col-lg-7 input-danhgia">
						<div class="form-group">
						  <input type="text" class="form-control" id="usr" v-model='evaluate.email' placeholder=" Email">
						</div>
					</div>
					<div class=" col-sm-7 col-md-7 col-lg-7 input-danhgia">
						  <button class="btn btn-danger  btn-block" @click='handleRanting()' v-if="this.account != null ">Gửi đánh giá</button>
						  <button class="btn btn-danger  btn-block" @click='handleRanting()' v-if="this.account == null " data-toggle="modal" href='#modal-id-login'>Gửi giá</button>
					</div>
				</div>
			</div>
		<!-- 	phần comment dánh giá  -->

			<div class="row cmt-danhia" v-for='item in cmtrating'>
				<div class=" col-sm-15 col-md-15 col-lg-15">
					<div class="panel-cmt">
					   <strong>{{item.name}}</strong>
					 </div>
				</div>
				<div class="col-sm-14 col-md-14 col-lg-14" style="margin-top:-12px; ">
				   <span class="fa fa-star" v-for=' star in item.star'></span><span class="fa fa-star-o" v-for=' start in 5-(item.star)'></span>
					<span class="content-cmt-danhgia">{{item.content}}</span>
				</div>
				<img :src="item.image" class="img-send">
				<div class=" col-sm-15 col-md-15 col-lg-15" style="margin-top:4px; ">
					<a  @click='tooglecmtrating(item)' >Thảo luận</a>		
					<span style="margin-left: 10px; " >2 ngày trước</span>
				</div>
				<div class="reply-cmt"  v-if="item.reply_danhgia.length > 0 ">
					<div  class=" name-repcmt" v-for='prod in item.reply_danhgia' >
						<div class="avatar-repcmt">V</div>
						<strong>{{prod.name}}<span style="font-weight: normal;font-size: 12px;padding: 3px 5px;background: #f1c40f;color: black;border-radius: 4px; ">Quản trị viên</span></strong>

						<p>{{prod.content}}</p>
					</div>	
				</div>
				<div class=" col-sm-15 col-md-15 col-lg-7" style="margin-top:4px;" v-if='item.is_rating'>
					<input type="text"  class="form-control" v-model='item.contentcmt'>
					<button class="btn btn-danger" @click = 'sendRepCmtDanhgia(item)' v-if="this.account != '' ">Gửi</button>
					<button class="btn btn-danger" @click = 'sendRepCmtDanhgia(item)' v-if="this.account == ' ' " data-toggle="modal" href='#modal-id-login'>Gửi</button>
				</div>
			</div>
			<div class="row">
				<div style="float: right;" v-if='cmtrating.length > 1 '>
                         <paginate
                            v-model="paginatedanhgia.current_page"
                            :page-count="paginatedanhgia.pageCount"
                            :margin-pages="paginatedanhgia.pageCount"
                            :click-handler="getListPapersdanhgia"
                            :container-class="'pagination'"
                            :page-class="'page-item'">
                         </paginate>
                    </div>
			</div>
		</div>


					<div class="row form-cmt">
						<div class=" col-sm-14 col-md-14 col-lg-14">
							<div class="form-group">
							   <textarea class="form-control" rows="5" id="comment" v-model='comment.content' placeholder="Mời bạn để lại bình luận..."></textarea>
							   <button class="btn btn-danger" @click='SendComment()' v-if="this.account == null " data-toggle="modal" href='#modal-id-login'>Gửi</button>
							   <button class="btn btn-danger" @click='SendComment()' v-if="this.account != null " >Gửi</button>
							</div>
							
							<!-- <div class="col-12 col-md-9 img-danhgia">
                                <input type="file" id='file' class="form-control-file" v-on:change='uploadImgCmt()' 
                                ref='file'>
                                 <img :src="this.comment.image" >
                            </div> -->
						</div>
						<div class="row">
							<div class=" col-sm-15 col-md-15 col-lg-15">
								<nav class="navbar navbar">
								  <div class="container-fluid">
								    <div class="navbar-header">
								       <p class="navbar-brand" href="#" v-if='this.List_Comment == 0'>Hãy là người đầu tiên bình luận {{products.name}}</p>
						       <p class="navbar-brand" href="#" v-else>{{List_Comment.length}} bình luận</p>
								    </div>
								  </div>
								</nav>
							</div>
						</div>
					</div>
					<div class="row cmt-danhia" v-for='item in List_Comment'>
						<div class=" col-sm-15 col-md-15 col-lg-15">
							<div class="panel-cmt">
								<div class="shape"></div>
							   <strong>{{item.name}}</strong>
							 </div>
						</div>
						<div class="col-xs-14 col-sm-14 col-md-14 col-lg-14" style="margin-top:-12px; ">
							<span class="content-cmt-danhgia">{{item.content}}</span>
						</div>
						<div class=" col-sm-15 col-md-15 col-lg-15" style="margin-top:4px; ">
							<a  @click='toggleRepCmt(item)' >Trả lời</a>
							<span style="margin-left: 10px; ">2 ngày trước</span>
						</div>
						
						<input type="hidden" v-model='item.id'>
						<div class="reply-cmt" v-if='item.replies.length > 0 '>
							<div  class=" name-repcmt" v-for='prod in item.replies' >
								<div class="avatar-repcmt">V</div>
								<strong>{{prod.name}}<span style="font-weight: normal;font-size: 12px;padding: 3px 5px;background: #f1c40f;color: black;border-radius: 4px; ">Quản trị viên</span></strong>

								<p>{{prod.content}}</p>
							</div>	
						</div>
						<div class=" col-sm-15 col-md-15 col-lg-7" style="margin-top:4px;" v-if='item.contentcmt'>
							 <textarea class="form-control" rows="5" id="comment" v-model='item.repcontentcmt' placeholder="Nhập bình luận .. "></textarea>
							<button class="btn btn-danger" @click = 'SendRepComment(item)' v-if="this.account != '' ">Gửi</button>
							<!-- <button class="btn btn-danger" @click = 'SendRepComment(item)' v-if="this.account == null " data-toggle="modal" href='#modal-id-login'>Gửi</button> -->
						</div>
					</div>
					<div class="row" v-if='List_Comment.length > 1 '>
						<div style="float: right;">
                                 <paginate
                                    v-model="paginatecmt.current_page"
                                    :page-count="paginatecmt.pageCount"
                                    :margin-pages="paginatecmt.pageCount"
                                    :click-handler="getListPapersCmt"
                                    :container-class="'pagination'"
                                    :page-class="'page-item'">
                                 </paginate>
                            </div>
					</div>
				</div>
				<div class=" col-sm-5 col-md-5 col-lg-5 thongsokithuat" style="float: right;">
				<h5>Thông số kĩ thuật</h5>
				<ul class="list-group">
				  <li class="list-group-item">Cras justo odio</li>
				  <li class="list-group-item">Dapibus ac facilisis in</li>
				  <li class="list-group-item">Morbi leo risus</li>
				  <li class="list-group-item">Porta ac consectetur ac</li>
				  <li class="list-group-item">Vestibulum at eros</li>
				  <li class="list-group-item">Cras justo odio</li>
				  <li class="list-group-item">Dapibus ac facilisis in</li>
				  <li class="list-group-item">Morbi leo risus</li>
				  <li class="list-group-item">Porta ac consectetur ac</li>
				  <li class="list-group-item">Vestibulum at eros</li>
				</ul>
			</div>
			</div>
			
		</div>
	</div>
	</MainLayout>
</template>
<script >
	import Loading from './../layout/Loading.vue'
	import StarRating from 'vue-star-rating'
	import Danhgia from './DetailProducts/Danhgia.vue'
	import { EventBus } from './event-bus.js';
	export default{
		components: {
		  // Comment,
		  Danhgia,
		  Loading,
		  StarRating,
		},
		// props: ['cmtrating','List_Comment'],
		data(){
			return{
				user:{
					name:'',
					password:'',
				},
				evaluate:{
					id:'',
					name:'',
					phone:'',
					email:'',
					id_products:0,
					content:'',
					image:''
				},
				comment:{
					id:'',
					content:'',
					image:'',
				},
				star:0,
				products:[],
				productslienquan:[],
				cmtrating:[],
				repcommentdanhgia:[],
				is_rating:false,
				List_Comment:[],
				isloading : false,
				randomProducts:[],
				show_CloseImg:true,
				show_receive_infor:false,
				totaldanhgia :[],
				trungbinhstar:0,
				is_Closeform:false,
				 clickCount: 0,
				compute:{
					namsao:0,
					bonsao:0,
					basao:0,
					haisao:0,
					motsao:0
				},
				color:'blue',
				replydanhgia:{
					content:''
				},
				replycomment:{
					content:''
				},
				account:[],
				editProducts:0,
				paginatecmt:{
                   current_page:1,
                   pageCount:0,
                   per_page:0 ,
                },
                paginatedanhgia:{
                   current_page:1,
                   pageCount:0,
                   per_page:0 ,
                },
                fontSize1: 0,
                fontSize2: 0,
                fontSize3: 0,
                fontSize4: 0,
                fontSize5: 0,
                activeColor: 'yellow',
                star1:0,
                star2:0,
                star3:0,
                star4:0,
                star5:0,
                searchcompare:'',
                productsCompareSearch:[]
			}
		},
		created:function(){
			this.getProducts()
			this.getListPapersCmt()
			this.getListPapersdanhgia()
			EventBus.$on('loginDetail',this.login)
			EventBus.$on('logout', this.logout)
		},
		methods:{
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
	    	},
			searchcompareproducts(){
				axios.get('/getsearchcompare/'+this.searchcompare)
				.then(response=>{
					console.log(response.data.productscompare)
					this.productsCompareSearch = response.data.productscompare.slice(0,6)
				})
				.catch(errors=>{
					console.log('errors');
				})
				console.log(this.searchcompare)
			},
			logout(e){
				this.account = e
			},
			getListPapersdanhgia(page = 1){
                axios.get('/papersdanhgia/'+ page + '/'+ this.$route.params.id )
                .then(response=>{
                    console.log(response.data.list_papers)
                    this.cmtrating  = response.data.list_papers
                   	this.cmtrating.forEach(item => {
						Vue.set(item, 'is_rating', false)
				  	})
                    this.paginatedanhgia.current_page  = response.data.page
                    this.paginatedanhgia.per_page  = response.data.per_page
                    this.paginatedanhgia.pageCount  = response.data.pageCount
                   
                })
                .catch(errors=>{
                    console.log('Error')
                })
            },
			getListPapersCmt(page = 1){
                axios.get('/paperscmt/'+ page + '/'+ this.$route.params.id)
                .then(response=>{
                    console.log(response.data.list_papers)
                    this.List_Comment  = response.data.list_papers
                     this.List_Comment.forEach(item => {
						Vue.set(item, 'contentcmt', false)
						Vue.set(item, 'repcontentcmt', '')
					})
                    this.paginatecmt.current_page  = response.data.page
                    this.paginatecmt.per_page  = response.data.per_page
                    this.paginatecmt.pageCount  = response.data.pageCount
                    console.log( this.paginate.current_page)
                   
                })
                .catch(errors=>{
                    console.log('Error')
                })
            },
			editImg(item){
                let file
                    file = this.$refs.file.files[0]
                    this.products.image = "/img/"+ file.name;      
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
                      item.image = '/img/' + response.data.result
                      console.log(response.data.result) 
                    })
                    .catch(function(){
                      console.log('FAILURE!!')
                    });
              
            },
            closeFormDanhgia(){
            	this.is_Closeform = !this.is_Closeform
            },
			uploadImg(){
				this.show_CloseImg=false
                let file
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
                      this.evaluate.image = '/img/' + response.data.result
                      console.log(response.data.result) 
                    })
                    .catch(function(){
                      console.log('FAILURE!!')
                    });
              
            },
			getProductsDetail(id){
				this.$http.get('/detailproducts/' +id).then((response) => {
                    this.products = response.data.result 
                    this.productslienquan = response.data.splienquan 
                    this.cmtrating = response.data.rating 
                    this.randomProducts = response.data.randomProducts
                    this.List_Comment = response.data.comment 
                    this.cmtrating.forEach(item => {
						Vue.set(item, 'is_rating', false)
						Vue.set(item, 'contentcmt', '')
					})
					this.isloading = false
					this.totaldanhgia = response.data.totaldanhgia
					this.compute.namsao = response.data.namsao // WTF 1 sao 2 sao 3 sao 4 sao... là cái j vậy e,code tù vậy em, 100 sao thì em viết 100 dòng à, @@
                    this.compute.bonsao = response.data.bonsao
                    this.compute.baosao = response.data.basao
                    this.compute.haisao = response.data.haisao
                    this.compute.motsao = response.data.motsao
					this.fontSize1= (response.data.motsao / this.cmtrating.length)*100
                    this.fontSize2= (response.data.haisao / this.cmtrating.length)*100
                    this.fontSize3= (response.data.basao / this.cmtrating.length)*100
                    this.fontSize4= (response.data.bonsao / this.cmtrating.length)*100
                    this.fontSize5= (response.data.namsao / this.cmtrating.length)*100
                });
			},
			closeImgPostDanhgia(){
				this.evaluate.image =''
				this.show_CloseImg=true
			},
			detailProducts(id){
				this.isloading = true,
				this.getProductsDetail(id);
			},	
			getProducts()
            {
            		this.isloading = true,
               	axios.get('/detailproducts/' + this.$route.params.id).then((response) => {
                    this.products = response.data.result 
                    this.productslienquan = response.data.splienquan 
                    this.randomProducts = response.data.randomProducts
                    this.cmtrating = response.data.rating 
                    this.List_Comment = response.data.comment
                    this.totaldanhgia = response.data.totaldanhgia
                    this.compute.namsao = response.data.namsao // WTF 1 sao 2 sao 3 sao 4 sao... là cái j vậy e,code tù vậy em, 100 sao thì em viết 100 dòng à, @@
                    this.compute.bonsao = response.data.bonsao
                    this.compute.baosao = response.data.basao
                    this.compute.haisao = response.data.haisao
                    this.compute.motsao = response.data.motsao
                    this.trungbinhstar = response.data.lamtronstar
                    this.account = response.data.account
                    this.cmtrating.forEach(item => {
						Vue.set(item, 'is_rating', false)
						Vue.set(item, 'contentcmt', '')
					})
					this.List_Comment.forEach(item => {
						Vue.set(item, 'contentcmt', false)
						Vue.set(item, 'repcontentcmt', '')
					})
                    // this.$router.push('/') 
                    this.isloading = false
                    // var bar1 =0;
                    // var bar2 =0;
                    // var bar3 =0;
                    // var bar4 =0;
                    // var bar5 =0;
                    // var avgbar1 = 0;
                    // var avgbar2 = 0;
                    // var avgbar3 = 0;
                    // var avgbar4 = 0;
                    // var avgbar5 = 0;
                    // for(var i = 0; i < this.cmtrating.length ; i++ )
                    // {
                    // 	if((this.cmtrating[i]['star']) == '1')
                    // 	{
                    // 		bar1 = this.cmtrating[i]['star'].length
                    // 		this.fontSize1= bar1 / this.cmtrating.length
                    // 		this.star1 = bar1
                    // 	}
                    // 	if((this.cmtrating[i]['star']) == '2')
                    // 	{
                    // 		bar2 = this.cmtrating[i]['star'].length
                    // 		this.fontSize2= bar2 / this.cmtrating.length
                    // 		this.star2 = bar2
                    // 	}
                    // 	if((this.cmtrating[i]['star']) == '3')
                    // 	{
                    // 		bar3 = this.cmtrating[i]['star'].length
                    // 		this.fontSize3= bar3 / this.cmtrating.length
                    // 		this.star3 = bar3
                    // 	}
                    // 	if((this.cmtrating[i]['star']) == '4')
                    // 	{
                    // 		bar4 = this.cmtrating[i]['star'].length
                    // 		this.fontSize4= bar4 / this.cmtrating.length
                    // 		this.star4 = bar4
                    // 	}
                    // 	if((this.cmtrating[i]['star']) == '5')
                    // 	{
                    // 		bar5 = this.cmtrating[i]['star']
                    // 		this.fontSize5= bar5 / this.cmtrating.length
                    // 		this.star5 = bar5
                    // 	}
                    // }
                    this.fontSize1= (response.data.motsao / this.cmtrating.length)*100
                    this.fontSize2= (response.data.haisao / this.cmtrating.length)*100
                    this.fontSize3= (response.data.basao / this.cmtrating.length)*100
                    this.fontSize4= (response.data.bonsao / this.cmtrating.length)*100
                    this.fontSize5= (response.data.namsao / this.cmtrating.length)*100

                });
            },
            handleRanting()
            {
            	if(this.account == ''){
            		vue.swal('bạn vui lòng đăng nhập')
            	}
            	axios.post('/addpostrating',{
            		star :this.star,
            		phone :this.evaluate.phone,
            		email :this.evaluate.email,
            		name :this.evaluate.name,
            		content :this.evaluate.content,
            		image :this.evaluate.image,
            		id_products:this.$route.params.id,
            	})
            	.then(response=>{
            		Vue.swal('Success', 'Thêm thành công!', 'success')
              //     this.cmtrating.unshift({
              //     	id:response.data.danhgia.id,
              //     	star :this.star,
            		// phone :this.evaluate.phone,
            		// email :this.evaluate.email,
            		// name :response.data.danhgia.name,
            		// image :this.evaluate.image,
            		// content:this.evaluate.content,
              //     })
                  this.cmtrating =response.data.danhgia
                  this.cmtrating.forEach(item => {
						Vue.set(item, 'is_rating', false)
				  })
                })
            },
            toggleRepCmt(item){
            	console.log(1)
            	item.contentcmt = !item.contentcmt;
            },
            tooglecmtrating(item){
            	item.is_rating = !item.is_rating;
            },
            login(e){
				this.account = e
			},
            SendComment(){
				axios.post('/postcomment',{
					content:this.comment.content,
					image:this.comment.image,
					id_products:this.$route.params.id
				}).then(response=>{
					console.log(response.data.id)	
					this.List_Comment = response.data.comments
					this.List_Comment.forEach(item => {
						Vue.set(item, 'contentcmt', false)
						Vue.set(item, 'repcontentcmt', '')
					})
				})
				
			},
            sendRepCmtDanhgia(item){
            	axios.post('/repycmtdanhgia',{
            		id_danhgia : item.id,
            		content:item.contentcmt,
            		id_products : this.$route.params.id,
            		page : this.paginatedanhgia.current_page
            	})
            	.then(response=>{
            		this.repcommentdanhgia.push({
            			content:this.replydanhgia.content,
            		})
            		this.cmtrating = response.data.danhgia
            		this.cmtrating.forEach(item => {
						Vue.set(item, 'is_rating', false)
				  	})
            		this.paginatedanhgia.current_page  = response.data.page
                    this.paginatedanhgia.per_page  = response.data.per_page
                    this.paginatedanhgia.pageCount  = response.data.pageCount
            	});
            },
            SendRepComment(item){
            	axios.post('/repycmt',{
            		id_comment : item.id,
            		id_products : this.$route.params.id,
            		content:item.repcontentcmt,
            		page : this.paginatecmt.current_page
            	})
            	.then(response=>{
            		this.repcommentdanhgia.push({
            			content:this.replydanhgia.content,
            		})
            		this.List_Comment.forEach(item => {
						Vue.set(item, 'contentcmt', false)
						Vue.set(item, 'repcontentcmt', '')
					})
            		this.List_Comment = response.data.comment
            		this.List_Comment.forEach(item => {
						Vue.set(item, 'contentcmt', false)
						Vue.set(item, 'repcontentcmt', '')
					})
                    this.paginatecmt.current_page  = response.data.page
                    this.paginatecmt.per_page  = response.data.per_page
                    this.paginatecmt.pageCount  = response.data.pageCount
            	});
            },
            formatPrice(value) {
		        let val = (value/1).toFixed(0).replace('.', ',')
		        return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
	    	},
	    	addCart(){
	    		axios.get('/addCart/'+ this.$route.params.id)
	    		.then(response=>{
	    			console.log(response.data.content)
	    			this.$router.push({
					    name: 'cart', 
					});
	    		})
	    	},
	    	updateProduct(item) {
                axios.post('/postupdateproducts/' + item.id, {
                      subcates_id:item.id_subcates,
                      name:item.name,
                      price:item.price,
                      discount:item.discount,
                      thongtinkhuyenmai:item.thongtinkhuyenmai,
                      thongsokithuat:item.thongsokithuat,
                      noibat:item.noibat,
                      image:item.image})
                .then(response => {
                    console.log(response.data.result)
                    item.isEdit = false
                    this.editProducts = 0
                })
                .catch(error => {
                    this.errors = error.response.data.errors.name
                })
            },
	    	compareProducts(){
	    		
	    	},
	    	reciveNofj(){
	    		this.show_receive_infor =true
	    	},
	    	editPrice(){
	    		this.editProducts = 1
	    	}
		},
		
	}
</script>

<style scoped="scss">
	.fa-star,.fa-star-o{
		font-size: 15px;
		margin: 2px;
		color:#f4bc44;
	}
	.totaldanhgia {
		margin-left: 5px; 
		font-size: 12px;
		color: #777;
	}
	.buy_now{
		cursor: pointer;
	}
	.img-large img{
		width: 82.14%;
	}
	.products img {
		height: 190px;
	}
	.payment-1{
		margin: 4% 0% 0% 6%;
	}
	.img-danhgia img{
		width: 100px;
		margin: 10px 0px;
	}
	.img-danhgia{
		position: relative;
	}
	.fa-close{
		position: absolute;
		right:56%;
		font-size: 22px;
	} 
	.thumbnail .fa-star,.fa-star-o{
		font-size: 12px;
	}
	.img-send{
		width: 100px;
		margin: 10px 0px;

	}
	.popSearchCompare{
		position: absolute;
		z-index: 99;
		border-radius: 5px;
		color: #333;
		box-shadow: 1px 2px 7px 0 rgba(0, 0, 0, 0.21); 
		width: 30%;
		background: white;
	}
	.hethang{
		padding: 15px;
		color: #a05f1d;
	    background: #fffee7;
	    border: solid 1px #e8ce6d;
	}
	.hethang:hover{
		 background: #fffee7;
		 color: #a05f1d;
		 border: solid 1px #e8ce6d;
		 cursor: none; 
	}
	.itemCompareProducts:hover a{
		color: white;
	}
	.itemCompareProducts{
		padding: 4px 0px 4px 8px;
		width: 100%;
	}
	.itemCompareProducts:hover{
		background: green;
		color: white;
		cursor: pointer;
	}
	.nofi {
		  background: #337ab7;
   		  border: solid 1px #337ab7;
   		  margin-top: 25px;
   		  padding: 15px;
	}
	.form-infor-dathang{
		-webkit-box-shadow: 0px 0px 13px 3px rgba(214,217,217,1);
		-moz-box-shadow: 0px 0px 13px 3px rgba(214,217,217,1);
		box-shadow: 0px 0px 13px 3px rgba(214,217,217,1);
		padding: 10px;
		margin-top:20px; 
	}
	a{
		cursor: pointer;
		color: #333;
	}
	.reply-cmt{
		display: block;
	    position: relative;
	    margin: 5px 0 0 0;
	    padding: 10px 15px 0 12px;
	    clear: both;
	    font-size: 14px;
	    color: #333;
	    line-height: 24px;
	    background: #f8f8f8;
	    border: 1px solid #dfdfdf;
	}
	.name-repcmt{
		display: block;
	    font-size: 14px;
	    color: #333;
	    line-height: 22px;
	    margin-bottom: 7px;
	    border-bottom: 1px solid #dfdfdf;
	    background: #f8f8f8;
	}
	.name-repcmt strong{
		width: 94%;
	    float: left;
	    overflow: hidden;
	    line-height: 22px;
	    margin-top: 2px;
	    font-weight: bold;
	}
	.avatar-repcmt{
		float: left;
	    width: 25px;
	    height: 25px;
	    background: #ddd;
	    margin-right: 7px;
	    text-align: center;
	    color: #666;
	    text-transform: uppercase;
	    font-size: 12px;
	    line-height: 26px;
	    font-weight: 600;
	}
</style>