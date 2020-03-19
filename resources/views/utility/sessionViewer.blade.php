@if (session()->has('success'))
    <div class="d-flex justify-content-center alert alert-success">
        {{ session()->get('success')}}
    </div>
@endif
@if (session()->has('error'))
    <div class="d-flex justify-content-center alert alert-danger">
        {{ session()->get('error')}}
    </div>
@endif
