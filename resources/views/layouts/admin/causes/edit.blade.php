@extends('layouts.admin')

@section('content')
    <div class="max-w-7xl mx-auto">
        <h1 class="text-2xl font-bold mb-6">Edit Cause</h1>
        <form method="POST" action="{{ route('causes.update', $cause) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block text-gray-700">Title</label>
                <input type="text" name="title" value="{{ old('title', $cause->title) }}" class="w-full p-2 border rounded" required>
                @error('title') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Description</label>
                <textarea name="description" class="w-full p-2 border rounded" required>{{ old('description', $cause->description) }}</textarea>
                @error('description') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Image</label>
                @if ($cause->image)
                    <img src="{{ asset('storage/' . $cause->image) }}" alt="Current Image" class="w-32 mb-2">
                @endif
                <input type="file" name="image" class="w-full p-2 border rounded">
                @error('image') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Donation Link</label>
                <input type="url" name="donation_link" value="{{ old('donation_link', $cause->donation_link) }}" class="w-full p-2 border rounded">
                @error('donation_link') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Publish Date</label>
                <input type="datetime-local" name="published_at" value="{{ old('published_at', $cause->published_at ? $cause->published_at->format('Y-m-d\TH:i') : '') }}" class="w-full p-2 border rounded">
                @error('published_at') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
        </form>
    </div>
@endsection
