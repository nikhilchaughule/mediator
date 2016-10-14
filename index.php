<!doctype html>
<html lang="en">
<head>
  <?php 
  require_once 'class.Mediator.php';
  $data = new Mediator();
  if(@trim($_POST['content'])){
  	$processed = $data->parseContent($_POST['content']);
  }
  ?>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="<?php echo $data->desc; ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
	<title><?php echo $data->title." ".$data->version; ?></title>
	<link rel="stylesheet"	href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="assets/css/material.min.css">
	<link rel="stylesheet" href="assets/css/main.css">
	
	<script src="assets/js/material.min.js"></script>
</head>
<body>
	<!-- Simple header with scrollable tabs. -->
	<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
		<header class="mdl-layout__header">
			<div class="mdl-layout__header-row">
				<!-- Title -->
				<span class="mdl-layout-title"><?php echo $data->title." ".$data->version; ?></span>
			</div>
			<?php
				
				if(!empty($processed)){
					$manipulated = array ();
					foreach ($processed as $eachentry){
						$manipulated[$eachentry[6]][$eachentry[1]." &lt;".$eachentry[4]."&gt;"][$eachentry[0]] = array(
								'date'=>$eachentry[3],
								'update'=>$eachentry[2],
								'notes'=>$eachentry[7],
								'rating'=>$eachentry[5]
						);
					}
					/* echo "<pre>";
					var_dump($manipulated);
					echo "</pre>"; */
					
				}
				
				
						?>
			<!-- Tabs -->
			<div class="mdl-layout__tab-bar mdl-js-ripple-effect">
				<?php 
				
				if(@trim($_POST['content']) && !empty($manipulated)):
				$counter=0;
					foreach ($manipulated as $eachproject=>$userdata):
						echo '<a href="#'.str_replace(" ","",$eachproject).'" class="mdl-layout__tab '.(($counter==0)?'is-active':'').'">'.str_replace(" ","",$eachproject).'</a>';
					$counter++;
					endforeach;
				endif;
				?>
			</div>
		</header>
		<div class="mdl-layout__drawer">
			<span class="mdl-layout-title">Nothing to show ....yet!!</span>
		</div>
		<main class="mdl-layout__content">
		<?php if(!@trim($_POST['content'])): ?>
		<section class="docs-text-styling about-panel about-panel--text mdl-cell mdl-cell--12-col">
			<dl>
				<dd>
					<!-- Textfield with Floating Label -->

					<form action="" method="post" >
					
						<div class="checkbox">
							<?php 
								$checks = array(
										'1'=>'Name',
										'0'=>'Timestamp',
										'3'=>'Date'									
								);
								foreach ($checks as $val=>$eachcheck):
							?>
								<label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="showbox-<?php echo $val; ?>">
								  <input  name="show[]" type="checkbox" id="showbox-<?php echo $val; ?>" class="mdl-checkbox__input" <?php if(in_array($val,@$_POST['show'])) echo "checked";?> value="<?php echo $val; ?>">
								  <span class="mdl-checkbox__label"><?php echo $eachcheck; ?></span>
								</label> 
							<?php endforeach; ?>
							</div>
						<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
							<textarea class="mdl-textfield__input" name="content" type="text" rows= "2" style="width:700px" id="content" ><?php echo @$_POST['content']; ?></textarea>
							<label class="mdl-textfield__label" for="content">Paste your Report Summary here...</label>
						</div>
						<!-- Colored FAB button with ripple -->
						<button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored donebutton" id="donebutton">
						  <i class="material-icons">done</i>
						</button>
						<!-- Rich Tooltip -->
							<div class="mdl-tooltip" data-mdl-for="donebutton">
								Done
							</div>
					</form>
				</dd>
			</dl>
		</section>
		<?php endif; ?>
				<?php 
				if(@$_POST['content'] && !empty($manipulated)):
					$counter=0;
						foreach ($manipulated as $eachproject=>$userdata):
							echo '<a href="#'.str_replace(" ","",$eachproject).'" class="mdl-layout__tab">'.$eachproject.'</a>';
					?>
					<section class="mdl-layout__tab-panel <?php if($counter==0) echo 'is-active'; ?>" id="<?php echo str_replace(" ","",$eachproject); ?>">
						<div class="page-content">
							<!-- Your content goes here -->
							<?php 
							echo "<pre>";var_dump($userdata);echo "</pre>";
							?>
						</div>
					</section>
					<?php 
						$counter++;
						endforeach;
					endif;
				
				?>
		</main>

	</div>




</body>
</html>