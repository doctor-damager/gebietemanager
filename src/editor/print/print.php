
<div class="container-fluid d-lg-none">
  <div class="row" >
    <h4>Die Karten werden nur auf PC richtig dargestellt!</h4>
</div>
</div>


<div class="container-fluid">
<div class="row" > <h5 class="small muted">In Chorme drucken und "Hintergrundgrafiken anzeigen" anwählen für eine korrekte Darstellung!</h5></div>
  <div class="row" >

<button onclick="printOtherPage()">Drucken</button></div>
  <div class="row">
<div class="embed-responsive embed-responsive-16by9 " >
<iframe id="frame" class="embed-responsive-item" allowfullscreen src="./src/editor/print/print_a4.php"></iframe>
</div></div>
</div>
<script type="text/javascript">
  function printOtherPage() {
  document.getElementById('frame').contentWindow.window.print();}
</script>