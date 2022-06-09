elems = document.getElementsByClassName("list_task_id");

for (let index = 0; index < elems.length; index++)
{
    elems[index].addEventListener("click", task_update);
}
let form = document.getElementsByClassName("form_task")[0];
let er = null;
let editing_task_id = document.getElementsByClassName("list_cont_tasks__table")[0].getAttribute('data__now_editing_task_id');
let editing_task_status = document.getElementsByClassName("list_cont_tasks__table")[0].getAttribute('data__now_editing_task_status');
alert(editing_task_id);
if (editing_task_id > 0)    // Действия, если при редактировании задачи, отправка прошла с ошибками
{
    table = document.getElementsByClassName("list_cont_tasks__table")[0];    // строки, чтобы найти теги <tr> с задачами
    table_tbody = table.children[1];
    table_tr = table_tbody.children;

    let td_event_elem = find_row_by_id(table_tr, editing_task_id).children[1];  // td с заголовком здачи
	alert(td_event_elem);
    td_event_elem.style.color = "#0095B6";
    document.getElementsByClassName("task_header")[0].innerHTML = "Редактирование";
    form[6].innerHTML = "Изменить";

    let if_done_element = document.createElement('input'); 
            if_done_element.type = "checkbox"; 
            if_done_element.name = "if_done";
            form[5].after(if_done_element);
            
            let desc_if_done_element = document.createElement('label'); 
            desc_if_done_element.innerHTML = "Выполнена:";
            form[6].before(desc_if_done_element);

			let mark_element = document.createElement('input'); 
			mark_element.type = "hidden"; 
			mark_element.name = "task_id"; 
			form.append(mark_element);

			let cancel_button = document.createElement('button'); 
			cancel_button.innerHTML = "Отмена"; 
			cancel_button.type = "reset"; 
			cancel_button.classList += "formbutton"; 
			form.append(cancel_button);

			form[9].addEventListener("click", href); 

    let task_id = line.children[1].getAttribute("data__id");
    form[8].value = task_id;
    editing_task_status > 0 ? form[7].setAttribute("checked", "checked") : form[7].removeAttribute("checked");

    er = td_event_elem;
}

function find_row_by_id(rows, find_id)
{
    for (let index = 0; index < rows.length; index++)
    {
        if (rows[index].children[0].getAttribute("data__id") == find_id)
        {
            return rows[index];
        }
    }
}
function task_update(event)
{
    if (er) { er.style.color = ""; }   
    this.style.color = "#0095B6";
    document.getElementsByClassName("task_header")[0].innerHTML = "Редактирование";    
    let line = this.parentNode;    
     

    form[0].value = line.children[0].innerHTML;   
    for (let index = 0; index < form[1].children.length; index++)  
    {
        if (form[1].children[index].selected) { form[1].children[index].selected = false; }
        if (form[1].children[index].innerHTML.includes(line.children[1].innerHTML)) { form[1].children[index].selected = true; }
    }
    form[2].value = line.children[2].innerHTML;   
    let temp = line.children[3].innerHTML.split(" ");
		form[3].value = temp[0] + "T" + temp[1];  
    for (let index = 0; index < form[4].children.length; index++)   
    {
        if (form[4].children[index].selected) { form[4].children[index].selected = false; }
        if (form[4].children[index].innerHTML.includes(line.children[4].innerHTML)) { form[4].children[index].selected = true; }
    }
    form[5].value = line.children[5].innerHTML;
    form[6].innerHTML = "Изменить";
  
    if (!form[7]) 
		{             
            let if_done_element = document.createElement('input'); 
            if_done_element.type = "checkbox"; 
            if_done_element.name = "if_done";
            form[5].after(if_done_element);
            
            let desc_if_done_element = document.createElement('label'); 
            desc_if_done_element.innerHTML = "Выполнена:";
            form[6].before(desc_if_done_element);

			let mark_element = document.createElement('input'); 
			mark_element.type = "hidden"; 
			mark_element.name = "task_id"; 
			form.append(mark_element);

			let cancel_button = document.createElement('button'); 
			cancel_button.innerHTML = "Отмена"; 
			cancel_button.type = "reset"; 
			cancel_button.classList += "formbutton"; 
			form.append(cancel_button);

			form[9].addEventListener("click", href); 
		}
   	if (line.children[6].innerHTML.includes("Выполненная")) { form[6].setAttribute("checked", "checked"); }
    let task_id = line.children[1].getAttribute("data__id");
    form[8].value = task_id;
    er = this;
}

function href()
{
    window.location.href = window.location.href;
}
