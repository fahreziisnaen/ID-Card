<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Karyawan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Tampilkan error jika ada -->
                    @if ($errors->any())
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                        <strong>Whoops!</strong> Ada beberapa masalah dengan input Anda.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Informasi Dasar -->
                        <div class="mb-8">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Dasar</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="nip" class="block text-sm font-medium text-gray-700">NIP</label>
                                    <input type="text" name="nip" id="nip" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" value="{{ old('nip') }}" required>
                                    @error('nip')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="nama_depan" class="block text-sm font-medium text-gray-700">Nama Depan</label>
                                    <input type="text" name="nama_depan" id="nama_depan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" value="{{ old('nama_depan') }}" required onchange="updateNamaLengkap()">
                                    @error('nama_depan')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="nama_belakang" class="block text-sm font-medium text-gray-700">Nama Belakang</label>
                                    <input type="text" name="nama_belakang" id="nama_belakang" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" value="{{ old('nama_belakang') }}" onchange="updateNamaLengkap()">
                                    @error('nama_belakang')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Hidden input untuk nama lengkap -->
                                <input type="hidden" name="nama" id="nama" value="{{ old('nama') }}">

                                <div>
                                    <label for="jabatan" class="block text-sm font-medium text-gray-700">Jabatan</label>
                                    <input type="text" name="jabatan" id="jabatan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" value="{{ old('jabatan') }}" required>
                                    @error('jabatan')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="departemen" class="block text-sm font-medium text-gray-700">Departemen</label>
                                    <input type="text" name="departemen" id="departemen" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" value="{{ old('departemen') }}" required>
                                    @error('departemen')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Kontak -->
                        <div class="mb-8">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Kontak</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="no_telepon" class="block text-sm font-medium text-gray-700">No. Telepon</label>
                                    <input type="text" name="no_telepon" id="no_telepon" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" value="{{ old('no_telepon') }}" required>
                                    @error('no_telepon')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                    <input type="email" name="email" id="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" value="{{ old('email') }}" required>
                                    @error('email')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Foto -->
                        <div class="mb-8">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Foto</h3>
                            <div>
                                <label for="foto" class="block text-sm font-medium text-gray-700">Foto Profil</label>
                                <input type="file" name="foto" id="foto" class="mt-1 block w-full" accept="image/*">
                                @error('foto')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex justify-end space-x-4">
                            <a href="{{ route('employees.index') }}" class="inline-flex justify-center rounded-md border border-gray-300 bg-white py-2 px-4 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                Batal
                            </a>
                            <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

@push('scripts')
<script>
function updateNamaLengkap() {
    const namaDepan = document.getElementById('nama_depan').value.trim();
    const namaBelakang = document.getElementById('nama_belakang').value.trim();
    const namaLengkap = [namaDepan, namaBelakang].filter(Boolean).join(' ');
    document.getElementById('nama').value = namaLengkap;
}

// Update nama lengkap saat halaman dimuat
document.addEventListener('DOMContentLoaded', updateNamaLengkap);
</script>
@endpush 