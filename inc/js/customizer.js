/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

(function($) {
		// site title
		wp.customize('blogname', function(value) {
				value.bind(function(to) {
						$('.site-title').text(to);
				});
		});

		// tagline
		wp.customize('blogdescription', function(value) {
				value.bind(function(to) {
						$('.site-description').text(to);
				});
		});
		// header logo
		wp.customize('serranova_header_logo_show', function(value) {
				value.bind(function(to) {
						if (to === 'text') {
								$('#site-branding h1, #site-branding span').show();
								$('#site-branding img').hide();
						}

						if (to === 'logo') {
								$('#site-branding h1, #site-branding span').hide();
								$('#site-branding img').show();
						}
				});
		});

		// serranova header logo image
		wp.customize('serranova_header_logo_image', function(value) {
				value.bind(function(to) {
						$('#site-branding img').attr('src', to);
				});
		});

		// serranova hero banner
		wp.customize('serranova_hero_show', function(value) {
				value.bind(function(to) {
						return to === 'yes' ? $('#hero').show() : $('#hero').hide();
				});
		});

		// serranova hero banner bg image
		wp.customize('serranova_hero_image', function(value) {
				value.bind(function(to) {
						$('#hero .hero-image img').attr('src', to);
				});
		});

		// serranova hero banner title
		wp.customize('serranova_hero_title', function(value) {
				value.bind(function(to) {
						$('#hero h2').text(to);
				});
		});

		// serranova hero banner text
		wp.customize('serranova_hero_text', function(value) {
				value.bind(function(to) {
						$('#hero .herotext').html(to);
				});
		});

		// serranova hero button 1 show/hide
		wp.customize('serranova_hero_button1_show', function(value) {
				value.bind(function(to) {
						return to === 'yes' ? $('.button.green').show() : $('.button.green').hide();
				});
		});

		// serranova hero button 1 text
		wp.customize('serranova_hero_button1_text', function(value) {
				value.bind(function(to) {
						$('.herobuttons a:first-child').text(to);
				});
		});

		// serranova hero button 1 link
		wp.customize('serranova_hero_button1_link', function(value) {
				value.bind(function(to) {
						$('.herobuttons a:first-child').attr('href', encodeURI(to));
				});
		});

		// serranova hero button 2 show/hide
		wp.customize('serranova_hero_button2_show', function(value) {
				value.bind(function(to) {
						return to === 'yes' ? $('.button.seethrough').show() : $('.button.seethrough').hide();
				});
		});

		// serranova hero button 2 text
		wp.customize('serranova_hero_button2_text', function(value) {
				value.bind(function(to) {
						$('.herobuttons a:last-child').text(to);
				});
		});

		// serranova hero button 2 link
		wp.customize('serranova_hero_button2_link', function(value) {
				value.bind(function(to) {
						$('.herobuttons a:last-child').attr('href', encodeURI(to));
				});
		});

		// serranova footer logo show/hide
		wp.customize('serranova_footer_logo_show', function(value) {
				value.bind(function(to) {
						return to === 'yes' ? $('#footer #bottom .wrapper > a').show().children('a').attr('href', to) : $('#footer #bottom .wrapper > a').hide();
				});
		});

		// serranova footer logo image
		wp.customize('serranova_footer_logo_image', function(value) {
				value.bind(function(to) {
						$('#footer a img.bottomlogo').attr('src', to);
				});
		});

		//serranova_google_fonts_heading_font

		// Background color.
		wp.customize('background_color', function(value) {
				value.bind(function(to) {
						if ('blank' === to) {
								$('body').css({
										'clip': 'rect(1px, 1px, 1px, 1px)',
										'position': 'absolute'
								});
						} else {
								$('body').css({
										'clip': 'auto',
										'background-color': to,
										'position': 'relative'
								});
						}
				});
		});

		// google fonts
		wp.customize('serranova_google_fonts_body_font', function(value) {
				value.bind(function(to) {
						var font = to.replace(' ', '+');
						WebFontConfig = {
								google: { families: [font + '::latin'] }
						};
						(function() {
								var wf = document.createElement('script');
								wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
										'://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
								wf.type = 'text/javascript';
								wf.async = 'true';
								var s = document.getElementsByTagName('script')[0];
								s.parentNode.insertBefore(wf, s);
						})();

						// style the text
						if (to == 'none') {
								$('body').attr('style', '');
						} else {
								var myVar = setInterval(function() {
										if (typeof WebFont != 'undefined') {
												WebFont.load({
														google: {
																families: [font]
														}
												});
												clearInterval(myVar);
										}
								}, 100);

								$('body, p, span, small, input, li, li a, .block_cont_in :not(h1,h2,h3,h4,h5,.fa,h1 a, h2 a, h3 a, h4 a, h5 a), .banner_left .text a, .profile_cont :not(h1,h2,h3,h4,h5), .herotext, .herobuttons .button').attr("style", 'font-family:"' + to + '" !important');
						}
				});
		});
		wp.customize('serranova_google_fonts_heading_font', function(value) {
				value.bind(function(to) {
						var font = to.replace(' ', '+');
						WebFontConfig = {
								google: { families: [font + '::latin'] }
						};
						(function() {
								var wf = document.createElement('script');
								wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
										'://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
								wf.type = 'text/javascript';
								wf.async = 'true';
								var s = document.getElementsByTagName('script')[0];
								s.parentNode.insertBefore(wf, s);
						})();

						// style the text
						if (to == 'none') {
								$('h1,h2,h3,h4,h5,h6, h1 a, h2 a, h3 a, h4 a, h5 a, h6 a').attr("style", '');
						} else {
								var myVar = setInterval(function() {
										if (typeof WebFont != 'undefined') {
												WebFont.load({
														google: {
																families: [font]
														}
												});
												clearInterval(myVar);
										}
								}, 100);

								$('h1,h2,h3,h4,h5,h6, h1 a, h2 a, h3 a, h4 a, h5 a, h6 a').attr("style", 'font-family:"' + to + '" !important');
						}
				});
		});

		// colors
		wp.customize('serranova_accent_color', function(value) {
				value.bind(function(to) {
						if ('blank' === to) {
								// bg - .search input.submit, .tab_head li:hover, .tab_head li.active, .banner_left a.contact, .read_more, .pagination a, .pagination span
								$('.search input.submit, .tab_head li:hover, .tab_head li.active, #hero .green, .blogimage .fa, .blogpostmeta .fa, .featurewidgeticon .fa, .socialmediamenu .fa, .pagination a, .pagination span, .profile_cont .fa').css({});
								$('body #serranova-selection-styles').remove();
						} else {
								$('body').append('<style id="serranova-selection-styles">::selection {background: ' + to + '}</style>')
								$('.block_cont_in ul li .fa-folder-open-o, .block_cont_in ul li .fa-calendar-check-o, .block_cont_in ul li .fa-comments-o, .profile_cont .fa, .comment-body a, #respond a, .post-edit-link, .authormeta a').css({
										'color': to
								});
								$('.postmeta li a')
										.on('mouseenter', function(e) {
												$(e.target).attr('style', 'color: ' + to);
										})
										.on('mouseleave', function(e) {
												$(e.target).attr('style', '');
										});
								$('.tab_head li')
										.on('mouseenter', function(e) {
												var el = e.target;
												while (e.target.localName !== 'LI') {
														el = e.target.parentElement;
												}
												$(el).attr('style', 'background-color: ' + to);
										})
										.on('mouseleave', function(e) {
												$(e.target).attr('style', '');
										});
								$('.blogpostmeta a, .postcontentmeta a')
										.on('mouseover', function(e) {
												$(e.target).attr('style', 'color: ' + to);
										})
										.on('mouseleave', function(e) {
												//$(e.target).attr('style', '');
												e.target.color = 'initial';
										});
								$('.footerwidget a, .authormeta a, .post-edit-link')
										.on('mouseover', function(e) {
												$(e.target).css({
														borderTopColor: to,
														borderBottomColor: to,
														borderLeftColor: to,
														borderRightColor: to
												});
										})
										.on('mouseleave', function(e) {
												$(e.target).css({
														borderTopColor: undefined,
														borderBottomColor: undefined,
														borderLeftColor: undefined,
														borderRightColor: undefined
												});
										});
								$('.blogimage .fa, .search input.submit, .tab_head li:hover, .tab_head li.active, #hero .green, .pagination a, .pagination span, ::selection').css({
										'background-color': to
								});
								$('#hero').css({
										'border-color': to
								});
								$('.blogpostmeta .fa, .featurewidgeticon .fa, .socialmediamenu .fa, .profile_cont .fa, .herotext a, .postcontentmeta .fa').css({ color: to });
								$('.herobuttons .button.seethrough, .tab_cont .clear').attr('style', 'border-color: ' + to);
						}
				})
		});
		// end colors

})(jQuery);
