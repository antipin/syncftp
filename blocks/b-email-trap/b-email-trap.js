$(function() {

    var $block = $(".b-email-trap"),
        $slide1 = $(".b-email-trap__slide_type_form", $block),
        $slide2 = $(".b-email-trap__slide_type_success", $block),
        $submitBtn = $(".b-email-trap__input_type_submit", $block),
        $emailField = $(".b-email-trap__input_type_email", $block);

    $submitBtn.click(function(e){

        e.preventDefault();

        // Disable
        $emailField.attr("disabled", "disabled");
        $submitBtn.attr("disabled", "disabled");

		var v = $("#email-trap-val").val();
		$.post("/save.php", { email: v} ).success(function(response) {

                $slide1.fadeOut("medium", function(){
                    $slide2.fadeIn("medium");
                })

            });

        return false;
    });

});