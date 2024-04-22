window.onload = function(){
    // Fonction pour effectuer l'appel AJAX après que la page a été correctement modifiée
    function executeAjaxRequest() {
        ajaxRequest('GET', '../PHP/request.php/printCalendar/', displayRDVInCalendar);
    }

    // Vérifier si le formulaire a été soumis depuis identify.php
    const urlParams = new URLSearchParams(window.location.search);
    const formSubmitted = urlParams.get('formSubmitted');

    if (formSubmitted === 'true') {
        // Ajoutez ici votre code pour modifier la page index.html si nécessaire
        
        var contenuHTML = `   <!-- Button trigger modal -->
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
                </section>
            </div>
          </div>
        </div>
        <div id='calendar'></div>`;

        $('#container').html(contenuHTML);

        document.querySelector('button.addHeure').addEventListener('click', function() {
            var newInput = document.createElement('div');
            newInput.className = 'cs-form';
            newInput.innerHTML = '<label for="heure" class="col-sm-1 col-form-label">Heure</label>' +
                                '<input type="time" class="form-control heure" value="10:05 AM" name="heures[]"/>';

            document.getElementById('horaires').appendChild(newInput);
        });

        // Exécutez l'appel AJAX après que la page a été modifiée
        executeAjaxRequest();
    }
};
    // La fonction de rappel pour traiter les données renvoyées par la requête AJAX
    function displayRDVInCalendar(infos) {
        console.log(infos);
        // Votre logique de traitement des données ici...
    }


function displayRDVInCalendar(infos){
    console.log(infos);


}