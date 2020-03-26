  // Add slideDown animation to Bootstrap dropdown when expanding.
  $('.dropdown').on('show.bs.dropdown', function() {
    $(this).find('.dropdown-menu').first().stop(true, true).slideDown(333);
  });

  // Add slideUp animation to Bootstrap dropdown when collapsing.
  $('.dropdown').on('hide.bs.dropdown', function() {
    $(this).find('.dropdown-menu').first().stop(true, true).slideUp(333);
  });

// Single Item slick
$('.slick-single').slick({
  arrows: false,
  autoplay: true,
  autoplaySpeed: 4500,
});

// 3 Column Slick
$('.slick3').slick({
	dots: true,
	infinite: true,
	slidesToShow: 3,
	slidesToScroll: 3,
	responsive: [
  {
    breakpoint: 1200,
    settings: {
      slidesToShow: 3,
      slidesToScroll: 3,
      infinite: true,
      dots: true
    }
  },
  {
    breakpoint: 768,
    settings: {
      slidesToShow: 2,
      slidesToScroll: 2
    }
  },
  {
    breakpoint: 576,
    settings: {
      slidesToShow: 1,
      slidesToScroll: 1,
      arrows: false,
    }
  }
  ]
});

// 4 Column Slick
$('.slick4').slick({
  dots: true,
  infinite: true,
  slidesToShow: 4,
  slidesToScroll: 4,
  responsive: [
  {
    breakpoint: 1200,
    settings: {
      slidesToShow: 4,
      slidesToScroll: 4,
      infinite: true,
      dots: true
    }
  },
  {
    breakpoint: 768,
    settings: {
      slidesToShow: 2,
      slidesToScroll: 2
    }
  },
  {
    breakpoint: 576,
    settings: {
      slidesToShow: 2,
      slidesToScroll: 2,
      arrows: false,
    }
  }
  ]
});