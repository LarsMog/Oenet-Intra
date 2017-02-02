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

<body>
  <jdoc:include type="message" />
  <div id="frame" class="outline">
    <?php if ($app->getCfg('offline_image')) : ?>
      <img src="<?php echo $app->getCfg('offline_image'); ?>" alt="<?php echo $app->getCfg('sitename'); ?>" />
    <?php endif; ?>
    <?php if ($app->getCfg('display_offline_message', 1) == 1 && str_replace(' ', '', $app->getCfg('offline_message')) != ''): ?>
		<p><?php echo $app->getCfg('offline_message'); ?></p>
    <?php elseif ($app->getCfg('display_offline_message', 1) == 2 && str_replace(' ', '', JText::_('JOFFLINE_MESSAGE')) != ''): ?>
		<p><?php echo JText::_('JOFFLINE_MESSAGE'); ?></p>
	<?php endif; ?>
    <form action="<?php echo JRoute::_('index.php', true); ?>" method="post" name="login" id="form-login">
      <fieldset class="input">
        <p id="form-login-username">
          <label for="username"><?php echo JText::_('JGLOBAL_USERNAME'); ?></label><br />
          <input type="text" name="username" id="username" class="inputbox" alt="<?php echo JText::_('JGLOBAL_USERNAME'); ?>" size="18" />
        </p>
        <p id="form-login-password">
          <label for="passwd"><?php echo JText::_('JGLOBAL_PASSWORD'); ?></label><br />
          <input type="password" name="password" id="password" class="inputbox" alt="<?php echo JText::_('JGLOBAL_PASSWORD'); ?>" size="18" />
        </p>
        <p id="form-login-remember">
          <label for="remember"><?php echo JText::_('JGLOBAL_REMEMBER_ME'); ?></label>
          <input type="checkbox" name="remember" value="yes" alt="<?php echo JText::_('JGLOBAL_REMEMBER_ME'); ?>" id="remember" />
        </p>
        <p id="form-login-submit">
          <label>&nbsp;</label>
          <input type="submit" name="Submit" class="button" value="<?php echo JText::_('JLOGIN'); ?>" />
        </p>
      </fieldset>
      <input type="hidden" name="option" value="com_users" />
      <input type="hidden" name="task" value="user.login" />
      <input type="hidden" name="return" value="<?php echo base64_encode(JURI::base()); ?>" />
      <?php echo JHTML::_( 'form.token' ); ?>
    </form>
  </div>
</body>

</html>