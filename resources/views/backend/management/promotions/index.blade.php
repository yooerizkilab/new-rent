@extends('layouts.admin')

@push('css')
    
@endpush

@section('main-content')

<!-- Page Heading -->
<div class="d-flex justify-content-between align-items-center mb-2">
    <!-- Elemen H1 -->
    <h1 class="h3 text-gray-800">{{ __('Promotion') }}</h1>
    
    <!-- Elemen A Href di Sebelah Kanan -->
    <a href="{{ route('admin.promotions.create') }}" class="btn btn-md btn-primary shadow-sm">
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
                            <th>Title</th>
                            <th>Discount</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($promotions as $promotion)
                        <tr>
                            <td>{{ $promotion->code }}</td>
                            <td>{{ $promotion->discount_percentage }}%</td>
                            <td>{{ $promotion->start_date }}</td>
                            <td>{{ $promotion->end_date }}</td>
                            <td>{{ $promotion->status }}</td>
                            <td>
                                <a href="{{ route('admin.promotions.edit', $promotion) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('admin.promotions.destroy', $promotion) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                                <a href="{{ route('admin.promotions.show', $promotion) }}" class="btn btn-info">View</a>
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