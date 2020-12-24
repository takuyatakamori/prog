function $(id) {
  return document.getElementById(id);
}

/**
 * ドロップイベント発火時に動く関数
 * 画像ファイルがドロップされたら1枚だけブラウザに読み込む
 * @param {event} e - イベントで取得した内容
 */
function handleDropAction(e) {
  // ブラウザデフォルトのイベント処理を停止
  e.preventDefault();
  e.stopPropagation();

  // ドラッグ&ドロップでブラウザに渡した画像の取得
  const droppedFiles = e.dataTransfer.files;

  // ファイルが1つ以上あれば処理開始
  if (droppedFiles.length > 0) {
    const ajaxData = new FormData();
    const file = droppedFiles[0];    // 1つ目のファイルだけ使う。あとは無視

    // 指定のファイルタイプ（画像）以外の場合はアラートを出して処理を中断
    const permitType = ["image/jpeg", "image/png", "image/gif"];
    if (file && permitType.indexOf(file.type) === -1) {
        alert("この形式のファイルはアップロードできません");
        return;
    }

    /*
     * ファイルのアップロード
     */
    ajaxData.append("file", file);  // アップロードデータを準備

    // 今開いているページにドラッグ&ドロップしたファイルを POST する 
    fetch("index.html", {
      "method": "POST",
      "body": ajaxData
    })
    .then(result => {
      // POST されたファイルを読み込み
      const fr = new FileReader();
      fr.onload = () => {
        // 読み込みが完了したとき

        // 読み込んだ画像をimgタグにしてブラウザのid=imgのdivタグ内に追加
        const image = new Image();
        image.src = fr.result;
        $("img").append(image);

        // 顔認識 API 呼び出し
        // 読み込んだファイルのDataURLを渡している
        processImage(fr.result);
      };
      // DataURL形式でドラッグ&ドロップファイルされたファイルを読み込む
      fr.readAsDataURL(file);
    })
    .catch(err => {
      // ファイルの読み込みに失敗したとき
      console.log(err);  // エラー内容をコンソールに出力
    });
  }
}

/**
 * 顔認識APIにドラッグ&ドロップした画像を投げる
 * @param {string} dataUrl - ドラッグ&ドロップしたファイルを表す DataURL
 */
function processImage(dataUrl) {
  // APIキーとエンドポイントはAzureポータルで自分で発行したものを使ってね
  const subscriptionKey = "0ceed3809251496d92f0179b7aa36d97";
  const uriBase = "https://takuyatakamori.cognitiveservices.azure.com/face/v1.0/detect";

  // APIの引数をGETパラメータで渡す
  // とりあえずアリアリで
  const params = 
      "returnFaceId=true" +
      "&returnFaceLandmarks=false"+
      "&returnFaceAttributes=" +
          "age,gender,headPose,smile,facialHair,glasses,emotion," +
          "hair,makeup,occlusion,accessories,blur,exposure,noise";

  // DataURL形式の画像データをバイナリを扱えるデータ形式blobに変換する
  // この辺はコピペなので詳しくは調べてね
  const type = dataUrl.slice(5,dataUrl.indexOf(";"));  // DataURLからファイルタイプを取得
  const bin = atob(dataUrl.split(',')[1]);
  const buffer = new Uint8Array(bin.length);
  for (var i = 0; i < bin.length; i++) {
      buffer[i] = bin.charCodeAt(i);
  }
  const blob = new Blob([buffer.buffer], { type: type });

  /*
   * ドラッグ&ドロップした画像とAPIパラメータでFace APIを呼び出す
   */
  // バイナリデータなのでoctet-streamで。
  // APIキーは添えるだけ
  fetch(uriBase + "?" + params, {
    headers: {
      "Content-Type": "application/octet-stream",
      "Ocp-Apim-Subscription-Key": subscriptionKey
    },
    method: "POST",
    body: blob
  })
  .then(response => {
    // なにがしかの反応がAPIからあったらjsonだと思って読んでみる
    return response.json();
  })
  .then(jso => {
    // json()関数が成功したらJavaScript Objectが返ってくる罠があるのでjsonにデコードする
    // id=outputタグの内容を帰ってきたjsonで上書き
    $("output").innerText = JSON.stringify(jso);
  })
  .catch(err => {
    // APIの呼び出しに失敗したとき
    console.log(err);  // エラー内容をコンソールに出力
  });
};

/**
 * DOM読み込み完了時の動作
 * @param {function} loaded - DOM読み込み完了時に実行するコールバック関数
 */
function ready(loaded) {
  if (["interactive", "complete"].includes(document.readyState)) {
    loaded();
  } else {
    document.addEventListener("DOMContentLoaded", loaded);
  }
}

// DOMが読み込み完了したあとでDOMにイベントハンドラをセットする
ready(() => {
  const dropArea = $("img");

  // ドロップ領域のブラウザデフォルトのイベント処理を停止
  ["drag", "dragstart", "dragend", "dragover", "dragenter", "dragleave"].forEach(event => {
    dropArea.addEventListener(event, (e) => {
      e.preventDefault();
      e.stopPropagation();
    });
  });

  // ドロップ領域のドロップイベント発生時に呼び出される関数を設定
  dropArea.addEventListener("drop", handleDropAction);
});