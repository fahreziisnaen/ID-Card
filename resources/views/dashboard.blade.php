<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Welcome Message -->
                    <div class="text-center mb-8">
                        <h1 class="text-3xl font-bold text-gray-900 mb-2">Selamat Datang, {{ Auth::user()->name }}!</h1>
                        <p class="text-gray-600">di Sistem ID-Card QR Generator</p>
                    </div>

                    <!-- Quick Action Button -->
                    <div class="flex justify-center mt-6">
                        <a href="{{ route('employees.index') }}" 
                           class="inline-flex items-center px-6 py-3 bg-blue-600 border border-transparent rounded-md font-semibold text-white hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            Data Karyawan
                        </a>
                    </div>

                    <!-- Optional: Quick Stats or Info Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
                        <div class="bg-blue-50 rounded-lg p-6 border border-blue-100">
                            <h3 class="text-lg font-semibold text-blue-800 mb-2">Panduan Penggunaan</h3>
                            <p class="text-blue-600">
                                Klik tombol "Data Karyawan" untuk mengelola data dan generate QR Code ID Card karyawan.
                            </p>
                        </div>
                        <div class="bg-green-50 rounded-lg p-6 border border-green-100">
                            <h3 class="text-lg font-semibold text-green-800 mb-2">Fitur Utama</h3>
                            <ul class="list-disc list-inside text-green-600">
                                <li>Manajemen Data Karyawan</li>
                                <li>Generate QR Code ID Card</li>
                                <li>QR Code to vCard</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Activity Logs -->
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6 mb-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Log Aktivitas Terbaru</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aktivitas</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($activities as $activity)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $activity->formatted_created_at }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $activity->user->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $activity->description }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
