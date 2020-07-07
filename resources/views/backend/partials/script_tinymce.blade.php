<script src="{{ asset('public/js/tinymce/tiny_old.min.js') }}"></script>
<script>
	tinymce.init({

		selector:'#description',
        theme: 'modern',
        plugins: [
          'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
          'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
          'save table contextmenu directionality emoticons template paste textcolor'
        ],
        toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print media fullpage | forecolor backcolor | code preview',
		image_advtab: true,
        skin: 'lightgray',
        relative_urls : false,
        document_base_url : "{{ URL::to('') }}",
		setup: function(editor){
			editor.on('change', function () {
				editor.save();
			});
		}
	});
</script>