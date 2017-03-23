$(document).ready(function () {
  window.NextGalaxy.UI.init();
  /**
   * [viewportUnitBuggyFill library
   * detect systems that need fallback
   * for use viewport units
   * repo at: https://github.com/rodneyrehm/viewport-units-buggyfill
   * CSS stylesheet. read more at: http://caniuse.com/#feat=viewport-units]
   */
  window.viewportUnitsBuggyfill.init({
    hacks: window.viewportUnitsBuggyfillHacks,
    contentHack: true,
    behaviorHack: true,
    refreshDebounceWait: 250
  });
});