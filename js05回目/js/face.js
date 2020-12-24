function processImage() {
	// Replace <Subscription Key> with your valid subscription key.
	var subscriptionKey = "0ceed3809251496d92f0179b7aa36d97";

	var uriBase =
	"https://takuyatakamori.cognitiveservices.azure.com/face/v1.0/detect";

	// Request parameters.
	var params = {
		"returnFaceId": "true",
		"returnFaceLandmarks": "false",
		"returnFaceAttributes":
		"age,gender,headPose,smile,facialHair,glasses,emotion," +
		"hair,makeup,occlusion,accessories,blur,exposure,noise"
	};

	// Display the image.
	var type = 'image/jpeg';
	var dataurl = capture_image.toDataURL(type);
	var bin = atob(dataurl.split(',')[1]);
	var buffer = new Uint8Array(bin.length);
	for (var i = 0; i < bin.length; i++) {
		buffer[i] = bin.charCodeAt(i);
	}
	var blob = new Blob([buffer.buffer], { type: type });

	// Perform the REST API call.
	$.ajax({
		url: uriBase + "?" + $.param(params),

		// Request headers.
		beforeSend: function (xhrObj) {
			xhrObj.setRequestHeader("Content-Type", "application/octet-stream");
			xhrObj.setRequestHeader("Ocp-Apim-Subscription-Key", subscriptionKey);
		},

		processData: false,
		type: "POST",

		// Request body.
		data: blob,
	})

	.done(function (data) {
		// Show formatted JSON on webpage.
		// $("#responseTextArea").val(JSON.stringify(data, null, 2));
		console.log(data);
		const gender = data[0].faceAttributes.gender;
		const anger = data[0].faceAttributes.emotion.anger;
		const fear = data[0].faceAttributes.emotion.fear;
		const happiness = data[0].faceAttributes.emotion.happiness;
		const neutral = data[0].faceAttributes.emotion.neutral;
		const sadness = data[0].faceAttributes.emotion.sadness;
		const surprise = data[0].faceAttributes.emotion.surprise;
		if(gender=="male"){
			if((fear>0.4)){
				$("#kimetsu").append('<img src="img/zenitsu.jpg" alt="善逸" class="kimage">')
				$("#freeword").val("うなぎ");
			}else if(anger>0){
				$("#kimetsu").append('<img src="img/rengoku.jpg" alt="煉獄" class="kimage">')
				$("#freeword").val("ステーキ");
			}else if(happiness>0){
				$("#kimetsu").append('<img src="img/tanjirou.jpg" alt="炭治郎" class="kimage">')
				$("#freeword").val("焼き鳥");
			}else if(surprise>0){
				$("#kimetsu").append('<img src="img/giyu.jpg" alt="義勇" class="kimage">')
				$("#freeword").val("鍋");
			}else if(neutral>sadness){
				$("#kimetsu").append('<img src="img/muichirou.jpg" alt="無一郎" class="kimage">')
				$("#freeword").val("多国籍");
			}else{
				$("#kimetsu").append('<img src="img/inosuke.jpg" alt="伊之助" class="kimage">')
				$("#freeword").val("食べ放題");
			}
		}else{
			if((fear>0.4)){
				$("#kimetsu").append('<img src="img/tamayo.jpg" alt="珠世" class="kimage">')
			}else if(anger>0){
				$("#kimetsu").append('<img src="img/shinobu.jpg" alt="しのぶ" class="kimage">')
			}else if(happiness>0){
				$("#kimetsu").append('<img src="img/mitsuri.jpg" alt="蜜璃" class="kimage">')
			}else if(surprise>0){
				$("#kimetsu").append('<img src="img/nezuko.jpg" alt="禰󠄀豆子" class="kimage">')
			}else if(neutral>sadness){
				$("#kimetsu").append('<img src="img/kanawo.jpg" alt="カナヲ" class="kimage">')
			}else{
				$("#kimetsu").append('<img src="img/aoi.jpg" alt="アオイ" class="kimage">')
			}
		}
	})

	.fail(function (jqXHR, textStatus, errorThrown) {
		// Display error message.
		var errorString = (errorThrown === "") ?
		"Error. " : errorThrown + " (" + jqXHR.status + "): ";
		errorString += (jqXHR.responseText === "") ?
		"" : (jQuery.parseJSON(jqXHR.responseText).message) ?
				jQuery.parseJSON(jqXHR.responseText).message :
				jQuery.parseJSON(jqXHR.responseText).error.message;
		alert(errorString);
	});
};

