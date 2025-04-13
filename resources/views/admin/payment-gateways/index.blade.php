@extends('layouts.dashboard')

@section('content')
<a href="{{ route('admin.payment-gateways.create') }}" class="px-3 py-1 min-w-9 min-h-5 text-sm font-normal text-white bg-slate-800 dark:bg-slate-600 border border-slate-800 dark:border-slate-600 rounded hover:bg-slate-600 dark:hover:bg-slate-500 hover:border-slate-600 dark:hover:border-slate-500 transition duration-200 ease mb-4 inline-block">
        Add Payment Gateway
    </a> <hr>
    <div class="w-full flex justify-between items-center mb-3 mt-1 pl-3">
        <div>
            <h3 class="text-lg font-semibold text-slate-800 dark:text-slate-200">Payment Gateways</h3>
            <p class="text-slate-500 dark:text-slate-400">Overview of the current payment gateways.</p>
        </div>
    </div>

   

    <div class="relative flex flex-col w-full h-full overflow-scroll text-gray-700 dark:text-gray-200 bg-white dark:bg-slate-800 shadow-md rounded-lg bg-clip-border">
        <table class="w-full text-left table-auto min-w-max">
            <thead>
                <tr>
                    <th class="p-4 border-b border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900">
                        <p class="text-sm font-normal leading-none text-slate-500 dark:text-slate-400">Name</p>
                    </th>
                    <th class="p-4 border-b border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900">
                        <p class="text-sm font-normal leading-none text-slate-500 dark:text-slate-400">Active</p>
                    </th>
                    <th class="p-4 border-b border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-right">
                        <p class="text-sm font-normal leading-none text-slate-500 dark:text-slate-400">Actions</p>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($paymentGateways as $paymentGateway)
                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-700 border-b border-slate-200 dark:border-slate-700">
                        <td class="p-4 py-3">
                            <p class="block font-semibold text-sm text-slate-800 dark:text-slate-200">{{ $paymentGateway->name }}</p>
                        </td>
                        <td class="p-4 py-3">
                            <p class="text-sm text-slate-500 dark:text-slate-400">
                                @if ($paymentGateway->is_active)
                                    <span class="px-2 py-1 bg-green-200 dark:bg-green-700 dark:text-green-200 rounded">Active</span>
                                @else
                                    <span class="px-2 py-1 bg-red-200 dark:bg-red-700 dark:text-red-200 rounded">Inactive</span>
                                @endif
                            </p>
                        </td>
                        <td class="p-4 py-3 text-right">
                            <a href="{{ route('admin.payment-gateways.edit', $paymentGateway) }}"
                                class="rounded-md bg-green-600 dark:bg-green-700 py-1 px-2 border border-transparent text-center text-sm text-white dark:text-slate-200 transition-all shadow-md hover:shadow-lg focus:bg-green-700 dark:focus:bg-green-800 focus:shadow-none active:bg-green-700 dark:active:bg-green-800 hover:bg-green-700 dark:hover:bg-green-800 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none ml-2">
                                Edit
                            </a>
                            <form action="{{ route('admin.payment-gateways.destroy', $paymentGateway) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="rounded-md bg-red-600 dark:bg-red-700 py-1 px-2 border btn btn-sm border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-red-700 dark:focus:bg-red-800 focus:shadow-none active:bg-red-700 dark:active:bg-red-800 hover:bg-red-700 dark:hover:bg-red-800 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none ml-2"
                                    onclick="return confirm('Are you sure you want to delete this payment gateway?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection