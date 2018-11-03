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
                        <router-link to='/CreateWarhouse'>
                            <button class="btn btn-danger" style="float: right;" @click='showAddProducts()'v-if='!this.show_addproducts'>Tạo phiếu nhập </button>
                        </router-link>
                        <button class="btn btn-danger" style="float: right;" @click='showAddProducts()'v-if='this.show_addproducts'>Đóng lại </button>
                    </div>
                    <div class="col-xs-15 col-sm-15 col-md-15 col-lg-15 interfact">
                        <div class="col-xs-15 col-sm-15 col-md-15 col-lg-4">
                            <input type="text" class="form-control" placeholder="Nhập tên hoặc mã đon hàng để tìm kiếm" name="" >
                        </div>
                        <div class="col-xs-15 col-sm-15 col-md-15 col-lg-2" style="margin-left: 10px; ">
                             <input type="date" id="input-1" class="form-control"  v-model='dateStar' >
                        </div>

                        <div class="col-xs-15 col-sm-15 col-md-15 col-lg-2" style="margin-left: 10px; ">
                             <input type="date" id="input-2" class="form-control"  v-model='dateEnd' >
                        </div>
                         <input type="button" name="" value="Tìm" class="btn btn-danger" @click='dateSearch()'>
                    </div>
                    <div class="col-xs-15 col-sm-15 col-md-15 col-lg-15 interfact">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center"></th>
                                    <th class="text-center">Mã đơn hàng </th>
                                    <th class="text-center">Người nhập</th>
                                    <th class="text-center">Trạng thái</th>
                                    <th class="text-center">Số lượng</th>
                                    <th class="text-center">Tông tiền</th>
                                    <th class="text-center">Ngày nhập</th>
                                    <th class="text-center">Hành động</th>
                                    <th class="text-center"></th>
                                </tr>
                            </thead>
                            <tbody>
                               <tr v-for='(item,index) in listTrade'>
                                    <td class="text-center"><i class="fa fa-plus-circle plus"></i></td>
                                    <td class="text-center">{{index + 1}}</td>
                                    <td class="text-center">{{item.name}}</td>
                                    <td class="text-center">Hoàn thành</td>
                                    <td class="text-center">{{item.soluong}}</td>
                                    <td class="text-center">{{formatPrice(item.sum)}} ₫</td>
                                    <td class="text-center">{{item.created_at}}</td>
                                    <td class="text-center">
                                        <i class="fa fa-pencil-square-o edit"></i>
                                        <router-link :to="{name:'ListwareHouseProducts',params:{id:item.id}}">
                                            <i class="fa fa-print blue"></i>
                                        </router-link>
                                        <i class="fa fa-trash-o delete" @click = 'deleteImprortProducts(item,index)'></i>
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
            formatPrice(value) {
                let val = (value/1).toFixed(0).replace('.', ',')
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
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