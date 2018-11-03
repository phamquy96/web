<template>
	<div>
        <div class="container-fluid">
            <Nav></Nav>
        </div>
        <div class="container-fluid">
            <NavBar></NavBar>
            <div class="col-xs-5 col-sm-5 col-md-5 col-lg-10 content">
                    <div class="col-xs-15 col-sm-15 col-md-15 col-lg-15 ">
                        <h3 style="float: left;">Danh sách sản phẩm</h3>
                        <button class="btn btn-danger" style="float: right;">Tạo sản phẩm </button>
                    </div>
                    <div class="col-xs-15 col-sm-15 col-md-15 col-lg-15 interfact">
                        <div class="col-xs-15 col-sm-15 col-md-15 col-lg-4">
                            <input type="text" name="" class="form-control" placeholder="Nhập tên hoặc mã đon hàng để tìm kiếm" v-model='search' v-on:keyup="SearchInvetory">
                        </div>
                        <div class="col-xs-15 col-sm-15 col-md-15 col-lg-2" style="margin-left: 10px; " @change ='SortInvetory()'>
                            <select class="form-control" v-model='sort'>
                                <option v-bind:value = 0>--Sắp xếp--</option>
                                <option v-bind:value = 1>Gía cáo đến thấp</option>
                                <option v-bind:value = 2>Gía thấp đến cao</option>
                            </select>
                        </div>
                        <div class="col-xs-15 col-sm-15 col-md-15 col-lg-2" style="margin-left: 10px; ">
                            <select class="form-control" v-model='choose' @change ='chooseProducts()'>
                                <option  v-bind:value = 0>-- Tất cả --</option>
                                <option  v-bind:value = 1>Chỉ lấy hàng tồn</option>
                                <option  v-bind:value = 2>Hết hàng</option>
                            </select>
                        </div>
            
                    </div>
                    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-15 thongketonkho">
                        <div class="col-xs-15 col-sm-15 col-md-15 col-lg-15 report">
                            <div class="report-green">
                                <div class="content-rep">
                                    <p> <i class="fa fa-signal"></i>Ngày thống kê {{datenow}}</p>
                                </div>
                            </div>
                            <div class="report-green">
                                <div class="content-rep">
                                    <p> <i class="fa fa-shopping-cart"></i>Số lượng tồn kho {{formatPrice(qtyInventory)}} ₫</p>
                                </div>
                            </div>
                            <div class="report-green">
                                <div class="content-rep">
                                    <p> <i class="fa fa-undo"></i>Tổng vốn tồn kho {{formatPrice(importmoneyInventory)}} ₫</p>
                                </div>
                            </div>
                            <div class="report-green">
                                <div class="content-rep">
                                    <p> <i class="fa fa-cloud"></i>Tổng giá trị tồn kho {{formatPrice(moneyInventory)}} ₫</p>
                                </div>
                            </div>
                        </div>
                    
                    </div>
                    <div class="col-xs-15 col-sm-15 col-md-15 col-lg-15 interfact">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">Mã đơn hàng</th>
                                    <th class="text-center">Tên Sản Phẩm</th>
                                    <th class="text-center">Hình ảnh</th>
                                    <th class="text-center">Số lượng</th>                       
                                    <th class="text-center">Vốn tồn kho</th>
                                    <th class="text-center">Gía trị tồn</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for='(item,index) in listInventory'>
                                    <td class="text-center">{{index + 1}}</td>
                                    <td class="text-center">{{item.name}}</td>
                                    <td class="text-center"><img :src="item.image"></td>
                                    <td class="text-center">{{item.soluong}}</td>
                                    <td class="text-center">{{formatPrice((item.price)*(item.soluong))}} ₫</td>
                                    <td class="text-center">{{formatPrice((item.importprices)*(item.soluong))}} ₫</td>
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
                products:{
                    name:'',
                    image:''
                },
                listInventory:[],
                qtyInventory:0,
                moneyInventory:0,
                importmoneyInventory:0,
                search:'',
                sort:0,
                choose:0,
                datenow:''
            }
        },
        created(){
            this.getInventory()
        },
        methods:{
             chooseProducts(){
                axios.get('/admin/invetory/choose/'+this.choose)
                .then(response=>{
                    this.listInventory =response.data.products
                    this.qtyInventory = response.data.qty
                    this.importmoneyInventory = response.data.summoneyiventon
                    this.moneyInventory = response.data.summoney
                    this.datenow = response.data.datenow
                }).catch(errors=>{
                    console.log('Errors');
                }) 
             },
             SearchInvetory(){
                if(this.search =='')
                {
                    axios.get('/admin/invetory/searchblank/')
                    .then(response=>{
                        this.listInventory =response.data.products
                    }).catch(errors=>{
                        console.log('Errors');
                    })
                }if(this.search != ''){
                    axios.get('/admin/invetory/search/'+this.search)
                    .then(response=>{
                        this.listInventory =response.data.products
                    }).catch(errors=>{
                        console.log('Errors');
                    })
                }
                 
             },
             SortInvetory(){
                axios.get('/admin/invetory/sort/'+this.sort)
                .then(response=>{
                    this.listInventory =response.data.products
                }).catch(errors=>{
                    console.log('Errors');
                }) 
             },
             // SearchInvetory(){
             //    axios.post('/admin/invetory/search/',{
             //        search: this.search,
             //        sort:this.sort,
             //        choose:this.choose
             //    }).then(response=>{
             //        console.log(ok)
             //    }).catch(errors=>{
             //        console.log('Errors');
             //    })     
             // },
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
            getInventory(){
                axios.get('/getlistinventory').then(response=>{
                    this.listInventory = response.data.listInventory
                    this.qtyInventory = response.data.qtyInventory
                    this.moneyInventory = response.data.moneyInventory
                    this.importmoneyInventory =response.data.importmoneyInventory
                    this.datenow = response.data.datenow
                    console.log(response.data.qtyInventory)
                     this.listInventory.forEach(item => {
                        Vue.set(item ,'isEdit', false)
                    })
                })
            },
            formatPrice(value) {
                let val = (value/1).toFixed(0).replace('.', ',')
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
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
            }
        }
	}
</script>
<style type="text/css" scoped>
    img{
        width: 40px;
    }
</style>