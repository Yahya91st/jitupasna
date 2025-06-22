@extends('layouts.main')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-2xl font-bold">Edit Formulir 03 - Pendataan ke OPD</h1>
        <a href="{{ route('forms.form3.show', $pendataan->id) }}" class="btn btn-secondary">
            <i class="fa fa-arrow-left"></i> Kembali
        </a>
    </div>
    
    @if(isset($bencana))
        <div class="alert alert-light-primary color-primary mb-4">
            <p>Bencana: {{ $bencana->kategori_bencana->nama }}</p>
            <p>Tanggal: {{ $bencana->tanggal }}</p>
            <p>Lokasi: 
                @foreach($bencana->desa as $desa)
                    {{ $desa->nama }}@if(!$loop->last), @endif
                @endforeach
            </p>
        </div>
    @endif
    
    <form action="{{ route('forms.form3.update', $pendataan->id) }}" method="POST" class="space-y-8">
        @csrf
        @method('PATCH')
        
        <input type="hidden" name="bencana_id" value="{{ $pendataan->bencana_id }}">
        
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-semibold mb-4">Data Surat</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nomor Surat</label>
                    <input type="text" name="nomor_surat" value="{{ old('nomor_surat', $pendataan->nomor_surat) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm form-control" required>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">Tanggal</label>
                    <input type="date" name="tanggal" value="{{ old('tanggal', $pendataan->tanggal) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm form-control" required>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">Sifat</label>
                    <input type="text" name="sifat" value="{{ old('sifat', $pendataan->sifat) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm form-control" required>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">Lampiran</label>
                    <input type="text" name="lampiran" value="{{ old('lampiran', $pendataan->lampiran) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm form-control">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">Perihal</label>
                    <input type="text" name="perihal" value="{{ old('perihal', $pendataan->perihal) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm form-control" required>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">Instansi Tujuan</label>
                    <input type="text" name="instansi_tujuan" value="{{ old('instansi_tujuan', $pendataan->instansi_tujuan) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm form-control" required>
                </div>
            </div>
            
            <div class="mt-4">
                <label class="block text-sm font-medium text-gray-700">Tembusan</label>
                <textarea name="tembusan" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm form-control">{{ old('tembusan', $pendataan->tembusan) }}</textarea>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nama Penandatangan</label>
                    <input type="text" name="nama_penandatangan" value="{{ old('nama_penandatangan', $pendataan->nama_penandatangan) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm form-control" required>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">Jabatan Penandatangan</label>
                    <input type="text" name="jabatan_penandatangan" value="{{ old('jabatan_penandatangan', $pendataan->jabatan_penandatangan) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm form-control" required>
                </div>
            </div>
        </div>
        
        <div class="flex justify-end mt-4">
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection
