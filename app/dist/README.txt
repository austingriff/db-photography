WELCOME
=======

Thank you for downloading jQuery Tiles Gallery, by GreenTreeLabs. This document will guide you through the installation and customization process of jQuery Tiles Gallery.



INSTALLATION
============

Put jquery.tilesgallery.js in the js/ folder and jquery-tilesgallery.css in the css/ folder of your website. Include these files in the head of your page, be sure to include also an updated version of jQuery:

<html>
	<head>
	....
	<script src="http://code.jquery.com/jquery-1.7.2.min.js" type="text/javascript"></script>
	<script src="/js/jquery.tilesgallery.js"  type="text/javascript"></script>
	<link href="/css/jquery-tilesgallery.css" rel="Stylesheet" />
	...
	</head>
...
</html>

If you plan to use social sharing in your galleries then add also the following line before </head>:

<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="Stylesheet" />


HTML SETUP
==========

What you need is:

	- a container;
	- a list of tag, each one containing an image;

example:

	<!-- main Tile Gallery container -->
	<div class="tiles">

			<!-- inner container -->
            <div class="items">

            	<!-- tile -->
                <div class="item">

                	<!-- image -->
                    <img class="pic" src="photos/photo-001.jpg">

                    <!-- caption (optional) -->
                    <div class="caption"><h3>Title</h3><p>Lorem ipsum dolor sic amet</p></div>
                </div>

                <!-- tile -->
                <div class="item">

                	<!-- image -->
                    <img class="pic" src="photos/photo-002.jpg">

                    <!-- caption (optional) -->
                    <div class="caption"><h3>Title</h3><p>Lorem ipsum dolor sic amet</p></div>
                </div>

                <!-- add as many tiles as you need -->
            </div>
        </div>
    </div>

the script to apply jQuery Tiles Gallery can be anywhere in the page:

	<script type="text/javascript">
	$(function () {
		$(".tiles").tilesGallery({
			height: 600
		});
	})
	</script>

...and you have done!



OPTIONS
=======


°	height
		An int value. Height of the container in pixels. This option can be omitted but you'll need to set it up via CSS.
	
°	margin
		An int value. Margin thickness in pixels between the images.

°	callback
		A function value. After jQuery Tiles Gallery has done its job you can run custom code within the callback. For example, the following code:
		
		$(".tiles").tilesGallery({
			callback: function () {
				alert("jQuery Tiles Gallery has done its job!");
			}
		});

		will open an alert containing the text: "jQuery Tiles Gallery has done its job!".
	


HOW TO...
=========

°	...change the color of the borders? 
	The borders are transparent, so you just have to set the background color of the whole container (the div with "example" ID in our example).

°	...show a lightbox popup when I click on images?
	Choose your favourite popup plugin and activate it in the callback. For example, if you use jQuery Lightbox, you should write this:

	$(".tiles").tilesGallery({
		callback: function () {
			$(".tiles a").lightBox();
		}
	});

	the jQuery Lightbox can be downloaded from http://leandrovieira.com/projects/jquery/lightbox/ 
	
	




