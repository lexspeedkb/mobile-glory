	<!-- Scripts -->
	<script>
	  var dialog = document.querySelector('dialog');
	  if (! dialog.showModal) {
	    dialogPolyfill.registerDialog(dialog);
	  }
	  $('body').on('click', '.show-dialog', function() {
	    dialog.showModal();
	  });
	  dialog.querySelector('.close').addEventListener('click', function() {
	    dialog.close();
	  });
	</script>
	<script src="/components/js/functions.js"></script>
	<script src="/templates/assets/js/main.js"></script>
</body>
</html>