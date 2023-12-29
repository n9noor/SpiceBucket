
<h1>{{ $Message }}</h1>

<form action="/razorpay/success" method="POST">
 <script src="https://checkout.razorpay.com/v1/checkout.js" 
 data-key="rzp_live_LQek1HirtX5tlM" data-amount="39900"   
		data-currency="INR" 
        data-order_id="{{ $razorpayOrder }}" 
        data-buttontext="Pay with Razorpay"
        data-name="spicebucket"
        data-description="Add amount in wallet"
        data-image="your_logo_url"
        data-prefill.name="Madhav Kumar"
        data-prefill.email="praveenpnf@gmail.com"
        data-prefill.contact="8810686936"  
        data-theme.color="#F37254">
	</script>

	 <input type="hidden" name="_token" value="{{ csrf_token() }}">
	</form>



