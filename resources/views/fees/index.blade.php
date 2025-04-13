@extends('layouts.dashboard')

@section('content')
    <div class="w-full flex justify-between items-center mb-3 mt-1 pl-3">
        <div>
            <h3 class="text-lg font-semibold text-slate-800 dark:text-slate-200">Fee Management</h3>
            <p class="text-slate-500 dark:text-slate-400">Manage all fee records in the system.</p>
        </div>
        <a href="{{ route('fees.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Add New Fee</a>
    </div>

    <div class="relative overflow-x-auto bg-white dark:bg-slate-800 shadow-md rounded-lg p-6">
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">#</th>
                    <th scope="col" class="px-6 py-3">Student</th>
                    <th scope="col" class="px-6 py-3">Fee Type</th>
                    <th scope="col" class="px-6 py-3">Amount</th>
                    <th scope="col" class="px-6 py-3">Status</th>
                    <th scope="col" class="px-6 py-3">Due Date</th>
                    <th scope="col" class="px-6 py-3">Payment Date</th>
                    <th scope="col" class="px-6 py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($fees as $fee)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-slate-50 dark:hover:bg-gray-600">
                        <td class="px-6 py-4">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4">{{ $fee->student->name ?? 'N/A' }}</td>
                        <td class="px-6 py-4">{{ $fee->fee_type }}</td>
                        <td class="px-6 py-4">{{ number_format($fee->amount, 2) }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 text-sm rounded-full {{ $fee->payment_status === 'paid' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ ucfirst($fee->payment_status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">{{ $fee->due_date ? $fee->due_date->format('d M Y') : 'N/A' }}</td>
                        <td class="px-6 py-4">{{ $fee->payment_date ? $fee->payment_date->format('d M Y') : 'N/A' }}</td>
                        <td class="px-6 py-4 flex space-x-2">
                            <a href="{{ route('fees.show', $fee->id) }}" class="px-2 py-1 bg-blue-600 text-white rounded hover:bg-blue-700">View</a>
                            <a href="{{ route('fees.edit', $fee->id) }}" class="px-2 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">Edit</a>
                            <form action="{{ route('fees.destroy', $fee->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this fee?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-2 py-1 bg-red-600 text-white rounded hover:bg-red-700">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-6 py-4 text-center">No fees found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $fees->links() }}
        </div>
    </div>
@endsection