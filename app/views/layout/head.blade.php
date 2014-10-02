<meta charset="utf-8">
<title>Cream</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Cream, the CRM app">
<meta name="author" content="Israel Ortuño">

<link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700' rel='stylesheet' type='text/css'>

<!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
<!--[if lt IE 9]>
  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

    @stylesheets ('application')

    @foreach (Helpers\LoadAssets::$collections as $collection)
        @stylesheets ($collection)
    @endforeach
    
    @javascripts ('application')
    
    @foreach (Helpers\LoadAssets::$collections as $collection)
        @javascripts ($collection)
    @endforeach

<script type="text/javascript">
    var spinnerVisible = false;
    var itemsToLoad = 0;
    function showProgress() {
        if ( ! spinnerVisible ) {
            $("div#spinner").fadeIn("fast");
            spinnerVisible = true;
        }
        itemsToLoad++;
    };
    function hideProgress() {
        if ((spinnerVisible) && (itemsToLoad == 1)) {
            var spinner = $("div#spinner");
            spinner.fadeOut("fast");
            spinnerVisible = false;
        }
        itemsToLoad--;
    };
</script>