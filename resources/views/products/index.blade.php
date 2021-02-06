@extends('layouts.app')

@section('title', '| Products')

{{--  @section('head_style')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/buttons.dataTables.min.css')}}">
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
                            <h4>Products</h4>
                        </div>
                        <div class="pull-right">
                            <a href="javascript:void(0)" style="visibility:hidden" id="flush_btn" onclick="flush_quot()">
                                <span class="btn btn-danger btn-xs position-right"><i class="fa fa-plus"></i>Flush quotation products</span>
                            </a>
                            <a href="javascript:void(0)" style="visibility:hidden" id="quot_btn" onclick="add_quot()">
                                <span class="btn btn-success btn-xs position-right"><i class="fa fa-plus"></i>Add item in Quotation</span>
                            </a>
                            <a href="{{ route('products.create') }}">
                                <span class="btn btn-success btn-xs position-right"><i class="fa fa-plus"></i>Create New</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div class="panel panel-flat">
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
                        <table class="table datatable-basic table-style"width="100%">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Sr.no</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Company</th>
                                    <th>Colour</th>
                                    <th>Watt</th>
                                    <th>Body Color</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $key => $product)    
                                    <tr>
                                        <td><input class="form-control" type="checkbox" onclick='calc(this, "{{ $product->id }}")'></td>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->categories->name }}</td>
                                        <td>{{ $product->companies->name }}</td>
                                        <td>{{ $product->watt }}</td>
                                        <td>{{ $product->color }}</td>
                                        <td>{{ $product->body_color }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td>{{ $product->quantity }}</td>
                                        <td>
                                            <ul class="icons-list btn-size">
                                                <li>
                                                    <a href="{{ route('products.edit', $product->id) }}">
                                                        <i class="glyphicon glyphicon-pencil"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <form action="{{ route('products.destroy', $product->id)}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                        <button style=" padding: 0; background: transparent; border: 0;" type="button"><i class="glyphicon glyphicon-trash" onclick="productDelete(this); event.preventDefault();"></i></button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer_script')
    <script>
        var selectedProducts = [];
        $('.datatable-basic').DataTable({
            columnDefs: [{ 
                orderable: false,
                //width: '100px',
                targets: [ 10 ]
            },{
                targets: 0,
                checkboxes: {
                   'selectRow': true
                }
             }],
        });


        function calc(e,id)
        {
            if(e.checked){
                selectedProducts.push(id);
            } else{
                const index = selectedProducts.indexOf(id);
                if (index > -1) {
                  selectedProducts.splice(index, 1);
                }
            }
            $("#quot_btn").css("visibility",(selectedProducts.length > 0)? "visible" : "hidden");
            $("#flush_btn").css("visibility",localStorage.getItem("item_for_quot") ? "visible" : "hidden");
        }
        function add_quot()
        {
            localStorage.setItem("item_for_quot", JSON.stringify(selectedProducts));
            $.ajax({
                url: 'http://127.0.0.1:8000/products/add-quot',
                type: 'post',
                dataType:"json",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "productForQuot": selectedProducts
                },
                success: function(data){
                    $("#flush_btn").css("visibility", "visible");
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    var errorMsg = 'Ajax request failed: ' + xhr.responseText;
                    console.error(errorMsg);
                  }
            });
        }

        function flush_quot()
        {
            localStorage.removeItem("item_for_quot");
            $.ajax({
                url: 'http://127.0.0.1:8000/products/remove-quot',
                type: 'post',
                dataType:"json",
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                success: function(data){
                    $("#flush_btn").css("visibility", "hidden");
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    var errorMsg = 'Ajax request failed: ' + xhr.responseText;
                    console.error(errorMsg);
                  }
            });
        }
    </script>
    <script type="text/javascript">
		function productDelete(e){
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
	</script>
@endsection

