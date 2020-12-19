@extends('layouts.app')

@section('content')

    <div class="container mt-5">
        <div class="card">
            <div class="card-header">{{ __('Users List') }}
                <div class="pull-right">
                    <a href="{{ route('users.create') }}" class="btn btn-primary">
                        Add New User</a>

                </div>
            </div>

            <div class="card-body">
                <table class="table table-bordered yajra-datatable">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->role->name}}</td>
                        <td> <a href="{{route('users.show',$user->id)}}" class="btn btn-primary" title="View Users details">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a href="{{route('users.edit',$user->id)}}" class="btn btn-secondary" title="Edit Users details">
                                <i class="fa fa-pencil"></i></a>
                                <button id="deleteUser" value="{{$user->id}}"  class="btn btn-danger" title="Delete Users">
                                    <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <script type="text/javascript">
        jQuery(document).ready(function () {

            var table = $('.yajra-datatable').DataTable({

            });
            var ref = null;
            $("body").on('click', '#deleteUser', function (e) {

                e.preventDefault();
                var $this = this;
                ref = this;
                var id = jQuery($this).val();

                var deleted = confirm("You want to delete?");
                if (deleted) {
                    console.log(id);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    jQuery.ajax
                    ({
                        type: 'DELETE',
                        url: 'users/' + id,
                        success: function (response, textStatus) {
                            console.log(response.message);
                            jQuery(ref).parent('td').parent('tr').remove();
                            location.reload();
                            toastr.success(response.message);

                        },
                        error: function (err) {
                            let error = JSON.parse(err.responseText);
                            console.log(error.message);
                        }
                    });
                }
            });
        });
    </script>
@endpush
