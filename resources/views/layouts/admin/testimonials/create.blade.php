// resources/views/admin/testimonials/create.blade.php
@extends('layouts.admin')

@section('content')
    <div class="max-w-7xl mx-auto">
        <h1 class="text-2xl font-bold mb-6">Add New Testimonial</h1>
        <form method="POST" action="{{ route('testimonials.store') }}">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700">Name</label>
                <input type="text" name="name" class="w-full p-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Content</label>
                <textarea name="content" class="w-full p-2 border rounded" required></textarea>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Role</label>
                <input type="text" name="role" class="w-full p-2 border rounded" required>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
        </form>
    </div>
@endsection
