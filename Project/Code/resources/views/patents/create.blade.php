@extends('dashboards.users.layouts.user-dash-layout')
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
@section('content')
<style type="text/css">
    .dropdown-toggle {
        height: 40px;
        width: 400px !important;
    }

    body label:not(.input-group-text) {
        margin-top: 10px;
    }

    body .my-select {
        background-color: #fff;
        color: #212529;
        border: #000 0.2 solid;
        border-radius: 10px;
        padding: 6px 20px;
        width: 100%;
        font-size: 14px;
    }
</style>
<div class="container">

    @if ($errors->any())
    <div class="alert alert-danger">
    <strong>{{ __('message.whoops') }}</strong> {{ __('message.problem_with_input') }}<br><br>
    <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="col-md-8 grid-margin stretch-card">
        <div class="card" style="padding: 16px;">
            <div class="card-body">
                <h4 class="card-title">{{ __('message.add_other_academic_works') }}</h4>
                <p class="card-description">{{ __('message.enter_details_for_other_academic_works') }}</p>
                <form class="forms-sample" action="{{ route('patents.store') }}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label for="exampleInputac_name" class="col-sm-3">{{ __('message.name2') }}</label>
                        <div class="col-sm-9">
                            <input type="text" name="ac_name" class="form-control" placeholder="{{ __('message.name') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputac_type" class="col-sm-3 ">{{ __('message.Type') }}</label>
                        <div class="col-sm-4">
                            <select id="category" class="custom-select my-select" name="ac_type">
                                <option value="" disabled selected >---- {{ __('message.select_category') }} ----</option>
                                <optgroup label="{{ __('message.patent') }}">
                                    <option value="สิทธิบัตร">{{ __('message.patent') }}</option>
                                    <option value="สิทธิบัตร (การประดิษฐ์)">{{ __('message.patent_invention') }}</option>
                                    <option value="สิทธิบัตร (การออกแบบผลิตภัณฑ์)">{{ __('message.patent_design') }}</option>
                                </optgroup>
                                <optgroup label="{{ __('message.utility_model') }}">
                                    <option value="อนุสิทธิบัตร">{{ __('message.utility_model') }}</option>
                                </optgroup>
                                <optgroup label="{{ __('message.copyright') }}">
                                    <option value="ลิขสิทธิ์">{{ __('message.copyright') }}</option>
                                    <option value="ลิขสิทธิ์ (วรรณกรรม)">{{ __('message.copyright_literature') }}</option>
                                    <option value="ลิขสิทธิ์ (ตนตรีกรรม)">{{ __('message.copyright_music') }}</option>
                                    <option value="ลิขสิทธิ์ (ภาพยนตร์)">{{ __('message.copyright_film') }}</option>
                                    <option value="ลิขสิทธิ์ (ศิลปกรรม)">{{ __('message.copyright_art') }}</option>
                                    <option value="ลิขสิทธิ์ (งานแพร่เสี่ยงแพร่ภาพ)">{{ __('message.copyright_broadcasting') }}</option>
                                    <option value="ลิขสิทธิ์ (โสตทัศนวัสดุ)">{{ __('message.copyright_audio_visual') }}</option>
                                    <option value="ลิขสิทธิ์ (งานอื่นใดในแผนกวรรณคดี/วิทยาศาสตร์/ศิลปะ)">{{ __('message.copyright_literary_science_art') }}</option>
                                    <option value="ลิขสิทธิ์ (สิ่งบันทึกเสียง)">{{ __('message.copyright_sound_recordings') }}</option>
                                </optgroup>
                                <optgroup label="{{ __('message.others') }}">
                                    <option value="ความลับทางการค้า">{{ __('message.commercial_secrets') }}</option>
                                    <option value="เครื่องหมายการค้า">{{ __('message.trademarks') }}</option>
                                </optgroup>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputac_year" class="col-sm-3 ">{{ __('message.date_received') }}</label>
                        <div class="col-sm-4">
                            <input type="date" name="ac_year" class="form-control" placeholder="ac_year">

                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputac_refnumber" class="col-sm-3 ">{{ __('message.registration_number') }}</label>
                        <div class="col-sm-4">
                            <input type="text" name="ac_refnumber" class="form-control" placeholder="{{ __('message.registration_number') }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="exampleInputac_doi" class="col-sm-3 ">{{ __('message.faculty_in_department') }}</label>
                        <div class="col-sm-9">
                            <div class="table-responsive">
                                <table class="table table-hover small-text" id="dynamicAddRemove">
                                    <tr>
                                    <td>
              <select id='selUser0' style='width: 200px;' name="moreFields[0][userid]">
                 <option value=''>{{ __('message.select_user') }}</option>
                   @foreach($users as $user)
            <option value="{{ $user->id }}">
                @if (app()->getLocale() == 'th')
                    {{ $user->fname_th }} {{ $user->lname_th }}
                @else
                    {{ $user->fname_en }} {{ $user->lname_en }}
                @endif
            </option>
        @endforeach
    </select>
</td>

                                        <td><button type="button" name="add" id="add-btn2" class="btn btn-success btn-sm"><i class="fas fa-plus"></i></button>
                                        </td>
                                    </tr>
                                </table>
                                <!-- <input type="button" name="submit" id="submit" class="btn btn-info" value="Submit" />-->
                            </div>
                        </div>
                    </div>
                    <!-- <div class="form-group row">
                        <label for="exampleInput" class="col-sm-3 ">บุคลลภายนอก</label>
                        <div class="col-sm-9">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dynamic_field">
                                    <tr>
                                        <td><input type="text" name="fname[]" placeholder="Enter Author FName" class="form-control name_list" /></td>
                                        <td><input type="text" name="lname[]" placeholder="Enter Author LName" class="form-control name_list" /></td>
                                        <td><button type="button" name="add" id="add" class="btn btn-success btn-sm"><i class="fas fa-plus"></i></button>
                                        </td>
                                    </tr>
                                </table>
                                <!-- <input type="button" name="submit" id="submit" class="btn btn-info" value="Submit" />
                            </div>
                        </div>
                    </div> -->
                    <div class="form-group row ">
                        <label for="exampleInputpaper_doi" class="col-sm-3 ">{{ __('message.external_person') }}</label>
                        <div class="col-sm-9">
                            <div class="table-responsive">
                                <table class="table table-hover small-text" id="tb">
                                    <tr class="tr-header">
                                        
                                        <th>{{ __('message.first_name') }}</th>
                                        <th>{{ __('message.last_name') }}</th>
                                        <!-- <th>Email Id</th> -->
                                            <!-- <button type="button" name="add" id="add" class="btn btn-success btn-sm"><i class="mdi mdi-plus"></i></button> -->
                                        <th><a href="javascript:void(0);" style="font-size:18px;" id="addMore2" title="Add More Person"><i class="mdi mdi-plus"></i></span></a></th>
                                    <tr>
                                        <!--  -->
                                        <td><input type="text" name="fname[]" class="form-control" placeholder="{{ __('message.first_name') }}" ></td>
                                        <td><input type="text" name="lname[]" class="form-control" placeholder="{{ __('message.last_name') }}" ></td>
                                        <!-- <td><input type="text" name="emailid[]" class="form-control"></td> -->
                                        <td><a href='javascript:void(0);' class='remove'><span><i class="mdi mdi-minus"></span></a></td>
                                    </tr>
                                </table>
                                <!-- <input type="button" name="submit" id="submit" class="btn btn-info" value="Submit" /> -->
                            </div>
                        </div>
                    </div>
                    <button type="submit" name="submit" id="submit" class="btn btn-primary me-2">{{ __('message.submit') }}</button>
                    <a class="btn btn-light" href="{{ route('patents.index')}}">{{ __('message.cancel') }}</a>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("#selUser0").select2()
        $("#head0").select2()

        var i = 0;

        $("#add-btn2").click(function() {

            ++i;
            $("#dynamicAddRemove").append('<tr><td><select id="selUser' + i + '" name="moreFields[' + i +
                '][userid]"  style="width: 200px;"><option value="">Select User</option>@foreach($users as $user)<option value="{{ $user->id }}">{{ $user->fname_th }} {{ $user->lname_th }}</option>@endforeach</select></td><td><button type="button" class="btn btn-danger btn-sm remove-tr">X</i></button></td></tr>'
            );
            $("#selUser" + i).select2()
        });
        $(document).on('click', '.remove-tr', function() {
            $(this).parents('tr').remove();
        });

    });
</script>
<script>
        $(document).ready(function() {
            $('#addMore2').on('click', function() {
                var data = $("#tb tr:eq(1)").clone(true).appendTo("#tb");
                data.find("input").val('');
            });
            $(document).on('click', '.remove', function() {
                var trIndex = $(this).closest("tr").index();
                if (trIndex > 1) {
                    $(this).closest("tr").remove();
                } else {
                    alert("Sorry!! Can't remove first row!");
                }
            });
        });
    </script>
<script type="text/javascript">
    $(document).ready(function() {
        var postURL = "<?php echo url('addmore'); ?>";
        var i = 1;

        $('#add').click(function() {
            i++;
            $('#dynamic_field').append('<tr id="row' + i +
                '" class="dynamic-added"><td><input type="text" name="fname[]" placeholder="Enter your Name" class="form-control name_list" /></td><td><input type="text" name="lname[]" placeholder="Enter your Name" class="form-control name_list" /></td><td><button type="button" name="remove" id="' +
                i + '" class="btn btn-danger btn-sm btn_remove">X</button></td></tr>');
        });

        $(document).on('click', '.btn_remove', function() {
            var button_id = $(this).attr("id");
            $('#row' + button_id + '').remove();
        });

    });
</script>
@endsection