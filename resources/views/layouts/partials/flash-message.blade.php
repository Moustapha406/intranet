@if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible show fade">
        <button type="button" class="close" data-dismiss="alert">
            <span>&times;</span>
        </button>
        <strong>{{ $message }}</strong>
    </div>
@endif
@if ($message = Session::get('error'))
    <div class="alert alert-danger alert-dismissible show fade">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
@endif
@if ($message = Session::get('warning'))
    <div class="alert alert-warning alert-dismissible show fade">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
@endif
@if ($message = Session::get('info'))
    <div class="alert alert-info alert-dismissible show fade">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
@endif
@if ($errors->any())
    <div class="alert alert-danger alert-dismissible show fade">
        <button type="button" class="close" data-dismiss="alert">×</button>
        Check the following errors :(
    </div>
@endif