<!-- Core JS files -->
	<script type="text/javascript" src="{{ asset('assets/js/plugins/loaders/pace.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/core/libraries/jquery.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/core/libraries/bootstrap.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/plugins/loaders/blockui.min.js') }}"></script>
	{{--  for alert box   --}}
	<script type="text/javascript" src="{{ asset('assets/js/plugins/sweetalert/sweetalert.js') }}"></script>
	<script type="text/javascript">
		function logout(){
			swal({
	  				title: "Are you sure want to Logout..?",
					icon: "warning",
					//text:"Are you sure want to Logout..?",
					buttons: true,
					buttons: ["Cancel", "Confirm Logout"],
					dangerMode: true,
					closeOnClickOutside: false,
					closeOnEsc: false,
					timer: 10000,
				})
			.then((willDelete) => {
  			if (willDelete) {
    				document.getElementById('logout-form').submit();
  			}
			});
		}
	</script>

	@yield('head_script')
<!-- /core JS files -->