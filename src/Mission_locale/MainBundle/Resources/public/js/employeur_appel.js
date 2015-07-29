$(function(){
    $("input:radio[name='form[entreprise]']").click(function() {
        if(($(this).val() == '1'))
        {
            $("#particulier label").text('Votre prénom');
        }
        else if(($(this).val() == '2')){
            $("#particulier label").text('Raison sociale');
        }
    });
});
