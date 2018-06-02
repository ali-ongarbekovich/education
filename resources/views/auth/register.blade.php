@extends('layouts.app')

@section('content')
<div class="col-lg-8 col-md-8">



    <!-- POST -->
    <div class="post">
        <form action="#" class="form newtopic" method="post">
            <div class="postinfotop">
                <h2>Create New Account</h2>
            </div>

            <!-- acc section -->
            <div class="accsection">
                <div class="acccap">
                    <div class="userinfo pull-left">&nbsp;</div>
                    <div class="posttext pull-left"><h3>Required Fields</h3></div>
                    <div class="clearfix"></div>
                </div>
                <div class="topwrap">
                    <div class="userinfo pull-left">
                        <div class="avatar">
                            <img src="images/avatar-blank.jpg" alt="" />
                            <div class="status green">&nbsp;</div>
                        </div>
                        <div class="imgsize">60 x 60</div>
                        <div>
                            <button class="btn">Add</button>
                        </div>
                    </div>
                    <div class="posttext pull-left">
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <input type="text" placeholder="{{ __('Name') }}" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <input type="text" placeholder="{{ __('E-Mail Address') }}" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus/>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <input type="password" placeholder="{{ __('Password') }}" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required id="pass" name="pass" />
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <input type="password" placeholder="{{ __('Confirm Password') }}" class="form-control" id="pass2" required name="password_confirmation"/>
                            </div>
                            @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>

                    </div>
                    <div class="clearfix"></div>
                </div>
            </div><!-- acc section END -->

            <div class="postinfobot">

                <div class="notechbox pull-left">
                    <input type="checkbox" name="note" id="note" class="form-control" />
                </div>

                <div class="pull-left lblfch">
                    <label for="note"> I agree with the Terms and Conditions of this site</label>
                </div>

                <div class="pull-right postreply">
                    <div class="pull-left smile"><a href="04_new_account.html#"><i class="fa fa-smile-o"></i></a></div>
                    <div class="pull-left"><button type="submit" class="btn btn-primary">{{ __('Register') }}</button></div>
                    <div class="clearfix"></div>
                </div>


                <div class="clearfix"></div>
            </div>
        </form>
    </div><!-- POST -->

</div>
@endsection
