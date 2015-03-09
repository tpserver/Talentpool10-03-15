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
    <div id="topbar_bg">
        <div id="topbar">
            <a href="/"><div id="logo"></div></a>
            <?php if( !isset($currentPage) ) $currentPage = true; ?>
            <div id="menu" style="width:450px;">
                <div class="menu_option @if( $currentPage == Route::is('campaign*')) {{'menu_option_selected'}} @endif">{{link_to_route('campaign.index', 'Campaigns')}}</div>
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
            <h1>Candidates Pools/ New Candidates Pool</h1>
        @endif
        <div id="later_display" style="display:block;">
        <?php
	if(Session::has('opportunity'))
        {
            $opportunity_details = Opportunity::where('id', '=', Session::get('opportunity'))->with('locations')->get();
            foreach($opportunity_details as $opportunity_detail)
            {
                $location_name = '';
                if($opportunity_detail->opportunity_type == 1)
                {
		?>
		<div class="search-filter-container" style="border-top: 10px solid #1ABC9C;">
		    <h4>Opportunity Filtering Options</h4>
		    <div id="opportunity-type-type-subject" class="search-filter-sentence-container" data-category="opportunity">
			<!--<div style="float: left; margin-top: 5px;">
			    Opportunity Name
			    <span></span>
			</div>
			<div class="filter-element" data-guid="c6f04a4c-94f0-4844-b790-e2e0b780136d" style="color: #1ABC9C;">
			    {{$opportunity_detail->name}}
			</div>
			<div class="clear"></div>
			<div style="float: left; margin-top: 5px;">
			    Opportunity Type
			    <span></span>
			</div>
			<div class="filter-element" data-guid="c6f04a4c-94f0-4844-b790-e2e0b780136d" style="color: #1ABC9C;">
			    Specific Hire
			</div>
			<div class="clear"></div>-->
			<div style="float: left; margin-top: 5px;">
			    Opportunity Location
			    <span></span>
			</div>
			<?php
			foreach ($opportunity_detail['locations'] as $location)
			{
			?>
			<div class="filter-element" data-guid="c6f04a4c-94f0-4844-b790-e2e0b780136d" style="color: #1ABC9C;">
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
			<div class="filter-element" data-guid="c6f04a4c-94f0-4844-b790-e2e0b780136d" style="color: #1ABC9C;">
			    {{$opportunity_detail->opportunity_date}}
			</div>
			<div class="clear"></div>
			<?php
			}
			?>
		    </div>
		    <div class="search-form-filter-container-clear-fix clear"></div>
		</div>
		<?php
		    //$opportunity_op = 'Opportunity Name - '.$opportunity_detail->name;
                    //$opportunity_op .= '/Opportunity Type - Specific Hire';
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
            //print_r($opportunity_details);
        }
        ?>
        </div>
        <div id="db_search_align_container">
            {{ Form::open(['url' => route('candidatesPool.edit_store'), 'id' => 'search-form-filter']) }}
	    <div id="progress_bar">
                <div id="total">{{$usersCount}}</div>
                <div id="candidates_label">Candidates</div>
                <div id="create-campaign-button" style="display:none;">Edit Talent Pool</div>
            </div>
            <?php
	    //print_r($details_filter);
	    $totalNo = count($candidateOptions);
	    //echo $totalNo;
	    for($i=0;$i<$totalNo;$i++)
	    {
		if($candidateOptions[$i]['category'] == 1)
		{
		    $category_workOptions[] = $candidateOptions[$i];
		}
		if($candidateOptions[$i]['group_id']==10)
		{
		    $attributes_category[] = $candidateOptions[$i];
		}
		if($candidateOptions[$i]['group_id']!=10 && $candidateOptions[$i]['category']==2)
		{
		    $academicOptions_category[] = $candidateOptions[$i];
		}
		if($candidateOptions[$i]['subcategory_id']==10)
		{
		    $experience_category[] = $candidateOptions[$i];
		}
		if($candidateOptions[$i]['subcategory_id']==5)
		{
		    $schoolSubjectOptions[] = $candidateOptions[$i];
		}
		    //print_r($candidateOptions[$i]);
	    }
	    if(isset($schoolSubjectOptions))
	    {
		$data_category = 'academic';
		$category_color = "#9b59b6";
		
		//echo $data_category." ".$category_color;
		
	    ?>
		<div class="search-filter-container" style="border-top: 10px solid {{$category_color}};">
		    <a class="remove-filter-container-btn" onclick="removeFilterContainer(this)" href="javascript:void(0)">x</a>
		    <div id="academic-school-school-subject" class="search-filter-sentence-container" data-category="{{$data_category}}">
			<div style="float: left; margin-top: 5px;">
			    Studied 
			    <span></span>
			</div>
			<?php
			foreach($schoolSubjectOptions as $value)
			{
			?>
			<div class="filter-element" data-guid="c6f04a4c-94f0-4844-b790-e2e0b780136d" style="background-color: {{$category_color}};">
			    {{$value['name']}}
			    <input type="hidden" data-group-name="academic" name="school-subject[]" value="{{$value['id']}}">
			    <a id="x-school-subject-{{$value['id']}}" class="remove-from-filter" data-group-delete="undefined" onclick="removeElementFromFIlter(this);">x</a>
			</div>
			<?php } ?>
			<div class="clear"></div>
		    </div>
		    <div class="search-form-filter-container-clear-fix clear"></div>
		</div>
	    <?php
	    }
	    if(isset($experience_category))
	    {
		//echo $experience_category[0]['category'];
	        if($experience_category[0]['category'] == 1)
		{
		    $data_category = 'work';
		    $category_color = "#2ecc71";
		}
		if($experience_category[0]['category'] == 2)
		{
		    $data_category = 'academic';
		    $category_color = "#9b59b6";
		}
		if($experience_category[0]['category'] == 3)
		{
		    $data_category = 'sport';
		    $category_color = "#3498db";
		}
		if($experience_category[0]['category'] == 4)
		{
		    $data_category = 'other';
		    $category_color = "#e74c3c";
		}
		//echo $data_category." ".$category_color;
		
	    ?>
		<div class="search-filter-container" style="border-top: 10px solid {{$category_color}};">
		    <a class="remove-filter-container-btn" onclick="removeFilterContainer(this)" href="javascript:void(0)">x</a>
		    <div id="work-sector" class="search-filter-sentence-container" data-category="{{$data_category}}">
			<div style="float: left; margin-top: 5px;">
			    Has experience with
			    <span></span>
			</div>
			<?php
			foreach($experience_category as $value)
			{
			?>
			<div class="filter-element" data-guid="9bff3c3c-060f-4d5f-8f1b-ce9c072f4e59" style="background-color: {{$category_color}};">
			    {{$value['name']}}
			    <input type="hidden" data-group-name="experience" name="experience[]" value="{{$value['id']}}">
			    <a id="x-experience-{{$value['id']}}" class="remove-from-filter" data-group-delete="undefined" onclick="removeElementFromFIlter(this);">x</a>
			</div>
			<?php } ?>
			<div class="clear"></div>
		    </div>
		    <div class="search-form-filter-container-clear-fix clear"></div>
		</div>
	    <?php
	    }
	    if(isset($attributes_category))
	    {
		//echo $attributes_category[0]['category'];
	        if($attributes_category[0]['category'] == 1)
		{
		    $data_category = 'work';
		    $category_color = "#2ecc71";
		}
		if($attributes_category[0]['category'] == 2)
		{
		    $data_category = 'academic';
		    $category_color = "#9b59b6";
		}
		if($attributes_category[0]['category'] == 3)
		{
		    $data_category = 'sport';
		    $category_color = "#3498db";
		}
		if($attributes_category[0]['category'] == 4)
		{
		    $data_category = 'other';
		    $category_color = "#e74c3c";
		}
		//echo $data_category." ".$category_color;
		
	    ?>
		<div class="search-filter-container" style="border-top: 10px solid {{$category_color}};">
		    <a class="remove-filter-container-btn" onclick="removeFilterContainer(this)" href="javascript:void(0)">x</a>
		    <div id="sport-attributes" class="search-filter-sentence-container" data-category="{{$data_category}}">
			<div style="float: left; margin-top: 5px;">
			    Has the following attributes
			    <span></span>
			</div>
			<?php
			foreach($attributes_category as $value)
			{
			?>
			<div class="filter-element" data-guid="61dcdab9-23e9-4f22-8cbc-99f89bc3a680" style="background-color: {{$category_color}};">
			    {{$value['name']}}
			    <input type="hidden" data-group-name="attributes" name="attributes[]" value="{{$value['id']}}">
			    <a id="x-attributes-{{$value['id']}}" class="remove-from-filter" data-group-delete="undefined" onclick="removeElementFromFIlter(this);">x</a>
			</div>
			<?php } ?>
			<div class="clear"></div>
		    </div>
		    <div class="search-form-filter-container-clear-fix clear"></div>
		</div>
	    <?php
	    }
	    if(isset($category_workOptions))
	    {
		//echo $category_workOptions[0]['category'];
	        if($category_workOptions[0]['category'] == 1)
		{
		    $data_category = 'work';
		    $category_color = "#2ecc71";
		}
		if($category_workOptions[0]['category'] == 2)
		{
		    $data_category = 'academic';
		    $category_color = "#9b59b6";
		}
		if($category_workOptions[0]['category'] == 3)
		{
		    $data_category = 'sport';
		    $category_color = "#3498db";
		}
		if($category_workOptions[0]['category'] == 4)
		{
		    $data_category = 'other';
		    $category_color = "#e74c3c";
		}
		//echo $data_category." ".$category_color;
		
	    ?>
		<div class="search-filter-container" style="border-top: 10px solid {{$category_color}};">
		    <a class="remove-filter-container-btn" onclick="removeFilterContainer(this)" href="javascript:void(0)">x</a>
		    <div id="work-sector" class="search-filter-sentence-container" data-category="{{$data_category}}">
			<div style="float: left; margin-top: 5px;">
			    Has work experience in  
			    <span></span>
			</div>
			<?php
			foreach($category_workOptions as $value)
			{
			?>
			<div class="filter-element" data-guid="61dcdab9-23e9-4f22-8cbc-99f89bc3a680" style="background-color: {{$category_color}};">
			    {{$value['name']}}
			    <input type="hidden" data-group-name="sector" name="work_option[]" value="{{$value['id']}}">
			    <a id="x-work_option-{{$value['id']}}" class="remove-from-filter" data-group-delete="undefined" onclick="removeElementFromFIlter(this);">x</a>
			</div>
			<?php } ?>
			<div class="clear"></div>
		    </div>
		    <div class="search-form-filter-container-clear-fix clear"></div>
		</div>
	    <?php
	    }
	    if(!empty($candidateworkTypes))
	    {
		$category_color = "#2ecc71";
		$data_category = "work";
	    ?>
		<div class="search-filter-container" style="border-top: 10px solid {{$category_color}};">
		    <a class="remove-filter-container-btn" onclick="removeFilterContainer(this)" href="javascript:void(0)">x</a>
		    <div id="work-type" class="search-filter-sentence-container" data-category="{{$data_category}}">
			<div style="float: left; margin-top: 5px;">
			    Has work experience in a 
			    <span></span>
			</div>
			<?php
			foreach($candidateworkTypes as $value)
			{
			?>
			<div class="filter-element" data-guid="e839208a-d9b6-4430-b148-cdf6fe008a97" style="background-color: {{$category_color}};">
			    {{$value['name']}}
			    <input type="hidden" data-group-name="work" name="work_type_option[]" value="{{$value['id']}}">
			    <a id="x-work_type-{{$value['id']}}" class="remove-from-filter" data-group-delete="undefined" onclick="removeElementFromFIlter(this);">x</a>
			</div>
			<?php } ?>
			<div class="clear"></div>
		    </div>
		    <div class="search-form-filter-container-clear-fix clear"></div>
		</div>
	    <?php
	    }
	    if(!empty($candidateworkLengths))
	    {
		$category_color = "#2ecc71";
		$data_category = "work";
	    ?>
		<div class="search-filter-container" style="border-top: 10px solid {{$category_color}};">
		    <a class="remove-filter-container-btn" onclick="removeFilterContainer(this)" href="javascript:void(0)">x</a>
		    <div id="work-length-min-work-length" class="search-filter-sentence-container" data-category="{{$data_category}}">
			<div style="float: left; margin-top: 5px;">
			    Has work experience of 
			    <span></span>
			</div>
			<?php
			foreach($candidateworkLengths as $value)
			{
			?>
			<div class="filter-element" data-guid="b2d38d90-2687-4053-8630-7c22ece2ca79" style="background-color: {{$category_color}};">
			    {{$value['name']}}
			    <input type="hidden" data-group-name="work" name="min-work-length[]" value="{{$value['id']}}">
			    <a id="x-min-work-length-{{$value['id']}}" class="remove-from-filter" data-group-delete="undefined" onclick="removeElementFromFIlter(this);">x</a>
			</div>
			<?php } ?>
			<div class="clear"></div>
		    </div>
		    <div class="search-form-filter-container-clear-fix clear"></div>
		</div>
	    <?php
	    }
	    if(!empty($candidateSportLevels))
	    {
		$category_color = "#3498db";
		$data_category = "sport";
	    ?>
		<div class="search-filter-container" style="border-top: 10px solid {{$category_color}};">
		    <a class="remove-filter-container-btn" onclick="removeFilterContainer(this)" href="javascript:void(0)">x</a>
		    <div id="sport-sport-sport_level" class="search-filter-sentence-container" data-category="{{$data_category}}">
			<div style="float: left; margin-top: 5px;">
			    Has played sport at a level
			    <span></span>
			</div>
			<?php
			foreach($candidateSportLevels as $value)
			{
			?>
			<div class="filter-element" data-guid="3698c362-d160-4033-adbf-85579c3ca587" style="background-color: {{$category_color}};">
			    {{$value['name']}}
			    <input type="hidden" data-group-name="sport" name="sport_level[]" value="{{$value['id']}}">
			    <a id="x-sport_level-{{$value['id']}}" class="remove-from-filter" data-group-delete="undefined" onclick="removeElementFromFIlter(this);">x</a>
			</div>
			<?php } ?>
			<div class="clear"></div>
		    </div>
		    <div class="search-form-filter-container-clear-fix clear"></div>
		</div>
	    <?php
	    }
	    if(!empty($candidateSportNames))
	    {
		$category_color = "#3498db";
		$data_category = "sport";
	    ?>
		<div class="search-filter-container" style="border-top: 10px solid {{$category_color}};">
		    <a class="remove-filter-container-btn" onclick="removeFilterContainer(this)" href="javascript:void(0)">x</a>
		    <div id="sport-sport" class="search-filter-sentence-container" data-category="{{$data_category}}">
			<div style="float: left; margin-top: 5px;">
			    Has played
			    <span></span>
			</div>
			<?php
			foreach($candidateSportNames as $value)
			{
			?>
			<div class="filter-element" data-guid="3e739047-ae0a-4f15-bdc2-4332ab8bad35" style="background-color: {{$category_color}};">
			    {{$value['name']}}
			    <input type="hidden" data-group-name="sport" name="sport_name[]" value="{{$value['id']}}">
			    <a id="x-sport_name-{{$value['id']}}" class="remove-from-filter" data-group-delete="undefined" onclick="removeElementFromFIlter(this);">x</a>
			</div>
			<?php } ?>
			<div class="clear"></div>
		    </div>
		    <div class="search-form-filter-container-clear-fix clear"></div>
		</div>
	    <?php
	    } 
	    if(!empty($candidateSocialpositions))
	    {
		$category_color = "#3498db";
		$data_category = "sport";
	    ?>
		<div class="search-filter-container" style="border-top: 10px solid {{$category_color}};">
		    <a class="remove-filter-container-btn" onclick="removeFilterContainer(this)" href="javascript:void(0)">x</a>
		    <div id="sport-society-society_position" class="search-filter-sentence-container" data-category="{{$data_category}}">
			<div style="float: left; margin-top: 5px;">
			    Has held position of
			    <span></span>
			</div>
			<?php
			foreach($candidateSocialpositions as $value)
			{
			?>
			<div class="filter-element" data-guid="3e739047-ae0a-4f15-bdc2-4332ab8bad35" style="background-color: {{$category_color}};">
			    {{$value['name']}}
			    <input type="hidden" data-group-name="sport" name="society_position[]" value="{{$value['id']}}">
			    <a id="x-society_position-{{$value['id']}}" class="remove-from-filter" data-group-delete="undefined" onclick="removeElementFromFIlter(this);">x</a>
			</div>
			<?php } ?>
			<div class="clear"></div>
		    </div>
		    <div class="search-form-filter-container-clear-fix clear"></div>
		</div>
	    <?php
	    }
	    if(!empty($candidateSocialCategories))
	    {
		$category_color = "#3498db";
		$data_category = "sport";
	    ?>
		<div class="search-filter-container" style="border-top: 10px solid {{$category_color}};">
		    <a class="remove-filter-container-btn" onclick="removeFilterContainer(this)" href="javascript:void(0)">x</a>
		    <div id="sport-society-society_category" class="search-filter-sentence-container" data-category="{{$data_category}}">
			<div style="float: left; margin-top: 5px;">
			    Has been part of society
			    <span></span>
			</div>
			<?php
			foreach($candidateSocialCategories as $value)
			{
			?>
			<div class="filter-element" data-guid="87e7293c-073b-49e3-9c59-d771cde45e52" style="background-color: {{$category_color}};">
			    {{$value['name']}}
			    <input type="hidden" data-group-name="sport" name="society_category[]" value="{{$value['id']}}">
			    <a id="x-society_category-{{$value['id']}}" class="remove-from-filter" data-group-delete="undefined" onclick="removeElementFromFIlter(this);">x</a>
			</div>
			<?php } ?>
			<div class="clear"></div>
		    </div>
		    <div class="search-form-filter-container-clear-fix clear"></div>
		</div>
	    <?php
	    }
	    if(!empty($candiateSkills))
	    {
		$category_color = "#9b59b6";
		$data_category = "academic";
	    ?>
		<div class="search-filter-container" style="border-top: 10px solid {{$category_color}};">
		    <a class="remove-filter-container-btn" onclick="removeFilterContainer(this)" href="javascript:void(0)">x</a>
		    <div id="academic-skills-skills" class="search-filter-sentence-container" data-category="{{$data_category}}">
			<div style="float: left; margin-top: 5px;">
			    Has the following skills
			    <span></span>
			</div>
			<?php
			foreach($candiateSkills as $value)
			{
			?>
			<div class="filter-element" data-guid="cbf0d825-f483-4b3d-a980-40c600eb2faf" style="background-color: {{$category_color}};">
			    {{$value['name']}}
			    <input type="hidden" data-group-name="skills" name="skills[]" value="{{$value['id']}}">
			    <a id="x-skills-{{$value['id']}}" class="remove-from-filter" data-group-delete="undefined" onclick="removeElementFromFIlter(this);">x</a>
			</div>
			<?php } ?>
			<div class="clear"></div>
		    </div>
		    <div class="search-form-filter-container-clear-fix clear"></div>
		</div>
	    <?php
	    }
	    if(!empty($candidatedegreeTypes))
	    {
		$category_color = "#9b59b6";
		$data_category = "academic";
	    ?>
		<div class="search-filter-container" style="border-top: 10px solid {{$category_color}};">
		    <a class="remove-filter-container-btn" onclick="removeFilterContainer(this)" href="javascript:void(0)">x</a>
		    <div id="academic-university-degree_type" class="search-filter-sentence-container" data-category="{{$data_category}}">
			<div style="float: left; margin-top: 5px;">
			    With degree type
			    <span></span>
			</div>
			<?php
			foreach($candidatedegreeTypes as $value)
			{
			?>
			<div class="filter-element" data-guid="dd3d6fbd-23bf-4825-8804-65527f7a7f9b" style="background-color: {{$category_color}};">
			    {{$value['name']}}
			    <input type="hidden" data-group-name="degree" name="degree_type[]" value="{{$value['id']}}">
			    <a id="x-degree_type-{{$value['id']}}" class="remove-from-filter" data-group-delete="undefined" onclick="removeElementFromFIlter(this);">x</a>
			</div>
			<?php } ?>
			<div class="clear"></div>
		    </div>
		    <div class="search-form-filter-container-clear-fix clear"></div>
		</div>
	    <?php
	    }
	    if(!empty($candidatedegreeResults))
	    {
		$category_color = "#9b59b6";
		$data_category = "academic";
	    ?>
		<div class="search-filter-container" style="border-top: 10px solid {{$category_color}};">
		    <a class="remove-filter-container-btn" onclick="removeFilterContainer(this)" href="javascript:void(0)">x</a>
		    <div id="academic-university-degree_result" class="search-filter-sentence-container" data-category="{{$data_category}}">
			<div style="float: left; margin-top: 5px;">
			    With degree result
			    <span></span>
			</div>
			<?php
			foreach($candidatedegreeResults as $value)
			{
			?>
			<div class="filter-element" data-guid="8a7d5df9-8083-43e9-b9f9-fbf3bfcdcea6" style="background-color: {{$category_color}};">
			    {{$value['name']}}
			    <input type="hidden" data-group-name="degree" name="degree_result[]" value="{{$value['id']}}">
			    <a id="x-degree_result-{{$value['id']}}" class="remove-from-filter" data-group-delete="undefined" onclick="removeElementFromFIlter(this);">x</a>
			</div>
			<?php } ?>
			<div class="clear"></div>
		    </div>
		    <div class="search-form-filter-container-clear-fix clear"></div>
		</div>
	    <?php
	    }
	    if(!empty($candidatedegreeSubjects))
	    {
		$category_color = "#9b59b6";
		$data_category = "academic";
	    ?>
		<div class="search-filter-container" style="border-top: 10px solid {{$category_color}};">
		    <a class="remove-filter-container-btn" onclick="removeFilterContainer(this)" href="javascript:void(0)">x</a>
		    <div id="academic-university" class="search-filter-sentence-container" data-category="{{$data_category}}">
			<div style="float: left; margin-top: 5px;">
			    With degree subject
			    <span></span>
			</div>
			<?php
			foreach($candidatedegreeSubjects as $value)
			{
			?>
			<div class="filter-element" data-guid="71e9e277-beb4-443a-822e-f275c916a00f" style="background-color: {{$category_color}};">
			    {{$value['name']}}
			    <input type="hidden" data-group-name="degree" name="university-subject[]" value="{{$value['id']}}">
			    <a id="x-university-subject-{{$value['id']}}" class="remove-from-filter" data-group-delete="undefined" onclick="removeElementFromFIlter(this);">x</a>
			</div>
			<?php } ?>
			<div class="clear"></div>
		    </div>
		    <div class="search-form-filter-container-clear-fix clear"></div>
		</div>
	    <?php
	    }
	    //print_r($experience_category); echo "<br/><br/>"; if(isset($academicOptions_category)){print_r($academicOptions_category);} echo "<br/><br/>"; print_r($attributes_category); echo "<br/><br/>"; if(isset($academicOptions_category)){print_r($category_workOptions);}
	    ?>
	    <!--<div class="search-filter-container" style="border-top: 10px solid #2ecc71;">
		<a class="remove-filter-container-btn" onclick="removeFilterContainer(this)" href="javascript:void(0)"></a>
		<div id="work-sector" class="search-filter-sentence-container" data-category="work">
		    <div style="float: left; margin-top: 5px;">
			Has work experience in
			<span></span>
		    </div>
		    <div class="filter-element" data-guid="bc12c6a5-2b9a-4e66-9863-b1ecd2f3ffed" style="color: #2ecc71;">
			Design
			<input type="hidden" data-group-name="sector" name="work_option[]" value="2">
			<a id="x-work_option-2" class="remove-from-filter" data-group-delete="undefined" onclick="removeElementFromFIlter(this);"></a>
		    </div>
		    <div class="clear"></div>
		</div>
		<div class="search-form-filter-container-clear-fix clear"></div>
	    </div>-->
	    <div id='search-form-filter-clear-fix' class="clear"></div>
            <div id="new-candidate-pool-form" style="display: none;">
                {{Form::hidden('name', $candidatesPools->name, ['id' => 'candidate_pool_name', 'placeholder' => 'Candidates Pool Name'])}}
		{{Form::hidden('candidatepool_id', $candidatesPools->id, ['id' => 'candidatepool_id'])}}
                {{Form::hidden('users', '', ['id' => 'campaign-users'])}}
                @if( Input::has('returnTo') )
                    {{Form::hidden('returnTo', Input::get('returnTo'))}}
                @endif
                {{Form::submit('Save Candidates Pool', ['class' => 'small-button red-button float-left']);}}
                {{Form::button('Cancel', ['id' => 'new-candidates-pool-cancel-btn', 'class' => 'small-button red-button float-left'])}}
                {{Session::flash('campaign', Session::get('campaign', 0))}}
            </div>
            {{ Form::close() }}
            <!--<div id="create-campaign-button" style="display:none;">Edit Campaign</div>-->
            <!--<div id="create-campaign-usebutton" style="display:none;">Create Campaign</div>-->
        </div>
        {{ Form::open(array('url' => 'foo/bar', 'id' => 'search-form')) }}
        <div id="categories_box">
            <div class="option_icon_box" id="work_option">
                <div id="border_1" class="option_icon_top_border"></div>
                <div class="option_icon" id="icon_1"></div>
                <div class="option_text">Work Experience</div>
            </div>
            <div class="option_icon_box" id="academic_option">
                <div id="border_2" class="option_icon_top_border"></div>
                <div class="option_icon" id="icon_2"></div>
                <div class="option_text">Academics &#38; Skills</div>
            </div>
            <div class="option_icon_box" id="sport_option">
                <div id="border_3" class="option_icon_top_border"></div>
                <div class="option_icon" id="icon_3"></div>
                <div class="option_text">Sports &#38; Societies</div>
            </div>
            <!--<div class="option_icon_box" id="other_option">
                <div id="border_4" class="option_icon_top_border"></div>
                <div class="option_icon" id="icon_4"></div>
                <div class="option_text">Other</div>
            </div>-->
        </div>
        <div class="sub_option_container" id="sub_option_container_work">
            <div id="sub_option_length" class="sub_option ">Length</div>
            <div id="sub_option_sector" class="sub_option ">Sector</div>
            <div id="sub_option_type" class="sub_option ">Type</div>
            <!--<div id="sub_option_company" class="sub_option ">Company</div>-->
            <div id="sub_option_specific" class="sub_option ">Specific Experience</div>
        </div>
        <div class="sub_option_container" id="sub_option_container_academic">
            <div id="sub_option_school" class="sub_option ">School</div>
            <div id="sub_option_university" class="sub_option ">University</div>
            <div id="sub_option_languages" class="sub_option ">Languages</div>
            <div id="sub_option_skills" class="sub_option ">Skills</div>
            <div id="sub_option_capabilities" class="sub_option ">Capabilities</div>
        </div>
        <div class="sub_option_container" id="sub_option_container_sport">
            <div id="sub_option_sport" class="sub_option ">Sport</div>
            <div id="sub_option_society" class="sub_option ">Society</div>
            <div id="sub_option_attributes" class="sub_option ">Attributes</div>
        </div>
        <div class="sub_option_filter" id="sub_option_work_filter_length">
            <div class="sub_sub_option work_experience">
                <div class="box_header">Length</div>
                <select name="min-work-length" id="min-work-length">
                    <option value="0">No Minimum</option>
                    @foreach($workDurations as $workDuration)
                    <option value="{{$workDuration->id}}">{{$workDuration->name}}</option>
                    @endForeach
                </select>
                <select name="max-work-length" id="max-work-length">
                    <option value="0">No Maximum</option>
                    @foreach($workDurations as $workDuration)
                    <option value="{{$workDuration->id}}">{{$workDuration->name}}</option>
                    @endForeach
                </select>
                <div class="clear"></div>
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
                    <div class="box_header">Sector</div>
                    @include('inputs.work', $workOptions)
                    <div class="add_to_filter_holder">                    
                        <div class="add_to_filter_btn add-to-filter-btn work_experience_btn">Add to Filter +</div>
                        <div id="spacer"></div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
        <div class="sub_option_filter" id="sub_option_work_filter_type">
            <div class="sub_sub_option work_experience">
                <div class="box_header">Type</div>
                @foreach($workTypes as $userType)
                <label for="work_type_option-{{$userType->id}}" class="work_sector" style="width: 240px;">{{ Form::checkbox('work_type_option[]', $userType->id, false, ['id' => 'work_type_option-'.$userType->id, 'data-group-name' => 'work'] ) }}{{$userType->name}}</label>
                @endforeach
                <div class="clear"></div>
                <div class="add_to_filter_holder">                    
                    <div class="add_to_filter_btn add-to-filter-btn work_experience_btn">Add to Filter +</div>
                    <div id="spacer"></div>
                </div>
                <div class="clear"></div>
            </div>

            <div class="clear"></div>
        </div>
        <!--<div class="sub_option_filter" id="sub_option_work_filter_company">
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
        </div>-->
        <div class="sub_option_filter" id="sub_option_work_filter_specific">
            <div class="sub_sub_option work_specific">
                <div class="box_header">Specific Experience</div>
                @foreach($experience as $experience)
                <label class="work_sector">{{ Form::checkbox('experience[]', $experience->id, false, ['id' => 'experience-' . $experience->id, 'data-group-name' => 'experience']) }}
                    {{ $experience->name }}</label>
                @endforeach
                <div class="clear"></div>
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
            <div class="sub_sub_option university">
            <div class="box_header">Degree Type</div>
                @foreach($degreeTypes as $degreeType)
                <label class="work_sector">{{ Form::checkbox('degree_type[]', $degreeType->id, false, ['id' => 'degree_type-' . $degreeType->id, 'data-group-name' => 'degree']) }}
                    {{ $degreeType->name }}</label>
                @endforeach
                <div class="clear"></div>
                <div class="add_to_filter_holder">                    
                    <div class="add_to_filter_btn add-to-filter-btn academic_btn">Add to Filter +</div>
                    <div id="spacer"></div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="sub_sub_option university">
                <div class="box_header">Degree Result</div>
                @foreach($degreeResults as $degreeResult)
                <label class="work_sector">{{ Form::checkbox('degree_result[]', $degreeResult->id, false, ['id' => 'degree_result-' . $degreeResult->id, 'data-group-name' => 'degree']) }}
                    {{ $degreeResult->name }}</label>
                @endforeach
                <div class="clear"></div>
                <div class="add_to_filter_holder">                    
                    <div class="add_to_filter_btn add-to-filter-btn academic_btn">Add to Filter +</div>
                    <div id="spacer"></div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="sub_sub_option university">
                <div class="box_header">Specific Subject</div>
                <select name="university-subject" id="university-subject">
                    <option value="0">Subject</option>
                    @foreach($degreeSubjects as $degreeSubject)
                        <option value="{{$degreeSubject->id}}">{{$degreeSubject->name}}</option>
                    @endforeach
                </select>
                <div class="clear"></div>
                <div class="add_to_filter_holder">                    
                    <div class="add_to_filter_btn add-to-filter-btn academic_btn">Add to Filter +</div>
                    <div id="spacer"></div>
                </div>
                <div class="clear"></div>
            </div>
            <!--<div class="sub_sub_option university">
                <div class="box_header">Graduation Year From</div>
                <select name="university_from" id="university-subject">
                    <option value="0">Graduation Year From</option>
                    @for ( $i = 2000; $i <= 2019; $i++ )
                    <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
                <div class="clear"></div>
                <div class="add_to_filter_holder">                    
                    <div class="add_to_filter_btn add-to-filter-btn academic_btn">Add to Filter +</div>
                    <div id="spacer"></div>
                </div>
                <div class="clear"></div>
            </div>-->
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
            <!--<div class="sub_sub_option university">
                <div class="box_header">University</div>
                <div class="sub_option_divider">Top Universities</div>
                <div class="sub_option_divider">University Group</div>
                <label class="subject_category"><input type="checkbox" name="degree_subject" value="" />Russell Group</label>
                <label class="subject_category"><input type="checkbox" name="degree_subject" value="" />Ivy League</label>

                <div class="sub_option_divider">Specific Universities</div>
                {{Form::text('degree_uni_input', '', ['id'=>'degree_uni_input'])}}
                <div class="subject_input_helper">Type a University Above &#8593;</div>
                <div class="clear"></div>
                <div class="add_to_filter_holder">                    
                    <div class="add_to_filter_btn add-to-filter-btn academic_btn">Add to Filter +</div>
                    <div id="spacer"></div>
                </div>
                <div class="clear"></div>
            </div>-->

        </div>
        <div class="sub_option_filter language" id="sub_option_academic_filter_languages">

            <div class="sub_sub_option">
                <div class="box_header">Language</div>
                <select name="language[]" id="language" data-group-name="language" data-group-delete="true">
                    <option value="0">Language</option>
                    @foreach ( $languages as $language )
                    <option value="{{ $language->id }}">{{ $language->name }}</option>
                    @endforeach
                </select>
                <select name="language-level[]" id="language-level" data-group-name="language" data-group-delete="false">
                    <option value="0">Level</option>
                    @foreach ( $languageLevels as $languageLevel )
                    <option value="{{ $languageLevel->id }}">{{ $languageLevel->name }}</option>
                    @endforeach
                </select>
                <div class="clear"></div>
                <div class="add_to_filter_holder">                    
                    <div class="add_to_filter_btn add-to-filter-btn academic_btn">Add to Filter +</div>
                    <div id="spacer"></div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <div class="sub_option_filter skills" id="sub_option_academic_filter_skills">
            <div class="sub_sub_option">
                @include('search.skills', $skillOptions)
                <div class="clear"></div>
                <div class="add_to_filter_holder">                    
                    <div class="add_to_filter_btn add-to-filter-btn academic_btn">Add to Filter +</div>
                    <div id="spacer"></div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <div class="sub_option_filter capabilities" id="sub_option_academic_filter_capabilities">
            <div class="sub_sub_option">
                <div class="box_header">Capabilities</div>
                @include('search.capabilities', $capabilities)
                <div class="clear"></div>
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
                <div class="box_header">Sport Level</div>
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
            <div class="sub_sub_option">
                <div class="box_header">Society Category</div>
                @include('search.social_categories', $socialCategories)
                <div class="clear"></div>
                <div class="add_to_filter_holder">                    
                    <div class="add_to_filter_btn add-to-filter-btn sports_and_societies_btn">Add to Filter +</div>
                    <div id="spacer"></div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="sub_sub_option">
                <div class="box_header">Society Position</div>
                @include('search.social_positions', $socialPositions)
                <div class="clear"></div>
                <div class="add_to_filter_holder">                    
                    <div class="add_to_filter_btn add-to-filter-btn sports_and_societies_btn">Add to Filter +</div>
                    <div id="spacer"></div>
                </div>
                <div class="clear"></div>
            </div>
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
        </div>
        <div class="sub_option_filter" id="sub_option_sport_filter_attributes">
            <div class="sub_sub_option">
                <div class="box_header">Attributes</div>
                <?php $paramSafeName = 'attributes';  ?>
                @foreach( $attributes as $option )
                    <label class="work_sector">{{ Form::checkbox($paramSafeName.'[]', $option->id, false, ['id' => $paramSafeName . '-' . $option->id, 'data-group-name' => 'attributes']) }}
                    {{ $option->name }}</label>
                @endforeach

                <div class="clear"></div>
                <div class="add_to_filter_holder">
                    <div class="add_to_filter_btn add-to-filter-btn sports_and_societies_btn">Add to Filter +</div>
                    <div id="spacer"></div>
                </div>
                <div class="clear"></div>
            </div>

        </div>
        <div class="sub_option_filter" id="sub_option_other_filter">
            <div>
                {{ Form::label('gender') }} {{ Form::select('gender', ['Not Specified', 'Male', 'Female']) }}
                {{ Form::label('ethnicity') }} @include('inputs.ethnicity_dropdown', $ethnicities)
                {{ Form::label('birth year')}}{{ Form::select('dob', range(2005, 1930)) }}
            </div>
            <div class="clear"></div>
            <div class="add_to_filter_btn add-to-filter-btn academic_btn">Add to Filter</div>
        </div>
        {{ Form::close() }}
    </div>
</div>
<div id="footer">
</div>

@include('common.bottom')
{{ HTML::script('js/bootstrap.min.js') }}
{{ HTML::script('js/jquery.tokeninput.js') }}
{{ HTML::script('js/db_search.js') }}   
{{ HTML::script('js/equalize.min.js') }}
<script>
    var searchDescriptionLabels =
        {
            'work': {
                'length': {
                    'min-work-length': 'Has work experience of at least  <span></span>',
                    'max-work-length': 'Has work experience less than ',
                    'max-work-length-b': 'and less than<span></span>'
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
                    'min-work-length': 'Has work experience of at least  <span></span>',
                    'max-work-length': 'Has work experience less than ',
                    'max-work-length-b': 'and less than<span></span>'
                },
                'languages': {
                    'language': 'Speaks  <span></span>',
                    'level': 'at a <span></span> level'
                },
                'skills':{
                    'skill':'Has the following skill <span></span>',
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
                'attributes': 'Has the following attributes'
            }
        };
    @if(Session::get('campaign', 0) == 1)
        setProgressIndicator('candidates');
    @endif
    $('#specific_company_input').tokenInput('{{route('search.getCompanies')}}');
    $('#degree_subject_input').tokenInput('{{route('search.getDegreeSubjects')}}');
    $('#specific_sport_input').tokenInput('{{route('search.getSports')}}');
    $('#specific_society_input').tokenInput('{{route('search.getSocietyNames')}}');
    $('#degree_uni_input').tokenInput('{{route('search.getUniversities')}}');
    
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
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        <div id="db_search_align_container">
            Please provide a name for your new Talent Pool
            <input type="text" id="candidate_pool_modal_name" name="candidate_pool_modal_name" value="{{$candidatesPools->name}}" placeholder="Candidate Pool Name" />
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="saveitem_candidate_pool" class="btn btn-primary" onclick="setValueCandidate();">Save changes</button>
      </div>
    </div>
  </div>
</div>
</body>
</html>
