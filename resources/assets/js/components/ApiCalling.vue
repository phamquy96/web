<template>
	<div class="api-calling">
		<vue-markdown :emoji="true">this is the default slot `hey` :)</vue-markdown>
		<div class="error" v-if="errors.length">
			<span v-for="err in errors">
				{{ err }}
			</span>
			<hr>
		</div>
			<div class="create-form">
				<div class="product-name-input form-group">
					<input class="form-control" type="text" v-model="product.name">
				</div>
				<div class="product-name-input form-group">
					<input class="form-control" type="text" v-model.number="product.price">
					<img :src="product.image" id='image'>
				</div>
				<input type="file" id="file" ref="file" v-on:change="handleFileUpload()"/>

				<div class="button-create form-group">
					<button class="btn btn-primary" @click="createProduct">Create</button>
				</div>
			</div>
			
		<hr>
		<div class="list-products">
			<h2>LIST PRODUCT</h2>
			<div class="product-table">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>ID</th>
							<th>Name</th>
							<th>Price</th>
							<th>Hinh anh</th>
							<th>Date created</th>
							<th></th>
						</tr>
					</thead>
					
						<tbody>
							<tr v-for="(prod, index) in list_products">
								<td>{{ prod.id }}</td>
								<td v-if="!prod.isEdit">
									{{ prod.name }}
								</td>
								<td v-else>
									<input type="text" class="form-control" v-model="prod.name">
								</td>
								<td v-if="!prod.isEdit">
									{{ prod.price }}
								</td>
								<td v-else>
									<input type="text" class="form-control" v-model.number="prod.price">
								</td>
								<td v-if="!prod.isEdit">
									<img :src="prod.image" id='image'>
								</td>
								<td v-else>
									<input type="file" id="file" ref="file" v-on:change="handleFileUpload(prod)"/>
									<img :src="prod.image" id='image'>
								</td>
								
								<td>{{ prod.created_at }}</td>
								<td v-if="!prod.isEdit">
									<button class="btn btn-success" @click="editProduct(prod)">Edit</button>
									<button class="btn btn-danger" @click="deleteProduct(prod, index)">Delete</button>
								</td>
								<td v-else>
									<button class="btn btn-primary" @click="updateProduct(prod)">Save</button>
									<button class="btn btn-danger" @click="cancelEdit(prod)">Cancel</button>
								</td>
							</tr>
						</tbody>
					</form>
				</table>
			</div>
		</div>
	</div>
</template>

<script>
	import moment from 'moment'
	import VueMarkdown from 'vue-markdown'
	import {cloneDeep} from 'lodash' //ko dùng clone mà dùng cloneDeep để copy toàn bộ cả thuộc tính nữa
	export default {
		components: {
			VueMarkdown
		},
		data() {
			return {
				product: {
					name: 'anhquy',
					price: 500,
					image:''
				},
				errors: [],
				list_products: [],
				is_editing_some_product: false,
				oldProduct: {}
			}
		},
		created() {
			this.getListProducts()
		},
		methods: {
			// on roi day con xu ly voi' cai oldProduct khi nguoi dung no' sua? xong sau do lai bam calcel nua thoi
			editProduct(prod) {
				this.oldProduct = cloneDeep(prod) // ->ok
				prod.isEdit = true
				this.is_editing_some_product = true
			},
			cancelEdit(prod) {
				prod.isEdit = false
				this.is_editing_some_product = false
				// nếu làm như vừa nãy gán lại trực tiếp bằng đối tượng nó sẽ lỗi vì làm thế nó chỉ trỏ đến địa chỉ còn giá trị thì Vue nó vẫn render ra thằng cũ, làm thế này là đc.
				prod.name = this.oldProduct.name
				prod.price = this.oldProduct.price
				prod.image = this.oldProduct.image
			},
            handleFileUpload(prod){
            	// thay sai chua
            	// no phải là this.$refs.file[0].files[0].name
            	// nhưng lúc thêm thì vẫn thêm thành công ý j? đúng a
            	// thế là do lúc thêm và lúc edit thì cái refs.file kia nó khác nhau em ko dùng chung 1 cấu trúc đc.
            	// giờ em tạo thêm 1 biến is_edit. nếu đang edit thì phải lấy kiểu khác
            	let file
            	if(!this.is_editing_some_product) {
            		file = this.$refs.file.files[0]
            		this.product.image = "/img/"+ file.name; // Neu tao san pham
            	}
		        
            	else {
            		file = this.$refs.file[0].files[0]
            		this.product.image = "/img/"+ file.name; // Neu edit
            	}
		        let formData = new FormData();

		        formData.append('file', file); //haizz, lan sau dung viet lap di lap lai 1 doan code em nhe
		            axios.post( '/single-file',
	                formData,
	                {
	                headers: {
	                    'Content-Type': 'multipart/form-data'
	                }
	              }
	            ).then(response=>{
	            	  prod.image = '/img/' + response.data.result
			          console.log(response.data.result) // o day sau khi upload thanh cong thi em phải cap nhật ngay lại đường dẫn cho thằng product, nhưng nếu làm vậy mà người dùng lại ko muốn chỉnh sửa nữa thì lại phải lấy lại giá trị cũ, nên em cần lưu lại cái đường dẫn cũ. mà ko chỉ có ảnh đâu, các trường khác cũng vậy em đã tính đến khả năng mà nó sửa xong nhưng lại bấm cancel ko muốn sửa nữa chưa, nếu vậy em cần lưu lại giá trị của cả object image ban đầu phòng khi cần recover. A sẽ dùng lodash để clone
			        })
			        .catch(function(){
			          console.log('FAILURE!!')
			        });
		      },
			formatDate(d) {
				var dformat = [ d.getFullYear(), (d.getMonth()+1),
                    d.getDate()
                    ].join('/')+
                    ' ' +
                  [ d.getHours(),
                    d.getMinutes(),
                    d.getSeconds()].join(':');
                    return dformat
			},
			createProduct() {
				this.errors = []

				axios.post('/products', {name: this.product.name, price: this.product.price,image: this.product.image})
				.then(response => {
					console.log(response.data.result)
					this.list_products.push({
						id: response.data.result.id,
						name: this.product.name,
						price: this.product.price,
						image: this.product.image,
						created_at: moment().format('YYYY-MM-DD HH:mm:ss'),
						isEdit: false
					})
				})
				.catch(error => {
					this.errors = error.response.data.errors.name,
					this.errors = error.response.data.errors.image
				})
			},
			getListProducts() {
				axios.get('/products')
				.then(response => {
					this.list_products = response.data
					this.list_products.forEach(item => {
						Vue.set(item, 'isEdit', false)
					})
				})
				.catch(error => {
					this.errors = error.response.data.errors.name
				})
			},
			updateProduct(product) {
				console.log(product.image)
				axios.put('/products/' + product.id, {name: product.name, price: product.price,image: product.image})
				.then(response => {
					console.log(response.data.result)
					product.isEdit = false
				})
				.catch(error => {
					this.errors = error.response.data.errors.name
				})
			},
			deleteProduct(product, index) {
				axios.delete('/products/' + product.id)
				.then(response => {
					console.log(response.data.result)
					this.list_products.splice(index, 1)
				})
				.catch(error => {
					this.errors = error.response.data.errors.name
				})
			}
		}
	}
</script>

<style>
.error {
	span {
		color: red;
	}
}
#image{
	width :150px;
}
</style>