$(document).ready(function(){
	$('.tx-t3o-snippets .tags a').click(function(){
		oldVal = $('#t3o-snippets-tags').val();
		if(!oldVal) {
			$('#t3o-snippets-tags').val($(this).text());
		} else {
			$('#t3o-snippets-tags').val(oldVal + ',' + $(this).text());
		}
	});
});