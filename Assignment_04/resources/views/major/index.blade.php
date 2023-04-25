@php
    use Illuminate\Support\Str;    
@endphp

@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ route('majors.create') }}" class="btn btn-primary mt-5 mb-3">Create</a>
        <div class="card rounded mb-5">
            <div class="card-header">
                <h2>Major Lists</h2>
            </div>
            <div class="card-body">
                @if (count($majors) > 0)
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($majors as $major)
                                <tr data-id="{{ $major->id }}">
                                    <th>{{ $major->id }}</th>
                                    <td>{{ Str::limit($major->name, 25, '...') }}</td>
                                    <td class="d-flex">
                                        <a href="{{ route('majors.edit', $major->id) }}"
                                            class="btn btn-sm btn-success">Edit</a>
                                        <button class="ms-2 btn btn-sm btn-danger" 
                                            onclick="deleteData(event, {{ $major->id }}, 'major')">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $majors->links() }}
                @else
                    <p class="text-danger">There is no data of majors</p>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/axios.js') }}"></script>
@endpush
