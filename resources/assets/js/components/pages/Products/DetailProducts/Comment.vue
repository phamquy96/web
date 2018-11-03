<template>
		<div>
			<div>
				<div class="row form-cmt">
						<div class=" col-sm-14 col-md-14 col-lg-14">
							<div class="form-group">
							   <textarea class="form-control" rows="5" id="comment" v-model='comment.content' placeholder="Mời bạn để lại bình luận..."></textarea>
							   <button class="btn btn-danger" @click='SendComment()'>Gửi</button>
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
							   <strong>Phậm Đức Qúy</strong>
							 </div>
						</div>
						<div class="col-xs-14 col-sm-14 col-md-14 col-lg-14" style="margin-top:-12px; ">
							<span class="content-cmt-danhgia">{{item.content}}</span>
						</div>
						<div class=" col-sm-15 col-md-15 col-lg-15" style="margin-top:4px; ">
							<a @click='toggleRepCmt(item)'>Trả lời</a>
							<span style="margin-left: 10px; ">2 ngày trước</span>
						</div>
						<div class=" col-sm-15 col-md-15 col-lg-7" style="margin-top:4px;" v-if='item.contentcmt'>
							 <textarea class="form-control" rows="5" id="comment" v-model='item.repcontentcmt' placeholder="Nhập bình luận .. "></textarea>
							<button class="btn btn-danger" @click = 'SendRepComment(item)' style="margin-top:4px; ">Gửi</button>
						</div>
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
			this.getProducts();
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
                    this.compute.namsao = response.data.namsao
                    this.compute.bonsao = response.data.bonsao
                    this.compute.baosao = response.data.basao
                    this.compute.haisao = response.data.haisao
                    this.compute.motsao = response.data.motsao
                    this.trungbinhstar = response.data.trungbinh; 
                    console.log(response.data.namsao)
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
                });
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
            SendComment(){
				axios.post('/postcomment',{
					content:this.comment.content,
					image:this.comment.image,
					id_products:this.$route.params.id
				}).then(response=>{
					this.List_Comment.unshift({
						content:this.comment.content,
						image:this.comment.image,
					})
				})
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
	    	addCart(){
	    		axios.get('/addCart/'+ this.$route.params.id)
	    		.then(response=>{
	    			console.log(response.data.content)
	    			this.$router.push({
					    name: 'cart', 
					});
	    		})
	    	},
	    	compareProducts(){
	    		
	    	},
	    	reciveNofj(){
	    		this.show_receive_infor =true
	    	}
		},
		
	}
</script>
<style type="text/css">
	.txt-cmt img{width: 100px;}
	.content-cmt img{width: 100px;}
</style>