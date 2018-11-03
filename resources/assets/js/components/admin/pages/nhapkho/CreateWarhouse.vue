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
        <div class="content mt-3" >
            <div class="animated fadeIn" >
                <div class="row">
                <div class="col-lg-15">
                    <div class="card">
                        {{product.noibat}}
                      <div class="card-header">
                        <strong>Basic Form</strong> Elements
                      </div>
                        <div class="card-body card-block">
                        <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                          <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Tên Sản Phẩm</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="text-input" name="text-input" placeholder="Text" class="form-control" v-model='search' v-on:keyup='searchProducts'>
                                <p v-for ='item in listProductsSearch' @click='addWarehouse(item)'>{{item.name}}</p>
                                <div class="col-xs-15 col-sm-15 col-md-15 col-lg-15 interfact">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center"></th>
                                    <th class="text-center">Mã đơn hàng</th>
                                    <th class="text-center">Tên sản phẩm</th>
                                    <th class="text-center">Hình ảnh</th>
                                    <th class="text-center">Số lượng thêm</th>
                                    <th class="text-center">Số lượng đang có tại</th>
                                    <th class="text-center">Đơn vị</th>
                                    <th class="text-center">Gía nhập </th>
                                    <th class="text-center">Gía đang bán </th>
                                    <th class="text-center">Thành tiền</th>
                                    <th class="text-center"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for='(item,index) in Warehouse_Products'>
                                    <input type="hidden" name="" v-model ='item.id'>
                                    <td class="text-center"><i class="fa fa-plus-circle plus"></i></td>
                                    <td class="text-center"><a href="">#F9F9F9</a></td>
                                    <td class="text-center">{{item.name}}</td>
                                    <td class="text-center"><img :src="item.image"></td>

                                    <td class="text-center">
                                        <input type="text" class="form-control" v-model="item.qtychange" v-on:keyup='update(item)'> 
                                    </td>
                                    <td class="text-center">{{item.soluong}}</td>
                                    <td class="text-center">Cái</td>
                                    <td class="text-center">
                                        <input type="text" name="" class="form-control" v-model='item.importprices'  v-on:keyup='update(item)'>
                                    </td>
                                    <td class="text-center">
                                        <input type="text" name="" class="form-control" v-model='item.price' >
                                    </td>
                                    <td>{{item.thanhtien}}</td>
                                    <td class="text-center">
                                        <i class="fa fa-pencil-square-o edit"></i>
                                        <i class="fa fa-print blue"></i>
                                        <i class="fa fa-trash-o delete" @click = 'deleteProduct(item,index)'></i>
                                    </td>
                                    <td>
                                        <input type="checkbox" name="">
                                    </td>
                                </tr> 
                            </tbody>
                        </table>
                        <div class="alert alert-info">
                            <div>
                                Tổng số hóa đơn: <span>5</span> Tổng tiền: <span>3,507,500</span> Tổng nợ:<span> 0</span>
                            </div>
                        </div>
                    </div> 
                            </div>
                          </div>
                        </form>
                      </div>
                      <div class="card-footer">
                        <button class="btn btn-primary btn-sm" @click='post()'>
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
                Warehouse_Products:[],
                listProductsSearch:[],
                show_addproducts:false,
                search:'',
                id_subcates:'',
                qty:1,
                listTrade:[],
                dateStar:'',
                dateEnd:'',
            }
        },
        created(){
            this.getListTrade()
        },
        methods:{
            dateSearch(){
                 axios.get('admin/warehouse/searchdate/'+this.dateStar + '/' + this.dateEnd)
                 .then(response=>{
                    this.listTrade = response.data.listWasehouesSearch
                 })
                 .catch(errors=>{
                    console.log('Errors')
                 })
             },
            searchProducts(){
                 axios.get('/addsearchproducts/'+this.search).then(response=>{
                    this.listProductsSearch = response.data.products.slice(0,5)
                })
            },
            getListTrade(){
                axios.get('/listtrade').then(response=>{
                    this.listTrade = response.data.listTrade
                })
            },
            update(products){
                 this.Warehouse_Products.forEach(item => {
                     var thanhtien =  item.importprices * products.qtychange
                    if(item.id == products.id)
                    {
                        products.thanhtien = thanhtien
                    }
                 })
            },
            addWarehouse(item){
                var thanhtien =  item.importprices * this.qty
                this.Warehouse_Products.push({
                    id:item.id,
                    name : item.name,
                    image: item.image,
                    price: item.price,
                    thanhtien : thanhtien,
                    qtychange : 1,
                    soluong: item.soluong,
                    importprices:item.importprices
                })
                
            },
             deleteOrder(item,index){
                axios.get('/admin/import/import/'+item.id).then(response=>{
                    this.listOrders.splice(index, 1)
                }).then(response=>{
                    Vue.swal('success','Xóa thành công','success')    
                })
            },
            post(){
                axios.post('/postproductskho',{Warehouse_Products:this.Warehouse_Products})
                .then(response=>{
                    this.listTrade = response.data.listTrade
                    Vue.swal('success','Xóa thành công','success')
                }).catch(errors=>{
                    console.log('loi')
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
            showAddProducts(){
                this.show_addproducts = !this.show_addproducts
            },
            deleteImprortProducts(item,index){
                axios.get('/deletelisttrade/'+ item.id)
                .then(response=>{
                    this.listTrade.splice(index,1) 
                    Vue.swal('success','Xóa thành công','success')
                })
                .catch(errors=>{
                    console.log('errors delete');
                })
                
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
    .fa{
        font-size: 15px;
    }
</style>