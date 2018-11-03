<template>
    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-2 sidebar-admin">
        <ul class="list-group">
        <li class="list-group-item">
              <router-link to='/pages'>
                <i class="fa fa-tachometer"></i><span>Tổng quan</span>
             </router-link>
        </li>
        <li class="list-group-item">
             <router-link to='/orders'>   
                <i class="fa fa-shopping-cart"></i><span>Đơn hàng </span>
            </router-link>
        </li>
        <li class="list-group-item">
            <router-link to='/listproducts'>
                <i class="fa fa-barcode"></i><span>Sản phẩm</span>
            </router-link>
        </li>
          <li class="list-group-item">
            <router-link to='/custommer'>
                <i class="fa fa-users"></i><span>Khách hàng</span>
            </router-link>
          </li>
          <li class="list-group-item">
            <router-link to='/nhapkho'>
                <i class="fa fa-truck"></i><span>Nhập kho</span>
            </router-link>
         </li>
         <li class="list-group-item">
            <router-link to='/xuatkho'>
                <i class="fa fa-truck"></i><span>Xuất kho</span>
            </router-link>
         </li>
          <li class="list-group-item">
            <router-link to='/tonkho'>
               <i class="fa fa-list-alt"></i><span>Tồn kho</span>
            </router-link>
         </li>
          <li class="list-group-item">
              <router-link to='/doanhso'>
                <i class="fa fa-signal"> </i>
                <span>Doanh số</span>
             </router-link>
         </li>
          <li class="list-group-item">
               <router-link to='/phieuthu'>
                    <i class="fa fa-file-text"></i><span>Phiếu thu</span>
                </router-link>
          </li>
           <li class="list-group-item">
               <router-link to='/phieuchi'>
                    <i class="fa fa-file-text"></i><span>Phiếu chi</span>
                </router-link>
          </li>
          <li class="list-group-item">
              <router-link to='/profit'>         
                <i class="fa fa-usd"> </i><span>Lợi nhuận</span>
              </router-link>
          </li>
          <li class="list-group-item">
              <router-link to='/ListUser'>         
                <i class="fa fa-usd"> </i><span>Thành viên</span>
              </router-link>
          </li>
          <li class="list-group-item"><i class="fa fa-cogs "></i><span>Thiết lập</span></li>
        </ul>
    </div>
</template>