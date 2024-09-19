@extends('layouts.admin')

@push('css')
    
@endpush

@section('main-content')

<!-- Page Heading -->
<div class="d-flex justify-content-between align-items-center mb-2">
    <!-- Elemen H1 -->
    <h1 class="h3 text-gray-800">{{ __('Mobil') }}</h1>
    
    <!-- Elemen A Href di Sebelah Kanan -->
    <a href="{{ route('admin.cars.create') }}" class="btn btn-md btn-primary shadow-sm">
        <i class="fas fa-pencil-square fa-md text-white-50"></i> Tambah
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

 <!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card border-left-primary shadow h-100 py-2">  
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            <form action="" method="get">
                <input type="text" name="q" class="form-control" placeholder="Cari data...">
            </form>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Brand</th>
                            <th>Model</th>
                            <th>Year</th>
                            <th>Color</th>
                            <th>License Plate</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cars as $car)
                        <tr>
                            <td>{{ $car->id }}</td>
                            <td>{{ $car->brand }}</td>
                            <td>{{ $car->model }}</td>
                            <td>{{ $car->year }}</td>
                            <td>{{ $car->color }}</td>
                            <td>{{ $car->license_plate }}</td>
                            <td>{{ $car->status }}</td>
                            <td>
                                <a href="{{ route('admin.cars.show', $car) }}" class="btn btn-info">View</a>
                                <a href="{{ route('admin.cars.edit', $car) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('admin.cars.destroy', $car) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{-- <div class="float-right">
                {!! $cars->links() !!}
            </div> --}}
        </div>
    </div>
</div>
@endsection

@push('script')
    
@endpush