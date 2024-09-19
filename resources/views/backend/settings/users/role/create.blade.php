@extends('layouts.admin')

@push('css')

@endpush

@section('main-content')

<!-- Page Heading -->
<div class="d-flex justify-content-between align-items-center mb-2">
    <!-- Elemen H1 -->
    <h1 class="h3 text-gray-800">{{ __('Tambah Roles') }}</h1>
    
    <!-- Elemen A Href di Sebelah Kanan -->
    <a href="{{ route('settings.roles') }}" class="btn btn-md btn-primary shadow-sm">
        <i class="fas fa-share fa-md text-white-50"></i> kembali
    </a>
</div>

<p class="mb-4">
    DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the 
    <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.
</p>

 <!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card border-left-primary shadow h-100 py-2">  
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('settings.roles.store') }}" method="POST">
                @csrf
                <!-- Name -->
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                 <!-- Guard Name -->
                 <div class="mb-3">
                    <label for="guard_name" class="form-label">Guard Name</label>
                    <select class="form-control @error('guard_name') is-invalid @enderror" id="guard_name" name="guard_name" required>
                        <option value="" disabled selected>Select Guard Name</option>
                        <option value="web" {{ old('guard_name') == 'web' ? 'selected' : '' }}>Web</option>
                        <option value="api" {{ old('guard_name') == 'api' ? 'selected' : '' }}>API</option>
                    </select>
                    @error('guard_name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <!-- Submit Button -->
                <div class="card-footer d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>         
        </div>         
    </div>
</div>
@endsection

@push('script')

@endpush