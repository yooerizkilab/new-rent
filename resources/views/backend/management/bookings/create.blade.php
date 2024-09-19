@extends('layouts.admin')

@push('css')
    
@endpush

@section('main-content')
<!-- Page Heading -->
<div class="d-flex justify-content-between align-items-center mb-2">
    <!-- Elemen H1 -->
    <h1 class="h3 text-gray-800">{{ __('Tambah Booking') }}</h1>
    
    <!-- Elemen A Href di Sebelah Kanan -->
    <a href="{{ route('admin.bookings') }}" class="btn btn-md btn-primary shadow-sm">
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
                <h6 class="m-0 font-weight-bold text-primary">Form Tambah Bookings</h6>
            </div>
            <form action="{{ route('admin.bookings.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <!-- Kolom Kiri -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="car_id">Pilih Mobil:</label>
                                <select class="form-control" id="car_id" name="car_id" required>
                                    @foreach($cars as $car)
                                        <option value="{{ $car->id }}">{{ $car->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="customer_id">Pilih Pelanggan:</label>
                                <select class="form-control" id="customer_id" name="customer_id" required>
                                    @foreach($customers as $customer)
                                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- Kolom Kanan -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="start_date">Tanggal Mulai:</label>
                                <input type="date" class="form-control" id="start_date" name="start_date" required>
                            </div>
                            <div class="form-group">
                                <label for="end_date">Tanggal Selesai:</label>
                                <input type="date" class="form-control" id="end_date" name="end_date" required>
                            </div>
                            <div class="form-group">
                                <label for="total_price">Harga Total:</label>
                                <input type="number" class="form-control" id="total_price" name="total_price" required>
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