(function($){
  $(function(){
    $('select').formSelect();
    $('.sidenav').sidenav();
    $('.fixed-action-btn').floatingActionButton();
    $('.modal').modal();
    $('.tooltipped').tooltip();

    
  }); // end of document ready
})(jQuery); // end of jQuery name space

const cerrarModal=  (modal) =>{
  const elem = document.getElementById(modal);
  var instance = M.Modal.getInstance(elem);
  instance.close();
  document.body.style.overflow = "auto";
}

const ponerPaginacion = (tabla) => {
  $('#'+tabla).pageMe({
    pagerSelector:'#myPager',
    activeColor: 'purple',
    prevText:'Anterior',
    nextText:'Siguiente',
    showPrevNext:true,
    hidePageNumbers:false,
    perPage:20
  });
}