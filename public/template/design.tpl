<!DOCTYPE html>
<html lang="fr" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8" />

    {assign var=websitePage value=$controller->getPageName()|security}
    {assign var=websiteKeywords value=$controller->getPageKeywords()|security}
    {assign var=websiteDescription value=$controller->getPageDescription()|security}
    {assign var=websiteAuthor value=$controller->getPageAuthor()|security}
    {assign var=websiteRobots value=$controller->getPageRobots()|security}

    <title>{$websitePage}</title>

    <meta name="description" lang="fr" content="{$websiteDescription}" />
    <meta name="author" lang="fr" content="{$websiteAuthor}" />
    <meta name="robots" lang="fr" content="{$websiteRobots}" />
    <meta name="keywords" lang="fr" content="{$websiteKeywords}" />
	<meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Common CSS for all website pages -->
    <link rel="stylesheet" 
        href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" 
        integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" 
        crossorigin="anonymous">
    <link rel="stylesheet" 
        href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" 
        integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" 
        crossorigin="anonymous">
    <link rel="stylesheet" 
        href="{$skin}style/common.css"
        media="all" />

    <!-- Specific CSS for the current page -->
    {foreach from=$controller->getStylesheetList() item="stylesheet"}
    <link href="{$root}{$stylesheet}" rel="stylesheet" type="text/css" media="all" />
    {/foreach}

    <!-- Common scripts for all website pages -->
    <script src="https://code.jquery.com/jquery-2.2.2.min.js"></script>
    <script src="{$skin}script/common.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" 
        integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" 
        crossorigin="anonymous"></script>

    <!-- Specific scripts for the current page -->
    {foreach from=$controller->getScriptList() item="script"}
    <script type="text/javascript" src="{$root}{$script}"></script>
    {/foreach}

    <!-- HTML 5 for IE -->
    <!--[if lte IE 8]>
    <script src="{$skin}script/html5.js"></script>
    <![endif]-->
</head>
<body>

    <div class="site-wrapper">
      <div class="site-wrapper-inner">
        <div class="cover-container">
          <div class="masthead clearfix">
            <div class="inner">
              <h3 class="masthead-brand">Your website</h3>
              <nav>
                <ul class="nav masthead-nav">
                  {link link="Home" name="Home"}
                  {link link="About" name="About us"}
                </ul>
              </nav>
            </div>
          </div>

          <div class="inner cover">
            {$controller->getPageContent()}
          </div>

          <div class="mastfoot">
            <div class="inner">
              <p>Cover template for <a href="http://getbootstrap.com">Bootstrap</a>, by <a href="https://twitter.com/mdo">@mdo</a>.</p>
            </div>
          </div>
        </div>
      </div>
    </div>

</body>
</html>