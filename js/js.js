var modali = document.getElementById("modali");

var gets = (function() 
{
    var a = window.location.search;
    var b = new Object();
    a = a.substring(1).split("&");
    for (var i = 0; i < a.length; i++) 
    {
    c = a[i].split("=");
        b[c[0]] = c[1];
    }
    return b;
})();

function sortirovka(sort, varik, page) 
{
  $.ajax({
  async: false,
  type: "POST",
  url:"/views/index.show.php",
  data: {sort: sort, varik:varik, page: page},
  dataType: "text",
  error :function(){
    alert("Извините произошла ошибка"); 
  },
  success: function(response)
  { 
  $('#index_show').html(response) 
  }
      });
}

function index_show(page) 
{
  $.ajax({
  async: false,
  type: "POST",
  url:"/views/index.show.php",
  data: {page: page },
  dataType: "text",
  error :function(){
    alert("Извините произошла ошибка"); 
  },
  success: function(response)
  { 
    $('#index_show').html(response)
  }
  });
}

function showbtn() 
{
  $.ajax({
  async: false,
  type: "POST",
  url:"/obrabotchik/avtoriz_button.php",
  dataType: "text",
  error :function(){
    alert("Извините произошла ошибка"); 
  },
  success: function(response)
  {  
    $('#showbtn').html(response)
  }
        });
}


function myBtnavtoriz() 
{
   modali.style.display = "block";
  $.ajax({
  async: false,
  type: "POST",
  url:"/obrabotchik/obrabotchik_form.php",
  data: {action: "tru" },
  dataType: "text",
  error :function(){
    alert("Извините произошла ошибка"); 
  },
  success: function(response)
  {  
    $('#modali').html(response)
    showbtn();
  }
});
}


function myBtnExit() {
  $.ajax({
  async: false,
  type: "POST",
  url:"/obrabotchik/obrabotchik_form.php",
  data: {action: "exit" },
  dataType: "text",
  error :function(){
    alert("Извините произошла ошибка"); 
  },
  success: function(response){  
    showbtn();
    index_show(gets['page']);
  }
});
}


function Edit_Tasks(id) {
   modali.style.display = "block";
  $.ajax({
  async: false,
  type: "POST",
  url:"/obrabotchik/obrabotchik_form.php",
  data: {action_edit: "Edit_Tasks", id: id},
  dataType: "text",
  error :function(){
    alert("Извините произошла ошибка"); 
  },
  success: function(response){  
    $('#modali').html(response)
  }
});
}

$(document).on('submit', '#saveAdmin', function(e) {
    $.ajax({
        url: $(this).attr('action'),
        type: $(this).attr('method'),
        data: $(this).serialize(),
        success: function(response) {
          $('#modali').html(response)
           index_show(gets['page']);
           showbtn();
         }
    });
    e.preventDefault();
});


$(document).on('submit', '#authorization', function(e) {
    $.ajax({
        url: $(this).attr('action'),
        type: $(this).attr('method'),
        data: $(this).serialize(),
        success: function(response) {
          $('#modali').html(response)
          showbtn();
          index_show(gets['page']);
         }
    });
    e.preventDefault();
});


$(document).on('submit', '#addTask', function(e) {
    $.ajax({
        url: $(this).attr('action'),
        type: $(this).attr('method'),
        data: $(this).serialize(),
        success: function(response) {
           $('#modali').html(response)
            modali.style.display = "block";         
         }
    }).done(function() {
            $(this).find('input').val('');
            $("#addTask").trigger('reset'); 
            index_show(gets['page']);
        })
    e.preventDefault();
});


window.onclick = function(){
if (event.target == modali) {
modali.style.display = "none";
}
}  