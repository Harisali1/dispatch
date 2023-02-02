@extends('front.layouts.Dispatch-layout')

@section('page-title',"Dispatch Map View")

@section('css')
	<style>
		/*my css*/
	</style>
@stop

@section('content')
    <main id="main" class="page-dispatch" data-page="dispatch">
        <div class="pg-container container-fluid">
            <!-- Content Area - [Start] -->
            <div id="main_content_area" class="style_2">
				<div class="heading_area">
					<div class="container">
						<div class="hgroup divider-after center align-center">
							<h1 class="lh-10">Dispatch Map View</h1>
						</div>
					</div>
				</div>
				<div class="disp_map_view_wrap">
					<div class="row no-gutters">
						<!-- Sidebar -->
						<aside id="left_sidebar" class="col-12 col-lg-4">
							<div class="inner pr-30">
								<div class="widget_sidebar widget_filter">
									<h5 class="widgetTitle"><i class="icofont-user-alt-5"></i> Filter Results</h5>
									<div class="widgetInfo">
										<form action="" id="filter-summary" class="needs-validation" novalidate>
											<div class="form-group no-min-h">
												<label for="endDate">Filter by zones</label>
												<select id="filterByzone" name="filterByzone" class="form-control form-control-lg">
													<option value="0" disabled selected>Select Zone</option>
													<option value="">Zone 1</option>
													<option value="">Zone 2</option>
													<option value="">Zone 3</option>
												</select>

												<div class="selected_list">
													<h5>Selected Zones</h5>
													<ul>
														<li><span class="selected_lbl">Zone 1</span></li>
														<li><span class="selected_lbl">Zone 2</span></li>
														<li><span class="selected_lbl">Zone 3</span></li>
														<li><span class="selected_lbl">Zone 4</span></li>
													</ul>
												</div>
											</div>
											<div class="divider sm"></div>
											<div class="form-group">
												<label for="endDate">Filter by Vendor</label>
												<select id="filterByvendor" name="filterByvendor" class="form-control form-control-lg">
													<option value="0" disabled selected>Select Vendor</option>
													<option value="">Vendor 1</option>
													<option value="">Vendor 2</option>
													<option value="">Vendor 3</option>
												</select>

												<div class="selected_list">
													<h5>Selected Vendor</h5>
													<ul>
														<li><span class="selected_lbl">Vendor 1</span></li>
														<li><span class="selected_lbl">Vendor 2</span></li>
														<li><span class="selected_lbl">Vendor 3</span></li>
														<li><span class="selected_lbl">Vendor 4</span></li>
													</ul>
												</div>
											</div>
											<div class="divider sm"></div>
											<div class="btn-group nomargin align-right">
												<button type="submit" disabled class="btn btn-primary btn-xs submitButton mb-fluid mb-align-center">Filter</button>
											</div>

											<div class="orders_result"></div>

											<div class="order_found_btn d-flex align-items-center cursor-pointer">
												<img src="assets/images/positive-vote.png" alt="">
												<div class="btn_info f20">We’ve Found 7 order based on your search</div>
												<i class="icofont-rounded-right"></i>
											</div>
										</Form>

										<div class="orders_assign_wrap">
											<a href="#" class="back_btn">
												<i class="icofont-rounded-left"></i> Back
											</a>

											<div class="order_assign_list_box">
												<div class="order_assign_list">
													<table class="table tbl-responsive mb_last_row_hightlight mb_last_row_center">
														<thead>
															<tr>
																<th scope="col" width="100px">Ref no.</th>
																<th scope="col" width="122px">Date / Time</th>
																<th scope="col" width="100px">Status</th>
																<th scope="col" width="100px">Action</th>
															</tr>
														</thead>
														<tbody>
															<tr>
																<td class="basecolor1 bold">CR-455595</td>
																<td>20:00:00 06-02</td>
																<td class="color-bright-red">Merchant accepted</td>
																<td><a href="#" class="btn btn-basecolor1 full-w btn-border btn-mb">Select</a></td>
															</tr>
															<tr>
																<td class="basecolor1 bold">CR-455595</td>
																<td>20:00:00 06-02</td>
																<td class="color-bright-red">Merchant accepted</td>
																<td><a href="#" class="btn btn-basecolor1 full-w btn-border btn-mb">Select</a></td>
															</tr>
															<tr>
																<td class="basecolor1 bold">CR-455595</td>
																<td>20:00:00 06-02</td>
																<td class="color-bright-red">Merchant accepted</td>
																<td><a href="#" class="btn btn-basecolor1 full-w btn-border btn-mb">Select</a></td>
															</tr>
															<tr>
																<td class="basecolor1 bold">CR-455595</td>
																<td>20:00:00 06-02</td>
																<td class="color-bright-red">Merchant accepted</td>
																<td><a href="#" class="btn btn-basecolor1 full-w btn-border btn-mb">Select</a></td>
															</tr>
															<tr>
																<td class="basecolor1 bold">CR-455595</td>
																<td>20:00:00 06-02</td>
																<td class="color-bright-red">Merchant accepted</td>
																<td><a href="#" class="btn btn-basecolor1 full-w btn-border btn-mb">Select</a></td>
															</tr>
															<tr>
																<td class="basecolor1 bold">CR-455595</td>
																<td>20:00:00 06-02</td>
																<td class="color-bright-red">Merchant accepted</td>
																<td><a href="#" class="btn btn-basecolor1 full-w btn-border btn-mb">Select</a></td>
															</tr>
															<tr>
																<td class="basecolor1 bold">CR-455595</td>
																<td>20:00:00 06-02</td>
																<td class="color-bright-red">Merchant accepted</td>
																<td><a href="#" class="btn btn-basecolor1 full-w btn-border btn-mb">Select</a></td>
															</tr>
															<tr>
																<td class="basecolor1 bold">CR-455595</td>
																<td>20:00:00 06-02</td>
																<td class="color-bright-red">Merchant accepted</td>
																<td><a href="#" class="btn btn-basecolor1 full-w btn-border btn-mb">Select</a></td>
															</tr>
															<tr>
																<td class="basecolor1 bold">CR-455595</td>
																<td>20:00:00 06-02</td>
																<td class="color-bright-red">Merchant accepted</td>
																<td><a href="#" class="btn btn-basecolor1 full-w btn-border btn-mb">Select</a></td>
															</tr>
															<tr>
																<td class="basecolor1 bold">CR-455595</td>
																<td>20:00:00 06-02</td>
																<td class="color-bright-red">Merchant accepted</td>
																<td><a href="#" class="btn btn-basecolor1 full-w btn-border btn-mb">Select</a></td>
															</tr>
															<tr>
																<td class="basecolor1 bold">CR-455595</td>
																<td>20:00:00 06-02</td>
																<td class="color-bright-red">Merchant accepted</td>
																<td><a href="#" class="btn btn-basecolor1 full-w btn-border btn-mb">Select</a></td>
															</tr>
															<tr>
																<td class="basecolor1 bold">CR-455595</td>
																<td>20:00:00 06-02</td>
																<td class="color-bright-red">Merchant accepted</td>
																<td><a href="#" class="btn btn-basecolor1 full-w btn-border btn-mb">Select</a></td>
															</tr>
														</tbody>
													</table>
												</div>
												<div class="assign_btn">
													<a href="#" class="btn btn-primary full-w">Assign 2 orders now <i class="icofont-rounded-right"></i></a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</aside>
						<aside id="right_content" class="col-12 col-lg-8">
							<div id="map" class="inner google_map">
							</div>
						</aside>
					</div>
				</div>
            </div>
			<!-- Content Area - [/end] -->

			@include('front.layouts.includes.footer')
        </div>
    </main>
@stop

@section('js')
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDCjLC_NDa34ly8UcT9xMd8tXiPdaLP2FE&callback=initMap&libraries=&v=weekly&channel=2" async></script>
	<script>
        var map;
        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: 43.822455717638356, lng: -79.53075990399391},
                zoom: 8,
                disableDefaultUI: true,
            });
        }
	</script>
@stop