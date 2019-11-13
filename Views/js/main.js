/*
    Autor: Omega
    Fecha de creación: 01/10/2018
    
    El fichero main.js contiene las funciones jQuery requeridas para conseguir que el menú sea desplegable al hacer click de EntregaET1.html
*/

/*Funcion para que se abra y cierre el menu al pulsar*/
$(document).ready(function(){
    $('.menu li:has(ul)').click(function (e){
        e.preventDefault();
        
        if($(this).hasClass('activado')){
            $(this).removeClass('activado');
            $(this).children('ul').slideUp();
            
        }else{
            $('.menu li ul').slideUp();
            $('.menu li').removeClass('activado');
            $(this).addClass('activado');
            $(this).children('ul').slideDown();
        }
    });  
});

/*Funcion para que redirija al cambio de idioma al pulsar en un idioma en el menu correspondiente*/
$(document).ready(function(){

  $('.select_idioma .submenuI li').click(function (e){
        e.preventDefault();
        
        var $id = $(this).attr('id');
        window.location.href  = '../Functions/CambioIdioma.php?idioma='+$id;  
  });
});

/*Funcion para que redirija a la pagina correspondiente a la accion del menu principal*/
$(document).ready(function(){

  $(' .submenu li').click(function (e){
        e.preventDefault();
        
        var $id = $(this).attr('id');
        window.location.href  = '../Controllers/LOTERIAIU_Controller.php?action='+$id;  
  });
});