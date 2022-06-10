window.onload = init;

function init()
{
    document.getElementsByName('date')[0].value = new Date().toJSON().slice(0,10);
    let tags = document.querySelector('#inputTags');
    tags.addEventListener('keyup', tagsOnKeyUp);
    tags.addEventListener('blur', function(){swapTag(this);} );
    tags.addEventListener('change', function(e){swapTag( document.querySelector('#inputTags') ); } );
    document.querySelector('button[type=submit]').addEventListener('click', preSend);
}

function preSend()
{
    let lis = document.querySelectorAll('.selectTags .selectTag');
    let tags = '';
    for (let li of lis)
    {
        tags += li.textContent + ',';
    }
    document.querySelector('#hiddenTags').value = tags;

    console.log( document.querySelector('#hiddenTags').value );
}

async function tagsOnKeyUp(e)
{

    if (e.keyCode == 13) return;
    if (e.key == ',') {swapTag(this); return};

    let tags = this.value.split(',');
    let lastTag = tags[ tags.length-1 ].trim();

    if(lastTag && lastTag.length)
    {
        let response = await fetch('/getTags/' + lastTag);

        if (response.ok)
        {
            let json = await response.json();
            addOptionInList(json);
            // showTagList(json);
        }
        else
        {
            console.log("Ошибка HTTP: " + response.status);
        }
    }
}

function addOptionInList(json)
{
    if (json.length)
    {
        let opt = '';
        for (let j of json)
        {
            opt += '<option>'+ j.name +'</option>';
        }
        let tagsList = document.querySelector('#tagsList');
        tagsList.innerHTML = '';
        tagsList.insertAdjacentHTML('beforeend', opt);

    }
}


function swapTag(input)
{
    let tags = input.value.split(',');
    for(let i=0;i<tags.length;i++)
    {
        tags[i] = tags[i].trim();
    }

    for(let t of tags)
    {
        if (t != '')
        {
            document.querySelector('.selectTags').insertAdjacentHTML('beforeend', '<li name="tags" class="selectTag" onclick="this.remove()">' + t + '</li>');
            input.value = '';
            document.querySelector('#tagsList').innerHTML = '';
        }
    }
}
