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
$fontawesomeie = $this->params->get('fontawesomeie');
$pie = $this->params->get('pie');

// variables
$app = JFactory::getApplication();
$doc = JFactory::getDocument();
$menu = $app->getMenu(); 
$params = $app->getParams();
$pageclass = $params->get('pageclass_sfx');
$tpath = $this->baseurl.'/templates/'.$this->template;

$this->setGenerator(null);

// CSS
if ($bootstrapcss==1) $doc->addStyleSheet($tpath.'/css/bootstrap.min.css');
$doc->addStyleSheet($tpath.'/css/template.css'); 
if ($fontawesome==1) $doc->addStyleSheet($tpath.'/css/font-awesome.min.css');
if ($fontawesomeie==1) $doc->addStyleSheet($tpath.'/css/font-awesome-ie7.min.css');

// JS
if ($bootstrapjs==1) $doc->addScript($tpath.'/js/jquery.min.js');
if ($bootstrapjs==1) $doc->addScript($tpath.'/js/bootstrap.min.js'); 
if ($modernizr==1) $doc->addScript($tpath.'/js/modernizr.js'); 

// Columns
if ($this->countModules('left') && !$this->countModules('right')){ $leftcol = "3"; $centercol = "9";
}elseif (!$this->countModules('left') && $this->countModules('right')){ $rightcol = "3"; $centercol = "9";
}elseif ($this->countModules('left') && $this->countModules('right')){ $leftcol = "3"; $rightcol = "3"; $centercol = "6";
}elseif (!$this->countModules('left') && !$this->countModules('right')){ $centercol = "12"; }

?><!doctype html>
<!--[if IEMobile]><html class="iemobile" lang="<?php echo $this->language; ?>"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="<?php echo $this->language; ?>"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="<?php echo $this->language; ?>"> <![endif]-->
<!--[if gt IE 8]><!-->  <html class="no-js" lang="<?php echo $this->language; ?>"> <!--<![endif]-->

<head>
  <jdoc:include type="head" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
  <link rel="apple-touch-icon-precomposed" href="<?php echo $tpath; ?>/apple-touch-icon-57x57.png">
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $tpath; ?>/apple-touch-icon-72x72.png"> 
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo $tpath; ?>/apple-touch-icon-114x114.png">
  <?php if ($pie==1) : ?>
    <!--[if lte IE 8]>
      <style> 
        {behavior:url(<?php echo $tpath; ?>/js/PIE.htc);}
      </style>
    <![endif]-->
  <?php endif; ?>
  
  <?php if ($bootstrapjs==1) : ?>
	  <script>
	  	jQuery.noConflict();
	  </script>
  <?php endif; ?>
  
  <?php if ($this->params->get( 'ga' )) : ?>  
	  <script type="text/javascript">
		  var _gaq = _gaq || [];
		  _gaq.push(['_setAccount', '<?php echo $this->params->get('ga');?>']);
		  _gaq.push(['_trackPageview']);
		
		  (function() {
		    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		  })();
	  </script>
  <?php endif; ?>
  
</head>
	
<body<?php if($pageclass): ?>class="<?php echo $pageclass; ?>"<?php endif; ?>>

<div class="row-fluid">
	<div class="span12">
		<!-- Begin Content -->
		<h1 class="page-header"><?php echo JText::_('JERROR_LAYOUT_PAGE_NOT_FOUND'); ?></h1>
		<div class="well">
			<div class="row-fluid">
				<div class="span6">
					<p><strong><?php echo JText::_('JERROR_LAYOUT_ERROR_HAS_OCCURRED_WHILE_PROCESSING_YOUR_REQUEST'); ?></strong></p>
					<p><?php echo JText::_('JERROR_LAYOUT_NOT_ABLE_TO_VISIT'); ?></p>
					<ul>
						<li><?php echo JText::_('JERROR_LAYOUT_AN_OUT_OF_DATE_BOOKMARK_FAVOURITE'); ?></li>
						<li><?php echo JText::_('JERROR_LAYOUT_MIS_TYPED_ADDRESS'); ?></li>
						<li><?php echo JText::_('JERROR_LAYOUT_SEARCH_ENGINE_OUT_OF_DATE_LISTING'); ?></li>
						<li><?php echo JText::_('JERROR_LAYOUT_YOU_HAVE_NO_ACCESS_TO_THIS_PAGE'); ?></li>
					</ul>
				</div>
				<div class="span6">
					<?php if (JModuleHelper::getModule('search')) : ?>
						<p><strong><?php echo JText::_('JERROR_LAYOUT_SEARCH'); ?></strong></p>
						<p><?php echo JText::_('JERROR_LAYOUT_SEARCH_PAGE'); ?></p>
						<?php
							$module = JModuleHelper::getModule('search');
							echo JModuleHelper::renderModule($module);
						?>
					<?php endif; ?>
					<p><?php echo JText::_('JERROR_LAYOUT_GO_TO_THE_HOME_PAGE'); ?></p>
					<p><a href="<?php echo $this->baseurl; ?>/index.php" class="btn"><i class="icon-home"></i> <?php echo JText::_('JERROR_LAYOUT_HOME_PAGE'); ?></a></p>
				</div>
			</div>
			<hr />
			<p><?php echo JText::_('JERROR_LAYOUT_PLEASE_CONTACT_THE_SYSTEM_ADMINISTRATOR'); ?></p>
			<blockquote>
				<span class="label label-inverse"><?php echo $this->error->getCode(); ?></span> <?php echo $this->error->getMessage();?>
			</blockquote>
		</div>
	</div>
</div>

</body>
</html>
