@if(Session::has('success'))
<div class="alert alert-success alert-with-icon shake fade out show" role="alert" style="transition: 0.5s;" data-notify="container" data-dismiss="alert" aria-label="close">
<button type="button" aria-hidden="true" class="close">
    <i class="fa fab-remove"></i>
</button>
<span data-notify="icon" class="fa fa-bell"></span>
<span data-notify="message">{{ Session::get('success') }}</span>
</div>
@endif

@if(Session::has('warning'))
<div class="alert alert-warning alert-with-icon shake fade out show" role="alert" style="transition: 0.5s;" data-notify="container" data-dismiss="alert" aria-label="close">
<button type="button" aria-hidden="true" class="close">
    <i class="fa fab-remove"></i>
</button>
<span data-notify="icon" class="fa fa-bell"></span>
<span data-notify="message">{{ Session::get('warning') }}</span>
</div>
@endif

@if(Session::has('error'))
<div class="alert alert-danger alert-with-icon shake fade out show" role="alert" style="transition: 0.5s;" data-notify="container" data-dismiss="alert" aria-label="close">
<button type="button" aria-hidden="true" class="close">
    <i class="fa fab-remove"></i>
</button>
<span data-notify="icon" class="fa fa-bell"></span>
<span data-notify="message">{{ Session::get('error') }}</span>
</div>
@endif

@if(Session::has('info'))
<div class="alert alert-info alert-with-icon shake fade out show" role="alert" style="transition: 0.5s;" data-notify="container" data-dismiss="alert" aria-label="close">
<button type="button" aria-hidden="true" class="close">
    <i class="fa fab-remove"></i>
</button>
<span data-notify="icon" class="fa fa-bell"></span>
<span data-notify="message">{{ Session::get('info') }}</span>
</div>
@endif


@if (session('status'))
<div class="alert alert-info alert-with-icon shake fade out show" role="alert" style="transition: 0.5s;" data-notify="container" data-dismiss="alert" aria-label="close">
<button type="button" aria-hidden="true" class="close">
    <i class="fa fab-remove"></i>
</button>
<span data-notify="icon" class="fa fa-bell"></span>
<span data-notify="message">{{ session('status') }}</span>
</div>
@endif
