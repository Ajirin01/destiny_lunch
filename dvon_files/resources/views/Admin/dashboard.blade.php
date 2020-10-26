@extends('layouts.admin_base')

@section('content')
        <div class="page-wrapper">
            <div class="content">
				<div class="row">
					<div class="col-12 col-md-12 col-lg-8 col-xl-11">
						<div class="card">
							<div class="card-header">
                                <h4 class="card-title d-inline-block">Dashboard</h4>
                                <p>you are logged in!</p>
                                 {{-- <a href="{{ route('appointments.index') }}" class="btn btn-primary float-right">View all</a> --}}
							</div>
						</div>
					</div>
				</div>
            </div>
            
@endsection