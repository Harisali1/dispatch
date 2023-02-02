@extends('front.layouts.Dispatch-layout')

@section('page-title',"Roles")

@section('css')
<style>

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
<aside id="right_content" class="col-md-12 col-lg-9 col-sm-12">
	<div class="inner">
			<div class="content_header_wrap">
				<div class="hgroup divider-after left">
					<h1 class="lh-10">Roles & Privileges</h1>
				</div>
			</div>
			<div class="content_header_wrap">
				@include('front.partials.errors')
			</div>

			<section class="section-content summary-section">
				<div class="section-inner">
					<div class="grid_controls">
						<div class="row align-items-end">
							<div class="col-4">
								{{ $Roles->links('vendor.pagination.default') }}
							</div>
						</div>
					</div>
					<table class="table table-striped table-responsive tbl-responsive mb_last_row_hightlight mb_last_row_center">
						<thead>
							<tr>
								<th width="5%" scope="col">ID #</th>
								<th width="8%" scope="col">Name</th>
								<th width="8%" scope="col">Total Users</th>
								<th width="12%" scope="col">Total Dashboard Cards</th>
								<th width="12%" scope="col">Created At</th>
								<th width="8%" scope="col">Set Privileges</th>
								<th width="10%" scope="col" class="align-right">Actions</th>
							</tr>
						</thead>
						<tbody>
						@foreach($Roles as $key => $role)
							<tr>
								<td class="valing-middle"><span class="bold basecolor1">{{$key+1}}</span></td>
								<td class="valing-middle">{{$role->display_name}}</td>
								<td class="valing-middle">{{$role->User->count()}}</td>
								@if(!empty($role->dashbaord_cards_rights))
								<?php
								$dashboard_count = count(explode(',',$role->dashbaord_cards_rights));
								?>
								<td class="valing-middle">{{$dashboard_count}}</td>
								@else
									<td class="valing-middle">No Permissions</td>
								@endif
								<td class="valing-middle">{{$role->created_at}}</td>
								<td class="valing-middle">
									@if(can_access_route('role.set-permissions',$userPermissoins))
									<a href="{!! URL::route('role.set-permissions',$role->id) !!}"
									   title="Edit"
									   class="btn btn-basecolor1 btn-border btn-mb">
										Set privileges
									</a>
									@endif
								</td>
								<td class="semibold align-right">
									@if(can_access_route('role.edit',$userPermissoins))
									<a href="{!! URL::route('role.edit', $role->id) !!}" class="btn btn-basecolor1 btn-mb ">Edit</a>
									@endif
									@if(can_access_route('role.show',$userPermissoins))
									<a href="{!! URL::route('role.show', $role->id) !!}" class="btn btn-basecolor1 btn-mb ">View</a>
									@endif
								</td>
							</tr>
						@endforeach
						</tbody>
					</table>
				</div>
			</section>
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
		/*my js*/
	</script>
@stop