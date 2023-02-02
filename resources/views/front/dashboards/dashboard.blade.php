@extends('front.layouts.Dispatch-layout')

@section('page-title',"Dashboard")

@section('css')
    <style>
        .message-notes {
            text-align: left;
        }
    </style>
@stop

@section('content')
    <main id="main" class="page-dashbaord" data-page="summary">
        <div class="pg-container container-fluid">
        @include('front.partials.errors')
        <!-- Content Area - [Start] -->
            <div id="main_content_area">
                <section class="section">
                    <div class="container-fluid">

                        <div class="hgroup ml-0">
                            <h1 class="lh-10 main-head divider-after left">Dashboard</h1>
                        </div>
                        <!--Cards-Div-Open-->
                        <div class="summary-hightlights">
                            <div class="row align-items-center">
                                @if(can_view_cards('vendor_card_count',$dashbord_cards_rights))
                                    <div class="attr-wrap col-6 col-sm-4 col-md-2">
                                        <div class="attr link-wrap">
                                            <h5 class="nomargin bf-color">Vendors</h5>
                                            <div class="h2 nomargin">{{$vendorCount}}</div>
                                        </div>
                                    </div>
                                @endif
                                @if(can_view_cards('zone_card_count',$dashbord_cards_rights))
                                    <div class="attr-wrap col-6 col-sm-4 col-md-2">
                                        <div class="attr link-wrap">
                                            <h5 class="nomargin bf-color">Zones</h5>
                                            <div class="h2 nomargin">{{$zonesCount}}</div>
                                        </div>
                                    </div>
                                @endif
                                @if(can_view_cards('joeys_card_count',$dashbord_cards_rights))
                                    <div class="attr-wrap col-6 col-sm-4 col-md-2">
                                        <div class="attr link-wrap">
                                            <h5 class="nomargin bf-color">Joeys</h5>
                                            <div class="h2 nomargin">{{$joeysCount}}</div>
                                        </div>
                                    </div>
                                @endif
                                @if(can_view_cards('shift_card_count',$dashbord_cards_rights))
                                    <div class="attr-wrap col-6 col-sm-4 col-md-2">
                                        <div class="attr link-wrap">
                                            <h5 class="nomargin bf-color">Shifts</h5>
                                            <div class="h2 nomargin">{{$shiftCount}}</div>
                                        </div>
                                    </div>
                                @endif
                                @if(can_view_cards('order_card_count',$dashbord_cards_rights))
                                    <div class="attr-wrap col-6 col-sm-4 col-md-2">
                                        <div class="attr link-wrap">
                                            <h5 class="nomargin bf-color">Orders</h5>
                                            <div class="h2 nomargin">{{$orderCount}}</div>
                                        </div>
                                    </div>
                                @endif
                                @if(can_view_cards('hub_card_count',$dashbord_cards_rights))
                                    <div class="attr-wrap col-6 col-sm-4 col-md-2">
                                        <div class="attr link-wrap">
                                            <h5 class="nomargin bf-color">Hubs</h5>
                                            <div class="h2 nomargin">{{$hubCount}}</div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <!--Cards-Div-Close-->
                        <div class="row">
                            @if(can_view_cards('joeys_list',$dashbord_cards_rights))
                                <div class="col-12 col-md-6 mt-4">
                                    <div class="box">
                                        <div class="card-body">
                                            <h4 class="card-title">Joeys On Duty</h4>
                                            <table class="table table-striped table-responsive tbl-responsive mb_last_row_hightlight mb_last_row_center">
                                                <thead>
                                                <tr>
                                                    <th width="10%" scope="col">Joey #</th>
                                                    <th width="13%" scope="col">Name</th>
                                                    <th width="12%" scope="col">Email</th>
                                                    <th width="15%" scope="col">Phone</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @forelse($joeys as $joey)
                                                    <tr>
                                                        <td class="valing-middle"><span
                                                                    class="bold basecolor1">{{$joey->id}}</span></td>
                                                        <td class="valing-middle">{{$joey->full_name}}</td>
                                                        <td class="valing-middle">{{$joey->email}}</td>
                                                        <td class="valing-middle">{{$joey->phone}}</td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td class="message-notes"></td>
                                                        <td class="message-notes"></td>
                                                        <td class="message-notes">No data available</td>
                                                        <td class="message-notes"></td>
                                                    </tr>
                                                @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if(can_view_cards('vendor_list',$dashbord_cards_rights))
                                <div class="col-12 col-md-6 mt-4">
                                    <div class="box">
                                        <div class="card-body">
                                            <h4 class="card-title">Vendors</h4>
                                            <table class="table table-striped table-responsive tbl-responsive mb_last_row_hightlight mb_last_row_center">
                                                <thead>
                                                <tr>
                                                    <th width="10%" scope="col">Ref no#</th>
                                                    <th width="13%" scope="col">Name</th>
                                                    <th width="12%" scope="col">Email</th>
                                                    <th width="15%" scope="col">Phone</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @forelse($vendors as $vendor)
                                                    <tr>
                                                        <td class="valing-middle"><span
                                                                    class="bold basecolor1">{{$vendor->id}}</span></td>
                                                        <td class="valing-middle">{{$vendor->full_name}}</td>
                                                        <td class="valing-middle">{{$vendor->email}}</td>
                                                        <td class="valing-middle">{{$vendor->phone}}</td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td class="message-notes"></td>
                                                        <td class="message-notes"></td>
                                                        <td class="message-notes">No data available</td>
                                                        <td class="message-notes"></td>
                                                    </tr>
                                                @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if(can_view_cards('recent_e_commerce_list',$dashbord_cards_rights))
                                <div class="col-12 col-md-6 mt-4">
                                    <div class="box">
                                        <div class="card-body">
                                            <h4 class="card-title">Recent E-Commerce Routes</h4>
                                            <table class="table table-striped table-responsive tbl-responsive mb_last_row_hightlight mb_last_row_center dashboard-table">
                                                <thead>
                                                <tr>
                                                    <th width="10%" scope="col">Route #</th>
                                                    <th width="13%" scope="col">Hub</th>
                                                    <th width="12%" scope="col">Zone</th>
                                                    <th width="15%" scope="col">Created At</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @forelse ($recentRoutes as $routes)
                                                    <tr>
                                                        <td class="valing-middle"><span
                                                                    class="bold basecolor1">{{$routes->id}}</span></td>
                                                        <td class="valing-middle">{{ optional($routes->Hub)->title ?? 'N/A' }}</td>
                                                        <td class="valing-middle">{{ optional($routes->Zones)->address ?? 'N/A' }}</td>
                                                        <td class="valing-middle">{{ $routes->created_at }}</td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td class="message-notes">1</td>
                                                        <td class="message-notes"></td>
                                                        <td class="message-notes">No data available</td>
                                                        <td class="message-notes"></td>
                                                    </tr>
                                                @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if(can_view_cards('recent_grocery_list',$dashbord_cards_rights))
                                <div class="col-12 col-md-6 mt-4">
                                    <div class="box">
                                        <div class="card-body">
                                            <h4 class="card-title">Recent Grocery Orders</h4>
                                            <table class="table table-striped table-responsive tbl-responsive mb_last_row_hightlight mb_last_row_center">
                                                <thead>
                                                <tr>
                                                    <th width="10%" scope="col">Order no.</th>
                                                    <th width="13%" scope="col">Name</th>
                                                    <th width="12%" scope="col">Email</th>
                                                    <th width="15%" scope="col">Phone</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @forelse($recentOrders as $recentOrder)
                                                    <tr>
                                                        <td class="valing-middle"><span
                                                                    class="bold basecolor1">{{$recentOrder->id}}</span>
                                                        </td>
                                                        <td class="valing-middle">
                                                            {{ (isset($recentOrder->LastDropOffTasks->SprintContacts))? $recentOrder->LastDropOffTasks->SprintContacts->name : '' }}
                                                        </td>
                                                        <td class="valing-middle">
                                                            {{ (isset($recentOrder->LastDropOffTasks->SprintContacts))? $recentOrder->LastDropOffTasks->SprintContacts->email : '' }}
                                                        </td>
                                                        <td class="valing-middle">
                                                            {{ (isset($recentOrder->LastDropOffTasks->SprintContacts))? $recentOrder->LastDropOffTasks->SprintContacts->phone : '' }}
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td class="message-notes"></td>
                                                        <td class="message-notes"></td>
                                                        <td class="message-notes">No data available</td>
                                                        <td class="message-notes"></td>
                                                    </tr>
                                                @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                </section>
            </div>
            <!-- Content Area - [/end] -->
        </div>
    </main>
@stop

@section('js')
    <script>
//        jQuery(document).ready(function () {
//
//            //appConfig.set( 'dt.searching', true );
//            $('#roleTable').DataTable({
//                "paging": false
//            });
//
//            $('.dashboard-table').dataTable({
//                "oLanguage": {
//                    "sEmptyTable": "My Custom Message On Empty Table"
//                }
//            });
//
//        });
    </script>
@stop