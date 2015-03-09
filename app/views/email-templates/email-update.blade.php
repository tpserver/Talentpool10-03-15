@extends('layouts.employer')
@section('head.content')
    {{ HTML::script('js/vendor/tinymce/js/tinymce/tinymce.min.js') }}
    {{ HTML::style('js/vendor/codemirror/lib/codemirror.css') }}
    {{ HTML::script('js/vendor/codemirror/lib/codemirror.js') }}
    {{ HTML::script('js/vendor/codemirror/mode/htmlembedded/htmlembedded.js') }}
    <script type="text/javascript">
    
    window.onload = function() {
                    window.editor = CodeMirror.fromTextArea(code_textarea, {
                        mode: "htmlembedded",
                        theme: "default",
                        lineNumbers: true
                    });
                };
    
    tinymce.init({

        selector: 'textarea.mceEditor',
        menubar: false,
        //menubar: true,
        plugins: ['anchor link code table contextmenu'],
        //plugins: ["advlist autolink lists link image charmap print preview anchor",
        //"searchreplace visualblocks code fullscreen",
        //"insertdatetime media table contextmenu paste moxiemanager"],
        //toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
        toolbar: 'undo redo | bold italic | hr | alignleft aligncenter alignright alignjustify | bullist numlist | link ',
        height: '200',
        theme: 'modern',
        skin: 'light',
        statusbar: false,
    });
      function emailTemplateValid()
    {
            //    var flag = $('#email_text_type').val();
            //   
            //    if (flag == 2) {
            //    //var tinyeditor=document.getElementById('body').value;
            //     var tinyeditor=$('textarea#body').val();
            //    alert(tinyeditor);
            //    }
            //    else if (flag == 1) {
            ////    var tinyeditor=document.getElementById('code_textarea').value;
            //     var tinyeditor=$('textarea#code_textarea').val();
            //
            //    alert(tinyeditor);
            //    }
            //  // var content = tinyMCE.activeEditor.getContent(); // get the content
            //   return false;
            //   // var content = tinymce.get('tinyeditor').getContent({format: 'text'});
            //    if($.trim(tinyeditor).search(/\S/)==-1)
            //    {
            //        $('#email-template-body-error').css("display", "block");
            //        return false;
            //    }
            //    else
            //    {
            //    $('#new_email_form_update').submit();   
            //    }
           $('#new_email_form_update').submit();   
    }
</script>
        {{ HTML::style('css/email_create.css') }}
    <style>
            #new_email_box {
                background-color: #fff;
                padding-top: 40px;
                padding-left: 15px;
                width: 1130px;
                margin-top: 15px;
                clear: both;
                background-image:url("/img/compose_mail_bg.png") ;
                background-repeat: repeat-x;
                margin-left: auto;
                margin-right: auto;
            }

            #email-template-name, #email-template-subject, #email-template-name-error, #email-template-subject-error {
                width: 1100px;
            }

            #email-template-text, #email-template-body-error {
                width: 1100px;
                margin-bottom: 0px;
            }
            
            #email-template-body-error {
                height: 233px;
            }
            
            #email_button_holder {
                padding-left: 15px;
                padding-right: 15px;
                width: 860px;
                margin-top: 15px;
                clear: both;
                background-repeat: no-repeat;
                width: 790px;
                margin-left: auto;
                margin-right: auto;
            }

            #new-email-template-cancel-btn {
                float: right;
            }

            button {
                font-family: "Lato", Arial,Helvetica,sans-serif;
            }
            
        </style>
@stop    
@section('content')
    <h1>Campaigns / New Campaign</h1>
    @include('common.progress_indicator')
        {{ Form::model($emailTemplate, ['route' => ['email-template.update', $emailTemplate->id], 'method' => 'PUT', 'id' => 'new_email_form_update' ]) }}

    <div id="new_email_box">
        <div class="create-control-buttons-container float-left"  id="email_button_holder" style="margin-bottom:10px;width:1105px;">
            <p>In writing your message, we recommend that you introduce yourself, your organisation and the opportunity. Try to keep it short. Please specify start date and location and give an indication of salary. It is also critical that you have a ‘call to action’. This could be anything from a request for a standard (or video) CV by email - remember to give an address - to an invitation to schedule an interview.</p>
            <p>Please make sure you sign off with whatever details you wish the candidate to see (full name, position, contact etc). Above all, imagine you are writing to just one person; given the name will be personalised, this approach will get you the best results.</p>
        </div>
        <!--<div id="template_name_box" class="text_input_container">
            <div class="error_overlay" @if(($errors->first('name'))){{'style="display: block;"'}}@endif id="email-template-name-error">Template name required</div>
            {{ Form::text('name', Input::old('name'), ['placeholder' => 'Template Name', 'id' => 'email-template-name']) }}
        </div>-->
        <div class="text_input_container">
            <div class="error_overlay" @if(($errors->first('subject'))){{'style="display: block;"'}}@endif id="email-template-subject-error">Email subject required</div>
            {{ Form::hidden('subject', $emailTemplate->subject, ['placeholder' => 'Email Subject', 'id' => 'email-template-subject']) }}
        </div>
        <div id="email_tab_container">
        		<div id="left_email_tab" class="<?php echo (($emailTemplate->email_text_type==2)?'email-type selected':'email-type unselected');?>" onclick="richText(this.id);">Rich Text</div>
                <div id="right_email_tab" class="<?php echo (($emailTemplate->email_text_type==1)?'email-type selected':'email-type unselected');?>" onclick="richText(this.id);">HTML</div>
                <input type="hidden" value="{{ $emailTemplate->email_text_type }}" name="email_text_type" id="email_text_type" />
        </div>
        <div id="email-template-text" class="text_input_container" style="<?php echo (($emailTemplate->email_text_type==2)?'display:block;':'display:none;');?>">
            <div class="error_overlay" @if(($errors->first('body'))){{'style="display: block;"'}}@endif id="email-template-body-error">Email body required</div>
            {{ Form::textarea('body', $emailTemplate->body, ['placeholder' => 'Email body', 'email-template-body' => 'body', 'class' => 'mceEditor','rows'=>'4', 'cols'=>'50']) }}
        </div>        
        
        <div id="email-template-text-rich" class="text_input_container" style="<?php echo (($emailTemplate->email_text_type==1)?'display:block;':'display:none;');?>">
            <div class="error_overlay" @if(($errors->first('body'))){{'style="display: block;"'}}@endif id="email-template-body-error">Email body required</div>
            {{ Form::textarea('body-rich', $emailTemplate->body, ['email-template-body' => 'body-html', 'id' =>'code_textarea']) }}
        </div>        
        <div class="clear"></div>              
    </div>
        @if( Input::has('returnTo') )
                {{Form::hidden('returnTo', Input::get('returnTo'))}}
        @endif
        
        <div class="button-holder">
                <div class="red_button campaing-back-step-btn" onclick="window.location='{{route('new-campaign.email')}}'">Back</div>
                <div class="red_button campaing-next-step-btn" onclick="emailTemplateValid();">Next</div>
                </div>
        
    </div>
{{ Form::close() }}
@stop
<script type="text/javascript">
        
        function richText(id)
        {
                if (id=='left_email_tab')
                {
                
                //alert(id);
                        //$("#right_email_tab").removeClass("email-type unselected").addClass("email-type selected");
                        //$("#left_email_tab").removeClass("email-type selected").addClass("email-type unselected");
                        document.getElementById("left_email_tab").setAttribute("class", "email-type selected");
                        document.getElementById("right_email_tab").setAttribute("class", "email-type unselected");
                        document.getElementById("email_text_type").value = 2;
                        //document.getElementById("email-template-text-rich").value = "";
                        document.getElementById("email-template-text-rich").style.display = "none";
                        document.getElementById("email-template-text").style.display = "block";
                }

                if (id=='right_email_tab')
                {
				
				//alert(id);
				        //$("#left_email_tab").removeClass("email-type unselected").addClass("email-type selected");
				        //$("#right_email_tab").removeClass("email-type selected").addClass("email-type unselected");
				        document.getElementById("right_email_tab").setAttribute("class", "email-type selected");
				        document.getElementById("left_email_tab").setAttribute("class", "email-type unselected");
				        document.getElementById("email_text_type").value = 1;
				        //document.getElementById("email-template-text").value = "";
				        document.getElementById("email-template-text").style.display = "none";
				        document.getElementById("email-template-text-rich").style.display = "block";
				
                }
        }

</script>