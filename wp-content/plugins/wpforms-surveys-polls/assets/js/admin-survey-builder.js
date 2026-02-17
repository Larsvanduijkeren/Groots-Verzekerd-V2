/* global wpforms_builder, wpforms_surveys_polls */

/**
 * @param wpforms_surveys_polls.alert_disable_entries
 * @param wpforms_surveys_polls.alert_enable_entries
 */

/**
 * WPForms Survey Builder.
 *
 * @param {jQuery} $ jQuery object.
 */
( function( $ ) {
	// Global settings access.
	let s;

	// Main Survey admin builder object.
	// noinspection ES6ConvertVarToLetConst
	var WPFormsSurveyBuilder = { // eslint-disable-line no-var
		// Settings.
		settings: {
			surveyFields: [ 'text', 'textarea', 'select', 'radio', 'checkbox', 'rating', 'likert_scale', 'net_promoter_score' ],
		},

		/**
		 * Start the engine.
		 *
		 * @since 1.0.0
		 */
		init() {
			// Settings shortcut.
			s = this.settings;

			// Document ready.
			$( WPFormsSurveyBuilder.ready );
		},

		/**
		 * Document ready.
		 *
		 * @since 1.0.0
		 */
		ready() {
			// Element actions.
			WPFormsSurveyBuilder.buildUIActions();

			// Make Likert row/column settings sortable.
			WPFormsSurveyBuilder.likertSortable();
		},

		/**
		 * Element binds and actions.
		 *
		 * @since 1.0.0
		 */
		buildUIActions() { // eslint-disable-line max-lines-per-function
			// Clicking `Disable storing entry information in WordPress` checkbox in Builder > Settings
			// or `Enable Survey Reporting` or `Enable Poll Results` in Builder > Surveys and Polls.
			$( document ).on( 'click', '#wpforms-panel-field-settings-disable_entries, #wpforms-panel-field-settings-survey_enable, #wpforms-panel-field-settings-poll_enable', WPFormsSurveyBuilder.alertEnableEntries );

			// Toggle individual field survey reporting settings depending on
			// the state of the global form setting.
			$( document ).on( 'change', '#wpforms-panel-field-settings-survey_enable', function() {
				if ( $( this ).is( ':checked' ) ) {
					$( '.wpforms-field-option-row-survey' ).addClass( 'wpforms-hidden' );
				} else {
					$( '.wpforms-field-option-row-survey' ).removeClass( 'wpforms-hidden' );
				}
			} );

			// When a new field is added that supports survey reporting, if
			// survey reporting is enabled globally, hide the individual field
			// setting.
			$( document ).on( 'wpformsFieldAdd', function( event, id, type ) {
				if ( $.inArray( type, s.surveyFields ) > -1 && $( '#wpforms-panel-field-settings-survey_enable' ).is( ':checked' ) ) {
					$( '#wpforms-field-option-row-' + id + '-survey' ).addClass( 'wpforms-hidden' );
				}
			} );

			// Make new Likert fields sortable.
			$( document ).on( 'wpformsFieldAdd', function( event, id, type ) {
				if ( 'likert_scale' === type ) {
					WPFormsSurveyBuilder.likertSortable( '#wpforms-field-option-' + id + ' .choices-list' );
				}
			} );

			// Likert field add new row or column.
			$( document ).on( 'click', '.wpforms-field-option-likert_scale .choices-list .add', function( event ) {
				WPFormsSurveyBuilder.likertChoiceAdd( event, $( this ) );
			} );

			// Likert field remove row or column.
			$( document ).on( 'click', '.wpforms-field-option-likert_scale .choices-list .remove', function( event ) {
				WPFormsSurveyBuilder.likertChoiceDelete( event, $( this ) );
			} );

			// Likert field update row/column labels.
			$( document ).on( 'input', '.wpforms-field-option-likert_scale .choices-list input', function() {
				const $list = $( this ).closest( '.choices-list' ),
					fieldID = $list.data( 'field-id' );
				WPFormsSurveyBuilder.likertChoiceUpdate( fieldID );
			} );

			// NPS field update Lowest/Highest labels.
			$( document ).on( 'input', '.wpforms-field-option-row-lowest_label input, .wpforms-field-option-row-highest_label input', function( event ) {
				WPFormsSurveyBuilder.netPromoterUpdateLabels( event, $( this ) );
			} );

			// Likert field toggle single row display.
			$( document ).on( 'change', '.wpforms-field-option-likert_scale .wpforms-field-option-row-single_row input', function() {
				$( this ).closest( '.wpforms-field-option-group-inner' ).find( '.wpforms-field-option-row-rows .choices-list' ).toggleClass( 'wpforms-hidden' );
				WPFormsSurveyBuilder.likertChoiceUpdate( $( this ).closest( '.wpforms-field-option-row' ).data( 'field-id' ) );
			} );

			// Likert field toggle multiple responses (radio/checkbox).
			$( document ).on( 'change', '.wpforms-field-option-likert_scale .wpforms-field-option-row-multiple_responses input', function() {
				WPFormsSurveyBuilder.likertChoiceUpdate( $( this ).closest( '.wpforms-field-option-row' ).data( 'field-id' ) );
			} );

			// Likert field style (theme).
			$( document ).on( 'change', '.wpforms-field-option-likert_scale .wpforms-field-option-row-style select', function() {
				const $this = $( this ),
					value = $this.val(),
					fieldID = $this.parent().data( 'field-id' );
				$( '#wpforms-field-' + fieldID ).find( 'table' ).removeClass( 'classic modern' ).addClass( value );
			} );

			// Net Promoter Score field style (theme).
			$( document ).on( 'change', '.wpforms-field-option-net_promoter_score .wpforms-field-option-row-style select', function() {
				const $this = $( this ),
					value = $this.val(),
					fieldID = $this.parent().data( 'field-id' );
				$( '#wpforms-field-' + fieldID ).find( 'table' ).removeClass( 'classic modern' ).addClass( value );
			} );

			// Update Likert Scale field preview on undo/redo.
			$( document ).on( 'wpformsUndoRedoRun', '#wpforms-builder', function( e, commandType, command ) {
				const commands = [
					'ActionItemsAddRemoveCommand',
					'ChoicesListReorderCommand',
				];

				if (
					commands.includes( command.constructor?.id ) &&
					command.args?.fieldId &&
					command.args?.fieldType === 'likert_scale'
				) {
					WPFormsSurveyBuilder.likertChoiceUpdate( command.args?.fieldId );
				}
			} );
		},

		/**
		 * Display alert if Entries disabled.
		 *
		 * @since 1.5.3
		 */
		alertEnableEntries() {
			const $t = $( this );

			if ( ! $t.is( ':checked' ) ) {
				return;
			}

			const $disableEntries = $( '#wpforms-panel-field-settings-disable_entries' ),
				$surveyEnable = $( '#wpforms-panel-field-settings-survey_enable' ),
				$pollEnable = $( '#wpforms-panel-field-settings-poll_enable' );
			let alertText = '';

			if ( $t.is( $disableEntries ) ) {
				if ( ! ( $surveyEnable.is( ':checked' ) || $pollEnable.is( ':checked' ) ) ) {
					return;
				}

				alertText = wpforms_surveys_polls.alert_disable_entries;
			} else {
				if ( ! $disableEntries.is( ':checked' ) ) {
					return;
				}

				alertText = wpforms_surveys_polls.alert_enable_entries;

				$t.prop( 'checked', false );
			}

			$.alert( {
				title: wpforms_builder.heads_up,
				content: alertText,
				icon: 'fa fa-exclamation-circle',
				type: 'orange',
				buttons: {
					confirm: {
						text: wpforms_builder.ok,
						btnClass: 'btn-confirm',
						keys: [ 'enter' ],
					},
				},
			} );
		},

		/**
		 * Make the Likert field row and column options sortable.
		 *
		 * @since 1.0.0
		 *
		 * @param {string} selector Selector.
		 */
		likertSortable( selector ) {
			selector = selector || '.wpforms-field-option-likert_scale .choices-list';

			const $builder = $( '#wpforms-builder' );

			$( selector ).sortable( {
				items:   'li',
				axis:    'y',
				delay:   100,
				opacity: 0.6,
				handle:  '.move',
				start( e, ui ) {
					$builder.trigger( 'wpformsBeforeLikertScaleFieldChoiceDragStart', ui );
				},
				stop( e, ui ) {
					const id = ui.item.parent().data( 'field-id' );
					WPFormsSurveyBuilder.likertChoiceUpdate( id );
					$builder.trigger( 'wpformsLikertScaleFieldChoiceMove', ui );
				},
				update() {},
			} );
		},

		/**
		 * Likert field add new row or column choice.
		 *
		 * @since 1.0.0
		 *
		 * @param {Object} event Event object.
		 * @param {Object} el    DOM element.
		 */
		likertChoiceAdd( event, el ) {
			event.preventDefault();

			const $this = $( el ),
				$parent = $this.parent(),
				$list = $this.closest( '.choices-list' ),
				fieldID = $list.data( 'field-id' );
			let id = $list.attr( 'data-next-id' );
			const choiceType = $list.data( 'choice-type' ),
				$newChoice = $parent.clone().insertAfter( $parent );

			$newChoice.attr( 'data-key', id );
			$newChoice.find( 'input' ).val( '' ).attr( 'name', 'fields[' + fieldID + '][' + choiceType + '][' + id + ']' );

			id++;
			$list.attr( 'data-next-id', id );

			WPFormsSurveyBuilder.likertChoiceUpdate( fieldID );
		},

		/**
		 * Likert field remove row or column choice.
		 *
		 * @since 1.0.0
		 *
		 * @param {Object} event Event object.
		 * @param {Object} el    DOM element.
		 */
		likertChoiceDelete( event, el ) {
			event.preventDefault();

			const $this = $( el ),
				$list = $this.closest( '.choices-list' ),
				total = $list.find( 'li' ).length;

			if ( 1 === total ) {
				$.alert( {
					title:   false,
					content: wpforms_builder.error_choice,
					icon:   'fa fa-info-circle',
					type:   'blue',
					buttons: {
						confirm: {
							text:     wpforms_builder.ok,
							btnClass: 'btn-confirm',
							keys:     [ 'enter' ],
						},
					},
				} );
			} else {
				$this.parent().remove();
				WPFormsSurveyBuilder.likertChoiceUpdate( $list.data( 'field-id' ) );
			}
		},

		/**
		 * Likert field re-render the table output in the preview area.
		 *
		 * @since 1.0.0
		 *
		 * @param {number} fieldID Field ID.
		 */
		likertChoiceUpdate( fieldID ) {
			const $singleRow = $( '#wpforms-field-option-' + fieldID + '-single_row' );
			const data = {
				rows:        {},
				columns:     {},
				colCount:    0,
				singleRow:   $singleRow.is( ':checked' ),
				singleClass: $singleRow.is( ':checked' ) ? 'single-row' : '',
				inputType:   $( '#wpforms-field-option-' + fieldID + '-multiple_responses' ).is( ':checked' ) ? 'checkbox' : 'radio',
				style:       $( '#wpforms-field-option-' + fieldID + '-style' ).val(),
				width:       0,
			};

			// Get columns.
			$( '#wpforms-field-option-row-' + fieldID + '-columns .choices-list li' ).each( function() {
				const $this = $( this ),
					key = $this.data( 'key' ),
					value = $this.find( 'input' ).val();

				data.columns[ 'c' + key ] = {
					key,
					value,
				};

				data.colCount++;
			} );

			// Get rows.
			$( '#wpforms-field-option-row-' + fieldID + '-rows .choices-list li' ).each( function() {
				const $this = $( this ),
					key = $this.data( 'key' ),
					value = $this.find( 'input' ).val();

				data.rows[ 'r' + key ] = {
					key,
					value,
				};
			} );

			// Calculate the width of columns.
			data.width = data.singleRow ? 100 / data.colCount : 80 / data.colCount;

			// Generate new table from template and replace current.
			const likertPreview = wp.template( 'wpforms-likert-scale-preview' );
			$( '#wpforms-field-' + fieldID ).find( 'table' ).replaceWith( likertPreview( data ) );
		},

		/**
		 * Net Promoter Score update the Lowest and Highest labels text in preview.
		 *
		 * @since 1.13.0
		 *
		 * @param {Object} event Event object.
		 * @param {Object} el    DOM element.
		 */
		netPromoterUpdateLabels( event, el ) {
			const fieldID = el.closest( '.wpforms-field-option-row' ).data( 'field-id' );
			const value = el.val();
			const labelSelector = el.attr( 'id' ).includes( 'lowest' ) ? '.not-likely' : '.extremely-likely';

			$( '#wpforms-field-' + fieldID ).find( labelSelector ).text( value );
		},
	};

	WPFormsSurveyBuilder.init();
}( jQuery ) );
