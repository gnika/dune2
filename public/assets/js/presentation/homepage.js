
$( ".sendemail" ).click(function() {

    var nameForm = $('#name').val();
    var emailForm = $('#email').val();
    var messageForm = $('#message').val();

    if( nameForm != '' && emailForm != '' && messageForm != ''){

        $.ajax({
            method: "POST",
            url: "sendemail",
            data: { name: nameForm, email: emailForm, message: messageForm }
        }).done(function(html ) {
            alert(html);
        });

        $('#name').val('');
        $('#email').val('');
        $('#message').val('');

    }else{
        alert('Veuillez remplir tous les champs du formulaire de contact');
    }

    return false;

});

$( ".charge" ).click(function() {
    $('.charge').hide();
    $('.load').attr('style', 'display: block');
});





