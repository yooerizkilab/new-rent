@extends('layouts.admin')

@push('css')
    
@endpush

@section('main-content')
<!-- Page Heading -->
<div class="d-flex justify-content-between align-items-center mb-2">
    <!-- Elemen H1 -->
    <h1 class="h3 text-gray-800">{{ __('Detail Mobil') }}</h1>
    
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
            <div class="card-body">
                <div class="row">
                   {{ $car->model }}
                    <br>
                   {{ $car->brand }}
                    <br>
                   {{ $car->year }}
                    <br>
                   {{ $car->color }}
                    <br>
                   {{ $car->transmission }}
                    <br>
                   {{ $car->fuel }}
                   <br>
                   {{ $car->mileage }}
                   <br>
                   {{ $car->baggage }}
                   <br>
                   {{ $car->seat }}
                   <br>
                   {{ $car->feature }}
                   <br>
                   {{ $car->license_plate }}
                   <br>
                   {{ $car->description }}
                   <br>
                   {{ $car->image }}
                   <br>
                   {{ $car->status }}
                   <br>
                   {{ $car->daily_rate }}
                   <br>
                   {{ $car->weekly_rate }}
                   <br>
                   {{ $car->monthly_rate }}
                   <br>
                   {{ $car->penalty_rate_per_day }}
                </div>
                <!-- Tombol Submit -->
                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.cars.edit', $car) }}" type="submit" class="btn btn-primary mt-2">
                        <i class="fas fa-pencil"></i> Ubah
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('script')
    
@endpush