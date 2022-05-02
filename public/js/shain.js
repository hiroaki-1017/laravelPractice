function cancel() {
    if(window.confirm("登録処理を中止して一覧画面に戻ります。よろしいですか？")) {
        location.href="mst_shain";
    }
}

function returnPage() {
    history.back();
}