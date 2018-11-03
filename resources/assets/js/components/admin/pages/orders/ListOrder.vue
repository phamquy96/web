<template>
	<div>
        <div class="container-fluid">
            <Nav></Nav>
        </div>
        <div class="container-fluid">
            <NavBar></NavBar>
            <div class="col-xs-5 col-sm-5 col-md-5 col-lg-10 content">
                    <h3>Danh sách đơn hàng</h3>
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
                                    <th class="text-center">Mã đơn hàng</th>
                                    <th class="text-center">Ngày bán</th>
                                    <th class="text-center">Hình thức giao dịch</th>
                                    <th class="text-center" style="width: 190px;">
                                        <select class="form-control">
                                            <option>Khách hàng</option>
                                            <option>Đơn hàng đã xóa</option>
                                            <option>Đơn hàng còn nợ</option>
                                        </select>
                                    </th>
                                    <th class="text-center" style="width: 154px;">
                                        <select class="form-control" v-model ='status'>
                                            <option v-bind:value="-1">Trạng thái</option>
                                            <option v-bind:value="0">Khởi tạo</option>
                                            <option v-bind:value="1">Hoàn thành</option>
                                            <option v-bind:value="2">Xác nhận</option>
                                            <option v-bind:value="3">Đang giao</option>
                                            <option v-bind:value="4">Đã giao</option>
                                            <option v-bind:value="5">Hủy</option>
                                        </select>
                                    </th>
                                    <th class="text-center">Tông tiền</th>
                                    <th class="text-center">Nợ</th>
                                    <th class="text-center">Hành động</th>
                                    <th class="text-center"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for='(item,index) in filterlistOrders'>
                                    <td class="text-center"><i class="fa fa-plus-circle plus"></i></td>
                                    <td class="text-center">{{index + 1}}</td>
                                    <td class="text-center">{{item.date_order}}</td>
                                    <td class="text-center" v-if='item.payment == 0'>Onine</td>
                                    <td class="text-center" v-if='item.payment == 1'>Thanh toán trực tiếp</td>
                                    <td class="text-center">{{item.name}}</td>
                                    <td class="text-center" v-if='item.status == 0 && !item.isEdit'>Khởi tạo</td>
                                    <td class="text-center" v-if='item.status == 1 && !item.isEdit '>Hoàn thành</td>
                                    <td class="text-center" v-if='item.status == 2 && !item.isEdit'>Xác nhận</td>
                                    <td class="text-center" v-if='item.status == 3 && !item.isEdit'>Đang giao</td>
                                    <td class="text-center" v-if='item.status == 4 && !item.isEdit'>Đã giao</td>
                                    <td class="text-center" v-if='item.status == 5 && !item.isEdit'>Hủy</td>
                                    <td class="text-center" v-if=' item.isEdit'>
                                        <select class="form-control" v-model ='item.status' v-if=' item.isEdit'>
                                            <option v-bind:value="-1">Trạng thái</option>
                                            <option v-bind:value="0">Khởi tạo</option>
                                            <option v-bind:value="1">Hoàn thành</option>
                                            <option v-bind:value="2">Xác nhận</option>
                                            <option v-bind:value="3">Đang giao</option>
                                            <option v-bind:value="4">Đã giao</option>
                                            <option v-bind:value="5">Hủy</option>
                                        </select>
                                    </td>
                                    <td class="text-center">{{formatPrice(item.sum)}} ₫</td>
                                    <td class="text-center">0</td>
                                    <td class="text-center">
                                        <i title="chỉnh sửa" class="fa fa-pencil-square-o edit" @click='editOrders(item)' v-if=' !item.isEdit'></i>
                                        <i title="Lưu" class="fa fa-close" @click='updateOrders(item)' v-if='item.isEdit'></i>
                                        <i title="In" class="fa fa-print blue"></i>
                                        <i title="Xóa" class="fa fa-trash-o delete"  @click ='deleteOrder(item,index)'></i>
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
                // orders:{
                //     name:'',
                //     image:''
                // },
                statuschange:'',
                listOrders:[],
                status:-1,
                dateStar:'',
                dateEnd:'',
            }
        },
        created(){
            this.getOrders()
        },
        methods:{
             dateSearch(){
                 axios.get('admin/orders/searchdate/'+this.dateStar + '/' + this.dateEnd)
                 .then(response=>{
                    this.listOrders = response.data.listOrdersSearch
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
            updateOrders(item) {
                axios.post('/admin/orders/postorders/' + item.id, {
                     statuschange:item.status
                     })
                .then(response => {
                    console.log(response.data.result)
                    item.isEdit = false
                })
                .catch(error => {
                    this.errors = error.response.data.errors.name
                })
            },
            getOrders(){
                axios.get('/getlistorders').then(response=>{
                    this.listOrders = response.data.listOrders
                    this.listOrders.forEach(item => {
                        Vue.set(item ,'isEdit', false)
                    })
                })
            },
            editOrders(item) { // ->ok
                item.isEdit = true
                console.log(111)

            },
            formatPrice(value) {
                let val = (value/1).toFixed(0).replace('.', ',')
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
            },
            cancelEdit(item){
                 item.isEdit =false
            },
            updateProduct(item) {
                axios.post('/postorders/' + item.id, {
                      status:item.status,
                     })
                .then(response => {
                    console.log(response.data.result)
                    item.isEdit = false
                })
                .catch(error => {
                    this.errors = error.response.data.errors.name
                })
            },
            deleteOrder(item,index){
                axios.get('/admin/orders/deleteOrder/'+item.id).then(response=>{
                    this.listOrders.splice(index, 1)
                }).then(response=>{
                    Vue.swal('success','Xóa thành công','success')    
                })
            },


        },
        computed: {
            filterlistOrders() {
                console.log(323)
                console.log(this.status)
                var id = this.status
                var data = this.listOrders
                if(this.status == -1)
                {
                    return data
                }
                if(this.status == 0){
                    var a = this.search
                    return data.filter(item => item.status == id)
                }
                if(this.status == 1){
                    var a = this.search
                    return data.filter(item => item.status == id)
                }
                if(this.status == 2){
                    var a = this.search
                    return data.filter(item => item.status == id)
                }
                if(this.status == 3){
                    var a = this.search
                    return data.filter(item => item.status == id)
                }
                if(this.status == 4){
                    var a = this.search
                    return data.filter(item => item.status == id)
                }
                if(this.status == 5){
                    var a = this.search
                    return data.filter(item => item.status == id)
                }
                 if(this.status == 6){
                    var a = this.search
                    return data.filter(item => item.status == id)
                }
                
            }
        }
	}
</script>
<style type="text/css" scoped>
    img{
        width: 40px;
    }
</style>