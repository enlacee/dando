<script type="text/javascript">
$(function(){
	$('#swfupload-control').swfupload({
		upload_url: "swfupload/upload-file.php",
		file_post_name: 'uploadfile',
		file_size_limit : "26214400",
		file_types : "*.jpg;*.png;*",//*.jpg;*.png;*.gif;*.rar;*.doc
		file_types_description : "Image files",
		file_upload_limit : 1,
		flash_url : "swfupload/js/swfupload/swfupload.swf",
		button_image_url : 'swfupload/js/swfupload/wdp_buttons_upload.png',
		button_width : 514,
		button_height : 50,
		button_placeholder : $('#button')[0],
		debug: false,
        file_dialog_start_handler:true
	})
		.bind('fileQueued', function(event, file){
			var listitem='<li id="'+file.id+'" >'+
				'<strong>Detalles: </strong><em>'+file.name+'</em> ('+Math.round(file.size/1024)+' KB) <span class="progressvalue" ></span>'+
				'<div class="progressbar" ><div class="progress" ></div></div>'+
				'<p class="status" >Pending</p>'+
				'<span class="cancel" >&nbsp;</span>'+
				'</li>';
			$('#log').append(listitem);
			$('li#'+file.id+' .cancel').bind('click', function(){
				var swfu = $.swfupload.getInstance('#swfupload-control');
				swfu.cancelUpload(file.id);
				$('li#'+file.id).slideUp('fast');
			});
			// start the upload since it's queued
			$(this).swfupload('startUpload');
		})
		.bind('fileQueueError', function(event, file, errorCode, message){
			alert('Size of the file '+file.name+' is greater than limit');
		})
		.bind('fileDialogComplete', function(event, numFilesSelected, numFilesQueued){
			$('#queuestatus').text('Archivos Seleccionados: '+numFilesSelected+' / En cola: '+numFilesQueued);
		})
		.bind('uploadStart', function(event, file){
			$('#log li#'+file.id).find('p.status').text('Subiendo... Espere por favor!!!');
			$('#log li#'+file.id).find('span.progressvalue').text('0%');
			$('#log li#'+file.id).find('span.cancel').hide();
		})
		.bind('uploadProgress', function(event, file, bytesLoaded){
			//Show Progress
			var percentage=Math.round((bytesLoaded/file.size)*100);
			$('#log li#'+file.id).find('div.progress').css('width', percentage+'%');
			$('#log li#'+file.id).find('span.progressvalue').text(percentage+'%');
		})
		.bind('uploadSuccess', function(event, file, serverData){
			
			if(serverData=="1"){
				alert("La imagen excede del tamaño permitido");
			}else{
				
				if(serverData=="2"){
         			alert("Error al subir imagen");
				}else{
					var item=$('#log li#'+file.id);
					item.find('div.progress').css('width', '100%');
					item.find('span.progressvalue').text('100%');
					var pathtofile='<a href="uploading/'+file.name+'" target="_blank" >view &raquo;</a>';
					
					$("#foto").val(serverData);
					$("#log").hide("slow");
					$("#modal").dialog('close'); 
					
					//Antes - item.addClass('success').find('p.status').html('Hecho!!! | '+pathtofile);
					item.addClass('success').find('p.status').html('Completado!!!');
					
				}
				
				
			}
			
			
		})
		.bind('uploadComplete', function(event, file){
			// upload has completed, try the next one in the queue
			$(this).swfupload('startUpload');
		})
	
});	
</script>
<script type="text/javascript">
	$(document).ready(function(){
		$("#modal").dialog({
		
			 autoOpen:false,
					modal:true,
					width:545,
					height:450,
					buttons:{
						Cerrar:function(){
						   $("#modal").dialog('close'); 
						}
					}
			
			});
	});
	
</script>


<!--Here-->
<div id="modal" title="Continue...">

<div id="swfupload-control" >
<p style="text-align:left !important;"><strong>Tama&ntilde;o m&aacute;ximo de la imagen:</strong> 1 MB</p>
	<input type="button" id="button" />
	<p id="queuestatus" ></p>
	<ol id="log"></ol>
    
<p style="text-align:left !important;"><br><strong>IMPORTANTE:</strong> No cierre esta ventana mientras se este subiendo el la imagen!!! Esta cerrara automaticamente una vez completada la operaci&oacute;n...</p>
    
</div>

</div>
<!--Here-->