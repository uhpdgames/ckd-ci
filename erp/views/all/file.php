<?php
?>

<div id='fileStructure'>
	<div id="elfinder"> </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js">

</script>
ddddd
<script>
	$(function() {
	var elf = $('#elfinder').elfinder({
	  lang: 'en',             // language (OPTIONAL)
	url : 'http://localhost/ckd/File/elfinder_init'  // connector URL (REQUIRED)
	}).elfinder('instance');
	});
</script>
