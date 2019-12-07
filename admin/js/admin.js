$(document).ready(function(){
	if (window.File && window.FileReader && window.FileList && window.Blob){
		$("input[name*='thumbnail']").focusout(function(){
			var thumbnail 	= $("input[name*='thumbnail']")[0].files[0];
			if (thumbnail!=null) {
				$(this).parent().children("span.browser").css('background','green');
			}
		})
		$("input[name*='banner']").focusout(function(){
			var banner 		= $("input[name*='banner']")[0].files[0];
			if (banner!=null) {
				$(this).parent().children("span.browser").css('background','green');
			}
		})

		
	}else{
		alert('Nâng cấp trình duyệt, không thì đập máy đi !');
	}
		
});

// push-parts-films
$(document).ready(function(){
	$(document).on('click', '#push-part', function() {
		var file_data = $("input[name*='file_film']")[0].files[0];
		var film_id   = $("input[name*='film_id']").val();
		var name	  = $("input[name*='name_part']").val();
		// var player	  = $("input[name*='player']").val();
		var formData = new FormData();
			// formData.append('file', $("input[name*='file_film']")[0].files[0]);
			formData.append('file', $("input[name*='file_film']").prop('files')[0]);
			formData.append('film_id', $("input[name*='film_id']").val());
			formData.append('name', $("input[name*='name_part']").val());

        $.ajax({
                url: "push-parts.php",
                type: "post",
                dataType: "text",
                cache: false,
		       	processData: false,  // tell jQuery not to process the data
		       	contentType: false,  // tell jQuery not to set contentType
		       	async:true,
                data: formData,
                success: function (msg) {
                    alert(msg + 'hihi');
                },
                error: function(){
                	alert("sai !");
                }
            })
	});
})