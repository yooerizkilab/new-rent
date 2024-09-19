@extends('layouts.admin')

@push('css')
<!-- Select2 CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
@endpush

@section('main-content')
<!-- Page Heading -->
<div class="d-flex justify-content-between align-items-center mb-2">
    <!-- Elemen H1 -->
    <h1 class="h3 text-gray-800">{{ __('Tambah Mobil') }}</h1>
    
    <!-- Elemen A Href di Sebelah Kanan -->
    <a href="{{ route('admin.cars') }}" class="btn btn-md btn-primary shadow-sm">
        <i class="fas fa-share fa-md text-white-50"></i> Kembali
    </a>
</div>

<p class="mb-4">
    DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the 
    <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.
</p>

@if (session('success'))
    <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger border-left-danger" role="alert">
        <ul class="pl-4 my-2">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4 border-left-primary">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Form Tambah Data</h6>
            </div>
            <form action="{{ route('admin.cars.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <!-- Kolom Kiri -->
                        <div class="col-md-6">
                            <!-- Car Brand -->
                            <div class="form-group">
                                <label for="brand">Merk Mobil</label>
                                <input type="text" class="form-control" id="brand" name="brand" placeholder="Masukkan merk mobil" required>
                            </div>

                            <!-- Car Model -->
                            <div class="form-group">
                                <label for="model">Model Mobil</label>
                                <input type="text" class="form-control" id="model" name="model" placeholder="Masukkan model mobil" required>
                            </div>

                            <!-- License Plate -->
                            <div class="form-group">
                                <label for="license_plate">Plat Nomor</label>
                                <input type="text" class="form-control" id="license_plate" name="license_plate" placeholder="Masukkan plat nomor" required>
                            </div>

                            <!-- Year -->
                            <div class="form-group">
                                <label for="year">Tahun</label>
                                <input type="number" class="form-control" id="year" name="year" placeholder="Masukkan tahun pembuatan mobil" required>
                            </div>

                            <!-- Color -->
                            <div class="form-group">
                                <label for="color">Warna</label>
                                <input type="text" class="form-control" id="color" name="color" placeholder="Masukkan warna mobil" required>
                            </div>

                            <!-- Transmission -->
                            <div class="form-group">
                                <label for="transmission">Transmisi</label>
                                <select class="form-control" id="transmission" name="transmission" required>
                                    <option value="manual">Manual</option>
                                    <option value="automatic">Automatic</option>
                                </select>
                            </div>

                            <!-- Fuel Type -->
                            <div class="form-group">
                                <label for="fuel">Bahan Bakar</label>
                                <select class="form-control" id="fuel" name="fuel" required>
                                    <option value="petrol">Bensin</option>
                                    <option value="diesel">Diesel</option>
                                    <option value="electric">Listrik</option>
                                </select>
                            </div>

                            <!-- Mileage -->
                            <div class="form-group">
                                <label for="mileage">Kilometer</label>
                                <input type="text" class="form-control" id="mileage" name="mileage" placeholder="Masukkan jarak tempuh mobil" required>
                            </div>

                            <!-- Baggage Capacity -->
                            <div class="form-group">
                                <label for="baggage">Kapasitas Bagasi</label>
                                <input type="text" class="form-control" id="baggage" name="baggage" placeholder="Masukkan kapasitas bagasi" required>
                            </div>

                            <!-- Seating Capacity -->
                            <div class="form-group">
                                <label for="seat">Kapasitas Kursi</label>
                                <input type="text" class="form-control" id="seat" name="seat" placeholder="Masukkan kapasitas kursi" required>
                            </div>
                        </div>
                        <!-- Kolom Kanan -->
                        <div class="col-md-6">
                            <!-- Features with Select2 -->
                            <div class="form-group">
                                <label for="feature">Fitur</label>
                                <select class="form-control select2" id="feature" name="feature[]" multiple="multiple" required>
                                    <option value="AC">AC</option>
                                    <option value="GPS">GPS</option>
                                    <option value="Airbag">Airbag</option>
                                    <option value="Bluetooth">Bluetooth</option>
                                    <option value="Sunroof">Sunroof</option>
                                    <!-- Add more options as needed -->
                                </select>
                            </div>

                            <!-- Description -->
                            <div class="form-group">
                                <label for="description">Deskripsi</label>
                                <textarea class="form-control" id="description" name="description" rows="6" placeholder="Masukkan deskripsi mobil"></textarea>
                            </div>

                            <!-- Car Image -->
                            <div class="form-group">
                                <label for="image">Gambar Mobil</label>
                                <input type="file" class="form-control-file" id="image" name="image" accept="image/*">
                            </div>

                            <!-- Status -->
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control" id="status" name="status" required>
                                    <option value="available">Tersedia</option>
                                    <option value="rented">Disewa</option>
                                    <option value="maintenance">Perawatan</option>
                                </select>
                            </div>

                            <!-- Daily Rate -->
                            <div class="form-group">
                                <label for="daily_rate">Tarif Harian</label>
                                <input type="number" class="form-control" id="daily_rate" name="daily_rate" placeholder="Masukkan tarif harian" step="0.01" required>
                            </div>

                            <!-- Weekly Rate -->
                            <div class="form-group">
                                <label for="weekly_rate">Tarif Mingguan</label>
                                <input type="number" class="form-control" id="weekly_rate" name="weekly_rate" placeholder="Masukkan tarif mingguan" step="0.01" required>
                            </div>

                            <!-- Monthly Rate -->
                            <div class="form-group">
                                <label for="monthly_rate">Tarif Bulanan</label>
                                <input type="number" class="form-control" id="monthly_rate" name="monthly_rate" placeholder="Masukkan tarif bulanan" step="0.01" required>
                            </div>

                            <!-- Penalty Rate Per Day -->
                            <div class="form-group">
                                <label for="penalty_rate_per_day">Tarif Denda Per Hari</label>
                                <input type="number" class="form-control" id="penalty_rate_per_day" name="penalty_rate_per_day" placeholder="Masukkan tarif denda per hari" step="0.01" required>
                            </div>
                        </div>
                    </div>
            
                    <!-- Tombol Submit -->
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary mt-2">
                            <i class="fas fa-paper-plane"></i> Submit
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<!-- Select2 JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        // Initialize Select2
        $('.select2').select2({
            placeholder: "Pilih fitur mobil",
            allowClear: true
        });
    });
</script>
@endpush