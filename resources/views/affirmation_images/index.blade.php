@extends('layouts.app')

@section('title', '| Affirmation Images')

@section('theme_script')
    <script type="text/javascript" src="{{ asset('assets/js/plugins/tables/datatables/datatables.min.js') }}"></script>
    <script type="text/javascript" src="assets/js/plugins/forms/selects/select2.min.js"></script>
    <script type="text/javascript" src="{{ asset('assets/js/pages/datatables_basic.js') }}"></script>
@endsection
@section('content')

    <div class="content-wrapper">
        <div>
            <div class="page-header page-header-default">
                <div class="page-header-content">
                    <div class="page-title" style="padding-right:0">
                        <div style="display:inline-block">
                            <h4>Affirmation Images</h4>
                        </div>
                        <div class="pull-right">
                            <a href="{{ route('affirmation-image.create') }}">
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
                                    <th>Sr.no</th>
                                    <th>Images</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($images as $key => $image)    
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td><img src="{{ asset('assets/images/affirmation-images/'.$image->image_path) }}" style="height:100px; width:100px"</td>
                                        <td>
                                            <ul class="icons-list btn-size">
                                                <li>
                                                    <a href="{{ route('affirmation-image.edit', $image->id) }}">
                                                        <i class="glyphicon glyphicon-pencil"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <form action="{{ route('affirmation-image.destroy', $image->id)}}" method="post" id="delete-image-form">
                                                    @csrf
                                                    @method('DELETE')
                                                        <button style=" padding: 0; background: transparent; border: 0;" type="button"  onclick="imageDelete(this); event.preventDefault();"><i class="glyphicon glyphicon-trash"></i></button>
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
        $('.datatable-basic').DataTable({
            columnDefs: [{ 
                orderable: false,
                targets: [ 2 ]
            },{ 
                orderable: false,
                targets: [ 1 ]
            }],
             bFilter:false,
        });
    </script>
    <script type="text/javascript">
		function imageDelete(e){
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
