jQuery(function( $ ) {
  var homePrice, homeSavings, update_handle_track_pos;

  update_handle_track_pos = function(slider, ui_handle_pos) {
		var handle_track_xoffset, slider_range_inverse_width;
		handle_track_xoffset = -((ui_handle_pos / 100) * slider.clientWidth);
		$(slider).find(".handle-track").css("left", handle_track_xoffset);
		var homeCost = homePrice[ui_handle_pos/2];

		$(".homeCost").text("$" + parseInt(homeCost).toLocaleString());
		var homeSellSavings = (1.05*(6000+(0.03*(homeCost-100000))))-(1.05*(((6000+(0.03*(homeCost-100000)))/2)+5000));
		$(".homeSavings").text("$" + Math.ceil(homeSellSavings).toLocaleString());

		var buyerCashback = (1500+(0.015*homeCost))-5000;
		$(".buyerCashback").text("$" + Math.ceil(buyerCashback).toLocaleString());

		var sellerBetterwayBuyer = (1.05*(6000+(0.03*(homeCost-100000))))-(1.05*10000);
		$(".sellerBetterwayBuyer").text("$" + Math.ceil(sellerBetterwayBuyer).toLocaleString());
		slider_range_inverse_width = (100 - ui_handle_pos) + "%";
		return $(slider).find(".slider-range-inverse").css("width", slider_range_inverse_width);
  };

  homePrice = ["300000", "320000", "340000", "360000", "380000", "400000", "420000", "440000", "460000", "480000", "500000", "550000", "600000", "650000", "700000", "750000", "800000", "850000", "900000", "950000", "1000000", "1050000", "1100000", "1150000", "1200000", "1250000", "1300000", "1350000", "1400000", "1450000", "1500000", "1550000", "1600000", "1650000", "1700000", "1750000", "1800000", "1850000", "1900000", "1950000", "2000000", "2100000", "2200000", "2300000", "2400000", "2500000", "2600000", "2700000", "2800000", "2900000", "3000000"];


  $("#js-slider").slider({
    range: "min",
    max: 100,
    value: 34,
    step: 2,
    create: function(event, ui) {
      var slider;
      slider = $(event.target);
      slider.find('.ui-slider-handle').append('<span class="dot"><span class="handle-track"></span></span>');
      slider.prepend('<div class="slider-range-inverse"></div>');
      slider.find(".handle-track").css("width", event.target.clientWidth);
      return update_handle_track_pos(event.target, $(this).slider("value"));
    },
    slide: function(event, ui) {
      return update_handle_track_pos(event.target, ui.value);
    }
  });

}).call(this);