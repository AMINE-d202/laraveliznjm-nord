var sideNav = document.querySelector('.sidenav');
M.Sidenav.init(sideNav);

var modal = document.querySelector('.modal');
M.Modal.init(modal);

$(document).ready(function(){
    $('select').formSelect();
    $('.datepicker').datepicker();
    $(".dropdown-trigger").dropdown();
    $('.collapsible').collapsible();
  });
if(document.getElementById('address')){
  M.textareaAutoResize($('#address'));
}