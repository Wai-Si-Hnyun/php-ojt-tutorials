@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card mt-5">
            <div class="card-header">
                <h2>Major Edit</h2>
            </div>
            <div class="card-body">
                <form id="majorUpdateForm">
                    <input type="hidden" name="id" id="major_id" value="{{ $major->id }}">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" id="name" value="{{ $major->name }}"
                            class="form-control">
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

@push('scripts')
    <script src="{{ asset('js/axios.js') }}"></script>
    <script>
        document.getElementById('majorUpdateForm').addEventListener('submit', (e) => {
            e.preventDefault();

            const id = document.getElementById('major_id').value;
            const name = document.getElementById('name').value;
            const route = `/majors/${id}/update`;

            uploadMajorData(name, route);
        })
    </script>
@endpush
