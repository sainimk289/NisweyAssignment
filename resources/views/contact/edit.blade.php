@extends('layouts.app')
@section('content')
<div class="container" style="max-width: 60%; margin: 2rem auto;">
    <div class="card">
        <div class="card-body">
            @include('partials.messages')
            <h2 class="mb-4">Contact Edit</h2>
            <form action="{{ route('contact.update') }}" method="POST">
                @csrf
                @method('put')
                <input type="hidden" name="id" value="{{ $contact->id }}">
                <div class="form-group">
                    <label for="name">Select XML File:</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ $contact->name }}" name="name" id="name">
                    @error('name')
                    <div class="text-danger mt-1">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="phone">Select XML File:</label>
                    <input type="text" class="form-control @error('phone') is-invalid @enderror" value="{{ $contact->phone }}" name="phone" id="phone">
                    @error('phone')
                    <div class="text-danger mt-1">
                        {{ $message }}
                    </div>
                    @enderror
                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
            </form>

        </div>
    </div>
</div>
@endsection
