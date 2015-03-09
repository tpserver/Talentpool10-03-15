@extends('layouts.employer')
@section('head.content')
    @include('campaign.common.head')
@stop
@section('content')
<div id="main_container">
    <h1>Campaigns / New Campaign</h1>
    @include('common.progress_indicator')
    <div id="campaing-steps-container">
        <div id="campaing-step-error-container" onclick="$(this).fadeOut()"></div>
        <div id="preview-container" class="campaign-step-container">
            <div id="preview-box">
            <?php
            $userTotal = DB::table('candidates_pool_user')->where('candidates_pool_id', '=', $candidatesPool->id)->count();
            ?>
                {{Form::open([ 'url' =>route('new-campaign.save-step'), 'id'=>'save-campaign-payment-form', 'style' =>'display: none'])}}
                    {{Form::hidden('step', 'preview')}}
                    {{Form::text('campaign-name', '', ['placeholder' => 'Campaign Name'])}}
                    {{Form::hidden('opportunity', $opportunity->id, ['id'=>'campaign-opportunity'])}}
                    {{Form::hidden('candidates_pool', $candidatesPool->id, ['id'=>'campaign-candidates-pool'])}}
                    {{Form::hidden('email_template', $emailTemplate->id, ['id'=>'campaign-email-template'])}}
                    {{Form::submit('Save')}}
                {{Form::close()}}
                <!--<div id="progress_container" class="campaign-preview-last-right" style="margin-bottom: 15px;">
                    <div class="campaign-preview-right">
                    {{ link_to_route('opportunity.edit', 'View/Edit Opportunity', ['id' => $opportunity->id], ['id' => 'edit-template-btn', 'class' => 'small-button blue-button float-left', 'style' => 'margin-right: 10px;width: 240px !important;background-color: #3498DB;', 'target' => '_blank']) }}
                    </div>
                    <div class="campaign-preview-right">
                        {{ link_to_route('candidatepool.edit', 'View/Edit TalentPool', ['id' => $candidatesPool->id], ['id' => 'edit-template-btn', 'class' => 'small-button purple-button float-left', 'style' => 'margin-right: 10px;width: 240px !important;background-color: #9B59B6;', 'target' => '_blank']) }}
                    </div>
                    <div class="campaign-preview-right">
                        {{ link_to_route('email-template.edit', 'View/Edit Message', ['id' => $emailTemplate->id], ['id' => 'edit-template-btn', 'class' => 'small-button red-button float-left', 'style' => 'margin-right: 10px;width: 240px !important;', 'target' => '_blank']) }}
                    </div>
                </div>-->
                <!--<div class="campaign-preview-right">
                        {{ link_to_route('email-template.edit', 'View/Edit Message', ['id' => $emailTemplate->id], ['id' => 'edit-template-btn', 'class' => 'small-button red-button float-left', 'style' => 'margin-right: 10px;width: 240px !important;', 'target' => '_blank']) }}
                </div>-->
                <!--<div style="margin-bottom: 15px;">One last step</div>-->
                <div id="campaign-preview-container">
                	
                    <div id="email_preview_box">
                    <div class="box_header">Campaign Preview</div>
                       <div class="opportunity">
                            <div class="box_label_container">
                               <div class="box_label">Opportunity</div>
                           </div>
                           <div class="box_content_container">
                               <div class="box_label"><span id="preview-opportunity-name">{{$opportunity->name}}</span></div>
                           </div>
                       </div>
                        <div class="opportunity">
                            <div class="box_label_container">
                                <div class="box_label">Talent Pool</div>
                            </div>
                            <div class="box_content_container">
                                <div class="box_label"><span id="preview-candidates-pool-name">{{$candidatesPool->name}}</span></div>
                                <div class="color_box" id="candidates_preview_box_label_right">
                                    <div class="box_label">{{$userTotal}} Candidates</div>
                                </div>
                            </div>
                                                    
                        </div>
                        <div id="email_subject_label_container" class="box_label_container">
                            <div class="box_label">Subject</div>
                        </div>
                        <div id="email_subject_container" class="box_content_container">
                            <div  class="box_label"><span id="preview-email-subject">{{$emailTemplate->subject}}</span></div>
                        </div>
                        <iframe id="preview-email-body" src="{{route('campaign-email-preview')}}"></iframe>
                    </div>
                </div>
            </div>
            <div class="button-holder">
                <div class="red_button campaing-back-step-btn" onclick="window.location='{{route('new-campaign.email')}}'">Back</div>
                <div class="red_button campaing-next-step-btn" onclick="campaingNextButton('save-campaign-payment-form', '')">Next</div>
            </div>
        </div>
    </div>    
    <div id="spacer"></div>
</div>
@stop
@section('bottom.content')
{{ HTML::script('js/campaign.js') }}
{{ HTML::script('js/jquery.ba-bbq.js') }}
{{ HTML::script('js/jquery.tokeninput.js') }}
{{ HTML::script('js/db_search.js') }} 
{{--print_r(Session::all())--}}
<script>
    function campaingNextButton(formId, errorMsg)
    {
        var form = $('#'+formId);
        form.submit();
        //alert(formId);
        //var form = $('#'+formId);
        //if(form.find('input:radio:checked').length == 0)
        //{
        //    $("#campaing-step-error-container").height( 70 );
        //    $("#campaing-step-error-container").show();
        //    showStepError(errorMsg);
        //}
        //else
        //{
        //    //alert($('opportunity').val());
        //    checkdVal = $('input:radio[name=opportunity]:checked').val();
        //    if (checkdVal==0)
        //    {
        //        $("#show_opportunity_type").modal('show');
        //    }
        //    else
        //    {
        //        form.submit();
        //    }
        //}
    }
</script>
<script>
    $(function() {
        setProgressIndicator('preview');
        var iFrame = $('#preview-email-body');
        iFrame.contents().find('#email-body').html('{{{$emailTemplate->name}}}');
        iFrame.css('height', iFrame.contents().find('body').height());
        @if(isset($error))
            {{'showStepError("'.$error.'");'}}
        @endif
    });
</script>
@stop