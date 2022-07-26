<!doctype html>
<html lang="en">
	<head>
	
		<meta name="description" content="This is a demo of making image gallery from a directory using PHP." />
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="stylesheet" href="assets/css/lightbox.min.css"/>
		<style>
			
			.spacer{
				position: relative;
				height: 80px;
			}
			
			
			/* ---- grid ---- */

			.gallery-list {
				margin: auto;
				left: 7px;
			}

			.gallery-item {
				width: 20%;
				margin-bottom: 15px;
				position: relative;
				overflow: hidden;
				cursor: pointer;
			}

			.gallery-item img {
				width: 100%;
				height: auto;
				vertical-align: top;
				webkit-filter: grayscale(50%);
				-moz-filter: grayscale(50%);
				-o-filter: grayscale(50%);
				-ms-filter: grayscale(50%);
				filter: grayscale(50%);
				-webkit-transition: all 0.5s ease-in-out;
				-moz-transition: all 0.5s ease-in-out;
				-o-transition: all 0.5s ease-in-out;
				transition: all 0.5s ease-in-out;
			}

			.gallery-item:hover img {
				-webkit-filter: grayscale(0%);
				-moz-filter: grayscale(0%);
				-o-filter: grayscale(0%);
				-ms-filter: grayscale(0%);
				filter: grayscale(0%);
				-webkit-transform: scale(1.2) rotate(-3deg);
				-moz-transform: scale(1.2) rotate(-3deg);
				-o-transform: scale(1.2) rotate(-3deg);
				-ms-transform: scale(1.2) rotate(-3deg);
				transform: scale(1.2) rotate(-3deg);
			}
		</style>
		
	</head>
	<body>
		<div class="container">
			
			
			<div class="form-group row">
				<div class="col-12 mt-5">
					<div class="gallery-list">
					<?php
						
						//get current directory
						$working_dir = getcwd();
						
						//get image directory
						$img_dir = $working_dir . "/gallery/images/";
						
						//change current directory to image directory
						chdir($img_dir);
						
						//using glob() function get images 
						$files = glob("*.{jpg,jpeg,png,gif,JPG,JPEG,PNG,GIF}", GLOB_BRACE );
						
						//again change the directory to working directory
						chdir($working_dir);
						
						//iterate over image files
						foreach ($files as $file) {
						?>
							<div class="gallery-item">
								<a href="<?php echo "gallery/images/" . $file ?>" data-lightbox="gallery">
									<img src="<?php echo "gallery/images/thumb/" . $file ?>"/>
								</a>
							</div>
						<?php }
					?>
						
					</div>
				</div>
				
			</div>

			<div class="spacer"></div>
		</div>
		
		<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
		<script src="assets/js/lightbox.min.js"></script>
		<script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>
		<script>
			$(document).ready(function(){

				(function($,sr){
					// http://paulirish.com/2009/throttled-smartresize-jquery-event-handler/
					// debouncing function from John Hann
					// http://unscriptable.com/index.php/2009/03/20/debouncing-javascript-methods/
					var debounce = function(func, threshold, execAsap) {
						var timeout;
				  
						return function debounced () {
							var obj = this, args = arguments;
							function delayed () {
								if (!execAsap)
									func.apply(obj, args);
									timeout = null;
							}
				  
							if (timeout)
								clearTimeout(timeout);
							else if (execAsap)
							func.apply(obj, args);
				  
							timeout = setTimeout(delayed, threshold || 50);
						};
					};
				  
					// smartresize
					jQuery.fn[sr] = function(fn){  return fn ? this.bind('resize', debounce(fn)) : this.trigger(sr); };
				  
				  })(jQuery,'smartresize');

				var colWidth = function () {
					var w = $container.width(),
						columnNum = 1,
						columnWidth = 0;
					if (w > 1200) {
						columnNum  = 3;
					} else if (w > 900) {
						columnNum  = 3;
					} else if (w > 600) {
						columnNum  = 3;
					} else if (w > 400) {
						columnNum  = 2;
					}else if (w > 300) {
						columnNum  = 1;
					}
					columnWidth = Math.floor(w/columnNum);
					columnWidth = columnWidth - 10;
					
					// Item width
					$container.find('.gallery-item').each(function() {
						var $item = $(this);
						var multiplier_w = $item.attr('class').match(/item-w(\d)/);
						var width = multiplier_w ? columnWidth*multiplier_w[1]-4 : columnWidth-4;
						// Update item width
						$item.css({
							width: width
						});
					});
					return columnWidth;
				};

				var $container = $('.gallery-list');
				$container.isotope({
					resizable: false,
					itemSelector: '.gallery-item',
					percentPosition: true,
					masonry: {
						columnWidth: colWidth(),
						gutter: 10,
					}
				});
			
			});
		</script>
	</body>
</html>
