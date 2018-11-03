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
                        <button class="btn btn-danger" style="float: right;" @click='showAddProducts()'v-if='!this.show_addproducts'>Tạo sản phẩm </button>
                        <button class="btn btn-danger" style="float: right;" @click='showAddProducts()'v-if='this.show_addproducts'>Đóng lại </button>
                    </div>
                    <div class="col-xs-15 col-sm-15 col-md-15 col-lg-15 interfact">
                        <div class="col-xs-15 col-sm-15 col-md-15 col-lg-4">
                            <input type="text" class="form-control" placeholder="Nhập tên hoặc mã đon hàng để tìm kiếm" name="" v-model='search'>
                        </div>
                        <div class="col-xs-15 col-sm-15 col-md-15 col-lg-2" style="margin-left: 10px; ">
                            <select class="form-control">
                                <option>Đang kinh doanh</option>
                                <option>Đã ngừng kinh doanh</option>
                                <option>Tạm hết hàng</option>
                                <option>Đã xóa</option>
                            </select>
                        </div>
                        <div class="col-xs-15 col-sm-15 col-md-15 col-lg-2" style="margin-left: 10px; ">
                            <select class="form-control" v-model="id_subcates">
                                <option>--Danh Mục--</option>
                                <option v-for='item in subcates' v-bind:value="item.id">{{item.sub_catetitle}}</option>
                            </select>
                        </div>
                        <div class="col-xs-15 col-sm-15 col-md-15 col-lg-2" style="margin-left: 10px; ">
                            <select class="form-control">
                                <option>-- Sắp xếp --</option>
                                <option>Từ A -> Z</option>
                                <option>Từ Z -> A </option>
                                <option>Gía Thấp đến cao</option>
                                <option>Gía cao đến thấp</option>
                                <option>Bán chạy nhất</option>
                            </select>
                        </div>
            
                    </div>
                    <div class="col-xs-15 col-sm-15 col-md-15 col-lg-15 interfact">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center"></th>
                                    <th class="text-center">STT</th>
                                    <th class="text-center">Tên sản phẩm</th>
                                    <th class="text-center">Hình ảnh</th>
                                    <th class="text-center">Số lượng</th>
                                    <th class="text-center">Danh mục</th>
                                    <th class="text-center">Gía</th>
                                    <th class="text-center">Hành động</th>
                                    <th class="text-center"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for='(item,index) in warehouseProducts' >
                                    <td class="text-center"><i class="fa fa-plus-circle plus"></i></td>
                                    <td class="text-center">{{index + 1}}</td>
                                    <td class="text-center">{{item.name}}</td>
                                    <td class="text-center"><img :src="item.image"></td>
                                    <td class="text-center">{{item.qty}}</td>
                                    <td class="text-center">Iphone</td>
                                    <td class="text-center">{{item.price}}</td>
                                    <td class="text-center">
                                        <i class="fa fa-pencil-square-o edit"></i>
                                        <i class="fa fa-print blue"></i>
                                        <i class="fa fa-trash-o delete"></i>
                                    </td>
                                    <td>
                                        <input type="checkbox" name="">
                                    </td>
                                </tr>
                                <!-- <tr v-for='item in filterProductsnew' v-if='filterProductsnew.length>0'>
                                    <td class="text-center"><i class="fa fa-plus-circle plus"></i></td>
                                    <td class="text-center"><a href="">#F9F9F9</a></td>
                                    <td class="text-center">{{item.name}}</td>
                                    <td class="text-center"><img :src="item.image"></td>
                                    <td class="text-center">{{item.id_subcates}}</td>
                                    <td class="text-center">Iphone</td>
                                    <td class="text-center">{{item.price}}</td>
                                    <td class="text-center">
                                        <i class="fa fa-pencil-square-o edit"></i>
                                        <i class="fa fa-print blue"></i>
                                        <i class="fa fa-trash-o delete"></i>
                                    </td>
                                    <td>
                                        <input type="checkbox" name="">
                                    </td>
                                </tr> -->
                            </tbody>
                        </table>
                        <div class="alert alert-info">
                            <div>
                                Tổng số hóa đơn: <span>5</span> Tổng tiền: <span>3,507,500</span> Tổng nợ:<span> 0</span>
                            </div>
                        </div>
                    </div> 


        <div class="content mt-3" >
            <div class="animated fadeIn" >
                <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        {{product.noibat}}
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
                              <select name="select" id="select" class="form-control">
                                <option  v-for='item in cates' :value="item.id">{{item.name}}</option>
                              </select>
                            </div>
                          </div>
                          <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="select" class=" form-control-label">Chọn Hãng</label>
                            </div>
                            <div class="col-12 col-md-9">
                              <select name="select" id="select" class="form-control" v-model='product.subcates_id'>
                                <option value="0">Please select</option>
                                <option  v-for='item in subcates' :value="item.id">{{item.sub_catetitle}}</option>
                              </select>
                            </div>
                          </div>
                          <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Tên Sản Phẩm</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="text-input" name="text-input" placeholder="Text" class="form-control" v-model='product.name'>
                                <small class="form-text text-muted">This is a help text</small>
                            </div>
                          </div>
                          <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Gía Sản Phẩm</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="number" id="text-input" name="text-input" placeholder="Text" class="form-control" v-model='product.price'>
                                <small class="form-text text-muted">This is a help text</small>
                            </div>
                          </div>
                          <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label" >Gía Khuyến Mại</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="number" id="text-input" name="text-input" placeholder="Text" class="form-control" v-model='product.discount'>
                                <small class="form-text text-muted">This is a help text</small>
                            </div>
                          </div>
                          <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label" >Số lượng</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="number" id="text-input" name="text-input" placeholder="Text" class="form-control" v-model='product.qty'>
                                <small class="form-text text-muted">This is a help text</small>
                            </div>
                          </div>
                          <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Thông tin khuyên mại</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="text-input" name="text-input" placeholder="Text" class="form-control" v-model='product.thongtinkhuyenmai'>
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
                                  <input type="radio" id="inline-radio1" name="inline-radios" value="1" class="form-check-input" v-model='product.noibat'>Có
                                </label>
                                <label for="inline-radio2" class="form-check-label ">
                                  <input type="radio" id="inline-radio2" name="inline-radios" value="0" class="form-check-input" v-model='product.noibat'>Không
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
                         
                          <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="file-multiple-input" class=" form-control-label">
                                Chọn nhiều ảnh hơn
                            </label>
                            </div>
                            <!-- <div class="col-12 col-md-9">
                                <input type="file" id="files" ref="files" multiple v-on:change="handleFileUploads()"/>
                                <img :src="this.product.mulimage">
                            </div> -->
                          </div>
                        </form>
                      </div>
                      <div class="card-footer">
                        <button class="btn btn-primary btn-sm" @click='CreatedProducts()'>
                          <i class="fa fa-dot-circle-o"></i> Submit
                        </button>
                        <button type="reset" class="btn btn-danger btn-sm">
                          <i class="fa fa-ban"></i> Reset
                        </button>
                      </div>
                    </div>
                   
                  </div>
                </div>
            </div><!-- .animated -->
        </div><!-- .content --> 
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
                    qty:''
                },
                cates:[],
                subcates:[],
                listProducts:[],
                show_addproducts:false,
                search:'',
                id_subcates:'',
                warehouseProducts:[],
            }
        },
        created(){
            this.getProductsWarehouse()
            this.page()
        },
        methods:{

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
            getProductsWarehouse(){
                axios.get('/productswarehouse').then(response=>{
                    console.log(response.data.warehouseProducts)
                    this.warehouseProducts = response.data.warehouseProducts
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
                })
                .catch(error => {
                    this.errors = error.response.data.errors.name
                })
            },
            deleteProduct(item,index){
                axios.get('/deletecates/'+item.id).then(response=>{
                    this.List_Products.splice(index, 1)
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
                })
                .then(response=>{
                  console.log(response.data.products);
                })
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
        computed:{
            //filter theo ID SUB_CATES
        filterProducts() {
                console.log(this.id_subcates)
                var id = this.id_subcates
                var data = this.listProducts
                 if(this.id_subcates == '')
                {
                    return data
                }
                if(this.id_subcates > 1){
                    return data.filter(item => item.id_subcates == id)
                }
            },
             //filter theo Tên
         filterProductsnew() {
                console.log(323)
                var data = this.listProducts
                var search = this.search
                return data.filter(function (item) {
                    return item.name.toLowerCase().includes(search.toLowerCase())
                })
            }
        }

	}
</script>
<style type="text/css" scoped>
    img{
        width: 40px;
    }
</style>