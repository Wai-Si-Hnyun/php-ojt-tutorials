@php
    use Illuminate\Support\Str;    
@endphp

@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ route('students.create') }}" class="btn btn-primary mt-5 mb-3">Create</a>
        <div class="card rounded mb-5">
            <div class="card-header">
                <h2>Student Lists</h2>
            </div>
            <div class="card-body">
                @if (count($students) > 0)
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Major</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
                                <tr>
                                    <th>{{ $student->id }}</th>
                                    <td>{{ Str::limit($student->name, 20, '...') }}</td>
                                    <td>{{ Str::limit($student->major->name, 20, '...') }}</td>
                                    <td>{{ $student->phone }}</td>
                                    <td>{{ Str::limit($student->email, 20, '...') }}</td>
                                    <td>{{ Str::limit($student->address, 20, '...') }}</td>
                                    <td class="d-flex">
                                        <a href="{{ route('students.edit', $student->id) }}"
                                            class="btn btn-sm btn-success">Edit</a>
                                        <form action="{{ route('students.destroy', $student->id) }}" 
                                            method="POST" onsubmit="return confirmDelete();">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="ms-2 btn btn-sm btn-danger">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $students->links() }}
                @else
                    <p class="text-danger">There is no data of students</p>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function confirmDelete() {
            return confirm('Are you sure to delete this item?');
        }
    </script>
@endpush
