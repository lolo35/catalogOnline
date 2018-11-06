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
function prezenta(id,materia){
  console.log(id);
  console.log(materia);
  $("#main-content-div").hide("fold", {direction: "up"}, "slow", function(){
    $("#main-content-div").html("");
    $.ajax({
      method: "GET",
      url: "scripts/php/prezenta.php?nume=" + id + "&materia=" + materia ,
      cache: false,
      success: function(data){
        $("#main-content-div").html(data);
        $("#main-content-div").show("fold", {direction: "down"}, "slow", function(){

        });
      }
    });
  });
}
function markAsPresent(id, clasa,sqlId){
  console.log(id);
  console.log(clasa);
  console.log(sqlId);
  $.ajax({
    method: "POST",
    url: "scripts/php/pontare.php",
    data: {
      pontare: 1,
      nume: id,
      user_id: sqlId,
      clasa: clasa
    },
    cache: false,
    success: function(data){
      console.log(data);
      if(data === "success"){
        $("#" + sqlId +"-span").html("<i class='fas fa-check-circle' style='color: green; font-size: 1.4em;'></i>");
      }
    }
  });
}