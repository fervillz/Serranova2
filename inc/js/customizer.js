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
		wp.customize('Serranova_header_logo_show', function(value) {
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

		// Serranova header logo image
		wp.customize('Serranova_header_logo_image', function(value) {
				value.bind(function(to) {
						$('#site-branding img').attr('src', to);
				});
		});

		// Serranova hero banner
		wp.customize('Serranova_hero_show', function(value) {
				value.bind(function(to) {
						return to === 'yes' ? $('#hero').show() : $('#hero').hide();
				});
		});

		// Serranova hero banner bg image
		wp.customize('Serranova_hero_bg_image', function(value) {
				value.bind(function(to) {
						$('#hero .hero-bg').attr('style', 'background-image: url(' + to + ')');
				});
		});

		// Serranova hero banner title
		wp.customize('Serranova_hero_title', function(value) {
				value.bind(function(to) {
						$('#hero h2').text(to);
				});
		});

		// Serranova hero banner text
		wp.customize('Serranova_hero_text', function(value) {
				value.bind(function(to) {
						$('#hero .herotext').html(to);
				});
		});

		// Serranova hero button 1 show/hide
		wp.customize('Serranova_hero_button1_show', function(value) {
				value.bind(function(to) {
						return to === 'yes' ? $('.button.green').show() : $('.button.green').hide();
				});
		});

		// Serranova hero button 1 text
		wp.customize('Serranova_hero_button1_text', function(value) {
				value.bind(function(to) {
						$('.button.green').text(to);
				});
		});

		// Serranova hero button 1 link
		wp.customize('Serranova_hero_button1_link', function(value) {
				value.bind(function(to) {
						$('.button.green').attr('href', encodeURI(to));
				});
		});

		// Serranova hero button 2 show/hide
		wp.customize('Serranova_hero_button2_show', function(value) {
				value.bind(function(to) {
						return to === 'yes' ? $('.button.seethrough').show() : $('.button.seethrough').hide();
				});
		});

		// Serranova hero button 2 text
		wp.customize('Serranova_hero_button2_text', function(value) {
				value.bind(function(to) {
						$('.button.seethrough').text(to);
				});
		});

		// Serranova hero button 2 link
		wp.customize('Serranova_hero_button2_link', function(value) {
				value.bind(function(to) {
						$('.button.seethrough').attr('href', encodeURI(to));
				});
		});

		//Serranova hero overlay
		wp.customize('Serranova_hero_overlay_enabled', function(value) {
				value.bind(function(to) {
						$('.hero-overlay').hide();
						if (to === 'yes') {
								$('.hero-overlay').show();
						}
				});
		});

		//Serranova hero overlay color
		wp.customize('Serranova_hero_overlay_color', function(value) {
				value.bind(function(to) {
						if (to !== 'blank') {
								$('.hero-overlay').css({ 'background-color': to });
						} else {
								$('.hero-overlay').css({ 'background-color': undefined });
						}
				});
		});

		//Serranova hero overlay opacity
		wp.customize('Serranova_hero_overlay_opacity', function(value) {
				value.bind(function(to) {
						if (to !== 'blank') {
								$('.hero-overlay').css({ 'opacity': to / 100 });
						} else {
								$('.hero-overlay').css({ 'opacity': undefined });
						}
				});
		});

		// Serranova hero blur
		wp.customize('Serranova_hero_blur_enabled', function(value) {
				value.bind(function(to) {
						$('.hero-bg').css({ 'filter': 'blur(' + to + 'px)', '-webkit-filter': 'blur(' + to + 'px)' });
				});
		});

		// Serranova footer logo show/hide
		wp.customize('Serranova_footer_logo_show', function(value) {
				value.bind(function(to) {
						return to === 'yes' ? $('#footer #bottom .wrapper > a').show().children('a').attr('href', to) : $('#footer #bottom .wrapper > a').hide();
				});
		});

		// Serranova footer logo image
		wp.customize('Serranova_footer_logo_image', function(value) {
				value.bind(function(to) {
						$('#footer a img.bottomlogo').attr('src', to);
				});
		});

		//Serranova_google_fonts_heading_font

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
		wp.customize('Serranova_google_fonts_body_font', function(value) {
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
		wp.customize('Serranova_google_fonts_heading_font', function(value) {
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
		wp.customize('Serranova_accent_color', function(value) {
				value.bind(function(to) {
						if ('blank' === to) {
								// bg - .search input.submit, .tab_head li:hover, .tab_head li.active, .banner_left a.contact, .read_more, .pagination a, .pagination span
								$('.search input.submit, .tab_head li:hover, .tab_head li.active, #hero .green, .blogimage .fa, .blogpostmeta .fa, .featurewidgeticon .fa, .socialmediamenu .fa, .pagination a, .pagination span, .profile_cont .fa').css({});
								$('body #Serranova-selection-styles').remove();
						} else {
								$('body').append('<style id="Serranova-selection-styles">::selection {background: ' + to + '}</style>')
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
