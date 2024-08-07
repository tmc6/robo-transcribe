$("#io559").change(function(){
var file = this.files[0];
var fileType = file["type"];
var validImageTypes = ["video/mp4"];
if ($.inArray(fileType, validImageTypes) < 0) {
     alert("Please select a video file");
	 $("#io559").val('');
	 
}
})