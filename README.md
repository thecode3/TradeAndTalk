<!-- Display the countdown timer in an element -->
<p id="demo"></p>
<script>
// Set the date we're counting down to
var countDownDate = new Date("Oct 13, 2021 24:00:00").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();

  // Find the distance between now and the count down date
  var distance = countDownDate - now;

  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // Display the result in the element with id="demo"
  document.getElementById("demo").innerHTML = days + "d " + hours + "h "
  + minutes + "m " + seconds + "s ";

  // If the count down is finished, write some text
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("demo").innerHTML = "EXPIRED";
  }
}, 1000);
</script>
<html>
	<body>
		<audio controls autoplay>
			<source src="https://github.com/thecode3/TradeAndTalk/blob/main/src/Blue1.mp3">
			</audio>
		<head>
			<style>
				body {
				background-image: url(https://github.com/thecode3/TradeAndTalk/blob/main/TradeAndTalk%20Photos/TradeAndTalk%20Main.jpg?raw=true);
				background-repeat: no-repeat;
				background-attachment: fixed; 
				background-size: 100% 100%;
				}
			</style>
			<head>
				<body>
					<html>
						<h2>Trade And Talk Community</h2>
						<a href="https://www.mql5.com/en/users/osamaahmed/">Visit MetaQuotes Ltd.</a>
						<body>
							<html>
								<h1 style="color:16755C;text-align:center;">Trade And Talk Community©®™ 2021</h1>
								<p style="color:16755C;"> The Calendar : Currency And Alt Coin And Crypto Currency And Tokens <p>
								<p>
								<script type="text/javascript" src="https://c.mql5.com/js/widgets/navigator/widget.js"></script>
<div id="navigatorWidget"></div>
<script type="text/javascript">
    new navigatorWidget({"type":"overview","filter":"","style":"tiles","period":"D1","width":500,"height":500});
</script>
								<p>
									<script type="text/javascript" src="https://c.mql5.com/js/widgets/navigator/widget.js"></script>
<div id="navigatorWidget"></div>
<script type="text/javascript">
    new navigatorWidget({"type":"matrix","filter":"","width":500,"height":500});
</script>
								<p>
								<script type="text/javascript" src="https://c.mql5.com/js/widgets/navigator/widget.js"></script>
<div id="navigatorWidget"></div>
<script type="text/javascript">
    new navigatorWidget({"type":"converter","filter":"USDGBP","datepicker":true,"details":true,"extras":"USD,EUR,GBP,JPY,CHF,CNH,CAD,NOK,AUD,SGD,NZD,SEK,RUB,ZAR,MXN,PLN,HKD","width":500,"height":500});
</script>
								<p>
<h2 style="color:16755C;text-align:center;"> <p>Trade And Talk Community©®™ 2021 <br> All legal rights are held by© 2021 GitHub, Inc.</h2>
								<head>
									<body>
										<html>
