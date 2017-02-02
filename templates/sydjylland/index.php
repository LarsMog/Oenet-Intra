<?php  
/*------------------------------------------------------------------------
# author    Webitall ApS
# copyright Copyright © 2013 webitall. All rights reserved.
# @license  http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Website   http://www.webitall.dk
-------------------------------------------------------------------------*/
defined( '_JEXEC' ) or die; 

// parameters (template)
$modernizr = $this->params->get('modernizr');
$bootstrapjs = $this->params->get('bootstrapjs');
$bootstrapcss = $this->params->get('bootstrapcss');
$fontawesome = $this->params->get('fontawesome');

// variables
$app = JFactory::getApplication();
$doc = JFactory::getDocument();
$menu = $app->getMenu(); 
$params = $app->getParams();
$pageclass = $params->get('pageclass_sfx');
$tpath = $this->baseurl.'/templates/'.$this->template;
$lang = JFactory::getLanguage();
$this->setGenerator(null);

// CSS
if ($bootstrapcss==1) $doc->addStyleSheet($tpath.'/css/bootstrap.min.css');
//if ($bootstrapcss==1) $doc->addStyleSheet('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.4/css/bootstrap.min.css" integrity="sha384-2hfp1SzUoho7/TsGGGDaFdsuuDL0LX2hnUp6VkX3CUQ2K4K+xjboZdsXyp4oUHZj');
$doc->addStyleSheet($tpath.'/css/template.css'); 
if ($fontawesome==1) $doc->addStyleSheet($tpath.'/css/font-awesome.min.css');
if ($fontawesomeie==1) $doc->addStyleSheet($tpath.'/css/font-awesome-ie7.min.css');

// JS
if ($bootstrapjs==1) $doc->addScript($tpath.'/js/jquery.min.js');
if ($bootstrapjs==1) $doc->addScript($tpath.'/js/bootstrap.min.js');
//if ($bootstrapjs==1) $doc->addScript('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.4/js/bootstrap.min.js" integrity="sha384-VjEeINv9OSwtWFLAtmc4JCtEJXXBub00gtSnszmspDLCtC0I4z4nqz7rEFbIZLLU');

if ($modernizr==1) $doc->addScript($tpath.'/js/modernizr.js'); 

// Columns
if ($this->countModules('left') && !$this->countModules('right')){ $leftcol = "3"; $centercol = "9";
}elseif (!$this->countModules('left') && $this->countModules('right')){ $rightcol = "3"; $centercol = "9";
}elseif ($this->countModules('left') && $this->countModules('right')){ $leftcol = "3"; $rightcol = "3"; $centercol = "6";
}elseif (!$this->countModules('left') && !$this->countModules('right')){ $centercol = "12"; }
?>
<!doctype html>
<!--[if IEMobile]><html class="iemobile" lang="<?php echo $this->language; ?>"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="<?php echo $this->language; ?>"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="<?php echo $this->language; ?>"> <![endif]-->
<!--[if gt IE 8]><!-->  <html class="no-js" lang="<?php echo $this->language; ?>"> <!--<![endif]-->
<head>
  <jdoc:include type="head" />

  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
  <link rel="apple-touch-icon-precomposed" href="<?php echo $tpath; ?>/apple-touch-icon-57x57.png">
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $tpath; ?>/apple-touch-icon-72x72.png"> 
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo $tpath; ?>/apple-touch-icon-114x114.png">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  
  <?php if ($bootstrapjs==1) : ?>
	  <script>
	  	jQuery.noConflict();
	  </script>
  <?php endif; ?>
  

  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css' />
  <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-84212737-1', 'auto');
  ga('send', 'pageview');

</script>
</head>
	
<body class="<?php if($pageclass): ?><?php echo $pageclass; ?><?php endif; ?> <?php if ($menu->getActive() == $menu->getDefault($lang->getTag())) : ?> frontpage<?php endif; ?>">
<div id="mainwrap">
	<div id="nav">
		
		<jdoc:include type="modules" name="topmenu" style="raw" />
		<div class="container langwrap"><div class="lang"><jdoc:include type="modules" name="lang" style="xhtml" /></div></div>
	</div>


        <div id="jumbo"> </div>


	<div id="wrap">
		<div class="container maincontent">
	  <div class="search_container">

	  </div>
			<div class="row">
				<jdoc:include type="modules" name="statement" style="raw" />
			</div>
		</div>
		
		<div class="container">
			<div class="content">
			  <?php

?>
				<div class="row"> 
					<?php if ($this->countModules('left')): ?>
						<div class="col-md-<? echo $leftcol; ?>"> 
							<jdoc:include type="modules" name="left" style="extended" />
						</div>
					<?php endif; ?>
			    	
			    	<div class="col-md-<?php echo $centercol; ?>" style="margin-top:18px">
			    		<?php if(count(JFactory::getApplication()->getMessageQueue())):?>
				    		<jdoc:include type="message" />
						<?php endif; ?>
							<div class="container">
							<jdoc:include type="component" />
							</div>
			    	</div>
			    	
					<?php if ($this->countModules('right')): ?>
						<div class="col-md-<? echo $rightcol; ?>">
							<!--<div class="pad20">-->
								<jdoc:include type="modules" name="right" style="extended" />
							<!--</div>-->
			    		</div>
			    	<?php endif; ?>	
				</div>
			</div>
		</div>
		
		<?php if ($this->countModules('front1 or front2')): ?>
		<div class="container front">
			<div class="row">
				<div class="col-md-4 col-sm-4 frontbox"><jdoc:include type="modules" name="front1" style="extended" /></div>
				<div class="col-md-8 col-sm-8 frontbox"><jdoc:include type="modules" name="front2" style="extended" /></div>
			</div>
		</div>
		<?php endif; ?>


	</div>
    <div id="footer">
      <div class="container">
	      <div class="row">
	          <div class="col-md-6 col-sm-12 col-xs-12">
			      <jdoc:include type="modules" name="footer" style="raw" />
		      </div>
	      </div>
      </div>
      
    </div>
</div>
</body>
</html>

