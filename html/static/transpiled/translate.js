'use strict';

/** @param{string} language */
function changeLanguage(language) {
    var elements = $('.change-language');
    var attribute = '';

    // Set attribute
    switch (language) {
        case 'en-GB':
            attribute = 'text-en';
            break;
        case 'sv-SE':
            attribute = 'text-sv';
            break;
        case 'no-NO':
            attribute = 'text-no';
            break;
        default:
            attribute = 'text-no';
    }
    var _iteratorNormalCompletion = true;
    var _didIteratorError = false;
    var _iteratorError = undefined;

    try {
        for (var _iterator = elements[Symbol.iterator](), _step; !(_iteratorNormalCompletion = (_step = _iterator.next()).done); _iteratorNormalCompletion = true) {
            var element = _step.value;

            // Check if input field or not
            if (element.tagName === 'TEXTAREA' || element.tagName === 'INPUT') {
                element.setAttribute('placeholder', element.getAttribute(attribute));
            } else {
                element.innerHTML = element.getAttribute(attribute);
            }
        }
    } catch (err) {
        _didIteratorError = true;
        _iteratorError = err;
    } finally {
        try {
            if (!_iteratorNormalCompletion && _iterator.return) {
                _iterator.return();
            }
        } finally {
            if (_didIteratorError) {
                throw _iteratorError;
            }
        }
    }
}