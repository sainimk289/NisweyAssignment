@extends('layouts.app')
@section('content')
<div class="container" style="max-width: 60%; margin: 2rem auto;">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <h2 class="mb-4">Contact List</h2>
                </div>
                <div class="col-md-4 text-right">
                    <a class="btn btn-primary" href="{{ url('contact/import') }}"><i
                            class="fas fa-arrow-circle-down"></i> Import</a>
                </div>
            </div>
            @include('partials.messages')
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($contacts as $contact)
                    <tr>
                        <td scope="row">{{ $contact->id }}</td>
                        <td>{{ $contact->name }}</td>
                        <td>{{ $contact->phone }}</td>
                        <td>
                            <a class="btn btn-primary" href="{{ route('contact.edit', $contact->id) }}"><i
                                    class="fas fa-pen"></i></a>
                            <form action="{{ route('contact.destroy', $contact->id) }}" method="POST"
                                  class="d-inline delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm delete-btn"><i
                                        class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center">No Data Available</td>
                    </tr>
                    @endforelse

                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {!! $contacts->links('pagination::bootstrap-4') !!}
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteForms = document.querySelectorAll('.delete-form');
        deleteForms.forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault(); // prevent the form from submitting immediately
                Swal.fire({
                    title: 'Are you sure?',
                    text: "This contact will be permanently deleted!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit(); // submit the form if confirmed
                    }
                });
            });
        });
    });
</script>
@endsection
