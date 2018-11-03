<template>
	<MainLayout>
		<div>
			<div class="row">
			<h4>So sánh điện thoại {{products.name}} và {{productCompare.name}}  {{sosanhthem.name}}</h4>
		</div>
		<div class="row">
		<table class="table table-bordered">
		  	<tbody>
			    <tr>
			      	<th scope="row">1</th>
			      	<td>
			      		<router-link :to="{name:'detail',params:{id:productCompare.id}}">
				      		<img :src="productCompare.image" style="width: 200px;margin: 10px 0px 0px 80px;">
				      	</router-link>
				      		<h4>{{productCompare.name}}</h4>
				      		<p>{{productCompare.price}} đ</p>
				      		<p style="margin-top:4px; "> <span class="fa fa-star" v-for=' star in avg(productCompare)'></span><span class="fa fa-star-o" v-for=' start in 5-(avg(productCompare))'></span><span class="totaldanhgia">{{productCompare.danhgias.length}} đánh giá</span></p>
			     	 </td>
			     	 <td>
			     	 	<router-link :to="{name:'detail',params:{id:products.id}}">
				      		<img :src="products.image" style="width: 200px;margin: 10px 0px 0px 80px;">
				      	</router-link>
					      	<h4>{{products.name}}</h4>
					      	<p>{{products.price}} đ</p>
					      	<p style="margin-top:4px; "> <span class="fa fa-star" v-for=' star in avg(products)'></span><span class="fa fa-star-o" v-for=' start in 5-(avg(products))'></span><span class="totaldanhgia">{{products.danhgias.length}} đánh giá</span></p>
			      	</td>
			      	<td v-if='!this.is_show_compareProducts' style="position: relative;">
			      		<i class="fa fa-close" @click='DeleteCompare()'></i>
			     	 	<router-link :to="{name:'detail',params:{id:sosanhthem.id}}">
				      		<img :src="sosanhthem.image" style="width: 200px;margin: 10px 0px 0px 80px;">
				      	</router-link>
					      	<h4>{{sosanhthem.name}}</h4>
					      	<p>{{sosanhthem.price}} đ</p>
					      	<p style="margin-top:4px;" v-if='sosanhthem != 0'> <span class="fa fa-star" v-for=' star in avg(sosanhthem)'></span><span class="fa fa-star-o" v-for=' start in 5-(avg(sosanhthem))'></span><span class="totaldanhgia">{{sosanhthem.danhgias.length}} đánh giá</span></p>
					      	<p style="margin-top:4px;" v-if='sosanhthem == 0'> <span class="fa fa-star" v-for=' star in avg(sosanhthem)'></span><span class="fa fa-star-o" v-for=' start in 5-(avg(sosanhthem))'></span><span class="totaldanhgia">{{sosanhthem.danhgias.length}} đánh giá</span></p>
			      	</td>
			     	<td v-if='this.is_show_compareProducts' style="position: relative;">
			      		<!-- <button data-toggle="modal" href='#modal-id-add' >Thêm điên toại để so sánh</button>
			      		<div class="modal fade" id="modal-id-add" v-if='this.is_show_compareProducts'>
			      			<div class="modal-dialog">
			      				<div class="modal-content">
			      					<div class="modal-header">
			      						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			      						<h4 class="modal-title">Modal title</h4>
			      					</div>
			      					<div class="modal-body">
			      						<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" v-for='item in randomProducts' 
			      						@click='sosanhthemsp(item.id)'>
			      							<div class="thumbnail">
			      								<img :src="item.image" alt="" style="width: 80%;">
			      								<div class="caption">
			      									<h3>{{item.name}}</h3>
			      									<p>
			      										{{item.price}}
			      									</p>
			      								</div>
			      							</div>
			      						</div>
			      					</div>
			      					
			      					<div class="modal-footer">
			      						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			      					</div>
			      				</div>
			      			</div>
			      		</div> -->
			      		<input type="text" class="form-control" v-on:keyup="searchCompare" v-model='search' placeholder="Nhập tìm kiếm thêm sản phẩm so sánh"> 
			      		<div class="pop-up-compare" v-if="this.search !='' ">
			      			<div class="showItemSearch" v-for='item in resultProductsCompare'  @click='sosanhthemsp(item.id)'>
			      				<img :src="item.image">
			      				<div class="infor-search">
			      					<span >{{item.name}}</span>
			      					<p>{{item.price}}đ</p>
			      				</div>
			      			</div>
			      		</div>

			      	 </td>
			     	 
			    </tr>
			   	<!-- <tr>
			      	<th scope="row">2</th>
			        <td>Jacob</td>
			        <td>Thornton</td>
			        <td>@fat</td>
			    </tr> -->
		  	</tbody>
		</table>
	</div>
		</div>
	</MainLayout>
</template>
<script>
	export default{
		data(){
			return{
				products:[],
				productCompare:[],
				randomProducts:[],
				sosanhthem:[],
				is_show_compareProducts:true,
				resultProductsCompare:[],
				search:''
			}
		},
		created(){
			this.getProductsCompare()
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
			getProductsCompare(){
				console.log(this.$route.params.id)
				console.log(this.$route.params.in)
				axios.get('/compareProducts/'+this.$route.params.id+'/'+this.$route.params.in)
				.then(response=>{
					console.log('win')
					this.products = response.data.products
					this.productCompare = response.data.productCompare
					this.randomProducts = response.data.randomProducts
				})
				.catch(error=>{	
					console.log('Fail')
				})
			},
			sosanhthemsp(id){
				axios.get('/addsosanh/'+id)
				.then(response=>{
					this.is_show_compareProducts=false,
					this.sosanhthem = response.data.sosanhthem
					console.log( response.data.sosanhthem)
				})
				.catch(error=>{	
					console.log('Fail')
				})
			},
			searchCompare(){
				axios.get('/searchCompare/'+this.search)
				.then(response=>{
					this.resultProductsCompare = response.data.resultProductsCompare.slice(0,5)
					console.log(response.data.resultProductsCompare)
				})
				.catch(error=>{	
					console.log('Fail')
				})
			},
			DeleteCompare(){
				this.sosanhthem = ''
				this.is_show_compareProducts =true,
				this.search = ''
			}

		}
	}
</script>
<style scoped="css">
	.thumbnail img{
		height: 190px;
	}
	a{
		cursor: pointer;
	}
	img{
		cursor: pointer;
	}
	p{
		font-size: 14px;
	    color: #e10c00;
	    line-height: 15px;
	    font-weight: bold;
	}
	.pop-up-compare{
		width: 100%;
		height: auto;
		background: white;
		padding: 5px;
		box-shadow: 1px 2px 7px 0 rgba(0, 0, 0, 0.21); 
	}
	.showItemSearch{
		width: 100%;
		height: 50px;
		cursor: pointer;
	}
	.showItemSearch img{
		width: 40px;
		float: left;
	}
	.showItemSearch p{
		font-size: 13px;
		margin-top:4px;
		border-bottom: dashed 1px  #eee;
	}
	.infor-search {
		float: left;
		width: 80%;
	}
	.fa-close{
		font-size: 23px;
		right: 6%;;
		position: absolute;
	}
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
</style>