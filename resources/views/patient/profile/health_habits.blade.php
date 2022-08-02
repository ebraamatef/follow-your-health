@extends('layouts.app')

@section('content')
<div class="mb-5" style="width: 100%; height: 150px; background-image:  url('{{ URL('/storage/doctor_banner.jpg') }}'); background-repeat: no-repeat; background-size: cover">
    <div class="d-flex align-items-center justify-content-center" style="width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5);">
        <div class='col-12 col-md-10 text-center'>
            <p class='text-white fs-1'><b>Medical Profile</b></p>
        </div>
    </div>
</div>
<div class="container">
<div class="pb-4 card border-0 rounded- mb-5 mt-5">
    <div class="card-header border-1 primary_color mb-4 fs-4 d-flex align-items-center border-0 rounded-0">
    </div>
<div class="row justify-content-center">
    <div class="col-11 mb-4">
        <form action=" {{url('/patient/profile/health/edit')}}" >
            @csrf
            @method('PUT')<div>
                <h4><b>Health Habits And Personal Safty</b></h4>
            </div>
            <div class="col table-responsive">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>Exercise</th>
                            <td colspan="4">
                                <div class="form-check">
                                    <input class="form-check-input" name="exercise_patient" type="radio" id="sedentary_patient" value="sedentary" {{ ($test->exercise=="sedentary")? "checked" : "" }}>
                                    <label class="form-check-label" for="sedentary_patient">Sedentary (No exercise)</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="exercise_patient" type="radio" id="mild_exercise_patient" value="mild exercise" {{ ($test->exercise=="mild exercise")? "checked" : "" }}>
                                    <label class="form-check-label" for="mild_exercise_patient">Mild exercise (i.e., climb stairs, walk 3 blocks, golf)</label>
                                </div> 
                                <div class="form-check">
                                    <input class="form-check-input" name="exercise_patient" type="radio" id="occasional_vigorous_exercise_patient" value="occasional vigorous"{{ ($test->exercise=="occasional vigorous")? "checked" : "" }} >
                                    <label class="form-check-label" for="occasional_vigorous_exercise_patient">Occasional vigorous exercise (i.e., work or recreation, less than 4x/week for 30 min.)</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="exercise_patient" type="radio" id="regular_vigorous_exercise_patient" value="Regular"{{ ($test->exercise=="Regular")? "checked" : "" }}>
                                    <label class="form-check-label" for="regular_vigorous_exercise_patient">Regular vigorous exercise (i.e., work or recreation 4x/week for 30 minutes)</label>
                                </div> 
                            </td>
                        </tr>
                        <tr>
                            <th scope="row" rowspan="5">Diet</th>
                            <td colspan="2">Are you dieting?</td>
                            <td >
                                <div class="form-check-inline">
                                    <input class="form-check-input" type="radio" name="are_you_dieting_patient" id="are_you_dieting_patient_yes"
                                     value="yes"{{ ($test->dieting=="yes")? "checked" : "" }}>
                                    <label class="form-check-label" for="are_you_dieting_patient_yes">
                                        Yes
                                    </label>
                                </div> 
                            </td>
                        <td>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" name="are_you_dieting_patient" id="are_you_dieting_patient_no"
                                 value="No"{{ ($test->dieting=="No")? "checked" : "" }}>
                                <label class="form-check-label" for="are_you_dieting_patient_no">
                                    No
                                </label>
                            </div>
                            </td>  
                        </tr>
                        <tr>
                            <td colspan="2">If yes, are you on a physician prescribed medical diet? </td>
                            <td>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" name="physician_prescribed_medical_diet" id="physician_prescribed_medical_diet_yes"  
                                value="yes"{{ ($test->medical_diet=="yes")? "checked" : "" }}>
                            <label class="form-check-label" for="physician_prescribed_medical_diet_yes">
                                Yes
                            </label>
                            </div> 
                        </td>
                        <td>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" name="physician_prescribed_medical_diet" id="physician_prescribed_medical_diet_no" 
                                value="No" {{ ($test->medical_diet=="no")? "checked" : "" }}>
                                <label class="form-check-label" for="physician_prescribed_medical_diet_no">
                                    No
                                </label>
                            </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"># of meals you eat in an average day? </td>
                            <td colspan="2">
                                <input class="form-control" type="field" name="n_of_meals_patient" id="" value="{{$test->meals_average}}">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                Rank salt intake 
                            </td>
                            <td colspan="2">
                                <div class="form-check">
                                    <input class="form-check-input" name="rank_salt_intake_patient" type="radio" id="high_salt_patient"
                                     value="high"{{ ($test->Rank_salt=="high")? "checked" : "" }}>
                                    <label class="form-check-label" for="high_salt_patient"> High</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rank_salt_intake_patient" type="radio" id="medium_salt_patient"
                                     value="medium"{{ ($test->Rank_salt=="medium")? "checked" : "" }}>
                                    <label class="form-check-label" for="medium_salt_patient">Medium</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rank_salt_intake_patient" type="radio" id="low_salt_patient"
                                     value="low"{{ ($test->Rank_salt=="low")? "checked" : "" }}>
                                    <label class="form-check-label" for="low_salt_patient">Low</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            
                        </tr>
                        <tr>
                            <th scope="row" rowspan="2">Caffeine</th>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" name="none_caffeine_patient" type="checkbox" id="none_caffeine_patient" 
                                    value="none"{{ ($test->caffeine=="none")? "checked" : "" }}>
                                    <label class="form-check-label" for="none_caffeine_patient">None</label>
                                </div>  
                            </td> 
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" name="coffee" type="checkbox" id="coffee"
                                     value="coffee"{{ ($test->caffeine=="coffee")? "checked" : "" }}>
                                    <label class="form-check-label" for="coffee">Coffee</label>
                                </div>  
                            </td> 
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" name="tea_caffeine_patient" type="checkbox" id="tea_caffeine_patient" 
                                    value="tea"{{ ($test->caffeine=="tea")? "checked" : "" }} >
                                    <label class="form-check-label" for="tea_caffeine_patient">Tea</label>
                                </div>  
                            </td> 
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" name="cola_caffeine_patient" type="checkbox" id="cola_caffeine_patient"
                                     value="cola"{{ ($test->caffeine=="cola")? "checked" : "" }} >
                                    <label class="form-check-label" for="cola_caffeine_patient">Cola</label>
                                </div>  
                            </td> 
                        </tr>
                        <tr>
                            <td colspan="2">
                                # of cups/cans per day? 
                            </td>
                            <td colspan="2">
                                <input class="form-control" type="field" name="n_of_cups" id="" value="{{$test->cups}}" >
                            </td>
                        </tr>
                        <tr>
                            <th scope="row" rowspan="8">Alcohol</th>
                            <td colspan="2">Do you drink alcohol? </td>
                            <td colspan="">
                                <div class="form-check-inline">
                                    <input class="form-check-input" type="radio" name="do_you_drink_alcohol_patient" id="do_you_drink_alcohol_patient_yes"
                                     value="yes" {{ ($test->alchohol=="yes")? "checked" : "" }}  >
                                    <label class="form-check-label" for="do_you_drink_alcohol_patient_yes">
                                        Yes
                                    </label>
                                </div> 
                            </td>
                            <td>
                                <div class="form-check-inline">
                                    <input class="form-check-input" type="radio" name="do_you_drink_alcohol_patient" id="do_you_drink_alcohol_patient_no"
                                     value="no"{{ ($test->alchohol=="no")? "checked" : "" }} >
                                    <label class="form-check-label" for="do_you_drink_alcohol_patient_no">
                                        No
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">If yes, what kind? </td>
                            <td colspan="2">
                                <input class="form-control" type="field" name="If_yes_what_kind_patient"  value="{{$test->alchohol_kind}}" > 
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">How many drinks per week? </td>
                            <td colspan="2">
                                <input class="form-control" type="field" name="how_many_drinks_per_week_patient" id=""  value="{{$test->alchohol_rate}}" >
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">Are you concerned about the amount you drink? </td>
                            <td colspan="">
                                <div class="form-check-inline">
                                    <input class="form-check-input" type="radio" name="are_you_concerned_about_the_amount_you_drink_patient" id="are_you_concerned_about_the_amount_you_drink_patient_yes" 
                                    value="yes"{{ ($test->alchohol_concerned=="yes")? "checked" : "" }} >
                                    <label class="form-check-label" for="are_you_concerned_about_the_amount_you_drink_patient_yes">
                                        Yes
                                    </label>
                                </div> 
                            </td>
                            <td>
                                <div class="form-check-inline">
                                    <input class="form-check-input" type="radio" name="are_you_concerned_about_the_amount_you_drink_patient" 
                                    id="are_you_concerned_about_the_amount_you_drink_patient_no"
                                     value="no" {{ ($test->alchohol_concerned=="no")? "checked" : "" }} >
                                    <label class="form-check-label" for="are_you_concerned_about_the_amount_you_drink_patient_no">
                                        No
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">Have you considered stopping? </td>
                            <td>
                                <div class="form-check-inline">
                                    <input class="form-check-input" type="radio" name="have_you_considered_stopping_patient" id="have_you_considered_stopping_yes"
                                     value="yes" {{ ($test->alchohol_stopping=="yes")? "checked" : "" }} >
                                    <label class="form-check-label" for="have_you_considered_stopping_yes">
                                        Yes
                                    </label>
                                </div> 
                            </td>
                            <td>
                                <div class="form-check-inline">
                                    <input class="form-check-input" type="radio" name="have_you_considered_stopping_patient" id="have_you_considered_stopping_no"
                                     value="no" {{ ($test->alchohol_stopping=="no")? "checked" : "" }} >
                                    <label class="form-check-label" for="have_you_considered_stopping_no">
                                        No
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                           
                        </tr>
                        <tr>
                            <td colspan="2">Are you prone to “binge” drinking? </td>
                            <td>
                                <div class="form-check-inline">
                                    <input class="form-check-input" type="radio" name="are_you_prone_to_“binge”_drinking_patient" id="are_you_prone_to_“binge”_drinking_yes" 
                                    value="yes" {{ ($test->alchohol_binge=="yes")? "checked" : "" }}>
                                    <label class="form-check-label" for="are_you_prone_to_“binge”_drinking_yes">
                                        Yes
                                    </label>
                                </div> 
                            </td>
                            <td>
                                <div class="form-check-inline">
                                    <input class="form-check-input" type="radio" name="are_you_prone_to_“binge”_drinking_patient"
                                     id="are_you_prone_to_“binge”_drinking_no" 
                                     value="no"{{ ($test->alchohol_binge=="no")? "checked" : "" }}>
                                    <label class="form-check-label" for="are_you_prone_to_“binge”_drinking_no">
                                        No
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">Do you drive after drinking? </td>
                            <td>
                                <div class="form-check-inline">
                                    <input class="form-check-input" type="radio" name="do_you_drive_after_drinking_patient" id="do_you_drive_after_drinking_yes" 
                                    value="yes"{{ ($test->alchohol_drive=="yes")? "checked" : "" }}>
                                    <label class="form-check-label" for="do_you_drive_after_drinking_yes">
                                        Yes
                                    </label>
                                </div> 
                            </td>
                            <td>
                                <div class="form-check-inline">
                                    <input class="form-check-input" type="radio" name="do_you_drive_after_drinking_patient" id="do_you_drive_after_drinking_no" 
                                    value="no"  {{ ($test->alchohol_drive=="no")? "checked" : "" }} >
                                    <label class="form-check-label" for="do_you_drive_after_drinking_no">
                                        No
                                    </label>
                                </div>
                            </td>
                        </tr>
                            <th rowspan="2">Tobacco </th>
                            <td colspan="2">Do you use tobacco? </td>
                            <td>
                                <div class="form-check-inline">
                                    <input class="form-check-input" type="radio" name="do_you_use_tobacco_patient" id="do_you_use_tobacco_patient_yes"
                                     value="yes"{{ ($test->use_tobacco=="yes")? "checked" : "" }}>
                                    <label class="form-check-label" for="do_you_use_tobacco_patient_yes">
                                    Yes
                                    </label>
                                </div> 
                            </td>
                            <td>
                                <div class="form-check-inline">
                                    <input class="form-check-input" type="radio" name="do_you_use_tobacco_patient" id="do_you_use_tobacco_patient_no" 
                                    value="no" {{ ($test->use_tobacco=="no")? "checked" : "" }} >
                                    <label class="form-check-label" for="do_you_use_tobacco_patient_no">
                                    No
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                           
                           
                        </tr>
                        <tr>
                            
                           
                        </tr>
                        <tr>
                            <th rowspan="2">Drugs</th> 
                            <td colspan="2">Do you currently use recreational or street drugs? </td>
                            <td>
                                <div class="form-check-inline">
                                    <input class="form-check-input" type="radio" name="do_you_currently_use_recreational_or_street_drugs_patient"
                                     id="do_you_currently_use_recreational_or_street_drugs_patient_yes" 
                                     value="yes"{{ ($test->use_drugs=="yes")? "checked" : "" }} >
                                    <label class="form-check-label" for="do_you_currently_use_recreational_or_street_drugs_patient_yes">
                                    Yes
                                    </label>
                                </div> 
                            </td>
                            <td>
                                <div class="form-check-inline">
                                    <input class="form-check-input" type="radio" name="do_you_currently_use_recreational_or_street_drugs_patient" 
                                    id="do_you_currently_use_recreational_or_street_drugs_patient_no" 
                                    value="no"{{ ($test->use_drugs=="no")? "checked" : "" }} >
                                    <label class="form-check-label" for="do_you_currently_use_recreational_or_street_drugs_patient_no">
                                    No
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">Have you ever given yourself street drugs with a needle?  </td>
                            <td>
                                <div class="form-check-inline">
                                    <input class="form-check-input" type="radio" name="have_you_ever_given_yourself_street_drugs_with_a_needle_patient"
                                     id="have_you_ever_given_yourself_street_drugs_with_a_needle_patient_yes"
                                      value="yes" {{ ($test->drug_needle=="yes")? "checked" : "" }} >
                                    <label class="form-check-label" for="have_you_ever_given_yourself_street_drugs_with_a_needle_patient_yes">
                                    Yes
                                    </label>
                                </div> 
                            </td>
                            <td>
                                <div class="form-check-inline">
                                    <input class="form-check-input" type="radio" name="have_you_ever_given_yourself_street_drugs_with_a_needle_patient"
                                     id="have_you_ever_given_yourself_street_drugs_with_a_needle_patient_no"
                                      value="no"{{ ($test->drug_needle=="no")? "checked" : "" }} >
                                    <label class="form-check-label" for="have_you_ever_given_yourself_street_drugs_with_a_needle_patient_no">
                                    No
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th rowspan="5">Sex</th>
                            <td colspan="2">Are you sexually active? </td>
                            <td>
                                <div class="form-check-inline">
                                    <input class="form-check-input" type="radio" name="are_you_sexually_active_patient" id="are_you_sexually_active_patient_yes" 
                                    value="yes"  {{ ($test->sexually_active=="yes")? "checked" : "" }} >
                                    <label class="form-check-label" for="are_you_sexually_active_patient_yes">
                                    Yes
                                    </label>
                                </div> 
                            </td>
                            <td>
                                <div class="form-check-inline">
                                    <input class="form-check-input" type="radio" name="are_you_sexually_active_patient" id="are_you_sexually_active_patient_no"
                                     value="no" {{ ($test->sexually_active=="no")? "checked" : "" }} >
                                    <label class="form-check-label" for="are_you_sexually_active_patient_no">
                                    No
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">If yes, are you trying for a pregnancy? </td>
                            <td>
                                <div class="form-check-inline">
                                    <input class="form-check-input" type="radio" name="if_yes_are_you_trying_for_a_pregnancy_patient" id="if_yes_are_you_trying_for_a_pregnancy_patient_yes"
                                     value="yes"  {{ ($test->sexually_pregnancy=="no")? "checked" : "" }} >
                                    <label class="form-check-label" for="if_yes_are_you_trying_for_a_pregnancy_patient_yes">
                                    Yes
                                    </label>
                                </div> 
                            </td>
                            <td>
                                <div class="form-check-inline">
                                    <input class="form-check-input" type="radio" name="if_yes_are_you_trying_for_a_pregnancy_patient" id="if_yes_are_you_trying_for_a_pregnancy_patient_no" 
                                    value="no"  {{ ($test->sexually_pregnancy=="no")? "checked" : "" }} >
                                    <label class="form-check-label" for="if_yes_are_you_trying_for_a_pregnancy_patient_no">
                                    No
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                          
                            
                        </tr>
                        <tr>
                            <td colspan="2">Any discomfort with intercourse? </td>
                            <td>
                                <div class="form-check-inline">
                                    <input class="form-check-input" type="radio" name="if_not_trying_for_a_pregnancy_list_contraceptive_or_barrier_method_used_patient" id="if_not_trying_for_a_pregnancy_list_contraceptive_or_barrier_method_used_patient_yes" 
                                    value="yes"  {{ ($test->sexually_discomfort=="yes")? "checked" : "" }} >
                                    <label class="form-check-label" for="if_not_trying_for_a_pregnancy_list_contraceptive_or_barrier_method_used_patient_yes">
                                    Yes
                                    </label>
                                </div> 
                            </td>
                            <td>
                                <div class="form-check-inline">
                                    <input class="form-check-input" type="radio" name="if_not_trying_for_a_pregnancy_list_contraceptive_or_barrier_method_used_patient" id="if_not_trying_for_a_pregnancy_list_contraceptive_or_barrier_method_used_patient_no"
                                     value="no" {{ ($test->sexually_discomfort=="no")? "checked" : "" }} >
                                    <label class="form-check-label" for="if_not_trying_for_a_pregnancy_list_contraceptive_or_barrier_method_used_patient_no">
                                    No
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            
                                    
                                
                            </td>
                        </tr>
                        <tr>
                            <th rowspan="6">Personal Safety</th>
                            <td colspan="2">Do you live alone? </td>
                            <td>
                                <div class="form-check-inline">
                                    <input class="form-check-input" type="radio" name="do_you_live_alone_patient" id="do_you_live_alone_patient_yes" 
                                    value="yes" {{ ($test->live_alone=="yes")? "checked" : "" }} >
                                    <label class="form-check-label" for="do_you_live_alone_patient_yes">
                                    Yes
                                    </label>
                                </div> 
                            </td>
                            <td>
                                <div class="form-check-inline">
                                    <input class="form-check-input" type="radio" name="do_you_live_alone_patient" id="do_you_live_alone_patient_no" 
                                    value="no" {{ ($test->live_alone=="no")? "checked" : "" }} >
                                    <label class="form-check-label" for="do_you_live_alone_patient_no">
                                    No
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">Do you have frequent falls? </td>
                            <td>
                                <div class="form-check-inline">
                                    <input class="form-check-input" type="radio" name="do_you_have_frequent_falls_patient" id="do_you_have_frequent_falls_patient_yes" 
                                    value="yes" {{ ($test->frequent_falls=="yes")? "checked" : "" }} >
                                    <label class="form-check-label" for="do_you_have_frequent_falls_patient_yes">
                                    Yes
                                    </label>
                                </div> 
                            </td>
                            <td>
                                <div class="form-check-inline">
                                    <input class="form-check-input" type="radio" name="do_you_have_frequent_falls_patient" id="do_you_have_frequent_falls_patient_no"
                                     value="no" {{ ($test->frequent_falls=="no")? "checked" : "" }} >
                                    <label class="form-check-label" for="do_you_have_frequent_falls_patient_no">
                                    No
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">Do you have vision or hearing loss? </td>
                            <td>
                                <div class="form-check-inline">
                                    <input class="form-check-input" type="radio" name="do_you_have_vision_or_hearing_loss_patient" id="do_you_have_vision_or_hearing_loss_patient_yes"
                                     value="yes"   {{ ($test->vision_hearing_loss=="yes")? "checked" : "" }} >
                                    <label class="form-check-label" for="do_you_have_vision_or_hearing_loss_patient_yes">
                                    Yes
                                    </label>
                                </div> 
                            </td>
                            <td>
                                <div class="form-check-inline">
                                    <input class="form-check-input" type="radio" name="do_you_have_vision_or_hearing_loss_patient" id="do_you_have_vision_or_hearing_loss_patient_no"
                                     value="no"  {{ ($test->vision_hearing_loss=="no")? "checked" : "" }} >
                                    <label class="form-check-label" for="do_you_have_vision_or_hearing_loss_patient_no">
                                    No
                                    </label>
                                </div>
                            </td> 
                        </tr>
                        <tr>
                          
                        </tr>
                        <tr>
                            
                          
                        </tr>
                        <tr>
                           
                        </tr>
                    </tbody>
                </table>
                <div class="clearfix">
                    <button name="health_habits_patient_save_button" type="submit" class="btn btn-primary primary_color primary_color_border float-end">Save</button>
                </div>
            </div>
        </form> 
    </div>
</div>


{{-- --------------------------------------------------------------------------------------------------- --}}
<div class="row justify-content-center">
    <div class="col-11 mb-4">
        <form action="{{url('/patient/profile/health/mental')}}">
            <div>
                @csrf
                @method('PUT')
                <h4><b>Mental Health</b></h4>
            </div>
            <div class="col">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                        <td colspan="6">Is stress a major problem for you? </td>
                        <td>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" name="is_stress_a_major_problem_for_you_patient" id="is_stress_a_major_problem_for_you_patient_yes" 
                                value="yes"  {{ ($test->stress=="yes")? "checked" : "" }}>
                                <label class="form-check-label" for="is_stress_a_major_problem_for_you_patient_yes">
                                    Yes
                                </label>
                            </div> 
                        </td>
                        <td>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" name="is_stress_a_major_problem_for_you_patient" id="is_stress_a_major_problem_for_you_patient_no" 
                                value="no"  {{ ($test->stress=="no")? "checked" : "" }}>
                                <label class="form-check-label" for="is_stress_a_major_problem_for_you_patient_no">
                                    No
                                </label>
                            </div>
                        </td>
                        </tr>
                        <tr>
                        <td colspan="6">Do you feel depressed? </td>
                        <td>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" name="do_you_feel_depressed_patient" id="do_you_feel_depressed_patient_yes" 
                                value="yes" {{ ($test->depressed=="yes")? "checked" : "" }}>
                            <label class="form-check-label" for="do_you_feel_depressed_patient_yes">
                                Yes
                            </label>
                            </div> 
                        </td>
                        <td>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" name="do_you_feel_depressed_patient" id="do_you_feel_depressed_patient_no" 
                                value="no" {{ ($test->depressed=="no")? "checked" : "" }}>
                                <label class="form-check-label" for="do_you_feel_depressed_patient_no">
                                    No
                                </label>
                            </div>
                        </td>
                        </tr>
                        <tr>
                        <td colspan="6">Do you panic when stressed? </td>
                        <td>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" name="do_you_panic_when_stressed_patient" id="do_you_panic_when_stressed_patient_yes" 
                                value="yes" {{ ($test->panic=="yes")? "checked" : "" }}>
                            <label class="form-check-label" for="do_you_panic_when_stressed_patient_yes">
                                Yes
                            </label>
                            </div> 
                        </td>
                        <td>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" name="do_you_panic_when_stressed_patient" id="do_you_panic_when_stressed_patient_no"
                                 value="no"  {{ ($test->panic=="no")? "checked" : "" }}>
                                <label class="form-check-label" for="do_you_panic_when_stressed_patient_no">
                                    No
                                </label>
                            </div>
                        </td>
                        </tr>
                        <tr>
                        <td colspan="6">Do you have problems with eating or your appetite? </td>
                        <td>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" name="do_you_have_problems_with_eating_or_your_appetite_patient"
                                 id="do_you_have_problems_with_eating_or_your_appetite_patient_yes"
                                  value="yes"  {{ ($test->appetite=="yes")? "checked" : "" }}>
                            <label class="form-check-label" for="do_you_have_problems_with_eating_or_your_appetite_patient_yes">
                                Yes
                            </label>
                            </div> 
                        </td>
                        <td>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" name="do_you_have_problems_with_eating_or_your_appetite_patient"
                                 id="do_you_have_problems_with_eating_or_your_appetite_patient_no" 
                                 value="no" {{ ($test->appetite=="no")? "checked" : "" }}>
                                <label class="form-check-label" for="do_you_have_problems_with_eating_or_your_appetite_patient_no">
                                    No
                                </label>
                            </div>
                        </td>
                        </tr>
                        <tr>
                        <td colspan="6">Do you cry frequently? </td>
                        <td>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" name="do_you_cry_frequently_patient" id="do_you_cry_frequently_patient_yes"
                                 value="yes" {{ ($test->cry_frequently=="yes")? "checked" : "" }}>
                            <label class="form-check-label" for="do_you_cry_frequently_patient_yes">
                                Yes
                            </label>
                            </div> 
                        </td>
                        <td>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" name="do_you_cry_frequently_patient" id="do_you_cry_frequently_patient_no" 
                                value="no" {{ ($test->cry_frequently=="no")? "checked" : "" }}>
                                <label class="form-check-label" for="do_you_cry_frequently_patient_no">
                                    No
                                </label>
                            </div>
                        </td>
                        </tr>
                        <tr>
                        <td colspan="6">Have you ever attempted suicide? </td>
                        <td>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" name="have_you_ever_attempted_suicide_patient" id="have_you_ever_attempted_suicide_patient_yes"
                                 value="yes"  {{ ($test->suicide=="yes")? "checked" : "" }}>
                            <label class="form-check-label" for="have_you_ever_attempted_suicide_patient_yes">
                                Yes
                            </label>
                            </div> 
                        </td>
                        <td>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" name="have_you_ever_attempted_suicide_patient" id="have_you_ever_attempted_suicide_patient_no"
                                 value="no" {{ ($test->suicide=="no")? "checked" : "" }}>
                                <label class="form-check-label" for="have_you_ever_attempted_suicide_patient_no">
                                    No
                                </label>
                            </div>
                        </td>
                        </tr>
                        <tr>
                        <td colspan="6">Have you ever seriously thought about hurting yourself? </td>
                        <td>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" name="have_you_ever_seriously_thought_about_hurting_yourself_patient" 
                                id="have_you_ever_seriously_thought_about_hurting_yourself_patient_yes"
                                 value="yes" {{ ($test->hurting_yourself=="yes")? "checked" : "" }} >
                            <label class="form-check-label" for="have_you_ever_seriously_thought_about_hurting_yourself_patient_yes">
                                Yes
                            </label>
                            </div> 
                        </td>
                        <td>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" name="have_you_ever_seriously_thought_about_hurting_yourself_patient" 
                                id="have_you_ever_seriously_thought_about_hurting_yourself_patient_no"
                                 value="no" {{ ($test->hurting_yourself=="no")? "checked" : "" }}>
                                <label class="form-check-label" for="have_you_ever_seriously_thought_about_hurting_yourself_patient_no">
                                    No
                                </label>
                            </div>
                        </td>
                        </tr>
                        <tr>
                        <td colspan="6">Do you have trouble sleeping? </td>
                        <td>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" name="do_you_have_trouble_sleeping_patient" id="do_you_have_trouble_sleeping_patient_yes" 
                                value="yes" {{ ($test->trouble_sleeping=="yes")? "checked" : "" }}>
                            <label class="form-check-label" for="do_you_have_trouble_sleeping_patient_yes">
                                Yes
                            </label>
                            </div> 
                        </td>
                        <td>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" name="do_you_have_trouble_sleeping_patient" id="do_you_have_trouble_sleeping_patient_no" 
                                value="no" {{ ($test->trouble_sleeping=="no")? "checked" : "" }}>
                                <label class="form-check-label" for="do_you_have_trouble_sleeping_patient_no">
                                    No
                                </label>
                            </div>
                        </td>
                        </tr>
                        <tr>
                        <td colspan="6">Have you ever been to a counselor? </td>
                        <td>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" name="have_you_ever_been_to_a_counselor_patient" id="have_you_ever_been_to_a_counselor_patient_yes"
                                 value="yes"  {{ ($test->counselor=="yes")? "checked" : "" }} >
                            <label class="form-check-label" for="have_you_ever_been_to_a_counselor_patient_yes">
                                Yes
                            </label>
                            </div> 
                        </td>
                        <td>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" name="have_you_ever_been_to_a_counselor_patient" id="have_you_ever_been_to_a_counselor_patient_no"
                                 value="no"  {{ ($test->counselor=="no")? "checked" : "" }} >
                                <label class="form-check-label" for="have_you_ever_been_to_a_counselor_patient_no">
                                    No
                                </label>
                            </div>
                        </td>
                        </tr>
                    </tbody>
                </table>
                <div class="clearfix">
                    <button name="family_health_patient_save_button" type="submit" class="btn btn-primary primary_color primary_color_border float-end">Save</button>
                </div>
            </div>
        </form> 
    </div>
</div>
</div>
</div>



@endsection
