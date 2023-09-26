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
    <form action="" method="POST">
        {{ csrf_field() }}
        <div class="card-body">
            <div class="form-group">
                <label>Name</label>
                <input type="name" class="form-control" name="name" value="{{ old('name') }}" placeholder="Name">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" value="{{ old('email') }}" name="email" placeholder="Email">
                <div class="alert-danger">{{ $errors->first('email') }}</div>
            </div>

        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
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
                            <div style="text-align: right"><a href="{{ url('admin/admin/add') }}"
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
                                        <th>Email</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($users as $usersList)
                                        <tr>
                                            <td>{{ $usersList->id }}</td>
                                            <td>{{ $usersList->name }}</td>
                                            <td>{{ $usersList->email }}</td>
                                            <td>{{ $usersList->created_at }}</td>
                                            <td><a href="{{ url('admin/admin/' . $usersList->id . '/edit') }}"
                                                    class="btn btn-success">Edit</a>
                                                <a href="{{ url('admin/admin/' . $usersList->id . '/delete') }}"
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
                                {{ $users->links() }}

                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
