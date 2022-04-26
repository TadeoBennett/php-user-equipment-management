$(document).ready(function(){
    $("#deviceType").on('change', function(){
        $(".specs").fadeOut(200);
        if ($(this).val() == 2 || $(this).val() == 3) {
            $(".computer").fadeIn(500);
	    $("[name='add-spec-type']").val($(this).val());
        }else if ($(this).val() == 1) {
            $(".screen").fadeIn(500);
	    $("[name='add-spec-type']").val($(this).val());
        }else if ($(this).val() == 4) {
            $(".ups").fadeIn(500);
	    $("[name='add-spec-type']").val($(this).val());
        }else{
            $(".specs").fadeOut(200);
	    $("[name='add-spec-type']").val(-1);
        }
    }).change();
});
