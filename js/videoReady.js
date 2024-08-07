$( document ).ready(function() {
	let videoName="";
	let link1="";
	function deleteVideo(json1){
	$.ajax({
        type : "POST",
        url : "http://videosubtitle/videoReady.php",
		data : {"videoNameTemp":json1['tempName']},
        success: function (result) {
			alert(result);
        }
	});
	}
    $.ajax({
        type : "POST",
        url : "http://videosubtitle/videoReady.php",
        success: function (videoName) {
			videoNameJson=JSON.parse(videoName);
			link1="http://videosubtitle/uploads/subtitledVideos/"+videoNameJson['tempName']+'/'+videoNameJson['originalName'];
			html="<a style=\"text-decoration: none; color:white\" href='http://videosubtitle/uploads/subtitledVideos/"+videoNameJson['tempName']+'/'+videoNameJson['originalName']+'\' download=\'mySubtitledVideo\''+ "><button style='color: #ffffff; background-color: #2b2829;font-size: 14px;border-radius: 9px;padding: 20px 60px;cursor: pointer;position: relative;left: 36%;top: 120%;' type='button' id='i10k10' value='Download'/>Download</a>";
            $("#i9fa2y").html("Your subtitled video is ready! You may also delete the subtitled video to upload a new one.<br> Your download link expires in 1 hour.<br><a href='"+link1+"'>"+link1+"</a>");
			html2="<button style='color: #ffffff; background-color: #2b2829;font-size: 14px;border-radius: 9px;padding: 20px 60px;cursor: pointer;position: relative;left: 38%;top: 120%;' type='button' id='i11k11' value='Delete'/>Delete</button>";
			$("#i4jo41").html(html);
			$("#i4jo41").append(html2);
			$("#i11k11").click(function() {
				deleteVideo(videoNameJson);
			});
        }
    });

});