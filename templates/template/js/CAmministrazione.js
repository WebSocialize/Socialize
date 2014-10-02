$(document).ready(function(){
   $(".admin").click(function(){
    var id = "#" + $(this).attr("id");
    $("#dialog-delcommento"+id).dialog({
        autoOpen: false,
        height: 150,
        width: 220,
        modal: true,
        draggable: false,
        show: {effect: 'blind', duration: 750},
        hide: 'fold',
        buttons:
           {
                    "SI": function()
                    {
                       
                         $.ajax({
                                    type: "POST",
                                    url: "index.php",
                                    data: $("#form_delcommento"+id).serialize()+"&controller=amministrazione&task=del_commento&ajax=yes",
                                    dataType: "html",
                                    success: function(data)
                                            {
                                                $("#dialog-delcommento"+id).dialog("close");
                                                $("#composto").html("COMMENTO ELIMINATO CON SUCCESSO");
                                            },
                                        });
                                    },
                    "NO": function()
                    {
                        $(this).dialog("destroy");
                    },
                },
    });
  
    $("#dialog-delcommento"+id).dialog("open");
});

$("#del_evento").click(function(){    
    $("#dialog-delevento").dialog({
        autoOpen: false,
        height: 150,
        width: 220,
        modal: true,
        draggable: false,
        show: {effect: 'blind', duration: 750},
        hide: 'fold',
        buttons:
           {
                    "SI": function()
                    {
                       
                         $.ajax({
                                    type: "POST",
                                    url: "index.php",
                                    data: $("#form_delevento").serialize()+"&controller=amministrazione&task=del_evento&ajax=yes",
                                    dataType: "html",
                                    success: function(data)
                                            {
                                                $("#dialog-delevento").dialog("close");
                                                $("#composto").html("EVENTO ELIMINATO CON SUCCESSO");
                                            },
                                        });
                                    },
                    "NO": function()
                    {
                        $(this).dialog("destroy");
                    },
                },
    });
  
    $("#dialog-delevento").dialog("open");
});

$("#del_profilo").click(function(){
    $("#dialog-delprofilo").dialog({
        autoOpen: false,
        height: 150,
        width: 220,
        modal: true,
        draggable: false,
        show: {effect: 'blind', duration: 750},
        hide: 'fold',
        buttons:
           {
                    "SI": function()
                    {
                       
                         $.ajax({
                                    type: "POST",
                                    url: "index.php",
                                    data: $("#form_delprofilo").serialize()+"&controller=amministrazione&task=del_utente&ajax=yes",
                                    dataType: "html",
                                    success: function(data)
                                            {
                                                $("#dialog-delprofilo").dialog("close");
                                                $("#composto").html("UTENTE ELIMINATO CON SUCCESSO");
                                            },
                                        });
                                    },
                    "NO": function()
                    {
                        $(this).dialog("destroy");
                    },
                },
    });
  
    $("#dialog-delprofilo").dialog("open");
});

});

//CAmministrazione



//CAmministrazione

