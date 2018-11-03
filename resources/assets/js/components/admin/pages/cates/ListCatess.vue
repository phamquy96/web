<template>
	<div>
	
		<NavBar></NavBar>
    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
       <Nav></Nav> 
        <!-- Header-->

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Dashboard</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">Dashboard</a></li>
                            <li><a href="#">Table</a></li>
                            <li class="active">Data table</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Data Table</strong>
                        </div>
                        <div class="card-body">
                  <table id="bootstrap-data-table" class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>Id</th>
                        <th>Tên Hãng</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for='(item,index) in List_cates'>
                        <td>{{item.id}}</td>
                        <td v-if="!item.isEdit">{{item.name}}</td>
                        <td v-else><input type="text" v-model='item.name' ></td>
                        <td v-if="!item.isEdit">
                            <button class="btn btn-success" @click="editProduct(item)">Edit</button>
                            <button class="btn btn-success" @click="deleteProduct(item,index)">Xoa</button>
                        </td>
                        <td v-else>
                            <button class="btn btn-primary" @click="updateProduct(item)">Save</button>
                            <button class="btn btn-danger" @click="cancelEdit(item)">Cancel</button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                        </div>
                    </div>
                </div>


                </div>
            </div><!-- .animated -->
        </div>
    </div>
	</div>
</template>
<script>
import NavBar from './../../layout/NavBar.vue'
import Nav from './../../layout/Nav.vue'
	export default{
		components:{
			NavBar,
			Nav
		},
        data(){
            return{
                cates:{
                    name:''
                },
                List_cates:[]
            }
        },
        created(){
            this.getCates()
        },
        methods:{
            getCates(){
                axios.get('/getcates').then(response=>{
                    this.List_cates = response.data.cates
                    console.log(response.data.cates)
                    this.List_cates.forEach(item => {
                        Vue.set(item ,'isEdit', false)
                    })
                })
            },
            editProduct(item){
                item.isEdit =true
            },
            cancelEdit(item){
                 item.isEdit =false
            },
            updateProduct(item) {
                axios.post('/postcates/' + item.id, {name: item.name})
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
                    this.List_cates.splice(index, 1)
                })
            }
        }
	}
</script>