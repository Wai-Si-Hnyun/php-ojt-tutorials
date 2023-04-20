@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card mt-5">
            <div class="card-header">
                <h2>Major Edit</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('majors.update', $major->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" id="name" value="{{ $major->name }}"
                            class="form-control @error('name')
                                is-invalid
                            @enderror">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <a href="{{ route('majors.index') }}" class="btn btn-secondary">Back</a>
                        <button type="submit" class="btn btn-primary">Update</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
