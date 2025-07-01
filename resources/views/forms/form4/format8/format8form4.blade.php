@extends('layouts.main')

@section('content')
<div class="container-fluid mt-4">    <h5 class="text-center fw-bold">Formulir 04<br>Pengumpulan Data Sektor</h5>
    <h4 class="mb-3">Format 8. Pengumpulan Data Sektor Listrik</h4>

    <form method="POST" action="{{ route('forms.form4.store-format8') }}">
        @csrf
        <input type="hidden" name="bencana_id" value="{{ request()->bencana_id }}">
        
        <div class="card mb-3">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Informasi Lokasi</h5>
            </div>
            <div class="card-body">                <div class="row mb-3">
                    <div class="col-md-6 col-sm-12">
                        <label for="nama_kampung" class="form-label">Nama Kampung:</label>
                        <input type="text" class="form-control responsive-input" id="nama_kampung" name="nama_kampung" required>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <label for="nama_distrik" class="form-label">Nama Distrik:</label>
                        <input type="text" class="form-control responsive-input" id="nama_distrik" name="nama_distrik" required>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Perkiraan Kerusakan Infrastruktur Listrik</h5>
            </div>            <div class="card-body">                <div class="table-responsive">
                    <table class="table table-bordered" style="width: 100%; border-collapse: collapse;">
                        <thead class="table-light">
                            <tr>
                                <th rowspan="2" style="text-align: center; vertical-align: middle; width: 1000px;">URAIAN</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle; width: 1000px;">KOMPONEN</th>
                                <th colspan="2" style="text-align: center; vertical-align: middle; width: 10px;">Jumlah Kerusakan</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle; width: 10px;">Harga Satuan (Rp)</th>
                            </tr>
                            <tr>
                                <th style="text-align: center; width: 1px;">Satuan</th>
                                <th style="text-align: center; width: 1px;">Unit</th>
                            </tr>
                        </thead>
                            <tbody>                        <tr>
                            <td rowspan="3" class="align-middle fw-bold bg-light" style="text-align: center; vertical-align: middle; font-size: clamp(0.8rem, 1vw, 1rem);">SISTEM TRANSMISI DAN DISTRIBUSI</td>
                            <td style="vertical-align: middle; text-align: center;">KABEL (meter)</td>
                            <td style=""><input type="number" name="kabel_rb" class="form-control" style="width: 10%"></td>
                            <td style=""><input type="number" name="kabel_rs" class="form-control" style="width: 10%"></td>
                            <td style=""><input type="number" name="kabel_rs" class="form-control" style="width: 10%"></td>
                        </tr>
                        <tr>
                            <td style=" text-align: center;">TIANG</td>
                            <td style=""><input type="number" name="tiang_rb" class="form-control" style="width: 10%"></td>
                            <td style=""><input type="number" name="tiang_rs" class="form-control" style="width: 10%"></td>
                            <td style=""><input type="number" name="tiang_rr" class="form-control" style="width: 10%"></td>
                        </tr>
                        <tr>
                            <td style=" text-align: center;">GARDU/TRAFO</td>
                            <td style=""><input type="number" name="trafo_rb" class="form-control" style="width: 10%"></td>
                            <td style=""><input type="number" name="trafo_rs" class="form-control" style="width: 10%"></td>
                            <td style=""><input type="number" name="trafo_rr" class="form-control" style="width: 10%"></td>
                        </tr>                        <tr>
                            <td rowspan="4" class="align-middle fw-bold bg-light" style="text-align: center;  font-size: clamp(0.8rem, 1vw, 1rem);">SISTEM PEMBANGKITAN</td>
                            <td style=" text-align: center;">PLTA</td>
                            <td style=""><input type="number" name="pembangkit_rb" class="form-control" style="width: 10%"></td>
                            <td style=""><input type="number" name="pembangkit_rs" class="form-control" style="width: 10%"></td>
                            <td style=""><input type="number" name="pembangkit_rr" class="form-control" style="width: 10%"></td>
                        </tr>
                        <tr>
                            <td style=" text-align: center;">PLTU</td>
                            <td style=""><input type="number" name="pembangkit_rb" class="form-control" style="width: 10%"></td>
                            <td style=""><input type="number" name="pembangkit_rs" class="form-control" style="width: 10%"></td>
                            <td style=""><input type="number" name="pembangkit_rr" class="form-control" style="width: 10%"></td>
                        </tr>
                        <tr>
                            <td style=" text-align: center;">PLTD</td>
                            <td style=""><input type="number" name="pembangkit_rb" class="form-control" style="width: 10%"></td>
                            <td style=""><input type="number" name="pembangkit_rs" class="form-control" style="width: 10%"></td>
                            <td style=""><input type="number" name="pembangkit_rr" class="form-control" style="width: 10%"></td>
                        </tr>
                        <tr>
                            <td style=" text-align: center;">PEMBANGKIT LAIN-LAIN <input type="text"> KETERANGAN</td>                            
                            <td style=""><input type="number" name="pembangkit_rb" class="form-control" style="width: 10%"></td>
                            <td style=""><input type="number" name="pembangkit_rs" class="form-control" style="width: 10%"></td>
                            <td style=""><input type="number" name="pembangkit_rr" class="form-control" style="width: 10%"></td>
                        </tr>
                        <tr>
                            <td style=" text-align: center;">PERKIRAAN JANGKA WAKTU PEMULIHAN</td>
                            <td><input type="text"> BULAN</td>                            
                        </tr>
                        
                        <tr>                            
                            <td style="vertical-align: middle; text-align: center;">PEMBANGKIT LISTRIK DARURAT</td>
                        </tr>
                        
                        <tr>
                            <td style="vertical-align: middle; text-align: center;">GENSET</td>
                            <td><input type="text"> UNIT</td>
                        </tr>
                        
                        <tr>
                            <td>
                                BIAYA PENGADAAN PER GENSET
                            </td>
                            <td><input type="text"> RP</td>
                        </tr>
                        
                        <tr>
                            <td>
                                PERKIRAAN KEHILANGAN PENURUNAN PENDAPATAN
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>B. PERMINTAAN LISTRIK PER BULAN SEBELUM BENCANA</td>
                            <td><input type="text" style="width: 10px"></td>
                            <td><input type="text" style="width: 10px"> KWH</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>C. PERMINTAAN LISTRIK PER BULAN PASCA BENCANA</td>
                            <td><input type="text" style="width: 10px"></td>
                            <td><input type="text" style="width: 10px"> KWH</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>D. TARIF LISTRIK PER KWH</td>
                            <td><input type="text" style="width: 10px"></td>
                            <td><input type="text" style="width: 10px"> RP.</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>E. PENURUNAN PENDAPATAN</td>
                            <td><input type="text" style="width: 10px"></td>
                            <td><input type="text" style="width: 10px"></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>PERKIRAAN KENAIKAN BIAYA OPERASIONAL</td>
                        </tr>
                    
                        <tr>
                            <td></td>
                            <td>B. BIAYA OPERASIONAL PER BULAN SEBELUM BENCANA</td>
                            <td><input type="text" style="width: 10px"></td>
                            <td><input type="text" style="width: 10px"> RP</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>C. BIAYA OPERASIONAL PER BULAN PASCA BENCANA</td>
                            <td><input type="text" style="width: 10px"></td>
                            <td><input type="text" style="width: 10px"> RP</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>D. KENAIKAN BIAYA OPERASIONAL</td>
                            <td><input type="text" style="width: 10px"></td>
                            <td><input type="text" style="width: 10px"></td>
                            <td></td>
                        </tr>
                    </tbody>
                    </table>
                </div>
                
            </div>
        </div>
        <div class="mt-3 text-center mb-5">
            <button type="submit" class="btn btn-primary px-4 py-2">Simpan Data</button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Langsung hilangkan semua transisi di AdminLTE
        const style = document.createElement('style');
        style.innerHTML = `
            /* Override ALL AdminLTE transitions */
            .main-sidebar, .main-sidebar *, .main-header, .main-header *, .content-wrapper, body, * {
                -webkit-transition: none !important;
                -moz-transition: none !important;
                -o-transition: none !important;
                transition: none !important;
                animation: none !important;
            }
            
            /* Override AdminLTE specific animations */
            .sidebar-collapse .main-sidebar, .sidebar-collapse .main-sidebar::before {
                margin-left: 0 !important;
                transform: translate3d(0, 0, 0) !important;
            }
        `;
        document.head.appendChild(style);
        
        // Function to handle sidebar toggle events and adjust layout
        function handleSidebarToggle() {
            const body = document.querySelector('body');
            const tableResponsive = document.querySelectorAll('.table-responsive');
            
            // Override AdminLTE animation properties
            const mainSidebar = document.querySelector('.main-sidebar');
            if (mainSidebar) {
                mainSidebar.style.transition = 'none !important';
            }
            
            // Observer for sidebar collapse/expand
            const observer = new MutationObserver(function(mutations) {
                mutations.forEach(function(mutation) {
                    if (mutation.attributeName === 'class') {
                        const isSidebarCollapsed = body.classList.contains('sidebar-collapse');
                        
                        // Re-force transition none on all elements
                        document.querySelectorAll('.main-sidebar, .main-header, .content-wrapper').forEach(el => {
                            el.style.transition = 'none !important';
                            el.style.webkitTransition = 'none !important';
                        });
                        
                        // Adjust table container width based on sidebar state without animation
                        tableResponsive.forEach(function(table) {
                            table.style.maxWidth = '100%';
                            table.style.transition = 'none';
                        });
                    }
                });
            });
            
            // Start observing the body element for class changes
            observer.observe(body, { attributes: true });
            
            // Initial setup
            const isSidebarCollapsed = body.classList.contains('sidebar-collapse');
            tableResponsive.forEach(function(table) {
                table.style.maxWidth = '100%';
            });
        }
        
        // Initialize sidebar toggle handling
        handleSidebarToggle();
        
        // Make form inputs more responsive
        const adjustInputWidths = function() {
            const inputs = document.querySelectorAll('input[type="number"], input[type="text"]');
            const windowWidth = window.innerWidth;
            
            inputs.forEach(input => {
                if (windowWidth < 768) {
                    input.style.minWidth = '60px';
                } else if (windowWidth < 992) {
                    input.style.minWidth = '70px';
                } else {
                    input.style.minWidth = '80px';
                }
            });
        };
        
        // Run on load and on resize
        adjustInputWidths();
        window.addEventListener('resize', adjustInputWidths);
    });
</script>
@endsection