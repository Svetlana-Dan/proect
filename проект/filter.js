let param = window.location.href.split('?').length > 1 ? window.location.href.split('?')[1] : '';
let filter_date = param.split('date=').length > 1 ? param.split('date=')[1].split('&')[0] : null;
let filter_what = param.split('what=').length > 1 ? param.split('what=')[1].split('&')[0] : null;
let filter_when = param.split('when=').length > 1 ? param.split('when=')[1].split('&')[0]: null;
let url = window.location.href.split('?')[0];
let elements = document.getElementsByClassName("filter_element");
for (let index = 0; index < elements.length; index++)
{
    if (elements[index].tagName == "SELECT" || elements[index].tagName == "INPUT")
    {
        elements[index].addEventListener("change", filter);
    }
    else
    {
        elements[index].addEventListener("click", filter);
    }
}
function filter(event)
{
    let varb = "?";
    if (event.target.tagName == "SELECT")
    {
        filter_what = event.target.value;
    }
    else if (event.target.tagName == "INPUT")
    {
        filter_date = event.target.value;
        filter_when = null;
    }
    else if (event.target.tagName == "SPAN")
    {
        filter_when = event.target.attributes.value.value;
        filter_date = null;
    }
    if (filter_what != null) { varb += "what=" + filter_what + "&"; }
    if (filter_date != null) { varb += "date=" + filter_date + "&";}
    if (filter_when != null) { varb += "when=" + filter_when;}
    window.location.href = url + varb;
    return;
}