<template>
	<div>
        <div class="container-fluid">
            <Nav></Nav>
        </div>
        <div class="container-fluid">
            <NavBar></NavBar>
            <div class="col-xs-5 col-sm-5 col-md-5 col-lg-10 content" v-if='!this.show_addproducts'>
                    <div class="col-xs-15 col-sm-15 col-md-15 col-lg-15 ">
                        <h3 style="float: left;">Danh sách sản phẩm</h3>
                        <router-link to='/addproducts'>
                            <button class="btn btn-danger" style="float: right;" @click='showAddProducts()'v-if='!this.show_addproducts'>Tạo sản phẩm </button>
                        </router-link>
                    </div>
                    <div class="col-xs-15 col-sm-15 col-md-15 col-lg-15 interfact">
                        <div class="col-xs-15 col-sm-15 col-md-15 col-lg-4">
                            <input type="text" class="form-control" placeholder="Nhập tên hoặc mã đon hàng để tìm kiếm" name=""v-model='search' v-on:keyup="SearchInvetory">
                        </div>
                        <div class="col-xs-15 col-sm-15 col-md-15 col-lg-2" style="margin-left: 10px; ">
                            <select class="form-control"  v-model='choose' @change ='chooseProducts()'>
                                <option v-bind:value = 0>Đang kinh doanh</option>
                                <option v-bind:value = 1>Đã ngừng kinh doanh</option>
                                <option v-bind:value = 2>Tạm hết hàng</option>
                                <option v-bind:value = 3>Sắp hết hàng</option>
                                <option v-bind:value = 4>Đã xóa</option>
                            </select>
                        </div>
                        <div class="col-xs-15 col-sm-15 col-md-15 col-lg-2" style="margin-left: 10px; " @change ='SortInvetory()'> 
                            <select class="form-control" v-model='sort'>
                                <option v-bind:value = 0>-- Sắp xếp --</option>
                                <option v-bind:value = 1>Từ A -> Z</option>
                                <option v-bind:value = 2>Từ Z -> A </option>
                                <option v-bind:value = 3>Gía Thấp đến cao</option>
                                <option v-bind:value = 4>Gía cao đến thấp</option>
                                <option v-bind:value = 5>Bán chạy nhất</option>
                            </select>
                        </div>
            
                    </div>
                    <div class="col-xs-15 col-sm-15 col-md-15 col-lg-15 interfact">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center"></th>
                                    <th class="text-center">Mã đơn hàng</th>
                                    <th class="text-center">Tên sản phẩm</th>
                                    <th class="text-center">Hình ảnh</th>
                                    <th class="text-center">Số lượng</th>
                                    <th class="text-center">Danh mục</th>
                                    <th class="text-center">Gía bán</th>
                                    <th class="text-center">Gía nhập</th>
                                    <th class="text-center">Hành động</th>
                                    <th class="text-center"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for='(item,index) in listProducts' >
                                    <td class="text-center"><i class="fa fa-plus-circle plus"></i></td>
                                    <td class="text-center">{{index + 1}}</td>
                                    <td class="text-center">{{item.name}}</td>
                                    <td class="text-center"><img :src="item.image"></td>
                                    <td class="text-center">{{item.soluong}}</td>
                                    <td class="text-center">{{item.subcates.sub_catetitle}}</td>
                                    <td class="text-center">{{formatPrice(item.price)}} ₫</td>
                                    <td class="text-center">{{formatPrice(item.importprices)}} ₫</td>
                                    <td class="text-center">
                                        <router-link :to="{name:'EditProducts',params:{id:item.id}}">
                                            <i class="fa fa-pencil-square-o edit" title="Sửa"></i>
                                        </router-link>
                                        <i class="fa fa-print blue" title="In"></i>
                                        <i class="fa fa-trash-o delete" title="Xóa" @click='deleteProduct(item,index)'></i>
                                    </td>
                                    <td>
                                        <input type="checkbox" name="">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="alert alert-info">
                            <div style="float: left;">
                                Tổng số hóa đơn: <span>5</span> Tổng tiền: <span>3,507,500</span> Tổng nợ:<span> 0</span>
                            </div>
                            <div style="clear: both;"></div>
                            <!-- <div style="float: right;">
                                 <paginate
                                    v-model="paginate.current_page"
                                    :page-count="paginate.pageCount.length"
                                    :page-range="8"
                                    :margin-pages="paginate.pageCount"
                                    :click-handler="getListPapers"
                                    :prev-text="'Prev'"
                                    :next-text="'Next'"
                                    :container-class="'pagination'"
                                    :page-class="'page-item'">
                                 </paginate>
                            </div> -->
                        </div>          
                    </div> 
            </div>
        </div>
         </div>
	</div>
</template>
<script>
import NavBar from './../../layout/NavBar.vue'
import Nav from './../../layout/Nav.vue'
import {cloneDeep} from 'lodash'
	export default{
		components:{
			NavBar,
			Nav
		},
        data(){
            return{
                product:{
                    subcates_id:'0',
                    name:'',
                    price:'',
                    discount:'',
                    thongtinkhuyenmai:'',
                    thongsokithuat:'',
                    noibat:'',
                    image:'',
                    qty:'',
                    importprice:''
                },
                cates:[],
                subcates:[],
                listProducts:[],
                show_addproducts:false,
                id_subcates:'',
                paginate:{
                   current_page:1,
                   pageCount:'',
                   per_page:0 
                },
                list_papers:[],
                search:'',
                sort:0,
                choose:0,
            }
        },
        created(){
            this.getProducts()
            this.page()
            this.getListPapers()
        },
        methods:{
            chooseProducts(){
                axios.get('/admin/products/choose/'+this.choose)
                .then(response=>{
                    this.listProducts =response.data.products
                }).catch(errors=>{
                    console.log('Errors');
                }) 
             },
             SearchInvetory(){
                if(this.search =='')
                {
                    axios.get('/admin/products/searchblank/')
                    .then(response=>{
                        this.listProducts =response.data.products
                    }).catch(errors=>{
                        console.log('Errors');
                    })
                }if(this.search != ''){
                    axios.get('/admin/products/search/'+this.search)
                    .then(response=>{
                        this.listProducts =response.data.products
                    }).catch(errors=>{
                        console.log('Errors');
                    })
                }
                 
             },
             SortInvetory(){
                axios.get('/admin/products/sort/'+this.sort)
                .then(response=>{
                    this.listProducts =response.data.products
                }).catch(errors=>{
                    console.log('Errors');
                }) 
             },
             clickCallback: function(pageNum) {
                 console.log(pageNum)
             },
             uploadImg(item){
                let file
                    file = this.$refs.file[0].files[0]
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
            getListPapers(page = 1){
                axios.get('/papers/'+ page)
                .then(response=>{
                    console.log(response.data.list_papers)
                    this.listProducts  = response.data.list_papers
                    this.paginate.current_page  = response.data.page
                    this.paginate.per_page  = response.data.per_page
                    this.paginate.pageCount  = response.data.pageCount
                    console.log( this.paginate.current_page)
                })
                .catch(errors=>{
                    console.log('Error')
                })
            },
            getProducts(){
                axios.get('/getproducts').then(response=>{
                    this.listProducts = response.data.products.slice(0,8)
                    this.account = response.data.account
                    this.listProducts.forEach(item => {
                        Vue.set(item ,'isEdit', false)
                    })
                })
            },
            editProduct(item) { // ->ok
                item.isEdit = true

            },
            cancelEdit(item){
                 item.isEdit =false
            },
            updateProduct(item) {
                axios.post('/admin/products/postupdateproducts/' + item.id, {
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
                })
                .catch(error => {
                    this.errors = error.response.data.errors.name
                })
            },
            deleteProduct(item,index){
                console.log('1111')
                axios.get('/admin/products/deleteProducts/'+item.id).then(response=>{
                    this.listProducts.splice(index, 1)
                    Vue.swal('success','Xóa thành công!!!','success');
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
                      console.log(response.data.result) 
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
                  importprice:this.product.importprice
                })
                .then(response=>{
                    Vue.swal('Hello Vue world!!!');
                  console.log(response.data.products);
                })
            },
            formatPrice(value) {
                let val = (value/1).toFixed(0).replace('.', ',')
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
            },
            page(){
                axios.get('/getcates').then(response => {
                    this.cates = response.data.cates
                    this.subcates = response.data.subcates
                    console.log(this.subcates)
                })
                .catch(error => {
                   console.log('FAIL')
                })
            },
            showAddProducts(){
                this.show_addproducts = !this.show_addproducts
            }
        },
	}
</script>
<style type="text/css" scoped>
    img{
        width: 40px;
    }
    .alert-info ul li{
        width: 20px;
        height: 20px;
        color: white;
        background: blue;
        margin:10px;
        text-align: center;
        line-height: 20px;
        cursor: pointer; 
    }
</style>