$(document).ready(function(){

$("#num_visite").click(function(){
$("#dialog_partec").dialog({
        autoOpen: false,
        height: 495,
        width: 495,
        modal: true,
        draggable: false,
        show: {effect: 'blind', duration: 750},
        buttons:{
        "Annulla": function()
        {
        $(this).dialog("destroy");
        },
        },
    });
    $("#dialog_partec").dialog("open");
});

//CRicerca
//carica i profili degli utenti

  $('.profile').click(function(){
        var x = "#" + $(this).attr("id");
        var y = "#gotoprof" + $(this).attr("id");
        $.ajax({
            task: "POST",
            url: "index.php",
            data: $(y).serialize() + "&controller=ricerca&ajax=yes",
            success: function(data)
            {   
                $("#main_content").hide();
                $("#side_content").hide();
                $("#composto").html(data);
                closeDialogPartec();

            }
        });

});
    function closeDialogPartec(){
        $('#dialog_partec').dialog('close');
    }

});

