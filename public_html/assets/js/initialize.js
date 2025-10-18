(function($) {
	var debug = $('meta[name="debug"]').attr('content') == 'ON';

	const debounce = function debounce(func, timeout = 300){
		let timer;
		return (...args) => {
			clearTimeout(timer);
			timer = setTimeout(() => { func.apply(this, args); }, timeout);
		};
	}	


	// Board selection menu.
	$(document).on('click', '#board-selection-menu .board-item', function (e) {
		e.preventDefault();

		if ($(this).hasClass('disabled')) {
			return
		}

		$('#board-selection-menu .board-item.active').removeClass('active')

		const currentWidth = $(window).width();
		const activateOverlay = currentWidth > 767;

		$(this).addClass('active');

		let boardCode = $(this).data('board-code');

		// Find the element.
		const resultElement = $('.result.' + boardCode)

		if (resultElement && resultElement.length) {
			if (activateOverlay) {
				$('#board-result-overlay').fadeIn(300);
			}

			// Scroll to that element too.
			const firstElement = resultElement.get(0)
			$([document.documentElement, document.body]).animate({
        scrollTop: $(firstElement).offset().top - 200
    	}, 300, function () {
				if (activateOverlay) {
					$(firstElement).addClass('overlay-focus-element');
				}
			});
		}
	});

	$(document).on('click', '#board-result-overlay', function (e) {
		$('.overlay-focus-element').removeClass('overlay-focus-element')
		$('#board-selection-menu .board-item.active').removeClass('active')
		$('#board-result-overlay').fadeOut(300);
	});

	// Top sticky menu.
	const boardSelectionMenu = $('#board-selection-menu').get(0);
	if (boardSelectionMenu) {
		const boardSelectionMenuTop = $(boardSelectionMenu).offset().top;

		$(window).scroll(function () {
			const topRowHeight = 40;
			const scrollTop = $(window).scrollTop() + topRowHeight;
	
			if (scrollTop >= boardSelectionMenuTop && !$(boardSelectionMenu).hasClass('sticky')) {
				$(boardSelectionMenu).addClass('sticky');
				$('#main').addClass('board-selection-sticked');
			} else if (scrollTop < boardSelectionMenuTop && $(boardSelectionMenu).hasClass('sticky')) {
				$(boardSelectionMenu).removeClass('sticky');
				$('#main').removeClass('board-selection-sticked');
			}
		})

		// To show the h-scroller hint.
		const checkHScroller = function () {
			const width = $(window).width();

			if (width <= 1199 && !$('.mobile-h-scroller-hint').hasClass('show')) {
				$('.mobile-h-scroller-hint').addClass('show');

				(debounce(hideHScroller, 1500))();
			} else if (width > 1199 && $('.mobile-h-scroller-hint').hasClass('show')) {
				(debounce(hideHScroller, 1500))();
			}
		};

		const hideHScroller = function () {
			$('.mobile-h-scroller-hint').removeClass('show');
		};

		checkHScroller();

		$(window).resize(debounce(checkHScroller, 300));
	}

	// Scroll to top button.
	$(document).on('click', '#scroll-top', function (e) {
		e.preventDefault()
		
		$([document.documentElement, document.body]).animate({
			scrollTop: 0
		}, 350)
	})

	$(window).scroll(debounce(function () {
		const scrollTop = $(window).scrollTop();

		if (scrollTop > 0 && !$('#scroll-top').hasClass('active')) {
			$('#scroll-top').addClass('active')
			$('#scroll-top').fadeIn()
		} else if (scrollTop <= 0 && $('#scroll-top').hasClass('active')) {
			$('#scroll-top').removeClass('active')
			$('#scroll-top').fadeOut()
		}
	}, 300));
})(jQuery);