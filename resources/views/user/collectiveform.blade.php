@extends('layout.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div>
                        <h4 class="text-center header-title">Collective HTML Form</h4>
                            {!! Form::open(['url' => '/addcollective','method'=>'POST', 'class'=>'parsley-examples']) !!}
                            <div class="form-group">
                                {!! Form::label('userName', 'UserName',['class'=>'text-success']); !!}
                                {!! Form::text('name', '',['parsley-trigger'=>'change','required'=>'','placeholder'=>'Enter User Name','class'=>'form-control','id'=>'userName']); !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('userName', 'Email ID',['class'=>'text-success']); !!}
                                {!! Form::email('email', '',['parsley-trigger'=>'change','required'=>'','placeholder'=>'Enter Email Addess','class'=>'form-control','id'=>'email']); !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('userPassword', 'Password',['class'=>'text-success']); !!}
                                {!! Form::password('password',['parsley-trigger'=>'change','required'=>'','placeholder'=>'Enter Password','class'=>'form-control','id'=>'password']); !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('userName', 'Confirm Password',['class'=>'text-success']); !!}
                                {!! Form::password('confirm_password',['parsley-trigger'=>'change','required'=>'','placeholder'=>'Enter Password Again','class'=>'form-control','id'=>'password']); !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('userName', 'Select Country',['class'=>'text-success']); !!}
                                {!! Form::select('size',['L' => 'Large', 'S' => 'Small'],'null',['parsley-trigger'=>'change','required'=>'','class'=>'form-control','id'=>'country']); !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('userName', 'Select Quantity',['class'=>'text-success']); !!}
                                {!! Form::selectRange('number', 10, 20); !!}
                            </div>
                            <div class="form-group">
                                <div class="checkbox">
                                    <input id="remember-1" type="checkbox">
                                    <label for="remember-1"> Remember me </label>
                                </div>
                            </div>
                            <div class="form-group text-right mb-0">
                                <button class="btn btn-primary waves-effect waves-light mr-1" type="submit">
                                    Submit
                                </button>
                                <button type="reset" class="btn btn-secondary waves-effect">
                                    Cancel
                                </button>
                            </div>

                            {!! Form::close() !!}
                    </div>
                </div>
            </div>


        </div>

    </div>
    <!-- end row -->
@endsection
