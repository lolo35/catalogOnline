$(document).ready(function(){

});
function displayOre(id){
  $("a").removeClass("active");
  $("#" + id).addClass("active");
  $.ajax({
    method: "GET",
    url: "scripts/php/ore.php",
    cache: false,
    success: function(oreData){
      $("#main-content-div").hide("drop", {direction: "right"}, "slow", function(){
        $("#main-content-div").html("");
        $("#main-content-div").html(oreData);
        $("#main-content-div").show("drop", {direction: "left"}, "slow", function(){

        });
      });
    }
  });
}
function deleteMaterie(id){
  var answer = confirm("Sunteti sigur ca vreti sa stergeti materia?");
  if(answer){
    $.ajax({
      method: "POST",
      url: "scripts/php/deleteMaterie.php",
      data: {
        delete: "true",
        row: id
      },
      cache: false,
      success: function(deleteData){

          $("#row-" + id).remove();
          $("#ore-alert").hide("drop", {direction: "left"}, "slow", function(){
            $("#ore-alert").html("");
            $("#ore-alert").html(deleteData);
            $("#ore-alert").show("drop", {direction: "right"}, "slow", function(){

            });
          });
          console.log("it's deleted");
        }

    });
  }
}
function editMaterie(id){
  console.log(id);
  $("#materie-edit-modal-btn").click();
  $.ajax({
    method: "GET",
    url: "scripts/php/materieEdit-modalContent.php?id=" + id ,
    cache: false,
    success: function(materieEditData){
      $("#edit-materie-modal-body").html(materieEditData);
    }
  });
}
