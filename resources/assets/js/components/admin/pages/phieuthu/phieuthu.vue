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
                            <input type="text" name="" class="form-control" placeholder="Nhập tên hoặc mã đon hàng để tìm kiếm">
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
                                    <th class="text-center">Mã đơn hàng</th>
                                    <th class="text-center">Ngày thu</th>
                                    <th class="text-center">Người thu</th>
                                    <th class="text-center">Hình thức thu</th>                       
                                    <th class="text-center">Tổng tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for='(item,index) in listphieuthu'>
                                    <td class="text-center">{{index + 1}}</td>
                                    <td class="text-center">{{item.created_at}}</td>
                                    <td class="text-center">Phạm Qúy</td>
                                    <td class="text-center">giao dịch trực tiếp</td>
                                    <td class="text-center">{{formatPrice(item.sum)}} ₫</td>
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
                listphieuthu:[],
                sumMoney:0,
                dateStar:'',
                dateEnd:'',
                doanhso:0,
                sumvon:''
            }
        },
        created(){
            this.getphieuthu()
        },
        methods:{
            // summoney(item){
            //     var sum = 0 ;
            //     for(var i = 0 ; i < item.length ;i++)
            //     {
            //         sum += item[i]['finance']
            //     }
            //     return sum;
            // },
            // sum(item){
            //     var sum = 0 ;
            //     for(var i = 0 ; i < item.length ;i++)
            //     {
            //         sum += item[i]['soluong']
            //     }
            //     return sum;
            // },
              dateSearch(){
                 axios.get('searchdatephieuthu/'+this.dateStar + '/' + this.dateEnd)
                 .then(response=>{
                    this.listphieuthu = response.data.listphieuthu
                    // this.doanhso = response.data.doanhsothudc
                    // this.sumvon = response.data.sum
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
            formatPrice(value) {
                let val = (value/1).toFixed(0).replace('.', ',')
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
            },
            getphieuthu(){
                axios.get('/listphieuthu').then(response=>{
                    this.listphieuthu = response.data.listphieuthu
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