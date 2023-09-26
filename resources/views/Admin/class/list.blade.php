@extends('layouts/app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>List of Admin</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <form action="" method="GET">
        <div class="row">
            <div class="col-md-3">
                <label>Filter by Date</label>
                <input type="text" name="name" value="{{ Request::get('name') }}" class="form-control">
            </div>
            <div class="col-md-3">
                <label>Filter by Date</label>
                <input type="date" name="date" value="{{ Request::get('date') ?? date('Y-m-d') }}"
                    class="form-control">
            </div>
            <div class="col-md-6">
                <br />
                <button type="submit" class="btn btn-sm text-white btn-primary">Filter</button>
            </div>
        </div>
    </form>
    <main>
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Admin List</h3>
                            <div style="text-align: right"><a href="{{ url('admin/class/add') }}"
                                    class="btn btn-success text-white btn-sm">
                                    Add New Admin
                                </a>
                            </div>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        {{-- <th>Create by</th> --}}
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($classs as $classItem)
                                        <tr>
                                            <td>{{ $classItem->id }}</td>
                                            <td>{{ $classItem->name }}</td>
                                            @if ($classItem->status == 0)
                                                <td>Acteve</td>
                                            @else
                                                <td>Incolme</td>
                                            @endif
                                            {{-- <td>{{ $classItem->user->name }}</td> --}}
                                            <td>{{ $classItem->created_at->format('d-m-Y') }}</td>
                                            <td><a href="{{ url('admin/class/' . $classItem->id . '/edit') }}"
                                                    class="btn btn-success">Edit</a>
                                                <a href="{{ url('admin/class/' . $classItem->id . '/delete') }}"
                                                    class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <div>
                                            "No Items found"
                                        </div>
                                    @endforelse
                                </tbody>
                            </table>
                            <div style="float:right">
                                {{ $classs->links() }}

                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
