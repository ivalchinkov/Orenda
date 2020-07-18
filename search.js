function searchFunction() {
    var input, filter, ul, li, a, i;
    input = document.getElementById('myinput');
    filter = input.value.toUpperCase();
    ul = document.getElementById('wrapper');
    li = ul.getElementsByTagName('li');

    for(i=0 ; i< li.length; i++){
        a = li[i].getElementsByTagName('a')[0];
        if(a.innerHTML.toUpperCase().indexOf(filter) > -1){
            li[i].style.display = "";
        }

        else{
            li[i].style.display = 'none';
        }
    }
}

const vegetables = [
    {name: 'чушки'},
    {name: 'домати'},
    {name: 'моркови'},
    {name: 'патладжани'},
    {name: 'спанак'},
    {name: 'лук'}
];

const list = document.getElementById('list');

function setList(group){
    clearList();
    for(const vegetables of group){
        const item = document.createElement('li');
        item.classList.add('list-group-item');
        const text = document.createTextNode(vegetables.name);
        $('#result').append(vegetables.name);
        //$('#items-data').each(function(){
        //    console.log($(this).find('input.hidden_name').val() + '  ' + vegetables.name);
        //    if($(this).find('input.hidden_name').val() != vegetables.name){
        //        $(this).css('display', 'none');
        //}
        //});
        //console.log($('#result'));
        //appendvam mu text
        item.appendChild(text);
        list.appendChild(item);
    }
    if(group.length === 0){
        setNoResults();
    }
}

function clearList(){
    while(list.firstChild){
        list.removeChild(list.firstChild);
    }
}

function setNoResults(){
    const item = document.createElement('li');
    item.classList.add('list-group-item');
    const text = document.createTextNode('Няма намерен резултат');
    item.appendChild(text);
    list.appendChild(item);
}

function getRelevancy(value, searchTerm){
    if(value === searchTerm){
        return 2;
    }else if (value.startsWith(searchTerm)){
        return 1;
    }else if(value.includes(searchTerm)){
        return 0;
    }
}

const searchInput = document.getElementById('search');

searchInput.addEventListener('input', (event) => {
    let value = event.target.value;
    if(value && value.trim().length > 0){
        value = value.trim().toLowerCase();
        setList(vegetables.filter(vegetables => {
                return vegetables.name.includes(value);
            }).sort((vegetableA, vegetableB) => {
            return getRelevancy(vegetableB.name, value) - getRelevancy(vegetableA.name, value);
        }));
    }else{
        clearList();
    }
})