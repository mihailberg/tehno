var section = {

  opts: {
    section: '.js-section',
    tabs: '.js-tabs a',
    tabsActiveClass: 'd_activetab'
  },

  init: function() {
    if (window.location.hash) section.showSection(window.location.hash);
    section.tabsHandler();
  },

  showSection: function(hash) {
    $(section.opts.section).css('display', 'none').removeClass('active');
    $(section.opts.section + '[data-id=' + hash + ']').css('display', 'block').addClass('active');
    $(section.opts.tabs).removeClass(section.opts.tabsActiveClass);
    $(section.opts.tabs + '[href=' + hash + ']').addClass(section.opts.tabsActiveClass);
    catalog.setHeight();
    catalog.setId();
  },

  tabsHandler: function() {
    $(section.opts.tabs).click(function() {
      var $this = $(this),
          hash = $this.attr('href');
      section.showSection(hash);
    });
  }

};

section.init();

var add2basket = {

  opts: {
    buy: '.js-add2basket',
    modal: '.js-add2basket-modal'
  },

  init: function() {
    add2basket.buyHandler();
    add2basket.modalCreate();
    add2basket.modalHandler();
  },

  buyHandler: function() {
    $(add2basket.opts.buy).click(function() {
      var url = $(this).attr('href');
      $.ajax({
        type: 'post',
        url: url,
        cached: false,
        success: function(t) {
          add2basket.modalShow();
          console.log(t);
          setTimeout(add2basket.modalHide, 1500);
        }
      });
      return false;
    });
  },

  modalCreate: function() {
    var modal = '';
    modal += '<div class="add2basket-modal js-add2basket-modal">';
    modal += '<div class="add2basket-modal__in">';
    modal += 'Товар успешно добавлен в корзину!';
    modal += '</div></div>';
    $(modal).appendTo($('body'));
  },

  modalHandler: function() {
    $(add2basket.opts.modal).click(add2basket.modalHide);
  },

  modalShow: function() {
    $(add2basket.opts.modal).css('display', 'block');
  },

  modalHide: function() {
    $(add2basket.opts.modal).css('display', 'none');
  }

};

add2basket.init();

var catalog = {

  handlerPriceStatus: true,
  handlerProductionStatus: true,
  loader: {},
  pages: [],
  loading: [],
  priceFilter: [],
  productionFilter: [],
  sales: 0,
  id: 0,
  zoom: 1,
  height: 0,
  elHeight: 0,

  init: function() {
    this.loader = $('.loader');
    $('.js-section').each(function() {
      var id = parseInt($(this).data('id').substr(2));
      catalog.pages[id] = 1;
      catalog.loading[id] = false;
      catalog.priceFilter[id] = 0;
      catalog.productionFilter[id] = 0;
    });
    if ($('[name=sales]').length) this.sales = 1;
    this.setId();
    this.setZoom();
    this.setElHeight();
    this.setHeight();
    this.handlerScroll();
    this.handlerPrice();
    this.handlerProduction();
  },

  handlerScroll: function() {
    $(window).scroll(function() {
      if (scrollY > catalog.height && !catalog.loading[catalog.id]) catalog.loadMore();
    });
  },

  handlerPrice: function() {
    $('.jsd-priceFilter').on('change', function() {
      if (catalog.handlerPriceStatus) {
        catalog.handlerPriceStatus = false;
        catalog.sortByPrice($(this).val());
        setTimeout(function() {
          catalog.handlerPriceStatus = true;
        },500);
      }
    });
  },

  handlerProduction: function() {
    $('.jsd-productionFilter').on('change', function() {
      if (catalog.handlerProductionStatus) {
        catalog.handlerProductionStatus = false;
        catalog.sortByProduction($(this).val());
        setTimeout(function() {
          catalog.handlerProductionStatus = true;
        },500);
      }
    });
  },

  setZoom: function() {
    var cookie = "; " + document.cookie, cookieParts = cookie.split("; clientZoom=");
    if (cookieParts.length == 2) this.zoom = cookieParts.pop().split(";").shift();
    else this.zoom = 1;
  },

  setElHeight: function() {
    this.elHeight = parseInt($('.product').css('height'));
  },

  setHeight: function() {
    this.height = parseInt($('.js-section.active .js-section-end').offset().top) - this.elHeight;
  },

  setId: function() {
    this.id = $('.js-section.active').data('id').substr(2);
  },

  loadMore: function() {
    this.loading[this.id] = true;
    this.showLoader();
    this.pages[this.id]++;
    $.ajax({
      url: '/catalog/load.php',
      type: 'post',
      cache: false,
      async: true,
      data: {
        ajax: true,
        page: catalog.pages[catalog.id],
        id: catalog.id,
        priceFilter: catalog.priceFilter[catalog.id],
        productionFilter: catalog.productionFilter[catalog.id],
        sales: catalog.sales
      },
      success: function(response) {
        if (response != '') {
          var json = JSON.parse(response), str = '';
          for (var i = 0; i < json.length; i++) str += catalog.printNew(json[i]['URL'], json[i]['PREVIEW_PICTURE'], json[i]['NAME'], json[i]['PROPERTY_ARTICLE_VALUE'], json[i]['PRICE'], json[i]['ADD_URL']);
          catalog.addToSection(str);
          catalog.setHeight();
          catalog.loading[catalog.id] = false;
        }
        catalog.hideLoader();
      }
    });
  },

  printNew: function(url, img, name, art, price, add) {
    var str = '';
    str += '<div class="product"><div class="product__pic">'
        + '<a href="' + url + '"><img src="' + img + '" alt="' + name + '"></a></div>'
        + '<div class="product__title">' + name + '</div>'
        + '<div class="product__code">арт. ' + art + '</div>'
        + '<div class="product__details">'
        + '<div class="product__price">' + price + ' <i class="icon-rub"></i></div>'
        + '<div class="product__buy">'
        + '<a class="btn btn_small btn_green js-add2basket" href="' + add + '">В корзину</a>'
        + '</div></div></div>';
    return str;
  },

  hideLoader: function() {
    this.loader.css('display', 'none');
  },

  showLoader: function() {
    this.loader.css('display', 'block');
  },

  sortByPrice: function(priceFilter) {
    this.priceFilter[this.id] = priceFilter;
    this.sort();
  },

  sortByProduction: function(productionFilter) {
    this.productionFilter[this.id] = productionFilter;
    this.sort();
  },

  sort: function() {
    this.pages[this.id] = 0;
    this.clearSection();
    this.loadMore();
  },

  clearSection: function() {
    $('.js-section.active .d_tabproducts').html('');
  },

  addToSection: function(str) {
    $(str).appendTo($('.js-section.active .d_tabproducts'));
  }

};

$(function() {
  if ($('select').length) $('select').selectric();
});

if ($('.page_not').length) {
  $('.d_tabs').removeClass('d_tabs');
  $('.domtab').removeClass('domtab');
}