 

<!DOCTYPE html>
<html style="width: 100%; height: 100%;">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
    <meta charset="utf-8" />
    <title></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
    <style type="text/css">
/* FormViewer - v1.0.0 */

/* Layout Styles */
.page {
    display:block;
    overflow: hidden;
    background-color: white;
}

.page-inner {
    -webkit-transform-origin: top left;
    -ms-transform-origin: top left;
    transform-origin: top left;
}

#formviewer {
    overflow: auto;
    margin: 0;
    padding: 0;
    -webkit-overflow-scrolling: touch;
}

#overlay {
    width: 100%;
    height: 100%;
    position: absolute;
    z-index: 10;
    visibility: hidden;
}

#overlay.panning {
    visibility: visible;
    cursor: all-scroll;
    cursor: -moz-grab;
    cursor: -webkit-grab;
    cursor: grab;
}

#overlay.panning.mousedown {
    cursor: all-scroll;
    cursor: -moz-grabbing;
    cursor: -webkit-grabbing;
    cursor: grabbing;
}

/* Continuous Layout */
.layout-continuous .page {
    margin: 0 auto 10px;
}
.layout-continuous .page:last-child {
    margin: 0 auto 0;
}
</style>
    <script type="text/javascript">
/* FormViewer - v1.2.0 | Copyright 2022 IDRsolutions */
!function(){"use strict";var e={LAYOUT_CONTINUOUS:"continuous",SELECT_SELECT:"select",SELECT_PAN:"pan",ZOOM_SPECIFIC:"specific",ZOOM_ACTUALSIZE:"actualsize",ZOOM_FITWIDTH:"fitwidth",ZOOM_FITHEIGHT:"fitheight",ZOOM_FITPAGE:"fitpage",ZOOM_AUTO:"auto"},t=1,o=0,n,i,r,a,u=!0,s,c=[],l,f,m=[],d=10,g={},p=!1,v,O="",T=!1;e.setup=function(d){d||(d=FormViewer.config),p=!0,a=/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent),s=d.bounds,o=d.pagecount,d.url&&(O=d.url),T=!!d.isR2L,i=D("formviewer"),T&&R.addClass(i,"isR2L"),A.setup();var g=document.createElement("style");g.setAttribute("type","text/css"),document.head.appendChild(g),f=g.sheet,(t<1||t>o)&&(t=1);for(var b=0;b<o;b++)if(s[b][0]!=s[0][0]||s[b][1]!=s[0][1]){u=!1;break}switch(v){case FormViewer.LAYOUT_CONTINUOUS:break;default:v=FormViewer.LAYOUT_CONTINUOUS}var F=[e.LAYOUT_CONTINUOUS];for(v===FormViewer.LAYOUT_CONTINUOUS&&(r=E),window.addEventListener("resize",(function(){A.updateZoom()})),l=D("overlay"),S.setup(),null==(n=D("contentContainer"))&&(n=D("mainXFAForm")),n.style.transform="translateZ(0)",n.style.padding="5px",b=1;b<=o;b++){var L=D("page"+b);L.setAttribute("style","width: "+s[b-1][0]+"px; height: "+s[b-1][1]+"px;"),m[b]=L,c[b]=h(L,b)}r.setup(t),R.addClass(i,"layout-"+r.toString()),A.updateZoomToDefault(),r.goToPage(t);var C={selectMode:S.currentSelectMode,isMobile:a,layout:r.toString(),availableLayouts:F,isFirstPage:1===t,isLastPage:r.isLastPage(t)};for(var w in d)d.hasOwnProperty(w)&&(C[w]=d[w]);C.page=t,e.fire("ready",C)};var h=function(t,o){var n={isVisible:function(){return!0},isLoaded:function(){return!0},hide:function(){},unload:function(){e.fire("pageunload",{page:o})},load:function(){e.fire("pageload",{page:o})}};return n},b=function(n){t!=n&&(t=n,e.fire("pagechange",{page:t,pagecount:o,isFirstPage:1===t,isLastPage:r.isLastPage(n)}))},E=function(){var n={},r=0,a=0,u=[];n.setup=function(){i.addEventListener("scroll",c);for(var e=0;e<o;e++)s[e][0]>r&&(r=s[e][0]),s[e][1]>a&&(a=s[e][1])},n.unload=function(){i.removeEventListener("scroll",c)};var c=function(){l()},l=function(){var e,t;if(m[1].getBoundingClientRect().top>0)b(1);else for(e=1;e<=o;e++){var n=m[e].getBoundingClientRect();t=n.top;var i=n.bottom-n.top;if(t<=.25*i&&t>.5*-i){b(e);break}}f()},f=function(){u=[t];var e,n,r=i.clientHeight,a=function(e){return(n=m[e].getBoundingClientRect()).bottom>0&&n.top<r};for(e=t-1;e>=1&&a(e);e--)u.push(e);for(e=t+1;e<=o&&a(e);e++)u.push(e)};return n.goToPage=function(e,t){var o=0;if(t){var n=t.split(" ");switch(n[0]){case"XYZ":o=Number(n[2]);break;case"FitH":o=Number(n[1]);break;case"FitR":o=Number(n[4]);break;case"FitBH":o=Number(n[1]);break}(isNaN(o)||o<0||o>s[e-1][1])&&(o=0),0!==o&&(o=s[e-1][1]-o)}var r=A.getZoom();i.scrollTop=m[e].offsetTop-5+o*r,b(e),f()},n.getVisiblePages=function(){return u},n.updateLayout=function(){},n.isLastPage=function(e){return e===o},n.getZoomBounds=function(){return{width:r,height:a}},n.getAutoZoom=function(e){return n.getZoomBounds().width>i.clientWidth-d?e:1},n.next=function(){e.goToPage(t+1)},n.prev=function(){e.goToPage(t-1)},n.toString=function(){return FormViewer.LAYOUT_CONTINUOUS},n}(),F=function(e){try{e.getSelection?e.getSelection().empty?e.getSelection().empty():e.getSelection().removeAllRanges&&e.getSelection().removeAllRanges():e.document.selection&&e.document.selection.empty()}catch(e){}},L=function(e){try{F(e)}catch(e){}},S=function(){var t={},o,n,r=!1,a;t.setup=function(){switch(a){case FormViewer.SELECT_PAN:case FormViewer.SELECT_SELECT:break;default:a=FormViewer.SELECT_SELECT}this.currentSelectMode=a,this.currentSelectMode==e.SELECT_SELECT?t.enableTextSelection():t.enablePanning()},t.enableTextSelection=function(){this.currentSelectMode=e.SELECT_SELECT,R.removeClass(l,"panning"),l.removeEventListener("mousedown",u),document.removeEventListener("mouseup",s),l.removeEventListener("mousemove",c)};var u=function(e){return e=e||window.event,R.addClass(l,"mousedown"),o=e.clientX,n=e.clientY,r=!0,!1},s=function(){R.removeClass(l,"mousedown"),r=!1},c=function(e){if(r)return e=e||window.event,i.scrollLeft=i.scrollLeft+o-e.clientX,i.scrollTop=i.scrollTop+n-e.clientY,o=e.clientX,n=e.clientY,!1};return t.enablePanning=function(){this.currentSelectMode=e.SELECT_PAN,F(window),R.addClass(l,"panning"),l.addEventListener("mousedown",u),document.addEventListener("mouseup",s),l.addEventListener("mousemove",c)},t.setDefaultMode=function(e){a=e},t}();e.setSelectMode=function(t){if(p){if(a)return;t==e.SELECT_SELECT?S.enableTextSelection():S.enablePanning(),e.fire("selectchange",{type:t})}else S.setDefaultMode(t)};var A=(C=e.ZOOM_AUTO,P=[.25,.5,.75,1,1.25,1.5,2,2.5,3,3.5,4],I=[e.ZOOM_AUTO,e.ZOOM_FITPAGE,e.ZOOM_FITHEIGHT,e.ZOOM_FITWIDTH,e.ZOOM_ACTUALSIZE],Z=0,M=1,U=function(e,t,o,n,i){var r;return"-webkit-transform: "+(r=i?"translate3d("+t+"px, "+o+"px, 0) scale("+n+")":"translateX("+t+"px) translateY("+o+"px) scale("+n+")")+";\n-ms-transform: "+r+";\ntransform: "+r+";"},x=function(t){var n=!1,a=!1;(M=H(t))>=4?(M=4,a=!0):M<=.25&&(M=.25,n=!0);var u=i.scrollTop/i.scrollHeight;r.updateLayout();for(var l=r.getVisiblePages(),f=1;f<=o;f++)-1===l.indexOf(f)&&c[f].hide();w&&y.deleteRule(w);var d=U(null,0,0,M,!1);w=y.insertRule(".page-inner { \n"+d+"\n}",y.cssRules.length);for(var g=0;g<o;g++)m[g+1].style.width=Math.floor(s[g][0]*M)+"px",m[g+1].style.height=Math.floor(s[g][1]*M)+"px";i.scrollTop=i.scrollHeight*u,++Z%2==1&&x(),e.fire("zoomchange",{zoomType:C,zoomValue:M,isMinZoom:n,isMaxZoom:a})},V=function(){for(var e=M,t=P[P.length-1],o=0,n;o<P.length;o++)if(P[o]>e){t=P[o];break}for(o=0;o<I.length;o++){var i=H(I[o]);if(i>e&&i<=t){if(n&&i===t)continue;n=I[o],t=i}}return n||t},k=function(){for(var e=M,t=P[0],o=P.length-1,n;o>=0;o--)if(P[o]<e){t=P[o];break}for(o=0;o<I.length;o++){var i=H(I[o]);if(i<e&&i>=t){if(n&&i===t)continue;n=I[o],t=i}}return n||t},H=function(t){var o=r.getZoomBounds(),n=(i.clientWidth-d)/o.width,a=(i.clientHeight-d)/o.height,u=parseFloat(t);switch(isNaN(u)||(M=u,t=e.ZOOM_SPECIFIC),t||(t=C),t){case e.ZOOM_AUTO:M=r.getAutoZoom(n,a);break;case e.ZOOM_FITWIDTH:M=n;break;case e.ZOOM_FITHEIGHT:M=a;break;case e.ZOOM_FITPAGE:M=Math.min(n,a);break;case e.ZOOM_ACTUALSIZE:M=1;break}return C=t,M},{setup:function(){var e=document.createElement("style");e.setAttribute("type","text/css"),document.head.appendChild(e),y=e.sheet},updateZoom:x,updateZoomToDefault:function(){x(_)},zoomIn:function(){x(V())},zoomOut:function(){x(k())},getZoom:function(){return M},setDefault:function(e){_=e}}),C,w,P,I,Z,y,M,_,N,U,x,V,k,H;e.zoomIn=function(){A.zoomIn()},e.zoomOut=function(){A.zoomOut()},e.setZoom=function(e){p?A.updateZoom(e):A.setDefault(e)},e.goToPage=function(e,n){p?e>=1&&e<=o&&r.goToPage(Number(e),n):t=e},e.next=function(){r.next()},e.prev=function(){r.prev()},e.setLayout=function(o){p?(r.unload(),R.removeClass(i,"layout-"+r.toString()),(r=E).setup(t),R.addClass(i,"layout-"+r.toString()),A.updateZoom(FormViewer.ZOOM_AUTO),r.goToPage(t),e.fire("layoutchange",{layout:o})):v=o},e.updateLayout=function(){A.updateZoom()};var D=function(e){return document.getElementById(e)};e.on=function(e,t){g[e]||(g[e]=[]),-1===g[e].indexOf(t)&&g[e].push(t)},e.off=function(e,t){if(g[e]){var o=g[e].indexOf(t);-1!==o&&g[e].splice(o,1)}},e.fire=function(e,t){g[e]&&g[e].forEach((function(e){e(t)}))};var R={addClass:function(e,t){var o=0!==e.className.length?e.className.split(" "):[],n;-1===o.indexOf(t)&&(o.push(t),e.className=o.join(" "))},removeClass:function(){for(var e=arguments[0],t=0!==e.className.length?e.className.split(" "):[],o=1;o<arguments.length;o++){var n=t.indexOf(arguments[o]);-1!==n&&t.splice(n,1)}e.className=t.join(" ")}};e.handleFormSubmission=function(e,t){FormVuAPI&&(e||(e=window.prompt("Please enter the URL to submit to"))?z(e,t):console.log("No URL provided for FormSubmission"))};var z=function(e,t){if(FormVuAPI){var o={url:e,success:function(){alert("Form submitted successfully")},failure:function(){alert("Form failed to submit, please try again")}},n="string"==typeof t?t.toLowerCase():"";if(e.startsWith("mailto:"))return o.format=n,FormVuAPI.submitFormAsMail(o),void 0;switch(n){case"json":"function"==typeof FormVuAPI.submitFormAsJSON&&FormVuAPI.submitFormAsJSON(o);break;case"pdf":"function"==typeof FormVuAPI.submitFormAsPDF&&FormVuAPI.submitFormAsPDF(o);break;case"formdata":default:"function"==typeof FormVuAPI.submitFormAsFormData&&FormVuAPI.submitFormAsFormData(o);break}}};"function"==typeof define&&define.amd?define(["formviewer"],[],(function(){return e})):"object"==typeof module&&module.exports?module.exports=e:window.FormViewer=e}();
</script>
    <script type="text/javascript">
(function() {
"use strict";

/**
 * Shorthand helper function to getElementById
 * @param id
 * @returns {Element}
 */
var d = function (id) {
    return document.getElementById(id);
};

var ClassHelper = (function() {
    return {
        addClass: function(ele, name) {
            var classes = ele.className.length !== 0 ? ele.className.split(" ") : [];
            var index = classes.indexOf(name);
            if (index === -1) {
                classes.push(name);
                ele.className = classes.join(" ");
            }
        },

        removeClass: function(ele, name) {
            var classes = ele.className.length !== 0 ? ele.className.split(" ") : [];
            var index = classes.indexOf(name);
            if (index !== -1) {
                classes.splice(index, 1);
            }
            ele.className = classes.join(" ");
        }
    };
})();

var Button = {};

FormViewer.on('ready', function(data) {
    // Grab buttons
    Button.zoomIn = d('btnZoomIn');
    Button.zoomOut = d('btnZoomOut');

    if (Button.zoomIn) {
        Button.zoomIn.onclick = function(e) { FormViewer.zoomIn(); e.preventDefault(); };
    }
    if (Button.zoomOut) {
        Button.zoomOut.onclick = function(e) { FormViewer.zoomOut(); e.preventDefault(); };
    }

    document.title = data.title ? data.title : data.fileName;
    var pageLabels = data.pageLabels;
    var btnPage = d('btnPage');
    if (btnPage != null) {
        btnPage.innerHTML = pageLabels.length ? pageLabels[data.page - 1] : data.page;
        btnPage.title = data.page + " of " + data.pagecount;

        FormViewer.on('pagechange', function(data) {
            d('btnPage').innerHTML = pageLabels.length ? pageLabels[data.page - 1] : data.page;
            d('btnPage').title = data.page + " of " + data.pagecount;
        });
    }

    if (idrform.app) {
        idrform.app.execFunc = idrform.app.execMenuItem;
        idrform.app.execMenuItem = function (str) {
            switch (str.toUpperCase()) {
                case "FIRSTPAGE":
                    idrform.app.activeDocs[0].pageNum = 0;
                    FormViewer.goToPage(1);
                    break;
                case "LASTPAGE":
                    idrform.app.activeDocs[0].pageNum = FormViewer.config.pagecount - 1;
                    FormViewer.goToPage(FormViewer.config.pagecount);
                    break;
                case "NEXTPAGE":
                    idrform.app.activeDocs[0].pageNum++;
                    FormViewer.next();
                    break;
                case "PREVPAGE":
                    idrform.app.activeDocs[0].pageNum--;
                    FormViewer.prev();
                    break;
                default:
                    idrform.app.execFunc(str);
                    break;
            }
        }
    }

    document.addEventListener('keydown', function (e) {
        if (e.target != null) {
            switch (e.target.constructor) {
                case HTMLInputElement:
                case HTMLTextAreaElement:
                case HTMLVideoElement:
                case HTMLAudioElement:
                case HTMLSelectElement:
                    return;
                default:
                    break;
            }
        }
        switch (e.keyCode) {
            case 33: // Page Up
                FormViewer.prev();
                e.preventDefault();
                break;
            case 34: // Page Down
                FormViewer.next();
                e.preventDefault();
                break;
            case 37: // Left Arrow
                data.isR2L ? FormViewer.next() : FormViewer.prev();
                e.preventDefault();
                break;
            case 39: // Right Arrow
                data.isR2L ? FormViewer.prev() : FormViewer.next();
                e.preventDefault();
                break;
            case 36: // Home
                FormViewer.goToPage(1);
                e.preventDefault();
                break;
            case 35: // End
                FormViewer.goToPage(data.pagecount);
                e.preventDefault();
                break;
        }
    });
});

window.addEventListener("beforeprint", function(event) {
    FormViewer.setZoom(FormViewer.ZOOM_AUTO);
});

})();
</script><script type="text/javascript">
(function () {
    "use strict";

    var FormVuAPI = {};

    FormVuAPI.extractFormValues = function () {
        const inputs = document.getElementsByTagName("input");
        const textareas = document.getElementsByTagName("textarea");
        const selects = document.getElementsByTagName("select");

        const texts = [];
        const checks = [];
        const checkGroups = [];
        const radios = [];
        const choices = [];

        for (const inp of inputs) {
            const ref = inp.getAttribute("data-objref");
            if (ref && ref.length > 0) {
                const type = inp.type.toUpperCase();
                if (type === "TEXT" || type === "PASSWORD") {
                    texts.push(inp);
                } else if (type === "CHECKBOX") {
                    // Handle checkbox groups
                    if (Object.keys(idrform.getCheckboxGroup(inp.dataset.fieldName)).length > 1)
                        checkGroups.push(inp);
                    else checks.push(inp);
                } else if (type === "RADIO") {
                    // Filter out unisons
                    if (inp.name === inp.dataset.fieldName) radios.push(inp);
                }
            }
        }
        for (const inp of textareas) {
            const ref = inp.getAttribute("data-objref");
            if (ref && ref.length > 0) {
                texts.push(inp);
            }
        }
        for (const inp of selects) {
            const ref = inp.getAttribute("data-objref");
            if (ref && ref.length > 0) {
                choices.push(inp);
            }
        }

        const output = {};

        for (const item of texts) {
            const fieldText = item.value;
            const fieldName = item.getAttribute("data-field-name");
            output[fieldName] = fieldText;
        }

        for (const item of checkGroups) {
            const fieldName = item.getAttribute("data-field-name");
            const isChecked = item.checked;
            const value = item.value

            if (isChecked) {
                output[fieldName] = value;
            }
        }

        for (const item of checks) {
            const isChecked = item.checked;
            const fieldName = item.getAttribute("data-field-name");
            output[fieldName] = isChecked;
        }

        for (const item of choices) {
            const selected = item.value;
            const fieldName = item.getAttribute("data-field-name");
            const multiple =  item.getAttribute("multiple");
            if (multiple) {
                const options = item.children;
                const selectedItems = [];
                for (const option of options) {
                    if (option.selected) {
                        selectedItems.push(option.value);
                    }
                }
                output[fieldName] = selectedItems;
            } else {
                output[fieldName] = selected;
            }
        }

        for (const radio of radios) {
            const fieldName = radio.getAttribute("data-field-name");
            const isChecked = radio.checked;
            const value = radio.value;

            if (isChecked) {
                output[fieldName] = value;
            }
        }
        return output;
    };

    /**
     * Takes a JSON input in the format of formdata.json and updates the relevant
     * HTML fields values to match the provided values.
     *
     * @param {String|Object} formValues The values to be inserted into the HTML
     * @param {boolean} resetForm Whether a form reset should be called before inserting the values
     * @returns {boolean} true on method completion, false on invalid input
     */
    FormVuAPI.insertFormValues = function (formValues, resetForm) {
        if (typeof formValues === "string") {
            formValues = JSON.parse(formValues);
        } else if (!(formValues instanceof Object)) {
            console.error('Form values provided to insertFormValues is not an Object or JSON String');
            return false;
        }

        if (resetForm) {
            idrform.doc.resetForm();
        }

        for (let key of Object.keys(formValues)) {
            let val = formValues[key];
            if (val.inputType) {
                switch (val.inputType) {
                    case "radio button":
                        _handleRadioButtonInsert(val);
                        break;
                    case "checkbox":
                    case "checkbox group":
                        _handleCheckboxInsert(val);
                        break;
                    case "combobox":
                        _handleComboboxInsert(val);
                        break;
                    case "listbox":
                    case "listbox multi":
                        _handleListboxInsert(val);
                        break;
                    case "multiline text":
                        _handleMultilineTextInsert(val);
                        break;
                    default:
                        _handleGenericInputInsert(val);
                        break;
                }
            }
        }

        return true;
    };

    /**
     * Escapes the provided string for use as a CSS selector
     * Backslashes need to be escaped in order to be used in CSS selectors
     * (otherwise they will fail)
     *
     * @param {String} string the string to be escaped
     * @returns {String} an escaped string ready for use as a CSS selector
     * @private
     */
    let escapeForCssSelector = function(string) {
        return string.replaceAll('\\','\\\\');
    }

    /**
     * Selects the relevant radio button of the provided Form Field JSON object
     * Refreshes the AP images so the change is displayed
     * If the radio button is not found, a warning will be logged to the console
     *
     * @param {Object} jsonObj an object representation of a Form Field
     * @private
     */
    let _handleRadioButtonInsert = function(jsonObj) {
        let domRadioButtons = document.querySelectorAll('input[type=radio][data-field-name="' + escapeForCssSelector(jsonObj.fieldName) + '"][data-objref]');
        if (!domRadioButtons) {
            console.warn("Failed to find <input type=\"radio\"> " + jsonObj.fieldName);
            return;
        }
        domRadioButtons.forEach(element => {
            if (element.dataset.objref == jsonObj.objref) {
                element.checked = jsonObj.value;
                element.value = jsonObj.value;
            } else {
                element.checked = false;
            }
            if ("refreshApImage" in window && element.dataset.imageIndex) refreshApImage(parseInt(element.dataset.imageIndex));
        });
    }

    /**
     * Ticks the relevant checkbox of the provided Form Field JSON object
     * Refreshes the AP images so the change is displayed
     * If the checkbox is not found, a warning will be logged to the console
     *
     * @param {Object} jsonObj an object representation of a Form Field
     * @private
     */
    let _handleCheckboxInsert = function(jsonObj) {
        let domCheckboxes = document.querySelectorAll('input[type=checkbox][data-field-name="' + escapeForCssSelector(jsonObj.fieldName) + '"][data-objref]');
        if (!domCheckboxes) {
            console.warn("Failed to find <input type=\"checkbox\"> " + jsonObj.fieldName);
            return;
        }
        domCheckboxes.forEach(element => {
            if (element.dataset.objref == jsonObj.objref) {
                element.checked = jsonObj.value;
                element.value = jsonObj.value;
            } else {
                element.checked = false;
            }
            if ("refreshApImage" in window && element.dataset.imageIndex) refreshApImage(parseInt(element.dataset.imageIndex));
        });
    };

    /**
     * Selects the relevant combobox option from the provided Form Field JSON object
     * If a value is not an option, a new option will be added with the provided value
     * If the combobox is not found, a warning will be logged to the console
     *
     * @param {Object} jsonObj an object representation of a Form Field
     * @private
     */
    let _handleComboboxInsert = function(jsonObj) {
        let domCombobox = document.querySelector('select[data-field-name="' + escapeForCssSelector(jsonObj.fieldName) + '"][data-objref="' + jsonObj.objref + '"]');
        if (!domCombobox) {
            console.warn("Failed to find <select> " + jsonObj.fieldName);
            return;
        }

        let options = domCombobox.children;
        let optionFound = false;
        for (let i = 0, ii = options.length; i < ii; i++) {
            let option = options[i];
            if (option.value === jsonObj.value) {
                option.setAttribute("selected", "selected");
                domCombobox.selectedIndex = i;
                optionFound = true;
            } else {
                option.removeAttribute("selected");
            }
        }
        if (!optionFound) {
            const newOpt = document.createElement("option");
            newOpt.text = jsonObj.value;
            newOpt.value = jsonObj.value;
            newOpt.setAttribute("selected", "selected");
            domCombobox.appendChild(newOpt);
        }
        domCombobox.value = jsonObj.value;
    }

    /**
     * Selects the relevant listbox option from the provided Form Field JSON object
     * Unselects any other options
     * If the listbox is not found, a warning will be logged to the console
     *
     * @param {Object} jsonObj an object representation of a Form Field
     * @private
     */
    let _handleListboxInsert = function(jsonObj) {
        let domListbox = document.querySelector('select[data-field-name="' + escapeForCssSelector(jsonObj.fieldName) + '"][data-objref="' + jsonObj.objref + '"]');
        if (!domListbox) {
            console.warn("Failed to find <select> " + jsonObj.fieldName);
            return;
        }
        let options = domListbox.children;
        for (let i = 0, ii = options.length; i < ii; i++) {
            let option = options[i];

            if (option.value == jsonObj.value || jsonObj.value instanceof Array && jsonObj.value.includes(option.value)) {
                option.selected = true;
                option.setAttribute("selected", "selected");
            } else {
                option.removeAttribute("selected");
            }
        }
    }

    /**
     * Inserts the multiline text from the provided Form Field JSON object
     * If the textarea is not found, a warning will be logged to the console
     *
     * @param {Object} jsonObj an object representation of a Form Field
     * @private
     */
    let _handleMultilineTextInsert = function(jsonObj) {
        let domTextArea = document.querySelector('textarea[data-field-name="' + escapeForCssSelector(jsonObj.fieldName) + '"][data-objref="' + jsonObj.objref + '"]');
        if (!domTextArea) {
            console.warn("Failed to find <textarea> " + jsonObj.fieldName);
            return;
        }
        domTextArea.value = jsonObj.value;
    }

    /**
     * Inserts the value of the provided Form Field JSON object into the relevant HTML input
     * Can also insert into textareas if not using single-line text output
     * If the input/textarea is not found, a warning will be logged to the console
     *
     * @param {Object} jsonObj an object representation of a Form Field
     * @private
     */
    let _handleGenericInputInsert = function(jsonObj) {
        let domInput = document.querySelector(':is(input,textarea)[data-field-name="' + escapeForCssSelector(jsonObj.fieldName) + '"][data-objref="' + jsonObj.objref + '"]');
        if (!domInput) {
            console.warn("Failed to find <input> or <textarea>" + jsonObj.fieldName);
            return;
        }
        domInput.value = jsonObj.value;
    }

    let setRequestEventHandlers = function(xhr, params) {
        xhr.onreadystatechange = function(event) {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    if (params.success) {
                        params.success(event);
                    }
                } else {
                    if (params.failure) {
                        params.failure(event);
                    } else {
                        console.log(event.target.response);
                    }
                }
            }
        };
    };

    FormVuAPI.submitFormAsMail = function(params) {
        if (typeof params !== 'object') {
            params = {url: params};
        }
        if (!params.url.startsWith('mailto:')) {
            return;
        }
        switch (params.format) {
            case 'formdata':
                alert('The file will be saved in your machine, please attach it to the email');
                downloadFormDataValues(this.extractFormValues());
                openMailToLink(params.url);
                break;
            case 'pdf':
                alert('The file will be saved in your machine, please attach it to the email');
                idrform.app.execMenuItem('SaveAs');
                openMailToLink(params.url);
                break;
            default:
                alert('Unsupported submission format. Submission failed.');
                break;
        }
    };

    let downloadFormDataValues = function(formValues) {
        let formValuesString = "";
        for (var value in formValues) {
            if (formValues.hasOwnProperty(value) && formValues[value] !== undefined) {
                if (formValuesString.length !== 0) {
                    formValuesString += '&';
                }

                formValuesString += encodeURIComponent(value) + '=' + formValues[value];
            }
        }
        let fileDL = document.createElement('a');
        let pdfName = document.getElementById("FDFXFA_PDFName").textContent;
        fileDL.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(formValuesString));
        fileDL.setAttribute('download', pdfName + '.txt');
        fileDL.style.display = 'none';
        document.body.appendChild(fileDL);
        fileDL.click();
        document.body.removeChild(fileDL);
    };

    let openMailToLink = function(target) {
        let mailto = document.createElement('a');
        mailto.setAttribute('href', target);
        mailto.setAttribute('target', "_blank");
        mailto.style.display = 'none';
        document.body.appendChild(mailto);
        mailto.click();
        document.body.removeChild(mailto);
    };

    FormVuAPI.submitFormAsJSON = function (params) {
        let url = typeof params === 'object' ? params.url : params;

        let formValues = {data: this.extractFormValues()};
        let xhr = new XMLHttpRequest();
        if (xhr.upload) {
            setRequestEventHandlers(xhr, params);
            xhr.open('POST', url, true);
            xhr.setRequestHeader('Content-type', 'application/json');
            xhr.send(JSON.stringify(formValues));
            return xhr;
        }
    };

    FormVuAPI.submitFormAsFormData = function (params) {
        let url = typeof params === 'object' ? params.url : params;

        let formValues = this.extractFormValues();
        let xhr = new XMLHttpRequest();
        if (xhr.upload) {
            setRequestEventHandlers(xhr, params);
            xhr.open('POST', url, true);

            let formData = new FormData();
            for (var value in formValues) {
                if (formValues.hasOwnProperty(value) && formValues[value] !== undefined) {
                    formData.append(encodeURIComponent(value), formValues[value]);
                }
            }
            xhr.send(formData);
            return xhr;
        }
    };

    FormVuAPI.submitFormAsPDF = function (params) {
        let url, submitType="formData";
        if (typeof params === 'object') {
            url = params.url;
            submitType = params.submitType || "formData";
        } else {
            url = params;
        }

        const xhr = new XMLHttpRequest();
        if (xhr.upload) {
            setRequestEventHandlers(xhr, params);
            xhr.open('POST', url, true);
            const file = idrform.getCompletedFormPDF();
            const fileName = document.querySelector("#FDFXFA_PDFName").textContent;

            if (submitType === "raw") {
                xhr.setRequestHeader("Content-Disposition", `filename="${fileName}"`)
                xhr.send(file);
            } else if (submitType === "formData") {
                const formData = new FormData();
                formData.append("file", file, fileName);
                xhr.send(formData);
            }
            return xhr;
        }
    }

    window.FormVuAPI = FormVuAPI;

}());
</script>











<style type="text/css">
.btn{border:0 none; height:30px; padding:0; width:30px; background-color:transparent; display:inline-block; margin:7px 5px 0; vertical-align:top; cursor:pointer; color:#fff;}
.btn:hover{background-color:#0e1319; color:#eddbd9; border-radius:5px;}
.page{box-shadow: 1px 1px 4px rgba(0, 0, 0, 0.3);}
#formviewer{bottom:0; left:0; right:0; position:absolute; top:40px; background:#191f2f none repeat scroll 0 0;}
body{padding:0px; margin:0px; background-color:#191f2f;}
    {  z-index:9999; color:white;background-color:#707784; position:fixed; font-size:32px; margin:61px; opacity:0.8; top:0px; min-width:300px; min-height: 40px;margin-left: 706px;background: black;}


    
    .btn{border:0 none; height:30px; padding:0; width:30px; background-color:transparent; display:inline-block; margin:7px 5px 0; vertical-align:top; cursor:pointer; color:#fff;}
.btn:hover{background-color:#0e1319; color:#eddbd9; border-radius:5px;}
.page{box-shadow: 1px 1px 4px rgba(0, 0, 0, 0.3);}
#formviewer{bottom:0; left:0; right:0; position:absolute; top:40px; background:#191f2f none repeat scroll 0 0;}
body{padding:0px; margin:0px; background-color:#191f2f;}
#FDFXFA_Menu{text-align:center;   z-index:9999; color:white;background-color:#707784; position:fixed; font-size:32px; margin:0px; opacity:0.8; top:0px; min-width:300px; min-height: 40px; margin-left: 700px;}
#FDFXFA_Menu a{cursor:pointer; border-radius:5px; padding:5px; font-family: IDRSymbols; margin:5px 10px 5px 10px;}
#FDFXFA_PageLabel{padding-left:5px;font-size:20px}
#FDFXFA_PageCount{padding-right:5px;font-size:20px}
#FDFXFA_Menu a:hover{background-color:#0e1319; color:#eddbd9;}
#FDFXFA_PageLabel{min-width:20px;display:inline-block;}
#FDFXFA_Processing{width:100%; height:100%; z-index:10000; position:fixed; background-color:black; opacity:0.8; color:white; top:0px;text-align: center; font-size:300px; font-family:IDRSymbols;}
#FDFXFA_Processing span{top:50%;left:50%;margin:-50px 0 0 -50px}
#FDFXFA_FormType,#FDFXFA_Form,#FDFXFA_PDFName,#FDFXFA_FormSubmitURL{display:none;}
@font-face {font-family:'IDRSymbols'; src: url(data:application/x-font-woff;charset=utf-8;base64,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) format('woff'); font-weight:normal; font-style:normal;}
@media print {
#FDFXFA_Menu,#FDFXFA_Menu a,#FDFXFA_Menu label,#FDFXFA_Menu button{display:none}
#formviewer{overflow: visible}
div.page{box-shadow: none;}
}
</style>
</head>
<body style="margin: 0;background: white;height: 10px;"  onload='idrform.init()'>



    


<script type="text/javascript">var idrform=new IDRFORM,idrscript={};function IDRFORM(){class Event{#e;#t;changeEx;commitKey;fieldFull;keyDown;modifier;name;rc=!0;richChange;richChangeEx;richValue;selEnd;selStart;targetName;type;willCommit;constructor(e,t){this.#e=e,this.#t=t,this.changeEx=null,this.commitKey=null,this.fieldFull=null,this.keyDown=null,this.modifier=null,this.name="",this.richChange=null,this.richChangeEx=null,this.richValue=null,this.selEnd=null,this.selStart=null,this.targetName="",this.type="Field",this.willCommit=null}get shift(){return this.#e.shiftKey}get source(){return new Field(this.#e.target)}get target(){return new Field(this.#e.target)}get value(){return this.#t?this.#t.value:this.#e.target.value}set value(e){if(this.#t)return this.#t.value=e,void 0;this.#e.target.value=e}get change(){return this.#e.target.value}set change(e){this.#e.target.value=e}}const doc=new Doc,app=new App;let event;const AVAIL_CALCULATES={},AVAIL_VALIDATES={};this.app=app,this.doc=doc,window.getField=function(e){return doc.getField(e)};const AVAIL_SCRIPTS={A:"click",K:"input",C:"",V:"",F:"",Fo:"focus",Bl:"blur",D:"mousedown",U:"mouseup",E:"mouseenter",X:"mouseleave"};this._radioUnisonSiblings={},this._checkboxGroups={},this.init=function(){const e=document.getElementById("FDFXFA_FormType");e&&(app.isAcroForm="FDF"===e.textContent||"AcroForm"===e.textContent);const t=document.getElementById("FDFXFA_Processing");if(t&&(t.style.display="none"),idrscript.documentscript)try{window.eval(atob(idrscript.documentscript))}catch(e){console.log(e)}idrscript.pagescript&&idrform.exec(idrscript.pagescript);const o=document.querySelectorAll("input, select, textarea");for(const e of o){const t=e.getAttribute("type"),o=e.getAttribute("id"),n=["button","radio","checkbox"].includes(e.type);for(const[t,i]of Object.entries(AVAIL_SCRIPTS)){const a=o+"_"+t;a in idrscript&&(n?i.length>0&&e.addEventListener(i,(e=>{idrform.exec(idrscript[a],e)})):"F"===t?e.addEventListener("onblur",(e=>{idrform.exec(idrscript[a],e)})):"C"===t?AVAIL_CALCULATES[o]=atob(idrscript[a]):"V"===t&&(AVAIL_VALIDATES[o]=atob(idrscript[a])))}if("button"!==t&&e.addEventListener("change",(e=>{idrform.doc.calculateNow()})),"radio"===t){if(e.dataset.hide&&e.addEventListener("click",this._hideEvent),e.dataset.show&&e.addEventListener("click",this._showEvent),e.dataset.flagRadiosinunison){let t=this._radioUnisonSiblings[e.dataset.fieldName];t||(t={},this._radioUnisonSiblings[e.dataset.fieldName]=t);let o=t[e.value];o||(o=[],t[e.value]=o),o.push(e),e.addEventListener("change",(e=>{this._doRadioUnison(e.currentTarget)}))}}else if("checkbox"===t){let t=this._checkboxGroups[e.dataset.fieldName];t||(t={},this._checkboxGroups[e.dataset.fieldName]=t);let o=t[e.value];o||(o=[],t[e.value]=o),o.push(e),e.addEventListener("change",(e=>{this._doCheckboxGroup(e.currentTarget)}))}}doc.calculateNow()},this.exec=function(e,t){this.doc.exec(atob(e),t),this.doc.calculateNow()},this.execMenuItem=function(e){this.app.execMenuItem(e)},this.submitForm=function(e){this.doc.submitForm(e)},this._hideEvent=function(e){if(e.target&&e.target.dataset&&e.target.dataset.hide)for(var t=e.target.dataset.hide.split(" "),o=0;o<t.length;o++)idrform.doc.getField(t[o]).display=display.hidden},this._showEvent=function(e){if(e.target&&e.target.dataset&&e.target.dataset.show)for(var t=e.target.dataset.show.split(" "),o=0;o<t.length;o++)idrform.doc.getField(t[o]).display=display.visible},this._doRadioUnison=function(e){this._updateRadioUnisonSiblings(e);for(const[t,o]of Object.entries(this._radioUnisonSiblings[e.dataset.fieldName]))t!==e.value&&this._updateRadioUnisonSiblings(o[0])},this._updateRadioUnisonSiblings=function(e){const t=undefined;this._radioUnisonSiblings[e.dataset.fieldName][e.value].forEach((t=>{t.checked=e.checked,"refreshApImage"in window&&refreshApImage(parseInt(t.dataset.imageIndex))}))},this._doCheckboxGroup=function(e){const t=this._checkboxGroups[e.dataset.fieldName],o=e.checked;for(const[n,i]of Object.entries(t))for(const t of i)t.checked=n===e.value&&o,"refreshApImage"in window&&refreshApImage(parseInt(t.dataset.imageIndex))},this.getCheckboxGroup=function(e){return this._checkboxGroups[e]},this.getCompletedFormPDF=function(){return new Blob([Uint8Array.from(EcmaParser._insertFieldsToPDF("")).buffer],{type:"application/pdf"})};const AnnotationType={Caret:"Caret",Circle:"Circle",FileAttachment:"FileAttachment",FreeText:"FreeText",Highlight:"Highlight",Ink:"Ink",Link:"Link",Line:"Line",Polygon:"Polygon",PolyLine:"PolyLine",Sound:"Sound",Square:"Square",Squiggly:"Squiggly",Stamp:"Stamp",StrikeOut:"StrikeOut",Text:"Text",Underline:"Underline"},border={s:"solid",d:"dashed",b:"beveled",i:"inset",u:"underline"},cursor={visible:0,hidden:1,delay:2},display={visible:0,hidden:1,noPrint:2,noView:3},font={Times:"Times-Roman",TimesB:"Times-Bold",TimesI:"Times-Italic",TimesBI:"Times-BoldItalic",Helv:"Helvetica",HelvB:"Helvetica-Bold",HelvI:"Helvetica-Oblique",HelvBI:"Helvetica-BoldOblique",Cour:"Courier",CourB:"Courier-Bold",CourI:"Courier-Oblique",CourBI:"Courier-BoldOblique",Symbol:"Symbol",ZapfD:"ZapfDingbats",KaGo:"HeiseiKakuGo-W5-UniJIS-UCS2-H",KaMi:"HeiseiMin-W3-UniJIS-UCS2-H"},highlight={n:"none",i:"invert",p:"push",o:"outline"},position={textOnly:0,iconOnly:1,iconTextV:2,textIconV:3,iconTextH:4,textIconH:5,overlay:6},style={ch:"check",cr:"cross",di:"diamond",ci:"circle",st:"star",sq:"square"},trans={blindsH:"BlindsHorizontal",blindsV:"BlindsVertical",boxI:"BoxIn",boxO:"BoxOut",dissolve:"Dissolve",glitterD:"GlitterDown",glitterR:"GlitterRight",glitterRD:"GlitterRightDown",random:"Random",replace:"Replace",splitHI:"SplitHorizontalIn",splitHO:"SplitHorizontalOut",splitVI:"SplitVerticalIn",splitVO:"SplitVerticalOut",wipeD:"WipeDown",wipeL:"WipeLeft",wipeR:"WipeRight",wipeU:"WipeUp"},zoomType={none:"NoVary",fitP:"FitPage",fitW:"FitWidth",fitH:"fitHeight",fitV:"fitVisibleWidth",pref:"Preferred",refW:"ReflowWidth"},DS_GREATER_THAN="Invalid value: must be greater than or equal to %s.",IDS_GT_AND_LT="Invalid value: must be greater than or equal to %s and less than or equal to %s.",IDS_LESS_THAN="Invalid value: must be less than or equal to %s.",IDS_INVALID_MONTH="** Invalid **",IDS_INVALID_DATE2="should match format",IDS_INVALID_VALUE="The value entered does not match the format of the field";function AFExecuteThisScript(e,t,o){return console.log("method not defined contact - IDR SOLUTIONS"),event.rc}function AFImportAppearance(e,t,o,n){return console.log("method not defined contact - IDR SOLUTIONS"),!0}function AFLayoutBorder(e,t,o,n,i){console.log("method not defined contact - IDR SOLUTIONS")}function AFLayoutCreateStream(e){return console.log("method not defined contact - IDR SOLUTIONS"),null}function AFLayoutDelete(e){console.log("method not defined contact - IDR SOLUTIONS")}function AFLayoutNew(e,t,o){return console.log("method not defined contact - IDR SOLUTIONS"),null}function AFLayoutText(e,t,o,n,i,a){console.log("method not defined contact - IDR SOLUTIONS")}function AFPDDocEnumPDFields(e,t,o,n,i){console.log("method not defined contact - IDR SOLUTIONS")}function AFPDDocGetPDFieldFromName(e,t){return e.getField(t)}function AFPDDocLoadPDFields(e){console.log("method not defined contact - IDR SOLUTIONS")}function AFPDFieldFromCosObj(e){console.log("method not defined contact - IDR SOLUTIONS")}function AFPDFieldGetCosObj(e){console.log("method not defined contact - IDR SOLUTIONS")}function AFPDFieldGetDefaultTextAppearance(e,t){console.log("method not defined contact - IDR SOLUTIONS")}function AFPDFieldGetFlags(e,t){console.log("method not defined contact - IDR SOLUTIONS")}function AFPDFieldGetName(e){return e.name}function AFPDFieldGetValue(e){return e.value}function AFPDFieldIsAnnot(e){return console.log("AFPDFieldIsAnnot not defined contact - IDR SOLUTIONS"),!1}function AFPDFieldIsTerminal(e){return console.log("AFPDFieldIsTerminal not defined contact - IDR SOLUTIONS"),!0}function AFPDFieldIsValid(e){return console.log("AFPDFieldIsValid not defined contact - IDR SOLUTIONS"),!0}function AFPDFieldReset(e){console.log("AFPDFieldReset not defined contact - IDR SOLUTIONS")}function AFPDFieldSetDefaultTextAppearance(e,t){console.log("method not defined contact - IDR SOLUTIONS")}function AFPDFieldSetFlags(e,t,o){console.log("method not defined contact - IDR SOLUTIONS")}function AFPDFieldSetOptions(e,t){return console.log("method not defined contact - IDR SOLUTIONS"),"Good"}function AFPDFieldSetValue(e,t){e.value=t}function AFPDFormFromPage(e,t){return console.log("method not defined contact - IDR SOLUTIONS"),null}function AFPDWidgetGetAreaColors(e,t,o){console.log("method not defined contact - IDR SOLUTIONS")}function AFPDWidgetGetBorder(e,t){return console.log("method not defined contact - IDR SOLUTIONS"),!0}function AFPDWidgetGetRotation(e){return console.log("method not defined contact - IDR SOLUTIONS"),null}function AFPDWidgetSetAreaColors(e,t,o){console.log("method not defined contact - IDR SOLUTIONS")}function AFPDWidgetSetBorder(e,t){console.log("method not defined contact - IDR SOLUTIONS")}function AFSimple_Calculate(e,t){let o=0;switch(e){case"AVG":let e=0;for(const n of t){const t=doc.getField(n);null!=t&&null!=t.value&&(e++,o+=Number(t.value))}o/=e;break;case"MIN":o=doc.getField(t[0]).value;for(const e of t){const t=doc.getField(e);null!=t&&null!=t.value&&(o=Math.min(o,t.value))}break;case"MAX":o=doc.getField(t[0]).value;for(const e of t){const t=doc.getField(e);null!=t&&null!=t.value&&(o=Math.max(o,t.value))}break;case"PRD":o=1;for(const e of t){const t=doc.getField(e);null!=t&&null!=t.value&&(o*=t.value)}break;case"SUM":for(const e of t){const t=doc.getField(e);null!=t&&null!=t.value&&(o+=Number(t.value))}break}return o}function AFDate_KeystrokeEx(e){console.log("method not defined contact - IDR SOLUTIONS")}function AFDate_Format(e){var t=e,o=event.value,n,i;if(null!=o&&(""+o).length>0&&null==util.scand(t,o)){var a="Invalid date/time: please ensure that the date/time exists. Field ["+event.target.name+"] should match the format "+t;alert(a),event.value=null}}function AFDate_FormatEx(e){AFDate_Format(e)}function AFTime_Keystroke(e){AFTime_Format(e)}function AFTime_Format(e){var t=cFormat,o=event.value,n;if(null==util.scand(t,o)){var i="Invalid date/time: please ensure that the date/time exists. Field ["+event.target.name+"] should match the format "+t;alert(i),event.value=null}}function AFPercent_Keystroke(e,t){console.log("method not defined contact - IDR SOLUTIONS")}function AFPercent_Format(e,t){if("number"==typeof e&&"number"==typeof t){if(e<0&&(alert("Invalid nDec value in AFPercent_Format"),event.value=null),e>512)return event.value="%",void 0;e=Math.floor(e),t=Math.min(Math.max(0,Math.floor(t)),4);var o=AFMakeNumber(event.value);if(null===o)return event.value="%",void 0;event.value=100*o+"%"}}function AFSpecial_Keystroke(e){console.log("method not defined contact - IDR SOLUTIONS")}function AFSpecial_Format(e){var t;switch(e=AFMakeNumber(e)){case 0:t="99999";break;case 1:t="99999-9999";break;case 2:var o=""+event.value;t=o.length>8||o.startsWith("(")?"(999) 999-9999":"999-9999";break;case 3:t="999-99-9999";break;default:return alert("Invalid psf in AFSpecial_Keystroke"),void 0}event.value=util.printx(t,event.value)}function AFMakeNumber(e){if("number"==typeof e)return e;if("string"!=typeof e)return null;e=e.trim().replace(",",".");const t=parseFloat(e);return isNaN(t)||!isFinite(t)?null:t}function AFNumber_Format(e,t,o,n,i,a){var r=event.value;null!=(r=AFMakeNumber(r))&&(event.value=r)}function AFNumber_Keystroke(e,t,o,n,i,a){console.log("method not defined contact - IDR SOLUTIONS")}function AssembleFormAndImportFDF(e,t,o){return console.log("method not defined contact - IDR SOLUTIONS"),doc}function ExportAsFDF(e,t,o,n,i,a,r){console.log("method not defined contact - IDR SOLUTIONS")}function ExportAsFDFEx(e,t,o,n,i,a,r,s){console.log("method not defined contact - IDR SOLUTIONS")}function ExportAsFDFWithParams(e){console.log("method not defined contact - IDR SOLUTIONS")}function ExportAsHtml(e,t,o,n,i){console.log("method not defined contact - IDR SOLUTIONS")}function ExportAsHtmlEx(e,t,o,n,i,a){console.log("method not defined contact - IDR SOLUTIONS")}function ImportAnFDF(e,t){console.log("method not defined contact - IDR SOLUTIONS")}function IsPDDocAcroForm(e){console.log("method not defined contact - IDR SOLUTIONS")}function ResetForm(e,t,o){console.log("method not defined contact - IDR SOLUTIONS")}function App(){this.isAcroForm=!0,this.activeDocs=[doc],this.calculate=!0,this.contstants=null,this.focusRect=!0,this.formsVersion=6,this.fromPDFConverters=new Array,this.fs=new FullScreen,this.fullScreen=!1,this.language="ENU",this.media=new Media,this.monitors={},this.numPlugins=0,this.openInPlace=!1,this.platform="WIN",this.plugins=new Array,this.printColorProfiles=new Array,this.printNames=new Array,this.runtimeHighlight=!1,this.runtimeHightlightColor=new Array,this.thermometer=new Thermometer,this.toolBar=!1,this.toolBarHorizontal=!1,this.toolBarVertical=!1,this.viewerType="Exchange-Pro",this.viewerVariation="Full",this.viewerVersion=6,this.addMenuItem=function(){console.log("addMenuItem method not defined contact - IDR SOLUTIONS")},this.addSubMenu=function(){console.log("addSubMenu method not defined contact - IDR SOLUTIONS")},this.addToolButton=function(){console.log("addToolButton method not defined contact - IDR SOLUTIONS")},this.alert=function(e,t,o,n,i,a){var r={cMsg:e,nIcon:0,nType:0,cTitle:"Adobe Acrobat",oDoc:null,oCheckBox:null};if(e instanceof Object)for(var s in e)r[s]=e[s];switch(void 0!==o&&(r.nType=o),r.nType){case 0:return window.alert(r.cMsg),void 0;case 1:case 2:case 3:return window.confirm(r.cMsg)}},this.beep=function(){var e;new Audio("data:audio/wav;base64,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qJrx4KOQjahZxWbcZgztj2c49nKmkId44S71j0c8eV9yDK6uPRzx5X18eDvjvQ6yKo9ZSS6l//8elePK/Lf//IInrOF/FvDoADYAGBMGb7FtErm5MXMlmPAJQVgWta7Zx2go+8xJ0UiCb8LHHdftWyLJE0QIAIsI+UbXu67dZMjmgDGCGl1H+vpF4NSDckSIkk7Vd+sxEhBQMRU8j/12UIRhzSaUdQ+rQU5kGeFxm+hb1oh6pWWmv3uvmReDl0UnvtapVaIzo1jZbf/pD6ElLqSX+rUmOQNpJFa/r+sa4e/pBlAABoAAAAA3CUgShLdGIxsY7AUABPRrgCABdDuQ5GC7DqPQCgbbJUAoRSUj+NIEig0YfyWUho1VBBBA//uQZB4ABZx5zfMakeAAAAmwAAAAF5F3P0w9GtAAACfAAAAAwLhMDmAYWMgVEG1U0FIGCBgXBXAtfMH10000EEEEEECUBYln03TTTdNBDZopopYvrTTdNa325mImNg3TTPV9q3pmY0xoO6bv3r00y+IDGid/9aaaZTGMuj9mpu9Mpio1dXrr5HERTZSmqU36A3CumzN/9Robv/Xx4v9ijkSRSNLQhAWumap82WRSBUqXStV/YcS+XVLnSS+WLDroqArFkMEsAS+eWmrUzrO0oEmE40RlMZ5+ODIkAyKAGUwZ3mVKmcamcJnMW26MRPgUw6j+LkhyHGVGYjSUUKNpuJUQoOIAyDvEyG8S5yfK6dhZc0Tx1KI/gviKL6qvvFs1+bWtaz58uUNnryq6kt5RzOCkPWlVqVX2a/EEBUdU1KrXLf40GoiiFXK///qpoiDXrOgqDR38JB0bw7SoL+ZB9o1RCkQjQ2CBYZKd/+VJxZRRZlqSkKiws0WFxUyCwsKiMy7hUVFhIaCrNQsKkTIsLivwKKigsj8XYlwt/WKi2N4d//uQRCSAAjURNIHpMZBGYiaQPSYyAAABLAAAAAAAACWAAAAApUF/Mg+0aohSIRobBAsMlO//Kk4soosy1JSFRYWaLC4qZBYWFRGZdwqKiwkNBVmoWFSJkWFxX4FFRQWR+LsS4W/rFRb/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////VEFHAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAU291bmRib3kuZGUAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAMjAwNGh0dHA6Ly93d3cuc291bmRib3kuZGUAAAAAAAAAACU=").play()},this.beginPriv=function(){console.log("beginPriv method not defined contact - IDR SOLUTIONS")},this.browseForDoc=function(){console.log("browseForDoc method not defined contact - IDR SOLUTIONS")},this.clearInterval=function(){console.log("method not defined contact - IDR SOLUTIONS")},this.clearTimeOut=function(){console.log("method not defined contact - IDR SOLUTIONS")},this.endPriv=function(){console.log("endPriv method not defined contact - IDR SOLUTIONS")},this.execDialog=function(){console.log("execDialog method not defined contact - IDR SOLUTIONS")},this.execMenuItem=function(e){var t=document.getElementsByClassName("pageArea").length,o=e.toUpperCase();if("SAVEAS"===o)if(this.isAcroForm){var n=document.getElementById("FDFXFA_PDFName").textContent;EcmaParser.saveFormToPDF(n)}else createXFAPDF();else"PRINT"===o?this.activeDocs[0].print():"FIRSTPAGE"===o?this.activeDocs[0].pageNum=0:"PREVPAGE"===o?this.activeDocs[0].pageNum--:"NEXTPAGE"===o?this.activeDocs[0].pageNum++:"LASTPAGE"===o&&(this.activeDocs[0].pageNum=t-1)},this.getNthPluginName=function(){console.log("method not defined contact - IDR SOLUTIONS")},this.getPath=function(){console.log("method not defined contact - IDR SOLUTIONS")},this.goBack=function(){this.activeDocs[0].pageNum--},this.goForward=function(){this.activeDocs[0].pageNum++},this.hideMenuItem=function(){console.log("method not defined contact - IDR SOLUTIONS")},this.hideToolbarButton=function(){console.log("method not defined contact - IDR SOLUTIONS")},this.launchURL=function(e,t){app.activeDocs[0].getURL(e)},this.listMenuItems=function(){console.log("method not defined contact - IDR SOLUTIONS")},this.listToolbarButtons=function(){console.log("method not defined contact - IDR SOLUTIONS")},this.mailGetAddrs=function(){console.log("method not defined contact - IDR SOLUTIONS")},this.mailMsg=function(e,t,o,n,i,a){var r="mailto:";r+=t.split(";").join(",");var s=!1;o&&(s=!0,r+="?cc=",r+=o.split(";").join(",")),n&&(s?r+="&":(s=!0,r+="?"),r+=n.split(";").join(",")),i&&(s?r+="&":(s=!0,r+="?"),r+=i.split(" ").join("%20")),a&&(s?r+="&":(s=!0,r+="?"),r+=a.split(" ").join("%20")),window.location.href=r},this.mailGetAddrs=function(){console.log("method not defined contact - IDR SOLUTIONS")},this.newDoc=function(){return new Doc},this.newFDF=function(){return new FDF},this.openDoc=function(){console.log("method not defined contact - IDR SOLUTIONS")},this.openFDF=function(){console.log("method not defined contact - IDR SOLUTIONS")},this.popUpMenu=function(){console.log("method not defined contact - IDR SOLUTIONS")},this.popUpMenuEx=function(){console.log("method not defined contact - IDR SOLUTIONS")},this.removeToolButton=function(){console.log("method not defined contact - IDR SOLUTIONS")},this.response=function(e,t,o,n){var i;return i=t?window.prompt(e,t):window.prompt(e)},this.setInterval=function(){console.log("method not defined contact - IDR SOLUTIONS")},this.setTimeOut=function(){console.log("method not defined contact - IDR SOLUTIONS")},this.trustedFunction=function(){console.log("method not defined contact - IDR SOLUTIONS")},this.trustPropagatorFunction=function(){console.log("method not defined contact - IDR SOLUTIONS")}}function Doc(){this.pages=[],this.alternatePresentations={},this.author="",this.baseURL="",this.bookmarkRoot={},this.calculate=!1,this.creationDate=new Date,this.creator="",this.dataObjects=[],this.delay=!1,this.dirty=!1,this.disclosed=!1,this.docID=[],this.documentFileName="",this.dynamicXFAForm=!1,this.external=!0,this.fileSize=0,this.hidden=!1,this.hostContainer={},this.icons=[],this.info={},this.innerAppWindowRect=[],this.innerDocWindowRect=[],this.isModal=!1,this.keywords={},this.layout="",this.media={},this.metadata="",this.modDate=new Date,this.mouseX=0,this.mouseY=0,this.noautoComplete=!1,this.nocache=!1,this.numPages=0,this.numTemplates=0,this.path="",this.outerAppWindowRect=[],this.outerDocWindowRect=[],this.pageNum=0,this.pageWindowRect=[],this.permStatusReady=!1,this.producer="PDFWriter",this.requiresFullSave=!1,this.securityHandler="",this.selectedAnnots=[],this.sounds=[],this.spellDictionaryOrder=[],this.spellLanguageOrder=[],this.subject="",this.templates=[],this.title="",this.URL="",this.viewState={},this.xfa={},this.XFAForeground=!1,this.zoom=100,this.zoomType="novary",this.exec=function(scr,htmlEvent){try{console.log(htmlEvent),event=new Event(htmlEvent,null),eval(scr),event=void 0}catch(e){console.log(e)}}}function Events(){this.add=function(){console.log("add method not defined contact - IDR SOLUTIONS")},this.dispatch=function(){console.log("dispatch method not defined contact - IDR SOLUTIONS")},this.remove=function(){console.log("remove method not defined contact - IDR SOLUTIONS")}}function EventListener(){this.afterBlur=function(e){console.log("method not defined contact - IDR SOLUTIONS")},this.afterClose=function(e){console.log("method not defined contact - IDR SOLUTIONS")},this.afterDestroy=function(e){console.log("method not defined contact - IDR SOLUTIONS")},this.afterDone=function(e){console.log("method not defined contact - IDR SOLUTIONS")},this.afterError=function(e){console.log("method not defined contact - IDR SOLUTIONS")},this.afterEscape=function(e){console.log("method not defined contact - IDR SOLUTIONS")},this.afterEveryEvent=function(e){console.log("method not defined contact - IDR SOLUTIONS")},this.afterFocus=function(e){console.log("method not defined contact - IDR SOLUTIONS")},this.afterPause=function(e){console.log("method not defined contact - IDR SOLUTIONS")},this.afterPlay=function(e){console.log("method not defined contact - IDR SOLUTIONS")},this.afterReady=function(e){console.log("method not defined contact - IDR SOLUTIONS")},this.afterScript=function(e){console.log("method not defined contact - IDR SOLUTIONS")},this.afterSeek=function(e){console.log("method not defined contact - IDR SOLUTIONS")},this.afterStatus=function(e){console.log("method not defined contact - IDR SOLUTIONS")},this.afterStop=function(e){console.log("method not defined contact - IDR SOLUTIONS")},this.onBlur=function(e){console.log("method not defined contact - IDR SOLUTIONS")},this.onClose=function(e){console.log("method not defined contact - IDR SOLUTIONS")},this.onDestroy=function(e){console.log("method not defined contact - IDR SOLUTIONS")},this.onDone=function(e){console.log("method not defined contact - IDR SOLUTIONS")},this.onError=function(e){console.log("method not defined contact - IDR SOLUTIONS")},this.onEscape=function(e){console.log("method not defined contact - IDR SOLUTIONS")},this.onEveryEvent=function(e){console.log("method not defined contact - IDR SOLUTIONS")},this.onFocus=function(e){console.log("method not defined contact - IDR SOLUTIONS")},this.onGetRect=function(e){console.log("method not defined contact - IDR SOLUTIONS")},this.onPause=function(e){console.log("method not defined contact - IDR SOLUTIONS")},this.onPlay=function(e){console.log("method not defined contact - IDR SOLUTIONS")},this.onReady=function(e){console.log("method not defined contact - IDR SOLUTIONS")},this.onScript=function(e){console.log("method not defined contact - IDR SOLUTIONS")},this.onSeek=function(e){console.log("method not defined contact - IDR SOLUTIONS")},this.onStatus=function(e){console.log("method not defined contact - IDR SOLUTIONS")},this.onStrop=function(e){console.log("method not defined contact - IDR SOLUTIONS")}}function hexToRgbCss(e){var t=/^#?([a-f\d])([a-f\d])([a-f\d])$/i;e=e.replace(t,(function(e,t,o,n){return t+t+o+o+n+n}));var o=/^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(e),n,i,a;return"rgb("+parseInt(o[1],16)+","+parseInt(o[2],16)+","+parseInt(o[3],16)+")"}function rgbToHexCss(e,t,o){return"#"+((1<<24)+(e<<16)+(t<<8)+o).toString(16).slice(1)}function rgbCssToArr(e){return e.replace(/[^\d,]/g,"").split(",")}console.println=function(e){console.log(e)},Object.defineProperty(Doc.prototype,"addAnnot",{value:function(e){return console.log("addAnnot method not defined contact - IDR SOLUTIONS"),null}}),Object.defineProperty(Doc.prototype,"addField",{value:function(e,t,o,n){var i=document.getElementsByClassName("pageArea"),a;switch(t){case"text":(a=document.createElement("input")).setAttribute("type","text");break;case"button":a=document.createElement("button");break;case"combobox":a=document.createElement("select");break;case"listbox":a=document.createElement("select");break;case"checkbox":(a=document.createElement("input")).setAttribute("type","checkbox");break;case"radiobutton":(a=document.createElement("input")).setAttribute("type","radio");break;default:a=document.createElement("div")}return a.setAttribute("data-field-name",e),a.style.position="absolute",a.style.left=n[0],a.style.top=n[1],i[o].appendChild(a),new Field(a)}}),Object.defineProperty(Doc.prototype,"addIcon",{value:function(e,t){return this.icons.push(t),null}}),Object.defineProperty(Doc.prototype,"addLink",{value:function(e,t){var o=document.getElementsByClassName("pageArea"),n=document.createElement("a");return n.style.position="absolute",n.style.left=t[0],n.style.top=t[1],o[e].appendChild(n),new Link(n)}}),Object.defineProperty(Doc.prototype,"addRecipientListCryptFilter",{value:function(e,t){return console.log("addRecipientListCryptFilter method not defined contact - IDR SOLUTIONS"),null}}),Object.defineProperty(Doc.prototype,"addRequirement",{value:function(e,t){return console.log("addRequirement method not defined contact - IDR SOLUTIONS"),null}}),Object.defineProperty(Doc.prototype,"addScript",{value:function(e,t){return console.log("addScript method not defined contact - IDR SOLUTIONS"),null}}),Object.defineProperty(Doc.prototype,"addThumbnails",{value:function(e,t){return console.log("addThumbnails method not defined contact - IDR SOLUTIONS"),null}}),Object.defineProperty(Doc.prototype,"addWatermarkFromFile",{value:function(e){return console.log("addWatermarkFromFile method not defined contact - IDR SOLUTIONS"),null}}),Object.defineProperty(Doc.prototype,"addWatermarkFromText",{value:function(e){return console.log("addWatermarkFromText method not defined contact - IDR SOLUTIONS"),null}}),Object.defineProperty(Doc.prototype,"addWeblinks",{value:function(e,t){return console.log("addWeblinks method not defined contact - IDR SOLUTIONS"),null}}),Object.defineProperty(Doc.prototype,"bringToFront",{value:function(){return console.log("bringToFront method not defined contact - IDR SOLUTIONS"),null}}),Object.defineProperty(Doc.prototype,"calculateNow",{value:function(){for(const[fieldId,script]of Object.entries(AVAIL_CALCULATES)){const target=document.getElementById(fieldId);if(target){event=new Event(null,target);const res=eval(script);null!=res&&(target.value=res)}}return event=void 0,1}}),Object.defineProperty(Doc.prototype,"closeDoc",{value:function(e){window.close()}}),Object.defineProperty(Doc.prototype,"colorConvertPage",{value:function(e,t,o){return console.log("colorConvertPage method not defined contact - IDR SOLUTIONS"),!0}}),Object.defineProperty(Doc.prototype,"createDataObject",{value:function(e,t,o,n){console.log("createDataObject method not defined contact - IDR SOLUTIONS")}}),Object.defineProperty(Doc.prototype,"createTemplate",{value:function(e,t){console.log("createTemplate method not defined contact - IDR SOLUTIONS")}}),Object.defineProperty(Doc.prototype,"deletePages",{value:function(e,t){console.log("deletePages method not defined contact - IDR SOLUTIONS")}}),Object.defineProperty(Doc.prototype,"embedDocAsDataObject",{value:function(e,t,o,n){console.log("embedDocAsDataObject method not defined contact - IDR SOLUTIONS")}}),Object.defineProperty(Doc.prototype,"embedOutputIntent",{value:function(e){console.log("embedOutputIntent method not defined contact - IDR SOLUTIONS")}}),Object.defineProperty(Doc.prototype,"encryptForRecipients",{value:function(e,t,o){return console.log("encryptForRecipients method not defined contact - IDR SOLUTIONS"),!1}}),Object.defineProperty(Doc.prototype,"encryptUsingPolicy",{value:function(e,t,o,n){return console.log("encryptUsingPolicy method not defined contact - IDR SOLUTIONS"),{}}}),Object.defineProperty(Doc.prototype,"exportAsFDF",{value:function(){console.log("exportAsFDF method not defined contact - IDR SOLUTIONS")}}),Object.defineProperty(Doc.prototype,"exportAsText",{value:function(){console.log("exportAsFDF method not defined contact - IDR SOLUTIONS")}}),Object.defineProperty(Doc.prototype,"exportAsXFDF",{value:function(){console.log("exportAsXFDF method not defined contact - IDR SOLUTIONS")}}),Object.defineProperty(Doc.prototype,"exportAsXFDFStr",{value:function(){console.log("exportAsXFDF method not defined contact - IDR SOLUTIONS")}}),Object.defineProperty(Doc.prototype,"exportDataObject",{value:function(){console.log("exportDataObject method not defined contact - IDR SOLUTIONS")}}),Object.defineProperty(Doc.prototype,"exportXFAData",{value:function(){console.log("exportXFAData method not defined contact - IDR SOLUTIONS")}}),Object.defineProperty(Doc.prototype,"extractPages",{value:function(e,t,o){console.log("extractPages method not defined contact - IDR SOLUTIONS")}}),Object.defineProperty(Doc.prototype,"flattenPages",{value:function(e,t,o){console.log("flattenPages method not defined contact - IDR SOLUTIONS")}}),Object.defineProperty(Doc.prototype,"getAnnot",{value:function(e,t){return console.log("getAnnot method not defined contact - IDR SOLUTIONS"),null}}),Object.defineProperty(Doc.prototype,"getAnnot3D",{value:function(e,t){return console.log("getAnnot3D method not defined contact - IDR SOLUTIONS"),null}}),Object.defineProperty(Doc.prototype,"getAnnots",{value:function(e,t,o){return console.log("getAnnots method not defined contact - IDR SOLUTIONS"),[]}}),Object.defineProperty(Doc.prototype,"getAnnots3D",{value:function(e,t,o){return console.log("getAnnots3D method not defined contact - IDR SOLUTIONS"),[]}}),Object.defineProperty(Doc.prototype,"getColorConvertAction",{value:function(){return console.log("getColorConvertAction method not defined contact - IDR SOLUTIONS"),{}}}),Object.defineProperty(Doc.prototype,"getDataObject",{value:function(e){return console.log("getDataObject method not defined contact - IDR SOLUTIONS"),{}}}),Object.defineProperty(Doc.prototype,"getDataObjectContents",{value:function(e,t){return console.log("getDataObjectContents method not defined contact - IDR SOLUTIONS"),{}}}),Object.defineProperty(Doc.prototype,"getField",{value:function(e){var t=document.querySelectorAll('[data-field-name="'+e+'"]'),o=t[0];if(t.length>1&&"radio"==o.getAttribute("type"))for(var n=0,i=t.length;n<i;n++)if(t[n].checked)return new Field(t[n]);return new Field(o)}}),Object.defineProperty(Doc.prototype,"getIcon",{value:function(e){for(var t=0,o=this.icons.length;t<o;t++)if(this.icons[t].name===e)return this.icons[t];return new Icon}}),Object.defineProperty(Doc.prototype,"getLegalWarnings",{value:function(e){return console.log("getLegalWarnings method not defined contact - IDR SOLUTIONS"),{}}}),Object.defineProperty(Doc.prototype,"getLinks",{value:function(e,t){return console.log("getLinks method not defined contact - IDR SOLUTIONS"),[]}}),Object.defineProperty(Doc.prototype,"getNthFieldName",{value:function(e){var t,o=document.querySelectorAll("[data-field-name]")[e];return o?o.getAttribute("data-field-name"):""}}),Object.defineProperty(Doc.prototype,"getNthTemplate",{value:function(e){return console.log("getNthTemplate method not defined contact - IDR SOLUTIONS"),""}}),Object.defineProperty(Doc.prototype,"getOCGs",{value:function(e){return console.log("getOCGs method not defined contact - IDR SOLUTIONS"),[]}}),Object.defineProperty(Doc.prototype,"getOCGOrder",{value:function(){return console.log("getOCGOrder method not defined contact - IDR SOLUTIONS"),[]}}),Object.defineProperty(Doc.prototype,"getPageBox",{value:function(e,t){return console.log("getPageBox method not defined contact - IDR SOLUTIONS"),[]}}),Object.defineProperty(Doc.prototype,"getPageLabel",{value:function(e){return console.log("getPageLabel method not defined contact - IDR SOLUTIONS"),{}}}),Object.defineProperty(Doc.prototype,"getPageNthWord",{value:function(e,t,o){return console.log("getPageNthWord method not defined contact - IDR SOLUTIONS"),{}}}),Object.defineProperty(Doc.prototype,"getPageNthWordQuads",{value:function(e,t){return console.log("getPageNthWordQuards method not defined contact - IDR SOLUTIONS"),{}}}),Object.defineProperty(Doc.prototype,"getPageNumWords",{value:function(e){return console.log("getPageNumWords method not defined contact - IDR SOLUTIONS"),0}}),Object.defineProperty(Doc.prototype,"getPageRotation",{value:function(e){return console.log("getPageRotation method not defined contact - IDR SOLUTIONS"),0}}),Object.defineProperty(Doc.prototype,"getPageTransition",{value:function(e){return console.log("getPageTransition method not defined contact - IDR SOLUTIONS"),[]}}),Object.defineProperty(Doc.prototype,"getPrintParams",{value:function(){return console.log("getPrintParams method not defined contact - IDR SOLUTIONS"),{}}}),Object.defineProperty(Doc.prototype,"getSound",{value:function(e){return console.log("getSound method not defined contact - IDR SOLUTIONS"),{}}}),Object.defineProperty(Doc.prototype,"getTemplate",{value:function(e){return console.log("getTemplate method not defined contact - IDR SOLUTIONS"),{}}}),Object.defineProperty(Doc.prototype,"getURL",{value:function(e,t){console.log("getURL method not defined contact - IDR SOLUTIONS")}}),Object.defineProperty(Doc.prototype,"gotoNamedDest",{value:function(e){console.log("gotoNamedDest method not defined contact - IDR SOLUTIONS")}}),Object.defineProperty(Doc.prototype,"importAnFDF",{value:function(e){console.log("importAnFDF method not defined contact - IDR SOLUTIONS")}}),Object.defineProperty(Doc.prototype,"importDataObject",{value:function(e,t){console.log("importDataObject method not defined contact - IDR SOLUTIONS")}}),Object.defineProperty(Doc.prototype,"importIcon",{value:function(e,t){console.log("importIcon method not defined contact - IDR SOLUTIONS")}}),Object.defineProperty(Doc.prototype,"importSound",{value:function(e){console.log("importSound method not defined contact - IDR SOLUTIONS")}}),Object.defineProperty(Doc.prototype,"importTextData",{value:function(e,t){return console.log("importTextData method not defined contact - IDR SOLUTIONS"),0}}),Object.defineProperty(Doc.prototype,"importXFAData",{value:function(e){console.log("importXFAData method not defined contact - IDR SOLUTIONS")}}),Object.defineProperty(Doc.prototype,"insertPages",{value:function(e,t,o,n){console.log("insertPages method not defined contact - IDR SOLUTIONS")}}),Object.defineProperty(Doc.prototype,"mailDoc",{value:function(){console.log("mailDoc method not defined contact - IDR SOLUTIONS")}}),Object.defineProperty(Doc.prototype,"mailForm",{value:function(){console.log("mailForm method not defined contact - IDR SOLUTIONS")}}),Object.defineProperty(Doc.prototype,"movePage",{value:function(e,t){console.log("movePage method not defined contact - IDR SOLUTIONS")}}),Object.defineProperty(Doc.prototype,"newPage",{value:function(e,t,o){console.log("newPage method not defined contact - IDR SOLUTIONS")}}),Object.defineProperty(Doc.prototype,"numFields",{get:function(){var e;return document.querySelectorAll("[data-field-name]").length}}),Object.defineProperty(Doc.prototype,"openDataObject",{value:function(e){return console.log("openDataObject method not defined contact - IDR SOLUTIONS"),this}}),Object.defineProperty(Doc.prototype,"print",{value:function(){window.print()}}),Object.defineProperty(Doc.prototype,"removeDataObject",{value:function(e){console.log("removeDataObject method not defined contact - IDR SOLUTIONS")}}),Object.defineProperty(Doc.prototype,"removeField",{value:function(e){var t;document.querySelector('[data-field-name="'+e+'"]').remove()}}),Object.defineProperty(Doc.prototype,"removeIcon",{value:function(e){console.log("removeIcon method not defined contact - IDR SOLUTIONS")}}),Object.defineProperty(Doc.prototype,"removeLinks",{value:function(e,t){console.log("removeLinks method not defined contact - IDR SOLUTIONS")}}),Object.defineProperty(Doc.prototype,"removeRequirement",{value:function(e){console.log("removeRequirement method not defined contact - IDR SOLUTIONS")}}),Object.defineProperty(Doc.prototype,"removeScript",{value:function(e){console.log("removeScript method not defined contact - IDR SOLUTIONS")}}),Object.defineProperty(Doc.prototype,"removeTemplate",{value:function(e){console.log("removeTemplate method not defined contact - IDR SOLUTIONS")}}),Object.defineProperty(Doc.prototype,"removeThumbnails",{value:function(e,t){console.log("removeThumbnails method not defined contact - IDR SOLUTIONS")}}),Object.defineProperty(Doc.prototype,"removeWeblinks",{value:function(e,t){console.log("removeWeblinks method not defined contact - IDR SOLUTIONS")}}),Object.defineProperty(Doc.prototype,"replacePages",{value:function(e,t,o,n){console.log("replacePages method not defined contact - IDR SOLUTIONS")}}),Object.defineProperty(Doc.prototype,"resetForm",{value:function(e){if(e);else{for(var t=document.getElementsByTagName("form")[0],o=t.elements,n=0;n<o.length;n++){var i;if(o[n].dataset&&o[n].dataset.fieldName&&o[n].dataset.defaultDisplay)idrform.doc.getField(o[n].dataset.fieldName).display=Number(o[n].dataset.defaultDisplay)}t.reset()}}}),Object.defineProperty(Doc.prototype,"saveAs",{value:function(e,t,o,n,i){var a;if(this._checkRequired())return window.alert("At least one required field was empty on export. Please fill in required fields (highlighted) before continuing"),void 0;console.log("saveAs method not defined contact - IDR SOLUTIONS")}}),Object.defineProperty(Doc.prototype,"scroll",{value:function(e,t){console.log("scroll method not defined contact - IDR SOLUTIONS")}}),Object.defineProperty(Doc.prototype,"selectPageNthWord",{value:function(e,t,o){console.log("selectPageNthWord method not defined contact - IDR SOLUTIONS")}}),Object.defineProperty(Doc.prototype,"setAction",{value:function(e,t){console.log("setAction method not defined contact - IDR SOLUTIONS")}}),Object.defineProperty(Doc.prototype,"setDataObjectContents",{value:function(e,t,o){console.log("setDataObjectContents method not defined contact - IDR SOLUTIONS")}}),Object.defineProperty(Doc.prototype,"setOCGOrder",{value:function(e){console.log("setOCGOrder method not defined contact - IDR SOLUTIONS")}}),Object.defineProperty(Doc.prototype,"setPageAction",{value:function(e,t){console.log("setPageAction method not defined contact - IDR SOLUTIONS")}}),Object.defineProperty(Doc.prototype,"setPageBoxes",{value:function(e,t,o,n){console.log("setPageBoxes method not defined contact - IDR SOLUTIONS")}}),Object.defineProperty(Doc.prototype,"setPageLabels",{value:function(e,t){console.log("setPageLabels method not defined contact - IDR SOLUTIONS")}}),Object.defineProperty(Doc.prototype,"setPageTabOrder",{value:function(e,t){console.log("setPageTabOrder method not defined contact - IDR SOLUTIONS")}}),Object.defineProperty(Doc.prototype,"setPageTransitions",{value:function(e,t,o){console.log("setPageTransitions method not defined contact - IDR SOLUTIONS")}}),Object.defineProperty(Doc.prototype,"spawnPageFromTemplate",{value:function(e,t,o,n,i){console.log("spawnPageFromTemplate method not defined contact - IDR SOLUTIONS")}}),Object.defineProperty(Doc.prototype,"_getFieldsHTML",{value:function(e){for(var t=new Array,o=0,n=e.length;o<n;o++)for(var i=document.getElementsByTagName(e[o]),a=0,r=i.length;a<r;a++)t.push(i[a]);return t}}),Object.defineProperty(Doc.prototype,"_checkRequired",{value:function(){for(var e=!1,t=this._getFieldsHTML(["input","textarea","select"]),o=0,n=t.length;o<n;o++){var i=t[o];i.hasAttribute("required")&&(null!==i.value&&""!==i.value||(i.style.border="1px solid red",e=!0))}return e}}),Object.defineProperty(Doc.prototype,"_submitFormAsXML",{value:function(e){var t;if(this._checkRequired())return window.alert("At least one required field was empty on export. Please fill in required fields (highlighted) before continuing"),void 0;for(var o="  <fields>",n=this._getFieldsHTML(["input","textarea","select"]),i,a,r=0,s=n.length;r<s;r++)if(i=(a=n[r]).getAttribute("data-field-name"))switch(a.type){case"radio":case"checkbox":a.checked&&null!=a.value&&(o+="<"+i+">"+a.value+"</"+i+">");break;default:null!=a.value&&(o+="<"+i+">"+a.value+"</"+i+">");break}o+="</fields>";var c=document.createElement("form");c.setAttribute("method","post"),document.body.appendChild(c),c.setAttribute("action",url);var l=document.createElement("textarea");l.setAttribute("name","xmldata"),l.value=btoa(o),c.appendChild(l),c.submit()}}),Object.defineProperty(Doc.prototype,"_submitFormAsJSON",{value:function(e){var t;if(this._checkRequired())return window.alert("At least one required field was empty on export. Please fill in required fields (highlighted) before continuing"),void 0;for(var o='{"fields":[\n',n=this._getFieldsHTML(["input","textarea","select"]),i,a,r=0,s=n.length;r<s;r++)if(i=(a=n[r]).getAttribute("data-field-name"))switch(a.type){case"radio":case"checkbox":a.checked&&null!=a.value&&(o+='"'+i+'":"'+a.value+'",\n');break;default:null!=a.value&&(o+='"'+i+'":"'+a.value+'",\n');break}o+="]}";var c=document.createElement("form");c.setAttribute("method","post"),document.body.appendChild(c),c.setAttribute("action",url);var l=document.createElement("textarea");l.setAttribute("name","jsondata"),l.value=btoa(o),c.appendChild(l),c.submit()}}),Object.defineProperty(Doc.prototype,"_submitFormAsPDF",{value:function(e){var t;if(this._checkRequired())return window.alert("At least one required field was empty on export. Please fill in required fields (highlighted) before continuing"),void 0;var o=document.getElementById("FDFXFA_Processing");o&&(o.style.display="block");var n=EcmaParser._insertFieldsToPDF(""),i=EcmaFilter.encodeBase64(n),a=document.createElement("form");a.setAttribute("method","post"),e||(e=window.prompt("Please Enter URL to Submit Form; \n[ Please use 'pdfdata' as named parameter for accessing filled pdf as base64 ] \n[ Please refer to FormVu documentation for defining submit URL ]")),a.setAttribute("action",e),document.body.appendChild(a);var r=document.createElement("textarea");r.setAttribute("name","pdfdata"),r.value=i,a.appendChild(r),a.submit(),o&&(o.style.display="none")}}),Object.defineProperty(Doc.prototype,"submitForm",{value:function(e,t,o,n,i,a,r){if(app.isAcroForm)this._submitFormAsPDF(e);else{var s=new PdfDocument,c=new PdfPage;s.addPage(c);var l=new PdfText(70,70,"Helvetica",20,"Please wait...");c.addText(l),l=new PdfText(70,110,"Helvetica",11,"If this message is not eventually replaced by proper contents of the document, your PDF"),c.addText(l),l=new PdfText(70,124,"Helvetica",11,"viewer may not be able to display this type of document."),c.addText(l),l=new PdfText(70,150,"Helvetica",11,"You can upgrade to the latest version of Adobe Reader for Windows, Mac, or Linux by"),c.addText(l),l=new PdfText(70,164,"Helvetica",11,"visiting http://www.adobe.com/go/reader_download."),c.addText(l),l=new PdfText(70,190,"Helvetica",11,"For more assistance with Adobe Reader visit http://www.adobe.com/go/acrreader."),c.addText(l),l=new PdfText(70,220,"Helvetica",7.5,"Windows is either a registered trademark or a trademark of Microsoft Corporation in the United States and/or other countries. Mac is a trademark "),c.addText(l),l=new PdfText(70,229,"Helvetica",7.5,"of Apple Inc., registered in the United States and other countries. Linux is the registered trademark of Linus Torvalds in the U.S. and other "),c.addText(l),l=new PdfText(70,238,"Helvetica",7.5,"countries."),c.addText(l);var d=generateXDP(),u=s.createPdfString(d),h=EcmaPDF.encode64(u),f=document.createElement("form");f.setAttribute("method","post"),e||(e=window.prompt("Please Enter URL to Submit Form; \n[ Please use 'pdfdata' as named parameter for accessing filled pdf as base64 ] \n[ Please refer to FormVu documentation for defining submit URL ]")),f.setAttribute("action",e),document.body.appendChild(f);var m=document.createElement("textarea");m.setAttribute("name","pdfdata"),m.value=h,f.appendChild(m),f.submit()}}}),Object.defineProperty(Doc.prototype,"syncAnnotScan",{value:function(){console.log("syncAnnotScan method not defined contact - IDR SOLUTIONS")}});var color={transparent:["T"],black:["G",0],white:["G",1],red:["RGB",1,0,0],green:["RGB",0,1,0],blue:["RGB",0,0,1],cyan:["CMYK",1,0,0,0],magenta:["CMYK",0,1,0,0],yellow:["CMYK",0,0,1,0],dkGray:["G",.25],gray:["G",.5],ltGray:["G",.75],convert:function(e,t){var o=e;switch(t){case"G":"RGB"===e[0]?o=new Array("G",.3*e[1]+.59*e[2]+.11*e[3]):"CMYK"===e[0]&&(o=new Array("G",1-Math.min(1,.3*e[1]+.59*e[2]+.11*e[3]+e[4])));break;case"RGB":"G"===e[0]?o=new Array("RGB",e[1],e[1],e[1]):"CMYK"===e[0]&&(o=new Array("RGB",1-Math.min(1,e[1]+e[4]),1-Math.min(1,e[2]+e[4]),1-Math.min(1,e[3]+e[4])));break;case"CMYK":"G"===e[0]?o=new Array("CMYK",0,0,0,1-e[1]):"RGB"===e[0]&&(o=new Array("CMYK",1-e[1],1-e[2],1-e[3],0));break}return o},equal:function(e,t){if("G"===e[0]?e=this.convert(e,t[0]):t=this.convert(t,e[0]),e[0]!==t[0])return!1;for(var o=e[0].length,n=1;n<=o;n++)if(e[n]!==t[n])return!1;return!0},htmlColorToPDF:function(e){e.hasOwnProperty("indexof")&&-1!==e.indexof("#")&&(e=hexToRgbCss(e));var t=rgbCssToArr(e);return["RGB",t[0]/255,t[1]/255,t[2]/255]},pdfColorToHTML:function(e){var t=color.convert(e,"RGB");return rgbToHexCss(parseInt(255*t[1]),parseInt(255*t[2]),parseInt(255*t[3]))}};function Field(e){this.input=e,this.buttonAlignX=0,this.buttonAlignY=0,this.buttonFitBounds=!1,this.buttonPosition=0,this.buttonScaleHoq=0,this.buttonScaleWhen=0,this.calcOrderIndex=0,this.comb=!1,this.commitOnSelChange=!0,this.currentValueIndices=[],this.defaultStyle={},this.defaultValue="",this.doNotScroll=!1,this.doNotSpellCheck=!1,this.delay=!1,this.doc=doc,this.exportValues=[],this.fileSelect=!1,this.highlight="none",this.multiline=!1,this.multipleSelection=!1,this.page=0,this.password=!1,this.print=!0,this.radiosInUnison=!1,this.rect=[],this.richText=!1,this.richValue=[],this.rotation=0,this.style="",this.submitName="",this.textFont=null,this.userName=""}function FDF(){this.deleteOption=0,this.isSigned=!1,this.numEmbeddedFiles=0}function FullScreen(){}Object.defineProperty(Field.prototype,"alignment",{get:function(){return this.input.style.textAlign?this.input.style.textAlign:"left"},set:function(e){this.input.style.textAlign=e}}),Object.defineProperty(Field.prototype,"borderStyle",{get:function(){switch(this.input.style.borderStyle){case"solid":return border.s;case"dashed":return border.d;case"beveled":return border.b;case"inset":return border.i;case"underline":return border.u}return"none"},set:function(e){this.input.style.borderStyle=e}}),Object.defineProperty(Field.prototype,"charLimit",{get:function(){return this.input.maxLength},set:function(e){this.input.maxLength=e}}),Object.defineProperty(Field.prototype,"display",{get:function(){return this.input&&("none"===this.input.style.display||this.input.classList.contains("idr-hidden"))?display.hidden:display.visible},set:function(e){switch(this.input&&(this.input.dataset.defaultDisplay=this.input.dataset.defaultDisplay??this.display),e){case display.visible:this.input.classList.contains("idr-hidden")&&this.input.classList.remove("idr-hidden"),this.input.style.display="initial";break;case display.hidden:case display.noView:this.input.style.display="none";break}}}),Object.defineProperty(Field.prototype,"editable",{get:function(){return this.input.disabled},set:function(e){this.input.style.disabled=e}}),Object.defineProperty(Field.prototype,"fillColor",{get:function(){if(!this.input)return"";var e=window.getComputedStyle(this.input);return color.htmlColorToPDF(e.backgroundColor)},set:function(e){this.input.style.backgroundColor=color.pdfColorToHTML(e)}}),Object.defineProperty(Field.prototype,"hidden",{get:function(){return this.input.hidden},set:function(e){this.input.hidden=e}}),Object.defineProperty(Field.prototype,"lineWidth",{get:function(){return parseInt(this.style.borderWidth)},set:function(e){this.input.style.borderWidth=e+"px"}}),Object.defineProperty(Field.prototype,"name",{get:function(){return this.input.getAttribute("data-field-name")},set:function(e){this.input.setAttribute("data-field-name",e)}}),Object.defineProperty(Field.prototype,"numItems",{get:function(){return this.input.options.length}}),Object.defineProperty(Field.prototype,"readOnly",{get:function(){return this.input.readOnly},set:function(e){this.input.readOnly=e}}),Object.defineProperty(Field.prototype,"required",{get:function(){return this.input.required},set:function(e){this.input.required=e}}),Object.defineProperty(Field.prototype,"textSize",{get:function(){return parseInt(this.input.style.fontSize)},set:function(e){this.input.style.fontSize=parseInt(e)+"px"}}),Object.defineProperty(Field.prototype,"strokeColor",{get:function(){return color.htmlColorToPDF(this.input.style.borderColor)},set:function(e){this.input.style.borderColor=color.pdfColorToHTML(e)}}),Object.defineProperty(Field.prototype,"textColor",{get:function(){return color.htmlColorToPDF(this.input.style.color)},set:function(e){this.input.style.color=color.pdfColorToHTML(e)}}),Object.defineProperty(Field.prototype,"type",{get:function(){var e=this.input.tagName;return"INPUT"===e?this.getAttribute("type"):"SELECT"===e?"listbox":"BUTTON"===e?"button":"text"}}),Object.defineProperty(Field.prototype,"value",{get:function(){if(this.input){var e=this.input.value,t;switch(this.input.getAttribute("type")){case"checkbox":if(!this.input.checked)return!1;break;case"radio":if(null!=e)return EcmaFormField.hexDecodeName(e);break;case"text":if(""===e)return e;break}return isNaN(e)?e:1*e}},set:function(e){"radio"==this.input.getAttribute("type")?this.input.value=EcmaFormField.hexEncodeName(e):this.input.value=e}}),Object.defineProperty(Field.prototype,"valueAsString",{get:function(){return""+this.input.value},set:function(e){this.input.value=""+e}}),Object.defineProperty(Field.prototype,"browseForFileToSubmit",{value:function(){console.log("browseForFileToSubmit is method not defined contact - IDR SOLUTIONS")}}),Object.defineProperty(Field.prototype,"buttonGetCaption",{value:function(){return this.input.innerHTML}}),Object.defineProperty(Field.prototype,"buttonGetIcon",{value:function(){console.log("buttonGetIcon is method not defined contact - IDR SOLUTIONS")}}),Object.defineProperty(Field.prototype,"buttonImportIcon",{value:function(){console.log("buttonImportIcon is method not defined contact - IDR SOLUTIONS")}}),Object.defineProperty(Field.prototype,"buttonSetCaption",{value:function(e){this.input.innerHTML=e}}),Object.defineProperty(Field.prototype,"buttonSetIcon",{value:function(){console.log("buttonSetIcon is method not defined contact - IDR SOLUTIONS")}}),Object.defineProperty(Field.prototype,"checkThisBox",{value:function(e,t){this.input.checked=!0}}),Object.defineProperty(Field.prototype,"clearItems",{value:function(){var e,t;for(e=this.input.options.length-1;e>=0;e--)this.input.remove(e)}}),Object.defineProperty(Field.prototype,"defaultsChecked",{value:function(){return this.input.checked}}),Object.defineProperty(Field.prototype,"deleteItemAt",{value:function(e){if(-1===e){var t=this.input.options.length-1;this.input.remove(t)}else this.input.remove(e)}}),Object.defineProperty(Field.prototype,"getArray",{value:function(){console.log("getArray is method not defined contact - IDR SOLUTIONS")}}),Object.defineProperty(Field.prototype,"getItemAt",{value:function(e,t){return this.input.options[e]}}),Object.defineProperty(Field.prototype,"getLock",{value:function(){console.log("getLock is method not defined contact - IDR SOLUTIONS")}}),Object.defineProperty(Field.prototype,"insertItemAt",{value:function(e,t,o){var n=document.createElement("option");n.text=e,this.input.add(n,o)}}),Object.defineProperty(Field.prototype,"isBoxChecked",{value:function(e){return this.input.checked}}),Object.defineProperty(Field.prototype,"isDefaultChecked",{value:function(e){console.log("isDefaultChecked is method not defined contact - IDR SOLUTIONS")}}),Object.defineProperty(Field.prototype,"setAction",{value:function(e,t){switch(e){case"MouseUp":this.input.addEventListener("mouseup",new Function(t));break;case"MouseDown":this.input.addEventListener("mousedown",new Function(t));break;case"MouseEnter":this.input.addEventListener("mouseenter",new Function(t));break;case"MouseExit":this.input.addEventListener("mouseexit",new Function(t));break;case"OnFocus":this.input.addEventListener("focus",new Function(t));break;case"OnBlur":this.input.addEventListener("blur",new Function(t));break;case"Keystroke":this.input.addEventListener("keydown",new Function(t));break;case"Validate":break;case"Calculate":break;case"Format":break}}}),Object.defineProperty(Field.prototype,"setFocus",{value:function(){this.input.focus()}}),Object.defineProperty(Field.prototype,"setItems",{value:function(e){for(var t=0;t<e.length;t++){var o=document.createElement("option");o.text=e[t],this.input.add(o)}}}),Object.defineProperty(Field.prototype,"setLock",{value:function(e){console.log("setLock is method not defined contact - IDR SOLUTIONS")}}),Object.defineProperty(Field.prototype,"signatureGetModifications",{value:function(){console.log("signatureGetModifications is method not defined contact - IDR SOLUTIONS")}}),Object.defineProperty(Field.prototype,"signatureGetSeedValue",{value:function(){console.log("signatureGetSeedValue is method not defined contact - IDR SOLUTIONS")}}),Object.defineProperty(Field.prototype,"signatureInfo",{value:function(){console.log("signatureInfo is method not defined contact - IDR SOLUTIONS")}}),Object.defineProperty(Field.prototype,"signauteSetSeedValue",{value:function(){console.log("signauteSetSeedValue is method not defined contact - IDR SOLUTIONS")}}),Object.defineProperty(Field.prototype,"signatureSign",{value:function(){console.log("signatureSign is method not defined contact - IDR SOLUTIONS")}}),Object.defineProperty(Field.prototype,"signatureValidate",{value:function(){console.log("signatureValidate is method not defined contact - IDR SOLUTIONS")}}),Object.defineProperty(FDF.prototype,"addContact",{value:function(e){console.log("addContact method not defined contact - IDR SOLUTIONS")}}),Object.defineProperty(FDF.prototype,"addEmbeddedFile",{value:function(e,t){console.log("addEmbeddedFile method not defined contact - IDR SOLUTIONS")}}),Object.defineProperty(FDF.prototype,"addRequest",{value:function(e,t,o){console.log("addRequest method not defined contact - IDR SOLUTIONS")}}),Object.defineProperty(FDF.prototype,"close",{value:function(){console.log("close method not defined contact - IDR SOLUTIONS")}}),Object.defineProperty(FDF.prototype,"mail",{value:function(){console.log("mail method not defined contact - IDR SOLUTIONS")}}),Object.defineProperty(FDF.prototype,"save",{value:function(){console.log("save method not defined contact - IDR SOLUTIONS")}}),Object.defineProperty(FDF.prototype,"signatureClear",{value:function(){return console.log("signatureClear method not defined contact - IDR SOLUTIONS"),!1}}),Object.defineProperty(FDF.prototype,"signatureSign",{value:function(){return console.log("signatureSign method not defined contact - IDR SOLUTIONS"),!1}}),Object.defineProperty(FDF.prototype,"signatureValidate",{value:function(e,t){return console.log("signatureSign method not defined contact - IDR SOLUTIONS"),{}}}),Object.defineProperty(FullScreen.prototype,"isFullscreen",{get:function(){return this.isinFullscreen},set:function(e){var t,o;e?(document.body.requestFullscreen||document.body.msRequestFullscreen||document.body.mozRequestFullScreen||document.body.webkitRequestFullscreen).call(document.body):(document.exitFullscreen||document.msExitFullscreen||document.mozCancelFullScreen||document.webkitCancelFullScreen).call(document)},configurable:!0,enumerable:!0}),Object.defineProperty(FullScreen.prototype,"isFullscreenEnabled",{value:function(){return document.fullscreenEnabled||document.msFullscreenEnabled||document.mozFullScreenEnabled||document.webkitFullscreenEnabled}}),Object.defineProperty(FullScreen.prototype,"isinFullscreen",{value:function(){return!!(document.fullscreenElement||document.msFullscreenElement||document.mozFullScreenElement||document.webkitFullscreenElement)}}),Object.defineProperty(FullScreen.prototype,"toggleFullscreen",{value:function(){var e,t;this.isinFullscreen()?(document.exitFullscreen||document.msExitFullscreen||document.mozCancelFullScreen||document.webkitCancelFullScreen).call(document):(document.body.requestFullscreen||document.body.msRequestFullscreen||document.body.mozRequestFullScreen||document.body.webkitRequestFullscreen).call(document.body)}});var ADBC={SQLT_BIGINT:0,SQLT_BINARY:1,SQLT_BIT:2,SQLT_CHAR:3,SQLT_DATE:4,SQLT_DECIMAL:5,SQLT_DOUBLE:6,SQLT_FLOAT:7,SQLT_INTEGER:8,SQLT_LONGVARBINARY:9,SQLT_LONGVARCHAR:10,SQLT_NUMERIC:11,SQLT_REAL:12,SQLT_SMALLINT:13,SQLT_TIME:14,SQLT_TIMESTAMP:15,SQLT_TINYINT:16,SQLT_VARBINARY:17,SQLT_VARCHAR:18,SQLT_NCHAR:19,SQLT_NVARCHAR:20,SQLT_NTEXT:21,Numeric:0,String:1,Binary:2,Boolean:3,Time:4,Date:5,TimeStamp:6,getDataSourceList:function(){return console.log("ADBC.getDataSourceList() method not defined contact - IDR SOLUTIONS"),new Array},newConnnection:function(){var e={};if(arguments[0]instanceof Object)e=arguments[0];else switch(e.cDSN=arguments[0],arguments.length){case 2:e.cUID=arguments[1];break;case 3:e.cUID=arguments[1],e.cPWD=arguments[2];break}return console.log("ADBC.newConnection method not defined contact - IDR SOLUTIONS"),null}};function Alerter(){this.dispathc=function(){console.log("dispatch method not defined contact - IDR SOLUTIONS")}}function Alert(){this.type="",this.doc=null,this.fromUser=!1,this.error={message:""},this.errorText="",this.fileName="",this.selection=null}function AlternatePresentation(){this.active=!1,this.type="",this.start=function(){console.log("start method not defined contact - IDR SOLUTIONS")},this.stop=function(){console.log("stop method not defined contact - IDR SOLUTIONS")}}function Annotation(){this.type="Text",this.rect=[],this.page=0,this.alignment=0,this.AP="Approved",this.arrowBegin="None",this.arrowEnd="None",this.attachIcon="PushPin",this.author="",this.borderEffectIntensity="",this.callout=[],this.caretSymbol="",this.contents="",this.creationDate=new Date,this.dash=[],this.delay=!1,this.doc=null,this.doCaption=!1,this.fillColor=[],this.gestures=[],this.hidden=!1,this.inReplyTo="",this.intent="",this.leaderExtend=0,this.leaderLength=0,this.lineEnding="none",this.lock=!1,this.modDate=new Date,this.name="",this.noteIcon="Note",this.noView=!1,this.opacity=1,this.open=!1,this.point=[],this.points=[],this.popupOpen=!0,this.popupRect=[],this.print=!1,this.quads=[],this.readOnly=!1,this.refType="",this.richContents=[],this.richDefaults=null,this.rotate=0,this.seqNum=0,this.soundIcon="",this.state="",this.stateModel="",this.strokeColor=[],this.style="",this.subject="",this.textFont="",this.textSize=10,this.toggleNoView=!1,this.vertices=null,this.width=1,this.URI="",this.GoTo=""}function Bookmark(){this.children=null,this.color=["RGB",1,0,0],this.name="",this.open=!0,this.parent=null,this.style=0,this.createChild=function(e,t,o){console.log("createChild method not defined contact - IDR SOLUTIONS")},this.execute=function(){console.log("execute method not defined contact - IDR SOLUTIONS")},this.insertChild=function(e,t){console.log("insertChild method not defined contact - IDR SOLUTIONS")},this.remove=function(){console.log("remove method not defined contact - IDR SOLUTIONS")},this.setAction=function(e){console.log("setAction method not defined contact - IDR SOLUTIONS")}}function Catalog(){this.isIdle=!1,this.jobs=new Array,this.getIndex=function(e){console.log("getIndex method not defined contact - IDR SOLUTIONS")},this.remove=function(e){console.log("remove method not defined contact - IDR SOLUTIONS")}}function CatalogJob(){this.path="",this.type="",this.status=""}function Certificate(){this.binary="",this.issuerDN={},this.keyUsage=new Array,this.MD5Hash="",this.privateKeyValidityEnd={},this.privateKeyValidityStart={},this.SHA1Hash="",this.serialNumber="",this.subjectCN="",this.subjectDN="",this.ubRights={},this.usage={},this.validityEnd={},this.validityStart={}}function Rights(){this.mode="",this.rights=new Array}function Usage(){this.endUserSigning=!1,this.endUserEncryption=!1}Object.defineProperty(Annotation.prototype,"getDictionaryString",{value:function(){for(var e="<</Type /Annot /Subtype /"+this.type+" /Rect [ ",t=0,o=this.rect.length;t<o;t++)e+=this.rect[t]+" ";if(e+="]",this.type===AnnotationType.Highlight){e+="/QuadPoints [ ";for(var t=0,o=this.quads.length;t<o;t++)e+=this.quads[t]+" ";e+="]"}else if(this.type===AnnotationType.Text)this.contents.length>0&&(e+="/Contents ("+this.contents+")"),this.open&&(e+="/Open true");else if(this.type===AnnotationType.Link){if(this.URI.length>0?e+="/A <</Type /Action /S /URI /URI ("+this.URI+")>>":this.GoTo.length>0&&(e+="/Dest ["+this.GoTo+" /Fit]>>"),this.quads.length>0){e+="/QuadPoints [ ";for(var t=0,o=this.quads.length;t<o;t++)e+=this.quads[t]+" ";e+="]"}}else if(this.type===AnnotationType.Line)e+="/L ["+this.points[0]+" "+this.points[1]+" "+this.points[2]+" "+this.points[3]+"]";else if(this.type===AnnotationType.Polygon||this.type===AnnotationType.PolyLine){e+="/Vertices [";for(var t=0,o=this.vertices.length;t<o;t++)e+=this.vertices[t]+" ";e+="]"}else if(this.type===AnnotationType.Ink){e+="/InkList [";for(var n=this.gestures,t=0,o=n.length;t<o;t++){var i=n[t];e+=" [";for(var a=0,r=i.length;a<r;a++)e+=i[a]+" ";e+="] "}e+="]"}else if(this.type===AnnotationType.FreeText){for(var s="",t=0,o=this.richContents.length;t<o;t++){var c=this.richContents[t];s+="<span style='font-size:"+c.textSize+";color:"+c.textColor+"'>"+c.text+"</span>"}e+="/DA (/Arial "+this.textSize+" Tf)/RC (<body><p>"+s+"</p></body>)"}if(this.type===AnnotationType.Line||this.type===AnnotationType.Highlight||this.type===AnnotationType.FreeText||this.type===AnnotationType.Link||this.type===AnnotationType.Square||this.type===AnnotationType.Circle||this.type===AnnotationType.Polygon||this.type===AnnotationType.PolyLine||this.type===AnnotationType.Ink){if(this.opacity<1&&(e+="/CA "+this.opacity),1!==this.width&&(e+="/BS <</Type /Border /W "+this.width+">>"),this.fillColor.length>0){e+="/IC [";for(var t=0,o=this.fillColor.length;t<o;t++)e+=this.fillColor[t]+" ";e+="]"}if(this.strokeColor.length>0){e+="/C [";for(var t=0,o=this.strokeColor.length;t<o;t++)e+=this.strokeColor[t]+" ";e+="]"}}return e+=">>"}}),Object.defineProperty(Annotation.prototype,"destroy",{value:function(){return console.log("destroy method not defined contact - IDR SOLUTIONS"),!0}}),Object.defineProperty(Annotation.prototype,"getProps",{value:function(){return console.log("getProps method not defined contact - IDR SOLUTIONS"),!0}}),Object.defineProperty(Annotation.prototype,"getStateInModel",{value:function(){return console.log("getStateInModel method not defined contact - IDR SOLUTIONS"),!0}}),Object.defineProperty(Annotation.prototype,"setProps",{value:function(e){for(var t in e)t in this&&(this[t]=e[t]);return!0}}),Object.defineProperty(Annotation.prototype,"transitionToState",{value:function(e){console.log("transitionToState method not defined contact - IDR SOLUTIONS")}});var Collab={addStateModel:function(e,t,o,n,i,a){console.log("addStateModel not implemented")},documentToStream:function(e){console.log("documentToStream not implemented")},removeStateModel:function(e){console.log("removeStateModel not implemented")}};function States(){this.cUIName="",this.oIcon={}}function ColorConvertAction(){this.action={},this.alias="",this.colorantName="",this.convertIntent=0,this.convertProfile="",this.embed=!1,this.isProcessColor=!1,this.matchAttributesAll={},this.matchAttributesAny=0,this.matchIntent={},this.matchSpaceTypeAll={},this.matchSpaceTypeAny=0,this.preserveBlack=!1,this.useBlackPointCompensation=!1}function Column(){this.columnNum-0,this.name="",this.type=0,this.typeName="",this.value=""}function ColumnInfo(){this.name="",this.description="",this.type="",this.typeName=""}function Connection(){this.close=function(){console.log("close method not defined contact - IDR SOLUTIONS")},this.getColumnList=function(e){console.log("getColumnList method not defined contact - IDR SOLUTIONS")},this.getTableList=function(){console.log("getTableList method not defined contact - IDR SOLUTIONS")},this.newStatement=function(){console.log("newStatement method not defined contact - IDR SOLUTIONS")}}function Data(){this.creationDate={},this.description="",this.MIMEType="",this.modDate={},this.name="",this.path="",this.size=0}function DataSourceInfo(){this.name="",this.description=""}function dbg(){this.bps=new Array,this.c=new function(){console.log("c method not defined contact - IDR SOLUTIONS")},this.cb=function(e,t){console.log("cb method not defined contact - IDR SOLUTIONS")},this.q=function(){console.log("q method not defined contact - IDR SOLUTIONS")},this.sb=function(e,t,o){console.log("sb method not defined contact - IDR SOLUTIONS")},this.si=function(){console.log("si method not defined contact - IDR SOLUTIONS")},this.sn=function(){console.log("sn method not defined contact - IDR SOLUTIONS")},this.so=function(){console.log("so method not defined contact - IDR SOLUTIONS")},this.sv=function(){console.log("sv method not defined contact - IDR SOLUTIONS")}}function Dialog(){this.enable=function(e){console.log("enable method not defined contact - IDR SOLUTIONS")},this.end=function(e){console.log("end method not defined contact - IDR SOLUTIONS")},this.load=function(e){console.log("load method not defined contact - IDR SOLUTIONS")},this.store=function(e){console.log("store method not defined contact - IDR SOLUTIONS")}}function DirConnection(){this.canList=!1,this.canDoCustomSearch=!1,this.canDoCustomUISearch=!1,this.canDoStandardSearch=!1,this.groups=new Array,this.name="",this.uiName=""}function Directory(){this.info={},this.connect=function(e,t){return console.log("connect method not defined contact - IDR SOLUTIONS"),null}}function DirectoryInformation(){this.dirStdEntryID="",this.dirStdEntryName="",this.dirStdEntryPrefDirHandlerID="",this.dirStdEntryDirType="",this.dirStdEntryDirVersion="",this.server="",this.port=0,this.searchBase="",this.maxNumEntries=0,this.timeout=0}function Icon(){this.name=""}function IconStream(){this.width=0,this.height=0}function Identity(){this.corporation="",this.email="",this.loginName="",this.name=""}function Index(){this.available=!1,this.name="",this.path="",this.selected=!1,this.build=function(){console.log("build is method not defined contact - IDR SOLUTIONS")},this.parameters=function(){console.log("parameters is method not defined contact - IDR SOLUTIONS")}}function Link(e){this.ele=e,this.borderColor=[],this.borderWidth=0,this.highlightMode="invert",this.rect=[],this.setAction=function(){console.log("setAction is method not defined contact - IDR SOLUTIONS")}}function Marker(){this.frame=0,this.index=0,this.name="",this.time=0}function Markers(){this.player={},this.get=function(e){console.log("get is method not defined contact - IDR SOLUTIONS")}}function Media(){this.align={topLeft:0,topCenter:1,topRight:2,centerLeft:3,center:4,centerRight:5,bottomLeft:6,bottomCenter:7,bottomRight:8},this.canResize={no:0,keepRatio:1,yes:2},this.closeReason={general:0,error:1,done:2,stop:3,play:4,uiGeneral:5,uiScreen:6,uiEdit:7,docClose:8,docSave:9,docChange:10},this.defaultVisible=!0,this.ifOffScreen={allow:0,forseOnScreen:1,cancel:2},this.layout={meet:0,slice:1,fill:2,scroll:3,hidden:4,standard:5},this.monitorType={document:0,nonDocument:1,primary:3,bestColor:4,largest:5,tallest:6,widest:7},this.openCode={success:0,failGeneral:1,failSecurityWindow:2,failPlayerMixed:3,failPlayerSecurityPrompt:4,failPlayerNotFound:5,failPlayerMimeType:6,failPlayerSecurity:7,failPlayerData:8},this.over={pageWindow:0,appWindow:1,desktop:2,monitor:3},this.pageEventNames={Open:0,Close:1,InView:2,OutView:3},this.raiseCode={fileNotFound:0,fileOpenFailed:1},this.raiseSystem={fileError:0},this.renditionType={unknown:0,media:1,selector:2},this.status={clear:0,message:1,contacting:2,buffering:3,init:4,seeking:5},this.trace=!1,this.version=7,this.windowType={docked:0,floating:1,fullScreen:2},this.addStockEvents=function(e,t){console.log("addStockEvents method not defined contact - IDR SOLUTIONS")},this.alertFileNotFound=function(e,t,o){console.log("alertFileNotFound method not defined contact - IDR SOLUTIONS")},this.alertSelectFailed=function(e,t,o,n){console.log("alertFileNotFound method not defined contact - IDR SOLUTIONS")},this.argsDWIM=function(e){console.log("argsDWIM method not defined contact - IDR SOLUTIONS")},this.canPlayOrAlert=function(e){console.log("canPlayOrAlert method not defined contact - IDR SOLUTIONS")},this.computeFloatWinRect=function(e,t,o,n){console.log("computeFloatWinRect method not defined contact - IDR SOLUTIONS")},this.constrainRectToScreen=function(e,t){console.log("constrainRectToScreen method not defined contact - IDR SOLUTIONS")},this.createPlayer=function(e){console.log("createPlayer method not defined contact - IDR SOLUTIONS")},this.getAltTextData=function(e){console.log("getAltTextData method not defined contact - IDR SOLUTIONS")},this.getAltTextSettings=function(){console.log("getAltTextSettings method not defined contact - IDR SOLUTIONS")},this.getAnnotStockEvents=function(){console.log("getAnnotStockEvents method not defined contact - IDR SOLUTIONS")},this.getAnnotTraceEvents=function(){console.log("getAnnotTraceEvents method not defined contact - IDR SOLUTIONS")},this.getPlayers=function(){console.log("getPlayers method not defined contact - IDR SOLUTIONS")},this.getPlayerStockEvents=function(){console.log("getPlayerStockEvents method not defined contact - IDR SOLUTIONS")},this.getPlayerTraceEvents=function(){console.log("getPlayerTraceEvents method not defined contact - IDR SOLUTIONS")},this.getRenditionSettings=function(){console.log("getRenditionSettings method not defined contact - IDR SOLUTIONS")},this.getURLData=function(){console.log("getURLData method not defined contact - IDR SOLUTIONS")},this.getURLSettings=function(){console.log("getURLSettings method not defined contact - IDR SOLUTIONS")},this.getWindowBorderSize=function(){console.log("getWindowBorderSize method not defined contact - IDR SOLUTIONS")},this.openPlayer=function(){console.log("openPlayer method not defined contact - IDR SOLUTIONS")},this.removeStockEvents=function(){console.log("removeStockEvents method not defined contact - IDR SOLUTIONS")},this.startPlayer=function(){console.log("startPlayer method not defined contact - IDR SOLUTIONS")}}function MediaOffset(){this.frame=0,this.marker="",this.time=0}function MediaPlayer(){this.annot={},this.defaultSize={width:0,height:0},this.doc={},this.events={},this.hasFocus=!1,this.id=0,this.innerRect=[],this.isOpen=!1,this.isPlaying=!1,this.outerRect=[],this.page=0,this.settings={},this.uiSize=[],this.visible=!1,this.close=function(){console.log("close is not implemented")},this.open=function(){console.log("open is not implemented")},this.pause=function(){console.log("pause is not implemented")},this.play=function(){console.log("play is not implemented")},this.seek=function(){console.log("seek is not implemented")},this.setFocus=function(){console.log("setFocus is not implemented")},this.stop=function(){console.log("stop is not implemented")},this.triggerGetRect=function(){console.log("triggerGetRect is not implemented")}}function MediaReject(){this.rendition={}}function MediaSelection(){this.selectContext={},this.players=[],this.rejects=[],this.rendtion={}}function MediaSettings(){this.autoPlay=!1,this.baseURL="",this.bgColor=[],this.bgOpacity=1,this.data={},this.duration=0,this.endAt=0,this.floating={},this.layout=0,this.monitor={},this.monitorType=0,this.page=0,this.palindrome=!1,this.players={},this.rate=0,this.repeat=0,this.showUI=!1,this.startAt={},this.visible=!1,this.volume=0,this.windowType=0}function Monitor(){this.colorDepth=0,this.isPrimary=!1,this.rect=[],this.workRect=[]}function Monitors(){this.bestColor=function(){console.log("bestColor is not implemented")},this.bestFit=function(){console.log("bestFit is not implemented")},this.desktop=function(){console.log("desktop is not implemented")},this.document=function(){console.log("document is not implemented")},this.filter=function(){console.log("filter is not implemented")},this.largest=function(){console.log("largest is not implemented")},this.leastOverlap=function(){console.log("leastOverlap is not implemented")},this.mostOverlap=function(){console.log("mostOverlap is not implemented")},this.nonDocument=function(){console.log("nonDocument is not implemented")},this.primary=function(){console.log("primary is not implemented")},this.secondary=function(){console.log("secondary is not implemented")},this.select=function(){console.log("select is not implemented")},this.tallest=function(){console.log("tallest is not implemented")},this.widest=function(){console.log("widest is not implemented")}}function Net(){this.SOAP={},this.Discovery={},this.HTTP={},this.streamDecode=function(){console.log("streamDecode is not implemented")},this.streamDigest=function(){console.log("streamDigest is not implemented")},this.streamEncode=function(){console.log("streamEncode is not implemented")}}function OCG(){this.constants={},this.initState=!1,this.locked=!1,this.name="",this.state=!1,this.getIntent=function(){console.log("getIntent is not implemented")},this.setAction=function(){console.log("setAction is not implemented")},this.setIntent=function(){console.log("setIntent is not implemented")}}function PlayerInfo(){this.id="",this.mimeTypes=[],this.name="",this.version="",this.canPlay=function(){console.log("canPlay is not implemented")},this.canUseData=function(){console.log("canUseData is not implemented")},this.honors=function(){console.log("honors is not implemented")}}function PlayerInfoList(){this.select=function(){console.log("select is not implemented")}}function Plugin(){this.certified=!1,this.loaded=!1,this.name="",this.path="",this.version=0}function Booklet(){this.binding=0,this.duplexMode=0,this.subsetForm=0,this.subsetTo=0}function PrintParams(){this.binaryOK=!0,this.bitmapDPI=0,this.booklet=new Booklet,this.colorOverride=0,this.colorProfile="",this.constants={},this.downloadFarEastFonts=!1,this.fileName="",this.firstPage=0,this.flags=0,this.fontPolicy=0,this.gradientDPI=0,this.interactive=0,this.lastPage=0,this.nUpAutoRotate=!1,this.nUpNumPagesH=0,this.nUpNumPagesV=0,this.nUpPageBorder=!1,this.nUpPageOrder=0,this.pageHandling=0,this.pageSubset=0,this.printAsImage=!1,this.printContent=0,this.printName="",this.psLevel=0,this.rasterFlags=0,this.reversePages=!1,this.tileLabel=!1,this.tileMark=0,this.tileOverlap=0,this.tileScale=0,this.transparencyLevel=0,this.usePrinterCRD=0,this.useT1Conversion=0}function Span(){this.alignement=0,this.fontFamily=["serif","sans-serif","monospace"],this.fontStretch="normal",this.fontStyle="normal",this.fontWeight=400,this.strikeThrough=!1,this.subscript=!1,this.superscript=!1,this.text="",this.textColor=color.black,this.textSize=12,this.underline=!1}function Thermometer(){this.cancelled=!1,this.duration=0,this.text="",this.value=0,this.begin=function(){console.log("begin method not defined contact - IDR SOLUTIONS")},this.end=function(){console.log("end method not defined contact - IDR SOLUTIONS")}}var util={crackURL:function(e){return console.log("crackURL method not defined contact - IDR SOLUTIONS"),{}},iconStreamFromIcon:function(){return console.log("iconStreamFromIcon method not defined contact - IDR SOLUTIONS"),{}},printd:function(e,t,o){var n=["JANUARY","FEBRUARY","MARCH","APRIL","MAY","JUNE","JULY","AUGUST","SEPTEMBER","OCTOBER","NOVEMBER","DECEMBER"],i=["SUNDAY","MONDAY","TUESDAY","WEDNESDAY","THURSDAY","FRIDAY","SATURDAY"];switch(e){case 0:return this.printd("D:yyyymmddHHMMss",t);case 1:return this.printd("yyyy.mm.dd HH:MM:ss",t);case 2:return this.printd("m/d/yy h:MM:ss tt",t)}var a={year:t.getFullYear(),month:t.getMonth(),day:t.getDate(),dayOfWeek:t.getDay(),hours:t.getHours(),minutes:t.getMinutes(),seconds:t.getSeconds()},r=/(mmmm|mmm|mm|m|dddd|ddd|dd|d|yyyy|yy|HH|H|hh|h|MM|M|ss|s|tt|t|\\.)/g;return e.replace(r,(function(e,t){switch(t){case"mmmm":return n[a.month];case"mmm":return n[a.month].substring(0,3);case"mm":return(a.month+1).toString().padStart(2,"0");case"m":return(a.month+1).toString();case"dddd":return i[a.dayOfWeek];case"ddd":return i[a.dayOfWeek].substring(0,3);case"dd":return a.day.toString().padStart(2,"0");case"d":return a.day.toString();case"yyyy":return a.year.toString();case"yy":return(a.year%100).toString().padStart(2,"0");case"HH":return a.hours.toString().padStart(2,"0");case"H":return a.hours.toString();case"hh":return(1+(a.hours+11)%12).toString().padStart(2,"0");case"h":return(1+(a.hours+11)%12).toString();case"MM":return a.minutes.toString().padStart(2,"0");case"M":return a.minutes.toString();case"ss":return a.seconds.toString().padStart(2,"0");case"s":return a.seconds.toString();case"tt":return a.hours<12?"am":"pm";case"t":return a.hours<12?"a":"p"}return t.charCodeAt(1)}))},printf:function(e,arguments){var t=e.indexOf("%");if(-1===t)return e+" "+arguments;var o=e[t+1],n=e.indexOf("."),i=e[n+1],a=arguments.toFixed(i);return t>0&&(a=e.substring(0,t)+a),a},printx:function(e,t){var o=[e=>e,e=>e.toUpperCase(),e=>e.toLowerCase()],n=[],i=0,a=t.length,r=o[0],s=!1;for(var c of e)if(s)n.push(c),s=!1;else{if(i>=a)break;switch(c){case"?":n.push(r(t.charAt(i++)));break;case"X":for(;i<a;){var l;if("a"<=(l=t.charAt(i++))&&l<="z"||"A"<=l&&l<="Z"||"0"<=l&&l<="9"){n.push(r(l));break}}break;case"A":for(;i<a;){var l;if("a"<=(l=t.charAt(i++))&&l<="z"||"A"<=l&&l<="Z"){n.push(r(l));break}}break;case"9":for(;i<a;){var l;if("0"<=(l=t.charAt(i++))&&l<="9"){n.push(l);break}}break;case"*":for(;i<a;)n.push(r(t.charAt(i++)));break;case"\\":s=!0;break;case">":r=o[1];break;case"<":r=o[2];break;case"=":r=o[0];break;default:n.push(c)}}return n.join("")},scand:function(e,t){var o=e.split(/[ \-:\/\.]/),n=t.split(/[ \-:\/\.]/);if(o.length!=n.length)return null;for(var i=new Date,a=0;a<o.length;a++){var r;switch(r=(r=n[a]).toUpperCase(),o[a]){case"d":case"dd":if(isNaN(r))return null;i.setDate(parseInt(r));break;case"m":case"mm":if(isNaN(r))return null;var r;if(0==(r=parseInt(r))||r>12)return null;i.setMonth(r);break;case"mmm":case"mmmm":if(isNaN(r)){for(var s=["JANUARY","FEBRUARY","MARCH","APRIL","MAY","JUNE","JULY","AUGUST","SEPTEMBER","OCTOBER","NOVEMBER","DECEMBER"],c=-1,l=0,d=s.length;l<d;l++)if(-1!==s[l].indexOf(r)){c=l;break}if(-1===c)return null;i.setMonth(c)}else i.setMonth(parseInt(r)-1);break;case"y":case"yy":if(isNaN(r))return null;i.setFullYear(parseInt(r));break;case"yyy":case"yyyy":if(isNaN(r)||r.length!=o[a].length)return null;i.setFullYear(parseInt(r));break;case"H":case"HH":if(isNaN(r))return null;i.setHours(parseInt(r));break;case"M":case"MM":if(isNaN(r))return null;i.setMinutes(parseInt(r));case"s":case"ss":if(isNaN(r))return null;i.setSeconds(parseInt(r))}}return i},spansToXML:function(e){console.log("method not defined contact - IDR SOLUTIONS")},streamFromString:function(e,t){console.log("method not defined contact - IDR SOLUTIONS")},stringFromStream:function(e,t){console.log("method not defined contact - IDR SOLUTIONS")},xmlToSpans:function(e){console.log("method not defined contact - IDR SOLUTIONS")}},JSRESERVED=["break","delete","function","return","typeof","case","do","if","switch","var","catch","else","in","this","void","continue","false","instanceof","throw","while","debugger","finally","new","true","with","default","for","null","try","class","const","enum","export","extends","import","super","implements","let","private","public","yield","interface","package","protected","static","abstract","double","goto","native","static","boolean","enum","implements","package","super","byte","export","import","private","synchronized","char","extends","int","protected","throws","class","final","interface","public","transient","const","float","long","short","volatile","arguments","encodeURI","Infinity","Number","RegExp","Array","encodeURIComponent","isFinite","Object","String","Boolean","Error","isNaN","parseFloat","SyntaxError","Date","eval","JSON","parseInt","TypeError","decodeURI","EvalError","Math","RangeError","undefined","decodeURIComponent","Function","NaN","ReferenceError","URIError"],EcmaFilter={decode:function(e,t){if("FlateDecode"===e){for(var o=new EcmaFlate,n=[],i=0,a=2,r=t.length;a<r;a++)n[i++]=t[a];return o.decode(n)}var s,c,l;return"ASCII85Decode"===e?(new EcmaAscii85).decode(t):"ASCIIHexDecode"===e?(new EcmaAsciiHex).decode(t):"RunLengthDecode"===e?(new EcmaRunLength).decode():(console.log("This type of decoding is not supported yet : "+e),t)},applyPredictor:function(e,t,o,n,i,a,r){if(1===t)return e;for(var s,c=e.length,l=new EcmaBuffer(e),d=n*i+7>>3,u=(a*n*i+7>>3)+d,h=this.createByteBuffer(u),f=this.createByteBuffer(u),m,p=0,g=0;!(c<=g);){var y=0,S=d;if((s=t)>=10){if(-1===(m=l.getByte()))break;m+=10}else m=s;for(;S<u&&-1!==(y=l.readTo(h,S,u-S));)S+=y,g+=y;if(-1===y)break;switch(m){case 2:for(var O=d;O<u;O++){var E=255&h[O],A=255&h[O-d];h[O]=E+A&255,o&&(o[p]=h[O]),p++}break;case 10:for(var O=d;O<u;O++)o&&(o[p]=255&h[O]),p++;break;case 11:for(var O=d;O<u;O++){var E=255&h[O],A=255&h[O-d];h[O]=E+A,o&&(o[p]=255&h[O]),p++}break;case 12:for(var O=d;O<u;O++){var E=(255&f[O])+(255&h[O]);h[O]=E,o&&(o[p]=255&h[O]),p++}break;case 13:for(var O=d;O<u;O++){var I=255&h[O],v=(255&h[O-d])+(255&f[O])>>1;h[O]=I+v,o&&(o[p]=255&h[O]),p++}break;case 14:for(var O=d;O<u;O++){var D=255&h[O-d],b=255&f[O],T=255&f[O-d],F=D+b-T,R=F-D,L=F-b,P=F-T;R=R<0?-R:R,L=L<0?-L:L,P=P<0?-P:P,h[O]=R<=L&&R<=P?h[O]+D:L<=P?h[O]+b:h[O]+T,o&&(o[p]=255&h[O]),p++}break;case 15:break}for(var y=0;y<u;y++)f[y]=h[y]}return p},createByteBuffer:function(e){for(var t=[],o=0;o<e;o++)t.push(0);return t},decodeBase64:function(e){for(var t="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",o,n,i,a,r=[],s=e.replace(/[^A-Za-z0-9\+\/\=]/g,""),c=s.length,l=0;l<c;)o=t.indexOf(s.charAt(l++)),n=t.indexOf(s.charAt(l++)),i=t.indexOf(s.charAt(l++)),a=t.indexOf(s.charAt(l++)),r.push(o<<2|n>>4),64!==i&&r.push((15&n)<<4|i>>2),64!==a&&r.push((3&i)<<6|a);return r},encodeBase64:function(e){for(var t="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",o="",n,i,a,r,s,c,l,d=0,u=e.length;d<u;)r=(n=e[d++])>>2,s=(3&n)<<4|(i=e[d++])>>4,c=(15&i)<<2|(a=e[d++])>>6,l=63&a,isNaN(i)?c=l=64:isNaN(a)&&(l=64),o+=t.charAt(r)+t.charAt(s)+t.charAt(c)+t.charAt(l);return o}};function EcmaFlate(){this.decode=function(e){var t,o,n,i,a=1024;for(p=0,h=0,f=0,l=-1,m=!1,E=A=0,D=null,d=e,u=0,o=new Array(a),t=[];(n=j(o,0,a))>0;)for(i=0;i<n;i++)t.push(o[i]);return d=null,t};var e=[0,1,3,7,15,31,63,127,255,511,1023,2047,4095,8191,16383,32767,65535],t=[3,4,5,6,7,8,9,10,11,13,15,17,19,23,27,31,35,43,51,59,67,83,99,115,131,163,195,227,258,0,0],o=[1,2,3,4,5,7,9,13,17,25,33,49,65,97,129,193,257,385,513,769,1025,1537,2049,3073,4097,6145,8193,12289,16385,24577],n=[16,17,18,0,8,7,9,6,10,5,11,4,12,3,13,2,14,1,15],i=[0,0,0,0,0,0,0,0,1,1,1,1,2,2,2,2,3,3,3,3,4,4,4,4,5,5,5,5,0,99,99],a=[0,0,0,0,1,1,2,2,3,3,4,4,5,5,6,6,7,7,8,8,9,9,10,10,11,11,12,12,13,13],r=32768,s=0,c=new Array(r<<1),l,d,u,h,f,m,p,g=null,y,S,O,E,A,I=9,v=6,D,b,T,F;function R(){return d.length===u?-1:255&d[u++]}function L(t){return h&e[t]}function P(){this.next=null,this.list=null}function N(){this.e=0,this.b=0,this.n=0,this.t=null}function C(e,t,o,n,i,a){this.BMAX=16,this.N_MAX=288,this.status=0,this.root=null,this.m=0;var r,s=new Array(this.BMAX+1),c,l,d,u,h,f,m,p=new Array(this.BMAX+1),g,y,S,O=new N,E=new Array(this.BMAX),A=new Array(this.N_MAX),I=new Array(this.BMAX+1),v,D,b,T,F,R;for(R=this.root=null,h=0;h<s.length;h++)s[h]=0;for(h=0;h<p.length;h++)p[h]=0;for(h=0;h<E.length;h++)E[h]=null;for(h=0;h<A.length;h++)A[h]=0;for(h=0;h<I.length;h++)I[h]=0;c=t>256?e[256]:this.BMAX,g=e,y=0,h=t;do{s[g[y]]++,y++}while(--h>0);if(s[0]===t)return this.root=null,this.m=0,this.status=0,void 0;for(f=1;f<=this.BMAX&&0===s[f];f++);for(m=f,a<f&&(a=f),h=this.BMAX;0!==h&&0===s[h];h--);for(d=h,a>h&&(a=h),b=1<<f;f<h;f++,b<<=1)if((b-=s[f])<0)return this.status=2,this.m=a,void 0;if((b-=s[h])<0)return this.status=2,this.m=a,void 0;for(s[h]+=b,I[1]=f=0,g=s,y=1,D=2;--h>0;)I[D++]=f+=g[y++];g=e,y=0,h=0;do{0!==(f=g[y++])&&(A[I[f]++]=h)}while(++h<t);for(t=I[d],I[0]=h=0,g=A,y=0,u=-1,v=p[0]=0,S=null,T=0;m<=d;m++)for(r=s[m];r-- >0;){for(;m>v+p[1+u];){if(v+=p[1+u],u++,T=(T=d-v)>a?a:T,(l=1<<(f=m-v))>r+1)for(l-=r+1,D=m;++f<T&&!((l<<=1)<=s[++D]);)l-=s[D];for(v+f>c&&v<c&&(f=c-v),T=1<<f,p[1+u]=f,S=new Array(T),F=0;F<T;F++)S[F]=new N;(R=R?R.next=new P:this.root=new P).next=null,R.list=S,E[u]=S,u>0&&(I[u]=h,O.b=p[u],O.e=16+f,O.t=S,f=(h&(1<<v)-1)>>v-p[u],E[u-1][f].e=O.e,E[u-1][f].b=O.b,E[u-1][f].n=O.n,E[u-1][f].t=O.t)}for(O.b=m-v,y>=t?O.e=99:g[y]<o?(O.e=g[y]<256?16:15,O.n=g[y++]):(O.e=i[g[y]-o],O.n=n[g[y++]-o]),l=1<<m-v,f=h>>v;f<T;f+=l)S[f].e=O.e,S[f].b=O.b,S[f].n=O.n,S[f].t=O.t;for(f=1<<m-1;0!=(h&f);f>>=1)h^=f;for(h^=f;(h&(1<<v)-1)!==I[u];)v-=p[u],u--}this.m=p[1],this.status=0!==b&&1!==d?1:0}function k(e){for(;f<e;)h|=R()<<f,f+=8}function B(e){h>>=e,f-=e}function U(e,t,o){if(0===o)return 0;for(var n,i,a=0;;){for(k(T),n=(i=D.list[L(T)]).e;n>16;){if(99===n)return-1;B(i.b),k(n-=16),n=(i=i.t[L(n)]).e}if(B(i.b),16!==n){if(15===n)break;for(k(n),E=i.n+L(n),B(n),k(F),n=(i=b.list[L(F)]).e;n>16;){if(99===n)return-1;B(i.b),k(n-=16),n=(i=i.t[L(n)]).e}for(B(i.b),k(n),A=p-i.n-L(n),B(n);E>0&&a<o;)E--,A&=r-1,p&=r-1,e[t+a++]=c[p++]=c[A++];if(a===o)return o}else if(p&=r-1,e[t+a++]=c[p++]=i.n,a===o)return o}return l=-1,a}function w(e,t,o){var n;if(B(n=7&f),k(16),n=L(16),B(16),k(16),n!==(65535&~h))return-1;for(B(16),E=n,n=0;E>0&&n<o;)E--,p&=r-1,k(8),e[t+n++]=c[p++]=L(8),B(8);return 0===E&&(l=-1),n}function x(e,n,r){if(null===g){var s,c,l=new Array(288);for(s=0;s<144;s++)l[s]=8;for(;s<256;s++)l[s]=9;for(;s<280;s++)l[s]=7;for(;s<288;s++)l[s]=8;if(0!==(c=new C(l,288,257,t,i,S=7)).status){throw"EcmaFlateDecodeError : Huffman Status "+c.status;return-1}for(g=c.root,S=c.m,s=0;s<30;s++)l[s]=5;if((c=new C(l,30,0,o,a,O=5)).status>1){throw g=null,"EcmaFlateDecodeError : Huffman Status"+c.status;return-1}y=c.root,O=c.m}return D=g,b=y,T=S,F=O,U(e,n,r)}function M(e,r,s){var c,l,d,u,h,f,m,p,g,y=new Array(316);for(c=0;c<y.length;c++)y[c]=0;if(k(5),m=257+L(5),B(5),k(5),p=1+L(5),B(5),k(4),f=4+L(4),B(4),m>286||p>30)return-1;for(l=0;l<f;l++)k(3),y[n[l]]=L(3),B(3);for(;l<19;l++)y[n[l]]=0;if(0!==(g=new C(y,19,19,null,null,T=7)).status)return-1;for(D=g.root,T=g.m,u=m+p,c=d=0;c<u;)if(k(T),B(l=(h=D.list[L(T)]).b),(l=h.n)<16)y[c++]=d=l;else if(16===l){if(k(2),l=3+L(2),B(2),c+l>u)return-1;for(;l-- >0;)y[c++]=d}else if(17===l){if(k(3),l=3+L(3),B(3),c+l>u)return-1;for(;l-- >0;)y[c++]=0;d=0}else{if(k(7),l=11+L(7),B(7),c+l>u)return-1;for(;l-- >0;)y[c++]=0;d=0}if(g=new C(y,m,257,t,i,T=I),0===T&&(g.status=1),0!==g.status)return-1;for(D=g.root,T=g.m,c=0;c<p;c++)y[c]=y[c+m];return g=new C(y,p,0,o,a,F=v),b=g.root,0===(F=g.m)&&m>257||0!==g.status?-1:U(e,r,s)}function j(e,t,o){for(var n=0,i;n<o;){if(m&&-1===l)return n;if(E>0){if(l!==s)for(;E>0&&n<o;)E--,A&=r-1,p&=r-1,e[t+n++]=c[p++]=c[A++];else{for(;E>0&&n<o;)E--,p&=r-1,k(8),e[t+n++]=c[p++]=L(8),B(8);0===E&&(l=-1)}if(n===o)return n}if(-1===l){if(m)break;k(1),0!==L(1)&&(m=!0),B(1),k(2),l=L(2),B(2),D=null,E=0}switch(l){case 0:i=w(e,t+n,o-n);break;case 1:i=D?U(e,t+n,o-n):x(e,t+n,o-n);break;case 2:i=D?U(e,t+n,o-n):M(e,t+n,o-n);break;default:i=-1;break}if(-1===i)return m?0:-1;n+=i}return n}}function EcmaAsciiHex(){this.decode=function(e){for(var t=[],o=-1,n=0,i,a,r=!1,s=0,c=e.length;s<c;s++){if((i=e[s])>=48&&i<=57)a=15&i;else{if(!(i>=65&&i<=70||i>=97&&i<=102)){if(62===i){r=!0;break}continue}a=9+(15&i)}o<0?o=a:(t[n++]=o<<4|a,o=-1)}return o>=0&&r&&(t[n++]=o<<4,o=-1),t}}function EcmaAscii85(){this.decode=function(e){for(var t=e.length,o=[],n=[0,0,0,0,0],i,a,r,s,c,l=0;l<t;++l)if(122!==e[l]){for(i=0;i<5;++i)n[i]=e[l+i]-33;if((c=t-l)<5){for(i=c;i<4;n[++i]=0);n[c]=85}for(r=255&(a=85*(85*(85*(85*n[0]+n[1])+n[2])+n[3])+n[4]),s=255&(a>>>=8),a>>>=8,o.push(a>>>8,255&a,s,r),i=c;i<5;++i,o.pop());l+=4}else o.push(0,0,0,0);return o}}function EcmaRunLength(){this.decode=function(e){for(var t,o,n=e.length,i=0,a=[],r=0;r<n;r++)if((t=e[r])<0&&(t=256+t),128===t)r=n;else if(t>128){t=257-t,o=e[++r];for(var s=0;s<t;s++)a[i++]=o}else{r++,t++;for(var s=0;s<t;s++)a[i++]=e[r+s];r=r+t-1}return a}}var EcmaKEY={A:"A",AA:"AA",AC:"AC",AcroForm:"AcroForm",ActualText:"ActualText",AIS:"AIS",Alternate:"Alternate",AlternateSpace:"AlternateSpace",Annot:"Annot",Annots:"Annots",AntiAlias:"AntiAlias",AP:"AP",Array:"Array",ArtBox:"ArtBox",AS:"AS",Asset:"Asset",Assets:"Assets",Ascent:"Ascent",Author:"Author",AvgWidth:"AvgWidth",B:"B",BlackPoint:"BlackPoint",Background:"Background",Base:"Base",BaseEncoding:"BaseEncoding",BaseFont:"BaseFont",BaseState:"BaseState",BBox:"BBox",BC:"BC",BDC:"BDC",BG:"BG",BI:"BI",BitsPerComponent:"BitsPerComponent",BitsPerCoordinate:"BitsPerCoordinate",BitsPerFlag:"BitsPerFlag",BitsPerSample:"BitsPerSample",BlackIs1:"BlackIs1",BleedBox:"BleedBox",Blend:"Blend",Bounds:"Bounds",Border:"Border",BM:"BM",BPC:"BPC",BS:"BS",Btn:"Btn",ByteRange:"ByteRange",C:"C",C0:"C0",C1:"C1",C2:"C2",CA:"CA",ca:"ca",Calculate:"Calculate",CapHeight:"CapHeight",Caret:"Caret",Category:"Category",Catalog:"Catalog",Cert:"Cert",CF:"CF",CFM:"CFM",Ch:"Ch",CIDSet:"CIDSet",CIDSystemInfo:"CIDSystemInfo",CharProcs:"CharProcs",CharSet:"CharSet",CheckSum:"CheckSum",CIDFontType0C:"CIDFontType0C",CIDToGIDMap:"CIDToGIDMap",Circle:"Circle",ClassMap:"ClassMap",CMap:"CMap",CMapName:"CMapName",CMYK:"CMYK",CO:"CO",Color:"Color",Colors:"Colors",ColorBurn:"ColorBurn",ColorDodge:"ColorDodge",ColorSpace:"ColorSpace",ColorTransform:"ColorTransform",Columns:"Columns",Components:"Components",CompressedObject:"CompressedObject",Compatible:"Compatible",Configurations:"Configurations",Configs:"Configs",ContactInfo:"ContactInfo",Contents:"Contents",Coords:"Coords",Count:"Count",CreationDate:"CreationDate",Creator:"Creator",CropBox:"CropBox",CS:"CS",CVMRC:"CVMRC",D:"D",DA:"DA",DamageRowsBeforeError:"DamageRowsBeforeError",Darken:"Darken",DC:"DC",DCT:"DCT",Decode:"Decode",DecodeParms:"DecodeParms",Desc:"Desc",DescendantFonts:"DescendantFonts",Descent:"Descent",Dest:"Dest",Dests:"Dests",Difference:"Difference",Differences:"Differences",Domain:"Domain",DP:"DP",DR:"DR",DS:"DS",DV:"DV",DW:"DW",DW2:"DW2",E:"E",EarlyChange:"EarlyChange",EF:"EF",EFF:"EFF",EmbeddedFiles:"EmbeddedFiles",EOPROPtype:"EOPROPtype",Encode:"Encode",EncodeByteAlign:"EncodeByteAlign",Encoding:"Encoding",Encrypt:"Encrypt",EncryptMetadata:"EncryptMetadata",EndOfBlock:"EndOfBlock",EndOfLine:"EndOfLine",Exclusion:"Exclusion",Export:"Export",Extend:"Extend",Extends:"Extends",ExtGState:"ExtGState",Event:"Event",F:"F",FDF:"FDF",Ff:"Ff",Fields:"Fields",FIleAccess:"FIleAccess",FileAttachment:"FileAttachment",Filespec:"Filespec",Filter:"Filter",First:"First",FirstChar:"FirstChar",FIrstPage:"FIrstPage",Fit:"Fit",FItB:"FItB",FitBH:"FitBH",FItBV:"FItBV",FitH:"FitH",FItHeight:"FItHeight",FitR:"FitR",FitV:"FitV",FitWidth:"FitWidth",Flags:"Flags",Fo:"Fo",Font:"Font",FontBBox:"FontBBox",FontDescriptor:"FontDescriptor",FontFamily:"FontFamily",FontFile:"FontFile",FontFIle2:"FontFIle2",FontFile3:"FontFile3",FontMatrix:"FontMatrix",FontName:"FontName",FontStretch:"FontStretch",FontWeight:"FontWeight",Form:"Form",Format:"Format",FormType:"FormType",FreeText:"FreeText",FS:"FS",FT:"FT",FullScreen:"FullScreen",Function:"Function",Functions:"Functions",FunctionType:"FunctionType",G:"G",Gamma:"Gamma",GoBack:"GoBack",GoTo:"GoTo",GoToR:"GoToR",Group:"Group",H:"H",HardLight:"HardLight",Height:"Height",Hide:"Hide",Highlight:"Highlight",Hue:"Hue",Hival:"Hival",I:"I",ID:"ID",Identity:"Identity",Identity_H:"Identity_H",Identity_V:"Identity_V",IDTree:"IDTree",IM:"IM",Image:"Image",ImageMask:"ImageMask",Index:"Index",Indexed:"Indexed",Info:"Info",Ink:"Ink",InkList:"InkList",Instances:"Instances",Intent:"Intent",InvisibleRect:"InvisibleRect",IRT:"IRT",IT:"IT",ItalicAngle:"ItalicAngle",JavaScript:"JavaScript",JS:"JS",JT:"JT",JBIG2Globals:"JBIG2Globals",K:"K",Keywords:"Keywords",Keystroke:"Keystroke",Kids:"Kids",L:"L",Lang:"Lang",Last:"Last",LastChar:"LastChar",LastModified:"LastModified",LastPage:"LastPage",Launch:"Launch",Layer:"Layer",Leading:"Leading",Length:"Length",Length1:"Length1",Length2:"Length2",Length3:"Length3",Lighten:"Lighten",Limits:"Limits",Line:"Line",Linearized:"Linearized",LinearizedReader:"LinearizedReader",Link:"Link",ListMode:"ListMode",Location:"Location",Lock:"Lock",Locked:"Locked",Lookup:"Lookup",Luminosity:"Luminosity",LW:"LW",M:"M",MacExpertEncoding:"MacExpertEncoding",MacRomanEncoding:"MacRomanEncoding",Margin:"Margin",MarkInfo:"MarkInfo",Mask:"Mask",Matrix:"Matrix",Matte:"Matte",max:"max",MaxLen:"MaxLen",MaxWidth:"MaxWidth",MCID:"MCID",MediaBox:"MediaBox",Metadata:"Metadata",min:"min",MissingWidth:"MissingWidth",MK:"MK",ModDate:"ModDate",MouseDown:"MouseDown",MouseEnter:"MouseEnter",MouseExit:"MouseExit",MouseUp:"MouseUp",Movie:"Movie",Multiply:"Multiply",N:"N",Name:"Name",Named:"Named",Names:"Names",NeedAppearances:"NeedAppearances",Next:"Next",NextPage:"NextPage",NM:"NM",None:"None",Normal:"Normal",Nums:"Nums",O:"O",ObjStm:"ObjStm",OC:"OC",OCGs:"OCGs",OCProperties:"OCProperties",OE:"OE",OFF:"OFF",off:"off",ON:"ON",On:"On",OnBlur:"OnBlur",OnFocus:"OnFocus",OP:"OP",op:"op",Open:"Open",OpenAction:"OpenAction",OPI:"OPI",OPM:"OPM",Opt:"Opt",Order:"Order",Ordering:"Ordering",Outlines:"Outlines",Overlay:"Overlay",P:"P",PaintType:"PaintType",Page:"Page",PageLabels:"PageLabels",PageMode:"PageMode",Pages:"Pages",Params:"Params",Parent:"Parent",ParentTree:"ParentTree",Pattern:"Pattern",PatternType:"PatternType",PC:"PC",PDFDocEncoding:"PDFDocEncoding",Perms:"Perms",Pg:"Pg",PI:"PI",PieceInfo:"PieceInfo",PO:"PO",Polygon:"Polygon",PolyLine:"PolyLine",Popup:"Popup",Predictor:"Predictor",Prev:"Prev",PrevPage:"PrevPage",Print:"Print",PrinterMark:"PrinterMark",PrintState:"PrintState",Process:"Process",ProcSet:"ProcSet",Producer:"Producer",Projection:"Projection",Properties:"Properties",PV:"PV",Q:"Q",Qfactor:"Qfactor",QuadPoints:"QuadPoints",R:"R",Range:"Range",RBGroups:"RBGroups",RC:"RC",Reason:"Reason",Recipients:"Recipients",Rect:"Rect",Reference:"Reference",Registry:"Registry",ResetForm:"ResetForm",Resources:"Resources",RGB:"RGB",RichMedia:"RichMedia",RichMediaContent:"RichMediaContent",RD:"RD",RoleMap:"RoleMap",Root:"Root",Rotate:"Rotate",Rows:"Rows",RT:"RT",RV:"RV",S:"S",SA:"SA",Saturation:"Saturation",SaveAs:"SaveAs",Screen:"Screen",SetOCGState:"SetOCGState",Shading:"Shading",ShadingType:"ShadingType",Sig:"Sig",SigFlags:"SigFlags",Signed:"Signed",Size:"Size",SM:"SM",SMask:"SMask",SoftLight:"SoftLight",Sound:"Sound",Square:"Square",Squiggly:"Squiggly",Stamp:"Stamp",Standard:"Standard",StandardEncoding:"StandardEncoding",State:"State",StemH:"StemH",StemV:"StemV",StmF:"StmF",StrF:"StrF",StrikeOut:"StrikeOut",StructElem:"StructElem",StructParent:"StructParent",StructParents:"StructParents",StructTreeRoot:"StructTreeRoot",Style:"Style",SubFilter:"SubFilter",Subj:"Subj",Subject:"Subject",SubmitForm:"SubmitForm",Subtype:"Subtype",Supplement:"Supplement",T:"T",Tabs:"Tabs",TagSuspect:"TagSuspect",Text:"Text",TI:"TI",TilingType:"TilingType",tintTransform:"tintTransform",Title:"Title",TM:"TM",Toggle:"Toggle",ToUnicode:"ToUnicode",TP:"TP",TR:"TR",TrapNet:"TrapNet",Trapped:"Trapped",TrimBox:"TrimBox",Tx:"Tx",TxFontSize:"TxFontSize",TxOutline:"TxOutline",TU:"TU",Type:"Type",U:"U",UE:"UE",UF:"UF",Uncompressed:"Uncompressed",Unsigned:"Unsigned",Usage:"Usage",V:"V",Validate:"Validate",VerticesPerRow:"VerticesPerRow",View:"View",VIewState:"VIewState",VP:"VP",W:"W",W2:"W2",Watermark:"Watermark",WhitePoint:"WhitePoint",Widget:"Widget",Win:"Win",WinAnsiEncoding:"WinAnsiEncoding",Width:"Width",Widths:"Widths",WP:"WP",WS:"WS",X:"X",XFA:"XFA",XFAImages:"XFAImages",XHeight:"XHeight",XObject:"XObject",XRef:"XRef",XRefStm:"XRefStm",XStep:"XStep",XYZ:"XYZ",YStep:"YStep",Zoom:"Zoom",ZoomTo:"ZoomTo",Unchanged:"Unchanged",Underline:"Underline"},EcmaLEX={CHAR256:[1,0,0,0,0,0,0,0,0,1,1,0,1,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,0,2,0,0,2,2,0,0,0,0,0,2,4,4,4,4,4,4,4,4,4,4,0,0,2,0,2,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,2,0,2,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,2,0,2,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],STRPDF:[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,728,711,710,729,733,731,730,732,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,8226,8224,8225,8230,8212,8211,402,8260,8249,8250,8722,8240,8222,8220,8221,8216,8217,8218,8482,64257,64258,321,338,352,376,381,305,322,339,353,382,0,8364],isWhiteSpace:function(e){return 1===this.CHAR256[e]},isEOL:function(e){return 10===e||13===e},isDelimiter:function(e){return 2===this.CHAR256[e]},isComment:function(e){return 37===e},isBacklash:function(e){return 92===e},isEscSeq:function(e,t){if(252===e)switch(t){case 40:case 41:case 98:case 102:case 110:case 114:case 116:case 92:case 12:case 13:return!0;default:return!1}return!1},isDigit:function(e){return 4===this.CHAR256[e]},isBoolean:function(e){return"boolean"==typeof e},isNull:function(e){return null===typeof e},isNumber:function(e){return"number"==typeof e},isString:function(e){return"string"==typeof e},isHexString:function(e){return e instanceof EcmaHEX},isArray:function(e){return e instanceof Array},isName:function(e){return e instanceof EcmaNAME},isDict:function(e){return e instanceof EcmaDICT},isRef:function(e){return e instanceof EcmaOREF},isStreamDict:function(e){return EcmaKEY.Length in e.keys},getDA:function(e){for(var t={fontSize:10,fontName:"Arial",fontColor:"0 g"},o=e.length,n=0,i="",a=new Array;n<o;){var r=e.charCodeAt(n++);EcmaLEX.isWhiteSpace(r)||EcmaLEX.isEOL(r)?(i.length>0&&a.push(i),i=""):i+=String.fromCharCode(r)}i.length>0&&a.push(i);for(var n=0,o=a.length;n<o;n++)"/"===a[n].charAt(0)?(t.fontName=a[n].substring(1),a[n+1]&&(t.fontSize=parseInt(a[n+1]))):n>3&&"rg"===a[n]&&(t.fontColor=a[n-3]+" "+a[n-2]+" "+a[n-1]+" rg");return t},getRefFromString:function(e){var t=e.trim().split(" ");return new EcmaOREF(parseInt(t[0]),parseInt(t[1]))},getZeroLead:function(e){for(var t=""+e,o=10-t.length,n=0;n<o;n++)t="0"+t;return t},toPDFString:function(e){var t=e.length,o=[],n;if("þ"===e[0]&&"ÿ"===e[1])for(var i=2;i<t;i+=2)n=e.charCodeAt(i)<<8|e.charCodeAt(i+1),o.push(String.fromCharCode(n));else for(var i=0;i<t;++i){var a=this.STRPDF[e.charCodeAt(i)];o.push(a?String.fromCharCode(a):e.charAt(i))}return o.join("")},toPDFHex16String:function(e){var t=e.length,o=[],n;o.push("fe"),o.push("ff");for(var i=0;i<t;++i){n=e.charCodeAt(i);for(var a=Number(n>>8).toString(16);a.length<2;)a="0"+a;for(var r=Number(255&n).toString(16);r.length<2;)r="0"+r;o.push(a),o.push(r)}return o.join("")},toBytes32:function(e){return[(4278190080&e)>>24,(16711680&e)>>16,(65280&e)>>8,255&e]},textToBytes:function(e){for(var t=[],o,n=0,i=e.length;n<i;n++)(o=e.charCodeAt(n))<256?t.push(o):(t.push(o>>8),t.push(255&o));return t},bytesToText:function(e,t,o){for(var n="",i=t;i<o;i++)n+=String.fromCharCode(e[t+i]);return n},pushBytesToBuffer:function(e,t){for(var o=0,n=e.length;o<n;o++)t.push(e[o])},objectToText:function(e){if(this.isDict(e)){var t="<<";for(var o in e.keys)t+="/"+o+" "+this.objectToText(e.keys[o])+" ";return t+=">>"}if(this.isArray(e)){for(var t="[",n=0,i=e.length;n<i;n++)t+=" "+this.objectToText(e[n]);return t+="]"}return this.isRef(e)?e.ref:this.isName(e)?"/"+e.name:this.isNumber(e)?""+e:this.isString(e)?"("+EcmaLEX.toPDFString(e)+")":this.isHexString(e)?e.str:this.isBoolean(e)?e?"true":"false":"null"}},EcmaFontWidths={Arial:[750,750,750,750,750,750,750,750,750,750,750,750,750,750,750,750,750,750,750,750,750,750,750,750,750,750,750,750,750,750,750,750,278,278,355,556,556,889,667,191,333,333,389,584,278,333,278,278,556,556,556,556,556,556,556,556,556,556,278,278,584,584,584,556,1015,667,667,722,722,667,611,778,722,278,500,667,556,833,722,778,667,778,722,667,611,722,667,944,667,667,611,278,278,278,469,556,333,556,556,500,556,556,278,556,556,222,222,500,222,833,556,556,556,556,333,500,278,556,500,722,500,500,500,334,260,334,584,350,556,350,222,556,333,1e3,556,556,333,1e3,667,333,1e3,350,611,350,350,222,222,333,333,350,556,1e3,333,1e3,500,333,944,350,500,667,278,333,556,556,556,556,260,556,333,737,370,556,584,333,737,552,400,549,333,333,333,576,537,333,333,333,365,556,834,834,834,611,667,667,667,667,667,667,1e3,722,667,667,667,667,278,278,278,278,722,722,778,778,778,778,778,584,778,722,722,722,722,667,667,611,556,556,556,556,556,556,889,500,556,556,556,556,278,278,278,278,556,556,556,556,556,556,556,549,611,556,556,556,556,500,556,500]},EcmaFormField={READONLY_ID:1,REQUIRED_ID:2,NOEXPORT_ID:3,MULTILINE_ID:13,PASSWORD_ID:14,NOTOGGLETOOFF_ID:15,RADIO_ID:16,PUSHBUTTON_ID:17,COMBO_ID:18,EDIT_ID:19,SORT_ID:20,FILESELECT_ID:21,MULTISELECT_ID:22,DONOTSPELLCHECK_ID:23,DONOTSCROLL_ID:24,COMB_ID:25,RICHTEXT_ID:26,RADIOINUNISON_ID:26,COMMITONSELCHANGE_ID:27,handleDisplayChange:function(e,t,o){var n=this.flagToBooleans(o);switch(t.display){case display.hidden:n[2]=!0,n[3]=!0,n[6]=!1;break;case display.noPrint:n[2]=!1,n[3]=!1,n[6]=!1;break;case display.noView:n[2]=!1,n[3]=!0,n[6]=!0;case display.visible:n[2]=!1,n[3]=!0,n[6]=!1;break}e.keys[EcmaKEY.F]=this.booleansToFlag(n)},editTextField:function(e,t,o,n,i,a){var r=!1,s=!1,c=i,l=n.keys[EcmaKEY.Ff];if(l){var d=this.flagToBooleans(l);if(d[1]=!0,r=d[this.PASSWORD_ID]){for(var u="",h=0,f=c.length;h<f;h++)u+="*";c=u}s=d[this.MULTILINE_ID]}if(n.keys[EcmaKEY.V]=i,n.keys[EcmaKEY.AP]=new EcmaDICT,n.keys[EcmaKEY.TU]){var m=n.keys[EcmaKEY.TU];EcmaLEX.isHexString(m)||(m=m.replace(/[{()}]/g,"_"),n.keys[EcmaKEY.TU]=m)}var p=0;n.keys[EcmaKEY.Q]&&(p=n.keys[EcmaKEY.Q]);var g=n.keys[EcmaKEY.Rect],y=g[2]-g[0];y=Math.round(100*y)/100;var S=g[3]-g[1];S=Math.round(100*S)/100;var O=10,E=n.keys.DA,A=n.keys[EcmaKEY.Parent];if(EcmaLEX.isRef(A)){var u,I=(u=new EcmaBuffer).getIndirectObject(A);EcmaLEX.isDict(I)&&(I.keys[EcmaKEY.V]=i,t.push(I),o.push(A))}var v="0 g",D="Arial";if(E){var b=EcmaLEX.getDA(E);O=0===(O=b.fontSize)?10:O,v=b.fontColor,D=b.fontName}var T=new EcmaDICT,F=new EcmaOREF(a,0),R=n.keys[EcmaKEY.AP].keys.N;if(R)var T=e.getObjectValue(R);n.keys[EcmaKEY.AP].keys.N=F,T.keys[EcmaKEY.BBox]=[0,0,y,S],T.keys[EcmaKEY.Matrix]=[1,0,0,1,0,0],T.keys[EcmaKEY.Subtype]=new EcmaNAME(EcmaKEY.Form);var L=new EcmaDICT,P=new EcmaDICT;P.keys[EcmaKEY.Name]=new EcmaNAME("Helv"),P.keys[EcmaKEY.Type]=new EcmaNAME("Font"),P.keys[EcmaKEY.Subtype]=new EcmaNAME("Type1"),P.keys[EcmaKEY.BaseFont]=new EcmaNAME("Helvetica"),P.keys[EcmaKEY.Encoding]=new EcmaNAME("PDFDocEncoding");var N=new EcmaDICT;N.keys.Helv=P,L.keys[EcmaKEY.Font]=N,T.keys[EcmaKEY.Resources]=L,T.keys[EcmaKEY.FormType]=1,T.keys[EcmaKEY.Type]=new EcmaNAME(EcmaKEY.XObject);var C="";if(s){for(var u,k=0,B="",U="",w="",h=0,f=c.length;h<f;h++){var x=c.charCodeAt(h),M=String.fromCharCode(x),j=this.findCodeWidth(x,O);k+j>y&&(U===w?(B+=U+"\n",U="",w="",k=0):(B+="\n",k=this.findStringWidth(U,O),w=U)),k+=j,10===x?(B+=U+"\n",U="",w="",k=0):EcmaLEX.isWhiteSpace(x)?(B+=U+" ",U="",w+=" "):(U+=M,w+=M)}U.length>0&&(B+=U);var X=B.split("\n"),K=1.2*O;K=Math.round(100*K)/100;var V=X.length*K,Y=S-V+V-O;(Y=Y<0?0:Y)>0&&(Y=Math.round(100*Y)/100),C+="/Tx BMC\nBT\n"+v+"\n/Helv "+O+" Tf\n",C+="2 "+Y+" Td\n("+X[0]+") Tj\n";for(var h=1,f=X.length;h<f;h++)C+="0 "+-K+" Td\n("+X[h]+") Tj\n";C+="ET\nEMC";var W=EcmaLEX.textToBytes(C);T.keys[EcmaKEY.Length]=W.length,T.rawStream=W,T.stream=W,t.push(T),o.push(F)}else{var _=O-.2*O,H=S-_>0?(S-_)/2:0,G=2;if(p>0){var x,M,Q=0;G=0;for(var h=0,f=c.length;h<f;h++)x=c.charCodeAt(h),M=String.fromCharCode(x),Q+=this.findCodeWidth(x,O);Q<y&&(G=1===p?(y-Q)/2:y-Q)}for(var W=[],q="/Tx BMC\nBT\n"+v+"\n"+G+" "+H+" Td\n/Helv "+O+" Tf\n(",z=") Tj\nET\nEMC",u,h=0,f=(u=EcmaLEX.textToBytes(q)).length;h<f;h++)W.push(u[h]);for(var h=0,f=(u=EcmaLEX.textToBytes(c)).length;h<f;h++)W.push(u[h]);for(var h=0,f=(u=EcmaLEX.textToBytes(z)).length;h<f;h++)W.push(u[h]);T.keys[EcmaKEY.Length]=W.length,T.rawStream=W,T.stream=W,t.push(T),o.push(F)}},selectCheckBox:function(e,t){var o="Yes",n="Off",i=t.keys[EcmaKEY.AP];if(i){var a=(i=(new EcmaBuffer).getObjectValue(i)).keys[EcmaKEY.D];if(a)for(var r in(a=(new EcmaBuffer).getObjectValue(a)).keys){var s;"off"!==r.toLowerCase()&&(o=r)}e?(t.keys[EcmaKEY.AS]=new EcmaNAME(o),t.keys[EcmaKEY.V]=new EcmaNAME(o)):(t.keys[EcmaKEY.AS]=new EcmaNAME(n),t.keys[EcmaKEY.V]=new EcmaNAME(n))}},selectRadioChild:function(e,t){var o=t.keys[EcmaKEY.AP];if(o){var n="Yes",i="Off",a=(o=(new EcmaBuffer).getObjectValue(o)).keys[EcmaKEY.D];if(a)for(var r in(a=(new EcmaBuffer).getObjectValue(a)).keys)"off"!==r.toLowerCase()&&(e.value!=r?(n=e.value,this.handleAPNameChange(o,e.value)):n=r);e.checked?t.keys[EcmaKEY.AS]=new EcmaNAME(n):t.keys[EcmaKEY.AS]=new EcmaNAME(i)}},handleAPNameChange:function(e,t){var o=e.keys[EcmaKEY.D];if(o)for(var n in(o=(new EcmaBuffer).getObjectValue(o)).keys)"off"!==n.toLowerCase()&&t!=n&&(o.keys[t]=o.keys[n],delete o.keys[n]);var i=e.keys[EcmaKEY.N];if(i)for(var a in(i=(new EcmaBuffer).getObjectValue(i)).keys)"off"!==a.toLowerCase()&&t!=a&&(i.keys[t]=i.keys[a],delete i.keys[a]);var r=e.keys[EcmaKEY.R];if(r)for(var s in(r=(new EcmaBuffer).getObjectValue(r)).keys)"off"!==s.toLowerCase()&&t!=s&&(r.keys[t]=r.keys[s],delete r.keys[s])},selectChoice:function(e,t,o,n,i){var a=o.keys[EcmaKEY.Opt],r=n;if(o.keys[EcmaKEY.V]=n,a)for(var s=0,c=a.length;s<c;s++){var l=a[s];if(EcmaLEX.isArray(l)){if(l[0]===n){r=l[1],o.keys[EcmaKEY.I]=[s];break}}else if(l===n){r=l,o.keys[EcmaKEY.I]=[s];break}}o.keys[EcmaKEY.AP]=new EcmaDICT;var d=o.keys[EcmaKEY.Rect],u=d[2]-d[0],h=d[3]-d[1],f=10,m=o.keys.DA;if(m){var p=m.indexOf("/");p>=0&&(m=m.substring(p).split(" "),f=parseInt(m[1])),o.keys.DA="/Arial "+f+" Tf"}var g=new EcmaDICT,y=new EcmaOREF(i,0);o.keys[EcmaKEY.AP].keys.N=y,g.keys[EcmaKEY.BBox]=[0,0,u,h],g.keys[EcmaKEY.Matrix]=[1,0,0,1,0,0],g.keys[EcmaKEY.Subtype]=new EcmaNAME(EcmaKEY.Form),g.keys[EcmaKEY.Resources]=new EcmaDICT,g.keys[EcmaKEY.FormType]=1,g.keys[EcmaKEY.Type]=new EcmaNAME(EcmaKEY.XObject);var S=f-.2*f,O,E="/Tx BMC\nBT\n/Arial "+f+" Tf\n0 g\n2 "+(h-S>0?(h-S)/2:0)+" Td\n("+r+") Tj\nET\nEMC",A=EcmaLEX.textToBytes(E);g.keys[EcmaKEY.Length]=A.length,g.rawStream=A,g.stream=A,e.push(g),t.push(y)},findStringWidth:function(e,t){for(var o=0,n=0,i=e.length;n<i;n++){var a=e.charCodeAt(n);o+=a<256?EcmaFontWidths.Arial[a]/1e3*t:t}return o},findCodeWidth:function(e,t){return e<256?EcmaFontWidths.Arial[e]/1e3*t:t},flagToBooleans:function(e){for(var t=[!1],o=0;o<32;o++)t[o+1]=(e&1<<o)==1<<o;return t},booleansToFlag:function(e){for(var t=0,o=0;o<32;o++)t=e[32-o]?t<<1|1:t<<=1;return t},hexEncodeName:function(e){for(var t="",o=0;o<e.length;o++){var n=e.charCodeAt(o);n<33||n>126||'"'===e[o]||"#"===e[o]||"/"===e[o]?t+=n.toString(16):t+=e[o]}return t},hexDecodeName:function(e){for(var t="",o=0;o<e.length;o++){var n=e.charCodeAt(o);if("#"===e[o]&&o+2<e.length){var i=parseInt(e[o+1]+e[o+2],16);t+=String.fromCharCode(i),o+=2}else(n>=33||n<=126)&&(t+=e[o])}return t}},EcmaNAMES={},EcmaOBJECTOFFSETS={},EcmaPageOffsets=[],EcmaFieldOffsets=[],EcmaMainCatalog=null,EcmaMainData=[],EcmaXRefType=0;function showEcmaParserError(e){alert(e)}function EcmaOBJOFF(e,t,o){this.data=t,this.offset=e,this.isStream=o}function EcmaDICT(){this.keys={},this.stream=null,this.rawStream=null}function EcmaNAME(e){this.name=e,this.value=null}function EcmaOREF(e,t){this.num=e,this.gen=t,this.ref=e+" "+t+" R"}function EcmaHEX(e){this.str=e}function EcmaBuffer(e){this.data=e,this.pos=0,this.markPos=0,this.length=0,e&&(this.length=e.length)}EcmaBuffer.prototype.getByte=function(){return this.pos>=this.length?-1:this.data[this.pos++]},EcmaBuffer.prototype.mark=function(){this.markPos=this.pos},EcmaBuffer.prototype.reset=function(){this.pos=this.markPos},EcmaBuffer.prototype.movePos=function(e){this.pos=e},EcmaBuffer.prototype.readTo=function(e){for(var t=this.length-this.pos,o=Math.min(e.length,t),n=0;n<o;n++)e[n]=this.getByte()},EcmaBuffer.prototype.readTo=function(e,t,o){if(this.pos<this.length){for(var n=0,i=this.length-this.pos,a=Math.min(o,i),r=0;r<a;r++)e[t+r]=this.getByte(),n++;return n}return-1},EcmaBuffer.prototype.lookNext=function(){return this.pos>=this.length?-1:this.data[this.pos]},EcmaBuffer.prototype.lookNextNext=function(){return this.pos>=this.length?-1:this.data[this.pos+1]},EcmaBuffer.prototype.getNextLine=function(){for(var e="",t=this.getByte();;)if(13===t){if(e.endsWith(" "))break;if(10===(t=this.getByte()))break}else{if(10===t)break;e+=String.fromCharCode(t),t=this.getByte()}return e},EcmaBuffer.prototype.skipLine=function(){for(var e=this.getByte();-1!==e;){if(13===e){if(10===(e=this.lookNext())){this.getByte();break}break}if(10===e)break;e=this.getByte()}},EcmaBuffer.prototype.getNumberValue=function(){var e=this.getByte(),t=1,o=!1;if(43===e?e=this.getByte():45===e&&(t=-1,e=this.getByte()),46===e&&(o=!0,e=this.getByte()),e<48||e>57)return 0;for(var n=""+String.fromCharCode(e);;){var i=this.lookNext();if(46!==i&&!EcmaLEX.isDigit(i))break;e=this.getByte(),n+=""+String.fromCharCode(e)}return o?t*parseFloat("0."+n):-1!==n.indexOf(".")?t*parseFloat(n):t*parseInt(n)},EcmaBuffer.prototype.getNameValue=function(){var e="",t;for(this.getByte();(t=this.lookNext())>=0&&!EcmaLEX.isDelimiter(t)&&!EcmaLEX.isWhiteSpace(t);)e+=String.fromCharCode(this.getByte());return e},EcmaBuffer.prototype.getNormalString=function(){var e=[];this.getByte();for(var t=1,o=this.getByte(),n=!1;;){var i=!1;switch(o){case-1:n=!0;break;case 40:e.push("("),t++;break;case 41:--t?e.push(")"):n=!0;break;case 92:switch(o=this.getByte()){case-1:n=!0;break;case 40:case 41:case 92:e.push(String.fromCharCode(o));break;case 110:e.push("\n");break;case 114:e.push("\r");break;case 116:e.push("\t");break;case 98:e.push("\b");break;case 102:e.push("\f");break;case 48:case 49:case 50:case 51:case 52:case 53:case 54:case 55:var a=15&o;i=!0,(o=this.getByte())>=48&&o<=55&&(a=(a<<3)+(15&o),(o=this.getByte())>=48&&o<=55&&(i=!1,a=(a<<3)+(15&o))),e.push(String.fromCharCode(a));break;case 13:10===this.lookNext()&&this.getByte();break;case 10:break;default:e.push(String.fromCharCode(o));break}break;default:e.push(String.fromCharCode(o))}if(n)break;i||(o=this.getByte())}return e.join("")},EcmaBuffer.prototype.getHexString=function(){this.getByte();for(var e=this.getByte(),t="<";;){if(e<0||62===e){t+=">";break}EcmaLEX.isWhiteSpace(e)?e=this.getByte():(t+=String.fromCharCode(e),e=this.getByte())}return new EcmaHEX(t)},EcmaBuffer.prototype.getDictionary=function(){var e=new EcmaDICT;this.getByte(),this.getByte();for(var t=[],o=!0;o;){var n;switch(this.lookNext()){case-1:return e;case 48:case 49:case 50:case 51:case 52:case 53:case 54:case 55:case 56:case 57:case 43:case 45:case 46:var i=this.getNumberValue(),a=this.lookNext(),r=this.lookNextNext();if(t.length>0){var s,c=(s=t.pop()).name;EcmaLEX.isWhiteSpace(a)&&EcmaLEX.isDigit(r)?(this.getByte(),r=this.getNumberValue(),this.getByte(),this.getByte(),e.keys[c]=new EcmaOREF(i,r)):e.keys[c]=i}break;case 47:var l=this.getNameValue(),d;if(EcmaNAMES[l]?d=EcmaNAMES[l]:(d=new EcmaNAME(l),EcmaNAMES[l]=d),0===t.length)t.push(d);else{var s,c=(s=t.pop()).name;e.keys[c]=d}break;case 40:var u=this.getNormalString();if(0!==t.length){var s,c=(s=t.pop()).name;e.keys[c]=u}break;case 60:if(60===this.lookNextNext()){var h=this.getDictionary();if(0!==t.length){var s,c=(s=t.pop()).name;e.keys[c]=h}}else{var f=this.getHexString();if(0!==t.length){var s,c=(s=t.pop()).name;e.keys[c]=f}}break;case 91:var m=this.getArray();if(0!==t.length){var s,c=(s=t.pop()).name;e.keys[c]=m}break;case 116:if(114===this.data[this.pos+1]&&117===this.data[this.pos+2]&&101===this.data[this.pos+3]){for(var p=0;p<4;p++)this.getByte();if(t.length>0){var s,c=(s=t.pop()).name;e.keys[c]=!0}}else this.getByte();break;case 102:if(97===this.data[this.pos+1]&&108===this.data[this.pos+2]&&115===this.data[this.pos+3]&&101===this.data[this.pos+4]){for(var p=0;p<5;p++)this.getByte();if(t.length>0){var s,c=(s=t.pop()).name;e.keys[c]=!1}}else this.getByte();break;case 110:if(117===this.data[this.pos+1]&&108===this.data[this.pos+2]&&108===this.data[this.pos+3]){for(var p=0;p<4;p++)this.getByte();if(t.length>0){var s,c=(s=t.pop()).name;e.keys[c]=null}}else this.getByte();break;case 62:this.getByte(),62===this.lookNext()&&(this.getByte(),o=!1);break;default:this.getByte();break}}return EcmaLEX.isStreamDict(e)&&!e.stream&&(e.rawStream=this.getRawStream(e)),e},EcmaBuffer.prototype.getArray=function(){this.getByte();for(var e=[];;){var t;switch(this.lookNext()){case-1:return e;case 48:case 49:case 50:case 51:case 52:case 53:case 54:case 55:case 56:case 57:case 43:case 45:case 46:var o=this.getNumberValue(),n=this.data[this.pos],i=this.data[this.pos+1];if(EcmaLEX.isWhiteSpace(n)&&EcmaLEX.isDigit(i)){this.mark(),this.getByte(),i=this.getNumberValue(),this.getByte();var a=this.getByte(),r=this.lookNext();82===a&&(EcmaLEX.isWhiteSpace(r)||EcmaLEX.isDelimiter(r))?e.push(new EcmaOREF(o,i)):(e.push(o),this.reset())}else e.push(o);break;case 47:var s=this.getNameValue();EcmaNAMES[s]||(EcmaNAMES[s]=new EcmaNAME(s)),e.push(EcmaNAMES[s]);break;case 40:e.push(this.getNormalString());break;case 60:if(60===this.lookNextNext()){var c=this.getDictionary();e.push(c)}else e.push(this.getHexString());break;case 91:e.push(this.getArray());break;case 93:return this.getByte(),e;case 116:if(114===this.data[this.pos+1]&&117===this.data[this.pos+2]&&101===this.data[this.pos+3]){e.push(!0);for(var l=0;l<4;l++)this.getByte()}else this.getByte();break;case 102:if(97===this.data[this.pos+1]&&108===this.data[this.pos+2]&&115===this.data[this.pos+3]&&101===this.data[this.pos+4]){e.push(!1);for(var l=0;l<5;l++)this.getByte()}else this.getByte();break;case 110:if(117===this.data[this.pos+1]&&108===this.data[this.pos+2]&&108===this.data[this.pos+3]){e.push(null);for(var l=0;l<4;l++)this.getByte()}else this.getByte();default:this.getByte();break}}},EcmaBuffer.prototype.getRawStream=function(e){for(;;){var t;if(115===(t=this.lookNext())&&116===this.data[this.pos+1]&&114===this.data[this.pos+2]&&101===this.data[this.pos+3]&&97===this.data[this.pos+4]&&109===this.data[this.pos+5]){for(var o=0;o<6;o++)this.getByte();break}if(-1===t)return null;this.getByte()}this.skipLine();for(var n=this.getObjectValue(e.keys[EcmaKEY.Length]),i=new Array(n),o=0;o<n;o++)i[o]=255&this.getByte();for(;;){var t;if(-1===(t=this.lookNext()))break;if(101===t&&110===this.data[this.pos+1]&&100===this.data[this.pos+2]&&115===this.data[this.pos+3]&&116===this.data[this.pos+4]&&114===this.data[this.pos+5]&&101===this.data[this.pos+6]&&97===this.data[this.pos+7]&&109===this.data[this.pos+8]){for(var o=0;o<9;o++)this.getByte();break}this.getByte()}return i},EcmaBuffer.prototype.getStream=function(e){if(e.stream)return e.stream;var t=e.rawStream,o=e.keys[EcmaKEY.Filter];if(o)if(o instanceof Array)for(var n=0,i=o.length;n<i;n++)t=EcmaFilter.decode(o[n].name,t);else t=EcmaFilter.decode(o.name,t);var a=e.keys[EcmaKEY.DecodeParms];if(a){var r=1,s=1,c=8,l=1,d=1,u,h;if(a instanceof Array)for(var n=0,i=a.length;n<i;n++){var u,h;(h=(u=this.getObjectValue(a[n])).keys[EcmaKEY.Predictor])&&(r=h),(h=u.keys[EcmaKEY.Colors])&&(s=h),(h=u.keys[EcmaKEY.BitsPerComponent])&&(c=h),(h=u.keys[EcmaKEY.Columns])&&(l=h),(h=u.keys[EcmaKEY.EarlyChange])&&(d=h)}else(h=(u=this.getObjectValue(a)).keys[EcmaKEY.Predictor])&&(r=h),(h=u.keys[EcmaKEY.Colors])&&(s=h),(h=u.keys[EcmaKEY.BitsPerComponent])&&(c=h),(h=u.keys[EcmaKEY.Columns])&&(l=h),(h=u.keys[EcmaKEY.EarlyChange])&&(d=h);if(1!==r){var f=EcmaFilter.applyPredictor(t,r,null,s,c,l,d),m=EcmaFilter.createByteBuffer(f);EcmaFilter.applyPredictor(t,r,m,s,c,l,d)}t=m}return e.stream=t,t},EcmaBuffer.prototype.getObjectValue=function(e){if(EcmaLEX.isName(e))return e.name;if(EcmaLEX.isDict(e))return e;if(EcmaLEX.isRef(e)){var t=this.getIndirectObject(e,this.data,!1);return this.getObjectValue(t)}return e},EcmaBuffer.prototype.getIndirectObject=function(e){for(var t in EcmaOBJECTOFFSETS)if(t===e.ref){var o=EcmaOBJECTOFFSETS[t],n=o.offset,i=new EcmaBuffer(o.data),a;if(o.isStream)return o.data?(i.movePos(n),i.getObj()):null;for(i.movePos(n);;){var r=i.lookNext();if(-1===r)return null;if(111===r&&98===i.data[i.pos+1]&&106===i.data[i.pos+2]){for(var s=0;s<3;s++)i.getByte();break}i.getByte()}return i.getObj()}return null},EcmaBuffer.prototype.getObj=function(){for(;;){var e;switch(this.lookNext()){case-1:return null;case 48:case 49:case 50:case 51:case 52:case 53:case 54:case 55:case 56:case 57:case 43:case 45:case 46:var t=this.getNumberValue(),o=this.lookNext(),n=this.lookNextNext(),i=this.data[this.pos+2],a=this.data[this.pos+3];return EcmaLEX.isWhiteSpace(o)&&EcmaLEX.isDigit(n)&&EcmaLEX.isWhiteSpace(i)&&82===a?(this.getByte(),n=this.getNumberValue(),this.getByte(),this.getByte(),new EcmaOREF(t,n)):t;case 47:return this.getNameValue();case 40:return this.getNormalString();case 60:return 60===this.lookNextNext()?this.getDictionary():this.getHexString();case 91:return this.getArray();case 116:if(114===this.data[this.pos+1]&&117===this.data[this.pos+2]&&101===this.data[this.pos+3]){for(var r=0;r<4;r++)this.getByte();return!0}this.getByte();break;case 102:if(97===this.data[this.pos+1]&&108===this.data[this.pos+2]&&115===this.data[this.pos+3]&&101===this.data[this.pos+4]){for(var r=0;r<5;r++)this.getByte();return!1}this.getByte();case 110:if(117===this.data[this.pos+1]&&108===this.data[this.pos+2]&&108===this.data[this.pos+3]){for(var r=0;r<4;r++)this.getByte();return null}this.getByte();default:this.getByte();break}}return null},EcmaBuffer.prototype.readSimpleXREF=function(){var e=this.lookNext();if(EcmaLEX.isDigit(e))return this.readStreamXREF(),void 0;this.skipLine();for(var t=null;;){var o=this.lookNext();if(-1===o)break;if(EcmaLEX.isEOL(o))this.skipLine();else{if(116===o&&114===this.data[this.pos+1]&&97===this.data[this.pos+2]&&105===this.data[this.pos+3]&&108===this.data[this.pos+4]&&101===this.data[this.pos+5]&&114===this.data[this.pos+6]){t=this.getObj();break}var n=this.getObj();this.getByte();var i=this.getObj();this.skipLine();for(var a=0;a<i;a++){var r=this.getObj(),s=this.getObj(),c=this.getNextLine(),l=n+a+" "+s+" R";"n"!==(c=c.trim())||EcmaOBJECTOFFSETS[l]||(EcmaOBJECTOFFSETS[l]=new EcmaOBJOFF(r,this.data,!1))}}}if(t){EcmaMainCatalog||(EcmaMainCatalog=t.keys.Root);var d=t.keys[EcmaKEY.Prev];if(d){var u=this.getObjectValue(d);this.movePos(u),this.readSimpleXREF()}}else showEcmaParserError("Trailer not found")},EcmaBuffer.prototype.readStreamXREF=function(){EcmaXRefType=1,this.getObj(),this.getObj();var e=this.getObj(),t=this.getStream(e),o=e.keys[EcmaKEY.W],n=e.keys[EcmaKEY.Index];n||(n=[0,e.keys[EcmaKEY.Size]]);for(var i=o[0],a=o[1],r=o[2],s=n.length,c=0,l=new EcmaBuffer(t);s>c;)for(var d=n[c++],u=d+n[c++],h=d;h<u;h++){var f=0,m=0,p=0;if(0===i)f=1;else for(var g=0;g<i;g++)f=f<<8|l.getByte();for(var g=0;g<a;g++)m=m<<8|l.getByte();for(var g=0;g<r;g++)p=p<<8|l.getByte();var y=h+" "+p+" R";if(!EcmaOBJECTOFFSETS[y])switch(f){case 0:break;case 1:EcmaOBJECTOFFSETS[y]=new EcmaOBJOFF(m,EcmaMainData,!1);break;case 2:EcmaOBJECTOFFSETS[y]=new EcmaOBJOFF(m,null,!0);break}}EcmaMainCatalog||(EcmaMainCatalog=e.keys.Root);var S=e.keys[EcmaKEY.Prev];if(S){var O=this.getObjectValue(S);this.movePos(O),this.readSimpleXREF()}},EcmaBuffer.prototype.findFirstXREFOffset=function(){for(var e=this.data.length-10;e>0;){var t,o;if(115===this.data[e]&&116===this.data[e+1]&&97===this.data[e+2]&&114===this.data[e+3]&&116===this.data[e+4]&&120===this.data[e+5]&&114===this.data[e+6]&&101===this.data[e+7]&&102===this.data[e+8])return this.movePos(e),this.skipLine(),this.getObj();e--}return-1},EcmaBuffer.prototype.updateAllObjStm=function(){for(var e in EcmaOBJECTOFFSETS){var t=e.split(" "),o=new EcmaOREF(t[0],t[1]),n=this.getIndirectObject(o);if(n instanceof EcmaDICT&&n.keys[EcmaKEY.Type]&&n.keys[EcmaKEY.Type].name===EcmaKEY.ObjStm)for(var i=n.keys[EcmaKEY.N],a=n.keys[EcmaKEY.First],r=new EcmaBuffer(this.getStream(n)),s=0;s<i;s++){var c=r.getNumberValue();r.getByte();var l=r.getNumberValue();r.getByte();var d=c+" 0 R",u=new EcmaOBJOFF(a+l,this.getStream(n),!0);d in EcmaOBJECTOFFSETS?EcmaOBJECTOFFSETS[d].isStream&&!EcmaOBJECTOFFSETS[d].data&&(EcmaOBJECTOFFSETS[d]=u):EcmaOBJECTOFFSETS[d]=u}}},EcmaBuffer.prototype.updatePageOffsets=function(){var e,t=this.getObjectValue(EcmaMainCatalog).keys[EcmaKEY.Pages];t&&(t=this.getObjectValue(t),this.getPagesFromPageTree(t))},EcmaBuffer.prototype.getPagesFromPageTree=function(e){for(var t=e.keys[EcmaKEY.Kids],o=0,n=(t=this.getObjectValue(t)).length;o<n;o++){var i=t[o],a=this.getObjectValue(i),r=a.keys[EcmaKEY.Type];r.name===EcmaKEY.Pages?this.getPagesFromPageTree(a):r.name===EcmaKEY.Page&&EcmaPageOffsets.push(i)}};var EcmaParser={saveFormToPDF:function(e){var t=this._insertFieldsToPDF(e);this._openURL(e,t)},_insertFieldsToPDF:function(e){this._updateFileInfo(e);var t=new EcmaBuffer(EcmaMainData),o=t.findFirstXREFOffset();o&&(t.movePos(o),t.readSimpleXREF()),t.updateAllObjStm(),t.updatePageOffsets();var n=1;for(var i in EcmaOBJECTOFFSETS){var a=i.split(" ");n=Math.max(parseInt(a[0]),n)}n++;var r=[],s=[],c,l=t.getObjectValue(EcmaMainCatalog).keys[EcmaKEY.AcroForm],d=t.getObjectValue(l);delete d.keys[EcmaKEY.XFA],r.push(d),s.push(l);for(var u=document.getElementsByTagName("input"),h=document.getElementsByTagName("textarea"),f=document.getElementsByTagName("select"),m=[],p=[],g=[],y=[],S=[],O=0,E=u.length;O<E;O++){var A,I;if((I=(A=u[O]).getAttribute("data-objref"))&&I.length>0){var v=A.type.toUpperCase();"TEXT"===v||"PASSWORD"===v?m.push(A):"CHECKBOX"===v?p.push(A):"RADIO"===v?g.push(A):"BUTTON"===v&&S.push(A)}}for(var O=0,E=h.length;O<E;O++){var A,I;(I=(A=h[O]).getAttribute("data-objref"))&&I.length>0&&m.push(A)}for(var O=0,E=f.length;O<E;O++){var A,I;(I=(A=f[O]).getAttribute("data-objref"))&&I.length>0&&y.push(A)}for(var O=0,E=m.length;O<E;O++){var D=m[O].value,b=m[O].getAttribute("data-objref"),T=EcmaLEX.getRefFromString(b),F=t.getObjectValue(T);r.push(F),s.push(T),EcmaFormField.editTextField(t,r,s,F,D,n),n++}for(var O=0,E=S.length;O<E;O++){var b=S[O].getAttribute("data-objref"),T=EcmaLEX.getRefFromString(b),F,R=(F=t.getObjectValue(T)).keys[EcmaKEY.F],L=S[O].getAttribute("data-field-name"),P=idrform.doc.getField(L);S[O].dataset&&S[O].dataset.defaultDisplay&&P.display!==Number(S[O].dataset.defaultDisplay)&&(r.push(F),s.push(T),EcmaFormField.handleDisplayChange(F,P,R))}for(var O=0,E=p.length;O<E;O++){var N=p[O].checked,b=p[O].getAttribute("data-objref"),T=EcmaLEX.getRefFromString(b),F=t.getObjectValue(T);r.push(F),s.push(T),EcmaFormField.selectCheckBox(N,F)}for(var O=0,E=y.length;O<E;O++){var C=y[O].value,b=y[O].getAttribute("data-objref"),T=EcmaLEX.getRefFromString(b),F=t.getObjectValue(T);r.push(F),s.push(T),EcmaFormField.selectChoice(r,s,F,C,n),n++}for(var k={},O=0,E=g.length;O<E;O++){var B=g[O],b=B.getAttribute("data-objref"),T=EcmaLEX.getRefFromString(b),F,U=(F=t.getObjectValue(T)).keys[EcmaKEY.Parent].ref,w=B.checked,x=B.value;U?U in k?k[U].push({radioRef:b,parentRef:U,checked:w,value:x}):k[U]=[{radioRef:b,parentRef:U,checked:w,value:x}]:k[b]=[{radioRef:b,parentRef:null,checked:w,value:x}]}for(var M in k){var j=k[M],U;if(U=j[0].parentRef){var X=EcmaLEX.getRefFromString(U),K=t.getObjectValue(X);s.push(X),r.push(K);for(var V=!1,Y=null,O=0,E=j.length;O<E;O++)if(j[O].checked){Y=j[O].value,V=!0;break}V?K.keys[EcmaKEY.V]=new EcmaNAME(Y):delete K.keys[EcmaKEY.V];for(var O=0,E=j.length;O<E;O++){var W=EcmaLEX.getRefFromString(j[O].radioRef),_=t.getObjectValue(W);s.push(W),r.push(_),EcmaFormField.selectRadioChild(j[O],_)}}else{var W=EcmaLEX.getRefFromString(j[O].radioRef),_=t.getObjectValue(W);s.push(W),r.push(_),EcmaFormField.selectRadioChild(j[O],_)}}return this._saveFieldObjects(o,n,s,r),EcmaMainData},_saveFieldObjects:function(e,t,o,n){for(var i=EcmaMainData.length,a=[],r=0,s=o.length;r<s;r++){var c=o[r].num,l=n[r];a.push({ref:c,offset:i});var d=[];if(l.keys[EcmaKEY.Length]){var u=EcmaLEX.textToBytes(c+" 0 obj\n"),h=EcmaLEX.textToBytes(EcmaLEX.objectToText(n[r])+"stream\n"),f=n[r].rawStream,m=EcmaLEX.textToBytes("\nendstream\nendobj\n");EcmaLEX.pushBytesToBuffer(u,d),EcmaLEX.pushBytesToBuffer(h,d),EcmaLEX.pushBytesToBuffer(f,d),EcmaLEX.pushBytesToBuffer(m,d),EcmaLEX.pushBytesToBuffer(d,EcmaMainData)}else{var p=c+" 0 obj\n"+EcmaLEX.objectToText(n[r])+"\nendobj\n",d=EcmaLEX.textToBytes(p);EcmaLEX.pushBytesToBuffer(d,EcmaMainData)}i+=d.length}var g=EcmaMainData.length;if(EcmaXRefType){for(var y="[",S=[],r=0,s=a.length;r<s;r++){var O=a[r].ref,E=a[r].offset;S.push(1),EcmaLEX.pushBytesToBuffer(EcmaLEX.toBytes32(E),S),S.push(0),y+=O+" 1 "}y+="]";var A,I=(A=t)+" 0 obj\n<</Type /XRef /Root "+EcmaMainCatalog.ref+" /Prev "+e+" /Index "+y+" /W [1 4 1] /Size "+A+"/Length "+S.length+">>stream\n";EcmaLEX.pushBytesToBuffer(EcmaLEX.textToBytes(I),EcmaMainData),EcmaLEX.pushBytesToBuffer(S,EcmaMainData),I="\nendstream\nendobj\nstartxref\n"+g+"\n%%EOF",EcmaLEX.pushBytesToBuffer(EcmaLEX.textToBytes(I),EcmaMainData)}else{EcmaLEX.pushBytesToBuffer([120,114,101,102,10],EcmaMainData);for(var v="",r=0,s=a.length;r<s;r++){var c=a[r].ref,D=a[r].offset;v+=c+" 1\n"+EcmaLEX.getZeroLead(D)+" 00000 n \n"}var A;v+="trailer\n<</Size "+(A=t)+" /Root "+EcmaMainCatalog.ref+" /Prev "+e+">>\n",v+="startxref\n"+g+"\n%%EOF",EcmaLEX.pushBytesToBuffer(EcmaLEX.textToBytes(v),EcmaMainData)}},saveAnnotationToPDF:function(e,t){this._updateFileInfo(e);var o=new EcmaBuffer(EcmaMainData),n=o.findFirstXREFOffset();n&&(o.movePos(n),o.readSimpleXREF()),o.updateAllObjStm(),o.updatePageOffsets();var i=1;for(var a in EcmaOBJECTOFFSETS){var r=a.split(" ");i=Math.max(parseInt(r[0]),i)}i++,this._saveAnnotObjects(e,n,i,t)},_updateFileInfo:function(e){EcmaNAMES={},EcmaOBJECTOFFSETS={},EcmaPageOffsets=[],EcmaMainCatalog=null,EcmaXRefType=0;var t=document.getElementById("FDFXFA_PDFDump");if(t)EcmaMainData=EcmaFilter.decodeBase64(t.textContent);else{var o=new XMLHttpRequest;o.onreadystatechange=function(){if(EcmaMainData=[],4!==o.readyState||200!==o.status);else for(var e=o.responseText,t=0,n=e.length;t<n;t++)EcmaMainData.push(255&e.charCodeAt(t))},o.open("GET",e,!1),o.overrideMimeType("text/plain; charset=x-user-defined"),o.send()}},_saveAnnotObjects:function(e,t,o,n){for(var i=o,a=EcmaMainData.length,r=[],s={},c={},l=new EcmaBuffer(EcmaMainData),d=0,u=n.length;d<u;d++){var h=n[d].page,f=""+h,m=EcmaPageOffsets[h],p;f in c?p=c[f]:(p=l.getObjectValue(m),c[f]=p);var g=p.keys[EcmaKEY.Annots];s[f]=m.num,r.push({ref:i,offset:a});var y=i+" 0 obj\n"+n[d].getDictionaryString()+"\nendobj\n",S=EcmaLEX.textToBytes(y);if(EcmaLEX.pushBytesToBuffer(S,EcmaMainData),g)if(EcmaLEX.isRef(g)){var O=l.getObjectValue(g);if(EcmaLEX.isArray(O)){p.keys[EcmaKEY.Annots]=[];for(var E=0,A=O.length;E<A;E++)p.keys[EcmaKEY.Annots].push(O[E]);p.keys[EcmaKEY.Annots].push(new EcmaOREF(i,0))}else p.keys[EcmaKEY.Annots]=[g],p.keys[EcmaKEY.Annots].push(new EcmaOREF(i,0))}else EcmaLEX.isArray(g)?g.push(new EcmaOREF(i,0)):p.keys[EcmaKEY.Annots]=[new EcmaOREF(i,0)];else p.keys[EcmaKEY.Annots]=[new EcmaOREF(i,0)];a+=S.length,i++}var I=EcmaMainData.length;for(var v in s){var D=s[v];s[v]={ref:D,offset:I};var p=c[v],b=D+" 0 obj\n"+EcmaLEX.objectToText(p)+"\nendobj\n",S=EcmaLEX.textToBytes(b);EcmaLEX.pushBytesToBuffer(S,EcmaMainData),I=EcmaMainData.length}var T=EcmaMainData.length;EcmaXRefType?this._generateStreamXREF(t,T,o,r,s):this._generateSimpleXREF(t,T,o,r,s),this._openURL(e)},_generateSimpleXREF:function(e,t,o,n,i){EcmaLEX.pushBytesToBuffer([120,114,101,102,10],EcmaMainData);var a="";for(var r in i){var s=i[r].ref,c=i[r].offset;a+=s+" 1\n"+EcmaLEX.getZeroLead(c)+" 00000 n \n"}var l=n.length,d;if(l){a+=o+" "+l+"\n";for(var u=0,h=l;u<h;u++)a+=EcmaLEX.getZeroLead(n[u].offset)+" 00000 n \n"}a+="trailer\n<</Size "+(o+l)+" /Root "+EcmaMainCatalog.ref+" /Prev "+e+">>\n",a+="startxref\n"+t+"\n%%EOF",EcmaLEX.pushBytesToBuffer(EcmaLEX.textToBytes(a),EcmaMainData)},_generateStreamXREF:function(e,t,o,n,i){var a=n.length,r="[",s=[];for(var c in i){var l=i[c].ref,d=i[c].offset;s.push(1),EcmaLEX.pushBytesToBuffer(EcmaLEX.toBytes32(d),s),s.push(0),r+=l+" 1 "}r+=o+" "+a+"]";for(var u=0;u<a;u++){var d=n[u].offset;s.push(1),EcmaLEX.pushBytesToBuffer(EcmaLEX.toBytes32(d),s),s.push(0)}var h=o+a+1,f=h+" 0 obj\n<</Type /XRef /Root "+EcmaMainCatalog.ref+" /Prev "+e+" /Index "+r+" /W [1 4 1] /Size "+h+"/Length "+s.length+">>stream\n";EcmaLEX.pushBytesToBuffer(EcmaLEX.textToBytes(f),EcmaMainData),EcmaLEX.pushBytesToBuffer(s,EcmaMainData),f="\nendstream\nendobj\nstartxref\n"+t+"\n%%EOF",EcmaLEX.pushBytesToBuffer(EcmaLEX.textToBytes(f),EcmaMainData)},_openURL:function(e,t){var o,n="data:application/octet-stream;base64,"+EcmaFilter.encodeBase64(t),i=e,a=""+navigator.userAgent;if(-1!==a.indexOf("Edge")||-1!==a.indexOf("MSIE ")){for(var r=new ArrayBuffer(t.length),s=new Uint8Array(r),c=0,l=t.length;c<l;c++)s[c]=255&t[c];var d=new Blob([r],{type:"application/octet-stream"});return window.navigator.msSaveBlob(d,i),void 0}var u=document.createElement("a");if(u.setAttribute("download",i),u.setAttribute("href",n),document.body.appendChild(u),"click"in u)u.click();else{var h=document.createEvent("MouseEvent");h.initEvent("click",!0,!0),u.dispatchEvent(h)}u.setAttribute("href","")}},FONTNAMES={ARIAL:"Arial",HELVETICA:"Helvetica",COURIER:"Courier"},EcmaPDF={hashKey:"ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",getDictionaryString:function(e,t){for(var o=t,n=e.length;o<n&&60!==e[o];)o++;var i=[1],a="<<";for(o+=2;0!==i.length&&o<n;){var r=e[o],s=e[o+1];60===r&&s&&60===s?(i.push(1),o+=2,a+="<<"):62===r&&s&&62===s?(i.pop(),o+=2,a+=">>"):(a+=String.fromCharCode(r),o++)}return a},byteToString:function(e){return String.fromCharCode(e)},bytesToString:function(e){for(var t="",o=0;o<e.length;o++)t+=String.fromCharCode(parseInt(e[o]));return t},writeBytes:function(e,t){for(var o=0;o<e.length;o++){var n=e.charCodeAt(o);n<128?t.push(n):n<2048?t.push(192|n>>6,128|63&n):n<55296||n>=57344?t.push(224|n>>12,128|n>>6&63,128|63&n):(o++,n=65536+((1023&n)<<10|1023&e.charCodeAt(o)),t.push(240|n>>18,128|n>>12&63,128|n>>6&63,128|63&n))}},encode64:function(e){var t="",o,n,i,a,r,s,c,l=0;for(e=this.encodeUTF8(e);l<e.length;)a=(o=e.charCodeAt(l++))>>2,r=(3&o)<<4|(n=e.charCodeAt(l++))>>4,s=(15&n)<<2|(i=e.charCodeAt(l++))>>6,c=63&i,isNaN(n)?s=c=64:isNaN(i)&&(c=64),t+=this.hashKey.charAt(a)+this.hashKey.charAt(r)+this.hashKey.charAt(s)+this.hashKey.charAt(c);return t},decode64:function(e){for(var t="",o,n,i,a,r,s,c,l=0,d=(e=e.replace(/[^A-Za-z0-9\+\/\=]/g,"")).length;l<d;)o=(a=this.hashKey.indexOf(e.charAt(l++)))<<2|(r=this.hashKey.indexOf(e.charAt(l++)))>>4,n=(15&r)<<4|(s=this.hashKey.indexOf(e.charAt(l++)))>>2,i=(3&s)<<6|(c=this.hashKey.indexOf(e.charAt(l++))),t+=String.fromCharCode(o),64!==s&&(t+=String.fromCharCode(n)),64!==c&&(t+=String.fromCharCode(i));return t=this.decodeUTF8(t)},encodeUTF8:function(e){for(var t="",o=0,n=(e=e.replace(/\r\n/g,"\n")).length;o<n;o++){var i=e.charCodeAt(o);i<128?t+=String.fromCharCode(i):i>127&&i<2048?(t+=String.fromCharCode(i>>6|192),t+=String.fromCharCode(63&i|128)):(t+=String.fromCharCode(i>>12|224),t+=String.fromCharCode(i>>6&63|128),t+=String.fromCharCode(63&i|128))}return t},decodeUTF8:function(e){for(var t="",o=0,n=0,i,a,r=e.length;o<r;)(n=e.charCodeAt(o))<128?(t+=String.fromCharCode(n),o++):n>191&&n<224?(i=e.charCodeAt(o+1),t+=String.fromCharCode((31&n)<<6|63&i),o+=2):(i=e.charCodeAt(o+1),a=e.charCodeAt(o+2),t+=String.fromCharCode((15&n)<<12|(63&i)<<6|63&a),o+=3);return t}};function PdfDocument(){for(var e in this._pages=new Array,this._xfaStreams=new Array,this._fontResources=new Array,FONTNAMES){var t="<</Type /Font /Subtype /Type1 /BaseFont /"+FONTNAMES[e]+">>",o=new PdfResource(FONTNAMES[e],t);this._fontResources.push(o)}}function PdfPage(){this._width=612,this._height=792,this._rotation=0,this._texts=new Array,this._images=new Array}function PdfText(e,t,o,n,i){this._x=e,this._y=t,this._fontName;var a=o.toUpperCase();this._fontName=a in FONTNAMES?FONTNAMES[a]:FONTNAMES.ARIAL,this._fontSize=n,this._fontText=i}function PdfImage(e,t,o){this._x=e,this._y=t,this._imageData=o}function PdfResource(e,t){this._name=e,this._stream=t}function XFAStream(e,t){this._name=e,this._data=t}function getObjStart(e){return e+" 0 obj"}function getObjRef(e){return e+" 0 R"}function getCatalogString(e){return getObjStart(e)+" <</Type /Catalog /Pages "+getObjRef(e+1)+">>\nendobj\n"}function getStructTreeString(e){return getObjStart(e)+" <</Type /StructTreeRoot>>\nendobj\n"}function getXFACatalogString(e,t,o){return getObjStart(e)+" <</NeedsRendering true/AcroForm "+getObjRef(t)+"/Extensions<</ADBE<</BaseVersion/1.7/ExtensionLevel 5>>>>/MarkInfo<</Marked true>>/Type /Catalog /Pages "+getObjRef(e+1)+">>\nendobj\n"}function getPageTreeString(e,t){for(var o=getObjStart(e)+" <</Type /Pages /Kids [ ",n=e+1,i=0;i<t;i++)o+=getObjRef(i+n)+" ";return o+="] /Count "+t+">>\nendobj\n"}function getPageString(e,t,o,n,i){return getObjStart(e)+" <</Type /Page /Parent "+getObjRef(t)+" /Resources "+getObjRef(o)+" /Contents "+getObjRef(n)+" /MediaBox [0 0 "+i._width+" "+i._height+"] /Rotate "+i._rotation+">>\nendobj\n"}function getContentString(e,t){for(var o="",n=t._texts.length,i=0;i<n;i++){var a=t._texts[i];o+="BT /"+a._fontName+" "+a._fontSize+" Tf "+a._x+" "+a._y+" Td ("+a._fontText+")Tj ET\n"}var r=new Array;return EcmaPDF.writeBytes(o,r),getObjStart(e)+" <</Length "+r.length+">>\nstream\n"+o+"\nendstream\nendobj\n"}function getResourceString(e,t,o){for(var n=getObjStart(e)+" <</Font <<",i=0;i<t;i++){var a;n+="/"+o._fontResources[i]._name+" "+getObjRef(e+1+i)+" "}return n+=">> >>\nendObj\n"}function getFontDefString(e,t){return getObjStart(e)+t._stream+"\nendobj\n"}function getZeroLead(e){for(var t=""+e,o=10-t.length,n=0;n<o;n++)t="0"+t;return t}function getXrefString(e){for(var t=e.length,o="xref\n0 "+(t+1)+"\n0000000000 65535 f \n",n=0;n<t;n++)o+=getZeroLead(e[n])+" 00000 n \n";return o}function getXFADefinitionString(e,t){return getObjStart(e)+"\n<</XFA "+getObjRef(t)+"/Fields[]>>\nendobj\n"}function getXFATemplateString(e,t,o){return getObjStart(e)+"\n<</Length "+t+">>stream\n"+o+"\nendstream\nendobj\n"}PdfDocument.prototype.addPage=function(e){this._pages.push(e)},PdfDocument.prototype.addXFAStream=function(e){this._xfaStreams.push(e)},PdfPage.prototype.setWidth=function(e){this._width=e},PdfPage.prototype.setHeight=function(e){this._height=e},PdfPage.prototype.addText=function(e){e._y=this._height-e._y-e._fontSize,this._texts.push(e)},PdfPage.prototype.setRotation=function(e){this._rotation=e},PdfPage.prototype.addImage=function(e){this._images.push(e)},PdfDocument.prototype.createPdfString=function(e){var t=new Array,o=new Array,n=this._pages.length,i=1,a=2,r=3,s=3+n,c=s+n,l=c+1,d=this._fontResources.length,u=l+d,h=u;EcmaPDF.writeBytes("%PDF-1.7\n",o);var f=null;f=e?getXFACatalogString(1,h,u):getCatalogString(1),t.push(o.length),EcmaPDF.writeBytes(f,o),f=getPageTreeString(2,n),t.push(o.length),EcmaPDF.writeBytes(f,o);for(var m=0;m<n;m++){var p,g,y;f=getPageString(3+m,2,c,y=s+m,p=this._pages[m]),t.push(o.length),EcmaPDF.writeBytes(f,o)}for(var m=0;m<n;m++){var p,y;f=getContentString(y=s+m,p=this._pages[m]),t.push(o.length),EcmaPDF.writeBytes(f,o)}f=getResourceString(c,d,this),t.push(o.length),EcmaPDF.writeBytes(f,o);for(var m=0;m<d;m++)f=getFontDefString(l+m,this._fontResources[m]),t.push(o.length),EcmaPDF.writeBytes(f,o);if(e){var S=h+1;f=getXFADefinitionString(h,S),t.push(o.length),EcmaPDF.writeBytes(f,o);var O=new Array;EcmaPDF.writeBytes(e,O),f=getXFATemplateString(S,O.length,e),t.push(o.length),EcmaPDF.writeBytes(f,o)}var E=o.length;return f=getXrefString(t),EcmaPDF.writeBytes(f,o),f="trailer <</Size "+(t.length+1)+" /Root 1 0 R>>\nstartxref\n"+E+"\n%%EOF",EcmaPDF.writeBytes(f,o),EcmaPDF.bytesToString(o)}}var app=idrform.app;</script>

<div id='FDFXFA_Processing'>&#xF010;</div>
<div id='FDFXFA_FormType'>AcroForm</div>
<div id='FDFXFA_PDFName'>f941.pdf</div>
<div id='FDFXFA_Menu'><a title='Submit Form' onclick="FormViewer.handleFormSubmission('', 'formdata')">&#xF018;</a><a title='Go To FirstPage' onclick="idrform.app.execMenuItem('FirstPage')">&#xF01C;</a><a title='Go To PrevPage' onclick="idrform.app.execMenuItem('PrevPage')">&#xF01D;</a><label id='FDFXFA_PageLabel'><span id="btnPage">1</span></label><label id='FDFXFA_PageCount'>/ <span>6</span></label><a title='Go To NextPage' onclick="idrform.app.execMenuItem('NextPage')">&#xF01E;</a><a title='Go To LastPage' onclick="idrform.app.execMenuItem('LastPage')">&#xF01F;</a><a title='Save As Editable PDF' onclick="idrform.app.execMenuItem('SaveAs')">&#xF01A;</a><button id="btnZoomOut" title="Zoom Out" class="btn"><i class="fa fa-minus fa-lg" aria-hidden="true"></i></button><button id="btnZoomIn" title="Zoom In" class="btn"><i class="fa fa-plus fa-lg" aria-hidden="true"></i></button></div>
<div id="formviewer">
<div></div>
<div id="overlay"></div>
<form>
<div id="contentContainer"  style="background: white;">
<div id="page1" style="width: 934px; height: 1209px; margin-top:20px;" class="page">
<div class="page-inner" style="width: 934px; height: 1209px;">

<div id="p1" class="pageArea" style="overflow: hidden; position: relative; width: 934px; height: 1209px; margin-top:auto; margin-left:auto; margin-right:auto; background-color: white;">

<!-- Begin shared CSS values -->
<style class="shared-css" type="text/css" >
.t {
	transform-origin: bottom left;
	z-index: 2;
	position: absolute;
	white-space: pre;
	overflow: visible;
	line-height: 1.5;
}
.text-container {
	white-space: pre;
}
@supports (-webkit-touch-callout: none) {
	.text-container {
		white-space: normal;
	}
}
</style>
<!-- End shared CSS values -->


<!-- Begin inline CSS -->
<style type="text/css" >

#t1_1{left:55px;bottom:1129px;letter-spacing:-0.14px;}
#t2_1{left:89px;bottom:1122px;letter-spacing:-0.21px;}
#t3_1{left:55px;bottom:1117px;letter-spacing:-0.15px;}
#t4_1{left:253px;bottom:1126px;letter-spacing:0.19px;}
#t5_1{left:253px;bottom:1118px;letter-spacing:-0.14px;}
#t6_1{left:814px;bottom:1135px;letter-spacing:0.2px;}
#t7_1{left:781px;bottom:1119px;letter-spacing:-0.17px;}
#t8_1{left:66px;bottom:1080px;letter-spacing:-0.15px;}
#t9_1{left:211px;bottom:1080px;letter-spacing:-0.13px;}
#ta_1{left:311px;bottom:1087px;}
#tb_1{left:69px;bottom:1045px;letter-spacing:-0.17px;}
#tc_1{left:102px;bottom:1045px;letter-spacing:-0.14px;}
#td_1{left:69px;bottom:1009px;letter-spacing:-0.16px;}
#te_1{left:133px;bottom:1009px;letter-spacing:-0.11px;}
#tf_1{left:69px;bottom:969px;letter-spacing:-0.17px;}
#tg_1{left:126px;bottom:957px;letter-spacing:0.09px;}
#th_1{left:240px;bottom:957px;letter-spacing:0.06px;}
#ti_1{left:494px;bottom:957px;letter-spacing:0.08px;}
#tj_1{left:126px;bottom:911px;letter-spacing:0.07px;}
#tk_1{left:435px;bottom:911px;letter-spacing:0.08px;}
#tl_1{left:520px;bottom:911px;letter-spacing:0.08px;}
#tm_1{left:126px;bottom:865px;letter-spacing:0.08px;}
#tn_1{left:357px;bottom:865px;letter-spacing:0.08px;}
#to_1{left:500px;bottom:865px;letter-spacing:0.08px;}
#tp_1{left:654px;bottom:1088px;letter-spacing:-0.11px;}
#tq_1{left:654px;bottom:1073px;letter-spacing:-0.15px;}
#tr_1{left:671px;bottom:1042px;letter-spacing:0.09px;}
#ts_1{left:685px;bottom:1042px;letter-spacing:0.11px;}
#tt_1{left:671px;bottom:1018px;letter-spacing:0.09px;}
#tu_1{left:685px;bottom:1018px;letter-spacing:0.1px;}
#tv_1{left:671px;bottom:993px;letter-spacing:0.09px;}
#tw_1{left:685px;bottom:993px;letter-spacing:0.11px;}
#tx_1{left:671px;bottom:969px;letter-spacing:0.09px;}
#ty_1{left:685px;bottom:969px;letter-spacing:0.12px;}
#tz_1{left:649px;bottom:946px;letter-spacing:0.09px;}
#t10_1{left:683px;bottom:946px;letter-spacing:0.11px;}
#t11_1{left:807px;bottom:946px;letter-spacing:0.07px;}
#t12_1{left:649px;bottom:932px;letter-spacing:0.1px;}
#t13_1{left:55px;bottom:834px;letter-spacing:-0.01px;}
#t14_1{left:60px;bottom:813px;letter-spacing:-0.11px;}
#t15_1{left:122px;bottom:814px;letter-spacing:-0.12px;}
#t16_1{left:70px;bottom:791px;}
#t17_1{left:99px;bottom:791px;letter-spacing:-0.01px;word-spacing:1.14px;}
#t18_1{left:99px;bottom:772px;letter-spacing:-0.01px;}
#t19_1{left:160px;bottom:772px;letter-spacing:-0.01px;}
#t1a_1{left:208px;bottom:772px;letter-spacing:-0.01px;}
#t1b_1{left:278px;bottom:772px;letter-spacing:-0.01px;}
#t1c_1{left:328px;bottom:772px;letter-spacing:-0.01px;}
#t1d_1{left:398px;bottom:772px;letter-spacing:-0.01px;}
#t1e_1{left:450px;bottom:772px;letter-spacing:-0.01px;}
#t1f_1{left:536px;bottom:772px;letter-spacing:-0.01px;}
#t1g_1{left:584px;bottom:772px;letter-spacing:-0.01px;}
#t1h_1{left:667px;bottom:771px;}
#t1i_1{left:70px;bottom:735px;}
#t1j_1{left:99px;bottom:735px;letter-spacing:-0.01px;}
#t1k_1{left:348px;bottom:735px;}
#t1l_1{left:367px;bottom:735px;}
#t1m_1{left:385px;bottom:735px;}
#t1n_1{left:403px;bottom:735px;}
#t1o_1{left:422px;bottom:735px;}
#t1p_1{left:440px;bottom:735px;}
#t1q_1{left:458px;bottom:735px;}
#t1r_1{left:477px;bottom:735px;}
#t1s_1{left:495px;bottom:735px;}
#t1t_1{left:513px;bottom:735px;}
#t1u_1{left:532px;bottom:735px;}
#t1v_1{left:550px;bottom:735px;}
#t1w_1{left:568px;bottom:735px;}
#t1x_1{left:587px;bottom:735px;}
#t1y_1{left:605px;bottom:735px;}
#t1z_1{left:623px;bottom:735px;}
#t20_1{left:642px;bottom:735px;}
#t21_1{left:667px;bottom:735px;}
#t22_1{left:839px;bottom:730px;}
#t23_1{left:70px;bottom:698px;}
#t24_1{left:99px;bottom:698px;letter-spacing:-0.01px;}
#t25_1{left:550px;bottom:698px;}
#t26_1{left:568px;bottom:698px;}
#t27_1{left:587px;bottom:698px;}
#t28_1{left:605px;bottom:698px;}
#t29_1{left:623px;bottom:698px;}
#t2a_1{left:642px;bottom:698px;}
#t2b_1{left:667px;bottom:698px;}
#t2c_1{left:839px;bottom:693px;}
#t2d_1{left:70px;bottom:661px;}
#t2e_1{left:99px;bottom:661px;letter-spacing:-0.01px;}
#t2f_1{left:704px;bottom:661px;letter-spacing:-0.01px;}
#t2g_1{left:372px;bottom:640px;letter-spacing:-0.01px;}
#t2h_1{left:581px;bottom:640px;letter-spacing:-0.01px;}
#t2i_1{left:70px;bottom:616px;letter-spacing:-0.01px;}
#t2j_1{left:99px;bottom:616px;letter-spacing:-0.01px;}
#t2k_1{left:293px;bottom:616px;}
#t2l_1{left:312px;bottom:616px;}
#t2m_1{left:432px;bottom:610px;}
#t2n_1{left:478px;bottom:616px;letter-spacing:-0.01px;}
#t2o_1{left:641px;bottom:610px;}
#t2p_1{left:70px;bottom:588px;letter-spacing:-0.01px;}
#t2q_1{left:99px;bottom:588px;}
#t2r_1{left:121px;bottom:588px;letter-spacing:-0.01px;}
#t2s_1{left:312px;bottom:588px;}
#t2t_1{left:432px;bottom:583px;}
#t2u_1{left:478px;bottom:588px;letter-spacing:-0.01px;}
#t2v_1{left:641px;bottom:583px;}
#t2w_1{left:70px;bottom:561px;letter-spacing:-0.01px;}
#t2x_1{left:99px;bottom:561px;}
#t2y_1{left:121px;bottom:561px;letter-spacing:-0.01px;}
#t2z_1{left:312px;bottom:561px;}
#t30_1{left:432px;bottom:556px;}
#t31_1{left:478px;bottom:561px;letter-spacing:-0.01px;}
#t32_1{left:641px;bottom:556px;}
#t33_1{left:704px;bottom:621px;letter-spacing:-0.13px;word-spacing:-0.33px;}
#t34_1{left:704px;bottom:608px;letter-spacing:-0.13px;}
#t35_1{left:704px;bottom:595px;letter-spacing:-0.13px;}
#t36_1{left:704px;bottom:583px;letter-spacing:-0.14px;}
#t37_1{left:704px;bottom:570px;letter-spacing:-0.13px;}
#t38_1{left:704px;bottom:558px;letter-spacing:-0.11px;}
#t39_1{left:796px;bottom:558px;letter-spacing:-0.15px;}
#t3a_1{left:820px;bottom:558px;letter-spacing:-0.12px;}
#t3b_1{left:704px;bottom:545px;letter-spacing:-0.13px;}
#t3c_1{left:704px;bottom:532px;letter-spacing:-0.13px;}
#t3d_1{left:704px;bottom:520px;letter-spacing:-0.13px;}
#t3e_1{left:704px;bottom:507px;letter-spacing:-0.14px;}
#t3f_1{left:70px;bottom:533px;letter-spacing:-0.01px;}
#t3g_1{left:99px;bottom:533px;letter-spacing:-0.01px;}
#t3h_1{left:275px;bottom:533px;}
#t3i_1{left:293px;bottom:533px;}
#t3j_1{left:312px;bottom:533px;}
#t3k_1{left:432px;bottom:528px;}
#t3l_1{left:478px;bottom:533px;letter-spacing:-0.01px;}
#t3m_1{left:641px;bottom:528px;}
#t3n_1{left:70px;bottom:506px;letter-spacing:-0.01px;}
#t3o_1{left:99px;bottom:506px;letter-spacing:-0.01px;}
#t3p_1{left:293px;bottom:506px;}
#t3q_1{left:312px;bottom:506px;}
#t3r_1{left:432px;bottom:500px;}
#t3s_1{left:478px;bottom:506px;letter-spacing:-0.01px;}
#t3t_1{left:641px;bottom:500px;}
#t3u_1{left:70px;bottom:483px;letter-spacing:-0.01px;}
#t3v_1{left:99px;bottom:483px;letter-spacing:-0.01px;}
#t3w_1{left:99px;bottom:467px;letter-spacing:-0.01px;}
#t3x_1{left:432px;bottom:464px;}
#t3y_1{left:478px;bottom:469px;letter-spacing:-0.01px;}
#t3z_1{left:641px;bottom:464px;}
#t40_1{left:70px;bottom:432px;letter-spacing:-0.01px;}
#t41_1{left:99px;bottom:432px;letter-spacing:-0.01px;}
#t42_1{left:340px;bottom:432px;letter-spacing:-0.01px;}
#t43_1{left:664px;bottom:432px;letter-spacing:-0.01px;}
#t44_1{left:839px;bottom:427px;}
#t45_1{left:70px;bottom:396px;letter-spacing:-0.01px;}
#t46_1{left:99px;bottom:396px;letter-spacing:-0.01px;}
#t47_1{left:504px;bottom:396px;letter-spacing:-0.01px;}
#t48_1{left:623px;bottom:396px;}
#t49_1{left:642px;bottom:396px;}
#t4a_1{left:665px;bottom:396px;letter-spacing:-0.01px;}
#t4b_1{left:839px;bottom:390px;}
#t4c_1{left:70px;bottom:359px;}
#t4d_1{left:99px;bottom:359px;letter-spacing:-0.01px;}
#t4e_1{left:299px;bottom:359px;letter-spacing:-0.01px;}
#t4f_1{left:440px;bottom:359px;}
#t4g_1{left:458px;bottom:359px;}
#t4h_1{left:477px;bottom:359px;}
#t4i_1{left:495px;bottom:359px;}
#t4j_1{left:513px;bottom:359px;}
#t4k_1{left:532px;bottom:359px;}
#t4l_1{left:550px;bottom:359px;}
#t4m_1{left:568px;bottom:359px;}
#t4n_1{left:587px;bottom:359px;}
#t4o_1{left:605px;bottom:359px;}
#t4p_1{left:623px;bottom:359px;}
#t4q_1{left:642px;bottom:359px;}
#t4r_1{left:667px;bottom:359px;}
#t4s_1{left:839px;bottom:354px;}
#t4t_1{left:70px;bottom:322px;}
#t4u_1{left:99px;bottom:322px;letter-spacing:-0.01px;}
#t4v_1{left:422px;bottom:322px;}
#t4w_1{left:440px;bottom:322px;}
#t4x_1{left:458px;bottom:322px;}
#t4y_1{left:477px;bottom:322px;}
#t4z_1{left:495px;bottom:322px;}
#t50_1{left:513px;bottom:322px;}
#t51_1{left:532px;bottom:322px;}
#t52_1{left:550px;bottom:322px;}
#t53_1{left:568px;bottom:322px;}
#t54_1{left:587px;bottom:322px;}
#t55_1{left:605px;bottom:322px;}
#t56_1{left:623px;bottom:322px;}
#t57_1{left:642px;bottom:322px;}
#t58_1{left:667px;bottom:322px;}
#t59_1{left:839px;bottom:317px;}
#t5a_1{left:70px;bottom:286px;}
#t5b_1{left:99px;bottom:286px;letter-spacing:-0.01px;}
#t5c_1{left:367px;bottom:286px;}
#t5d_1{left:385px;bottom:286px;}
#t5e_1{left:403px;bottom:286px;}
#t5f_1{left:422px;bottom:286px;}
#t5g_1{left:440px;bottom:286px;}
#t5h_1{left:458px;bottom:286px;}
#t5i_1{left:477px;bottom:286px;}
#t5j_1{left:495px;bottom:286px;}
#t5k_1{left:513px;bottom:286px;}
#t5l_1{left:532px;bottom:286px;}
#t5m_1{left:550px;bottom:286px;}
#t5n_1{left:568px;bottom:286px;}
#t5o_1{left:587px;bottom:286px;}
#t5p_1{left:605px;bottom:286px;}
#t5q_1{left:623px;bottom:286px;}
#t5r_1{left:642px;bottom:286px;}
#t5s_1{left:667px;bottom:286px;}
#t5t_1{left:839px;bottom:280px;}
#t5u_1{left:70px;bottom:249px;}
#t5v_1{left:99px;bottom:249px;letter-spacing:-0.01px;}
#t5w_1{left:532px;bottom:249px;}
#t5x_1{left:550px;bottom:249px;}
#t5y_1{left:568px;bottom:249px;}
#t5z_1{left:587px;bottom:249px;}
#t60_1{left:605px;bottom:249px;}
#t61_1{left:623px;bottom:249px;}
#t62_1{left:642px;bottom:249px;}
#t63_1{left:667px;bottom:249px;}
#t64_1{left:839px;bottom:244px;}
#t65_1{left:63px;bottom:212px;letter-spacing:-0.01px;}
#t66_1{left:99px;bottom:212px;letter-spacing:-0.01px;}
#t67_1{left:287px;bottom:212px;letter-spacing:-0.01px;}
#t68_1{left:458px;bottom:212px;}
#t69_1{left:477px;bottom:212px;}
#t6a_1{left:495px;bottom:212px;}
#t6b_1{left:513px;bottom:212px;}
#t6c_1{left:532px;bottom:212px;}
#t6d_1{left:550px;bottom:212px;}
#t6e_1{left:568px;bottom:212px;}
#t6f_1{left:587px;bottom:212px;}
#t6g_1{left:605px;bottom:212px;}
#t6h_1{left:623px;bottom:212px;}
#t6i_1{left:642px;bottom:212px;}
#t6j_1{left:664px;bottom:212px;letter-spacing:-0.01px;}
#t6k_1{left:839px;bottom:207px;}
#t6l_1{left:63px;bottom:176px;letter-spacing:-0.01px;}
#t6m_1{left:99px;bottom:176px;letter-spacing:-0.01px;}
#t6n_1{left:546px;bottom:176px;letter-spacing:-0.01px;}
#t6o_1{left:660px;bottom:176px;letter-spacing:-0.01px;}
#t6p_1{left:839px;bottom:170px;}
#t6q_1{left:63px;bottom:144px;letter-spacing:-0.01px;}
#t6r_1{left:99px;bottom:144px;letter-spacing:-0.01px;word-spacing:1.78px;}
#t6s_1{left:99px;bottom:128px;letter-spacing:-0.01px;}
#t6t_1{left:238px;bottom:128px;}
#t6u_1{left:257px;bottom:128px;}
#t6v_1{left:275px;bottom:128px;}
#t6w_1{left:293px;bottom:128px;}
#t6x_1{left:312px;bottom:128px;}
#t6y_1{left:330px;bottom:128px;}
#t6z_1{left:348px;bottom:128px;}
#t70_1{left:367px;bottom:128px;}
#t71_1{left:385px;bottom:128px;}
#t72_1{left:403px;bottom:128px;}
#t73_1{left:422px;bottom:128px;}
#t74_1{left:440px;bottom:128px;}
#t75_1{left:458px;bottom:128px;}
#t76_1{left:477px;bottom:128px;}
#t77_1{left:495px;bottom:128px;}
#t78_1{left:513px;bottom:128px;}
#t79_1{left:532px;bottom:128px;}
#t7a_1{left:550px;bottom:128px;}
#t7b_1{left:568px;bottom:128px;}
#t7c_1{left:587px;bottom:128px;}
#t7d_1{left:605px;bottom:128px;}
#t7e_1{left:623px;bottom:128px;}
#t7f_1{left:642px;bottom:128px;}
#t7g_1{left:659px;bottom:127px;letter-spacing:-0.01px;}
#t7h_1{left:839px;bottom:125px;}
#t7i_1{left:63px;bottom:89px;letter-spacing:-0.01px;}
#t7j_1{left:99px;bottom:89px;letter-spacing:-0.01px;}
#t7k_1{left:257px;bottom:89px;}
#t7l_1{left:275px;bottom:89px;}
#t7m_1{left:293px;bottom:89px;}
#t7n_1{left:312px;bottom:89px;}
#t7o_1{left:330px;bottom:89px;}
#t7p_1{left:348px;bottom:89px;}
#t7q_1{left:367px;bottom:89px;}
#t7r_1{left:385px;bottom:89px;}
#t7s_1{left:403px;bottom:89px;}
#t7t_1{left:422px;bottom:89px;}
#t7u_1{left:440px;bottom:89px;}
#t7v_1{left:458px;bottom:89px;}
#t7w_1{left:477px;bottom:89px;}
#t7x_1{left:495px;bottom:89px;}
#t7y_1{left:513px;bottom:89px;}
#t7z_1{left:532px;bottom:89px;}
#t80_1{left:550px;bottom:89px;}
#t81_1{left:568px;bottom:89px;}
#t82_1{left:587px;bottom:89px;}
#t83_1{left:605px;bottom:89px;}
#t84_1{left:623px;bottom:89px;}
#t85_1{left:642px;bottom:89px;}
#t86_1{left:659px;bottom:89px;letter-spacing:-0.01px;}
#t87_1{left:839px;bottom:83px;}
#t88_1{left:77px;bottom:52px;letter-spacing:-0.01px;}
#t89_1{left:55px;bottom:34px;letter-spacing:0.11px;}
#t8a_1{left:632px;bottom:34px;letter-spacing:-0.15px;}
#t8b_1{left:760px;bottom:35px;letter-spacing:-0.14px;}
#t8c_1{left:788px;bottom:33px;letter-spacing:0.15px;}
#t8d_1{left:816px;bottom:35px;letter-spacing:-0.14px;}

.s0_1{font-size:11px;font-family:HelveticaNeueLTStd-Roman_1fp_1;color:#000;}
.s1_1{font-size:28px;font-family:HelveticaNeueLTStd-BlkCn_1fr_1;color:#000;}
.s2_1{font-size:21px;font-family:ITCFranklinGothicStd-Demi_1fq_1;color:#000;}
.s3_1{font-size:15px;font-family:OCRAStd_1fm_1;color:#000;}
.s4_1{font-size:11px;font-family:HelveticaNeueLTStd-Bd_1fn_1;color:#000;}
.s5_1{font-size:11px;font-family:HelveticaNeueLTStd-It_1fo_1;color:#000;}
.s6_1{font-size:9px;font-family:HelveticaNeueLTStd-Roman_1fp_1;color:#000;}
.s7_1{font-size:14px;font-family:HelveticaNeueLTStd-Bd_1fn_1;color:#F3F3F3;}
.s8_1{font-size:11px;font-family:HelveticaNeueLTStd-Bd_1fn_1;color:#F3F3F3;}
.s9_1{font-size:12px;font-family:HelveticaNeueLTStd-Bd_1fn_1;color:#000;}
.sa_1{font-size:12px;font-family:HelveticaNeueLTStd-Roman_1fp_1;color:#000;}
.sb_1{font-size:12px;font-family:HelveticaNeueLTStd-It_1fo_1;color:#000;}
.sc_1{font-size:13px;font-family:HelveticaNeueLTStd-Roman_1fp_1;color:#000;}
.sd_1{font-size:14px;font-family:HelveticaNeueLTStd-Bd_1fn_1;color:#FFF;}
.se_1{font-size:14px;font-family:HelveticaNeueLTStd-Bd_1fn_1;color:#000;}
.sf_1{font-size:13px;font-family:HelveticaNeueLTStd-Bd_1fn_1;color:#000;}
.sg_1{font-size:13px;font-family:HelveticaNeueLTStd-BdIt_1fs_1;color:#000;}
.sh_1{font-size:26px;font-family:HelveticaNeueLTStd-Bd_1fn_1;color:#000;}
.si_1{font-size:11px;font-family:HelveticaNeueLTStd-BdIt_1fs_1;color:#000;}
.sj_1{font-size:15px;font-family:HelveticaNeueLTStd-Bd_1fn_1;color:#000;}
.t.v0_1{transform:scaleX(0.89);}
.t.v1_1{transform:scaleX(0.96);}
.t.v2_1{transform:scaleX(0.989);}
.t.v3_1{transform:scaleX(0.94);}
.t.v4_1{transform:scaleX(0.95);}
.t.v5_1{transform:scaleX(0.88);}
.t.v6_1{transform:scaleX(0.969);}
#form1_1{	z-index: 2;	padding: 0px;	position: absolute;	left: 239px;	top: 103px;	width: 67px;	height: 26px;	color: rgb(0,0,0);	text-align: left;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form2_1{	z-index: 2;	padding: 0px;	position: absolute;	left: 337px;	top: 102px;	width: 261px;	height: 26px;	color: rgb(0,0,0);	text-align: left;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form3_1{	z-index: 2;	border-style: none;	padding: 0px;	position: absolute;	left: 649px;	top: 147px;	width: 15px;	height: 15px;	color: rgb(0,0,0);	text-align: left;	background: transparent;	font: normal 12px Wingdings, 'Zapf Dingbats';}
#form4_1{	z-index: 2;	padding: 0px;	position: absolute;	left: 209px;	top: 136px;	width: 384px;	height: 26px;	color: rgb(0,0,0);	text-align: left;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form5_1{	z-index: 2;	border-style: none;	padding: 0px;	position: absolute;	left: 649px;	top: 171px;	width: 15px;	height: 15px;	color: rgb(0,0,0);	text-align: left;	background: transparent;	font: normal 12px Wingdings, 'Zapf Dingbats';}
#form6_1{	z-index: 2;	padding: 0px;	position: absolute;	left: 176px;	top: 173px;	width: 417px;	height: 26px;	color: rgb(0,0,0);	text-align: left;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form7_1{	z-index: 2;	border-style: none;	padding: 0px;	position: absolute;	left: 649px;	top: 196px;	width: 15px;	height: 15px;	color: rgb(0,0,0);	text-align: left;	background: transparent;	font: normal 12px Wingdings, 'Zapf Dingbats';}
#form8_1{	z-index: 2;	border-style: none;	padding: 0px;	position: absolute;	left: 649px;	top: 220px;	width: 15px;	height: 15px;	color: rgb(0,0,0);	text-align: left;	background: transparent;	font: normal 12px Wingdings, 'Zapf Dingbats';}
#form9_1{	z-index: 2;	padding: 0px;	position: absolute;	left: 121px;	top: 209px;	width: 472px;	height: 26px;	color: rgb(0,0,0);	text-align: left;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form10_1{	z-index: 2;	padding: 0px;	position: absolute;	left: 121px;	top: 255px;	width: 284px;	height: 26px;	color: rgb(0,0,0);	text-align: left;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form11_1{	z-index: 2;	padding: 0px;	position: absolute;	left: 419px;	top: 255px;	width: 54px;	height: 26px;	color: rgb(0,0,0);	text-align: center;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form12_1{	z-index: 2;	padding: 0px;	position: absolute;	left: 484px;	top: 255px;	width: 109px;	height: 26px;	color: rgb(0,0,0);	text-align: center;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form13_1{	z-index: 2;	padding: 0px;	position: absolute;	left: 121px;	top: 301px;	width: 219px;	height: 26px;	color: rgb(0,0,0);	text-align: left;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form14_1{	z-index: 2;	padding: 0px;	position: absolute;	left: 352px;	top: 301px;	width: 132px;	height: 26px;	color: rgb(0,0,0);	text-align: left;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form15_1{	z-index: 2;	padding: 0px;	position: absolute;	left: 495px;	top: 301px;	width: 98px;	height: 26px;	color: rgb(0,0,0);	text-align: center;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form16_1{	z-index: 2;	padding: 0px;	position: absolute;	left: 682px;	top: 416px;	width: 197px;	height: 20px;	color: rgb(0,0,0);	text-align: center;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form17_1{	z-index: 2;	padding: 0px;	position: absolute;	left: 682px;	top: 448px;	width: 153px;	height: 20px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form18_1{	z-index: 2;	padding: 0px;	position: absolute;	left: 847px;	top: 448px;	width: 31px;	height: 20px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form19_1{	z-index: 2;	padding: 0px;	position: absolute;	left: 682px;	top: 484px;	width: 153px;	height: 20px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form20_1{	z-index: 2;	padding: 0px;	position: absolute;	left: 847px;	top: 484px;	width: 31px;	height: 20px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form21_1{	z-index: 2;	border-style: none;	padding: 0px;	position: absolute;	left: 682px;	top: 526px;	width: 15px;	height: 15px;	color: rgb(0,0,0);	text-align: left;	background: transparent;	font: normal 12px Wingdings, 'Zapf Dingbats';}
#form22_1{	z-index: 2;	padding: 0px;	position: absolute;	left: 330px;	top: 568px;	width: 98px;	height: 20px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;
 
}

#form23_1{	z-index: 2;	padding: 0px;	position: absolute;	left: 440px;	top: 567px;	width: 31px;	height: 20px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form24_1{	z-index: 2;	padding: 0px;	position: absolute;	left: 539px;	top: 567px;	width: 98px;	height: 30px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form25_1{	z-index: 2;	padding: 0px;	position: absolute;	left: 649px;	top: 567px;	width: 31px;	height: 30px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form26_1{	z-index: 2;	padding: 0px;	position: absolute;	left: 330px;	top: 594px;	width: 98px;	height: 20px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form27_1{	z-index: 2;	padding: 0px;	position: absolute;	left: 440px;	top: 594px;	width: 31px;	height: 20px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form28_1{	z-index: 2;	padding: 0px;	position: absolute;	left: 539px;	top: 594px;	width: 98px;	height: 20px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form29_1{	z-index: 2;	padding: 0px;	position: absolute;	left: 649px;	top: 594px;	width: 31px;	height: 20px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form30_1{	z-index: 2;	padding: 0px;	position: absolute;	left: 330px;	top: 622px;	width: 98px;	height: 20px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form31_1{	z-index: 2;	padding: 0px;	position: absolute;	left: 440px;	top: 622px;	width: 31px;	height: 20px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form32_1{	z-index: 2;	padding: 0px;	position: absolute;	left: 539px;	top: 622px;	width: 98px;	height: 20px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form33_1{	z-index: 2;	padding: 0px;	position: absolute;	left: 649px;	top: 622px;	width: 31px;	height: 20px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form34_1{	z-index: 2;	padding: 0px;	position: absolute;	left: 330px;	top: 649px;	width: 98px;	height: 20px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form35_1{	z-index: 2;	padding: 0px;	position: absolute;	left: 440px;	top: 649px;	width: 31px;	height: 20px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form36_1{	z-index: 2;	padding: 0px;	position: absolute;	left: 539px;	top: 649px;	width: 98px;	height: 20px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form37_1{	z-index: 2;	padding: 0px;	position: absolute;	left: 649px;	top: 649px;	width: 31px;	height: 20px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form38_1{	z-index: 2;	padding: 0px;	position: absolute;	left: 330px;	top: 677px;	width: 98px;	height: 20px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form39_1{	z-index: 2;	padding: 0px;	position: absolute;	left: 440px;	top: 677px;	width: 31px;	height: 20px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form40_1{	z-index: 2;	padding: 0px;	position: absolute;	left: 539px;	top: 677px;	width: 98px;	height: 20px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form41_1{	z-index: 2;	padding: 0px;	position: absolute;	left: 640px;	top: 677px;	width: 31px;	height: 20px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form42_1{	z-index: 2;	padding: 0px;	position: absolute;	left: 330px;	top: 714px;	width: 98px;	height: 20px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form43_1{	z-index: 2;	padding: 0px;	position: absolute;	left: 440px;	top: 714px;	width: 31px;	height: 20px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form44_1{	z-index: 2;	padding: 0px;	position: absolute;	left: 539px;	top: 714px;	width: 98px;	height: 20px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form45_1{	z-index: 2;	padding: 0px;	position: absolute;	left: 649px;	top: 714px;	width: 31px;	height: 20px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}



#form46_1{	z-index: 2;	padding: 0px;	position: absolute;	left: 682px;	top: 749px;	width: 153px;	height: 22px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;  padding-top: 12px; }





#form47_1{	z-index: 2;	padding: 0px;	position: absolute;	left: 838px;	top: 749px;	width: 31px;	height: 22px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif; padding-top: 12px;}
#form48_1{	z-index: 2;	padding: 0px;	position: absolute;	left: 682px;	top: 787px;	width: 153px;	height: 22px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form49_1{	z-index: 2;	padding: 0px;	position: absolute;	left: 847px;	top: 787px;	width: 31px;	height: 20px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form50_1{	z-index: 2;	padding: 0px;	position: absolute;	left: 682px;	top: 824px;	width: 153px;	height: 30px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form51_1{	z-index: 2;	padding: 0px;	position: absolute;	left: 838px;	top: 824px;	width: 31px;	height: 30px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form52_1{	z-index: 2;	padding: 0px;	position: absolute;	left: 682px;	top: 860px;	width: 153px;	height: 20px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form53_1{	z-index: 2;	padding: 0px;	position: absolute;	left: 847px;	top: 860px;	width: 31px;	height: 20px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form54_1{	z-index: 2;	padding: 0px;	position: absolute;	left: 682px;	top: 897px;	width: 153px;	height: 20px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form55_1{	z-index: 2;	padding: 0px;	position: absolute;	left: 847px;	top: 897px;	width: 31px;	height: 20px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form56_1{	z-index: 2;	padding: 0px;	position: absolute;	left: 682px;	top: 934px;	width: 153px;	height: 20px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form57_1{	z-index: 2;	padding: 0px;	position: absolute;	left: 847px;	top: 934px;	width: 31px;	height: 20px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form58_1{	z-index: 2;	padding: 0px;	position: absolute;	left: 682px;	top: 970px;	width: 153px;	height: 20px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form59_1{	z-index: 2;	padding: 0px;	position: absolute;	left: 847px;	top: 970px;	width: 31px;	height: 20px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form60_1{	z-index: 2;	padding: 0px;	position: absolute;	left: 682px;	top: 1007px;	width: 153px;	height: 20px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form61_1{	z-index: 2;	padding: 0px;	position: absolute;	left: 847px;	top: 1007px;	width: 31px;	height: 20px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form62_1{	z-index: 2;	padding: 0px;	position: absolute;	left: 682px;	top: 1053px;	width: 153px;	height: 20px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form63_1{	z-index: 2;	padding: 0px;	position: absolute;	left: 847px;	top: 1053px;	width: 31px;	height: 20px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form64_1{	z-index: 2;	background-size: 100% 100%;	background-image: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGcAAAAQCAMAAAA8uJGyAAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAABVJREFUeNpjYBgFo2AUjIJRMAroDwAGgAABi47q4AAAAABJRU5ErkJggg==");	background-repeat: no-repeat;	border-style: none;	padding: 0px;	position: absolute;	left: 682px;	top: 1094px;	width: 154px;	height: 22px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	font: normal 15px 'Times New Roman', Times, serif;}
#form65_1{	z-index: 2;	background-size: 100% 100%;	background-image: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABcAAAAQCAMAAADK8RQqAAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAAA1JREFUeNpjYBgFAwkAAYAAAWvLIfwAAAAASUVORK5CYII=");	background-repeat: no-repeat;	border-style: none;	padding: 0px;	position: absolute;	left: 847px;	top: 1094px;	width: 32px;	height: 22px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	font: normal 15px 'Times New Roman', Times, serif;}
#form3_1 { z-index:5; }
#form5_1 { z-index:4; }
#form7_1 { z-index:3; }
#form8_1 { z-index:2; }
#form21_1 { z-index:2; }

</style>
<!-- End inline CSS -->

<!-- Begin embedded font definitions -->
<style id="fonts1" type="text/css" >

@font-face {
	font-family: HelveticaNeueLTStd-BdIt_1fs_1;
	src: url(data:application/font-woff;charset=utf-8;base64,d09GRk9UVE8AAApAAAkAAAAADhQAAQABAAAAAAAAAAAAAAAAAAAAAAAAAABDRkYgAAAA4AAABpkAAAcl4o95Dk9TLzIAAAd8AAAAKgAAAGAJsQfcY21hcAAAB6gAAACwAAACUi5gST5oZWFkAAAIWAAAADMAAAA2+Nq32WhoZWEAAAiMAAAAHgAAACQEuwGdaG10eAAACKwAAAAxAAAAUCjhAABtYXhwAAAI4AAAAAYAAAAGABRQAG5hbWUAAAjoAAABQwAAAscdFucpcG9zdAAACiwAAAATAAAAIP+GADZ4nEVTC1QU1xme2d0Zgeqqu+yW7sDOuD5XCAJqDYbGx/LwsaKCIQZPMMvuAMtjF3eXheUhMbUCgUWkqOAjgJrDQ208xghGja8a0WCOjeXEExvbtBKprY21Lf/gvz3tXduTzJlzZ+79//+73/9999KUQkbRNK1fJRZ7RY/dakkXy0TzpkyP7aWVttWerfF57q3xwQyDxNFSuKJ2sgyXouP5v59bGfh2qjRl+uVI9qlKipysoWQ0/ew/Jmepz2XPL/AI8YkvvxxDxsS4F+PCGCEhLi5BWGFz5opCps/tEUvcwmqH1ekqdbosHtEWK6woLhYygsVuIUN0iy5vcPF7aoLdLVgEj8tiE0ssriLBmUdidptYnCu68kWXkOwqsxaVWNzWArtDdAgr0mIEscJaXOa2e8Vin1Bst4oOt2gTPAUuZ1l+gWC2O5weX6lIfnJdFpdPSCvJXRUjWBw2ocTiEwhLl5hvJzxdpMjuEKyiy2Mh38Iyl91ts1s9dqfDHbsgNXNTEGSRYBPzKPLQ1FRKRamp2VQ0FUstolZSyVQqtY5aT22gNlKZ1GtUFpVNhRPdKRnFUJFUGnWQ+orW0Vvpa7KNsoOycfk0uU1+XBGqeE1xmgll1irxKXkbIZbeDpny7VpIYE9ALIMJrDKlyytljwNfTv9VCpNLRRMbNBjCbkY6yWXY5REiYBkbHchmIJqkNoJSKgQlPQAc7ACDHNKkTZp7zRc+v8fdOO9MiUXqrTQbj1Er8SfJtWgKkQ6yPaBk8AkLNEyCj4bAooPZM26jGhfPMGJSjV4JkxohQsqCCFo6D/HyOi1cYqEH9LAe/GCa+Qy38LiPBS1GaCCMBcVAyiyMTkAVLuJxCqFUSar/Uk5XEDbSzYkcDWlpXmAbs6bq7YylnDXvyMCR1r7Wfh5nsr/I21kg6nD6P7eAAhaM3AfhONn+JGl/GObQdc+jg5sb2XFpmPGzdwLDDExm4eqLGWqD07ksRE/kMOhksSfQwTSwm6QOBktYZXcl0aWJ6PIAjFAARnkL7NDg8u8S4Q2IhAXDsAzCk86iolefvR+nHP5Cd3v4yI3fXne+Uq8nG0IiKodxDupxthkX4tTR3FGn/mHpo5oUXfLKEnN8av/TFr3y9ZrHS38H8Fi1Ewxghqg0iFAPwt8gW5NZ5UhfyOXmvXd6+JP2K3v4M81nmz7oCsFXQKFRn7nUNnj0E+6DK7WbV5tbUVfF49Tq5evm6UxX1wKjVw9eH+oaOM2rKzaDYVJ9W8P+Nl2n/3jLYb36zDmwMXuOt5zo1kGIH6d3LuAwFGW5qPXxypSacfj9OL2XcNkZVL4fvtVAVP2sa6jiMH0GzsVkjP4mGWaBbnQENGd5NLCbq/JzzJxp28WbD0+BFqibJ1zpPOlrHH48CrIgWCTsgSi5dAw8mpZjzT09Opg//0ucRbBojMVEnPsoiRwM48hNCBnUE8RCr1PM4F7NO3Pjl41tTe38gVHN9a4PL93nHrRnZPHKgLzLO5FTTtfCx/JaLRhYiAnaZ2CV1cT0JU+MoFDVSp+iEYzqUy8SrkMPo+69e2Dg7jfciV+VFdfsstdV82a8xpDgZ3CN2X1438Uu3WjWBeOKdEfGm/oGVn3n4F0GI1ll4Q+StBJJ9oKowXljy4kEG4Ah4xowzvsNGtCMDJHHpAeD9o/nIPwfI305qYveRO2MVQVXh/TKalzshSQCNRY7rpKSwKC+B19KSZrPT2ati9uC04XUwnO3H14E7b/4gCrwTEOIXYHdTDOb0X1r2w0OMkfJaXsVppnu4zTzendmEd/gZ9RjHZ8xGMUqcQfpfCaEYRhE1JeT7jPU7S86Pw8+Rj30p/dOfw0019m5q66TV7f3gp7I4a+uaarmlqWIyf/DGuoaY5AjWG3vkIt097HqCEzg10TDP8CtiZ9qiL7qO0UYz8SxZTHMGLsR+5g6X71vu25Jwxfe21xfn7+5lz8KMqahsvLdSs5b2nRqt7/Nv4+/DHuZp2z3Y2Y2cagGFMYn0pJy1VEwolH6VN0rPZA6gugbkZh0ylS91bSYKyzo7u9oObn7AH+LuEOCa4lXdb633/Dq4i9nPxkZ6v31Ob2fVRdUmRggJgm4BkKlr8pps/RMLn0YBJzPYlqAJbc5R2IZnMM+CrQxpRU/f2tVRfmeCs6NYcy7x96vO8aND3Y+vMArKw9N5BzCwg74WSMLh9r+3ha41zHp/4v7Q+D91u9aA3/eHzoeBoYfNU1WQn/4BKv5L7msPLcAAAB4nGNgZuJmnMDAysDAkAaEDOg0IxwwYAMOIIJZ4b8FiGQ4gakAADCfBZoAAHicY2BgYGaAYBkGRiDJwOgD5IFYWxhYGGYAaSUGBSCLCUjqMRgxuDB4MfgyBDMkMiQzpDLkMBQwFDGUMlT+//v/P1AtSI0hhpo8oJoSiJr/D/9f+X/p/8H/e/7v+r/1/4r/y/8v+7/g//z/8/7P/T8LajMhMFjdxcDIxsDAQ0gNCo8JGPYsGGpYwSTQMHYwgwNFkpOBi4EbwuRh4OXjZxBgEBQCcoSJcSHtAQDLD1rQeJxjYGRgYADijRvW74rnt/nKwMD8AijCcJpxFwOM/h/1X40lk/k8kMvOwAQSBQBiwAwpAHicY2BkYGBW+G8BJLv/R/07ymTHABRBASIAgYQFWwAAeJxjFGNgYIRiJh0ofgqhmbuBdAcQ20HFgTQjM5BOBuJACM3YCsRFUDF2BgYA5QcGBQAAAAAAUAAAFAAAeJylkU9qwkAYxd/4D9pCl92Vzr4oRuhGSqEioqIh2OCiGwnJRANxRmIieIYuuusxuukpeoqeoTfoS51uXdjAfPObN+97w0wAXOIdAofvhuPAAtdcHbiCOu4tV9HEo+UaPdpyHRd4sdyg/kanqJ1x9YAPywJdfFuu4FzcWq7iWdxZrqErXi3XcSU+LTeof7lGhmazz5LlKpeJjk22DvLEaBmbQketoUp3Kk/CwFWFmvhPedTsRaN84cTbhTMz60CPPRUFqfT6g87Qn07k0Y6jm3OVbcuTnVb7qA8uDCRC1g32yJBgiRVyagkfL6aeYY2ASkLW1EutIEVoYQiFFDvWcj+kzyUXHBP4eKIa8Yf0WEfkBRx2b3/nGVPKXI0xPPojcsp0D30M0GGyjylT5D/OOL1zTk9G/ruzw7u2T8/7AVQKiesAeJxjYGYAg//NDGYMWAAAKJgBvAA=) format("woff"),
url(data:font/truetype;charset=utf-8;base64,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) format("otf");
}

@font-face {
	font-family: HelveticaNeueLTStd-Bd_1fn_1;
	src: url(data:application/font-woff;charset=utf-8;base64,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) format("woff"),
url(data:font/truetype;charset=utf-8;base64,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) format("otf");
}

@font-face {
	font-family: HelveticaNeueLTStd-BlkCn_1fr_1;
	src: url(data:application/font-woff;charset=utf-8;base64,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) format("woff"),
url(data:font/truetype;charset=utf-8;base64,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) format("otf");
}

@font-face {
	font-family: HelveticaNeueLTStd-It_1fo_1;
	src: url(data:application/font-woff;charset=utf-8;base64,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) format("woff"),
url(data:font/truetype;charset=utf-8;base64,T1RUTwAJAIAAAwAQQ0ZGICcKOZUAAAdsAAAOTE9TLzIJsQfRAAAAnAAAAGBjbWFwPScedQAAAPwAAAJSaGVhZPjDt8sAAANQAAAANmhoZWEEuAGgAAADiAAAACRobXR4clQAAAAAA6wAAADmbWF4cAA6UAAAAASUAAAABm5hbWVeLKgxAAAEnAAAAq9wb3N0/4YANgAAB0wAAAAgAAMCAAGQAAUAAABmAGYAAAAAAGYAZgAAAAAAZgBmAAABAQEBAQEBAQEBAAAAAAAAAAAAAAAAAAAAAAAAAAAAQAAAAAADIP84AAADIADIAAAAAAAAAAAAAAAAAAAAAAAAAAAAAwAAAAMAAAAcAAEAAAAAAUwAAwABAAAAtAAEAJgAAAAiACAABAACACAAKgA1ADkAPwBBAEMARgBJAFAAUwBXAFkAeSAZ//3//wAAACAAKAAsADkAPwBBAEMARQBIAE0AUwBVAFkAYSAZ//3////h/9v/2v/X/9L/0f/Q/8//zv/L/8n/yP/H/8Df6QADAAEAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAQAmAAAACIAIAAEAAIAIAAqADUAOQA/AEEAQwBGAEkAUABTAFcAWQB5IBn//f//AAAAIAAoACwAOQA/AEEAQwBFAEgATQBTAFUAWQBhIBn//f///+H/2//a/9f/0v/R/9D/z//O/8v/yf/I/8f/wN/pAAMAAQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAEGAAAsAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAEAAAAAAAAAAwQFAAYHCAkKCwwNDg8AAAAQAAAAAAARABIAEwAUFQAWFwAAABgZGhsAABwAHR4fACAAAAAAAAAAISIjJCUmJygpKissLS4vMDEyMzQ1Njc4OQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACAAAAAAkAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAQAAAAEAAG+dkyJfDzz1AAAD6AAAAADLAboAAAAAAMsBugD/Wv8qBFIDvQAAAAcAAgAAAAAAAAABAAADIP84AAADZv9a/sgCOwABAAAAAAAAAAAAAAAAAAAAOQIsAAABFgAAAiwAAAEDAAABAwAAAWAAAAEWAAACLAAAARYAAAFNAAACLAAAAiwAAAIsAAACLAAAAiwAAAIsAAACLAAAAiwAAAKbAAACLAAAAiwAAAI+AAACLAAAAQMAAANmAAACLAAAAvcAAAIsAAACLAAAAtIAAAIsAAACLAAAAiwAAAIHAAACUQAAAhkAAAJRAAACGQAAASgAAAI+AAACLAAAAN4AAAIsAAAB4QAAAN4AAANUAAACLAAAAj4AAAJRAAACUQAAAU0AAAHhAAABOwAAAiwAAAHhAAAC9wAAAeEAAAAAAAAAAFAAADoAAAAAAA4ArgABAAAAAAAAAB8AAAABAAAAAAABABsAHwABAAAAAAACAAUAOgABAAAAAAADACsAPwABAAAAAAAEABsAagABAAAAAAAFAAsAhQABAAAAAAAGABsAkAADAAEECQAAAD4AqwADAAEECQABADYA6QADAAEECQACAAoBHwADAAEECQADAFYBKQADAAEECQAEADYBfwADAAEECQAFABYBtQADAAEECQAGADYBy05vIGNvcHlyaWdodCBpbmZvcm1hdGlvbiBmb3VuZC5IZWx2ZXRpY2FOZXVlTFRTdGQtSXRfMWZvXzFSb21hbkpQZWRhbCBQREYySFRNTCBIZWx2ZXRpY2FOZXVlTFRTdGQtSXRfMWZvXzFIZWx2ZXRpY2FOZXVlTFRTdGQtSXRfMWZvXzFWZXJzaW9uIDEuMEhlbHZldGljYU5ldWVMVFN0ZC1JdF8xZm9fMQBOAG8AIABjAG8AcAB5AHIAaQBnAGgAdAAgAGkAbgBmAG8AcgBtAGEAdABpAG8AbgAgAGYAbwB1AG4AZAAuAEgAZQBsAHYAZQB0AGkAYwBhAE4AZQB1AGUATABUAFMAdABkAC0ASQB0AF8AMQBmAG8AXwAxAFIAbwBtAGEAbgBKAFAAZQBkAGEAbAAgAFAARABGADIASABUAE0ATAAgAEgAZQBsAHYAZQB0AGkAYwBhAE4AZQB1AGUATABUAFMAdABkAC0ASQB0AF8AMQBmAG8AXwAxAEgAZQBsAHYAZQB0AGkAYwBhAE4AZQB1AGUATABUAFMAdABkAC0ASQB0AF8AMQBmAG8AXwAxAFYAZQByAHMAaQBvAG4AIAAxAC4AMABIAGUAbAB2AGUAdABpAGMAYQBOAGUAdQBlAEwAVABTAHQAZAAtAEkAdABfADEAZgBvAF8AMQAAAwAAAAAAAP+DADYAAAAAAAAAAAAAAAAAAAAAAAAAAAEABAIAAQEBHEhlbHZldGljYU5ldWVMVFN0ZC1JdF8xZm9fMQABAQEi+BsB+BgEfwwC+zr7avrm+lEF9+QP+A8RpxwOMBL4HAwVAAIBAfL/Q29weXJpZ2h0IDE5ODgsIDE5OTAsIDE5OTMsIDIwMDIgQWRvYmUgU3lzdGVtcyBJbmNvcnBvcmF0ZWQuIEFsbCBSaWdodHMgUmVzZXJ2ZWQuIEhlbHZldGljYSBpcyBhIHRyYWRlbWFyayBvZiBIZWlkZWxiZXJnZXIgRHJ1Y2ttYXNjaGluZW4gQUcsIGV4Y2x1c2l2ZWx5IGxpY2Vuc2VkIHRocm91Z2ggTGlub3R5cGUgTGlicmFyeSBHbWJILCBhbmQgbWF5IGJlIHJlZ2lzdGVyZWQgaW4gY2VydGFpbiBqdXJpc2RpY3Rpb25zLi9GU1R5cGUgNCBkZWYAAAEAAQAACAMADQkAGgAAIAAAIgAAJAAAJgEAKQEALgMANAAANgIAOgAAQhgAOgIAAQACAAUABgA/AHkApwDMAM0A5AD9AUYBcAHEAjACbALJAz8DQAN+A38DgAOtA64DxgQNBA4EXwRgBGEEqwSsBK0ErgVABZ4F5gZBBpoG4wdjB7IH2QfaCBMIKwipCPkJPwmdCfsKRQqoCvgLRAtvC7oL8Qw9DvvKDg773ftFdvo1dwGu4AP3QPtaFWb2fPcE9wUa93rt91b3JfdBHkUG+yf7OvsD+zz7dxr7CK37J7oiHg773ftFdvo1dwH3EuADXPtaFfcn9zn3A/c893ca9wpp9yNc9wAeUwawIJr7BfsFGvt6KvtW+yb7QB4O+4D5XncB1vezA/ek+V4VVQZ1Iiu8cl3qWz43sGbZ4rokvKJa7/aZhrv7AoAFDvvKi/cDAXv3OgOaFsMGf15/XVaDgVsY9yCXi/capfcECPsDBg4O+8qL9wMBmvcbA5oW9wMGo/cDBfsDBg77k492+YB3AXn4BQN5ehXUBve8+YAFQgYOa3/W+M/WAaTl99XlA6T3mxX7Lbr7Dvcp937S99f3FvdSSNn7EPtyM/uy+zQe5X0V78b3sfcu9w59+x48TFv7t/syN2zU9wUeDmugdvibzwH3EPfJA/hF+VkVSQY6YSViNht9RwXMwpCayh/7B/yvBeUGDmuL1vjD1gHP5fem5QP3MvhoFeSQwtjqG9S5XkFFY2JXZB/7ICL7UV56+2sI+FgGm9YF/AUGnb7BtrenCPcN2PdU1PdBGvcKNtL7BvssMyz7JnweDmt/1velz/d61hKM5Xfl93nlVOUT8vdq9+QVE/Th5YL7ACtGTyz7BHHa2I4fMQb7M4jhQ/cgG/dE2/cd7cl0wkapHxPqy57Kx94a9ww7xPsR+ytEJfsJeh7lBu2XwLnaG8XJfDj7DiF9MY8fDmugdvc61gGH+JED+Bf4xhWNBkj71QX7eAb3RfuFFeAGr/c6BekGmtYFLQbt+GgFQwb8OPxfejcF98sGDmt/1vfd1vcv1gGS5ffA5QP4n/lNFfv7BvsC/AoF1wa2o7+lvRvmvVcwJU43+wM1YbjdHzEG+xTfQfcV1Meeu8Eewb6l1NUa9w1D6PsTX1x/cGkeiY3D91QF97cGDmt/1vdE1vfU1hKP5WPl97HlE+z3pvfOFTZew9zgve3t57hSMy1VOiYfE/T7ovslFfsOidlQ9wob9yHP1vcNwB+w4KH3Aega9yJH6/sqHhPs+yoq+wr7JPsH3C73CsXMoLysH42JBSNrXPsg+xsbE/RFarLOHw4O2qB292vb9+Pfi3cSVPkrE9gT6Pgu+QoVjQbA++MF+4oG+6b7uxX1BvcR92sF98EGrPtrBe0G+xX5XgUjBg4ODn2gdvfb2/d32wGS+P8DkhbqBs/32wX33gac2wX73ga693cF+AsGnNsF/GoGDg773aB2+V53AZL3iQOSFuoG9yr5XgUsBg73rovvPHb5BeQSkvn0E3CSFuYG9xH5BQWNBuj9BQXmBvgA+QUFjQb7Jv0FBeYG9yv5XgX7GAYTsPv1/PoFiQYs+PoF+xgGDg73P3rb+ODbAbHq+IjqA7H3vBX7WfcD+wj3V/eC9yb3ZPd090X7Bfcf+037iPso+2D7ex7qFvdA7fdL91v3GNIj+xj7Pif7SvtR+yNH6vceHg4ODvcaetv5H3cBxOYD+Wz5XhUsBjH8QAX7Gm9pMvswG/seTND3Hqsf6fhQBSwGMvw4BftbYub7BPdlG/cN9wG79wq7H5enl8GXwggODg4ORn/W+BvWAYHg98bgA9b3GxXNwZ7IlB7Jk86QsKEIjQZ/W4Zdb2QIXW1adUkbW16jux/K93YVzpXLpcwbuMZ/U0ZjhjGDH/sGgfsngfsqGiHTY+Hivaa7rx6NiQVehqRvuhuao5CSmB+YygWIg4CHgxt9gJOjo5Woj6AfrPchBZGnlbCoGvQypif7AipW+wd6Hg6Qf9Zhdvha1vdNdxL4WuATuPha98YVJkr7IvsPN1K73PcCyfcs9ynaskk5HhN4/F/7xhXXBp7rBY0GE7hYls9S6hv3Q+33Mfc19xhK5vseTFJuWmUfiY3C95kFNgYOWH/W+BvWAaDg98rgA/iJ9/UV9wyHQsP7CRv7TSb7Lvs4+x/TN/ch9wvizfcHqR82BkxzVWBCGyxqz9v3BdH3FvcXzbZlTB8OkH/WTMr4G9b3TXcSnOATuPH3XBX3BtH3IPcb37lSPvsAQvsp+xUuY8DfHviM+JYVNwZU+6gFiQbQdz2hTBv7SSH7QPsx+xLSNfcY0L6ezr4fjQYTeHlBBdsGDlh/1vc+1vcm1gGV4PfP4AP3AvfIFdukwc3vG+msQkKFH9hAFY6ZkKWmGvcmSN77LPsi+xD7G/taMbv7Cvc/9wXpx/cGph42BktzWGhBG0ZKuNuajJqNmh8O+7igdvhO1vcW1oN3EqL38RPoohbgBur4TgXvBpnWBSgGyp+GzuAbmJmJiJgfE9iZ0wUT6JF0c41zG/schycicB8zBnxABeMGDn37Ztb3F9b4E9Z/dxJ14GHgE+T192YV6sv3KfcL5LZVOiNP+yT7FDZhzNUeE9T4UvfHFTsGeywFiY0GE+TMfEGzQBv7PCb7Ovst+w/NMPcUzMajwrAfjYkFJHBxIvsYGxPoSk+b0IYfNgb7B47tXvQb9wLctPK3H5qvmL+XwAgOa6B2+FrW9013Afgz4AOGFuAGx/eylrSbtKmlGa2rvKW6G72zdFp5g2CHeB9J+8IF4AbK97sFlLORsqEa5ly1KkRFa1FgHomNyPelBTYGDvwCoHb4mXf3BfMBhvd/A4YW4Ab3APiZBTYG9xP3WRU1BnUjBeEGDg4goHb3vHb3hnf3bXcBhvibA4YW4Aay90zx5vD7pwXqBvsU99r3dfdTBfsDBvuY+3WJjeT4OAU3Bg78AqB2+V53AYb3fwOGFuAG9yr5XgU2Bg73nKB2+FrWf3cS+V3gE9CGFuAGxfejlr6Tqq+uGa2pvau6G7mlcmB/hGSCYx9N+7sF4AbE95+Ut5a1p6kZsKjArbsbuK1tY3yHcod7H0P73AXgBsz3ygWSqJO3qRrfRKtCRkdlVGMeznxZpUobREpmVV8fiY0FE7Ce2AU8Bg5roHb4WtZ/dxL4M+AT0IYW4AbH97KWtJu0qaUZrau8pbobvbN0WnmDYId4H0n7wgXgBsr3uwWUs5GyoRrmXLUqREVrUWAeiQYTsJvZBTkGDn1/1vgb1gGc4Pfi4APx92EV9s/3IvcW6LZKOiVH+yP7EC5axOAeNooV+xHdMPcc90n09zL3PfcePtf7HvtJ+wD7MPs9Hg6Q+0V2907W+BvKTNYS+FvgE9j4W/fRFfsGRfsg+xs3XcTY9wDU9yn3FeizVjce/Iz8lxXfBsL3qQWNBkaf2XXKG/dJ9fdA9zH3EkTh+xhGWHhIWB+JBhPondUFOwYOkPtFdvdO1vgb1n93EpzgE+gT2PjF+JkVNQYT6Ho5BYkG0m9Moj8b+z8m+zL7M/sVyiz3G8vGqLyzH40GU/ucBeEG+8j4LhX20fcb9xLevVo9+wJO+y77HC1lz9weDvuToHb4S+V/dxKG+BMT0IYW4Aa893mTspe8oqwZprSvqrqXCJCflYugG5OUi4qTH5/mBY2BgYmBGzROV0RjH4kGE7Ck9wMFOwYOIH/W+BvWEoLgdOD3UOBT4BPYE9T4TPgBFfcNKLYrKytWKz3PaNBwHhPoz2/Pd1kaUEx3VERKotiPHjYG+xiK52D3Chvv9wO49wfcRq9Hpx8T1EenR567Gr/Fmb/Gv21Qhx4O+6WF1vgJ1gG65gP3kfkyFTYGa/stBTQGe0AF4gZH+9UFiHuJf3waScB5yp+fjY+fHprZBYZ7e4d6G3Fyk6aXjZWMlx/L98QF8gab1gUkBg5rf9ZhdviZdxKa4BOw+Jz4mRU2Bk/7sgU1eUI5LRtZY6K8nZO2j54fzffCBTYGTPu7BYJjhWR1GjC6YezS0avFth6NBhNwez0F3QYOIIviSXb4mXcStfhYE3D4gviZFS8GE7D7dPxCBYkGX/hCBTEG1fyZBeYGDvc/i/U2dvgm9weLdxK0+WUTWPmO+JkVLwYTmPtY/C8FiQZy+C8FKwb7TvwvBYkGa/gvBTEGyPyZBeUGE2j3TfgmBY0GpfwmBeUGDiCgdve7dveHdwFJ+MQDSRbyBvdE92jp+2gF7Ab7GPef93L3jgUkBvsu+1A991AFKQb3B/uHBQ4g+2bPaXb3bnb4mXcSTPjME7j4jfiZFS4G+238LwWJBk/4LwUwBub8mVc1BWp3dXRlG3x2kZN+HxN4fEYFE7iDm6KGnxviscLOtR8Oepz5Xpz7apcG96WS75L86ZcH1grgC/jAFPjgFQ==) format("otf");
}

@font-face {
	font-family: HelveticaNeueLTStd-Roman_1fp_1;
	src: url(data:application/font-woff;charset=utf-8;base64,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) format("woff"),
url(data:font/truetype;charset=utf-8;base64,T1RUTwAJAIAAAwAQQ0ZGIFu9WDcAAAfgAAAROU9TLzIJsQfzAAAAnAAAAGBjbWFw5aZXGAAAAPwAAAJSaGVhZPilt8YAAANQAAAANmhoZWEFlAIqAAADiAAAACRobXR4pn0AAAAAA6wAAAE4bWF4cABOUAAAAATkAAAABm5hbWVCbjZeAAAE7AAAAtNwb3N0/4YANgAAB8AAAAAgAAMCIgGQAAUAAABmAGYAAAAAAGYAZgAAAAAAZgBmAAABAQEBAQEBAQEBAAAAAAAAAAAAAAAAAAAAAAAAAAAAQAAAAAADIP84AAADIADIAAAAAAAAAAAAAAAAAAAAAAAAAAAAAwAAAAMAAAAcAAEAAAAAAUwAAwABAAAAtAAEAJgAAAAgACAABAAAACAAJAApADsAPQBKAFcAWgB5ANcgFCAZIB0gIv/9//8AAAAgACQAKAAsAD0AQQBMAFkAYQDXIBMgGSAcICL//f///+H/3v/c/9r/2f/W/9X/1P/O/3YAAN/qAADgKAADAAEAAAAAAAAAAAAAAAAAAAAAAAAAAAAMAAAADAAAAAAAAABJAEwASABLAAQAmAAAACAAIAAEAAAAIAAkACkAOwA9AEoAVwBaAHkA1yAUIBkgHSAi//3//wAAACAAJAAoACwAPQBBAEwAWQBhANcgEyAZIBwgIv/9////4f/e/9z/2v/Z/9b/1f/U/87/dgAA3+oAAOAoAAMAAQAAAAAAAAAAAAAAAAAAAAAAAAAAAAwAAAAMAAAAAAAAAEkATABIAEsAAAEGAAA6AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAEAAAACAAAABAUAAAYHCAkKCwwNDg8QERITFBUAFgAAABcYGRobHB0eHyAAISIjJCUmJygpKissAC0uAAAAAAAALzAxMjM0NTY3ODk6Ozw9Pj9AQUJDREVGRwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAABKAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAASUxISwADAAAAAAkAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAQAAAAEAAIK/wgVfDzz1AAAD6AAAAADLAboAAAAAAMsBugD/Wv8qBDQDuAAAAAcAAgAAAAAAAAABAAADIP84AAAD6P9a/rsDFwABAAAAAAAAAAAAAAAAAAAATgIsAAABFgAAAiwAAAIsAAABAwAAAQMAAAEWAAABhQAAARYAAAFNAAACLAAAAiwAAAIsAAACLAAAAiwAAAIsAAACLAAAAiwAAAIsAAACLAAAAiwAAAIsAAACWAAAAogAAAKtAAAC0gAAAsAAAAJjAAACPgAAAvcAAAIsAAABAwAAAgcAAAIsAAADZwAAAtIAAAL4AAACiAAAAiwAAAKtAAACiAAAAj4AAAIsAAACLAAAAiwAAAIsAAACYwAAAhkAAAJRAAACGQAAAlEAAAIZAAABKAAAAj4AAAIsAAAA3gAAAiwAAAIsAAAA3gAAA1UAAAIsAAACPgAAAlEAAAIsAAABTQAAAfQAAAE7AAACLAAAAfQAAAL2AAACBgAAAfQAAAIsAAACLAAAAiwAAAIsAAAD6AAAAlgAAAAAUAAATgAAAAAADgCuAAEAAAAAAAAAHwAAAAEAAAAAAAEAHgAfAAEAAAAAAAIABQA9AAEAAAAAAAMALgBCAAEAAAAAAAQAHgBwAAEAAAAAAAUACwCOAAEAAAAAAAYAHgCZAAMAAQQJAAAAPgC3AAMAAQQJAAEAPAD1AAMAAQQJAAIACgExAAMAAQQJAAMAXAE7AAMAAQQJAAQAPAGXAAMAAQQJAAUAFgHTAAMAAQQJAAYAPAHpTm8gY29weXJpZ2h0IGluZm9ybWF0aW9uIGZvdW5kLkhlbHZldGljYU5ldWVMVFN0ZC1Sb21hbl8xZnBfMVJvbWFuSlBlZGFsIFBERjJIVE1MIEhlbHZldGljYU5ldWVMVFN0ZC1Sb21hbl8xZnBfMUhlbHZldGljYU5ldWVMVFN0ZC1Sb21hbl8xZnBfMVZlcnNpb24gMS4wSGVsdmV0aWNhTmV1ZUxUU3RkLVJvbWFuXzFmcF8xAE4AbwAgAGMAbwBwAHkAcgBpAGcAaAB0ACAAaQBuAGYAbwByAG0AYQB0AGkAbwBuACAAZgBvAHUAbgBkAC4ASABlAGwAdgBlAHQAaQBjAGEATgBlAHUAZQBMAFQAUwB0AGQALQBSAG8AbQBhAG4AXwAxAGYAcABfADEAUgBvAG0AYQBuAEoAUABlAGQAYQBsACAAUABEAEYAMgBIAFQATQBMACAASABlAGwAdgBlAHQAaQBjAGEATgBlAHUAZQBMAFQAUwB0AGQALQBSAG8AbQBhAG4AXwAxAGYAcABfADEASABlAGwAdgBlAHQAaQBjAGEATgBlAHUAZQBMAFQAUwB0AGQALQBSAG8AbQBhAG4AXwAxAGYAcABfADEAVgBlAHIAcwBpAG8AbgAgADEALgAwAEgAZQBsAHYAZQB0AGkAYwBhAE4AZQB1AGUATABUAFMAdABkAC0AUgBvAG0AYQBuAF8AMQBmAHAAXwAxAAADAAAAAAAA/4MANgAAAAAAAAAAAAAAAAAAAAAAAAAAAQAEAgABAQEfSGVsdmV0aWNhTmV1ZUxUU3RkLVJvbWFuXzFmcF8xAAEBAR/4GwH4GAT7Ovtq+sj6TAX37A/4GhGnHBEdEvgcDBUAAgIAAQD3AQRDb3B5cmlnaHQgMTk4OCwgMTk5MCwgMTk5MywgMjAwMiAsIDIwMDNBZG9iZSBTeXN0ZW1zIEluY29ycG9yYXRlZC4gQWxsIFJpZ2h0cyBSZXNlcnZlZC4gSGVsdmV0aWNhIGlzIGEgVHJhZGVtYXJrIG9mIEhlaWRlbGJlcmdlciBEcnVja21hc2NoaW5lbiBBRyBleGNsdXNpdmVseSBsaWNlbnNlZCB0aHJvdWdoIExpbm90eXBlIExpYnJhcnkgR21iSCwgYW5kIG1heSBiZSByZWdpc3RlcmVkIGluIGNlcnRhaW4ganVyaXNkaWN0aW9ucy4vRlNUeXBlIDQgZGVmAAABAAEAAAUAAAgCAA0PAB4AACIJAC0LADoBAEIYAGkAAG8AAHQAAHcAAIkAAKgAAE4CAAEAAgAFAAYABwA/AHcAmQCuAMIA2wEmAUYBlAIIAjgCkgMCAzMDtAQiBCMEJARHBIAE7QVCBX4FogXCBiUGJgY5BmkGagaoBuAHMwdxB3IHzwhECF8IYAhhCGIIYwiICQYJYQmnCgIKWwqXCxELSAtmC2cLaAt7C9MMDAxSDKwMrQzaDT8NbQ2pDdYOHQ5dDqcOqA6pDqoOqw7CDvcO+90ODg778PtFdvo1dwG65QP3oftaFSz3LWb3J/c8Gvc2sPcp6vcqHkoGJfscVPs9+zAa+0PI+yPr+yoeDvvw+0V2+jV3AfcO5QPC+1oV8fccwvc99zAa90NO9yMr9yoeSgbq+y2w+yf7PBr7Nmb7KSz7Kh4O+92L9wMB3vcDA94WxgaNa3xZXnwIWQfYoazH1hrw+wMHDvtu94LbAb33tQO994IV97Xb+7UGDvvdi/cDAd73AwPeFvcD9wP7AwYO+6aPdvmAdwF5+AUDeXoV1Ab3vPmABUIGDlh/1vjP1gG15fe45QO19/AV+zCZ+2D3cvdymfdg9zD3MX33YPty+3J9+2D7MR7ljBX0jPdI9yX3JYz7SCIhivtI+yX7JYr3SPUeDligdviQzwH3o+AD9/j5WRVKBiB4M3EqG0f3TPyQ4AcOWIvW+MPWAbfg96flA/cV+F4V4Ii15u4b1slYPilOX/sMQR8nTTZPffs8CPhj1vwABpzj6LjkwQjjwt/K9xEa9xgp0/sQ+yo2IPskkh4OWH/W96XP93rWEqngReD3mOVP5RPy92734RWNm52MnBvfzlwyNURYOCpYy+eIHzYG+yaI6jb3JBv3GfcD1fci4GHPNZ4fjQcT7MGkt8HJGvcXLsb7D/siQy37G4Ye4AbejLPS6BvTwWNBPkxkQ39/i4x+Hw5YoHb3OtYB9+fbA/g3+VkVRwb71/xhBTn3y/s62/c669YrB/vSFveA9+8FjfvvBg5Yf9b33db3L9YBruD3v+UD+Gr5TRX78gZJ/ATUhwWzrLimwRvqzEgt+wVGVDo2UMLUhh82BvsUju9A9w8b9zne9wj3DPc2JNz7EltWe2hsH4mNsfdgBfeyBg5Yf9b30tb3RtYSseD3t+BF5RP097L4ERXsuUIzN1hCLy5V0ePkv9LqHxP492n3JxX3B4FCzfsJG/teUPtN+1f7Ka37VPdmHxP090fF9xvy9xc67vscPk9vSmMfiY0F9wGPovc09yUbE/jOt2FLkx8OWKB2+P3bAfci6gP4kflNFfxfO/gIBvsp+zL7B/tve/uECOoGmPdy9wj3mPcj9yIIDlh/1vel1oJ295HWErPlSuX3h+VN5RPZ9xb3XBXdzcHf281RPjxPUDYzTL/gHhO1SvfcFUuzUMZzHhO5PG9eSjca+yX0RPcc9xfz2vcd42LJNqYeE7rFpbPFyhrlT+b7Lx4TtfsBKEv7CR8T1uWIFdLDsc/QvWVEQ1lhSEVTr9keDlh/1vdG1vfS1hKt5UDg97bhE/T4LfhsFTdTQzI5UdPZ4rHc8Oq+QDQeE+z7/PvBFfsOluBO9wsb90DV9x33ifeg+wPS+xgfE/T7HSst+x37INsq9yTQyrHHqx+NiQX7S4ZYMCMbE+xHU7LQhR8ODg6E9wrP9xrPAbv4jAP4vPgYFfyMR/iMBvyM+14V+IzP/IwGDrSgdvdr2/fh4Yt3EoT5KxPYhBbtBtv3awX3wgbZ+2sF9Ab7q/leBSIGE+i9NRWNBvcL++EF+4YGDtmL2/eL24R295PbEtnq9+rqSuoT2vdB99sV920G29ZxLj1XWTkf+4IGLDsV9+0G9yLW7/QfE7rjW80znR6NBxO8zaazxNca0Wa+XKcepWA4i0wb+5cG6jsV91IG3dF9KB8T3EBfZPsAHvtSBg73B3rb+ODbAbbq+FXqA/k3+IcV9yx1+w/b+ykb+3D7Cvs9+2P7ZPcA+zj3cvdI9wP3APdGnR8sBvsKgkMz+xEb+z9D9xz3N/cp0/cg9z7u3Fgmnx8O7Ivb+L7bAdnq+CLqA9kW94kG94L09xv3g/d6+w/3AvtwH/uJBuo7Ffc0BvdDyiT7Pvub+0N5Sh/7MgYOj4vb94vb93fbAdnqA9kW+ITb/CX3i/gH2/wH93f4Itv8gQYOaqB299vb93fbAdnqA9kW6vfb99zb+9z3d/gK2/xpBg73LHrbYXb3vNv3p9sStur4buATvBN8+REWx/gM+80793gGE7z7FpEzJPsnG/szNfcc9yn3LdP3KvdB9eJa+wCeH+oG9ztw+xDR+zAb+3b7BvtI+2T7TvcT+0L3ad/lqtbCHw4O+/CgdvledwHd6gPdFur5XiwGDjN62/kfdwGh6vd56gP4TfleFSz8ngY8cFk0LnXG3h6pLF8H+xrWQfcZ9zS+7eweDg73nIv3Bi52+Ob3DBLb5fin5RN42xbl+OaNBvdz/OYF3Ab3c/jmBY385uX5XvsWBhO4+3b87Pt1+OwF+xYGDvcHi/cb+wZ2+NH3IYt3Etjl+BnlE1zYFuUGE2z40Y0H+An80QXz+V4xBhOc/NeJB/wM+NcFJgYO9y162/jg2wGx6viC6gOx9/kV+1b3B/tI93f3d/cH90j3VvdW+wf3SPt3+3f7B/tI+1Ye6hb3JNT3KvdC90LU+yr7JPskQvsq+0L7QkL3KvckHg60oHb3uNv3mtsB2er36uoD2Rbq97j3bgb3IorY2/cYGvcYPtr7Ih77zQbqOxX3Tgb2vF02NlpcIIwf+04GDg7ZoHb3xdv3jdsB2er3/+oD90H4FRX3jfeAB+SxV0UjP3QyH/u5/BUV6vfF93wG55xQRZUfmUV8PqZuCPUGY7yP2YXRhNF6yDibCI0H4aOx0uEa9wY41PsaHvvkBg60etv44NsSsOVH6vfl5UrqE9QT2PjZ+I0V9zGF+wPQ+yYb+xb7FUv7JfsX9wdq9wZyHxPk9wZy9wZ6KRokLHA1+wAnv/cMHjEG+0L3Gz33NPcW9ynI9yz3IPsGs/sGpR4T2PsHpfsGmOMa6Nuo2+3PXyWWHg5qoHb5DtsB94TqA/eEFur5DveC2/zPO/eCBg4ODg4Oj4vb+L7bAaH4zAOhFvjM2/xbBvhP+L4F2/yeO/guB/xQ/L4FDkV/1vgb1hKv5UXg94fgE+j4FPdIFVxdRfsEV1ufw8q7n8OVHsSVy4ysowj3HvtbFYeAg4qEG3CLnbMf954H9w0moC4eE9j7Byhe+xSGH+AG14/AodMbwch/QUs7kS15HxPoM3o0cvsJGiTYYenTyqTCuh5Tp3O3pp6QlJoeDn1/1kzK+BvW9013Es7g98/lE7z4Z/ebFSZkKPsI+wld6fHst+33BvcCvS0qHhN8/CT7mxXgBhO80I0HTrHXd8Ab9zLZ9w/3JvcmPPcS+zNESXJSbx+J9582Bg5Ff9b4G9YBr+UD+Iv38xX3D38twvsJG/s4O/sO+y/7Lt/7Avcy9xba1vcSnh80Bj2AWls5G/sAYOnq9LHs9w/RuGVKmB8OfX/WTMr4G9b3TXcSr+X3z+ATvPii+V4VNvueiQbIZT+fVhv7Mj37D/sm+yba+xL3M9LNpMSnH40GE3xF4AcTvPwk95IV8LLu9wj3CbktJSpfKfsG+wJZ6eweDkV/1vc+1vcm1gGv5fe95QP4Ofc4FUh8WmlFG/sFWNvljh/4Fwb3EZBT9z/7Sxv7ISX7BvsvH/sykNn7Bvc5G/cI3cn3BqIf/A/3JBXakcDO5BvfyEo6jx8O+8ugdvhO1vcW1oN3Eu7gE+juFuD4Tu/WJ9MGuKOYtJqdiYaaHhPY1QcT6JB7dI57Gy5ZXzcfPjRA4gcOavtmz/cc1vgVykzWEq/lReD3tdsT2vek0BX7BGnz6O635PcB9rMtMCphJPsEHxPq94L4VBU7BhPaQYoHxGxRqEob+0dP+yv7Dvsh2PsN9y7Mz6rKpx+NaQb7CF87+wMeE9ZTQaHJhx82BvsFkPcEZOwb9zfY4fc8Hw5YoHb4Wtb3TXcBy+D3luADyxbg97gG6L3Q8syzYkwe+/Lg9+gH9wNh2fscTUJxTW8eifelNgYO/BWgdviZd/cF8wHQ4APQFuD4mTYG4PdZFTYj4AYODg78FaB2+V53AdDgA9AW4PleNgYO94qgdvhaykzWEsvg93/g93/gFBwTvMsW4PfWBrKw6PDXoFtIHvvn4PfWB9vAv93enFhLHvvn4PgPB/ZGtiRJTmpUaB7KdlGkTBtEUW1RZR+JBhPc1zsHDligdvha1n93Esvg95bgE9jLFuD3uAbovdDyzLNiTB778uD36Af3A2HZ+xxBUW1LZx6JBhO43TsHDmp/1vgb1gGv5ffW5QOv95YV+yvi+wv3OPc44vcL9yv3LDT3C/s4+zg0+wv7LB7lFvcS09Hk5NNF+xL7EUNFMjJD0fcRHg59+0V2907W+BvKTNYSzuD3z+UT3Phn95sVJmQo+wj7CV3p8ey37fcG9wK9LSoe/CT8YRXg95+NBk6x13fAG/cy2fcP9yb3Jjz3EvszRElyUm8fiQYT7NE2Bw4O+6agdvhL5X93EsjgE9DIFuD3egb3F73Z9x0e5QcvjlJiYjgIiQYTsPcBOwcOIH/W+BvWEqrgQeX3euBI5RPUE+Sq9zcV+xSQ7Vz3CBv09wez9w/vN6c2nh8T2DyeMZXIGr/Gmb7DxXZJkR7gBvcShDCv+wYbMSRgIyjgb994HxPk4HjfgEkaSkN/VkVJo9eIHg77uIvW+APWAezgA/dK+TQVNvsvM0Dj+90GLK554x7M1mQGVoCSsh/31fLWJAcOWH/WYXb4mXcSy+D3luATuPiA+JkVNvu4Bi5ZRiRKY7TKHvfyNvvoB/sDtT33HNXFqcuvHo0GE3g52wcOIIvhSnb4mXcSmfhsE3D4eviZFTIGE7D7IfxDBYkG+yX4QwUsBvdU/JkF5gYO9yuL6ffR9Yt3Epz5aBOw+Xn4mRUzBvsI/DsFiQb7APg7BS4GI/w7BYkG+wn4OwUtBvc6/JkF5wYT0PP4LwWNBvT8LwXlBg4yoHb3uXandveCdxKU+IgTuJQW8gb3JPdq9yT7agX3AQb7XPer90b3ggUlBvsV+0n7EPdJBfsBBhPY90j7iQUOIPtj1l52+V93EpP4eBOw+ID4mRUxBvsl/DsFiQb7K/g7BSsG92H8lmgzBW17eHpoG3p6kpB7HxNwPQcTsISen4mfG9eusPCyHw4ODg4O+B33gtsB9xb5eAP3FveCFfl42/14Bg6Eo/heAdL4XwP3C6MV90r3SvdJ+0q7u/tJ90r3SPdIW7v7SPtI+0n3SFtb90n7SPtK+0oFDnqc+V6c+2qXBvelku+S/OmXB9YK4Av4wBT48xU=) format("otf");
}

@font-face {
	font-family: ITCFranklinGothicStd-Demi_1fq_1;
	src: url(data:application/font-woff;charset=utf-8;base64,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) format("woff"),
url(data:font/truetype;charset=utf-8;base64,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) format("otf");
}

@font-face {
	font-family: OCRAStd_1fm_1;
	src: url(data:application/font-woff;charset=utf-8;base64,d09GRk9UVE8AAAU8AAkAAAAAB6wAAQABAAAAAAAAAAAAAAAAAAAAAAAAAABDRkYgAAAA4AAAAjsAAAJ9m4iDoE9TLzIAAAMcAAAAKgAAAGAJsQihY21hcAAAA0gAAABVAAABkgMqBeRoZWFkAAADoAAAADMAAAA29+e3LGhoZWEAAAPUAAAAIAAAACQCtAJ4aG10eAAAA/QAAAAMAAAADgLQAABtYXhwAAAEAAAAAAYAAAAGAAZQAG5hbWUAAAQIAAABHgAAAgdQanD9cG9zdAAABSgAAAATAAAAIP+GADZ4nFWPTWgTURSF3yTNG2xjpOIoJGXe7LKRmnRVs7GlUBAFxQTETWJ1Jv2x6SQz00gs/aF1URlII4hYF7ZNMqkRbRC0yogb7UpduJqFK3ddNDLL94aXghOVBuHexT3c+51zGdDlAQzDBK6MXBuOa2Iqms6kom0FkRBDznQdinSlz7fpfPXh8Akc7X1L9k+SPj8HPAwzGh+RswVlcnxCE6LnBwfPCgORyIAwLMq3JCFeUDUpowoXZ27LSlZWxjRJ7BeGp6eFPweqoEiqpORd8dxoPFHISsKgIEppABjQ6wGnAQgCAN1swAOGwCrYZ24wtYAj6jaxbAb7bGzaXjzpPOMSyWQCtSw2vpva47EJ93bffUbEYj8l3yd4ah7GOGJh013oXH+xm7aX9NucE6M6m1Pnx8cr8wbC4ZZFw/BoJjw0KusNhEvs84XNdHohP8PT5F8OXmlXJwje5/AOfFkulato2yjWGkE8xjZWa7LBlxWtNBWiPztg3KQr9BUckqQhRH+Qq2zbpqGu5xBtwv/wEza+7uK/OTEOP4CdtV+tS/iDC5mDc9r6w3mUeeIrLS0XF0O5WTU3UV+uLaLX93xL1af3jRBWYMNYq1fRZrW49SKIp9id1Uo7l6qW7oTo5X+Olo0jRw+RNZubyd/NZDe0OvoI6xvlGnJirDFbkfkWD2XXBdFHbG5L3eZxE1LT5nAEmzTCBnSdNPTvOub0NzqkN3WW7/Y+vuA/pvt7DroPeg7W/H63jzviqd8zRSl4AHicY2BmusA4gYGVgYEhDQgZ0GlGOGDABhxABLPCfwsQyXACUwEAeDAGXwAAeJxjYGBgZoBgGQZGBhDoAfJArBAGFgYLIM3FwMHABIRGDKYMlv///v8PFDOAsf9f/H/+/xmoDhggVx8DIxsDqgARgJGJGWQjAwMriRoHKQAAcGofAQAAAHicY2BkYGAA4o0b1u+K57f5ysDA/AIownCacRcDjP5r8F+QdQGzOZDLzsAEEgUAWugLiAB4nGNgZGBgVvhvwcDAdOGvAUMeUxIDUAQFMAIAadMEL3icY7rAgAQACroA0wAAUAAABgAAeJx1kM1qwkAUhc9oIrSl7a4LoTTbQgnGZRctooiIPyGKmy5CMIkOmBmJceFLFXyOrvs+PSHTRRYJJPnud89cZgbAA74hUD0vfCsWuGdVcQs23gy38QzPsMXMwrCNO3wZ7tCnTArrhtUHToYFurgabuEWP4bbeMevYQtd8WjYxpN4Ndyh/1xoZ6uPl1zu9oUjVarzLCqkVk6qzyp2l8NgsCri0Euz0At0Fqmpn8TRwfFH4/5kPZ85tUSt2CT5qZzkub2a5wE1HGz5PeKCHBI77FHQSSgeU9NliGgkWdGX7kyK4WKJIQIMsGI/RsirS5ku/wFT5TqFKXwk7EY4cLWPEcboY4I15pjRNM9o7mw4MefF/+/J4156zfk/ElJV8QAAeJxjYGYAg//NDGYMWAAAKJgBvAA=) format("woff"),
url(data:font/truetype;charset=utf-8;base64,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) format("otf");
}

</style>
<!-- End embedded font definitions -->

<!-- Begin page background -->
<div id="pg1Overlay" style="width:100%; height:100%; position:absolute; z-index:1; background-color:rgba(0,0,0,0); -webkit-user-select: none;"></div>
<div id="pg1" style="-webkit-user-select: none;"><svg id="pdf1" width="934" height="1209" viewBox="0 0 934 1209" style="width:934px; height:1209px; -moz-transform:scale(1); z-index: 0; isolation: isolate;" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
<defs>
<style type="text/css"><![CDATA[
.g0_1{
fill: none;
stroke: #000;
stroke-width: 0.763;
stroke-miterlimit: 10;
}
.g1_1{
fill: none;
stroke: #000;
stroke-width: 0.762;
stroke-miterlimit: 10;
}
.g2_1{
fill: none;
stroke: #000;
stroke-width: 0.757;
stroke-miterlimit: 10;
}
.g3_1{
fill: #000;
}
.g4_1{
fill: none;
stroke: #000;
stroke-width: 1.222;
stroke-miterlimit: 10;
}
.g5_1{
fill: #D9D9D9;
}
.g6_1{
fill: none;
stroke: #000;
stroke-width: 1.527;
stroke-miterlimit: 10;
}
]]></style>
</defs>
<path d="M55,348.3H605V91.7H55V348.3ZM256.2,100.8H241.9m14.3,27.5H241.9m22,-5.5V106.3m-29.7,16.5V106.3" class="g0_1"/>
<path d="M234.2,106.3v22.4m-.4,-.4h22.4m-14.3,0h22.4m-.4,.4V106.3m0,16.5V100.5m.4,.3H241.9m14.3,0H233.8m.4,-.3v22.3" class="g1_1"/>
<path d="M294.1,100.8H279.8m14.3,27.5H279.8m22,-5.5V106.3m-29.7,16.5V106.3" class="g0_1"/>
<path d="M272.1,106.3v22.4m-.4,-.4h22.4m-14.3,0h22.3m-.3,.4V106.3m0,16.5V100.5m.3,.3H279.8m14.3,0H271.7m.4,-.3v22.3" class="g1_1"/>
<path d="M351.7,100.8H337.4m14.3,27.5H337.4m22,-5.5V106.3m-29.7,16.5V106.3" class="g0_1"/>
<path d="M329.7,106.3v22.4m-.3,-.4h22.3m-14.3,0h22.4m-.4,.4V106.3m0,16.5V100.5m.4,.3H337.4m14.3,0H329.4m.3,-.3v22.3" class="g1_1"/>
<path d="M390.5,100.8H376.2m14.3,27.5H376.2m22,-5.5V106.3m-29.7,16.5V106.3" class="g0_1"/>
<path d="M368.5,106.3v22.4m-.4,-.4h22.4m-14.3,0h22.4m-.4,.4V106.3m0,16.5V100.5m.4,.3H376.2m14.3,0H368.1m.4,-.3v22.3" class="g1_1"/>
<path d="M429.3,100.8H415m14.3,27.5H415m22,-5.5V106.3m-29.7,16.5V106.3" class="g0_1"/>
<path d="M407.3,106.3v22.4m-.4,-.4h22.4m-14.3,0h22.3m-.3,.4V106.3m0,16.5V100.5m.3,.3H415m14.3,0H406.9m.4,-.3v22.3" class="g1_1"/>
<path d="M468,100.8H453.7M468,128.3H453.7m22,-5.5V106.3M446,122.8V106.3" class="g0_1"/>
<path d="M446,106.3v22.4m-.4,-.4H468m-14.3,0h22.4m-.4,.4V106.3m0,16.5V100.5m.4,.3H453.7m14.3,0H445.6m.4,-.3v22.3" class="g1_1"/>
<path d="M506.8,100.8H492.5m14.3,27.5H492.5m22,-5.5V106.3m-29.7,16.5V106.3" class="g0_1"/>
<path d="M484.8,106.3v22.4m-.4,-.4h22.4m-14.3,0h22.4m-.4,.4V106.3m0,16.5V100.5m.4,.3H492.5m14.3,0H484.4m.4,-.3v22.3" class="g1_1"/>
<path d="M545.5,100.8H531.2m14.3,27.5H531.2m22,-5.5V106.3m-29.7,16.5V106.3" class="g0_1"/>
<path d="M523.5,106.3v22.4m-.3,-.4h22.3m-14.3,0h22.4m-.4,.4V106.3m0,16.5V100.5m.4,.3H531.2m14.3,0H523.2m.3,-.3v22.3" class="g1_1"/>
<path d="M584.3,100.8H570m14.3,27.5H570m22,-5.5V106.3m-29.7,16.5V106.3" class="g0_1"/>
<path d="M562.3,106.3v22.4m-.4,-.4h22.4m-14.3,0h22.4m-.4,.4V106.3m0,16.5V100.5m.4,.3H570m14.3,0H561.9m.4,-.3v22.3" class="g1_1"/>
<path d="M209,165H594V137.5H209V165Zm-33,36.7H594V174.2H176v27.5Zm-55,36.6H594V210.8H121v27.5Zm0,45.9H407V256.7H121v27.5Zm297,0h55V256.7H418v27.5Zm66,0H594V256.7H484v27.5ZM120.6,302.5H341.4M120.6,330H341.4M341,302.1v28.3M121,302.1v28.3M351.6,302.5H484.4M351.6,330H484.4M484,302.1v28.3M352,302.1v28.3M494.6,302.5h99.8M494.6,330h99.8M594,302.1v28.3M495,302.1v28.3M660,91.7H847M660,284.2H847M869,113.7V262.2M638,113.7V262.2" class="g0_1"/>
<path d="M638,262.2v22.3m-.4,-.3H660m187,0h22.4m-.4,.3V262.2m0,-148.5V91.3m.4,.4H847m-187,0H637.6m.4,-.4v22.4" class="g2_1"/>
<path d="M649,137.5H858V100.8H649v36.7Z" class="g3_1"/>
<path d="M649,163.5h15.3V148.2H649v15.3Zm0,24.4h15.3V172.6H649v15.3Zm0,24.5h15.3V197.1H649v15.3Zm0,24.4h15.3V221.5H649v15.3Z" class="g0_1"/>
<path d="M55,394.2h55V375.8H55v18.4Z" class="g3_1"/>
<path d="M54.6,375.8H880.4" class="g4_1"/>
<path d="M54.6,394.2H880.4M682,435.4H880V412.5H682v22.9Zm-.4,13.8H836.4M681.6,472.1H836.4M682,448.8v23.7M835.6,449.2h44.8m-44.8,22.9h44.8M880,448.8v23.7M681.6,485.8H836.4m-154.8,23H836.4M682,485.4v23.7M835.6,485.8h44.8m-44.8,23h44.8M880,485.4v23.7M682,541.6h15.3V526.3H682v15.3ZM329.6,568.3h99.8m-99.8,23h99.8M330,567.9v23.7m98.6,-23.3h44.8m-44.8,23h44.8M473,567.9v23.7m65.6,-23.3h99.8m-99.8,23h99.8M539,567.9v23.7m98.6,-23.3h44.8m-44.8,23h44.8M682,567.9v23.7m-352.4,4.1h99.8m-99.8,22.9h99.8M330,595.3V619m98.6,-23.3h44.8m-44.8,22.9h44.8M473,595.3V619m65.6,-23.3h99.8m-99.8,22.9h99.8M539,595.3V619m98.6,-23.3h44.8m-44.8,22.9h44.8M682,595.3V619m-352.4,4.2h99.8m-99.8,22.9h99.8M330,622.8v23.7m98.6,-23.3h44.8m-44.8,22.9h44.8M473,622.8v23.7m65.6,-23.3h99.8m-99.8,22.9h99.8M539,622.8v23.7m98.6,-23.3h44.8m-44.8,22.9h44.8M682,622.8v23.7m33,-78.2H858M715,705.8H858M880,590.3v93.5M693,590.3v93.5" class="g0_1"/>
<path d="M693,683.8v22.4m-.4,-.4H715m143,0h22.4m-.4,.4V683.8m0,-93.5V568m.4,.3H858m-143,0H692.6m.4,-.3v22.3" class="g2_1"/>
<path d="M329.6,650.8h99.8m-99.8,23h99.8M330,650.4v23.7m98.6,-23.3h44.8m-44.8,23h44.8M473,650.4v23.7m65.6,-23.3h99.8m-99.8,23h99.8M539,650.4v23.7m98.6,-23.3h44.8m-44.8,23h44.8M682,650.4v23.7m-352.4,4.2h99.8m-99.8,23h99.8M330,677.9v23.7m98.6,-23.3h44.8m-44.8,23h44.8M473,677.9v23.7m65.6,-23.3h99.8m-99.8,23h99.8M539,677.9v23.7m98.6,-23.3h44.8m-44.8,23h44.8M682,677.9v23.7M329.6,715h99.8m-99.8,22.9h99.8M330,714.6v23.7M428.6,715h44.8m-44.8,22.9h44.8M473,714.6v23.7M538.6,715h99.8m-99.8,22.9h99.8M539,714.6v23.7M637.6,715h44.8m-44.8,22.9h44.8M682,714.6v23.7m-.4,13.4H836.4M681.6,774.6H836.4M682,751.3V775M835.6,751.7h44.8m-44.8,22.9h44.8M880,751.3V775M681.6,788.3H836.4m-154.8,23H836.4M682,787.9v23.7M835.6,788.3h44.8m-44.8,23h44.8M880,787.9v23.7M681.6,825H836.4M681.6,847.9H836.4M682,824.6v23.7M835.6,825h44.8m-44.8,22.9h44.8M880,824.6v23.7M681.6,861.7H836.4M681.6,884.6H836.4M682,861.3V885M835.6,861.7h44.8m-44.8,22.9h44.8M880,861.3V885M681.6,898.3H836.4m-154.8,23H836.4M682,897.9v23.7M835.6,898.3h44.8m-44.8,23h44.8M880,897.9v23.7M681.6,935H836.4M681.6,957.9H836.4M682,934.6v23.7M835.6,935h44.8m-44.8,22.9h44.8M880,934.6v23.7M681.6,971.7H836.4M681.6,994.6H836.4M682,971.3V995M835.6,971.7h44.8m-44.8,22.9h44.8M880,971.3V995m-198.4,13.3H836.4m-154.8,23H836.4M682,1007.9v23.7m153.6,-23.3h44.8m-44.8,23h44.8m-.4,-23.4v23.7m-198.4,22.6H836.4m-154.8,22.9H836.4M682,1053.8v23.7m153.6,-23.3h44.8m-44.8,22.9h44.8m-.4,-23.3v23.7" class="g0_1"/>
<path d="M682,1118.3H836v-22.9H682v22.9Z" class="g5_1"/>
<path d="M681.6,1095.4H836.4m-154.8,22.9H836.4M682,1095v23.7" class="g0_1"/>
<path d="M836,1118.3h44v-22.9H836v22.9Z" class="g5_1"/>
<path d="M835.6,1095.4h44.8m-44.8,22.9h44.8M880,1095v23.7" class="g0_1"/>
<path d="M54.6,1155H594.4m-.8,0H748.4m-.8,0H880.4" class="g6_1"/>
</svg></div>
<!-- End page background -->


<!-- Begin text definitions (Positioned/styled in CSS) -->
<div class="text-container"><span id="t1_1" class="t s0_1">Form </span><span id="t2_1" class="t s1_1">941 for 2024: </span>
<span id="t3_1" class="t s0_1">(Rev. March 2024) </span>
<span id="t4_1" class="t s2_1">Employer’s QUARTERLY Federal Tax Return </span>
<span id="t5_1" class="t s0_1">Department of the Treasury — Internal Revenue Service </span>
<span id="t6_1" class="t s3_1">950122 </span>
<span id="t7_1" class="t s0_1">OMB No. 1545-0029 </span>
<span id="t8_1" class="t v0_1 s4_1">Employer identification number </span><span id="t9_1" class="t v0_1 s0_1">(EIN) </span>
<span id="ta_1" class="t s0_1">— </span>
<span id="tb_1" class="t s4_1">Name </span><span id="tc_1" class="t s5_1">(not your trade name) </span>
<span id="td_1" class="t s4_1">Trade name </span><span id="te_1" class="t s5_1">(if any) </span>
<span id="tf_1" class="t s4_1">Address </span>
<span id="tg_1" class="t s6_1">Number </span><span id="th_1" class="t s6_1">Street </span><span id="ti_1" class="t s6_1">Suite or room number </span>
<span id="tj_1" class="t s6_1">City </span><span id="tk_1" class="t s6_1">State </span><span id="tl_1" class="t s6_1">ZIP code </span>
<span id="tm_1" class="t s6_1">Foreign country name </span><span id="tn_1" class="t s6_1">Foreign province/county </span><span id="to_1" class="t s6_1">Foreign postal code </span>
<span id="tp_1" class="t s7_1">Report for this Quarter of 2024 </span>
<span id="tq_1" class="t s8_1">(Check one.) </span>
<span id="tr_1" class="t s9_1">1: </span><span id="ts_1" class="t sa_1">January, February, March </span>
<span id="tt_1" class="t s9_1">2: </span><span id="tu_1" class="t sa_1">April, May, June </span>
<span id="tv_1" class="t s9_1">3: </span><span id="tw_1" class="t sa_1">July, August, September </span>
<span id="tx_1" class="t s9_1">4: </span><span id="ty_1" class="t sa_1">October, November, December </span>
<span id="tz_1" class="t sa_1">Go to </span><span id="t10_1" class="t sb_1">www.irs.gov/Form941 </span><span id="t11_1" class="t sa_1">for </span>
<span id="t12_1" class="t sa_1">instructions and the latest information. </span>
<span id="t13_1" class="t sc_1">Read the separate instructions before you complete Form 941. Type or print within the boxes. </span>
<span id="t14_1" class="t sd_1">Part 1: </span>
<span id="t15_1" class="t se_1">Answer these questions for this quarter. </span>
<span id="t16_1" class="t sf_1">1 </span><span id="t17_1" class="t v1_1 sf_1">Number of employees who received wages, tips, or other compensation for the pay period </span>
<span id="t18_1" class="t v1_1 sf_1">including: </span><span id="t19_1" class="t v1_1 sg_1">Mar. 12 </span><span id="t1a_1" class="t v1_1 sf_1">(Quarter 1), </span><span id="t1b_1" class="t v1_1 sg_1">June 12 </span><span id="t1c_1" class="t v1_1 sf_1">(Quarter 2), </span><span id="t1d_1" class="t v1_1 sg_1">Sept. 12 </span><span id="t1e_1" class="t v1_1 sf_1">(Quarter 3), or </span><span id="t1f_1" class="t v1_1 sg_1">Dec. 12 </span><span id="t1g_1" class="t v1_1 sf_1">(Quarter 4) </span><span id="t1h_1" class="t sf_1">1 </span>
<span id="t1i_1" class="t sf_1">2 </span><span id="t1j_1" class="t sf_1">Wages, tips, and other compensation </span><span id="t1k_1" class="t sc_1">. </span><span id="t1l_1" class="t sc_1">. </span><span id="t1m_1" class="t sc_1">. </span><span id="t1n_1" class="t sc_1">. </span><span id="t1o_1" class="t sc_1">. </span><span id="t1p_1" class="t sc_1">. </span><span id="t1q_1" class="t sc_1">. </span><span id="t1r_1" class="t sc_1">. </span><span id="t1s_1" class="t sc_1">. </span><span id="t1t_1" class="t sc_1">. </span><span id="t1u_1" class="t sc_1">. </span><span id="t1v_1" class="t sc_1">. </span><span id="t1w_1" class="t sc_1">. </span><span id="t1x_1" class="t sc_1">. </span><span id="t1y_1" class="t sc_1">. </span><span id="t1z_1" class="t sc_1">. </span><span id="t20_1" class="t sc_1">. </span><span id="t21_1" class="t sf_1">2 </span><span id="t22_1" class="t sh_1">. </span>
<span id="t23_1" class="t sf_1">3 </span><span id="t24_1" class="t sf_1">Federal income tax withheld from wages, tips, and other compensation </span><span id="t25_1" class="t sc_1">. </span><span id="t26_1" class="t sc_1">. </span><span id="t27_1" class="t sc_1">. </span><span id="t28_1" class="t sc_1">. </span><span id="t29_1" class="t sc_1">. </span><span id="t2a_1" class="t sc_1">. </span><span id="t2b_1" class="t sf_1">3 </span><span id="t2c_1" class="t sh_1">. </span>
<span id="t2d_1" class="t sf_1">4 </span><span id="t2e_1" class="t sf_1">If no wages, tips, and other compensation are subject to social security or Medicare tax </span><span id="t2f_1" class="t sf_1">Check and go to line 6. </span>
<span id="t2g_1" class="t sf_1">Column 1 </span><span id="t2h_1" class="t sf_1">Column 2 </span>
<span id="t2i_1" class="t sf_1">5a </span><span id="t2j_1" class="t sf_1">Taxable social security wages* </span><span id="t2k_1" class="t sc_1">. </span><span id="t2l_1" class="t sc_1">. </span><span id="t2m_1" class="t sh_1">. </span><span id="t2n_1" class="t sc_1">× 0.124 = </span><span id="t2o_1" class="t sh_1">. </span>
<span id="t2p_1" class="t sf_1">5a </span><span id="t2q_1" class="t sf_1">(i) </span><span id="t2r_1" class="t sf_1">Qualified sick leave wages* </span><span id="t2s_1" class="t sc_1">. </span><span id="t2t_1" class="t sh_1">. </span><span id="t2u_1" class="t sc_1">× 0.062 = </span><span id="t2v_1" class="t sh_1">. </span>
<span id="t2w_1" class="t sf_1">5a </span><span id="t2x_1" class="t sf_1">(ii) </span><span id="t2y_1" class="t sf_1">Qualified family leave wages* </span><span id="t2z_1" class="t sc_1">. </span><span id="t30_1" class="t sh_1">. </span><span id="t31_1" class="t sc_1">× 0.062 = </span><span id="t32_1" class="t sh_1">. </span>
<span id="t33_1" class="t v2_1 s5_1">* Include taxable qualified sick and </span>
<span id="t34_1" class="t v2_1 s5_1">family leave wages paid in this </span>
<span id="t35_1" class="t v2_1 s5_1">quarter of 2024 for leave taken </span>
<span id="t36_1" class="t v2_1 s5_1">after March 31, 2021, and before </span>
<span id="t37_1" class="t v2_1 s5_1">October 1, 2021, on line 5a. Use </span>
<span id="t38_1" class="t v2_1 s5_1">lines 5a(i) and 5a(ii) </span><span id="t39_1" class="t v2_1 si_1">only </span><span id="t3a_1" class="t v2_1 s5_1">for taxable </span>
<span id="t3b_1" class="t v2_1 s5_1">qualified sick and family leave </span>
<span id="t3c_1" class="t v2_1 s5_1">wages paid in this quarter of 2024 </span>
<span id="t3d_1" class="t v2_1 s5_1">for leave taken after March 31, </span>
<span id="t3e_1" class="t v2_1 s5_1">2020, and before April 1, 2021. </span>
<span id="t3f_1" class="t sf_1">5b </span><span id="t3g_1" class="t sf_1">Taxable social security tips </span><span id="t3h_1" class="t sc_1">. </span><span id="t3i_1" class="t sc_1">. </span><span id="t3j_1" class="t sc_1">. </span><span id="t3k_1" class="t sh_1">. </span><span id="t3l_1" class="t sc_1">× 0.124 = </span><span id="t3m_1" class="t sh_1">. </span>
<span id="t3n_1" class="t sf_1">5c </span><span id="t3o_1" class="t sf_1">Taxable Medicare wages &amp; tips </span><span id="t3p_1" class="t sc_1">. </span><span id="t3q_1" class="t sc_1">. </span><span id="t3r_1" class="t sh_1">. </span><span id="t3s_1" class="t sc_1">× 0.029 = </span><span id="t3t_1" class="t sh_1">. </span>
<span id="t3u_1" class="t sf_1">5d </span><span id="t3v_1" class="t sf_1">Taxable wages &amp; tips subject to </span>
<span id="t3w_1" class="t sf_1">Additional Medicare Tax withholding </span>
<span id="t3x_1" class="t sh_1">. </span><span id="t3y_1" class="t sc_1">× 0.009 = </span><span id="t3z_1" class="t sh_1">. </span>
<span id="t40_1" class="t sf_1">5e </span><span id="t41_1" class="t v3_1 sf_1">Total social security and Medicare taxes. </span><span id="t42_1" class="t v3_1 sc_1">Add Column 2 from lines 5a, 5a(i), 5a(ii), 5b, 5c, and 5d </span><span id="t43_1" class="t sf_1">5e </span><span id="t44_1" class="t sh_1">. </span>
<span id="t45_1" class="t sf_1">5f </span><span id="t46_1" class="t sf_1">Section 3121(q) Notice and Demand—Tax due on unreported tips </span><span id="t47_1" class="t sc_1">(see instructions) </span><span id="t48_1" class="t sc_1">. </span><span id="t49_1" class="t sc_1">. </span><span id="t4a_1" class="t sf_1">5f </span><span id="t4b_1" class="t sh_1">. </span>
<span id="t4c_1" class="t sf_1">6 </span><span id="t4d_1" class="t sf_1">Total taxes before adjustments. </span><span id="t4e_1" class="t sc_1">Add lines 3, 5e, and 5f </span><span id="t4f_1" class="t sc_1">. </span><span id="t4g_1" class="t sc_1">. </span><span id="t4h_1" class="t sc_1">. </span><span id="t4i_1" class="t sc_1">. </span><span id="t4j_1" class="t sc_1">. </span><span id="t4k_1" class="t sc_1">. </span><span id="t4l_1" class="t sc_1">. </span><span id="t4m_1" class="t sc_1">. </span><span id="t4n_1" class="t sc_1">. </span><span id="t4o_1" class="t sc_1">. </span><span id="t4p_1" class="t sc_1">. </span><span id="t4q_1" class="t sc_1">. </span><span id="t4r_1" class="t sf_1">6 </span><span id="t4s_1" class="t sh_1">. </span>
<span id="t4t_1" class="t sf_1">7 </span><span id="t4u_1" class="t sf_1">Current quarter’s adjustment for fractions of cents </span><span id="t4v_1" class="t sc_1">. </span><span id="t4w_1" class="t sc_1">. </span><span id="t4x_1" class="t sc_1">. </span><span id="t4y_1" class="t sc_1">. </span><span id="t4z_1" class="t sc_1">. </span><span id="t50_1" class="t sc_1">. </span><span id="t51_1" class="t sc_1">. </span><span id="t52_1" class="t sc_1">. </span><span id="t53_1" class="t sc_1">. </span><span id="t54_1" class="t sc_1">. </span><span id="t55_1" class="t sc_1">. </span><span id="t56_1" class="t sc_1">. </span><span id="t57_1" class="t sc_1">. </span><span id="t58_1" class="t sf_1">7 </span><span id="t59_1" class="t sh_1">. </span>
<span id="t5a_1" class="t sf_1">8 </span><span id="t5b_1" class="t sf_1">Current quarter’s adjustment for sick pay </span><span id="t5c_1" class="t sc_1">. </span><span id="t5d_1" class="t sc_1">. </span><span id="t5e_1" class="t sc_1">. </span><span id="t5f_1" class="t sc_1">. </span><span id="t5g_1" class="t sc_1">. </span><span id="t5h_1" class="t sc_1">. </span><span id="t5i_1" class="t sc_1">. </span><span id="t5j_1" class="t sc_1">. </span><span id="t5k_1" class="t sc_1">. </span><span id="t5l_1" class="t sc_1">. </span><span id="t5m_1" class="t sc_1">. </span><span id="t5n_1" class="t sc_1">. </span><span id="t5o_1" class="t sc_1">. </span><span id="t5p_1" class="t sc_1">. </span><span id="t5q_1" class="t sc_1">. </span><span id="t5r_1" class="t sc_1">. </span><span id="t5s_1" class="t sf_1">8 </span><span id="t5t_1" class="t sh_1">. </span>
<span id="t5u_1" class="t sf_1">9 </span><span id="t5v_1" class="t sf_1">Current quarter’s adjustments for tips and group-term life insurance </span><span id="t5w_1" class="t sc_1">. </span><span id="t5x_1" class="t sc_1">. </span><span id="t5y_1" class="t sc_1">. </span><span id="t5z_1" class="t sc_1">. </span><span id="t60_1" class="t sc_1">. </span><span id="t61_1" class="t sc_1">. </span><span id="t62_1" class="t sc_1">. </span><span id="t63_1" class="t sf_1">9 </span><span id="t64_1" class="t sh_1">. </span>
<span id="t65_1" class="t sf_1">10 </span><span id="t66_1" class="t sf_1">Total taxes after adjustments. </span><span id="t67_1" class="t sc_1">Combine lines 6 through 9 </span><span id="t68_1" class="t sc_1">. </span><span id="t69_1" class="t sc_1">. </span><span id="t6a_1" class="t sc_1">. </span><span id="t6b_1" class="t sc_1">. </span><span id="t6c_1" class="t sc_1">. </span><span id="t6d_1" class="t sc_1">. </span><span id="t6e_1" class="t sc_1">. </span><span id="t6f_1" class="t sc_1">. </span><span id="t6g_1" class="t sc_1">. </span><span id="t6h_1" class="t sc_1">. </span><span id="t6i_1" class="t sc_1">. </span><span id="t6j_1" class="t sf_1">10 </span><span id="t6k_1" class="t sh_1">. </span>
<span id="t6l_1" class="t sf_1">11a </span><span id="t6m_1" class="t v4_1 sf_1">Qualified small business payroll tax credit for increasing research activities. </span><span id="t6n_1" class="t v4_1 sc_1">Attach Form 8974 </span><span id="t6o_1" class="t v5_1 sf_1">11a </span><span id="t6p_1" class="t sh_1">. </span>
<span id="t6q_1" class="t sf_1">11b </span><span id="t6r_1" class="t v6_1 sf_1">Nonrefundable portion of credit for qualified sick and family leave wages for leave taken </span>
<span id="t6s_1" class="t v6_1 sf_1">before April 1, 2021 </span><span id="t6t_1" class="t sc_1">. </span><span id="t6u_1" class="t sc_1">. </span><span id="t6v_1" class="t sc_1">. </span><span id="t6w_1" class="t sc_1">. </span><span id="t6x_1" class="t sc_1">. </span><span id="t6y_1" class="t sc_1">. </span><span id="t6z_1" class="t sc_1">. </span><span id="t70_1" class="t sc_1">. </span><span id="t71_1" class="t sc_1">. </span><span id="t72_1" class="t sc_1">. </span><span id="t73_1" class="t sc_1">. </span><span id="t74_1" class="t sc_1">. </span><span id="t75_1" class="t sc_1">. </span><span id="t76_1" class="t sc_1">. </span><span id="t77_1" class="t sc_1">. </span><span id="t78_1" class="t sc_1">. </span><span id="t79_1" class="t sc_1">. </span><span id="t7a_1" class="t sc_1">. </span><span id="t7b_1" class="t sc_1">. </span><span id="t7c_1" class="t sc_1">. </span><span id="t7d_1" class="t sc_1">. </span><span id="t7e_1" class="t sc_1">. </span><span id="t7f_1" class="t sc_1">. </span><span id="t7g_1" class="t v0_1 sf_1">11b </span>
<span id="t7h_1" class="t sh_1">. </span>
<span id="t7i_1" class="t sf_1">11c </span><span id="t7j_1" class="t sf_1">Reserved for future use </span><span id="t7k_1" class="t sc_1">. </span><span id="t7l_1" class="t sc_1">. </span><span id="t7m_1" class="t sc_1">. </span><span id="t7n_1" class="t sc_1">. </span><span id="t7o_1" class="t sc_1">. </span><span id="t7p_1" class="t sc_1">. </span><span id="t7q_1" class="t sc_1">. </span><span id="t7r_1" class="t sc_1">. </span><span id="t7s_1" class="t sc_1">. </span><span id="t7t_1" class="t sc_1">. </span><span id="t7u_1" class="t sc_1">. </span><span id="t7v_1" class="t sc_1">. </span><span id="t7w_1" class="t sc_1">. </span><span id="t7x_1" class="t sc_1">. </span><span id="t7y_1" class="t sc_1">. </span><span id="t7z_1" class="t sc_1">. </span><span id="t80_1" class="t sc_1">. </span><span id="t81_1" class="t sc_1">. </span><span id="t82_1" class="t sc_1">. </span><span id="t83_1" class="t sc_1">. </span><span id="t84_1" class="t sc_1">. </span><span id="t85_1" class="t sc_1">. </span><span id="t86_1" class="t v0_1 sf_1">11c </span><span id="t87_1" class="t sh_1">. </span>
<span id="t88_1" class="t sf_1">You MUST complete all three pages of Form 941 and SIGN it. </span>
<span id="t89_1" class="t s9_1">For Privacy Act and Paperwork Reduction Act Notice, see the back of the Payment Voucher. </span><span id="t8a_1" class="t s0_1">Cat. No. 17001Z </span><span id="t8b_1" class="t s0_1">Form </span><span id="t8c_1" class="t sj_1">941 </span><span id="t8d_1" class="t s0_1">(Rev. 3-2024) </span></div>
<!-- End text definitions -->


<!-- Begin Form Data -->

<?php
// Assuming $get_cdata[0]['unique_id'] is an integer
$unique_id = isset($get_cdata[0]['unique_id']) ? sprintf('%02d', $get_cdata[0]['unique_id']) : 'Default ID';
?>

 

 
 
<?php
$Federal_Pin_Number = isset($get_cominfo[0]['Federal_Pin_Number']) ? $get_cominfo[0]['Federal_Pin_Number'] : 'Default Value';
 if(strlen($Federal_Pin_Number) >= 9) {
     $one = substr($Federal_Pin_Number, 0, 2);
     $two = substr($Federal_Pin_Number, -7);
} else {
     $one = '00'; // Example default value
    $two = '0000000'; // Example default value
 }
  ?>
<!-- Begin Form Data -->
<input id="form1_1" type="text" tabindex="1" maxlength="2" value="<?php echo htmlspecialchars($one, ENT_QUOTES, 'UTF-8'); ?> " data-objref="458 0 R" data-field-name="topmostSubform[0].Page1[0].EntityArea[0].EIN_F944[0].f1_1[0]" style="font-size:24px; letter-spacing: 33px;" />
<input id="form2_1" type="text" tabindex="2" maxlength="7" value="<?php echo htmlspecialchars($two, ENT_QUOTES, 'UTF-8'); ?>" data-objref="459 0 R" data-field-name="topmostSubform[0].Page1[0].EntityArea[0].EIN_F944[0].f1_2[0]" style="font-size:24px; letter-spacing: 27px;"/>











<?php 
// Assume $selectedValue is defined elsewhere in your code and represents the selected quarter
 // Determine if the selected value indicates Q2
 #selectedValue
$isQ1 = ($selectedValue == 'Q1');
?>
 
 
 <input id="form3_1" type="checkbox" tabindex="12" value="1"  <?php echo $isQ1 ? 'checked' : ''; ?>    data-objref="465 0 R" data-field-name="topmostSubform[0].Page1[0].Header[0].ReportForQuarter[0].c1_1[0]" imageOn="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABEAAAARCAMAAAAMs7fIAAAAZlBMVEUAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAABwbJTWAAAAInRSTlMAcDkjf3b/8RjdjwGi1r8GAs4OGU8g2su2guEl5AeS7jQkzdhcKgAAAFlJREFUeNqtz0cSgDAMA0ATQKb3Ekoo//8k4ZL4AfFxR9KMiYJepIjiREAKVlmOwkFZAVwDTeuoswT0g6iNbGUSMC9/hpWXFdAbsPud49SGrvuRNWPn36Avfq3xAzhlMCzyAAAAAElFTkSuQmCC" imageOff="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAMAAAC6V+0/AAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAAA5JREFUeNpjYBgFgx0AAAGkAAF+IKsZAAAAAElFTkSuQmCC" imageDownOff="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABEAAAARCAMAAAAMs7fIAAAAD1BMVEUAAAC/v7+9vb2/v7/Dw8MCye4CAAAABXRSTlMA/0ZAEfKwnsUAAAAVSURBVHjaY2DABIyogGlkizCjAhYAmkIBMfGWWB0AAAAASUVORK5CYII=" imageName="null" images="110100"/>





<input id="form5_1" type="checkbox" tabindex="13" value="2"     data-objref="466 0 R" data-field-name="topmostSubform[0].Page1[0].Header[0].ReportForQuarter[0].c1_1[1]" imageOn="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABEAAAARCAMAAAAMs7fIAAAAZlBMVEUAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAABwbJTWAAAAInRSTlMAcDkjf3b/8RjdjwGi1r8GAs4OGU8g2su2guEl5AeS7jQkzdhcKgAAAFlJREFUeNqtz0cSgDAMA0ATQKb3Ekoo//8k4ZL4AfFxR9KMiYJepIjiREAKVlmOwkFZAVwDTeuoswT0g6iNbGUSMC9/hpWXFdAbsPud49SGrvuRNWPn36Avfq3xAzhlMCzyAAAAAElFTkSuQmCC" imageOff="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAMAAAC6V+0/AAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAAA5JREFUeNpjYBgFgx0AAAGkAAF+IKsZAAAAAElFTkSuQmCC" imageDownOff="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABEAAAARCAMAAAAMs7fIAAAAD1BMVEUAAAC/v7+9vb2/v7/Dw8MCye4CAAAABXRSTlMA/0ZAEfKwnsUAAAAVSURBVHjaY2DABIyogGlkizCjAhYAmkIBMfGWWB0AAAAASUVORK5CYII=" imageName="null" images="110100"/>










 
<!-- Assuming hr/f941_taxform is your view file -->
<!-- Use $get_cdata variable to access the data passed from the controller -->
<?php
// Check if get_cdata is set and not empty
if (isset($get_cominfo) && !empty($get_cominfo)) {
    $company_name = $get_cominfo[0]['company_name'];
} else {
    // Default value or handle the case when get_cdata is not available
    $company_name = 'Default Name';
}
?>



<input id="form4_1" type="text" tabindex="3" 
value="<?php echo htmlspecialchars($company_name, ENT_QUOTES,'UTF-8'); ?>"  
data-objref="471 0 R" data-field-name="topmostSubform[0].Page1[0].Header[0].EntityArea[0].f1_3[0]"  style="margin-left: 5px;"  />


 
<?php 
// Assume $selectedValue is defined elsewhere in your code and represents the selected quarter
// $selectedValue = 'Q2'; // This is just an example assignment
// Determine if the selected value indicates Q2
$isQ2 = ($selectedValue == 'Q2');
?>
<input id="form5_1" type="checkbox" tabindex="13" value="2"  <?php echo $isQ2 ? 'checked' : ''; ?>  data-objref="466 0 R" data-field-name="topmostSubform[0].Page1[0].Header[0].ReportForQuarter[0].c1_1[1]" imageOn="data:image/png;base64,
 
iVBORw0KGgoAAAANSUhEUgAAABEAAAARCAMAAAAMs7fIAAAAZlBMVEUAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAABwbJTWAAAAInRSTlMAcDkjf3b/8RjdjwGi1r8GAs4OGU8g2su2guEl5AeS7jQkzdhcKgAAAFlJREFUeNqtz0cSgDAMA0ATQKb3Ekoo//8k4ZL4AfFxR9KMiYJepIjiREAKVlmOwkFZAVwDTeuoswT0g6iNbGUSMC9/hpWXFdAbsPud49SGrvuRNWPn36Avfq3xAzhlMCzyAAAAAElFTkSuQmCC" imageOff="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAMAAAC6V+0/AAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAAA5JREFUeNpjYBgFgx0AAAGkAAF+IKsZAAAAAElFTkSuQmCC" imageDownOff="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABEAAAARCAMAAAAMs7fIAAAAD1BMVEUAAAC/v7+9vb2/v7/Dw8MCye4CAAAABXRSTlMA/0ZAEfKwnsUAAAAVSURBVHjaY2DABIyogGlkizCjAhYAmkIBMfGWWB0AAAAASUVORK5CYII=" imageName="null" images="110100"/>



<?php
// Assign a default value in case $get_cdata or $get_cdata[0]['adm_address'] is not set
$username = 'Default Address';

// Check if get_cdata is set and not empty
if (isset($get_cdata) && !empty($get_cdata[0]['username'])) {
    $username = $get_cdata[0]['username'];
}
?>







<input id="form6_1" type="text" tabindex="4" style="margin-left: 5px;"  
 
value="<?php echo htmlspecialchars($company_name, ENT_QUOTES,'UTF-8'); ?>"  

data-objref="472 0 R" data-field-name="topmostSubform[0].Page1[0].Header[0].EntityArea[0].f1_4[0]"/>


<?php 
$isQ3 = ($selectedValue == 'Q3');
?>
<input id="form7_1" type="checkbox" tabindex="14" value="3"   <?php echo $isQ3 ? 'checked' : ''; ?>  data-objref="467 0 R" data-field-name="topmostSubform[0].Page1[0].Header[0].ReportForQuarter[0].c1_1[2]" imageOn="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABEAAAARCAMAAAAMs7fIAAAAZlBMVEUAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAABwbJTWAAAAInRSTlMAcDkjf3b/8RjdjwGi1r8GAs4OGU8g2su2guEl5AeS7jQkzdhcKgAAAFlJREFUeNqtz0cSgDAMA0ATQKb3Ekoo//8k4ZL4AfFxR9KMiYJepIjiREAKVlmOwkFZAVwDTeuoswT0g6iNbGUSMC9/hpWXFdAbsPud49SGrvuRNWPn36Avfq3xAzhlMCzyAAAAAElFTkSuQmCC" imageOff="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAMAAAC6V+0/AAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAAA5JREFUeNpjYBgFgx0AAAGkAAF+IKsZAAAAAElFTkSuQmCC" imageDownOff="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABEAAAARCAMAAAAMs7fIAAAAD1BMVEUAAAC/v7+9vb2/v7/Dw8MCye4CAAAABXRSTlMA/0ZAEfKwnsUAAAAVSURBVHjaY2DABIyogGlkizCjAhYAmkIBMfGWWB0AAAAASUVORK5CYII=" imageName="null" images="110100"/>



<?php 
$isQ4 = ($selectedValue == 'Q4');
?>
 
<input id="form8_1" type="checkbox" tabindex="15" value="4"   <?php echo $isQ4 ? 'checked' : ''; ?>  data-objref="468 0 R" data-field-name="topmostSubform[0].Page1[0].Header[0].ReportForQuarter[0].c1_1[3]" imageOn="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABEAAAARCAMAAAAMs7fIAAAAZlBMVEUAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAABwbJTWAAAAInRSTlMAcDkjf3b/8RjdjwGi1r8GAs4OGU8g2su2guEl5AeS7jQkzdhcKgAAAFlJREFUeNqtz0cSgDAMA0ATQKb3Ekoo//8k4ZL4AfFxR9KMiYJepIjiREAKVlmOwkFZAVwDTeuoswT0g6iNbGUSMC9/hpWXFdAbsPud49SGrvuRNWPn36Avfq3xAzhlMCzyAAAAAElFTkSuQmCC" imageOff="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAMAAAC6V+0/AAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAAA5JREFUeNpjYBgFgx0AAAGkAAF+IKsZAAAAAElFTkSuQmCC" imageDownOff="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABEAAAARCAMAAAAMs7fIAAAAD1BMVEUAAAC/v7+9vb2/v7/Dw8MCye4CAAAABXRSTlMA/0ZAEfKwnsUAAAAVSURBVHjaY2DABIyogGlkizCjAhYAmkIBMfGWWB0AAAAASUVORK5CYII=" imageName="null" images="110100"/>





<?php
$address = isset($get_cominfo[0]['address']) ? $get_cominfo[0]['address'] : 'Default Address';
$get_address = explode(',', $address);
?>


<input id="form9_1" type="text" tabindex="5"  style="margin-left:5px;"
value="<?php echo htmlspecialchars($get_address[0], ENT_QUOTES, 'UTF-8'); ?>"
data-objref="473 0 R" data-field-name="topmostSubform[0].Page1[0].Header[0].EntityArea[0].f1_5[0]"/>





<input id="form10_1" type="text" tabindex="6" value="<?php echo htmlspecialchars($get_address[1], ENT_QUOTES, 'UTF-8'); ?>" data-objref="474 0 R" data-field-name="topmostSubform[0].Page1[0].Header[0].EntityArea[0].f1_6[0]"/>
<input id="form11_1" type="text" tabindex="7" maxlength="2" value="<?php echo htmlspecialchars($get_address[2], ENT_QUOTES, 'UTF-8'); ?>" data-objref="475 0 R" data-field-name="topmostSubform[0].Page1[0].Header[0].EntityArea[0].f1_7[0]"/>




<input id="form12_1" type="text" tabindex="8" maxlength="10" value="<?php echo htmlspecialchars($get_address[3], ENT_QUOTES, 'UTF-8'); ?>" data-objref="476 0 R" data-field-name="topmostSubform[0].Page1[0].Header[0].EntityArea[0].f1_8[0]"/>






<input id="form13_1" type="text" tabindex="9" value="" data-objref="477 0 R" data-field-name="topmostSubform[0].Page1[0].Header[0].EntityArea[0].f1_9[0]"/>
<input id="form14_1" type="text" tabindex="10" value="" data-objref="478 0 R" data-field-name="topmostSubform[0].Page1[0].Header[0].EntityArea[0].f1_10[0]"/>
<input id="form15_1" type="text" tabindex="11" value="" data-objref="479 0 R" data-field-name="topmostSubform[0].Page1[0].Header[0].EntityArea[0].f1_11[0]"/>




 
<input id="form9_1" type="text" tabindex="5"  style="margin-left:5px;"
 data-objref="473 0 R" data-field-name="topmostSubform[0].Page1[0].Header[0].EntityArea[0].f1_5[0]"/>





 
 

<input id="form16_1" type="text" tabindex="16" 
value="<?php echo htmlspecialchars($gt[0]['table_id'], ENT_QUOTES, 'UTF-8'); ?>"
data-objref="413 0 R" data-field-name="topmostSubform[0].Page1[0].f1_12[0]"/>







<?php
$total_amount_sum = '0';
if (isset($tif)) {
  
     foreach ($tif as $row) {
        $total_amount_sum += $row['sum_total_amount']; // Add each total_amount to the sum
}
}
$amount_partss = explode('.', $total_amount_sum);

// Extract the integer and decimal parts
$integer_parts = isset($amount_partss[0]) ? $amount_partss[0] : '0';
$decimal_parts = isset($amount_partss[1]) ? substr($amount_partss[1], 0, 2) : '00';
?>

<input id="form17_1" type="text" tabindex="17"  style="margin: 4px;"
    value="$<?php echo htmlspecialchars($integer_parts, ENT_QUOTES, 'UTF-8'); ?>"  
    data-objref="414 0 R" data-field-name="topmostSubform[0].Page1[0].f1_13[0]"/>

<input id="form18_1" type="text" tabindex="18" maxlength="3" style="margin-top: 5px;text-align: justify;"  
 value="<?php echo htmlspecialchars($decimal_parts, ENT_QUOTES, 'UTF-8'); ?>"    
data-objref="415 0 R" data-field-name="topmostSubform[0].Page1[0].f1_14[0]"/>




    
    



<?php
$federal_sum = '0';
if (isset($tif)) {
  
     foreach ($tif as $row) {
        $federal_sum += $row['sum_f_tax']; // Add each total_amount to the sum
}
}
$amount_partsf = explode('.', $federal_sum);

// Extract the integer and decimal parts
$integer_part_f = isset($amount_partsf[0]) ? $amount_partsf[0] : '0';
$decimal_part_f = isset($amount_partsf[1]) ? substr($amount_partsf[1], 0, 2) : '00';
?>



<input id="form19_1" type="text" tabindex="19" style="margin: 4px;"
    value="$<?php echo htmlspecialchars($integer_part_f, ENT_QUOTES, 'UTF-8'); ?>"  
    data-objref="416 0 R" data-field-name="topmostSubform[0].Page1[0].f1_15[0]"/>

<input id="form20_1" type="text" tabindex="20" maxlength="3" style="margin-top: 5px;text-align: justify;" 
 value="<?php echo htmlspecialchars($decimal_part_f, ENT_QUOTES, 'UTF-8'); ?>"
    data-objref="417 0 R" data-field-name="topmostSubform[0].Page1[0].f1_16[0]"/>






<input id="form21_1" type="checkbox" tabindex="21" value="1" data-objref="418 0 R" data-field-name="topmostSubform[0].Page1[0].c1_3[0]" imageOn="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABEAAAARCAMAAAAMs7fIAAAAZlBMVEUAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAABwbJTWAAAAInRSTlMAcDkjf3b/8RjdjwGi1r8GAs4OGU8g2su2guEl5AeS7jQkzdhcKgAAAFlJREFUeNqtz0cSgDAMA0ATQKb3Ekoo//8k4ZL4AfFxR9KMiYJepIjiREAKVlmOwkFZAVwDTeuoswT0g6iNbGUSMC9/hpWXFdAbsPud49SGrvuRNWPn36Avfq3xAzhlMCzyAAAAAElFTkSuQmCC" imageOff="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAMAAAC6V+0/AAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAAA5JREFUeNpjYBgFgx0AAAGkAAF+IKsZAAAAAElFTkSuQmCC" imageDownOff="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABEAAAARCAMAAAAMs7fIAAAAD1BMVEUAAAC/v7+9vb2/v7/Dw8MCye4CAAAABXRSTlMA/0ZAEfKwnsUAAAAVSURBVHjaY2DABIyogGlkizCjAhYAmkIBMfGWWB0AAAAASUVORK5CYII=" imageName="null" images="110100"/>



<?php
$social = '0';
if (isset($tif)) {
  
     foreach ($tif as $row) {
        $social += $row['sum_s_tax']; // Add each total_amount to the sum
}
}
$amount_parts_s = explode('.', $social);

// Extract the integer and decimal parts
$integer_part_s = isset($amount_parts_s[0]) ? $amount_parts_s[0] : '0';
$decimal_part_s = isset($amount_parts_s[1]) ? substr($amount_parts_s[1],0 ,2) : '00';
?>




<input id="form22_1" type="text" tabindex="22"
    value="$<?php echo ($integer_parts); ?>"  
    data-objref="419 0 R" data-field-name="topmostSubform[0].Page1[0].f1_17[0]"
    style="top :573px;"
       />

<input id="form23_1" type="text" tabindex="23" maxlength="3" 
     data-objref="420 0 R" data-field-name="topmostSubform[0].Page1[0].f1_18[0]"
       value="<?php echo ($decimal_parts); ?>" 
    style="text-align: start;margin-top: 5px;"/>



 









 


<?php
$value =$total_amount_sum * 0.124;

 $s = explode('.', $value);

// Extract the integer and decimal parts
$integer = isset($s[0]) ? $s[0] : '0';
$decimal = isset($s[1]) ? substr($s[1],0,2) : '00';
?>
<input id="form24_1" type="text" tabindex="24" value="$<?php echo $integer; ?>" 
    data-objref="421 0 R" data-field-name="topmostSubform[0].Page1[0].f1_19[0]"/>


 
<input id="form25_1" type="text" tabindex="25" maxlength="2"   style="text-align: start;" value="<?php echo $decimal; ?>" 

        data-objref="422 0 R" data-field-name="topmostSubform[0].Page1[0].f1_20[0]"/>







<?php
$medicare = '0';
if (isset($tif)) {
  
     foreach ($tif as $row) {
        $medicare += $row['sum_m_tax']; // Add each total_amount to the sum
}
}

$amount_parts_m = explode('.', $total_amount_sum);

// Extract the integer and decimal parts
$integer_part_m = isset($amount_parts_m[0]) ? $amount_parts_m[0] : '0';
$decimal_part_m = isset($amount_parts_m[1]) ? substr($amount_parts_m[1],0,2) : '00';
$medicare_cal=$total_amount_sum *0.029;

if (strpos($medicare_cal, '.') !== false) {
    // Split the $medicare_cal by dot
    $amount_parts_mcal = explode('.', $medicare_cal);

    // Extract the integer and decimal parts
    $integer_part_mcal = isset($amount_parts_mcal[0]) ? $amount_parts_mcal[0] : '0';
    $decimal_part_mcal = isset($amount_parts_mcal[1]) ? substr($amount_parts_mcal[1],0,2) : '00';
} else {
    // If $medicare_cal does not contain a dot, set default values
    $integer_part_mcal = $medicare_cal;
    $decimal_part_mcal = '00';
}
?>

<input id="form26_1" type="text" tabindex="26" value="" data-objref="423 0 R" data-field-name="topmostSubform[0].Page1[0].f1_21[0]"/>
<input id="form27_1" type="text" tabindex="27" maxlength="3" value="" data-objref="424 0 R" data-field-name="topmostSubform[0].Page1[0].f1_22[0]"/>
<input id="form28_1" type="text" tabindex="28" value="" data-objref="425 0 R" data-field-name="topmostSubform[0].Page1[0].f1_23[0]"/>
<input id="form29_1" type="text" tabindex="29" maxlength="3" value="" data-objref="426 0 R" data-field-name="topmostSubform[0].Page1[0].f1_24[0]"/>
<input id="form30_1" type="text" tabindex="30" value="" data-objref="427 0 R" data-field-name="topmostSubform[0].Page1[0].f1_25[0]"/>
<input id="form31_1" type="text" tabindex="31" maxlength="3" value="" data-objref="428 0 R" data-field-name="topmostSubform[0].Page1[0].f1_26[0]"/>
<input id="form32_1" type="text" tabindex="32" value="" data-objref="429 0 R" data-field-name="topmostSubform[0].Page1[0].f1_27[0]"/>
<input id="form33_1" type="text" tabindex="33" maxlength="3" value="" data-objref="430 0 R" data-field-name="topmostSubform[0].Page1[0].f1_28[0]"/>
<input id="form34_1" type="text" tabindex="34" value="" data-objref="431 0 R" data-field-name="topmostSubform[0].Page1[0].f1_29[0]"/>
<input id="form35_1" type="text" tabindex="35" maxlength="3" value="" data-objref="432 0 R" data-field-name="topmostSubform[0].Page1[0].f1_30[0]"/>
<input id="form36_1" type="text" tabindex="36" value="" data-objref="433 0 R" data-field-name="topmostSubform[0].Page1[0].f1_31[0]"/>
<input id="form37_1" type="text" tabindex="37" maxlength="3" value="" data-objref="434 0 R" data-field-name="topmostSubform[0].Page1[0].f1_32[0]"/>
<input id="form38_1" type="text" style="margin-top:5px;" tabindex="38" value="$<?php  echo $integer_parts; ?>" data-objref="435 0 R" data-field-name="topmostSubform[0].Page1[0].f1_33[0]"/>
<input id="form39_1" type="text" style="margin-top:5px;text-align:justify;" tabindex="39" maxlength="3" value="<?php  echo $decimal_parts; ?>" data-objref="436 0 R" data-field-name="topmostSubform[0].Page1[0].f1_34[0]"/>
<input id="form40_1" type="text" tabindex="40" style="margin-top:5px;" value="$<?php  echo $integer_part_mcal; ?>" data-objref="437 0 R" data-field-name="topmostSubform[0].Page1[0].f1_35[0]"/>
<input id="form41_1" type="text" tabindex="41" style="margin-top:5px;" maxlength="3" value="<?php  echo $decimal_part_mcal; ?>" data-objref="438 0 R" data-field-name="topmostSubform[0].Page1[0].f1_36[0]"/>
<input id="form42_1" type="text" tabindex="42" value="" data-objref="439 0 R" data-field-name="topmostSubform[0].Page1[0].f1_37[0]"/>
<input id="form43_1" type="text" tabindex="43" maxlength="3" value="" data-objref="440 0 R" data-field-name="topmostSubform[0].Page1[0].f1_38[0]"/>
<input id="form44_1" type="text" tabindex="44" value="" data-objref="441 0 R" data-field-name="topmostSubform[0].Page1[0].f1_39[0]"/>
<input id="form45_1" type="text" tabindex="45" maxlength="3" value="" data-objref="442 0 R" data-field-name="topmostSubform[0].Page1[0].f1_40[0]"/>



 



    <?php
 

$value1 =($social * 0.124)+($medicare_cal);


 
if (strpos($value1, '.') !== false) {
    // Split the $medicare_cal by dot
    $a = explode('.', $value1);

    // Extract the integer and decimal parts
    $i = isset($a[0]) ? $a[0] : '0';
    $d = isset($a[1]) ? substr($a[1],0,2) : '00';
} else {
    // If $medicare_cal does not contain a dot, set default values
    $i = $value1;
    $d = '00';
}
// Ensure that $social_sum and $value are cast to float before adding
// $sumtotal = (float)$social_sum + (float)$value;

?>
 
<?php
$tssm = $value1;
?>


 

<?php
$total_amount_sum = 0; // Initialize as numeric 0 instead of string '0' for arithmetic operations
if (isset($tif)) {
    foreach ($tif as $row) {
        $total_amount_sum += $row['sum_total_amount']; // Add each total_amount to the sum
    }
    $ssw = $total_amount_sum * 0.124; 
    $mw = $total_amount_sum * 0.029; 
    $gt = $ssw + $mw; // Corrected the missing $ sign

$ovt = explode('.', $gt);
// Extract the integer and decimal parts
$integer_parts = isset($ovt[0]) ? $ovt[0] : '0';
$decimal_parts = isset($ovt[1]) ? substr($ovt[1],0,2) : '00';

}
// Use $gt for further operations or output
?>



<input id="form46_1" type="text" tabindex="46"  style="padding-top: 12px;"
    value="$<?php echo htmlspecialchars($integer_parts, ENT_QUOTES, 'UTF-8'); ?>" 
    data-objref="443 0 R" data-field-name="topmostSubform[0].Page1[0].f1_41[0]"/>
 
<input id="form47_1" type="text" tabindex="47" maxlength="3"  style="padding-top: 12px;"
value="<?php echo htmlspecialchars($decimal_parts, ENT_QUOTES, 'UTF-8'); ?>" 
     data-objref="444 0 R" data-field-name="topmostSubform[0].Page1[0].f1_42[0]"/>




<input id="form48_1" type="text" tabindex="48" value="" data-objref="445 0 R" data-field-name="topmostSubform[0].Page1[0].f1_43[0]"/>
<input id="form49_1" type="text" tabindex="49" maxlength="3" value="" data-objref="446 0 R" data-field-name="topmostSubform[0].Page1[0].f1_44[0]"/>



<?php
$line_3 = $federal_sum;
$line_5e = $sumtotal;
$line_5f = 0;
// Calculate the total by adding up the values
$total_taxes_before_adjustments = $line_3 + $line_5e + $line_5f;
?>
<?php
// Assuming $total_taxes_before_adjustments is calculated and set
$total_taxes_before_adjustments = $federal_sum + $value1;

 if (strpos($total_taxes_before_adjustments, '.') !== false) {
    // Split the $medicare_cal by dot
    $a = explode('.', $total_taxes_before_adjustments);

    // Extract the integer and decimal parts
    $i = isset($a[0]) ? $a[0] : '0';
    $d = isset($a[1]) ? substr( $a[1] ,0 ,2 ) : '00';
} else {
    // If $medicare_cal does not contain a dot, set default values
    $i = $total_taxes_before_adjustments;
    $d = '00';
}
?>




<?php
$federal_sum = 0; // Initialize as numeric 0 for arithmetic operations
$total_amount_sum = 0; // Initialize as numeric 0 for arithmetic operations

if (isset($tif)) {
    foreach ($tif as $row) {
        // Ensure 'sum_f_tax' and 'sum_total_amount' are set and numeric
        $federal_sum += isset($row['sum_f_tax']) ? $row['sum_f_tax'] : 0;
        $total_amount_sum += isset($row['sum_total_amount']) ? $row['sum_total_amount'] : 0;
    }
}

$ssw = $total_amount_sum * 0.124; 
$mw = $total_amount_sum * 0.029; 
$gt = $ssw + $mw; // Additional calculations based on total amount sum

$fot = $federal_sum + $gt; // Corrected by adding a semicolon at the end

$fvt = explode('.', $fot);
// Extract the integer and decimal parts
$integer_parts = isset($fvt[0]) ? $fvt[0] : '0';
 $decimal_parts = isset($fvt[1]) ? substr( $fvt[1],0 ,2) : '00';


?>


<input id="form50_1" type="text" tabindex="50" 
    value="$<?php echo htmlspecialchars($integer_parts, ENT_QUOTES, 'UTF-8'); ?>" 
    data-objref="447 0 R" data-field-name="topmostSubform[0].Page1[0].f1_45[0]"/>


<input id="form51_1" type="text" tabindex="51" maxlength="3" 
 value="<?php echo htmlspecialchars($decimal_parts, ENT_QUOTES, 'UTF-8'); ?>" 
     data-objref="448 0 R" data-field-name="topmostSubform[0].Page1[0].f1_46[0]"/>











<input id="form52_1" type="text" tabindex="52" value="" data-objref="449 0 R" data-field-name="topmostSubform[0].Page1[0].f1_47[0]"/>
<input id="form53_1" type="text" tabindex="53" maxlength="3" value="" data-objref="450 0 R" data-field-name="topmostSubform[0].Page1[0].f1_48[0]"/>
<input id="form54_1" type="text" tabindex="54" value="" data-objref="451 0 R" data-field-name="topmostSubform[0].Page1[0].f1_49[0]"/>
<input id="form55_1" type="text" tabindex="55" maxlength="3" value="" data-objref="452 0 R" data-field-name="topmostSubform[0].Page1[0].f1_50[0]"/>
<input id="form56_1" type="text" tabindex="56" value="" data-objref="453 0 R" data-field-name="topmostSubform[0].Page1[0].f1_51[0]"/>
<input id="form57_1" type="text" tabindex="57" maxlength="3" value="" data-objref="454 0 R" data-field-name="topmostSubform[0].Page1[0].f1_52[0]"/>
<input id="form58_1" type="text" style="margin-top: 3px;" tabindex="58" value="" data-objref="455 0 R" data-field-name="topmostSubform[0].Page1[0].f1_53[0]"/>
<input id="form59_1" type="text" style="text-align: left;margin-top: 3px;" tabindex="59" maxlength="3" value="" data-objref="456 0 R" data-field-name="topmostSubform[0].Page1[0].f1_54[0]"/>
<input id="form60_1" type="text" tabindex="60" value="" data-objref="457 0 R" data-field-name="topmostSubform[0].Page1[0].f1_55[0]"/>
<input id="form61_1" type="text" tabindex="61" maxlength="3" value="" data-objref="458 0 R" data-field-name="topmostSubform[0].Page1[0].f1_56[0]"/>
<input id="form62_1" type="text" tabindex="62" value="" data-objref="459 0 R" data-field-name="topmostSubform[0].Page1[0].f1_57[0]"/>
<input id="form63_1" type="text" tabindex="63" maxlength="3" value="" data-objref="460 0 R" data-field-name="topmostSubform[0].Page1[0].f1_58[0]"/>
<input id="form64_1" type="button" tabindex="64" disabled="disabled" data-objref="461 0 R" data-field-name="topmostSubform[0].Page1[0].f1_59[0]"/>
<input id="form65_1" type="button" tabindex="65" maxlength="3" disabled="disabled" data-objref="462 0 R" data-field-name="topmostSubform[0].Page1[0].f1_60[0]"/>

<!-- End Form Data -->

</div>

</div>
</div>
<div id="page2" style="width: 934px; height: 1209px; margin-top:20px;" class="page">
<div class="page-inner" style="width: 934px; height: 1209px;">

<div id="p2" class="pageArea" style="overflow: hidden; position: relative; width: 934px; height: 1209px; margin-top:auto; margin-left:auto; margin-right:auto; background-color: white;">

<!-- Begin shared CSS values -->
<style class="shared-css" type="text/css" >
.t {
	transform-origin: bottom left;
	z-index: 2;
	position: absolute;
	white-space: pre;
	overflow: visible;
	line-height: 1.5;
}
.text-container {
	white-space: pre;
}
@supports (-webkit-touch-callout: none) {
	.text-container {
		white-space: normal;
	}
}
</style>
<!-- End shared CSS values -->


<!-- Begin inline CSS -->
<style type="text/css" >

#t1_2{left:814px;bottom:1134px;letter-spacing:0.2px;}
#t2_2{left:55px;bottom:1120px;letter-spacing:-0.17px;}
#t3_2{left:88px;bottom:1120px;letter-spacing:-0.14px;}
#t4_2{left:611px;bottom:1120px;letter-spacing:-0.15px;}
#t5_2{left:661px;bottom:1096px;}
#t6_2{left:60px;bottom:1078px;letter-spacing:-0.11px;}
#t7_2{left:122px;bottom:1080px;letter-spacing:-0.12px;}
#t8_2{left:389px;bottom:1080px;letter-spacing:-0.11px;}
#t9_2{left:63px;bottom:1051px;letter-spacing:-0.01px;}
#ta_2{left:99px;bottom:1051px;letter-spacing:-0.01px;word-spacing:0.48px;}
#tb_2{left:99px;bottom:1035px;letter-spacing:-0.01px;}
#tc_2{left:422px;bottom:1035px;}
#td_2{left:440px;bottom:1035px;}
#te_2{left:458px;bottom:1035px;}
#tf_2{left:477px;bottom:1035px;}
#tg_2{left:495px;bottom:1035px;}
#th_2{left:513px;bottom:1035px;}
#ti_2{left:532px;bottom:1035px;}
#tj_2{left:550px;bottom:1035px;}
#tk_2{left:568px;bottom:1035px;}
#tl_2{left:587px;bottom:1035px;}
#tm_2{left:605px;bottom:1035px;}
#tn_2{left:623px;bottom:1035px;}
#to_2{left:642px;bottom:1035px;}
#tp_2{left:659px;bottom:1034px;letter-spacing:-0.01px;}
#tq_2{left:839px;bottom:1032px;}
#tr_2{left:63px;bottom:991px;letter-spacing:-0.01px;}
#ts_2{left:99px;bottom:991px;letter-spacing:-0.01px;}
#tt_2{left:257px;bottom:991px;}
#tu_2{left:275px;bottom:991px;}
#tv_2{left:293px;bottom:991px;}
#tw_2{left:312px;bottom:991px;}
#tx_2{left:330px;bottom:991px;}
#ty_2{left:348px;bottom:991px;}
#tz_2{left:367px;bottom:991px;}
#t10_2{left:385px;bottom:991px;}
#t11_2{left:403px;bottom:991px;}
#t12_2{left:422px;bottom:991px;}
#t13_2{left:440px;bottom:991px;}
#t14_2{left:458px;bottom:991px;}
#t15_2{left:477px;bottom:991px;}
#t16_2{left:495px;bottom:991px;}
#t17_2{left:513px;bottom:991px;}
#t18_2{left:532px;bottom:991px;}
#t19_2{left:550px;bottom:991px;}
#t1a_2{left:568px;bottom:991px;}
#t1b_2{left:587px;bottom:991px;}
#t1c_2{left:605px;bottom:991px;}
#t1d_2{left:623px;bottom:991px;}
#t1e_2{left:642px;bottom:991px;}
#t1f_2{left:659px;bottom:991px;letter-spacing:-0.01px;}
#t1g_2{left:839px;bottom:986px;}
#t1h_2{left:63px;bottom:955px;letter-spacing:-0.01px;}
#t1i_2{left:99px;bottom:955px;letter-spacing:-0.01px;}
#t1j_2{left:257px;bottom:955px;}
#t1k_2{left:275px;bottom:955px;}
#t1l_2{left:293px;bottom:955px;}
#t1m_2{left:312px;bottom:955px;}
#t1n_2{left:330px;bottom:955px;}
#t1o_2{left:348px;bottom:955px;}
#t1p_2{left:367px;bottom:955px;}
#t1q_2{left:385px;bottom:955px;}
#t1r_2{left:403px;bottom:955px;}
#t1s_2{left:422px;bottom:955px;}
#t1t_2{left:440px;bottom:955px;}
#t1u_2{left:458px;bottom:955px;}
#t1v_2{left:477px;bottom:955px;}
#t1w_2{left:63px;bottom:918px;letter-spacing:-0.01px;}
#t1x_2{left:99px;bottom:918px;letter-spacing:-0.01px;}
#t1y_2{left:277px;bottom:918px;letter-spacing:-0.01px;}
#t1z_2{left:458px;bottom:918px;}
#t20_2{left:477px;bottom:918px;}
#t21_2{left:495px;bottom:918px;}
#t22_2{left:513px;bottom:918px;}
#t23_2{left:532px;bottom:918px;}
#t24_2{left:550px;bottom:918px;}
#t25_2{left:568px;bottom:918px;}
#t26_2{left:587px;bottom:918px;}
#t27_2{left:605px;bottom:918px;}
#t28_2{left:623px;bottom:918px;}
#t29_2{left:642px;bottom:918px;}
#t2a_2{left:659px;bottom:918px;letter-spacing:-0.01px;}
#t2b_2{left:839px;bottom:913px;}
#t2c_2{left:63px;bottom:881px;letter-spacing:-0.01px;}
#t2d_2{left:99px;bottom:881px;letter-spacing:-0.01px;}
#t2e_2{left:454px;bottom:881px;letter-spacing:-0.01px;}
#t2f_2{left:642px;bottom:881px;}
#t2g_2{left:664px;bottom:881px;letter-spacing:-0.01px;}
#t2h_2{left:839px;bottom:876px;}
#t2i_2{left:63px;bottom:849px;letter-spacing:-0.01px;}
#t2j_2{left:99px;bottom:850px;letter-spacing:-0.01px;word-spacing:7.06px;}
#t2k_2{left:99px;bottom:834px;letter-spacing:-0.01px;}
#t2l_2{left:659px;bottom:833px;letter-spacing:-0.01px;}
#t2m_2{left:839px;bottom:830px;}
#t2n_2{left:63px;bottom:799px;letter-spacing:-0.01px;}
#t2o_2{left:99px;bottom:799px;letter-spacing:-0.01px;}
#t2p_2{left:257px;bottom:799px;}
#t2q_2{left:275px;bottom:799px;}
#t2r_2{left:293px;bottom:799px;}
#t2s_2{left:312px;bottom:799px;}
#t2t_2{left:330px;bottom:799px;}
#t2u_2{left:348px;bottom:799px;}
#t2v_2{left:367px;bottom:799px;}
#t2w_2{left:385px;bottom:799px;}
#t2x_2{left:403px;bottom:799px;}
#t2y_2{left:422px;bottom:799px;}
#t2z_2{left:440px;bottom:799px;}
#t30_2{left:458px;bottom:799px;}
#t31_2{left:477px;bottom:799px;}
#t32_2{left:495px;bottom:799px;}
#t33_2{left:513px;bottom:799px;}
#t34_2{left:532px;bottom:799px;}
#t35_2{left:550px;bottom:799px;}
#t36_2{left:568px;bottom:799px;}
#t37_2{left:587px;bottom:799px;}
#t38_2{left:605px;bottom:799px;}
#t39_2{left:623px;bottom:799px;}
#t3a_2{left:642px;bottom:799px;}
#t3b_2{left:659px;bottom:799px;letter-spacing:-0.01px;}
#t3c_2{left:839px;bottom:794px;}
#t3d_2{left:63px;bottom:767px;letter-spacing:-0.01px;}
#t3e_2{left:99px;bottom:767px;letter-spacing:-0.01px;word-spacing:2.09px;}
#t3f_2{left:99px;bottom:751px;letter-spacing:-0.01px;}
#t3g_2{left:238px;bottom:751px;}
#t3h_2{left:257px;bottom:751px;}
#t3i_2{left:275px;bottom:751px;}
#t3j_2{left:293px;bottom:751px;}
#t3k_2{left:312px;bottom:751px;}
#t3l_2{left:330px;bottom:751px;}
#t3m_2{left:348px;bottom:751px;}
#t3n_2{left:367px;bottom:751px;}
#t3o_2{left:385px;bottom:751px;}
#t3p_2{left:403px;bottom:751px;}
#t3q_2{left:422px;bottom:751px;}
#t3r_2{left:440px;bottom:751px;}
#t3s_2{left:458px;bottom:751px;}
#t3t_2{left:477px;bottom:751px;}
#t3u_2{left:495px;bottom:751px;}
#t3v_2{left:513px;bottom:751px;}
#t3w_2{left:532px;bottom:751px;}
#t3x_2{left:550px;bottom:751px;}
#t3y_2{left:568px;bottom:751px;}
#t3z_2{left:587px;bottom:751px;}
#t40_2{left:605px;bottom:751px;}
#t41_2{left:623px;bottom:751px;}
#t42_2{left:642px;bottom:751px;}
#t43_2{left:659px;bottom:750px;letter-spacing:-0.01px;}
#t44_2{left:839px;bottom:748px;}
#t45_2{left:63px;bottom:716px;letter-spacing:-0.01px;}
#t46_2{left:99px;bottom:716px;letter-spacing:-0.01px;}
#t47_2{left:257px;bottom:716px;}
#t48_2{left:275px;bottom:716px;}
#t49_2{left:293px;bottom:716px;}
#t4a_2{left:312px;bottom:716px;}
#t4b_2{left:330px;bottom:716px;}
#t4c_2{left:348px;bottom:716px;}
#t4d_2{left:367px;bottom:716px;}
#t4e_2{left:385px;bottom:716px;}
#t4f_2{left:403px;bottom:716px;}
#t4g_2{left:422px;bottom:716px;}
#t4h_2{left:440px;bottom:716px;}
#t4i_2{left:458px;bottom:716px;}
#t4j_2{left:477px;bottom:716px;}
#t4k_2{left:495px;bottom:716px;}
#t4l_2{left:513px;bottom:716px;}
#t4m_2{left:532px;bottom:716px;}
#t4n_2{left:550px;bottom:716px;}
#t4o_2{left:568px;bottom:716px;}
#t4p_2{left:587px;bottom:716px;}
#t4q_2{left:605px;bottom:716px;}
#t4r_2{left:623px;bottom:716px;}
#t4s_2{left:642px;bottom:716px;}
#t4t_2{left:659px;bottom:716px;letter-spacing:-0.01px;}
#t4u_2{left:839px;bottom:711px;}
#t4v_2{left:63px;bottom:684px;letter-spacing:-0.01px;}
#t4w_2{left:99px;bottom:685px;letter-spacing:-0.01px;word-spacing:2.09px;}
#t4x_2{left:99px;bottom:669px;letter-spacing:-0.01px;}
#t4y_2{left:403px;bottom:669px;}
#t4z_2{left:422px;bottom:669px;}
#t50_2{left:440px;bottom:669px;}
#t51_2{left:458px;bottom:669px;}
#t52_2{left:477px;bottom:669px;}
#t53_2{left:495px;bottom:669px;}
#t54_2{left:513px;bottom:669px;}
#t55_2{left:532px;bottom:669px;}
#t56_2{left:550px;bottom:669px;}
#t57_2{left:568px;bottom:669px;}
#t58_2{left:587px;bottom:669px;}
#t59_2{left:605px;bottom:669px;}
#t5a_2{left:623px;bottom:669px;}
#t5b_2{left:642px;bottom:669px;}
#t5c_2{left:659px;bottom:668px;letter-spacing:-0.01px;}
#t5d_2{left:839px;bottom:665px;}
#t5e_2{left:63px;bottom:625px;letter-spacing:-0.01px;}
#t5f_2{left:99px;bottom:625px;letter-spacing:-0.01px;}
#t5g_2{left:257px;bottom:625px;}
#t5h_2{left:275px;bottom:625px;}
#t5i_2{left:293px;bottom:625px;}
#t5j_2{left:312px;bottom:625px;}
#t5k_2{left:330px;bottom:625px;}
#t5l_2{left:348px;bottom:625px;}
#t5m_2{left:367px;bottom:625px;}
#t5n_2{left:385px;bottom:625px;}
#t5o_2{left:403px;bottom:625px;}
#t5p_2{left:422px;bottom:625px;}
#t5q_2{left:440px;bottom:625px;}
#t5r_2{left:458px;bottom:625px;}
#t5s_2{left:477px;bottom:625px;}
#t5t_2{left:495px;bottom:625px;}
#t5u_2{left:513px;bottom:625px;}
#t5v_2{left:532px;bottom:625px;}
#t5w_2{left:550px;bottom:625px;}
#t5x_2{left:568px;bottom:625px;}
#t5y_2{left:587px;bottom:625px;}
#t5z_2{left:605px;bottom:625px;}
#t60_2{left:623px;bottom:625px;}
#t61_2{left:642px;bottom:625px;}
#t62_2{left:662px;bottom:626px;letter-spacing:-0.01px;}
#t63_2{left:839px;bottom:620px;}
#t64_2{left:63px;bottom:588px;letter-spacing:-0.01px;}
#t65_2{left:99px;bottom:588px;letter-spacing:-0.01px;}
#t66_2{left:337px;bottom:588px;letter-spacing:-0.01px;}
#t67_2{left:513px;bottom:588px;}
#t68_2{left:532px;bottom:588px;}
#t69_2{left:550px;bottom:588px;}
#t6a_2{left:568px;bottom:588px;}
#t6b_2{left:587px;bottom:588px;}
#t6c_2{left:605px;bottom:588px;}
#t6d_2{left:623px;bottom:588px;}
#t6e_2{left:642px;bottom:588px;}
#t6f_2{left:659px;bottom:588px;letter-spacing:-0.01px;}
#t6g_2{left:839px;bottom:583px;}
#t6h_2{left:63px;bottom:551px;letter-spacing:-0.01px;}
#t6i_2{left:99px;bottom:551px;letter-spacing:-0.01px;}
#t6j_2{left:257px;bottom:551px;}
#t6k_2{left:275px;bottom:551px;}
#t6l_2{left:293px;bottom:551px;}
#t6m_2{left:312px;bottom:551px;}
#t6n_2{left:330px;bottom:551px;}
#t6o_2{left:348px;bottom:551px;}
#t6p_2{left:367px;bottom:551px;}
#t6q_2{left:385px;bottom:551px;}
#t6r_2{left:403px;bottom:551px;}
#t6s_2{left:422px;bottom:551px;}
#t6t_2{left:440px;bottom:551px;}
#t6u_2{left:458px;bottom:551px;}
#t6v_2{left:477px;bottom:551px;}
#t6w_2{left:495px;bottom:551px;}
#t6x_2{left:513px;bottom:551px;}
#t6y_2{left:532px;bottom:551px;}
#t6z_2{left:550px;bottom:551px;}
#t70_2{left:568px;bottom:551px;}
#t71_2{left:587px;bottom:551px;}
#t72_2{left:605px;bottom:551px;}
#t73_2{left:623px;bottom:551px;}
#t74_2{left:642px;bottom:551px;}
#t75_2{left:659px;bottom:551px;letter-spacing:-0.01px;}
#t76_2{left:839px;bottom:546px;}
#t77_2{left:63px;bottom:515px;letter-spacing:-0.01px;}
#t78_2{left:99px;bottom:515px;letter-spacing:-0.01px;}
#t79_2{left:257px;bottom:515px;}
#t7a_2{left:275px;bottom:515px;}
#t7b_2{left:293px;bottom:515px;}
#t7c_2{left:312px;bottom:515px;}
#t7d_2{left:330px;bottom:515px;}
#t7e_2{left:348px;bottom:515px;}
#t7f_2{left:367px;bottom:515px;}
#t7g_2{left:385px;bottom:515px;}
#t7h_2{left:403px;bottom:515px;}
#t7i_2{left:422px;bottom:515px;}
#t7j_2{left:440px;bottom:515px;}
#t7k_2{left:458px;bottom:515px;}
#t7l_2{left:477px;bottom:515px;}
#t7m_2{left:495px;bottom:515px;}
#t7n_2{left:513px;bottom:515px;}
#t7o_2{left:532px;bottom:515px;}
#t7p_2{left:550px;bottom:515px;}
#t7q_2{left:568px;bottom:515px;}
#t7r_2{left:587px;bottom:515px;}
#t7s_2{left:605px;bottom:515px;}
#t7t_2{left:623px;bottom:515px;}
#t7u_2{left:642px;bottom:515px;}
#t7v_2{left:663px;bottom:515px;letter-spacing:-0.01px;}
#t7w_2{left:839px;bottom:510px;}
#t7x_2{left:63px;bottom:478px;letter-spacing:-0.01px;}
#t7y_2{left:99px;bottom:478px;letter-spacing:-0.01px;}
#t7z_2{left:183px;bottom:478px;letter-spacing:-0.01px;}
#t80_2{left:605px;bottom:478px;}
#t81_2{left:623px;bottom:478px;}
#t82_2{left:642px;bottom:478px;}
#t83_2{left:664px;bottom:478px;letter-spacing:-0.01px;}
#t84_2{left:839px;bottom:473px;}
#t85_2{left:63px;bottom:441px;letter-spacing:-0.01px;}
#t86_2{left:99px;bottom:441px;letter-spacing:-0.01px;}
#t87_2{left:182px;bottom:441px;letter-spacing:-0.01px;}
#t88_2{left:564px;bottom:436px;}
#t89_2{left:608px;bottom:441px;letter-spacing:-0.01px;}
#t8a_2{left:704px;bottom:442px;letter-spacing:-0.03px;}
#t8b_2{left:814px;bottom:442px;letter-spacing:-0.03px;}
#t8c_2{left:60px;bottom:409px;letter-spacing:-0.11px;}
#t8d_2{left:122px;bottom:409px;letter-spacing:-0.11px;}
#t8e_2{left:55px;bottom:386px;letter-spacing:-0.01px;}
#t8f_2{left:63px;bottom:354px;letter-spacing:-0.01px;}
#t8g_2{left:88px;bottom:354px;letter-spacing:-0.01px;}
#t8h_2{left:198px;bottom:359px;letter-spacing:-0.01px;word-spacing:0.85px;}
#t8i_2{left:198px;bottom:345px;letter-spacing:-0.01px;word-spacing:0.86px;}
#t8j_2{left:744px;bottom:345px;letter-spacing:-0.01px;word-spacing:0.86px;}
#t8k_2{left:198px;bottom:332px;letter-spacing:-0.01px;word-spacing:1.69px;}
#t8l_2{left:198px;bottom:319px;letter-spacing:-0.01px;word-spacing:3.01px;}
#t8m_2{left:198px;bottom:305px;letter-spacing:-0.01px;}
#t8n_2{left:198px;bottom:282px;letter-spacing:-0.01px;word-spacing:0.87px;}
#t8o_2{left:591px;bottom:282px;letter-spacing:-0.01px;word-spacing:0.87px;}
#t8p_2{left:198px;bottom:265px;letter-spacing:-0.01px;}
#t8q_2{left:198px;bottom:231px;letter-spacing:-0.01px;}
#t8r_2{left:286px;bottom:231px;letter-spacing:-0.01px;}
#t8s_2{left:506px;bottom:225px;}
#t8t_2{left:286px;bottom:198px;letter-spacing:-0.01px;}
#t8u_2{left:506px;bottom:193px;}
#t8v_2{left:286px;bottom:165px;letter-spacing:-0.01px;}
#t8w_2{left:506px;bottom:160px;}
#t8x_2{left:187px;bottom:132px;letter-spacing:-0.01px;}
#t8y_2{left:506px;bottom:127px;}
#t8z_2{left:561px;bottom:132px;letter-spacing:-0.01px;}
#t90_2{left:198px;bottom:108px;letter-spacing:-0.01px;word-spacing:0.7px;}
#t91_2{left:648px;bottom:108px;letter-spacing:-0.01px;}
#t92_2{left:708px;bottom:108px;letter-spacing:-0.01px;word-spacing:0.7px;}
#t93_2{left:198px;bottom:91px;letter-spacing:-0.01px;}
#t94_2{left:77px;bottom:61px;letter-spacing:-0.01px;}
#t95_2{left:55px;bottom:44px;letter-spacing:-0.14px;}
#t96_2{left:83px;bottom:42px;}
#t97_2{left:760px;bottom:44px;letter-spacing:-0.14px;}
#t98_2{left:788px;bottom:42px;letter-spacing:0.15px;}
#t99_2{left:816px;bottom:44px;letter-spacing:-0.14px;}

.s0_2{font-size:15px;font-family:OCRAStd_1fm_2;color:#000;}
.s1_2{font-size:11px;font-family:HelveticaNeueLTStd-Bd_1fn_2;color:#000;}
.s2_2{font-size:11px;font-family:HelveticaNeueLTStd-It_1fo_2;color:#000;}
.s3_2{font-size:15px;font-family:HelveticaNeueLTStd-Roman_1fp_2;color:#000;}
.s4_2{font-size:14px;font-family:HelveticaNeueLTStd-Bd_1fn_2;color:#FFF;}
.s5_2{font-size:14px;font-family:HelveticaNeueLTStd-Bd_1fn_2;color:#000;}
.s6_2{font-size:14px;font-family:HelveticaNeueLTStd-It_1fo_2;color:#000;}
.s7_2{font-size:13px;font-family:HelveticaNeueLTStd-Bd_1fn_2;color:#000;}
.s8_2{font-size:13px;font-family:HelveticaNeueLTStd-Roman_1fp_2;color:#000;}
.s9_2{font-size:26px;font-family:HelveticaNeueLTStd-Bd_1fn_2;color:#000;}
.sa_2{font-size:10px;font-family:HelveticaNeueLTStd-Roman_1fp_2;color:#000;}
.sb_2{font-size:11px;font-family:HelveticaNeueLTStd-Roman_1fp_2;color:#000;}
.sc_2{font-size:15px;font-family:HelveticaNeueLTStd-Bd_1fn_2;color:#000;}
.t.v0_2{transform:scaleX(0.89);}
.t.v1_2{transform:scaleX(0.92);}
.t.v2_2{transform:scaleX(0.88);}
#form1_2{	z-index: 2;	padding: 0px;	position: absolute;	left: 55px;	top: 87px;	width: 381px;	height: 20px;	color: rgb(0,0,0);	text-align: left;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form2_2{	z-index: 2;	padding: 0px;	position: absolute;	left: 627px;	top: 87px;	width: 32px;	height: 20px;	color: rgb(0,0,0);	text-align: center;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form3_2{	z-index: 2;	padding: 0px;	position: absolute;	left: 669px;	top: 87px;	width: 75px;	height: 20px;	color: rgb(0,0,0);	text-align: center;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form4_2{	z-index: 2;	padding: 0px;	position: absolute;	left: 682px;	top: 145px;	width: 153px;	height: 20px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form5_2{	z-index: 2;	padding: 0px;	position: absolute;	left: 847px;	top: 145px;	width: 31px;	height: 20px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form6_2{	z-index: 2;	background-size: 100% 100%;	background-image: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGcAAAAQCAMAAAA8uJGyAAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAABVJREFUeNpjYBgFo2AUjIJRMAroDwAGgAABi47q4AAAAABJRU5ErkJggg==");	background-repeat: no-repeat;	border-style: none;	padding: 0px;	position: absolute;	left: 682px;	top: 191px;	width: 154px;	height: 22px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	font: normal 15px 'Times New Roman', Times, serif;}
#form7_2{	z-index: 2;	background-size: 100% 100%;	background-image: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABcAAAAQCAMAAADK8RQqAAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAAA1JREFUeNpjYBgFAwkAAYAAAWvLIfwAAAAASUVORK5CYII=");	background-repeat: no-repeat;	border-style: none;	padding: 0px;	position: absolute;	left: 847px;	top: 191px;	width: 32px;	height: 22px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	font: normal 15px 'Times New Roman', Times, serif;}
#form8_2{	z-index: 2;	background-size: 100% 100%;	background-image: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFgAAAAQCAMAAAClQEgHAAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAABRJREFUeNpjYBgFo2AUjIJRMBgAAAWQAAE1+mUJAAAAAElFTkSuQmCC");	background-repeat: no-repeat;	border-style: none;	padding: 0px;	position: absolute;	left: 495px;	top: 228px;	width: 132px;	height: 22px;	color: rgb(0,0,0);	text-align: center;	background: transparent;	font: normal 15px 'Times New Roman', Times, serif;}
#form9_2{	z-index: 2;	padding: 0px;	position: absolute;	left: 682px;	top: 264px;	width: 153px;	height: 20px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form10_2{	z-index: 2;	padding: 0px;	position: absolute;	left: 847px;	top: 264px;	width: 31px;	height: 20px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form11_2{	z-index: 2;	padding: 0px;	position: absolute;	left: 682px;	top: 301px;	width: 153px;	height: 20px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form12_2{	z-index: 2;	padding: 0px;	position: absolute;	left: 847px;	top: 301px;	width: 31px;	height: 20px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form13_2{	z-index: 2;	padding: 0px;	position: absolute;	left: 682px;	top: 347px;	width: 153px;	height: 20px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form14_2{	z-index: 2;	padding: 0px;	position: absolute;	left: 847px;	top: 347px;	width: 31px;	height: 20px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form15_2{	z-index: 2;	background-size: 100% 100%;	background-image: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGcAAAAQCAMAAAA8uJGyAAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAABVJREFUeNpjYBgFo2AUjIJRMAroDwAGgAABi47q4AAAAABJRU5ErkJggg==");	background-repeat: no-repeat;	border-style: none;	padding: 0px;	position: absolute;	left: 682px;	top: 384px;	width: 154px;	height: 22px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	font: normal 15px 'Times New Roman', Times, serif;}
#form16_2{	z-index: 2;	background-size: 100% 100%;	background-image: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABcAAAAQCAMAAADK8RQqAAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAAA1JREFUeNpjYBgFAwkAAYAAAWvLIfwAAAAASUVORK5CYII=");	background-repeat: no-repeat;	border-style: none;	padding: 0px;	position: absolute;	left: 847px;	top: 384px;	width: 32px;	height: 22px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	font: normal 15px 'Times New Roman', Times, serif;}
#form17_2{	z-index: 2;	padding: 0px;	position: absolute;	left: 682px;	top: 429px;	width: 153px;	height: 20px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form18_2{	z-index: 2;	padding: 0px;	position: absolute;	left: 847px;	top: 429px;	width: 31px;	height: 20px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form19_2{	z-index: 2;	background-size: 100% 100%;	background-image: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGcAAAAQCAMAAAA8uJGyAAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAABVJREFUeNpjYBgFo2AUjIJRMAroDwAGgAABi47q4AAAAABJRU5ErkJggg==");	background-repeat: no-repeat;	border-style: none;	padding: 0px;	position: absolute;	left: 682px;	top: 466px;	width: 154px;	height: 22px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	font: normal 15px 'Times New Roman', Times, serif;}
#form20_2{	z-index: 2;	background-size: 100% 100%;	background-image: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABcAAAAQCAMAAADK8RQqAAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAAA1JREFUeNpjYBgFAwkAAYAAAWvLIfwAAAAASUVORK5CYII=");	background-repeat: no-repeat;	border-style: none;	padding: 0px;	position: absolute;	left: 847px;	top: 466px;	width: 32px;	height: 22px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	font: normal 15px 'Times New Roman', Times, serif;}
#form21_2{	z-index: 2;	padding: 0px;	position: absolute;	left: 682px;	top: 512px;	width: 153px;	height: 20px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form22_2{	z-index: 2;	padding: 0px;	position: absolute;	left: 847px;	top: 512px;	width: 31px;	height: 20px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form23_2{	z-index: 2;	background-size: 100% 100%;	background-image: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGcAAAAQCAMAAAA8uJGyAAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAABVJREFUeNpjYBgFo2AUjIJRMAroDwAGgAABi47q4AAAAABJRU5ErkJggg==");	background-repeat: no-repeat;	border-style: none;	padding: 0px;	position: absolute;	left: 682px;	top: 558px;	width: 154px;	height: 22px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	font: normal 15px 'Times New Roman', Times, serif;}
#form24_2{	z-index: 2;	background-size: 100% 100%;	background-image: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABcAAAAQCAMAAADK8RQqAAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAAA1JREFUeNpjYBgFAwkAAYAAAWvLIfwAAAAASUVORK5CYII=");	background-repeat: no-repeat;	border-style: none;	padding: 0px;	position: absolute;	left: 847px;	top: 558px;	width: 32px;	height: 22px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	font: normal 15px 'Times New Roman', Times, serif;}
#form25_2{	z-index: 2;	padding: 0px;	position: absolute;	left: 682px;	top: 594px;	width: 153px;	height: 20px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form26_2{	z-index: 2;	padding: 0px;	position: absolute;	left: 847px;	top: 594px;	width: 31px;	height: 20px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form27_2{	z-index: 2;	background-size: 100% 100%;	background-image: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGcAAAAQCAMAAAA8uJGyAAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAABVJREFUeNpjYBgFo2AUjIJRMAroDwAGgAABi47q4AAAAABJRU5ErkJggg==");	background-repeat: no-repeat;	border-style: none;	padding: 0px;	position: absolute;	left: 682px;	top: 631px;	width: 154px;	height: 22px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	font: normal 15px 'Times New Roman', Times, serif;}
#form28_2{	z-index: 2;	background-size: 100% 100%;	background-image: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABcAAAAQCAMAAADK8RQqAAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAAA1JREFUeNpjYBgFAwkAAYAAAWvLIfwAAAAASUVORK5CYII=");	background-repeat: no-repeat;	border-style: none;	padding: 0px;	position: absolute;	left: 847px;	top: 631px;	width: 32px;	height: 22px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	font: normal 15px 'Times New Roman', Times, serif;}
#form29_2{	z-index: 2;	background-size: 100% 100%;	background-image: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGcAAAAQCAMAAAA8uJGyAAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAABVJREFUeNpjYBgFo2AUjIJRMAroDwAGgAABi47q4AAAAABJRU5ErkJggg==");	background-repeat: no-repeat;	border-style: none;	padding: 0px;	position: absolute;	left: 682px;	top: 668px;	width: 154px;	height: 22px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	font: normal 15px 'Times New Roman', Times, serif;}
#form30_2{	z-index: 2;	background-size: 100% 100%;	background-image: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABcAAAAQCAMAAADK8RQqAAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAAA1JREFUeNpjYBgFAwkAAYAAAWvLIfwAAAAASUVORK5CYII=");	background-repeat: no-repeat;	border-style: none;	padding: 0px;	position: absolute;	left: 847px;	top: 668px;	width: 32px;	height: 22px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	font: normal 15px 'Times New Roman', Times, serif;}
#form31_2{	z-index: 2;	padding: 0px;	position: absolute;	left: 682px;	top: 704px;	width: 153px;	height: 20px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form32_2{	z-index: 2;	padding: 0px;	position: absolute;	left: 847px;	top: 704px;	width: 31px;	height: 20px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form33_2{	z-index: 2;	border-style: none;	padding: 0px;	position: absolute;	left: 682px;	top: 747px;	width: 15px;	height: 15px;	color: rgb(0,0,0);	text-align: left;	background: transparent;	font: normal 12px Wingdings, 'Zapf Dingbats';}
#form34_2{	z-index: 2;	border-style: none;	padding: 0px;	position: absolute;	left: 792px;	top: 747px;	width: 15px;	height: 15px;	color: rgb(0,0,0);	text-align: left;	background: transparent;	font: normal 12px Wingdings, 'Zapf Dingbats';}
#form35_2{	z-index: 2;	padding: 0px;	position: absolute;	left: 462px;	top: 741px;	width: 98px;	height: 20px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form36_2{	z-index: 2;	padding: 0px;	position: absolute;	left: 572px;	top: 741px;	width: 31px;	height: 20px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form37_2{	z-index: 2;	border-style: none;	padding: 0px;	position: absolute;	left: 167px;	top: 834px;	width: 15px;	height: 15px;	color: rgb(0,0,0);	text-align: left;	background: transparent;	font: normal 12px Wingdings, 'Zapf Dingbats';}
#form38_2{	z-index: 2;	border-style: none;	padding: 0px;	position: absolute;	left: 167px;	top: 908px;	width: 15px;	height: 15px;	color: rgb(0,0,0);	text-align: left;	background: transparent;	font: normal 12px Wingdings, 'Zapf Dingbats';}
#form39_2{	z-index: 2;	padding: 0px;	position: absolute;	left: 352px;	top: 952px;	width: 153px;	height: 20px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form40_2{	z-index: 2;	padding: 0px;	position: absolute;	left: 517px;	top: 952px;	width: 31px;	height: 20px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form41_2{	z-index: 2;	padding: 0px;	position: absolute;	left: 352px;	top: 986px;	width: 153px;	height: 20px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form42_2{	z-index: 2;	padding: 0px;	position: absolute;	left: 517px;	top: 986px;	width: 31px;	height: 20px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form43_2{	z-index: 2;	padding: 0px;	position: absolute;	left: 352px;	top: 1018px;	width: 153px;	height: 20px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form44_2{	z-index: 2;	padding: 0px;	position: absolute;	left: 517px;	top: 1018px;	width: 31px;	height: 20px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form45_2{	z-index: 2;	padding: 0px;	position: absolute;	left: 352px;	top: 1051px;	width: 153px;	height: 20px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form46_2{	z-index: 2;	padding: 0px;	position: absolute;	left: 517px;	top: 1051px;	width: 31px;	height: 20px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form47_2{	z-index: 2;	border-style: none;	padding: 0px;	position: absolute;	left: 167px;	top: 1082px;	width: 15px;	height: 15px;	color: rgb(0,0,0);	text-align: left;	background: transparent;	font: normal 12px Wingdings, 'Zapf Dingbats';}
#form33_2 { z-index:6; }
#form34_2 { z-index:5; }
#form37_2 { z-index:4; }
#form38_2 { z-index:3; }
#form47_2 { z-index:2; }

</style>
<!-- End inline CSS -->

<!-- Begin embedded font definitions -->
<style id="fonts2" type="text/css" >

@font-face {
	font-family: HelveticaNeueLTStd-Bd_1fn_2;
	src: url(data:application/font-woff;charset=utf-8;base64,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) format("woff"),
url(data:font/truetype;charset=utf-8;base64,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) format("otf");
}

@font-face {
	font-family: HelveticaNeueLTStd-It_1fo_2;
	src: url(data:application/font-woff;charset=utf-8;base64,d09GRk9UVE8AAAoUAAkAAAAADhgAAQABAAAAAAAAAAAAAAAAAAAAAAAAAABDRkYgAAAA4AAABigAAAasW1c3+U9TLzIAAAcIAAAAKgAAAGAJsQfRY21hcAAABzQAAADcAAACUjQm9nVoZWFkAAAIEAAAADMAAAA2+MO3y2hoZWEAAAhEAAAAHgAAACQEuAGgaG10eAAACGQAAABWAAAA5nJUAABtYXhwAAAIvAAAAAYAAAAGADpQAG5hbWUAAAjEAAABPAAAAq9hLKszcG9zdAAACgAAAAATAAAAIP+GADZ4nH2Sf1AURxbHe2a2RzQeSdhbT3esnREVLhYiECHiqQGCIIoaxZhI/LXODrD82CWzu+ACZkV0EXUjsCCCRFQEIUokRA0BtYxnfhwKaFK3l5RnnFAJFatylUoulzfaVt3N6iX5Lz1V3VP93vv2p973UUhHI4qipi+TCkskp1U0r5JcUua6LKdlboZzS2yOfUtcMB6ucpQ6VeeZTJOFJP/B+IM1GL5+Un3y6VPT2dowdfpkA6Ip6sf/vmAvdsvW3DynEJu4YEGUtifGPNqfjRLiYmLihGSLfZskZLkdTqnIIWTYRLtcbJfNTskSLSQXFgprg8UOYa3kkOSS4OWvYILVIZgFp2y2SEVmuUCw52gxq0Uq3CbJuZIspMousaDI7BDzrDbJJiSnRwnSdrHQ5bCWSIVuodAqSjaHZBGcebLdlZsnZFptdqe7WNJ+tslm2S2kF21bFiWYbRahyOwWNEpZyrVqnLJWZLUJoiQ7zdqZ75KtDotVdFrtNkf0vLSsdUGR+YJFykGI0j4UwqA/TERGhASEwhGahVAEhZ6hUDSD5iOUQKOFCKVMRQu1ziMaYcSi55EblaFyVIF2oNeRB+1ElWgXqkK70R7kRdVoL6pB+9B+dAD50BvoIKpFdage+VEDaqQiqT9TxdR1ehY9m46gI+lV9Gr6RXoNPcrwjMTkMLnMO0yfjtat0q3Wvahbo3szlAyFhpI7ZGnJg/hS6m2FgSSSbcj5uQJ0gI1Q9i9YD7Mh2bSUJZGa2wxZREqNJKSHRA6Em34rhDCF2agVQiQkAgOLoNQIk6wwcyMgUxbbK7QQTLCRlM0h60kESTKF/t5K8wRULkBVKvCRwgSAMwx/cPSTBtPf/CO1vcdDfKznVe8muyVkU1G2K4N7dXP7ID8EJYaRxusdN7j+jzxZaaI3toonbCWJrCRzjDM+E78au9Q5eNbkq8GbvSftA1xLe239Yf7wEN5btbO6itux09/e3th18Bh/BmbgulONvV3Gn+I6Iwk9Zz2ZUKbRvvIY6ZgCQwqj1sB/DDC5OuWvZCJHVkaQaLKA8J89BzPgibFhmNDNJ7CZjpe2pnBR+aO3Ad+CKfCn4QtSJh9a6wlkDmlKsLI0rFXR9/8AGw3A3gIBuLvvr11CUAp5hhiixSt3TeoB9ZDhOXYd6cI17M3SxcczOZIxgySRWBL2aTxMvXn56Mhl3sfqt7uT8W02iAhLAhARoBoVGNWMpOETw+2THwx/z907k5Kyh/88yfBGc21HpxEiln1Jokg4eYpwJDt2kEyC5wHf+xjYTlMCu8LxSl4yl7a8/3bLgRZfCx905CF9rERtLgX8b8oLHsY7RWEBqc04gQU9bDDEs66Z+Cs2mAmtWmZ2wFMadn+Tor8ZzPwQ2g9d9r919u1pPd2XTg9w73fIWz27LbtEfiUZxAp7Ddoa3jt0/lT3tN6uKz2DXH9PkVhRLVeX8y+Qf2rxGzCE67v873Ub76aeTklLl9aJppGKDR3LudTlOS9t4Wt8WN979HO8iA0t+OVx9dn/P/4x9B06d+Rcd8e0ntMXOwa4S+86s91VW6u38xnkqiY+BIO44d26vuPG8Y3n56QuLViz1VTD6nuPfIET2dAdj21vVWBMYX4As+HnUQiHKd9eWL5wdjqZSZ6Kzr6mmBL2GcjTd2JgOmT8BHGwGExL/kFMJIMgEkMWB2ed+DWwFd9oYF5V/xjsIrj9fU0XT5yZ1nnu7FsDTSG1bY37j3H+hv37/HzbOPZVVtZUcvNXvZwq8kGgk8Dgv2gtJh17AurEADUwzkDd/ThDAltA5uL5bHkSHmPTyd/x3vIaT4Ux44p7qK3Nd7DN1PIF9paXV5dxr8n+ziZf44Em/jpcwz+yRwJ4ltYyT8Ac9DasRdH3qq1qs6a4mvTheHdK4lxug3ji4pv+CweP8sNwVbM7U3Nsl7jH4jLGDJi/+/TW6Q8vmLQRLC5fjO888l8gOaPWErA9ksxUb+j7VZ+mGc2SoofztEFerc7DMez4w+aX43F+qcspcRUldf7Xef32ijSs7686csLbxo29c3XkPB9a1np/cyvJb2Kho/77+of3miYEJilPqFf+qCqG/wH6dtHdeJxjYGZiYJzAwMrAwJAGhAzoNCMcMGADDiCCWeG/BYhkOIGpAAAsoAWPAAB4nGNgYGBmgGAZBkYgycDoA+SBWFsYWBhmAGklBgUgiwlIajGYMlgy2DM4MjgzuDF4MgQwBDOEM0QyVCpI/v/7/z9QrQKDBoMOXI0rgweDL1BNKFBNIkTN/4f/b/+/9f/6/0v/L/6/8P/8/3P/T/8/+f/E/+P/D9x/CbWZEBis7mJgZAM5joAaKM3MwsrAxs7BycXNw8vHDxQQAAsLMggxCDOIiDKIiQN5EpJS0qCYkZWTB/oBAhSVlFVU1dQ1NLW0dXT19A0MjYxNTM3MLSyJcSGZgIl4pQDxzF99eJxjYGRgYADijRvW74rnt/nKwMD8AijCcJpxFwOM/h/1X4sliHkvkMvOwAQSBQBhCwwEAHicY2BkYGBW+G8BJNP+R/07wWTNABRBAZYAfhIFWwAAeJxj0mFgYBRjYGAC0cxQnIAkBqQZfSFsvHg2EtsOYR5zGlTsO5L8JTS97EAcCMSSCJpRA2EOwz2oeQ8hbOYQJHsCIRjkRpA8ozVCLchOsB4GADCaEbYAAAAAUAAAOgAAeJydj71qAkEUhc/4E0gCKdOkcNoQFNfCIkXSiKyiy6Jiuyz7oxPWGVl3BatU6fMegXR5ijxJ3iJn45DSwoGZ+825555hANzgEwLH1eI+ssAdb0euoYlHy3U84Nlyg54Xy01c483yBfV3OkXjkrcnfFgW6OPHcg1XomW5jqW4t9xAX7xabuJWfFm+oP7tGRmZ7SFXq3UhlU5NvgkLZbRMTanjjptk+6RQUeglZTJZzIu4PSoCJzVBb2Y2oR77SRxm0h8Me+5iOpEn/CdayyTfVW86ne4JFzwYSEQ8tzggh8IKaxTUFDRS6jk2CKkosqZeaSUpRgcuEmTY86z6EX0eueSeYIE51RhtjFgDOH+TAXqYsVaZGmP49MbkjMk+Bhiy73J2ygR5Zv55U0v2c+z+/+nwf93zsn4B6+iEF3icY2BmAIP/zQxmDFgAACiYAbwA) format("woff"),
url(data:font/truetype;charset=utf-8;base64,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) format("otf");
}

@font-face {
	font-family: HelveticaNeueLTStd-Roman_1fp_2;
	src: url(data:application/font-woff;charset=utf-8;base64,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) format("woff"),
url(data:font/truetype;charset=utf-8;base64,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) format("otf");
}

@font-face {
	font-family: OCRAStd_1fm_2;
	src: url(data:application/font-woff;charset=utf-8;base64,d09GRk9UVE8AAAUQAAkAAAAAB2wAAQABAAAAAAAAAAAAAAAAAAAAAAAAAABDRkYgAAAA4AAAAhAAAAJAQJT+009TLzIAAALwAAAAKgAAAGAJsQihY21hcAAAAxwAAABVAAABkgMqBeRoZWFkAAADdAAAADMAAAA29+e3LGhoZWEAAAOoAAAAIAAAACQCtAJ4aG10eAAAA8gAAAAMAAAADgLQAABtYXhwAAAD1AAAAAYAAAAGAAZQAG5hbWUAAAPcAAABHgAAAgdUa3L+cG9zdAAABPwAAAATAAAAIP+GADZ4nFWPwW8SURDG34PyNraIqXE1AbJvb1xMBU7IxZImTUxNNGLizVrdBVoLC7tbDDa0TfFQswlgYox4KQWWCtFuTPSC8R9QD544ePLmAcwe324eJkJj2pjMHObLzO/7BoIpB4AQem4u3I7FVWE5lEgvhycKtnzQujT1R6Alv6tuf3WRwDkSmv1odc9bfjcLHBAuxhekbEFeTaZUPnQ1ErnMh4PBMB8TpAciHy8oqphW+OuZh5KcleQVVRTm+Nj6On98oPCyqIhyfixeWYzfKWRFPsILYgIACGYd4CIAXgDQOBtwACdYAl3oh6sejy1optU3IfliDk2nNWeydpRqTE4pJpPNoo5JYNSnAXQyWxzSmzUDkyrzZqueSGzlMxy9xxxzSGlSkLhM0jOdZJX8YskRetuoNlr4UC+3DS9ZYYy9tqRzDVmtrvnoz1MwGdISfYfmRXEe0x/WLWZiYyi1HKZD9B8+ZZK7Y/w3O8qSZ+h07fdoiXwaQzbRplp7XsTpV67qzm5525fbUHKpzm57G79/4tppvX6q+4iMDL3SaeF6q3zQ9ZI15mivOcmlKNVHPnrjn2PfJMGTh6yKyWbyj9PZfbWDP6POfqON7SijbzQlbsQhaeyC6Qsmd6AccmSIaM9kSZD0aJDxaJplaN81wmofNETvaww37Xx5zX1Gc88Mpgczg4rbPe6ztnDhLwV6A/R4nGNgZrrAOIGBlYGBIQ0IGdBpRjhgwAYcQASzwn8LEMlwAlMBAHgwBl8AAHicY2BgYGaAYBkGRgYQ6AHyQKwQBhYGCyDNxcDBwASERgymDJb///7/DxQzgLH/X/x//v8ZqA4YIFcfAyMbA6oAEYCRiRlkIwMDK4kaBykAAHBqHwEAAAB4nGNgZGBgAOKNG9bviue3+crAwPwCKMJwmnEXA4z+a/BfkHUBszmQy87ABBIFAFroC4gAeJxjYGRgYFb4b8HAwHThrwFDHlMSA1AEBTACAGnTBC94nGO6wIAEAAq6ANMAAFAAAAYAAHicdZDNasJAFIVPNBHa0nbXhVA620IJJssuWkQREX9CFDddhGASHTAzEuPClyr0Obru+/TYTBdZJDDhu989c5kZAHf4hIXqe+Kq2MItq4pbcPBiuI1HeIZtZuaGHdzgw3CHPmPSsq9YveFo2EIXX4ZbuMa34TZe8WPYRte6N+zgwXo23KF/n2ux0YdzIbe7UkiV6SKPS6mVyPRJJe5iEPaXZRJ5WR75oc5jNQnSJN6LYDjyx6vZVNQStWKdFsfLJM/t1TwvqCGw4f+AMwpIbLFDSSeheE1NlyOmkWRFf3EnUgIXCwwQoo8l+wkiPl3GdASfVv/tU5ggQMpujD13BxhixP4YK8wwpWme0dxZc2LBh/8/k8ez9Jrzvxd+VfkAAHicY2BmAIP/zQxmDFgAACiYAbwA) format("woff"),
url(data:font/truetype;charset=utf-8;base64,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) format("otf");
}

</style>
<!-- End embedded font definitions -->

<!-- Begin page background -->
<div id="pg2Overlay" style="width:100%; height:100%; position:absolute; z-index:1; background-color:rgba(0,0,0,0); -webkit-user-select: none;"></div>
<div id="pg2" style="-webkit-user-select: none;"><svg id="pdf2" width="934" height="1209" viewBox="0 0 934 1209" style="width:934px; height:1209px; -moz-transform:scale(1); z-index: 0; isolation: isolate;" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
<defs>
<style type="text/css"><![CDATA[
.g0_2{
fill: none;
stroke: #000;
stroke-width: 1.527;
stroke-miterlimit: 10;
}
.g1_2{
fill: none;
stroke: #000;
stroke-width: 0.763;
stroke-miterlimit: 10;
}
.g2_2{
fill: #000;
}
.g3_2{
fill: none;
stroke: #000;
stroke-width: 1.222;
stroke-miterlimit: 10;
}
.g4_2{
fill: #D9D9D9;
}
]]></style>
</defs>
<path d="M54.6,73.3H880.4" class="g0_2"/>
<path d="M605,72.9V89m0,-.8v22.2" class="g1_2"/>
<path d="M55,128.3h55V110H55v18.3Z" class="g2_2"/>
<path d="M54.6,110H880.4" class="g3_2"/>
<path d="M54.6,128.3H880.4M681.6,146.7H836.4M681.6,169.6H836.4M682,146.3V170M835.6,146.7h44.8m-44.8,22.9h44.8M880,146.3V170" class="g1_2"/>
<path d="M682,215.4H836V192.5H682v22.9Z" class="g4_2"/>
<path d="M681.6,192.5H836.4M681.6,215.4H836.4M682,192.1v23.7" class="g1_2"/>
<path d="M836,215.4h44V192.5H836v22.9Z" class="g4_2"/>
<path d="M835.6,192.5h44.8m-44.8,22.9h44.8M880,192.1v23.7" class="g1_2"/>
<path d="M495,252.1H627V229.2H495v22.9Z" class="g4_2"/>
<path d="M495,252.1H627V229.2H495v22.9Zm186.6,13.7H836.4m-154.8,23H836.4M682,265.4v23.7M835.6,265.8h44.8m-44.8,23h44.8M880,265.4v23.7M681.6,302.5H836.4M681.6,325.4H836.4M682,302.1v23.7M835.6,302.5h44.8m-44.8,22.9h44.8M880,302.1v23.7M681.6,348.3H836.4m-154.8,23H836.4M682,347.9v23.7M835.6,348.3h44.8m-44.8,23h44.8M880,347.9v23.7" class="g1_2"/>
<path d="M682,407.9H836V385H682v22.9Z" class="g4_2"/>
<path d="M681.6,385H836.4M681.6,407.9H836.4M682,384.6v23.7" class="g1_2"/>
<path d="M836,407.9h44V385H836v22.9Z" class="g4_2"/>
<path d="M835.6,385h44.8m-44.8,22.9h44.8M880,384.6v23.7M681.6,430.8H836.4m-154.8,23H836.4M682,430.4v23.7M835.6,430.8h44.8m-44.8,23h44.8M880,430.4v23.7" class="g1_2"/>
<path d="M682,490.4H836V467.5H682v22.9Z" class="g4_2"/>
<path d="M681.6,467.5H836.4M681.6,490.4H836.4M682,467.1v23.7" class="g1_2"/>
<path d="M836,490.4h44V467.5H836v22.9Z" class="g4_2"/>
<path d="M835.6,467.5h44.8m-44.8,22.9h44.8M880,467.1v23.7M681.6,513.3H836.4m-154.8,23H836.4M682,512.9v23.7M835.6,513.3h44.8m-44.8,23h44.8M880,512.9v23.7" class="g1_2"/>
<path d="M682,582.1H836V559.2H682v22.9Z" class="g4_2"/>
<path d="M681.6,559.2H836.4M681.6,582.1H836.4M682,558.8v23.7" class="g1_2"/>
<path d="M836,582.1h44V559.2H836v22.9Z" class="g4_2"/>
<path d="M835.6,559.2h44.8m-44.8,22.9h44.8M880,558.8v23.7M681.6,595.8H836.4m-154.8,23H836.4M682,595.4v23.7M835.6,595.8h44.8m-44.8,23h44.8M880,595.4v23.7" class="g1_2"/>
<path d="M682,655.4H836V632.5H682v22.9Z" class="g4_2"/>
<path d="M681.6,632.5H836.4M681.6,655.4H836.4M682,632.1v23.7" class="g1_2"/>
<path d="M836,655.4h44V632.5H836v22.9Z" class="g4_2"/>
<path d="M835.6,632.5h44.8m-44.8,22.9h44.8M880,632.1v23.7" class="g1_2"/>
<path d="M682,692.1H836V669.2H682v22.9Z" class="g4_2"/>
<path d="M681.6,669.2H836.4M681.6,692.1H836.4M682,668.8v23.7" class="g1_2"/>
<path d="M836,692.1h44V669.2H836v22.9Z" class="g4_2"/>
<path d="M835.6,669.2h44.8m-44.8,22.9h44.8M880,668.8v23.7M681.6,705.8H836.4m-154.8,23H836.4M682,705.4v23.7M835.6,705.8h44.8m-44.8,23h44.8M880,705.4v23.7M461.6,742.5h99.8m-99.8,22.9h99.8M462,742.1v23.7m98.6,-23.3h44.8m-44.8,22.9h44.8M605,742.1v23.7m77,-2.7h15.3V747.8H682v15.3Zm110,0h15.3V747.8H792v15.3Z" class="g1_2"/>
<path d="M55,797.5h55V779.2H55v18.3Z" class="g2_2"/>
<path d="M54.6,779.2H880.4" class="g3_2"/>
<path d="M54.6,797.5H880.4M166.8,851h15.3V835.7H166.8V851Zm0,73.3h15.3V909H166.8v15.3Zm184.8,29H506.4m-154.8,23H506.4M352,952.9v23.7M505.6,953.3h44.8m-44.8,23h44.8M550,952.9v23.7m-198.4,9.6H506.4m-154.8,22.9H506.4M352,985.8v23.7M505.6,986.2h44.8m-44.8,22.9h44.8M550,985.8v23.7M351.6,1019H506.4m-154.8,22.9H506.4M352,1018.6v23.7M505.6,1019h44.8m-44.8,22.9h44.8m-.4,-23.3v23.7m-198.4,9.6H506.4m-154.8,22.9H506.4M352,1051.5v23.7m153.6,-23.3h44.8m-44.8,22.9h44.8m-.4,-23.3v23.7m-383.2,23.3h15.3v-15.3H166.8v15.3Z" class="g1_2"/>
<path d="M54.6,1145.8H99.4m-.8,0H880.4" class="g0_2"/>
</svg></div>
<!-- End page background -->


<!-- Begin text definitions (Positioned/styled in CSS) -->
<div class="text-container"><span id="t1_2" class="t s0_2">951222 </span>
<span id="t2_2" class="t s1_2">Name </span><span id="t3_2" class="t s2_2">(not your trade name) </span><span id="t4_2" class="t s1_2">Employer identification number (EIN) </span>
<span id="t5_2" class="t s3_2">– </span>
<span id="t6_2" class="t s4_2">Part 1: </span>
<span id="t7_2" class="t s5_2">Answer these questions for this quarter. </span><span id="t8_2" class="t s6_2">(continued) </span>
<span id="t9_2" class="t s7_2">11d </span><span id="ta_2" class="t s7_2">Nonrefundable portion of credit for qualified sick and family leave wages for leave taken </span>
<span id="tb_2" class="t s7_2">after March 31, 2021, and before October 1, 2021 </span><span id="tc_2" class="t s8_2">. </span><span id="td_2" class="t s8_2">. </span><span id="te_2" class="t s8_2">. </span><span id="tf_2" class="t s8_2">. </span><span id="tg_2" class="t s8_2">. </span><span id="th_2" class="t s8_2">. </span><span id="ti_2" class="t s8_2">. </span><span id="tj_2" class="t s8_2">. </span><span id="tk_2" class="t s8_2">. </span><span id="tl_2" class="t s8_2">. </span><span id="tm_2" class="t s8_2">. </span><span id="tn_2" class="t s8_2">. </span><span id="to_2" class="t s8_2">. </span><span id="tp_2" class="t v0_2 s7_2">11d </span>
<span id="tq_2" class="t s9_2">. </span>
<span id="tr_2" class="t s7_2">11e </span><span id="ts_2" class="t s7_2">Reserved for future use </span><span id="tt_2" class="t s8_2">. </span><span id="tu_2" class="t s8_2">. </span><span id="tv_2" class="t s8_2">. </span><span id="tw_2" class="t s8_2">. </span><span id="tx_2" class="t s8_2">. </span><span id="ty_2" class="t s8_2">. </span><span id="tz_2" class="t s8_2">. </span><span id="t10_2" class="t s8_2">. </span><span id="t11_2" class="t s8_2">. </span><span id="t12_2" class="t s8_2">. </span><span id="t13_2" class="t s8_2">. </span><span id="t14_2" class="t s8_2">. </span><span id="t15_2" class="t s8_2">. </span><span id="t16_2" class="t s8_2">. </span><span id="t17_2" class="t s8_2">. </span><span id="t18_2" class="t s8_2">. </span><span id="t19_2" class="t s8_2">. </span><span id="t1a_2" class="t s8_2">. </span><span id="t1b_2" class="t s8_2">. </span><span id="t1c_2" class="t s8_2">. </span><span id="t1d_2" class="t s8_2">. </span><span id="t1e_2" class="t s8_2">. </span><span id="t1f_2" class="t v0_2 s7_2">11e </span><span id="t1g_2" class="t s9_2">. </span>
<span id="t1h_2" class="t s7_2">11f </span><span id="t1i_2" class="t s7_2">Reserved for future use </span><span id="t1j_2" class="t s8_2">. </span><span id="t1k_2" class="t s8_2">. </span><span id="t1l_2" class="t s8_2">. </span><span id="t1m_2" class="t s8_2">. </span><span id="t1n_2" class="t s8_2">. </span><span id="t1o_2" class="t s8_2">. </span><span id="t1p_2" class="t s8_2">. </span><span id="t1q_2" class="t s8_2">. </span><span id="t1r_2" class="t s8_2">. </span><span id="t1s_2" class="t s8_2">. </span><span id="t1t_2" class="t s8_2">. </span><span id="t1u_2" class="t s8_2">. </span><span id="t1v_2" class="t s8_2">. </span>
<span id="t1w_2" class="t s7_2">11g </span><span id="t1x_2" class="t s7_2">Total nonrefundable credits. </span><span id="t1y_2" class="t s8_2">Add lines 11a, 11b, and 11d </span><span id="t1z_2" class="t s8_2">. </span><span id="t20_2" class="t s8_2">. </span><span id="t21_2" class="t s8_2">. </span><span id="t22_2" class="t s8_2">. </span><span id="t23_2" class="t s8_2">. </span><span id="t24_2" class="t s8_2">. </span><span id="t25_2" class="t s8_2">. </span><span id="t26_2" class="t s8_2">. </span><span id="t27_2" class="t s8_2">. </span><span id="t28_2" class="t s8_2">. </span><span id="t29_2" class="t s8_2">. </span><span id="t2a_2" class="t v0_2 s7_2">11g </span><span id="t2b_2" class="t s9_2">. </span>
<span id="t2c_2" class="t s7_2">12 </span><span id="t2d_2" class="t s7_2">Total taxes after adjustments and nonrefundable credits. </span><span id="t2e_2" class="t s8_2">Subtract line 11g from line 10 </span><span id="t2f_2" class="t s8_2">. </span><span id="t2g_2" class="t s7_2">12 </span><span id="t2h_2" class="t s9_2">. </span>
<span id="t2i_2" class="t s7_2">13a </span><span id="t2j_2" class="t v0_2 s7_2">Total deposits for this quarter, including overpayment applied from a prior quarter and </span>
<span id="t2k_2" class="t v0_2 s7_2">overpayments applied from Form 941-X, 941-X (PR), 944-X, or 944-X (SP) filed in the current quarter </span><span id="t2l_2" class="t v0_2 s7_2">13a </span>
<span id="t2m_2" class="t s9_2">. </span>
<span id="t2n_2" class="t s7_2">13b </span><span id="t2o_2" class="t s7_2">Reserved for future use </span><span id="t2p_2" class="t s8_2">. </span><span id="t2q_2" class="t s8_2">. </span><span id="t2r_2" class="t s8_2">. </span><span id="t2s_2" class="t s8_2">. </span><span id="t2t_2" class="t s8_2">. </span><span id="t2u_2" class="t s8_2">. </span><span id="t2v_2" class="t s8_2">. </span><span id="t2w_2" class="t s8_2">. </span><span id="t2x_2" class="t s8_2">. </span><span id="t2y_2" class="t s8_2">. </span><span id="t2z_2" class="t s8_2">. </span><span id="t30_2" class="t s8_2">. </span><span id="t31_2" class="t s8_2">. </span><span id="t32_2" class="t s8_2">. </span><span id="t33_2" class="t s8_2">. </span><span id="t34_2" class="t s8_2">. </span><span id="t35_2" class="t s8_2">. </span><span id="t36_2" class="t s8_2">. </span><span id="t37_2" class="t s8_2">. </span><span id="t38_2" class="t s8_2">. </span><span id="t39_2" class="t s8_2">. </span><span id="t3a_2" class="t s8_2">. </span><span id="t3b_2" class="t v0_2 s7_2">13b </span><span id="t3c_2" class="t s9_2">. </span>
<span id="t3d_2" class="t s7_2">13c </span><span id="t3e_2" class="t s7_2">Refundable portion of credit for qualified sick and family leave wages for leave taken </span>
<span id="t3f_2" class="t s7_2">before April 1, 2021 </span><span id="t3g_2" class="t s8_2">. </span><span id="t3h_2" class="t s8_2">. </span><span id="t3i_2" class="t s8_2">. </span><span id="t3j_2" class="t s8_2">. </span><span id="t3k_2" class="t s8_2">. </span><span id="t3l_2" class="t s8_2">. </span><span id="t3m_2" class="t s8_2">. </span><span id="t3n_2" class="t s8_2">. </span><span id="t3o_2" class="t s8_2">. </span><span id="t3p_2" class="t s8_2">. </span><span id="t3q_2" class="t s8_2">. </span><span id="t3r_2" class="t s8_2">. </span><span id="t3s_2" class="t s8_2">. </span><span id="t3t_2" class="t s8_2">. </span><span id="t3u_2" class="t s8_2">. </span><span id="t3v_2" class="t s8_2">. </span><span id="t3w_2" class="t s8_2">. </span><span id="t3x_2" class="t s8_2">. </span><span id="t3y_2" class="t s8_2">. </span><span id="t3z_2" class="t s8_2">. </span><span id="t40_2" class="t s8_2">. </span><span id="t41_2" class="t s8_2">. </span><span id="t42_2" class="t s8_2">. </span><span id="t43_2" class="t v0_2 s7_2">13c </span>
<span id="t44_2" class="t s9_2">. </span>
<span id="t45_2" class="t s7_2">13d </span><span id="t46_2" class="t s7_2">Reserved for future use </span><span id="t47_2" class="t s8_2">. </span><span id="t48_2" class="t s8_2">. </span><span id="t49_2" class="t s8_2">. </span><span id="t4a_2" class="t s8_2">. </span><span id="t4b_2" class="t s8_2">. </span><span id="t4c_2" class="t s8_2">. </span><span id="t4d_2" class="t s8_2">. </span><span id="t4e_2" class="t s8_2">. </span><span id="t4f_2" class="t s8_2">. </span><span id="t4g_2" class="t s8_2">. </span><span id="t4h_2" class="t s8_2">. </span><span id="t4i_2" class="t s8_2">. </span><span id="t4j_2" class="t s8_2">. </span><span id="t4k_2" class="t s8_2">. </span><span id="t4l_2" class="t s8_2">. </span><span id="t4m_2" class="t s8_2">. </span><span id="t4n_2" class="t s8_2">. </span><span id="t4o_2" class="t s8_2">. </span><span id="t4p_2" class="t s8_2">. </span><span id="t4q_2" class="t s8_2">. </span><span id="t4r_2" class="t s8_2">. </span><span id="t4s_2" class="t s8_2">. </span><span id="t4t_2" class="t v0_2 s7_2">13d </span><span id="t4u_2" class="t s9_2">. </span>
<span id="t4v_2" class="t s7_2">13e </span><span id="t4w_2" class="t s7_2">Refundable portion of credit for qualified sick and family leave wages for leave taken </span>
<span id="t4x_2" class="t s7_2">after March 31, 2021, and before October 1, 2021 </span><span id="t4y_2" class="t s8_2">. </span><span id="t4z_2" class="t s8_2">. </span><span id="t50_2" class="t s8_2">. </span><span id="t51_2" class="t s8_2">. </span><span id="t52_2" class="t s8_2">. </span><span id="t53_2" class="t s8_2">. </span><span id="t54_2" class="t s8_2">. </span><span id="t55_2" class="t s8_2">. </span><span id="t56_2" class="t s8_2">. </span><span id="t57_2" class="t s8_2">. </span><span id="t58_2" class="t s8_2">. </span><span id="t59_2" class="t s8_2">. </span><span id="t5a_2" class="t s8_2">. </span><span id="t5b_2" class="t s8_2">. </span><span id="t5c_2" class="t v0_2 s7_2">13e </span>
<span id="t5d_2" class="t s9_2">. </span>
<span id="t5e_2" class="t s7_2">13f </span><span id="t5f_2" class="t s7_2">Reserved for future use </span><span id="t5g_2" class="t s8_2">. </span><span id="t5h_2" class="t s8_2">. </span><span id="t5i_2" class="t s8_2">. </span><span id="t5j_2" class="t s8_2">. </span><span id="t5k_2" class="t s8_2">. </span><span id="t5l_2" class="t s8_2">. </span><span id="t5m_2" class="t s8_2">. </span><span id="t5n_2" class="t s8_2">. </span><span id="t5o_2" class="t s8_2">. </span><span id="t5p_2" class="t s8_2">. </span><span id="t5q_2" class="t s8_2">. </span><span id="t5r_2" class="t s8_2">. </span><span id="t5s_2" class="t s8_2">. </span><span id="t5t_2" class="t s8_2">. </span><span id="t5u_2" class="t s8_2">. </span><span id="t5v_2" class="t s8_2">. </span><span id="t5w_2" class="t s8_2">. </span><span id="t5x_2" class="t s8_2">. </span><span id="t5y_2" class="t s8_2">. </span><span id="t5z_2" class="t s8_2">. </span><span id="t60_2" class="t s8_2">. </span><span id="t61_2" class="t s8_2">. </span>
<span id="t62_2" class="t v0_2 s7_2">13f </span><span id="t63_2" class="t s9_2">. </span>
<span id="t64_2" class="t s7_2">13g </span><span id="t65_2" class="t s7_2">Total deposits and refundable credits. </span><span id="t66_2" class="t s8_2">Add lines 13a, 13c, and 13e </span><span id="t67_2" class="t s8_2">. </span><span id="t68_2" class="t s8_2">. </span><span id="t69_2" class="t s8_2">. </span><span id="t6a_2" class="t s8_2">. </span><span id="t6b_2" class="t s8_2">. </span><span id="t6c_2" class="t s8_2">. </span><span id="t6d_2" class="t s8_2">. </span><span id="t6e_2" class="t s8_2">. </span><span id="t6f_2" class="t v0_2 s7_2">13g </span><span id="t6g_2" class="t s9_2">. </span>
<span id="t6h_2" class="t s7_2">13h </span><span id="t6i_2" class="t s7_2">Reserved for future use </span><span id="t6j_2" class="t s8_2">. </span><span id="t6k_2" class="t s8_2">. </span><span id="t6l_2" class="t s8_2">. </span><span id="t6m_2" class="t s8_2">. </span><span id="t6n_2" class="t s8_2">. </span><span id="t6o_2" class="t s8_2">. </span><span id="t6p_2" class="t s8_2">. </span><span id="t6q_2" class="t s8_2">. </span><span id="t6r_2" class="t s8_2">. </span><span id="t6s_2" class="t s8_2">. </span><span id="t6t_2" class="t s8_2">. </span><span id="t6u_2" class="t s8_2">. </span><span id="t6v_2" class="t s8_2">. </span><span id="t6w_2" class="t s8_2">. </span><span id="t6x_2" class="t s8_2">. </span><span id="t6y_2" class="t s8_2">. </span><span id="t6z_2" class="t s8_2">. </span><span id="t70_2" class="t s8_2">. </span><span id="t71_2" class="t s8_2">. </span><span id="t72_2" class="t s8_2">. </span><span id="t73_2" class="t s8_2">. </span><span id="t74_2" class="t s8_2">. </span><span id="t75_2" class="t v0_2 s7_2">13h </span><span id="t76_2" class="t s9_2">. </span>
<span id="t77_2" class="t s7_2">13i </span><span id="t78_2" class="t s7_2">Reserved for future use </span><span id="t79_2" class="t s8_2">. </span><span id="t7a_2" class="t s8_2">. </span><span id="t7b_2" class="t s8_2">. </span><span id="t7c_2" class="t s8_2">. </span><span id="t7d_2" class="t s8_2">. </span><span id="t7e_2" class="t s8_2">. </span><span id="t7f_2" class="t s8_2">. </span><span id="t7g_2" class="t s8_2">. </span><span id="t7h_2" class="t s8_2">. </span><span id="t7i_2" class="t s8_2">. </span><span id="t7j_2" class="t s8_2">. </span><span id="t7k_2" class="t s8_2">. </span><span id="t7l_2" class="t s8_2">. </span><span id="t7m_2" class="t s8_2">. </span><span id="t7n_2" class="t s8_2">. </span><span id="t7o_2" class="t s8_2">. </span><span id="t7p_2" class="t s8_2">. </span><span id="t7q_2" class="t s8_2">. </span><span id="t7r_2" class="t s8_2">. </span><span id="t7s_2" class="t s8_2">. </span><span id="t7t_2" class="t s8_2">. </span><span id="t7u_2" class="t s8_2">. </span><span id="t7v_2" class="t v0_2 s7_2">13i </span><span id="t7w_2" class="t s9_2">. </span>
<span id="t7x_2" class="t s7_2">14 </span><span id="t7y_2" class="t s7_2">Balance due. </span><span id="t7z_2" class="t s8_2">If line 12 is more than line 13g, enter the difference and see instructions </span><span id="t80_2" class="t s8_2">. </span><span id="t81_2" class="t s8_2">. </span><span id="t82_2" class="t s8_2">. </span><span id="t83_2" class="t s7_2">14 </span><span id="t84_2" class="t s9_2">. </span>
<span id="t85_2" class="t s7_2">15 </span><span id="t86_2" class="t v1_2 s7_2">Overpayment. </span><span id="t87_2" class="t v1_2 s8_2">If line 13g is more than line 12, enter the difference </span><span id="t88_2" class="t s9_2">. </span><span id="t89_2" class="t s8_2">Check one: </span><span id="t8a_2" class="t v2_2 sa_2">Apply to next return. </span><span id="t8b_2" class="t sa_2">Send a refund. </span>
<span id="t8c_2" class="t s4_2">Part 2: </span><span id="t8d_2" class="t s5_2">Tell us about your deposit schedule and tax liability for this quarter. </span>
<span id="t8e_2" class="t s7_2">If you’re unsure about whether you’re a monthly schedule depositor or a semiweekly schedule depositor, see section 11 of Pub. 15. </span>
<span id="t8f_2" class="t s7_2">16 </span><span id="t8g_2" class="t s7_2">Check one: </span>
<span id="t8h_2" class="t s7_2">Line 12 on this return is less than $2,500 or line 12 on the return for the prior quarter was less than $2,500, </span>
<span id="t8i_2" class="t s7_2">and you didn’t incur a $100,000 next-day deposit obligation during the current quarter. </span><span id="t8j_2" class="t s8_2">If line 12 for the prior </span>
<span id="t8k_2" class="t s8_2">quarter was less than $2,500 but line 12 on this return is $100,000 or more, you must provide a record of your </span>
<span id="t8l_2" class="t s8_2">federal tax liability. If you’re a monthly schedule depositor, complete the deposit schedule below; if you’re a </span>
<span id="t8m_2" class="t s8_2">semiweekly schedule depositor, attach Schedule B (Form 941). Go to Part 3. </span>
<span id="t8n_2" class="t s7_2">You were a monthly schedule depositor for the entire quarter. </span><span id="t8o_2" class="t s8_2">Enter your tax liability for each month and total </span>
<span id="t8p_2" class="t s8_2">liability for the quarter, then go to Part 3. </span>
<span id="t8q_2" class="t s7_2">Tax liability: </span><span id="t8r_2" class="t s7_2">Month 1 </span><span id="t8s_2" class="t s9_2">. </span>
<span id="t8t_2" class="t s7_2">Month 2 </span><span id="t8u_2"  value="Ajith" class="t s9_2">. </span>
<span id="t8v_2" class="t s7_2">Month 3 </span><span id="t8w_2"   value="Ajith"  class="t s9_2">. </span>
<span id="t8x_2" class="t s7_2">Total liability for quarter </span><span id="t8y_2"  value="Ajith"  class="t s9_2">. </span><span id="t8z_2" class="t s7_2">Total must equal line 12. </span>
<span id="t90_2" class="t s7_2">You were a semiweekly schedule depositor for any part of this quarter. </span><span id="t91_2" class="t s8_2">Complete </span><span id="t92_2"   value="Ajith"  class="t s8_2">Schedule B (Form 941), </span>
<span id="t93_2" class="t s8_2">Report of Tax Liability for Semiweekly Schedule Depositors, and attach it to Form 941. Go to Part 3. </span>
<span id="t94_2" class="t s7_2">You MUST complete all three pages of Form 941 and SIGN it. </span>
<span id="t95_2" class="t sb_2">Page </span><span id="t96_2" class="t sc_2">2 </span><span id="t97_2" class="t sb_2">Form </span><span id="t98_2" class="t sc_2">941 </span><span id="t99_2" class="t sb_2">(Rev. 3-2024) </span></div>
<!-- End text definitions -->


<!-- Begin Form Data -->
<input id="form1_2" type="text" tabindex="66" value="" data-objref="411 0 R" data-field-name="topmostSubform[0].Page2[0].Name_ReadOrder[0].f1_3[0]"/>
<input id="form2_2" type="text" tabindex="67" maxlength="2" value="" data-objref="409 0 R" data-field-name="topmostSubform[0].Page2[0].EIN_Number[0].f1_1[0]"/>
<input id="form3_2" type="text" tabindex="68" maxlength="7" value="" data-objref="410 0 R" data-field-name="topmostSubform[0].Page2[0].EIN_Number[0].f1_2[0]"/>
<input id="form4_2" type="text" tabindex="69" value="" data-objref="365 0 R" data-field-name="topmostSubform[0].Page2[0].f2_3[0]"/>
<input id="form5_2" type="text" tabindex="70" maxlength="3" value="" data-objref="366 0 R" data-field-name="topmostSubform[0].Page2[0].f2_4[0]"/>
<input id="form6_2" type="button" tabindex="71" disabled="disabled" data-objref="367 0 R" data-field-name="topmostSubform[0].Page2[0].f2_5[0]"/>
<input id="form7_2" type="button" tabindex="72" maxlength="3" disabled="disabled" data-objref="368 0 R" data-field-name="topmostSubform[0].Page2[0].f2_6[0]"/>
<input id="form8_2" type="button" tabindex="73" disabled="disabled" data-objref="369 0 R" data-field-name="topmostSubform[0].Page2[0].f2_7[0]"/>
<input id="form9_2" type="text" tabindex="74" value="" data-objref="370 0 R" data-field-name="topmostSubform[0].Page2[0].f2_8[0]"/>
<input id="form10_2" type="text" tabindex="75" maxlength="3" value="" data-objref="371 0 R" data-field-name="topmostSubform[0].Page2[0].f2_9[0]"/>
<input id="form11_2" type="text" tabindex="76" value="" data-objref="372 0 R" data-field-name="topmostSubform[0].Page2[0].f2_10[0]"/>
<input id="form12_2" type="text" tabindex="77" maxlength="3" value="" data-objref="373 0 R" data-field-name="topmostSubform[0].Page2[0].f2_11[0]"/>
<input id="form13_2" type="text" tabindex="78" value="" data-objref="374 0 R" data-field-name="topmostSubform[0].Page2[0].f2_12[0]"/>
<input id="form14_2" type="text" tabindex="79" maxlength="3" value="" data-objref="375 0 R" data-field-name="topmostSubform[0].Page2[0].f2_13[0]"/>
<input id="form15_2" type="button" tabindex="80" disabled="disabled" data-objref="376 0 R" data-field-name="topmostSubform[0].Page2[0].f2_14[0]"/>
<input id="form16_2" type="button" tabindex="81" maxlength="3" disabled="disabled" data-objref="377 0 R" data-field-name="topmostSubform[0].Page2[0].f2_15[0]"/>
<input id="form17_2" type="text" tabindex="82" value="" data-objref="378 0 R" data-field-name="topmostSubform[0].Page2[0].f2_16[0]"/>
<input id="form18_2" type="text" tabindex="83" maxlength="3" value="" data-objref="379 0 R" data-field-name="topmostSubform[0].Page2[0].f2_17[0]"/>
<input id="form19_2" type="button" tabindex="84" disabled="disabled" data-objref="380 0 R" data-field-name="topmostSubform[0].Page2[0].f2_18[0]"/>
<input id="form20_2" type="button" tabindex="85" maxlength="3" disabled="disabled" data-objref="381 0 R" data-field-name="topmostSubform[0].Page2[0].f2_19[0]"/>
<input id="form21_2" type="text" tabindex="86" value="" data-objref="382 0 R" data-field-name="topmostSubform[0].Page2[0].f2_20[0]"/>
<input id="form22_2" type="text" tabindex="87" maxlength="3" value="" data-objref="383 0 R" data-field-name="topmostSubform[0].Page2[0].f2_21[0]"/>
<input id="form23_2" type="button" tabindex="88" disabled="disabled" data-objref="384 0 R" data-field-name="topmostSubform[0].Page2[0].f2_22[0]"/>
<input id="form24_2" type="button" tabindex="89" maxlength="3" disabled="disabled" data-objref="385 0 R" data-field-name="topmostSubform[0].Page2[0].f2_23[0]"/>
<input id="form25_2" type="text" tabindex="90" value="" data-objref="386 0 R" data-field-name="topmostSubform[0].Page2[0].f2_24[0]"/>
<input id="form26_2" type="text" tabindex="91" maxlength="3" value="" data-objref="387 0 R" data-field-name="topmostSubform[0].Page2[0].f2_25[0]"/>
<input id="form27_2" type="button" tabindex="92" disabled="disabled" data-objref="388 0 R" data-field-name="topmostSubform[0].Page2[0].f2_26[0]"/>
<input id="form28_2" type="button" tabindex="93" maxlength="3" disabled="disabled" data-objref="389 0 R" data-field-name="topmostSubform[0].Page2[0].f2_27[0]"/>
<input id="form29_2" type="button" tabindex="94" disabled="disabled" data-objref="390 0 R" data-field-name="topmostSubform[0].Page2[0].f2_28[0]"/>
<input id="form30_2" type="button" tabindex="95" maxlength="3" disabled="disabled" data-objref="391 0 R" data-field-name="topmostSubform[0].Page2[0].f2_29[0]"/>
<input id="form31_2" type="text" tabindex="96" value="" data-objref="392 0 R" data-field-name="topmostSubform[0].Page2[0].f2_30[0]"/>
<input id="form32_2" type="text" tabindex="97" maxlength="3" value="" data-objref="393 0 R" data-field-name="topmostSubform[0].Page2[0].f2_31[0]"/>
<input id="form33_2" type="checkbox" tabindex="100" value="1" data-objref="396 0 R" data-field-name="topmostSubform[0].Page2[0].c2_1[0]" imageOn="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABEAAAARCAMAAAAMs7fIAAAAZlBMVEUAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAABwbJTWAAAAInRSTlMAcDkjf3b/8RjdjwGi1r8GAs4OGU8g2su2guEl5AeS7jQkzdhcKgAAAFlJREFUeNqtz0cSgDAMA0ATQKb3Ekoo//8k4ZL4AfFxR9KMiYJepIjiREAKVlmOwkFZAVwDTeuoswT0g6iNbGUSMC9/hpWXFdAbsPud49SGrvuRNWPn36Avfq3xAzhlMCzyAAAAAElFTkSuQmCC" imageOff="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAMAAAC6V+0/AAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAAA5JREFUeNpjYBgFgx0AAAGkAAF+IKsZAAAAAElFTkSuQmCC" imageDownOff="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABEAAAARCAMAAAAMs7fIAAAAD1BMVEUAAAC/v7+9vb2/v7/Dw8MCye4CAAAABXRSTlMA/0ZAEfKwnsUAAAAVSURBVHjaY2DABIyogGlkizCjAhYAmkIBMfGWWB0AAAAASUVORK5CYII=" imageName="null" images="110100"/>
<input id="form34_2" type="checkbox" tabindex="101" value="2" data-objref="397 0 R" data-field-name="topmostSubform[0].Page2[0].c2_1[1]" imageOn="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABEAAAARCAMAAAAMs7fIAAAAZlBMVEUAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAABwbJTWAAAAInRSTlMAcDkjf3b/8RjdjwGi1r8GAs4OGU8g2su2guEl5AeS7jQkzdhcKgAAAFlJREFUeNqtz0cSgDAMA0ATQKb3Ekoo//8k4ZL4AfFxR9KMiYJepIjiREAKVlmOwkFZAVwDTeuoswT0g6iNbGUSMC9/hpWXFdAbsPud49SGrvuRNWPn36Avfq3xAzhlMCzyAAAAAElFTkSuQmCC" imageOff="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAMAAAC6V+0/AAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAAA5JREFUeNpjYBgFgx0AAAGkAAF+IKsZAAAAAElFTkSuQmCC" imageDownOff="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABEAAAARCAMAAAAMs7fIAAAAD1BMVEUAAAC/v7+9vb2/v7/Dw8MCye4CAAAABXRSTlMA/0ZAEfKwnsUAAAAVSURBVHjaY2DABIyogGlkizCjAhYAmkIBMfGWWB0AAAAASUVORK5CYII=" imageName="null" images="110100"/>
<input id="form35_2" type="text" tabindex="98" value="" data-objref="394 0 R" data-field-name="topmostSubform[0].Page2[0].f2_32[0]"/>
<input id="form36_2" type="text" tabindex="99" maxlength="3" value="" data-objref="395 0 R" data-field-name="topmostSubform[0].Page2[0].f2_33[0]"/>
<input id="form37_2" type="checkbox" tabindex="102" value="1" data-objref="398 0 R" data-field-name="topmostSubform[0].Page2[0].c2_2[0]" imageOn="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABEAAAARCAMAAAAMs7fIAAAAZlBMVEUAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAABwbJTWAAAAInRSTlMAcDkjf3b/8RjdjwGi1r8GAs4OGU8g2su2guEl5AeS7jQkzdhcKgAAAFlJREFUeNqtz0cSgDAMA0ATQKb3Ekoo//8k4ZL4AfFxR9KMiYJepIjiREAKVlmOwkFZAVwDTeuoswT0g6iNbGUSMC9/hpWXFdAbsPud49SGrvuRNWPn36Avfq3xAzhlMCzyAAAAAElFTkSuQmCC" imageOff="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAMAAAC6V+0/AAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAAA5JREFUeNpjYBgFgx0AAAGkAAF+IKsZAAAAAElFTkSuQmCC" imageDownOff="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABEAAAARCAMAAAAMs7fIAAAAD1BMVEUAAAC/v7+9vb2/v7/Dw8MCye4CAAAABXRSTlMA/0ZAEfKwnsUAAAAVSURBVHjaY2DABIyogGlkizCjAhYAmkIBMfGWWB0AAAAASUVORK5CYII=" imageName="null" images="110100"/>
<input id="form38_2" type="checkbox" tabindex="103" value="2" data-objref="399 0 R" data-field-name="topmostSubform[0].Page2[0].c2_2[1]" imageOn="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABEAAAARCAMAAAAMs7fIAAAAZlBMVEUAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAABwbJTWAAAAInRSTlMAcDkjf3b/8RjdjwGi1r8GAs4OGU8g2su2guEl5AeS7jQkzdhcKgAAAFlJREFUeNqtz0cSgDAMA0ATQKb3Ekoo//8k4ZL4AfFxR9KMiYJepIjiREAKVlmOwkFZAVwDTeuoswT0g6iNbGUSMC9/hpWXFdAbsPud49SGrvuRNWPn36Avfq3xAzhlMCzyAAAAAElFTkSuQmCC" imageOff="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAMAAAC6V+0/AAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAAA5JREFUeNpjYBgFgx0AAAGkAAF+IKsZAAAAAElFTkSuQmCC" imageDownOff="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABEAAAARCAMAAAAMs7fIAAAAD1BMVEUAAAC/v7+9vb2/v7/Dw8MCye4CAAAABXRSTlMA/0ZAEfKwnsUAAAAVSURBVHjaY2DABIyogGlkizCjAhYAmkIBMfGWWB0AAAAASUVORK5CYII=" imageName="null" images="110100"/>
<input id="form39_2" type="text" tabindex="104" value="" data-objref="400 0 R" data-field-name="topmostSubform[0].Page2[0].f2_34[0]"/>
<input id="form40_2" type="text" tabindex="105" maxlength="3" value="" data-objref="401 0 R" data-field-name="topmostSubform[0].Page2[0].f2_35[0]"/>
<input id="form41_2" type="text" tabindex="106" value="" data-objref="402 0 R" data-field-name="topmostSubform[0].Page2[0].f2_36[0]"/>
<input id="form42_2" type="text" tabindex="107" maxlength="3" value="" data-objref="403 0 R" data-field-name="topmostSubform[0].Page2[0].f2_37[0]"/>
<input id="form43_2" type="text" tabindex="108" value="" data-objref="404 0 R" data-field-name="topmostSubform[0].Page2[0].f2_38[0]"/>
<input id="form44_2" type="text" tabindex="109" maxlength="3" value="" data-objref="405 0 R" data-field-name="topmostSubform[0].Page2[0].f2_39[0]"/>
<input id="form45_2" type="text" tabindex="110" value="" data-objref="406 0 R" data-field-name="topmostSubform[0].Page2[0].f2_40[0]"/>
<input id="form46_2" type="text" tabindex="111" maxlength="3" value="" data-objref="407 0 R" data-field-name="topmostSubform[0].Page2[0].f2_41[0]"/>
<input id="form47_2" type="checkbox" tabindex="112" value="3" data-objref="408 0 R" data-field-name="topmostSubform[0].Page2[0].c2_2[2]" imageOn="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABEAAAARCAMAAAAMs7fIAAAAZlBMVEUAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAABwbJTWAAAAInRSTlMAcDkjf3b/8RjdjwGi1r8GAs4OGU8g2su2guEl5AeS7jQkzdhcKgAAAFlJREFUeNqtz0cSgDAMA0ATQKb3Ekoo//8k4ZL4AfFxR9KMiYJepIjiREAKVlmOwkFZAVwDTeuoswT0g6iNbGUSMC9/hpWXFdAbsPud49SGrvuRNWPn36Avfq3xAzhlMCzyAAAAAElFTkSuQmCC" imageOff="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAMAAAC6V+0/AAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAAA5JREFUeNpjYBgFgx0AAAGkAAF+IKsZAAAAAElFTkSuQmCC" imageDownOff="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABEAAAARCAMAAAAMs7fIAAAAD1BMVEUAAAC/v7+9vb2/v7/Dw8MCye4CAAAABXRSTlMA/0ZAEfKwnsUAAAAVSURBVHjaY2DABIyogGlkizCjAhYAmkIBMfGWWB0AAAAASUVORK5CYII=" imageName="null" images="110100"/>

<!-- End Form Data -->

</div>

</div>
</div>
<div id="page3" style="width: 934px; height: 1209px; margin-top:20px;" class="page">
<div class="page-inner" style="width: 934px; height: 1209px;">

<div id="p3" class="pageArea" style="overflow: hidden; position: relative; width: 934px; height: 1209px; margin-top:auto; margin-left:auto; margin-right:auto; background-color: white;">

<!-- Begin shared CSS values -->
<style class="shared-css" type="text/css" >
.t {
	transform-origin: bottom left;
	z-index: 2;
	position: absolute;
	white-space: pre;
	overflow: visible;
	line-height: 1.5;
}
.text-container {
	white-space: pre;
}
@supports (-webkit-touch-callout: none) {
	.text-container {
		white-space: normal;
	}
}
</style>
<!-- End shared CSS values -->


<!-- Begin inline CSS -->
<style type="text/css" >

#t1_3{left:814px;bottom:1134px;letter-spacing:0.2px;}
#t2_3{left:55px;bottom:1120px;letter-spacing:-0.17px;}
#t3_3{left:88px;bottom:1120px;letter-spacing:-0.14px;}
#t4_3{left:611px;bottom:1120px;letter-spacing:-0.15px;}
#t5_3{left:662px;bottom:1096px;}
#t6_3{left:60px;bottom:1078px;letter-spacing:-0.1px;}
#t7_3{left:122px;bottom:1078px;letter-spacing:-0.12px;}
#t8_3{left:63px;bottom:1051px;letter-spacing:-0.01px;}
#t9_3{left:99px;bottom:1051px;letter-spacing:-0.01px;}
#ta_3{left:458px;bottom:1051px;}
#tb_3{left:477px;bottom:1051px;}
#tc_3{left:495px;bottom:1051px;}
#td_3{left:513px;bottom:1051px;}
#te_3{left:532px;bottom:1051px;}
#tf_3{left:550px;bottom:1051px;}
#tg_3{left:568px;bottom:1051px;}
#th_3{left:587px;bottom:1051px;}
#ti_3{left:605px;bottom:1051px;}
#tj_3{left:623px;bottom:1051px;}
#tk_3{left:642px;bottom:1051px;}
#tl_3{left:660px;bottom:1051px;}
#tm_3{left:678px;bottom:1051px;}
#tn_3{left:697px;bottom:1051px;}
#to_3{left:715px;bottom:1051px;}
#tp_3{left:759px;bottom:1051px;letter-spacing:-0.01px;}
#tq_3{left:99px;bottom:1019px;letter-spacing:-0.01px;}
#tr_3{left:348px;bottom:1019px;}
#ts_3{left:377px;bottom:1019px;}
#tt_3{left:443px;bottom:1019px;letter-spacing:-0.01px;}
#tu_3{left:63px;bottom:988px;letter-spacing:-0.01px;}
#tv_3{left:99px;bottom:988px;letter-spacing:-0.01px;}
#tw_3{left:678px;bottom:988px;}
#tx_3{left:697px;bottom:988px;}
#ty_3{left:715px;bottom:988px;}
#tz_3{left:759px;bottom:987px;letter-spacing:-0.01px;}
#t10_3{left:63px;bottom:955px;letter-spacing:-0.01px;}
#t11_3{left:99px;bottom:955px;letter-spacing:-0.01px;}
#t12_3{left:664px;bottom:955px;letter-spacing:-0.01px;}
#t13_3{left:839px;bottom:950px;}
#t14_3{left:63px;bottom:927px;letter-spacing:-0.01px;}
#t15_3{left:99px;bottom:927px;letter-spacing:-0.01px;}
#t16_3{left:664px;bottom:927px;letter-spacing:-0.01px;}
#t17_3{left:839px;bottom:922px;}
#t18_3{left:63px;bottom:900px;letter-spacing:-0.01px;}
#t19_3{left:99px;bottom:900px;letter-spacing:-0.01px;}
#t1a_3{left:257px;bottom:900px;}
#t1b_3{left:275px;bottom:900px;}
#t1c_3{left:293px;bottom:900px;}
#t1d_3{left:312px;bottom:900px;}
#t1e_3{left:330px;bottom:900px;}
#t1f_3{left:348px;bottom:900px;}
#t1g_3{left:367px;bottom:900px;}
#t1h_3{left:385px;bottom:900px;}
#t1i_3{left:403px;bottom:900px;}
#t1j_3{left:422px;bottom:900px;}
#t1k_3{left:440px;bottom:900px;}
#t1l_3{left:458px;bottom:900px;}
#t1m_3{left:477px;bottom:900px;}
#t1n_3{left:495px;bottom:900px;}
#t1o_3{left:513px;bottom:900px;}
#t1p_3{left:532px;bottom:900px;}
#t1q_3{left:550px;bottom:900px;}
#t1r_3{left:568px;bottom:900px;}
#t1s_3{left:587px;bottom:900px;}
#t1t_3{left:605px;bottom:900px;}
#t1u_3{left:623px;bottom:900px;}
#t1v_3{left:642px;bottom:900px;}
#t1w_3{left:664px;bottom:900px;letter-spacing:-0.01px;}
#t1x_3{left:839px;bottom:895px;}
#t1y_3{left:63px;bottom:872px;letter-spacing:-0.01px;}
#t1z_3{left:99px;bottom:872px;letter-spacing:-0.01px;}
#t20_3{left:257px;bottom:872px;}
#t21_3{left:275px;bottom:872px;}
#t22_3{left:293px;bottom:872px;}
#t23_3{left:312px;bottom:872px;}
#t24_3{left:330px;bottom:872px;}
#t25_3{left:348px;bottom:872px;}
#t26_3{left:367px;bottom:872px;}
#t27_3{left:385px;bottom:872px;}
#t28_3{left:403px;bottom:872px;}
#t29_3{left:422px;bottom:872px;}
#t2a_3{left:440px;bottom:872px;}
#t2b_3{left:458px;bottom:872px;}
#t2c_3{left:477px;bottom:872px;}
#t2d_3{left:495px;bottom:872px;}
#t2e_3{left:513px;bottom:872px;}
#t2f_3{left:532px;bottom:872px;}
#t2g_3{left:550px;bottom:872px;}
#t2h_3{left:568px;bottom:872px;}
#t2i_3{left:587px;bottom:872px;}
#t2j_3{left:605px;bottom:872px;}
#t2k_3{left:623px;bottom:872px;}
#t2l_3{left:642px;bottom:872px;}
#t2m_3{left:664px;bottom:872px;letter-spacing:-0.01px;}
#t2n_3{left:839px;bottom:867px;}
#t2o_3{left:63px;bottom:845px;letter-spacing:-0.01px;}
#t2p_3{left:99px;bottom:845px;letter-spacing:-0.01px;}
#t2q_3{left:664px;bottom:845px;letter-spacing:-0.01px;}
#t2r_3{left:839px;bottom:840px;}
#t2s_3{left:63px;bottom:817px;letter-spacing:-0.01px;}
#t2t_3{left:99px;bottom:817px;letter-spacing:-0.01px;}
#t2u_3{left:664px;bottom:817px;letter-spacing:-0.01px;}
#t2v_3{left:839px;bottom:812px;}
#t2w_3{left:63px;bottom:794px;letter-spacing:-0.01px;}
#t2x_3{left:99px;bottom:795px;letter-spacing:-0.01px;word-spacing:3.49px;}
#t2y_3{left:99px;bottom:779px;letter-spacing:-0.01px;}
#t2z_3{left:312px;bottom:779px;}
#t30_3{left:330px;bottom:779px;}
#t31_3{left:348px;bottom:779px;}
#t32_3{left:367px;bottom:779px;}
#t33_3{left:385px;bottom:779px;}
#t34_3{left:403px;bottom:779px;}
#t35_3{left:422px;bottom:779px;}
#t36_3{left:440px;bottom:779px;}
#t37_3{left:458px;bottom:779px;}
#t38_3{left:477px;bottom:779px;}
#t39_3{left:495px;bottom:779px;}
#t3a_3{left:513px;bottom:779px;}
#t3b_3{left:532px;bottom:779px;}
#t3c_3{left:550px;bottom:779px;}
#t3d_3{left:568px;bottom:779px;}
#t3e_3{left:587px;bottom:779px;}
#t3f_3{left:605px;bottom:779px;}
#t3g_3{left:623px;bottom:779px;}
#t3h_3{left:642px;bottom:779px;}
#t3i_3{left:664px;bottom:778px;letter-spacing:-0.01px;}
#t3j_3{left:839px;bottom:775px;}
#t3k_3{left:63px;bottom:744px;letter-spacing:-0.01px;}
#t3l_3{left:99px;bottom:744px;letter-spacing:-0.01px;}
#t3m_3{left:664px;bottom:744px;letter-spacing:-0.01px;}
#t3n_3{left:839px;bottom:739px;}
#t3o_3{left:63px;bottom:716px;letter-spacing:-0.01px;}
#t3p_3{left:99px;bottom:716px;letter-spacing:-0.01px;}
#t3q_3{left:664px;bottom:716px;letter-spacing:-0.01px;}
#t3r_3{left:839px;bottom:711px;}
#t3s_3{left:63px;bottom:694px;letter-spacing:-0.01px;}
#t3t_3{left:99px;bottom:694px;letter-spacing:-0.01px;word-spacing:2.19px;}
#t3u_3{left:99px;bottom:678px;letter-spacing:-0.01px;}
#t3v_3{left:312px;bottom:678px;}
#t3w_3{left:330px;bottom:678px;}
#t3x_3{left:348px;bottom:678px;}
#t3y_3{left:367px;bottom:678px;}
#t3z_3{left:385px;bottom:678px;}
#t40_3{left:403px;bottom:678px;}
#t41_3{left:422px;bottom:678px;}
#t42_3{left:440px;bottom:678px;}
#t43_3{left:458px;bottom:678px;}
#t44_3{left:477px;bottom:678px;}
#t45_3{left:495px;bottom:678px;}
#t46_3{left:513px;bottom:678px;}
#t47_3{left:532px;bottom:678px;}
#t48_3{left:550px;bottom:678px;}
#t49_3{left:568px;bottom:678px;}
#t4a_3{left:587px;bottom:678px;}
#t4b_3{left:605px;bottom:678px;}
#t4c_3{left:623px;bottom:678px;}
#t4d_3{left:642px;bottom:678px;}
#t4e_3{left:664px;bottom:677px;letter-spacing:-0.01px;}
#t4f_3{left:839px;bottom:675px;}
#t4g_3{left:60px;bottom:648px;letter-spacing:-0.1px;}
#t4h_3{left:122px;bottom:648px;letter-spacing:-0.12px;}
#t4i_3{left:99px;bottom:631px;letter-spacing:0.11px;}
#t4j_3{left:738px;bottom:631px;letter-spacing:0.1px;}
#t4k_3{left:99px;bottom:615px;letter-spacing:0.09px;}
#t4l_3{left:121px;bottom:588px;letter-spacing:-0.01px;}
#t4m_3{left:154px;bottom:588px;letter-spacing:-0.01px;}
#t4n_3{left:154px;bottom:553px;letter-spacing:-0.01px;}
#t4o_3{left:121px;bottom:524px;letter-spacing:-0.01px;}
#t4p_3{left:60px;bottom:501px;letter-spacing:-0.11px;}
#t4q_3{left:122px;bottom:501px;letter-spacing:-0.12px;}
#t4r_3{left:66px;bottom:484px;letter-spacing:0.21px;}
#t4s_3{left:66px;bottom:470px;letter-spacing:0.2px;}
#t4t_3{left:66px;bottom:429px;letter-spacing:-0.09px;}
#t4u_3{left:66px;bottom:408px;letter-spacing:-0.11px;}
#t4v_3{left:121px;bottom:350px;letter-spacing:-0.01px;}
#t4w_3{left:201px;bottom:350px;}
#t4x_3{left:231px;bottom:350px;}
#t4y_3{left:517px;bottom:446px;letter-spacing:-0.01px;}
#t4z_3{left:517px;bottom:431px;letter-spacing:-0.01px;}
#t50_3{left:517px;bottom:410px;letter-spacing:-0.01px;}
#t51_3{left:517px;bottom:394px;letter-spacing:-0.01px;}
#t52_3{left:517px;bottom:350px;letter-spacing:-0.01px;}
#t53_3{left:77px;bottom:308px;letter-spacing:0.14px;}
#t54_3{left:594px;bottom:309px;letter-spacing:-0.01px;}
#t55_3{left:788px;bottom:309px;}
#t56_3{left:807px;bottom:309px;}
#t57_3{left:825px;bottom:309px;}
#t58_3{left:66px;bottom:277px;letter-spacing:0.11px;}
#t59_3{left:616px;bottom:277px;letter-spacing:0.25px;}
#t5a_3{left:66px;bottom:240px;letter-spacing:-0.14px;}
#t5b_3{left:616px;bottom:240px;letter-spacing:-0.01px;}
#t5c_3{left:723px;bottom:240px;}
#t5d_3{left:756px;bottom:240px;}
#t5e_3{left:66px;bottom:215px;letter-spacing:0.1px;}
#t5f_3{left:66px;bottom:202px;letter-spacing:0.1px;}
#t5g_3{left:616px;bottom:203px;letter-spacing:-0.01px;}
#t5h_3{left:66px;bottom:166px;letter-spacing:-0.01px;}
#t5i_3{left:616px;bottom:166px;letter-spacing:-0.01px;}
#t5j_3{left:66px;bottom:130px;letter-spacing:-0.01px;}
#t5k_3{left:484px;bottom:130px;letter-spacing:-0.01px;}
#t5l_3{left:616px;bottom:130px;letter-spacing:0.11px;}
#t5m_3{left:55px;bottom:99px;letter-spacing:-0.14px;}
#t5n_3{left:83px;bottom:97px;}
#t5o_3{left:760px;bottom:99px;letter-spacing:-0.14px;}
#t5p_3{left:788px;bottom:97px;letter-spacing:0.15px;}
#t5q_3{left:816px;bottom:99px;letter-spacing:-0.14px;}

.s0_3{font-size:15px;font-family:OCRAStd_1fm_3;color:#000;}
.s1_3{font-size:11px;font-family:HelveticaNeueLTStd-Bd_1fn_3;color:#000;}
.s2_3{font-size:11px;font-family:HelveticaNeueLTStd-It_1fo_3;color:#000;}
.s3_3{font-size:15px;font-family:HelveticaNeueLTStd-Roman_1fp_3;color:#000;}
.s4_3{font-size:14px;font-family:HelveticaNeueLTStd-Bd_1fn_3;color:#FFF;}
.s5_3{font-size:14px;font-family:HelveticaNeueLTStd-Bd_1fn_3;color:#000;}
.s6_3{font-size:13px;font-family:HelveticaNeueLTStd-Bd_1fn_3;color:#000;}
.s7_3{font-size:13px;font-family:HelveticaNeueLTStd-Roman_1fp_3;color:#000;}
.s8_3{font-size:26px;font-family:HelveticaNeueLTStd-Bd_1fn_3;color:#000;}
.s9_3{font-size:12px;font-family:HelveticaNeueLTStd-Bd_1fn_3;color:#000;}
.sa_3{font-size:12px;font-family:HelveticaNeueLTStd-Roman_1fp_3;color:#000;}
.sb_3{font-size:11px;font-family:HelveticaNeueLTStd-Roman_1fp_3;color:#000;}
.sc_3{font-size:17px;font-family:HelveticaNeueLTStd-Bd_1fn_3;color:#000;}
.sd_3{font-size:15px;font-family:HelveticaNeueLTStd-Bd_1fn_3;color:#000;}
.t.v0_3{transform:scaleX(0.84);}
.t.v1_3{transform:scaleX(0.83);}
.t.v2_3{transform:scaleX(0.96);}
.t.v3_3{transform:scaleX(0.99);}
.t.v4_3{transform:scaleX(0.95);}
.t.v5_3{transform:scaleX(0.969);}
.t.v6_3{transform:scaleX(0.98);}
#form1_3{	z-index: 2;	padding: 0px;	position: absolute;	left: 55px;	top: 87px;	width: 381px;	height: 20px;	color: rgb(0,0,0);	text-align: left;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form2_3{	z-index: 2;	padding: 0px;	position: absolute;	left: 627px;	top: 87px;	width: 32px;	height: 20px;	color: rgb(0,0,0);	text-align: center;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form3_3{	z-index: 2;	padding: 0px;	position: absolute;	left: 671px;	top: 87px;	width: 74px;	height: 20px;	color: rgb(0,0,0);	text-align: center;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form4_3{	z-index: 2;	border-style: none;	padding: 0px;	position: absolute;	left: 737px;	top: 138px;	width: 15px;	height: 15px;	color: rgb(0,0,0);	text-align: left;	background: transparent;	font: normal 12px Wingdings, 'Zapf Dingbats';}
#form5_3{	z-index: 2;	padding: 0px;	position: absolute;	left: 319px;	top: 164px;	width: 119px;	height: 20px;	color: rgb(0,0,0);	text-align: left;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form6_3{	z-index: 2;	border-style: none;	padding: 0px;	position: absolute;	left: 737px;	top: 202px;	width: 15px;	height: 15px;	color: rgb(0,0,0);	text-align: left;	background: transparent;	font: normal 12px Wingdings, 'Zapf Dingbats';}
#form7_3{	z-index: 2;	padding: 0px;	position: absolute;	left: 682px;	top: 228px;	width: 153px;	height: 20px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form8_3{	z-index: 2;	padding: 0px;	position: absolute;	left: 847px;	top: 228px;	width: 31px;	height: 20px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form9_3{	z-index: 2;	padding: 0px;	position: absolute;	left: 682px;	top: 255px;	width: 153px;	height: 20px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form10_3{	z-index: 2;	padding: 0px;	position: absolute;	left: 847px;	top: 255px;	width: 31px;	height: 20px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form11_3{	z-index: 2;	background-size: 100% 100%;	background-image: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGcAAAAQCAMAAAA8uJGyAAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAABVJREFUeNpjYBgFo2AUjIJRMAroDwAGgAABi47q4AAAAABJRU5ErkJggg==");	background-repeat: no-repeat;	border-style: none;	padding: 0px;	position: absolute;	left: 682px;	top: 283px;	width: 154px;	height: 22px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	font: normal 15px 'Times New Roman', Times, serif;}
#form12_3{	z-index: 2;	background-size: 100% 100%;	background-image: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABcAAAAQCAMAAADK8RQqAAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAAA1JREFUeNpjYBgFAwkAAYAAAWvLIfwAAAAASUVORK5CYII=");	background-repeat: no-repeat;	border-style: none;	padding: 0px;	position: absolute;	left: 847px;	top: 283px;	width: 32px;	height: 22px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	font: normal 15px 'Times New Roman', Times, serif;}
#form13_3{	z-index: 2;	background-size: 100% 100%;	background-image: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGcAAAAQCAMAAAA8uJGyAAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAABVJREFUeNpjYBgFo2AUjIJRMAroDwAGgAABi47q4AAAAABJRU5ErkJggg==");	background-repeat: no-repeat;	border-style: none;	padding: 0px;	position: absolute;	left: 682px;	top: 310px;	width: 154px;	height: 22px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	font: normal 15px 'Times New Roman', Times, serif;}
#form14_3{	z-index: 2;	background-size: 100% 100%;	background-image: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABcAAAAQCAMAAADK8RQqAAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAAA1JREFUeNpjYBgFAwkAAYAAAWvLIfwAAAAASUVORK5CYII=");	background-repeat: no-repeat;	border-style: none;	padding: 0px;	position: absolute;	left: 847px;	top: 310px;	width: 32px;	height: 22px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	font: normal 15px 'Times New Roman', Times, serif;}
#form15_3{	z-index: 2;	padding: 0px;	position: absolute;	left: 682px;	top: 338px;	width: 153px;	height: 20px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form16_3{	z-index: 2;	padding: 0px;	position: absolute;	left: 847px;	top: 338px;	width: 31px;	height: 20px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form17_3{	z-index: 2;	padding: 0px;	position: absolute;	left: 682px;	top: 365px;	width: 153px;	height: 20px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form18_3{	z-index: 2;	padding: 0px;	position: absolute;	left: 847px;	top: 365px;	width: 31px;	height: 20px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form19_3{	z-index: 2;	padding: 0px;	position: absolute;	left: 682px;	top: 402px;	width: 153px;	height: 20px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form20_3{	z-index: 2;	padding: 0px;	position: absolute;	left: 847px;	top: 402px;	width: 31px;	height: 20px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form21_3{	z-index: 2;	padding: 0px;	position: absolute;	left: 682px;	top: 439px;	width: 153px;	height: 20px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form22_3{	z-index: 2;	padding: 0px;	position: absolute;	left: 847px;	top: 439px;	width: 31px;	height: 20px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form23_3{	z-index: 2;	padding: 0px;	position: absolute;	left: 682px;	top: 466px;	width: 153px;	height: 20px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form24_3{	z-index: 2;	padding: 0px;	position: absolute;	left: 847px;	top: 466px;	width: 31px;	height: 20px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form25_3{	z-index: 2;	padding: 0px;	position: absolute;	left: 682px;	top: 503px;	width: 153px;	height: 20px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form26_3{	z-index: 2;	padding: 0px;	position: absolute;	left: 847px;	top: 503px;	width: 31px;	height: 20px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form27_3{	z-index: 2;	border-style: none;	padding: 0px;	position: absolute;	left: 99px;	top: 599px;	width: 15px;	height: 15px;	color: rgb(0,0,0);	text-align: left;	background: transparent;	font: normal 12px Wingdings, 'Zapf Dingbats';}
#form28_3{	z-index: 2;	padding: 0px;	position: absolute;	left: 397px;	top: 594px;	width: 261px;	height: 20px;	color: rgb(0,0,0);	text-align: left;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form29_3{	z-index: 2;	padding: 0px;	position: absolute;	left: 704px;	top: 594px;	width: 164px;	height: 20px;	color: rgb(0,0,0);	text-align: center;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form30_3{	z-index: 2;	padding: 0px;	position: absolute;	left: 660px;	top: 631px;	width: 162px;	height: 20px;	color: rgb(0,0,0);	text-align: left;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form31_3{	z-index: 2;	border-style: none;	padding: 0px;	position: absolute;	left: 99px;	top: 663px;	width: 15px;	height: 15px;	color: rgb(0,0,0);	text-align: left;	background: transparent;	font: normal 12px Wingdings, 'Zapf Dingbats';}
#form32_3{	z-index: 2;	padding: 0px;	position: absolute;	left: 596px;	top: 755px;	width: 272px;	height: 20px;	color: rgb(0,0,0);	text-align: left;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form33_3{	z-index: 2;	padding: 0px;	position: absolute;	left: 596px;	top: 791px;	width: 272px;	height: 20px;	color: rgb(0,0,0);	text-align: left;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form34_3{	z-index: 2;	padding: 0px;	position: absolute;	left: 649px;	top: 838px;	width: 219px;	height: 20px;	color: rgb(0,0,0);	text-align: center;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form35_3{	z-index: 2;	border-style: none;	padding: 0px;	position: absolute;	left: 842px;	top: 880px;	width: 15px;	height: 15px;	color: rgb(0,0,0);	text-align: left;	background: transparent;	font: normal 12px Wingdings, 'Zapf Dingbats';}
#form36_3{	z-index: 2;	padding: 0px;	position: absolute;	left: 188px;	top: 906px;	width: 394px;	height: 20px;	color: rgb(0,0,0);	text-align: left;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form37_3{	z-index: 2;	padding: 0px;	position: absolute;	left: 682px;	top: 906px;	width: 187px;	height: 20px;	color: rgb(0,0,0);	text-align: center;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form38_3{	z-index: 2;	padding: 0px;	position: absolute;	left: 188px;	top: 979px;	width: 394px;	height: 20px;	color: rgb(0,0,0);	text-align: left;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form39_3{	z-index: 2;	padding: 0px;	position: absolute;	left: 682px;	top: 979px;	width: 187px;	height: 20px;	color: rgb(0,0,0);	text-align: center;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form40_3{	z-index: 2;	padding: 0px;	position: absolute;	left: 188px;	top: 1016px;	width: 394px;	height: 20px;	color: rgb(0,0,0);	text-align: left;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form41_3{	z-index: 2;	padding: 0px;	position: absolute;	left: 682px;	top: 1016px;	width: 187px;	height: 20px;	color: rgb(0,0,0);	text-align: center;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form42_3{	z-index: 2;	padding: 0px;	position: absolute;	left: 188px;	top: 1053px;	width: 272px;	height: 20px;	color: rgb(0,0,0);	text-align: left;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form43_3{	z-index: 2;	padding: 0px;	position: absolute;	left: 529px;	top: 1053px;	width: 54px;	height: 20px;	color: rgb(0,0,0);	text-align: center;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form44_3{	z-index: 2;	padding: 0px;	position: absolute;	left: 682px;	top: 1053px;	width: 187px;	height: 20px;	color: rgb(0,0,0);	text-align: center;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form4_3 { z-index:6; }
#form6_3 { z-index:5; }
#form27_3 { z-index:4; }
#form31_3 { z-index:3; }
#form35_3 { z-index:2; }

</style>
<!-- End inline CSS -->

<!-- Begin embedded font definitions -->
<style id="fonts3" type="text/css" >

@font-face {
	font-family: HelveticaNeueLTStd-Bd_1fn_3;
	src: url(data:application/font-woff;charset=utf-8;base64,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) format("woff"),
url(data:font/truetype;charset=utf-8;base64,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) format("otf");
}

@font-face {
	font-family: HelveticaNeueLTStd-It_1fo_3;
	src: url(data:application/font-woff;charset=utf-8;base64,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) format("woff"),
url(data:font/truetype;charset=utf-8;base64,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) format("otf");
}

@font-face {
	font-family: HelveticaNeueLTStd-Roman_1fp_3;
	src: url(data:application/font-woff;charset=utf-8;base64,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) format("woff"),
url(data:font/truetype;charset=utf-8;base64,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) format("otf");
}

@font-face {
	font-family: OCRAStd_1fm_3;
	src: url(data:application/font-woff;charset=utf-8;base64,d09GRk9UVE8AAAUUAAkAAAAAB2QAAQABAAAAAAAAAAAAAAAAAAAAAAAAAABDRkYgAAAA4AAAAhIAAAI2uzP+xE9TLzIAAAL0AAAAKgAAAGAJsQihY21hcAAAAyAAAABVAAABkgMqBeRoZWFkAAADeAAAADMAAAA29+e3LGhoZWEAAAOsAAAAIAAAACQCtAJ4aG10eAAAA8wAAAAMAAAADgLQAABtYXhwAAAD2AAAAAYAAAAGAAZQAG5hbWUAAAPgAAABHgAAAgdYbHT/cG9zdAAABQAAAAATAAAAIP+GADZ4nFWPQWjTYBiG/3TrH9xqZcMotCN/bl5E2+1Se7FlMBAFxRa8tU6TtZvr0ibZpI6ysXqYBNoKItaD69qmo6ILgk6JeNHd3MFTD568eWhHjn/C34HpEIfwfZeX933e76PAsAtQFOW9OX07GlP4ZHAuk5waKMjyU9b54SOeFCfcNfu7G184g4NjH6zauDXhYYCLomZi02I2L82n0goXvBIKXeQmA4FJLsqL9wQulpcVISNz15bui1JWlGYVgb/ERRcXueOAzEmCLEgrjnh5JhbPZwUuxPHCHAAUGHOBcwD4AIDObcAFIiAKatQ4lfTavGpaHZPCbhMb5hCet18x8UQijvodOraX3GexAff3Pn5DVof+mvgUZ4lxFGasDjYcg/c4jouDOSHg3wzehW/qlXoT7Willu7Ds7S+2RI1ti4plQU/+QVzciGVahQ0hHukSN7CiCBEEPlp3aK1RlXX5WoOkR78D5828R0Hf2CHGfwEntgO+9fxZweyCleV6tMCyrxwV9Y3Smv+3LKcS7c3Wmvo3SP3evPlY82PJahr5XYT1Zql7dc+vEDvbjYGd8ly5YGf3Pjb2DFx4N9DVtlkllYeZrJbSht9ge2tegvZYVpbbohsn4Wi04LIMzq3Le+wuAeJYTI4gA0SoL2qaunqDxUz6nsVkrsqzY4MPb/qOaV6Rrsj3dFu2eNx9rTNn/0DUKQCAQAAeJxjYGa6wDiBgZWBgSENCBnQaUY4YMAGHEAEs8J/CxDJcAJTAQB4MAZfAAB4nGNgYGBmgGAZBkYGEOgB8kCsEAYWBgsgzcXAwcAEhEYMpgyW///+/w8UM4Cx/1/8f/7/GagOGCBXHwMjGwOqABGAkYkZZCMDAyuJGgcpAABwah8BAAAAeJxjYGRgYADijRvW74rnt/nKwMD8AijCcJpxFwOM/mvwX5B1AbM5kMvOwAQSBQBa6AuIAHicY2BkYGBW+G/BwMB04a8BQx5TEgNQBAUwAgBp0wQveJxjusCABAAKugDTAABQAAAGAAB4nHWQzWrCQBRGTzQKbWm760IozbZQgtFdFy2iiIg/QcVNFyGYRANmRmJc+FKFPkfXfZ9e63SRhYEJ5577zWVmgDs+sTh/T7LObHEr1Zkr1HgxXOURz7AtmYnhGjd8GK6LTyRp2VdSvbE3bNHgy3CFa74NV3nlx7BNw7o3XOPBejZcF/8+0c5K7455ut4UTqoSnWdhkWrlJPqgInfanXXmRRR4SRa0ZzoL1dCPo3Dr+L1+a7AYj5xSolQs43x/muS5zZKXC2ocVvLfcSQnZc2GQlyKkmtqcRmhmFRYiT+5g1CEy5QuMzrMpR8RyNMlkg5oi9V/+xRDfGLphmxlt0+PPi0GLBgzEnN5xuXOUibm8vD/Z/LkLM3L+V8cqlYBAAB4nGNgZgCD/80MZgxYAAAomAG8AA==) format("woff"),
url(data:font/truetype;charset=utf-8;base64,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) format("otf");
}

</style>
<!-- End embedded font definitions -->

<!-- Begin page background -->
<div id="pg3Overlay" style="width:100%; height:100%; position:absolute; z-index:1; background-color:rgba(0,0,0,0); -webkit-user-select: none;"></div>
<div id="pg3" style="-webkit-user-select: none;"><svg id="pdf3" width="934" height="1209" viewBox="0 0 934 1209" style="width:934px; height:1209px; -moz-transform:scale(1); z-index: 0; isolation: isolate;" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
<defs>
<style type="text/css"><![CDATA[
.g0_3{
fill: none;
stroke: #000;
stroke-width: 1.527;
stroke-miterlimit: 10;
}
.g1_3{
fill: none;
stroke: #000;
stroke-width: 0.763;
stroke-miterlimit: 10;
}
.g2_3{
fill: #000;
}
.g3_3{
fill: none;
stroke: #000;
stroke-width: 1.222;
stroke-miterlimit: 10;
}
.g4_3{
fill: #D9D9D9;
}
.g5_3{
fill: none;
stroke: #000;
stroke-width: 0.762;
stroke-miterlimit: 10;
}
]]></style>
</defs>
<path d="M54.6,73.3H880.4" class="g0_3"/>
<path d="M605,72.9V89m0,-.8v22.2" class="g1_3"/>
<path d="M55,128.3h55V110H55v18.3Z" class="g2_3"/>
<path d="M54.6,110H880.4" class="g3_3"/>
<path d="M54.6,128.3H880.4M737,154.3h15.3V139H737v15.3ZM319,187.9H440V165H319v22.9Zm418,30.6h15.3V203.2H737v15.3Zm-55.4,10.7H836.4M681.6,252.1H836.4M682,228.8v23.7M835.6,229.2h44.8m-44.8,22.9h44.8M880,228.8v23.7m-198.4,4.2H836.4M681.6,279.6H836.4M682,256.3V280M835.6,256.7h44.8m-44.8,22.9h44.8M880,256.3V280" class="g1_3"/>
<path d="M682,307.1H836V284.2H682v22.9Z" class="g4_3"/>
<path d="M681.6,284.2H836.4M681.6,307.1H836.4M682,283.8v23.7" class="g1_3"/>
<path d="M836,307.1h44V284.2H836v22.9Z" class="g4_3"/>
<path d="M835.6,284.2h44.8m-44.8,22.9h44.8M880,283.8v23.7" class="g1_3"/>
<path d="M682,334.6H836V311.7H682v22.9Z" class="g4_3"/>
<path d="M681.6,311.7H836.4M681.6,334.6H836.4M682,311.3V335" class="g1_3"/>
<path d="M836,334.6h44V311.7H836v22.9Z" class="g4_3"/>
<path d="M835.6,311.7h44.8m-44.8,22.9h44.8M880,311.3V335m-198.4,4.2H836.4M681.6,362.1H836.4M682,338.8v23.7M835.6,339.2h44.8m-44.8,22.9h44.8M880,338.8v23.7m-198.4,4.2H836.4M681.6,389.6H836.4M682,366.3V390M835.6,366.7h44.8m-44.8,22.9h44.8M880,366.3V390M681.6,403.3H836.4m-154.8,23H836.4M682,402.9v23.7M835.6,403.3h44.8m-44.8,23h44.8M880,402.9v23.7M681.6,440H836.4M681.6,462.9H836.4M682,439.6v23.7M835.6,440h44.8m-44.8,22.9h44.8M880,439.6v23.7m-198.4,4.2H836.4M681.6,490.4H836.4M682,467.1v23.7M835.6,467.5h44.8m-44.8,22.9h44.8M880,467.1v23.7M681.6,504.2H836.4M681.6,527.1H836.4M682,503.8v23.7M835.6,504.2h44.8m-44.8,22.9h44.8M880,503.8v23.7" class="g1_3"/>
<path d="M55,559.2h55V540.8H55v18.4Z" class="g2_3"/>
<path d="M54.6,540.8H880.4" class="g3_3"/>
<path d="M54.6,559.2H880.4M99,614.9h15.3V599.7H99v15.2Zm297,3.9H660v-23H396v23Zm308,0H869v-23H704v23Zm-17.8,13.7H665.3m20.9,21.4H665.3m22,.6V631.9m-23.1,22.6V631.9" class="g1_3"/>
<path d="M664.2,631.9v22.4m-.3,-.4h22.3m-20.9,0h22.4m-.4,.4V631.9m0,22.6V632.1m.4,.4H665.3m20.9,0H663.9m.3,-.4v22.4" class="g5_3"/>
<path d="M719.2,632.5H698.3m20.9,21.4H698.3m22,.6V631.9m-23.1,22.6V631.9" class="g1_3"/>
<path d="M697.2,631.9v22.4m-.3,-.4h22.3m-20.9,0h22.4m-.4,.4V631.9m0,22.6V632.1m.4,.4H698.3m20.9,0H696.9m.3,-.4v22.4" class="g5_3"/>
<path d="M752.2,632.5H731.3m20.9,21.4H731.3m22,.6V631.9m-23.1,22.6V631.9" class="g1_3"/>
<path d="M730.2,631.9v22.4m-.3,-.4h22.3m-20.9,0h22.4m-.4,.4V631.9m0,22.6V632.1m.4,.4H731.3m20.9,0H729.9m.3,-.4v22.4" class="g5_3"/>
<path d="M785.2,632.5H764.3m20.9,21.4H764.3m22,.6V631.9m-23.1,22.6V631.9" class="g1_3"/>
<path d="M763.2,631.9v22.4m-.3,-.4h22.3m-20.9,0h22.4m-.4,.4V631.9m0,22.6V632.1m.4,.4H764.3m20.9,0H762.9m.3,-.4v22.4" class="g5_3"/>
<path d="M818.2,632.5H797.3m20.9,21.4H797.3m22,.6V631.9m-23.1,22.6V631.9" class="g1_3"/>
<path d="M796.2,631.9v22.4m-.3,-.4h22.3m-20.9,0h22.4m-.4,.4V631.9m0,22.6V632.1m.4,.4H797.3m20.9,0H795.9m.3,-.4v22.4" class="g5_3"/>
<path d="M99,679.1h15.3V663.8H99v15.3Z" class="g1_3"/>
<path d="M55,705.8h55V687.5H55v18.3Z" class="g2_3"/>
<path d="M54.6,687.5H880.4" class="g3_3"/>
<path d="M54.6,705.8H880.4M165,815.8H495V751.7H165v64.1Zm0,41.3H286V834.2H165v22.9ZM594,774.6H869V751.7H594v22.9Zm0,36.7H869v-23H594v23Zm55,45.8H869V834.2H649v22.9Zm231,13.7H55m786.5,26h15.3V881.5H841.5v15.3ZM187,930.4H583V907.5H187v22.9Zm495,0H869V907.5H682v22.9ZM187,967.1H583V944.2H187v22.9Zm495,0H814V944.2H682v22.9Zm-495,36.7H583v-23H187v23Zm495,0H869v-23H682v23Zm-495,36.6H583v-22.9H187v22.9Zm495,0H869v-22.9H682v22.9Zm-495,36.7H462v-22.9H187v22.9Zm341,0h55v-22.9H528v22.9Zm154,0H869v-22.9H682v22.9Z" class="g1_3"/>
<path d="M54.6,1090.8H99.4m-.8,0H880.4" class="g0_3"/>
</svg></div>
<!-- End page background -->


<!-- Begin text definitions (Positioned/styled in CSS) -->
<div class="text-container"><span id="t1_3" class="t s0_3">950922 </span>
<span id="t2_3" class="t s1_3">Name </span><span id="t3_3" class="t s2_3">(not your trade name) </span><span id="t4_3" class="t s1_3">Employer identification number (EIN) </span>
<span id="t5_3" class="t s3_3">– </span>
<span id="t6_3" class="t s4_3">Part 3: </span><span id="t7_3" class="t s5_3">Tell us about your business. If a question does NOT apply to your business, leave it blank. </span>
<span id="t8_3" class="t s6_3">17 </span><span id="t9_3" class="t s6_3">If your business has closed or you stopped paying wages </span><span id="ta_3" class="t s7_3">. </span><span id="tb_3" class="t s7_3">. </span><span id="tc_3" class="t s7_3">. </span><span id="td_3" class="t s7_3">. </span><span id="te_3" class="t s7_3">. </span><span id="tf_3" class="t s7_3">. </span><span id="tg_3" class="t s7_3">. </span><span id="th_3" class="t s7_3">. </span><span id="ti_3" class="t s7_3">. </span><span id="tj_3" class="t s7_3">. </span><span id="tk_3" class="t s7_3">. </span><span id="tl_3" class="t s7_3">. </span><span id="tm_3" class="t s7_3">. </span><span id="tn_3" class="t s7_3">. </span><span id="to_3" class="t s7_3">. </span><span id="tp_3" class="t s7_3">Check here, and </span>
<span id="tq_3" class="t s7_3">enter the final date you paid wages </span><span id="tr_3" class="t s7_3">/ </span><span id="ts_3" class="t s7_3">/ </span><span id="tt_3" class="t s7_3">; also attach a statement to your return. See instructions. </span>
<span id="tu_3" class="t s6_3">18 </span><span id="tv_3" class="t s6_3">If you’re a seasonal employer and you don’t have to file a return for every quarter of the year </span><span id="tw_3" class="t s7_3">. </span><span id="tx_3" class="t s7_3">. </span><span id="ty_3" class="t s7_3">. </span><span id="tz_3" class="t s7_3">Check here. </span>
<span id="t10_3" class="t s6_3">19 </span><span id="t11_3" class="t v0_3 s6_3">Qualified health plan expenses allocable to qualified sick leave wages for leave taken before April 1, 2021 </span><span id="t12_3" class="t s6_3">19 </span><span id="t13_3" class="t s8_3">. </span>
<span id="t14_3" class="t s6_3">20 </span><span id="t15_3" class="t v1_3 s6_3">Qualified health plan expenses allocable to qualified family leave wages for leave taken before April 1, 2021 </span><span id="t16_3" class="t s6_3">20 </span><span id="t17_3" class="t s8_3">. </span>
<span id="t18_3" class="t s6_3">21 </span><span id="t19_3" class="t s6_3">Reserved for future use </span><span id="t1a_3" class="t s7_3">. </span><span id="t1b_3" class="t s7_3">. </span><span id="t1c_3" class="t s7_3">. </span><span id="t1d_3" class="t s7_3">. </span><span id="t1e_3" class="t s7_3">. </span><span id="t1f_3" class="t s7_3">. </span><span id="t1g_3" class="t s7_3">. </span><span id="t1h_3" class="t s7_3">. </span><span id="t1i_3" class="t s7_3">. </span><span id="t1j_3" class="t s7_3">. </span><span id="t1k_3" class="t s7_3">. </span><span id="t1l_3" class="t s7_3">. </span><span id="t1m_3" class="t s7_3">. </span><span id="t1n_3" class="t s7_3">. </span><span id="t1o_3" class="t s7_3">. </span><span id="t1p_3" class="t s7_3">. </span><span id="t1q_3" class="t s7_3">. </span><span id="t1r_3" class="t s7_3">. </span><span id="t1s_3" class="t s7_3">. </span><span id="t1t_3" class="t s7_3">. </span><span id="t1u_3" class="t s7_3">. </span><span id="t1v_3" class="t s7_3">. </span><span id="t1w_3" class="t s6_3">21 </span><span id="t1x_3" class="t s8_3">. </span>
<span id="t1y_3" class="t s6_3">22 </span><span id="t1z_3" class="t s6_3">Reserved for future use </span><span id="t20_3" class="t s7_3">. </span><span id="t21_3" class="t s7_3">. </span><span id="t22_3" class="t s7_3">. </span><span id="t23_3" class="t s7_3">. </span><span id="t24_3" class="t s7_3">. </span><span id="t25_3" class="t s7_3">. </span><span id="t26_3" class="t s7_3">. </span><span id="t27_3" class="t s7_3">. </span><span id="t28_3" class="t s7_3">. </span><span id="t29_3" class="t s7_3">. </span><span id="t2a_3" class="t s7_3">. </span><span id="t2b_3" class="t s7_3">. </span><span id="t2c_3" class="t s7_3">. </span><span id="t2d_3" class="t s7_3">. </span><span id="t2e_3" class="t s7_3">. </span><span id="t2f_3" class="t s7_3">. </span><span id="t2g_3" class="t s7_3">. </span><span id="t2h_3" class="t s7_3">. </span><span id="t2i_3" class="t s7_3">. </span><span id="t2j_3" class="t s7_3">. </span><span id="t2k_3" class="t s7_3">. </span><span id="t2l_3" class="t s7_3">. </span><span id="t2m_3" class="t s6_3">22 </span><span id="t2n_3" class="t s8_3">. </span>
<span id="t2o_3" class="t s6_3">23 </span><span id="t2p_3" class="t v2_3 s6_3">Qualified sick leave wages for leave taken after March 31, 2021, and before October 1, 2021 </span><span id="t2q_3" class="t s6_3">23 </span><span id="t2r_3" class="t s8_3">. </span>
<span id="t2s_3" class="t s6_3">24 </span><span id="t2t_3" class="t v3_3 s6_3">Qualified health plan expenses allocable to qualified sick leave wages reported on line 23 </span><span id="t2u_3" class="t s6_3">24 </span><span id="t2v_3" class="t s8_3">. </span>
<span id="t2w_3" class="t s6_3">25 </span><span id="t2x_3" class="t s6_3">Amounts under certain collectively bargained agreements allocable to qualified sick </span>
<span id="t2y_3" class="t s6_3">leave wages reported on line 23 </span><span id="t2z_3" class="t s7_3">. </span><span id="t30_3" class="t s7_3">. </span><span id="t31_3" class="t s7_3">. </span><span id="t32_3" class="t s7_3">. </span><span id="t33_3" class="t s7_3">. </span><span id="t34_3" class="t s7_3">. </span><span id="t35_3" class="t s7_3">. </span><span id="t36_3" class="t s7_3">. </span><span id="t37_3" class="t s7_3">. </span><span id="t38_3" class="t s7_3">. </span><span id="t39_3" class="t s7_3">. </span><span id="t3a_3" class="t s7_3">. </span><span id="t3b_3" class="t s7_3">. </span><span id="t3c_3" class="t s7_3">. </span><span id="t3d_3" class="t s7_3">. </span><span id="t3e_3" class="t s7_3">. </span><span id="t3f_3" class="t s7_3">. </span><span id="t3g_3" class="t s7_3">. </span><span id="t3h_3" class="t s7_3">. </span><span id="t3i_3" class="t s6_3">25 </span>
<span id="t3j_3" class="t s8_3">. </span>
<span id="t3k_3" class="t s6_3">26 </span><span id="t3l_3" class="t v4_3 s6_3">Qualified family leave wages for leave taken after March 31, 2021, and before October 1, 2021 </span><span id="t3m_3" class="t s6_3">26 </span><span id="t3n_3" class="t s8_3">. </span>
<span id="t3o_3" class="t s6_3">27 </span><span id="t3p_3" class="t v5_3 s6_3">Qualified health plan expenses allocable to qualified family leave wages reported on line 26 </span><span id="t3q_3" class="t s6_3">27 </span><span id="t3r_3" class="t s8_3">. </span>
<span id="t3s_3" class="t s6_3">28 </span><span id="t3t_3" class="t s6_3">Amounts under certain collectively bargained agreements allocable to qualified family </span>
<span id="t3u_3" class="t s6_3">leave wages reported on line 26 </span><span id="t3v_3" class="t s7_3">. </span><span id="t3w_3" class="t s7_3">. </span><span id="t3x_3" class="t s7_3">. </span><span id="t3y_3" class="t s7_3">. </span><span id="t3z_3" class="t s7_3">. </span><span id="t40_3" class="t s7_3">. </span><span id="t41_3" class="t s7_3">. </span><span id="t42_3" class="t s7_3">. </span><span id="t43_3" class="t s7_3">. </span><span id="t44_3" class="t s7_3">. </span><span id="t45_3" class="t s7_3">. </span><span id="t46_3" class="t s7_3">. </span><span id="t47_3" class="t s7_3">. </span><span id="t48_3" class="t s7_3">. </span><span id="t49_3" class="t s7_3">. </span><span id="t4a_3" class="t s7_3">. </span><span id="t4b_3" class="t s7_3">. </span><span id="t4c_3" class="t s7_3">. </span><span id="t4d_3" class="t s7_3">. </span><span id="t4e_3" class="t s6_3">28 </span>
<span id="t4f_3" class="t s8_3">. </span>
<span id="t4g_3" class="t s4_3">Part 4: </span><span id="t4h_3" class="t s5_3">May we speak with your third-party designee? </span>
<span id="t4i_3" class="t s9_3">Do you want to allow an employee, a paid tax preparer, or another person to discuss this return with the IRS? </span><span id="t4j_3" class="t sa_3">See the instructions </span>
<span id="t4k_3" class="t sa_3">for details. </span>
<span id="t4l_3" class="t s7_3">Yes. </span><span id="t4m_3" class="t s7_3">Designee’s name and phone number </span>
<span id="t4n_3" class="t s7_3">Select a 5-digit personal identification number (PIN) to use when talking to the IRS. </span>
<span id="t4o_3" class="t s7_3">No. </span>
<span id="t4p_3" class="t s4_3">Part 5: </span><span id="t4q_3" class="t s5_3">Sign here. You MUST complete all three pages of Form 941 and SIGN it. </span>
<span id="t4r_3" class="t sb_3">Under penalties of perjury, I declare that I have examined this return, including accompanying schedules and statements, and to the best of my knowledge </span>
<span id="t4s_3" class="t sb_3">and belief, it is true, correct, and complete. Declaration of preparer (other than taxpayer) is based on all information of which preparer has any knowledge. </span>


<span id="t4t_3" class="t sc_3">Sign your <p style="position: absolute; left: 107px; top: 15px;     font-family: 'Pe-icon-7-stroke';"><?php echo htmlspecialchars($company_name, ENT_QUOTES,'UTF-8'); ?></p></span>
<span id="t4u_3" class="t sc_3">name here </span>



<span id="t4v_3" class="t s7_3">Date <p style="position: absolute; top: -2px; left: 51px;font-family:cursive;"><?php echo date('m/d/Y'); ?></p></span>

 

<span id="t4y_3" class="t s7_3">Print your </span>
<span id="t4z_3" class="t s7_3">name here </span>
<span id="t50_3" class="t s7_3">Print your </span>
<span id="t51_3" class="t s7_3">title here </span>
<span id="t52_3" class="t s7_3">Best daytime phone </span>
<span id="t53_3" class="t sd_3">Paid Preparer Use Only </span><span id="t54_3" class="t s7_3">Check if you’re self-employed </span><span id="t55_3" class="t s7_3">. </span><span id="t56_3" class="t s7_3">. </span><span id="t57_3" class="t s7_3">. </span>
<span id="t58_3" class="t sa_3">Preparer’s name </span><span id="t59_3" class="t sb_3">PTIN </span>
<span id="t5a_3" class="t s7_3">Preparer’s signature </span><span id="t5b_3" class="t s7_3">Date </span><span id="t5c_3" class="t s7_3">/ </span><span id="t5d_3" class="t s7_3">/ </span>
<span id="t5e_3" class="t v6_3 sa_3">Firm’s name (or yours </span>
<span id="t5f_3" class="t v6_3 sa_3">if self-employed) </span><span id="t5g_3" class="t s7_3">EIN </span>
<span id="t5h_3" class="t s7_3">Address </span><span id="t5i_3" class="t s7_3">Phone </span>
<span id="t5j_3" class="t s7_3">City </span><span id="t5k_3" class="t s7_3">State </span><span id="t5l_3" class="t sa_3">ZIP code </span>
<span id="t5m_3" class="t sb_3">Page </span><span id="t5n_3" class="t sd_3">3 </span><span id="t5o_3" class="t sb_3">Form </span><span id="t5p_3" class="t sd_3">941 </span><span id="t5q_3" class="t sb_3">(Rev. 3-2024) </span></div>
<!-- End text definitions -->


<!-- Begin Form Data -->
<input id="form1_3" type="text" tabindex="113" value="" data-objref="362 0 R" data-field-name="topmostSubform[0].Page3[0].Name_ReadOrder[0].f1_3[0]"/>
<input id="form2_3" type="text" tabindex="114" maxlength="2" value="" data-objref="360 0 R" data-field-name="topmostSubform[0].Page3[0].EIN_Number[0].f1_1[0]"/>
<input id="form3_3" type="text" tabindex="115" maxlength="7" value="" data-objref="361 0 R" data-field-name="topmostSubform[0].Page3[0].EIN_Number[0].f1_2[0]"/>
<input id="form4_3" type="checkbox" tabindex="116" value="1" data-objref="319 0 R" data-field-name="topmostSubform[0].Page3[0].c3_1[0]" imageOn="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABEAAAARCAMAAAAMs7fIAAAAZlBMVEUAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAABwbJTWAAAAInRSTlMAcDkjf3b/8RjdjwGi1r8GAs4OGU8g2su2guEl5AeS7jQkzdhcKgAAAFlJREFUeNqtz0cSgDAMA0ATQKb3Ekoo//8k4ZL4AfFxR9KMiYJepIjiREAKVlmOwkFZAVwDTeuoswT0g6iNbGUSMC9/hpWXFdAbsPud49SGrvuRNWPn36Avfq3xAzhlMCzyAAAAAElFTkSuQmCC" imageOff="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAMAAAC6V+0/AAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAAA5JREFUeNpjYBgFgx0AAAGkAAF+IKsZAAAAAElFTkSuQmCC" imageDownOff="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABEAAAARCAMAAAAMs7fIAAAAD1BMVEUAAAC/v7+9vb2/v7/Dw8MCye4CAAAABXRSTlMA/0ZAEfKwnsUAAAAVSURBVHjaY2DABIyogGlkizCjAhYAmkIBMfGWWB0AAAAASUVORK5CYII=" imageName="null" images="110100"/>
<input id="form5_3" type="text" tabindex="117" maxlength="8" value="" data-objref="320 0 R" data-field-name="topmostSubform[0].Page3[0].f3_3[0]"/>
<input id="form6_3" type="checkbox" tabindex="118" value="1" data-objref="321 0 R" data-field-name="topmostSubform[0].Page3[0].c3_2[0]" imageOn="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABEAAAARCAMAAAAMs7fIAAAAZlBMVEUAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAABwbJTWAAAAInRSTlMAcDkjf3b/8RjdjwGi1r8GAs4OGU8g2su2guEl5AeS7jQkzdhcKgAAAFlJREFUeNqtz0cSgDAMA0ATQKb3Ekoo//8k4ZL4AfFxR9KMiYJepIjiREAKVlmOwkFZAVwDTeuoswT0g6iNbGUSMC9/hpWXFdAbsPud49SGrvuRNWPn36Avfq3xAzhlMCzyAAAAAElFTkSuQmCC" imageOff="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAMAAAC6V+0/AAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAAA5JREFUeNpjYBgFgx0AAAGkAAF+IKsZAAAAAElFTkSuQmCC" imageDownOff="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABEAAAARCAMAAAAMs7fIAAAAD1BMVEUAAAC/v7+9vb2/v7/Dw8MCye4CAAAABXRSTlMA/0ZAEfKwnsUAAAAVSURBVHjaY2DABIyogGlkizCjAhYAmkIBMfGWWB0AAAAASUVORK5CYII=" imageName="null" images="110100"/>
<input id="form7_3" type="text" tabindex="119" value="" data-objref="322 0 R" data-field-name="topmostSubform[0].Page3[0].f3_4[0]"/>
<input id="form8_3" type="text" tabindex="120" maxlength="3" value="" data-objref="323 0 R" data-field-name="topmostSubform[0].Page3[0].f3_5[0]"/>
<input id="form9_3" type="text" tabindex="121" value="" data-objref="324 0 R" data-field-name="topmostSubform[0].Page3[0].f3_6[0]"/>
<input id="form10_3" type="text" tabindex="122" maxlength="3" value="" data-objref="325 0 R" data-field-name="topmostSubform[0].Page3[0].f3_7[0]"/>
<input id="form11_3" type="button" tabindex="123" disabled="disabled" data-objref="326 0 R" data-field-name="topmostSubform[0].Page3[0].f3_8[0]"/>
<input id="form12_3" type="button" tabindex="124" maxlength="3" disabled="disabled" data-objref="327 0 R" data-field-name="topmostSubform[0].Page3[0].f3_9[0]"/>
<input id="form13_3" type="button" tabindex="125" disabled="disabled" data-objref="328 0 R" data-field-name="topmostSubform[0].Page3[0].f3_10[0]"/>
<input id="form14_3" type="button" tabindex="126" maxlength="3" disabled="disabled" data-objref="329 0 R" data-field-name="topmostSubform[0].Page3[0].f3_11[0]"/>
<input id="form15_3" type="text" tabindex="127" value="" data-objref="330 0 R" data-field-name="topmostSubform[0].Page3[0].f3_12[0]"/>
<input id="form16_3" type="text" tabindex="128" maxlength="3" value="" data-objref="331 0 R" data-field-name="topmostSubform[0].Page3[0].f3_13[0]"/>
<input id="form17_3" type="text" tabindex="129" value="" data-objref="332 0 R" data-field-name="topmostSubform[0].Page3[0].f3_14[0]"/>
<input id="form18_3" type="text" tabindex="130" maxlength="3" value="" data-objref="333 0 R" data-field-name="topmostSubform[0].Page3[0].f3_15[0]"/>
<input id="form19_3" type="text" tabindex="131" value="" data-objref="334 0 R" data-field-name="topmostSubform[0].Page3[0].f3_16[0]"/>
<input id="form20_3" type="text" tabindex="132" maxlength="3" value="" data-objref="335 0 R" data-field-name="topmostSubform[0].Page3[0].f3_17[0]"/>
<input id="form21_3" type="text" tabindex="133" value="" data-objref="336 0 R" data-field-name="topmostSubform[0].Page3[0].f3_18[0]"/>
<input id="form22_3" type="text" tabindex="134" maxlength="3" value="" data-objref="337 0 R" data-field-name="topmostSubform[0].Page3[0].f3_19[0]"/>
<input id="form23_3" type="text" tabindex="135" value="" data-objref="338 0 R" data-field-name="topmostSubform[0].Page3[0].f3_20[0]"/>
<input id="form24_3" type="text" tabindex="136" maxlength="3" value="" data-objref="339 0 R" data-field-name="topmostSubform[0].Page3[0].f3_21[0]"/>
<input id="form25_3" type="text" tabindex="137" value="" data-objref="340 0 R" data-field-name="topmostSubform[0].Page3[0].f3_22[0]"/>
<input id="form26_3" type="text" tabindex="138" maxlength="3" value="" data-objref="341 0 R" data-field-name="topmostSubform[0].Page3[0].f3_23[0]"/>
<input id="form27_3" type="checkbox" tabindex="139" value="1" data-objref="342 0 R" data-field-name="topmostSubform[0].Page3[0].c3_4[0]" imageOn="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABEAAAARCAMAAAAMs7fIAAAAZlBMVEUAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAABwbJTWAAAAInRSTlMAcDkjf3b/8RjdjwGi1r8GAs4OGU8g2su2guEl5AeS7jQkzdhcKgAAAFlJREFUeNqtz0cSgDAMA0ATQKb3Ekoo//8k4ZL4AfFxR9KMiYJepIjiREAKVlmOwkFZAVwDTeuoswT0g6iNbGUSMC9/hpWXFdAbsPud49SGrvuRNWPn36Avfq3xAzhlMCzyAAAAAElFTkSuQmCC" imageOff="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAMAAAC6V+0/AAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAAA5JREFUeNpjYBgFgx0AAAGkAAF+IKsZAAAAAElFTkSuQmCC" imageDownOff="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABEAAAARCAMAAAAMs7fIAAAAD1BMVEUAAAC/v7+9vb2/v7/Dw8MCye4CAAAABXRSTlMA/0ZAEfKwnsUAAAAVSURBVHjaY2DABIyogGlkizCjAhYAmkIBMfGWWB0AAAAASUVORK5CYII=" imageName="null" images="110100"/>
<input id="form28_3" type="text" tabindex="140" value="" data-objref="343 0 R" data-field-name="topmostSubform[0].Page3[0].f3_24[0]"/>
<input id="form29_3" type="text" tabindex="141" value="" data-objref="344 0 R" data-field-name="topmostSubform[0].Page3[0].f3_25[0]"/>
<input id="form30_3" type="text" tabindex="142" maxlength="5" value="" data-objref="345 0 R" data-field-name="topmostSubform[0].Page3[0].f3_26[0]"/>
<input id="form31_3" type="checkbox" tabindex="143" value="2" data-objref="346 0 R" data-field-name="topmostSubform[0].Page3[0].c3_4[1]" imageOn="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABEAAAARCAMAAAAMs7fIAAAAZlBMVEUAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAABwbJTWAAAAInRSTlMAcDkjf3b/8RjdjwGi1r8GAs4OGU8g2su2guEl5AeS7jQkzdhcKgAAAFlJREFUeNqtz0cSgDAMA0ATQKb3Ekoo//8k4ZL4AfFxR9KMiYJepIjiREAKVlmOwkFZAVwDTeuoswT0g6iNbGUSMC9/hpWXFdAbsPud49SGrvuRNWPn36Avfq3xAzhlMCzyAAAAAElFTkSuQmCC" imageOff="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAMAAAC6V+0/AAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAAA5JREFUeNpjYBgFgx0AAAGkAAF+IKsZAAAAAElFTkSuQmCC" imageDownOff="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABEAAAARCAMAAAAMs7fIAAAAD1BMVEUAAAC/v7+9vb2/v7/Dw8MCye4CAAAABXRSTlMA/0ZAEfKwnsUAAAAVSURBVHjaY2DABIyogGlkizCjAhYAmkIBMfGWWB0AAAAASUVORK5CYII=" imageName="null" images="110100"/>
<input id="form32_3" type="text" tabindex="144" value="<?php echo htmlspecialchars($get_userlist[0]['first_name']."". $get_userlist[0]['last_name'], ENT_QUOTES, 'UTF-8'); ?>" data-objref="347 0 R" data-field-name="topmostSubform[0].Page3[0].f3_27[0]"/>
<input id="form33_3" type="text" tabindex="145" value="ADMIN" data-objref="348 0 R" data-field-name="topmostSubform[0].Page3[0].f3_28[0]"/>
<input id="form34_3" type="text" tabindex="146" value="<?php echo htmlspecialchars($get_userlist[0]['phone'], ENT_QUOTES, 'UTF-8'); ?>" data-objref="349 0 R" data-field-name="topmostSubform[0].Page3[0].f3_29[0]"/>
<input id="form35_3" type="checkbox" tabindex="147" value="1" data-objref="350 0 R" data-field-name="topmostSubform[0].Page3[0].c3_5[0]" imageOn="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABEAAAARCAMAAAAMs7fIAAAAZlBMVEUAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAABwbJTWAAAAInRSTlMAcDkjf3b/8RjdjwGi1r8GAs4OGU8g2su2guEl5AeS7jQkzdhcKgAAAFlJREFUeNqtz0cSgDAMA0ATQKb3Ekoo//8k4ZL4AfFxR9KMiYJepIjiREAKVlmOwkFZAVwDTeuoswT0g6iNbGUSMC9/hpWXFdAbsPud49SGrvuRNWPn36Avfq3xAzhlMCzyAAAAAElFTkSuQmCC" imageOff="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAMAAAC6V+0/AAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAAA5JREFUeNpjYBgFgx0AAAGkAAF+IKsZAAAAAElFTkSuQmCC" imageDownOff="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABEAAAARCAMAAAAMs7fIAAAAD1BMVEUAAAC/v7+9vb2/v7/Dw8MCye4CAAAABXRSTlMA/0ZAEfKwnsUAAAAVSURBVHjaY2DABIyogGlkizCjAhYAmkIBMfGWWB0AAAAASUVORK5CYII=" imageName="null" images="110100"/>
<input id="form36_3" type="text" tabindex="148" value="" data-objref="351 0 R" data-field-name="topmostSubform[0].Page3[0].f3_30[0]"/>
<input id="form37_3" type="text" tabindex="149" maxlength="11" value="" data-objref="352 0 R" data-field-name="topmostSubform[0].Page3[0].f3_31[0]"/>
<input id="form38_3" type="text" tabindex="150" value="" data-objref="353 0 R" data-field-name="topmostSubform[0].Page3[0].f3_32[0]"/>
<input id="form39_3" type="text" tabindex="151" maxlength="10" value="" data-objref="354 0 R" data-field-name="topmostSubform[0].Page3[0].f3_33[0]"/>
<input id="form40_3" type="text" tabindex="152" value="" data-objref="355 0 R" data-field-name="topmostSubform[0].Page3[0].f3_34[0]"/>
<input id="form41_3" type="text" tabindex="153" value="" data-objref="356 0 R" data-field-name="topmostSubform[0].Page3[0].f3_35[0]"/>
<input id="form42_3" type="text" tabindex="154" value="" data-objref="357 0 R" data-field-name="topmostSubform[0].Page3[0].f3_36[0]"/>
<input id="form43_3" type="text" tabindex="155" maxlength="2" value="" data-objref="358 0 R" data-field-name="topmostSubform[0].Page3[0].f3_37[0]"/>
<input id="form44_3" type="text" tabindex="156" maxlength="10" value="" data-objref="359 0 R" data-field-name="topmostSubform[0].Page3[0].f3_38[0]"/>

<!-- End Form Data -->

</div>

</div>
</div>
<div id="page4" style="width: 934px; height: 1209px; margin-top:20px;" class="page">
<div class="page-inner" style="width: 934px; height: 1209px;">

<div id="p4" class="pageArea" style="overflow: hidden; position: relative; width: 934px; height: 1209px; margin-top:auto; margin-left:auto; margin-right:auto; background-color: white;">

<!-- Begin shared CSS values -->
<style class="shared-css" type="text/css" >
.t {
	transform-origin: bottom left;
	z-index: 2;
	position: absolute;
	white-space: pre;
	overflow: visible;
	line-height: 1.5;
}
.text-container {
	white-space: pre;
}
@supports (-webkit-touch-callout: none) {
	.text-container {
		white-space: normal;
	}
}
</style>
<!-- End shared CSS values -->


<!-- Begin inline CSS -->
<style type="text/css" >

#t1_4{left:814px;bottom:1134px;letter-spacing:0.2px;}
#t2_4{left:138px;bottom:585px;letter-spacing:-0.1px;}

.s0_4{font-size:15px;font-family:OCRAStd_1fm_4;color:#000;}
.s1_4{font-size:43px;font-family:HelveticaNeueLTStd-Bd_1fn_4;color:#000;}
</style>
<!-- End inline CSS -->

<!-- Begin embedded font definitions -->
<style id="fonts4" type="text/css" >

@font-face {
	font-family: HelveticaNeueLTStd-Bd_1fn_4;
	src: url(data:application/font-woff;charset=utf-8;base64,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) format("woff"),
url(data:font/truetype;charset=utf-8;base64,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) format("otf");
}

@font-face {
	font-family: OCRAStd_1fm_4;
	src: url(data:application/font-woff;charset=utf-8;base64,d09GRk9UVE8AAAU8AAkAAAAAB6wAAQABAAAAAAAAAAAAAAAAAAAAAAAAAABDRkYgAAAA4AAAAjwAAAJ9m4uDoE9TLzIAAAMcAAAAKgAAAGAJsQihY21hcAAAA0gAAABVAAABkgMqBeRoZWFkAAADoAAAADMAAAA29+e3LGhoZWEAAAPUAAAAIAAAACQCtAJ4aG10eAAAA/QAAAAMAAAADgLQAABtYXhwAAAEAAAAAAYAAAAGAAZQAG5hbWUAAAQIAAABHwAAAgdcbXcAcG9zdAAABSgAAAATAAAAIP+GADZ4nFWPMWgTYRTHv0ua77CNlYqnkJT7busiNSkONYsJhYIoKCYgLqnVuzStTS+5u1ZiSVsah8hBEkHEONg0yaVGtEHQKhGX2kkdnDI4uWVI5Mbvji8FLyoNwnvD+/Pe7/9/FBiwAYqihq9OXQ8EFX7GG4nNnO8pyHBTxpmBQ56kRx1F86sDj53A3pF3RuukMepkgI2ipoNTYjwpzc9FFc57YXLyLDfh8UxwAV68LXDBpKwIMZm7tHRHlOKiNKsI/DgXWFzk/hzInCTIgrRiieemg6FkXOAmOV6IAECBERs4DYALAGhlAzbgBxnQom5S1WGTV3WjqVPYoeOGbsfz5nMmFA6HULdJB/dmDljcgAd77z8jo0nvhz+EWNI49DFGEzeshf71F72j241xnTF9RKUTcmpurpzSEB7rNskYPJoNFmrlQh3hPP1irRiJrK0ssST8l4PTveoHwS0G78JXpXypgna0bLXuwrN0PVMVNbYkKfkFN/nZB+MOSZPX0C8IfkR+GNfonk1dLiQQ6cD/8FEd37Dw30wfgx/C/tqv7mX80YKswlWl8CiFYk8d+Y3N7Lo7sSwnorXN6jp6c9+xUXn2QHNjCda1XK2CipXs9ksXXqB3M+VeLlnO33WTK/8cmzr2HD1k5HRmaeVeLL6l1NAnWNsqVZHpo7Xlssh2WShaLog8phPb8g6LO5A0dAZ7cIN46GFVNerqdxUz6lsVklsqzQ7an1x0HlOdQ+3B9lA753RafdzkT/0GOn0pe3icY2BmusA4gYGVgYEhDQgZ0GlGOGDABhxABLPCfwsQyXACUwEAeDAGXwAAeJxjYGBgZoBgGQZGBhDoAfJArBAGFgYLIM3FwMHABIRGDKYMlv///v8PFDOAsf9f/H/+/xmoDhggVx8DIxsDqgARgJGJGWQjAwMriRoHKQAAcGofAQAAAHicY2BkYGAA4o0b1u+K57f5ysDA/AIownCacRcDjP5r8F+QdQGzOZDLzsAEEgUAWugLiAB4nGNgZGBgVvhvwcDAdOGvAUMeUxIDUAQFMAIAadMEL3icY7rAgAQACroA0wAAUAAABgAAeJx1kM1qwkAURk80Cm1pu+tCKM22UIIRV120iCIi/gQVN12EYBINmBmJceFLFfocXfd9eq3TRRYGJpx77jeXmQHu+MTi/D3JOrPFrVRnrlDjxXCVRzzDtmQmhmvc8GG4Lj6RpGVfSfXG3rBFgy/DFa75NlzllR/DNg3r3nCNB+vZcF38+0Q7K7075ul6UzipSnSehUWqlZPog4rcaXfWmRdR4CVZ0J7pLFRDP47CreP3+q3BYjxySolSsYzz/WmS5zZLXi6ocVjJf8eRnJQ1GwpxKUquqcVlhGJSYSX+5A5CES5TuszoMJd+RCBPl0g6oC1W/+1TDPGJpRuyld0+Pfq0GLBgzEjM5RmXO0uZmMvD/5/Jk7M0L+d/ASHWVgkAeJxjYGYAg//NDGYMWAAAKJgBvAA=) format("woff"),
url(data:font/truetype;charset=utf-8;base64,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) format("otf");
}

</style>
<!-- End embedded font definitions -->

<!-- Begin page background -->
<div id="pg4Overlay" style="width:100%; height:100%; position:absolute; z-index:1; background-color:rgba(0,0,0,0); -webkit-user-select: none;"></div>
<div id="pg4" style="-webkit-user-select: none;"><svg id="pdf4" width="934" height="1209" viewBox="0 0 934 1209" style="width:934px; height:1209px; -moz-transform:scale(1); z-index: 0; isolation: isolate;" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
<defs>
</defs>
</svg></div>
<!-- End page background -->


<!-- Begin text definitions (Positioned/styled in CSS) -->
<div class="text-container"><span id="t1_4" class="t s0_4">951020 </span>
<span id="t2_4" class="t s1_4">This page intentionally left blank </span></div>
<!-- End text definitions -->


</div>

</div>
</div>
<div id="page5" style="width: 934px; height: 1209px; margin-top:20px;" class="page">
<div class="page-inner" style="width: 934px; height: 1209px;">

<div id="p5" class="pageArea" style="overflow: hidden; position: relative; width: 934px; height: 1209px; margin-top:auto; margin-left:auto; margin-right:auto; background-color: white;">

<!-- Begin shared CSS values -->
<style class="shared-css" type="text/css" >
.t {
	transform-origin: bottom left;
	z-index: 2;
	position: absolute;
	white-space: pre;
	overflow: visible;
	line-height: 1.5;
}
.text-container {
	white-space: pre;
}
@supports (-webkit-touch-callout: none) {
	.text-container {
		white-space: normal;
	}
}
</style>
<!-- End shared CSS values -->


<!-- Begin inline CSS -->
<style type="text/css" >

#t1_5{left:55px;bottom:1118px;letter-spacing:0.18px;}
#t2_5{left:55px;bottom:1095px;letter-spacing:0.2px;}
#t3_5{left:55px;bottom:1053px;letter-spacing:0.18px;}
#t4_5{left:55px;bottom:1031px;letter-spacing:0.13px;}
#t5_5{left:55px;bottom:1014px;letter-spacing:0.13px;}
#t6_5{left:55px;bottom:998px;letter-spacing:0.13px;}
#t7_5{left:55px;bottom:982px;letter-spacing:0.12px;}
#t8_5{left:55px;bottom:952px;letter-spacing:0.18px;}
#t9_5{left:55px;bottom:930px;letter-spacing:0.13px;}
#ta_5{left:55px;bottom:914px;letter-spacing:0.11px;}
#tb_5{left:99px;bottom:914px;}
#tc_5{left:55px;bottom:891px;letter-spacing:0.12px;}
#td_5{left:55px;bottom:875px;letter-spacing:0.11px;}
#te_5{left:55px;bottom:858px;letter-spacing:0.12px;}
#tf_5{left:55px;bottom:842px;letter-spacing:0.12px;}
#tg_5{left:55px;bottom:825px;letter-spacing:0.11px;}
#th_5{left:55px;bottom:809px;letter-spacing:0.11px;}
#ti_5{left:55px;bottom:786px;letter-spacing:0.13px;}
#tj_5{left:55px;bottom:770px;letter-spacing:0.13px;}
#tk_5{left:55px;bottom:754px;letter-spacing:0.12px;}
#tl_5{left:55px;bottom:737px;letter-spacing:0.13px;}
#tm_5{left:70px;bottom:715px;letter-spacing:0.13px;}
#tn_5{left:55px;bottom:698px;letter-spacing:0.12px;}
#to_5{left:55px;bottom:682px;letter-spacing:0.12px;}
#tp_5{left:55px;bottom:665px;letter-spacing:0.13px;}
#tq_5{left:56px;bottom:620px;}
#tr_5{left:70px;bottom:628px;}
#ts_5{left:57px;bottom:623px;letter-spacing:-0.09px;}
#tt_5{left:98px;bottom:643px;letter-spacing:0.14px;}
#tu_5{left:399px;bottom:643px;letter-spacing:0.1px;}
#tv_5{left:98px;bottom:626px;letter-spacing:0.13px;}
#tw_5{left:98px;bottom:610px;letter-spacing:0.13px;}
#tx_5{left:55px;bottom:593px;letter-spacing:0.17px;}
#ty_5{left:88px;bottom:593px;letter-spacing:0.12px;}
#tz_5{left:281px;bottom:593px;letter-spacing:0.12px;}
#t10_5{left:404px;bottom:593px;letter-spacing:0.11px;}
#t11_5{left:55px;bottom:577px;letter-spacing:0.12px;}
#t12_5{left:484px;bottom:1053px;letter-spacing:0.16px;}
#t13_5{left:484px;bottom:1031px;letter-spacing:0.14px;}
#t14_5{left:816px;bottom:1031px;letter-spacing:0.1px;}
#t15_5{left:484px;bottom:1014px;letter-spacing:0.12px;}
#t16_5{left:484px;bottom:998px;letter-spacing:0.11px;}
#t17_5{left:665px;bottom:998px;letter-spacing:0.14px;}
#t18_5{left:778px;bottom:998px;letter-spacing:0.12px;}
#t19_5{left:484px;bottom:982px;letter-spacing:0.12px;}
#t1a_5{left:484px;bottom:965px;letter-spacing:0.12px;}
#t1b_5{left:484px;bottom:949px;letter-spacing:0.12px;}
#t1c_5{left:484px;bottom:932px;letter-spacing:0.12px;}
#t1d_5{left:484px;bottom:910px;letter-spacing:0.15px;}
#t1e_5{left:642px;bottom:910px;letter-spacing:0.13px;}
#t1f_5{left:484px;bottom:893px;letter-spacing:0.14px;}
#t1g_5{left:484px;bottom:871px;letter-spacing:0.14px;}
#t1h_5{left:626px;bottom:871px;letter-spacing:0.12px;}
#t1i_5{left:484px;bottom:854px;letter-spacing:0.13px;}
#t1j_5{left:484px;bottom:838px;letter-spacing:0.12px;}
#t1k_5{left:484px;bottom:815px;letter-spacing:0.15px;}
#t1l_5{left:686px;bottom:815px;letter-spacing:0.14px;}
#t1m_5{left:484px;bottom:799px;letter-spacing:0.14px;}
#t1n_5{left:484px;bottom:776px;letter-spacing:0.13px;}
#t1o_5{left:484px;bottom:760px;letter-spacing:0.12px;}
#t1p_5{left:484px;bottom:744px;letter-spacing:0.12px;}
#t1q_5{left:484px;bottom:727px;letter-spacing:0.12px;}
#t1r_5{left:484px;bottom:711px;letter-spacing:0.13px;}
#t1s_5{left:484px;bottom:694px;letter-spacing:0.13px;}
#t1t_5{left:484px;bottom:678px;letter-spacing:0.12px;}
#t1u_5{left:484px;bottom:655px;letter-spacing:0.13px;}
#t1v_5{left:484px;bottom:639px;letter-spacing:0.12px;}
#t1w_5{left:484px;bottom:622px;letter-spacing:0.14px;}
#t1x_5{left:484px;bottom:600px;letter-spacing:0.12px;}
#t1y_5{left:527px;bottom:600px;letter-spacing:0.12px;}
#t1z_5{left:484px;bottom:584px;letter-spacing:0.13px;}
#t20_5{left:222px;bottom:372px;letter-spacing:0.17px;}
#t21_5{left:67.4px;bottom:330.5px;letter-spacing:-0.18px;}
#t22_5{left:69px;bottom:314px;letter-spacing:-0.16px;}
#t23_5{left:55px;bottom:312px;letter-spacing:0.08px;}
#t24_5{left:55px;bottom:302px;letter-spacing:0.07px;}
#t25_5{left:389px;bottom:329px;letter-spacing:0.2px;}
#t26_5{left:313px;bottom:307px;letter-spacing:0.11px;}
#t27_5{left:770px;bottom:340px;letter-spacing:-0.17px;}
#t28_5{left:780px;bottom:298px;letter-spacing:-0.28px;}
#t29_5{left:818px;bottom:298px;letter-spacing:-0.3px;}
#t2a_5{left:60px;bottom:286px;}
#t2b_5{left:77px;bottom:285px;letter-spacing:-0.13px;}
#t2c_5{left:77px;bottom:273px;letter-spacing:-0.14px;}
#t2d_5{left:123px;bottom:244px;}
#t2e_5{left:337px;bottom:286px;}
#t2f_5{left:354px;bottom:264px;letter-spacing:0.14px;}
#t2g_5{left:354px;bottom:249px;letter-spacing:-0.15px;}
#t2h_5{left:545px;bottom:249px;letter-spacing:-0.15px;}
#t2i_5{left:646px;bottom:249px;letter-spacing:-0.11px;}
#t2j_5{left:726px;bottom:286px;letter-spacing:-0.13px;}
#t2k_5{left:838px;bottom:286px;letter-spacing:-0.16px;}
#t2l_5{left:60px;bottom:229px;}
#t2m_5{left:75px;bottom:229px;letter-spacing:-0.15px;}
#t2n_5{left:129px;bottom:204px;letter-spacing:0.08px;}
#t2o_5{left:117px;bottom:190px;letter-spacing:0.11px;}
#t2p_5{left:127px;bottom:156px;letter-spacing:0.09px;}
#t2q_5{left:117px;bottom:141px;letter-spacing:0.11px;}
#t2r_5{left:272px;bottom:201px;letter-spacing:0.08px;}
#t2s_5{left:260px;bottom:187px;letter-spacing:0.11px;}
#t2t_5{left:272px;bottom:156px;letter-spacing:0.08px;}
#t2u_5{left:260px;bottom:141px;letter-spacing:0.11px;}
#t2v_5{left:337px;bottom:228px;}
#t2w_5{left:352px;bottom:228px;letter-spacing:-0.13px;}
#t2x_5{left:352px;bottom:191px;letter-spacing:-0.14px;}
#t2y_5{left:352px;bottom:155px;letter-spacing:-0.1px;}

.s0_5{font-size:21px;font-family:ITCFranklinGothicStd-Demi_1fq_5;color:#000;}
.s1_5{font-size:18px;font-family:HelveticaNeueLTStd-Bd_1fn_5;color:#000;}
.s2_5{font-size:15px;font-family:HelveticaNeueLTStd-Roman_1fp_5;color:#000;}
.s3_5{font-size:15px;font-family:HelveticaNeueLTStd-Bd_1fn_5;color:#000;}
.s4_5{font-size:33px;font-family:AdobePiStd_c_5;color:#FFF;}
.s5_5{font-size:22px;font-family:ITCFranklinGothicStd-Demi_1fq_5;color:#000;}
.s6_5{font-size:7px;font-family:HelveticaNeueLTStd-Blk_e_5;color:#FFF;}
.s7_5{font-size:15px;font-family:HelveticaNeueLTStd-It_1fo_5;color:#000;}
.s8_5{font-size:11px;font-family:HelveticaNeueLTStd-Roman_1fp_5;color:#000;}
.s9_5{font-size:37px;font-family:HelveticaNeueLTStd-BlkCn_1fr_5;color:#000;}
.sa_5{font-size:9px;font-family:HelveticaNeueLTStd-Roman_1fp_5;color:#000;}
.sb_5{font-size:12px;font-family:HelveticaNeueLTStd-Bd_1fn_5;color:#000;}
.sc_5{font-size:31px;font-family:HelveticaNeueLTStd-BdOu_f_5;color:#000;}
.sd_5{font-size:31px;font-family:HelveticaNeueLTStd-Blk_e_5;color:#000;}
.se_5{font-size:11px;font-family:HelveticaNeueLTStd-Bd_1fn_5;color:#000;}
.sf_5{font-size:12px;font-family:HelveticaNeueLTStd-Roman_1fp_5;color:#000;}
.sg_5{font-size:10px;font-family:HelveticaNeueLTStd-Roman_1fp_5;color:#000;}
.t.v0_5{transform:scaleX(1.166);}
.t.v1_5{transform:scaleX(0.87);}
.t.m0_5{transform:matrix(0,-0.86,1,0,0,0);}
#form1_5{	z-index: 2;	padding: 0px;	position: absolute;	left: 660px;	top: 921px;	width: 162px;	height: 37px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form2_5{	z-index: 2;	padding: 0px;	position: absolute;	left: 825px;	top: 921px;	width: 51px;	height: 37px;	color: rgb(0,0,0);	text-align: right;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form3_5{	z-index: 2;	padding: 0px;	position: absolute;	left: 89px;	top: 937px;	width: 31px;	height: 23px;	color: rgb(0,0,0);	text-align: center;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form4_5{	z-index: 2;	padding: 0px;	position: absolute;	left: 132px;	top: 937px;	width: 74px;	height: 23px;	color: rgb(0,0,0);	text-align: center;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form5_5{	z-index: 2;	padding: 0px;	position: absolute;	left: 352px;	top: 979px;	width: 381px;	height: 17px;	color: rgb(0,0,0);	text-align: left;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form6_5{	z-index: 2;	border-style: none;	padding: 0px;	position: absolute;	left: 77px;	top: 993px;	width: 19px;	height: 19px;	color: rgb(0,0,0);	text-align: left;	background: transparent;	font: normal 13px Wingdings, 'Zapf Dingbats';}
#form7_5{	z-index: 2;	border-style: none;	padding: 0px;	position: absolute;	left: 209px;	top: 996px;	width: 19px;	height: 19px;	color: rgb(0,0,0);	text-align: left;	background: transparent;	font: normal 13px Wingdings, 'Zapf Dingbats';}
#form8_5{	z-index: 2;	padding: 0px;	position: absolute;	left: 352px;	top: 1016px;	width: 527px;	height: 17px;	color: rgb(0,0,0);	text-align: left;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form9_5{	z-index: 2;	border-style: none;	padding: 0px;	position: absolute;	left: 77px;	top: 1042px;	width: 19px;	height: 19px;	color: rgb(0,0,0);	text-align: left;	background: transparent;	font: normal 13px Wingdings, 'Zapf Dingbats';}
#form10_5{	z-index: 2;	border-style: none;	padding: 0px;	position: absolute;	left: 209px;	top: 1042px;	width: 19px;	height: 19px;	color: rgb(0,0,0);	text-align: left;	background: transparent;	font: normal 13px Wingdings, 'Zapf Dingbats';}
#form11_5{	z-index: 2;	padding: 0px;	position: absolute;	left: 352px;	top: 1053px;	width: 527px;	height: 17px;	color: rgb(0,0,0);	text-align: left;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form7_5 { z-index:3; }
#form10_5 { z-index:2; }
#form6_5 { z-index:3; }
#form9_5 { z-index:2; }

</style>
<!-- End inline CSS -->

<!-- Begin embedded font definitions -->
<style id="fonts5" type="text/css" >

@font-face {
	font-family: AdobePiStd_c_5;
	src: url(data:application/font-woff;charset=utf-8;base64,d09GRk9UVE8AAAQAAAkAAAAABmgAAQABAAAAAAAAAAAAAAAAAAAAAAAAAABDRkYgAAAA4AAAAR0AAAFYyD/Ork9TLzIAAAIAAAAAKgAAAGAJsQePY21hcAAAAiwAAAA/AAABcrSwmgFoZWFkAAACbAAAADEAAAA2+hO3WmhoZWEAAAKgAAAAHgAAACQDIwK2aG10eAAAAsAAAAAIAAAACAN8AABtYXhwAAACyAAAAAYAAAAGAAJQAG5hbWUAAALQAAABHAAAAhNQxEemcG9zdAAAA+wAAAATAAAAIP+GADZ4nGNkYGFiYGRk5HdMyU9KDcgMLkmJT443BQnJ/ZBl/CHB0v07Qoblz89zrN/3838/JDjj+32hH3I8ogxsjIxsfOduP30O1umZkppXkllS6ZxfUFmUmZ5RomBkYGCkAJZTCK4sLknNLVbwzEvOLyrIL0osSU3RU3DMyVEAKy1WKEotTi0qAwuCNWQWK6RmlmSkFikkAuXSM4Hai1JTFEqKElNScxOLshXyQTJI3DQ8Nilk5ikAzVIIzcsE8YJLgILFCol5KfpAU/LBtiTnl+aVFGWmFuvpuwWHVBakKlgopKSmIcIk3YCBgYGxh4GJkZFJgu+XwIIyxs0/9zH/fCb2R/Nn4B/Nv4GsfEVLfmYu+d23hG0v115uAMTHfScAAAB4nGNgZtzHOIGBlYGBIQ0IGdBpRjhgwAYcQASzwn8LEMlwAlMBAHFIBkwAAHicY2BgYGaAYBkGRgYQyAHyQCwXBhYGDSDNBqQZGZhUN/3/+/8/AwOEvuUPVQUCxKpjYGRjQHBGKAAAF2YW8AB4nGNgZGBgAOKNG9bviue3+crAwPwCKMJwmnEXA4L+b8Pyh9kKyGBnYAKJAgBNMgrkAAAAeJxjYGRgYFb4bwEkaxgY/v9nYGAAiqAAJgBgEwPcAAAAAAAAA3wAAAAAUAAAAgAAeJx9kM1qwkAUhc9oIrSFLtuN1HmBBrW4KwVBxIpKUHHZEPOjA2ZGYqT4Ut31Qbruy/QEh0I2CczwzXfuvUwGwD2+IHD9OlxXFvQdyw24eLbcxBP6lh3W+JZd3OHDcotesVI4Nzy94dOyQBvflhu4xY/lJl7xa9lBWzxadvEgXiy36N8XRkbmeMnVbl9IpVOTZ2GhjJapOevYG8Zmm/hqVcRBFAyWJgv11E/i8CD90bg/Wc9nslpSPW2S/FQO63ndaoAFDCQi7kdckPPndtijoFPQSOlzZAhpFFnTl+5MiuFhyN1gi4SPpbBiVYyA0wIMsGRSdmpMmSZMQhzY72OEMR96gjXmmNHUTanLNrQ5Tv836/FG3bqOPwH5XMd4nGNgZgCD/80MZgxYAAAomAG8AA==) format("woff"),
url(data:font/truetype;charset=utf-8;base64,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) format("otf");
}

@font-face {
	font-family: HelveticaNeueLTStd-BdOu_f_5;
	src: url(data:application/font-woff;charset=utf-8;base64,d09GRk9UVE8AAAXEAAkAAAAACJgAAQABAAAAAAAAAAAAAAAAAAAAAAAAAABDRkYgAAAA4AAAArMAAALWsFS2VE9TLzIAAAOUAAAAKgAAAGAJsQd2Y21hcAAAA8AAAABFAAABggKGBMNoZWFkAAAECAAAADMAAAA2+cu3tmhoZWEAAAQ8AAAAIAAAACQEgf+/aG10eAAABFwAAAAKAAAACgJ4AABtYXhwAAAEaAAAAAYAAAAGAANQAG5hbWUAAARwAAABPQAAAq+S3NmjcG9zdAAABbAAAAATAAAAIP+GADZ4nD2QX0hTcRTHd9VtWVPTNVkm80e0iX+yTQwba5Ip/gkp/ANJD7O73d+267Z75d7fzK2HKHoL0RSTmpa7UgglBUkPPfUQkfVSkNEfZPmgEhIiEmfrZ9DdS+fhnMP38Dnny2E0eTkahmHKO3B4GBPex57HUdzV10u442e5C9EB/8DJ7LwifYRJH8qjVVQp13b+IVpYKYJvxe8z1SXpcoNJk8MwG7st4lBM4gNBghxOp6MW1dvt9aiZE70Y9cZkgiMy6hR8ojQkSizBXB1qDodRTxaQUQ+WsTScFf87QbyMWEQklsMRVgoh0a/OeA6HvVgKYAm1SlFfKMLKviAvYAE1t9ciPOILR2V+GIdjKMz7sCBjDpGgJEYDQdTFCyKJDWG18UqsFEPtEW9HLWIFDkXYGFJdSjjAqz4lFeIF5MMSYdU6GJV4meN9hBcFue5EW29fdkkD4rBfo0axxqjJVZ+oydGMMm2FGcP15Foy7VET81IBRoGRbM4FD+yYwDq/uj5qWZ9vpFZqlRsdDjkF1gpSSt1Lzq2tpVVwg9u7WlPjdVK3hTKlQLZBCzawbVMtJZRUqsVGbZWqSCwqFt+hJnCBawdMEIe4FUzURV1WaqJxi2rlVvJXEhaTYExuJkuWlJvKrgKcAjrlimKkc9/T3aZp/e93UATtFiN9BbbUaZrvDHcfO1dBta09ARK5IR42/p2Dzaq9a7rx1EIKDn6F3I/mDy+ePntb9vni8y6rv6VJZeeoMWqCat36wpsfy4/Z/ktCqD9koaWntCpOC5ou26m+LL0IR+kX3dS9+4lHM5C/Ys7e1H96srxRBubqNWqnZ+oQtVsKryYyngT13oWGKR08GN+a3Hs9qY/PZDwzdHB6Hzyc2J7Y+zmdn9yvHJgd25y6nY2EwTA7DuY7Y9OGgn/8x0EsAHicY2BmXMo4gYGVgYEhDQgZ0GlGOGDABhxABLPCfwsQyXACUwEAaDMGMwAAeJxjYGBgZoBgGQZGBhCoAfJALB8GFgYDIM0BhExA2oDB6P/f//8RrP8X/1+AqoUAUtUzMLIxIHOJAoxgw4cPAAC7vBo9AAAAeJxjYGRgYADijRvW74rnt/nKwMD8AijCcJpxFwOM/p/97xOrJ/MDIJedgQkkCgBu7gz3AHicY2BkYGBW+G/BwMBU8T/7Hw/jFwagCApgAgB/RQVCAAAAAAJ4AAAAAAAAAABQAAADAAB4nJ2PzWrCQBSFz/gHbaHLbrpwtqUoKuiiixZERERj0OA2hGSiKXEiMRFcddV936PQXZ+iT9K36AkZunThwL18c+6ZM1wAt/iCQHmarJIF7nkruYI6ngxX8YgXwzV6Xg3XcYN3ww3qH3SK2hVvz/g0LDDAr+EKrkXTcBVr8WC4hoF4M1zHnfg23KD+YyXST/anNNpsMxnpMEl3XhYlWoZJroP2RMVHlUW+Z6lczZxVFrSGwSJ3Q7e/THaentoq8GJpj8a9iTOfyTP+M6O1Sg/Fn91254wLFhJI+Ox7nJAiwgZbZNQiaITUU+zgUYnImnqh5aQAbUygEOPIXsx9+ixyzprBwYpqgBaG7AuqLt+66GPJhCJTYwqb3oAcM9nGCGP0mOpgzgR5Yf5lr9acpzj879nlfp3Lsv4AateElwAAAHicY2BmAIP/zQxmDFgAACiYAbwA) format("woff"),
url(data:font/truetype;charset=utf-8;base64,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) format("otf");
}

@font-face {
	font-family: HelveticaNeueLTStd-Bd_1fn_5;
	src: url(data:application/font-woff;charset=utf-8;base64,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) format("woff"),
url(data:font/truetype;charset=utf-8;base64,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) format("otf");
}

@font-face {
	font-family: HelveticaNeueLTStd-BlkCn_1fr_5;
	src: url(data:application/font-woff;charset=utf-8;base64,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) format("woff"),
url(data:font/truetype;charset=utf-8;base64,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) format("otf");
}

@font-face {
	font-family: HelveticaNeueLTStd-Blk_e_5;
	src: url(data:application/font-woff;charset=utf-8;base64,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) format("woff"),
url(data:font/truetype;charset=utf-8;base64,T1RUTwAJAIAAAwAQQ0ZGIFB3mJYAAAYQAAAEEk9TLzIJsQh5AAAAnAAAAGBjbWFwCRUNzAAAAPwAAAHCaGVhZPi/t7UAAALAAAAANmhoZWEEcgG4AAAC+AAAACRobXR4GpAAAAAAAxwAAAAobWF4cAAKUAAAAANEAAAABm5hbWW5/66sAAADTAAAAqNwb3N0/4YANgAABfAAAAAgAAMCqAGQAAUAAABmAGYAAAAAAGYAZgAAAAAAZgBmAAABAQEBAQEBAQEBAAAAAAAAAAAAAAAAAAAAAAAAAAAAQAAAAAADIP84AAADIADIAAAAAAAAAAAAAAAAAAAAAAAAAAAAAwAAAAMAAAAcAAEAAAAAALwAAwABAAAAbAAEAFAAAAAQABAAAwAAADMAQQBDAEkATwBV//3//wAAADIAQQBDAEkATgBU//3////P/8L/wf+8/7j/tAADAAEAAAAAAAAAAAAAAAAAAAAAAAQAUAAAABAAEAADAAAAMwBBAEMASQBPAFX//f//AAAAMgBBAEMASQBOAFT//f///8//wv/B/7z/uP+0AAMAAQAAAAAAAAAAAAAAAAAAAAAAAAEGAAABAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAECAAAAAAAAAAAAAAAAAAMABAAAAAAABQAAAAAGBwAAAAAICQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAQAAAAEAAH28+sRfDzz1AAAD6AAAAADLAboAAAAAAMsBugD/W/8YBE0DuQAAAAcAAgAAAAAAAAABAAADIP84AAADHP9b/1kB9AABAAAAAAAAAAAAAAAAAAAACgKcAAACnAAAApwAAALSAAAC9wAAAU0AAAL3AAADHAAAApwAAAL3AAAAAFAAAAoAAAAAAA4ArgABAAAAAAAAAB8AAAABAAAAAAABABoAHwABAAAAAAACAAUAOQABAAAAAAADACoAPgABAAAAAAAEABoAaAABAAAAAAAFAAsAggABAAAAAAAGABoAjQADAAEECQAAAD4ApwADAAEECQABADQA5QADAAEECQACAAoBGQADAAEECQADAFQBIwADAAEECQAEADQBdwADAAEECQAFABYBqwADAAEECQAGADQBwU5vIGNvcHlyaWdodCBpbmZvcm1hdGlvbiBmb3VuZC5IZWx2ZXRpY2FOZXVlTFRTdGQtQmxrX2VfNVJvbWFuSlBlZGFsIFBERjJIVE1MIEhlbHZldGljYU5ldWVMVFN0ZC1CbGtfZV81SGVsdmV0aWNhTmV1ZUxUU3RkLUJsa19lXzVWZXJzaW9uIDEuMEhlbHZldGljYU5ldWVMVFN0ZC1CbGtfZV81AE4AbwAgAGMAbwBwAHkAcgBpAGcAaAB0ACAAaQBuAGYAbwByAG0AYQB0AGkAbwBuACAAZgBvAHUAbgBkAC4ASABlAGwAdgBlAHQAaQBjAGEATgBlAHUAZQBMAFQAUwB0AGQALQBCAGwAawBfAGUAXwA1AFIAbwBtAGEAbgBKAFAAZQBkAGEAbAAgAFAARABGADIASABUAE0ATAAgAEgAZQBsAHYAZQB0AGkAYwBhAE4AZQB1AGUATABUAFMAdABkAC0AQgBsAGsAXwBlAF8ANQBIAGUAbAB2AGUAdABpAGMAYQBOAGUAdQBlAEwAVABTAHQAZAAtAEIAbABrAF8AZQBfADUAVgBlAHIAcwBpAG8AbgAgADEALgAwAEgAZQBsAHYAZQB0AGkAYwBhAE4AZQB1AGUATABUAFMAdABkAC0AQgBsAGsAXwBlAF8ANQAAAwAAAAAAAP+DADYAAAAAAAAAAAAAAAAAAAAAAAAAAAEABAIAAQEBG0hlbHZldGljYU5ldWVMVFN0ZC1CbGtfZV81AAEBAR74GwH4EwT7Oft8+uH6TQX33w/38hG/+nIS+BwMFQACAQHy/0NvcHlyaWdodCAxOTg4LCAxOTkwLCAxOTkzLCAyMDAyIEFkb2JlIFN5c3RlbXMgSW5jb3Jwb3JhdGVkLiBBbGwgUmlnaHRzIFJlc2VydmVkLiBIZWx2ZXRpY2EgaXMgYSB0cmFkZW1hcmsgb2YgSGVpZGVsYmVyZ2VyIERydWNrbWFzY2hpbmVuIEFHLCBleGNsdXNpdmVseSBsaWNlbnNlZCB0aHJvdWdoIExpbm90eXBlIExpYnJhcnkgR21iSCwgYW5kIG1heSBiZSByZWdpc3RlcmVkIGluIGNlcnRhaW4ganVyaXNkaWN0aW9ucy4vRlNUeXBlIDQgZGVmAAABABMBACIAACQAACoAAC8BADUBAAoCAAEAAgBYAOsBLgF7AZEBwAIPAi8CaA4gi/c++Az3MgG891D3UfdeA/eB+CcV4ImmxdsburB1TFhRb2d1HzJVJ1ZROmlcd1GPSAj47/c++8+MBvcX2/dCw/dGGvco+wfS+z37T/sL+wL7U5YeDiCD9zL3KvcT9xD3LRKt91K/94kt92T7YvdME/T3hvhkFRPyxYm3qMEbtL16X1VWgmEfE/hwe46MfB/7HAcT9I2amY6oG7m6gE5SZ3ZSaG6TongfeJ2Cp4ywCPtSBleGjPtw980b93jL9xrgHxP49y/7BouTGo0HE/KO54v3JhrGSPcM+149Q3hkVh5WY2pPijkIDlaL95P7Lfct+F93EoP5dhNw97n3kxXQ93AFjQbL+3AFE7D8SPuTFfdxBhNwq/EF93cGE7CpJQX3eAb7mPleBftrBg57evdG+Bz3RgGv93AD+WX4VBV490f7APL7WIwI+3D7Ivsp+3X7Z/cX+zf3e/dl9wn3LfckH/tsBkh+bldBGyRq7+vrrO/y5p88cY8fDvxOoHb5XncBxPdwA8QW93D5XvtwBg57oHb5XncBxfdk93f3ZAPFFvdk+BqNBvdv/BoF92r5Xvtk/BKJBvtk+BIF+3UGDqB690b4HPdGAa/3cPew93ADr/f5Fftu9yX7MPdt9233Jfcw9273bvsl9zD7bftt+yX7MPtuHvdwFvcz4bDDw+Fm+zP7MzVmU1M1sPczHg4goHb4p/dLAfd093AD93QW93D4p/dc90v9APtL91wGDnt690b4vXcBwfdw92f3cAP5VfleFftw/BkGQoswIyCL5tQe+Bn7cPxKB/ta9wAs9273bvbq91oeDnqc+V6c+2iY9ziTBvemk/xjmAd6nPlenPtqlwj3pZLvkvzplwn3JAr3WguMDA75MBT5mxU=) format("otf");
}

@font-face {
	font-family: HelveticaNeueLTStd-It_1fo_5;
	src: url(data:application/font-woff;charset=utf-8;base64,d09GRk9UVE8AAA+QAAkAAAAAFLQAAQABAAAAAAAAAAAAAAAAAAAAAAAAAABDRkYgAAAA4AAAC5QAAA1Gh1KGEU9TLzIAAAx0AAAAKgAAAGAJsQfPY21hcAAADKAAAADgAAACUj0nHnVoZWFkAAANgAAAADMAAAA2+MO3y2hoZWEAAA20AAAAHgAAACQEuAGgaG10eAAADdQAAABkAAAA5nG7AABtYXhwAAAOOAAAAAYAAAAGADpQAG5hbWUAAA5AAAABPAAAAq9qLLQ5cG9zdAAAD3wAAAATAAAAIP+GADZ4nJ1We1iMaRt/3xnPU0J2e71hXt+845RVSYUiazeh1OawhIQY06Skg2kq0X45fEqSQyEVRW0Oi08b0sr5FEllMYthzaKk5fKx7P2OZ/ba75lpr/3v++ebmeudeea5799zn57ffbNMFxnDsmy/ydplqVp9rEY9VZuiDQ2bqY8aFqxf6BWduHCUdX+AJLBSny6Z3WXEjyz92PbxawTPe0o9Pz3Qr4erk9SvO8/IWPbdnxMSk9J1sUti9CqvMaNHu9PnGE/bc4S7ytvT01s1PipxsVY1Mz1Zr41PVgUnaBJ1SYk6tV4b5aEav2yZaoZVOVk1Q5us1aVa//zbMFVsskqt0uvUUdp4tS5OlRhN92KjtMsWa3VLtDrVRF2KJi5enayJiU3QJqjGB7mrtCs0y1KSY1O1y9JVy2I12oRkbZRKH6NLTFkSowqNTUjUpydp6Y/FOrUuXRUUv3iyu0qdEKWKV6erqJU67ZJYaqeOKsUmqDRanV5Nv5em6GKTo2I1+tjEhGSP4YEzw6wgI1VR2miGYembsZczPboyCoZRMcwAhhnEMC4sM5RlPOTMSIbxkTF+DBPQh/GjkWdkDGI8mOGMJ+PFzGYSmPVMKVPG3GAamJusHRvFPmSN7CP2sexT2ReyZFmubJPspqxRbi//p/y6/Df5e/mHLtldWtEwtAH9gl3xd9hsp7JbYrfXrtbexz7LvrGra1e3rild7zt85qB3KHPocPi1m68jaaAf6Q3I2d/BTw5K6Q1/GWdGZi6YvW7NvD6gKswFRSV0sSdy7EhfpCGXiq6iosXO/1OOzIO1RrYSrskrYS0PNbjEiEgN/ku5GASqDHJcAXJkEy/YkmpencamS0ievpK/i+GMeTUKoOfF7U2VSppZ+ARuyKVJ5rl8MPZTD17sI3wThBovbS1uEImd5RhqtZpGZcHPwGZL2+RSb+kan4cnk3uIrMAwiaznTfgY+KGXuNiAhuHXUgyagC2jLQtX+iK4iR3jMg3w2ADDDWx+K1xolUtl5ik8IZjILA7oJ1xTcb7yrNB2do7n4Km+RD5KXftY9MKk15PxwN+tL627qLx4rvLuPQX0mNBOuIXzM5NilTl5lyEMwalO8IkGuGtw2tKqaYXvW7lXsB+aeJ/Iy49MZ1+/flE7Y8SwWX4uIveelJPBPHHMeTAdHATo32yAHhfEKtM+YNsVMCDoV+Kq5F4RV1fiQAYRu0ce4HC1ce+ZI2JeDhoYN5+oiCBw7yctrW4SrbkqzzUC/aQZ2Xxzb3m+s7Qe7zEiiws+D7lIsrNmxYJxHaQhqb9tsRo7fkOjaOzUkf6kOh24GYwIfsa7aQp/xqetwt2sC8tS7AiKTun6NHpCpE26hUpLDjiQGFEHBldzJHLHX5F6ZHHAjVCP3Gi2H+9NNUdSDcixafwl5EjRcqHn4FTpCXC5aU75Zi0Xnu/8AnMx0EN6gvIwbLM8QW8xuFH54ZjbRbpZnqEcTAqkZ2gw1a+nxtQaodjISuc6bNA3oBZBDIboBuj3HJz9m8g/RHIUG8fysAA3XEwY4TNz2mCRxGHH+pVGyWR0Ku7I6ICTHWEd3H3urvRRyuVhxFbSs4X0FwhH+gYS5QDDHJNefLUcce23V1xZHqBw81rsTezHngR+m9IdkwmZ0ONL8BeAh6G3YQj0Gn3Cu0J0q0Tc3ZA94QdaFKaOw7dft8QQtEFJPV5pNItp7JU2uXmZOZJ3x14Wf0QUibHexFMgytAWUB4WX0rTaXy8LaMRmbe4jXQBrQA9gK0Dhzqx8EDhxcJL9jTV7ROsUXV6KElckjmIgrlgroq8+IOlIQows8gVv/0jEv1uvSmBmQZJMLBrTHDNJDeAwN+6WHp9u/JGQdPWqn32eThzXtaCxCj7BfERKcHCvMiKOrEBUvmmHTcrG4Xaa5kzAzVZXutEgteQIWuIq6L/Hc0vT8/urzumpGUYmfVt4mmhuGJr/i5xVwPasG519jrhm9UFFRU7Dm7ZKx6B/mjbgR1VBxXvvfcPITLX2cRupdJxa6ZBnSpFGGBKmpMUYeJqpQi4xruEkAGkp++MukcguwHuMPRhdfAYJbfCspBc43/Cpb/SouBqw3c2z+gQYMJr8IJR0CekjcZtRkKEVszJuwRFyAc7hnf6u9cEDSa5lAMfeOieHXCZdBXIFBfiQUYT8Y4v9IduT2+B3SHRB4cmz1oUILgvbTYCug3O0PtWjTZUtFoZ2kCRrFbupka+hfk84NugAuHJDzO+IEwAGUp4D82FJ0ppk7ST98Vh5CANf0vauH2hAgnuT/yJF3H6kVrZcq606ZxIzV+RPh4ZbSbCFwZwMbA7TNBskoMMrvPGby/eeiO8PBIQsF68789vLtpauV8BLpN/Ju40MJ8QgUR41REH+BLQy3rA+5U++Kvk8JjxQmBIrbF4U3FesehIaimFTjWAs2FdmlM5vOXay51NuEOait7gIgP6DDeUZTWZhF1FORt2idz9oju0sLfpk/OSBdIve8iAJHEEzvBHzygxkGgD9DZInCEzzSnFpDZxzz9ANN9xE4ZCt+c1s/wGTqOc1MtH3XhPSe/ODKjnx+JV7iiHOvm8MWP8cX+BfO5CB4ZhpOctT+jVeK3iUpWVuAYlLR9A+ghce8i0kpYsGn1it/l15HsBZI9OvDslFh/bdb7wgr2tFdgKhJVGmORZ1Il6qN55ouTEocq+Rw+fqTwtnD2uj0hftyh7hRhMLiETboA6tP34tup9irb5J10nTor7ehFl5etQaa0Ji4ziFaUB+o3NgkwbHjCStVyAg7n8KJwykDZRKkYiDOZeNjnSHd7JSXcSxmftKd1YKjRXV90sFsFZ+ki1CLIcRwEZa5KjhdWrN29eLcIz852/YVSUms6kQlYaxKexWVKJ7bxqCH3b9h9ygBIl6QUPIQVmWtsh2UVScvKeS6ORb6eZVrL820YrWVLzYbctHDQV5gUmrsW6dRUqdp4r+O7Yv/sePXT28Gnhh0rdosx/Ra3ViFNIHQ3HFSjbfmrnyQOH+lYdvHC0Tqg9Gq/JyNZlrxInkEd0vxEaUP7BglOHFE8mHg4IDNKGaZRNGXMrQ4SJIdGzFtLrhLiq0vvoc/xXLujhNBWdh/9fuaAEVfIAjaG11XlBd5vgqUn+FtT8780wAJzba0L8BgeRgeQTj4grJqXPRp58+tgT+kHwe/CGcaD84ieiJMGEIZ5kHCURMikVplKkhlCDkzTPxN2X5sFtnuBJ1sbou+DKfWDu0mrl24/P9lVaNlkK+Sf4EhyiLBJY9iClQYDgD+BPWcRp4i+kT2D4isnhIrWxfc89NJbSJimgXn/VSr3OkrhOr89AekF14ZnyI333nzj23elC+61lO3L3CgXbczcWiGVtKG/Nmpw1wsipcyZqrEhV39KBh0KpbO46rTXpTTDdNNNkazahEstDj89q3NzcZruNa45pSVJy7c2JzWlzFdND08ImhpTf30IvOOmz8cUiOhzQga0W7B4FHgs6IHJ3gw4EldYpzl8tOn/tfPz0bKUjqVxvkLoa2NNtcthm9uZ9cBwZhkbiVf7oKQ6ic9GGVTmZGYrgC+kNZWV5W8qUxQ9Q1qpV2SuF5bqC/YV5OzYVijfhCnqHSwxokG2GUVvvi1OxiauSdktFFHEaqUaj0gPGDBPmasrP7Cmo2VIq3oJLtDxDacGt1ayPSlF4nla/+vH24as1SkoDSavGocfU/dynwTask1I4lyStpWDDrb1KbwmgZLlQCkBe+J6lCLXRMv8y94NPquQCdnQiOGGdCMybO8V3kXDLcCquk4bToYJMtS3i6MILX6e6rdaxYYrkQnNbaXGxDYgqEt0cmwoJtqNDpUbaZPIolgcm8TblaVTZE7dZiuaMQkvTUvRaISN1W8E/RW5FRiDiateVlGeVCU+/v9R0UnRcudscuZssLcRQmf8m3/Ky0M7gYOomXeglmfj/AoIIKCB4nGNgZvzHOIGBlYGBIQ0IGdBpRjhgwAYcQASzwn8LEMlwAlMBAIiIBowAAHicY2BgYGaAYBkGRiDJwOgD5IFYWxhYGGYAaSUGBSCLCUhqMZgyWDLYMzgyODO4MXgyBDAEM4QzRDJUKkj+//v/P1CtAoMGgw5cjSuDB4MvUE0oUE0iRM3/h/9v/7/1//r/S/8v/r/w//z/c/9P/z/5/8T/4/8P3H8JtZkQGKzuYmBkYwBaQ0ANlGZmYWVgY+fg5OLm4eXjBwoIgIUFGYQYhBlERBnExIE8CUkpaVDMyMrJA/0AAYpKyiqqauoamlraOrp6+gaGRsYmpmbmFpbEuJBMwAQiOIlSCgAbMV+ueJxjYGRgYADijRvW74rnt/nKwMD8AijCcJpxFwOM/h/1X4sliHkvkMvOwAQSBQBhCwwEAHicY2BkYGBW+G8BJNP+R/07wWTNABRBAZYAfhIFWwAAeJxj0mFgYBSDYmYoToDyW6G0LwMDkw4BPBtKJwOxHRBfgpjFnAZhM30H4g4ovgRVB9PLDsSBQCyJoBk1oOYA5RnuQTDjQwjNHALVZwdVHwhxI0ie0RoiB2KD7ATrYQAAx9wVGQAAUAAAOgAAeJydj71qAkEUhc/4B0kgZZoUbhuC4gpapEgaERVdFl1sl2V/dMI6I+uuYJUqve8RSJenyJPkLXI2DiktHLgz3z33zBkGwC0+IXBaTdaJBe7ZnbiCOp4MV/GIF8M1el4N13GDd8MN6kc6Re2K3TM+DAv08WO4gmvRNFzFUjwYrqEv3gzXcSe+DDeofzvaCvX2kMnVOrekSnS2CXKplZXoQkXtUZzu41yGgRMX8dRb5FFrnPt2ov3eXG8CNXHjKEgtdzDsjrzZ1DrjPzNaxtmufNNud8644EDDQsh9iwMySKywRk5NQiGhnmGDgIokK+qlVpAitDFCjBR77uU8pM8hF6wpPCyoRmhhzNOH/XfTRw9znmWmwgQuvRE5ZbKLAYboMtXDjAnWhfmX3VpynmH3/0+b/+tclvULA6+EL3icY2BmAIP/zQxmDFgAACiYAbwA) format("woff"),
url(data:font/truetype;charset=utf-8;base64,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) format("otf");
}

@font-face {
	font-family: HelveticaNeueLTStd-Roman_1fp_5;
	src: url(data:application/font-woff;charset=utf-8;base64,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) format("woff"),
url(data:font/truetype;charset=utf-8;base64,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) format("otf");
}

@font-face {
	font-family: ITCFranklinGothicStd-Demi_1fq_5;
	src: url(data:application/font-woff;charset=utf-8;base64,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) format("woff"),
url(data:font/truetype;charset=utf-8;base64,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) format("otf");
}

</style>
<!-- End embedded font definitions -->

<!-- Begin page background -->
<div id="pg5Overlay" style="width:100%; height:100%; position:absolute; z-index:1; background-color:rgba(0,0,0,0); -webkit-user-select: none;"></div>
<div id="pg5" style="-webkit-user-select: none;"><svg id="pdf5" width="934" height="1209" viewBox="0 0 934 1209" style="width:934px; height:1209px; -moz-transform:scale(1); z-index: 0; isolation: isolate;" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
<defs>
<style type="text/css"><![CDATA[
.g0_5{
fill: none;
stroke: #000;
stroke-width: 3.055;
stroke-miterlimit: 10;
}
.g1_5{
fill: #000;
}
.g2_5{
fill: none;
stroke: #000;
stroke-width: 1.527;
stroke-miterlimit: 10;
stroke-dasharray: 7,4;
}
.g3_5{
fill: none;
stroke: #000;
stroke-width: 1.527;
stroke-miterlimit: 10;
}
.g4_5{
fill: none;
stroke: #000;
stroke-width: 0.763;
stroke-miterlimit: 10;
}
.g5_5{
fill: #FFF;
}
.g6_5{
fill: none;
stroke: #000;
stroke-width: 0.763;
stroke-linecap: square;
stroke-miterlimit: 10;
}
]]></style>
</defs>
<path d="M54.6,55H880.4M54.6,119.2H880.4" class="g0_5"/>
<path d="M55,585.1H91.7V548.5H55v36.6Z" class="g1_5"/>
<path d="M54.6,834.2H880.4" class="g2_5"/>
<path d="M54.6,907.5H187.8M759,852.1v28.3M187,852.1v28.3m-.8,27.1H759.8M759,879.6v28.7M187,879.6v28.7M759,870.4v37.9" class="g3_5"/>
<path d="M328.5,907.5H660.4M330,906v39.7m-1.5,16.8H660.4M330,942.6V964M658.5,907.5H825.4m-166.9,55H825.4M660,906v58M824.6,907.5h56.9m-56.9,55h56.9M880,906v58" class="g0_5"/>
<path d="M825,906v58M54.6,962.5H66.4M54.6,980.8H66.4m-.8,-18.3H330.4M65.6,980.8H330.4M54.6,1026.7H187.4" class="g4_5"/>
<path d="M95.3,1003.7c0,-5,-4.1,-9.1,-9.1,-9.1c-5.1,0,-9.2,4.1,-9.2,9.1c0,5.1,4.1,9.2,9.2,9.2c5,0,9.1,-4.1,9.1,-9.2Z" class="g5_5"/>
<path d="M95.3,1003.7c0,-5,-4.1,-9.1,-9.1,-9.1c-5.1,0,-9.2,4.1,-9.2,9.1c0,5.1,4.1,9.2,9.2,9.2c5,0,9.1,-4.1,9.1,-9.2" class="g6_5"/>
<path d="M54.6,1072.5H187.4" class="g4_5"/>
<path d="M95.3,1052.6c0,-5,-4.1,-9.1,-9.1,-9.1c-5.1,0,-9.2,4.1,-9.2,9.1c0,5.1,4.1,9.2,9.2,9.2c5,0,9.1,-4.1,9.1,-9.2Z" class="g5_5"/>
<path d="M95.3,1052.6c0,-5,-4.1,-9.1,-9.1,-9.1c-5.1,0,-9.2,4.1,-9.2,9.1c0,5.1,4.1,9.2,9.2,9.2c5,0,9.1,-4.1,9.1,-9.2" class="g6_5"/>
<path d="M186.6,1026.7H330.4M187,980.4V1027" class="g4_5"/>
<path d="M227.3,1006.8c0,-5.1,-4.1,-9.2,-9.1,-9.2c-5.1,0,-9.2,4.1,-9.2,9.2c0,5.1,4.1,9.2,9.2,9.2c5,0,9.1,-4.1,9.1,-9.2Z" class="g5_5"/>
<path d="M227.3,1006.8c0,-5.1,-4.1,-9.2,-9.1,-9.2c-5.1,0,-9.2,4.1,-9.2,9.2c0,5.1,4.1,9.2,9.2,9.2c5,0,9.1,-4.1,9.1,-9.2" class="g6_5"/>
<path d="M186.6,1072.5H330.4M187,1026.3v46.6" class="g4_5"/>
<path d="M227.3,1052.6c0,-5,-4.1,-9.1,-9.1,-9.1c-5.1,0,-9.2,4.1,-9.2,9.1c0,5.1,4.1,9.2,9.2,9.2c5,0,9.1,-4.1,9.1,-9.2Z" class="g5_5"/>
<path d="M227.3,1052.6c0,-5,-4.1,-9.1,-9.1,-9.1c-5.1,0,-9.2,4.1,-9.2,9.1c0,5.1,4.1,9.2,9.2,9.2c5,0,9.1,-4.1,9.1,-9.2" class="g6_5"/>
<path d="M329.6,1072.5h22.8M330,962.1v110.8m21.6,-73.7H880.4m-528.8,36.6H880.4m-528.8,36.7H880.4" class="g4_5"/>
</svg></div>
<!-- End page background -->


<!-- Begin text definitions (Positioned/styled in CSS) -->
<div class="text-container"><span id="t1_5" class="t s0_5">Form 941-V, </span>
<span id="t2_5" class="t s0_5">Payment Voucher </span>
<span id="t3_5" class="t s1_5">Purpose of Form </span>
<span id="t4_5" class="t s2_5">Complete Form 941-V if you’re making a payment with </span>
<span id="t5_5" class="t s2_5">Form 941. We will use the completed voucher to credit </span>
<span id="t6_5" class="t s2_5">your payment more promptly and accurately, and to </span>
<span id="t7_5" class="t s2_5">improve our service to you. </span>
<span id="t8_5" class="t s1_5">Making Payments With Form 941 </span>
<span id="t9_5" class="t s2_5">To avoid a penalty, make your payment with Form 941 </span>
<span id="ta_5" class="t s3_5">only if</span><span id="tb_5" class="t s2_5">: </span>
<span id="tc_5" class="t s2_5">• Your total taxes after adjustments and nonrefundable </span>
<span id="td_5" class="t s2_5">credits (Form 941, line 12) for either the current quarter or </span>
<span id="te_5" class="t s2_5">the preceding quarter are less than $2,500, you didn’t </span>
<span id="tf_5" class="t s2_5">incur a $100,000 next-day deposit obligation during the </span>
<span id="tg_5" class="t s2_5">current quarter, and you’re paying in full with a timely filed </span>
<span id="th_5" class="t s2_5">return; or </span>
<span id="ti_5" class="t s2_5">• You’re a monthly schedule depositor making a </span>
<span id="tj_5" class="t s2_5">payment in accordance with the Accuracy of Deposits </span>
<span id="tk_5" class="t s2_5">Rule. See section 11 of Pub. 15 for details. In this case, </span>
<span id="tl_5" class="t s2_5">the amount of your payment may be $2,500 or more. </span>
<span id="tm_5" class="t s2_5">Otherwise, you must make deposits by electronic funds </span>
<span id="tn_5" class="t s2_5">transfer. See section 11 of Pub. 15 for deposit </span>
<span id="to_5" class="t s2_5">instructions. Don’t use Form 941-V to make federal tax </span>
<span id="tp_5" class="t s2_5">deposits. </span>
<span id="tq_5" class="t v0_5 s4_5">▲ </span>
<span id="tr_5" class="t s5_5">! </span>
<span id="ts_5" class="t s6_5">CAUTION </span>
<span id="tt_5" class="t s7_5">Use Form 941-V when making any payment </span><span id="tu_5" class="t s7_5">with </span>
<span id="tv_5" class="t s7_5">Form 941. However, if you pay an amount with </span>
<span id="tw_5" class="t s7_5">Form 941 that should’ve been deposited, you </span>
<span id="tx_5" class="t s7_5">may </span><span id="ty_5" class="t s7_5">be subject to a penalty. See </span><span id="tz_5" class="t s2_5">Deposit Penalties </span><span id="t10_5" class="t s7_5">in </span>
<span id="t11_5" class="t s7_5">section 11 of Pub. 15. </span>
<span id="t12_5" class="t s1_5">Specific Instructions </span>
<span id="t13_5" class="t s3_5">Box 1—Employer identification number (EIN). </span><span id="t14_5" class="t s2_5">If you </span>
<span id="t15_5" class="t s2_5">don’t have an EIN, you may apply for one online by </span>
<span id="t16_5" class="t s2_5">visiting the IRS website at </span><span id="t17_5" class="t s7_5">www.irs.gov/EIN</span><span id="t18_5" class="t s2_5">. You may also </span>
<span id="t19_5" class="t s2_5">apply for an EIN by faxing or mailing Form SS-4 to the </span>
<span id="t1a_5" class="t s2_5">IRS. If you haven’t received your EIN by the due date of </span>
<span id="t1b_5" class="t s2_5">Form 941, write “Applied For” and the date you applied in </span>
<span id="t1c_5" class="t s2_5">this entry space. </span>
<span id="t1d_5" class="t s3_5">Box 2—Amount paid. </span><span id="t1e_5" class="t s2_5">Enter the amount paid with </span>
<span id="t1f_5" class="t s2_5">Form 941. </span>
<span id="t1g_5" class="t s3_5">Box 3—Tax period. </span><span id="t1h_5" class="t s2_5">Darken the circle identifying the </span>
<span id="t1i_5" class="t s2_5">quarter for which the payment is made. Darken only </span>
<span id="t1j_5" class="t s2_5">one circle. </span>
<span id="t1k_5" class="t s3_5">Box 4—Name and address. </span><span id="t1l_5" class="t s2_5">Enter your name and </span>
<span id="t1m_5" class="t s2_5">address as shown on Form 941. </span>
<span id="t1n_5" class="t s2_5">• Enclose your check or money order made payable to </span>
<span id="t1o_5" class="t s2_5">“United States Treasury.” Be sure to enter your </span>
<span id="t1p_5" class="t s2_5">EIN, “Form 941,” and the tax period (“1st Quarter 2024,” </span>
<span id="t1q_5" class="t s2_5">“2nd Quarter 2024,” “3rd Quarter 2024,” or “4th Quarter </span>
<span id="t1r_5" class="t s2_5">2024”) on your check or money order. Don’t send cash. </span>
<span id="t1s_5" class="t s2_5">Don’t staple Form 941-V or your payment to Form 941 (or </span>
<span id="t1t_5" class="t s2_5">to each other). </span>
<span id="t1u_5" class="t s2_5">• Detach Form 941-V and send it with your payment </span>
<span id="t1v_5" class="t s2_5">and Form 941 to the address in the Instructions for </span>
<span id="t1w_5" class="t s2_5">Form 941. </span>
<span id="t1x_5" class="t s3_5">Note: </span><span id="t1y_5" class="t s2_5">You must also complete the entity information </span>
<span id="t1z_5" class="t s2_5">above Part 1 on Form 941. </span>
<span id="t20_5" class="t s1_5">Detach Here and Mail With Your Payment and Form 941. </span>
<span id="t21_5" class="t m0_5 s8_5">Form </span>
<span id="t22_5" class="t s9_5">941-V </span>
<span id="t23_5" class="t sa_5">Department of the Treasury </span>
<span id="t24_5" class="t sa_5">Internal Revenue Service </span>
<span id="t25_5" class="t s0_5">Payment Voucher </span>
<span id="t26_5" class="t sb_5">Don’t staple this voucher or your payment to Form 941. </span>
<span id="t27_5" class="t s8_5">OMB No. 1545-0029 </span>
<span id="t28_5" class="t sc_5">20</span><span id="t29_5" class="t sd_5">23 </span>
<span id="t2a_5" class="t se_5">1 </span><span id="t2b_5" class="t s8_5">Enter your employer identification </span>
<span id="t2c_5" class="t s8_5">number (EIN). </span>
<span id="t2d_5" class="t s2_5">– </span>
<span id="t2e_5" class="t se_5">2 </span>
<span id="t2f_5" class="t s3_5">Enter the amount of your payment. </span>
<span id="t2g_5" class="t v1_5 s8_5">Make your check or money order payable to “</span><span id="t2h_5" class="t v1_5 se_5">United States Treasury</span><span id="t2i_5" class="t v1_5 s8_5">.” </span>
<span id="t2j_5" class="t s8_5">Dollars </span><span id="t2k_5" class="t s8_5">Cents </span>
<span id="t2l_5" class="t se_5">3 </span><span id="t2m_5" class="t s8_5">Tax Period </span>
<span id="t2n_5" class="t sf_5">1st </span>
<span id="t2o_5" class="t sf_5">Quarter </span>
<span id="t2p_5" class="t sf_5">2nd </span>
<span id="t2q_5" class="t sf_5">Quarter </span>
<span id="t2r_5" class="t sf_5">3rd </span>
<span id="t2s_5" class="t sf_5">Quarter </span>
<span id="t2t_5" class="t sf_5">4th </span>
<span id="t2u_5" class="t sf_5">Quarter </span>
<span id="t2v_5" class="t se_5">4 </span><span id="t2w_5" class="t s8_5">Enter your business name (individual name if sole proprietor). </span>
<span id="t2x_5" class="t s8_5">Enter your address. </span>
<span id="t2y_5" class="t sg_5">Enter your city, state, and ZIP code; or your city, foreign country name, foreign province/county, and foreign postal code. </span></div>
<!-- End text definitions -->


<!-- Begin Form Data -->
<input id="form1_5" type="text" tabindex="159" value="" data-objref="481 0 R" data-field-name="topmostSubform[0].Page5[0].f5_2[0]"/>
<input id="form2_5" type="text" tabindex="160" maxlength="3" value="" data-objref="482 0 R" data-field-name="topmostSubform[0].Page5[0].f5_3[0]"/>
<input id="form3_5" type="text" tabindex="157" maxlength="2" value="" data-objref="491 0 R" data-field-name="topmostSubform[0].Page5[0].EIN_Number[0].f1_1[0]"/>
<input id="form4_5" type="text" tabindex="158" maxlength="7" value="" data-objref="492 0 R" data-field-name="topmostSubform[0].Page5[0].EIN_Number[0].f1_2[0]"/>
<input id="form5_5" type="text" tabindex="165" value="" data-objref="484 0 R" data-field-name="topmostSubform[0].Page5[0].f1_3[0]"/>
<input id="form6_5" type="checkbox" tabindex="161" value="1" data-objref="489 0 R" data-field-name="topmostSubform[0].Page5[0].Line3_ReadOrder[0].Quarter1stAnd2nd[0].c5_1[0]" imageOn="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAMAAAC6V+0/AAAAe1BMVEUAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAC9eBywAAAAKXRSTlMAH0AsBy/M/+6LBkL0wBDrjWjwCJ8xrT+RI0nZBMdcGc79egp+0vXfpruiKuQAAABjSURBVHjavdBHDoAwDATAUE3vEHpv/38hUkScwBmxx5GltU3I71FUTX+RYQKAZTuyuR6w+NJwEMKdSGDMDZIUMUOEHLEQSBFLgRVijdaIorbj2Et7DiOjaX5ctKzbfpz0k4ddVcMFa5Npd80AAAAASUVORK5CYII=" imageOff="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAMAAAC6V+0/AAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAAA5JREFUeNpjYBgFgx0AAAGkAAF+IKsZAAAAAElFTkSuQmCC" imageDownOff="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAMAAAC6V+0/AAAAD1BMVEUAAAC/v7+/v7+/v7+/v79+V0oJAAAABXRSTlMA/1RfIHGW538AAAAXSURBVHjaY2DAChgxANOoIF0EmTEACwAp6AGjb9SJegAAAABJRU5ErkJggg==" imageName="null" images="110100"/>
<input id="form7_5" type="checkbox" tabindex="163" value="3" data-objref="487 0 R" data-field-name="topmostSubform[0].Page5[0].Line3_ReadOrder[0].c5_1[0]" imageOn="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAMAAAC6V+0/AAAAe1BMVEUAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAC9eBywAAAAKXRSTlMAH0AsBy/M/+6LBkL0wBDrjWjwCJ8xrT+RI0nZBMdcGc79egp+0vXfpruiKuQAAABjSURBVHjavdBHDoAwDATAUE3vEHpv/38hUkScwBmxx5GltU3I71FUTX+RYQKAZTuyuR6w+NJwEMKdSGDMDZIUMUOEHLEQSBFLgRVijdaIorbj2Et7DiOjaX5ctKzbfpz0k4ddVcMFa5Npd80AAAAASUVORK5CYII=" imageOff="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAMAAAC6V+0/AAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAAA5JREFUeNpjYBgFgx0AAAGkAAF+IKsZAAAAAElFTkSuQmCC" imageDownOff="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAMAAAC6V+0/AAAAD1BMVEUAAAC/v7+/v7+/v7+/v79+V0oJAAAABXRSTlMA/1RfIHGW538AAAAXSURBVHjaY2DAChgxANOoIF0EmTEACwAp6AGjb9SJegAAAABJRU5ErkJggg==" imageName="null" images="110100"/>
<input id="form8_5" type="text" tabindex="166" value="" data-objref="485 0 R" data-field-name="topmostSubform[0].Page5[0].f5_5[0]"/>
<input id="form9_5" type="checkbox" tabindex="162" value="2" data-objref="490 0 R" data-field-name="topmostSubform[0].Page5[0].Line3_ReadOrder[0].Quarter1stAnd2nd[0].c5_1[1]" imageOn="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAMAAAC6V+0/AAAAe1BMVEUAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAC9eBywAAAAKXRSTlMAH0AsBy/M/+6LBkL0wBDrjWjwCJ8xrT+RI0nZBMdcGc79egp+0vXfpruiKuQAAABjSURBVHjavdBHDoAwDATAUE3vEHpv/38hUkScwBmxx5GltU3I71FUTX+RYQKAZTuyuR6w+NJwEMKdSGDMDZIUMUOEHLEQSBFLgRVijdaIorbj2Et7DiOjaX5ctKzbfpz0k4ddVcMFa5Npd80AAAAASUVORK5CYII=" imageOff="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAMAAAC6V+0/AAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAAA5JREFUeNpjYBgFgx0AAAGkAAF+IKsZAAAAAElFTkSuQmCC" imageDownOff="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAMAAAC6V+0/AAAAD1BMVEUAAAC/v7+/v7+/v7+/v79+V0oJAAAABXRSTlMA/1RfIHGW538AAAAXSURBVHjaY2DAChgxANOoIF0EmTEACwAp6AGjb9SJegAAAABJRU5ErkJggg==" imageName="null" images="110100"/>
<input id="form10_5" type="checkbox" tabindex="164" value="4" data-objref="488 0 R" data-field-name="topmostSubform[0].Page5[0].Line3_ReadOrder[0].c5_1[1]" imageOn="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAMAAAC6V+0/AAAAe1BMVEUAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAC9eBywAAAAKXRSTlMAH0AsBy/M/+6LBkL0wBDrjWjwCJ8xrT+RI0nZBMdcGc79egp+0vXfpruiKuQAAABjSURBVHjavdBHDoAwDATAUE3vEHpv/38hUkScwBmxx5GltU3I71FUTX+RYQKAZTuyuR6w+NJwEMKdSGDMDZIUMUOEHLEQSBFLgRVijdaIorbj2Et7DiOjaX5ctKzbfpz0k4ddVcMFa5Npd80AAAAASUVORK5CYII=" imageOff="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAMAAAC6V+0/AAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAAA5JREFUeNpjYBgFgx0AAAGkAAF+IKsZAAAAAElFTkSuQmCC" imageDownOff="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAMAAAC6V+0/AAAAD1BMVEUAAAC/v7+/v7+/v7+/v79+V0oJAAAABXRSTlMA/1RfIHGW538AAAAXSURBVHjaY2DAChgxANOoIF0EmTEACwAp6AGjb9SJegAAAABJRU5ErkJggg==" imageName="null" images="110100"/>
<input id="form11_5" type="text" tabindex="167" value="" data-objref="311 0 R" data-field-name="topmostSubform[0].Page5[0].f5_6[0]"/>

<!-- End Form Data -->

</div>

</div>
</div>
<div id="page6" style="width: 934px; height: 1209px; margin-top:20px;" class="page">
<div class="page-inner" style="width: 934px; height: 1209px;">

<div id="p6" class="pageArea" style="overflow: hidden; position: relative; width: 934px; height: 1209px; margin-top:auto; margin-left:auto; margin-right:auto; background-color: white;">






    
<script>
//global variables that can be used by ALL the functions on this page.
let is64;
let inputs;     // A list of all the inputs on the page
let tabOrder;   // A list of all the inputs with tab order, ordered by tab index
const states = ['On.png', 'Off.png', 'DownOn.png', 'DownOff.png', 'RollOn.png', 'RollOff.png'];
const states64 = ['imageOn', 'imageOff', 'imageDownOn', 'imageDownOff', 'imageRollOn', 'imageRollOff'];

function setImage(input, state) {
    if (inputs[input].getAttribute('images').charAt(state) === '1') {
        document.getElementById(inputs[input].getAttribute('id') + "_img").src = getSrc(input, state);
    }
}

function getSrc(input, state) {
    let src;
    if (is64) {
        src = inputs[input].getAttribute(states64[state]);
    } else {
        src = inputs[input].getAttribute('imageName') + states[state];
    }
    return src;
}

/**
 * Replace checkboxes and radiobuttons with their APImages
 * @param isBase64 Whether the APImages are encoded in base64
 */
function replaceChecks(isBase64) {

    is64 = isBase64;
    // Get all the input fields on the page
    inputs = [...document.getElementsByTagName('input')];
    // Create a sorted list of inputs for tab ordering
    tabOrder = [...document.querySelectorAll("[tabindex]")].filter(input => input.tabIndex !== -1)
        .sort((a, b) => a.tabIndex - b.tabIndex);

    //cycle through the input fields
    for (let i=0; i<inputs.length; i++) {
        if (!inputs[i].hasAttribute('images')) continue;

        //check if the input is a checkbox or radio button
        if (inputs[i].getAttribute('class') !== 'idr-hidden' && inputs[i].getAttribute('data-image-added') !== 'true'
            && (inputs[i].getAttribute('type') === 'checkbox' || inputs[i].getAttribute('type') === 'radio')) {

            //create a new image
            let img = document.createElement('img');

            //check if the checkbox is checked
            if (inputs[i].checked) {
                if (inputs[i].getAttribute('images').charAt(0) === '1')
                    img.src = getSrc(i, 0);
            } else {
                if (inputs[i].getAttribute('images').charAt(1) === '1')
                    img.src = getSrc(i, 1);
            }

            //set image ID
            img.id = inputs[i].getAttribute('id') + "_img";
            // Copy Tab index
            img.tabIndex = inputs[i].tabIndex;

            //set action associations
            let imageIndex = i;
            img.addEventListener("click", () => checkClick(imageIndex));
            img.addEventListener("mousedown", () => checkDown(imageIndex));
            img.addEventListener("mouseover", () => checkOver(imageIndex));
            img.addEventListener("mouseup", () => checkRelease(imageIndex));
            img.addEventListener("mouseout", () => checkRelease(imageIndex));
            img.addEventListener("focus", () => checkFocus(imageIndex))
            img.addEventListener("blur", () => checkBlur(imageIndex))

            img.style.position = "absolute";
            let style = window.getComputedStyle(inputs[i]);
            img.style.top = style.top;
            img.style.left = style.left;
            img.style.width = style.width;
            img.style.height = style.height;
            img.style.zIndex = style.zIndex;

            //place image in front of the checkbox
            inputs[i].parentNode.insertBefore(img, inputs[i]);
            inputs[i].setAttribute('data-image-added','true');
            inputs[i].setAttribute('data-image-index', i.toString());

            //hide the checkbox
            inputs[i].style.display='none';

            // Specific handling for checkbox
            if (inputs[i].type === 'checkbox') {
                img.addEventListener("keydown", event => {
                    // Need to capture keydown or it will scroll the page
                    if (event.code === "Space") {
                        event.preventDefault();
                        event.stopPropagation();
                        return false;
                    }
                });

                img.addEventListener("keyup", event => {
                    if (event.isComposing) return;
                    if (event.code === "Space") {
                        checkSpace(imageIndex);
                    }
                })
            } else if (inputs[i].type === "radio") {

                // Handle navigation
                img.addEventListener("keydown", event => {
                    if (["ArrowLeft", "ArrowRight", "ArrowUp", "ArrowDown"].includes(event.code)) {
                        event.preventDefault();
                        event.stopPropagation();
                        handleRadioArrow(event.code, i);
                        return false;
                    } else if (event.code === "Tab") {
                        event.preventDefault();
                        event.stopPropagation();
                        handleRadioTab(event.shiftKey, i);
                        return false;
                    }
                })
            }
        }
    }
}

/**
 * Handle when a radio button is navigated using the arrow keys
 * @param code {("ArrowUp"|"ArrowDown"|"ArrowLeft"|"ArrowRight")} The code for the key used to navigate
 * @param i {Number}The index of the radiobutton in the inputs array
 */
function handleRadioArrow(code, i) {
    const options = [...document.querySelectorAll(`input[data-field-name="${inputs[i].dataset.fieldName}"]`)];


    // Get the index of the currently selected checkbox
    const selected = inputs[i];
    let index = selected ? options.indexOf(selected) : 0;

    if (["ArrowLeft", "ArrowUp"].includes(code)) {
        // Get the previous index, wrapping around if necessary
        index = index === 0 ? options.length - 1 : index - 1;
    } else {
        // Get the next index, wrapping around if necessary
        index = (index + 1) % options.length;
    }

    const input = options[index];
    const imageIndex = parseInt(input.dataset.imageIndex);
    input.checked = true;
    focus(input);
    input.dispatchEvent(new Event("change"));

    deselectSiblingRadio(imageIndex);
    refreshApImage(imageIndex);
}

/**
 * Handle when a radiobutton tries to go to the next or previous form field with tab
 * @param back {Boolean} Whether to go to the previous element
 * @param i {Number} The index of the radiobutton in the inputs array
 */
function handleRadioTab(back, i) {
    let index = tabOrder.indexOf(inputs[i]);

    // A count is used to ensure that if there is only one radio button group in the list then it will not be an
    // infinite loop
    let count = 0;
    while (count++ < tabOrder.length
            && (tabOrder[index].dataset.fieldName === inputs[i].dataset.fieldName
            || tabOrder[index].readOnly || tabOrder[index].disabled)) {
        if (!back) {
            index = (index + 1) % tabOrder.length;
        } else {
            index = (index - 1);
            if (index < 0) index = tabOrder.length - 1;
        }
    }

    focus(tabOrder[index]);
}

/**
 * Focus the element at the given index of the Inputs array
 * <br>
 * This ensures that the AP Image is selected if available, and the input is selected otherwise
 * @param i {Number | Element}The index of the element in the inputs array or the input itself
 */
function focus(i) {
    const input = typeof i === "number" ? inputs[i] : i;
    let element;
    if (input.dataset.imageAdded === "true") element = document.getElementById(input.id + "_img");
    else element = input;

    element.focus({focusVisible: true});
}

/**
 * A utility to deselect all the siblings of the input at the given index
 * @param i {Number} The index of the input of who's siblings are to be disabled
 */
function deselectSiblingRadio(i) {
    if (inputs[i].getAttribute('name') !== null) {
        for (let index = 0; index < inputs.length; index++) {
            if (index !== i && inputs[index].getAttribute('name') === inputs[i].getAttribute('name')) {
                inputs[index].checked = false;
                setImage(index, 1);
            }
        }
    }
}

/**
 * Refresh the AP Image of the given input based on its value
 *
 * Intended to be used externally to update the ap image after a change
 * @param i {Number} The index of the checkbox/radiobutton
 */
function refreshApImage(i)  {
    if (!inputs[i].hasAttribute('images')) return;
    if (inputs[i].checked) {
        setImage(i, 0);
    } else {
        setImage(i, 1);
    }
}

/**
 * Handle clicking on a checkbox/radiobutton
 * <br>
 * This is the one of the mouse operations that actually changes the checkbox/radiobutton status
 * @param i {Number} The index of the checkbox/radiobutton
 */
function checkClick(i) {
    if (!inputs[i].hasAttribute('images')) return;

    if (inputs[i].checked) {
        if (inputs[i].getAttribute('type') === 'radio' && inputs[i].dataset.flagNotoggletooff === "true") {
            inputs[i].dispatchEvent(new Event('click'));
            return;
        } else {
            inputs[i].checked = false;
            setImage(i, 1);
        }
    } else {
        inputs[i].checked = true;

        setImage(i, 0);

        deselectSiblingRadio(i);
    }

    /*
     * Both checkboxes and radio buttons fire the change and input events
     * https://html.spec.whatwg.org/multipage/input.html#concept-input-apply
     */
    inputs[i].dispatchEvent(new Event('change'));
    inputs[i].dispatchEvent(new Event('input'));

    inputs[i].dispatchEvent(new Event('click'));
}

/**
 * Handle when the space bar is pressed whilst a checkbox is targeted
 * <br>
 * This is only for checkboxes, so there's no radiobutton specific logic included
 * <br>
 * Changes the checkbox status and set the replacement image
 * @param i {Number} The index of the checkbox/radiobutton
 */
function checkSpace(i) {
    if (!inputs[i].hasAttribute('images')) return;
    if (inputs[i].checked) {
        inputs[i].checked = false;
        setImage(i, 1);
    } else {
        inputs[i].checked = true;
        setImage(i, 0);
    }

    /*
     * Both checkboxes and radio buttons fire the change and input events
     * https://html.spec.whatwg.org/multipage/input.html#concept-input-apply
     */
    inputs[i].dispatchEvent(new Event('change'));
    inputs[i].dispatchEvent(new Event('input'));

    inputs[i].dispatchEvent(new Event('keyup'));
}

/**
 * Handle when a checkbox/radiobutton is released (mouseup/mouseout)
 * @param i {Number} The index of the checkbox/radiobutton
 */
function checkRelease(i) {
    if (!inputs[i].hasAttribute('images')) return;
    if (inputs[i].checked) {
        setImage(i, 0);
    } else {
        setImage(i, 1);
    }
    inputs[i].dispatchEvent(new Event('mouseup'));
}

/**
 * Handle when a checkbox/radiobutton is pressed (mousedown)
 * @param i {Number} The index of the checkbox/radiobutton
 */
function checkDown(i) {
    if (!inputs[i].hasAttribute('images')) return;
    if (inputs[i].checked) {
        setImage(i, 2);
    } else {
        setImage(i, 3);
    }
    inputs[i].dispatchEvent(new Event('mousedown'));
}

/**
 * Handle when a mouse hovers over a checkbox/radiobutton
 * @param i {Number} The index of the checkbox/radiobutton
 */
function checkOver(i) {
    if (!inputs[i].hasAttribute('images')) return;
    if (inputs[i].checked) {
        setImage(i, 4);
    } else {
        setImage(i, 5);
    }
    inputs[i].dispatchEvent(new Event('mouseover'));
}

/**
 * Handle when the AP image is focused
 * @param i {Number} The index of the checkbox/radiobutton
 */
function checkFocus(i) {
    if (!inputs[i].hasAttribute('images')) return;

    inputs[i].dispatchEvent(new Event('focus'));
}

/**
 * Handle when the AP image loses focus
 * @param i {Number} The index of the checkbox/radiobutton
 */
function checkBlur(i) {
    if (!inputs[i].hasAttribute('images')) return;

    inputs[i].dispatchEvent(new Event('blur'));
}
</script>

<!-- Begin shared CSS values -->
<style class="shared-css" type="text/css" >
.t {
	transform-origin: bottom left;
	z-index: 2;
	position: absolute;
	white-space: pre;
	overflow: visible;
	line-height: 1.5;
}
.text-container {
	white-space: pre;
}
@supports (-webkit-touch-callout: none) {
	.text-container {
		white-space: normal;
	}
}
</style>
<!-- End shared CSS values -->


<!-- Begin inline CSS -->
<style type="text/css" >

#t1_6{left:55px;bottom:1138px;letter-spacing:-0.15px;}
#t2_6{left:55px;bottom:1103px;letter-spacing:0.14px;}
#t3_6{left:55px;bottom:1086px;letter-spacing:0.13px;}
#t4_6{left:413px;bottom:1086px;letter-spacing:0.1px;}
#t5_6{left:55px;bottom:1070px;letter-spacing:0.13px;}
#t6_6{left:380px;bottom:1070px;letter-spacing:0.11px;}
#t7_6{left:55px;bottom:1053px;letter-spacing:0.12px;}
#t8_6{left:341px;bottom:1053px;letter-spacing:0.11px;}
#t9_6{left:55px;bottom:1037px;letter-spacing:0.13px;}
#ta_6{left:356px;bottom:1037px;letter-spacing:0.13px;}
#tb_6{left:55px;bottom:1020px;letter-spacing:0.14px;}
#tc_6{left:55px;bottom:1004px;letter-spacing:0.13px;}
#td_6{left:55px;bottom:988px;letter-spacing:0.13px;}
#te_6{left:386px;bottom:988px;letter-spacing:0.11px;}
#tf_6{left:55px;bottom:971px;letter-spacing:0.12px;}
#tg_6{left:375px;bottom:971px;letter-spacing:0.09px;}
#th_6{left:55px;bottom:955px;letter-spacing:0.12px;}
#ti_6{left:55px;bottom:938px;letter-spacing:0.11px;}
#tj_6{left:55px;bottom:922px;letter-spacing:0.12px;}
#tk_6{left:165px;bottom:922px;letter-spacing:0.12px;}
#tl_6{left:55px;bottom:906px;letter-spacing:0.12px;}
#tm_6{left:70px;bottom:883px;letter-spacing:0.12px;}
#tn_6{left:55px;bottom:867px;letter-spacing:0.12px;}
#to_6{left:55px;bottom:850px;letter-spacing:0.13px;}
#tp_6{left:55px;bottom:834px;letter-spacing:0.12px;}
#tq_6{left:55px;bottom:817px;letter-spacing:0.12px;}
#tr_6{left:55px;bottom:801px;letter-spacing:0.12px;}
#ts_6{left:55px;bottom:784px;letter-spacing:0.14px;}
#tt_6{left:70px;bottom:762px;letter-spacing:0.12px;}
#tu_6{left:55px;bottom:745px;letter-spacing:0.12px;}
#tv_6{left:55px;bottom:729px;letter-spacing:0.12px;}
#tw_6{left:55px;bottom:713px;letter-spacing:0.12px;}
#tx_6{left:55px;bottom:696px;letter-spacing:0.13px;}
#ty_6{left:55px;bottom:680px;letter-spacing:0.12px;}
#tz_6{left:484px;bottom:1103px;letter-spacing:0.11px;}
#t10_6{left:484px;bottom:1086px;letter-spacing:0.13px;}
#t11_6{left:484px;bottom:1070px;letter-spacing:0.12px;}
#t12_6{left:484px;bottom:1053px;letter-spacing:0.12px;}
#t13_6{left:484px;bottom:1037px;letter-spacing:0.12px;}
#t14_6{left:484px;bottom:1020px;letter-spacing:0.12px;}
#t15_6{left:484px;bottom:1004px;letter-spacing:0.13px;}
#t16_6{left:484px;bottom:988px;letter-spacing:0.12px;}
#t17_6{left:499px;bottom:965px;letter-spacing:0.12px;}
#t18_6{left:484px;bottom:949px;letter-spacing:0.13px;}
#t19_6{left:484px;bottom:932px;letter-spacing:0.13px;}
#t1a_6{left:484px;bottom:910px;letter-spacing:0.16px;}
#t1b_6{left:605px;bottom:910px;}
#t1c_6{left:623px;bottom:910px;}
#t1d_6{left:642px;bottom:910px;}
#t1e_6{left:660px;bottom:910px;}
#t1f_6{left:678px;bottom:910px;}
#t1g_6{left:697px;bottom:910px;}
#t1h_6{left:715px;bottom:910px;}
#t1i_6{left:733px;bottom:910px;}
#t1j_6{left:752px;bottom:910px;}
#t1k_6{left:770px;bottom:910px;}
#t1l_6{left:782px;bottom:910px;letter-spacing:0.12px;}
#t1m_6{left:484px;bottom:887px;letter-spacing:0.13px;}
#t1n_6{left:752px;bottom:887px;}
#t1o_6{left:770px;bottom:887px;}
#t1p_6{left:788px;bottom:887px;}
#t1q_6{left:807px;bottom:887px;}
#t1r_6{left:829px;bottom:887px;letter-spacing:0.13px;}
#t1s_6{left:484px;bottom:865px;letter-spacing:0.13px;}
#t1t_6{left:484px;bottom:848px;letter-spacing:0.13px;}
#t1u_6{left:697px;bottom:848px;}
#t1v_6{left:715px;bottom:848px;}
#t1w_6{left:733px;bottom:848px;}
#t1x_6{left:752px;bottom:848px;}
#t1y_6{left:770px;bottom:848px;}
#t1z_6{left:790px;bottom:848px;letter-spacing:0.12px;}
#t20_6{left:499px;bottom:826px;letter-spacing:0.13px;}
#t21_6{left:484px;bottom:809px;letter-spacing:0.13px;}
#t22_6{left:484px;bottom:793px;letter-spacing:0.13px;}
#t23_6{left:484px;bottom:776px;letter-spacing:0.14px;}
#t24_6{left:654px;bottom:776px;letter-spacing:0.21px;}
#t25_6{left:689px;bottom:776px;}
#t26_6{left:693px;bottom:776px;letter-spacing:0.15px;}
#t27_6{left:854px;bottom:776px;}
#t28_6{left:862px;bottom:776px;letter-spacing:0.1px;}
#t29_6{left:484px;bottom:760px;letter-spacing:0.13px;}
#t2a_6{left:484px;bottom:744px;letter-spacing:0.12px;}
#t2b_6{left:484px;bottom:727px;letter-spacing:0.13px;}
#t2c_6{left:484px;bottom:711px;letter-spacing:0.13px;}
#t2d_6{left:525px;bottom:711px;letter-spacing:0.12px;}
#t2e_6{left:830px;bottom:711px;letter-spacing:0.13px;}
#t2f_6{left:484px;bottom:694px;letter-spacing:0.13px;}
#t2g_6{left:604px;bottom:694px;letter-spacing:0.12px;}

.s0_6{font-size:11px;font-family:HelveticaNeueLTStd-Roman_1fp_6;color:#000;}
.s1_6{font-size:15px;font-family:HelveticaNeueLTStd-Bd_1fn_6;color:#000;}
.s2_6{font-size:15px;font-family:HelveticaNeueLTStd-Roman_1fp_6;color:#000;}
.s3_6{font-size:15px;font-family:HelveticaNeueLTStd-It_1fo_6;color:#000;}
</style>
<!-- End inline CSS -->

<!-- Begin embedded font definitions -->
<style id="fonts6" type="text/css" >

@font-face {
	font-family: HelveticaNeueLTStd-Bd_1fn_6;
	src: url(data:application/font-woff;charset=utf-8;base64,d09GRk9UVE8AAA0QAAkAAAAAEfwAAQABAAAAAAAAAAAAAAAAAAAAAAAAAABDRkYgAAAA4AAACQQAAAqFOatN0E9TLzIAAAnkAAAAKgAAAGAJsQgMY21hcAAAChAAAADUAAACIolp8hxoZWFkAAAK5AAAADMAAAA2+Ke32WhoZWEAAAsYAAAAHwAAACQFPAIVaG10eAAACzgAAAB9AAABIKDBAABtYXhwAAALuAAAAAYAAAAGAEhQAG5hbWUAAAvAAAABPAAAAq8eA3Y0cG9zdAAADPwAAAATAAAAIP+GADZ4nH1Ve1RU5Rb/5nHOGR5N6TBEM3rOabTInHg4wACSS0UGBdMlmvYSHWDQEZixGR4hYmWlooyvKMGwMHKJj0qXj8jUpJYPvNHVuikqAlaklzTNx+xDe9btfgewe+8/98yac863v71/+7df51MQtZIoFIphkx2FpY5iZ659mqPEMXXWzOK8pybmzYvNd81LkPcFyaiQwtSYjK4/Tv+Ry8CVByUypHVYcPpQaVionigVitt/proXl3ucCxYWi7FJiYlmek+K6b9bzOKYmJgx4oQ8d45DnFnuLXYUecUprly3Z7HbYy925EWJEwoLxSzZ2CtmObwOT6ks/IuV6PSKdrHYY89zFNk9BaI7n+458xyFOQ7PAodHnOQpyS0osntzFzpdDpc4Id0sOl7JLSzxOksdheVioTPX4fI68sTihR53yYKF4lSny11cvthBX3I8dk+5mF6UM9ks2l15YpG9XKQsPY4FTsrTQ42cLjHX4Sm20+eiEo/Tm+fMLXa6Xd6oaNvMWTJInJjnyCdEQX+EIYRTkweUZEgwEQkxachTD5CJEaSKkMk01URJNVjCEQ0JIsEkhESRaJJKJpE0YiPpZDKZQjJIJplKniHTyHSykqyilqvJGlJNfGQt+YgcJV+S38hNhUURp3hHySo5pUYZpAxWhihDlW8oL6hEVbmqVU3Upep96nb1BeZB5jFmJXOCDWEXsQXsJ9wQbiq3ljvE/Yv7U2PTpGsDkdqBKxC5BqIUpyBWdSr8e9Y3r3C+/U1NKnel9uypqwaIwljuvs5JqnMyHGJlIav972tdQylYIEjKKFO82Tdd9WY4WNivwcLAB2wL0oeVxQ/6shmMZy/gJL2P7cHNDD7zF0YgvKG0L7tMcYY6OEMd9GXLDixrIEK6eF8q+SACb0kX+12fvK8fCa0QKdtESh4fC0cCHqbfPDLgrWLxqORlMIbqV1J+NaCFRaCV4aAWzP2OqDCJBdsZYEADGhswaBPwHAuxqNWDlv3HNxUxMRkVEwXUUpD9FGQXqGHuIMjuQbZUGMtebFo0/l3h7awq2/vZGrp276vuWtW84vuSc+M+0Pi4i7s+Pt1lAJL8M4bxAf2gh/Hs2b1FtlRHUZqA41ltwRLQStWgHdoIZgwDM2wDs65dd60RXtfjpCp44mkYY4TZt2/Aw5CAcbvn1Aq6dkz/3LnxK8PJ4w1Hzp0qiV/Pg5mFJBz+DY5CPfJp+Dga/Dn33Pxdt3/ZOMNEa8UsXnfNOmFPrzCYfbGyN7kDoHfoLjBBNph0zVIovKQvXGlB1dyc2mNf7tv8WQ3/2dtHqhsbNDjtrv7r9Z9sbTEeObB82ozktXHLBMurFjcGGR698MKN0231h5p53SvVS9YtWV+hgZHssoYVhw4ZYCsHD+FDH45EDYbk4iNv8Nq0Sn/UNejyQ2bZ0Bbq+XXq+bBuaUs4GFnd4TYfl7XzdPF5421QdUIWzEBV58jMTO/shUIV1KKJlR4MvKSPz0+xWvMvXvlxz8Wurj0pcTwNxk8xFXvBpJIOwE96iFiO6r+h1ogpozEE4zH6LiohBob1noPhWwQczk5d7rBPMY5x/fzD+R1Xfzmxp3BGjfA/5OS0rBggJ42l7Gh7mbC2ij1aMH3bNCOax9E8C4LuMI44jwaIaTve+PVu3sdWwWx9gjvpKUt+d0f3rkvXru4Yax3g93APKP2KJpnifijWg+WdBHgCJxkxVsRgjMa4W6gGKwR1fwnafQIOYQuWz12YZUyZt79npdCj3ufbdrbHeGanI7VW0OKthlIpubfHr+imeN3hYJKSb/SO2skefO+9vVvqV1fV8/e4au/Laz1G1GRNiRFyE8zdnDYNn+sFjR++uhblH0qTBa+BUdehuy59IdXpkRagw1bFnXTO+TDdiI+NQy0a0NSGwRDd2rqtZafgS2cnVC94NsX4/Pwtx5YJ+CiLwRsh5MXfjbB8B4zsFrDmZ32cu+OH9k/OXrraNN46IdeWLGgtlKuVTlBmmUKu+FzKmJbbBI3s3d0H29s+sifw2EzX33EQ5ujG0bOfcc9YwK+CrbTe2sBYal1XdhOCFMep4XE51Dq6QfWf19OKBAFV0or9SlBUpviWKn0ro9vYr46BCSsYOm9YBJdgDmQxmMJiOk5jJB2auH5s+YNyH1guMauFEpnvjVGgHko3IGPgHzZMd1jWgWPsrb9v2d6z0jadx4N0vZ/7ZnPbpY4NWTYeP6fr3zgwpBxFZeqzOdlFfKt7RmOGcfKzhbPzhSqa37No4AYS0u9gMB+65v+bkOkDCWF17d+jkZO7dLDZYR1lvhfe1WPiXSSQANa7QCARkkxA0IoJJiSYxIMpvLOp89frTYmJSa7EJ0e7Oi/TOcT4UkihQHIrtAz2ekcLZujp+2of+9zHJxa3GmH0edADD5ET4WFMyJzpmeWUw7jeRnlAXSBFH11wqUvQdXTt6Lz2y+6EJF533Vo0NorXarGZBjkCgmn3RKzoH3VdbX+Qlayu6ZdPz92pb6haVcvraiGC0zWtXf6q73WjLS0742UZ/9Svcpw4srKXfqAU+6lVJg20CVL0OHwDBGVDqBGCIfgzGPZr8o7E94Xk98duPGo4cGjDrqMHls5ax9NvCeheG7EXGSOqkHViRMxl1+Vy4feSE0vnG56fU5Ezc85Hrat5LV5+izbmmV7FVYoPy/ri5JaKjjdfwePsyPNlP27fWb2ukQcVt2pp5eqlxhdf3fSFADV3ekfQIlaCetQNyVr2nyJKn8pjZMJG1rRo/rgpngPdPDTT9Xcchu1NgNEnW7cf/5Rfy+peSQU5vvj+rlWslzaqpE2yKR0oBd5j6BmmgHsMjmIhLVDHwBjalI8M6G7oO6jqOyzrPs6a8TZVtcBtBnk2Hu/QhRnuMPgkC4myWST7E9xkfOxVvMnA43RKMAEz6HFND9e3pO0qaasME8kig37ZZRD4GaSnSEag/L2ciudeWPGIe7V73WKfBoO4VU1NVU3GG4c/7txJz48l9X3Z9bioDp5ew0J9ze81gfY6blC4SQPbNt7cGPjnpiB/MJhC/O+EhoJpc+gD1aFa6VhY39P6fwM7u9KdeJxjYGayZpzAwMrAwJAGhAzoNCMcMGADDiCCWeG/BYhkOIGpAABCDwXKAAB4nGNgYGBmgGAZBkYgycAoA+SBWHMYWBgawOICQBEeBgUGFQY1Bi0GPQYrBnsGT4ZIhkoFEQXJ/3///weqgshqMOgwGABlHRl8GBJhsv8f/r/3/y4Q3vl/+//1/9f+X/l/9oHx/ddQe3CDgbafgZGNgcESvxKwEUxAo1jZ2Bk4OLkYuHl4+fgFBIWERURB0mIM4hKSUtIysnLyQEcqKimrqKqpa2hqaevoQg3Q0zcwNDI2MTUzt7C0sraxtbN3cHRydnF1I2AxucCdARSyRAMAi5FRw3icY2BkYGAA4o0b1u+K57f5ysDA/AIownCacRcDjP4f9V+NxYz5PJDLzsAEEgUAYCkL9gB4nGNgZGBgVvhvASRf/I/6t4ZpPwNQBAV4AACSUwZUAHicY9JhYGAUY2BgAtJMayFsRg0ong7lT0dSQwRGNo/pABA/heIOIA4E4u8QPqM6hM/cDeEzcwHp2VD6EhB3AnEyVG8ZUHwDRB6M7aBySDSjL5QNNJORCeoOOwibuQtqdzICM7YCaUkgnQCV4wCq04OIMbED2S8YGACNnRpJAAAAAABQAABIAAB4nJ2PzWrCQBSFz/gHbaHLbrpwtqUoxkUWXbQgIiIagga3EpKJpsQZiYngqqvu+x6F7voUfZK+RU9w6NKFA/fON+eeOcMAuMUXBE6rzTqxwD1PJ66hiSfLdTzixXKDnlfLTdzg3XKL+gedonHF0zM+LQu4+LVcw7VoW65jKR4sN+CKN8tN3Ilvyy3qP56Rkdkd83S9KWSqE5NvwyI1Wiam1HF3rLKDKtIo9FSppsGiiDuDeOUkeuXOzTbUE1/FYSb94ag/DmZTecZ/ZrRU+b560+n2zrjgwUAiYt/hiBwp1tigoJZCI6GeY4uQSkrW1CutJMXoYgyFDAf2ah7R55FL1hQBFlRjdDBgX8HhTc3dxZwJVabGBD69MTljso8hRugzNcCMCfLC/MtuLTnPsf//p8P/9S7L+gNG5IN3eJxjYGYAg//NDGYMWAAAKJgBvAA=) format("woff"),
url(data:font/truetype;charset=utf-8;base64,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) format("otf");
}

@font-face {
	font-family: HelveticaNeueLTStd-It_1fo_6;
	src: url(data:application/font-woff;charset=utf-8;base64,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) format("woff"),
url(data:font/truetype;charset=utf-8;base64,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) format("otf");
}

@font-face {
	font-family: HelveticaNeueLTStd-Roman_1fp_6;
	src: url(data:application/font-woff;charset=utf-8;base64,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) format("woff"),
url(data:font/truetype;charset=utf-8;base64,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) format("otf");
}

</style>
<!-- End embedded font definitions -->

<!-- Begin page background -->
<div id="pg6Overlay" style="width:100%; height:100%; position:absolute; z-index:1; background-color:rgba(0,0,0,0); -webkit-user-select: none;"></div>
<div id="pg6" style="-webkit-user-select: none;"><svg id="pdf6" width="934" height="1209" viewBox="0 0 934 1209" style="width:934px; height:1209px; -moz-transform:scale(1); z-index: 0; isolation: isolate;" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
<defs>
<style type="text/css"><![CDATA[
.g0_6{
fill: none;
stroke: #000;
stroke-width: 1.527;
stroke-miterlimit: 10;
}
]]></style>
</defs>
<path d="M54.6,73.3H880.4" class="g0_6"/>
</svg></div>
<!-- End page background -->


<!-- Begin text definitions (Positioned/styled in CSS) -->
<div class="text-container"><span id="t1_6" class="t s0_6">Form 941 (Rev. 3-2024) </span>
<span id="t2_6" class="t s1_6">Privacy Act and Paperwork Reduction Act Notice. </span>
<span id="t3_6" class="t s2_6">We ask for the information on Form 941 to carry out </span><span id="t4_6" class="t s2_6">the </span>
<span id="t5_6" class="t s2_6">Internal Revenue laws of the United States. We </span><span id="t6_6" class="t s2_6">need it to </span>
<span id="t7_6" class="t s2_6">figure and collect the right amount of tax. </span><span id="t8_6" class="t s2_6">Subtitle C, </span>
<span id="t9_6" class="t s2_6">Employment Taxes, of the Internal Revenue </span><span id="ta_6" class="t s2_6">Code </span>
<span id="tb_6" class="t s2_6">imposes employment taxes on wages and provides for </span>
<span id="tc_6" class="t s2_6">income tax withholding. Form 941 is used to determine </span>
<span id="td_6" class="t s2_6">the amount of taxes that you owe. Section 6011 </span><span id="te_6" class="t s2_6">requires </span>
<span id="tf_6" class="t s2_6">you to provide the requested information if the </span><span id="tg_6" class="t s2_6">tax is </span>
<span id="th_6" class="t s2_6">applicable to you. Section 6109 requires you to provide </span>
<span id="ti_6" class="t s2_6">your identification number. If you fail to provide this </span>
<span id="tj_6" class="t s2_6">information in a </span><span id="tk_6" class="t s2_6">timely manner, or provide false or </span>
<span id="tl_6" class="t s2_6">fraudulent information, you may be subject to penalties. </span>
<span id="tm_6" class="t s2_6">You’re not required to provide the information </span>
<span id="tn_6" class="t s2_6">requested on a form that is subject to the Paperwork </span>
<span id="to_6" class="t s2_6">Reduction Act unless the form displays a valid OMB </span>
<span id="tp_6" class="t s2_6">control number. Books and records relating to a form or </span>
<span id="tq_6" class="t s2_6">its instructions must be retained as long as their contents </span>
<span id="tr_6" class="t s2_6">may become material in the administration of any Internal </span>
<span id="ts_6" class="t s2_6">Revenue law. </span>
<span id="tt_6" class="t s2_6">Generally, tax returns and return information are </span>
<span id="tu_6" class="t s2_6">confidential, as required by section 6103. However, </span>
<span id="tv_6" class="t s2_6">section 6103 allows or requires the IRS to disclose or </span>
<span id="tw_6" class="t s2_6">give the information shown on your tax return to others </span>
<span id="tx_6" class="t s2_6">as described in the Code. For example, we may </span>
<span id="ty_6" class="t s2_6">disclose your tax information to the Department of </span>
<span id="tz_6" class="t s2_6">Justice for civil and criminal litigation, and to cities, </span>
<span id="t10_6" class="t s2_6">states, the District of Columbia, and U.S. commonwealths </span>
<span id="t11_6" class="t s2_6">and possessions for use in administering their tax laws. </span>
<span id="t12_6" class="t s2_6">We may also disclose this information to other countries </span>
<span id="t13_6" class="t s2_6">under a tax treaty, to federal and state agencies to </span>
<span id="t14_6" class="t s2_6">enforce federal nontax criminal laws, or to federal law </span>
<span id="t15_6" class="t s2_6">enforcement and intelligence agencies to combat </span>
<span id="t16_6" class="t s2_6">terrorism. </span>
<span id="t17_6" class="t s2_6">The time needed to complete and file Form 941 will </span>
<span id="t18_6" class="t s2_6">vary depending on individual circumstances. The </span>
<span id="t19_6" class="t s2_6">estimated average time is: </span>
<span id="t1a_6" class="t s1_6">Recordkeeping </span><span id="t1b_6" class="t s2_6">. </span><span id="t1c_6" class="t s2_6">. </span><span id="t1d_6" class="t s2_6">. </span><span id="t1e_6" class="t s2_6">. </span><span id="t1f_6" class="t s2_6">. </span><span id="t1g_6" class="t s2_6">. </span><span id="t1h_6" class="t s2_6">. </span><span id="t1i_6" class="t s2_6">. </span><span id="t1j_6" class="t s2_6">. </span><span id="t1k_6" class="t s2_6">. </span><span id="t1l_6" class="t s2_6">22 hr., 28 min. </span>
<span id="t1m_6" class="t s1_6">Learning about the law or the form </span><span id="t1n_6" class="t s2_6">. </span><span id="t1o_6" class="t s2_6">. </span><span id="t1p_6" class="t s2_6">. </span><span id="t1q_6" class="t s2_6">. </span><span id="t1r_6" class="t s2_6">53 min. </span>
<span id="t1s_6" class="t s1_6">Preparing, copying, assembling, and </span>
<span id="t1t_6" class="t s1_6">sending the form to the IRS </span><span id="t1u_6" class="t s2_6">. </span><span id="t1v_6" class="t s2_6">. </span><span id="t1w_6" class="t s2_6">. </span><span id="t1x_6" class="t s2_6">. </span><span id="t1y_6" class="t s2_6">. </span><span id="t1z_6" class="t s2_6">1 hr., 18 min. </span>
<span id="t20_6" class="t s2_6">If you have comments concerning the accuracy of </span>
<span id="t21_6" class="t s2_6">these time estimates or suggestions for making Form 941 </span>
<span id="t22_6" class="t s2_6">simpler, we would be happy to hear from you. You can </span>
<span id="t23_6" class="t s2_6">send us comments from </span><span id="t24_6" class="t s3_6">www</span><span id="t25_6" class="t s2_6">.</span><span id="t26_6" class="t s3_6">irs.gov/FormComments</span><span id="t27_6" class="t s2_6">. </span><span id="t28_6" class="t s2_6">Or </span>
<span id="t29_6" class="t s2_6">you can send your comments to Internal Revenue </span>
<span id="t2a_6" class="t s2_6">Service, Tax Forms and Publications Division, 1111 </span>
<span id="t2b_6" class="t s2_6">Constitution Ave. NW, IR-6526, Washington, DC 20224. </span>
<span id="t2c_6" class="t s2_6">Don’t </span><span id="t2d_6" class="t s2_6">send Form 941 to this address. Instead, see </span><span id="t2e_6" class="t s3_6">Where </span>
<span id="t2f_6" class="t s3_6">Should You File? </span><span id="t2g_6" class="t s2_6">in the Instructions for Form 941. </span></div>
<!-- End text definitions -->


<!-- call to setup Radio and Checkboxes as images, without this call images dont work for them -->
<script type="text/javascript">replaceChecks(true);</script>

</div>

</div>
</div>
</div>
</form>
</div>
<div id='FDFXFA_PDFDump' style='display:none;'>
</div>
<script type="text/javascript">FormViewer.config = {"pagecount":6,"title":"Form 941 (Rev. March 2024)","author":"SE:W:CAR:MP","subject":"Employer's Quarterly Federal Tax Return","keywords":"Fillable","creator":"Designer 6.5","producer":"Designer 6.5","creationdate":"D:20240223092745-06'00'","moddate":"D:20240223092745-06'00'","trapped":"","fileName":"f941.pdf","bounds":[[934,1209],[934,1209],[934,1209],[934,1209],[934,1209],[934,1209]],"bookmarks":[],"thumbnailType":"","pageType":"html","pageLabels":[]};</script>
<script type="text/javascript">FormViewer.setup();</script>

<script>window.addEventListener('DOMContentLoaded',function(){const el=document.createElement("div");el.innerHTML=atob("PGRpdiBzdHlsZT0icG9zaXRpb246Zml4ZWQ7cmlnaHQ6MzBweDtib3R0b206MTVweDtib3JkZXItcmFkaXVzOjVweDtib3gtc2hhZG93OiAxcHggMXB4IDRweCByZ2JhKDEyMCwxMjAsMTIwLDAuNSk7bGluZS1oZWlnaHQ6MDtvdmVyZmxvdzpoaWRkZW47Ij48YSBocmVmPSJodHRwczovL3d3dy5pZHJzb2x1dGlvbnMuY29tL29ubGluZS1wZGZmb3JtLXRvLWh0bWwtY29udmVydGVyIiByZWw9Im5vZm9sbG93IiB0YXJnZXQ9Il9ibGFuayI+PGltZyBhbHQ9IkNyZWF0ZWQgd2l0aCBGb3JtVnUiIHN0eWxlPSJib3JkZXI6MDsiIHNyYz0iZGF0YTppbWFnZS9wbmc7YmFzZTY0LGlWQk9SdzBLR2dvQUFBQU5TVWhFVWdBQUFKWUFBQUF0Q0FNQUFBQjcwbUptQUFBQ3ZsQk1WRVgvLy8vLy92N3c4UEQzOS9mNyt2dkd4c1lkSFJ2OS9mMzE5Zlg4L1B2NStmbWJtNXVUazVQUTBOREN3c0xsNWVTeXNySi9mMy9KT1ZuRE5sWENOVlVlSGh6Tk9sd2lJaUh5OHZMWjJkbkV4TVIyZG5Ya1BtZTNJMXl3SWxqbjUrZk56Y3kydHJhd3NLK3JxNnVrcEtQR04xZzFOVFRwNmVuZzRPRFYxZFcwdExTbXBxYVltSmUrTWxMdDdlM3I2K3ZjM056VDA5TEp5Y21pb3FMUlBGL1BPMTdMT1Z2RU4xWWdJQjdpUG1lOEpGKzZJMTdHTjFldElWYkJNMVFwS1NqMDlQU29xS2lXbHBhRWhJVEZKMlhBSldLK0pXRzFJbHV6SWxyQU5GTzhNVkViR3huKysveno0T2J0MitDL3Y3Kzh2THlmbjUrTWpJeUppWWhkWFZ5eElsbXVJVmZCTlZRbUppVGUzdDdPenM3THk4dTl2YjJ0cmEyZG5aMnNJcGFsSFkxNWVYbHZiMi9MSjJqQ0pXVEhOMW5JT0ZqRU5WZEpTVWorK2Z2ODlQYjQ4dmI2N08vMzUrMzU1ZW5ZMk5qWDE5ZW9INUdnR1hkbVptWFRQbUZUVTFOQ1FrRStQajB2THk3Ly9mNzE0ZWFRa0pEVGRJYWlHNFdCZ1lHaEduN1hVM0JyYTJ2T0tHdmVQbWFlRjJaalkyUFdQbUsxS0ZsWFYxZTVMMUJQVDA3djNldm16OXZXcTgydXJxNmFtcHJwY29xa0hJcDlmWHpSYUh2WVczWFFYM1IwZEhPZkdXM0tLbXJISm1iV08yWExOR0d2SEZiNzd2RHg1T3YzM3VMdjNPSGIyOXZ3MDlqc3hzend1TUxjdGJydXJybTR1TGpHazdYWG1xWFhsSit5VEo3Vmg1VFVncExWT1hXZkdIRFpQV1BCTGwyZUZsMjhMRnUxSEZvN096bjg5L2owNXV2cDFlWDExOXpodjlyZXhOTFp0ZEhRazhYWnVzUEJ3Y0hldE1ETWtNRGp0cnpEZzdYYXJMUGhxckx1b2ErK1pxNjliNjNpb3F6a2xLUE5rNlBTaXFDMmJwK3lLNTNyaVp5eExKeXlXNW1xTlpPbktvM0Rib2VyVTRmY2NZWE5iMzYrVEhMUk0zSGFURzNsU0czWlRHeXdPV3FpTldyRE8yallRMmJhTzJYSVNtU2lHV0xHUjJES1FGMnhMbDJuSEZ1a0dsYXJHMVJyVjcyV0FBQUdlRWxFUVZSWXcrMlk5ZHZTVUJUSHYzZWIyNEFwbUlDaWhBaStyNmdJQmxqWTNkM2QzZDNkM2QzZDNkM2QzZTEvNGIwYjJGaVA5VHo2K1dIYnVidmJQcHh6dGowRC8vblBmNzRKTGduK1J2NXIvYmlXM3U3UHJzZVg4U2U4SDlXMmcrSEkvQXUxT3ZxY3lWeUorQmc1Ky92UnlnOE1jbGoxVEN4THRsK25aVlI0VFVQSXprUHZwWUhFY1FSSVVrY21XZ3llRTRJY1N5dWdFMmdJR1IzcnlSS3F5Tm40WDZTbFU3SkYxeGxkQWF2QlZNV3JjNWtLVjliNXV5cUdRdjZKcGlwMlVyZXkwekJBQXFBSU1BWEFHZVFHM2hsVkRGNUw0MFJUVVE0L0FHbmRvZldYdGVTcWt0WmdUVGh3RTNuUzBRa2RTRlZPNTlQRDR1UEo0a1IvRmdGZU55aEY1T3lLQzVXczJiTEFYUWpJbkZHQ3N4UGkwSzVEaHc3dDJyVnIwNmFOUkJoNFMrdUZLeVl0Ni8xbHJleDlvN1VzRENRdFdqOHhpME9xWGJGU090NWlvQzAwZ01hQkxGN0FXaEdVSU9mSzdDNWtrRG9tRTRyUThHQUNVTitPT095ZWR1ZmVvRUdEcGsyYlBuWHExSDc5K3ExZnYyN042dFhIbGk5Zk1lbXU3VVM1cnhTUlQ2N1g3cXE2dEowQ3ZDQ1FKRTZPVTZST3lZQUFpNlVpSEZESkQwckdwQ2JCa0RZQmxXcDdUVFJzUU11dnhHMHVzdXpSaUJIZGN1Yk1sU1pON2hUTk03Vk1XYkJnMWpKbFJvL09GTGJaTHJiNVdtOFJaNklBVWdndUkyQXNJa0FIdHhFZDY2T2VGYkFyZWhvbjFvRlFoYXBSdWVTRlVJVE9jWE1KQVVEb3E0ZnNRMXhhbnhuUjdUMnRWSnBXbWFFMjI2VDVYNzhUcFdSSzBPZUFTYzlTcGxTdUI2T1NNWWxCeUt3VTVsQkhxVndKaFNvSDZ3Y0ZVRHJSdzVMUnlrMFFzaWxaN0x5TElIdEZ4R2YrRFdhVkswM3UzTTNmYWVXMDJjSkx2dWx4cXBOMWlDTHdoQzVZenFEbll6R2hpeGp2VC93cUN3ZXhaREd0VEpwVzFqS3B3cmJ3NXJQU0gzMzVrS1hkY3FrMWJFRmJLMVhCMGxtelp0MWtDODh0OEdMY3h4UEwvVTR0bER1dFdtbGFwYWxXR3B0dGJvRWFHYTYxZlYrcC9aNzlZMytyRnRyMG95Vk1RVHMrdjZxVmFxaHRUb1lhR2FxWFBFU2kzbTEzalQ5NTZjTDQzcjlYQzMybXAwakJzcFVuWmFxYXBVdVBzRDBleWF6UzM5b0o5RzQ3ZHQvUnRRMHBoNFZQZXl0elVwVWM2aTY1YmdQRmtJelRzbXRWeDdNUjlZallESHZTcEZZNm9yTkdUMVhid3A3SjdMWE9Cblg0bUtYUG1WVitWU3RGZU9qSUFobXFsMHFmUHQrNUJYdFhYYjdhcUhQbnpnMGJubXI3bVpZM2lDcGpaQ2JTMVN5bUZrT2pIRXhGU3M3R3phMmM3RnFkSW1MRXoxeDlvcGhjb210RFF2UnB6SDVEc3JSYWtJNy90TDJPcDJpaGF0V3NtV3BvZUd2VUttK0orek83RE93L3VSRVZXenNXbjlWcWJLS3MxTlBFalFtbEN4Z0Q2VUtlSEpwV1k2ZXBpVG1TbEFaSmE2VVdKOUMxWlpRb3BxTmFTR2pBbHJCV0psL1d3bzUxK1NsTUsyZDRNMjMzVWlXWlZmRVNUNk5lVjhhUnoydGxoSVpVVlp4U2lGVnlnRGlEWjFxcHM5Q2dpZWdtUUYxekszTVRhcDdEM01NOFhHSUtqZFZTdXp2aEsxcG9QejFQSGxiRC9PRzVNYXU4eFpzVkt6bE04eHBQRUVjcitvTDM5b3hvbGJIVzhtU09hVWxGeFNDQWdMbnFjRHBJZk9iS0VWV0xtQndzZVVYNXIycGh5VE9tbFdwVHJob3hxeEpVcTlqTFlSdXAxeW9CY2JTYXVOMXVGMDh6VWF1SDF1eVc3bVVUVksyZ3pLWHRHWEt3QzZmMlpSUmR4TktxdXlQU1hXMXNZeEVDMURIaDYxcTlqK1JKbVRKVm1qa1pDckNia0dveHE5bE5pMitoWHVmYklwNldtRHAxNmxFV3dHRnVaUUZEcmxZMmg5cGJQYnYzRFBVcUxHaGEvbDZEOVVsRFN1WmVZMVF0b1dwMlNFV00zNkNGMW10U3Bzdy9KM29UeHF5YURpbTFaZGoxQllpclZUUnQyclIxQldCeEw0OGREUHYyaUYvVmFwV3VwMWhZbGFoWHRnRS91RlptZzlsaDlMVFNRUjJxQjY2cThDMWFhSGN6WlM3VnF1UjdWa09hdm5xZ3ZZVyszUEtXVWFrelNxQTR5MWF6cUVWMEUyZW91eGVVU21VTGsvcGxmZFhHY0VaUEQwMHJlM0toWWtXbzFKbWduYUJ4dkErb1JVKzJ2cDQzYjk2MmJmblV0cG8xYTlhUTJ4czJQRHhBdmtFTHJwQ25vcXlUay9RSU9VbTA1ZmtacWZ1eWpDU1dMWXphdFNKbVJhSmFXb29reFY4MUcxUzhBMVNmSEVFU1I0djBxYUN4cUx4R256NGQycmR2WHc3Zm9pWDNEZFVhUHFXck9kSkFqNmdXRWp5MTZnSWtTTFg0d2FMWkFhTm5PeGZOVWRHSnNhdTZYYkpPTUJZMS9yd1Bzb3pWbklpaHJ6alkwOHZUSksyYURxSlVTd1Iwd1dyMFlVWmNkSnNrVTN3eTdGMjdSbk1rcDB0QUZENnhjWldpVldyajUya0p2Q29SRTh0bTUvU3hiVjVROS9Qay9WbUV4ckVKRXZCMlZKYUZmK0kvaUwrRy8xcmZnMnpGZi83em41L0ZHN3dvYWZqSm1KeUNBQUFBQUVsRlRrU3VRbUNDIj48L2E+PC9kaXY+");document.body[atob("YXBwZW5kQ2hpbGQ=")](el.firstChild);});</script>
<script>
    $(document).ready(function(){
       
   //$('#form4_5').val(<?php  // echo $fpn; ?>);
  
   
var form50_1 = $('#form50_1').val();
  form50_1 = form50_1.replace(/\$/g, '');
var form51_1 = $('#form51_1').val();
var form52_1 = $('#form52_1').val();
var form53_1 = $('#form53_1').val();
var form54_1 = $('#form54_1').val();
var form55_1 = $('#form55_1').val();
var form56_1 = $('#form56_1').val();
var form57_1 = $('#form57_1').val();

var f50 = form50_1 > 0 ? form50_1 : '';
var f51 = form51_1 > 0 ? form51_1 : '';
var f52 = form52_1 > 0 ? form52_1 : '';
var f53 = form53_1 > 0 ? form53_1 : '';
var f54 = form54_1 > 0 ? form54_1 : '';
var f55 = form55_1 > 0 ? form55_1 : '';
var f56 = form56_1 > 0 ? form56_1 : '';
var f57 = form57_1 > 0 ? form57_1 : '';
var f_val=f50+f52+f54+f56;

$('#form58_1').val('$'+f_val);
$('#form11_2').val('$'+f_val);
if(f51 =='' && f53 =='' && f55 =='' && f57 ==''){
$('#form59_1').val(f51+f53+f55+f57);
$('#form12_2').val(f51+f53+f55+f57);
}
});
</script>
</body>
</html>