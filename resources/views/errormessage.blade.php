@if ($message = Session::get('success'))
<div class="alert alert-success fade show" role="alert">
<!--    <div class="alert-icon"><i class="flaticon-warning"></i></div>-->
    <div class="alert-text"> {!! $message !!}</div>
    <div class="alert-close">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true"><i class="la la-close"></i></span>
        </button>
    </div>
</div>
@endif

@if ($message = Session::get('error'))
<div class="alert alert-danger fade show" role="alert">
<!--    <div class="alert-icon"><i class="flaticon-questions-circular-button"></i></div>-->
    <div class="alert-text">{{ $message }}</div>
    <div class="alert-close">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true"><i class="la la-close"></i></span>
        </button>
    </div>
</div>
@endif


@if ($message = Session::get('warning'))
<div class="alert alert-warning fade show" role="alert">
<!--    <div class="alert-icon"><i class="flaticon-warning"></i></div>-->
    <div class="alert-text">{{ $message }}</div>
    <div class="alert-close">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true"><i class="la la-close"></i></span>
        </button>
    </div>
</div>
@endif


@if ($message = Session::get('info'))
<div class="alert alert-info alert-block">
    <button type="button" class="close" data-dismiss="alert">x</button>	
    <strong>{{ $message }}</strong>
</div>
@endif


@if ($errors->any())

<div class="alert alert-danger fade show" role="alert">
<!--    <div class="alert-icon"><i class="flaticon-questions-circular-button"></i></div>$error-->
    <div class="alert-text">
     @foreach ($errors->all() as $error)<li>{{ $error }}  </li>@endforeach</div>
    <div class="alert-close">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true"><i class="la la-close"></i></span>
        </button>
    </div>
</div>
@endif