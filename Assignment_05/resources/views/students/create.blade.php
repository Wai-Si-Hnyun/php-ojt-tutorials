@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card my-5">
            <div class="card-header">
                <h2>Student Create</h2>
            </div>
            <div class="card-body">
                <form id="studentCreateForm">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" id="name" 
                            value="{{ old('name') }}" placeholder="Name"
                            class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="major_id" class="form-label">Major</label>
                        <select name="major_id" id="major_id" class="form-select">
                            <option value="" selected disabled>Choose Major</option>
                            @foreach ($majors as $major)
                                <option value="{{ $major->id }}" 
                                    {{ old('major_id') == $major->id ? 'selected' : '' }}>
                                    {{ $major->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                            placeholder="09********" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}"
                            placeholder="name@example.com" 
                            class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea name="address" id="address" rows="5" cols="8"
                            class="form-control">{{ old('address') }}</textarea>
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

@push('scripts')
    <script src="{{ asset('js/axios.js') }}"></script>
    <script>
        document.getElementById('studentCreateForm').addEventListener('submit', (e) => {
            e.preventDefault();

            const name = document.getElementById('name').value;
            const major_id = document.getElementById('major_id').value;
            const phone = document.getElementById('phone').value;
            const email = document.getElementById('email').value;
            const address = document.getElementById('address').value;

            const data = {
                'name': name,
                'major_id': major_id,
                'phone': phone,
                'email': email,
                'address': address,
                'route': '/students/store'
            };

            uploadStudentData(data);
        })
    </script>
@endpush
