$(document).ready(function(){

});
function makeActive(id){
  $("a").removeClass("active");
  $("#" + id).addClass("active");
  $.ajax({
    method: "GET",
    url: "scripts/php/clase.php?clasa=" + id,
    cache: false,
    success: function(data){
      $("#main-content-div").hide("drop", {direction: "left"}, "slow", function(){
        $("#main-content-div").html(data);
        $("#main-content-div").show("drop", {direction: "right"}, "slow", function(){

        });
      });
    }
  });
}
function selectClasa(id){
  console.log(id);
  $("#main-content-div").hide("drop", {direction: "left"}, "slow", function(){
    $("#main-content-div").html("");
    $.ajax({
      method: "GET",
      url: "scripts/php/selectClasa.php?id=" + id,
      cache: false,
      success: function(data){
        $("#main-content-div").html(data);
        $("#main-content-div").show("drop", {direction: "right"}, "slow", function(){

        });
      }
    });
  });
}
