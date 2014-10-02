$(document).ready(function(){

//dialog per la modifica dell'evento
$("#mod_evento").click(function(){
    $("#dialog-modevento").dialog({
        autoOpen: false,
        height: 450,
        width: 350,
        modal: true,
        draggable: false,
        show: {effect: 'blind', duration: 750},
        hide: 'fold',
        buttons:
                {
                    "Salva dati": function()
                    {
                        if($("#form_modevento").valid())
                        {
                        $.ajaxFileUpload(
                                {
                                    url: 'index.php?controller=modifica_evento&task=salva_immagine&ajax=yes',
                                    secureuri: false,
                                    fileElementId: 'fileToUpload3',
                                    dataType: 'json',
                                    data: {name: 'logan', id: 'id'},
                                    success: function(data, status)
                                    {
                                        var h = data.msg;
                                        if (typeof(data.error) != 'undefined')
                                        {
                                            if (data.error != '')
                                            {
                                                alert(data.error);
                                            } else
                                            {
                                                alert(data.msg);
                                            }
                                        }
                                        $.ajax({
                                            type: "POST",
                                            url: "index.php",
                                            data: $("#form_modevento").serialize() + '&' + h + "&ajax=yes",
                                            dataType: "html",
                                            success: function(data)
                                            {
                                                $("#dialog-modevento").dialog("close");
                                                alert("Dati aggiornati con successooo!");
                                                $("#composto").html(data);
                                            },
                                        });
                                    },
                                    error: function(data, status, e)
                                    {
                                        alert(e);
                                    }
                                }
                        );
                    }

                    },
                    "Annulla": function()
                    {
                        $(this).dialog("destroy");
                    },
                },
    });
  
    $("#dialog-modevento").dialog("open");
    
    });

//invio del commento tramite ajax che permette al profilo dell'evento di ricaricarsi subito indipendentemente dal resto della pagina
$("#commenta").click(function(){
    if ($("#ins_commento").valid())
    {
        $.ajax({
            type:"POST",
            url:"index.php",
            data:$("#ins_commento").serialize()+"&ajax=yes",
            success:function(data){
                $("#composto").html(data);
            }
        });
    }
});

//funzione che a clic del tasto "partecipa"/"non partecipare più" ricarica subito la pagina dell'evento e riapre la sezione relativa alle partecipazioni

$("#partecipazione").click(function(){
    $.ajax({
            type: "POST",
            url: "index.php",
            data: $("#ins_partecipazione").serialize()+"&ajax=yes",
            success:function(data){
                $("#composto").html(data);
                consultaSezione('orange');
            }
        });
});

});




