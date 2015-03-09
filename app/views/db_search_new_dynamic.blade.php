<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        @include('common.head', array('title', 'GradList - Frequently Asked Questions') )
        {{ HTML::style('css/base.css') }}
        {{ HTML::style('css/base_extended.css') }}
        {{ HTML::style('css/main.css') }}
        {{ HTML::style('css/db_search_new.css') }}
        {{ HTML::style('css/token-input.css') }}
        {{ HTML::style('css/token-input-facebook.css') }}
    </head>
    <body>
    <div id="overlay" class="" style=""></div>
    <div id="topbar_bg">
        <div id="topbar">
            <a href="/"><div id="logo"></div></a>
            <?php if( !isset($currentPage) ) $currentPage = true; ?>
            <div id="menu" style="width:450px;">
                <div class="menu_option @if( $currentPage == Route::is('campaign*')) {{'menu_option_selected'}} @endif">		{{link_to_route('campaign.index', 'Campaigns')}}</div>
                <div class="menu_option @if( $currentPage == Route::is('opportunity*')) {{'menu_option_selected'}} @endif">{{link_to_route('opportunity.index', 'Opportunities')}}</div>
                <div class="menu_option @if( $currentPage == Route::is('candidatesPool*')) {{'menu_option_selected'}} @endif">{{link_to_route('candidatesPool.index', 'Talent Pools')}}</div>
            </div>
            <div class="dropdown_no_focus" id="user_dropdown">
                <svg id="triangle_svg_no_focus" height="10" width="10">
                    <polygon id="dropdown_triangle" class="triangle_no_focus" points="5,10 10,0 0,0"/>
                </svg>
                <svg id="triangle_svg_focus" height="10" width="10">
                    <polygon id="dropdown_triangle" class="triangle_focus" points="5,10 10,0 0,0"/>
                </svg>
                <div id="user_name">{{Sentry::getUser()->first_name}}</div>
                <div id="hello_span">Hello,</div>
                <div id="dropdown_menu">
                        <a href="{{route('employers.settings')}}"><div class="dropdown_menu_option">Settings</div></a>
                        <a href="{{ URL::to('logout') }}"><div class="dropdown_menu_option">Log Out</div></a>
                </div>
            </div>
            <!--<div class="dropdown_no_focus" id="user_dropdown" style="padding:15px;">
                <div id="user_name">Candidates</div>
                <div id="total">{{$usersCount}}</div>
            </div>-->
            <!--<div id="total_label">
                Candidates selected
                <div id="total">{{$usersCount}}</div>
            </div>-->
        </div>
    </div>
    
    
        
    <div id="main_container">
        @if(Session::get('campaign', 0) == 1)
            <h1>Campaigns / New Campaign</h1>
            @include('common.progress_indicator')
        @else    
            <h1>Talent Pools / New Talent Pool</h1>
	@endif
        <div id="later_display" style="display:block;">
        <?php
        if(Session::has('opportunity'))
        {
            $opportunity_details = Opportunity::where('id', '=', Session::get('opportunity'))->with('locations')->with('workType')->get();
            //print_r($opportunity_details->workType);
            foreach($opportunity_details as $opportunity_detail)
            {
                //print_r($opportunity_detail['workType']);
                $location_name = '';
                if($opportunity_detail->opportunity_type == 1)
                {
		?>
            
                    <div class="search-filter-container" style="border-top: 10px solid #1ABC9C;">
                        <h4>Opportunity Filtering Options {{$opportunity_detail->job_type_id}}</h4>
                        <div id="opportunity-type-type-subject" class="search-filter-sentence-container" data-category="opportunity">
                            <!--<div style="float: left; margin-top: 5px;">
                                Opportunity Name
                                <span></span>
                            </div>
                            <div class="filter-element" data-guid="c6f04a4c-94f0-4844-b790-e2e0b780136d" style="color: #1ABC9C;">
                                {{$opportunity_detail->name}}
                            </div>-->
                            <!--<div class="clear"></div>
                            <div style="float: left; margin-top: 5px;">
                                Opportunity Type
                                <span></span>
                            </div>
                            <div class="filter-element" data-guid="c6f04a4c-94f0-4844-b790-e2e0b780136d" style="color: #1ABC9C;">
                                Specific Hire
                            </div>
                            <div class="clear"></div>-->
                            <div class="clear"></div>
                            <div style="float: left; margin-top: 5px;">
                                Opportunity Location
                                <span></span>
                            </div>
                            <?php
                            foreach ($opportunity_detail['locations'] as $location)
                            {
                            ?>
                            <div class="filter-element" data-guid="c6f04a4c-94f0-4844-b790-e2e0b780136d" style="background-color: #1ABC9C;">
                                {{$location->name}}
                            </div>
                            <?php
                            }
                            ?>
                            <div class="clear"></div>
                            <?php
                            if($opportunity_detail->opportunity_date!='0000-00-00'){
                            ?>
                            <div style="float: left; margin-top: 5px;">
                                Opportunity Date
                                <span></span>
                            </div>
                            <div class="filter-element" data-guid="c6f04a4c-94f0-4844-b790-e2e0b780136d" style="background-color: #1ABC9C;margin-top:3px;">
                                {{$opportunity_detail->opportunity_date}}
                            </div>
                            <div class="clear"></div>
                            <?php
                            }
                            ?>
                            <div style="float: left; margin-top: 5px;">
                                Job type looking for
                                <span></span>
                            </div>
                            <div class="filter-element" data-guid="c6f04a4c-94f0-4844-b790-e2e0b780136d" style="background-color: #1ABC9C;margin-top:3px;">
                                {{ $opportunity_detail['workType']->name }}
                            </div>
                        </div>
                        <div class="search-form-filter-container-clear-fix clear"></div>
                    </div>
        <?php
                    //$opportunity_op = 'Opportunity Name - '.$opportunity_detail->name;
                    //$opportunity_op .= '/Opportunity Type - Specific Hire';
                    ////'opporDetails'      => $opportunity_details,
                    ////foreach($opporDetails->locations as $location)
                    ////    echo $location->name;
                    //foreach ($opportunity_detail['locations'] as $location)
                    //{
                    //    //$locations_array = $location;
                    //    //echo $locations_array_result .= $locations_array->name.",";
                    //    $location_name .= $location->name.",";
                    //}
                    //$location_name = substr($location_name, 0, -1);
                    //$opportunity_op .="/Opportunity Location - ".$location_name;
		
                    //if($opportunity_detail->opportunity_date != '0000-00-00')
                    //{
                    //    $opportunity_op .= "/Opportunity Date - ".$opportunity_detail->opportunity_date;
                    //}
                    //echo "<h4>".$opportunity_op."</h4>";
                }
            }
        }
        ?>
        </div>
	<div id="search_criteria_specific">
	    <div id="left_search_tab" class="sr-unselected">Search with AND</div>
	    <div id="right_search_tab" class="sr-selected">Search with OR</div>
	</div>
        <div id="db_search_align_container">
            {{ Form::open(['url' => route('candidatesPool.store'), 'id' => 'search-form-filter']) }}
            <div id="progress_bar">
                <div id="total">{{$usersCount}}</div>
                <div id="candidates_label">Candidates</div>
                <div id="create-campaign-button" style="display:none;">Create Talent Pool</div>
            </div>
            <input id="search_criteria" type="hidden" name="search_criteria" value="2">
	    <div id='search-form-filter-clear-fix' class="clear"></div>
            <div id="new-candidate-pool-form" style="display: none;">
                {{Form::hidden('name', '', ['id' => 'candidate_pool_name', 'placeholder' => 'Candidates Pool Name'])}}
                {{Form::hidden('users', '', ['id' => 'campaign-users'])}}
                @if( Input::has('returnTo') )
                    {{Form::hidden('returnTo', Input::get('returnTo'))}}
                @endif
                {{Form::submit('Save Candidates Pool', ['class' => 'small-button red-button float-left']);}}
                {{Form::button('Cancel', ['id' => 'new-candidates-pool-cancel-btn', 'class' => 'small-button red-button float-left'])}}
                {{Session::flash('campaign', Session::get('campaign', 0))}}
            </div>
            {{ Form::close() }}
            <!--<div id="create-campaign-button" style="display:none;">Create TalentPool</div>-->
            <!--<div id="create-campaign-usebutton" style="display:none;">Create Campaign</div>-->
        </div>
        {{ Form::open(array('url' => 'foo/bar', 'id' => 'search-form')) }}
        <div id="categories_box">
        	<!-- User segment working fine start-->
            <div class="option_icon_box" id="segment_option" style="display:none;">
                  <div id="border_1" class="option_icon_top_border"></div>
                  <div class="option_icon" id="icon_1"></div>
                  <div class="option_text">User Segments</div>
            </div>
        	<!-- User segment working fine end-->
            <div class="option_icon_box" id="work_option">
                <div id="border_2" class="option_icon_top_border"></div>
                <div class="option_icon" id="icon_2">
                <object type="image/svg+xml" data="../img/search_icons/briefcase.svg">Your browser does not support SVG</object>
                </div>
                <div class="option_text">Work Experience</div>
            </div>
            <div class="option_icon_box" id="academic_option">
                <div id="border_3" class="option_icon_top_border"></div>
                <div class="option_icon" id="icon_3">
                <object type="image/svg+xml" data="../img/search_icons/books.svg">Your browser does not support SVG</object>
                </div>
                <div class="option_text">Academics &amp; Skills</div>
            </div>
            <div class="option_icon_box" id="sport_option">
                <div id="border_4" class="option_icon_top_border"></div>
                <div class="option_icon" id="icon_4">
                <object type="image/svg+xml" data="../img/search_icons/football-field.svg">Your browser does not support SVG</object>
                </div>
                <div class="option_text">Extra-Curricular</div>
            </div>
            <div class="option_icon_box" id="other_option">
                <div id="border_5" class="option_icon_top_border"></div>
                <div class="option_icon" id="icon_5">
                <object type="image/svg+xml" data="../img/search_icons/medal.svg">Your browser does not support SVG</object>
                </div>
                <div class="option_text">Diversity & Attributes</div>
            </div>                                    
        </div>
		<!-- User segment working fine start -->
        <div class="sub_option_container" id="sub_option_container_segment" style="display:none;">
            <div id="sub_option_segment" class="sub_option ">User Segment</div>
        </div>
		<!-- User segment working fine end -->
        <div class="sub_option_container" id="sub_option_container_work" >
            <div id="sub_option_length" class="sub_option ">Length</div>
            <div id="sub_option_sector" class="sub_option ">Sector Experience</div>
            <div id="sub_option_type" class="sub_option ">Type</div>
            <div id="sub_option_company" class="sub_option " style="display:none;">Company</div>
            <div id="sub_option_specific" class="sub_option ">Specific Experience</div>
        </div>
        <div class="sub_option_container" id="sub_option_container_academic" >
            <div id="sub_option_school" class="sub_option " style="display:none;">School</div>
            <div id="sub_option_university" class="sub_option ">University</div>
            <div id="sub_option_languages" class="sub_option ">Languages</div>
            <div id="sub_option_skills" class="sub_option ">Skills</div>
            <div id="sub_option_capabilities" class="sub_option ">Capabilities</div>
        </div>
        <div class="sub_option_container" id="sub_option_container_sport">
            <div id="sub_option_sport" class="sub_option " style="display:none;">Sport</div>
            <div id="sub_option_society" class="sub_option ">Society</div>
        </div>
        <div id="sub_option_container_other" class="sub_option_container">
            <div id="sub_option_general" class="sub_option">Diversity</div>
            <div id="sub_option_attributes" class="sub_option ">Candidate Attributes</div>
            <!--<div id="sub_option_sector" class="sub_option ">Sector</div>-->
            <!--<div id="sub_option_sectorpref" class="sub_option">Sector Preferences</div>-->
        </div>
        <div class="sub_option_filter" id="sub_option_other_filter_attributes">
            <div class="sub_sub_option other_details" style="border-top: 10px solid #e74c3c;">
            	<div class="sub_sub_option_padding">
                <div class="box_header_with_subtitle">Candidate Attributes</div>
                <div class="box_header_subtitle">During signup, candidates are asked to select the five attributes from the following fifteen that they believe they are strongest at. You can filter by their responses</div>
                <?php $paramSafeName = 'attributes';  ?>
                @foreach( $attributes as $option )
                    
                    <div class="capabilities checkbox_container_option">
                        <div class="checkbox_option"></div>
                    	<p>{{ $option->name }}</p>
                    {{ Form::checkbox($paramSafeName.'[]', $option->id, false, ['id' => $paramSafeName . '-' . $option->id, 'data-group-name' => 'attributes']) }} 
                    </div>
                @endforeach

                <div class="clear"></div>
                </div>
                <div class="add_to_filter_holder">
                    <div class="add_to_filter_btn add-to-filter-btn other_details_btn">Add to Filter +</div>
                    <div id="spacer"></div>
                </div>
                <div class="clear"></div>
            </div>

        </div>
                <div class="sub_option_filter" id="sub_option_work_filter_sector">
                    <div class="sub_sub_option work_experience">
                           
                           <div class="sub_sub_option_padding">
                           
                           <div class="box_header_with_subtitle">Sector Experience</div>
                           <p class="box_header_subtitle">By filtering by sector, only candidates who have experience in the sectors you select will be included in your talent pool</p>
                            <?php $_lastGroupId = 0;  $_isOpened = false; ?>
                            @foreach( $workOptions as $option )
                            <?php 
                            //$paramSafeName = str_replace( ' ', '-', strtolower($option->group->name) ); 
                            $paramSafeName = 'work_expsector'; 
                            ?>
        
                            @if( $option->group->id != $_lastGroupId || $_lastGroupId == 0 )
                                <div class="sub_option_divider">{{ $option->group->name }}</div>
                            @endif    
                                
                                
                                <div class="capabilities checkbox_container_option">
                                    <div class="checkbox_option"></div>
                                	<p>{{ $option->name }}</p>
                                {{ Form::checkbox($paramSafeName.'[]', $option->id, false, ['id' => $paramSafeName . '-' . $option->id, 'data-group-name' => 'sector']) }} 
                                </div>
            
                                
                                
                            <?php $_lastGroupId = $option->group->id; $_isOpened = true; ?>
                            @endforeach
                            
                            </div>
                            
                            <div class="add_to_filter_holder">                    
                                <div class="add_to_filter_btn add-to-filter-btn work_experience_btn">Add to Filter +</div>
                                <div id="spacer"></div>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>
        <div class="sub_option_filter" id="sub_option_other_filter_general">
            <div class="sub_sub_option other_details">
                
                <div class="sub_sub_option_padding">
                <div class="box_header_with_subtitle">Diversity</div>
                <div class="box_header_subtitle">In support of your equality initiatives, you may select to include only women and/or ethnic minority candidates in your talent pool</div>
                
                <div class="capabilities checkbox_container_option">
                    <div class="checkbox_option"></div>
                	<p>Women Only</p>
                {{ Form::checkbox('gender', 2, false, ['id' => 'gender', 'style' => 'width: 17px;'] ) }} 
                </div>
                
                
  <!--@include('inputs.ethnicity_dropdown', $ethnicities)-->
                
                <div class="capabilities checkbox_container_option">
                    <div class="checkbox_option"></div>
                	<p>Ethnic Minorities Only</p>
                {{ Form::checkbox('ethnicity', 2, false, ['id' => 'ethnicity', 'style' => 'width: 17px;'] ) }} 
                </div>
                
                <!--{{ Form::label('birth year')}}
                <select name="dob" id="dob">
                    <option value="0">Select birth year</option>
                    @for ($i = 2007; $i >= 1900; $i--)
                    <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>-->
                
                <div class="clear"></div>
                </div>
                <div class="add_to_filter_holder">                    
                    <div class="add_to_filter_btn add-to-filter-btn other_details_btn">Add to Filter +</div>
                    <div id="spacer"></div>
                </div>
            </div>
            <!--<div class="sub_sub_option other_jobtype">
                    <div class="box_header">Job Type Looking for</div>
                    @foreach($workTypes as $userType)
                    <label for="jobtype-{{$userType->id}}" class="work_sector" style="width: 240px;">{{ Form::checkbox('jobtype[]', $userType->id, false, ['id' => 'jobtype-'.$userType->id, 'data-group-name' => 'jobtype'] ) }}{{$userType->name}}</label>
                    @endforeach
                    <div class="clear"></div>
                    <div class="add_to_filter_holder">                    
                        <div class="add_to_filter_btn add-to-filter-btn other_sector_preference_btn">Add to Filter +</div>
                        <div id="spacer"></div>
                    </div>
            </div>-->
            <div class="clear"></div>
        </div>
        <div class="sub_option_filter" id="sub_option_work_filter_length">
            <div class="sub_sub_option work_experience">
            
            	<div class="sub_sub_option_padding">
            	
                <div class="box_header_with_subtitle">Length</div>
                <p class="box_header_subtitle">How much time do you want your candidates to have spent doing any one piece of work experience?</p>
                <select name="min-work-length" id="min-work-length" data-group-name="length" data-group-delete="false">
                    <option value="0">No Minimum</option>
                    @foreach($workDurations as $workDuration)
                    <option value="{{$workDuration->id}}">{{$workDuration->name}}</option>
                    @endForeach
                </select>
                <select name="max-work-length" id="max-work-length" data-group-name="length" data-group-delete="false">
                    <option value="0">No Maximum</option>
                    @foreach($workDurations as $workDuration)
                    <option value="{{$workDuration->id}}">{{$workDuration->name}}</option>
                    @endForeach
                </select>
                <div class="clear"></div>
                
                </div>
                
                <div class="add_to_filter_holder">                    
                    <div class="add_to_filter_btn add-to-filter-btn work_experience_btn">Add to Filter +</div>
                    <div id="spacer"></div>
                </div>
                <div class="clear"></div>
            </div>

            <div class="clear"></div>
        </div>
        <div class="sub_option_filter" id="sub_option_work_filter_sector">
            <div class="sub_sub_option work_experience">
                    <div class="box_header">Sector Experience in</div>
                    <?php $_lastGroupId = 0;  $_isOpened = false; ?>
                    @foreach( $workOptions as $option )
                    <?php 
                    //$paramSafeName = str_replace( ' ', '-', strtolower($option->group->name) ); 
                    $paramSafeName = 'work_expsector'; 
                    ?>

                    @if( $option->group->id != $_lastGroupId || $_lastGroupId == 0 )
                        <div class="sub_option_divider">{{ $option->group->name }}</div>
                    @endif    
                        <label class="work_sector">{{ Form::checkbox($paramSafeName.'[]', $option->id, false, ['id' => $paramSafeName . '-' . $option->id, 'data-group-name' => 'sector']) }}
                        {{ $option->name }}</label>
                    <?php $_lastGroupId = $option->group->id; $_isOpened = true; ?>
                    @endforeach
                    <div class="add_to_filter_holder">                    
                        <div class="add_to_filter_btn add-to-filter-btn work_experience_btn">Add to Filter +</div>
                        <div id="spacer"></div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
        <div class="sub_option_filter" id="sub_option_work_filter_type">
            <div class="sub_sub_option work_experience">
            
            	<div class="sub_sub_option_padding">
                <div class="box_header_with_subtitle">Experience Type</div>
                <p class="box_header_subtitle">You can filter candidates here by what sort of work experience they have</p>
                @foreach($workTypes as $userType)
                <div class="capabilities checkbox_container_option">
                    <div class="checkbox_option"></div>
                	<p>{{ $userType->name }}</p>
                {{ Form::checkbox('work_type_option[]', $userType->id, false, ['id' => 'work_type_option-'.$userType->id, 'data-group-name' => 'work'] ) }} 
                </div>
                @endforeach
                <div class="clear"></div>
                </div>
                
                <div class="add_to_filter_holder">                    
                    <div class="add_to_filter_btn add-to-filter-btn work_experience_btn">Add to Filter +</div>
                    <div id="spacer"></div>
                </div>
                <div class="clear"></div>
            </div>

            <div class="clear"></div>
        </div>
        <div class="sub_option_filter" id="sub_option_work_filter_company">
            <div class="sub_sub_option work_experience">
                <div class="box_header">Specific Companies</div>
                {{Form::text('specific_company_input', '', ['id'=>'specific_company_input'])}}
                <div class="subject_input_helper">Type a Company Above &#8593;</div>
                <div class="clear"></div>
                <div class="add_to_filter_holder">                    
                    <div class="add_to_filter_btn add-to-filter-btn work_experience_btn">Add to Filter +</div>
                    <div id="spacer"></div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <div class="sub_option_filter" id="sub_option_work_filter_specific">
            <div class="sub_sub_option work_specific" style="border-top: 10px solid #2ecc71;">
            
            	<div class="sub_sub_option_padding">
            	
                <div class="box_header_with_subtitle">Specific Experience</div>
                <p class="box_header_subtitle">If your candidates need to have  experience in a particular area, you can specify that here</p>

                @foreach($experience as $experience)
                
                <div class="capabilities checkbox_container_option">
                    <div class="checkbox_option"></div>
                	<p>{{ $experience->name }}</p>
                {{ Form::checkbox('experience[]', $experience->id, false, ['id' => 'experience-' . $experience->id, 'data-group-name' => 'experience']) }} 
                </div>

                @endforeach
                <div class="clear"></div>
                </div>
                
                <div class="add_to_filter_holder">
                    <div class="add_to_filter_btn add-to-filter-btn work_experience_btn">Add to Filter +</div>
                    <div id="spacer"></div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <div class="sub_option_filter" id="sub_option_academic_filter_school">
            <div class="sub_sub_option university">
                <div class="box_header">Specific Subject</div>
                <select name="school-subject" id="school-subject">
                    <option value="0">Subject</option>
                    @foreach($schoolOptions as $schoolOption)
                        <option value="{{$schoolOption->id}}">{{$schoolOption->name}}</option>
                    @endforeach
                </select>
                <!--<select>
                    <option>Result</option>
                    <option>A*</option>
                    <option>A</option>
                    <option>B</option>
                    <option>C</option>
                    <option>D</option>
                </select>-->
                <div class="clear"></div>
                <div class="add_to_filter_holder">                    
                    <div class="add_to_filter_btn add-to-filter-btn academic_btn">Add to Filter +</div>
                    <div id="spacer"></div>
                </div>
                <div class="clear"></div>
            </div>
            <!--<div class="sub_sub_option university">
                <div class="box_header">Overall Result</div>
                <select class="grade_letter">
                    <option></option>
                    <option>A*</option>
                    <option>A</option>
                    <option>B</option>
                    <option>C</option>
                    <option>D</option>
                </select>
                <select class="grade_letter">
                    <option></option>
                    <option>A*</option>
                    <option>A</option>
                    <option>B</option>
                    <option>C</option>
                    <option>D</option>
                </select>
                <select class="grade_letter">
                    <option></option>
                    <option>A*</option>
                    <option>A</option>
                    <option>B</option>
                    <option>C</option>
                    <option>D</option>
                </select>
                <select class="grade_letter">
                    <option></option>
                    <option>A*</option>
                    <option>A</option>
                    <option>B</option>
                    <option>C</option>
                    <option>D</option>
                </select>
                <select class="grade_letter">   
                    <option></option>
                    <option>A*</option>
                    <option>A</option>
                    <option>B</option>
                    <option>C</option>
                    <option>D</option>
                </select>
                <div class="clear"></div>
                <div class="add_to_filter_holder">                    
                    <div class="add_to_filter_btn add-to-filter-btn academic_btn">Add to Filter +</div>
                    <div id="spacer"></div>
                </div>
                <div class="clear"></div>
            </div>-->
        </div> 

        <div class="sub_option_filter" id="sub_option_academic_filter_university">
            <!--Working fine closed because client requirement start -->
			<!--<div class="sub_sub_option university">
			<div class="box_header">Degree Type</div>
                @foreach($degreeTypes as $degreeType)
                <label class="work_sector">{{ Form::checkbox('degree_type[]', $degreeType->id, false, ['id' => 'degree_type-' . $degreeType->id, 'data-group-name' => 'degree']) }}
                    {{ $degreeType->name }}</label>
                @endforeach
                <div class="clear"></div>
                <div class="add_to_filter_holder">
                </div>
                <div class="clear"></div>
            </div>-->
			<!--Working fine closed because client requirement end -->
            <div class="sub_sub_option university">
            
            	<div class="sub_sub_option_padding">
                <div class="box_header">Degree Result</div>
                
                <div class="capabilities checkbox_container_option">
                    <div class="checkbox_option"></div>
                	<p>1st</p>
                {{ Form::checkbox('degree_result[]', 1, false, ['id' => 'degree_result-' . 1, 'data-group-name' => 'degree']) }}
                </div>
                
                <div class="capabilities checkbox_container_option">
                    <div class="checkbox_option"></div>
                	<p>2:1 or Above</p>
                {{ Form::checkbox('degree_result[]', 2, false, ['id' => 'degree_result-' . 2, 'data-group-name' => 'degree']) }}
                </div>
                
                <div class="clear"></div>
                </div>
                <div class="add_to_filter_holder">                    
                    <div class="add_to_filter_btn add-to-filter-btn academic_btn">Add to Filter +</div>
                    <div id="spacer"></div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="sub_sub_option university">
            
            	<div class="sub_sub_option_padding">
                <div class="box_header">Degree Subject Categories</div>
                @foreach($degreeSubjects as $degreeSubject)
                
                                        
                                        <div class="capabilities checkbox_container_option">
                                            <div class="checkbox_option"></div>
                                        	<p>{{ $degreeSubject->name }}</p>
                                        {{ Form::checkbox('university-subject[]', $degreeSubject->id, false, ['id' => 'university-subject-' . $degreeSubject->id, 'data-group-name' => 'degree'] )}} 
                                        </div>
                
                               @endforeach
                <!--<select name="university-subject" id="university-subject">
                    <option value="0">Subject</option>
                    @foreach($degreeSubjects as $degreeSubject)
                        <option value="{{$degreeSubject->id}}">{{$degreeSubject->name}}</option>
                    @endforeach
                </select>-->
                <div class="clear"></div>
                </div>
                <div class="add_to_filter_holder">                    
                    <div class="add_to_filter_btn add-to-filter-btn academic_btn">Add to Filter +</div>
                    <div id="spacer"></div>
                </div>
                <div class="clear"></div>
            </div>
            <!--<div class="sub_sub_option university">
                <div class="box_header">Degree Subject (Specific Subjects)</div>
                {{Form::text('degree_subject_input', '', ['id'=>'degree_subject_input'])}}
                <div class="clear"></div>
                <div class="add_to_filter_holder">                    
                    <div class="add_to_filter_btn add-to-filter-btn academic_btn">Add to Filter +</div>
                    <div id="spacer"></div>
                </div>
                <div class="clear"></div>
            </div>-->
            <div class="sub_sub_option university">
            	<div class="sub_sub_option_padding">
                <div class="box_header">University Group</div>
                	
                	<div class="capabilities checkbox_container_option">
                	    <div class="checkbox_option"></div>
                		<p>Top 10</p>
                	{{ Form::checkbox('university-group[]', 1, false, ['id' => 'university-group-' . 1, 'data-group-name' => 'degree'] )}} 
                	</div>
                	
                	<div class="capabilities checkbox_container_option">
                	    <div class="checkbox_option"></div>
                		<p>Russell Group</p>
                	{{ Form::checkbox('university-group[]', 2, false, ['id' => 'university-group-' . 2, 'data-group-name' => 'degree'] )}} 
                	</div>
                	
                	<div class="capabilities checkbox_container_option">
                	    <div class="checkbox_option"></div>
                		<p>Not Russell Group</p>
                	{{ Form::checkbox('university-group[]', 3, false, ['id' => 'university-group-' . 3, 'data-group-name' => 'degree'] )}} 
                	</div>
                	
                <div class="clear"></div>
                </div>
                <div class="add_to_filter_holder">                    
                    <div class="add_to_filter_btn add-to-filter-btn academic_btn">Add to Filter +</div>
                    <div id="spacer"></div>
                </div>
                <div class="clear"></div>
            </div>
            <div style="display: none;" class="sub_sub_option university">
                <div class="box_header">Specific Universities</div>
                
                {{Form::text('degree_uni_input', '', ['id'=>'degree_uni_input'])}}
                <div class="clear"></div>
                <div class="add_to_filter_holder">                    
                    <div class="add_to_filter_btn add-to-filter-btn academic_btn">Add to Filter +</div>
                    <div id="spacer"></div>
                </div>
                <div class="clear"></div>
            </div>
            <!--<div class="sub_sub_option university">
                <div class="sub_option_divider">Specific Universities</div>
                {{Form::text('degree_uni_input', '', ['id'=>'degree_uni_input'])}}
                <div class="subject_input_helper">Type a University Above &#8593;</div>
                    <label class="work_sector"><input type="checkbox" id="abc" name="valuess[]" value="abc" /> abc</label>
                    <label class="work_sector"><input type="checkbox" id="cde" name="valuess[]" value="ced" /> cde</label>
                <div class="clear"></div>
                <div class="add_to_filter_holder">                    
                    <div class="add_to_filter_btn add-to-filter-btn academic_btn">Add to Filter +</div>
                    <div id="spacer"></div>
                </div>
                <div class="clear"></div>
            </div>-->
            <div class="sub_sub_option university">
            
            	<div class="sub_sub_option_padding">
                <div class="box_header">Graduation Year</div>
                <select name="university_from[]" id="university_from">
                    <option value="0">Graduation Year From</option>
                    @for ( $i = 2000; $i <= 2019; $i++ )
                    <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
                <select name="university_to[]" id="university_to">
                    <option value="0">Graduation Year To</option>
                    @for ( $i = 2000; $i <= 2019; $i++ )
                    <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
                <div class="clear"></div>
                </div>
                <div class="add_to_filter_holder">                    
                    <div class="add_to_filter_btn add-to-filter-btn academic_btn">Add to Filter +</div>
                    <div id="spacer"></div>
                </div>
                <div class="clear"></div>
            </div>
			<!-- Closed because client's requirements start -->
            <!--<div class="sub_sub_option university">
                <div class="box_header">Degree Subject</div>
                <div class="sub_option_divider">Subject Category</div>
                @include('search.degree_subjects', $degreeSubjects)
                <div class="sub_option_divider">Specific Subjects</div>
                {{Form::text('degree_subject_input', '', ['id'=>'degree_subject_input'])}}
                <div class="subject_input_helper">Type a Subject Above &#8593;</div>
                <div class="clear"></div>
                <div class="add_to_filter_holder">                    
                    <div class="add_to_filter_btn add-to-filter-btn academic_btn">Add to Filter +</div>
                    <div id="spacer"></div>
                </div>
                <div class="clear"></div>
            </div>-->
			<!-- Closed because client's requirements end -->
        </div>
        <div class="sub_option_filter language" id="sub_option_academic_filter_languages">
        
                    <div class="sub_sub_option">
                    	<div class="sub_sub_option_padding">
                        <div class="box_header_with_subtitle">Languages</div>
                        <div class="box_header_subtitle">You can select candidate’s language(s) and levels from the filters below. Selecting a level will include all candidates at that level and above</div>
                        <div>
                        
                       <?php $language_list = array(
                       array("id" => 38, "name" => "French"),
                       array("id" => 42, "name" => "German"),
                       array("id" => 79, "name" => "Mandarin"),
                       array("id" => 57, "name" => "Italian"),
                       array("id" => 113, "name" => "Spanish"),
                       array("id" => 49, "name" => "Hindi")
                       );?>
                       
                       @foreach ( $language_list as $language )
                       
                       
                       <div class="key_skill">
                        <div class="key_skill_item checkbox_container_option">
                        <div class="checkbox_option"></div>
                        <p>{{ $language["name"] }}</p>
                       {{ Form::checkbox('language[]', $language["id"], false, ['id' => 'language-' . $language["id"], 'class' => 'check-lang', 'data-group-name' => 'language' . $language["id"], 'data-group-delete' => 'true']) }}
                       </div>
                       <select class="slect_lang" name="language-level-{{ $language['id'] }}[]" id="language-level-{{ $language['id'] }}" data-group-name="language{{ $language['id'] }}" data-group-delete="false" style="width: 120px;">
                           <option value="0">Level</option>
                           @foreach ( $languageLevels as $languageLevel )
                           <option value="{{ $languageLevel->id }}">{{ $languageLevel->name }}</option>
                           @endforeach
                       </select>
                        </div>
                       
                       @endforeach
                        
                        
                        <?php $language_array = array(38,42,79,57,113,49,131,32); ?>
                            <select name="language[]" id="language" data-group-name="language" data-group-delete="true">
                                <option value="0">Other Language</option>
                                @foreach ( $languages as $language )
                                <?php
                                if (!in_array($language->id, $language_array))
                                {
                                ?>
                                    <option value="{{ $language->id }}">{{ $language->name }}</option>
                                <?php
                                }
                                ?>
                                @endforeach
                            </select>
                            <select name="language-level-other[]" id="language-level-other" data-group-name="language" data-group-delete="false">
                                <option value="0">Level</option>
                                @foreach ( $languageLevels as $languageLevel )
                                <option value="{{ $languageLevel->id }}">{{ $languageLevel->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        
                        <!--<select name="language[]" id="language" data-group-name="language" data-group-delete="true">
                            <option value="0">Language</option>
                            @foreach ( $languages as $language )
                            <option value="{{ $language->id }}">{{ $language->name }}</option>
                            @endforeach
                        </select>-->
                        <!--<select name="language-level[]" id="language-level" data-group-name="language" data-group-delete="false">
                            <option value="0">Level</option>
                            @foreach ( $languageLevels as $languageLevel )
                            <option value="{{ $languageLevel->id }}">{{ $languageLevel->name }}</option>
                            @endforeach
                        </select>-->
                        <div class="clear"></div>
                        </div>
                        <div class="add_to_filter_holder">
                        
                        <div class="and_or_label">Filter Type</div>
                        <div class="and_search">And</div>
                        <div class="or_search search_type_on">Or</div>
                        
                        
                        
                                            
                            <div class="add_to_filter_btn add-to-filter-btn academic_btn" id="language_filterbtn">Add to Filter +</div>
                            <div id="spacer"></div>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
        
        <div class="sub_option_filter skill" id="sub_option_academic_filter_skills">
            <div class="sub_sub_option" style="border-top: 10px solid #9b59b6;">
            	<div class="sub_sub_option_padding">
        		<div class="box_header_with_subtitle">Skills</div>
        		<div class="box_header_subtitle">You can use the options below to filter for candidates with specific technical skills</div>
                
                <?php $_lastGroupId = 0;  $_isOpened = false; ?>
                @foreach( $skillOptions as $option )
                @if( $option->skill_group->id != $_lastGroupId && $_lastGroupId != 0 )
                </div>
                @endif 
                @if( $option->skill_group->id != $_lastGroupId || $_lastGroupId == 0 )
                <div class="sub_option_divider">{{ $option->skill_group->name }}</div>
                <div class="sub_skill_container">
                @endif    
                    <div class="key_skill">
                        <div class="key_skill_item checkbox_container_option">
                            <div class="checkbox_option"></div>
                            <p>{{ $option->name }}</p>
                            {{ Form::checkbox('skill[]', $option->id, false, ['id' => 'skill-' . $option->id, 'class' => 'skillselect', 'data-group-name' => 'skill', 'data-group-delete' => 'true']) }}
                        </div>
                        <select class="slect_prev" name="skill-level-{{ $option->id }}[]" id="skill-level-{{ $option->id }}" data-group-name="skill" data-group-delete="false" style="width: 120px;">
                            <option value="0">Level</option>
                            <option value="1">Basic</option>
                            <option value="2">Intermediate</option>
                            <option value="3">Expert</option>
                        </select>
                    </div>
                <?php $_lastGroupId = $option->skill_group->id; $_isOpened = true; ?>
                @endforeach
                
                <div class="clear"></div>
                </div>
                <div class="add_to_filter_holder">                    
                    <div class="add_to_filter_btn add-to-filter-btn academic_btn">Add to Filter +</div>
                    <div id="spacer"></div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        </div>
        
        <div class="sub_option_filter capabilities" id="sub_option_academic_filter_capabilities">
            <div class="sub_sub_option" style="border-top: 10px solid #9b59b6;">
            	<div class="sub_sub_option_padding">
                <div class="box_header_with_subtitle">Capabilities</div>
                <div class="box_header_subtitle">During signup, candidates are asked to select the five capabilities from the following fifteen that they believe they are strongest at. You can filter by their responses</div>
                
                <?php $paramSafeName = 'capabilities';  ?>
                @foreach( $capabilities as $option )
                    <div class="capabilities checkbox_container_option">
                        <div class="checkbox_option"></div>
                    	<p>{{ $option->name }}</p>
                    {{ Form::checkbox($paramSafeName.'[]', $option->id, false, ['id' => $paramSafeName . '-' . $option->id, 'data-group-name' => 'capabilities']) }}
                    </div>
                @endforeach
                
                <div class="clear"></div>
                </div>
                <div class="add_to_filter_holder">
                    <div class="add_to_filter_btn add-to-filter-btn academic_btn">Add to Filter +</div>
                    <div id="spacer"></div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        
        <div class="sub_option_filter" id="sub_option_sport_filter_sport">
            <div class="sub_sub_option">
                <div class="box_header">Sport Level</div>
                @foreach($sportLevels as $sportLevel)
                    <label style="width:230px;">{{ Form::checkbox('sport_level[]', $sportLevel->id, false, ['id' => 'sport_level-' . $sportLevel->id]) }}{{$sportLevel->name}}</label>
                @endforeach
                <div class="clear"></div>
                <div class="add_to_filter_holder">                    
                    <div class="add_to_filter_btn add-to-filter-btn sports_and_societies_btn">Add to Filter +</div>
                    <div id="spacer"></div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="sub_sub_option">
                <div class="box_header">Specific Sport</div>
                @foreach($sportNames as $sportName)
                    <label style="width:230px;">{{ Form::checkbox('sport_name[]', $sportName->id, false, ['id' => 'sport_name-' . $sportName->id]) }}{{$sportName->name}}</label>
                @endforeach
                <div class="clear"></div>
                <div class="add_to_filter_holder">                    
                    <div class="add_to_filter_btn add-to-filter-btn sports_and_societies_btn">Add to Filter +</div>
                    <div id="spacer"></div>
                </div>
                <div class="clear"></div>
            </div>
            <!--<div class="sub_sub_option">
                <div class="box_header">Specific Sport</div>
                {{Form::text('specific_sport_input', '', ['id' => 'specific_sport_input'])}}
                <div class="subject_input_helper">Type a Subject Above &#8593;</div>
                <div class="clear"></div>
                <div class="add_to_filter_holder">                    
                    <div class="add_to_filter_btn add-to-filter-btn sports_and_societies_btn">Add to Filter +</div>
                    <div id="spacer"></div>
                </div>
                <div class="clear"></div>
            </div>-->
        </div>

        <div class="sub_option_filter" id="sub_option_sport_filter_society">
            <div class="sub_sub_option society_category">
            	<div class="sub_sub_option_padding">
                <div class="box_header_with_subtitle">Society Category</div>
                <div class="box_header_subtitle">You can filter below for candidates who were involved with particular types of society while at university</div>
                @foreach( $socialCategories as $socialCategory )
                    @if($socialCategory->id != 8)
                    <div class="capabilities checkbox_container_option">
                        <div class="checkbox_option"></div>
                    	<p>{{ $socialCategory->name }}</p>
                    {{ Form::checkbox('society_category[]', $socialCategory->id, false, ['id'=> 'society_category-' . $socialCategory->id]) }} 
                    </div>
                    @endif
                @endforeach
                <div class="clear"></div>
                </div>
                <div class="add_to_filter_holder">                    
                    <div class="add_to_filter_btn add-to-filter-btn sports_and_societies_btn">Add to Filter +</div>
                    <div id="spacer"></div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="sub_sub_option society_position">
            	<div class="sub_sub_option_padding">
                <div class="box_header_with_subtitle">Society Position</div>
                <div class="box_header_subtitle">Use the options here to include only candidates who held particular positions of responsibility while at university</div>
                
                @foreach( $socialPositions as $socialPosition )
                    
                    <div class="capabilities checkbox_container_option">
                        <div class="checkbox_option"></div>
                    	<p>{{ $socialPosition->name }}</p>
                    {{ Form::checkbox('society_position[]', $socialPosition->id, false, ['id' => 'society_position-' . $socialPosition->id]) }} 
                    </div>
                    
                @endforeach
                
                <div class="clear"></div>
                </div>
                <div class="add_to_filter_holder">                    
                    <div class="add_to_filter_btn add-to-filter-btn sports_and_societies_btn">Add to Filter +</div>
                    <div id="spacer"></div>
                </div>
                <div class="clear"></div>
            </div>
			<!-- Working fine but closed because client's requirement start  -->
            <!--<div class="sub_sub_option">
                <div class="box_header">Specific Society</div>
                {{Form::text('specific_society_input', '', ['id'=>'specific_society_input'])}}
                <div class="subject_input_helper">Type a Society Above &#8593;</div>
                <div class="clear"></div>
                <div class="add_to_filter_holder">                    
                    <div class="add_to_filter_btn add-to-filter-btn sports_and_societies_btn">Add to Filter +</div>
                    <div id="spacer"></div>
                </div>
                <div class="clear"></div>
            </div>-->
			<!-- Working fine but closed because client's requirement end  -->
        </div>
        
        <!-- Added Later 27_11_2014-->
        <div class="sub_option_filter" id="sub_option_segment_filter_segment">
            <div class="sub_sub_option segment">
                <div class="checkbox_container_option">
                    <div class="box_header">Exclude candidates in other TalentPools</div>
                    <label id="all_talent_pool" class="checkbox_radio_option"><input id="exclude_by_talentpool-1" class="radio_availability" name="exclude_by_talentpool" type="radio" value="1">All Talent Pools</label>
                    <label id="specific_talent_pool" class="checkbox_radio_option"><input id="exclude_by_talentpool-2" class="radio_availability" name="exclude_by_talentpool" type="radio" value="2">Specific Talent Pools</label>
                    <div class="mini_checkbox_container talentpool_container">
                    @foreach($specific_talentpools as $specific_talentpool)    
                        <label class="mini_checkbox"><input id="specific-talentpool-{{$specific_talentpool->id}}" type="checkbox" name="specific-talentpool[]" value="{{$specific_talentpool->id}}" />{{$specific_talentpool->name}}</label>
                        <!--<label class="mini_checkbox"><input id="specific-talentpool-2" type="checkbox" name="specific-talentpool[]" value="2" />Talent Pool Two</label>
                        <label class="mini_checkbox"><input id="specific-talentpool-3" type="checkbox" name="specific-talentpool[]" value="3" />Talent Pool Three</label>-->
                    @endforeach
                    </div>
                </div>
                <div class="add_to_filter_holder">                    
                    <div class="add_to_filter_btn add-to-filter-btn segment_btn">Add to Filter +</div>
                    <div id="spacer"></div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="sub_sub_option segment">
                <div class="checkbox_container_option">
                    <select id="include_exclude_select" name="include_exclude_select[]">
                    	<option value="0">Opportunity</option>
                        <option value="1">Include</option>
                    	<option value="2">Exclude</option>
                    </select>
                    <div id="include_exclude_box_header" class="box_header">candidates already contacted about other opportunities</div>
                    <label id="all_opportunities" class="checkbox_radio_option"><input id="excluded_by_opportunity-1" class="radio_availability opportunity_check" name="excluded_by_opportunity" type="radio" value="1">All Opportunities</label>
                    <label id="specific_opportunities" class="checkbox_radio_option"><input id="excluded_by_opportunity-2" class="radio_availability opportunity_check" name="excluded_by_opportunity" type="radio" value="2">Specific Opportunities</label>
                    <div class="mini_checkbox_container opportunity_container">
                        @foreach($specific_opportunities as $specific_opportunity)
                        <label class="mini_checkbox"><input id="specific_opportunity_value-{{$specific_opportunity->id}}" type="checkbox" name="specific_opportunity_value[]" value="{{$specific_opportunity->id}}" />{{$specific_opportunity->name}}</label>
                        <!--<label class="mini_checkbox"><input id="specific_opportunity-2" type="checkbox" name="specific_opportunity[]" value="2" />Opportunity Two</label>
                        <label class="mini_checkbox"><input id="specific_opportunity-3" type="checkbox" name="specific_opportunity[]" value="3" />Opportunity Three</label>-->
                        @endforeach
                    </div>
                </div>
                <div class="add_to_filter_holder">                    
                    <div class="add_to_filter_btn add-to-filter-btn segment_btn">Add to Filter +</div>
                    <div id="spacer"></div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="sub_sub_option segment">
                <div class="box_header">Exclude specific individuals</div>
                {{Form::text('specific_email_input', '', ['id'=>'specific_email_input','style'=>'width:350px;border:1px solid !important'])}}
                <div class="subject_input_helper">Type a Email Above &#8593;</div>
                <div class="clear"></div>
                <div class="add_to_filter_holder">                    
                    <div class="add_to_filter_btn add-to-filter-btn segment_btn">Add to Filter +</div>
                    <div id="spacer"></div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        {{ Form::close() }}
    </div>
</div>
<div id="footer">
</div>

@include('common.bottom')
{{ HTML::script('js/bootstrap.min.js') }}
{{ HTML::script('js/jquery.tokeninput.js') }}
{{ HTML::script('js/jquery.tokeninputother.js') }}
{{ HTML::script('js/jquery.tokeninputothersubject.js') }}
{{ HTML::script('js/db_search.js') }}   
{{ HTML::script('js/equalize.min.js') }}
<script>
    
    $( document ).ready(function() {
        $('#language').change(function() {
            var language_val = $("#language").val();
            if(language_val == 0){
                $('#language-level-other').val(0);
            }
        });
        $('.skillselect').change(function() {
            var selectskill = $(this).attr('id');
            var skills = selectskill.split('-');
            var skills_id = skills[1];
            if ($('#'+selectskill).prop('checked')==false){ 
                $('#skill-level-'+skills_id).val(0);
            }
        });
        $('.check-lang').change(function() {
            var language_id = $(this).attr('id');
            var languages = language_id.split('-');
            var languages = languages[1];
            if ($('#'+language_id).prop('checked')==false){ 
                $('#language-level-'+languages).val(0);
            }
            
        });
        $('.slect_prev').change(function() {
            var skill_id = $(this).attr('id');
            var skill_id = skill_id.split('-');
            var skills = 'skill-'+skill_id[2];
            $('#'+skills).prop("checked", true);
        });
        $('.slect_lang').change(function() {
            var lang_id = $(this).attr('id');
            var lang_id = lang_id.split('-');
            var langs = 'language-'+lang_id[2];
            $('#'+langs).prop("checked", true);
        });
        $("#left_search_tab").click(function() {
            $("#left_search_tab").removeClass("sr-unselected").addClass("sr-selected");
            $("#right_search_tab").removeClass("sr-selected").addClass("sr-unselected");
            $("#search_criteria").val(1);
        });
        $("#right_search_tab").click(function() {
            $("#right_search_tab").removeClass("sr-unselected").addClass("sr-selected");
            $("#left_search_tab").removeClass("sr-selected").addClass("sr-unselected");
            $("#search_criteria").val(2);
        });
	
        $(".talentpool_container").hide();
        $("#all_talent_pool").click(function() {
            
            $('.talentpool_container').find('input[type=checkbox]:checked').removeAttr('checked');
            $(".talentpool_container").hide();
        });
        $("#specific_talent_pool").click(function() {
            $(".talentpool_container").show();
        });
        
        $(".opportunity_container").hide();
        $("#all_opportunities").click(function() {
            $('.opportunity_container').find('input[type=checkbox]:checked').removeAttr('checked');
            $(".opportunity_container").hide();
        });
        $("#specific_opportunities").click(function() {
            $(".opportunity_container").show();
        });
        $(".opportunity_check").click(function() {
            var selectedVal = $("#include_exclude_select").val();
            if (selectedVal == 0)
            {
                $('#include_exclude_select').val('1');
            }
        })
        $( "#include_exclude_select" ).change(function() {
            var selectedVal = $("#include_exclude_select").val();
            if (selectedVal == 0)
            {
                $(".opportunity_check").removeAttr('checked');
                $('.opportunity_container').find('input[type=checkbox]:checked').removeAttr('checked');
            }
            else
            {
                var radio_buttons = $(".opportunity_check");
                if (radio_buttons.filter(':checked').length == 0) {
                    $("#excluded_by_opportunity-1").prop("checked", true);
                    $(".opportunity_container").hide();
                }
            }
        });
    });
    var searchDescriptionLabels =
        {
            'work': {
                'length': {
                    'min-work-length': 'Has work experience of at least <span></span>',
                    'max-work-length': 'Has work experience less than ',
                    'max-work-length-b': 'and less than<span></span>'
                    //'min-work-lengths': 'Has work experience of at least ',
                    //'max-work-lengths': 'Has work experience less than '
                },
                'sector': 'Has work experience in  <span></span>',
                'type': 'Has work experience in a  <span></span>',
                'company': 'Has worked for  <span></span>',
                'specific': 'Has experience with'
            },
            'academic': {
                'school': {
                    'grade': '',
                    'school-subject': 'Studied ',
                    'result': 'Had a result of <span></span> or higher at A Level (or equivalent)'
                },
                'university': {
                    'degree_type': 'With degree type',
                    'degree_result': 'With degree result',
                    //'min-work-length': 'Has work experience of at least  <span></span>',
                    //'max-work-length': 'Has work experience less than ',
                    //'max-work-length-b': 'and less than <span></span>',
                    'university-group': 'Has studied from university (Group) ',
                    'university-specific': 'Has studied from university ',
					'university-sub-specific': 'Has studied with Specific Subject ',
                    'university-subject': 'Has studied with Subjects  Categories ',
					'university_from': 'Has degree year from ',
                    'university_to': 'Has degree year to '
                },
                'languages': {
                    'language': 'Speaks  <span></span>',
                    'level': 'at a <span></span> level'
                },
                'skills':{
                    'skill':'Has the following skills <span></span>',
		    		'level': 'at a <span></span> level'
                },
                'capabilities': 'Has the following capabilities'
            },
            'sport': {
                'sport': {
                    'sport_level': 'Has played sport at a <span></span> level',
                    'sport': 'Has played <span></span>',
                    'position': 'Has played sports as <span></span>'
                },
                'society': {
                    'society_category': 'Has been part of a <span></span> society',
                    'society_position': 'Has held the position of <span></span>',
                    'name': 'Has been part of <span></span>'
                },
            },
            'other': {
                'general': {
                    'gender': 'Gender ',
                    'ethnicity': 'With ethnicity(minority only) ',
                    'dob': 'With birth year of ',
                    'jobtype': 'With job type searching for '
                },
                'attributes': 'Has the following candidate attribute ',
                'sector': 'Has work sector preference in <span></span>',
            },
            'segment': {
                'segment': {
                    'exclude_by_talentpool': 'Has Excluded by talentpool <span></span>',
                    'specific-talentpool': 'Has Excluded by talentpool <span></span>',
                    'include_exclude_select': 'Has opportunity <span></span>',
                    'excluded_by_opportunity': 'Has opportunity type <span></span>',
                    'specific_opportunity_value': 'Has Specific opportunity <span></span>',
                    'excluded_email': 'Has excluded email <span></span>'
                }
            }
        };
    @if(Session::get('campaign', 0) == 1)
        setProgressIndicator('candidates');
    @endif
    
    $('#specific_company_input').tokenInput('{{route('search.getCompanies')}}');
    //$('#degree_subject_input').tokenInput('{{route('search.getDegreeSubjects')}}');
    $('#specific_sport_input').tokenInput('{{route('search.getSports')}}');
    $('#specific_society_input').tokenInput('{{route('search.getSocietyNames')}}');
    $('#degree_uni_input').tokenInputOther('{{route('search.getUniversities')}}');
    $('#specific_email_input').tokenInput('{{route('search.getUsersEmail')}}');
    $('#degree_subject_input').tokenInputOtherSubject('{{route('search.getSpecificSubjectInput')}}');
    
    $("#create-campaign-button").click( function() {
        //alert(1);
        $("#create_candidatepool_type").modal('show');
    });
    function setValueCandidate()
    {
        var textValue = document.getElementById("candidate_pool_modal_name").value;
        if (textValue.search(/\S/)==-1)
        {
            $("#create_candidatepool_type").modal('hide');
            alert('Candidate Pool name required.');
        }
        else
        {
            var elem = document.getElementById("candidate_pool_name");
            elem.value = textValue;
            document.getElementById('search-form-filter').submit();
            
        }
        
    }
</script>

<!-- Modal -->
<div class="modal fade" id="create_candidatepool_type" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      
      <div class="modal-body">
        <div id="db_search_align_container">
            
            <input type="text" id="candidate_pool_modal_name" name="candidate_pool_modal_name" value="" placeholder="Talent Pool Name" />
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="button white" data-dismiss="modal">Cancel</button>
        <button type="button" id="saveitem_candidate_pool" class="button blue" onclick="setValueCandidate();">Create Talent Pool</button>
      </div>
    </div>
  </div>
</div>
</body>
</html>
