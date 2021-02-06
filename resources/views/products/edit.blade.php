@extends('layouts.app')

@section('title', '| Edit Product')

@section('head_style')
<<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection 

@section('head_script')
     <script type="text/javascript" src="{{ asset('assets/js/plugins/validation/jquery.validate.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/validation/product.js') }}"></script> 
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection

@section('content')
<div class="content-wrapper">
    <div>
        <div class="page-header page-header-default">
            <div class="page-header-content">
                <div class="page-title">
                    <h4>Edit Product</h4>
                </div>
            </div>
        </div>
        <div class="panel panel-flat">
            <div class="panel-body">
                
                <div class="col-lg-6">
                    @if(session()->has('success'))
                    <div class="alert alert-success no-border"> 
                        <strong>Success!</strong>
                    {!! session('success') !!}
                    </div>
                    @endif
                    @if(session()->has('danger'))
                        <div class="alert alert-danger no-border"> 
                            <!-- <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button> -->
                        {!! session('danger') !!}
                        </div>
                    @endif
                    @include('errors.list')
                    <div class="col-lg-12">
                        <form role="form" name="product_form" id="product_form" action="{{ route('products.update',$product->id) }}" method="POST">
                            @csrf
                            {{ method_field('PUT') }}
                            <fieldset class="form-horizontal form-validate-jquery">
                                <div class="row">
                                        <<div class="form-group">
                                            <label class="col-lg-4 control-label">Name<span class="text-danger"> *</span>
                                            </label>
                                            <div class="col-lg-8">
                                                <input class="form-control" type="text" name="name" id="name" placeholder="Enter name" value="{{ $product->name }}"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-4 control-label">Category<span class="text-danger"> *</span></label>
                                            <div class="col-lg-8">
                                                <select style="width: 100%" class="js-example-basic-single" name="category_id" value="{{ $product->category_id }}">
                                                    @foreach($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-4 control-label">Company Name
                                            </label>
                                            <div class="col-lg-8">
                                                <select style="width: 100%" class="js-example-basic-single" name="company_id" value="{{ $product->company_id }}">
                                                    @foreach($companies as $company)
                                                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-4 control-label">Color<span class="text-danger"> *</span>
                                            </label>
                                            <div class="col-lg-8">
                                                <input class="form-control" type="text" name="color" id="color" placeholder="Enter color" value="{{ $product->color }}"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-4 control-label">Watt<span class="text-danger"> *</span>
                                            </label>
                                            <div class="col-lg-8">
                                                <input class="form-control" type="text" name="watt" id="watt" placeholder="Enter watt" value="{{ $product->watt }}"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-4 control-label">Dimention</label>
                                            <div class="col-lg-8">
                                                <input class="form-control" type="text" name="dimention" id="dimention" placeholder="Enter dimention" value="{{ $product->dimention }}"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-4 control-label">Lumens Output</label>
                                            <div class="col-lg-8">
                                                <input class="form-control" type="text" name="lumens_output" id="lumens_output" placeholder="Enter lumens_output" value="{{ $product->lumens_output }}"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-4 control-label">Beam Angle</label>
                                            <div class="col-lg-8">
                                                <input class="form-control" type="text" name="beam_angle" id="beam_angle" placeholder="Enter beam angle" value="{{ $product->beam_angle }}"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-4 control-label">Body Colour<span class="text-danger"> *</span>
                                            </label>
                                            <div class="col-lg-8">
                                                <input class="form-control" type="text" name="body_colour" id="body_colour" placeholder="Enter body colour" value="{{ $product->body_colour }}"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-4 control-label">Quantity</label>
                                            <div class="col-lg-8">
                                                <input class="form-control" type="text" name="quantity" id="quantity" placeholder="Enter quantity" value="{{ $product->quantity }}"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-4 control-label">Price<span class="text-danger"> *</span>
                                            </label>
                                            <div class="col-lg-8">
                                                <input class="form-control" type="text" name="price" id="price" placeholder="Enter price" value="{{ $product->price }}"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-lg-12">
                                                <div class="text-right">
                                                    <a href="{{ route('products.index') }}">
                                                        <button class="btn btn-primary bg-teal-300 btn-xs legitRipple cancle-btn-margin" type="button">
                                                            <i class="icon-cross position-left position-left"></i>Cancel
                                                        </button>
                                                    </a>
                                                    <button class="btn btn-success btn-xs legitRipple" type="submit"><i class="icon-floppy-disk position-left"></i>Update</button>
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
    <script type="text/javascript">
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>
     <script type="text/javascript" src="{{ asset('assets/js/plugins/validation/additional-methods.js') }}"></script> 
    
@endsection