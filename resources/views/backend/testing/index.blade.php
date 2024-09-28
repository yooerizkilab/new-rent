@extends('layouts.admin')

@push('css')
<!-- Custom styles for this page -->
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@section('main-content')

<div class="row">
    <div class="col-lg-6 mb-4">

        <!-- Illustrations -->
        <div class="card border-left-primary shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Illustrations</h6>
            </div>
            <div class="card-body">
    
                <div class="form-group">
                    <input type="hidden" id="user_id" value="{{ auth()->user()->id }}">
                    <input type="hidden" id="nama_user" value="{{ auth()->user()->name }}">
                    <input type="hidden" id="no_tlpn" value="{{ auth()->user()->tlpn }}">
                    <label for="Proyek">Proyek</label>
                    <input type="text" id="proyek" class="form-control @error('proyek') is-invalid @enderror" name="proyek" placeholder="Masukkan proyek" required>
                </div>

                <div class="form-group">
                    <label for="qr_code">Jumlah Item</label>
                    <input type="text" id="jumlah" class="form-control @error('jumlah') is-invalid @enderror" name="jumlah" value="1" placeholder="Masukkan Jumlah Item" required>
                </div>
    
                <!-- Spinner Loading -->
                <div id="spinner" style="display:none;">
                    <img src="https://www.google.com/url?sa=i&url=https%3A%2F%2Fpixabay.com%2Fgifs%2Floading-animation-spin-highlights-7528%2F&psig=AOvVaw2uYfqcgodwsqE-ww_d6qYZ&ust=1727406482491000&source=images&cd=vfe&opi=89978449&ved=0CBMQjRxqFwoTCJiL_-DQ34gDFQAAAAAdAAAAABAf" alt="Loading...">
                </div>
    
                <!-- Display -->
                <div id="location"></div>
                <div class="mb-3" id="address"></div>
                <div id="qr-reader"></div>
                <div class="mt-3" id="qr-result"></div>
    
                <div class="float-right">
                    {{-- Button Stop Scanner --}}
                    {{-- <button class="btn btn-danger mt-3" onclick="stopQrCodeScanner()">Stop Scanner</button> --}}
                    <button class="btn btn-primary mt-3" onclick="getLocationAndScanQR()">Get Location</button>
                </div>
            </div>
        </div>
    </div>
</div>
 <!-- DataTales Example -->
 <div class="card shadow mb-4">
    <div class="card border-left-primary shadow h-100 py-2">  
        <div class="card-header py-3 d-flex justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            <div>
                <a href="" class="btn btn-info btn-md"><i class="fas fa-file-pdf fa-md white-50"></i> Print PDF</a>
                <a href="" class="btn btn-success btn-md"><i class="fas fa-file-csv fa-md white-50"></i> Print Excel</a>
            </div>
        </div>
        
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name User</th>
                            <th>No Tlpn</th>
                            <th>Nama Item</th>
                            <th>Jenis</th>
                            <th>Satuan</th>
                            <th>Lokasi Item</th>
                            <th>Proyek</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($histories) > 0)
                            @foreach ($histories as $history)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $history->nama_user }}</td>
                                    <td>{{ $history->no_tlpn_user }}</td>
                                    <td>{{ $history->nama_item }}</td>
                                    <td>{{ $history->jenis_item }}</td>
                                    <td>{{ $history->satuan_item }}</td>
                                    <td>{{ $history->lokasi }}</td>
                                    <td>{{ $history->proyek }}</td>
                                    <td>{{ $history->created_at->format('d-m-Y') }}</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')

 <!-- Page level plugins -->
 <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
 <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

 <!-- Page level custom scripts -->
 <script src="{{ asset('vendor/js/demo/datatables-demo.js')}}"></script>

{{-- QrcodeScanner --}}
<script src="https://cdn.jsdelivr.net/npm/html5-qrcode@2.3.4/html5-qrcode.min.js"></script>

<!-- QR Code Scanner -->
<script>
    function getLocationAndScanQR() {
        // Tampilkan spinner
        document.getElementById("spinner").style.display = "block";

        // Dapatkan lokasi
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition((position) => {
                const latitude = position.coords.latitude;
                const longitude = position.coords.longitude;

                document.getElementById("location").innerHTML = `Latitude: ${latitude}<br>Longitude: ${longitude}`;

                // Lakukan reverse geocoding (opsional)
                reverseGeocode(latitude, longitude).then((address) => {
                    // Setelah dapat lokasi, mulai scan QR code
                    startQrCodeScanner(address);
                });
            }, showError);
        } else {
            document.getElementById("location").innerHTML = "Geolocation is not supported by this browser.";
            document.getElementById("spinner").style.display = "none"; // Sembunyikan spinner
        }
    }

    // Fungsi Reverse Geocoding
    async function reverseGeocode(lat, lon) {
        const url = `https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lon}&format=json`;

        try {
            let response = await fetch(url);
            let data = await response.json();
            const address = data.display_name;
            document.getElementById("address").innerHTML = "Address: " + address;
            return address;
        } catch (error) {
            console.log("Error with reverse geocoding: ", error);
            return null;
        }
    }

    // Fungsi untuk memulai QR code scanner
    function startQrCodeScanner(address) {
        const html5QrCode = new Html5Qrcode("qr-reader");
        html5QrCode.start(
            { facingMode: "environment" }, // Arah kamera (environment untuk kamera belakang)
            {
                fps: 10, // Kecepatan pemindaian (frame per second)
                qrbox: { width: 250, height: 250 } // Ukuran kotak QR code
            },
            (qrCodeMessage) => {
                // Hasil scan QR code
                document.getElementById("qr-result").innerHTML = `QR Code Result: ${qrCodeMessage}`;

                // Hentikan scanner setelah berhasil scan
                html5QrCode.stop();

                // Kirim data ke server (AJAX)
                saveDataToDatabase(qrCodeMessage, address);
            },
            (errorMessage) => {
                // Jika terjadi kesalahan saat scanning
                console.log(`Error scanning QR code: ${errorMessage}`);
                document.getElementById("spinner").style.display = "none"; // Sembunyikan spinner
            }
        ).catch(err => {
            // Jika terjadi kesalahan saat memulai scanner
            console.log(`Unable to start scanning: ${err}`);
            document.getElementById("spinner").style.display = "none"; // Sembunyikan spinner
        });
    }

    // Fungsi stop QR code scanner
    // function stopQrCodeScanner() {
    //     const html5QrCode = new Html5Qrcode("qr-reader");
    //     html5QrCode.stop();
    // }

    // Fungsi untuk menyimpan data ke database
    function saveDataToDatabase(qrCodeMessage, address) {
        // Ambil data dari session atau elemen HTML
        const userId = document.getElementById('user_id').value; // contoh id dari input hidden
        const namaUser = document.getElementById('nama_user').value; // contoh id dari input hidden
        const noTlpn = document.getElementById('no_tlpn').value; // contoh id dari input hidden
        const proyek = document.getElementById('proyek').value; // contoh id dari input proyek
        const jumlah = document.getElementById('jumlah').value;

        const url = "{{ route('admin.test.store') }}"; // route Laravel untuk menyimpan history

        // Tampilkan spinner
        document.getElementById("spinner").style.display = "block";

        // Kirim data menggunakan fetch
        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}' // Token CSRF untuk keamanan
            },
            body: JSON.stringify({
                id_user: userId,
                qr_code: qrCodeMessage, 
                lokasi: address,
                nama_user: namaUser,
                no_tlpn_user: noTlpn,
                proyek: proyek,
                jumlah: jumlah
            })
        })
        .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                    icon: 'success',
                    title: 'Data tersimpan',
                    text: '{{ session('success') ? session('success') : 'Data berhasil disimpan!' }}',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    window.location.reload();
                });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Data gagal disimpan',
                        text: data.message || 'Terjadi kesalahan saat menyimpan data.',
                        confirmButtonText: 'Close'
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Data gagal disimpan',
                    text: 'Terjadi kesalahan saat menyimpan data',
                    confirmButtonText: 'Close'
                });
            })
            .finally(() => {
                // Sembunyikan spinner
                document.getElementById("spinner").style.display = "none";
            });
        }

    // Penanganan Error Geolocation
    function showError(error) {
        switch (error.code) {
            case error.PERMISSION_DENIED:
                document.getElementById("location").innerHTML = "User denied the request for Geolocation.";
                break;
            case error.POSITION_UNAVAILABLE:
                document.getElementById("location").innerHTML = "Location information is unavailable.";
                break;
            case error.TIMEOUT:
                document.getElementById("location").innerHTML = "The request to get user location timed out.";
                break;
            case error.UNKNOWN_ERROR:
                document.getElementById("location").innerHTML = "An unknown error occurred.";
                break;
        }
        document.getElementById("spinner").style.display = "none"; // Sembunyikan spinner jika error
    }

</script>
@endpush