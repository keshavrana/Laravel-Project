@extends('layout.layout')
@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div>
                        <h4 class="text-center header-title">Add User</h4>
                        <form action="#" class="parsley-examples" data-parsley-validate novalidate>
                            <div class="form-group">
                                <label for="userName">User Name<span class="text-danger">*</span></label>
                                <input type="text" name="nick" parsley-trigger="change" required placeholder="Enter user name"
                                    class="form-control" id="userName">
                            </div>
                            <div class="form-group">
                                <label for="emailAddress">Email address<span class="text-danger">*</span></label>
                                <input type="email" name="email" parsley-trigger="change" required placeholder="Enter email"
                                    class="form-control" id="emailAddress">
                            </div>
                            <div class="form-group">
                                <label for="pass1">Password<span class="text-danger">*</span></label>
                                <input id="pass1" type="password" placeholder="Password" required class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="passWord2">Confirm Password <span class="text-danger">*</span></label>
                                <input data-parsley-equalto="#pass1" type="password" required placeholder="Password"
                                    class="form-control" id="passWord2">
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
        
                        </form>
                    </div>
                </div>
            </div>
            

        </div>

    </div>
    <!-- end row -->
@endsection
