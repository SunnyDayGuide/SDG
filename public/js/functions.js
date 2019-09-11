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