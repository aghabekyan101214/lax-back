@extends('layouts.app')

@section('content')
    <style>
        .d-none{
            display: none;
        }
    </style>
   <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <h3 class="box-title">{{$title}}</h3>
{{--                <a href="{{$route."/create"}}" class="btn btn-success m-b-30"><i class="fas fa-plus"></i> Add New {{ $title }}</a>--}}

                {{--table--}}
                <div class="table-responsive">
                    <table id="datatable" class="display table table-hover table-striped nowrap" cellspacing="0"
                           width="100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Make</th>
                                <th>Models</th>
                                <th>Settings</th>
                            </tr>
                        </thead>

                        <tbody>
                        @foreach($data as $key => $val)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td>{{ $val->Make_Name }}</td>
                                <td>
                                    <ul>
                                        @foreach($val->models as $model)
                                            <li>{{ $model->Model_Name }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>
                                    <a href="{{$route."/".$val->Make_ID."/edit"}}" data-toggle="tooltip"
                                       data-placement="top" title="Edit" class="btn btn-info btn-circle tooltip-info">
                                        <i class="fas fa-edit"></i>
                                    </a>

{{--                                    <form style="display: inline-block" action="{{ $route."/".$val->id }}"--}}
{{--                                          method="post" id="work-for-form">--}}
{{--                                        @csrf--}}
{{--                                        @method("DELETE")--}}
{{--                                        <a href="javascript:void(0);" data-text="make" class="delForm" data-id ="{{$val->id}}">--}}
{{--                                            <button data-toggle="tooltip"--}}
{{--                                                    data-placement="top" title="Remove"--}}
{{--                                                    class="btn btn-danger btn-circle tooltip-danger"><i--}}
{{--                                                    class="fas fa-trash"></i></button>--}}
{{--                                        </a>--}}
{{--                                    </form>--}}
{{--                                    <button onclick="changeStatus('{{ $val->id }}', $(this))" data-toggle="tooltip" data-placement="top" title="Change Status" class="btn btn-info btn-circle tooltip-info">--}}
{{--                                        <i class="fas fa-toggle-on"></i>--}}
{{--                                    </button>--}}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('head')
    <!--This is a datatable style -->
    <link href="{{asset('assets/plugins/datatables/media/css/dataTables.bootstrap.css')}}" rel="stylesheet"
          type="text/css"/>

    <style>
        .swal-modal {
            width: 660px !important;
        }
    </style>
@endpush

@push('foot')
    <!--Datatable js-->
    <script src="{{asset('assets/plugins/datatables/datatables.min.js')}}"></script>

    <script src="{{asset('assets/plugins/swal/sweetalert.min.js')}}"></script>
    <script>
        $('#datatable').DataTable({
            "order": []
        });
        changeStatus= (id, self) => {
            $.post( "/makes/change-status/" + id, function( data ) {
                if(data == 1) {
                    self.parentsUntil("tbody").find("span.badge.badge-success").show();
                    self.parentsUntil("tbody").find("span.badge.badge-danger").hide();
                } else {
                    self.parentsUntil("tbody").find("span.badge.badge-success").hide();
                    self.parentsUntil("tbody").find("span.badge.badge-danger").show();
                }
            });
        };
    </script>
@endpush



