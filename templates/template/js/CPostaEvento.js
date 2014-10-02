//dialog creazione di un evento
$(document).ready(function() {
    $("#dialog-evento").dialog({
        autoOpen: false,
        height: 495,
        width: 495,
        modal: true,
        draggable: false,
        show: {effect: 'blind', duration: 750},
        hide: 'fold',
        buttons:
                {
                    "Crea nuovo evento": function()
                    {
                        if ($("#form_evento").valid()){
                        $.ajaxFileUpload(
                                {
                                    url: 'index.php?controller=creazione&task=salva_immagine&ajax=yes',
                                    secureuri: false,
                                    fileElementId: 'fileToUpload',
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
                                            data: $("#form_evento").serialize() + '&' + h + "&ajax=yes",
                                            dataType: "html",
                                            success: function(data)
                                            {
                                                $("#dialog-evento").dialog("close");
                                                alert("Evento inserito con successo!");
                                                $("#dialog-evento").find("input[type=text],textarea").val("");
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
                        $("#dialog-evento").find("input[type=text],textarea").val("");
                    },
                },
    });


    $("#creaevento").click(function() {
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
                            opzione += '<option value="' + provincia + '">' + provincia + '</option>';
                            $("#crea_citt").html(opzione);
                        }
                    }
                }),
        $.ajax(
                {
                    url: "categorie.txt",
                    dataType: "text",
                    success: function(data)
                    {
                        var array = String(data).split("\n");
                        var categoria;
                        var opzione = "";
                        for (var i = 0; i < 10; i++)
                        {
                            categoria = array[i];
                            opzione += '<option value="' + categoria + '">' + categoria + '</option>';
                            $("#crea_categoria").html(opzione);
                        }
                    }
                }),
        $("#dialog-evento").dialog("open");
    });
});