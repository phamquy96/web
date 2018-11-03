<template>
	<div>
        <div class="container-fluid">
            <Nav></Nav>
        </div>
        <div class="container-fluid">
            <NavBar></NavBar>
            <div class="col-xs-5 col-sm-5 col-md-5 col-lg-10 content">
                    <div class="col-xs-15 col-sm-15 col-md-15 col-lg-15 ">
                        <h3 style="float: left;">Hoạt động hôm nay</h3>
                    </div>
                    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-15 thongketonkho">
                        <div class="col-xs-15 col-sm-15 col-md-15 col-lg-15 report">
                            <div class="report-green">
                                <div class="content-rep">
                                    <p> <i class="fa fa-signal"></i>Tiền bán hàng {{formatPrice(sumMoney)}} ₫</p>
                                </div>
                            </div>
                            <div class="report-green">
                                <div class="content-rep">
                                    <p> <i class="fa fa-shopping-cart"></i>Đơn hàng {{formatPrice(count)}} </p>
                                </div>
                            </div>
                            <div class="report-green">
                                <div class="content-rep">
                                    <p> <i class="fa fa-undo"></i>Số đơn trả {{cancel}} </p>
                                </div>
                            </div>
                            <div class="report-green">
                                <div class="content-rep">
                                    <p> <i class="fa fa-cloud"></i>Lợi nhuận {{formatPrice(profittoday)}} ₫</p>
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
                sumMoney:0,
                dateStar:'',
                dateEnd:'',
                doanhso:0,
                sumvon:'',
                count:'',
                profittoday:'',
                cancel :''
            }
        },
        created(){
            this.getPagesAdmin()
        },
        methods:{
              dateSearch(){
                 axios.get('admin/profit/searchdate/'+this.dateStar + '/' + this.dateEnd)
                 .then(response=>{
                    this.listprofit = response.data.listProfitSearch
                    this.doanhso = response.data.doanhsothudc
                    this.sumvon = response.data.sum
                 })
                 .catch(errors=>{
                    console.log('Errors')
                 })
             },   
             
            getPagesAdmin(){
                axios.get('/admin/pages').then(response=>{
                    console.log(response.data.profit)
                    this.cancel = response.data.cancel
                    this.sumMoney = response.data.sum
                    this.count = response.data.count 
                    this.profittoday = response.data.profittoday
                })
            },
            formatPrice(value) {
                let val = (value/1).toFixed(0).replace('.', ',')
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
            },
           
        }
	}
</script>
<style type="text/css" scoped>
    img{
        width: 40px;
    }
</style>