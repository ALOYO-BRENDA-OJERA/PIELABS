// resources/views/admin/services/create.blade.php
@extends('layouts.admin')

@section('content')
    <div class="max-w-7xl mx-auto">
        <h1 class="text-2xl font-bold mb-6">Add New Service</h1>
        <form method="POST" action="{{ route('services.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700">Title</label>
                <input type="text" name="title" class="w-full p-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Description</label>
                <textarea name="description" class="w-full p-2 border rounded" required></textarea>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Media</label>
                <input type="file" name="media" class="w-full p-2 border rounded">
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
        </form>
    </div>
@endsection
