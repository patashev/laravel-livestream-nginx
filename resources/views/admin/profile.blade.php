@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <img src="{{ profile_image() }}" class="img-circle" alt="User Image" style="width: 40px;">
                        <span>Update Profile</span>
                    </h3>
                </div>

                <div class="box-body">

                    @include('admin.partials.info')

                    <form method="POST" action="{{ $selectedNavigation->url . "/" . user()->id }}" accept-charset="UTF-8" enctype="multipart/form-data">
                        <input name="_token" type="hidden" value="{{ csrf_token() }}">
                        <input name="_method" type="hidden" value="PUT">

                        <fieldset>

                                <div class="col-md-6">
                                    <div class="form-group {{ form_error_class('firstname', $errors) }}">
                                        <label for="firstname">Firstname</label>
                                        <div class="input-group">
                                            <input type="text" name="firstname" class="form-control" placeholder="Firstname" value="{{ ($errors->any()? old('firstname') : user()->firstname) }}">
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        </div>
                                        {!! form_error_message('firstname', $errors) !!}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group {{ form_error_class('lastname', $errors) }}">
                                        <label for="email">Lastname</label>
                                        <div class="input-group">
                                            <input type="text" name="lastname" class="form-control" placeholder="Lastname" value="{{ ($errors->any()? old('lastname') : user()->lastname) }}">
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        </div>
                                        {!! form_error_message('lastname', $errors) !!}
                                    </div>
                                </div>



                                <div class="col-md-6">
                                    <div class="form-group {{ form_error_class('cellphone', $errors) }}">
                                        <label for="cellphone">Cellphone</label>
                                        <input type="text" class="form-control" id="cellphone" name="cellphone" placeholder="Please insert the Cellphone" value="{{ ($errors && $errors->any()? old('cellphone') : user()->cellphone ) }}">
                                        {!! form_error_message('cellphone', $errors) !!}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group {{ form_error_class('telephone', $errors) }}">
                                        <label for="telephone">Telephone</label>
                                        <input type="text" class="form-control" id="telephone" name="telephone" placeholder="Please insert the Telephone" value="{{ ($errors && $errors->any()? old('telephone') : user()->telephone ) }}">
                                        {!! form_error_message('telephone', $errors) !!}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <section class="form-group {{ form_error_class('email', $errors) }}">
                                        <label for="email">Email Address (readonly)</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="email" name="email" placeholder="Email Address" value="{{ ($errors->any()? old('email') : user()->email) }}" readonly>
                                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                        </div>
                                        {!! form_error_message('email', $errors) !!}
                                    </section>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group {{ form_error_class('password', $errors) }}">
                                        <label for="password">Password <small> (leave blank to keep it unchanged)</small></label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="" >
                                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                        </div>
                                        {!! form_error_message('password', $errors) !!}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group {{ form_error_class('born_at', $errors) }}">
                                        <label for="password">Date of Birth</label>
                                        <div class="input-group">
                                            <input id="born_at" type="text" class="form-control" name="born_at" placeholder="Select your birth date" value="{{ ($errors->any()? old('born_at') : user()->born_at) }}">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        </div>
                                        {!! form_error_message('born_at', $errors) !!}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group {{ form_error_class('password_confirmation', $errors) }}">
                                        <label>Confirm Password</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="id-password_confirmation" name="password_confirmation" placeholder="Password Confirm" value="{{ ($errors->any()? old('password_confirmation') : user()->password_confirmation) }}">
                                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                        </div>
                                        {!! form_error_message('password_confirmation', $errors) !!}
                                    </div>
                                </div>



                                <div class="col-md-6">
                                    <section class="form-group {{ form_error_class('stream_key', $errors) }}">
                                        <label for="stream_key">Stream Key (readonly)</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="stream_key" name="stream_key" placeholder="Stream Key" value="{{ ($errors->any()? old('stream_key') : user()->stream_key) }}" readonly>
                                            <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                        </div>
                                        {!! form_error_message('stream_key', $errors) !!}
                                    </section>
                                </div>

                                <div class="col-md-6">
                                    <section class="form-group {{ form_error_class('api_key', $errors) }}">
                                        <label for="api_key">Api Key (readonly)</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="api_key" name="api_key" placeholder="Api Key" value="{{ ($errors->any()? old('api_key') : user()->api_key) }}" readonly>
                                            <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                        </div>
                                        {!! form_error_message('api_key', $errors) !!}
                                    </section>
                                </div>

                                <div class="col-md-6">
                                    <label for="api_key">Gender</label>
                                    <div class="form-check">
                                     <label class="form-check-label">
                                       <span><i></i>Male</span>
                                       <input type="radio" name="gender" value="male" {{ ($errors->any() && old('gender') == 'male'? 'checked="checked"' : user()->gender == 'male'? 'checked="checked"':'') }}>
                                     </label>
                                    </div>
                                    <div class="form-check">
                                     <label class="form-check-label">
                                       <span><i></i>Female</span>
                                       <input type="radio" name="gender" value="female" {{ ($errors->any() && old('gender') == 'female'? 'checked="checked"' : user()->gender == 'female'? 'checked="checked"':'') }}>
                                     </label>
                                     {!! form_error_message('gender', $errors) !!}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                  <section class="form-group {{ form_error_class('photo', $errors) }}">
                                      <label>Profile image (250 x 250)</label>
                                      <div class="input-group">
                                          <input id="photo-label" type="text" class="form-control" readonly placeholder="Browse for an image">
                                          <span class="input-group-btn">
                                        <button type="button" class="btn btn-default" onclick="document.getElementById('photo').click();">Browse</button>
                                      </span>
                                          <input id="photo" style="display: none" accept="{{ get_file_extensions('image') }}" type="file" name="photo" onchange="document.getElementById('photo-label').value = this.value">
                                      </div>
                                      {!! form_error_message('photo', $errors) !!}
                                  </section>

                                @if(user()->image)
                                      <section>
                                          <img src="{{ profile_image() }}" style="max-height: 230px !important;">
                                          <input type="hidden" name="image" value="{{ user()->image }}">
                                      </section>
                                @endif
                              </div>
                        </fieldset>
                        <br>
                        <div class="col-md-12">
                          @include('admin.partials.form_footer')
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    <script type="text/javascript" charset="utf-8">
        $(function ()
        {
            $("#born_at").datetimepicker({
                viewMode: 'years',
                format: 'YYYY-MM-DD'
            });
        })
    </script>
@endsection
