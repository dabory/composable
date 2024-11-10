/**
 * chatUI constructor
 * @constructor
 * @param {d3-selection} container - Container for the chat interface.
 * @return {object} chatUI object
 */
var chatUI = (function (container) {

    var module = {};

    module.chatbot = container.append('div').attr('id', 'cb-chatbot');
    module.chatbotButton = container.append('button').attr('id', 'cb-chatbot-button');
    module.chatbotButton.append('div').attr('class', 'cb-sc-krNlru');

    module.container = module.chatbot.append('div').attr('id', 'cb-container');
    module.config = null;
    module.bubbles = [];
    module.ID = 0;
    module.keys = {};
    module.types = {};
    module.inputState = false;
    module.height = 0;

    module.container.html(`
        <div class="cb-top">
            <button type="button" id="zoom-btn"><img id="cb-zoom-img" src="/chat-ui/build/assets/icn_big.svg" alt="big"></button>
            <button type="button" id="close-btn"><img src="/chat-ui/build/assets/icn_cls.svg" alt="close"></button>
        </div>
        <div id="cb-header">
            <div id="cb-title">
                <div class="cb-icon"></div>
                <p id="cb-text">다보리 AI 매니저</p></div>
                <div class="cb-setting cb-topicn">
                    <div class="cb-dropdown">
                        <button type="button" id="select-ai-btn"><img src="/chat-ui/build/assets/icn_gpt.svg" alt="chat gpt"></button>
                        <div class="cb-dropmenu" style="display: none;">
                            <ul>
                                <li class="active">
                                    <div class="cb-avatar">
                                        <img src="/chat-ui/build/assets/icn_none.svg">
                                    </div>
                                    <div class="cb-conts">
                                       <a href="#" class="cb-tit">ChatGPT</a>
                                       <span class="cb-text">Lead web developer</span>
                                    </div>
                                    <div class="cb-badge"><span class="cb-success"></span></div>
                                </li>
                                <li class="">
                                    <div class="cb-avatar">
                                        <img src="/chat-ui/build/assets/icn_none.svg">
                                    </div>
                                    <div class="cb-conts">
                                       <a href="#" class="cb-tit">Bard</a>
                                       <span class="cb-text">Lead web developer</span>
                                    </div>
                                    <div class="cb-badge"><span></span></div>
                                </li>
                                <li class="">
                                    <div class="cb-avatar">
                                        <img src="/chat-ui/build/assets/icn_none.svg">
                                    </div>
                                    <div class="cb-conts">
                                       <a href="#" class="cb-tit">LLAMA</a>
                                       <span class="cb-text">Lead web developer</span>
                                    </div>
                                    <div class="cb-badge"><span></span></div>
                                </li>
                                <li class="">
                                    <div class="cb-avatar">
                                        <img src="/chat-ui/build/assets/icn_none.svg">
                                    </div>
                                    <div class="cb-conts">
                                       <a href="#" class="cb-tit">HyperClovaX</a>
                                       <span class="cb-text">Lead web developer</span>
                                    </div>
                                    <div class="cb-badge"><span></span></div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div>
                        <button type="button"><img src="/chat-ui/build/assets/icn_bard.svg" alt="bard"></button>
                    </div>
                    <div>
                        <button type="button"><img src="/chat-ui/build/assets/icn_chat.svg" alt="chat"></button>
                    </div>
                </div>
            </div>
        </div>
    `)
    //
    // module.top = module.container.append('div').attr('class', 'cb-top');
    // module.top.button1 = module.top.append('button');
    // module.top.button1.append('img').attr('id', 'cb-zoom-img').attr('src', '/chat-ui/build/assets/icn_big.svg');
    // module.top.button2 = module.top.append('button');
    // module.top.button2.append('img').attr('src', '/chat-ui/build/assets/icn_cls.svg');
    //
    // module.header = module.container.append('div').attr('id', 'cb-header');
    // module.header.title = module.header.append('div').attr('id', 'cb-title');
    // module.header.title.logo = module.header.title.append('div').attr('class', 'cb-icon');
    // module.header.title.text = module.header.title.append('p').attr('id', 'cb-text').text('다보리 AI 매니저');
    //
    // module.setting = module.header.append('div').attr('class', 'cb-setting cb-topicn');
    //
    // module.setting.dropdown1 = module.setting.append('div').attr('class', 'cb-dropdown');
    // module.setting.dropdown1.button1 = module.setting.dropdown1.append('button');
    // module.setting.dropdown1.dropmenu = module.setting.dropdown1.append('div').attr('class', 'cb-dropmenu').append('ul');
    // module.setting.dropdown1.dropmenu.li = module.setting.dropdown1.dropmenu.append('li');
    // module.setting.dropdown1.dropmenu.li.append('div').attr('class', 'cb-avatar').append('img')
    //     .attr('src', '/chat-ui/build/assets/icn_none.svg');
    // module.setting.dropdown1.dropmenu.li.append('div').attr('class', 'cb-conts').html('<a href="#" class="cb-tit"></a><span class="cb-text"></span>')
    //
    // module.setting.dropdown1.button1.append('img').attr('src', '/chat-ui/build/assets/icn_gpt.svg');
    //
    // module.setting.dropdown2 = module.setting.append('div').attr('class', 'cb-dropdown');
    // module.setting.dropdown2.button2 = module.setting.dropdown2.append('button');
    // module.setting.dropdown2.button2.append('img').attr('src', '/chat-ui/build/assets/icn_bard.svg')
    //
    // module.setting.dropdown3 = module.setting.append('div').attr('class', 'cb-dropdown');
    // module.setting.dropdown3.button3 = module.setting.dropdown3.append('button');
    // module.setting.dropdown3.button3.append('img').attr('src', '/chat-ui/build/assets/icn_chat.svg')


    // module.setting.select = module.setting.append('select').attr('class', 'cb-setting-select');
    // module.setting.select.append('option').text('ChatGPT');
    // module.setting.select.append('option').text('Bard');
    // module.setting.select.append('option').text('LLaMA');
    // module.setting.select.append('option').text('HyperClovaX');
    // module.setting.select.append('option').text('KoGPT');

    module.scroll = module.container.append('div').attr('id', 'cb-flow');
    module.flow = module.scroll.append('div').attr('class', 'cb-inner');
    module.input = module.container.append('div').attr('id', 'cb-input').style('display', 'none');
    module.input.append('div').attr('id', 'cb-input-container').append('input').attr('type', 'text');
    module.input.append('button').text('+');


    /**
     * updateContainer should be called when height or width changes of the container changes
     * @memberof chatUI
     */
    module.updateContainer = function () {
        module.height = module.container.node().offsetHeight;
        module.flow.style('padding-top', module.height + 'px');
        module.scroll.style('height', (module.height - ((module.inputState == true) ? 77 : 0)) + 'px');
        module.scrollTo('end');
    };

    /**
     * @memberof chatUI
     * @param {object} options - object containing configs {type:string (e.g. 'text' or 'select'), class:string ('human' || 'bot'), value:depends on type}
     * @param {function} callback - function to be called after everything is done
     * @return {integer} id - id of the bubble
     */
    module.addBubble = function (options, callback) {
        callback = callback || function () {
        };

        if (!(options.type in module.types)) {
            throw 'Unknown bubble type';
        } else {

            module.ID++;
            var id = module.ID;
            module.bubbles.push({
                id: id,
                type: options.type
                //additional info
            });
            module.keys[id] = module.bubbles.length - 1;

            //segment container
            var outer = module.flow.append('div')
                .attr('class', 'cb-segment cb-' + options.class + ' cb-bubble-type-' + options.type)
                .attr('id', 'cb-segment-' + id);

            //speaker icon
            outer.append('div').attr('class', 'cb-icon');

            var bubble = outer.append('div')
                .attr('class', 'cb-bubble ' + options.class)
                // .style("height", "50px")
                .append('div')
                .attr('class', 'cb-inner');


            outer.append('hr');

            module.types[options.type](bubble, options, callback);

            module.scrollTo('end');

            return module.ID;
        }
    };

    module.addApiBubble = function (bubble, options, callback) {
        callback = callback || function () {
        };

        if (!(options.type in module.types)) {
            throw 'Unknown bubble type';
        } else {

            module.ID++;
            var id = module.ID;
            module.bubbles.push({
                id: id,
                type: options.type
                //additional info
            });
            module.keys[id] = module.bubbles.length - 1;

            module.types[options.type](bubble, options, callback);

            module.scrollTo('end');

            return module.ID;
        }
    };

    /**
     * @memberof chatUI
     * @param {d3-selection} bubble - d3 selection of the bubble container
     * @param {object} options - object containing configs {type:'text', class:string ('human' || 'bot'), value:array of objects (e.g. [{label:'yes'}])}
     * @param {function} callback - function to be called after everything is done
     */
    module.types.select = function (bubble, options, callback) {
        bubble.selectAll('.cb-choice').data(options.value).enter().append('div')
            .attr('class', 'cb-choice')
            .text(function (d) {
                return d.label;
            })
            .on('click', function (d) {
                d3.select(this).classed('cb-active', true);
                d3.select(this.parentNode).selectAll('.cb-choice').on('click', function () {
                });
                callback(d);
            });
    };

    /**
     * @memberof chatUI
     * @param {d3-selection} bubble - d3 selection of the bubble container
     * @param {object} options - object containing configs {type:'text', class:string ('human' || 'bot'), value:string (e.g. 'Hello World')}
     * @param {function} callback - function to be called after everything is done
     */
    module.types.text = function (bubble, options, callback) {
        if (('delay' in options) && options.delay) {
            // var animatedCircles = '<div class="circle"></div><div class="circle"></div><div class="circle"></div>';
            // bubble.append('div')
            //     .attr('class', 'cb-waiting')
            //     .html(animatedCircles);

            setTimeout(function () {

                bubble.select(".cb-waiting").remove();
                module.appendText(bubble, options, callback);

            }, (isNaN(options.delay) ? 1000 : options.delay));
        } else {
            module.appendText(bubble, options, callback);
        }

    };

    /**
     * Helper Function for adding text to a bubble
     * @memberof chatUI
     * @param {d3-selection} bubble - d3 selection of the bubble container
     * @param {object} options - object containing configs {type:'text', class:string ('human' || 'bot'), value:string (e.g. 'Hello World')}
     * @param {function} callback - function to be called after everything is done
     */
    module.appendText = function (bubble, options, callback) {
        bubble.attr('class', 'bubble-ctn-' + options.class).append('p')
            .html(options.value)
            .transition()
            .duration(200)
            .style("width", "auto")
            .style('opacity', 1);

        chat.scrollTo('end');

        callback();
    };

    /**
     * Showing the input module and set cursor into input field
     * @memberof chatUI
     * @param {function} submitCallback - function to be called when user presses enter or submits through the submit-button
     * @param {function} typeCallback - function to when user enters text (on change)
     */
    module.showInput = function (submitCallback, typeCallback) {
        module.inputState = true;

        if (typeCallback) {
            module.input.select('input')
                .on('change', function () {
                    typeCallback(d3.select(this).node().value);
                });
        } else {
            module.input.select('input').on('change', function () {
            });
        }

        module.input.select('input').on('keyup', function () {
            const val = module.input.select('input').node().value
            if (d3.event.keyCode == 13 && val != '') {
                submitCallback(val);
                module.input.select('input').node().value = '';
            }
        });

        module.input.select('button')
            .on('click', function () {
                const val = module.input.select('input').node().value
                if (val != '') {
                    submitCallback(val);
                    module.input.select('input').node().value = '';
                }
            });

        module.input.style('display', 'block');
        module.updateContainer();

        module.input.select('input').node().focus();
        module.scrollTo('end');
    };

    /**
     * Hide the input module
     */
    module.hideInput = function () {
        module.input.select('input').node().blur();
        module.input.style('display', 'none');
        module.inputState = false;
        module.updateContainer();
        module.scrollTo('end');
    };

    /**
     * Remove a bubble from the chat
     * @memberof chatUI
     * @param {integer} id - id of bubble provided by addBubble
     */
    module.removeBubble = function (id) {
        module.flow.select('#cb-segment-' + id).remove();
        module.bubbles.splice(module.keys[id], 1);
        delete module.keys[id];
    };

    /**
     * Remove all bubbles until the bubble with 'id' from the chat
     * @memberof chatUI
     * @param {integer} id - id of bubble provided by addBubble
     */
    module.removeBubbles = function (id) {
        for (var i = module.bubbles.length - 1; i >= module.keys[id]; i--) {
            module.removeBubble(module.bubbles[i].id);
        }
    };

    /**
     * Remove all bubbles until the bubble with 'id' from the chat
     * @memberof chatUI
     * @param {integer} id - id of bubble provided by addBubble
     * @return {object} obj - {el:d3-selection, obj:bubble-data}
     */
    module.getBubble = function (id) {
        return {
            el: module.flow.select('#cb-segment-' + id),
            obj: module.bubbles[module.keys[id]]
        };
    };

    module.clearBubbles = function () {
        const cbInnerElements = document.getElementsByClassName('cb-inner');
        for (let i = 0; i < cbInnerElements.length; i++) {
            const cbInnerElement = cbInnerElements[i];

            // Remove all child elements of each 'cb-inner' element
            while (cbInnerElement.firstChild) {
                cbInnerElement.removeChild(cbInnerElement.firstChild);
            }
        }
    };

    /**
     * Scroll chat flow
     * @memberof chatUI
     * @param {string} position - where to scroll either 'start' or 'end'
     */
    module.scrollTo = function (position) {
        //start
        var s = 0;
        //end
        if (position == 'end') {
            const innerHeight = d3.select("#cb-flow").node().clientHeight;
            s = module.scroll.property('scrollHeight') - (innerHeight - 77);
        }
        d3.select('#cb-flow').transition()
            .duration(300)
            .tween("scroll", scrollTween(s));

    };

    function initChat() {

        var conversation = {};

        conversation.init = function () {
            module.addBubble({
                type: 'text',
                value: '안녕하세요, 어떻게 도와드릴까요 ?',
                class: 'bot',
                delay: 0
            }, function () {
                //Show the input container
                module.showInput(conversation.nameResponse);
            });
        };

        conversation.nameResponse = function (message) {
            module.addBubble({type: 'text', value: message, class: 'human', delay: 0});

            const outer = module.flow.append('div')
                .attr('class', 'cb-segment cb-' + 'bot' + ' cb-bubble-type-' + 'text')
                .attr('id', 'cb-segment-' + (module.ID + 1));

            outer.append('div').attr('class', 'cb-icon');

            const bubble = outer.append('div')
                .attr('class', 'cb-bubble ' + 'bot')
                // .style("height", "50px")
                .append('div')
                .attr('class', 'cb-inner');

            outer.append('hr');

            const animatedCircles = '<div class="circle"></div><div class="circle"></div><div class="circle"></div>';
            bubble.append('div')
                .attr('class', 'cb-waiting')
                .html(animatedCircles);

            d3.request('http://34.64.58.79:8080/chatgpt-ask2')

                .header("Content-Type", "application/json")
                .post(JSON.stringify({
                    message: message
                }), function(error, data) {
                    if (error) {
                        module.addBubble({type: 'text', value: 'API 호출 중 오류 발생', class: 'bot', delay: 0});
                        outer.remove();
                    } else {
                        const content = JSON.parse(data.responseText)['content'].replace(/\n/g, "<br>");
                        module.addApiBubble(bubble,{type: 'text', value: content, class: 'bot', delay: 500});
                    }
                });
        };

        conversation.init();
    }

    function initDaboryChat() {

        var conversation = {};

        conversation.init = function () {
            module.addBubble({
                type: 'text',
                value: '안녕하세요. setup-get api 테스트!',
                class: 'bot',
                delay: 1000
            }, function () {

                //After initial bubble is presented, ask the user for her name
                module.addBubble({
                    type: 'text',
                    value: '가져올 setup 설정코드와 브랜드코드를 콤마로 구분해서 입력하세요.(ex: contact-us,main)',
                    class: 'bot',
                    delay: 0
                });

                //Show the input container
                module.showInput(conversation.nameResponse);

            });
        };

        conversation.nameResponse = function (setup) {

            //As input arrives, present the input
            module.addBubble({type: 'text', value: setup, class: 'human', delay: 0});

            //Hide the input container
            // module.hideInput();

            const [setupCode, brandCode] = setup.split(',')

            $.fn.dataLinker.api23Js('setup-get', {
                SetupCode: setupCode,
                BrandCode: brandCode,
            }, function (response) {
                console.log(response)
                module.addBubble({type: 'text', value: JSON.stringify(response), class: 'bot', delay: 500});
            })

            //And welcome the user with her name
            // module.addBubble({ type: 'text', value: 'Hello '+userName, class: 'bot', delay: 500 }, function(){
            //     module.addBubble({ type: 'text', value: 'Do you want to know my name?', class: 'bot', delay:500 }, function(){
            //
            //         module.addBubble({ type: 'select', value:[{label:'Yes'}, {label:'No'}], class: 'human', delay: 0 }, conversation.questResponse);
            //
            //     });
            // });
        };

        // conversation.questResponse = function(mood){
        //     switch(mood.label){
        //         case 'Yes':
        //             module.addBubble({ type: 'text', value: 'My name is BOT.', class: 'bot', delay: 500 });
        //             break;
        //         case 'No':
        //             module.addBubble({ type: 'text', value: 'OK :(', class: 'bot', delay: 500 });
        //             break;
        //     }
        // };

        conversation.init();
    }

    function scrollTween(offset) {
        return function () {
            var i = d3.interpolateNumber(module.scroll.property('scrollTop'), offset);
            return function (t) {
                module.scroll.property('scrollTop', i(t));
            };
        };
    }

    function debouncer(func, _timeout) {
        var timeoutID, timeout = _timeout || 200;
        return function () {
            var scope = this, args = arguments;
            clearTimeout(timeoutID);
            timeoutID = setTimeout(function () {
                func.apply(scope, Array.prototype.slice.call(args));
            }, timeout);
        };
    }

    function closeChat() {
        const chatbotElement = document.getElementById('cb-chatbot');
        const chatbotBtnElement = document.getElementById('cb-chatbot-button');
        if (chatbotBtnElement.classList.contains('active')) {
            // If the class is already present, remove it
            chatbotBtnElement.classList.remove('active');
            chatbotElement.style.display = 'none';
        } else {

            module.clearBubbles()
            initChat()
            chatbotBtnElement.classList.add('active');
            chatbotElement.style.display = 'block';
            d3.select("#cb-input-container input").node().focus();
        }
    }

    module.container.select('#zoom-btn').on('click', function () {
        const chatbotElement = d3.select('#cb-chatbot');
        const zoomImgElement = d3.select('#cb-zoom-img');

        if (chatbotElement.classed('zoom-in')) {
            // 'zoom-in' 클래스가 있으면 제거하고 이미지 소스 변경
            chatbotElement.classed('zoom-in', false);
            zoomImgElement.attr('src', '/chat-ui/build/assets/icn_big.svg');
        } else {
            chatbotElement.classed('zoom-in', true);
            zoomImgElement.attr('src', '/chat-ui/build/assets/icn_small.svg');
        }
        module.scrollTo('end');
    });

    module.container.select('#select-ai-btn').on('click', function () {
        const dropmenuElement = d3.select(this)
            .select(function() {
                return this.closest('.cb-dropdown').querySelector('.cb-dropmenu');
            });

        if (dropmenuElement.classed('active')) {
            dropmenuElement.classed('active', false);
            dropmenuElement.style('display', 'none');
        } else {
            dropmenuElement.classed('active', true);
            dropmenuElement.style('display', 'block');
        }
    });

    module.container.selectAll('.cb-dropmenu li').on('click', function () {
        d3.selectAll('.cb-dropmenu li').each(function () {
            d3.select(this).classed('active', false);
            d3.select(this).select('.cb-badge span').classed('cb-success', false);
        });
        d3.select(this).classed('active', true);
        d3.select(this).select('.cb-badge span').classed('cb-success', true);
    });

    module.container.select('#close-btn').on('click', function () {
        closeChat()
    });

    module.chatbotButton.on('click', function () {
        closeChat()
    });

    //On Resize scroll to end
    d3.select(window).on('resize', debouncer(function (e) {
        module.updateContainer();
    }, 200));

    module.updateContainer();

    return module;
});
