$(document).ready(function() {
    
   //funzione che gestisce l'apertura e la chiusura delle tendine del menù
    var $menu = $('#ldd_menu');
    $menu.children('li').each(function() {
        var $this = $(this);
        var $span = $this.children('span');
        $span.data('width', $span.width());

        $this.on('mouseenter', function() {
            $menu.find('.ldd_submenu').stop(true, true).hide();
            $span.stop().animate({'width': '180px'}, 300, function() {
                $this.find('.ldd_submenu').slideDown(300);
            });
        }).on('mouseleave', function() {
            $this.find('.ldd_submenu').stop(true, true).hide();
            $span.stop().animate({'width': $span.data('width') + 'px'}, 300);
        });
    });




//funzione che permette la submit nella ricerca di eventi/persone e nel login tramite il tasto invio
    $(".enter").on("keypress", function(e)
    {
        if (e.which == 13)
        {
            var x = individuaForm($(this));

            $.ajax({
                type: "POST",
                url: "index.php",
                data: $(x).serialize() + "&ajax=yes",
                dataType: "html",
                success: function(data)
                {
                    $("#main_content").hide();
                    $("#side_content").hide();
                    $("#composto").html(data);
                },
            });
        }
    });

});



// funzione che apre/chiude le diverse sezioni in base ai click
function consultaSezione(id){
        var elem= "#" + id;
        var pieno=$('#ev'+id).attr('name');
        if (pieno!="")
        {
            $('.slider .opened').removeClass('opened').addClass('closed');
            $(elem).removeClass('closed').addClass('opened');
            $('.sliderimage').attr('src', $(elem).find('img').attr('src'));
        }
        return false;
};

function individuaForm(cont) {

    if (cont.attr("name") == "nomeevento")
        return "#cercaevento";
    if (cont.attr("name") == "nomepersona" || cont.attr("name") == "cognomepersona")
        return "#cercapersona";

}

//funzione che setta il puntatore standard x gli eventi mancanti dalla home page
$(document).ready(function(){
    var elem;
    var pieno;
    for (var i = 0; i < 3; i++) {
        elem= "#" + i;
        pieno=$('#ev'+i).attr('name');
        if (pieno=="")
            $(elem).css({'cursor':"default"});
    }
});