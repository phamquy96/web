<template>
	<div>
        <div class="container-fluid">
            <Nav></Nav>
        </div>
        <div class="container-fluid">
            <NavBar></NavBar>
            <div class="col-xs-5 col-sm-5 col-md-5 col-lg-15 content">
                    <div class="col-xs-15 col-sm-15 col-md-15 col-lg-15 ">
                        <h3 style="float: left;">Danh sách sản phẩm</h3>
                        <button class="btn btn-danger" style="float: right;">Tạo sản phẩm </button>
                    </div>
                    <div class="col-xs-15 col-sm-15 col-md-15 col-lg-15 interfact">
                        <div class="col-xs-15 col-sm-15 col-md-15 col-lg-4">
                            <input type="text" name="" class="form-control" placeholder="Nhập tên hoặc mã đon hàng để tìm kiếm">
                        </div>
                        <div class="col-xs-15 col-sm-15 col-md-15 col-lg-2" style="margin-left: 10px; ">
                            <select class="form-control">
                                <option>Đơn hàng</option>
                                <option>Đơn hàng đã xóa</option>
                                <option>Đơn hàng còn nợ</option>
                            </select>
                        </div>
                        <div class="col-xs-15 col-sm-15 col-md-15 col-lg-2" style="margin-left: 10px; ">
                            <select class="form-control">
                                <option>--Danh Mục</option>
                                <option>Đơn hàng đã xóa</option>
                                <option>Đơn hàng còn nợ</option>
                            </select>
                        </div>
                        <div class="col-xs-15 col-sm-15 col-md-15 col-lg-2" style="margin-left: 10px; ">
                             <input type="date" id="input-1" class="form-control"  v-model='dateStar' >
                        </div>

                        <div class="col-xs-15 col-sm-15 col-md-15 col-lg-2" style="margin-left: 10px; ">
                             <input type="date" id="input-2" class="form-control"  v-model='dateEnd' >
                        </div>
                         <input type="button" name="" value="Tìm" class="btn btn-danger" @click='dateSearch()'>
            
                    </div>
                    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-15 thongketonkho">
                        <div class="col-xs-15 col-sm-15 col-md-15 col-lg-15 report">
                            <div class="report-green">
                                <div class="content-rep">
                                    <p> <i class="fa fa-signal"></i>Tiền bán hàng 0</p>
                                </div>
                            </div>
                            <div class="report-green">
                                <div class="content-rep">
                                    <p> <i class="fa fa-shopping-cart"></i>Số lượng tồn kho </p>
                                </div>
                            </div>
                            <div class="report-green">
                                <div class="content-rep">
                                    <p> <i class="fa fa-undo"></i>Doanh số {{formatPrice(sumMoney)}}</p>
                                </div>
                            </div>
                            <div class="report-green">
                                <div class="content-rep">
                                    <p> <i class="fa fa-cloud"></i>Tổng giá trị tồn kho </p>
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
                                    <th class="text-center">Thu Ngân</th>
                                    <th class="text-center">Ngày bán</th>                       
                                    <th class="text-center">Tông tiền</th>
                                    <th class="text-center">Số lượng</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for='item in listSales'>
                                    <td class="text-center"><a href="">#F9F9F9</a></td>
                                    <td class="text-center">{{item.name}}</td>
                                    <td class="text-center">Phạm Qúy</td>
                                    <td class="text-center">{{item.created_at}}</td>
                                    <td class="text-center">{{item.sum}}</td>
                                    <td class="text-center">3</td>
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
                listSales:[],
                sumMoney:0,
                dateStar:'',
                dateEnd:'',
            }
        },
        created(){
            this.getSales()
        },
        methods:{
              dateSearch(){
                 axios.get('admin/wasehouse/searchdate/'+this.dateStar + '/' + this.dateEnd)
                 .then(response=>{
                    this.listSales = response.data.listSellSearch
                     console.log('Errors')
                 })
                 .catch(errors=>{
                    console.log('Errors')
                 })
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
            getSales(){
                axios.get('/admin/sales/list').then(response=>{
                    this.listSales = response.data.listSales
                    this.sumMoney = response.data.sumMoney
                    this.listSales.forEach( item =>{
                        var sumQty = 0 ;
                        var sumQty = item.sum
                    })
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