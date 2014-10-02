$(document).ready(function(){
//function che invia il nuovo stato dell'utente e aggiorna subito il suo profilo e riaprendo la sezione relativa allo stato
$("#invia_stato").click(function(){
        $.ajax({
            type: "POST",
            url: "index.php",
            data: $("#cambia_stato").serialize()+"&ajax=yes",
            success:function(data){
                $("#composto").html(data);
                consultaSezione('red');
            }
        });
    });

//function che gestisce la dialog per la modifica della password
$("#mod_password").click(function(){
    $("#dialog-modpassword").dialog({
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
                        if ($("#form_modpassword").valid())
                        {                    
                         $.ajax({
                                    type: "POST",
                                    url: "index.php",
                                    data: $("#form_modpassword").serialize()+"&ajax=yes",
                                    dataType: "html",
                                    success: function(data)
                                            {                      
                                                alert('Hai modificato la password con successo!');
                                                $("#dialog-modpassword").find("input[type=password]").val("");
                                                $("#dialog-modpassword").dialog("close");
                                            },
                                        })
                        };
                    },
                    "Annulla": function()
                    {
                        $("#dialog-modpassword").find("input[type=password]").val("");
                        $(this).dialog("close");
                    },
                },
    });
  
    $("#dialog-modpassword").dialog("open");
});

//funzione che gestisce la dialog per la modifica del profilo
$("#mod_profilo").click(function(){
    $("#dialog-modprofilo").dialog({
        autoOpen: false,
        height: 400,
        width: 320,
        modal: true,
        draggable: false,
        show: {effect: 'blind', duration: 750},
        hide: 'fold',
        buttons:
                {
                    "Salva dati": function()
                    {
                        if($("#form_modprofilo").valid())
                        {    
                        $.ajaxFileUpload(
                                {
                                    url: 'index.php?task=salva_immagine&ajax=yes',
                                    secureuri: false,
                                    fileElementId: 'fileToUpload2',
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
                                            data: $("#form_modprofilo").serialize() + '&' + h + "&ajax=yes",
                                            dataType: "html",
                                            success: function(data)
                                            {
                                                $("#dialog-modprofilo").dialog("close");
                                                alert("Dati aggiornati con successo!");
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
                        $(this).dialog("close");
                    },
                },
    });
    $.ajax(
                {
                    url: "province.txt",
                    dataType: "text",
                    success: function(data)
                    {
                        var array = String(data).split("\n");
                        var provincia;
                        var opzione = "";
                        for (var i = 0; i < 110; i++)
                        {
                            provincia = array[i];
                            opzione += '<option value="'+provincia+'">' + provincia + '</option>';
                            $("#user_citta").html(opzione);
                        }
                    }
                }),
    $.ajax(
                {
                    url: "interessi.txt",
                    dataType: "text",
                    success: function(data)
                    {
                        var array = String(data).split("\n");
                        var interesse;
                        var opzione = "";
                        for (var i = 0; i < 11; i++)
                        {
                            interesse = array[i];
                            opzione += '<input type="checkbox" name="'+interesse+'"/>'+interesse;
                           // opzione += '<option value="' + interesse + '">' + interesse + '</option>';
                            $("#user_int").html(opzione);
                        }
                    }
                }),
    $("#dialog-modprofilo").dialog("open");
});

});


