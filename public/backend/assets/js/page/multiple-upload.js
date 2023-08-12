"use strict";

// DropzoneJS
if (window.Dropzone) {
  Dropzone.autoDiscover = false;
}

var dropzone = new Dropzone("div#mydropzone", {
  url: "#",
  maxFiles: 20,
  addRemoveLinks: true,
  acceptedFiles: ".jpeg, .png, .jpg, .gif", // Allowed file extensions
  maxFilesize: 2, // Max file size in MB
});

var minSteps = 6,
  maxSteps = 60,
  timeBetweenSteps = 100,
  bytesPerStep = 100000;

  dropzone.uploadFiles = function (files) {
    var self = this;

    for (var i = 0; i < files.length; i++) {

      var file = files[i];
      var totalSteps = Math.round(Math.min(maxSteps, Math.max(minSteps, file.size / bytesPerStep))); // Declare totalSteps using var or let

      for (var step = 0; step < totalSteps; step++) {
        var duration = timeBetweenSteps * (step + 1);
        setTimeout(function (file, totalSteps, step) {
          return function () {
            file.upload = {
              progress: 100 * (step + 1) / totalSteps,
              total: file.size,
              bytesSent: (step + 1) * file.size / totalSteps
            };

            self.emit('uploadprogress', file, file.upload.progress, file.upload.bytesSent);
            if (file.upload.progress == 100) {
              file.status = Dropzone.SUCCESS;
              self.emit("success", file, 'success', null);
              self.emit("complete", file);
              self.processQueue();
              // this.set('images', file);
              console.log(file);
              Livewire.emit('addImage', file);
              // window.livewire.emit('addImage', file);
            }
          };
        }(file, totalSteps, step), duration);
      }

    }
  }

  // Custom function to handle file validation
  dropzone.on("addedfile", function (file) {
    if (!validateFile(file)) {
      this.removeFile(file); // Remove the file from Dropzone if it's not valid
    }
  });

  // Custom function to validate the file
  function validateFile(file) {
    var fileExtension = file.name.split(".").pop().toLowerCase();
    var allowedExtensions = ["jpeg", "png", "jpg", "gif"];
    var maxFileSize = 2; // Max file size in MB

    // Check if the file extension is allowed
    if (!allowedExtensions.includes(fileExtension)) {
      alert("Invalid file type. Only JPEG, PNG, JPG, and GIF files are allowed.\nFiles with unsupported formats will be removed!");
      return false;
    }

    // Check if the file size is within the allowed limit
    if (file.size > maxFileSize * 1024 * 1024) {
      alert("File size exceeds the allowed limit of 2MB.\nFiles that  exceeds the allowed limit will be removed!");
      return false;
    }

    return true; // File is valid
  }

  // dropzone.on("complete", function(file) {
  //   dropzone.removeFile(file);
  // });


// dropzone.uploadFiles = function (files) {
//   var self = this;

//   for (var i = 0; i < files.length; i++) {

//     var file = files[i];
//     totalSteps = Math.round(Math.min(maxSteps, Math.max(minSteps, file.size / bytesPerStep)));

//     for (var step = 0; step < totalSteps; step++) {
//       var duration = timeBetweenSteps * (step + 1);
//       setTimeout(function (file, totalSteps, step) {
//         return function () {
//           file.upload = {
//             progress: 100 * (step + 1) / totalSteps,
//             total: file.size,
//             bytesSent: (step + 1) * file.size / totalSteps
//           };

//           self.emit('uploadprogress', file, file.upload.progress, file.upload.bytesSent);
//           if (file.upload.progress == 100) {
//             file.status = Dropzone.SUCCESS;
//             self.emit("success", file, 'success', null);
//             self.emit("complete", file);
//             self.processQueue();
//             // this.set('images', contents);
//             console.log(file);
//           }
//         };
//       }(file, totalSteps, step), duration);
//     }
//   }
// }