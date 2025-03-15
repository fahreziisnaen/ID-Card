<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'nip',
        'nama',
        'nama_depan',
        'nama_belakang',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'alamat_jalan',
        'kota',
        'provinsi',
        'kode_pos',
        'negara',
        'no_telepon',
        'no_telepon_kantor',
        'no_whatsapp',
        'email',
        'email_kantor',
        'jabatan',
        'departemen',
        'unit_kerja',
        'tanggal_bergabung',
        'linkedin_url',
        'website',
        'foto',
        'tanda_tangan',
        'catatan'
    ];

    protected $dates = [
        'tanggal_lahir',
        'tanggal_bergabung'
    ];

    protected $casts = [
        'tanggal_lahir' => 'datetime',
        'tanggal_bergabung' => 'datetime'
    ];

    public function getRouteKeyName()
    {
        return 'nip';
    }

    public function getVCardString()
    {
        return "BEGIN:VCARD
VERSION:3.0
N:{$this->nama_belakang};{$this->nama_depan};;;
FN:{$this->nama}
ORG:PT. Internet Pratama Indonesia;{$this->departemen}
TITLE:{$this->jabatan}
EMAIL;type=WORK:{$this->email_kantor}
EMAIL;type=HOME:{$this->email}
TEL;type=WORK,voice:{$this->no_telepon_kantor}
TEL;type=CELL,voice:{$this->no_telepon}
TEL;type=CELL,WHATSAPP:{$this->no_whatsapp}
ADR;type=WORK:;;{$this->alamat_jalan};{$this->kota};{$this->provinsi};{$this->kode_pos};{$this->negara}
URL;type=WORK:" . config('app.url') . "/employees/{$this->nip}
URL;type=LinkedIn:{$this->linkedin_url}
URL;type=Website:{$this->website}
NOTE:{$this->catatan}
REV:" . now()->format('Y-m-d\TH:i:s\Z') . "
END:VCARD";
    }
} 