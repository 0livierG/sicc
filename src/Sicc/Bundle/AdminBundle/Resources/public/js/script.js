/**
 * Created by student on 12/14/13.
 */
function confirmationJs(texte){
    var sur= confirm(texte);
    return sur;
}

$(document).ready(function(){
    $('.redactor_content').redactor();
});