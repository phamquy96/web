<template>
	<div>
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
							<div class=" col-xs-10 col-sm-10 col-md-10 col-lg-9 bar-rating" style="background: red;height: 7px;">
							</div>
								<span>122 đánh giá</span>
						</div>
						<div class="row tool-bar-star">
							<div class=" col-xs-6 col-sm-2 col-md-2 col-lg-2 level-star" >
								<span>4</span><i class="fa fa-star"></i>
							</div>
							<div class=" col-xs-10 col-sm-10 col-md-10 col-lg-9 bar-rating" style="background: red;height: 7px;">
							</div>
								<span>122 đánh giá</span>
						</div>
						<div class="row tool-bar-star">
							<div class=" col-xs-6 col-sm-2 col-md-2 col-lg-2 level-star" >
								<span>3</span><i class="fa fa-star"></i>
							</div>
							<div class=" col-xs-10 col-sm-10 col-md-10 col-lg-9 bar-rating" style="background: red;height: 7px;">
							</div>
								<span>122 đánh giá</span>
						</div>
						<div class="row tool-bar-star">
							<div class=" col-xs-6 col-sm-2 col-md-2 col-lg-2 level-star" >
								<span>2</span><i class="fa fa-star"></i>
							</div>
							<div class=" col-xs-10 col-sm-10 col-md-10 col-lg-9 bar-rating" style="background: red;height: 7px;">
							</div>
								<span>122 đánh giá</span>
						</div>
						<div class="row tool-bar-star">
							<div class=" col-xs-6 col-sm-2 col-md-2 col-lg-2 level-star" >
								<span>1</span><i class="fa fa-star"></i>
							</div>
							<div class=" col-xs-10 col-sm-10 col-md-10 col-lg-9 bar-rating" style="background: red;height: 7px;">
							</div>
								<span>122 đánh giá</span>
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
						  <button class="btn btn-danger  btn-block" @click='handleRanting()'>Gửi đánh giá</button>
					</div>
				</div>
			</div>
		<!-- 	phần comment dánh giá  -->

			<div class="row cmt-danhia" v-for='item in cmtrating'>
				<div class=" col-sm-15 col-md-15 col-lg-15">
					<div class="panel-cmt">
					   <strong>Phậm Đức Qúy</strong>
					 </div>
				</div>
				<div class="col-sm-14 col-md-14 col-lg-14" style="margin-top:-12px; ">
				   <span class="fa fa-star" v-for=' star in item.star'></span><span class="fa fa-star-o" v-for=' start in 5-(item.star)'></span>
					<span class="content-cmt-danhgia">{{item.content}}</span>
				</div>
				<img :src="item.image" class="img-send">
				<div class=" col-sm-15 col-md-15 col-lg-15" style="margin-top:4px; ">
					<a  @click='tooglecmtrating(item)'>Thảo luận</a>
					<span style="margin-left: 10px; " >2 ngày trước</span>
				</div>
				<div class=" col-sm-15 col-md-15 col-lg-7" style="margin-top:4px;" v-if='item.is_rating'>
					<input type="text"  class="form-control" v-model='item.contentcmt'>
					<button class="btn btn-danger" @click = 'sendRepCmtDanhgia(item)'>Gửi</button>
				</div>
				<i v-for='prod in repcommentdanhgia'>{{prod}}</i>
			</div>
			<div class="row">
				<ul class="pagination">
				    <li><a href="#">1</a></li>
				    <li><a href="#">2</a></li>
				    <li><a href="#">3</a></li>
				    <li><a href="#">4</a></li>
				    <li><a href="#">5</a></li>
				 </ul>
			</div>
		</div>
	</div>
</template>
<script >
	import StarRating from 'vue-star-rating'
	export default{
		components: {
		  StarRating,
		},
		// props: ['cmtrating','List_Comment'],
		data(){
			return{
				evaluate:{
					name:'',
					phone:'',
					email:'',
					id_products:0,
					content:'',
					image:''
				},
				comment:{
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
				}
			}
		},
		created:function(){
			
		},
		methods:{
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
			closeImgPostDanhgia(){
				this.evaluate.image =''
				this.show_CloseImg=true
			},
			detailProducts(id){
				this.isloading = true,
				this.getProductsDetail(id);
			},	
			
            closeFormDanhgia(){
            	this.is_Closeform = !this.is_Closeform
            },
            handleRanting()
            {
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
                  this.cmtrating.unshift({
                  	star :this.star,
            		phone :this.evaluate.phone,
            		email :this.evaluate.email,
            		name :this.evaluate.name,
            		image :this.evaluate.image,
            		content:this.evaluate.content,
                  })
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
            sendRepCmtDanhgia(item){
            	axios.post('/repycmtdanhgia',{
            		id_danhgia : item.id,
            		content:item.contentcmt,
            	})
            	.then(response=>{
            		this.repcommentdanhgia.push({
            			content:this.replydanhgia.content,
            		})
            	});
            },
            SendRepComment(item){
            	axios.post('/repycmt',{
            		id_comment : item.id,
            		content:item.repcontentcmt,
            	})
            	.then(response=>{
            		this.repcommentdanhgia.push({
            			content:this.replydanhgia.content,
            		})
            	});
            },
            formatPrice(value) {
		        let val = (value/1).toFixed(0).replace('.', ',')
		        return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
	    	},
	    	compareProducts(){
	    		
	    	},
	    	reciveNofj(){
	    		this.show_receive_infor =true
	    	}
		},
		
	}
</script>