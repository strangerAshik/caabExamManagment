<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <title>Examiner | An Exam Management Excellence</title>
    <!--Pro-->    

    <!-- Bootstrap Core CSS -->
    <link href="{{asset('public/coreAsset/bower_components/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
  


    <!-- MetisMenu CSS -->
    <link href="{{asset('public/coreAsset/bower_components/metisMenu/dist/metisMenu.min.css')}}" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="{{asset('public/coreAsset/dist/css/timeline.css')}}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{asset('public/coreAsset/dist/css/sb-admin-2.css')}}" rel="stylesheet">


    <!-- Custom Fonts -->
    <link href="{{asset('public/coreAsset/bower_components/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">

    <!--Clock-->
        <link href="{{asset('public/clock/assets/css/style.css')}}" rel="stylesheet" />

        <!--[if lt IE 9]>
            <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

   
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        @include('core.component.navigation')
        @yield('navigation')

        <div id="page-wrapper"> 
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><!-- Dashboard --></h1>
            </div>
        <!-- /.col-lg-12 -->
        </div>
<!-- /.row -->  
<div >
    <span id="test"></span>
</div>
   @if (count($errors) > 0)
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif
     @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
     @endif        
            @yield('content')
            <div id="test"></div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="{{asset('public/coreAsset/bower_components/jquery/dist/jquery.min.js')}}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{asset('public/coreAsset/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="{{asset('public/coreAsset/bower_components/metisMenu/dist/metisMenu.min.js')}}"></script>

    <!-- Morris Charts JavaScript -->
    <script src="{{asset('public/coreAsset/bower_components/raphael/raphael-min.js')}}"></script>
    <script src="{{asset('public/coreAsset/bower_components/morrisjs/morris.min.js')}}"></script>
   

    <!-- Custom Theme JavaScript -->
    <script src="{{asset('public/coreAsset/dist/js/sb-admin-2.js')}}"></script>

    <!--Clock-->

    <!-- JavaScript Includes -->
        <?php  $elapsedTime=$elapsedTime; ?>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/moment.js/2.0.0/moment.min.js"></script>
        <script type="text/javascript">
            $(function() {

    // Cache some selectors

    var clock = $('#clock'),
        alarm = clock.find('.alarm'),
        ampm = clock.find('.ampm'),
        dialog = $('#alarm-dialog').parent(),
        alarm_set = $('#alarm-set'),
        alarm_clear = $('#alarm-clear'),
        time_is_up = $('#time-is-up').parent();
        time_is_not_set = $('#alarm-dialog').parent();

    // This will hold the number of seconds left
    // until the alarm should go off
    var alarm_counter =<?php echo $elapsedTime?>;//endTime-loadtime in second

    // Map digits to their names (this will be an array)
    var digit_to_name = 'zero one two three four five six seven eight nine'.split(' ');

    // This object will hold the digit elements
    var digits = {};

    // Positions for the hours, minutes, and seconds
    var positions = [
        'h1', 'h2', ':', 'm1', 'm2', ':', 's1', 's2'
    ];

    // Generate the digits with the needed markup,
    // and add them to the clock

    var digit_holder = clock.find('.digits');

    $.each(positions, function() {

        if (this == ':') {
            digit_holder.append('<div class="dots">');
        } else {

            var pos = $('<div>');

            for (var i = 1; i < 8; i++) {
                pos.append('<span class="d' + i + '">');
            }

            // Set the digits as key:value pairs in the digits object
            digits[this] = pos;

            // Add the digit elements to the page
            digit_holder.append(pos);
        }

    });

    // Add the weekday names

    var weekday_names = 'MON TUE WED THU FRI SAT SUN'.split(' '),
        weekday_holder = clock.find('.weekdays');

    $.each(weekday_names, function() {
        weekday_holder.append('<span>' + this + '</span>');
    });

    var weekdays = clock.find('.weekdays span');


    // Run a timer every second and update the clock

    (function update_time() {

        // Use moment.js to output the current time as a string
        // hh is for the hours in 12-hour format,
        // mm - minutes, ss-seconds (all with leading zeroes),
        // d is for day of week and A is for AM/PM

        var now = moment().format("hhmmssdA");

        digits.h1.attr('class', digit_to_name[now[0]]);
        digits.h2.attr('class', digit_to_name[now[1]]);
        digits.m1.attr('class', digit_to_name[now[2]]);
        digits.m2.attr('class', digit_to_name[now[3]]);
        digits.s1.attr('class', digit_to_name[now[4]]);
        digits.s2.attr('class', digit_to_name[now[5]]);

        // The library returns Sunday as the first day of the week.
        // Stupid, I know. Lets shift all the days one position down, 
        // and make Sunday last

        var dow = now[6];
        dow--;

        // Sunday!
        if (dow < 0) {
            // Make it last
            dow = 6;
        }

        // Mark the active day of the week
        weekdays.removeClass('active').eq(dow).addClass('active');

        // Set the am/pm text:
        ampm.text(now[7] + now[8]);
        //If Exam Is not Set Yet
         if(alarm_counter<0){

            time_is_up.fadeIn();

            // Play the alarm sound. This will fail
            // in browsers which don't support HTML5 audio

            try {
                $('#alarm-ring')[0].play();
            } catch (e) {}

            alarm_counter--;
            alarm.removeClass('active');

             // time_is_not_set.fadeIn();
         }
           
       

        // Is there an alarm set?

        if (alarm_counter > 0) {

            // Decrement the counter with one second
            alarm_counter--;

            // Activate the alarm icon
            alarm.addClass('active');
        } else if (alarm_counter == 0) {

            time_is_up.fadeIn();

            // Play the alarm sound. This will fail
            // in browsers which don't support HTML5 audio

            try {
                $('#alarm-ring')[0].play();
            } catch (e) {}

            alarm_counter--;
            alarm.removeClass('active');
        } else {
            // The alarm has been cleared
            alarm.removeClass('active');
        }

        // Schedule this function to be run again in 1 sec
        setTimeout(update_time, 1000);

    })();

  


    // Handle setting and clearing alamrs

    $('.alarm-button').click(function() {

        // Show the dialog
        dialog.trigger('show');

    });

    dialog.find('.close').click(function() {
        dialog.trigger('hide')
    });

    dialog.click(function(e) {

        // When the overlay is clicked, 
        // hide the dialog.

        if ($(e.target).is('.overlay')) {
            // This check is need to prevent
            // bubbled up events from hiding the dialog
            dialog.trigger('hide');
        }
    });


    alarm_set.click(function() {

        var valid = true,
            after = 0,
            to_seconds = [3600, 60, 1];

        dialog.find('input').each(function(i) {

            // Using the validity property in HTML5-enabled browsers:

            if (this.validity && !this.validity.valid) {

                // The input field contains something other than a digit,
                // or a number less than the min value

                valid = false;
                this.focus();

                return false;
            }

            after += to_seconds[i] * parseInt(parseInt(this.value));
        });

        if (!valid) {
            alert('Please enter a valid number!');
            return;
        }

        if (after < 1) {
            alert('Please choose a time in the future!');
            return;
        }

        alarm_counter = after;
        dialog.trigger('hide');
    });

    alarm_clear.click(function() {
        alarm_counter = -1;

        dialog.trigger('hide');
    });

    // Custom events to keep the code clean
    dialog.on('hide', function() {

        dialog.fadeOut();

    }).on('show', function() {

        // Calculate how much time is left for the alarm to go off.

        var hours = 0,
            minutes = 0,
            seconds = 0,
            tmp = 0;

        if (alarm_counter > 0) {

            // There is an alarm set, calculate the remaining time

            tmp = alarm_counter;

            hours = Math.floor(tmp / 3600);
            tmp = tmp % 3600;

            minutes = Math.floor(tmp / 60);
            tmp = tmp % 60;

            seconds = tmp;
        }

        // Update the input fields
        dialog.find('input').eq(0).val(hours).end().eq(1).val(minutes).end().eq(2).val(seconds);

        dialog.fadeIn();

    });

    time_is_up.click(function() {
        //time_is_up.fadeOut();
    });

});
        </script>
<script type="text/javascript">
    $.ajaxSetup({
       headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
    });
</script>

<script type="text/javascript">
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $(document).ready(function(){
                $('.optionsRadio').click(function(){
                    var questionId=$(this).attr("name");
                    var ans=$(this).val();
                    var examId= $("input[name~='exam_id']").val();
                   // alert(examId);
                    //alert(ans);
                    // $.post('saveAnswer',
                    //     {question_id:questionId,ans:ans,_token: CSRF_TOKEN},
                    //     function(data){
                    //     console.log(data);
                    // });
                   var dataString="question_id="+questionId+"&ans="+ans+"&exam_id="+examId;
                    $.ajax({
                            type: "POST",
                            url: "saveAnswer",
                            data: dataString,
                            success:function(data){
                                if(data=='0')
                                alert('You Are Not Allowed to Answer Now!! As You Submitted & Viewed The Result');
                                console.log(data);
                                if(data=='1')
                                $('#test').html('Answer Saved');
                            }
                    });
                });
            });
</script>
</body>

</html>
