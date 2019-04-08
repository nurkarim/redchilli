<script src="{{ asset('public/assets/js/jquery.min.js') }}"></script>

<script src="{{ asset('public/assets/js/popper.min.js') }}"></script>
<script src="{{ asset('public/assets/js/bootstrap.min.js') }}"></script>


<script src="{{ asset('public/assets/js/fastclick.js') }}"></script>

<!-- App js -->


	<script src="{{ asset('public/assets/datatable/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('public/assets/datatable/js/dataTables.bootstrap4.min.js') }}"></script>
	<script src="{{ asset('public/assets/plugins/switchery/switchery.min.js') }}"></script>
<script src="{{ asset('public/assets/js/pikeadmin.js') }}"></script>

	<!-- Counter-Up-->
{{-- 	<script src="assets/plugins/waypoints/lib/jquery.waypoints.min.js"></script>
	<script src="assets/plugins/counterup/jquery.counterup.min.js"></script>	 --}}		

	<script>
		$(document).ready(function() {
			// data-tables
			$('#example1').DataTable();
					
			// counter-up
			// $('.counter').counterUp({
			// 	delay: 10,
			// 	time: 600
			// });
		} );		
	</script>
	
	@yield('js')
	