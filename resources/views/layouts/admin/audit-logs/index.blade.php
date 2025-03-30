// resources/views/admin/audit-logs/index.blade.php
@extends('layouts.admin')

@section('content')
    <div class="max-w-7xl mx-auto">
        <h1 class="text-2xl font-bold mb-6">Audit Logs</h1>
        <table class="w-full bg-white shadow rounded">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-3">User</th>
                    <th class="p-3">Action</th>
                    <th class="p-3">Description</th>
                    <th class="p-3">IP Address</th>
                    <th class="p-3">Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($auditLogs as $log)
                    <tr>
                        <td class="p-3">{{ $log->user->name ?? 'N/A' }}</td>
                        <td class="p-3">{{ $log->action }}</td>
                        <td class="p-3">{{ $log->description }}</td>
                        <td class="p-3">{{ $log->ip_address }}</td>
                        <td class="p-3">{{ $log->created_at->format('Y-m-d H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
