$(document).ready(function()
{
	$( "#datepicker" ).datepicker(
    {
      monthNamesShort: ["Gen", "Feb", "Mar", "Apr", "Mag", "Giu", "Lug", "Ago", "Set", "Ott", "Nov", "Dec"],
      changeMonth: true,
      changeYear: true,
      dateFormat:"dd-mm-yy",
      yearRange: "1900:thisYear",
      maxDate: "today",
      defaultDate:"01-01-2000",
    });

	$.validator.addMethod("name_regex", function(value, element) { 
		return this.optional(element) || /^[a-zA-Z\ ]+$/i.test(value); 
		}, "Sono presenti caratteri non validi!");

	$.validator.addMethod("surname_regex", function(value, element) { 
		return this.optional(element) || /^[a-zA-Z\xE0\xE8\xE9\xF9\xF2\xEC\x27\ ]+$/i.test(value); 
		}, "Sono presenti caratteri non validi!");

	$.validator.addMethod("nomexevento_regex", function(value, element) { 
		return this.optional(element) || /^[a-zA-Z0-9\xE0\xE8\xE9\xF9\xF2\xEC\ ]+$/i.test(value); 
		}, "Sono presenti caratteri non validi!");
	
	$.validator.addMethod("date_regex", function(value, element) { 
		return this.optional(element) || /^(?:(?:31(\/|-|\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\/|-|\.)(?:0?[1,3-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/|-|\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$/i.test(value); 
		}, "Sono presenti caratteri non validi!");

	$.validator.addMethod("alfanum", function(value, element) { 
		return this.optional(element) || /^[a-zA-Z0-9]+$/i.test(value); 
		}, "Sono presenti caratteri non validi!");

	 $("#form_invioemail").validate(
	{
        rules:{
		'oggetto':{
			required: true,
			alfanum:true,
			},
		'messaggio':{
			required: true,
			minlength:1,
			},
		},
        messages:{
		'oggetto':{
			required: "Il campo oggetto &egrave obbligatorio!",
			},
		'messaggio':{
			required: "Il campo messaggio &egrave obbligatorio!",
			minlength:"Messaggio troppo breve!",
			},
       }
	});
	 $("#form_evento").validate(
	{
        rules:{
		
		'nome':{
			required: true,
			minlength: 3,
			maxlength:18,
			nomexevento_regex:true,
			},
		'luogo':{
			required: true,
			minlength: 3
			},
        'data' :{
            required: true,
            date_regex:true,

            },
		'descrizione':{
			required: true,
			maxlength: 150
			},


		},
		
		
		
        messages:{
		'nome':{
			required: "Il campo nome &egrave obbligatorio!",
			minlength: "Scegli un nome di almeno 3 lettere!",
			maxlength: "Scegli un nome di massimo 18 lettere!",
			},
		'luogo':{
			required: "Il campo luogo &egrave obbligatorio!",
			minlength: "Scegli un luogo di almeno 3 lettere!"
			},
		'data':{
			required: "data richiesta",
		},
		'descrizione':{
			required: "Il campo descrizione &egrave obbligatorio!",
			maxlength: "Inserisci una descrizione di massimo 150 caratteri"
			},

		}
	});

	 $("#form_modprofilo").validate(
	{
        rules:{
		
		'data':{
			required: true,
			date_regex:true,

			},
		},
       messages:{
		'data':{
			required: "Il campo luogo &egrave obbligatorio!",
			
			},
		 },
		});


	$("#form_modevento").validate(
	{
        rules:{
		
		'luogo':{
			required: true,
			minlength: 3,
			},
         'data':{
         	required: true,
         	date_regex:true,
          },
		'descrizione':{
			required: true,
			maxlength: 150,
			},


		},
	   messages:{
		'luogo':{
			required: "Il campo luogo &egrave obbligatorio!",
			minlength: "Scegli un luogo di almeno 4 lettere!",
			},
		'data':{
			required:"data richiesta!",
		},
		'descrizione':{
			required: "Il campo descrizione &egrave obbligatorio!",
			maxlength: "Inserisci una descrizione di massimo 150 caratteri",
			},

		}
	});
	
	$('#ins_commento').validate(
	{
		rules:{
			'comment':{
				required:true,
				minlength:1,
				maxlength:500,
			},
		},
		messages:{
			'comment':{
				required:"",
				minlength:"",
				maxlength:"Massimo 500 caratteri!",
			},
		},
	});
	$('#form_modpassword').validate(
	{
		rules:{
			'old_password':{
				required:true,
				remote:{
					url:"index.php?task=verifica_old_pwd&ajax=yes",
					type:"post",
				}
			},
			'new_password':{
				required:true,
				minlength:8,
				alfanum:true,
			},
			'new_password_conf':{
				equalTo:'#new_pwd'
			},
		},
		messages:{
			'old_password':{
				required:'Devi inserire la tua vecchia password!',
				remote:'La tua password &egrave errata.'
			},
			'new_password':{
				required:'Devi inserire la tua nuova password!',
				minlength:'La tua password deve essere composta da almeno 8 caratteri!'
			},
			'new_password_conf':{
				equalTo:'Le due password non coincidono!'
			}
		}
	});
	$("#form_recpassword").validate(
	{
		rules:{
			'email':{
				required:true,
				email:true,
				remote:{
					url: "index.php?task=pwd_recuperabile&ajax=yes",
					type:"post",
				},
			},
		},
		messages:{
			'email':{
				required: "Devi inserire un indirizzo email.",
				email: "L'indirizzo non &egrave valido.",
				remote: "Nessun utente associato all'indirizzo email inserito.",
			},
		},
	});
	$("#form_register").validate(
	{
        rules:{
		'nome':{
			required: true,
			minlength: 3,
			name_regex:true
			},
			'cognome':{
			required: true,
			minlength: 3,
			surname_regex:true
			},
			'data':{
			 required:true,
			 date_regex:true,
			},
		    'email':{
			required: true,
			email: true,
			remote: {
				url:"index.php?task=account_disponibile&ajax=yes",
				type:"post",
			}
		},
		'pwd':{
			alfanum:true,
			required: true,
			minlength: 8
			},
		'conf_pwd':{
			equalTo: '#password'
			},
		},
        messages:{
		'nome':{
			required: "Il campo nome &egrave obbligatorio!",
			minlength: "Scegli un nome di almeno 4 lettere!",
			username_regex: "Hai utilizzato caratteri non validi. Sono consentiti solo lettere numeri!",
			},
		'cognome':{
			required: "Il campo cognome &egrave obbligatorio!",
			minlength: "Scegli un cognome di almeno 4 lettere!",
			username_regex: "Hai utilizzato caratteri non validi. Sono consentiti solo lettere numeri!",
			},
		'data':{
			required:"Data richiesta!",
		},
		'email':{
			required: "Il campo email &egrave obbligatorio!",
			email: "Inserisci un valido indirizzo email!",
			remote: "Email gi&agrave esistente! Esegui la procedura di smarrimento password!"
			},
		'pwd':{
			required: "Il campo password &egrave obbligatorio!",
			minlength: "Inserisci una password di almeno 8 caratteri!"
			},
		'conf_pwd':{
			equalTo: "Le due password non coincidono!"
			},
		},
		submitHandler: function(form) {
        $.ajax( {
            type:"POST",
            url:"index.php",
            data: $("#form_register").serialize()+"&ajax=yes",
            dataType: "html",
            success:function(data)
            {
            	$("#main_content").hide();
                $("#side_content").hide();
                $("#composto").html(data);      
            }
        } );

        return false;
        
    }
	});
     

     $("#form_login").validate(
	{
        rules:{
		'email':{
			required: true,
			email: true,
			remote:{
					url: "index.php?task=pwd_recuperabile&ajax=yes",
					type:"post",
				},
		},
		'password':{
			required: true,
			minlength: 8,
			alfanum:true,
			},
		},
        messages:{
		'email':{
			required: "",
			email: "",
			remote: "Email errata."
			},
		'password':{
			required: "",
			minlength: ""
			},
		},
    });

     $( "#datepicker_evento" ).datepicker(
    {
      monthNamesShort: ["Gen", "Feb", "Mar", "Apr", "Mag", "Giu", "Lug", "Ago", "Set", "Ott", "Nov", "Dec"],
      changeMonth: true,
      changeYear: true,
      dateFormat:"dd-mm-yy",
      yearRange: "1900:2020",
      minDate: "today",
    });




    

});