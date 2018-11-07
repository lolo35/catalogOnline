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
function showNote(id, clasa){
  console.log(id);
  console.log(clasa);
  if($("#current-" + id).is(":visible")){
    $("#arrow-" + id).html("<i class='fas fa-chevron-down'></i>");
    $("#current-" + id).hide(700);
  }else{
    $("#arrow-" + id).html("<i class='fas fa-chevron-up'></i>");
    $("#current-" + id).show(700);
  }
}
function addGrade(userId,clasa){
  console.log(userId);
  console.log(clasa);
  $.ajax({
    method: "GET",
    url: "scripts/php/getNote.php?user_id=" + userId + "&clasa=" + clasa ,
    cache: false,
    success: function(noteData){
      $("#note-dialog").html(noteData);
      $("#note-dialog").dialog("open");
    }
  });
}
function insertGrade(userId,clasa){
  console.log(userId);
  console.log(clasa);
  var grade = $("#insert-grade-input").val();
  console.log(grade);
  $.ajax({
    method: "POST",
    url: "scripts/php/insertGrade.php",
    data: {
      ins: 1,
      user: userId,
      grade: grade,
      clasa: clasa
    },
    cache: false,
    success: function(insertData){
      //console.log(insertData);
      $("#current-" + userId + "-note").html(insertData);
    }
  });
}
function editGrades(user_id,clasa){
  console.log(user_id);
  console.log(clasa);
  $("#main-content-div").hide("fold", {direction: "up"}, "slow", function(){
    $("#main-content-div").html("");
    $.ajax({
      method: "GET",
      url: "scripts/php/editGrades.php?user=" + user_id + "&ora=" + clasa,
      cache: false,
      success: function(editGradesData){
        $("#main-content-div").html(editGradesData);
        $("#main-content-div").show("fold", {direction: "down"}, "slow", function(){

        });
      }
    });
  });
}
function deleteGrade(id){
  console.log(id);
  var conf = confirm("Doriti sa stergeti aceasta nota?");
  if(conf){
    $.ajax({
      method: "POST",
      url: "scripts/php/deleteGrade.php",
      data: {
        delete: "yes",
        id: id
      },
      cache: false,
      success: function(deleteData){
        if(deleteData === "success"){
          console.log("I'l do something here later");
          $("#" + id).remove();
        }
      }
    });
  }
}
function showNoteModal(id){
  $.ajax({
    method: "GET",
    url: "scripts/php/dataForNoteModal.php?id=" + id,
    cache: false,
    success: function(noteModalData){
      $("#note-modal-content").html(noteModalData);
    }
  });
  $("#modal-trigger-hidden-btn").click();
}
