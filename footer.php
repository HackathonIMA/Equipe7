
			</div>
		</div>
	</div>
</body>
</html>
<script type="text/javascript" src="js/speech.js"></script>
<script type="text/javascript" src="js/functions.js"></script>

<script type="text/javascript">
	$(document).ready(function(){
		$(".topo").click(function(){
			$(".bgMenu").toggleClass("hide");
			$(".bgMenu").removeClass("hidden-xs");
		});
		
		$(".bgMenu").css("min-height",$(window).height());
	});
	
	function menu(nome){
		$("#maincontent").load(nome+".html");
	}
</script>