@extends('layouts.app', ['isSidebar' => true, 'isNavbar' => true, 'isFooter' => true])
@section('patient', 'active')
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables/responsive.bootstrap4.min.css') }}">
@endpush
@section('content')
    <div class="dashboard_mainsec">
        <!-- company Details -->
        <div class="companydetails_head">
            <h3 class="heading_title">
                List
            </h3>
            <div class="comdehead_right">

                <a href="{{ route('user.add') }}" class="btn btn-primary">Add
                </a>
            </div>
        </div>
    </div>
    <!-- advance filter box -->

    <!-- company details -->
    <div class="company_profiles card-body">
        <div class="table-responsive adminbio_table">
            <table class="table table-striped table-bordered customdatatable" id="usersTable">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">image</th>
                        <th scope="col">name</th>
                        <th scope="col">dob</th>
                        <th scope="col">class</th>
                        <th scope="col">address</th>
                        <th scope="col">zip code</th>
                        <th scope="col">country</th>
                        <th scope="col">state</th>
                        <th scope="col">city</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('assets/custom/js/datatableajax.js') }}"></script>
@endpush
