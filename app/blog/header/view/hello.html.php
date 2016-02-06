<head>
	<meta charset="utf-8">
	<title>无处不在的小土</title>
	<script src=<?php echo '"'.$config->web->js.'environment.js"'?>></script>
	<script src=<?php echo '"'.$config->web->js.'my.js"'?>></script>
	<script src=<?php echo '"'.$config->web->plugin.'epiceditor/js/epiceditor.js"'?>></script>
	<script type="text/javascript" src="http://cdn.mathjax.org/mathjax/latest/MathJax.js?config=default"></script>
<!--
	<link href=<?php echo '"'.$config->web->css.'screen.css"'?> media="screen, projection" rel="stylesheet" type="text/css">
-->
</head>

<body>
	<header role="banner">
		<h1><a href="/"><?php echo $world?></a></h1>
	</header>

	<p>\[x=\frac{-b\pm\sqrt{b^2-4ac}}{2a}\]</p>

	<div id='epiceditor'></div>
	<script>
		var editor = new EpicEditor({basePath: 'plugin/epiceditor'});
	    editor.load();

		previewer = editor.getElement('previewer');
		var mathjax = previewer.createElement('script');
		mathjax.type = 'text/javascript';
		mathjax.src = 'http://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML';
		previewer.body.appendChild(mathjax);

		var config = previewer.createElement('script');
		config.type = 'text/x-mathjax-config';
		config.text = "MathJax.Hub.Config({tex2jax: {inlineMath: [['$','$']], displayMath: [['$$','$$']], processEscapes: true}});";
		previewer.body.appendChild(config);

		editor.on('preview', function() {
			    editor.getElement('previewerIframe').contentWindow.eval(
					        'MathJax.Hub.Queue(["Typeset",MathJax.Hub]);');
				});
	</script>
	<script>
		function save_draft_button_click() {
			var msg = <?php echo '"'.$config->module_prompt.'=header&'.$config->func_prompt.'=save_draft"';?>;
			var draft = new Object();
			draft.md = editor.exportFile();
			draft.html = editor.exportFile(null,'html');

			msg += "&draft=" + JSON.stringify(draft);
			post(POST_PHP, msg, function(request) {
				alert(request.responseText);
			});
		}

		function publish_article_button_click() {
			alert(">>>>>>");
		}
	</script>
	<button id='save_draft_button' onclick='save_draft_button_click()'>保存到草稿箱</button>
	<button id='publish_article_button' onclick='publish_article_button_click()'>发布</button>

</body>
