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
        $request->validate([
            'nip' => 'required|unique:employees',
            'nama' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required',
            'no_telepon' => 'required',
            'email' => 'required|email|unique:employees',
            'jabatan' => 'required',
            'departemen' => 'required',
            'tanggal_bergabung' => 'required|date',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->all();
        
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $filename = time() . '_' . $foto->getClientOriginalName();
            // Simpan file ke storage/app/public/employee-photos
            $path = $foto->storeAs('employee-photos', $filename, 'public');
            $data['foto'] = $filename;
        }

        Employee::create($data);
        return redirect()->route('employees.index')->with('success', 'Data karyawan berhasil ditambahkan');
    }

    public function show(Employee $employee)
    {
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
            'nama' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required',
            'no_telepon' => 'required',
            'email' => 'required|email|unique:employees,email,' . $employee->id,
            'jabatan' => 'required',
            'departemen' => 'required',
            'tanggal_bergabung' => 'required|date',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            // Hapus foto lama
            if ($employee->foto) {
                Storage::disk('public')->delete('employee-photos/' . $employee->foto);
            }
            
            $foto = $request->file('foto');
            $filename = time() . '_' . $foto->getClientOriginalName();
            // Simpan file ke storage/app/public/employee-photos
            $path = $foto->storeAs('employee-photos', $filename, 'public');
            $data['foto'] = $filename;
        }

        $employee->update($data);
        return redirect()->route('employees.index')->with('success', 'Data karyawan berhasil diperbarui');
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