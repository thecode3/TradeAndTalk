#TradeAndTalk

The Calendar :
Currency And  Alt Coin  And Crypto Currency And Tokens 

<html style="height: 100%;">
<head>
	<meta charset="utf-8">
	<title>Cryptocurrency Price Chart</title>
	<script src="jquery-1.10.1.min.js"></script>
	<script src="highstock.js"></script>
	<script src="theme.js"></script>
	<style>
	body {
		font-family: Noto Sans, Segoe UI, Helvetica, sans-serif;
		font-size: 92%;
		margin: 0;
		padding: 0;
		height: calc(100% - 70px);
		text-align: center;
	}
	body, #about-inner {
		background: #1E1F21;
	}
	body, .buttons > a, .help-button {
		color: #D6D6D6;
	}
	:focus {
		outline: 0;
	}
	a {
		color: #3885E2;
	}
	p {
		margin-top: 0.7em;
		margin-bottom: 0.7em;
	}
	#loading, .error {
		top: 150px;
		width: 100%;
		position: absolute;
	}
	.error {
		color: red;
	}
	#loading {
		display: none;
	}
	#ChartContainer {
		height: 100%;
	}
	.top {
		margin-top: 8px;
	}
	#relation-selection {
		margin-left: 18px;
	}
	.top2 {
		margin-top: 8px;
	}
	.buttons {
		display: inline-block;
	}
	.buttons > a, .help-button {
		display: inline-block;
		padding-top: 4px;
		padding-bottom: 3px;
		padding-left: 4px;
		padding-right: 4px;
		margin-left: 7px;
		margin-right: 3px;
		border: 1px solid transparent;
		border-radius: 4px;
		transition: all ease-out 0.2s;
		text-decoration: none;
		min-width: 25px;
	}
	.buttons > a:hover {
		border-color: #D6D6D6;
	}
	.buttons > a.active {
		color: #DDDF0D;
		border-color: #DDDF0D;
	}
	#average-button.active {
		color: #5494D3;
		border-color: #5494D3;
	}
	#noDataWarning {
		display: none;
		margin-top: 8px;
		color: red;
		border: 1px solid red;	
		padding-top: 4px;
		padding-bottom: 3px;
		padding-left: 4px;
		padding-right: 4px;	
		border-radius: 4px;
	}
	.help-button {
		margin-left: 35px;
	}
	#average-button {
		margin-left: 10px;
	}
	#about {
		position: absolute;
		height: 100%;
		width: 100%;
		top: 0;
		display: none;
		background: rgba(22,22,22,0.75);
	}
	#about-inner {
		margin-top: 200px;
		display: inline-block;
		border: 1px solid #D6D6D6;
		border-radius: 4px;
		padding: 25px;
		padding-top: 17px;
		padding-bottom: 17px;
		text-align: left;
		line-height: 130%;
		box-shadow: 0px 0px 20px #0C0C0C;
	}
	#about-inner > h1 {
		text-align: center;
		font-size: 1.7em;
		margin: 15px;
		margin-bottom: 25px;
	}
	</style>
</head>
<body onclick="closeHelp()">
	</div>
	<div class="top">
		<div id="chart-selection" class="buttons">Chart: </div>
		<div id="relation-selection" class="buttons">Compared to: </div>
		<a href="#" onclick="showHelp(event); return false" class="help-button">?</a>
	</div>
	<div class="top2">
		<div id="ranges" class="buttons">Range: </div>
		<div class="buttons">
			<a href="#" id="average-button">Average</a>
		</div>
	</div>
	<div id="noDataWarning"></div>
	<div id="loading">
		Loading ...
	</div>
	<div id="ChartContainer"></div>
	<div id="about">
		<div id="about-inner" onclick="showHelp(event);">
			<h1>Cryptocurrency Price Chart</h1>
			<p>Original URL: <a href="https://trustable-code.github.io/cryptocurrency-price-chart/">https://trustable-code.github.io/cryptocurrency-price-chart/</a></p>
			<p>Developer: <a href="https://github.com/trustable-code" target="_blank">Simon Krauter</a></p>
			<p>Repository: <a href="https://github.com/trustable-code/cryptocurrency-price-chart" target="_blank">https://github.com/trustable-code/cryptocurrency-price-chart</a></p>
			<p>Data provider: <a href="https://poloniex.com" target="_blank">https://poloniex.com</a>, <a href="https://coinmarketcap.com" target="_blank">https://coinmarketcap.com</a></p>
			<p>Chart library: <a href="https://www.highcharts.com" target="_blank">https://www.highcharts.com</a></p>
		</div>
</body>

<script>
var currencies = {
	"totalmarketcap": {"shortName": "Total Market Cap.", "longName": "Total Market Capitalization", "showChartButton": true, "compareTo": ["USDT"]},
	"USDT": {"shortName": "$", "longName": "Tether Dollar", "showChartButton": false},
	"BTC": {"shortName": "BTC", "longName": "Bitcoin Core", "marketCapKey": "bitcoin", "showChartButton": true, "compareTo": ["USDT"], "color": "#F4911F"},
	"ETH": {"shortName": "ETH", "longName": "Ethereum", "marketCapKey": "ethereum", "showChartButton": true, "compareTo": ["USDT", "BTC"], "color": "#6187A6"},
	"BCH": {"shortName": "BCH", "longName": "Bitcoin Cash", "marketCapKey": "bitcoin-cash", "showChartButton": true, "compareTo": ["USDT", "BTC"], "color": "#4CC947"},
	"XRP": {"shortName": "XRP", "longName": "Ripple", "marketCapKey": "ripple", "showChartButton": false, "color": "#102B3E"},
	"LTC": {"shortName": "LTC", "longName": "Litecoin", "marketCapKey": "litecoin", "showChartButton": true, "compareTo": ["USDT", "BTC", "XMR"], "color": "#88CBF5"},
	"ADA": {"shortName": "ADA", "longName": "Cardano", "marketCapKey": "", "showChartButton": false, "color": "#0A1C2A"}, // price not available on Poloniex
	"IOTA": {"shortName": "IOTA", "longName": "IOTA", "marketCapKey": "iota", "showChartButton": false, "color": "#041816"}, // price not available on Poloniex
	"DASH": {"shortName": "DASH", "longName": "Dash", "marketCapKey": "dash", "showChartButton": true, "compareTo": ["USDT", "BTC", "XMR"], "color": "#1C75BC"},
	"XEM": {"shortName": "XEM", "longName": "NEM", "marketCapKey": "nem", "showChartButton": false, "color": "#05CCBB"}, // price not available on Poloniex
	"XMR": {"shortName": "XMR", "longName": "Monero", "marketCapKey": "monero", "showChartButton": true, "compareTo": ["USDT", "BTC"], "color": "#E05600"},
	"ETC": {"shortName": "ETC", "longName": "Ethereum Classic", "marketCapKey": "", "showChartButton": false, "compareTo": ["USDT", "BTC", "ETH"], "color": "#669073"}
};
var ranges = {
	"2d": 2,
	"1w": 7,
	"2w": 14,
	"1m": 30,
	"3m": 365 / 4,
	"6m": 365 / 2,
	"1y": 365,
	"2y": 365 * 2,
	"4y": 365 * 4
};
var baseTite = document.title;
var currChart = "";
var currRel = "USDT";
var currPair = "";
var defaultRange = "1y";
var range = defaultRange;
var showAverage = false;
var avgPeriod;
var avgPeriodStr;
var period; // number of seconds
var startTimestamp;
var priceData = {};
var marketShareData = {};

addChartSelectionButton("marketshare", "Market Share");

for(var cur in currencies) {
	if(currencies[cur].showChartButton)
		addChartSelectionButton(cur, currencies[cur].shortName);
}

for(var cur in currencies) {
	var el = document.createElement("A");
	el.id = cur + "Rel";
	el.innerHTML = currencies[cur].shortName;
	document.getElementById("relation-selection").appendChild(el);
}

for(var ran in ranges) {
	var el = document.createElement("A");
	el.id = ran;
	el.innerHTML = ran;
	document.getElementById("ranges").appendChild(el);
}
updateHref();

window.onhashchange = function() {
	updateChart();
}
updateChart();

function updateChart() {
	updateNoDataWarning(null);
	document.title = "(...) " + baseTite;
	if(currChart == "")
		document.getElementById("marketshare").classList.remove("active");
	else
	  document.getElementById(currChart).classList.remove("active");
	document.getElementById(range).classList.remove("active");
	document.getElementById(currRel + "Rel").classList.remove("active");
	var hash = window.location.hash.substr(1);
	var a = hash.split(":");
	var relCurrency = a[0];
	if(a.length >= 2)
		range = a[1];
	if(a.length >= 3 && a[2] == "avg")
		showAverage = true;
	else
		showAverage = false;
	a = relCurrency.split("/");
	if(a.length == 1) {
		currChart = a[0];
	}
	else if(a.length == 2) {
		currChart = a[0];
		currRel = a[1];
	}
	if(!(currChart in currencies))
		currChart = "";
	if(!(currRel in currencies) || isCurrRelDisabled(currRel))
		currRel = "USDT";

	if(currChart == "") {
		document.getElementById("marketshare").classList.add("active");
	} else {
		document.getElementById(currChart).classList.add("active");
		document.getElementById(currRel + "Rel").classList.add("active");
	}
	if(!(range in ranges))
		range = defaultRange;
	document.getElementById(range).classList.add("active");
	if(currChart == "")
		document.getElementById("average-button").style.display = "none";
	else {
		document.getElementById("average-button").style.display = "";
		if(showAverage)
			document.getElementById("average-button").classList.add("active");
		else
			document.getElementById("average-button").classList.remove("active");
	}
	document.getElementById("ChartContainer").innerHTML = "";
	document.getElementById("loading").style.display = "block";
	window.location.href = genHash(currChart, currRel, range, showAverage);
	updateHref();
	if(currChart != "") {
		if(ranges[range] <= 3) {
			period = 60*5; // 5 minutes
			avgPeriod = 24;
			avgPeriodStr = "6h";
		} else if(ranges[range] <= 7) {
			period = 60*15; // 15 minutes
			avgPeriod = 48;
			avgPeriodStr = "12h";
		} else if(ranges[range] <= 14) {
			period = 60*30; // 30 minutes
			avgPeriod = 48;
			avgPeriodStr = "24h";
		} else if(ranges[range] <= 50) {
			period = 60*60*2; // 2 hours
			avgPeriod = 24;
			avgPeriodStr = "2d";
		} else if(ranges[range] <= 100) {
			period = 60*60*2; // 2 hours
			avgPeriod = 48;
			avgPeriodStr = "4d";
		} else if(ranges[range] <= 200) {
			period = 60*60*4; // 4 hours
			avgPeriod = 48;
			avgPeriodStr = "8d";
		} else {
			period = 60*60*24; // 1 day
			avgPeriod = 24;
			avgPeriodStr = "24d";
		}
	}
	setUseUtc(period >= 60*60*24);
	startTimestamp = Math.round((new Date().getTime() / 1000) - ranges[range] * 24 * 60 * 60);
	if(currChart == "")
		loadMarketShareData();
	else if(currChart == "totalmarketcap")
		loadTotalMarketCapHistoryData();
	else
		loadPriceData();
}

function updateNoDataWarning(lastDate) {
	var div = document.getElementById("noDataWarning");
	var minDate = ((new Date()).getTime() - (15*60 + period) * 1000 * 2);
	if(lastDate === null || lastDate > minDate)
		div.style.display = "none";
	else
	{
		div.style.display = "inline-block";
		div.innerHTML = "Warning: No data since " + formatDateTimeIsoLocal(lastDate);
	}
}

function loadPriceData() {
	var url = "https://poloniex.com/public?command=returnChartData&currencyPair=" + currRel + "_" + currChart + "&start=" + startTimestamp + "&end=9999999999999999&period=" + period;
	//~ url = "https://nexunity.org/tools/bypass-sop/?url=" + encodeURIComponent(url);
	console.log(url);
	$.ajax(url).done(function(data) {
		if(data["error"]) {
			showError(data["error"]);
			return;
		}
		priceData = data;
		showChart();
	});
}

function loadTotalMarketCapHistoryData() {
	var endTimestamp = new Date().getTime();
	var url = "https://nexunity.org/tools/bypass-sop/?url=https://graphs2.coinmarketcap.com/global/marketcap-total/" + (startTimestamp * 1000) + "/" + endTimestamp + "/";
	// We have to bypass the Same Origin Policy.
	$.ajax(url).done(function(data) {
		if(data["error"]) {
			showError(data["error"]);
			return;
		}
		priceData = data;
		showChart();
	});
}

function loadMarketShareData() {
	var endTimestamp = new Date().getTime();
	var url = "https://nexunity.org/tools/bypass-sop/?url=https://graphs2.coinmarketcap.com/global/dominance/" + (startTimestamp * 1000) + "/" + endTimestamp + "/";
	// We have to bypass the Same Origin Policy.
	$.ajax(url).done(function(data) {
		if(data["error"]) {
			showError(data["error"]);
			return;
		}
		marketShareData = data;
		showChart();
	});
}

function showError(errorMsg) {
	document.getElementById("ChartContainer").innerHTML = "<div class=\"error\">Could not load data.<br>" + errorMsg + "</div>";
	document.getElementById("loading").style.display = "none";
	document.title = baseTite;	
}

function genHash(cur, currRel, ran, showAverage) {
	var chart;
	if(cur == "")
		chart = "marketshare"
	else
		chart = cur + "/" + currRel
	var hash = "#" + chart + ":" + ran;
	if(showAverage)
		hash = hash + ":avg"
	return hash;
}

function isCurrRelDisabled(cur) {
	return cur == currChart || (currChart != "" && currencies[currChart].compareTo && currencies[currChart].compareTo.indexOf(cur) == -1);
}

function updateHref() {
	var rightCount = 0;
	for(var cur in currencies) {
		var el = document.getElementById(cur);
		if(el)
			el.href = genHash(cur, currRel, range, showAverage);
		el = document.getElementById(cur + "Rel");
		el.href = genHash(currChart, cur, range, showAverage);
		if(isCurrRelDisabled(cur))
		  el.style.display = "none";
		else {
		  el.style.display = "";
		  rightCount++;
		}
	}
	if(currChart != "" && rightCount >= 2)
		document.getElementById("relation-selection").style.display = "";
	else
		document.getElementById("relation-selection").style.display = "none";
	for(var ran in ranges) {
		document.getElementById(ran).href = genHash(currChart, currRel, ran, showAverage);
	}
	document.getElementById("average-button").href = genHash(currChart, currRel, range, !showAverage);
	document.getElementById("marketshare").href = genHash("", currRel, range);
}

function calculateAverage(rows, period) {
  var avgRows = [];
  for(var i = 0; i < rows.length; i++) {
		var key = rows[i][0];
		var val = rows[i][1];
		var count = 1;
		for(var j = i - Math.round(period/2); j < i; j++) {
			if(j > 0) {
				val = val + rows[j][1];
				count++;
			}
		}
		for(var j = i + Math.round(period/2); j > i; j--) {
			if(j < rows.length) {
				val = val + rows[j][1];
				count++;
			}
		}
		val = val / count;
		avgRows.push([key, val]);
	}
	return avgRows;
}

function getUserfulNumberOfDecimals(rows) {
	if(rows.length == 0)
		return 0;
	var minValue = rows[0][1];
	var maxValue = rows[0][1];
	for(var i = 1; i < rows.length; i++)
	{
		var val = rows[i][1];
		if(minValue > val)
			minValue = val;
		if(maxValue < val)
			maxValue = val;
	}
	var diff = maxValue - minValue;
	if(diff == 0)
		return 0;
	var decimals = 0;
	while(diff < 50) {
		diff = diff * 10;
		decimals++;
	}
	return decimals;
}

function showChart() {
	if(currChart == "")
		showChartMarketShare();
	else
		showChartCurrency();

	document.getElementById("loading").style.display = "none";
}

function setUseUtc(useUtc) {
	Highcharts.setOptions({
		global: {
			useUTC: useUtc
		}
	});
}

function getBaseChartData() {
	var xAxisFormat;
	if(ranges[range] <= 7)
		xAxisFormat = "{value:%a %H:%M}";
	else if(ranges[range] <= 365)
		xAxisFormat = "{value:%b %e}";
	else
		xAxisFormat = "{value:%Y %b}";

	var chartData = {
		chart: {
			renderTo: "ChartContainer"
		},
		title: {
			y: 30
		},
		subtitle: {
		},
		xAxis: {
			type: "datetime",
			labels: {
				format: xAxisFormat
			}
		},
		yAxis: {
			labels: { },
			crosshair: true
		},
		tooltip: { },
		plotOptions: {
			line: {
				animation: false,
				marker: {
					enabled: false
				}
			},
			area: { }
		},
		navigator: {
			enabled: false
		},
		rangeSelector: {
			enabled: false
		},
		scrollbar: {
			enabled: false
		},
		credits: {
			enabled: false
		},
		legend: {
			verticalAlign: 'top',
			y: 65,
			margin: 10
		},
	};
	if(period < 60*60*24)
		chartData.tooltip.xDateFormat = "%a, %Y-%m-%d %H:%M";
	else
		chartData.tooltip.xDateFormat = "%a, %Y-%m-%d";

	return chartData;
}

function showChartMarketShare() {
	var keys = [];
	for(var i in marketShareData) {
		keys.push([i, marketShareData[i][marketShareData[i].length - 1][1]])
	}
	keys.sort(function(a, b) {
		if(a[1] > b[1])
			return -1;
		if(a[1] < b[1])
			return 1;
		return 0;
	});
	
	var chartData = getBaseChartData();
	chartData.chart.type = "area";
	chartData.plotOptions.area.stacking = "percent";
	chartData.yAxis.labels.format = "{value:.0f} %";
	chartData.yAxis.offset = 35; // width in pixels
	chartData.tooltip.pointFormat = "<span style=\"color:{series.color}\">\u25CF</span>{series.name}: {point.y:.1f} %<br>";
	chartData.legend.enabled = true;
	chartData.title.text = "Market Share";
	document.title = chartData.title.text + " – " + baseTite;
	chartData.subtitle.text = "";
	
	var count = 0;
	for(var i in keys) {
		var key = keys[i][0];
		if(key == "others")
			continue;
		var shortName = key;
		for(var curr in currencies) {
			if(currencies[curr].marketCapKey == key) {
				shortName = currencies[curr].shortName;
				break;
			}
		}
		if(chartData.subtitle.text != "")
			chartData.subtitle.text = chartData.subtitle.text + " | ";
		var value = marketShareData[key][marketShareData[key].length - 1][1];
		chartData.subtitle.text = chartData.subtitle.text + shortName + ": <span style=\"color:white;\">" + formatFloat(value, 1) + "</span> %";
		count++;
		if(count == 3)
			break;
	}	
	
	var chart = new Highcharts.StockChart(chartData);
	var otherSeries = {
		name: "Other",
		data: [],
		color: "#444444"
	}
	for(var i in keys) {
		var key = keys[i][0];
		var found = false;
		for(var curr in currencies) {
			if(currencies[curr].marketCapKey == key) {
				found = true;
				var series = {
					name: currencies[curr].shortName,
					data: marketShareData[key],
					color: currencies[curr].color
				}				
				chart.addSeries(series);
				break;
			}
		}
		if(!found) {
			for(var j in marketShareData[key]) {
				if(otherSeries.data[j] == undefined)
					otherSeries.data[j] = marketShareData[key][j];
				else
					otherSeries.data[j][1] = otherSeries.data[j][1] + marketShareData[key][j][1];
			}
		}
	}
	chart.addSeries(otherSeries);
}

function showChartCurrency() {
	// prepare data:
	var series = {
		name: "",
		data: []
	}

	var docTitleFirstPart;
	var lastValueStr;
	var decimals;
	if(currChart == "totalmarketcap") {
		series.name = currencies[currRel].shortName;
		priceData = priceData.market_cap_by_available_supply;
		for(var i in priceData) {
			series.data.push([priceData[i][0], priceData[i][1]]);
		}
		decimals = getUserfulNumberOfDecimals(series.data);
		updateNoDataWarning(priceData[priceData.length - 1][0] * 1000);
		var lastValue = priceData[priceData.length - 1][1];
		lastValueStr = formatBigNumberWithUnit(lastValue, series.name);
		docTitleFirstPart = lastValueStr + " " + currencies[currChart].shortName;
	} else {
		series.name = currencies[currRel].shortName + "/" + currencies[currChart].shortName;
		for(var i in priceData) {
			series.data.push([priceData[i]["date"] * 1000, priceData[i].weightedAverage]);
		}
		decimals = getUserfulNumberOfDecimals(series.data);
		updateNoDataWarning(priceData[priceData.length - 1]["date"] * 1000);
		var lastValue = priceData[priceData.length - 1]["close"];
		lastValueStr = formatBigNumberWithUnit(lastValue, series.name);
		docTitleFirstPart = lastValueStr;
	}

	document.title = docTitleFirstPart + " – " + baseTite;
	var chartData = getBaseChartData();
	chartData.type = "line";
	chartData.yAxis.type = "logarithmic";
	chartData.yAxis.labels.format = "{value:." + Math.max(decimals - 1, 0) + "f} " + series.name;
	chartData.yAxis.offset = 80; // width in pixels
	chartData.tooltip.pointFormat = "<span style=\"color:{series.color}\">\u25CF</span> {point.y:." + decimals + "f} {series.name}<br>";

	chartData.title.text = currencies[currChart].longName;
	if(currRel != "USDT")
		chartData.title.text = chartData.title.text + " / " + currencies[currRel].longName;

	chartData.subtitle.text = "latest: " + "<span style=\"color:white;\">" + lastValueStr + "</span>";

	// Add average series:
	var avgSeries;
	if(showAverage) {
		avgSeries = {
			name: series.name + " (" + avgPeriodStr + " average)",
			data: calculateAverage(series.data, avgPeriod),
			lineWidth: 1.5
		}
		var avgLastValue = avgSeries.data[avgSeries.data.length - 1][1];
		var avgLastValueStr = "<span style=\"color:white;\">" + formatBigNumberWithUnit(avgLastValue, series.name) + "</span>";
		chartData.subtitle.text = avgPeriodStr + " average: " + avgLastValueStr + " | " + chartData.subtitle.text;
	}

	var chart = new Highcharts.StockChart(chartData);
	chart.addSeries(series);
	if(showAverage)
		chart.addSeries(avgSeries);
}

function showHelp(event) {
	document.getElementById("about").style.display = "block";
	event.stopPropagation();
}
function closeHelp() {
	document.getElementById("about").style.display = "";
}

function getURLParamValue(name) {
	var a = RegExp(name + "=(.+?)(&|$)").exec(location.search);
	if(a == null)
		return null
  return decodeURI(a[1]);
}

function formatFloat(value, decimals) {
	var f = Math.pow(10, decimals);
	return Math.round(value * f) / f;
}

function formatBigNumberWithUnit(value, unit) {
	if(value < 500) {
		var temp = value;
		var decimals = 0;
		while(temp < 50) {
			temp = temp * 10;
			decimals++;
		}
		return formatFloat(value, decimals) + " " + unit;
	}
	var n = 0;
	while(value >= 100000 && n < 4) {
		value = value / 1000;
		n++;
	}
	if(n == 0)
		return formatFloat(value, 0) + " " + unit;
	if(n == 1)
		return formatFloat(value, 0) + " k" + unit;
	if(n == 2)
		return formatFloat(value, 0) + " M" + unit;
	if(n == 3)
		return formatFloat(value, 0) + " G" + unit;
	return formatFloat(value, 0) + " T" + unit;
}

function addChartSelectionButton(id, title) {
	var el = document.createElement("A");
	el.id = id;
	el.innerHTML = title;
	document.getElementById("chart-selection").appendChild(el);
}

function formatDateTimeIsoLocal(timestamp) {
	//~ var iso = new Date(timestamp).toISOString()
	//~ return iso.substr(0, 10) + " " + iso.substr(11, 5);
	var d = new Date(timestamp);
	//~ return d.toTimeString();
	var year = d.getFullYear();
	var month = d.getMonth() + 1;
	var day = d.getDate();
	var hour = d.getHours();
	var minute = d.getMinutes();
	return year + '-' + ('0' + month).slice(-2) + '-' + ('0' + day).slice(-2) + ' ' + ('0' + hour).slice(-2) + ':' + ('0' + minute).slice(-2);
}

</script>
</html>

<!DOCTYPE html>
<html>
<body>

<h1>The audio loop attribute</h1>

<p>Click on the play button to play a sound:</p>

<audio controls autoplay loop>
  <source src="Blue1.mp3" type="audio/mp3">
  <source src="Blue2.mp3" type="audio/mp3">
  Your browser does not support the audio element.
</audio>

</body>
</html>
