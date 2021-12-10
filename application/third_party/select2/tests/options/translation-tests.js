\n  color: @jumbotron-color;\n  background-color: @jumbotron-bg;\n\n  h1,\n  .h1 {\n    color: @jumbotron-heading-color;\n  }\n  p {\n    margin-bottom: (@jumbotron-padding / 2);\n    font-size: @jumbotron-font-size;\n    font-weight: 200;\n  }\n\n  > hr {\n    border-top-color: darken(@jumbotron-bg, 10%);\n  }\n\n  .container & {\n    border-radius: @border-radius-large; // Only round corners at higher resolutions if contained in a container\n  }\n\n  .container {\n    max-width: 100%;\n  }\n\n  @media screen and (min-width: @screen-sm-min) {\n    padding-top:    (@jumbotron-padding * 1.6);\n    padding-bottom: (@jumbotron-padding * 1.6);\n\n    .container & {\n      padding-left:  (@jumbotron-padding * 2);\n      padding-right: (@jumbotron-padding * 2);\n    }\n\n    h1,\n    .h1 {\n      font-size: (@font-size-base * 4.5);\n    }\n  }\n}\n","//\n// Thumbnails\n// --------------------------------------------------\n\n\n// Mixin and adjust the regular image class\n.thumbnail {\n  display: block;\n  padding: @thumbnail-padding;\n  margin-bottom: @line-height-computed;\n  line-height: @line-height-base;\n  background-color: @thumbnail-bg;\n  border: 1px solid @thumbnail-border;\n  border-radius: @thumbnail-border-radius;\n  .transition(all .2s ease-in-out);\n\n  > img,\n  a > img {\n    &:extend(.img-responsive);\n    margin-left: auto;\n    margin-right: auto;\n  }\n\n  // Add a hover state for linked versions only\n  a&:hover,\n  a&:focus,\n  a&.active {\n    border-color: @link-color;\n  }\n\n  // Image captions\n  .caption {\n    padding: @thumbnail-caption-padding;\n    color: @thumbnail-caption-color;\n  }\n}\n","//\n// Alerts\n// --------------------------------------------------\n\n\n// Base styles\n// -------------------------\n\n.alert {\n  padding: @alert-padding;\n  margin-bottom: @line-height-computed;\n  border: 1px solid transparent;\n  border-radius: @alert-border-radius;\n\n  // Headings for larger alerts\n  h4 {\n    margin-top: 0;\n    // Specified for the h4 to prevent conflicts of changing @headings-color\n    color: inherit;\n  }\n  // Provide class for links that match alerts\n  .alert-link {\n    font-weight: @alert-link-font-weight;\n  }\n\n  // Improve alignment and spacing of inner content\n  > p,\n  > ul {\n    margin-bottom: 0;\n  }\n  > p + p {\n    margin-top: 5px;\n  }\n}\n\n// Dismissible alerts\n//\n// Expand the right padding and account for the close button's positioning.\n\n.alert-dismissable, // The misspelled .alert-dismissable was deprecated in 3.2.0.\n.alert-dismissible {\n  padding-right: (@alert-padding + 20);\n\n  // Adjust close link position\n  .close {\n    position: relative;\n    top: -2px;\n    right: -21px;\n    color: inherit;\n  }\n}\n\n// Alternate styles\n//\n// Generate contextual modifier classes for colorizing the alert.\n\n.alert-success {\n  .alert-variant(@alert-success-bg; @alert-success-border; @alert-success-text);\n}\n.alert-info {\n  .alert-variant(@alert-info-bg; @alert-info-border; @alert-info-text);\n}\n.alert-warning {\n  .alert-variant(@alert-warning-bg; @alert-warning-border; @alert-warning-text);\n}\n.alert-danger {\n  .alert-variant(@alert-danger-bg; @alert-danger-border; @alert-danger-text);\n}\n","// Alerts\n\n.alert-variant(@background; @border; @text-color) {\n  background-color: @background;\n  border-color: @border;\n  color: @text-color;\n\n  hr {\n    border-top-color: darken(@border, 5%);\n  }\n  .alert-link {\n    color: darken(@text-color, 10%);\n  }\n}\n","//\n// Progress bars\n// --------------------------------------------------\n\n\n// Bar animations\n// -------------------------\n\n// WebKit\n@-webkit-keyframes progress-bar-stripes {\n  from  { background-position: 40px 0; }\n  to    { background-position: 0 0; }\n}\n\n// Spec and IE10+\n@keyframes progress-bar-stripes {\n  from  { background-position: 40px 0; }\n  to    { background-position: 0 0; }\n}\n\n\n\n// Bar itself\n// -------------------------\n\n// Outer container\n.progress {\n  overflow: hidden;\n  height: @line-height-computed;\n  margin-bottom: @line-height-computed;\n  background-color: @progress-bg;\n  border-radius: @border-radius-base;\n  .box-shadow(inset 0 1px 2px rgba(0,0,0,.1));\n}\n\n// Bar of progress\n.progress-bar {\n  float: left;\n  width: 0%;\n  height: 100%;\n  font-size: @font-size-small;\n  line-height: @line-height-computed;\n  color: @progress-bar-color;\n  text-align: center;\n  background-color: @progress-bar-bg;\n  .box-shadow(inset 0 -1px 0 rgba(0,0,0,.15));\n  .transition(width .6s ease);\n}\n\n// Striped bars\n//\n// `.progress-striped .progress-bar` is deprecated as of v3.2.0 in favor of the\n// `.progress-bar-striped` class, which you just add to an existing\n// `.progress-bar`.\n.progress-striped .progress-bar,\n.progress-bar-striped {\n  #gradient > .striped();\n  background-size: 40px 40px;\n}\n\n// Call animation for the active one\n//\n// `.progress.active .progress-bar` is deprecated as of v3.2.0 in favor of the\n// `.progress-bar.active` approach.\n.progress.active .progress-bar,\n.progress-bar.active {\n  .animation(progress-bar-stripes 2s linear infinite);\n}\n\n// Account for lower percentages\n.progress-bar {\n  &[aria-valuenow=\"1\"],\n  &[aria-valuenow=\"2\"] {\n    min-width: 30px;\n  }\n\n  &[aria-valuenow=\"0\"] {\n    color: @gray-light;\n    min-width: 30px;\n    background-color: transparent;\n    background-image: none;\n    box-shadow: none;\n  }\n}\n\n\n\n// Variations\n// -------------------------\n\n.progress-bar-success {\n  .progress-bar-variant(@progress-bar-success-bg);\n}\n\n.progress-bar-info {\n  .progress-bar-variant(@progress-bar-info-bg);\n}\n\n.progress-bar-warning {\n  .progress-bar-variant(@progress-bar-warning-bg);\n}\n\n.progress-bar-danger {\n  .progress-bar-variant(@progress-bar-danger-bg);\n}\n","// Gradients\n\n#gradient {\n\n  // Horizontal gradient, from left to right\n  //\n  // Creates two color stops, start and end, by specifying a color and position for each color stop.\n  // Color stops are not available in IE9 and below.\n  .horizontal(@start-color: #555; @end-color: #333; @start-percent: 0%; @end-percent: 100%) {\n    background-image: -webkit-linea