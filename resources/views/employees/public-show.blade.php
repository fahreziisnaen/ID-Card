<x-public-layout>
    <div class="min-h-screen py-8 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-gray-50 to-white">
        <div class="max-w-md mx-auto">
            <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100">
                <!-- Header with Gradient -->
                <div class="relative h-40 bg-gradient-to-r from-orange-500 to-orange-600">
                    <div class="absolute inset-0 bg-black/10"></div>
                    <div class="relative px-8 py-6 text-center">
                        <h1 class="text-xl font-semibold text-white">PT. Internet Pratama Indonesia</h1>
                        <img src="{{ asset('images/company-logo.png') }}" alt="Company Logo" class="h-5 mx-auto mt-4">
                    </div>
                </div>

                <!-- Profile Section -->
                <div class="relative px-8 pb-8">
                    <!-- Profile Image -->
                    <div class="flex justify-center -mt-16 mb-6">
                        @if($employee->foto && Storage::disk('public')->exists('employee-photos/' . $employee->foto))
                            <div class="relative">
                                <div class="absolute inset-0 bg-gradient-to-b from-orange-500 to-orange-600 rounded-full blur-lg opacity-20 scale-110"></div>
                                <img src="{{ asset('storage/employee-photos/' . $employee->foto) }}" 
                                    alt="Foto {{ $employee->nama }}" 
                                    class="relative w-32 h-32 object-cover rounded-full ring-4 ring-white shadow-xl">
                            </div>
                        @else
                            <div class="w-32 h-32 bg-gray-100 rounded-full ring-4 ring-white shadow-xl flex items-center justify-center">
                                <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                        @endif
                    </div>

                    <!-- Name and Position -->
                    <div class="text-center mb-8">
                        <h2 class="text-2xl font-bold text-gray-900">{{ $employee->nama }}</h2>
                        <p class="text-lg text-gray-600">{{ $employee->jabatan }}</p>
                        <p class="text-sm text-gray-500">{{ $employee->departemen }}</p>
                    </div>

                    <!-- Contact Info -->
                    <div class="space-y-4">
                        <div class="flex items-center justify-center space-x-2">
                            <span class="text-gray-500">{{ $employee->email }}</span>
                        </div>
                        <div class="flex items-center justify-center space-x-2">
                            <span class="text-gray-500">{{ $employee->no_telepon }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-public-layout> 