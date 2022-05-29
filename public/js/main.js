var rows = document.getElementsByClassName("datarow");
var columns = document.getElementsByClassName("column_name");
var buttons = document.getElementsByClassName("editrowbutton");
var fullrows = document.getElementsByClassName("userprofile__info--row");
const profile = document.getElementsByClassName("userprofile")[0];
var descriptions = document.getElementsByClassName("productGridCard__description");

function editRow(row, datavalue, updateroute, editroute) {
    // open edit mode on new row
    profile.innerHTML = profile.innerHTML.replace(`<form id="profileform" class="editprofile-form">`,`<form method="POST" id="profileform" class="editprofile-form" action="${updateroute}">`);
    
    var column = columns[row].innerHTML.toLowerCase().replace(/\s/g,''); // convert column names to lowercase and remove spaces
    var addedAttributes = "";

    // add attributes based on which piece of data is being edited
    switch (column) {
        case 'phonenumber':
            addedAttributes = 'maxlength="10"';
            break;
    }
    
    const formstring = `<input class="editprofile-form__input" name="${column}" id="${column}" ${addedAttributes} type="text" value="${datavalue}" /><a href='${editroute}' class="cancel_edit--button"><i class="gg-close"></a></i><button class="submit_edit--button" type="submit"><i class="gg-check"></i></button>`;
    
    // while editing
    rows[row].innerHTML = formstring;  
    fullrows[row].style.background = "#eeeeeeda";

    for (var i = 0; i < buttons.length; i++) {
        buttons[i].style.display = "none";
        if (row != i) {
            fullrows[i].style.background = "none";
        }
    }
}

function truncate(str, n){
    // returns shortened description
    return (str.length > n) ? str.substr(0, n-1) + '&hellip;' : str;
};

window.onload = function() {
    // change loaned values and hide ribbon if item isn't loaned out
    var loaned = document.getElementsByClassName("loaned");
    var ribbon = document.getElementsByClassName("cr");
    for (var i = 0;  i < loaned.length; i++) {
        if (loaned[i].innerHTML == '0') {
            ribbon[i].style.display = "none";
        }
        loaned[i].innerHTML = "";
    }

    for (var i = 0; i < descriptions.length; i++) {
        string = descriptions[i].innerHTML;
        descriptions[i].innerHTML = truncate(string, 100);
    }

}