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
                            <li><a href="#">Forms</a></li>
                            <li class="active">Basic</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                      <div class="card-header">
                        <strong>Basic Form</strong> Elements
                      </div>
                        <div class="card-body card-block">
                        <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                         
                          <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="select" class=" form-control-label">Chọn Hãng</label>
                            </div>
                            <div class="col-12 col-md-9">
                              <select name="select" id="select" class="form-control" v-model='subcates.cates_id'>
                                <option  v-for='item in cates' :value="item.id">{{item.name}}</option>
                              </select>
                            </div>
                          </div>
                          <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Tên Sản Phẩm</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="text-input" name="text-input" placeholder="Text" class="form-control" v-model='subcates.name'>
                                <small class="form-text text-muted">This is a help text</small>
                            </div>
                          </div>
                           <input type="file" id='file' class="form-control-file" v-on:change='uploadImg()' 
                                ref='file'>
                        </form>
                      </div>
                      <div class="card-footer">
                        <button class="btn btn-primary btn-sm" @click='CreatedSubcates()'>
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


    </div><!-- /#right-panel -->
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
                subcates:{
                    cates_id:1,
                    name:'',
                    image:''                
                },
                cates:[],
            }
        },
        created(){
            this.getCates()
        },
        methods:{
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
                      this.subcates.image = '/img/' + response.data.result
                      console.log(response.data.result) 
                    })
                    .catch(function(){
                      console.log('FAILURE!!')
                    });
              
            },
            getCates(){
                axios.get('/getcates').then(response => {
                    this.cates = response.data.cates
                })
                .catch(error => {
                   console.log('FAIL')
                })
            },
            CreatedSubcates(){
                    axios.post('/addsubcates',{
                      cates_id:this.subcates.cates_id,
                      name:this.subcates.name,
                      image:this.subcates.image,
                    })
                    .then(response=>{
                      console.log('thongcong')  
                      Vue.swal('Oops...', 'Thêm thành công!', 'success')    
                    })
                }
            }, 
	   }
</script>