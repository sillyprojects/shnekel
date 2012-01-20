<!DOCTYPE html>
<html>
<head>
  <title>Shnekel Exchange Rate | שער השנקל</title>
  <link rel="stylesheet" href="css/style.css" type="text/css" media="screen" charset="utf-8"/>
</head>
<body id="main">
  <?php
    // get xml from Bank of Israel
    $xml = simplexml_load_file("http://www.bankisrael.gov.il/currency.xml");
    // date of last update
    $lastUpdate = $xml->LAST_UPDATE;
  ?>

  <div id="header">
    <h1>Shnekel Exchange Rate<span class="description">Last update: <?php echo $lastUpdate; ?> (<span id="toggle-help">more about this project</span>)</h1>
  </div>

  <div id="wrapper">
    <div id="help">
      <ul>
        <h3>What is a Shnekel?</h3>
        <li><p><strong>Etymology</strong>: Blend of שְׁנֵי and שֶׁקֶל ("two sheqels" in a colloquial sub-standard form). The word was invented during a radio game on the Israeli Galei Tzahal station in December 2007, when the two-new-sheqel piece was first introduced.</p></li>
        <li><p><a href="http://bit.ly/rzAcg6">Read more on WikiMedia's Wiktionary</a></p></li>
      </ul>
      <ul>
        <h3>Is this real?</h3>
        <li><p>Very much so. The data presented here is based on formal NIS Exchange Rate live feed (<a href="http://www.bankisrael.gov.il/currency.xml">source available</a> from the Bank of Israel)</p></li>
        <li><p>The Shnekel Exchange Rate actually makes use of <em>mathematical operands</em> in order to achieve a complete computation of the Shnekel Exchange rates, based on this data.</p></li>
      </ul>
      <ul>
        <h3>Press Room</h3>
        <li><p><a href="http://bit.ly/vipMBs">The Shnekel Exchange on Yedioth Achronot's financial magazine</a> (a daily newspaper in Israel)</p></li>
      </ul>
    </div>
    <div id="content" class="chart exchange-rate">
    <?php
      // loop through rates
      foreach($xml->children() as $child) {
        if (strlen($child->NAME) > 0) {

          $changeRate = strtolower($child->CHANGE) * 2;
          $exchangeRate = strtolower($child->RATE) * 2;
          $countryCode = strtolower($child->CURRENCYCODE);
          $currencyName = strtolower($child->NAME);
          $change = $child->CHANGE;

          // semantic css class for change value
          if ($change == 0) {
            $changeValue = "no-change";
          } else if ($change < 0) {
            $changeValue = "negative";
          } else if ($change > 0) {
            $changeValue = "positive";
          }
     ?>

      <div class="entry <?php echo $currencyName . ' ' . $countryCode; ?>">
        <div class="summary">
          <div class="thumbnail flag"></div>
          <div class="currency-code"><?php echo $countryCode; ?></div>
          <div class="meta">
            <div class="name"><?php echo $currencyName; ?></div>
            <div class="exchange-rate"><?php echo $exchangeRate; ?></div>
            <div class="change-rate<?php echo ' ' . $changeValue; ?>"><?php echo $changeRate; ?></div>
          </div>
        </div>
      </div>
      <?php }
    } ?>

      <div class="entry nis ils">
        <div class="summary">
          <div class="thumbnail flag"></div>
          <div class="currency-code">nis</div>
          <div class="meta">
            <div class="name">shekel</div>
            <div class="exchange-rate">0.5</div>
            <div class="change-rate no-change">0</div>
          </div>
        </div>
      </div>

  </div>
  <div id="footer">
    <p>2008 (cc) a sillyproject by <a href="http://hapinkas.com" target="_blank">Tomer Lichtash</a> &amp; <a href="http://room404.net" target="_blank">Ido Kenan</a></p>
    <a rel="license" href="http://creativecommons.org/licenses/by-sa/3.0/"><img alt="Creative Commons License" style="border-width:0" src="http://i.creativecommons.org/l/by-sa/3.0/88x31.png" /></a>
  </div>
</body>
<script src="js/jquery-1.7.1.min.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
  var _helpText = $("#toggle-help").html();
  $("#toggle-help").click(function(){
    var _view = $("#help").css("display");
    if (_view == "none") {
      $("#help").fadeIn();
      $("#toggle-help").html("close help");
    } else {
      $("#help").slideUp('fast');
      $("#toggle-help").html(_helpText);
    }
  });
</script>
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-26201270-3']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
