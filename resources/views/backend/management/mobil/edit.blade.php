@extends('layouts.admin')

@push('css')
    
@endpush

@section('main-content')
<!-- Page Heading -->
<div class="d-flex justify-content-between align-items-center mb-2">
    <!-- Elemen H1 -->
    <h1 class="h3 text-gray-800">{{ __('Ubah Mobil') }}</h1>
    
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
            <form action="{{ route('admin.cars.update', $car) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">
                        <!-- Kolom Kiri -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="brand">Brand</label>
                                <input type="text" id="brand" name="brand" class="form-control" value="{{ $car->brand }}" required>
                            </div>
                            <div class="form-group">
                                <label for="model">Model</label>
                                <input type="text" id="model" name="model" class="form-control" value="{{ $car->model }}" required>
                            </div>
                            <div class="form-group">
                                <label for="year">Year</label>
                                <input type="number" id="year" name="year" class="form-control" value="{{ $car->year }}" required>
                            </div>
                            <div class="form-group">
                                <label for="color">Color</label>
                                <input type="text" id="color" name="color" class="form-control" value="{{ $car->color }}" required>
                            </div>
                        </div>
                        <!-- Kolom Kanan -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="license_plate">License Plate</label>
                                <input type="text" id="license_plate" name="license_plate" class="form-control" value="{{ $car->license_plate }}" required>
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select id="status" name="status" class="form-control" required>
                                    <option value="available" {{ $car->status == 'available' ? 'selected' : '' }}>Available</option>
                                    <option value="rented" {{ $car->status == 'rented' ? 'selected' : '' }}>Rented</option>
                                    <option value="maintenance" {{ $car->status == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                                </select>
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

@push('script')
    
@endpush