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
                Parent Details
            </h3>
            <div class="comdehead_right">
            </div>
            <div class="backwardright"><a href="{{ route('user.list') }}"><i class="fa fa-backward"></i></a></div>
        </div>
    </div>
    <!-- advance filter box -->

    <!-- company details -->
    <div class="company_profiles card-body">
        <div class="table-responsive adminbio_table">
            <table class="table table-striped table-bordered customdatatable" id="parentDetailsTable">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">name</th>
                        <th scope="col">Relation</th>
                        <th scope="col">Phone No.</th>
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
    <script>
        let id = @json($id);
    </script>
    <script src="{{ asset('assets/custom/js/datatableajax.js') }}"></script>
@endpush
