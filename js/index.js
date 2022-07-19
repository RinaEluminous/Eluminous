$.fancybox.defaults.btnTpl.counter = '<div><span data-fancybox-index></span> / <span data-fancybox-count></span></div>';

$('[data-fancybox="images"]').fancybox({
  loop    : true,
  arrows  : false,
  infobar : false,
  margin  : [44,0,22,0],
  buttons : [
    'arrowLeft',
    'counter',
    'arrowRight',
    'close'
  ],
  thumbs : {
    autoStart : true,
    axis      : 'x'
  },

})