$(document).on('click', '#connectAccount', function () {
    ajaxRequest('GET', '../PHP/request.php/getPage/', setIdenPage);
});


function setIdenPage(infos){

    if(infos == "signinClient"){
        setPage("identifyClient");
    }
    if(infos == "signinMed"){
        setPage("identifyMed");
    }

}


$(document).on('submit', '#signin', function (event) {
    event.preventDefault();

    ajaxRequest('GET', '../PHP/request.php/getPage/', sendToDB);



});


function sendToDB(infos){

    if(infos == "signinClient"){
        var nom = $(document).find('#nom').val();
        var prenom = $(document).find('#prenom').val();
        var numtel = $(document).find('#tel').val();
        var email = $(document).find('#email').val();
        var mdp = $(document).find('#mdp').val();

        ajaxRequest('POST','../PHP/request.php/signin/', isWellInsertClient,'nom='+ nom +'&prenom=' + prenom + '&numtel=' + numtel + '&email=' + email +'&mdp=' + mdp);

    }

    if(infos == "signinMed"){

        var nom = $(document).find('#nom_med').val();
        var prenom = $(document).find('#prenom_med').val();
        var codePos = $(document).find('#codepos_med').val();
        var numtel = $(document).find('#tel_med').val();
        var email = $(document).find('#email_med').val();
        var spe = $(document).find('#specialite_med').val();
        var mdp = $(document).find('#mdp_med').val();

        ajaxRequest('POST','../PHP/request.php/signinmed/', isWellInsert,'nom='+ nom +'&prenom=' + prenom + '&codePos=' + codePos+'&numtel=' + numtel + '&email=' + email+'&spe=' + spe+'&mdp=' + mdp);
    }

}


function isWellInsertMed(infos){
    
    if(infos == false){
        console.log("Vous vous êtes déjà enregistré avec cette adresse e-mail");
       

    }
    else{
        console.log("Enregistrement réussi");
        setPage("identifyMed");
    }

}

function isWellInsertClient(infos){


    
    if(infos == false){
        console.log("Vous vous êtes déjà enregistré avec cette adresse e-mail");
       

    }
    else{
        console.log("Enregistrement réussi");
        setPage("identifyClient");
    }

}



