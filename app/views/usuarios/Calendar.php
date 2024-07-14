<?

    global $f;
    global $c;

    $ev = new MEvents_gestion;
    

    $type_ev = array("1" => "activo", "0" => "echo", "2" => "anulado", "3" => "retrasado");

    if ($_SESSION['auditar_actividades'] == "1") {
?>
        <div class="panel panel-default block1 m-t-30">
            <div class="panel-heading">Filtrar Actividades por:</div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-2">
                            <h4>Usuario</h4>
                        </div>
                        <div class="col-md-2">
                            <h4>Tipo de Actividad</h4>
                        </div>
                        <div class="col-md-2">
                            <h4>Mostrar</h4>
                        </div>
                        <div class="col-md-2">
                            <h4>Fecha de Consulta</h4>
                        </div>
                        <div class="col-md-4"></div>
                    </div>
                    <form action="/calendario/" method="POST">
                        <div class="row">
                            <div class="col-md-2">
                                <input type="hidden" value="<?= $_SERVER['REQUEST_URI'] ; ?>"  id="retorno" name="retorno">
                                <select name="usuario" id="usuario"  class="form-control">
                                    <option value="<?= $_SESSION['user_ai'] ?>">Seleccione un Usuario</option>
                                    <option value="<?= $_SESSION['user_ai'] ?>" <?= ($_POST['usuario'] == $_SESSION['user_ai'])?"selected='selected'":"" ?>>YO (<?= $_SESSION['nombre'] ?>)</option>
                                <?
                                    $q = $con->Query("Select * from usuarios where user_id != '".$_SESSION['usuario']."'");
                                    while ( $row = $con->FetchAssoc($q)) {
                                        $sel =  ($_POST['usuario'] == $row['a_i'])?"selected='selected'":"";
                                        echo '<option value="'.$row['a_i'].'" '.$sel.'>'.$row['p_nombre'].' '.$row['p_apellido'].'</option>';
                                    }
                                ?>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select name="type" id="type"  class="form-control">
                                    <option value="mias">Seleccione una Opción</option>
                                    <option value="todos" <?= ($_POST['type'] == 'todos')?"selected='selected'":"" ?>>Toda la Actividad Creada</option>
                                    <option value="otros" <?= ($_POST['type'] == 'otros')?"selected='selected'":"" ?>>Solo la Actividad Asignada a Otros Usuarios</option>
                                    <option value="mias" <?= ($_POST['type'] == 'mias')?"selected='selected'":"" ?>>Solo la Actividad Asignada a el Mismo</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select name="estado" id="estado"  class="form-control">
                                    <option value="asignados">Seleccione una Opción</option>
                                    <option value="Todos" <?= ($_POST['estado'] == 'Todos')?"selected='selected'":"" ?>>Toda la Actividad Creada</option>
                                    <option value="asignados" <?= ($_POST['estado'] == 'asignados')?"selected='selected'":"" ?>>Solo Eventos Asignados</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select name="fecha" id="fecha"  class="form-control">
                                    <option value="fecha">Seleccione una Fecha</option>
                                    <option value="fecha" <?= ($_POST['fecha'] == 'fecha')?"selected='selected'":"" ?>>Consultar Por Fecha del Evento</option>
                                    <option value="added" <?= ($_POST['fecha'] == 'added')?"selected='selected'":"" ?>>Consultar Por Fecha de Creación</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary" >Filtrar Gestión</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?

        if (isset($_POST['retorno'])) {
            $path = "";
            
            $emailu = $c->GetDataFromTable("usuarios", "a_i", $_POST['usuario'], "user_id", "");
            
            if ($_POST['type'] == "mias") {
                $path .= " grupo = '".$_POST['usuario']."' ";
            }elseif($_POST['type'] == "otros"){
                $path .= " user_id = '".$emailu."' ";
            }else{
                $path .= " (grupo = '".$_POST['usuario']."' or user_id = '".$emailu."') ";
            }
            
            if ($_POST['estado'] == "Todos") {
                $path .= "";
            }else{
                $path .= "and type_event = '1'";
            }
            
            $query = $ev->ListarEvents_gestion(" WHERE  $path ", "order by fecha desc, time desc");
        }else{
            $query = $ev->ListarEvents_gestion(" WHERE grupo = '".$_SESSION['user_ai']."' and type_event = '1' ", "order by fecha desc, time desc");
        }

    }else{
        $query = $ev->ListarEvents_gestion(" WHERE grupo = '".$_SESSION['user_ai']."' and type_event = '1' ", "order by fecha desc, time desc");
        $hidebtn = false;    
    }

?>




<div class="row m-t-30">
    <div class="col-md-12">
        <div class="white-box">
            <h3 class="m-b-30">Tablero de Actividades</h3>
            <div id="calendar"></div>
        </div>
    </div>
</div>
<!-- /.row -->
<!-- BEGIN MODAL -->
<div class="modal fade none-border" id="my-event">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><strong>Detalle del Evento</strong></h4>
            </div>
            <div class="modal-body"></div>
            <!--<div class="modal-footer">
                <button type="button" class="btn btn-white waves-effect" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success save-event waves-effect waves-light">Create event</button>
                <button type="button" class="btn btn-danger delete-event dn waves-effect waves-light" data-dismiss="modal">Delete</button>
            </div>-->
        </div>
    </div>
</div>


<link href="<?= HOMEDIR ?>/app/plugins/theme/plugins/bower_components/calendar/dist/fullcalendar.css" rel="stylesheet" />
<script src="<?= HOMEDIR ?>/app/plugins/theme/plugins/bower_components/calendar/jquery-ui.min.js"></script>
<script src="<?= HOMEDIR ?>/app/plugins/theme/plugins/bower_components/moment/moment.js"></script>
<script src='<?= HOMEDIR ?>/app/plugins/theme/plugins/bower_components/calendar/dist/fullcalendar.js'></script>
<script src="<?= HOMEDIR ?>/app/plugins/theme/plugins/bower_components/calendar/dist/jquery.fullcalendar.js"></script>
<script src="<?= HOMEDIR ?>/app/plugins/theme/plugins/bower_components/calendar/dist/lang-all.js"></script>
<script>
    !function($) {
    "use strict";

    var CalendarApp = function() {
        this.$body = $("body")
        this.$calendar = $('#calendar'),
        this.$event = ('#calendar-events div.calendar-events'),
        this.$categoryForm = $('#add-new-event form'),
        this.$extEvents = $('#calendar-events'),
        this.$modal = $('#my-event'),
        this.$saveCategoryBtn = $('.save-category'),
        this.$calendarObj = null
    };


    /* on drop 
        CalendarApp.prototype.onDrop = function (eventObj, date) { 
            var $this = this;
            // retrieve the dropped element's stored Event Object
            var originalEventObject = eventObj.data('eventObject');
            var $categoryClass = eventObj.attr('data-class');
            // we need to copy it, so that multiple events don't have a reference to the same object
            var copiedEventObject = $.extend({}, originalEventObject);
            // assign it the date that was reported
            copiedEventObject.start = date;

            if ($categoryClass)
                copiedEventObject['className'] = [$categoryClass];
            // render the event on the calendar
            $this.$calendar.fullCalendar('renderEvent', copiedEventObject, true);
            // is the "remove after drop" checkbox checked?
            if ($('#drop-remove').is(':checked')) {
                // if so, remove the element from the "Draggable Events" list
                eventObj.remove();
            }

        },
    */
    /* on click on event 
    */
        CalendarApp.prototype.onEventClick =  function (calEvent, jsEvent, view) {
            var $this = this;
            var form = $("<form></form>");

            var URL = '/events_gestion/getevento/'+calEvent.id+'/';
            $.ajax({
                type: 'POST',
                url: URL,
                success:function(msg){
                    form.append(msg);
                }
            });

//                form.append("<label>Change event name</label>");
//                form.append("<div class='input-group'><input class='form-control' type=text value='" + calEvent.id + "' /><span class='input-group-btn'><button type='submit' class='btn btn-success waves-effect waves-light'><i class='fa fa-check'></i> Actualizar evento</button></span></div>");
                $this.$modal.modal({
                    backdrop: 'static'
                });
                $this.$modal.find('.delete-event').show().end().find('.save-event').hide().end().find('.modal-body').empty().prepend(form).end().find('.delete-event').unbind('click').click(function () {
                    $this.$calendarObj.fullCalendar('removeEvents', function (ev) {
                        return (ev._id == calEvent._id);
                    });
                    $this.$modal.modal('hide');
                });
                $this.$modal.find('form').on('submit', function () {
                    calEvent.title = form.find("input[type=text]").val();
                    $this.$calendarObj.fullCalendar('updateEvent', calEvent);
                    $this.$modal.modal('hide');
                    return false;
                });
        },
    /* on select 
        CalendarApp.prototype.onSelect = function (start, end, allDay) {
            var $this = this;
                $this.$modal.modal({
                    backdrop: 'static'
                });
                var form = $("<form></form>");
                form.append("<div class='row'></div>");
                form.find(".row")
                    .append("<div class='col-md-6'><div class='form-group'><label class='control-label'>Event Name</label><input class='form-control' placeholder='Insert Event Name' type='text' name='title'/></div></div>")
                    .append("<div class='col-md-6'><div class='form-group'><label class='control-label'>Category</label><select class='form-control' name='category'></select></div></div>")
                    .find("select[name='category']")
                    .append("<option value='bg-danger'>Danger</option>")
                    .append("<option value='bg-success'>Success</option>")
                    .append("<option value='bg-purple'>Purple</option>")
                    .append("<option value='bg-primary'>Primary</option>")
                    .append("<option value='bg-pink'>Pink</option>")
                    .append("<option value='bg-info'>Info</option>")
                    .append("<option value='bg-warning'>Warning</option></div></div>");
                $this.$modal.find('.delete-event').hide().end().find('.save-event').show().end().find('.modal-body').empty().prepend(form).end().find('.save-event').unbind('click').click(function () {
                    form.submit();
                });
                $this.$modal.find('form').on('submit', function () {
                    var title = form.find("input[name='title']").val();
                    var beginning = form.find("input[name='beginning']").val();
                    var ending = form.find("input[name='ending']").val();
                    var categoryClass = form.find("select[name='category'] option:checked").val();
                    if (title !== null && title.length != 0) {
                        $this.$calendarObj.fullCalendar('renderEvent', {
                            title: title,
                            start:start,
                            end: end,
                            allDay: false,
                            className: categoryClass
                        }, true);  
                        $this.$modal.modal('hide');
                    }
                    else{
                        alert('You have to give a title to your event');
                    }
                    return false;
                    
                });
                $this.$calendarObj.fullCalendar('unselect');
        },
    CalendarApp.prototype.enableDrag = function() {
        //init events
        $(this.$event).each(function () {
            // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
            // it doesn't need to have a start or end
            var eventObject = {
                title: $.trim($(this).text()) // use the element's text as the event title
            };
            // store the Event Object in the DOM element so we can get to it later
            $(this).data('eventObject', eventObject);
            // make the event draggable using jQuery UI
            $(this).draggable({
                zIndex: 999,
                revert: true,      // will cause the event to go back to its
                revertDuration: 0  //  original position after the drag
            });
        });
    }
    */
    /* Initializing */
    CalendarApp.prototype.init = function() {
        //this.enableDrag();

        /*  Initialize the calendar  */
        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();
        var form = '';
        var today = new Date($.now());

        var defaultEvents =  [ 
        <?
    while($row = $con->FetchAssoc($query)){

        $l = new MEvents_gestion;
        $l->Createevents_gestion('id', $row[id]);
        $colorevent = "bg-info";

        if ($l->GetStatus() == "2") {
            $colorevent = "bg-success";
        }else{
            if ($l->GetType_event() == "1") {
                $colorevent = "bg-info";
            }else{
                $colorevent = "bg-warning";
            }
        }

        $fecha = $l -> GetFecha();

        if ($_POST['fecha'] == "added") {
            $fecha = $l->GetAdded();
        }

        echo "  {
                    id: ".$l -> GetId().",
                    title: '".html_entity_decode($l -> GetTitle())."',
                    start: '".$fecha." ".$l->GetTime()."', 
                    className: '".$colorevent."'
                },";
        //echo $l -> GetDescription(); 
    }
?>
 
          
            ];

        var $this = this;
        $this.$calendarObj = $this.$calendar.fullCalendar({
            lang: 'es',
            slotDuration: '00:15:00', /* If we want to split day time each 15minutes */
            minTime: '08:00:00',
            maxTime: '19:00:00',  
            defaultView: 'month',  
            handleWindowResize: true,   
             
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay,list'
            },
            events: defaultEvents,
            editable: false,
            droppable: false, // this allows things to be dropped onto the calendar !!!
            eventLimit: true, // allow "more" link when too many events
            selectable: true,
            drop: function(date) { $this.onDrop($(this), date); },
            select: function (start, end, allDay) { $this.onSelect(start, end, allDay); },
            eventClick: function(calEvent, jsEvent, view) { $this.onEventClick(calEvent, jsEvent, view); }

        });

        //on new event
        this.$saveCategoryBtn.on('click', function(){
            var categoryName = $this.$categoryForm.find("input[name='category-name']").val();
            var categoryColor = $this.$categoryForm.find("select[name='category-color']").val();
            if (categoryName !== null && categoryName.length != 0) {
                $this.$extEvents.append('<div class="calendar-events bg-' + categoryColor + '" data-class="bg-' + categoryColor + '" style="position: relative;"><i class="fa fa-move"></i>' + categoryName + '</div>')
                $this.enableDrag();
            }

        });
    },

   //init CalendarApp
    $.CalendarApp = new CalendarApp, $.CalendarApp.Constructor = CalendarApp
    
}(window.jQuery),

//initializing CalendarApp
function($) {
    "use strict";
    $.CalendarApp.init()
}(window.jQuery);

</script>
