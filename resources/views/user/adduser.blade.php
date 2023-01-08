@extends('layout.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                @php
                    if(empty($user->name) || empty($user->email)){
                        $name = "";
                        $email = "";
                    }
                    else{
                       $name = $user->name;
                       $email = $user->email;
                    }
                @endphp
                <div class="card-body">
                    <div>
                        <h4 class="text-center header-title">{{$label}}</h4>
                        <form action="{{$url}}" method="POST" class="parsley-examples" data-parsley-validate novalidate>
                           @csrf
                            <x-input type="text" name="name" label="User Name" :value="$name" />
                            <x-input type="email" name="email" label="Email" :value="$email" />
                            <x-input type="password" name="password" label="Password" />
                            <x-input type="password" name="password_confirmation" label="Confirm Password" />
                            <div class="form-group text-right mb-0">
                                <button class="btn btn-primary waves-effect waves-light mr-1" type="submit">
                                    Submit
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
    <!-- end row -->
@endsection
