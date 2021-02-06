@extends('layouts.app')

@section('title', '| Affirmation Quotes')

{{--  @section('head_style')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/buttons.dataTables.min.css')}}">
<style type="text/css">
    .selected{
        background-color: #ddd;
    }
</style>
@endsection  --}}

@section('theme_script')
    <script type="text/javascript" src="{{ asset('assets/js/plugins/tables/datatables/datatables.min.js') }}"></script>
    <script type="text/javascript" src="assets/js/plugins/forms/selects/select2.min.js"></script>
    <script type="text/javascript" src="{{ asset('assets/js/pages/datatables_basic.js') }}"></script>
@endsection
@section('content')

    <div class="content-wrapper affirmation-quote">
        <div>
            <div class="page-header page-header-default">
                <div class="page-header-content">
                    <div class="page-title" style="padding-right:0">
                        <div style="display:inline-block">
                            <h4>Quotation</h4>
                        </div>
                        <!-- <div class="pull-right">
                            <a href="{{ route('affirmation-quote.create') }}">
                                <span class="btn btn-success btn-xs position-right"><i class="fa fa-plus"></i>Create New</span>
                            </a>
                        </div> -->
                    </div>
                </div>
            </div>
            <div>
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <div class="col-lg-12">
                            <div style="margin:20px">
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
                            </div>
                            <div class="table-responsive display nowrap" style="margin: 25px 0;">
                                <table class="table product-table datatable-basic table-style"width="100%">
                                    <thead>
                                        <tr>
                                            <th>Sr.no</th>
                                            <th>Name</th>
                                            <th>Category</th>
                                            <th>Company</th>
                                            <th>Colour</th>
                                            <th>Watt</th>
                                            <th>Body Color</th>
                                            <th>Price</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $key => $product)    
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td>{{ $product->name }}</td>
                                                <td>{{ $product->categories->name }}</td>
                                                <td>{{ $product->companies->name }}</td>
                                                <td>{{ $product->watt }}</td>
                                                <td>{{ $product->color }}</td>
                                                <td>{{ $product->body_color }}</td>
                                                <td>{{ $product->price }}</td>
                                                <td>
                                                    <ul class="icons-list btn-size">
                                                        <li>
                                                                <button type="button" class="label border-success text-grey-600" onclick="addProduct('{{ $key }}'); event.preventDefault();$(this).parents('tr').addClass('selected')">+ Add to quotation</button>
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    
                                </table>
                            </div>
                            <form role="form" name="quotation_form" id="quotation_form" method="post" action="{{ route('quotations.store') }}">
                                    @csrf
                                    <fieldset class="form-horizontal form-validate-jquery">
                                        <legend class="client-legend col-lg-12"><i class="fa fa-info-circle" aria-hidden="true"></i> Client Detail</legend>
                                        <div class="row">
                                                <div class="col-lg-6">    
                                                    <div class="form-group">
                                                        <label class="col-lg-12 control-label">To(Client or Company name)<span class="text-danger"> *</span>
                                                        </label>
                                                        <div class="col-lg-12">
                                                            <input type="text" class="form-control" name="client_company_name" id="client_company_name" placeholder="Enter Client or Company Name" value="{{old('client_company_name')}}" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="col-lg-12 control-label">Address(Client or Company Address)</label>
                                                        <div class="col-lg-12">
                                                            <textarea class="form-control" name="client_company_address" id="client_company_address" rows=5 placeholder="Enter Client or Company Address">{{old('client_company_address')}}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            </fieldset>
                                            <fieldset class="form-horizontal form-validate-jquery">
                                                <legend class="client-legend col-lg-12"><i class="fa fa-info-circle" aria-hidden="true"></i>Product details</legend>
                                                <div class="form-group">
                                                    <div class="table-responsive col-lg-12">
                                                      <table class="table payment-table">
                                                        <thead>
                                                          <tr>
                                                            <th class="text-center">SN</th>
                                                            <th class="text-center stage-style">Product</th>
                                                            <th class="text-center">Color</th>
                                                            <th class="text-center">Watt</th>
                                                            <th class="text-center">Nos</th>
                                                            <th class="text-center">Unit</th>
                                                            <th class="release-style text-center">Rate</th>
                                                            <th class="release-style text-center">Amount</th>
                                                            <th> </th>
                                                          </tr>
                                                        </thead>
                                                        <tbody id="quot_product_tbody">
                                                            <tr>
                                                                <td colspan="7" class="text-right">
                                                                    Discount
                                                                </td>
                                                                <td>
                                                                    <input class="form-control" type="number" name="discount" id="discount" value="0">
                                                                </td>
                                                                <td></td>
                                                            </tr>        
                                                            <tr>
                                                                <td colspan="7" class="text-right">
                                                                    Total
                                                                </td>
                                                                <td>
                                                                    <input class="form-control" type="number" name="total" id="total">
                                                                </td>
                                                                <td></td>
                                                            </tr>              
                                                        </tbody>
                                                      </table>
                                                    </div>  
                                                  </div>
                                            </fieldset>
                                            <div class="form-group">
                                                <div class="col-lg-12">
                                                    <div class="text-right">
                                                        <button class="btn btn-success btn-xs legitRipple" type="submit"><i class="icon-floppy-disk position-left"></i>Generate Quotation</button>
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
        </div>
    </div>
@endsection
@section('footer_script')
    <script>
        $(document).ready(function(){
            // jquery for add new payment schedule
            var payment_id=0;
          $("#add_schedule").click(function(){
            $("#payment_schedule_tbody").append("<tr> <td>"+(payment_id+1)+"</td> <td><input type='text' placeholder='Enter stage' name=quotation_payment["+(payment_id+1)+"][stage] class='form-control'></td> <td class='form-group'><input type='text' placeholder='Enter fee payable %' name=quotation_payment["+(payment_id+1)+"][fee_payable] class='form-control fee-payable'></td> <td><textarea placeholder='Enter payment release period' name=quotation_payment["+(payment_id+1)+"][release_period] class='form-control'></textarea></td> <td><a class='label label-danger remove_schedule'><i class='fa fa-minus'> </i></a></td>");
            payment_id++;
          });
            // $("#rate, #nos").on('input', function() {
            //     var nos = $(this).parents("tr").find("#nos").val();
            //     var rate = $(this).parents("tr").find("#rate").val();
            //     var amount = nos * rate;
            //     $(this).parents("tr").find("#amount").val(amount);
            //     calculateAmount();
            // });

            $("#discount").on('input', function() {
                discount();
            });
        });
        $('.datatable-basic').DataTable({
            "pageLength": 5,
            columnDefs: [{ 
                orderable: false,
                //width: '100px',
                targets: [ 8 ]
            }],
        });
        var product_index = 0;
        function addProduct(key){
            var data = {!! $products !!}[key];
            var row = '<tr><td class="text-center">'+(product_index+1)+'</td><td class="text-center"><input type="text" class="form-control" name="name[]" value="'+data['name']+'"/></td><td class="text-center"><input type="text" class="form-control" name="color[]" value="'+data['color']+'"/></td><td class="text-center"><input type="text" class="form-control" name="watt[]" value="'+data['watt']+'"/></td><td class="text-center"><input type="text" class="form-control" id="nos" name="nos[]" oninput="calAmount(this)" /></td><td class="text-center"><input type="text" class="form-control" name="unit[]"/></td><td class="text-center"><input type="text"  class="form-control" oninput="calAmount(this)" id="rate" name="rate[]" value="'+data["price"]+'" /></td><td class="text-center"><input type="text" class="form-control amount" id="amount" name="amount[]" /></td><td><a class="label label-danger remove_product" onclick="removeQuotProduct('+this+')"><i class="fa fa-minus"> </i></a></td></tr>'
            $("#quot_product_tbody").prepend(row);
            product_index++;
        }

        function removeQuotProduct(e){
            // console.log("key",key)
            console.log("e",e)
            // var key = $(e).attr("key");
            // $('.product-table > tbody > tr').eq(key).removeClass("selected");
        }

		function quoteDelete(e){
			swal({
	  				title: "Are you sure want to Delete..?",
					icon: "warning",
					//text:"Are you sure want to Logout..?",
					buttons: true,
					buttons: ["Cancel", "Confirm"],
					dangerMode: true,
					closeOnClickOutside: false,
					closeOnEsc: false,
					timer: 10000,
				})
			.then((willDelete) => {
  			if (willDelete) {
    				$(e).parents('form').submit();
  			}
			});
		}
        function calAmount(e){
            var nos = $(e).parents("tr").find("#nos").val();
            var rate = $(e).parents("tr").find("#rate").val();
            var amount = nos * rate;
            console.log("nos",nos)
            console.log("rate",rate)
            console.log("rate",rate)
            console.log("amount",amount)
            $(e).parents("tr").find("#amount").val(amount);
            calculateAmount();
        }
        var totalAmount = 0;
        function calculateAmount(){
            var discount = $("#discount").val() || 0;
            totalAmount = totalAmt();
            if(parseInt(discount) > 0){
                discount();
            }
            $("#total").val(totalAmount);

        }

        function totalAmt(){
            var total = 0;
            $(".amount").each(function(){
                let value = $(this).val() || 0;
                total = total+parseInt(value);
            })
            return total;
        }
        function discount(){
            var discount = $("#discount").val() || 0;
            var total = totalAmount || 0;
            var discountInRs = (total*discount)/100;
                total = total - discountInRs;
                $("#total").val(total);
        }
	</script>
@endsection