function registCancel() {
	if (window.confirm("登録処理を中断して一覧に戻ります。よろしいですか？")) {
		location.href = "hatchu";
	}
}

var mdl1;
var mdl2;

$(function () {
	mdl1 = $('.modal1').modaal({ type: 'ajax' });
	mdl2 = $('.modal2').modaal({ type: 'ajax' });
});

function searchTorihikisaki() {
	let arrData = {
		"torihikisaki": $('#torihikisaki').val(),
		"torihikisaki_kbn": $('#torihikisaki_kbn').val(),
		"_token": $('meta[name="csrf-token"]').attr('content')
	}

	$.post(
		"torihikisakigetpage",
		arrData,
		function (data) {
			if (data == 0) {
				$('.pagination').twbsPagination('destroy');
			}
			$('.pagination').twbsPagination('destroy');
			$('.pagination').twbsPagination({
				totalPages: data,
				visiblePages: 5,
				onPageClick: function (event, page) {
					arrData["page"] = page;
					torihikisakiGetList(arrData);
				}
			});
		}
	);
}

function searchTorihikisaki() {
	let arrData = {
		"torihikisaki": $('#torihikisaki').val(),
		"torihikisaki_kbn": $('#torihikisaki_kbn').val(),
		"_token": $('meta[name="csrf-token"]').attr('content')
	}

	$.post(
		"torihikisakigetpage",
		arrData,
		function (data) {
			if (data == 0) {
				$('.pagination').twbsPagination('destroy');
			}
			$('.pagination').twbsPagination('destroy');
			$('.pagination').twbsPagination({
				totalPages: data,
				visiblePages: 5,
				onPageClick: function (event, page) {
					arrData["page"] = page;
					torihikisakiGetList(arrData);
				}
			});
		}
	);
}

//リスト表示
function torihikisakiGetList(arrData) {
	$.post(
		"torihikisakigetlist",
		arrData,
		function (data) {
			$('#list').html(data);
		}
	);
}

//キャンセル処理
function cancel() {
	mdl1.modaal('close');
	mdl2.modaal('close');
}

//選択処理
function choiceSpl(code, name) {
	$("#torihikisaki_code").val(code);
	$("#torihikisaki_name").val(name);
	mdl1.modaal('close');
}

function searchYakuhin() {
	let arrData = {
		"yakuhin": $('#yakuhin').val(),
		"yakuhin_kbn": $('#yakuhin_kbn2').val(),
		"_token": $('meta[name="csrf-token"]').attr('content')
	}
	$.post(
		"yakuhingetpage",
		arrData,
		function (data) {
			console.log(data);
			if (data == 0) {
				$(".pagination").twbsPagination('destroy');
			}
			$(".pagination").twbsPagination('destroy');
			$(".pagination").twbsPagination({
				totalPages: data,
				visiblePages: 10,
				onPageClick: function (event, page) {
					//console.log(page);
					arrData['page'] = page;
					yakuhinGetList(arrData);
				}
			});
		}
	);
}

function yakuhinGetList(arrData) {
	$.post(
		"yakuhingetlist",
		arrData,
		function (data) {
			$('#list').html(data);
		}
	);
}

function choiceYakuhin(jan, name, kbn, yj) {
	$("#jan_code").val(jan);
	$("#hanbai_name").val(name);
	$("#yakuhin_kbn").val(kbn);
	$("#yj_code").val(yj);
	mdl2.modaal('close');
}
