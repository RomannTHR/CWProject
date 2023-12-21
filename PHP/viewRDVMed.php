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

    <br>
    <h1 style="text-align : center;"> Votre agenda </h1>
    <br>
    <div id='calendar' style="width : 80%; margin-left : 10vw; border : solid; padding: 0.5vw; border-width : 1px;"></div> 





  </body>


</html>
