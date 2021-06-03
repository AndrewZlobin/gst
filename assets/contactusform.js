getHttpRequestStatuses = () => {
    return {
        opened: 1,
        loading: 3,
        done: 4
    }
};

getStatusFromElement = (status, iserror = '') => {
    let querySelector = `[data-sendingstatus="${status}"]`;

    if (iserror.length) {
        querySelector = `[data-sendingstatus="${status}"][data-iserror="${iserror}"]`;
    }

    return document.querySelector(querySelector).textContent;
};

changeElementIsHiddenAttribute = (element) => {
    element.dataset.ishidden === 'true'
        ? element.dataset.ishidden = 'false'
        : element.dataset.ishidden = 'false'
};

changeSpinnerColor = (defaultColor, newColor) => {
    let contactUsSpinner = document.getElementsByClassName('contact-us-form__spinner')[0];

    let defaultColorSelector = `text-${defaultColor}`;
    let newColorSelector = `text-${newColor}`

    if (contactUsSpinner.classList.contains(defaultColorSelector)) {
        contactUsSpinner.classList.remove(defaultColorSelector);
        contactUsSpinner.classList.add(newColorSelector);
    }
}

let contactUsContainer = document.getElementsByClassName('contact-us-form__status')[0];
let contactUsResult = document.getElementsByClassName('contact-us-form__result')[0];

document.getElementById('contact_us_form').addEventListener("submit", (e) => {
    e.preventDefault();
    const XHR = new XMLHttpRequest();

    const formMethod = e.target.method;
    const formAction = e.target.action;

    const formData = new FormData(e.target);

    XHR.open(formMethod.toUpperCase(), formAction);

    changeElementIsHiddenAttribute(contactUsContainer);
    // Opened
    if (XHR.readyState === getHttpRequestStatuses().opened) {
        // TODO Need refactor
        changeSpinnerColor('custom-yellow', 'secondary');
        changeSpinnerColor('info', 'secondary');
        changeSpinnerColor('danger', 'secondary');
        changeSpinnerColor('success', 'secondary');
        changeElementIsHiddenAttribute(contactUsResult);
        contactUsResult.textContent = getStatusFromElement(getHttpRequestStatuses().opened);
    }

    // Loading
    XHR.onprogress = () => {
        if (XHR.readyState === getHttpRequestStatuses().loading) {
            changeSpinnerColor('secondary', 'info');
            contactUsResult.textContent = getStatusFromElement(getHttpRequestStatuses().loading);
        }
    }

    // Done (success or error)
    XHR.onload = () => {
        if (XHR.readyState === 4) {
            if (XHR.status === 400) {
                changeSpinnerColor('info', 'danger');
                contactUsResult.textContent = getStatusFromElement(getHttpRequestStatuses().done, 'true');
            } else {
                changeSpinnerColor('info', 'success');
                contactUsResult.textContent = getStatusFromElement(getHttpRequestStatuses().done, 'false');
            }
        }
    };

    XHR.send(formData);

    e.target.reset();
});
