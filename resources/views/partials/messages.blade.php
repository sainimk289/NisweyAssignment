{{-- Success Message --}}
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('warning'))
    <div class="alert alert-warning">
        {{ session('warning') }}
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if (session('info'))
    <div class="alert alert-info">
        {{ session('info') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        Please fill all required fields.
    </div>
@endif
