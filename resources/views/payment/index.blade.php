@extends('layouts.master')
@section('css')
<!-- Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}"  rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<!-- Slect2 css -->
<link href="{{URL::asset('assets/plugins/select2/select2.min.css')}}" rel="stylesheet" />
@endsection
@section('page-header')
						<!--Page header-->
						<div class="page-header">
							<div class="page-leftheader">
								<h4 class="page-title">Payments Dashboard</h4>
							</div>
						</div>
						<!--End Page header-->
@endsection
@section('content')
                        <!--Row-->
                        @if(Session::has('success'))
                            <div class="alert alert-{{ session('success.alert') }} alert-dismissible fade show" role="alert">
                                {{ session('success.message') }}

                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

						<div class="row row-deck">
							<div class="col-xl-12 col-lg-12 col-md-12">
								<div class="card">
									<div class="card-header">
										<h3 class="card-title"></h3>
										<div class="card-options">
											<div class="btn-group ml-5 mb-0">
                                                <a class="btn btn-primary" data-target="#modaldemo1" data-toggle="modal" href=""><i class="fa fa-plus mr-2"></i>Add New Payments</a>
											</div>
										</div>
									</div>
									<div class="card-body">
										<div class="table-responsive">
                                            <table id="example" class="table table-bordered text-nowrap key-buttons">
                                                <thead>
                                                    <th class="border-bottom-0">#</th>
                                                    <th class="border-bottom-0">SID</th>
                                                    <th class="border-bottom-0">DOB</th>
                                                    <th class="border-bottom-0">Store Code</th>
                                                    <th class="border-bottom-0">Store Name</th>
                                                    <th class="border-bottom-0">Tender</th>
                                                    <th class="border-bottom-0">Check Payment</th>
                                                    <th class="border-bottom-0">Card</th>
                                                    <th class="border-bottom-0">Exp</th>
                                                    <th class="border-bottom-0">Quantity</th>
                                                    <th class="border-bottom-0">Amount</th>
                                                    <th class="border-bottom-0">Total</th>
                                                    <th class="border-bottom-0">Employee Name</th>
                                                    <th class="border-bottom-0">Employee ID</th>
                                                    <th class="border-bottom-0">Edit</th>
                                                    <th class="border-bottom-0">Delete</th>
                                                </thead>
                                                <tbody>
                                                    @if($payments->isNotEmpty())
                                                        @foreach($payments as $payment)
                                                            <tr class="bold">
                                                                <td>{{$payment->id}}</td>
                                                                <td>{{$payment->sid}}</td>
                                                                <td>{{$payment->dob}}</td>
                                                                <td>{{$payment->store_code}}</td>
                                                                <td>{{$payment->store_name}}</td>
                                                                <td>{{$payment->tender}}</td>
                                                                <td>{{$payment->check_payments}}</td>
                                                                <td>{{$payment->card}}</td>
                                                                <td>{{$payment->exp}}</td>
                                                                <td>{{$payment->qty}}</td>
                                                                <td>{{$payment->amount}}</td>
                                                                <td>{{$payment->total}}</td>
                                                                <td>{{$payment->empployee_name}}</td>
                                                                <td>{{$payment->empployee_id}}</td>
                                                                <td><a class="btn btn-primary btn-xs" href="{{action('PaymentController@edit', $payment->id)}}" ><span class="fa fa-pencil"></span></a></td>
                                                                <td>
                                                                    <form action="{{action('PaymentController@destroy', $payment->id)}}" method="post">
                                                                        {{csrf_field()}}
                                                                        <input name="_method" type="hidden" value="DELETE">
                                                                        <button class="btn btn-danger btn-xs" type="submit"><span class="fa fa-trash"></span></button>
                                                                    </form>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @else
                                                        <tr>
                                                            <td colspan="8">No one there!</td>
                                                        </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
								</div>
							</div>
						</div>
						<!--End row-->
					</div>
				</div><!-- end app-content-->
            </div>
            <div class="modal" id="modaldemo1">
                <div class="modal-dialog" role="document">
                    <div class="modal-content modal-content-demo">
                        <div class="modal-header">
                            <h6 class="modal-title">File Upload</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{ route('payment.store') }}" role="form" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-xs-6">
                                        <div class="custom-file">
                                            <input type="file" id="xmldata" name="xmldata" class="custom-file-input" data-height="250" accept="text/xml" onchange='openFile(event)'/>
                                            <label class="custom-file-label">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    <button type="submit" class="btn btn-lg btn-primary">Upload</button>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-light" data-dismiss="modal" type="button">Close</button>
                        </div>
                    </div>
                </div>
            </div>
@endsection
@section('js')
<!-- Data tables -->
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/responsive.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/js/datatables.js')}}"></script>
<!-- Select2 js -->
<script src="{{URL::asset('assets/plugins/select2/select2.full.min.js')}}"></script>

<script type="text/javascript">
    var openFile = function(event) {
        var input = event.target;

        var reader = new FileReader();
        reader.onload = function(){
            var dataURL = reader.result;
            console.log(dataURL);
            xmlDoc = $.parseXML(dataURL),
            $xml = $(xmlDoc),
            $('#xmltext').val(dataURL);
        };
        reader.readAsText(input.files[0]);
    };
</script>
@endsection
