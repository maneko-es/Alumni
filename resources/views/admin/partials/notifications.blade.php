@if (Session::has('success'))
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <i class="fa fa-btn fa-check-circle fa-lg"></i>
        {{ Session::get('success') }}
    </div>
@endif
