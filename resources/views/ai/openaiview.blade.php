@extends('layout.layout')
@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div>
                        <h4 class="text-center header-title"></h4>
                        <form action="/airesult" method="POST" class="parsley-examples" data-parsley-validate novalidate>
                            @csrf
                            <div class="form-group">
                                <label for="userName">Enter The Topic Name And AI Gives You Answer<span class="text-danger">*</span></label>
                                <input type="text" name="topic" @isset($topic) value="{{$topic}}" @endisset required parsley-trigger="change" required
                                    placeholder="Enter Topic Name" autocomplete="off" class="form-control" id="userName">
                            </div>
                            <div class="form-group text-right mb-0">
                                <button class="btn btn-primary waves-effect waves-light mr-1" type="submit">
                                    Request
                                </button>
                                <button type="reset" class="btn btn-secondary waves-effect">
                                    Cancel
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h3>Output By AI</h3>
                    @if (isset($data))
                    <div style="white-space:pre-line">{{$data}}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
@endsection
