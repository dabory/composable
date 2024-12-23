!(function ($, undefined) {
    $.fn.getSelector = function () {
        if (!this || !this.length) {
            return ;
        }

        function _getChildSelector(index) {
            if (typeof index === 'undefined') {
                return '';
            }

            index = index + 1;
            return ':nth-child(' + index + ')';
        }

        function _getIdAndClassNames($el) {
            var selector = '';

            // attach id if exists
            var elId = $el.attr('id');
            if(elId){
                selector += '#' + elId;
            }

            // attach class names if exists
            var classNames = $el.attr('class');
            if(classNames){
                selector += '.' + classNames.replace(/^\s+|\s+$/g, '').replace(/\s/gi, '.');
            }

            return selector;
        }

        // get all parents siblings index and element's tag name,
        // except html and body elements
        var selector = this.parents(':not(html,body)')
            .map(function() {
                var parentIndex = $(this).index();

                return this.tagName + _getChildSelector(parentIndex);
            })
            .get()
            .reverse()
            .join(' ');

        if (selector) {
            // get node name from the element itself
            selector += ' ' + this[0].nodeName +
                // get child selector from element ifself
                _getChildSelector(this.index());
        }

        selector += _getIdAndClassNames(this);

        return selector;
    }

})(window.jQuery);
