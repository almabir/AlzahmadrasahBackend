@extends('layouts.dashboard')

@section('content')
    <div class="w-full flex justify-between items-center mb-3 mt-1 pl-3">
        <div>
            <h3 class="text-lg font-semibold text-slate-800 dark:text-slate-200">Fee Details</h3>
            <p class="text-slate-500 dark:text-slate-400">View the details of the fee.</p>
        </div>
        <a href="{{ route('fees.index') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Back to List</a>
    </div>

    <div class="relative flex flex-col w-full h-full overflow-scroll text-gray-700 dark:text-gray-200 bg-white dark:bg-slate-800 shadow-md rounded-lg bg-clip-border p-6">
        <!-- Fee Details -->
        <div class="mb-6">
            <h4 class="text-md font-semibold text-slate-700 dark:text-slate-300 mb-2">Fee Information</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <p class="text-sm text-slate-600 dark:text-slate-400">Student:</p>
                    <p class="text-sm text-slate-800 dark:text-slate-200 font-medium">{{ $fee->student->name ?? 'N/A' }}</p>
                </div>
                <div>
                    <p class="text-sm text-slate-600 dark:text-slate-400">Fee Type:</p>
                    <p class="text-sm text-slate-800 dark:text-slate-200 font-medium">{{ $fee->fee_type }}</p>
                </div>
                <div>
                    <p class="text-sm text-slate-600 dark:text-slate-400">Amount:</p>
                    <p class="text-sm text-slate-800 dark:text-slate-200 font-medium">{{ number_format($fee->amount, 2) }}</p>
                </div>
                <div>
                    <p class="text-sm text-slate-600 dark:text-slate-400">Payment Status:</p>
                    <p class="text-sm text-slate-800 dark:text-slate-200 font-medium">
                        <span class="px-2 py-1 text-sm rounded-full {{ $fee->payment_status === 'paid' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ ucfirst($fee->payment_status) }}
                        </span>
                    </p>
                </div>
                <div>
                    <p class="text-sm text-slate-600 dark:text-slate-400">Due Date:</p>
                    <p class="text-sm text-slate-800 dark:text-slate-200 font-medium">{{ $fee->due_date ? $fee->due_date->format('d M Y') : 'N/A' }}</p>
                </div>
                <div>
                    <p class="text-sm text-slate-600 dark:text-slate-400">Payment Date:</p>
                    <p class="text-sm text-slate-800 dark:text-slate-200 font-medium">{{ $fee->payment_date ? $fee->payment_date->format('d M Y') : 'N/A' }}</p>
                </div>
                <div>
                    <p class="text-sm text-slate-600 dark:text-slate-400">Payment Method:</p>
                    <p class="text-sm text-slate-800 dark:text-slate-200 font-medium">{{ $fee->payment_method ?? 'N/A' }}</p>
                </div>
                <div>
                    <p class="text-sm text-slate-600 dark:text-slate-400">Transaction ID:</p>
                    <p class="text-sm text-slate-800 dark:text-slate-200 font-medium">{{ $fee->transaction_id ?? 'N/A' }}</p>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="flex items-center justify-end space-x-2">
            <a href="{{ route('fees.edit', $fee->id) }}" class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">Edit</a>
            <form action="{{ route('fees.destroy', $fee->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this fee?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Delete</button>
            </form>
        </div>
    </div>
@endsection