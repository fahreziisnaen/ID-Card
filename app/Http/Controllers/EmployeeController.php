<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    public function __construct()
    {
        // Buat folder jika belum ada
        Storage::disk('public')->makeDirectory('employee-photos');
    }

    public function index()
    {
        $employees = Employee::latest()->paginate(10);
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        return view('employees.create');
    }

    public function store(Request $request)
    {
        \Log::info('Store method called');
        \Log::info('Request data:', $request->all());

        $request->validate([
            'nip' => 'required|unique:employees',
            'nama_depan' => 'required',
            'nama_belakang' => 'nullable',
            'jabatan' => 'required',
            'departemen' => 'required',
            'no_telepon' => 'required',
            'email' => 'required|email|unique:employees',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        try {
            $data = $request->all();
            
            // Generate nama lengkap dari nama depan dan belakang
            $data['nama'] = trim($request->nama_depan . ' ' . $request->nama_belakang);
            
            if ($request->hasFile('foto')) {
                $foto = $request->file('foto');
                $filename = time() . '_' . $foto->getClientOriginalName();
                $path = $foto->storeAs('employee-photos', $filename, 'public');
                $data['foto'] = $filename;
            }

            Employee::create($data);
            return redirect()->route('employees.index')->with('success', 'Data karyawan berhasil ditambahkan');
        } catch (\Exception $e) {
            // Tambahkan log untuk debugging
            \Log::error('Error creating employee: ' . $e->getMessage());
            return back()->withInput()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    public function show(Employee $employee)
    {
        // Jika user tidak login, gunakan layout publik
        if (!auth()->check()) {
            return view('employees.public-show', compact('employee'));
        }
        
        return view('employees.show', compact('employee'));
    }

    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'nip' => 'required|unique:employees,nip,' . $employee->id,
            'nama_depan' => 'required',
            'nama_belakang' => 'nullable',
            'nama' => 'required',
            'jabatan' => 'required',
            'departemen' => 'required',
            'no_telepon' => 'required',
            'email' => 'required|email|unique:employees,email,' . $employee->id,
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        try {
            $data = $request->all();
            
            // Generate nama lengkap dari nama depan dan belakang
            $data['nama'] = trim($request->nama_depan . ' ' . $request->nama_belakang);

            if ($request->hasFile('foto')) {
                if ($employee->foto) {
                    Storage::disk('public')->delete('employee-photos/' . $employee->foto);
                }
                
                $foto = $request->file('foto');
                $filename = time() . '_' . $foto->getClientOriginalName();
                $path = $foto->storeAs('employee-photos', $filename, 'public');
                $data['foto'] = $filename;
            }

            $employee->update($data);
            return redirect()->route('employees.index')->with('success', 'Data karyawan berhasil diperbarui');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    public function destroy(Employee $employee)
    {
        if ($employee->foto) {
            Storage::disk('public')->delete('employee-photos/' . $employee->foto);
        }
        
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Data karyawan berhasil dihapus');
    }
} 