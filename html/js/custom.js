$(document).ready(function(){
  
  $(".registry-form").parent().parent().find("button").hide();
  
  $(".cc_overlay_lock").on('click', function(){
    $(".cc_cp_f_powered_by").text('');
  });

  $('.cc_dialog_text').text('El nostre lloc web fa servir cookies pròpies i de tercers pel seu funcionament, mantenir la sessió, obtenir estadístiques i personalitzar com es mostra el contingut. Pots acceptar totes les cookies clicant a “Estic d\'acord”  o configurar el seu ús, rebutjar-les i obtenir més informació clicant a "Canviar preferències"');
  		
  $('.cc_b_cp').on('click', function(){
	  $('.cc_cp_m_content_entry[content_layout="content_your_privacy"]').children().eq(1).text('Una "Cookie" és un petit arxiu que s’emmagatzema a l’ordinador de l’usuari i ens permet reconèixer-lo. El conjunt de "cookies" ens ajuda a millorar la qualitat del nostre web, permetent-nos controlar quines pàgines són útils per als nostres usuaris i quines no.');
	  $('.cc_cp_m_content_entry[content_layout="content_your_privacy"]').children().eq(2).text('Les cookies són essencials per al funcionament d’internet, aportant innumerables avantatges en la prestació de serveis interactius, facilitant-li la navegació i operativitat del nostre lloc web. Tingui en compte que les cookies no poden espatllar el seu equip i que, a canvi, el fet que estiguin activades ens ajuda a identificar i resoldre els errors.');
  });

  $('#addSchool').on('click', function(e){
  	e.preventDefault();
  	
	var newSchool = "\
		<div class='form-row'>\
		  <select name='select_school_new_"+ $(".select-school").length  +"' class='select-school'>\
		    <option selected disabled hidden>Selecciona l'escola</option>\
		    <option value='1'>Thau Barcelona</option>\
		    <option value='2'>Thau Sant Cugat</option>\
		    <option value='3'>Escola d'Idiomes</option>\
		    <option value='4'>Batxillerats</option>\
		    <option value='5'>Cicles Formatius</option>\
		    <option value='6'>Virtelia Escola de Música</option>\
		  </select>\
		  <div class=\"promo\"><input type=\"text\" placeholder=\"Promoció\" name=\"promo_" + $(".select-school").length +"\" class=\"promo\"><div class='rm-school'><i class='fas fa-times'></i></div>\</div>\
		</div>";
		
		var count = $(".select-school").length;

		if (count === 0){			
  			$("#schools").append(newSchool);
  			console.log("length 0");
		} else if (count < 2) {			
		 	$("#schools").append(newSchool);
		}

		$('.rm-school').on('click', function(){
			$(this).parent().parent().remove();
			var newSchools = $(".select-school");
			console.log(newSchools);
		  	$.each(newSchools, function(index, value){
		  		$(this).attr('name', 'select_school_new_' + index);
		 	});
		 	$.each($("input.promo"), function(index, value){
		  		$(this).attr('name', 'promo_' + index);
		 	});
		});
	});
	

	var newStudy = "\
		<div class='form-row'>\
		    <label for='estudis'>Estudis</label>\
		    <div class=\"studies\"><input type=\"text\" id=\"estudis\"><div class='rm-study'><i class='fas fa-times'></i></div>\</div>\
		</div>";
});







