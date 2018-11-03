@if($status == 0)
<h2>Trang thia khoi tao</h2>
@elseif($status == 1)
<h2>Trang thia Xác nhận</h2>
@elseif($status == 2)
<h2>Trang thia Hoàn thành</h2>
@elseif($status == 3)
<h2>Trang thia Xác nhận </h2>
@elseif($status == 4)
<h2>Trang thia Đang giao</h2>
@elseif($status == 5)
<h2>Trang thia Đã giao</h2>
@endif