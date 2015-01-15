	<footer class="container-fluid footer">
		<p class="pull-right">
			Executed in {elapsed_time} seconds, using {memory_usage}.
			<br/>
			Powered by <a href="http://cibonfire.com" target="_blank"><i class="icon-fire">&nbsp;</i>&nbsp;Bonfire</a> <?php echo BONFIRE_VERSION ?>
		</p>
	</footer>

	<div id="debug"><!-- Stores the Profiler Results --></div>

  <!-- Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if offline -->
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="<?php echo js_path(); ?>jquery-1.7.2.min.js"><\/script>')</script>

    <script src="<?php echo base_url('/js/jquery.sceditor.bbcode.min.js'); ?>"></script>
    <script src="<?php echo base_url('/js/jquery.steps.min.js'); ?>"></script>
    <script src="<?php echo base_url('/js/functions.js'); ?>"></script>
    <script>
        $(function ()
        {
            $("#main-slider").steps({
                headerTag: "label",
                bodyTag: "div",
                transitionEffect: "slideLeft"
            });
        });


        $(document).ready(function() {
            var initEditor = function() {
                $("textarea").sceditor({
                    plugins: 'bbcode',
                    style: "./minified/jquery.sceditor.default.min.css"
                });
            };



            initEditor();
        });
    </script>
	<?php echo Assets::js(); ?>
</body>
</html>
