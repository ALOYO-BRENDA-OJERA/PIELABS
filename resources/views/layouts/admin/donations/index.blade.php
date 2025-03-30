// resources/views/admin/donations/index.blade.php
@extends('layouts.admin')

@section('content')
    <div class="max-w-7xl mx-auto">
        <h1 class="text-2xl font-bold mb-6">Donations Management</h1>
        <table class="w-full bg-white shadow rounded">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-3">Donor</th>
                    <th class="p-3">Amount</th>
                    <th class="p-3">Date</th>
                    <th class="p-3">Payment Method</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($donations as $donation)
                    <tr>
                        <td class="p-3">{{ $donation->donor_name }}</td>
                        <td class="p-3">${{ $donation->amount }}</td>
                        <td class="p-3">{{ $donation->donated_at->format('Y-m-d') }}</td>
                        <td class="p-3">{{ $donation->payment_method }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="#" class="bg-green-500 text-white px-4 py-2 rounded mt-4 inline-block">Export Report</a>
    </div>
@endsection
