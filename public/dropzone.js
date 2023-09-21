Dropzone.options.dropzoneUpload = {
  url: "/upload",
  paramName: "photo",
  maxFilesize: 20,
  acceptedFiles: "image/*",
  init: function() {
    this.on("success", function(file, response) {
      const jsonResponse = JSON.parse(response);
      if(jsonResponse.success) {
        document.getElementById("photoPathInput").value = jsonResponse.photo_path;
      } else {
        console.error(jsonResponse.error);
      }
    });
  }
};