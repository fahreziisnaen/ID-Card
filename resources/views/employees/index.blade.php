<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Karyawan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-4">
                        <a href="{{ route('employees.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Tambah Karyawan
                        </a>
                    </div>

                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-6 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        NIP
                                    </th>
                                    <th class="px-6 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Nama
                                    </th>
                                    <th class="px-6 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Jabatan
                                    </th>
                                    <th class="px-6 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Departemen
                                    </th>
                                    <th class="px-6 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                @foreach($employees as $employee)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                            {{ $employee->nip }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                            {{ $employee->nama }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                            {{ $employee->jabatan }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                            {{ $employee->departemen }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                            <a href="{{ route('employees.show', $employee) }}" class="text-blue-600 hover:text-blue-900 mr-2">Detail</a>
                                            <a href="{{ route('employees.edit', $employee) }}" class="text-green-600 hover:text-green-900 mr-2">Edit</a>
                                            <button 
                                                type="button"
                                                data-name="{{ $employee->nama }}"
                                                data-url="{{ route('employees.show', $employee) }}"
                                                class="show-qr text-purple-600 hover:text-purple-900 mr-2 cursor-pointer">
                                                Show QR
                                            </button>
                                            <form action="{{ route('employees.destroy', $employee) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $employees->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal QR -->
    <div id="qrModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4" id="modalTitle"></h3>
                <div class="mt-2 px-7 py-3">
                    <div id="qrcode" class="flex justify-center mb-4"></div>
                    <p class="text-sm text-gray-500 mt-1 mb-4">
                        Scan QR Code untuk melihat detail karyawan
                    </p>
                </div>
                <div class="items-center px-4 py-3">
                    <button 
                        onclick="document.getElementById('qrModal').classList.add('hidden')"
                        class="px-4 py-2 bg-gray-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-300 transition duration-150 ease-in-out">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Pastikan QR Code library sudah dimuat
        if (typeof QRCode === 'undefined') {
            console.error('QR Code library not loaded!');
        }

        // Tunggu sampai DOM selesai dimuat
        window.addEventListener('load', function() {
            console.log('Window loaded');
            
            const buttons = document.querySelectorAll('.show-qr');
            console.log('Found buttons:', buttons.length);
            
            buttons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    console.log('Button clicked');
                    
                    const nama = this.dataset.name;
                    const url = this.dataset.url;
                    console.log('Data:', { nama, url });
                    
                    try {
                        const modal = document.getElementById('qrModal');
                        const modalTitle = document.getElementById('modalTitle');
                        const qrcodeDiv = document.getElementById('qrcode');
                        
                        // Clear previous QR code
                        qrcodeDiv.innerHTML = '';
                        
                        // Set modal title
                        modalTitle.textContent = `QR Code - ${nama}`;
                        
                        // Generate new QR code
                        console.log('Generating QR code...');
                        new QRCode(qrcodeDiv, {
                            text: url,
                            width: 128,
                            height: 128,
                            colorDark : "#000000",
                            colorLight : "#ffffff",
                            correctLevel : QRCode.CorrectLevel.H
                        });
                        console.log('QR code generated');
                        
                        // Show modal using Tailwind classes
                        modal.classList.remove('hidden');
                        console.log('Modal should be visible now');
                    } catch (error) {
                        console.error('Error:', error);
                        alert('Error generating QR code: ' + error.message);
                    }
                });
            });

            // Close when clicking outside modal
            window.onclick = function(event) {
                const modal = document.getElementById('qrModal');
                if (event.target == modal) {
                    modal.classList.add('hidden');
                    console.log('Modal closed');
                }
            }
        });
    </script>
    @endpush
</x-app-layout> 