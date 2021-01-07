<html lang="ja">
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="css/post.css">
<link rel="stylesheet" href="css/reset.css">
<link rel="stylesheet" href="css/sanitize.css">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<title>アンケート記入画面</title>
</head>
<body>
	<div class="wrapper">
		<p class="main">
			<img src="img/title_a.png" alt="タイトル">
		</p>
		<form action="write.php" method="post">
			<div class="name nyuryoku">
				<input type="text" name="name" placeholder="お名前">
				<i class="fa fa-user fa-lg fa-fw" aria-hidden="true"></i>
			</div>
			<div class="email nyuryoku">
				<input type="text" name="mail" placeholder="Email">
				<i class="fa fa-envelope fa-lg fa-fw" aria-hidden="true"></i>

			</div>
			<div class="gender title2">
				<p class="lead2">性別</p>
				<input type="radio" name="gender" value="男性" id="man" class="gender-switch radiohide"><label for="man" class="gender-label blue">男性</label>
				<input type="radio" name="gender" value="女性" id="woman" class="gender-switch radiohide"><label for="woman" class="gender-label pink">女性</label>
				<input type="radio" name="gender" value="未回答" id="unanswered" class="gender-switch radiohide"><label for="unanswered" class="gender-label orange">未回答</label>
			</div>
			<div class="age title2">
				<p class="lead2">年代</p>
				<input type="radio" name="age" value="十代以下" id="10" class="age-switch radiohide"><label for="10" class="age-label">10代以下</label>
				<input type="radio" name="age" value="二十代" id="20" class="age-switch radiohide"><label for="20" class="age-label">20代</label>
				<input type="radio" name="age" value="三十代" id="30" class="age-switch radiohide"><label for="30" class="age-label">30代</label>
				<input type="radio" name="age" value="四十代" id="40" class="age-switch radiohide"><label for="40" class="age-label">40代</label>
				<input type="radio" name="age" value="五十代" id="50" class="age-switch radiohide"><label for="50" class="age-label">50代</label>
				<input type="radio" name="age" value="六十代以上" id="60" class="age-switch radiohide"><label for="60" class="age-label">60代以上</label>
			</div>
			<p class="lead">お兄ちゃんにするなら</p>
			<div class="ani title">
				<input type="radio" name="ani" value="悲鳴嶼行冥" id="himejima" class="ani-switch radiohide">
				<label for="himejima" class="ani-label">
					<p class="namae">悲鳴嶼行冥</p>
					<img src="img/gyomei.png" alt="悲鳴嶼行冥">
				</label>
				<input type="radio" name="ani" value="冨岡義勇" id="tomioka" class="ani-switch radiohide">
				<label for="tomioka" class="ani-label">
					<p class="namae">冨岡義勇</p>
					<img src="img/giyu.png" alt="冨岡義勇">
				</label>
				<input type="radio" name="ani" value="不死川実弥" id="shinazugawa" class="ani-switch radiohide">
				<label for="shinazugawa" class="ani-label">
					<p class="namae">不死川実弥</p>
					<img src="img/sanemi.png" alt="不死川実弥">
				</label>
				<input type="radio" name="ani" value="煉獄杏寿郎" id="rengoku" class="ani-switch radiohide">
				<label for="rengoku" class="ani-label">
					<p class="namae">煉獄杏寿郎</p>
					<img src="img/kyojuro.png" alt="煉獄杏寿郎">
				</label>
				<input type="radio" name="ani" value="竈門炭治郎" id="tanjiro" class="ani-switch radiohide">
				<label for="tanjiro" class="ani-label">
					<p class="namae">竈門炭治郎</p>
					<img src="img/tanjiro.png" alt="竈門炭治郎">
				</label>
			</div>
			<p class="lead">弟にするなら</p>
			<div class="otouto title">
				<input type="radio" name="otouto" value="我妻善逸" id="zenitsu" class="otouto-switch radiohide">
				<label for="zenitsu" class="otouto-label">
					<p class="namae">我妻善逸</p>
					<img src="img/zenitsu.png" alt="我妻善逸">
				</label>
				<input type="radio" name="otouto" value="嘴平伊之助" id="inosuke" class="otouto-switch radiohide">
				<label for="inosuke" class="otouto-label">
					<p class="namae">嘴平伊之助</p>
					<img src="img/inosuke.png" alt="嘴平伊之助">
				</label>
				<input type="radio" name="otouto" value="時透無一郎" id="muichiro" class="otouto-switch radiohide">
				<label for="muichiro" class="otouto-label">
					<p class="namae">時透無一郎</p>
					<img src="img/muichiro.png" alt="時透無一郎">
				</label>
				<input type="radio" name="otouto" value="不死川玄弥" id="genya" class="otouto-switch radiohide">
				<label for="genya" class="otouto-label">
					<p class="namae">不死川玄弥</p>
					<img src="img/genya.png" alt="不死川玄弥">
				</label>
				<input type="radio" name="otouto" value="伊黒小芭内" id="obanai" class="otouto-switch radiohide">
				<label for="obanai" class="otouto-label">
					<p class="namae">伊黒小芭内</p>
					<img src="img/obanai.png" alt="伊黒小芭内">
				</label>
			</div>
			<p class="lead">お姉ちゃんにするなら</p>
			<div class="ane title"> 
				<input type="radio" name="ane" value="甘露寺蜜璃" id="mitsuri" class="ane-switch radiohide">
				<label for="mitsuri" class="ane-label">
					<p class="namae">甘露寺蜜璃</p>
					<img src="img/mitsuri.png" alt="甘露寺蜜璃">
				</label>
				<input type="radio" name="ane" value="胡蝶しのぶ" id="shinobu" class="ane-switch radiohide">
				<label for="shinobu" class="ane-label">
					<p class="namae">胡蝶しのぶ</p>
					<img src="img/shinobu.png" alt="胡蝶しのぶ">
				</label>
				<input type="radio" name="ane" value="珠世" id="tamayo" class="ane-switch radiohide">
				<label for="tamayo" class="ane-label">
					<p class="namae">珠世</p>
					<img src="img/tamayo.png" alt="珠世">
				</label>
				<input type="radio" name="ane" value="神崎アオイ" id="aoi" class="ane-switch radiohide">
				<label for="aoi" class="ane-label">
					<p class="namae">神崎アオイ</p>
					<img src="img/aoi.png" alt="神崎アオイ">
				</label>
				<input type="radio" name="ane" value="累の姉" id="nezuko" class="ane-switch radiohide">
				<label for="nezuko" class="ane-label">
					<p class="namae">竈門禰豆子</p>
					<img src="img/nezuko.png" alt="竈門禰豆子">
				</label>
			</div>
			<p class="lead">妹にするなら</p>
			<div class="imouto title">
				<input type="radio" name="imouto" value="竈門禰豆子(妹)" id="nezuko2" class="imouto-switch radiohide">
				<label for="nezuko2" class="imouto-label">
					<p class="namae">竈門禰豆子</p>
					<img src="img/nezuko.png" alt="竈門禰豆子2">
				</label>
				<input type="radio" name="imouto" value="栗花落カナヲ" id="kanao" class="imouto-switch radiohide">
				<label for="kanao" class="imouto-label">
					<p class="namae">栗花落カナヲ</p>
					<img src="img/kanao.png" alt="栗花落カナヲ">
				</label>
				<input type="radio" name="imouto" value="寺内きよ" id="kiyo" class="imouto-switch radiohide">
				<label for="kiyo" class="imouto-label">
					<p class="namae">寺内きよ</p>
					<img src="img/kiyo.png" alt="寺内きよ">
				</label>
				<input type="radio" name="imouto" value="中原すみ" id="sumi" class="imouto-switch radiohide">
				<label for="sumi" class="imouto-label">
					<p class="namae">中原すみ</p>
					<img src="img/sumi.png" alt="中原すみ">
				</label>
				<input type="radio" name="imouto" value="高田なほ" id="naho" class="imouto-switch radiohide">
				<label for="naho" class="imouto-label">
					<p class="namae">高田なほ</p>
					<img src="img/naho.png" alt="高田なほ">
				</label>
			</div>
			<p class="lead">おすすめ度</p>
			<div class="osusume title">
				<span class="star-rating">
					<input type="radio" name="rating" value="★"><i></i>
					<input type="radio" name="rating" value="★★"><i></i>
					<input type="radio" name="rating" value="★★★"><i></i>
					<input type="radio" name="rating" value="★★★★"><i></i>
					<input type="radio" name="rating" value="★★★★★"><i></i>
				</span>
			</div>
			<div class="submit">
				<input type="submit" value="送信" class="btn">
			</div>
		</form>
	</div>
	<footer class="ftr">created by Takuchan of G'sACADEMIY UNIT_SAPPORO_DEV1</footer>
</body>
</html>