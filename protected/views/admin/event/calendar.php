<?php

$this->menu=array(
	array('label'=>'Create Event','url'=>array('create')),
);
/*$this->widget('ext.EFullCalendar.EFullCalendar', array(
    // polish version available, uncomment to use it
    // 'lang'=>'pl',
    // you can create your own translation by copying locale/pl.php
    // and customizing it
 
    // remove to use without theme
    // this is relative path to:
    // themes/<path>
    'themeCssFile'=>'cupertino/theme.css',
 
    // raw html tags
    'htmlOptions'=>array(
        // you can scale it down as well, try 80%
        'style'=>'width:100%'
    ),
    // FullCalendar's options.
    // Documentation available at
    // http://arshaw.com/fullcalendar/docs/
    'options'=>array(
        'header'=>array(
            'left'=>'prev,next',
            'center'=>'title',
            'right'=>'today'
        ),
        'lazyFetching'=>true,
        'events'=>$calendarEventsUrl, // action URL for dynamic events, or
        'events'=>array(), // pass array of events directly
 
        // event handling
        // mouseover for example
        'eventMouseover'=>new CJavaScriptExpression("js_function_callback"),
    )
));*/
/*$this->widget('ext.EFullCalendar.EFullCalendar', array(
    'themeCssFile'=>'cupertino/jquery-ui.min.css',
    'options'=>array(
        'header'=>array(
            'left'=>'prev,next',
            'center'=>'title',
            'right'=>'today'
        )
    )));*/
$url_job_create = '/event/create/';
$this->widget('ext.EFullCalendar.EFullCalendar', array(
    'id' => 'diary',
    // polish version available, uncomment to use it
    // 'lang'=>'pl',
    // you can create your own translation by copying locale/pl.php
    // and customizing it
 
    // remove to use without theme
    // this is relative path to:
    // themes/<path>
    'themeCssFile'=>'cupertino/theme.css',
 
    // raw html tags
    'htmlOptions'=>array(
        // you can scale it down as well, try 80%
        'style'=>'width:100%'
    ),
    // FullCalendar's options.
    // Documentation available at
    // http://arshaw.com/fullcalendar/docs/
    'options'=>array(
        'header'=>array(
            'left'=>'prev,next',
            'center'=>'title',
            'right'=>'today,month,basicWeek'
        ),
        'firstDay' => 1,
        'weekNumbers' => true,
        'lazyFetching'=>true,
        'contentHeight' => 350,
        'events'=>CController::createUrl('event/CalendarEvents'),      
  // viewRender       
        'viewRender' => "js:function (view, element)
          {
            var job_create_url = '$url_job_create';
 
            console.log(view);
            console.log(element);
            
            $('#diary.fc-day-number').each(function() {            
              var dateYMD = $(this).parent().parent().data('date');
              var d = new Date(dateYMD);
              var tmpDay = pad(d.getDate(),2);
              var tmpMonth = pad(d.getMonth()+1,2);
              var tmpYear = d.getFullYear();
              var dateDMY = tmpDay + '/' + tmpMonth + '/' + tmpYear;

              var day = parseInt($(this).html());
              $(this).html('<a href=\"' + job_create_url  + dateDMY + '\"><img src=\"".Yii::app()->request->baseUrl."./img/icon-add-job_16x16.png\" alt=\"Add job\" /></a> ' + day);
            });            
          }",
    ),
  )
);

/* 
js:function (view, element)
          {
            var job_create_url = '$url_job_create';
 
            console.log(view);
            console.log(element);
            
            $('#diary.fc-day-number').each(function() {
            
              var dateYMD = $(this).parent().parent().data('date');
              var d = new Date(dateYMD);
              var tmpDay = pad(d.getDate(),2);
              var tmpMonth = pad(d.getMonth()+1,2);
              var tmpYear = d.getFullYear();
              var dateDMY = tmpDay + '/' + tmpMonth + '/' + tmpYear;

              var day = parseInt($(this).html());
              $(this).html('<a href=\"' + job_create_url  + dateDMY + '\"><img src=\"".Yii::app()->request->baseUrl."./img/icon-add-job_16x16.png\" alt=\"Add job\" /></a> ' + day);
            });
        }",
 */
?>
<Script>

    </script>