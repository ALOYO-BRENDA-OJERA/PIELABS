// resources/views/admin/teams/index.blade.php
@extends('layouts.admin')

@section('content')
    <div class="max-w-7xl mx-auto">
        <h1 class="text-2xl font-bold mb-6">Team Management</h1>
        <a href="{{ route('teams.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Add New Member</a>
        <table class="w-full bg-white shadow rounded">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-3">Name</th>
                    <th class="p-3">Designation</th>
                    <th class="p-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($teams as $team)
                    <tr>
                        <td class="p-3">{{ $team->name }}</td>
                        <td class="p-3">{{ $team->designation }}</td>
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
