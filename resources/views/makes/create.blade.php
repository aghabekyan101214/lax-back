@extends('layouts.app')

@section('content')
    <style>
        hr{
            border-color: #0e6185;
        }
    </style>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">{{$title}}</div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        <form method="post" action="{{ $route .(isset($make->id) ? "/$make->id" : "") }}" enctype="multipart/form-data">
                            @csrf
                            @if(isset($make->id))
                                @method("PUT")
                            @endif

                            <div class="form-group">
                                <label for="price">Make</label>
                                @error('Make_Name')
                                <p class="invalid-feedback text-danger" role="alert"><strong>{{ $message }}</strong></p>
                                @enderror
                                <input type="text" required name="Make_Name" class="form-control" value="{{ $make->Make_Name ?? "" }}">
                            </div>

                            <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('head')
        <link rel="stylesheet" href="{{ asset("assets/plugins/select2/dist/css/select2.css") }}">
        <link rel="stylesheet" href="{{ asset("assets/plugins/datepicker/bootstrap-datepicker.min.css") }}">
    @endpush
    @push('foot')
        <script src="{{ asset("assets/plugins/select2/dist/js/select2.js") }}"></script>
        <script src="{{ asset("assets/plugins/datepicker/bootstrap-datepicker.min.js") }}"></script>
        <script>

            $(document).ready(function () {
                $(".select2").select2();

            });

        </script>
    @endpush
@endsection
