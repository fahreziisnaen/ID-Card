<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Karyawan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            @if($employee->foto && Storage::disk('public')->exists('employee-photos/' . $employee->foto))
                                <img src="{{ asset('storage/employee-photos/' . $employee->foto) }}" alt="Foto {{ $employee->nama }}" class="w-48 h-48 object-cover rounded-full mx-auto mb-4">
                            @else
                                <div class="w-48 h-48 bg-gray-200 rounded-full mx-auto mb-4 flex items-center justify-center">
                                    <span class="text-gray-500 text-lg">No Photo</span>
                                </div>
                            @endif
                        </div>

                        <div class="space-y-4">
                            <div>
                                <h3 class="text-gray-600 text-sm">NIP</h3>
                                <p class="text-gray-900">{{ $employee->nip }}</p>
                            </div>

                            <div>
                                <h3 class="text-gray-600 text-sm">Nama Lengkap</h3>
                                <p class="text-gray-900">{{ $employee->nama }}</p>
                            </div>

                            <div>
                                <h3 class="text-gray-600 text-sm">Nama Depan</h3>
                                <p class="text-gray-900">{{ $employee->nama_depan }}</p>
                            </div>

                            <div>
                                <h3 class="text-gray-600 text-sm">Nama Belakang</h3>
                                <p class="text-gray-900">{{ $employee->nama_belakang ?: '-' }}</p>
                            </div>

                            <div>
                                <h3 class="text-gray-600 text-sm">Jabatan</h3>
                                <p class="text-gray-900">{{ $employee->jabatan }}</p>
                            </div>

                            <div>
                                <h3 class="text-gray-600 text-sm">Departemen</h3>
                                <p class="text-gray-900">{{ $employee->departemen }}</p>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <h3 class="text-gray-600 text-sm">No. Telepon</h3>
                                <p class="text-gray-900">{{ $employee->no_telepon }}</p>
                            </div>

                            <div>
                                <h3 class="text-gray-600 text-sm">Email</h3>
                                <p class="text-gray-900">{{ $employee->email }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-between mt-6">
                        <a href="{{ route('employees.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Kembali</a>
                        <div>
                            <a href="{{ route('employees.edit', $employee) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mr-2">Edit</a>
                            <form action="{{ route('employees.destroy', $employee) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 