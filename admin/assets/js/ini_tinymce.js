tinymce.init({
	selector: '#myTextArea' ,
    plugins: 'image imagetools textcolor colorpicker textpattern table print preview link wordcount lists',
    toolbar1:'insertfole undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | image ',
    toolbar2:'print preview link | forecolor backcolor fontselect',
    indent_use_margin: true,
    height: '400',
    images_upload_url: config.routes.tiny_url,
    images_upload_handler: function(blobInfo, success, failure){
        var xhr, formData;
        var image_src = document.getElementById('image-src');

        xhr = new XMLHttpRequest();
        xhr.withCredentials = false;
        xhr.open('POST', config.routes.tiny_url);

        xhr.onload = function(){
            var json;

            if(xhr.status != 200){
                failure('HTTP Error:' + xhr.status);
                return;
            }
            json = JSON.parse(xhr.responseText);

            if(!json || typeof json.location != 'string'){
                failure('Invalid Json:' + xhr.responseText);
                return;
            }

            success(json.location);

            config.variables.image_src.push(json.location);

            image_src.value = config.variables.image_src;

        };

        formData = new FormData();
        formData.append('file', blobInfo.blob(), blobInfo.filename());

        xhr.send(formData);
    }
    
});