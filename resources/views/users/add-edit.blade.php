@extends('layouts.app', ['isSidebar' => true, 'isNavbar' => true, 'isFooter' => true])
@section('patient', 'active')
@push('styles')
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
@endpush
@section('content')
    <div class="dashboard_mainsec">
        <!-- company Details -->
        <div class="companydetails_head">
            <h3 class="heading_title">
                {{ $pageTitle }}
            </h3>
            <div class="backwardright"><a href="{{ route('user.list') }}"><i class="fa fa-backward"></i></a></div>
        </div>
        <div class="company_profiles card-body">
            <form id="userDetails" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="uuid" id="uuid" value="{{ $isPatient->uuid ?? '' }}">
                <div class="row">
                    <div class="col-lg-12 col-md-12 ">
                        <div class="doctor-details-style clinicsheading_title">
                        </div>
                    </div>
                    <div class="col-md-4 adfilter-single">
                        <label for="">Name</label>
                        <input type="text" class="form-control" name="name" id="name"
                            placeholder="Enter Patient Name" value="{{ old('name', $isPatient->name ?? '') }}">
                        @error('name')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-4 adfilter-single">
                        <label for="">Date of Birth</label>
                        <input type="text" class="form-control datepicker" name="date" id="date"
                            placeholder="Enter Date" value="{{ old('date', $isPatient->date ?? '') }}">
                        @error('date')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-md-4 adfilter-single">
                        <label for="class">Class</label>
                        <select name="class" id="class" class="form-control">
                            <option value="">---Select Class---</option>
                            <option value="1">I</option>
                            <option value="2">II</option>
                            <option value="3">III</option>
                            <option value="4">IV</option>
                            <option value="5">V</option>
                            <option value="6">VI</option>
                            <option value="7">VII</option>
                            <option value="8">VIII</option>
                            <option value="9">IX</option>
                            <option value="10">X</option>
                            <option value="11">XI</option>
                            <option value="12">XII</option>


                        </select>
                        @error('class')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-4 adfilter-single">
                        <label for="">zip_code</label>
                        <input type="number" class="form-control" name="zip_code" id="zip_code"
                            placeholder=" Enter zip code" value="" data-listener-added_bddbe92d="true">
                        @error('zip_code')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-md-4 adfilter-single">
                        <label for="">Country</label>
                        <select name="country_id" class="form-control select_country" id="select_country">
                            <option value="">---Select---</option>
                            {{ getCountry('') }}
                        </select>
                        @error('country_id')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-4 adfilter-single">
                        <label for="">State</label>
                        <select name="state_id" id="state_id" class="form-control select_state">
                            <option value="">---Select---</option>
                        </select>
                        @error('state_id')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-4 adfilter-single">
                        <label for="">City</label>
                        <select name="city_id" id="city_id" class="form-control select_city">
                            <option value="">---Select---</option>
                        </select>
                        @error('city_id')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-6 adfilter-single">
                        <label for="">Address</label>
                        <textarea name="address" id="address" cols="30" rows="3" class="form-control">{{ old('address', $isPatient->address ?? '') }}</textarea>

                        @error('address')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-md-6 adfilter-single">
                        <label for="">Profile Images</label>
                        <input type="file" class="form-control" name="profile_images" id="profile_images"
                            placeholder="">
                        @error('profile_images')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <strong>Additional Fields</strong>
                    <div class="dynamicAddRemove" id="#dynamicAddRemove">

                        <input type="hidden" value="{{ isset($data) ? $data->additional_fields : '' }}"
                            id="additional_fields" class="additional_fields">

                    </div>
                    <div class="col-md-6">
                        <div class="position-relative form-group">
                            <button type="button" name="add" id="dynamic-ar" class="btn btn-outline-primary">+Add
                                More
                                Fields</button>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-cancle">Cancel</button>
                        <button type="submit" class="btn btn-book">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="{{ asset('assets/js/custom/userDetails.js') }}"></script>
    <script>
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd'
        });
    </script>
    <script>
        $(document).ready(function() {
            var i = 1;
            var $dynamicContainer = $(".dynamicAddRemove");

            // Fetch relations from the server
            function fetchRelations() {
                return $.ajax({
                    url: APP_URL + "/ajax/relation",
                    method: 'GET',
                    dataType: 'json'
                });
            }

            // Generate HTML for a new field row
            function generateFieldHtml(name, phone, relationOptions) {
                return `
        <div class="form-row">
            <div class="col-md-3">
                <div class="position-relative form-group">
                    <label class="">Parent Name</label>
                    <input type="text" class="form-control field-name" value="${name}" 
                        name="f[${i}][name]" placeholder="Enter Parent Name">
                </div>
            </div>
            <div class="col-md-3">
                <div class="position-relative form-group">
                    <label class="">Phone Number</label>
                    <input type="text" class="form-control field-phone" value="${phone}" 
                        name="f[${i}][phone]" placeholder="Enter Phone Number">
                </div>
            </div>
            <div class="col-md-3">
                <div class="position-relative form-group">
                    <label class="">Relation</label>
                    <select class="form-control field-relation" name="f[${i}][relation]">
                        ${relationOptions}
                    </select>
                </div>
            </div>
            <button type="button" class="btn btn-outline-danger remove-input-field">Delete</button>
        </div>`;
            }

            // Populate relations and set up initial event listeners
            fetchRelations().then(function(relations) {
                // Prepare options for the dropdown from the fetched relations data
                var relationOptions = relations.map(relation =>
                    `<option value="${relation.id}">${relation.name}</option>`
                ).join('');

                // Add new row on button click
                $("#dynamic-ar").on('click', function() {
                    if (i <= 6) { // Allow only up to 6 fields
                        $dynamicContainer.append(generateFieldHtml('', '', relationOptions));
                        i++;
                        if (i === 6) {
                            $('.additional_fields').prop('disabled',
                                true); // Disable button when limit reached
                        }
                    }
                });

                // Remove field row on 'Delete' button click
                $(document).on('click', '.remove-input-field', function() {
                    $(this).closest('.form-row').remove();
                    i--;
                    $('.additional_fields').prop('disabled',
                        false); // Re-enable button if fields are less than limit
                });
            })
        });
    </script>
@endpush
