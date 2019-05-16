<!-- loader -->
<div id="loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#f4b214"/></svg></div>

<script src="{{URL::asset('js/jquery-3.2.1.min.js')}}"></script>
<script src="{{URL::asset('js/jquery-migrate-3.0.0.js')}}"></script>
<script src="{{URL::asset('js/messenger.min.js')}}"></script>
<script src="{{URL::asset('js/popper.min.js')}}"></script>
<script src="{{URL::asset('js/bootstrap.min.js')}}"></script>
<script src="{{URL::asset('js/owl.carousel.min.js')}}"></script>
<script src="{{URL::asset('js/jquery.waypoints.min.js')}}"></script>
<script src="{{URL::asset('js/jquery.stellar.min.js')}}"></script>

<script src="{{URL::asset('js/messenger-theme-future.js')}}"></script>

<script src="{{URL::asset('js/main.js')}}"></script>

@if(UINotification::get('success'))
    <?php Alert::success(UINotification::get('success')); UINotification::clean('success');
    ?>
    @endif
@if(UINotification::get('warning'))
    <?php Alert::warning(UINotification::get('warning'));UINotification::clean('warning');?>
@endif
@if(UINotification::get('error'))
    <?php Alert::error(UINotification::get('error'));UINotification::clean('error');?>
@endif

