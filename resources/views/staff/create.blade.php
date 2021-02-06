@extends('layouts.app')

@section('title', '| Staff')

@section('head_script')
     <script type="text/javascript" src="{{ asset('assets/js/plugins/validation/jquery.validate.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/validation/staff.js') }}"></script> 
    <script type="text/javascript" src="{{ asset('assets/js/plugins/pickers/datepicker.js') }}"></script> 
@endsection

@section('content')
<div class="content-wrapper">
    <div>
        <div class="page-header page-header-default">
            <div class="page-header-content">
                <div class="page-title">
                    <h4>{{(isset($data))?'Edit':'Add'}} Member</h4>
                </div>
            </div>
        </div>
        <div class="panel panel-flat">
            <div class="panel-body">
                
                <div class="col-lg-6">
                    @if(session()->has('success'))
                    <div class="alert alert-success no-border"> 
                        <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
                    {!! session('success') !!}
                    </div>
                    @endif
                    @if(session()->has('danger'))
                        <div class="alert alert-danger no-border"> 
                            <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
                        {!! session('danger') !!}
                        </div>
                    @endif
                    @include('errors.list')
                    <div class="col-lg-12">
                        <form role="form" enctype="multipart/form-data" name="staff_form" id="staff_form" method="post" action="{{(isset($data)) ? route('staff.update',$data->id) : route('staff.store') }}">
                            @csrf
                            {{ (isset($data)) ? method_field('PUT') : '' }}
                            <fieldset class="form-horizontal form-validate-jquery">
                                <div class="row">
                                        <div class="form-group">
                                            <label class="col-lg-4 control-label">Name<span class="text-danger"> *</span>
                                            </label>
                                            <div class="col-lg-8">
                                                <input class="form-control" type="text" name="name" id="name" placeholder="Enter name" value="{{(isset($data->name))? $data->name : old('name') }}" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-4 control-label">Gender
                                            </label>
                                            <div class="col-lg-8">
                                                <select name="gender" class="form-control" value="{{(isset($data->gender))? $data->gender : old('gender') }}">
                                                    <option value="1" {{ isset($data) && ($data->gender == 1) ? 'selected' : '' }} >
                                                        Male
                                                    </option>
                                                    <option value="2" {{ isset($data) && ($data->gender == 2) ? 'selected' : '' }} >
                                                        Female
                                                    </option>
                                                    <option value="3" {{ isset($data) && ($data->gender == 3) ? 'selected' : '' }} >
                                                        Other
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-4 control-label">Contact no<span class="text-danger"> *</span>
                                            </label>
                                            <div class="col-lg-8">
                                                <input class="form-control" type="text" name="contact" id="contact" placeholder="Enter contact number" value="{{(isset($data->contact))? $data->contact : old('contact') }}"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-4 control-label">Date of birth
                                            </label>
                                            <div class="col-lg-8">
                                                <input type="text" id="dob" name="date_of_birth" class="form-control datepicker" value="{{(isset($data->date_of_birth))? $data->date_of_birth : old('date_of_birth') }}"  placeholder="Select Date of birth">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-4 control-label">Address
                                            </label>
                                            <div class="col-lg-8">
                                                <textarea class="form-control" name="address" rows="3" placeholder="Enter Address">{{(isset($data->address))? $data->address : old('address') }}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-4 control-label">Upload Goverment proof
                                            </label>
                                            <div class="col-lg-8">
                                                <input type="file" name="goverment_proof_id" class="form-control" accept="image/png, image/jpeg, image/jpg">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-lg-12">
                                                <div class="text-right">
                                                    <a href="{{ route('staff.index') }}">
                                                        <button class="btn btn-primary bg-teal-300 btn-xs legitRipple cancle-btn-margin" type="button">
                                                            <i class="icon-cross position-left position-left"></i>Cancel
                                                        </button>
                                                    </a>
                                                    <button class="btn btn-success btn-xs legitRipple" type="submit"><i class="icon-floppy-disk position-left"></i>{{(isset($data))?'Update':'Save'}}</button>
                                                </div>
                                            </div>
                                        </div>
                                    
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="col-lg-6 "></div> -->
    </div>
</div>
@endsection

@section('footer_script')
    <script type="text/javascript" src="{{ asset('assets/js/plugins/validation/additional-methods.js') }}"></script> 
    <script type="text/javascript">
    $( function() {
        $( ".datepicker" ).datepicker({
            format: "yyyy-mm-dd"
        });
    });
    </script>
</script>
    
@endsection