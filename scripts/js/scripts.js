$(document).ready(function(){

});
function leftMenu(id){
  console.log(id);
  var menuItem = id.substring(9);
  console.log(menuItem);
  if(menuItem === "Pagina Principala"){
    window.location.replace("index.php");
  }else if(menuItem === "Situatie corigente"){
    $("#" + id).addClass("active");
  }
  if(menuItem === "Grafic prezenta"){
    $.ajax({
      method: "GET",
      url: "scripts/php/chartsMain.php",
      cache: false,
      success: function(chartsData){
        $("#main-content-div").hide("fold", {direction: "up"}, "slow", function(){
          $("#main-content-div").html("");
          $("#main-content-div").html(chartsData);
          $("#main-content-div").show("fold", {direction: "down"}, "slow", function(){

          });
        });
      }
    });
  }
  if(menuItem === "Situatie absente"){
    $.ajax({
      method: "GET",
      url: "scripts/php/situatieAbsente.php",
      cache: false,
      success: function(situatieAbsenteData){
        var direction = randDirection();
        console.log(direction);
        $("#main-content-div").hide("fold", {direction: "left"}, "slow", function(){
          $("#main-content-div").html("");
          $("#main-content-div").html(situatieAbsenteData);
          $("#main-content-div").show("fold", {direction: "right"}, "slow", function(){

          });
        });
      },
      error: function(situatieAbsenteData){
        console.log(situatieAbsenteData);
      }
    });
  }
  if(menuItem === "Situatie corigente"){
    $.ajax({
      method: "GET",
      url: "scripts/php/situatieCorigente.php",
      cache: false,
      success: function(situatieCorigenteData){
        $("#main-content-div").hide("fold", {direction: "right"}, "slow", function(){
          $("#main-content-div").html("");
          $("#main-content-div").html(situatieCorigenteData);
          $("#main-content-div").show("fold", {direction: "left"}, "slow", function(){

          });
        });
      }
    });
  }
}
function randDirection(){
  var directionArray = ["up","down","right","left"];
  var randDirection = directionArray[(Math.random() * directionArray.length) | 0];
  //console.log(randDirection);
  return randDirection;
}
function makeActive(id){
  //$("a").removeClass("active");
  //$("#" + id).addClass("active");
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
          $("#tabel-note-container").hide("fold", {direction: "up"}, "slow", function(){
            $("#tabel-note-container").html(
              "<div class='list-group'>" +
                "<a href='#' class='list-group-item list-group-item-action left-menu' onclick='showNoteDetails(\" " + id + "\")'>" +
                  "<i class='fas fa-info-circle' style='color: white;'></i>" +
                    "<span style='color: white;'>" +
                    " Tabel Note" +
                  "</span>" +
                "</a>" +
              "</div>");
              $("#tabel-note-container").show("fold", {direction: "down"}, "slow", function(){

              });
          });
        });
      }
    });
  });
}
function showNoteDetails(materia){
  console.log(materia);
  $.ajax({
    method: "GET",
    url: "scripts/php/tabelnote.php?clasa=" + materia ,
    cache: false,
    success: function(tabelNoteDate){
      $("#main-content-div").hide("fold", {direction: "up"}, "slow", function(){
        $("#main-content-div").html("");
        $("#main-content-div").html(tabelNoteDate);
        $("#main-content-div").show("fold", {direction: "down"}, "slow", function(){

        });
      });
      //$("#tabel-note-dialog").html(tabelNoteDate);
    }
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
function markAsPrezentClick(id, clasa,sqlId){
  console.log(id);
  console.log(clasa);
  console.log(sqlId);
  $.ajax({
    method: "POST",
    url: "scripts/php/markAsPrezent.php",
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
        $("#" + id).attr("onclick", "markAsAbsent('"+ id +"', '" + clasa + "', '" + sqlId + "')");
      }
    }
  });
}
function markAsAbsent(id, clasa, sqlId){
  $.ajax({
    method: "POST",
    url: "scripts/php/markAsAbsent.php",
    data: {
      absent: "true",
      nume: id,
      user_id: sqlId,
      clasa: clasa
    },
    cache: false,
    success: function(absentData){
      if(absentData === "success"){
        $("#" + sqlId + "-span").html("<i class='fas fa-times-circle' style='color: red; font-size: 1.4em;'></i>");
        $("#" + id).attr("onclick", "markAsPrezentClick('"+ id +"', '" + clasa + "', '" + sqlId + "')");
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
function submitChangeGradeForm(){
  $("#change-grade-form").submit();
}
function changeGradeForm(e,id,userId,clasa){
  e.preventDefault();
  //console.log(userId);
  //console.log(clasa);
  var grade = $("#nota").val();
  var tipNota = $("#tip-nota").val();
  var comments = $("#comments").val();
  $.ajax({
    method: "POST",
    url: "scripts/php/submitChangeGrade.php",
    data: {
      changeGrade: "true",
      id: id,
      grade: grade,
      type: tipNota,
      comments: comments
    },
    cache: false,
    success: function (changeGradeData){
      $("#modal-alert-div").html(changeGradeData);
      /*$("#main-content-div").html("");
      $.ajax({
        method: "GET",
        url: "scripts/php/editGrades.php?user=" + userId + "&ora=" + clasa,
        cache: false,
        success: function(editGradesData){
          $("#main-content-div").html(editGradesData);
        }
      });*/
    }
  });
}
function refreshGradeTable(user, ora){
  $("#noteModal").on('hidden.bs.modal', function(e){
    $("#main-content-div").html("");
    $.ajax({
      method: "GET",
      url: "scripts/php/editGrades.php?user=" + user + "&ora=" + ora,
      cache: false,
      success: function(editGradesData){
        $("#main-content-div").html(editGradesData);
      }
    });
  });
}
