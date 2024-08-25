$(document).ready(function() {
  // Make AJAX request to retrieve data from database
  $.ajax({
    url: "get_score.php",
    method: "GET",
    dataType: "json",
    success: function(data) {
      // Generate HTML for table using retrieved data
      var html = "";
      for (var i = 0; i < jsonData.length; i++) {
        var contestant = jsonData[i].contestant;
        var criteria = jsonData[i].criteria;
        var score = jsonData[i].score;
        var total = jsonData[i].total;
        var comments = jsonData[i].comments;
        html += "<tr>";
        if (i == 0) {
          html += "<td rowspan='" + jsonData.length + "'>" + contestant + "</td>";
        }
        html += "<td>" + criteria + "</td>";
        html += "<td>" + score + "</td>";
        html += "</tr>";
        if (comments.length > 0) {
          html += "<tr>";
          html += "<td colspan='3'>";
          html += "<table class='table text-white text-center'>";
          html += "<thead><tr><th>Criteria</th><th>Score</th><th>Comment</th></tr></thead>";
          html += "<tbody>";
          for (var j = 0; j < comments.length; j++) {
            var comment_criteria = comments[j].criteria;
            var comment_score = comments[j].score;
            var comment_comment = comments[j].comment;
            html += "<tr>";
            html += "<td>" + comment_criteria + "</td>";
            html += "<td>" + comment_score + "</td>";
            html += "<td>" + comment_comment + "</td>";
            html += "</tr>";
          }
          html += "</tbody>";
          html += "</table>";
          html += "</td>";
          html += "</tr>";
        }
      }
      // Insert generated HTML into table element
      $("#data-table tbody").html(html);
    },
    error: function() {
      // Handle error
    }
  });
});
