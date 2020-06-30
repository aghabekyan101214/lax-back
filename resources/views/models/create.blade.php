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
                <div class="panel-heading">Manage {{ $title }} For <b>{{ $make->Make_Name }}</b> </div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        <form method="post" action="{{ $route .(isset($make->Make_ID) ? "/$make->Make_ID" : "") }}" enctype="multipart/form-data">
                            @csrf
                            @if(isset($make->id))
                                @method("PUT")
                            @endif
                            <input type="hidden" name="make_id" value="{{ $make->Make_ID ?? "" }}">
                            <div class="form-group">
                                <label for="price">Manage Models</label>
                                @error('models')
                                <p class="invalid-feedback text-danger" role="alert"><strong>{{ $message }}</strong></p>
                                @enderror
                                <select class="select2 form-control" name="models[]" multiple>
                                    @foreach($models as $model)
                                        <option @if(in_array($model->Model_ID, $modelIds)) selected @endif value="{{ $model->Model_ID }}">{{ $model->Model_Name }}</option>
                                    @endforeach
                                </select>
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
