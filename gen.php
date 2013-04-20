<!--
	Author: Tanner
	https://github.com/Tanner963/CSS-Parallax
	http://tanner.warsztat.io/
	http://fb.me/tannernetwork
	http://twitter.com/tannernetwork
	2013
-->
<?php


	$parallax = array(
		'width' => '1000',
		'height' => '400',
		'background' => '#0091BE',
		'step' => '5',
	);
	$layers = array(
		1 => array(
			'width' => '800',
			'height' => '400',
			'left' => '0',
			'maxLeft' => '-800',
			'background' => 'url(layer1.png)'
		),
		2 => array(
			'width' => '1500',
			'height' => '400',
			'left' => '-500',
			'maxLeft' => '0',
			'background' => 'url(layer2.png)'
		),
		3 => array(
			'width' => '500',
			'height' => '400',
			'left' => '-3500',
			'maxLeft' => '250',
			'background' => 'url(layer3.png) no-repeat center'
		)
	)
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Pure CSS Parallax</title>
	<style>
	body {
		padding: 0px;
		margin: 0px;
		background: #eef;
	}
	
	#parallax {
		width: <?php echo $parallax['width']; ?>px;
		height: <?php echo $parallax['height']; ?>px;
		margin: 0px auto;
		background: <?php echo $parallax['background']; ?>;
		position: relative;
		font-size: 0px;
		overflow: hidden;
	}
	
	#parallax .control {
		z-index: 1000;
		display: inline-block;
		width: <?php echo $parallax['step']; ?>px;
		height: 100%;
		margin: 0px;
		padding: 0px;
		position: absolute;
	}
	
	<?php
		$controls = $parallax['width'] / $parallax['step'];
		while($controls > 0){
			$controls--;
			echo '#parallax .c'.($controls+1).' {left:'.($controls*$parallax['step']).'px;}
	';
		}
	?>
	
	#parallax .layer {
		z-index: 1;
		position: absolute;
		left: 0px;
		top: 0px;
		margin: 0px;
		padding: 0px;
		font-size: 12px;
		transition-property: left;
		transition-duration: 1s;
		-webkit-transition-property: left;
		-webkit-transition-duration: 1s;
	}
	
	<?php
		foreach($layers as $id => $layer){
			echo '#parallax .l'.$id.' {
	width:'.$layer['width'].'px;
	height:'.$layer['height'].'px;
	background:'.$layer['background'].';
	background-size: contain;
	left:'.$layer['left'].'px;
}
	';
		}
	?>
	
	<?php
		$controls = $parallax['width'] / $parallax['step'];
		while($controls > 0){
			$controls--;
			foreach($layers as $id => $layer){
				$left = ($layer['maxLeft'] - $layer['left']) * $controls / $parallax['width'] * $parallax['step'] + $layer['left'];
				echo '#parallax .c'.($controls+1).':hover ~ .l'.$id.' {left: '.$left.'px; !important}
	';
			};
		}
	?>	
	</style>
</head>
<body>
	<div id="parallax">
		<!--Controls-->
		<?php
			$controls = $parallax['width'] / $parallax['step'];
			while($controls > 0){
				echo '<div class="control c'.$controls.'"></div>
		';
				$controls--;
			}
		?>
<!--Layers-->
		<?php
			foreach($layers as $id => $layer){
				echo '<div class="layer l'.$id.'"></div>
		';
			}
		?>
</div>
<div style="text-align: center; font-family: Arial; margin: 20px;">
	<a href="https://github.com/Tanner963/CSS-Parallax">github</a> -
	<a href="http://tanner.warsztat.io">homepage</a> -
	<a href="http://fb.me/tannernetwork">facebook</a> -
	<a href="http://twitter/tannernetwork">twitter</a> - subscribe! //tanner
</div>
</body>
</html>