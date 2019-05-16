<!-- Bootstrap core JavaScript-->
<script src="{{URL::asset('js/jquery-3.2.1.min.js')}}"></script>
<script src="{{URL::asset('js/vendor/bootstrap/js/bootstrap.bundle.js')}}"></script>

<!-- Core plugin JavaScript-->
<script src="{{URL::asset('js/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

<!-- Custom scripts for all pages-->
<script src="{{URL::asset('js/sb-admin-2.js')}}"></script>

<!-- Page level plugins -->
<script src="{{URL::asset('js/vendor/chart.js/Chart.min.js')}}"></script>

<!-- Page level custom scripts -->
<script src="{{URL::asset('js/demo/chart-area-demo.js')}}"></script>
<script src="{{URL::asset('js/demo/chart-pie-demo.js')}}"></script>
<script src="{{URL::asset('js/messenger.min.js')}}"></script>
<script src="{{URL::asset('js/popper.min.js')}}"></script>

@if(\App\Tools\UINotification::get('success'))
    <?php  \App\Tools\Alert::success(\App\Tools\UINotification::get('success')); \App\Tools\UINotification::clean('success');
    ?>
@endif
@if(\App\Tools\UINotification::get('warning'))
    <?php \App\Tools\Alert::warning(\App\Tools\UINotification::get('warning'));\App\Tools\UINotification::clean('warning');?>
@endif
@if(\App\Tools\UINotification::get('error'))
    <?php \App\Tools\Alert::error(\App\Tools\UINotification::get('error'));\App\Tools\UINotification::clean('error');?>
@endif