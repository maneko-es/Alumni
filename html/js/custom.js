$(document).ready(function(){
  $(".cc_overlay_lock").on('click', function(){
    $(".cc_cp_f_powered_by").text('');
  });

  $('.cc_dialog_text').text('El nostre lloc web fa servir cookies pròpies i de tercers pel seu funcionament, mantenir la sessió, obtenir estadístiques i personalitzar com es mostra el contingut. Pots acceptar totes les cookies clicant a “Estic d\'acord”  o configurar el seu ús, rebutjar-les i obtenir més informació clicant a "Canviar preferències"');
  		
  $('.cc_b_cp').on('click', function(){
	  $('.cc_cp_m_content_entry[content_layout="content_your_privacy"]').children().eq(1).text('Una "Cookie" és un petit arxiu que s’emmagatzema a l’ordinador de l’usuari i ens permet reconèixer-lo. El conjunt de "cookies" ens ajuda a millorar la qualitat del nostre web, permetent-nos controlar quines pàgines són útils per als nostres usuaris i quines no.');
	  $('.cc_cp_m_content_entry[content_layout="content_your_privacy"]').children().eq(2).text('Les cookies són essencials per al funcionament d’internet, aportant innumerables avantatges en la prestació de serveis interactius, facilitant-li la navegació i operativitat del nostre lloc web. Tingui en compte que les cookies no poden espatllar el seu equip i que, a canvi, el fet que estiguin activades ens ajuda a identificar i resoldre els errors.');
  });

// var newStudy = "\
// 	<div class='form-row'>\
// 	    <label for='estudis'>Estudis</label>\
// 	    <div class=\"studies\"><input type=\"text\" id=\"estudis\"><div class='rm-study'><i class='fas fa-times'></i></div>\</div>\
// 	</div>";

// var newSchool = "\
// 	<div class='form-row'>\
// 	  <label class=\"school-label\" for='select-school'>Escola</label>\
// 	  <select name='select-school' id='select-school'>\
// 	    <option>Thau Barcelona</option>\
// 	    <option>Thau Sant Cugat</option>\
// 	    <option>Batxillerat</option>\
// 	    <option>Escola d'Idiomes</option>\
// 	    <option>Batxillerats</option>\
// 	    <option>Cicles Formatius</option>\
// 	    <option>Virtelia Escola de Música</option>\
// 	  </select>\
// 	  <label class=\"promo-label\" for='promo'>Any promoció</label>\
// 	  <div class=\"promo\"><input type=\"text\" id=\"promo\"><div class='rm-school'><i class='fas fa-times'></i></div>\</div>\
// 	</div>";

// // $('#addSchool').click(function(e){
// // 	alert('hola');
// //   e.preventDefault();
// //   $("#schools").append(newSchool);
// //   $('.rm-school').click(function(){
// //     $(this).parent().parent().remove();
// //   });
// // });

// $('#afegirEstudi').click(function(e){
//   e.preventDefault();
//   $("#estudis").append(newStudy);
//   $('.rm-study').click(function(){
//     $(this).parent().parent().remove();
//   });
// });





});
