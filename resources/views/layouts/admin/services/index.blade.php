// resources/views/admin/services/index.blade.php
@extends('layouts.admin')

@section('content')
    <div class="max-w-7xl mx-auto">
        <h1 class="text-2xl font-bold mb-6">Services Management</h1>
        <a href="{{ route('services.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Add New Service</a>
        <table class="w-full bg-white shadow rounded">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-3">Title</th>
                    <th class="p-3">Description</th>
                    <th class="p-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($services as $service)
                    <tr>
                        <td class="p-3">{{ $service->title }}</td>
                        <td class="p-3">{{ Str::limit($service->description, 50) }}</td>
                        <td class="p-3">
                            <a href="#" class="text-blue-500">Edit</a> |
                            <a href="#" class="text-red-500">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
