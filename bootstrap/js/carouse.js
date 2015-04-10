/**
 * Created by jypierre on 4/7/2015.
 */
/*
 *dbpasCarousel - another jquery carousel plugin!
 *version 0.1
 *copyright(c) 2013, dbpas llc, http://www.dbpas.com/
 *dual licensed under mit and gpl
 *
 *inspired by http://web.enavu.com/tutorials/making-an-infinite-jquery-carousel/
 *
 */

//polyfill, object.create
if (!Object.create) {
    Object.create = (function(){
        function F(){}
        return function(o){
            if (arguments.length != 1) {
                throw new Error('Object.create implementation only accepts one parameter.');
            }
            F.prototype = o;
            return new F()
        }
    })();
}

;(function($, win, doc, undefined) {
    'use strict';

    function destroy(elem) {
        var $data = $.data($(elem)[0], 'dbpasCarousel');                                //get jquery data to remove timer

        if ($data) {
            clearInterval($data.timerHandle);                                       //remove timer

            $(elem).parent().parent().find('*').off('.dbpasCarousel');              //remove all events on descendants

            $(elem).unwrap().unwrap().siblings('[data-carousel-control]').remove(); //remove control structure around ul
            $(elem).find('.caption').remove();                                      //remove any image captions
            $(elem).removeAttr('style').children().removeAttr('style');             //remove inline styles

            $(elem).removeData('dbpasCarousel');                                    //remove jquery data
        }else{
            console.log('dbpasCarousel: unable to destroy selected element!');
        }
    }

    var Carousel = {
        init: function(options, elem) {
            var self = this;

            self.elem = elem;
            self.$elem = $(elem);

            self.options = $.extend({}, $.fn.dbpasCarousel.options, options);

            self.timerHandle = null;
            self.$queue = $({});

            self.build(); //build control structure around ul

            self.$wrapper = self.$elem.parent();
            self.$controlLeft = self.$wrapper.siblings('[data-carousel-control="left"]');
            self.$controlRight =  self.$wrapper.siblings('[data-carousel-control="right"]');
            self.$li = self.$elem.find('li'),

                self.maxOuterWidth = 0;
            self.maxWidth = 0;

            self.$li.each(function() {
                if ($(this).outerWidth() >= self.maxOuterWidth) {                                             //get max width to apply to all items for smooth movement
                    self.maxOuterWidth = $(this).outerWidth();
                    self.maxWidth = $(this).width();
                }
                if (self.options.imgCaption && $(this).find('img:first').attr('alt')) {                       //image caption enabled, assume first image alt is caption
                    $(this).append($('<p/>').addClass('caption').html($(this).find('img:first').attr('alt')));
                }
            });

            self.$li.css({'width': (self.maxWidth) + 'px'});                                                //give all items uniform width for smooth movement
            self.$wrapper.css({'max-width': (self.maxOuterWidth * self.options.itemsVisible) + 'px'});      //adjust wrapper width to show X items
            self.$elem.css({'left': '-' + self.maxOuterWidth + 'px'});                                      //move list to the left of view by 1 item width
            self.$elem.find('li:first').before($(self.$elem.find('li:last')));                              //makes sure first item is showing

            self.events();

            self.complete();
        },

        build: function() {
            var self = this;

            //wrap ul by 2 divs for formating and add navigation controls
            self.$elem.wrap($('<div />').attr('data-carousel-name', self.$elem.attr('id') || '')).wrap($('<div />').attr('data-carousel-control', 'wrapper'));
            self.$elem.parent().parent().prepend($('<div />').attr('data-carousel-control', 'left').html('&laquo;')).append($('<div />').attr('data-carousel-control', 'right').html('&raquo;'));
        },

        navigation: function(direction) {
            var self = this;

            self.leftIndent = 0;

            if (direction == 'right') {
                self.leftIndent = parseInt(self.$elem.css('left')) + self.maxOuterWidth;  //move list to the right of view by 1 item width
                self.$queue.queue('dbpasCarouselMove', function(next) {                   //queue the moving of item to front of list to be dequeued in animation
                    self.$elem.find('li:first').before($(self.$elem.find('li:last')));
                    next();
                });
            }else{
                self.leftIndent = parseInt(self.$elem.css('left')) - self.maxOuterWidth;  //move list to the left of view by 1 item width
                self.$queue.queue('dbpasCarouselMove', function(next) {                   //queue the moving of item to back of list to be dequeued in animation
                    self.$elem.find('li:last').after($(self.$elem.find('li:first')));
                    next();
                });
            }

            self.$elem.not(':animated').animate(
                {'left': self.leftIndent},
                self.options.slideDelay,
                function() {
                    self.$queue.dequeue('dbpasCarouselMove');                   //move item to front/back of list
                    self.$elem.css({'left': '-' + self.maxOuterWidth + 'px'});  //move list to the left/right of view by 1 item width
                }
            );
        },

        timer: function(action) {
            var self = this;

            if (action == 'start') {
                self.timerHandle = setInterval(function() {
                    self.navigation('left');                        //auto slide always goes left
                }, self.options.autoDelay);
            }else{
                clearInterval(self.timerHandle);
            }
        },

        events: function() {
            var self = this, eventNS = '.dbpasCarousel',
                pauseActionStart, pauseActionStop, controlAction;

            if ('ontouchstart' in doc.documentElement) {              //check for touch events
                controlAction = 'touchstart' + eventNS;
                pauseActionStart = 'touchstart' + eventNS;
                pauseActionStop = 'touchend' + eventNS;
            }else{
                controlAction = 'click' + eventNS;
                pauseActionStart = 'mouseenter' + eventNS;
                pauseActionStop = 'mouseleave' + eventNS;
                $('body').addClass('no-touch');                   //add class to disable :hover
            }

            if (self.options.autoSlide) {
                self.timer('start');

                if (self.options.hoverPause) {
                    self.$wrapper.parent().on(pauseActionStart, function() {
                        self.timer('stop');
                    });

                    self.$wrapper.parent().on(pauseActionStop, function() {
                        self.timer('start');
                    });
                }
            }
            /*! jCarousel - v0.3.3 - 2015-02-28
             * http://sorgalla.com/jcarousel/
             * Copyright (c) 2006-2015 Jan Sorgalla; Licensed MIT */
            (function($) {
                'use strict';

                var jCarousel = $.jCarousel = {};

                jCarousel.version = '0.3.3';

                var rRelativeTarget = /^([+\-]=)?(.+)$/;

                jCarousel.parseTarget = function(target) {
                    var relative = false,
                        parts    = typeof target !== 'object' ?
                            rRelativeTarget.exec(target) :
                            null;

                    if (parts) {
                        target = parseInt(parts[2], 10) || 0;

                        if (parts[1]) {
                            relative = true;
                            if (parts[1] === '-=') {
                                target *= -1;
                            }
                        }
                    } else if (typeof target !== 'object') {
                        target = parseInt(target, 10) || 0;
                    }

                    return {
                        target: target,
                        relative: relative
                    };
                };

                jCarousel.detectCarousel = function(element) {
                    var carousel;

                    while (element.length > 0) {
                        carousel = element.filter('[data-jcarousel]');

                        if (carousel.length > 0) {
                            return carousel;
                        }

                        carousel = element.find('[data-jcarousel]');

                        if (carousel.length > 0) {
                            return carousel;
                        }

                        element = element.parent();
                    }

                    return null;
                };

                jCarousel.base = function(pluginName) {
                    return {
                        version:  jCarousel.version,
                        _options:  {},
                        _element:  null,
                        _carousel: null,
                        _init:     $.noop,
                        _create:   $.noop,
                        _destroy:  $.noop,
                        _reload:   $.noop,
                        create: function() {
                            this._element
                                .attr('data-' + pluginName.toLowerCase(), true)
                                .data(pluginName, this);

                            if (false === this._trigger('create')) {
                                return this;
                            }

                            this._create();

                            this._trigger('createend');

                            return this;
                        },
                        destroy: function() {
                            if (false === this._trigger('destroy')) {
                                return this;
                            }

                            this._destroy();

                            this._trigger('destroyend');

                            this._element
                                .removeData(pluginName)
                                .removeAttr('data-' + pluginName.toLowerCase());

                            return this;
                        },
                        reload: function(options) {
                            if (false === this._trigger('reload')) {
                                return this;
                            }

                            if (options) {
                                this.options(options);
                            }

                            this._reload();

                            this._trigger('reloadend');

                            return this;
                        },
                        element: function() {
                            return this._element;
                        },
                        options: function(key, value) {
                            if (arguments.length === 0) {
                                return $.extend({}, this._options);
                            }

                            if (typeof key === 'string') {
                                if (typeof value === 'undefined') {
                                    return typeof this._options[key] === 'undefined' ?
                                        null :
                                        this._options[key];
                                }

                                this._options[key] = value;
                            } else {
                                this._options = $.extend({}, this._options, key);
                            }

                            return this;
                        },
                        carousel: function() {
                            if (!this._carousel) {
                                this._carousel = jCarousel.detectCarousel(this.options('carousel') || this._element);

                                if (!this._carousel) {
                                    $.error('Could not detect carousel for plugin "' + pluginName + '"');
                                }
                            }

                            return this._carousel;
                        },
                        _trigger: function(type, element, data) {
                            var event,
                                defaultPrevented = false;

                            data = [this].concat(data || []);

                            (element || this._element).each(function() {
                                event = $.Event((pluginName + ':' + type).toLowerCase());

                                $(this).trigger(event, data);

                                if (event.isDefaultPrevented()) {
                                    defaultPrevented = true;
                                }
                            });

                            return !defaultPrevented;
                        }
                    };
                };

                jCarousel.plugin = function(pluginName, pluginPrototype) {
                    var Plugin = $[pluginName] = function(element, options) {
                        this._element = $(element);
                        this.options(options);

                        this._init();
                        this.create();
                    };

                    Plugin.fn = Plugin.prototype = $.extend(
                        {},
                        jCarousel.base(pluginName),
                        pluginPrototype
                    );

                    $.fn[pluginName] = function(options) {
                        var args        = Array.prototype.slice.call(arguments, 1),
                            returnValue = this;

                        if (typeof options === 'string') {
                            this.each(function() {
                                var instance = $(this).data(pluginName);

                                if (!instance) {
                                    return $.error(
                                        'Cannot call methods on ' + pluginName + ' prior to initialization; ' +
                                        'attempted to call method "' + options + '"'
                                    );
                                }

                                if (!$.isFunction(instance[options]) || options.charAt(0) === '_') {
                                    return $.error(
                                        'No such method "' + options + '" for ' + pluginName + ' instance'
                                    );
                                }

                                var methodValue = instance[options].apply(instance, args);

                                if (methodValue !== instance && typeof methodValue !== 'undefined') {
                                    returnValue = methodValue;
                                    return false;
                                }
                            });
                        } else {
                            this.each(function() {
                                var instance = $(this).data(pluginName);

                                if (instance instanceof Plugin) {
                                    instance.reload(options);
                                } else {
                                    new Plugin(this, options);
                                }
                            });
                        }

                        return returnValue;
                    };

                    return Plugin;
                };
            }(jQuery));

            (function($, window) {
                'use strict';

                var toFloat = function(val) {
                    return parseFloat(val) || 0;
                };

                $.jCarousel.plugin('jcarousel', {
                    animating:   false,
                    tail:        0,
                    inTail:      false,
                    resizeTimer: null,
                    lt:          null,
                    vertical:    false,
                    rtl:         false,
                    circular:    false,
                    underflow:   false,
                    relative:    false,

                    _options: {
                        list: function() {
                            return this.element().children().eq(0);
                        },
                        items: function() {
                            return this.list().children();
                        },
                        animation:   400,
                        transitions: false,
                        wrap:        null,
                        vertical:    null,
                        rtl:         null,
                        center:      false
                    },

                    // Protected, don't access directly
                    _list:         null,
                    _items:        null,
                    _target:       $(),
                    _first:        $(),
                    _last:         $(),
                    _visible:      $(),
                    _fullyvisible: $(),
                    _init: function() {
                        var self = this;

                        this.onWindowResize = function() {
                            if (self.resizeTimer) {
                                clearTimeout(self.resizeTimer);
                            }

                            self.resizeTimer = setTimeout(function() {
                                self.reload();
                            }, 100);
                        };

                        return this;
                    },
                    _create: function() {
                        this._reload();

                        $(window).on('resize.jcarousel', this.onWindowResize);
                    },
                    _destroy: function() {
                        $(window).off('resize.jcarousel', this.onWindowResize);
                    },
                    _reload: function() {
                        this.vertical = this.options('vertical');

                        if (this.vertical == null) {
                            this.vertical = this.list().height() > this.list().width();
                        }

                        this.rtl = this.options('rtl');

                        if (this.rtl == null) {
                            this.rtl = (function(element) {
                                if (('' + element.attr('dir')).toLowerCase() === 'rtl') {
                                    return true;
                                }

                                var found = false;

                                element.parents('[dir]').each(function() {
                                    if ((/rtl/i).test($(this).attr('dir'))) {
                                        found = true;
                                        return false;
                                    }
                                });

                                return found;
                            }(this._element));
                        }

                        this.lt = this.vertical ? 'top' : 'left';

                        // Ensure before closest() call
                        this.relative = this.list().css('position') === 'relative';

                        // Force list and items reload
                        this._list  = null;
                        this._items = null;

                        var item = this.index(this._target) >= 0 ?
                            this._target :
                            this.closest();

                        // _prepare() needs this here
                        this.circular  = this.options('wrap') === 'circular';
                        this.underflow = false;

                        var props = {'left': 0, 'top': 0};

                        if (item.length > 0) {
                            this._prepare(item);
                            this.list().find('[data-jcarousel-clone]').remove();

                            // Force items reload
                            this._items = null;

                            this.underflow = this._fullyvisible.length >= this.items().length;
                            this.circular  = this.circular && !this.underflow;

                            props[this.lt] = this._position(item) + 'px';
                        }

                        this.move(props);

                        return this;
                    },
                    list: function() {
                        if (this._list === null) {
                            var option = this.options('list');
                            this._list = $.isFunction(option) ? option.call(this) : this._element.find(option);
                        }

                        return this._list;
                    },
                    items: function() {
                        if (this._items === null) {
                            var option = this.options('items');
                            this._items = ($.isFunction(option) ? option.call(this) : this.list().find(option)).not('[data-jcarousel-clone]');
                        }

                        return this._items;
                    },
                    index: function(item) {
                        return this.items().index(item);
                    },
                    closest: function() {
                        var self    = this,
                            pos     = this.list().position()[this.lt],
                            closest = $(), // Ensure we're returning a jQuery instance
                            stop    = false,
                            lrb     = this.vertical ? 'bottom' : (this.rtl && !this.relative ? 'left' : 'right'),
                            width;

                        if (this.rtl && this.relative && !this.vertical) {
                            pos += this.list().width() - this.clipping();
                        }

                        this.items().each(function() {
                            closest = $(this);

                            if (stop) {
                                return false;
                            }

                            var dim = self.dimension(closest);

                            pos += dim;

                            if (pos >= 0) {
                                width = dim - toFloat(closest.css('margin-' + lrb));

                                if ((Math.abs(pos) - dim + (width / 2)) <= 0) {
                                    stop = true;
                                } else {
                                    return false;
                                }
                            }
                        });


                        return closest;
                    },
                    target: function() {
                        return this._target;
                    },
                    first: function() {
                        return this._first;
                    },
                    last: function() {
                        return this._last;
                    },
                    visible: function() {
                        return this._visible;
                    },
                    fullyvisible: function() {
                        return this._fullyvisible;
                    },
                    hasNext: function() {
                        if (false === this._trigger('hasnext')) {
                            return true;
                        }

                        var wrap = this.options('wrap'),
                            end = this.items().length - 1,
                            check = this.options('center') ? this._target : this._last;

                        return end >= 0 && !this.underflow &&
                        ((wrap && wrap !== 'first') ||
                        (this.index(check) < end) ||
                        (this.tail && !this.inTail)) ? true : false;
                    },
                    hasPrev: function() {
                        if (false === this._trigger('hasprev')) {
                            return true;
                        }

                        var wrap = this.options('wrap');

                        return this.items().length > 0 && !this.underflow &&
                        ((wrap && wrap !== 'last') ||
                        (this.index(this._first) > 0) ||
                        (this.tail && this.inTail)) ? true : false;
                    },
                    clipping: function() {
                        return this._element['inner' + (this.vertical ? 'Height' : 'Width')]();
                    },
                    dimension: function(element) {
                        return element['outer' + (this.vertical ? 'Height' : 'Width')](true);
                    },
                    scroll: function(target, animate, callback) {
                        if (this.animating) {
                            return this;
                        }

                        if (false === this._trigger('scroll', null, [target, animate])) {
                            return this;
                        }

                        if ($.isFunction(animate)) {
                            callback = animate;
                            animate  = true;
                        }

                        var parsed = $.jCarousel.parseTarget(target);

                        if (parsed.relative) {
                            var end    = this.items().length - 1,
                                scroll = Math.abs(parsed.target),
                                wrap   = this.options('wrap'),
                                current,
                                first,
                                index,
                                start,
                                curr,
                                isVisible,
                                props,
                                i;

                            if (parsed.target > 0) {
                                var last = this.index(this._last);

                                if (last >= end && this.tail) {
                                    if (!this.inTail) {
                                        this._scrollTail(animate, callback);
                                    } else {
                                        if (wrap === 'both' || wrap === 'last') {
                                            this._scroll(0, animate, callback);
                                        } else {
                                            if ($.isFunction(callback)) {
                                                callback.call(this, false);
                                            }
                                        }
                                    }
                                } else {
                                    current = this.index(this._target);

                                    if ((this.underflow && current === end && (wrap === 'circular' || wrap === 'both' || wrap === 'last')) ||
                                        (!this.underflow && last === end && (wrap === 'both' || wrap === 'last'))) {
                                        this._scroll(0, animate, callback);
                                    } else {
                                        index = current + scroll;

                                        if (this.circular && index > end) {
                                            i = end;
                                            curr = this.items().get(-1);

                                            while (i++ < index) {
                                                curr = this.items().eq(0);
                                                isVisible = this._visible.index(curr) >= 0;

                                                if (isVisible) {
                                                    curr.after(curr.clone(true).attr('data-jcarousel-clone', true));
                                                }

                                                this.list().append(curr);

                                                if (!isVisible) {
                                                    props = {};
                                                    props[this.lt] = this.dimension(curr);
                                                    this.moveBy(props);
                                                }

                                                // Force items reload
                                                this._items = null;
                                            }

                                            this._scroll(curr, animate, callback);
                                        } else {
                                            this._scroll(Math.min(index, end), animate, callback);
                                        }
                                    }
                                }
                            } else {
                                if (this.inTail) {
                                    this._scroll(Math.max((this.index(this._first) - scroll) + 1, 0), animate, callback);
                                } else {
                                    first  = this.index(this._first);
                                    current = this.index(this._target);
                                    start  = this.underflow ? current : first;
                                    index  = start - scroll;

                                    if (start <= 0 && ((this.underflow && wrap === 'circular') || wrap === 'both' || wrap === 'first')) {
                                        this._scroll(end, animate, callback);
                                    } else {
                                        if (this.circular && index < 0) {
                                            i    = index;
                                            curr = this.items().get(0);

                                            while (i++ < 0) {
                                                curr = this.items().eq(-1);
                                                isVisible = this._visible.index(curr) >= 0;

                                                if (isVisible) {
                                                    curr.after(curr.clone(true).attr('data-jcarousel-clone', true));
                                                }

                                                this.list().prepend(curr);

                                                // Force items reload
                                                this._items = null;

                                                var dim = this.dimension(curr);

                                                props = {};
                                                props[this.lt] = -dim;
                                                this.moveBy(props);

                                            }

                                            this._scroll(curr, animate, callback);
                                        } else {
                                            this._scroll(Math.max(index, 0), animate, callback);
                                        }
                                    }
                                }
                            }
                        } else {
                            this._scroll(parsed.target, animate, callback);
                        }

                        this._trigger('scrollend');

                        return this;
                    },
                    moveBy: function(properties, opts) {
                        var position = this.list().position(),
                            multiplier = 1,
                            correction = 0;

                        if (this.rtl && !this.vertical) {
                            multiplier = -1;

                            if (this.relative) {
                                correction = this.list().width() - this.clipping();
                            }
                        }

                        if (properties.left) {
                            properties.left = (position.left + correction + toFloat(properties.left) * multiplier) + 'px';
                        }

                        if (properties.top) {
                            properties.top = (position.top + correction + toFloat(properties.top) * multiplier) + 'px';
                        }

                        return this.move(properties, opts);
                    },
                    move: function(properties, opts) {
                        opts = opts || {};

                        var option       = this.options('transitions'),
                            transitions  = !!option,
                            transforms   = !!option.transforms,
                            transforms3d = !!option.transforms3d,
                            duration     = opts.duration || 0,
                            list         = this.list();

                        if (!transitions && duration > 0) {
                            list.animate(properties, opts);
                            return;
                        }

                        var complete = opts.complete || $.noop,
                            css = {};

                        if (transitions) {
                            var backup = {
                                    transitionDuration: list.css('transitionDuration'),
                                    transitionTimingFunction: list.css('transitionTimingFunction'),
                                    transitionProperty: list.css('transitionProperty')
                                },
                                oldComplete = complete;

                            complete = function() {
                                $(this).css(backup);
                                oldComplete.call(this);
                            };
                            css = {
                                transitionDuration: (duration > 0 ? duration / 1000 : 0) + 's',
                                transitionTimingFunction: option.easing || opts.easing,
                                transitionProperty: duration > 0 ? (function() {
                                    if (transforms || transforms3d) {
                                        // We have to use 'all' because jQuery doesn't prefix
                                        // css values, like transition-property: transform;
                                        return 'all';
                                    }

                                    return properties.left ? 'left' : 'top';
                                })() : 'none',
                                transform: 'none'
                            };
                        }

                        if (transforms3d) {
                            css.transform = 'translate3d(' + (properties.left || 0) + ',' + (properties.top || 0) + ',0)';
                        } else if (transforms) {
                            css.transform = 'translate(' + (properties.left || 0) + ',' + (properties.top || 0) + ')';
                        } else {
                            $.extend(css, properties);
                        }

                        if (transitions && duration > 0) {
                            list.one('transitionend webkitTransitionEnd oTransitionEnd otransitionend MSTransitionEnd', complete);
                        }

                        list.css(css);

                        if (duration <= 0) {
                            list.each(function() {
                                complete.call(this);
                            });
                        }
                    },
                    _scroll: function(item, animate, callback) {
                        if (this.animating) {
                            if ($.isFunction(callback)) {
                                callback.call(this, false);
                            }

                            return this;
                        }

                        if (typeof item !== 'object') {
                            item = this.items().eq(item);
                        } else if (typeof item.jquery === 'undefined') {
                            item = $(item);
                        }

                        if (item.length === 0) {
                            if ($.isFunction(callback)) {
                                callback.call(this, false);
                            }

                            return this;
                        }

                        this.inTail = false;

                        this._prepare(item);

                        var pos     = this._position(item),
                            currPos = this.list().position()[this.lt];

                        if (pos === currPos) {
                            if ($.isFunction(callback)) {
                                callback.call(this, false);
                            }

                            return this;
                        }

                        var properties = {};
                        properties[this.lt] = pos + 'px';

                        this._animate(properties, animate, callback);

                        return this;
                    },
                    _scrollTail: function(animate, callback) {
                        if (this.animating || !this.tail) {
                            if ($.isFunction(callback)) {
                                callback.call(this, false);
                            }

                            return this;
                        }

                        var pos = this.list().position()[this.lt];

                        if (this.rtl && this.relative && !this.vertical) {
                            pos += this.list().width() - this.clipping();
                        }

                        if (this.rtl && !this.vertical) {
                            pos += this.tail;
                        } else {
                            pos -= this.tail;
                        }

                        this.inTail = true;

                        var properties = {};
                        properties[this.lt] = pos + 'px';

                        this._update({
                            target:       this._target.next(),
                            fullyvisible: this._fullyvisible.slice(1).add(this._visible.last())
                        });

                        this._animate(properties, animate, callback);

                        return this;
                    },
                    _animate: function(properties, animate, callback) {
                        callback = callback || $.noop;

                        if (false === this._trigger('animate')) {
                            callback.call(this, false);
                            return this;
                        }

                        this.animating = true;

                        var animation = this.options('animation'),
                            complete  = $.proxy(function() {
                                this.animating = false;

                                var c = this.list().find('[data-jcarousel-clone]');

                                if (c.length > 0) {
                                    c.remove();
                                    this._reload();
                                }

                                this._trigger('animateend');

                                callback.call(this, true);
                            }, this);

                        var opts = typeof animation === 'object' ?
                                $.extend({}, animation) :
                            {duration: animation},
                            oldComplete = opts.complete || $.noop;

                        if (animate === false) {
                            opts.duration = 0;
                        } else if (typeof $.fx.speeds[opts.duration] !== 'undefined') {
                            opts.duration = $.fx.speeds[opts.duration];
                        }

                        opts.complete = function() {
                            complete();
                            oldComplete.call(this);
                        };

                        this.move(properties, opts);

                        return this;
                    },
                    _prepare: function(item) {
                        var index  = this.index(item),
                            idx    = index,
                            wh     = this.dimension(item),
                            clip   = this.clipping(),
                            lrb    = this.vertical ? 'bottom' : (this.rtl ? 'left'  : 'right'),
                            center = this.options('center'),
                            update = {
                                target:       item,
                                first:        item,
                                last:         item,
                                visible:      item,
                                fullyvisible: wh <= clip ? item : $()
                            },
                            curr,
                            isVisible,
                            margin,
                            dim;

                        if (center) {
                            wh /= 2;
                            clip /= 2;
                        }

                        if (wh < clip) {
                            while (true) {
                                curr = this.items().eq(++idx);

                                if (curr.length === 0) {
                                    if (!this.circular) {
                                        break;
                                    }

                                    curr = this.items().eq(0);

                                    if (item.get(0) === curr.get(0)) {
                                        break;
                                    }

                                    isVisible = this._visible.index(curr) >= 0;

                                    if (isVisible) {
                                        curr.after(curr.clone(true).attr('data-jcarousel-clone', true));
                                    }

                                    this.list().append(curr);

                                    if (!isVisible) {
                                        var props = {};
                                        props[this.lt] = this.dimension(curr);
                                        this.moveBy(props);
                                    }

                                    // Force items reload
                                    this._items = null;
                                }

                                dim = this.dimension(curr);

                                if (dim === 0) {
                                    break;
                                }

                                wh += dim;

                                update.last    = curr;
                                update.visible = update.visible.add(curr);

                                // Remove right/bottom margin from total width
                                margin = toFloat(curr.css('margin-' + lrb));

                                if ((wh - margin) <= clip) {
                                    update.fullyvisible = update.fullyvisible.add(curr);
                                }

                                if (wh >= clip) {
                                    break;
                                }
                            }
                        }

                        if (!this.circular && !center && wh < clip) {
                            idx = index;

                            while (true) {
                                if (--idx < 0) {
                                    break;
                                }

                                curr = this.items().eq(idx);

                                if (curr.length === 0) {
                                    break;
                                }

                                dim = this.dimension(curr);

                                if (dim === 0) {
                                    break;
                                }

                                wh += dim;

                                update.first   = curr;
                                update.visible = update.visible.add(curr);

                                // Remove right/bottom margin from total width
                                margin = toFloat(curr.css('margin-' + lrb));

                                if ((wh - margin) <= clip) {
                                    update.fullyvisible = update.fullyvisible.add(curr);
                                }

                                if (wh >= clip) {
                                    break;
                                }
                            }
                        }

                        this._update(update);

                        this.tail = 0;

                        if (!center &&
                            this.options('wrap') !== 'circular' &&
                            this.options('wrap') !== 'custom' &&
                            this.index(update.last) === (this.items().length - 1)) {

                            // Remove right/bottom margin from total width
                            wh -= toFloat(update.last.css('margin-' + lrb));

                            if (wh > clip) {
                                this.tail = wh - clip;
                            }
                        }

                        return this;
                    },
                    _position: function(item) {
                        var first  = this._first,
                            pos    = first.position()[this.lt],
                            center = this.options('center'),
                            centerOffset = center ? (this.clipping() / 2) - (this.dimension(first) / 2) : 0;

                        if (this.rtl && !this.vertical) {
                            if (this.relative) {
                                pos -= this.list().width() - this.dimension(first);
                            } else {
                                pos -= this.clipping() - this.dimension(first);
                            }

                            pos += centerOffset;
                        } else {
                            pos -= centerOffset;
                        }

                        if (!center &&
                            (this.index(item) > this.index(first) || this.inTail) &&
                            this.tail) {
                            pos = this.rtl && !this.vertical ? pos - this.tail : pos + this.tail;
                            this.inTail = true;
                        } else {
                            this.inTail = false;
                        }

                        return -pos;
                    },
                    _update: function(update) {
                        var self = this,
                            current = {
                                target:       this._target,
                                first:        this._first,
                                last:         this._last,
                                visible:      this._visible,
                                fullyvisible: this._fullyvisible
                            },
                            back = this.index(update.first || current.first) < this.index(current.first),
                            key,
                            doUpdate = function(key) {
                                var elIn  = [],
                                    elOut = [];

                                update[key].each(function() {
                                    if (current[key].index(this) < 0) {
                                        elIn.push(this);
                                    }
                                });

                                current[key].each(function() {
                                    if (update[key].index(this) < 0) {
                                        elOut.push(this);
                                    }
                                });

                                if (back) {
                                    elIn = elIn.reverse();
                                } else {
                                    elOut = elOut.reverse();
                                }

                                self._trigger(key + 'in', $(elIn));
                                self._trigger(key + 'out', $(elOut));

                                self['_' + key] = update[key];
                            };

                        for (key in update) {
                            doUpdate(key);
                        }

                        return this;
                    }
                });
            }(jQuery, window));
            self.$controlLeft.on(controlAction, function() {
                self.navigation('left');
            });

            self.$controlRight.on(controlAction, function() {
                self.navigation('right');
            });
        },

        complete: function() {
            var self = this;

            if (typeof self.options.onComplete === 'function') {
                self.options.onComplete.apply(self.$elem);
            }
        }
    };

    $.fn.dbpasCarousel = function(options) {
        return this.each(function() {
            if (this.tagName.toLowerCase() == 'ul') {  //must be ul to work
                if (typeof options === 'string') {
                    switch(options.toLowerCase()) {
                        case 'destroy':
                            destroy(this);
                            break;
                        default:
                            console.log('dbpasCarousel: "' + options + '" is an invalid method!');
                    }
                }else{
                    var carousel = Object.create(Carousel);

                    carousel.init(options, this);

                    $.data(this, 'dbpasCarousel', carousel); //make data available for later use
                }
            }else{
                console.log('dbpasCarousel: selected element is not a "UL"!');
            }
        });
    };

    $.fn.dbpasCarousel.options = {
        itemsVisible: 2,  //for smooth movement, leave at a minimum 2 items out of view
        slideDelay: 500,  //milliseconds
        autoSlide: 0,     //0-off 1-on
        autoDelay: 5000,  //milliseconds
        hoverPause: 1,    //0-off 1-on
        imgCaption: 1,    //0-off 1-on
        onComplete: null  //callback function
    };

})(jQuery, window, document);