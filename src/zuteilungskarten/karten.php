<?php 
echo "willkommen bei ".ucfirst($current_file_name);
?><button onclick="printOtherPage()">Print</button>
<div class="embed-responsive embed-responsive-16by9">
<iframe id="frame" class="embed-responsive-item" allowfullscreen src="./src/zuteilungskarten/eintrag.php"></iframe>
</div>

<script type="text/javascript">
  function printOtherPage() {
  document.getElementById('frame').contentWindow.window.print();}
</script>