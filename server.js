$("#upload").on("click", function (e) {
  e.preventDefault();
  $("#tbl").hide();
  var file = $("#file-upload").prop("files")[0];
  var form_data = new FormData();
  form_data.append("file", file);
  $.ajax({
    url: "upload.php",
    dataType: "json",
    cache: false,
    contentType: false,
    processData: false,
    data: form_data,
    type: "post",
    success: function (response) {
      console.log(response);
      if (response["status"] == 1) {
        let i=3
        $(".message").text(`file uploaded , wait ${i} second`);
        setTimeout(() => {
          $("#custom-form").css("display", "none");
          $("#tbl").css("display", "inline-table");
        }, 4000);

        setInterval(() => {
          $(".message").text(`file uploaded , wait ${i--} second`);
        },1000);
       
        delete response.status;

        $("table > tbody > tr > td:last-child").each(function (key, val) {
          val.append(Object.entries(response)[key][1]);
        });
      } else if(response["status"] == 2){
        $(".message").text("invalid file , please upload the 'csv' file");
      } else if (response["status"] == 0) {
        $(".message").text("sorry file is already exist");
      } else {
        $(".message").text("file not upload");
      }
    },
  });
});
