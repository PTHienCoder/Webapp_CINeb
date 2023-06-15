
<div style="width: 600px; margin: 0 auto;">
	
	<div style="text-align: center;">
		<h2>Xin Chào {{$data['name']}}</h2>
        <p>Bạn đã đăng ký tài khoản tại CINeb</p>
        <p>Để có thể kích hoạt tài khoản của bạn vui lòng ấn vào nút kích hoạt bên dưới để xác nhận tài khoản</p>
       <a href="{{url('/VerifyEmail/'.$data['id'])}}"> 
       	<button class="button-arounder"> Xác Nhận </button>
         </a>


	</div>
</div>
