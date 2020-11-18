@extends('layouts.master')
@section('css')
<!-- Select2 css -->
<link href="{{URL::asset('assets/plugins/select2/select2.min.css')}}" rel="stylesheet" />
@endsection
@section('page-header')
						<!--Page header-->
						<div class="page-header">
							<div class="page-leftheader">
								<h4 class="page-title">Edit User</h4>
							</div>
							<div class="page-rightheader ml-auto d-lg-flex d-none">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="d-flex"><svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 3L2 12h3v8h6v-6h2v6h6v-8h3L12 3zm5 15h-2v-6H9v6H7v-7.81l5-4.5 5 4.5V18z"/><path d="M7 10.19V18h2v-6h6v6h2v-7.81l-5-4.5z" opacity=".3"/></svg><span class="breadcrumb-icon"> Dashboard</span></a></li>
									<li class="breadcrumb-item"><a href="{{ route('users.index') }}">Users Panel</a></li>
									<li class="breadcrumb-item active" aria-current="page">Edit User</li>
								</ol>
							</div>
						</div>
						<!--End Page header-->
@endsection
@section('content')
						<!-- Row -->
						<div class="row">
							<div class="col-xl-12 col-lg-12 col-md-12">
								<div class="card">
                                    <div class="card-header">
										<div class="card-title">Edit User</div>
                                    </div>
                                    <div class="card-body">
                                        <form method="POST" action="{{ route('users.update', $user->id) }}"  role="form">
                                            {{ csrf_field() }}
                                            <input name="_method" type="hidden" value="PATCH">
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <div class="form-group">
                                                        <label class="form-label">Name</label>
                                                        <input type="text" name="name" id="name" class="form-control input-sm" value="{{ $user->name }}">
                                                    </div>
                                                </div>
                                                <div class="col-xs-12">
                                                    <div class="form-group">
                                                        <label class="form-label">Email</label>
                                                        <input type="email" name="email" id="email" class="form-control input-sm" value="{{ $user->email }}">
                                                    </div>
                                                </div>
                                                {{-- <div class="row"> --}}
                                                @if ( $user->isAdmin() )
                                                    <div class="col-xs-12">
                                                        <div class="form-group">
                                                            <label class="form-label">Role</label>
                                                            <select class="form-control" name="role">
                                                            @if ( $user->isAdmin() )
                                                            <option value="1">Admin</option>
                                                            <option value="2">User</option>
                                                            @else
                                                            <option value="2">User</option>
                                                            <option value="1">Admin</option>
                                                            @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                                @else
                                                    <input type="hidden" name="role" id="role" class="form-control input-sm" value="{{ $user->role_id }}">
                                                @endif
                                                {{-- </div> --}}
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <button type="submit" class="btn btn-lg btn-primary">Updated</button>
                                                    @if($user->role_id == 1)
                                                        <a href="{{ route('users.index') }}" class="btn btn-lg btn-danger">Cancel</a>
                                                    @else
                                                        <a href="{{ route('users.index') }}" class="btn btn-lg btn-danger">Cancel</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </form>
                                    </div>
								</div>
							</div>
						</div>
						<!-- End Row-->

					</div>
				</div><!-- end app-content-->
			</div>
@endsection
@section('js')
<!--Select2 js -->
<script src="{{URL::asset('assets/plugins/select2/select2.full.min.js')}}"></script>
<script src="{{URL::asset('assets/js/select2.js')}}"></script>
@endsection
