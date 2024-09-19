@extends('layouts.admin')

@push('css')

@endpush

@section('main-content')

<!-- Page Heading -->
<div class="d-flex justify-content-between align-items-center mb-2">
    <!-- Elemen H1 -->
    <h1 class="h3 text-gray-800">{{ __('Permissions') }}</h1>
    
   <!-- Elemen A Href di Sebelah Kanan -->
   <a href="{{ route('settings.permissions.create') }}" class="btn btn-md btn-primary shadow-sm">
    <i class="fas fa-pencil-square fa-md text-white-50"></i> Tambah
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
                            <th>Name</th>
                            <th>Guard Name</th>
                            <th>Join Date</th>
                            <th width="20%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permissions as $permission)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $permission->name }}</td>
                            <td>{{ $permission->guard_name }}</td>
                            <td>{{ $permission->created_at->format('d M Y') }}</td>
                            <td width="">
                                <a href="{{ route('settings.permissions.edit', $permission->id) }}" class="btn btn-warning btn-icon-split">
                                    <span class="text">Edit</span>
                                    <span class="icon text-white-50">
                                        <i class="fas fa-pen"></i>
                                    </span>
                                </a>
                                <form id="deleteForm-{{ $permission->id }}" action="{{ route('settings.permissions.destroy', $permission->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-icon-split" onclick="confirmDelete({{ $permission->id }})">
                                        <span class="text">Delet</span>
                                        <span class="icon text-white-50">
                                            <i class="fas fa-trash"></i>
                                        </span>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="float-right">
                   {{ $permissions->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function confirmDelete(permissionId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Jika konfirmasi, submit form
                document.getElementById('deleteForm-' + permissionId).submit();
            }
        })
    }
</script>
@endpush