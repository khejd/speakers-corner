/** @param{string} language */
function changeLanguage(language){
    let elements = $('.change-language');
    let attribute = '';

    // Set attribute
    switch(language) {
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
    for (let element of elements){
        // Check if input field or not
        if (element.tagName === 'TEXTAREA' || element.tagName === 'INPUT'){
            element.setAttribute('placeholder', element.getAttribute(attribute))
        } else {
            element.innerHTML = element.getAttribute(attribute);
        }
    }
}
