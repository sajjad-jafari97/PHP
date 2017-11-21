if ($){
console.log('jQuery est dispo');
}

$(document).ready(function(){
  // dom chargé

var btnHideForm = $("#btnHideForm");
var isFormVisible = true;


btnHideForm.click(function(){

  $(this).next('form').toggle();
  isFormVisible = !isFormVisible;
  (isFormVisible)
  ? $(this).html('Masquer le formulair')
  : $(this).html('Afficher le formulair');
});

});
