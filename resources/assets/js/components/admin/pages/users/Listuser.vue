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
                    </div>
                    <div class="col-xs-15 col-sm-15 col-md-15 col-lg-15 interfact">
                        <div class="col-xs-15 col-sm-15 col-md-15 col-lg-4">
                            <input type="text" class="form-control" placeholder="Nhập tìm kiếm thành viên" name=""v-model='search' v-on:keyup="SearchInvetory">
                        </div>
            
                    </div>
                    <div class="col-xs-15 col-sm-15 col-md-15 col-lg-15 interfact">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center"></th>
                                    <th class="text-center">Tên sản phẩm</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Quyền</th>
                                    <th class="text-center">Hành động</th>
                                    <th class="text-center"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for='(item,index) in listUser' >
                                    <td class="text-center"><i class="fa fa-plus-circle plus"></i></td>
                                    <td class="text-center" v-if='!item.isEdit'>{{item.name}}</td>
                                    <td class="text-center" v-if='item.isEdit'><input type="text" name="" v-model='item.name' class="form-control"></td>
                                    <td class="text-center" v-if='!item.isEdit'>{{item.email}}</td>
                                    <td class="text-center" v-if='item.isEdit'><input type="text" name="" v-model='item.email' class="form-control"></td>
                                    <td class="text-center" v-if='item.level == 0 && !item.isEdit'>Thành viên</td>
                                    <td class="text-center" v-if='item.level == 1 && !item.isEdit'>Admin</td>
                                    <td class="text-center" v-if='item.isEdit'>
                                        <select class="form-control" v-model='item.level'>
                                            <option v-bind:value=0 >Thành Viên</option>
                                            <option v-bind:value=1 >Admin</option>
                                        </select>
                                    </td>
                                    <td class="text-center">
                                        <i class="fa fa-pencil-square-o edit" title="Sửa" v-if='!item.isEdit' @click='editUser(item)'></i>
                                        <i class="fa fa-close edit" title="Sửa" v-if='item.isEdit' @click='updateUser(item)'></i>
                                        <i class="fa fa-print blue" title="In"></i>
                                        <i class="fa fa-trash-o delete" title="Xóa" @click='deleteUser(item,index)'></i>
                                    </td>
                                    <td>
                                        <input type="checkbox" name="">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="alert alert-info">
                            <div style="float: left;">
                                Tổng số thành viên: <span>{{this.listUser.length}}</span> 
                            </div>
                            <div style="clear: both;"></div>
                           
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
                listUser:[]
            }
        },
        created(){
            this.getlistUser()
        },
        methods:{
            editUser(item){
                item.isEdit = true
            },
            getlistUser(){
                axios.get('/admin/user/listuser').then(response=>{
                    this.listUser = response.data.listUser
                    console.log(this.listUser)
                    this.listUser.forEach(item => {
                        Vue.set(item ,'isEdit', false)
                    })
                })
            },
             SearchInvetory(){
                if(this.search =='')
                {
                    axios.get('/admin/user/searchblank/')
                    .then(response=>{
                        this.listUser =response.data.user
                        this.listUser.forEach(item => {
                            Vue.set(item ,'isEdit', false)
                        })
                    }).catch(errors=>{
                        console.log('Errors');
                    })
                }if(this.search != ''){
                    axios.get('/admin/user/search/'+this.search)
                    .then(response=>{
                        this.listUser =response.data.user
                        this.listUser.forEach(item => {
                            Vue.set(item ,'isEdit', false)
                        })
                    }).catch(errors=>{
                        console.log('Errors');
                    })
                }
                 
             },
              deleteUser(item,index){
                axios.get('/admin/products/deleteProducts/'+item.id).then(response=>{
                    this.listProducts.splice(index, 1)
                    Vue.swal('success','Xóa thành công!!!','success');
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
            getProducts(){
                axios.get('/getproducts').then(response=>{
                    this.listProducts = response.data.products.slice(0,8)
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
            updateUser(item){
                axios.post('/admin/user/editUser/'+item.id,{
                    name:item.name,
                    email:item.email,
                    level:item.level
                }).then(response=>{
                     item.isEdit = false
                    Vue.swal('success','Sửa user thành công !!','success')
                }).catch(errors=>{
                    console.log('errors') 
                })
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