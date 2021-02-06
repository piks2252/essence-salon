@extends('layouts.app')

@section('title', '| Add Company')

@section('head_script')
     <script type="text/javascript" src="{{ asset('assets/js/plugins/validation/jquery.validate.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/validation/category.js') }}"></script> 
@endsection

@section('content')
<div class="content-wrapper">
    <div>
        <div class="page-header page-header-default">
            <div class="page-header-content">
                <div class="page-title">
                    <h4>Add Company</h4>
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
                        <form role="form" name="category_form" id="category_form" method="post" action="{{ route('companies.store') }}">
                            @csrf
                            <fieldset class="form-horizontal form-validate-jquery">
                                <div class="row">
                                        <div class="form-group">
                                            <label class="col-lg-4 control-label">Name<span class="text-danger"> *</span>
                                            </label>
                                            <div class="col-lg-8">
                                                <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name" value="{{old('name')}}" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-lg-12">
                                                <div class="text-right">
                                                    <a href="{{ route('companies.index') }}">
                                                        <button class="btn btn-primary bg-teal-300 btn-xs legitRipple cancle-btn-margin" type="button">
                                                            <i class="icon-cross position-left position-left"></i>Cancel
                                                        </button>
                                                    </a>
                                                    <button class="btn btn-success btn-xs legitRipple" type="submit"><i class="icon-floppy-disk position-left"></i>Save</button>
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
</script>
    
@endsection