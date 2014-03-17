<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/css/fullcalendar.css" />
<!--<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/css/fullcalendar.print.css" />-->
<script src="<?php echo Yii::app()->baseUrl; ?>/js/fullcalendar.min.js"></script>
<style>
    #calendar {
        width: 900px;
        margin: 0 auto;
    }


</style>

<div id='calendar'></div>

<script>
    $(document).ready(function() {
        $('#calendar').fullCalendar({
            buttonText: {
                today:    'hoje',
                month:    'mês',
                week:     'semana',
                day:      'dia'
            },
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
            monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
            dayNames: ['Domingo', 'Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sábado'],
            dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb'],
            editable: false,
            axisFormat: 'HH:mm',
            allDayText: 'Todo dia',
            //theme:true,
            events: [
                <?php
                    $i = 0;

                    if(count($marcacoes) > 0)
                    {
                        foreach($marcacoes as $marc1)
                        {
                            if(isset($marc1) && isset($marc1["data"]) && $marc1["id"])
                            {
                                $d = new DateTime($marc1["data"]);
                                echo "{";
                                echo "title:'".$marc1["fornecedor"]."',";
                                echo "id:'".$marc1["id"]."',";
                                echo "start: new Date(".$d->format('Y').", ".(intval($d->format('m'))-1).", ".$d->format('d').", ".$d->format('H').", ".$d->format('i')."),";
                                echo "color: '".$marc1["corloja"]."',";
                                echo "allDay: true";
                                echo "},";
                            }
                        }
                    }
                ?>
            ],
            timeFormat: {
                week: 'H:mm{ - H:mm}',
                day: 'H:mm{ - H:mm}',
                '': 'H(:mm)'
            },
            weekends: false,
            firstDay:1,
            dayClick: function(date, allDay, jsEvent, view) {
                $('#calendar').fullCalendar( 'gotoDate', date);
                $('#calendar').fullCalendar( 'changeView', 'agendaDay',{
                });
            },
            eventClick: function(calEvent, jsEvent, view) {
                $('#calendar').fullCalendar( 'gotoDate', calEvent.start);
                <?php
                if(isset($secure) && $secure == 1){?>
                showTask(calEvent.id);
                <?php }else{?>
                $('#calendar').fullCalendar( 'changeView', 'agendaDay' );
                <?php }?>
            }
        });
    });
</script>
<fieldset>
<legend>
    <?php
        foreach($lojas as $marc1)
        {
            echo "<div style=\"background-color: ".$marc1["corloja"]."; width:200px; margin:auto; font-size:13px;\">";
            echo $marc1["nome"];
            echo "</div>";
        }
    ?>
</legend>
</fieldset>
