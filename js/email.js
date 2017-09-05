$(function () {
	function removeCampo() {
		$(".removerCampoE").unbind("click");
		$(".removerCampoE").bind("click", function () {
			i=0;
			$(".emails p.campoEmail").each(function () {
				i++;
			});
			if (i>1) {
				$(this).parent().remove();
			}
		});
	}
	removeCampo();
	$(".adicionarCampoE").click(function () {
		novoCampo = $(".emails p.campoEmail:first").clone();
		novoCampo.find("input").val("");
		novoCampo.insertAfter(".emails p.campoEmail:last");
		removeCampo();
	});
});