@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card my-5">
            <div class="card-header">
                <h2>Student Create</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('students.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" id="name" 
                            value="{{ old('name') }}" placeholder="Name"
                            class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="major" class="form-label">Major</label>
                        <select name="major_id" id="major" class="form-select 
                            @error('major_id') is-invalid @enderror">
                            <option value="" selected disabled>Choose Major</option>
                            @foreach ($majors as $major)
                                <option value="{{ $major->id }}" 
                                    {{ old('major_id') == $major->id ? 'selected' : '' }}>
                                    {{ $major->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('major_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                            placeholder="09********" class="form-control @error('phone') is-invalid @enderror">
                        @error('phone')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}"
                            placeholder="name@example.com" 
                            class="form-control @error('email') is-invalid @enderror">
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea name="address" id="address" rows="5" cols="8"
                            class="form-control 
                            @error('address') is-invalid @enderror">{{ old('address') }}</textarea>
                        @error('address')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <a href="{{ route('students.index') }}" class="btn btn-secondary">Back</a>
                        <button type="submit" class="btn btn-primary">Create</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
