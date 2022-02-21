@extends('layouts.app')

@section('title', '| Invoices')

@section('head_script')
     <script type="text/javascript" src="{{ asset('assets/js/plugins/validation/jquery.validate.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/pickers/datepicker.js') }}"></script> 
@endsection

@section('theme_script')
    <script type="text/javascript" src="{{ asset('assets/js/plugins/tables/datatables/datatables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/forms/selects/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/pages/datatables_basic.js') }}"></script>
@endsection

@section('content')
<div class="content-wrapper">
    <div>
        <div class="page-header page-header-default">
            <div class="page-header-content">
                <div class="page-title">
                    <h4>{{(isset($data))?'Edit':'Add'}} Invoices</h4>
                </div>
            </div>
        </div>
        <div class="panel panel-flat">
            <div class="panel-body">
                
                <!-- <div class="col-lg-6"> -->
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
                        <form role="form" name="invoice_form" id="invoice_form">
                            <div class="col-lg-6">
                                <fieldset class="form-horizontal form-validate-jquery">
                                    <div class="row">
                                            <div class="form-group">
                                                <label class="col-lg-4 control-label">Client Name<span class="text-danger"> *</span>
                                                </label>
                                                <div class="col-lg-8">
                                                    <select data-placeholder="Select Client" class="select-search" name="client_id" id="client_id">
                                                        <option></option>
                                                        @foreach($clients as $client)
                                                          <option value="{{$client->id}}">{{$client->name}}</option>
                                                        @endforeach 
                                                        
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-4 control-label">Service<span class="text-danger"> *</span>
                                                </label>
                                                <div class="col-lg-8">
                                                    <select data-placeholder="Select Service" class="select-search" id="service_id" name="service_id">
                                                        <option></option>
                                                        @foreach($services as $service)
                                                          <option value="{{$service->id}}" data-price="{{ $service->price }}">{{$service->service_name}}</option>
                                                        @endforeach 
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-4 control-label">Operator<span class="text-danger"> *</span>
                                                </label>
                                                <div class="col-lg-8">
                                                    <select data-placeholder="Select Operator" class="select-search" id="operator_id" name="operator_id">
                                                        <option></option>
                                                        @foreach($operators as $operator)
                                                          <option value="{{$operator->id}}">{{$operator->name}}</option>
                                                        @endforeach 
                                                        
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-lg-12">
                                                    <div class="text-right">
                                                        <button class="btn btn-success btn-xs legitRipple add-btn" type="submit"><i class="icon-floppy-disk position-left"></i>Add</button>
                                                    </div>
                                                </div>
                                            </div>
                                        
                                    </div>
                                </fieldset>
                            </div>
                        </form>
                        <div class="col-lg-12">
                            <div class="table-responsive display nowrap" style="margin: 25px 0;">
                                <table class="table datatable-basic table-style"width="100%">
                                    <thead>
                                        <tr>
                                            <th>SN.no</th>
                                            <th>Service</th>
                                            <th>Operator</th>
                                            <th>Price</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td style="text-align: right;">
                                                Discount
                                            </td>
                                            <td>
                                                <input type="number" class="form-control" name="discount" id="discount" min=0 max=100 value=0 />
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td style="text-align: right;">
                                                Total Amount
                                            </td>
                                            <td>
                                                <b id="total">0</b>
                                            </td>
                                            <td></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <div class="text-right">
                                    <a href="{{ route('services.index') }}">
                                        <button class="btn btn-primary bg-teal-300 btn-xs legitRipple cancle-btn-margin" type="button">
                                            <i class="icon-cross position-left position-left"></i>Cancel
                                        </button>
                                    </a>
                                    <button class="btn btn-success btn-xs legitRipple add_invoice" type="button"><i class="icon-floppy-disk position-left"></i>{{(isset($data))?'Update':'Save'}}</button>
                                </div>
                            </div>
                        </div>    
                    </div>
                <!-- </div> -->
            </div>
        </div>
        <!-- <div class="col-lg-6 "></div> -->
    </div>
</div>
@endsection

@section('footer_script')
    <script type="text/javascript" src="{{ asset('assets/js/plugins/validation/additional-methods.js') }}"></script> 
    <!-- <script type="text/javascript" src="{{ asset('assets/js/plugins/validation/invoice.js') }}"></script>  -->
    <script type="text/javascript">
        var amountWithDiscount = 0;
        var discount = 0;
    $( function() {
        $( ".datepicker" ).datepicker({
            format: "yyyy-mm-dd"
        });
    });
    $(document).ready(function(){
        var t = $('.datatable-basic').DataTable();
        var client_services = [];
        $('.select-search').select2();
        $("#invoice_form").validate({
            errorElement: "span",
            errorClass: "validation-error-label",
            rules: {
                client_id: {
                    required:true,
                    digits: true
                },
                service_id: {
                    required:true,
                    digits: true
                },
                operator_id: {
                    required:true,
                    digits: true
                },
            },

            highlight: function (element, errorClass) {
                $(element).removeClass(errorClass);
            },
            unhighlight: function (element, errorClass) {
                $(element).removeClass(errorClass);
            },
            errorPlacement: function (error, element) {
                error.appendTo(element.parent());
            },
            submitHandler: function (form) {
                // submit();
                var service = $("#service_id").select2().find(":selected");
                var operator = $('#operator_id').select2('data');
                var price=service.data("price");
                var id = 0;
                client_services.push({ service_id:service.val(), operator_id: operator[0].id })
                let html = '<tr><td>'+(id+1)+'</td><td>'+service.text()+'</td><td>'+operator[0].text+'</td><td class="price">'+price+'</td><td><button class="btn remove_service" ><a class="label label-danger"><i class="fa fa-minus"> </i></a></td></tr>';
                id++;
                t.row.add($(html)).draw();
                calculateDiscount();
                // $("#total").text(total)
                $('#service_id, #operator_id').val(null).trigger('change');
                
            }
        });
        $(".select-search").on('select2:select', function() {
            $(this).valid();
        });
        $("body").on("click", "button.remove_service", function(e){
            t
            .row( $(this).parents('tr') )
            .remove()
            .draw();

            calculateDiscount();
        })

        $(".add_invoice").on("click", function(e){
            e.preventDefault();
            if(client_services.length > 0){
                var client_id = $('#client_id').select2('data')[0].id;
                $.ajax({
                    type: 'post',
                    url: '{{ route("invoices.store") }}',
                    dataType:'json',
                    data:{client_id,client_services, discount:parseInt(discount), total_amount: amountWithDiscount},
                    headers: {
                        'X-CSRF-Token': '{{ csrf_token() }}',
                    },
                    success: function(data){
                        console.log("data", data)
                        alert(data.message);
                        location.reload();
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        // alert("Please fill the information properly");
                        alert("Something went wrong");
                        var errorMsg = 'Ajax request failed: ' + xhr.responseText;
                        console.error(errorMsg);
                      }
                });
            } else{
                alert("Please fill the information properly");
            }
        })

        $("#discount").on('input', function() {
            calculateDiscount();
        });

    })
    function calculatePrice(){
        var total = 0;
        $(".price").map(function(){
            total = total + parseInt($(this).text());
        })
        return total;
    }

    function calculateDiscount(){
        var total = calculatePrice();
        discount = $("#discount").val() || 0;
        amountWithDiscount = total - (total * parseInt(discount) / 100);
        $("#total").text(amountWithDiscount);
    }

    </script>
</script>
    
@endsection