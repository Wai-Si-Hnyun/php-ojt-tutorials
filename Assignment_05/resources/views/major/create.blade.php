@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card mt-5">
            <div class="card-header">
                <h2>Major Create</h2>
            </div>
            <div class="card-body">
                <form id="majorCreateForm">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" id="name"class="form-control">
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <a href="{{ route('majors.index') }}" class="btn btn-secondary">Back</a>
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
        document.getElementById('majorCreateForm').addEventListener('submit', (e) => {
            e.preventDefault();

            const name = document.getElementById('name').value;
            const route = '/majors/store';

            uploadMajorData(name, route);
        })
    </script>
@endpush
