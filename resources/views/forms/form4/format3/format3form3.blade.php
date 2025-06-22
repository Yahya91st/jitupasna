@extends('layouts.main')

@section('content')
<div class="container">
    <h2 class="text-center mb-4">Formulir 03 - Pendataan ke OPD</h2>

    {{-- BAGIAN 1 --}}
    <h5>1. Formulir Isian Data Dasar Sebelum Bencana</h5>
    <p><strong>Wilayah bencana, Kab/Kota/Kecamatan:</strong> ........................................</p>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Kategori</th>
                <th>Sub-Kategori</th>
                <th>Jawaban</th>
            </tr>
        </thead>
        <tbody>
            {{-- Penduduk-Wilayah --}}
            <tr><td rowspan="3">Penduduk-Wilayah</td><td>Jumlah laki-laki</td><td></td></tr>
            <tr><td>Jumlah perempuan</td><td></td></tr>
            <tr><td>Jumlah rumah tangga</td><td></td></tr>

            {{-- Sarana Kesehatan --}}
            <tr><td rowspan="4">Sarana Kesehatan</td><td>Jumlah rumah sakit</td><td></td></tr>
            <tr><td>Jumlah PUSKESMAS</td><td></td></tr>
            <tr><td>Jumlah PUSKESMAS Pembantu</td><td></td></tr>
            <tr><td>Jumlah POLINDES / POSYANDU</td><td></td></tr>

            {{-- Tenaga Kesehatan --}}
            <tr><td rowspan="5">Tenaga Kesehatan</td><td>Jumlah dokter</td><td></td></tr>
            <tr><td>Jumlah perawat</td><td></td></tr>
            <tr><td>Jumlah bidan</td><td></td></tr>
            <tr><td>Jumlah tenaga kesehatan lainnya</td><td></td></tr>
            <tr><td>Jumlah kunjungan ke PUSKESMAS</td><td></td></tr>

            {{-- Balita --}}
            <tr><td rowspan="4">Balita</td><td>Jumlah balita gizi buruk</td><td></td></tr>
            <tr><td>Jumlah balita kurang gizi</td><td></td></tr>
            <tr><td>Jumlah balita tingkat gizi normal</td><td></td></tr>
            <tr><td>Jumlah balita lainnya</td><td></td></tr>

            {{-- Manula --}}
            <tr><td>Manula</td><td>Jumlah manula</td><td></td></tr>

            {{-- Penerima JPS --}}
            <tr><td>Penerima JPS Kesehatan</td><td>Jumlah penerima jps kesehatan</td><td></td></tr>

            {{-- Sanitasi --}}
            <tr><td rowspan="2">Sanitasi</td><td>Jumlah rumah dengan sanitasi sehat</td><td></td></tr>
            <tr><td>Jumlah rumah dengan MCK umum</td><td></td></tr>

            {{-- Ekonomi --}}
            <tr><td rowspan="4">Ekonomi</td><td>Jumlah keluarga pra-sejahtera</td><td></td></tr>
            <tr><td>Jumlah keluarga sejahtera-1</td><td></td></tr>
            <tr><td>Jumlah keluarga sejahtera-2</td><td></td></tr>
            <tr><td>Jumlah penduduk miskin</td><td></td></tr>
        </tbody>
    </table>

    {{-- BAGIAN 2 --}}
    <h5 class="mt-5">2. Formulir Isian Data Sekunder Akibat Bencana (Umum)</h5>
    <table class="table table-bordered">
        <thead>
            <tr><th>Pertanyaan</th><th>Jawaban</th></tr>
        </thead>
        <tbody>
            <tr><td>Sejarah bencana di masa lalu</td><td></td></tr>
            <tr><td>Kronologis kejadian bencana saat ini</td><td></td></tr>
            <tr><td>Wilayah yang terdampak bencana saat ini</td><td></td></tr>
            <tr><td>Jumlah korban meninggal dunia</td><td></td></tr>
            <tr><td>Jumlah korban luka-luka</td><td></td></tr>
            <tr><td>Jumlah korban yang mengungsi</td><td></td></tr>
            <tr><td>Kerusakan dan kerugian yang dialami</td><td></td></tr>
        </tbody>
    </table>

    {{-- BAGIAN 3 --}}
    <h5 class="mt-5">3. Formulir Isian Data Sekunder Akibat Bencana (Khusus)</h5>

    {{-- OPD: Pertanian & Kelautan --}}
    <h6>Satuan Kerja Perangkat Daerah Bidang Pertanian, Perkebunan, Peternakan, Perikanan, Kehutanan</h6>
    <p><strong>Nama OPD:</strong> ............................................</p>
    <p><strong>Tgl/Bln/Thn:</strong> ............................................</p>

    <table class="table table-bordered">
        <thead><tr><th>No</th><th>Pokok Bahasan</th></tr></thead>
        <tbody>
            <tr><td>1</td><td>Rumah tangga terdampak: Pertanian, Peternakan, Perkebunan, Perikanan, lainnya</td></tr>
            <tr><td>2</td><td>Penggunaan kegiatan ekonomi terdampak</td></tr>
            <tr><td>3</td><td>Jenis produk lokal khas terdampak</td></tr>
            <tr><td>4</td><td>Jumlah organisasi/lembaga pertanian terdampak & kebutuhan pemulihan</td></tr>
        </tbody>
    </table>

    {{-- OPD: Perdagangan, Industri, Koperasi --}}
    <h6 class="mt-4">Satuan Kerja Perangkat Daerah Bidang Non-Pertanian</h6>
    <p><strong>Nama OPD:</strong> ............................................</p>
    <p><strong>Tgl/Bln/Thn:</strong> ............................................</p>

    <table class="table table-bordered">
        <thead><tr><th>No</th><th>Pokok Bahasan</th></tr></thead>
        <tbody>
            <tr><td>1</td><td>Rumah tangga terdampak di sektor perdagangan, industri, koperasi, UMKM</td></tr>
            <tr><td>2</td><td>Pergeseran kegiatan ekonomi</td></tr>
            <tr><td>3</td><td>Produk lokal khas terdampak & pemulihan</td></tr>
            <tr><td>4</td><td>Organisasi koperasi terdampak & kebutuhan pemulihan</td></tr>
        </tbody>
    </table>

    {{-- OPD: Sosial & Keagamaan --}}
    <h6 class="mt-4">Satuan Kerja Perangkat Daerah Bidang Sosial dan Keagamaan</h6>
    <p><strong>Nama OPD:</strong> ............................................</p>
    <p><strong>Tgl/Bln/Thn:</strong> ............................................</p>

    <table class="table table-bordered">
        <thead><tr><th>No</th><th>Pokok Bahasan</th></tr></thead>
        <tbody>
            <tr><td>1</td><td>Kehilangan akses rumah ibadah</td></tr>
            <tr><td>2</td><td>Penyandang cacat akibat bencana & rehabilitasi</td></tr>
            <tr><td>3</td><td>Kegiatan agama & sosial yang terdampak</td></tr>
            <tr><td>4</td><td>Pergeseran kegiatan masyarakat</td></tr>
            <tr><td>5</td><td>Keberfungsian masyarakat dan pemulihannya</td></tr>
            <tr><td>6</td><td>Permasalahan sosial dan solusinya</td></tr>
            <tr><td>7</td><td>Kearifan lokal untuk mitigasi risiko sosial</td></tr>
        </tbody>
    </table>

    {{-- OPD: Pendidikan --}}
    <h6 class="mt-4">Satuan Kerja Perangkat Daerah - Dinas Pendidikan</h6>
    <p><strong>Nama OPD:</strong> ............................................</p>
    <p><strong>Tgl/Bln/Thn:</strong> ............................................</p>

    <table class="table table-bordered">
        <thead><tr><th>No</th><th>Pokok Bahasan</th></tr></thead>
        <tbody>
            <tr><td>1</td><td>Hambatan pendidikan sebelum bencana</td></tr>
            <tr><td>2</td><td>Trauma siswa/guru setelah bencana</td></tr>
            <tr><td>3</td><td>Permasalahan pendidikan & pemulihan</td></tr>
            <tr><td>4</td><td>Guru meninggal/hilang & solusinya</td></tr>
        </tbody>
    </table>

    {{-- OPD: Sekretariat Daerah --}}
    <h6 class="mt-4">Satuan Kerja Perangkat Daerah - Sekretariat Daerah</h6>
    <p><strong>Nama OPD:</strong> ............................................</p>
    <p><strong>Tgl/Bln/Thn:</strong> ............................................</p>

    <table class="table table-bordered">
        <thead><tr><th>No</th><th>Pokok Bahasan</th></tr></thead>
        <tbody>
            <tr><td>1</td><td>Gangguan RT/RW & kebutuhan pemulihan</td></tr>
            <tr><td>2</td><td>Sistem pemeliharaan desa dan kerusakannya</td></tr>
            <tr><td>3</td><td>Sistem ketahanan pangan desa</td></tr>
            <tr><td>4</td><td>Kehilangan dokumen penting & solusinya</td></tr>
            <tr><td>5</td><td>Permasalahan administrasi</td></tr>
            <tr><td>6</td><td>Pegawai pemerintah meninggal & pengganti</td></tr>
        </tbody>
    </table>

    {{-- OPD: Dinas Kesehatan --}}
    <h6 class="mt-4">Satuan Kerja Perangkat Daerah - Dinas Kesehatan</h6>
    <p><strong>Nama OPD:</strong> ............................................</p>
    <p><strong>Tgl/Bln/Thn:</strong> ............................................</p>

    <table class="table table-bordered">
        <thead><tr><th>No</th><th>Pokok Bahasan</th></tr></thead>
        <tbody>
            <tr><td>1</td><td>Permasalahan pelayanan kesehatan sebelum bencana</td></tr>
            <tr><td>2</td><td>Indikasi trauma penduduk</td></tr>
            <tr><td>3</td><td>Program kesehatan untuk penanggulangan</td></tr>
            <tr><td>4</td><td>Permasalahan & kegiatan pemulihan</td></tr>
            <tr><td>5</td><td>Program tambahan untuk anak & sekolah</td></tr>
            <tr><td>6</td><td>Jumlah balita terdampak</td></tr>
            <tr><td>7</td><td>Ibu hamil terdampak & kegiatan pemulihan</td></tr>
            <tr><td>8</td><td>Lansia terdampak & kegiatan pemulihan</td></tr>
            <tr><td>9</td><td>Dampak kesehatan jangka menengah</td></tr>
            <tr><td>10</td><td>Rencana kontingensi kesehatan</td></tr>
        </tbody>
    </table>
</div>
@endsection
