$(function(){
    $("input:radio[name='type']").click(function() {
        if(($(this).val() == 'particulier'))
        {
            $("#particulier").fadeIn();
            $("#entreprise").hide()
        }
        else if(($(this).val() == 'entreprise')){
            $("#entreprise").fadeIn();
            $("#particulier").hide();
        }
    });
});
