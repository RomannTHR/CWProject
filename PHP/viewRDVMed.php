<?php 
  session_start();
?>
<!DOCTYPE html>
<html lang='en'>
  
  <head>
    <meta charset='utf-8' />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="fullcalendar/main.min.css" />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/tempusdominus-bootstrap-4@5.39.0/build/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <style>
      a{
        color : black;
        text-decoration : none;
      }


    </style>
    <script>
      
      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          locale: 'fr',
          headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
          },
          events: [
            {
            }
            
          ],
          dayClick: function(info) {
            var newEvent = {
              title: 'Nouveau rendez-vous',
              start: info.dateStr,
              allDay: true
            };
            calendar.addEvent(newEvent);
          }
        });


        <?php 
          require_once("database.php");
          $email_med = $_SESSION['email'];
          $result = addRDVInCalendar($email_med);
          foreach ($result as $event) {
            $new_date = str_replace(" ","T",$event['heure_rdv']);
            $new_date_time = new DateTime($new_date);
            $datemodif = $new_date_time->modify('+1 hour');
            $end_date = $datemodif->format('Y-m-d\TH:i:s');
            echo "var specificDateEvent = {";
            echo "title: '".$event['nom']." ".$event['prenom']." - ".$event['specialite']."'  ,";
            echo "start: '$new_date',";
            echo "end: '$end_date'";
            echo "};";
            echo "calendar.addEvent(specificDateEvent);";
          }
        ?>


        
        

    

        



        

        calendar.render();
    });
    </script>



  </head>
  <body>
  <nav class="navbar" style="background-color: #7b9dfc;">
    <div class="container">
      <a class="navbar-brand mx-auto p-2" href="#">
        <img src="../Images/Allobobo.png" alt="Bootstrap" width="300" height="98">
      </a>
      <a href="identify.php">
        <img src="../Images/deco.png" alt="Bootstrap" width="100" height="98">
      </a>
      
    </div>
    </nav>
    <!-- Button trigger modal -->
    <button type="button" style="margin-top : 1vw; margin-left : 1vw;"class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
      Ajouter une disponibilité
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Gestion disponibilités</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <h3 style="text-align : center;">Jour</h3>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
            <section class="container">
                <form action="viewRDVMed.php" method="post">
                    <div class="row form-group">
                        <label for="date" class="col-sm-1 col-form-label">Date</label>
                        <div class="">
                            <div class="input-group date" id="datepicker">
                                <input type="text" class="form-control" name="date">
                                <span class="input-group-append">
                                    <span class="input-group-text bg-white">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <h3 style="text-align : center;">Heure</h3>
                    <div class="cs-form" id="horaires">
                      <label for="heure" class="col-sm-1 col-form-label">Heure</label>
                      <input type="time" class="form-control heure" value="10:05 AM" name="heures[]"/>
                    </div>
                    <br>
                    <button type="button" class="btn addHeure" style="width : 100%;">Ajouter une heure</button>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <input class="btn btn-primary" type="submit" value = "Ajouter" name="Add">
                  </div>
                </form>

                <?php 
      
                  require_once("database.php");
                  
                  $date = $_POST['date'];

                  $heures = $_POST['heures'];
                  
                  if(!empty($_POST['Add'])){
                    insertDispoByDay($_SESSION['email'],$date,$heures);
                  }
                
                ?>

            </section>

            <script type="text/javascript">
                $(function() {
                    $('#datepicker').datepicker();
                });
                document.querySelector('button.addHeure').addEventListener('click', function() {
                var newInput = document.createElement('div');
                newInput.className = 'cs-form';
                newInput.innerHTML = '<label for="heure" class="col-sm-1 col-form-label">Heure</label>' +
                                    '<input type="time" class="form-control heure" value="10:05 AM" name="heures[]"/>';

                document.getElementById('horaires').appendChild(newInput);
              });
            </script>
        </div>
      </div>
    </div>

    <br>
    <h1 style="text-align : center;"> Votre agenda </h1>
    <br>
    <div id='calendar' style="width : 80%; margin-left : 10vw; border : solid; padding: 0.5vw; border-width : 1px;"></div> 
  </body>

  


</html>
