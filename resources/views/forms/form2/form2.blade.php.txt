@extends('layouts.main')

@section('content')
<div class="page-heading">
    <div class="page-title mb-4">
        <h3>Formulir 02 - Surat Keputusan Pembentukan Tim Kerja Pengkajian Kebutuhan Pascabencana</h3>
        <p class="text-subtitle text-muted">Pengisian formulir keputusan pembentukan tim kerja untuk pengkajian kebutuhan pascabencana</p>
    </div>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Data Surat Keputusan</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('forms.form2.store') }}" method="POST">
                @csrf
                <input type="hidden" name="bencana_id" value="{{ $bencana->id ?? request()->get('bencana_id') }}">
                
                <!-- 1. Informasi Umum -->
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="mt-3 mb-4">1. Informasi Umum</h5>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nomor_surat">Nomor Surat Keputusan</label>
                            <input type="text" class="form-control @error('nomor_surat') is-invalid @enderror" id="nomor_surat" name="nomor_surat" value="{{ old('nomor_surat') }}" required>
                            @error('nomor_surat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tanggal_ditetapkan">Tanggal Penetapan</label>
                            <input type="date" class="form-control @error('tanggal_ditetapkan') is-invalid @enderror" id="tanggal_ditetapkan" name="tanggal_ditetapkan" value="{{ old('tanggal_ditetapkan') }}" required>
                            @error('tanggal_ditetapkan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tentang">Tentang</label>
                            <input type="text" class="form-control @error('tentang') is-invalid @enderror" id="tentang" name="tentang" value="Pembentukan Tim Kerja Pengkajian Kebutuhan Pascabencana" required>
                            @error('tentang')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="lokasi">Lokasi (Wilayah Terdampak)</label>
                            <input type="text" class="form-control @error('lokasi') is-invalid @enderror" id="lokasi" name="lokasi" value="{{ old('lokasi') }}" required>
                            @error('lokasi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="pejabat_penandatangan">Pejabat yang Menetapkan</label>
                            <input type="text" class="form-control @error('pejabat_penandatangan') is-invalid @enderror" id="pejabat_penandatangan" name="pejabat_penandatangan" value="{{ old('pejabat_penandatangan') }}" required placeholder="Deputi Rehabilitasi dan Rekonstruksi BNPB / Kepala BPBD">
                            @error('pejabat_penandatangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- 2. Dasar Hukum -->
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="mt-5 mb-4">2. Dasar Hukum</h5>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="menimbang">Menimbang (Alasan Pembentukan Tim)</label>
                            <textarea class="form-control @error('menimbang') is-invalid @enderror" id="menimbang" name="menimbang" rows="5" required>{{ old('menimbang') }}</textarea>
                            @error('menimbang')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="mengingat">Mengingat (Undang-Undang dan Peraturan Terkait)</label>
                            <textarea class="form-control @error('mengingat') is-invalid @enderror" id="mengingat" name="mengingat" rows="5" required>{{ old('mengingat') }}</textarea>
                            @error('mengingat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- 3. Keputusan -->
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="mt-5 mb-4">3. Keputusan</h5>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="tim_kerja">Susunan Personil Tim Kerja</label>
                            <div class="alert alert-info">
                                Harap isi dengan format: <br>
                                Nama Lengkap - Jabatan - Posisi dalam Tim<br>
                                Contoh: John Doe - Kepala Seksi Rehabilitasi - Ketua Tim
                            </div>
                            <textarea class="form-control @error('tim_kerja') is-invalid @enderror" id="tim_kerja" name="tim_kerja" rows="7" required>{{ old('tim_kerja') }}</textarea>
                            @error('tim_kerja')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="tugas_tim">Tugas Tim</label>
                            <div class="alert alert-info">
                                Tugas Tim Meliputi:
                                <ol>
                                    <li>Perencanaan dan persiapan pengkajian kebutuhan pascabencana</li>
                                    <li>Pengumpulan data</li>
                                    <li>Pengolahan dan analisis data</li>
                                    <li>Penyusunan laporan hasil pengkajian</li>
                                </ol>
                                Tambahkan tugas lain jika diperlukan.
                            </div>
                            <textarea class="form-control @error('tugas_tim') is-invalid @enderror" id="tugas_tim" name="tugas_tim" rows="7" required>1. Perencanaan dan persiapan pengkajian kebutuhan pascabencana
2. Pengumpulan data
3. Pengolahan dan analisis data
4. Penyusunan laporan hasil pengkajian{{ old('tugas_tim') }}</textarea>
                            @error('tugas_tim')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- 4. Penetapan dan Tembusan -->
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="mt-5 mb-4">4. Penetapan dan Tembusan</h5>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="penanggung_jawab">Penanggung Jawab</label>
                            <input type="text" class="form-control @error('penanggung_jawab') is-invalid @enderror" id="penanggung_jawab" name="penanggung_jawab" value="{{ old('penanggung_jawab') }}" required placeholder="Deputi Rehabilitasi dan Rekonstruksi BNPB / Kepala Daerah">
                            @error('penanggung_jawab')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="tembusan">Tembusan</label>
                            <div class="alert alert-info">
                                Harap isi dengan format: <br>
                                1. Kepala BNPB<br>
                                2. Menteri/Kepala Lembaga terkait<br>
                                Tambahkan tembusan lain jika diperlukan.
                            </div>
                            <textarea class="form-control @error('tembusan') is-invalid @enderror" id="tembusan" name="tembusan" rows="5" required>1. Kepala BNPB
2. {{ old('tembusan') }}</textarea>
                            @error('tembusan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="row mt-5">
                    <div class="col-md-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary me-2">Simpan</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Preview Section (Optional) -->
    <div class="card mt-4">
        <div class="card-header">
            <h4 class="card-title">Preview Surat Keputusan</h4>
        </div>
        <div class="card-body">
            <p class="text-muted">Data yang telah diisi akan ditampilkan dalam format surat keputusan di sini.</p>
            <div id="previewArea">
                <!-- Preview content will be displayed here using JavaScript -->
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    // Script untuk menghasilkan preview surat keputusan
    $(document).ready(function() {
        // Function to update preview
        function updatePreview() {
            // Collect form data
            const nomorSurat = $('#nomor_surat').val();
            const tentang = $('#tentang').val();
            const lokasi = $('#lokasi').val();
            const tanggal = $('#tanggal_ditetapkan').val();
            const pejabat = $('#pejabat_penandatangan').val();
            const menimbang = $('#menimbang').val();
            const mengingat = $('#mengingat').val();
            const timKerja = $('#tim_kerja').val();
            const tugasTim = $('#tugas_tim').val();
            const penanggungJawab = $('#penanggung_jawab').val();
            const tembusan = $('#tembusan').val();
            
            // Format the date
            const formattedDate = tanggal ? new Date(tanggal).toLocaleDateString('id-ID', {
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            }) : '';
            
            // Generate preview HTML
            let previewHTML = `
                <div class="border p-4">
                    <div class="text-center mb-4">
                        <h5>KEPUTUSAN ${pejabat ? pejabat.toUpperCase() : ''}</h5>
                        <h5>NOMOR: ${nomorSurat}</h5>
                        <h5>TENTANG</h5>
                        <h5>${tentang ? tentang.toUpperCase() : ''}</h5>
                        <h5>DI ${lokasi ? lokasi.toUpperCase() : ''}</h5>
                    </div>
                    
                    <div class="mb-3">
                        <strong>${pejabat ? pejabat.toUpperCase() : ''}</strong>
                    </div>
                    
                    <div class="mb-3">
                        <p><strong>Menimbang:</strong></p>
                        <p>${menimbang ? menimbang.replace(/\n/g, '<br>') : ''}</p>
                    </div>
                    
                    <div class="mb-3">
                        <p><strong>Mengingat:</strong></p>
                        <p>${mengingat ? mengingat.replace(/\n/g, '<br>') : ''}</p>
                    </div>
                    
                    <div class="text-center mb-3">
                        <h5>MEMUTUSKAN:</h5>
                    </div>
                    
                    <div class="mb-3">
                        <p><strong>KESATU:</strong> Membentuk Tim Kerja Pengkajian Kebutuhan Pascabencana dengan susunan tim sebagai berikut:</p>
                        <p>${timKerja ? timKerja.replace(/\n/g, '<br>') : ''}</p>
                    </div>
                    
                    <div class="mb-3">
                        <p><strong>KEDUA:</strong> Tim sebagaimana dimaksud dalam Diktum KESATU mempunyai tugas sebagai berikut:</p>
                        <p>${tugasTim ? tugasTim.replace(/\n/g, '<br>') : ''}</p>
                    </div>
                    
                    <div class="mb-3">
                        <p><strong>KETIGA:</strong> Dalam melaksanakan tugasnya, Tim bertanggung jawab kepada ${penanggungJawab}.</p>
                    </div>
                    
                    <div class="mb-3">
                        <p><strong>KEEMPAT:</strong> Keputusan ini mulai berlaku pada tanggal ditetapkan.</p>
                    </div>
                    
                    <div class="row mt-4">
                        <div class="col-md-6"></div>
                        <div class="col-md-6 text-center">
                            <p>Ditetapkan di : ...........................</p>
                            <p>pada tanggal : ${formattedDate}</p>
                            <p class="mb-5"><strong>${pejabat}</strong></p>
                            <p><u>...................................</u></p>
                            <p>NIP. ...........................</p>
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <p>Tembusan:</p>
                        <p>${tembusan ? tembusan.replace(/\n/g, '<br>') : ''}</p>
                    </div>
                </div>
            `;
            
            // Update preview area
            $('#previewArea').html(previewHTML);
        }
        
        // Attach event listeners to form fields
        $('form input, form textarea').on('input', updatePreview);
        
        // Initial preview
        // setTimeout(updatePreview, 1000);
    });
</script>
@endpush
