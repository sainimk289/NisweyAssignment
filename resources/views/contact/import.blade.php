@extends('layouts.app')
@section('content')
<div class="container" style="max-width: 60%; margin: 2rem auto;">
    <div class="card">
        <div class="card-body">
            @include('partials.messages')
            <h2 class="mb-4">Import Contacts</h2>
            <form action="{{ route('contacts.import.xml') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="xml_file">Select XML File:</label>
                    <input type="file" class="form-control" name="xml_file" id="xml_file" accept=".xml" required>
                    <div class="invalid-feedback">
                        Please select an XML file to import.
                    </div>
                    @error('xml_file')
                    <div class="text-danger mt-1">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary mt-3">Submit</button>
            </form>

        </div>
    </div>
</div>
<script>
    // Bootstrap 5 client-side validation
    (() => {
        'use strict';
        const forms = document.querySelectorAll('.needs-validation');
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    })();
</script>
@endsection
