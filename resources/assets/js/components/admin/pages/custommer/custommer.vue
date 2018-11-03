<template>
	<div>
        <div class="container-fluid">
            <Nav></Nav>
        </div>
        <div class="container-fluid">
            <NavBar></NavBar>
            <div class="col-xs-5 col-sm-5 col-md-5 col-lg-10 content">
                    <div class="col-xs-15 col-sm-15 col-md-15 col-lg-15 ">
                        <h3 style="float: left;">Khách hàng</h3>
                        <button class="btn btn-danger" style="float: right;">Tạo sản phẩm </button>
                    </div>
                    <div class="col-xs-15 col-sm-15 col-md-15 col-lg-15 interfact">
                        <div class="col-xs-15 col-sm-15 col-md-15 col-lg-4">
                            <input type="text" name="" class="form-control" placeholder="Nhập tên hoặc mã đon hàng để tìm kiếm" v-model ='search'>
                        </div>
                        <div class="col-xs-15 col-sm-15 col-md-15 col-lg-2" style="margin-left: 10px; ">
                            <select class="form-control">
                                <option>Đơn hàng</option>
                                <option>Đơn hàng đã xóa</option>
                                <option>Đơn hàng còn nợ</option>
                            </select>
                        </div>
                    </div>
                   
                    <div class="col-xs-15 col-sm-15 col-md-15 col-lg-15 interfact">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">Mã đơn hàng</th>
                                    <th class="text-center">Tên Khách hàng</th>
                                    <th class="text-center">Điện thoại</th>
                                    <th class="text-center">Địa chỉ</th>                       
                                    <th class="text-center">Lần cuối mua hàng</th>
                                    <th class="text-center">Tổng tiền mua hàng</th>
                                    <th class="text-center">Nợ</th>
                                    <th class="text-center"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for='(item,index) in filterlistCustomer'>
                                    <td class="text-center">{{index + 1}}</td>
                                    <td class="text-center">{{item.name}}</td>
                                    <td class="text-center">{{item.phone}}</td>
                                    <td class="text-center">Hà Nội</td>
                                    <td class="text-center">{{item.created_at}}</td>
                                    <td class="text-center">3.200.000đ</td>
                                    <td class="text-center">0
                                    <td class="text-center">
                                        <i title="Xóa" class="fa fa-trash-o delete"  @click ='deleteCustomer(item,index)'></i>
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
                listCustomer:[],
                qtyInventory:0,
                moneyInventory:0,
                search:''
            }
        },
        created(){
            this.getCustomer()
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
            getCustomer(){
                axios.get('/getlistcustomer').then(response=>{
                    this.listCustomer = response.data.listCustomer
                    this.qtyInventory = response.data.qtyInventory
                    this.moneyInventory = response.data.moneyInventory
                    console.log(response.data.qtyInventory)
                     this.listInventory.forEach(item => {
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
            deleteCustomer(item,index){
                axios.get('/admin/orders/deleteCustomer/'+item.id).then(response=>{
                    this.listCustomer.splice(index, 1)
                }).then(response=>{
                    Vue.swal('success','Xóa thành công','success')    
                })
            },
            formatPrice(value) {
                let val = (value/1).toFixed(0).replace('.', ',')
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
            },
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
         filterlistCustomer() {
                console.log(323)
                var data = this.listCustomer
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