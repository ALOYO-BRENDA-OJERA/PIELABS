// resources/views/admin/dashboard.blade.php
@extends('layouts.admin')

@section('content')
    <div class="max-w-7xl mx-auto">
        <h1 class="text-2xl font-bold mb-6">Dashboard Overview</h1>

        <!-- Graphical Reports (Placeholder) -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div class="bg-white p-4 shadow rounded">
                <h3 class="text-lg">Monthly Donations</h3>
                <p class="text-2xl">$5,000</p> <!-- Replace with dynamic data -->
            </div>
            <div class="bg-white p-4 shadow rounded">
                <h3 class="text-lg">Visitor Traffic</h3>
                <p class="text-2xl">1,200</p>
            </div>
            <div class="bg-white p-4 shadow rounded">
                <h3 class="text-lg">User Engagement</h3>
                <p class="text-2xl">85%</p>
            </div>
        </div>

        <!-- Recent Activities -->
        <div class="bg-white p-4 shadow rounded mb-6">
            <h3 class="text-lg font-semibold mb-4">Recent Activities</h3>
            <ul>
                @foreach ($activities as $activity)
                    <li class="py-2">{{ $activity->description }} - {{ $activity->created_at->diffForHumans() }}</li>
                @endforeach
            </ul>
        </div>

        <!-- Quick Actions -->
        <div class="flex space-x-4">
            <a href="{{ route('causes.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Add Cause</a>
            <a href="{{ route('donations.index') }}" class="bg-green-500 text-white px-4 py-2 rounded">View Donations</a>
        </div>
    </div>
@endsection
