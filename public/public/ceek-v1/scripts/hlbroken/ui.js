/**
 * [NextGalaxy global namespace]
 * @type {Object}
 */
window.NextGalaxy = window.NextGalaxy || {};

/**
 * [OPTIONS keys collection
 * that make reference to those pages with
 * any ui element that need an specific option
 * configuration]
 * @type {Object}
 */
window.NextGalaxy.OPTIONS = {
  'selection-2' : {
    miles : {
      animate: 'slow',
      step: 1,
      value: 99,
      max: 99,
      min: 10,
      slide: function (event, ui) {
        // show the current value selected
        $('#miles-value').text(ui.value);
        $('input[name="preferences_miles_of_me"]').val(ui.value);

        if (ui.value === 99) {
          $('#miles-value').text('Everywhere');
        }
      },

      create: function(event, ui) {
        $('input[name="preferences_miles_of_me"]').val(99);
      }
    },

    age : {
      animate: 'slow',
      min: 18,
      max: 99,
      step: 1,
      values: [18, 99],
      slide: function (event, ui) {
        // prevent handles to overlap
        if ((ui.values[0]) >= ui.values[1]) {
          return false;
        }

        // show the current value selected
        $('#age-value').text(ui.values[0] + '-' + ui.values[1]);
        $('input[name="preferences_age_range"]').val(ui.values[0] + '-' + ui.values[1]);
      },

      create: function(event, ui) {
        $('input[name="preferences_age_range"]').val(18 + '-' + 99);
      }
    }
  }
};

/**
 * [UI namespace to manage the
 * creation of custom user
 * interface elements]
 * @type {Object}
 */
window.NextGalaxy.UI = {
  customSelectContainerSelector: '.custom-select-container',

  init : function init() {
    this._initElems();
    this._initializeUI();
  },

  _initElems : function _initElems() {
    this.inputSliderSingle = $('.slider-single');
    this.inputSliderRange = $('.slider-range');
    this.customSelectElem = $('.custom-select');
  },

  _initializeUI : function _initializeUI() {
    if (this.inputSliderSingle.length > 0) { this._createInputSliderSingle(); }
    if (this.inputSliderRange.length > 0) { this._createInputSliderRange(); }
    if (this.customSelectElem.length > 0) { this._createCustomSelect(); }
  },

  /**
   * [_createInputSliderRange create a new
   * range slider input based on the current
   * location]
   * @return {JQueryUI} return a new JQuery UI element
   */
  _createInputSliderRange : function _createInputSliderRange() {
    this.inputSliderRange.slider(window.NextGalaxy.OPTIONS[window.NextGalaxy.LOCATION].age);
  },

  /**
   * [_createInputSliderSingle create a new
   * range slider input based on the current
   * location]
   * @return {JQueryUI} return a new JQuery UI element
   */
  _createInputSliderSingle : function _createInputSliderSingle() {
    this.inputSliderSingle.slider(window.NextGalaxy.OPTIONS[window.NextGalaxy.LOCATION].miles);
  },

  /**
   * [_createCustomSelect
   * create a new customSelect elem
   * based on customSelect library
   * read more at: http://adam.co/lab/jquery/customselect/]
   * @return {customSelect} return a new customSlect element
   */
  _createCustomSelect : function _createCustomSelect() {
    var ui;

    ui = this;

    this.customSelectElem.selectmenu({
      open: function () {
        $(this).closest(ui.customSelectContainerSelector).addClass('open');
      }
    });
  }
};