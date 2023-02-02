@extends('front.layouts.Dispatch-layout')

@section('page-title',"Set Role Permissions")

@section('css')
	<style>
		/*my css*/
	</style>
@stop

@section('content')
<main id="main" class="page-summary" data-page="summary">
<div class="pg-container container-fluid">
<!-- Content Area - [Start] -->
<div id="main_content_area">
<div class="row no-gutters">
<!-- Sidebar -->
@include('front.roles.role-sidebar')
<!-- Sidebar -->
<aside id="right_content" class="col-12 col-lg-9">
	<div class="inner">
			<div class="content_header_wrap">
				<div class="hgroup divider-after left">
					<h1 class="lh-10">Set Role Permissions</h1>
				</div>
			</div>
		<form method="POST" action="{{ route('role.set-permissions.update',$role->id) }}" id="account-form"  class="needs-validation" novalidate>
			@csrf
			@method('POST')
			@foreach($permissions_list as $permission_label => $permissions)
			<section class="form-section">
				<div class="section-inner">
					<h4>{{$permission_label}}</h4>
					<div class="form-group no-min-h nomargin">
						<div class="custom-control-inline-wrap">
							@foreach($permissions as  $name =>  $permission)
							<div class="custom-radio form-radio custom-control-inline mb-6">
								<input class="form-radio-input" type="checkbox" name="permissions[]" id="{{$permission_label.'-'.$name}}" value="{{ $permission }}"
									   @if(check_permission_exist($permission,$role->Permissions->pluck('route_name')->toArray()))
									   checked
										@endif>
								<label class="form-radio-label" for="{{$permission_label.'-'.$name}}">{{$name}}</label>
							</div>
							@endforeach

						</div>
					</div>

				</div>
			</section>
			@endforeach
			<div class="content_footer_wrap">
				<button type="submit" class="btn btn-primary submitButton">Set Privilages</button>
			</div>
		</form>
		</div>
</aside>
</div>
</div>
<!-- Content Area - [/end] -->
</div>
</main>
@stop

@section('js')
	<script>
        /*My Js*/
	</script>
@stop