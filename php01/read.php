<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/read.css?v=2">
	<!-- <link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="css/sanitize.css"> -->
  <title>アンケート結果</title>
</head>
<body>
	<p class="main">
		<img src="img/title_r.png" alt="タイトル">
	</p>
<?php
// $filename = 'data/data.txt';
// $content = file_get_contents($filename);
// $strs = explode(",",$content);
// var_dump($strs);
// echo $strs;

// #1 ファイルの読み込み
$f = fopen("data/data.txt", "r");

// #2 テーブルのHTMLを生成
echo '<table>
        <tr>
            <th>名前</th>
            <th>メールアドレス</th>
            <th>性別</th>
            <th>年代</th>
            <th>お兄ちゃんにするなら</th>
            <th>弟にするなら</th>
            <th>お姉ちゃんにするなら</th>
						<th>妹にするなら</th>
						<th>おすすめ度</th>
						<th></th>
        </tr>';

// #3 csvのデータを配列に変換し、HTMLに埋め込んでいる
while($line = fgetcsv($f)) {
    echo "<tr>";
    for ($i=0;$i<count($line);$i++) {
        echo "<td>" . $line[$i] . "</td>";
    }
    echo "</tr>";
}
echo "</table>";

// #4 ファイルを閉じる
fclose($f);


$filename = 'data/data.txt';
$content = file_get_contents($filename);
$strs = explode(",",$content);
$output = array_count_values($strs);
// print_r($output);
?>

<div class="wrapper">
	<div class="chart">
		<canvas id="myPieChart" width="500" height="400"></canvas>
	</div>
	<div class="chart">
		<canvas id="myPieChart2" width="500" height="400"></canvas>
	</div>
</div>
<div class="wrapper">
	<div class="chart">
		<canvas id="myPieChart3" width="500" height="400"></canvas>
	</div>
	<div class="chart">
		<canvas id="myPieChart4" width="500" height="400"></canvas>
	</div>
	</div>
<div class="wrapper">
	<div class="chart">
		<canvas id="myPieChart5" width="500" height="400"></canvas>
	</div>
	<div class="chart">
		<canvas id="myPieChart6" width="500" height="400"></canvas>
	</div>
	</div>
<div class="wrapper">
	<div class="chart">
		<canvas id="myBarChart" width="1000" height="600"></canvas>
	</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js"></script>
<script>
const ctx = document.getElementById("myPieChart");
const myPieChart = new Chart(ctx, {
	type: 'pie',
	data: {
		labels: ["10代以下", "20代", "30代", "40代", "50代", "60代以上"],
		datasets: [{
			backgroundColor: [
				"#5D9CEC",
				"#48CFAD",
				"#FFCE54",
				"#ED5565",
				"#AC92EC",
				"#CCD1D9"
			],
			data: [<?php echo $output[十代以下]; ?>, <?php echo $output[二十代]; ?>, <?php echo $output[三十代]; ?>, <?php echo $output[四十代]; ?>, <?php echo $output["五十代"]; ?>, <?php echo $output["六十代以上"]; ?>]
			}]
	},
	options: {
		title: {
			display: true,
			text: '年代'
		}
	}
});

const ctx2 = document.getElementById("myPieChart2");
const myPieChart2 = new Chart(ctx2, {
	type: 'pie',
	data: {
		labels: ["男性", "女性", "未回答"],
		datasets: [{
			backgroundColor: [
				"#5D9CEC",
				"#48CFAD",
				"#FFCE54"
			],
			data: [<?php echo $output[男性]; ?>, <?php echo $output[女性]; ?>, <?php echo $output[未回答]; ?>]
			}]
	},
	options: {
		title: {
			display: true,
			text: '性別'
		}
	}
});

const ctx3 = document.getElementById("myPieChart3");
const myPieChart3 = new Chart(ctx3, {
	type: 'pie',
	data: {
		labels: ["悲鳴嶼行冥", "冨岡義勇", "不死川実弥", "煉獄杏寿郎", "竈門炭治郎"],
		datasets: [{
			backgroundColor: [
				"#5D9CEC",
				"#48CFAD",
				"#FFCE54",
				"#ED5565",
				"#AC92EC",
				"#CCD1D9"
			],
			data: [<?php echo $output[悲鳴嶼行冥]; ?>, <?php echo $output[冨岡義勇]; ?>, <?php echo $output[不死川実弥]; ?>, <?php echo $output[煉獄杏寿郎]; ?>, <?php echo $output[竈門炭治郎]; ?>]
			}]
	},
	options: {
		title: {
			display: true,
			text: 'お兄ちゃんにするなら'
		}
	}
});

const ctx4 = document.getElementById("myPieChart4");
const myPieChart4 = new Chart(ctx4, {
	type: 'pie',
	data: {
		labels: ["我妻善逸", "嘴平伊之助", "時透無一郎", "不死川玄弥", "伊黒小芭内"],
		datasets: [{
			backgroundColor: [
				"#5D9CEC",
				"#48CFAD",
				"#FFCE54",
				"#ED5565",
				"#AC92EC",
				"#CCD1D9"
			],
			data: [<?php echo $output[我妻善逸]; ?>, <?php echo $output[嘴平伊之助]; ?>, <?php echo $output[時透無一郎]; ?>, <?php echo $output[不死川玄弥]; ?>, <?php echo $output[伊黒小芭内]; ?>]
			}]
	},
	options: {
		title: {
			display: true,
			text: '弟にするなら'
		}
	}
});

const ctx5 = document.getElementById("myPieChart5");
const myPieChart5 = new Chart(ctx5, {
	type: 'pie',
	data: {
		labels: ["甘露寺蜜璃", "胡蝶しのぶ", "珠世", "神崎アオイ", "竈門禰豆子"],
		datasets: [{
			backgroundColor: [
				"#5D9CEC",
				"#48CFAD",
				"#FFCE54",
				"#ED5565",
				"#AC92EC",
				"#CCD1D9"
			],
			data: [<?php echo $output[甘露寺蜜璃]; ?>, <?php echo $output[胡蝶しのぶ]; ?>, <?php echo $output[珠世]; ?>, <?php echo $output[神崎アオイ]; ?>, <?php echo $output[竈門禰豆子]; ?>]
			}]
	},
	options: {
		title: {
			display: true,
			text: 'お姉ちゃんにするなら'
		}
	}
});

const ctx6 = document.getElementById("myPieChart6");
const myPieChart6 = new Chart(ctx6, {
	type: 'pie',
	data: {
		labels: ["竈門禰豆子", "栗花落カナヲ", "寺内きよ", "中原すみ", "高田なほ"],
		datasets: [{
			backgroundColor: [
				"#5D9CEC",
				"#48CFAD",
				"#FFCE54",
				"#ED5565",
				"#AC92EC",
				"#CCD1D9"
			],
			data: [<?php echo $output["竈門禰豆子(妹)"]; ?>, <?php echo $output[栗花落カナヲ]; ?>, <?php echo $output[寺内きよ]; ?>, <?php echo $output[中原すみ]; ?>, <?php echo $output[高田なほ]; ?>]
			}]
	},
	options: {
		title: {
			display: true,
			text: '妹にするなら'
		}
	}
});

var ctx7 = document.getElementById("myBarChart");
  var myBarChart = new Chart(ctx7, {
    type: 'bar',
    data: {
      labels: ['★', '★★', '★★★', '★★★★', '★★★★★'],
      datasets: [
        {
          label: '★の数',
          data: [<?php echo $output[★]; ?>,<?php echo $output[★★]; ?>,<?php echo $output[★★★]; ?>,<?php echo $output[★★★★]; ?>,<?php echo $output[★★★★★]; ?>],
          backgroundColor: "rgba(219,39,91,0.5)"
				}
				// ,{
        //   label: 'B店 来客数',
        //   data: [55, 45, 73, 75, 41, 45, 58],
        //   backgroundColor: "rgba(130,201,169,0.5)"
        // },{
        //   label: 'C店 来客数',
        //   data: [33, 45, 62, 55, 31, 45, 38],
        //   backgroundColor: "rgba(255,183,76,0.5)"
        // }
      ]
    },
    options: {
      title: {
        display: true,
        text: 'おすすめ度'
      },
      scales: {
        yAxes: [{
          ticks: {
            suggestedMax: 5,
            suggestedMin: 0,
            stepSize: 1,
            callback: function(value, index, values){
              return  value +  '個'
            }
          }
        }]
      },
    }
  });
</script>
</body>
</html>