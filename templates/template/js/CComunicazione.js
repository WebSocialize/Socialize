$(document).ready(function(){
  $("#recupera_password").click(function(){
    $("#dialog-recpassword").dialog({
        autoOpen: false,
        height: 300,
        width: 300,
        modal: true,
        draggable: false,
        show: {effect: 'blind', duration: 750},
        hide: 'fold',
        buttons:
           {
                    "Invia": function()
                    {
                        if ($("#form_recpassword").valid())
                        {
                         $.ajax({
                                    type: "POST",
                                    url: "index.php",
                                    data: $("#form_recpassword").serialize()+"&ajax=yes",
                                    dataType: "html",
                                    success: function(data)
                                            {
                                                alert("ok");
                                                $("#dialog-recpassword").dialog("close");
                                                $("#dialog-recpassword").find("input[type=text]").val("");
                                                   
                                            },
                              /*      error:function(data)
                                            {
                                                alert("non ok");
                                            },*/
                                })
                        };
                    },
                    "Annulla": function()
                    {
                        $(this).dialog("close");
                        $("#dialog-recpassword").find("input[type=text]").val("");
                    },
                },
    });
  
    $("#dialog-recpassword").dialog("open");
 });

$("#invioemail").click(function(){
    $("#dialog-invioemail").dialog({
        autoOpen: false,
        height: 600,
        width: 500,
        modal: true,
        draggable: false,
        show: {effect: 'blind', duration: 750},
        hide: 'fold',
        buttons:
           {
                    "Invia": function()
                    {
                       if ($("#form_invioemail").valid())
                       {
                         $.ajax({
                                    type: "POST",
                                    url: "index.php",
                                    data: $("#form_invioemail").serialize()+"&ajax=yes",
                                    dataType: "html",
                                    success: function(data)
                                            {
                                                $("#dialog-invioemail").dialog("close");
                                                $("#dialog-invioemail").find("input[type=text],textarea").val("");
                                                alert("EMAIL INVIATA CON SUCCESSO");
                                            },
                                        });
                         }
                    },
                    "Annulla": function()
                    {
                        $(this).dialog("close");
                        $("#dialog-invioemail").find("input[type=text],textarea").val("");
                    },
                },
    });
  
    $("#dialog-invioemail").dialog("open");
});

});

