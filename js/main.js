$(window).ready(function() {
	
	$("#email-trap-btn").click(function(e) {
		var v = $("#email-trap-val").val();
		$.post("/save.php", { email: v} ).done(function(data) {
  			alert("Data Loaded: " + data); });
	});
});