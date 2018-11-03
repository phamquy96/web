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
                                <label for="text-input" class=" form-control-label">Tên Danh Mục</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="text-input" name="text-input" placeholder="Text" class="form-control" v-model='cates.name'>
                                <small class="form-text text-muted">This is a help text</small>
                            </div>
                          </div>
                          
                        </form>
                        </div>
                        <div class="card-footer">
                        <button class="btn btn-primary btn-sm" @click='CreatedCates()'>
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
                cates:{
                    name:'',
                }
            }
        },
        created:function(){
        },
        methods:{
            CreatedCates(){
                axios.post('/addcates',{
                  name:this.cates.name,
                })
                .then(response=>{
                  console.log(response.data.products);
                })
            }

        }
	}
</script>